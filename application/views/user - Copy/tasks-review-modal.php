<link rel="stylesheet" href="<?php echo base_url();?>assets/css/mention.css">
<?php
$privilege_only_view = 'no';
if(!empty($this->session->userdata('d168_user_cor_id')))
{
$getCompPackInfo = $this->Front_model->getCompany($this->session->userdata('d168_user_cor_id'));
if($getCompPackInfo)
{
  $privilege = "no";
  if(is_numeric($this->session->userdata('d168_user_role_in_comp')))
  {
    $getCompRolesInfo = $this->Front_model->getCompanyRoles($this->session->userdata('d168_user_role_in_comp'));  
    if($getCompRolesInfo)
    {
      if($getCompRolesInfo->privilege != 'all')
      {
        $cus_privilege = explode(', ',trim($getCompRolesInfo->privilege));
        if(in_array('view', $cus_privilege))
        {
          $privilege_only_view = 'yes';
        }
      }
      else
      {
        $privilege = "yes";
      }
    }      
  }
}
}
if($tdetail)
{
    $check_permission = $this->Front_model->check_file_preview_access($tdetail->tproject_assign);
    
    $getProject = $this->Front_model->getProjectDetailID($tdetail->tproject_assign);
    if($getProject)
    {
        $pcreated_by = $getProject->pcreated_by;
        $pmanager = $getProject->pmanager;        
    }

    $get_active_Email_ID = $this->Front_model->getStudentById($this->session->userdata('d168_id'));
    $ActiveEmail_ID = "";
    if($get_active_Email_ID)
    {
        $ActiveEmail_ID = $get_active_Email_ID->email_address;
    }
    $check_active_portfolio = $this->Front_model->check_PortfolioMemberActive($tdetail->portfolio_id, $ActiveEmail_ID);
    if($check_active_portfolio)
    {
        
    //Arrive for review
    $pro_car = $this->Front_model->getProjectById($tdetail->tproject_assign);
    if($pro_car)
    {
        if($tdetail->po_review_notify == 'sent_yes' && $pro_car->pcreated_by == $this->session->userdata('d168_id'))
        {
            $data = array(
                            'po_review_notify' => 'sent_seen',
                        );
            $data = $this->security->xss_clean($data); // xss filter
            $this->Front_model->edit_TaskArriveReviewNotify($data,$tdetail->tproject_assign,$tdetail->tid);
        }
        elseif($tdetail->po_review_notify == 'sent_yes' && $pro_car->pmanager == $this->session->userdata('d168_id'))
        {
            $data = array(
                            'po_review_notify' => 'sent_seen',
                        );
            $data = $this->security->xss_clean($data); // xss filter
            $this->Front_model->edit_TaskArriveReviewNotify($data,$tdetail->tproject_assign,$tdetail->tid);
        }
    }
?> 
                    <div data-simplebar style="max-height: 400px;"> 
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media">
                                           <div class="avatar-sm me-4">
                                                <span class="avatar-title rounded-circle bg-d bg-soft text-white font-size-24">
                                                        <i class="bx bx-detail"></i>
                                                </span>
                                           </div>

                                            <div class="media-body overflow-hidden">
                                                <span>
                                                    <h5 class="text-truncate font-size-15" style="padding: 8px;"><strong>TASK:</strong> <b><?php echo $tdetail->tname;?></b></h5>
                                                    <?php
                                                    if(isset($_COOKIE["d168_selectedportfolio"]))
                                                    {
                                                        if($_COOKIE["d168_selectedportfolio"] == $tdetail->portfolio_id)
                                                        {
if($privilege_only_view == 'no')
{

                                                            ?>
                                                    <a href="javascript:void(0)" onclick="return tasks_review_approve(<?php echo $tdetail->tid;?>);" class="btn btn-sm btn-d text-white">Approve Task</a>
                                                    <a href="javascript:void(0)" onclick="return tasks_review_deny(<?php echo $tdetail->tid;?>);" class="btn btn-sm bg-d text-white">Deny Task</a> 
                                                    <?php
}
                                                        }
                                                        else
                                                        {
                                                            echo "<span class='text-danger'> Different Portfolio is Selected!</span>";
                                                        }
                                                    }
                                                    else
                                                    {
                                                        echo "<span class='text-danger'> Portfolio not Selected!</span>";
                                                    }
                                                    ?>                
                                                </span>
                                                
                                            </div>
                                        </div>

                                        <h5 class="font-size-15 mt-4">Task Code :</h5>
                                        <p class="text-muted"><?php echo $tdetail->tcode;?></p>

                                        <h5 class="font-size-15 mt-4">Task Notes :</h5>
                                        <p class="pdes"><?php echo $tdetail->tnote;?></p>

                                        <h5 class="font-size-15 mt-4">Task Description :</h5>

                                        <p class="pdes"><?php 
                                        if(!empty($tdetail->tdes))
                                            {
                                                echo $tdetail->tdes;
                                            }
                                        ?></p>

                                        <h5 class="font-size-15 mt-4">Tasks Links and Comments :</h5>
                                        <p><?php if(!empty($tdetail->tlink))
                                                        {
                                                            $tlink = explode(',', $tdetail->tlink);
                                                            $tlink_comment = explode(',',$tdetail->tlink_comment);
                                                            $tlcount = count($tlink);
                                                            if($tlcount > 0){
                                                ?>
                                                <ul class="list-unstyled fw-medium">
                                                <?php
                                                for ($i=0; $i<$tlcount; $i++){
                                                    ?>
                                                    <li>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <i class="mdi mdi-chevron-double-right me-1 text-d"></i> 
                                                                <a href="<?php echo $tlink[$i];?>" class="nameLink" title="Open Link" target="_blank">
                                                                                <?php
                                                                                    echo $tlink[$i];
                                                                                ?>
                                                                                </a>
                                                            </div>
                                                            <div class="col-6">
                                                                                <?php
                                                                                   if(!empty($tlink_comment[$i])){
                                                                                    echo $tlink_comment[$i];
                                                                                }
                                                                                ?>
                                                            </div>
                                                        </div></li>
                                                    <?php
                                                }
                                                ?>
                                                </ul>
                                                <?php
                                            }
                                        }?></p>

                                        <h5 class="font-size-15 mt-4">Task Files :</h5>
                                        <p><?php if(!empty($tdetail->tfile))
                                        {
                                            $tfile = explode(',', $tdetail->tfile);
                                            $count = count($tfile);
                                            if($count > 0)
                                            {
                                                ?>
                                                <ul class="list-unstyled fw-medium">
                                                <?php
                                                for($i=0; $i<$count; $i++)
                                                {
                                                    $tfile_name = $tfile[$i];
                                                    ?>
                                                    <li>
                                                        <div class="row">
                                                            <div class="col-9">
                                                                <i class="mdi mdi-chevron-double-right me-1 text-d"></i> 
<?php
if($privilege_only_view == 'no')
{
?>                                                                 
                                                                <a href="javascript: void(0);" class="nameLink" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>')" title="Preview"><?php echo substr($tfile_name, strpos($tfile_name, '_') + 1);?></a>
<?php
}
elseif(($pcreated_by == $this->session->userdata('d168_id')) || ($pmanager == $this->session->userdata('d168_id')))
{
?>                                                                 
                                                                <a href="javascript: void(0);" class="nameLink" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>')" title="Preview"><?php echo substr($tfile_name, strpos($tfile_name, '_') + 1);?></a>
<?php
}
else
{
    if($check_permission)
    {
        if($check_permission->req_status == 'accepted')
        {
        ?> 
            <a href="javascript: void(0);" class="nameLink" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>')" title="Preview"><?php echo substr($tfile_name, strpos($tfile_name, '_') + 1);?></a>
        <?php
        }
        else
        {
        ?> 
            <a href="javascript: void(0);" class="nameLink" onclick="return file_preview_access_req('<?php echo $tdetail->tproject_assign;?>')" title="Preview"><?php echo substr($tfile_name, strpos($tfile_name, '_') + 1);?></a>
        <?php 
        }
    }
    else
    {
    ?> 
        <a href="javascript: void(0);" class="nameLink" onclick="return file_preview_access_req('<?php echo $tdetail->tproject_assign;?>')" title="Preview"><?php echo substr($tfile_name, strpos($tfile_name, '_') + 1);?></a>
    <?php 
    }    
}
?>
                                                            </div>
                                                            <div class="col-3">
<?php 
if($privilege_only_view == 'no')
{
?>
                                                                <a href="javascript:void(0)" onclick="return delete_tfile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>');" class="text-dark float-end" title="Delete"><i class="bx bxs-x-square h3 m-1"></i></a>

                                                                <a href="<?php echo base_url().'front/download_taskFileAttachment/'.$tfile_name.'/'.$tdetail->tid;?>" class="text-dark float-end" title="Download"><i class="bx bx-download h3 m-1 text-d"></i></a>
<?php
}

if($privilege_only_view == 'no')
{
?>
                                                                <a href="javascript: void(0);" class="nameLink float-end" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
<?php
}
elseif(($pcreated_by == $this->session->userdata('d168_id')) || ($pmanager == $this->session->userdata('d168_id')))
{
?>
                                                                <a href="javascript: void(0);" class="nameLink float-end" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
<?php
}
else
{
    if($check_permission)
    {
        if($check_permission->req_status == 'accepted')
        {
        ?> 
            <a href="javascript: void(0);" class="nameLink float-end" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
        <?php
        }
        else
        {
        ?> 
            <a href="javascript: void(0);" class="nameLink float-end" onclick="return file_preview_access_req('<?php echo $tdetail->tproject_assign;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
        <?php 
        }
    }
    else
    {
    ?> 
        <a href="javascript: void(0);" class="nameLink float-end" onclick="return file_preview_access_req('<?php echo $tdetail->tproject_assign;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
    <?php 
    }    
}
?>
                                                            </div>
                                                        </div></li>
                                                    <?php
                                                }
                                                ?>
                                                </ul>
                                                <?php
                                            }
                                        }?></p>

                                        <h5 class="font-size-15 mt-4">Subtasks :</h5>
                                        <p><?php 
                                        $Check_Task_Subtasks = $this->Front_model->Check_Task_Subtasks2($tdetail->tid);
                                        if($Check_Task_Subtasks)
                                        {
                                        ?>
                                            <ul class="list-unstyled fw-medium">
                                                <?php
                                                foreach($Check_Task_Subtasks as $subtask)
                                                {
                                                    ?>
                                                    <li>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <?php
                                                                    if($subtask->ststatus == 'to_do')
                                                                    {
                                                                ?>
                                                                <i class="mdi mdi-checkbox-blank-circle-outline me-1 h4" title="To Do"></i> 
                                                                <?php
                                                                }
                                                                elseif($subtask->ststatus == 'in_progress')
                                                                {
                                                                ?>
                                                                <i class="mdi mdi-dots-horizontal-circle-outline me-1 h4" title="In Progress"></i> 
                                                                <?php
                                                                }
                                                                elseif($subtask->ststatus == 'in_review')
                                                                {
                                                                ?>
                                                                <i class="mdi mdi mdi-progress-check me-1 h4" title="In Review"></i>
                                                                <?php
                                                                }
                                                                elseif($subtask->ststatus == 'done')
                                                                {
                                                                ?>
                                                                <i class="mdi mdi-check-circle-outline me-1 text-d h4" title="Done"></i>
                                                                <?php
                                                                } 
                                                                ?>
                                                                <a href="javascript: void(0);" class="nameLink h6" onclick="return SubtaskOverviewModal('<?php echo $subtask->stid;?>')"><?php echo $subtask->stcode." : ".$subtask->stname;?></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php
                                                }
                                                ?>
                                            </ul>
                                        <?php
                                        }
                                        ?></p>
                                        <div class="row m-4">
                                                        <div class="col-md-6">
                                                            <div>
                                                                <?php
                                                                    if(!empty($tdetail->tproject_assign))
                                                                        {
                                                                ?>
                                                                <p class="text-muted"><i class="bx bx-briefcase-alt-2 font-size-16 align-middle me-1 text-d"></i> Project :
                                                                <?php
                                                                            $check_page = $this->Front_model->ProjectDetail($tdetail->tproject_assign);
                                                                            if($check_page)
                                                                            {
                                                                                $pro = $this->Front_model->getProjectById($tdetail->tproject_assign);
                                                                ?>
                                                                    <a class="nameLink" href="<?php echo base_url('projects-overview/'.$tdetail->tproject_assign);?>">
                                                                        <?php echo $pro->pname;?>
                                                                    </a>
                                                                <?php
                                                                            }
                                                                            else
                                                                            {
                                                                                $pro = $this->Front_model->getProjectById($tdetail->tproject_assign);
                                                                ?>
                                                                <a class="nameLink" href="<?php echo base_url('projects-overview-accepted/'.$tdetail->tproject_assign);?>">
                                                                        <?php echo $pro->pname;?>
                                                                </a>
                                                                <?php
                                                                            }
                                                                ?>
                                                                </p>
                                                                <?php
                                                                        }
                                                                ?>
                                                                <p class="text-muted"><i class="bx bxs-user-check font-size-16 align-middle me-1 text-d"></i> Assigned To : <?php
                                                                    $stud = $this->Front_model->getStudentById($tdetail->tassignee);
                                                                     echo $stud->first_name.' '.$stud->last_name;
                                                                    ?>
                                                                </p>                                                         
                                                                <p class="text-muted"><i class="bx bx-calendar font-size-16 align-middle me-1 text-d"></i> Created Date : <?php echo date("j M, Y", strtotime($tdetail->tcreated_date));?></p>
                                                                <p class="text-muted"><i class="bx bxs-user font-size-16 align-middle me-1 text-d"></i> Created By : <?php echo $tdetail->first_name.' '.$tdetail->last_name;?></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div>
                                                                <?php
                                                                    if(!empty($tdetail->tproject_assign))
                                                                        {
                                                                            $pro = $this->Front_model->getProjectById($tdetail->tproject_assign);
                                                                ?>
                                                                <p class="text-muted"><i class="bx bxs-user-detail font-size-16 align-middle me-1 text-d"></i> Portfolio : <?php
                                                                if($pro){
                                                                        if($pro->portfolio_id != 0)
                                                                        {
                                                                            $portfolio = $this->Front_model->getPortfolio2($pro->portfolio_id);
                                                                            if($portfolio){
                                                                            if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}
                                                                        }
                                                                        }
                                                                        } 
                                                                    ?></p>
                                                                <?php
                                                                }
                                                                ?>
                                                                <p class="text-muted"><i class="bx bx-calendar-check font-size-16 align-middle me-1 text-d"></i> Due Date : <?php echo date("j M, Y", strtotime($tdetail->tdue_date));?></p>
                                                                <p class="text-muted"><i class="bx bx-sort font-size-16 align-middle me-1 text-d"></i> Priority : <?php echo $tdetail->tpriority;?></p>
                                                                <?php
                                                                $tid = $tdetail->tid;
                                                                $assignee_status = $this->Front_model->check_assignee_status($tid);
                                                                if($assignee_status)
                                                                {
                                                                    if($assignee_status->tstatus == 'to_do')
                                                                    {
                                                                ?>
                                                            <div class="btn-group dropstart">
                                                                <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                    To Do <i class="mdi mdi-chevron-down"></i>
                                                                </button>
                                                                <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                    <form method="post" action="<?php echo(base_url('change_taskStatus'));?>">
                                                                        <input type="hidden" name="tid" value="<?php echo $tid;?>">
                                                                        <input type="hidden" name="tassignee" value="<?php echo $assignee_status->tassignee;?>">  
                                                                        <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_progress">In Progress</button>
                                                                        <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_review">In Review</button>
                                                                        <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="done">Done</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                                <?php
                                                                    }

                                                                    if($assignee_status->tstatus == 'in_progress')
                                                                    {
                                                                ?>
                                                            <div class="btn-group dropstart">
                                                                <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                    In Progress <i class="mdi mdi-chevron-down"></i>
                                                                </button>
                                                                <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                    <form method="post" action="<?php echo(base_url('change_taskStatus'));?>">
                                                                        <input type="hidden" name="tid" value="<?php echo $tid;?>">
                                                                        <input type="hidden" name="tassignee" value="<?php echo $assignee_status->tassignee;?>">  
                                                                        <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="to_do">To Do</button>
                                                                        <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_review">In Review</button>
                                                                        <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="done">Done</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                                <?php
                                                                    }

                                                                    if($assignee_status->tstatus == 'in_review')
                                                                    {
                                                                ?>
                                                            <div class="btn-group dropstart">
                                                                <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                    In Review <i class="mdi mdi-chevron-down"></i>
                                                                </button>
                                                                <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                    <form method="post" action="<?php echo(base_url('change_taskStatus'));?>">
                                                                        <input type="hidden" name="tid" value="<?php echo $tid;?>">
                                                                        <input type="hidden" name="tassignee" value="<?php echo $assignee_status->tassignee;?>">  
                                                                        <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="to_do">To Do</button>
                                                                        <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_progress">In Progress</button>
                                                                        <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="done">Done</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                                <?php
                                                                    }

                                                                    if($assignee_status->tstatus == 'done')
                                                                    {
                                                                ?>
                                                            <div class="btn-group dropstart">
                                                                <p class="text-muted me-2"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : </p>
                                                                <button type="button" class="btn btn-d btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                    Done <i class="mdi mdi-chevron-down"></i>
                                                                </button>
                                                                <div class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px 0px auto auto; transform: translate(-94px, 0px);" data-popper-placement="left-start">
                                                                    <form method="post" action="<?php echo(base_url('change_taskStatus'));?>">
                                                                        <input type="hidden" name="tid" value="<?php echo $tid;?>">
                                                                        <input type="hidden" name="tassignee" value="<?php echo $assignee_status->tassignee;?>">  
                                                                        <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="to_do">To Do</button>
                                                                        <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_progress">In Progress</button>
                                                                        <button type="submit" class="dropdown-item" name="status_but" id="status_but" value="in_review">In Review</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                                <?php
                                                                    }
                                                                }
                                                                else
                                                                {
                                                                ?>
                                                                <p class="text-muted"><i class="bx bx-check-shield font-size-16 align-middle me-1 text-d"></i>Status : 
                                                                    <?php
                                                                            if($tdetail->tstatus == 'to_do')
                                                                            {
                                                                                echo "To Do";
                                                                            }
                                                                            elseif($tdetail->tstatus == 'in_progress')
                                                                            {
                                                                                echo "In Progress";
                                                                            }
                                                                            elseif($tdetail->tstatus == 'in_review')
                                                                            {
                                                                                echo "In Review";
                                                                            }
                                                                            elseif($tdetail->tstatus == 'done')
                                                                            {
                                                                                echo "Done";
                                                                            } 
                                                                    ?>
                                                                </p>
                                                                <?php
                                                                }
                                                                ?>                                                             
                                                            </div>
                                                        </div>
                                        </div>
                                    </div>
                                  </div>
                                </div><!-- end col -->   
                                <div class="col-lg-4">
                                    <div class="card">
                                    <div class="card-body">
<?php
if($tdetail->tproject_assign != '0')
{
   //$comments = $this->Front_model->getProjectComments($tdetail->tproject_assign); 
   $comments = $this->Front_model->getTaskComments($tdetail->tid);
   $check_Powner = $this->Front_model->getProjectById($tdetail->tproject_assign);
   $checkpro_Owner = "";
   $pownerName = "";
   if($check_Powner)
   {
        $Powner_detail = $this->Front_model->getStudentById($check_Powner->pcreated_by);  
        if($Powner_detail)  
        {
            $pownerName = $Powner_detail->first_name.' '.$Powner_detail->last_name;
        }
        if($check_Powner->pcreated_by == $this->session->userdata('d168_id'))
        {
            $checkpro_Owner = "owner";
        }
        else
        {
            $checkpro_Owner = "team";
        }
   }
   if($checkpro_Owner == "owner")
   {
        $mentionList_trmodal = $this->Front_model->MentionList($tdetail->tproject_assign); 
   }
   elseif($checkpro_Owner == "team")
   {
        $mentionList_trmodalforAccepted = $this->Front_model->MentionListforAccepted($tdetail->tproject_assign);
        //print_r($mentionList_trmodalforAccepted);
        $ownerMention[]['name'] = $pownerName;
        //print_r($ownerMention);
        $mentionList_trmodal = array_merge($mentionList_trmodalforAccepted,$ownerMention);
   }
}
else
{
    $comments = $this->Front_model->getTaskComments($tdetail->tid);
    $mentionList_trmodal = array();
}
?>
<!-- Start Comment section -->
<h4 class="card-title">Comment Section</h4>
<div class="w-100 user-chat">
    <div class="card">        
        <div id="scrollbottom_trmodal" class="chat-conversation p-2">
            <ul class="list-unstyled mb-0 append_new_msg_trmodal" data-simplebar style="max-height: 250px;">
                <?php   
                if($comments){
                    $comment_date = "";
                    foreach ($comments as $cm) {
                        $msg_date = date("Y-m-d", strtotime($cm->c_created_date));
                        if($msg_date == $comment_date)
                        {
                            echo '';
                        }
                        elseif($msg_date == date("Y-m-d"))
                        {
                        ?>
                        <li> 
                            <div class="chat-day-title">
                                <span class="title">Today</span>
                            </div>
                        </li>
                        <?php
                        }
                        elseif($msg_date == date("Y-m-d",strtotime("-1 days")))
                        {
                        ?>
                        <li> 
                            <div class="chat-day-title">
                                <span class="title">Yesterday</span>
                            </div>
                        </li>
                        <?php
                        }
                        else
                        {
                        ?>
                        <li> 
                            <div class="chat-day-title">
                                <span class="title"><?php echo date("j M, Y", strtotime($cm->c_created_date));?></span>
                            </div>
                        </li>
                        <?php
                        }
                        $studdel = $this->Front_model->getStudentById($cm->c_created_by);
                        if($cm->c_created_by == $this->session->userdata('d168_id')){
                            $today_date = date("Y-m-d H:i:s");
                            $delete_allow = date('Y-m-d H:i:s',strtotime('+2 hour',strtotime($cm->c_created_date)));
                            ?>
                        <li class="right" id="msg_id_trmodal<?php echo $cm->cid?>">
                            <div class="conversation-list">
                                <?php
                                if(($today_date < $delete_allow) && (empty($cm->delete_msg)))
                                {
                                ?>
                                <div class="dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                      </a>
                                    <div class="dropdown-menu">
                                        <!-- <a class="dropdown-item" href="#">Copy</a>
                                        <a class="dropdown-item" href="#">Save</a>
                                        <a class="dropdown-item" href="#">Forward</a> -->
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="return delete_comment_trmodal('<?php echo $cm->cid?>');">Delete</a>
                                    </div>
                                </div>
                                <?php
                                }
                                ?>
                                <div class="ctext-wrap">
                                    <div class="conversation-name">Me</div>
                                    <?php
                                    if($cm->delete_msg == 'yes')
                                    {
                                    ?>
                                    <p>
                                        <i><i class="mdi mdi-block-helper"></i> You deleted this message</i>
                                    </p>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    <p>
                                        <?php echo $cm->message; ?>
                                    </p>
                                    <?php
                                    }
                                    ?>
                                    <p class="chat-time mb-0 text-muted"><i class="mdi mdi-clock-check-outline me-1"></i> <?php echo date("h:i a", strtotime($cm->c_created_date));?></p>
                                </div>
                            </div>
                        </li>
                            <?php
                        }else{
                            ?>
                        <li>
                            <div class="conversation-list">
                                <!-- <div class="dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                      </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Copy</a>
                                        <a class="dropdown-item" href="#">Save</a>
                                        <a class="dropdown-item" href="#">Forward</a>
                                        <a class="dropdown-item" href="#">Delete</a>
                                    </div>
                                </div> -->
                                <div class="ctext-wrap">
                                    <div class="conversation-name"><?php echo ucfirst($studdel->first_name).' '.ucfirst($studdel->last_name); ?></div>
                                    <?php
                                    if($cm->delete_msg == 'yes')
                                    {
                                    ?>
                                    <p>
                                        <i><i class="mdi mdi-block-helper"></i> this message was deleted</i>
                                    </p>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    <p>
                                        <?php echo $cm->message; ?>
                                    </p>
                                    <?php
                                    }
                                    ?>
                                    <p class="chat-time mb-0 text-muted"><i class="mdi mdi-clock-check-outline me-1"></i> <?php echo date("h:i a", strtotime($cm->c_created_date));?></p>
                                </div>
                            </div>
                        </li>
                            <?php
                        } 
                        $comment_date = $msg_date;                       
                    }
                }else{
                    ?>
                    <p class="text-muted p-2 no_comment">No comments...</p>
                    <?php
                }
                ?>                      
            </ul>
        </div>
        <div class="p-3 chat-input-section">
            <form method="POST" name="comment_form_trmodal" id="comment_form_trmodal" class="comment_form" autocomplete="off">
                <div class="row">
                    <div class="col" style="padding-right: 0px !important;">
                        <div class="position-relative">
                            <input type="text" id="message_trmodal" name="message" class="form-control chat-input" placeholder="Enter Comment...">
                            <span id="messageErr" class="text-danger"></span>
                            <input type="hidden" name="pid" id="pid" value="<?php echo $tdetail->tproject_assign; ?>">
                            <input type="hidden" name="tid" id="tid" value="<?php echo $tdetail->tid; ?>">
                            <input type="hidden" name="stid" id="stid" value="0">
                            <input type="hidden" name="area_type" value="from_modal">
                        </div>
                    </div>
                </div>
                <button type="submit" id="comment_form_trmodal_button" class="btn btn-sm btn-d chat-send waves-effect waves-light mt-1 float-end"><span class="d-none d-sm-inline-block me-2">Send</span> <i class="mdi mdi-send"></i></button>
                <img id="loader6" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
            </form>
        </div>
    </div>
</div>
<!-- End Comment section -->
                                    </div>
                                </div>
                                </div><!-- end col -->   
                            </div>
                                                     
                        </div>
                        <!-- end row -->

                    </div> 
                </div>
                
          
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
<!-- <script src="<?php echo base_url('assets/js/front.js');?>"></script> -->
<script src="<?php echo base_url();?>assets/js/mention.js"></script>
<script>
var jArray= <?php echo json_encode($mentionList_trmodal);?>;
//console.log(jArray);
 var myMention = new Mention({
    input: document.querySelector('#message_trmodal'),
    options: jArray
 })
</script>
<script type="text/javascript">
    // FOR COMMENT FORM ----------------------------------------
  $('#comment_form_trmodal').on('submit',function(event){    
    //debugger;
    event.preventDefault(); // Stop page from refreshing
    $('#comment_form_trmodal_button').hide();
    $('#loader6_tmodal').css('visibility','visible');
    var formData = new FormData(this); 
    console.log(formData);
    $.ajax({
         url:base_url+'front/insert_comment',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:false,
         async:false,
         success: function(data){
          $('#comment_form_trmodal_button').show();
          $('#loader6_tmodal').css('visibility','hidden');  
          var m_val = $('#message_trmodal').val();
          if(m_val)
          {
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
            }
            else if(data.status == true){
                $('.no_comment').hide();
                $('#comment_form_trmodal').trigger('reset');
                $('.append_new_msg_trmodal .simplebar-content').append('<li class="right" id="msg_id_trmodal'+data.comment_id+'" style="padding-top:25px"><div class="conversation-list"><div class="dropdown"><a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></a><div class="dropdown-menu"><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_comment_trmodal('+data.comment_id+');">Delete</a></div></div><div class="ctext-wrap"><div class="conversation-name">Me</div><p>'+data.comment_sent+'</p><p class="chat-time mb-0 text-muted"><i class="mdi mdi-clock-check-outline me-1"></i>'+data.comment_date+'</p></div></div></li>');
                $("#scrollbottom_trmodal .simplebar-content-wrapper").scrollTop($("#scrollbottom_trmodal .simplebar-content-wrapper").prop("scrollHeight"));
            }   
          }       
       }// success msg ends here
     });
  });
</script>
<script type="text/javascript">
function delete_comment_trmodal(id)
{ 
//debugger;  
  var id = id; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Delete Comment",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/delete_comment',
              type: 'post',
              data: {id: id},
              success: function(data){ 
                $('#msg_id_trmodal'+id).html('<div class="conversation-list"><div class="ctext-wrap"><div class="conversation-name">Me</div><p><i><i class="mdi mdi-block-helper"></i> You deleted this message</i></p><p class="chat-time mb-0 text-muted"></p></div></div>');
              }
            });
          }
      });       
}
function tasks_review_approve(tid)
{
  var tid = tid;
  var flag = '1';
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Approve Task",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/tasks_review_status',
              type: 'post',
              data: {tid: tid,flag: flag},
              success: function(data){
                $('.task_review_status'+tid).html('<i class="fas fa-angle-down" onclick="return editable_field2();"></i><span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">Done</span>');
                // Display Modal
                $('#TaskReviewModal').modal('hide'); 
                //window.location.reload();
              }
            });
          }
      });
}

function tasks_review_deny(tid)
{
  var tid = tid;
  var flag = '2';
  Swal.fire({
      title: "Are you sure?",
      text: "You want to Deny Task",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/tasks_review_status',
              type: 'post',
              data: {tid: tid,flag: flag},
              success: function(data){ 
                $('.task_review_status'+tid).html('<i class="fas fa-angle-down" onclick="return editable_field2();"></i><span class="badge rounded-pill badge-soft-dark description-content" onclick="return editable_field2();">In Progress</span>');
                // Display Modal
                $('#TaskReviewModal').modal('hide');
                //window.location.reload();
              }
            });
          }
      });
}
</script>