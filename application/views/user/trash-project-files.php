<?php
$page = 'trash-project-files';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Trash</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- App favicon -->
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
<!-- DataTables -->
    <link href="<?php echo base_url();?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <?php
include('header_links.php');
?>
    </head>

    <body data-sidebar="dark">
        <!-- Begin page -->
        <div id="layout-wrapper">

            <?php
            include('header.php');
            ?>
<!-- ========== Left Sidebar Start ========== -->
            <?php
            include('sidebar.php');
            ?>
<!-- Left Sidebar End -->
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <div class="row align-items-center">
                    <div>                                                                        
                        <h4 class="mb-sm-0 font-size-18">Trash</h4>
                    </div>
            </div>
            <div class="page-title-center">
                <div class="row">
                    <div class="col-12">
                        <ul class="nav nav-pills justify-content-end">
                            <li class="nav-item me-3">
                                <div class="text-center">
                                   <input class="form-check-input" type="radio" name="trash_radio" id="all_trash" onclick="return all_trash_filter();" checked>
                                   <label class="form-check-label">All</label>
                                </div>
                            </li>
                            <li class="nav-item me-3">
                                <div class="text-center">
                                   <input class="form-check-input" type="radio" name="trash_radio" id="project_trash" onclick="return trash_filter();">
                                   <label class="form-check-label">Projects</label>
                                </div>
                            </li>
                            <li class="nav-item me-3">
                                <div class="text-center">
                                   <input class="form-check-input" type="radio" name="trash_radio" id="task_trash" onclick="return trash_filter();">
                                   <label class="form-check-label">Tasks & Subtasks</label>
                                </div>
                            </li>
                            <li class="nav-item me-3">
                                <div class="text-center">
                                   <input class="form-check-input" type="radio" name="trash_radio" id="file_trash" onclick="return trash_filter();">
                                   <label class="form-check-label">Files</label>
                                </div>
                            </li>
                            <li class="nav-item me-3">
                                <div class="text-center">
                                   <input class="form-check-input" type="radio" name="trash_radio" id="platform_trash" onclick="return trash_filter();">
                                   <label class="form-check-label">Content</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Trash</a></li> -->
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
<style>
            .filterIcon {
                height: 16px;
                width: 16px;
                margin-left: 6px;
            }

            .modalFilter {
                display: none;
                height: auto;
                background: #FFF;
                border: solid 1px #ccc;
                padding: 8px;
                position: absolute;
                z-index: 1001;
                min-width: 160px;
            }

            .modalFilter .modal-content {
                max-height: 250px;
                overflow-y: auto;
            }

            .modalFilter .modal-footer {
                background: #FFF;
                height: 35px;
                padding-top: 6px;
            }

            .modalFilter .btn {
                padding: 0 1em;
                height: 28px;
                line-height: 28px;
                text-transform: none;
            }

        #mask {
            display: none;
            background: transparent;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1;
            width: 100%;
            height: 100%;
            opacity: 1000;
        }
    </style>
<?php
if(($this->session->flashdata('message')) && ($this->session->flashdata('message') != ""))
{
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
<i class="mdi mdi-check-all me-2"></i>
<?php echo $this->session->flashdata('message'); ?>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
}
if(($this->session->flashdata('al_message')) && ($this->session->flashdata('al_message') != ""))
{
?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="mdi mdi-block-helper me-2"></i>
        <?php echo $this->session->flashdata('al_message'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>
                        <div class="row" id="all_trash_list">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-danger">( If you do not restore deleted data within 30 days, then data will be deleted permanently ! )</h5>
                                        <div class="table-responsive">
                                            <div id="mask"></div>
                                            <table id="datatable7" class="table table-nowrap align-middle mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th scope="col">Portfolio</th>
                                                        <th scope="col">Trash</th>
                                                        <th scope="col">Title</th>
                                                        <th scope="col">Type</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Restore</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        if($TrashProjectFiles)
                                                        {
                                                            foreach($TrashProjectFiles as $l)
                                                            {
                                                                $check_project = $this->Front_model->file_itgetProjectById2($l->pid);
                                                                $check_pmember = $this->Front_model->file_itgetMemberProject($l->pid);
                                                                $getp = $this->Front_model->file_itgetPortfolio2($l->portfolio_id);
                                                                if($check_project)
                                                                {
                                                                    if($check_project->pcreated_by == $this->session->userdata('d168_id'))
                                                                    {
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php if($getp){ if($getp->portfolio_user == 'company'){ echo $getp->portfolio_name;}elseif($getp->portfolio_user == 'individual'){ echo $getp->portfolio_name.' '.$getp->portfolio_mname.' '.$getp->portfolio_lname;}else{ echo $getp->portfolio_name;}}?></td>
                                                                            <td><?php echo substr($l->pfile, strpos($l->pfile, '_') + 1);?></td>
                                                                            <td><?php echo $l->pname;?></td>
                                                                            <td>Project File</td>
                                                                            <td><?php echo $l->pfptrash_date;?></td>
                                                                            <td>
                                                                                <a href="javascript:void(0)" onclick="return pfile_retrieve('<?php echo $l->pfile_id;?>');" class="btn btn-d btn-sm" id="retrieve_link<?php echo $l->pfile_id;?>">Restore</a>
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                }
                                                                if($check_pmember)
                                                                {
                                                                    foreach($check_pmember as $cpm)
                                                                    {
                                                                    if($cpm->status == 'accepted')
                                                                    {
                                                                    if($cpm->pmember == $this->session->userdata('d168_id'))
                                                                    {
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php if($getp){ if($getp->portfolio_user == 'company'){ echo $getp->portfolio_name;}elseif($getp->portfolio_user == 'individual'){ echo $getp->portfolio_name.' '.$getp->portfolio_mname.' '.$getp->portfolio_lname;}else{ echo $getp->portfolio_name;}}?></td>
                                                                            <td><?php echo substr($l->pfile, strpos($l->pfile, '_') + 1);?></td>
                                                                            <td><?php echo $l->pname;?></td>
                                                                            <td>Project File</td>
                                                                            <td><?php echo $l->pfptrash_date;?></td>
                                                                            <td>
                                                                                <a href="javascript:void(0)" onclick="return pfile_retrieve('<?php echo $l->pfile_id;?>');" class="btn btn-d btn-sm" id="retrieve_link<?php echo $l->pfile_id;?>">Restore</a>
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                    }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        if($TrashTaskFiles)
                                                        {
                                                            foreach($TrashTaskFiles as $l2)
                                                            {
                                                                $check_project2 = $this->Front_model->file_itgetProjectById2($l2->pid);
                                                                $check_pmember2 = $this->Front_model->file_itgetMemberProject($l2->pid);
                                                                $getp = $this->Front_model->file_itgetPortfolio2($l2->portfolio_id);
                                                                if($check_project2)
                                                                {
                                                                    if($check_project2->pcreated_by == $this->session->userdata('d168_id'))
                                                                    {
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php if($getp){ if($getp->portfolio_user == 'company'){ echo $getp->portfolio_name;}elseif($getp->portfolio_user == 'individual'){ echo $getp->portfolio_name.' '.$getp->portfolio_mname.' '.$getp->portfolio_lname;}else{ echo $getp->portfolio_name;}}?></td>
                                                                            <td><?php echo substr($l2->tfile, strpos($l2->tfile, '_') + 1);?></td>
                                                                            <td><?php echo $l2->tname;?></td>
                                                                            <td>Task File</td>
                                                                            <td><?php echo $l2->task_trash_date;?></td>
                                                                            <td>
                                                                                <a href="javascript:void(0)" onclick="return tfile_retrieve('<?php echo $l2->tid;?>','<?php echo $l2->tfile;?>','<?php echo $l2->trash_id;?>');" class="btn btn-d btn-sm" id="retrieve_link<?php echo $l2->trash_id;?>">Restore</a>
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                }
                                                                if($check_pmember2)
                                                                {
                                                                    foreach($check_pmember2 as $cpm2)
                                                                    {
                                                                    if($cpm2->status == 'accepted')
                                                                    {
                                                                    if($cpm2->pmember == $this->session->userdata('d168_id'))
                                                                    {
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php if($getp){ if($getp->portfolio_user == 'company'){ echo $getp->portfolio_name;}elseif($getp->portfolio_user == 'individual'){ echo $getp->portfolio_name.' '.$getp->portfolio_mname.' '.$getp->portfolio_lname;}else{ echo $getp->portfolio_name;}}?></td>
                                                                            <td><?php echo substr($l2->tfile, strpos($l2->tfile, '_') + 1);?></td>
                                                                            <td><?php echo $l2->tname;?></td>
                                                                            <td>Task File</td>
                                                                            <td><?php echo $l2->task_trash_date;?></td>
                                                                            <td>
                                                                                <a href="javascript:void(0)" onclick="return tfile_retrieve('<?php echo $l2->tid;?>','<?php echo $l2->tfile;?>','<?php echo $l2->trash_id;?>');" class="btn btn-d btn-sm" id="retrieve_link<?php echo $l2->trash_id;?>">Restore</a>
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                    }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        if($TrashProjects)
                                                        {
                                                            foreach($TrashProjects as $l4)
                                                            {
                                                                $getp = $this->Front_model->file_itgetPortfolio2($l4->portfolio_id);
                                                                ?>
                                                                <tr>
                                                                    <td><?php if($getp){ if($getp->portfolio_user == 'company'){ echo $getp->portfolio_name;}elseif($getp->portfolio_user == 'individual'){ echo $getp->portfolio_name.' '.$getp->portfolio_mname.' '.$getp->portfolio_lname;}else{ echo $getp->portfolio_name;}}?></td>
                                                                    <td><?php echo $l4->pname;?></td>
                                                                    <td></td>
                                                                    <td>Project</td>
                                                                    <td><?php echo $l4->ptrash_date;?></td>
                                                                    <td>
                                                                        <a href="javascript:void(0)" onclick="return project_retrieve('<?php echo $l4->pid;?>');" class="btn btn-d btn-sm" id="retrieve_link<?php echo $l4->pid;?>">Restore</a>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                        if($TrashTasks)
                                                        {
                                                            foreach($TrashTasks as $l5)
                                                            {
                                                                $getp = $this->Front_model->file_itgetPortfolio2($l5->portfolio_id);
                                                                ?>
                                                                <tr>
                                                                    <td><?php if($getp){ if($getp->portfolio_user == 'company'){ echo $getp->portfolio_name;}elseif($getp->portfolio_user == 'individual'){ echo $getp->portfolio_name.' '.$getp->portfolio_mname.' '.$getp->portfolio_lname;}else{ echo $getp->portfolio_name;}}?></td>
                                                                    <td><?php echo $l5->tname;?></td>
                                                                    <td><?php echo $l5->pname;?></td>
                                                                    <td>Task</td>
                                                                    <td><?php echo $l5->trash_date;?></td>
                                                                    <td>
                                                                        <a href="javascript:void(0)" onclick="return task_retrieve('<?php echo $l5->tid;?>');" class="btn btn-d btn-sm" id="retrieve_link<?php echo $l5->tid;?>">Restore</a>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                        if($TrashSingleTasks)
                                                        {
                                                            foreach($TrashSingleTasks as $l5)
                                                            {
                                                                $getp = $this->Front_model->file_itgetPortfolio2($l5->portfolio_id);
                                                                ?>
                                                                <tr>
                                                                    <td><?php if($getp){ if($getp->portfolio_user == 'company'){ echo $getp->portfolio_name;}elseif($getp->portfolio_user == 'individual'){ echo $getp->portfolio_name.' '.$getp->portfolio_mname.' '.$getp->portfolio_lname;}else{ echo $getp->portfolio_name;}}?></td>
                                                                    <td><?php echo $l5->tname;?></td>
                                                                    <td></td>
                                                                    <td>Task</td>
                                                                    <td><?php echo $l5->trash_date;?></td>
                                                                    <td>
                                                                        <a href="javascript:void(0)" onclick="return task_retrieve('<?php echo $l5->tid;?>');" class="btn btn-d btn-sm" id="retrieve_link<?php echo $l5->tid;?>">Restore</a>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                        if($TrashSubtaskFiles)
                                                        {
                                                            foreach($TrashSubtaskFiles as $l6)
                                                            {
                                                                $check_project3 = $this->Front_model->file_itgetProjectById2($l6->pid);
                                                                $check_pmember3 = $this->Front_model->file_itgetMemberProject($l6->pid);
                                                                $getp = $this->Front_model->file_itgetPortfolio2($l6->portfolio_id);
                                                                if($check_project3)
                                                                {
                                                                    if($check_project3->pcreated_by == $this->session->userdata('d168_id'))
                                                                    {
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php if($getp){ if($getp->portfolio_user == 'company'){ echo $getp->portfolio_name;}elseif($getp->portfolio_user == 'individual'){ echo $getp->portfolio_name.' '.$getp->portfolio_mname.' '.$getp->portfolio_lname;}else{ echo $getp->portfolio_name;}}?></td>
                                                                            <td><?php echo substr($l6->stfile, strpos($l6->stfile, '_') + 1);?></td>
                                                                            <td><?php echo $l6->stname;?></td>
                                                                            <td>Subtask File</td>
                                                                            <td><?php echo $l6->stask_trash_date;?></td>
                                                                            <td>
                                                                                <a href="javascript:void(0)" onclick="return stfile_retrieve('<?php echo $l6->stid;?>','<?php echo $l6->stfile;?>','<?php echo $l6->strash_id;?>');" class="btn btn-d btn-sm" id="retrieve_link<?php echo $l6->strash_id;?>">Restore</a>
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                }
                                                                if($check_pmember3)
                                                                {
                                                                    foreach($check_pmember3 as $cpm3)
                                                                    {
                                                                    if($cpm3->status == 'accepted')
                                                                    {
                                                                    if($cpm3->pmember == $this->session->userdata('d168_id'))
                                                                    {
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php if($getp){ if($getp->portfolio_user == 'company'){ echo $getp->portfolio_name;}elseif($getp->portfolio_user == 'individual'){ echo $getp->portfolio_name.' '.$getp->portfolio_mname.' '.$getp->portfolio_lname;}else{ echo $getp->portfolio_name;}}?></td>
                                                                            <td><?php echo substr($l6->stfile, strpos($l6->stfile, '_') + 1);?></td>
                                                                            <td><?php echo $l6->stname;?></td>
                                                                            <td>Subtask File</td>
                                                                            <td><?php echo $l6->stask_trash_date;?></td>
                                                                            <td>
                                                                                <a href="javascript:void(0)" onclick="return stfile_retrieve('<?php echo $l6->stid;?>','<?php echo $l6->stfile;?>','<?php echo $l6->strash_id;?>');" class="btn btn-d btn-sm" id="retrieve_link<?php echo $l6->strash_id;?>">Restore</a>
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                    }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        if($TrashSubtasks)
                                                        {
                                                            foreach($TrashSubtasks as $l7)
                                                            {
                                                                $getp = $this->Front_model->file_itgetPortfolio2($l7->portfolio_id);
                                                                ?>
                                                                <tr>
                                                                    <td><?php if($getp){ if($getp->portfolio_user == 'company'){ echo $getp->portfolio_name;}elseif($getp->portfolio_user == 'individual'){ echo $getp->portfolio_name.' '.$getp->portfolio_mname.' '.$getp->portfolio_lname;}else{ echo $getp->portfolio_name;}}?></td>
                                                                    <td><?php echo $l7->stname;?></td>
                                                                    <td><?php echo $l7->pname;?></td>
                                                                    <td>Subtask</td>
                                                                    <td><?php echo $l7->strash_date;?></td>
                                                                    <td>
                                                                        <a href="javascript:void(0)" onclick="return subtask_retrieve('<?php echo $l7->stid;?>');" class="btn btn-d btn-sm" id="sretrieve_link<?php echo $l7->stid;?>">Restore</a>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                        if($TrashSingleSubtasks)
                                                        {
                                                            foreach($TrashSingleSubtasks as $l7)
                                                            {
                                                                $getp = $this->Front_model->file_itgetPortfolio2($l7->portfolio_id);
                                                                ?>
                                                                <tr>
                                                                    <td><?php if($getp){ if($getp->portfolio_user == 'company'){ echo $getp->portfolio_name;}elseif($getp->portfolio_user == 'individual'){ echo $getp->portfolio_name.' '.$getp->portfolio_mname.' '.$getp->portfolio_lname;}else{ echo $getp->portfolio_name;}}?></td>
                                                                    <td><?php echo $l7->stname;?></td>
                                                                    <td></td>
                                                                    <td>Subtask</td>
                                                                    <td><?php echo $l7->strash_date;?></td>
                                                                    <td>
                                                                        <a href="javascript:void(0)" onclick="return subtask_retrieve('<?php echo $l7->stid;?>');" class="btn btn-d btn-sm" id="sretrieve_link<?php echo $l7->stid;?>">Restore</a>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                        if($TrashPlatform)
                                                        {
                                                            foreach($TrashPlatform as $l8)
                                                            {
                                                                $getp = $this->Front_model->file_itgetPortfolio2($l8->portfolio_id);
                                                                ?>
                                                                <tr>
                                                                    <td><?php if($getp){ if($getp->portfolio_user == 'company'){ echo $getp->portfolio_name;}elseif($getp->portfolio_user == 'individual'){ echo $getp->portfolio_name.' '.$getp->portfolio_mname.' '.$getp->portfolio_lname;}else{ echo $getp->portfolio_name;}}?></td>
                                                                    <td><?php
                                                                        if($l8->platform == 'twitter')
                                                                        {
                                                                            echo "Twitter";
                                                                        }
                                                                        elseif($l8->platform == 'facebook')
                                                                        { 
                                                                            echo "Facebook";
                                                                        }
                                                                        elseif($l8->platform == 'instagram')
                                                                        {
                                                                            echo "Instagram";
                                                                        }
                                                                        elseif($l8->platform == 'linkedin')
                                                                        {
                                                                            echo "LinkedIn";
                                                                        }
                                                                        elseif($l8->platform == 'google-my-business')
                                                                        {
                                                                            echo "Google My Business";
                                                                        }
                                                                        elseif($l8->platform == 'pinterest')
                                                                        {
                                                                            echo "Pinterest";
                                                                        }
                                                                        elseif($l8->platform == 'youtube')
                                                                        {
                                                                            echo "YouTube";
                                                                        }
                                                                        elseif($l8->platform == 'blogger')
                                                                        {
                                                                            echo "Blog";
                                                                        }
                                                                        elseif($l8->platform == 'tiktok')
                                                                        {
                                                                            echo "TikTok";
                                                                        }
                                                                        ?></td>
                                                                    <td><?php echo $l8->pname;?></td>
                                                                    <td>Content</td>
                                                                    <td><?php echo $l8->trash_date;?></td>
                                                                    <td>
                                                                        <a href="javascript:void(0)" onclick="return platform_retrieve('<?php echo $l8->pc_id;?>');" class="btn btn-d btn-sm" id="cpretrieve_link<?php echo $l8->pc_id;?>">Restore</a>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="project_trash_list" style="display:none;">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-danger">( If you do not restore deleted data within 30 days, then data will be deleted permanently ! )</h5>
                                        <div class="table-responsive">
                                            <div id="mask"></div>
                                            <table id="datatable9" class="table table-nowrap align-middle mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th scope="col">Portfolio</th>
                                                        <th scope="col">Project</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Restore</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        if($TrashProjects)
                                                        {
                                                            foreach($TrashProjects as $l4)
                                                            {
                                                                $getp = $this->Front_model->file_itgetPortfolio2($l4->portfolio_id);
                                                                ?>
                                                                <tr>
                                                                    <td><?php if($getp){ if($getp->portfolio_user == 'company'){ echo $getp->portfolio_name;}elseif($getp->portfolio_user == 'individual'){ echo $getp->portfolio_name.' '.$getp->portfolio_mname.' '.$getp->portfolio_lname;}else{ echo $getp->portfolio_name;}}?></td>
                                                                    <td><?php echo $l4->pname;?></td>
                                                                    <td><?php echo $l4->ptrash_date;?></td>
                                                                    <td>
                                                                        <a href="javascript:void(0)" onclick="return project_retrieve('<?php echo $l4->pid;?>');" class="btn btn-d btn-sm" id="retrieve_link<?php echo $l4->pid;?>">Restore</a>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="task_trash_list" style="display:none;">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-danger">( If you do not restore deleted data within 30 days, then data will be deleted permanently ! )</h5>
                                        <div class="table-responsive">
                                            <div id="mask"></div>
                                            <table id="datatable10" class="table table-nowrap align-middle mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th scope="col">Code</th>
                                                        <th scope="col">Portfolio</th>
                                                        <th scope="col">Project</th>
                                                        <th scope="col">Task</th>
                                                        <th scope="col">Assignee</th>
                                                        <th scope="col">Type</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Restore</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        if($TrashTasks)
                                                        {
                                                            foreach($TrashTasks as $l5)
                                                            {
                                                                $getp = $this->Front_model->file_itgetPortfolio2($l5->portfolio_id);
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $l5->tcode;?></td>
                                                                    <td><?php if($getp){ if($getp->portfolio_user == 'company'){ echo $getp->portfolio_name;}elseif($getp->portfolio_user == 'individual'){ echo $getp->portfolio_name.' '.$getp->portfolio_mname.' '.$getp->portfolio_lname;}else{ echo $getp->portfolio_name;}}?></td>
                                                                    <td><?php echo $l5->pname;?></td>
                                                                    <td><?php echo $l5->tname;?></td>
                                                                    <td><?php 
                                                                    $stud = $this->Front_model->getStudentById($l5->tassignee);
                                                                    if($stud)
                                                                    {
                                                                     echo $stud->first_name.' '.$stud->last_name;
                                                                    }
                                                                    ?></td>
                                                                    <td>Task</td>
                                                                    <td><?php echo $l5->trash_date;?></td>
                                                                    <td>
                                                                        <a href="javascript:void(0)" onclick="return task_retrieve('<?php echo $l5->tid;?>');" class="btn btn-d btn-sm" id="retrieve_link<?php echo $l5->tid;?>">Restore</a>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                        if($TrashSingleTasks)
                                                        {
                                                            foreach($TrashSingleTasks as $l5)
                                                            {
                                                                $getp = $this->Front_model->file_itgetPortfolio2($l5->portfolio_id);
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $l5->tcode;?></td>
                                                                    <td><?php if($getp){ if($getp->portfolio_user == 'company'){ echo $getp->portfolio_name;}elseif($getp->portfolio_user == 'individual'){ echo $getp->portfolio_name.' '.$getp->portfolio_mname.' '.$getp->portfolio_lname;}else{ echo $getp->portfolio_name;}}?></td>
                                                                    <td></td>
                                                                    <td><?php echo $l5->tname;?></td>
                                                                    <td><?php 
                                                                    $stud = $this->Front_model->getStudentById($l5->tassignee);
                                                                    if($stud)
                                                                    {
                                                                     echo $stud->first_name.' '.$stud->last_name;
                                                                    }
                                                                    ?></td>
                                                                    <td>Task</td>
                                                                    <td><?php echo $l5->trash_date;?></td>
                                                                    <td>
                                                                        <a href="javascript:void(0)" onclick="return task_retrieve('<?php echo $l5->tid;?>');" class="btn btn-d btn-sm" id="retrieve_link<?php echo $l5->tid;?>">Restore</a>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                        if($TrashSubtasks)
                                                        {
                                                            foreach($TrashSubtasks as $l7)
                                                            {
                                                                $getp = $this->Front_model->file_itgetPortfolio2($l7->portfolio_id);
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $l7->stcode;?></td>
                                                                    <td><?php if($getp){ if($getp->portfolio_user == 'company'){ echo $getp->portfolio_name;}elseif($getp->portfolio_user == 'individual'){ echo $getp->portfolio_name.' '.$getp->portfolio_mname.' '.$getp->portfolio_lname;}else{ echo $getp->portfolio_name;}}?></td>
                                                                    <td><?php echo $l7->pname;?></td>
                                                                    <td><?php echo $l7->stname;?></td>
                                                                    <td><?php 
                                                                    $stud = $this->Front_model->getStudentById($l7->stassignee);
                                                                    if($stud)
                                                                    {
                                                                     echo $stud->first_name.' '.$stud->last_name;
                                                                    }
                                                                    ?></td>
                                                                    <td>Subtask</td>
                                                                    <td><?php echo $l7->strash_date;?></td>
                                                                    <td>
                                                                        <a href="javascript:void(0)" onclick="return subtask_retrieve('<?php echo $l7->stid;?>');" class="btn btn-d btn-sm" id="sretrieve_link<?php echo $l7->stid;?>">Restore</a>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                        if($TrashSingleSubtasks)
                                                        {
                                                            foreach($TrashSingleSubtasks as $l7)
                                                            {
                                                                $getp = $this->Front_model->file_itgetPortfolio2($l7->portfolio_id);
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $l7->stcode;?></td>
                                                                    <td><?php if($getp){ if($getp->portfolio_user == 'company'){ echo $getp->portfolio_name;}elseif($getp->portfolio_user == 'individual'){ echo $getp->portfolio_name.' '.$getp->portfolio_mname.' '.$getp->portfolio_lname;}else{ echo $getp->portfolio_name;}}?></td>
                                                                    <td></td>
                                                                    <td><?php echo $l7->stname;?></td>
                                                                    <td><?php 
                                                                    $stud = $this->Front_model->getStudentById($l7->stassignee);
                                                                    if($stud)
                                                                    {
                                                                     echo $stud->first_name.' '.$stud->last_name;
                                                                    }
                                                                    ?></td>
                                                                    <td>Subtask</td>
                                                                    <td><?php echo $l7->strash_date;?></td>
                                                                    <td>
                                                                        <a href="javascript:void(0)" onclick="return subtask_retrieve('<?php echo $l7->stid;?>');" class="btn btn-d btn-sm" id="sretrieve_link<?php echo $l7->stid;?>">Restore</a>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="file_trash_list" style="display: none;">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-danger">( If you do not restore deleted data within 30 days, then data will be deleted permanently ! )</h5>
                                        <div class="table-responsive">
                                            <div id="mask"></div>
                                            <table id="datatable11" class="table table-nowrap align-middle mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th scope="col">Portfolio</th>
                                                        <th scope="col">File</th>
                                                        <th scope="col">Title</th>
                                                        <th scope="col">Type</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Restore</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        if($TrashProjectFiles)
                                                        {
                                                            foreach($TrashProjectFiles as $l)
                                                            {
                                                                $check_project = $this->Front_model->file_itgetProjectById2($l->pid);
                                                                $check_pmember = $this->Front_model->file_itgetMemberProject($l->pid);
                                                                $getp = $this->Front_model->file_itgetPortfolio2($l->portfolio_id);
                                                                if($check_project)
                                                                {
                                                                    if($check_project->pcreated_by == $this->session->userdata('d168_id'))
                                                                    {
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php if($getp){ if($getp->portfolio_user == 'company'){ echo $getp->portfolio_name;}elseif($getp->portfolio_user == 'individual'){ echo $getp->portfolio_name.' '.$getp->portfolio_mname.' '.$getp->portfolio_lname;}else{ echo $getp->portfolio_name;}}?></td>
                                                                            <td><?php echo substr($l->pfile, strpos($l->pfile, '_') + 1);?></td>
                                                                            <td><?php echo $l->pname;?></td>
                                                                            <td>Project File</td>
                                                                            <td><?php echo $l->pfptrash_date;?></td>
                                                                            <td>
                                                                                <a href="javascript:void(0)" onclick="return pfile_retrieve('<?php echo $l->pfile_id;?>');" class="btn btn-d btn-sm" id="retrieve_link<?php echo $l->pfile_id;?>">Restore</a>
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                }
                                                                if($check_pmember)
                                                                {
                                                                    foreach($check_pmember as $cpm)
                                                                    {
                                                                    if($cpm->status == 'accepted')
                                                                    {
                                                                    if($cpm->pmember == $this->session->userdata('d168_id'))
                                                                    {
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php if($getp){ if($getp->portfolio_user == 'company'){ echo $getp->portfolio_name;}elseif($getp->portfolio_user == 'individual'){ echo $getp->portfolio_name.' '.$getp->portfolio_mname.' '.$getp->portfolio_lname;}else{ echo $getp->portfolio_name;}}?></td>
                                                                            <td><?php echo substr($l->pfile, strpos($l->pfile, '_') + 1);?></td>
                                                                            <td><?php echo $l->pname;?></td>
                                                                            <td>Project File</td>
                                                                            <td><?php echo $l->pfptrash_date;?></td>
                                                                            <td>
                                                                                <a href="javascript:void(0)" onclick="return pfile_retrieve('<?php echo $l->pfile_id;?>');" class="btn btn-d btn-sm" id="retrieve_link<?php echo $l->pfile_id;?>">Restore</a>
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                    }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        if($TrashTaskFiles)
                                                        {
                                                            foreach($TrashTaskFiles as $l2)
                                                            {
                                                                $check_project2 = $this->Front_model->file_itgetProjectById2($l2->pid);
                                                                $check_pmember2 = $this->Front_model->file_itgetMemberProject($l2->pid);
                                                                $getp = $this->Front_model->file_itgetPortfolio2($l2->portfolio_id);
                                                                if($check_project2)
                                                                {
                                                                    if($check_project2->pcreated_by == $this->session->userdata('d168_id'))
                                                                    {
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php if($getp){ if($getp->portfolio_user == 'company'){ echo $getp->portfolio_name;}elseif($getp->portfolio_user == 'individual'){ echo $getp->portfolio_name.' '.$getp->portfolio_mname.' '.$getp->portfolio_lname;}else{ echo $getp->portfolio_name;}}?></td>
                                                                            <td><?php echo substr($l2->tfile, strpos($l2->tfile, '_') + 1);?></td>
                                                                            <td><?php echo $l2->tname;?></td>
                                                                            <td>Task File</td>
                                                                            <td><?php echo $l2->task_trash_date;?></td>
                                                                            <td>
                                                                                <a href="javascript:void(0)" onclick="return tfile_retrieve('<?php echo $l2->tid;?>','<?php echo $l2->tfile;?>','<?php echo $l2->trash_id;?>');" class="btn btn-d btn-sm" id="retrieve_link<?php echo $l2->trash_id;?>">Restore</a>
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                }
                                                                if($check_pmember2)
                                                                {
                                                                    foreach($check_pmember2 as $cpm2)
                                                                    {
                                                                    if($cpm2->status == 'accepted')
                                                                    {
                                                                    if($cpm2->pmember == $this->session->userdata('d168_id'))
                                                                    {
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php if($getp){ if($getp->portfolio_user == 'company'){ echo $getp->portfolio_name;}elseif($getp->portfolio_user == 'individual'){ echo $getp->portfolio_name.' '.$getp->portfolio_mname.' '.$getp->portfolio_lname;}else{ echo $getp->portfolio_name;}}?></td>
                                                                            <td><?php echo substr($l2->tfile, strpos($l2->tfile, '_') + 1);?></td>
                                                                            <td><?php echo $l2->tname;?></td>
                                                                            <td>Task File</td>
                                                                            <td><?php echo $l2->task_trash_date;?></td>
                                                                            <td>
                                                                                <a href="javascript:void(0)" onclick="return tfile_retrieve('<?php echo $l2->tid;?>','<?php echo $l2->tfile;?>','<?php echo $l2->trash_id;?>');" class="btn btn-d btn-sm" id="retrieve_link<?php echo $l2->trash_id;?>">Restore</a>
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                    }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        if($TrashSubtaskFiles)
                                                        {
                                                            foreach($TrashSubtaskFiles as $l6)
                                                            {
                                                                $check_project3 = $this->Front_model->file_itgetProjectById2($l6->pid);
                                                                $check_pmember3 = $this->Front_model->file_itgetMemberProject($l6->pid);
                                                                $getp = $this->Front_model->file_itgetPortfolio2($l6->portfolio_id);
                                                                if($check_project3)
                                                                {
                                                                    if($check_project3->pcreated_by == $this->session->userdata('d168_id'))
                                                                    {
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php if($getp){ if($getp->portfolio_user == 'company'){ echo $getp->portfolio_name;}elseif($getp->portfolio_user == 'individual'){ echo $getp->portfolio_name.' '.$getp->portfolio_mname.' '.$getp->portfolio_lname;}else{ echo $getp->portfolio_name;}}?></td>
                                                                            <td><?php echo substr($l6->stfile, strpos($l6->stfile, '_') + 1);?></td>
                                                                            <td><?php echo $l6->stname;?></td>
                                                                            <td>Subtask File</td>
                                                                            <td><?php echo $l6->stask_trash_date;?></td>
                                                                            <td>
                                                                                <a href="javascript:void(0)" onclick="return stfile_retrieve('<?php echo $l6->stid;?>','<?php echo $l6->stfile;?>','<?php echo $l6->strash_id;?>');" class="btn btn-d btn-sm" id="retrieve_link<?php echo $l6->strash_id;?>">Restore</a>
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                }
                                                                if($check_pmember3)
                                                                {
                                                                    foreach($check_pmember3 as $cpm3)
                                                                    {
                                                                    if($cpm3->status == 'accepted')
                                                                    {
                                                                    if($cpm3->pmember == $this->session->userdata('d168_id'))
                                                                    {
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php if($getp){ if($getp->portfolio_user == 'company'){ echo $getp->portfolio_name;}elseif($getp->portfolio_user == 'individual'){ echo $getp->portfolio_name.' '.$getp->portfolio_mname.' '.$getp->portfolio_lname;}else{ echo $getp->portfolio_name;}}?></td>
                                                                            <td><?php echo substr($l6->stfile, strpos($l6->stfile, '_') + 1);?></td>
                                                                            <td><?php echo $l6->stname;?></td>
                                                                            <td>Subtask File</td>
                                                                            <td><?php echo $l6->stask_trash_date;?></td>
                                                                            <td>
                                                                                <a href="javascript:void(0)" onclick="return stfile_retrieve('<?php echo $l6->stid;?>','<?php echo $l6->stfile;?>','<?php echo $l6->strash_id;?>');" class="btn btn-d btn-sm" id="retrieve_link<?php echo $l6->strash_id;?>">Restore</a>
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                    }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="platform_trash_list" style="display:none;">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-danger">( If you do not restore deleted data within 30 days, then data will be deleted permanently ! )</h5>
                                        <div class="table-responsive">
                                            <div id="mask"></div>
                                            <table id="datatable12" class="table table-nowrap align-middle mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th scope="col">Code</th>
                                                        <th scope="col">Portfolio</th>
                                                        <th scope="col">Project</th>
                                                        <th scope="col">Content</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Restore</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        if($TrashPlatform)
                                                        {
                                                            foreach($TrashPlatform as $l8)
                                                            {
                                                                $getp = $this->Front_model->file_itgetPortfolio2($l8->portfolio_id);
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $l8->pc_code;?></td>
                                                                    <td><?php if($getp){ if($getp->portfolio_user == 'company'){ echo $getp->portfolio_name;}elseif($getp->portfolio_user == 'individual'){ echo $getp->portfolio_name.' '.$getp->portfolio_mname.' '.$getp->portfolio_lname;}else{ echo $getp->portfolio_name;}}?></td>
                                                                    <td><?php echo $l8->pname;?></td>
                                                                    <td><?php
                                                                        if($l8->platform == 'twitter')
                                                                        {
                                                                        ?>
                                                                        <i class="fab fa-twitter font-size-24" title="Twitter"></i></label>
                                                                        <?php
                                                                        }
                                                                        elseif($l8->platform == 'facebook')
                                                                        { 
                                                                        ?>                 
                                                                        <i class="fab fa-facebook font-size-24" title="Facebook"></i></label>
                                                                        <?php
                                                                        }
                                                                        elseif($l8->platform == 'instagram')
                                                                        {
                                                                        ?>
                                                                        <i class="fab fa-instagram font-size-24" title="Instagram"></i></label>
                                                                        <?php
                                                                        }
                                                                        elseif($l8->platform == 'linkedin')
                                                                        {
                                                                        ?>
                                                                        <i class="fab fa-linkedin font-size-24" title="LinkedIn"></i></label>
                                                                        <?php
                                                                        }
                                                                        elseif($l8->platform == 'google-my-business')
                                                                        {
                                                                        ?>
                                                                        <i class="mdi mdi-google-my-business font-size-24" title="Google My Business"></i></label>
                                                                        <?php
                                                                        }
                                                                        elseif($l8->platform == 'pinterest')
                                                                        {
                                                                        ?>
                                                                        <i class="fab fa-pinterest font-size-24" title="Pinterest"></i></label>
                                                                        <?php
                                                                        }
                                                                        elseif($l8->platform == 'youtube')
                                                                        {
                                                                        ?>
                                                                        <i class="fab fa-youtube font-size-24" title="YouTube"></i></label>
                                                                        <?php
                                                                        }
                                                                        elseif($l8->platform == 'blogger')
                                                                        {
                                                                        ?>
                                                                        <i class="fab fa-blogger font-size-24" title="Blog"></i></label>
                                                                        <?php
                                                                        }
                                                                        elseif($l8->platform == 'tiktok')
                                                                        {
                                                                        ?>
                                                                        <i class="fab fa-tiktok font-size-24" title="TikTok"></i> </label>
                                                                        <?php
                                                                        }
                                                                        ?></td>
                                                                    <td><?php echo $l8->trash_date;?></td>
                                                                    <td>
                                                                        <a href="javascript:void(0)" onclick="return platform_retrieve('<?php echo $l8->pc_id;?>');" class="btn btn-d btn-sm" id="cpretrieve_link<?php echo $l8->pc_id;?>">Restore</a>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                
                <?php
                include('footer.php');
                ?>
                           </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- JAVASCRIPT -->
<script src="<?php echo base_url();?>assets/libs/jquery/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/metismenu/metisMenu.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/node-waves/waves.min.js"></script> 
<!-- Required datatable js -->
<script src="<?php echo base_url();?>assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="<?php echo base_url();?>assets/js/pages/datatables.init.js"></script>       
<?php
include('footer_links.php');
?>
<script>
    function configFilter($this, colArray) {
        //debugger;
            setTimeout(function () {
                var tableName = $this[0].id;
                var columns = $this.api().columns();
                $.each(colArray, function (i, arg) {
                    $('#' + tableName + ' th:eq(' + arg + ')').append('<img src="<?php echo base_url('assets/images/filter.png');?>" class="filterIcon" onclick="showFilter(event,\'' + tableName + '_' + arg + '\')" />');
                });

                var template = '<div class="modalFilter">' +
                                 '<div class="modal-content">' +
                                 '{0}</div>' +
                                 '<div class="modal-footer">' +
                                     '<a href="#!" onclick="clearFilter(this, {1}, \'{2}\');"  class=" btn bg-d btn-sm text-white">Clear</a>' +
                                     '<a href="#!" onclick="performFilter(this, {1}, \'{2}\');"  class=" btn btn-d btn-sm">Ok</a>' +
                                 '</div>' +
                             '</div>';
                $.each(colArray, function (index, value) {
                    //debugger;
                    columns.every(function (i) {
                        //debugger;
                        if (value === i) {
                            var column = this, content = '<input type="text" class="filterSearchText" onkeyup="filterValues(this)" /> <br/>';
                            var columnName = $(this.header()).text().replace(/\s+/g, "_");
                            var distinctArray = [];
                            column.data().each(function (d, j) {
                                if (distinctArray.indexOf(d) == -1) {
                                    var id = tableName + "_" + columnName + "_" + j; // onchange="formatValues(this,' + value + ');
                                    content += '<div><input type="checkbox" style="margin-right:10px;" value="' + d + '"  id="' + id + '"/><label for="' + id + '"> ' + d + '</label></div>';
                                    distinctArray.push(d);
                                }
                            });
                            var newTemplate = $(template.replace('{0}', content).replace('{1}', value).replace('{1}', value).replace('{2}', tableName).replace('{2}', tableName));
                            $('body').append(newTemplate);
                            modalFilterArray[tableName + "_" + value] = newTemplate;
                            content = '';
                        }
                    });
                });
            }, 50);
        }
        var modalFilterArray = {};
        //User to show the filter modal
        function showFilter(e, index) {
            $('.modalFilter').hide();
            $(modalFilterArray[index]).css({ left: 0, top: 0 });
            var th = $(e.target).parent();
            var pos = th.offset();
            console.log(th);
            $(modalFilterArray[index]).width(th.width() * 1.5);
            $(modalFilterArray[index]).css({ 'left': pos.left, 'top': pos.top });
            $(modalFilterArray[index]).show();
            $('#mask').show();
            e.stopPropagation();
        }

        //This function is to use the searchbox to filter the checkbox
        function filterValues(node) {
            var searchString = $(node).val();
            var rootNode = $(node).parent();
            if (searchString == '') {
                rootNode.find('div').show();
            } else {
                rootNode.find("div").hide();
                rootNode.find("div:contains('" + searchString + "')").show();
            }
        }

        //Execute the filter on the table for a given column
        function performFilter(node, i, tableId) {
            var rootNode = $(node).parent().parent();
            var searchString = '', counter = 0;

            rootNode.find('input:checkbox').each(function (index, checkbox) {
                if (checkbox.checked) {
                    searchString += (counter == 0) ? checkbox.value : '|' + checkbox.value;
                    counter++;
                }
            });
            $('#' + tableId).DataTable().column(i).search(
                searchString,
                true, false
            ).draw();
            rootNode.hide();
            $('#mask').hide();
        }

        //Removes the filter from the table for a given column
        function clearFilter(node, i, tableId) {
            var rootNode = $(node).parent().parent();
            rootNode.find(".filterSearchText").val('');
            rootNode.find('input:checkbox').each(function (index, checkbox) {
                checkbox.checked = false;
                $(checkbox).parent().show();
            });
            $('#' + tableId).DataTable().column(i).search(
                '',
                true, false
            ).draw();
            rootNode.hide();
            $('#mask').hide();
        }
    </script>

    </body>

</html>
