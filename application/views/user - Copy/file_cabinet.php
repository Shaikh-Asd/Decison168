<?php
$page = 'file-cabinet'; 
?>
<!doctype html>
<html lang="en">    
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <title>File Cabinet</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
        <!-- DataTables -->
        <link href="<?php echo base_url();?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <?php
        include('header_links.php');
        ?>
        <style type="text/css">
            .btn-light:hover {
                color: #000;
                background-color: #f1f4f8;
                border-color: #f1f3f8;
            }
            .folder-tree { 
                list-style: none; 
                cursor: pointer; 
                padding-left: 20px; 
            }
            .folder-tree li { 
                margin-bottom: 10px; 
                font-size: 14px; 
                transition: all .4s ease; 
                position: relative; 
            }
            .folder-tree li ul { 
                padding-left: 30px; 
                padding-top: 8px; 
            }
            .folder-tree ul { 
                display: none; 
                position: relative; 
            }
            .folder-tree ul:before { 
                position: absolute; 
                content: ''; 
                left: -13px; 
                top: 0; 
                width: 9px; 
                height: 100%; 
                background-color: transparent; 
                border-left: dashed 1px #c2c2c2; 
                border-bottom: dashed 1px #c2c2c2; 
            }
            .folder-tree li ul li { 
                display: block; 
                margin-bottom: 8px; 
            }
            .folder-tree .arrow { 
                position: absolute; 
                top: 1px; 
                left: -20px; 
                width: 13px; 
                height: 13px; 
                transition: all .4s ease; 
            }
            .folder-tree .arrow i { 
                color: #595959; 
                transition: all .4s ease; 
            }
            .folder-tree .arrow:hover i { 
                color: #292929; 
            }
            .folder-tree li.expanded > ul { 
                display: block; 
            }
            .folder-tree li.expanded > .arrow .mdi-plus-box-outline::before{ 
                content: "\F06F2";
            }
            .text-green-0 {
                color: #004225 !important;
            }
            .text-green-1 {
                color: #005831 !important;
            }
            .text-green-2 {
                color: #006e3e !important;
            }
            .text-green-3 {
                color: #00854a !important;
            }
            .text-green-4{ 
                color: #009b57 !important;
            }
            .text-green-5 {
                color: #00b163 !important;
            }
            .text-green-6 {
                color: #00c770 !important;
            }
            .text-green-7 {
                color: #00dd7c !important;
            }
            .text-green-8 {
                color: #00dd7c !important;
            }
            .text-green-9 {
                color: #0bff94 !important;
            }
            .text-green-10 {
                color: #21ff9d !important;
            }
            .module-address-bar{
                background-color: #f8f8fb !important;
                border: 1px solid #c7df19 !important;
            }
            .font-size-30{
                font-size: 30px !important;
            }
            .cursor-pointer{
                cursor: pointer;
            }
        </style>
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
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <h4 class="mb-sm-0 font-size-18">File Cabinet</h4>
                                        </div>
                                        <div class="col-9">
                                            <ul class="nav nav-pills justify-content-end">
                                                <li class="nav-item">
                                                    <a class="nav-link" id="v-pills-list-tab" data-bs-toggle="pill" href="#v-pills-list" role="tab" aria-controls="v-pills-list" aria-selected="false">
                                                        <i class="mdi mdi-format-list-bulleted"></i>
                                                    </a>
                                                </li>
                                                <li class="nav-item me-2">
                                                    <a class="nav-link active" id="v-pills-grid-tab" data-bs-toggle="pill" href="#v-pills-grid" role="tab" aria-controls="v-pills-grid" aria-selected="true">
                                                        <i class="mdi mdi-view-grid-outline"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item">
                                                <div class="row">
                                                    <div class="col-2" style="padding: 0px"> 
                                                        <i class="mdi mdi-filter h3 float-end mt-1" style="cursor: pointer;" id="filter_files" onclick="return show_FilterOptions();"></i>
                                                        <div class="modal bs-example-modal-lg filtercollapse" style="display: none;">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-body">
                                                                        <button type="button" class="btn-close float-end" onclick="$('.filtercollapse').css('display','none');"></button>
                                                                        <div class="row">
                                                                            <div class="col-xl">
                                                                                <div class="mt-4 mt-xl-0">
                                                                                    <div class="docs-options">
                                                                                        <div class="input-group mb-3">
                                                                                            <div class="text-center">
                                                                                               <input class="form-check-input" type="radio" name="fileIt_radio" id="fileIt_radio" value="all" checked>
                                                                                               <label class="form-check-label">All</label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="input-group mb-3">
                                                                                            <div class="text-center">
                                                                                               <input class="form-check-input" type="radio" name="fileIt_radio" id="fileIt_radio" value="goal">
                                                                                               <label class="form-check-label">Goals</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-xl">
                                                                                <div class="mt-4 mt-xl-0">
                                                                                    <div class="docs-options">
                                                                                        <div class="input-group mb-3">
                                                                                            <div class="text-center">
                                                                                               <input class="form-check-input" type="radio" name="fileIt_radio" id="fileIt_radio" value="kpi">
                                                                                               <label class="form-check-label">KPIs</label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="input-group mb-3">
                                                                                            <div class="text-center">
                                                                                               <input class="form-check-input" type="radio" name="fileIt_radio" id="fileIt_radio" value="project">
                                                                                               <label class="form-check-label">Projects</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-xl">
                                                                                <div class="mt-4 mt-xl-0">
                                                                                    <div class="docs-options"> 
                                                                                        <div class="input-group mb-3">
                                                                                            <div class="text-center">
                                                                                               <input class="form-check-input" type="radio" name="fileIt_radio" id="fileIt_radio" value="task">
                                                                                               <label class="form-check-label">Tasks</label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!-- <div class="input-group mb-3">
                                                                                            <div class="text-center">
                                                                                               <input class="form-check-input" type="radio" name="fileIt_radio" id="fileIt_radio" value="platform">
                                                                                               <label class="form-check-label">Content</label>
                                                                                            </div>
                                                                                        </div> -->
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div><!-- /.modal-content -->
                                                            </div><!-- /.modal-dialog -->
                                                        </div>
                                                    </div>
                                                    <div class="col-10" style="padding: 0px;">
                                                        <div class="input-group mb-2">
                                                            <input type="text" class="form-control" placeholder="Search..." id="search-criteria-list" style="line-height: 1.5;">
                                                            <button type="button" class="btn bg-transparent" style="line-height: 0.5;margin-left: -40px; z-index: 100;display:none;" id="search-clear-list">
                                                              <i class="fa fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>                    
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
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

<div class="d-xl-flex">
    <div class="w-100">
        <div class="d-md-flex">
            <div class="w-100">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content " id="v-pills-tabContent">
                            <div class="tab-pane fade" id="v-pills-list" role="tabpanel" aria-labelledby="v-pills-list-tab">
                                <div class="row">
                                    <div class="folder-tree-wrapper">
                                        <ul class="folder-tree">
<?php
if($activeDepartments){
    $deptcnt=1;
    foreach ($activeDepartments as $dept) {
        $portfolio_id = $dept->portfolio_id;
        $department_id = $dept->portfolio_dept_id;
        $goals_count1 = $this->Front_model->file_itGoalsCountDeptWise($portfolio_id,$department_id);
        $goals_count2 = $this->Front_model->file_itAcceptedGoalsCountDeptWise($portfolio_id,$department_id);

        $strategies_count1 = $this->Front_model->file_itStrategiesCountDeptWise($portfolio_id,$department_id);
        $strategies_count2 = $this->Front_model->file_itAcceptedStrategiesCountDeptWise($portfolio_id,$department_id);

        $project_count1 = $this->Front_model->file_itProjectCountDeptWise($portfolio_id,$department_id);
        $project_count2 = $this->Front_model->file_itAcceptedProjectCountDeptWise($portfolio_id,$department_id);

        $task_count = $this->Front_model->file_itTaskCountDeptWise($portfolio_id,$department_id);
        $single_task_count = $this->Front_model->file_itSingleTaskCountDeptWise($portfolio_id,$department_id);

        $subtask_count = $this->Front_model->file_itSubtaskCountDeptWise($portfolio_id,$department_id);
        $single_subtask_count = $this->Front_model->file_itSingleSubtaskCountDeptWise($portfolio_id,$department_id);

        $platform_count = $this->Front_model->file_itPlatformCountDeptWise($portfolio_id,$department_id);

        $total_count = intval($goals_count1)+intval($goals_count2)+intval($strategies_count1)+intval($strategies_count2)+intval($project_count1)+intval($project_count2)+intval($task_count)+intval($single_task_count)+intval($subtask_count)+intval($single_subtask_count);
       ?>
            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-0"></i> <?php echo $dept->department; ?> (<?php echo $total_count; ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                <ul>
                    <li class="goal-wise search-list" id="goal-<?php echo $deptcnt; ?>"><i class="mdi mdi-folder-multiple text-green-1"></i> Goals (<?php echo intval($goals_count1)+intval($goals_count2); ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                        <?php
                        $file_itGoals1 = $this->Front_model->file_itGoalsDeptWise($portfolio_id,$department_id);
                        $file_itGoals2 = $this->Front_model->file_itAcceptedGoalsDeptWise($portfolio_id,$department_id);
                        if($file_itGoals1){
                            ?>
                            <ul>
                                <?php
                                foreach ($file_itGoals1 as $ag) {
                                    $goal_id = $ag->gid;
                                    $goal_strategies_count = $this->Front_model->file_itStrategiesCountGoalWise($portfolio_id,$department_id,$goal_id);                        
                                    ?>
                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-2"></i> <?php echo $ag->gname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return GoalOverviewModal(<?php echo $goal_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                        <ul>
                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-3"></i> KPIs (<?php echo $goal_strategies_count; ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                <?php
                                                $file_itGoalStrategy = $this->Front_model->file_itStrategiesGoalWise($portfolio_id,$department_id,$goal_id); 
                                                if($file_itGoalStrategy){
                                                    ?>
                                                    <ul>
                                                        <?php
                                                        foreach ($file_itGoalStrategy as $fgs) {
                                                            $strategy_id = $fgs->sid;
                                                            $goal_project_count1 = $this->Front_model->file_itProjectsCountStrategyWise($portfolio_id,$department_id,$strategy_id);   
                                                            $goal_project_count2 = $this->Front_model->file_itAcceptedProjectsCountStrategyWise($portfolio_id,$department_id,$strategy_id);   
                                                            ?>
                                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-4"></i> <?php echo $fgs->sname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return StrategiesOverviewModal(<?php echo $strategy_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                <ul>
                                                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-5"></i> Projects (<?php echo intval($goal_project_count1)+  intval($goal_project_count2); ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                                        <?php
                                                                        $file_itGoalProject1 = $this->Front_model->file_itProjectsStrategyWise($portfolio_id,$department_id,$strategy_id); 
                                                                        $file_itGoalProject2 = $this->Front_model->file_itAcceptedProjectsStrategyWise($portfolio_id,$department_id,$strategy_id); 
                                                                        if($file_itGoalProject1){
                                                                            ?>
                                                                            <ul>
                                                                                <?php
                                                                                foreach ($file_itGoalProject1 as $fgp) {
                                                                                    $project_id = $fgp->pid;
                                                                                    $project_file_it = $fgp->project_file_it;
                                                                                    $goal_task_count = $this->Front_model->file_itTasksCountProjectWise($portfolio_id,$department_id,$project_id); 
                                                                                    $goal_platform_count = $this->Front_model->file_itPlatformCountProjectWise($portfolio_id,$department_id,$project_id); 
                                                                                    ?>
                                                                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-6"></i> <?php echo $fgp->pname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return ProjectOverviewModal(<?php echo $project_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                                        <ul>
                                                                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-7"></i> Tasks (<?php echo $goal_task_count; ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                                                                <?php
                                                                                                $file_itGoalTask = $this->Front_model->file_itTasksProjectWise($portfolio_id,$department_id,$project_id); 
                                                                                                if($file_itGoalTask){
                                                                                                    ?>
                                                                                                    <ul>
                                                                                                        <?php
                                                                                                        foreach ($file_itGoalTask as $fgt) {
                                                                                                            $task_id = $fgt->tid;
                                                                                                            $goal_subtask_count = $this->Front_model->file_itSubtaskCountTaskWise($portfolio_id,$department_id,$task_id); 
                                                                                                            ?>
                                                                                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-8"></i> <?php echo $fgt->tname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return TaskOverviewModal(<?php echo $task_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                                                                <ul>
                                                                                                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-9"></i> Subtasks (<?php echo $goal_subtask_count; ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                                                                                        <?php
                                                                                                                        $file_itGoalSubtask = $this->Front_model->file_itSubtasksTaskWise($portfolio_id,$department_id,$task_id); 
                                                                                                                        if($file_itGoalSubtask){
                                                                                                                            ?>
                                                                                                                            <ul>
                                                                                                                                <?php
                                                                                                                                foreach ($file_itGoalSubtask as $fgst) {
                                                                                                                                    $subtask_id = $fgst->stid;
                                                                                                                                    ?>
                                                                                                                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-10"></i> <?php echo $fgst->stname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return SubtaskOverviewModal(<?php echo $subtask_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                                                                                    <?php
                                                                                                                                    $subtask_files = $fgst->stfile;
                                                                                                                                    if($subtask_files && $fgst->subtask_file_it == 'yes'){
                                                                                                                                        $subtask_files_array = explode(',', $subtask_files);
                                                                                                                                        ?>
                                                                                                                                        <ul>
                                                                                                                                            <?php
                                                                                                                                            foreach ($subtask_files_array as $stf) {
                                                                                                                                            ?>
                                                                                                                                                <li class="search-list" onclick="return PreviewSubtaskFile('<?php echo $stf;?>','<?php echo $subtask_id;?>')"><i class="text-d mdi mdi-file-document"></i> <?php echo $stf; ?></li>
                                                                                                                                            <?php
                                                                                                                                            }
                                                                                                                                            ?>
                                                                                                                                        </ul>
                                                                                                                                        <?php
                                                                                                                                    }
                                                                                                                                    ?>
                                                                                                                                    </li>
                                                                                                                                    <?php
                                                                                                                                }
                                                                                                                                ?>
                                                                                                                            </ul>
                                                                                                                            <?php
                                                                                                                        }
                                                                                                                        ?>
                                                                                                                    </li>
                                                                                                                    <?php
                                                                                                                    $task_files = $fgt->tfile;
                                                                                                                    $task_files_array = explode(',', $task_files);
                                                                                                                    if($task_files && $fgt->task_file_it == 'yes'){
                                                                                                                        foreach ($task_files_array as $tf) {
                                                                                                                        ?>
                                                                                                                            <li class="search-list" onclick="return PreviewTaskFile('<?php echo $tf;?>','<?php echo $task_id;?>')"><i class="text-d mdi mdi-file-document"></i> <?php echo $tf; ?></li>
                                                                                                                        <?php
                                                                                                                        }
                                                                                                                    }
                                                                                                                    ?>
                                                                                                                </ul>
                                                                                                            </li>
                                                                                                            <?php
                                                                                                        }
                                                                                                        ?>
                                                                                                    </ul>
                                                                                                    <?php
                                                                                                }
                                                                                                ?>
                                                                                            </li>
                                                                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-7"></i> Content (<?php echo $goal_platform_count; ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                                                                <?php
                                                                                                $file_itGoalPlatform = $this->Front_model->file_itPlatformProjectWise($portfolio_id,$department_id,$project_id);
                                                                                                if($file_itGoalPlatform){
                                                                                                    ?>
                                                                                                    <ul>
                                                                                                        <?php
                                                                                                        foreach ($file_itGoalPlatform as $agp) {
                                                                                                            $platform_id = $agp->pc_id;                            
                                                                                                            ?>
                                                                                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-8"></i> 
                                                                                                                <?php
                                                                                                                if($agp->platform == 'twitter')
                                                                                                                {
                                                                                                                    echo '<i class="fab fa-twitter font-size-18 social-d mr-0" title="Twitter"></i>';
                                                                                                                }else if($agp->platform == 'facebook')
                                                                                                                {
                                                                                                                    echo '<i class="fab fa-facebook font-size-18 social-d mr-0" title="Facebook"></i>';
                                                                                                                }else if($agp->platform == 'instagram')
                                                                                                                {
                                                                                                                    echo '<i class="fab fa-instagram font-size-18 social-d mr-0" title="Instagram"></i>';
                                                                                                                }else if($agp->platform == 'linkedin')
                                                                                                                {
                                                                                                                    echo '<i class="fab fa-linkedin font-size-18 social-d mr-0" title="LinkedIn"></i>';
                                                                                                                }else if($agp->platform == 'google-my-business')
                                                                                                                {
                                                                                                                    echo '<i class="mdi mdi-google-my-business font-size-18 social-d mr-0" title="Google My Business"></i>';
                                                                                                                }else if($agp->platform == 'pinterest')
                                                                                                                {
                                                                                                                    echo '<i class="fab fa-pinterest font-size-18 social-d mr-0" title="Pinterest"></i>';
                                                                                                                }else if($agp->platform == 'youtube')
                                                                                                                {
                                                                                                                    echo '<i class="fab fa-youtube font-size-18 social-d mr-0" title="YouTube"></i>';
                                                                                                                }else if($agp->platform == 'blogger')
                                                                                                                {
                                                                                                                    echo '<i class="fab fa-blogger font-size-18 social-d mr-0" title="Blog"></i>';
                                                                                                                }else if($agp->platform == 'tiktok')
                                                                                                                {
                                                                                                                    echo '<i class="fab fa-tiktok font-size-18 social-d mr-0" title="TikTok"></i>';
                                                                                                                }else{
                                                                                                                    echo $agp->platform;
                                                                                                                }
                                                                                                                ?>
                                                                                                             <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return show_platform_modal('file-cabinet','<?php echo $agp->platform; ?>',<?php echo $platform_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                                                            <?php
                                                                                                            $platform_files = $agp->pc_file;
                                                                                                            $doc_pc_files = $agp->doc_pc_file;
                                                                                                            if($platform_files || $doc_pc_files){
                                                                                                                ?>
                                                                                                                <ul>
                                                                                                                <?php
                                                                                                                if($platform_files && $agp->cp_file_it == 'yes'){
                                                                                                                    $platform_files_array = explode(',', $platform_files);                                        
                                                                                                                    foreach ($platform_files_array as $cpf) {
                                                                                                                    ?>
                                                                                                                        <li class="search-list" onclick="return PreviewContentFile('<?php echo $cpf; ?>',<?php echo $platform_id;?>)"><i class="text-d mdi mdi-file-document"></i> <?php echo $cpf; ?></li>
                                                                                                                    <?php
                                                                                                                    }                                            
                                                                                                                }
                                                                                                                if($doc_pc_files && $agp->cp_file_it == 'yes'){
                                                                                                                    $doc_pc_files_array = explode(',', $doc_pc_files);
                                                                                                                    foreach ($doc_pc_files_array as $dcpf) {
                                                                                                                    ?>
                                                                                                                        <li class="search-list" onclick="return PreviewContentFile('<?php echo $dcpf; ?>',<?php echo $platform_id;?>)"><i class="text-d mdi mdi-file-document"></i> <?php echo $dcpf; ?></li>
                                                                                                                    <?php
                                                                                                                    }
                                                                                                                } 
                                                                                                                ?>
                                                                                                                </ul>
                                                                                                                <?php                                   
                                                                                                            }
                                                                                                            ?>
                                                                                                            </li>
                                                                                                            <?php
                                                                                                        }
                                                                                                        ?>
                                                                                                    </ul>
                                                                                                    <?php
                                                                                                }
                                                                                                ?>
                                                                                            </li>
                                                                                            <?php
                                                                                            $project_files = $this->Front_model->getProjectfilesbyPid($project_id);
                                                                                            if($project_files && $project_file_it == 'yes'){
                                                                                                foreach ($project_files as $pf) {
                                                                                                    ?>
                                                                                                    <li class="search-list" onclick="return previewModalFullscreen(<?php echo $pf->pfile_id;?>)"><i class="text-d mdi mdi-file-document"></i> <?php echo $pf->pfile; ?></li>
                                                                                                    <?php
                                                                                                }
                                                                                            }
                                                                                            ?>                
                                                                                        </ul>
                                                                                    </li>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </ul>
                                                                            <?php
                                                                        }
                                                                        if($file_itGoalProject2){
                                                                            ?>
                                                                            <ul>
                                                                                <?php
                                                                                foreach ($file_itGoalProject2 as $ffgp) {
                                                                                    $project_id = $ffgp->pid;
                                                                                    $fgp = $this->Front_model->file_itProjectDetail2($project_id);-
                                                                                    $project_file_it = $fgp->project_file_it;
                                                                                    $goal_task_count = $this->Front_model->file_itTasksCountProjectWise($portfolio_id,$department_id,$project_id); 
                                                                                    $goal_platform_count = $this->Front_model->file_itPlatformCountProjectWise($portfolio_id,$department_id,$project_id); 
                                                                                    ?>
                                                                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-6"></i> <?php echo $fgp->pname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return ProjectOverviewModal(<?php echo $project_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                                        <ul>
                                                                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-7"></i> Tasks (<?php echo $goal_task_count; ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                                                                <?php
                                                                                                $file_itGoalTask = $this->Front_model->file_itTasksProjectWise($portfolio_id,$department_id,$project_id); 
                                                                                                if($file_itGoalTask){
                                                                                                    ?>
                                                                                                    <ul>
                                                                                                        <?php
                                                                                                        foreach ($file_itGoalTask as $fgt) {
                                                                                                            $task_id = $fgt->tid;
                                                                                                            $goal_subtask_count = $this->Front_model->file_itSubtaskCountTaskWise($portfolio_id,$department_id,$task_id); 
                                                                                                            ?>
                                                                                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-8"></i> <?php echo $fgt->tname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return TaskOverviewModal(<?php echo $task_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                                                                <ul>
                                                                                                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-9"></i> Subtasks (<?php echo $goal_subtask_count; ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                                                                                        <?php
                                                                                                                        $file_itGoalSubtask = $this->Front_model->file_itSubtasksTaskWise($portfolio_id,$department_id,$task_id); 
                                                                                                                        if($file_itGoalSubtask){
                                                                                                                            ?>
                                                                                                                            <ul>
                                                                                                                                <?php
                                                                                                                                foreach ($file_itGoalSubtask as $fgst) {
                                                                                                                                    $subtask_id = $fgst->stid;
                                                                                                                                    ?>
                                                                                                                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-10"></i> <?php echo $fgst->stname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return SubtaskOverviewModal(<?php echo $subtask_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                                                                                    <?php
                                                                                                                                    $subtask_files = $fgst->stfile;
                                                                                                                                    if($subtask_files && $fgst->subtask_file_it == 'yes'){
                                                                                                                                        $subtask_files_array = explode(',', $subtask_files);
                                                                                                                                        ?>
                                                                                                                                        <ul>
                                                                                                                                            <?php
                                                                                                                                            foreach ($subtask_files_array as $stf) {
                                                                                                                                            ?>
                                                                                                                                                <li class="search-list" onclick="return PreviewSubtaskFile('<?php echo $stf;?>','<?php echo $subtask_id;?>')"><i class="text-d mdi mdi-file-document"></i> <?php echo $stf; ?></li>
                                                                                                                                            <?php
                                                                                                                                            }
                                                                                                                                            ?>
                                                                                                                                        </ul>
                                                                                                                                        <?php
                                                                                                                                    }
                                                                                                                                    ?>
                                                                                                                                    </li>
                                                                                                                                    <?php
                                                                                                                                }
                                                                                                                                ?>
                                                                                                                            </ul>
                                                                                                                            <?php
                                                                                                                        }
                                                                                                                        ?>
                                                                                                                    </li>
                                                                                                                    <?php
                                                                                                                    $task_files = $fgt->tfile;
                                                                                                                    $task_files_array = explode(',', $task_files);
                                                                                                                    if($task_files && $fgt->task_file_it == 'yes'){
                                                                                                                        foreach ($task_files_array as $tf) {
                                                                                                                        ?>
                                                                                                                            <li class="search-list" onclick="return PreviewTaskFile('<?php echo $tf;?>','<?php echo $task_id;?>')"><i class="text-d mdi mdi-file-document"></i> <?php echo $tf; ?></li>
                                                                                                                        <?php
                                                                                                                        }
                                                                                                                    }
                                                                                                                    ?>
                                                                                                                </ul>
                                                                                                            </li>
                                                                                                            <?php
                                                                                                        }
                                                                                                        ?>
                                                                                                    </ul>
                                                                                                    <?php
                                                                                                }
                                                                                                ?>
                                                                                            </li>
                                                                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-7"></i> Content (<?php echo $goal_platform_count; ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                                                                <?php
                                                                                                $file_itGoalPlatform = $this->Front_model->file_itPlatformProjectWise($portfolio_id,$department_id,$project_id);
                                                                                                if($file_itGoalPlatform){
                                                                                                    ?>
                                                                                                    <ul>
                                                                                                        <?php
                                                                                                        foreach ($file_itGoalPlatform as $agp) {
                                                                                                            $platform_id = $agp->pc_id;                            
                                                                                                            ?>
                                                                                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-8"></i> <?php
                                                                                                                if($agp->platform == 'twitter')
                                                                                                                {
                                                                                                                    echo '<i class="fab fa-twitter font-size-18 social-d mr-0" title="Twitter"></i>';
                                                                                                                }else if($agp->platform == 'facebook')
                                                                                                                {
                                                                                                                    echo '<i class="fab fa-facebook font-size-18 social-d mr-0" title="Facebook"></i>';
                                                                                                                }else if($agp->platform == 'instagram')
                                                                                                                {
                                                                                                                    echo '<i class="fab fa-instagram font-size-18 social-d mr-0" title="Instagram"></i>';
                                                                                                                }else if($agp->platform == 'linkedin')
                                                                                                                {
                                                                                                                    echo '<i class="fab fa-linkedin font-size-18 social-d mr-0" title="LinkedIn"></i>';
                                                                                                                }else if($agp->platform == 'google-my-business')
                                                                                                                {
                                                                                                                    echo '<i class="mdi mdi-google-my-business font-size-18 social-d mr-0" title="Google My Business"></i>';
                                                                                                                }else if($agp->platform == 'pinterest')
                                                                                                                {
                                                                                                                    echo '<i class="fab fa-pinterest font-size-18 social-d mr-0" title="Pinterest"></i>';
                                                                                                                }else if($agp->platform == 'youtube')
                                                                                                                {
                                                                                                                    echo '<i class="fab fa-youtube font-size-18 social-d mr-0" title="YouTube"></i>';
                                                                                                                }else if($agp->platform == 'blogger')
                                                                                                                {
                                                                                                                    echo '<i class="fab fa-blogger font-size-18 social-d mr-0" title="Blog"></i>';
                                                                                                                }else if($agp->platform == 'tiktok')
                                                                                                                {
                                                                                                                    echo '<i class="fab fa-tiktok font-size-18 social-d mr-0" title="TikTok"></i>';
                                                                                                                }else{
                                                                                                                    echo $agp->platform;
                                                                                                                }
                                                                                                                ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return show_platform_modal('file-cabinet','<?php echo $agp->platform; ?>',<?php echo $platform_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                                                            <?php
                                                                                                            $platform_files = $agp->pc_file;
                                                                                                            $doc_pc_files = $agp->doc_pc_file;
                                                                                                            if($platform_files || $doc_pc_files){
                                                                                                                ?>
                                                                                                                <ul>
                                                                                                                <?php
                                                                                                                if($platform_files && $agp->cp_file_it == 'yes'){
                                                                                                                    $platform_files_array = explode(',', $platform_files);                                        
                                                                                                                    foreach ($platform_files_array as $cpf) {
                                                                                                                    ?>
                                                                                                                        <li class="search-list" onclick="return PreviewContentFile('<?php echo $cpf; ?>',<?php echo $platform_id;?>)"><i class="text-d mdi mdi-file-document"></i> <?php echo $cpf; ?></li>
                                                                                                                    <?php
                                                                                                                    }                                            
                                                                                                                }
                                                                                                                if($doc_pc_files && $agp->cp_file_it == 'yes'){
                                                                                                                    $doc_pc_files_array = explode(',', $doc_pc_files);
                                                                                                                    foreach ($doc_pc_files_array as $dcpf) {
                                                                                                                    ?>
                                                                                                                        <li class="search-list" onclick="return PreviewContentFile('<?php echo $dcpf; ?>',<?php echo $platform_id;?>)"><i class="text-d mdi mdi-file-document"></i> <?php echo $dcpf; ?></li>
                                                                                                                    <?php
                                                                                                                    }
                                                                                                                } 
                                                                                                                ?>
                                                                                                                </ul>
                                                                                                                <?php                                   
                                                                                                            }
                                                                                                            ?>
                                                                                                            </li>
                                                                                                            <?php
                                                                                                        }
                                                                                                        ?>
                                                                                                    </ul>
                                                                                                    <?php
                                                                                                }
                                                                                                ?>
                                                                                            </li>
                                                                                            <?php
                                                                                            $project_files = $this->Front_model->getProjectfilesbyPid($project_id);
                                                                                            if($project_files && $project_file_it == 'yes'){
                                                                                                foreach ($project_files as $pf) {
                                                                                                    ?>
                                                                                                    <li class="search-list" onclick="return previewModalFullscreen(<?php echo $pf->pfile_id;?>)"><i class="text-d mdi mdi-file-document"></i> <?php echo $pf->pfile; ?></li>
                                                                                                    <?php
                                                                                                }
                                                                                            }
                                                                                            ?>                
                                                                                        </ul>
                                                                                    </li>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </ul>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                    <?php
                                                }
                                                ?>
                                            </li>
                                        </ul>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                            <?php
                        }
                        if($file_itGoals2){
                            ?>
                            <ul>
                                <?php
                                foreach ($file_itGoals2 as $aag) {    
                                    $goal_id = $aag->gid;
                                    $ag = $this->Front_model->file_itGoalDetail($goal_id);
                                    $goal_strategies_count = $this->Front_model->file_itStrategiesCountGoalWise($portfolio_id,$department_id,$goal_id);                        
                                    ?>
                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-2"></i> <?php echo $ag->gname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return GoalOverviewModal(<?php echo $goal_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                        <ul>
                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-3"></i> KPIs (<?php echo $goal_strategies_count; ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                <?php
                                                $file_itGoalStrategy = $this->Front_model->file_itStrategiesGoalWise($portfolio_id,$department_id,$goal_id); 
                                                if($file_itGoalStrategy){
                                                    ?>
                                                    <ul>
                                                        <?php
                                                        foreach ($file_itGoalStrategy as $fgs) {
                                                            $strategy_id = $fgs->sid;
                                                            $goal_project_count1 = $this->Front_model->file_itProjectsCountStrategyWise($portfolio_id,$department_id,$strategy_id);   
                                                            $goal_project_count2 = $this->Front_model->file_itAcceptedProjectsCountStrategyWise($portfolio_id,$department_id,$strategy_id);   
                                                            ?>
                                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-4"></i> <?php echo $fgs->sname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return StrategiesOverviewModal(<?php echo $strategy_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                <ul>
                                                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-5"></i> Projects (<?php echo intval($goal_project_count1)+intval($goal_project_count2); ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                                        <?php
                                                                        $file_itGoalProject1 = $this->Front_model->file_itProjectsStrategyWise($portfolio_id,$department_id,$strategy_id); 
                                                                        $file_itGoalProject2 = $this->Front_model->file_itAcceptedProjectsStrategyWise($portfolio_id,$department_id,$strategy_id); 
                                                                        if($file_itGoalProject1){
                                                                            ?>
                                                                            <ul>
                                                                                <?php
                                                                                foreach ($file_itGoalProject1 as $fgp) {
                                                                                    $project_id = $fgp->pid;
                                                                                    $project_file_it = $fgp->project_file_it;
                                                                                    $goal_task_count = $this->Front_model->file_itTasksCountProjectWise($portfolio_id,$department_id,$project_id); 
                                                                                    $goal_platform_count = $this->Front_model->file_itPlatformCountProjectWise($portfolio_id,$department_id,$project_id); 
                                                                                    ?>
                                                                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-6"></i> <?php echo $fgp->pname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return ProjectOverviewModal(<?php echo $project_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                                        <ul>
                                                                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-7"></i> Tasks (<?php echo $goal_task_count; ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                                                                <?php
                                                                                                $file_itGoalTask = $this->Front_model->file_itTasksProjectWise($portfolio_id,$department_id,$project_id); 
                                                                                                if($file_itGoalTask){
                                                                                                    ?>
                                                                                                    <ul>
                                                                                                        <?php
                                                                                                        foreach ($file_itGoalTask as $fgt) {
                                                                                                            $task_id = $fgt->tid;
                                                                                                            $goal_subtask_count = $this->Front_model->file_itSubtaskCountTaskWise($portfolio_id,$department_id,$task_id); 
                                                                                                            ?>
                                                                                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-8"></i> <?php echo $fgt->tname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return TaskOverviewModal(<?php echo $task_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                                                                <ul>
                                                                                                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-9"></i> Subtasks (<?php echo $goal_subtask_count; ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                                                                                        <?php
                                                                                                                        $file_itGoalSubtask = $this->Front_model->file_itSubtasksTaskWise($portfolio_id,$department_id,$task_id); 
                                                                                                                        if($file_itGoalSubtask){
                                                                                                                            ?>
                                                                                                                            <ul>
                                                                                                                                <?php
                                                                                                                                foreach ($file_itGoalSubtask as $fgst) {
                                                                                                                                    $subtask_id = $fgst->stid;
                                                                                                                                    ?>
                                                                                                                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-10"></i> <?php echo $fgst->stname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return SubtaskOverviewModal(<?php echo $subtask_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                                                                                    <?php
                                                                                                                                    $subtask_files = $fgst->stfile;
                                                                                                                                    if($subtask_files && $fgst->subtask_file_it == 'yes'){
                                                                                                                                        $subtask_files_array = explode(',', $subtask_files);
                                                                                                                                        ?>
                                                                                                                                        <ul>
                                                                                                                                            <?php
                                                                                                                                            foreach ($subtask_files_array as $stf) {
                                                                                                                                            ?>
                                                                                                                                                <li class="search-list" onclick="return PreviewSubtaskFile('<?php echo $stf;?>','<?php echo $subtask_id;?>')"><i class="text-d mdi mdi-file-document"></i> <?php echo $stf; ?></li>
                                                                                                                                            <?php
                                                                                                                                            }
                                                                                                                                            ?>
                                                                                                                                        </ul>
                                                                                                                                        <?php
                                                                                                                                    }
                                                                                                                                    ?>
                                                                                                                                    </li>
                                                                                                                                    <?php
                                                                                                                                }
                                                                                                                                ?>
                                                                                                                            </ul>
                                                                                                                            <?php
                                                                                                                        }
                                                                                                                        ?>
                                                                                                                    </li>
                                                                                                                    <?php
                                                                                                                    $task_files = $fgt->tfile;
                                                                                                                    $task_files_array = explode(',', $task_files);
                                                                                                                    if($task_files && $fgt->task_file_it == 'yes'){
                                                                                                                        foreach ($task_files_array as $tf) {
                                                                                                                        ?>
                                                                                                                            <li class="search-list" onclick="return PreviewTaskFile('<?php echo $tf;?>','<?php echo $task_id;?>')"><i class="text-d mdi mdi-file-document"></i> <?php echo $tf; ?></li>
                                                                                                                        <?php
                                                                                                                        }
                                                                                                                    }
                                                                                                                    ?>
                                                                                                                </ul>
                                                                                                            </li>
                                                                                                            <?php
                                                                                                        }
                                                                                                        ?>
                                                                                                    </ul>
                                                                                                    <?php
                                                                                                }
                                                                                                ?>
                                                                                            </li>
                                                                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-7"></i> Content (<?php echo $goal_platform_count; ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                                                                <?php
                                                                                                $file_itGoalPlatform = $this->Front_model->file_itPlatformProjectWise($portfolio_id,$department_id,$project_id);
                                                                                                if($file_itGoalPlatform){
                                                                                                    ?>
                                                                                                    <ul>
                                                                                                        <?php
                                                                                                        foreach ($file_itGoalPlatform as $agp) {
                                                                                                            $platform_id = $agp->pc_id;                            
                                                                                                            ?>
                                                                                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-8"></i> 
                                                                                                                <?php
                                                                                                                if($agp->platform == 'twitter')
                                                                                                                {
                                                                                                                    echo '<i class="fab fa-twitter font-size-18 social-d mr-0" title="Twitter"></i>';
                                                                                                                }else if($agp->platform == 'facebook')
                                                                                                                {
                                                                                                                    echo '<i class="fab fa-facebook font-size-18 social-d mr-0" title="Facebook"></i>';
                                                                                                                }else if($agp->platform == 'instagram')
                                                                                                                {
                                                                                                                    echo '<i class="fab fa-instagram font-size-18 social-d mr-0" title="Instagram"></i>';
                                                                                                                }else if($agp->platform == 'linkedin')
                                                                                                                {
                                                                                                                    echo '<i class="fab fa-linkedin font-size-18 social-d mr-0" title="LinkedIn"></i>';
                                                                                                                }else if($agp->platform == 'google-my-business')
                                                                                                                {
                                                                                                                    echo '<i class="mdi mdi-google-my-business font-size-18 social-d mr-0" title="Google My Business"></i>';
                                                                                                                }else if($agp->platform == 'pinterest')
                                                                                                                {
                                                                                                                    echo '<i class="fab fa-pinterest font-size-18 social-d mr-0" title="Pinterest"></i>';
                                                                                                                }else if($agp->platform == 'youtube')
                                                                                                                {
                                                                                                                    echo '<i class="fab fa-youtube font-size-18 social-d mr-0" title="YouTube"></i>';
                                                                                                                }else if($agp->platform == 'blogger')
                                                                                                                {
                                                                                                                    echo '<i class="fab fa-blogger font-size-18 social-d mr-0" title="Blog"></i>';
                                                                                                                }else if($agp->platform == 'tiktok')
                                                                                                                {
                                                                                                                    echo '<i class="fab fa-tiktok font-size-18 social-d mr-0" title="TikTok"></i>';
                                                                                                                }else{
                                                                                                                    echo $agp->platform;
                                                                                                                }
                                                                                                                ?>
                                                                                                             <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return show_platform_modal('file-cabinet','<?php echo $agp->platform; ?>',<?php echo $platform_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                                                            <?php
                                                                                                            $platform_files = $agp->pc_file;
                                                                                                            $doc_pc_files = $agp->doc_pc_file;
                                                                                                            if($platform_files || $doc_pc_files){
                                                                                                                ?>
                                                                                                                <ul>
                                                                                                                <?php
                                                                                                                if($platform_files && $agp->cp_file_it == 'yes'){
                                                                                                                    $platform_files_array = explode(',', $platform_files);                                        
                                                                                                                    foreach ($platform_files_array as $cpf) {
                                                                                                                    ?>
                                                                                                                        <li class="search-list" onclick="return PreviewContentFile('<?php echo $cpf; ?>',<?php echo $platform_id;?>)"><i class="text-d mdi mdi-file-document"></i> <?php echo $cpf; ?></li>
                                                                                                                    <?php
                                                                                                                    }                                            
                                                                                                                }
                                                                                                                if($doc_pc_files && $agp->cp_file_it == 'yes'){
                                                                                                                    $doc_pc_files_array = explode(',', $doc_pc_files);
                                                                                                                    foreach ($doc_pc_files_array as $dcpf) {
                                                                                                                    ?>
                                                                                                                        <li class="search-list" onclick="return PreviewContentFile('<?php echo $dcpf; ?>',<?php echo $platform_id;?>)"><i class="text-d mdi mdi-file-document"></i> <?php echo $dcpf; ?></li>
                                                                                                                    <?php
                                                                                                                    }
                                                                                                                } 
                                                                                                                ?>
                                                                                                                </ul>
                                                                                                                <?php                                   
                                                                                                            }
                                                                                                            ?>
                                                                                                            </li>
                                                                                                            <?php
                                                                                                        }
                                                                                                        ?>
                                                                                                    </ul>
                                                                                                    <?php
                                                                                                }
                                                                                                ?>
                                                                                            </li>
                                                                                            <?php
                                                                                            $project_files = $this->Front_model->getProjectfilesbyPid($project_id);
                                                                                            if($project_files && $project_file_it == 'yes'){
                                                                                                foreach ($project_files as $pf) {
                                                                                                    ?>
                                                                                                    <li class="search-list" onclick="return previewModalFullscreen(<?php echo $pf->pfile_id;?>)"><i class="text-d mdi mdi-file-document"></i> <?php echo $pf->pfile; ?></li>
                                                                                                    <?php
                                                                                                }
                                                                                            }
                                                                                            ?>                
                                                                                        </ul>
                                                                                    </li>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </ul>
                                                                            <?php
                                                                        }
                                                                        if($file_itGoalProject2){
                                                                            ?>
                                                                            <ul>
                                                                                <?php
                                                                                foreach ($file_itGoalProject2 as $ffgp) {
                                                                                    $project_id = $ffgp->pid;
                                                                                    $fgp = $this->Front_model->file_itProjectDetail2($project_id);
                                                                                    $project_file_it = $fgp->project_file_it;
                                                                                    $goal_task_count = $this->Front_model->file_itTasksCountProjectWise($portfolio_id,$department_id,$project_id); 
                                                                                    $goal_platform_count = $this->Front_model->file_itPlatformCountProjectWise($portfolio_id,$department_id,$project_id); 
                                                                                    ?>
                                                                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-6"></i> <?php echo $fgp->pname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return ProjectOverviewModal(<?php echo $project_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                                        <ul>
                                                                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-7"></i> Tasks (<?php echo $goal_task_count; ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                                                                <?php
                                                                                                $file_itGoalTask = $this->Front_model->file_itTasksProjectWise($portfolio_id,$department_id,$project_id); 
                                                                                                if($file_itGoalTask){
                                                                                                    ?>
                                                                                                    <ul>
                                                                                                        <?php
                                                                                                        foreach ($file_itGoalTask as $fgt) {
                                                                                                            $task_id = $fgt->tid;
                                                                                                            $goal_subtask_count = $this->Front_model->file_itSubtaskCountTaskWise($portfolio_id,$department_id,$task_id); 
                                                                                                            ?>
                                                                                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-8"></i> <?php echo $fgt->tname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return TaskOverviewModal(<?php echo $task_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                                                                <ul>
                                                                                                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-9"></i> Subtasks (<?php echo $goal_subtask_count; ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                                                                                        <?php
                                                                                                                        $file_itGoalSubtask = $this->Front_model->file_itSubtasksTaskWise($portfolio_id,$department_id,$task_id); 
                                                                                                                        if($file_itGoalSubtask){
                                                                                                                            ?>
                                                                                                                            <ul>
                                                                                                                                <?php
                                                                                                                                foreach ($file_itGoalSubtask as $fgst) {
                                                                                                                                    $subtask_id = $fgst->stid;
                                                                                                                                    ?>
                                                                                                                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-10"></i> <?php echo $fgst->stname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return SubtaskOverviewModal(<?php echo $subtask_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                                                                                    <?php
                                                                                                                                    $subtask_files = $fgst->stfile;
                                                                                                                                    if($subtask_files && $fgst->subtask_file_it == 'yes'){
                                                                                                                                        $subtask_files_array = explode(',', $subtask_files);
                                                                                                                                        ?>
                                                                                                                                        <ul>
                                                                                                                                            <?php
                                                                                                                                            foreach ($subtask_files_array as $stf) {
                                                                                                                                            ?>
                                                                                                                                                <li class="search-list" onclick="return PreviewSubtaskFile('<?php echo $stf;?>','<?php echo $subtask_id;?>')"><i class="text-d mdi mdi-file-document"></i> <?php echo $stf; ?></li>
                                                                                                                                            <?php
                                                                                                                                            }
                                                                                                                                            ?>
                                                                                                                                        </ul>
                                                                                                                                        <?php
                                                                                                                                    }
                                                                                                                                    ?>
                                                                                                                                    </li>
                                                                                                                                    <?php
                                                                                                                                }
                                                                                                                                ?>
                                                                                                                            </ul>
                                                                                                                            <?php
                                                                                                                        }
                                                                                                                        ?>
                                                                                                                    </li>
                                                                                                                    <?php
                                                                                                                    $task_files = $fgt->tfile;
                                                                                                                    $task_files_array = explode(',', $task_files);
                                                                                                                    if($task_files && $fgt->task_file_it == 'yes'){
                                                                                                                        foreach ($task_files_array as $tf) {
                                                                                                                        ?>
                                                                                                                            <li class="search-list" onclick="return PreviewTaskFile('<?php echo $tf;?>','<?php echo $task_id;?>')"><i class="text-d mdi mdi-file-document"></i> <?php echo $tf; ?></li>
                                                                                                                        <?php
                                                                                                                        }
                                                                                                                    }
                                                                                                                    ?>
                                                                                                                </ul>
                                                                                                            </li>
                                                                                                            <?php
                                                                                                        }
                                                                                                        ?>
                                                                                                    </ul>
                                                                                                    <?php
                                                                                                }
                                                                                                ?>
                                                                                            </li>
                                                                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-7"></i> Content (<?php echo $goal_platform_count; ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                                                                <?php
                                                                                                $file_itGoalPlatform = $this->Front_model->file_itPlatformProjectWise($portfolio_id,$department_id,$project_id);
                                                                                                if($file_itGoalPlatform){
                                                                                                    ?>
                                                                                                    <ul>
                                                                                                        <?php
                                                                                                        foreach ($file_itGoalPlatform as $agp) {
                                                                                                            $platform_id = $agp->pc_id;                            
                                                                                                            ?>
                                                                                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-8"></i> 
                                                                                                                <?php
                                                                                                                    if($agp->platform == 'twitter')
                                                                                                                    {
                                                                                                                        echo '<i class="fab fa-twitter font-size-18 social-d mr-0" title="Twitter"></i>';
                                                                                                                    }else if($agp->platform == 'facebook')
                                                                                                                    {
                                                                                                                        echo '<i class="fab fa-facebook font-size-18 social-d mr-0" title="Facebook"></i>';
                                                                                                                    }else if($agp->platform == 'instagram')
                                                                                                                    {
                                                                                                                        echo '<i class="fab fa-instagram font-size-18 social-d mr-0" title="Instagram"></i>';
                                                                                                                    }else if($agp->platform == 'linkedin')
                                                                                                                    {
                                                                                                                        echo '<i class="fab fa-linkedin font-size-18 social-d mr-0" title="LinkedIn"></i>';
                                                                                                                    }else if($agp->platform == 'google-my-business')
                                                                                                                    {
                                                                                                                        echo '<i class="mdi mdi-google-my-business font-size-18 social-d mr-0" title="Google My Business"></i>';
                                                                                                                    }else if($agp->platform == 'pinterest')
                                                                                                                    {
                                                                                                                        echo '<i class="fab fa-pinterest font-size-18 social-d mr-0" title="Pinterest"></i>';
                                                                                                                    }else if($agp->platform == 'youtube')
                                                                                                                    {
                                                                                                                        echo '<i class="fab fa-youtube font-size-18 social-d mr-0" title="YouTube"></i>';
                                                                                                                    }else if($agp->platform == 'blogger')
                                                                                                                    {
                                                                                                                        echo '<i class="fab fa-blogger font-size-18 social-d mr-0" title="Blog"></i>';
                                                                                                                    }else if($agp->platform == 'tiktok')
                                                                                                                    {
                                                                                                                        echo '<i class="fab fa-tiktok font-size-18 social-d mr-0" title="TikTok"></i>';
                                                                                                                    }else{
                                                                                                                        echo $agp->platform;
                                                                                                                    }
                                                                                                                    ?>
                                                                                                             <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return show_platform_modal('file-cabinet','<?php echo $agp->platform; ?>',<?php echo $platform_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                                                            <?php
                                                                                                            $platform_files = $agp->pc_file;
                                                                                                            $doc_pc_files = $agp->doc_pc_file;
                                                                                                            if($platform_files || $doc_pc_files){
                                                                                                                ?>
                                                                                                                <ul>
                                                                                                                <?php
                                                                                                                if($platform_files && $agp->cp_file_it == 'yes'){
                                                                                                                    $platform_files_array = explode(',', $platform_files);                                        
                                                                                                                    foreach ($platform_files_array as $cpf) {
                                                                                                                    ?>
                                                                                                                        <li class="search-list" onclick="return PreviewContentFile('<?php echo $cpf; ?>',<?php echo $platform_id;?>)"><i class="text-d mdi mdi-file-document"></i> <?php echo $cpf; ?></li>
                                                                                                                    <?php
                                                                                                                    }                                            
                                                                                                                }
                                                                                                                if($doc_pc_files && $agp->cp_file_it == 'yes'){
                                                                                                                    $doc_pc_files_array = explode(',', $doc_pc_files);
                                                                                                                    foreach ($doc_pc_files_array as $dcpf) {
                                                                                                                    ?>
                                                                                                                        <li class="search-list" onclick="return PreviewContentFile('<?php echo $dcpf; ?>',<?php echo $platform_id;?>)"><i class="text-d mdi mdi-file-document"></i> <?php echo $dcpf; ?></li>
                                                                                                                    <?php
                                                                                                                    }
                                                                                                                } 
                                                                                                                ?>
                                                                                                                </ul>
                                                                                                                <?php                                   
                                                                                                            }
                                                                                                            ?>
                                                                                                            </li>
                                                                                                            <?php
                                                                                                        }
                                                                                                        ?>
                                                                                                    </ul>
                                                                                                    <?php
                                                                                                }
                                                                                                ?>
                                                                                            </li>
                                                                                            <?php
                                                                                            $project_files = $this->Front_model->getProjectfilesbyPid($project_id);
                                                                                            if($project_files && $project_file_it == 'yes'){
                                                                                                foreach ($project_files as $pf) {
                                                                                                    ?>
                                                                                                    <li class="search-list" onclick="return previewModalFullscreen(<?php echo $pf->pfile_id;?>)"><i class="text-d mdi mdi-file-document"></i> <?php echo $pf->pfile; ?></li>
                                                                                                    <?php
                                                                                                }
                                                                                            }
                                                                                            ?>                
                                                                                        </ul>
                                                                                    </li>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </ul>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                    <?php
                                                }
                                                ?>
                                            </li>
                                        </ul>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                            <?php
                        }
                        ?>
                    </li>
                    <li class="kpi-wise search-list" id="kpi-<?php echo $deptcnt; ?>"><i class="mdi mdi-folder-multiple text-green-1"></i> KPIs (<?php echo intval($strategies_count1)+intval($strategies_count2); ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                        <?php
                        $file_itStrategies1 = $this->Front_model->file_itStrategiesDeptWise($portfolio_id,$department_id);
                        $file_itStrategies2 = $this->Front_model->file_itAcceptedStrategiesDeptWise($portfolio_id,$department_id);
                        if($file_itStrategies1){
                            ?>
                            <ul>
                                <?php
                                foreach ($file_itStrategies1 as $as) {
                                    $strategy_id = $as->sid;
                                    $goal_project_count1 = $this->Front_model->file_itProjectsCountStrategyWise($portfolio_id,$department_id,$strategy_id);  
                                    $goal_project_count2 = $this->Front_model->file_itAcceptedProjectsCountStrategyWise($portfolio_id,$department_id,$strategy_id);  
                                    ?>
                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-2"></i> <?php echo $as->sname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return StrategiesOverviewModal(<?php echo $strategy_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                        <ul>
                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-3"></i> Projects (<?php echo intval($goal_project_count1)+intval($goal_project_count2); ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                <?php
                                                $file_itGoalProject1 = $this->Front_model->file_itProjectsStrategyWise($portfolio_id,$department_id,$strategy_id); 
                                                $file_itGoalProject2 = $this->Front_model->file_itAcceptedProjectsStrategyWise($portfolio_id,$department_id,$strategy_id); 
                                                if($file_itGoalProject1){
                                                    ?>
                                                    <ul>
                                                        <?php
                                                        foreach ($file_itGoalProject1 as $fgp) {
                                                            $project_id = $fgp->pid;
                                                            $project_file_it = $fgp->project_file_it;
                                                            $goal_task_count = $this->Front_model->file_itTasksCountProjectWise($portfolio_id,$department_id,$project_id); 
                                                            $goal_platform_count = $this->Front_model->file_itPlatformCountProjectWise($portfolio_id,$department_id,$project_id); 
                                                            ?>
                                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-5"></i> <?php echo $fgp->pname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return ProjectOverviewModal(<?php echo $project_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                <ul>
                                                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-6"></i> Tasks (<?php echo $goal_task_count; ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                                        <?php
                                                                        $file_itGoalTask = $this->Front_model->file_itTasksProjectWise($portfolio_id,$department_id,$project_id); 
                                                                        if($file_itGoalTask){
                                                                            ?>
                                                                            <ul>
                                                                                <?php
                                                                                foreach ($file_itGoalTask as $fgt) {
                                                                                    $task_id = $fgt->tid;
                                                                                    $goal_subtask_count = $this->Front_model->file_itSubtaskCountTaskWise($portfolio_id,$department_id,$task_id); 
                                                                                    ?>
                                                                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-7"></i> <?php echo $fgt->tname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return TaskOverviewModal(<?php echo $task_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                                        <ul>
                                                                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-8"></i> Subtasks (<?php echo $goal_subtask_count; ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                                                                <?php
                                                                                                $file_itGoalSubtask = $this->Front_model->file_itSubtasksTaskWise($portfolio_id,$department_id,$task_id); 
                                                                                                if($file_itGoalSubtask){
                                                                                                    ?>
                                                                                                    <ul>
                                                                                                        <?php
                                                                                                        foreach ($file_itGoalSubtask as $fgst) {
                                                                                                            $subtask_id = $fgst->stid;
                                                                                                            ?>
                                                                                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-9"></i> <?php echo $fgst->stname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return SubtaskOverviewModal(<?php echo $subtask_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                                                            <?php
                                                                                                            $subtask_files = $fgst->stfile;
                                                                                                            if($subtask_files && $fgst->subtask_file_it == 'yes'){
                                                                                                                $subtask_files_array = explode(',', $subtask_files);
                                                                                                                ?>
                                                                                                                <ul>
                                                                                                                    <?php
                                                                                                                    foreach ($subtask_files_array as $stf) {
                                                                                                                    ?>
                                                                                                                        <li class="search-list" onclick="return PreviewSubtaskFile('<?php echo $stf;?>','<?php echo $subtask_id;?>')"><i class="text-d mdi mdi-file-document"></i> <?php echo $stf; ?></li>
                                                                                                                    <?php
                                                                                                                    }
                                                                                                                    ?>
                                                                                                                </ul>
                                                                                                                <?php
                                                                                                            }
                                                                                                            ?>
                                                                                                            </li>
                                                                                                            <?php
                                                                                                        }
                                                                                                        ?>
                                                                                                    </ul>
                                                                                                    <?php
                                                                                                }
                                                                                                ?>
                                                                                            </li>
                                                                                            <?php
                                                                                            $task_files = $fgt->tfile;
                                                                                            $task_files_array = explode(',', $task_files);
                                                                                            if($task_files && $fgt->task_file_it == 'yes'){
                                                                                                foreach ($task_files_array as $tf) {
                                                                                                ?>
                                                                                                    <li class="search-list" onclick="return PreviewTaskFile('<?php echo $tf;?>','<?php echo $task_id;?>')"><i class="text-d mdi mdi-file-document"></i> <?php echo $tf; ?></li>
                                                                                                <?php
                                                                                                }
                                                                                            }
                                                                                            ?>
                                                                                        </ul>
                                                                                    </li>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </ul>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </li>
                                                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-6"></i> Content (<?php echo $goal_platform_count; ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                                        <?php
                                                                        $file_itGoalPlatform = $this->Front_model->file_itPlatformProjectWise($portfolio_id,$department_id,$project_id);
                                                                        if($file_itGoalPlatform){
                                                                            ?>
                                                                            <ul>
                                                                                <?php
                                                                                foreach ($file_itGoalPlatform as $agp) {
                                                                                    $platform_id = $agp->pc_id;                           
                                                                                    ?>
                                                                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-7"></i> 
                                                                                        <?php
                                                                                            if($agp->platform == 'twitter')
                                                                                            {
                                                                                                echo '<i class="fab fa-twitter font-size-18 social-d mr-0" title="Twitter"></i>';
                                                                                            }else if($agp->platform == 'facebook')
                                                                                            {
                                                                                                echo '<i class="fab fa-facebook font-size-18 social-d mr-0" title="Facebook"></i>';
                                                                                            }else if($agp->platform == 'instagram')
                                                                                            {
                                                                                                echo '<i class="fab fa-instagram font-size-18 social-d mr-0" title="Instagram"></i>';
                                                                                            }else if($agp->platform == 'linkedin')
                                                                                            {
                                                                                                echo '<i class="fab fa-linkedin font-size-18 social-d mr-0" title="LinkedIn"></i>';
                                                                                            }else if($agp->platform == 'google-my-business')
                                                                                            {
                                                                                                echo '<i class="mdi mdi-google-my-business font-size-18 social-d mr-0" title="Google My Business"></i>';
                                                                                            }else if($agp->platform == 'pinterest')
                                                                                            {
                                                                                                echo '<i class="fab fa-pinterest font-size-18 social-d mr-0" title="Pinterest"></i>';
                                                                                            }else if($agp->platform == 'youtube')
                                                                                            {
                                                                                                echo '<i class="fab fa-youtube font-size-18 social-d mr-0" title="YouTube"></i>';
                                                                                            }else if($agp->platform == 'blogger')
                                                                                            {
                                                                                                echo '<i class="fab fa-blogger font-size-18 social-d mr-0" title="Blog"></i>';
                                                                                            }else if($agp->platform == 'tiktok')
                                                                                            {
                                                                                                echo '<i class="fab fa-tiktok font-size-18 social-d mr-0" title="TikTok"></i>';
                                                                                            }else{
                                                                                                echo $agp->platform;
                                                                                            }
                                                                                            ?>
                                                                                     <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return show_platform_modal('file-cabinet','<?php echo $agp->platform; ?>',<?php echo $platform_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                                    <?php
                                                                                    $platform_files = $agp->pc_file;
                                                                                    $doc_pc_files = $agp->doc_pc_file;
                                                                                    if($platform_files || $doc_pc_files){
                                                                                        ?>
                                                                                        <ul>
                                                                                        <?php
                                                                                        if($platform_files && $agp->cp_file_it == 'yes'){
                                                                                            $platform_files_array = explode(',', $platform_files);                                        
                                                                                            foreach ($platform_files_array as $cpf) {
                                                                                            ?>
                                                                                                <li class="search-list" onclick="return PreviewContentFile('<?php echo $cpf; ?>',<?php echo $platform_id;?>)"><i class="text-d mdi mdi-file-document"></i> <?php echo $cpf; ?></li>
                                                                                            <?php
                                                                                            }                                            
                                                                                        }
                                                                                        if($doc_pc_files && $agp->cp_file_it == 'yes'){
                                                                                            $doc_pc_files_array = explode(',', $doc_pc_files);
                                                                                            foreach ($doc_pc_files_array as $dcpf) {
                                                                                            ?>
                                                                                                <li class="search-list" onclick="return PreviewContentFile('<?php echo $dcpf; ?>',<?php echo $platform_id;?>)"><i class="text-d mdi mdi-file-document"></i> <?php echo $dcpf; ?></li>
                                                                                            <?php
                                                                                            }
                                                                                        } 
                                                                                        ?>
                                                                                        </ul>
                                                                                        <?php                                   
                                                                                    }
                                                                                    ?>
                                                                                    </li>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </ul>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </li>
                                                                    <?php
                                                                    $project_files = $this->Front_model->getProjectfilesbyPid($project_id);
                                                                    if($project_files && $project_file_it == 'yes'){
                                                                        foreach ($project_files as $pf) {
                                                                            ?>
                                                                            <li class="search-list" onclick="return previewModalFullscreen(<?php echo $pf->pfile_id;?>)"><i class="text-d mdi mdi-file-document"></i> <?php echo $pf->pfile; ?></li>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </ul>
                                                            </li>
                                                            <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                    <?php
                                                }
                                                if($file_itGoalProject2){
                                                    ?>
                                                    <ul>
                                                        <?php
                                                        foreach ($file_itGoalProject2 as $ffgp) {
                                                            $project_id = $ffgp->pid;
                                                            $fgp = $this->Front_model->file_itProjectDetail2($project_id);
                                                            $project_file_it = $fgp->project_file_it;
                                                            $goal_task_count = $this->Front_model->file_itTasksCountProjectWise($portfolio_id,$department_id,$project_id); 
                                                            $goal_platform_count = $this->Front_model->file_itPlatformCountProjectWise($portfolio_id,$department_id,$project_id); 
                                                            ?>
                                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-5"></i> <?php echo $fgp->pname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return ProjectOverviewModal(<?php echo $project_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                <ul>
                                                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-6"></i> Tasks (<?php echo $goal_task_count; ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                                        <?php
                                                                        $file_itGoalTask = $this->Front_model->file_itTasksProjectWise($portfolio_id,$department_id,$project_id); 
                                                                        if($file_itGoalTask){
                                                                            ?>
                                                                            <ul>
                                                                                <?php
                                                                                foreach ($file_itGoalTask as $fgt) {
                                                                                    $task_id = $fgt->tid;
                                                                                    $goal_subtask_count = $this->Front_model->file_itSubtaskCountTaskWise($portfolio_id,$department_id,$task_id); 
                                                                                    ?>
                                                                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-7"></i> <?php echo $fgt->tname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return TaskOverviewModal(<?php echo $task_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                                        <ul>
                                                                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-8"></i> Subtasks (<?php echo $goal_subtask_count; ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                                                                <?php
                                                                                                $file_itGoalSubtask = $this->Front_model->file_itSubtasksTaskWise($portfolio_id,$department_id,$task_id); 
                                                                                                if($file_itGoalSubtask){
                                                                                                    ?>
                                                                                                    <ul>
                                                                                                        <?php
                                                                                                        foreach ($file_itGoalSubtask as $fgst) {
                                                                                                            $subtask_id = $fgst->stid;
                                                                                                            ?>
                                                                                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-9"></i> <?php echo $fgst->stname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return SubtaskOverviewModal(<?php echo $subtask_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                                                            <?php
                                                                                                            $subtask_files = $fgst->stfile;
                                                                                                            if($subtask_files && $fgst->subtask_file_it == 'yes'){
                                                                                                                $subtask_files_array = explode(',', $subtask_files);
                                                                                                                ?>
                                                                                                                <ul>
                                                                                                                    <?php
                                                                                                                    foreach ($subtask_files_array as $stf) {
                                                                                                                    ?>
                                                                                                                        <li class="search-list" onclick="return PreviewSubtaskFile('<?php echo $stf;?>','<?php echo $subtask_id;?>')"><i class="text-d mdi mdi-file-document"></i> <?php echo $stf; ?></li>
                                                                                                                    <?php
                                                                                                                    }
                                                                                                                    ?>
                                                                                                                </ul>
                                                                                                                <?php
                                                                                                            }
                                                                                                            ?>
                                                                                                            </li>
                                                                                                            <?php
                                                                                                        }
                                                                                                        ?>
                                                                                                    </ul>
                                                                                                    <?php
                                                                                                }
                                                                                                ?>
                                                                                            </li>
                                                                                            <?php
                                                                                            $task_files = $fgt->tfile;
                                                                                            $task_files_array = explode(',', $task_files);
                                                                                            if($task_files && $fgt->task_file_it == 'yes'){
                                                                                                foreach ($task_files_array as $tf) {
                                                                                                ?>
                                                                                                    <li class="search-list" onclick="return PreviewTaskFile('<?php echo $tf;?>','<?php echo $task_id;?>')"><i class="text-d mdi mdi-file-document"></i> <?php echo $tf; ?></li>
                                                                                                <?php
                                                                                                }
                                                                                            }
                                                                                            ?>
                                                                                        </ul>
                                                                                    </li>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </ul>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </li>
                                                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-6"></i> Content (<?php echo $goal_platform_count; ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                                        <?php
                                                                        $file_itGoalPlatform = $this->Front_model->file_itPlatformProjectWise($portfolio_id,$department_id,$project_id);
                                                                        if($file_itGoalPlatform){
                                                                            ?>
                                                                            <ul>
                                                                                <?php
                                                                                foreach ($file_itGoalPlatform as $agp) {
                                                                                    $platform_id = $agp->pc_id;                           
                                                                                    ?>
                                                                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-7"></i> 
                                                                                        <?php
                                                                                            if($agp->platform == 'twitter')
                                                                                            {
                                                                                                echo '<i class="fab fa-twitter font-size-18 social-d mr-0" title="Twitter"></i>';
                                                                                            }else if($agp->platform == 'facebook')
                                                                                            {
                                                                                                echo '<i class="fab fa-facebook font-size-18 social-d mr-0" title="Facebook"></i>';
                                                                                            }else if($agp->platform == 'instagram')
                                                                                            {
                                                                                                echo '<i class="fab fa-instagram font-size-18 social-d mr-0" title="Instagram"></i>';
                                                                                            }else if($agp->platform == 'linkedin')
                                                                                            {
                                                                                                echo '<i class="fab fa-linkedin font-size-18 social-d mr-0" title="LinkedIn"></i>';
                                                                                            }else if($agp->platform == 'google-my-business')
                                                                                            {
                                                                                                echo '<i class="mdi mdi-google-my-business font-size-18 social-d mr-0" title="Google My Business"></i>';
                                                                                            }else if($agp->platform == 'pinterest')
                                                                                            {
                                                                                                echo '<i class="fab fa-pinterest font-size-18 social-d mr-0" title="Pinterest"></i>';
                                                                                            }else if($agp->platform == 'youtube')
                                                                                            {
                                                                                                echo '<i class="fab fa-youtube font-size-18 social-d mr-0" title="YouTube"></i>';
                                                                                            }else if($agp->platform == 'blogger')
                                                                                            {
                                                                                                echo '<i class="fab fa-blogger font-size-18 social-d mr-0" title="Blog"></i>';
                                                                                            }else if($agp->platform == 'tiktok')
                                                                                            {
                                                                                                echo '<i class="fab fa-tiktok font-size-18 social-d mr-0" title="TikTok"></i>';
                                                                                            }else{
                                                                                                echo $agp->platform;
                                                                                            }
                                                                                            ?>
                                                                                     <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return show_platform_modal('file-cabinet','<?php echo $agp->platform; ?>',<?php echo $platform_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                                    <?php
                                                                                    $platform_files = $agp->pc_file;
                                                                                    $doc_pc_files = $agp->doc_pc_file;
                                                                                    if($platform_files || $doc_pc_files){
                                                                                        ?>
                                                                                        <ul>
                                                                                        <?php
                                                                                        if($platform_files && $agp->cp_file_it == 'yes'){
                                                                                            $platform_files_array = explode(',', $platform_files);                                        
                                                                                            foreach ($platform_files_array as $cpf) {
                                                                                            ?>
                                                                                                <li class="search-list" onclick="return PreviewContentFile('<?php echo $cpf; ?>',<?php echo $platform_id;?>)"><i class="text-d mdi mdi-file-document"></i> <?php echo $cpf; ?></li>
                                                                                            <?php
                                                                                            }                                            
                                                                                        }
                                                                                        if($doc_pc_files && $agp->cp_file_it == 'yes'){
                                                                                            $doc_pc_files_array = explode(',', $doc_pc_files);
                                                                                            foreach ($doc_pc_files_array as $dcpf) {
                                                                                            ?>
                                                                                                <li class="search-list" onclick="return PreviewContentFile('<?php echo $dcpf; ?>',<?php echo $platform_id;?>)"><i class="text-d mdi mdi-file-document"></i> <?php echo $dcpf; ?></li>
                                                                                            <?php
                                                                                            }
                                                                                        } 
                                                                                        ?>
                                                                                        </ul>
                                                                                        <?php                                   
                                                                                    }
                                                                                    ?>
                                                                                    </li>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </ul>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </li>
                                                                    <?php
                                                                    $project_files = $this->Front_model->getProjectfilesbyPid($project_id);
                                                                    if($project_files && $project_file_it == 'yes'){
                                                                        foreach ($project_files as $pf) {
                                                                            ?>
                                                                            <li class="search-list" onclick="return previewModalFullscreen(<?php echo $pf->pfile_id;?>)"><i class="text-d mdi mdi-file-document"></i> <?php echo $pf->pfile; ?></li>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </ul>
                                                            </li>
                                                            <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                    <?php
                                                }
                                                ?>
                                            </li>
                                        </ul>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                            <?php
                        }
                        if($file_itStrategies2){
                            ?>
                            <ul>
                                <?php
                                foreach ($file_itStrategies2 as $aas) {
                                    $strategy_id = $aas->sid;
                                    $as = $this->Front_model->file_itStrategyDetail($strategy_id);
                                    $goal_project_count1 = $this->Front_model->file_itProjectsCountStrategyWise($portfolio_id,$department_id,$strategy_id);  
                                    $goal_project_count2 = $this->Front_model->file_itAcceptedProjectsCountStrategyWise($portfolio_id,$department_id,$strategy_id);  
                                    ?>
                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-2"></i> <?php echo $as->sname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return StrategiesOverviewModal(<?php echo $strategy_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                        <ul>
                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-3"></i> Projects (<?php echo intval($goal_project_count1)+intval($goal_project_count2); ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                <?php
                                                $file_itGoalProject1 = $this->Front_model->file_itProjectsStrategyWise($portfolio_id,$department_id,$strategy_id); 
                                                $file_itGoalProject2 = $this->Front_model->file_itAcceptedProjectsStrategyWise($portfolio_id,$department_id,$strategy_id); 
                                                if($file_itGoalProject1){
                                                    ?>
                                                    <ul>
                                                        <?php
                                                        foreach ($file_itGoalProject1 as $fgp) {
                                                            $project_id = $fgp->pid;
                                                            $project_file_it = $fgp->project_file_it;
                                                            $goal_task_count = $this->Front_model->file_itTasksCountProjectWise($portfolio_id,$department_id,$project_id); 
                                                            $goal_platform_count = $this->Front_model->file_itPlatformCountProjectWise($portfolio_id,$department_id,$project_id); 
                                                            ?>
                                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-5"></i> <?php echo $fgp->pname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return ProjectOverviewModal(<?php echo $project_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                <ul>
                                                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-6"></i> Tasks (<?php echo $goal_task_count; ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                                        <?php
                                                                        $file_itGoalTask = $this->Front_model->file_itTasksProjectWise($portfolio_id,$department_id,$project_id); 
                                                                        if($file_itGoalTask){
                                                                            ?>
                                                                            <ul>
                                                                                <?php
                                                                                foreach ($file_itGoalTask as $fgt) {
                                                                                    $task_id = $fgt->tid;
                                                                                    $goal_subtask_count = $this->Front_model->file_itSubtaskCountTaskWise($portfolio_id,$department_id,$task_id); 
                                                                                    ?>
                                                                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-7"></i> <?php echo $fgt->tname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return TaskOverviewModal(<?php echo $task_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                                        <ul>
                                                                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-8"></i> Subtasks (<?php echo $goal_subtask_count; ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                                                                <?php
                                                                                                $file_itGoalSubtask = $this->Front_model->file_itSubtasksTaskWise($portfolio_id,$department_id,$task_id); 
                                                                                                if($file_itGoalSubtask){
                                                                                                    ?>
                                                                                                    <ul>
                                                                                                        <?php
                                                                                                        foreach ($file_itGoalSubtask as $fgst) {
                                                                                                            $subtask_id = $fgst->stid;
                                                                                                            ?>
                                                                                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-9"></i> <?php echo $fgst->stname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return SubtaskOverviewModal(<?php echo $subtask_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                                                            <?php
                                                                                                            $subtask_files = $fgst->stfile;
                                                                                                            if($subtask_files && $fgst->subtask_file_it == 'yes'){
                                                                                                                $subtask_files_array = explode(',', $subtask_files);
                                                                                                                ?>
                                                                                                                <ul>
                                                                                                                    <?php
                                                                                                                    foreach ($subtask_files_array as $stf) {
                                                                                                                    ?>
                                                                                                                        <li class="search-list" onclick="return PreviewSubtaskFile('<?php echo $stf;?>','<?php echo $subtask_id;?>')"><i class="text-d mdi mdi-file-document"></i> <?php echo $stf; ?></li>
                                                                                                                    <?php
                                                                                                                    }
                                                                                                                    ?>
                                                                                                                </ul>
                                                                                                                <?php
                                                                                                            }
                                                                                                            ?>
                                                                                                            </li>
                                                                                                            <?php
                                                                                                        }
                                                                                                        ?>
                                                                                                    </ul>
                                                                                                    <?php
                                                                                                }
                                                                                                ?>
                                                                                            </li>
                                                                                            <?php
                                                                                            $task_files = $fgt->tfile;
                                                                                            $task_files_array = explode(',', $task_files);
                                                                                            if($task_files && $fgt->task_file_it == 'yes'){
                                                                                                foreach ($task_files_array as $tf) {
                                                                                                ?>
                                                                                                    <li class="search-list" onclick="return PreviewTaskFile('<?php echo $tf;?>','<?php echo $task_id;?>')"><i class="text-d mdi mdi-file-document"></i> <?php echo $tf; ?></li>
                                                                                                <?php
                                                                                                }
                                                                                            }
                                                                                            ?>
                                                                                        </ul>
                                                                                    </li>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </ul>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </li>
                                                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-6"></i> Content (<?php echo $goal_platform_count; ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                                        <?php
                                                                        $file_itGoalPlatform = $this->Front_model->file_itPlatformProjectWise($portfolio_id,$department_id,$project_id);
                                                                        if($file_itGoalPlatform){
                                                                            ?>
                                                                            <ul>
                                                                                <?php
                                                                                foreach ($file_itGoalPlatform as $agp) {
                                                                                    $platform_id = $agp->pc_id;                           
                                                                                    ?>
                                                                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-7"></i>
                                                                                    <?php
                                                                                        if($agp->platform == 'twitter')
                                                                                        {
                                                                                            echo '<i class="fab fa-twitter font-size-18 social-d mr-0" title="Twitter"></i>';
                                                                                        }else if($agp->platform == 'facebook')
                                                                                        {
                                                                                            echo '<i class="fab fa-facebook font-size-18 social-d mr-0" title="Facebook"></i>';
                                                                                        }else if($agp->platform == 'instagram')
                                                                                        {
                                                                                            echo '<i class="fab fa-instagram font-size-18 social-d mr-0" title="Instagram"></i>';
                                                                                        }else if($agp->platform == 'linkedin')
                                                                                        {
                                                                                            echo '<i class="fab fa-linkedin font-size-18 social-d mr-0" title="LinkedIn"></i>';
                                                                                        }else if($agp->platform == 'google-my-business')
                                                                                        {
                                                                                            echo '<i class="mdi mdi-google-my-business font-size-18 social-d mr-0" title="Google My Business"></i>';
                                                                                        }else if($agp->platform == 'pinterest')
                                                                                        {
                                                                                            echo '<i class="fab fa-pinterest font-size-18 social-d mr-0" title="Pinterest"></i>';
                                                                                        }else if($agp->platform == 'youtube')
                                                                                        {
                                                                                            echo '<i class="fab fa-youtube font-size-18 social-d mr-0" title="YouTube"></i>';
                                                                                        }else if($agp->platform == 'blogger')
                                                                                        {
                                                                                            echo '<i class="fab fa-blogger font-size-18 social-d mr-0" title="Blog"></i>';
                                                                                        }else if($agp->platform == 'tiktok')
                                                                                        {
                                                                                            echo '<i class="fab fa-tiktok font-size-18 social-d mr-0" title="TikTok"></i>';
                                                                                        }else{
                                                                                            echo $agp->platform;
                                                                                        }
                                                                                        ?> 
                                                                                     <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return show_platform_modal('file-cabinet','<?php echo $agp->platform; ?>',<?php echo $platform_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                                    <?php
                                                                                    $platform_files = $agp->pc_file;
                                                                                    $doc_pc_files = $agp->doc_pc_file;
                                                                                    if($platform_files || $doc_pc_files){
                                                                                        ?>
                                                                                        <ul>
                                                                                        <?php
                                                                                        if($platform_files && $agp->cp_file_it == 'yes'){
                                                                                            $platform_files_array = explode(',', $platform_files);                                        
                                                                                            foreach ($platform_files_array as $cpf) {
                                                                                            ?>
                                                                                                <li class="search-list" onclick="return PreviewContentFile('<?php echo $cpf; ?>',<?php echo $platform_id;?>)"><i class="text-d mdi mdi-file-document"></i> <?php echo $cpf; ?></li>
                                                                                            <?php
                                                                                            }                                            
                                                                                        }
                                                                                        if($doc_pc_files && $agp->cp_file_it == 'yes'){
                                                                                            $doc_pc_files_array = explode(',', $doc_pc_files);
                                                                                            foreach ($doc_pc_files_array as $dcpf) {
                                                                                            ?>
                                                                                                <li class="search-list" onclick="return PreviewContentFile('<?php echo $dcpf; ?>',<?php echo $platform_id;?>)"><i class="text-d mdi mdi-file-document"></i> <?php echo $dcpf; ?></li>
                                                                                            <?php
                                                                                            }
                                                                                        } 
                                                                                        ?>
                                                                                        </ul>
                                                                                        <?php                                   
                                                                                    }
                                                                                    ?>
                                                                                    </li>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </ul>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </li>
                                                                    <?php
                                                                    $project_files = $this->Front_model->getProjectfilesbyPid($project_id);
                                                                    if($project_files && $project_file_it == 'yes'){
                                                                        foreach ($project_files as $pf) {
                                                                            ?>
                                                                            <li class="search-list" onclick="return previewModalFullscreen(<?php echo $pf->pfile_id;?>)"><i class="text-d mdi mdi-file-document"></i> <?php echo $pf->pfile; ?></li>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </ul>
                                                            </li>
                                                            <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                    <?php
                                                }
                                                if($file_itGoalProject2){
                                                    ?>
                                                    <ul>
                                                        <?php
                                                        foreach ($file_itGoalProject2 as $ffgp) {
                                                            $project_id = $ffgp->pid;
                                                            $fgp = $this->Front_model->file_itProjectDetail2($project_id);
                                                            $project_file_it = $fgp->project_file_it;
                                                            $goal_task_count = $this->Front_model->file_itTasksCountProjectWise($portfolio_id,$department_id,$project_id); 
                                                            $goal_platform_count = $this->Front_model->file_itPlatformCountProjectWise($portfolio_id,$department_id,$project_id); 
                                                            ?>
                                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-5"></i> <?php echo $fgp->pname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return ProjectOverviewModal(<?php echo $project_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                <ul>
                                                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-6"></i> Tasks (<?php echo $goal_task_count; ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                                        <?php
                                                                        $file_itGoalTask = $this->Front_model->file_itTasksProjectWise($portfolio_id,$department_id,$project_id); 
                                                                        if($file_itGoalTask){
                                                                            ?>
                                                                            <ul>
                                                                                <?php
                                                                                foreach ($file_itGoalTask as $fgt) {
                                                                                    $task_id = $fgt->tid;
                                                                                    $goal_subtask_count = $this->Front_model->file_itSubtaskCountTaskWise($portfolio_id,$department_id,$task_id); 
                                                                                    ?>
                                                                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-7"></i> <?php echo $fgt->tname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return TaskOverviewModal(<?php echo $task_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                                        <ul>
                                                                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-8"></i> Subtasks (<?php echo $goal_subtask_count; ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                                                                <?php
                                                                                                $file_itGoalSubtask = $this->Front_model->file_itSubtasksTaskWise($portfolio_id,$department_id,$task_id); 
                                                                                                if($file_itGoalSubtask){
                                                                                                    ?>
                                                                                                    <ul>
                                                                                                        <?php
                                                                                                        foreach ($file_itGoalSubtask as $fgst) {
                                                                                                            $subtask_id = $fgst->stid;
                                                                                                            ?>
                                                                                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-9"></i> <?php echo $fgst->stname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return SubtaskOverviewModal(<?php echo $subtask_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                                                            <?php
                                                                                                            $subtask_files = $fgst->stfile;
                                                                                                            if($subtask_files && $fgst->subtask_file_it == 'yes'){
                                                                                                                $subtask_files_array = explode(',', $subtask_files);
                                                                                                                ?>
                                                                                                                <ul>
                                                                                                                    <?php
                                                                                                                    foreach ($subtask_files_array as $stf) {
                                                                                                                    ?>
                                                                                                                        <li class="search-list" onclick="return PreviewSubtaskFile('<?php echo $stf;?>','<?php echo $subtask_id;?>')"><i class="text-d mdi mdi-file-document"></i> <?php echo $stf; ?></li>
                                                                                                                    <?php
                                                                                                                    }
                                                                                                                    ?>
                                                                                                                </ul>
                                                                                                                <?php
                                                                                                            }
                                                                                                            ?>
                                                                                                            </li>
                                                                                                            <?php
                                                                                                        }
                                                                                                        ?>
                                                                                                    </ul>
                                                                                                    <?php
                                                                                                }
                                                                                                ?>
                                                                                            </li>
                                                                                            <?php
                                                                                            $task_files = $fgt->tfile;
                                                                                            $task_files_array = explode(',', $task_files);
                                                                                            if($task_files && $fgt->task_file_it == 'yes'){
                                                                                                foreach ($task_files_array as $tf) {
                                                                                                ?>
                                                                                                    <li class="search-list" onclick="return PreviewTaskFile('<?php echo $tf;?>','<?php echo $task_id;?>')"><i class="text-d mdi mdi-file-document"></i> <?php echo $tf; ?></li>
                                                                                                <?php
                                                                                                }
                                                                                            }
                                                                                            ?>
                                                                                        </ul>
                                                                                    </li>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </ul>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </li>
                                                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-6"></i> Content (<?php echo $goal_platform_count; ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                                        <?php
                                                                        $file_itGoalPlatform = $this->Front_model->file_itPlatformProjectWise($portfolio_id,$department_id,$project_id);
                                                                        if($file_itGoalPlatform){
                                                                            ?>
                                                                            <ul>
                                                                                <?php
                                                                                foreach ($file_itGoalPlatform as $agp) {
                                                                                    $platform_id = $agp->pc_id;                           
                                                                                    ?>
                                                                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-7"></i> 
                                                                                        <?php
                                                                                        if($agp->platform == 'twitter')
                                                                                        {
                                                                                            echo '<i class="fab fa-twitter font-size-18 social-d mr-0" title="Twitter"></i>';
                                                                                        }else if($agp->platform == 'facebook')
                                                                                        {
                                                                                            echo '<i class="fab fa-facebook font-size-18 social-d mr-0" title="Facebook"></i>';
                                                                                        }else if($agp->platform == 'instagram')
                                                                                        {
                                                                                            echo '<i class="fab fa-instagram font-size-18 social-d mr-0" title="Instagram"></i>';
                                                                                        }else if($agp->platform == 'linkedin')
                                                                                        {
                                                                                            echo '<i class="fab fa-linkedin font-size-18 social-d mr-0" title="LinkedIn"></i>';
                                                                                        }else if($agp->platform == 'google-my-business')
                                                                                        {
                                                                                            echo '<i class="mdi mdi-google-my-business font-size-18 social-d mr-0" title="Google My Business"></i>';
                                                                                        }else if($agp->platform == 'pinterest')
                                                                                        {
                                                                                            echo '<i class="fab fa-pinterest font-size-18 social-d mr-0" title="Pinterest"></i>';
                                                                                        }else if($agp->platform == 'youtube')
                                                                                        {
                                                                                            echo '<i class="fab fa-youtube font-size-18 social-d mr-0" title="YouTube"></i>';
                                                                                        }else if($agp->platform == 'blogger')
                                                                                        {
                                                                                            echo '<i class="fab fa-blogger font-size-18 social-d mr-0" title="Blog"></i>';
                                                                                        }else if($agp->platform == 'tiktok')
                                                                                        {
                                                                                            echo '<i class="fab fa-tiktok font-size-18 social-d mr-0" title="TikTok"></i>';
                                                                                        }else{
                                                                                            echo $agp->platform;
                                                                                        }
                                                                                        ?>
                                                                                     <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return show_platform_modal('file-cabinet','<?php echo $agp->platform; ?>',<?php echo $platform_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                                    <?php
                                                                                    $platform_files = $agp->pc_file;
                                                                                    $doc_pc_files = $agp->doc_pc_file;
                                                                                    if($platform_files || $doc_pc_files){
                                                                                        ?>
                                                                                        <ul>
                                                                                        <?php
                                                                                        if($platform_files && $agp->cp_file_it == 'yes'){
                                                                                            $platform_files_array = explode(',', $platform_files);                                        
                                                                                            foreach ($platform_files_array as $cpf) {
                                                                                            ?>
                                                                                                <li class="search-list" onclick="return PreviewContentFile('<?php echo $cpf; ?>',<?php echo $platform_id;?>)"><i class="text-d mdi mdi-file-document"></i> <?php echo $cpf; ?></li>
                                                                                            <?php
                                                                                            }                                            
                                                                                        }
                                                                                        if($doc_pc_files && $agp->cp_file_it == 'yes'){
                                                                                            $doc_pc_files_array = explode(',', $doc_pc_files);
                                                                                            foreach ($doc_pc_files_array as $dcpf) {
                                                                                            ?>
                                                                                                <li class="search-list" onclick="return PreviewContentFile('<?php echo $dcpf; ?>',<?php echo $platform_id;?>)"><i class="text-d mdi mdi-file-document"></i> <?php echo $dcpf; ?></li>
                                                                                            <?php
                                                                                            }
                                                                                        } 
                                                                                        ?>
                                                                                        </ul>
                                                                                        <?php                                   
                                                                                    }
                                                                                    ?>
                                                                                    </li>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </ul>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </li>
                                                                    <?php
                                                                    $project_files = $this->Front_model->getProjectfilesbyPid($project_id);
                                                                    if($project_files && $project_file_it == 'yes'){
                                                                        foreach ($project_files as $pf) {
                                                                            ?>
                                                                            <li class="search-list" onclick="return previewModalFullscreen(<?php echo $pf->pfile_id;?>)"><i class="text-d mdi mdi-file-document"></i> <?php echo $pf->pfile; ?></li>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </ul>
                                                            </li>
                                                            <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                    <?php
                                                }
                                                ?>
                                            </li>
                                        </ul>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                            <?php
                        }
                        ?>
                    </li>
                    <li class="project-wise search-list" id="project-<?php echo $deptcnt; ?>"><i class="mdi mdi-folder-multiple text-green-1"></i> Projects (<?php echo intval($project_count1)+intval($project_count2); ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                        <?php
                        $file_itProjects1 = $this->Front_model->file_itProjectsDeptWise($portfolio_id,$department_id);                    
                        $file_itProjects2 = $this->Front_model->file_itAcceptedProjectsDeptWise($portfolio_id,$department_id);                    
                        if($file_itProjects1){
                            ?>
                            <ul>
                                <?php
                                foreach ($file_itProjects1 as $ap) {  
                                    $project_id = $ap->pid;
                                    $project_file_it = $ap->project_file_it;
                                    $goal_task_count = $this->Front_model->file_itTasksCountProjectWise($portfolio_id,$department_id,$project_id); 
                                    $goal_platform_count = $this->Front_model->file_itPlatformCountProjectWise($portfolio_id,$department_id,$project_id);                          
                                    ?>
                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-2"></i> <?php echo $ap->pname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return ProjectOverviewModal(<?php echo $project_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                        <ul>
                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-3"></i> Tasks (<?php echo $goal_task_count; ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                <?php
                                                $file_itGoalTask = $this->Front_model->file_itTasksProjectWise($portfolio_id,$department_id,$project_id); 
                                                if($file_itGoalTask){
                                                    ?>
                                                    <ul>
                                                        <?php
                                                        foreach ($file_itGoalTask as $fgt) {
                                                            $task_id = $fgt->tid;
                                                            $goal_subtask_count = $this->Front_model->file_itSubtaskCountTaskWise($portfolio_id,$department_id,$task_id); 
                                                            ?>
                                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-4"></i> <?php echo $fgt->tname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return TaskOverviewModal(<?php echo $task_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                <ul>
                                                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-5"></i> Subtasks (<?php echo $goal_subtask_count; ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                                        <?php
                                                                        $file_itGoalSubtask = $this->Front_model->file_itSubtasksTaskWise($portfolio_id,$department_id,$task_id); 
                                                                        if($file_itGoalSubtask){
                                                                            ?>
                                                                            <ul>
                                                                                <?php
                                                                                foreach ($file_itGoalSubtask as $fgst) {
                                                                                    $subtask_id = $fgst->stid;
                                                                                    ?>
                                                                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-6"></i> <?php echo $fgst->stname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return SubtaskOverviewModal(<?php echo $subtask_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                                    <?php
                                                                                    $subtask_files = $fgst->stfile;
                                                                                    if($subtask_files && $fgst->subtask_file_it == 'yes'){
                                                                                        $subtask_files_array = explode(',', $subtask_files);
                                                                                        ?>
                                                                                        <ul>
                                                                                            <?php
                                                                                            foreach ($subtask_files_array as $stf) {
                                                                                            ?>
                                                                                                <li class="search-list" onclick="return PreviewSubtaskFile('<?php echo $stf;?>','<?php echo $subtask_id;?>')"><i class="text-d mdi mdi-file-document"></i> <?php echo $stf; ?></li>
                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                        </ul>
                                                                                        <?php
                                                                                    }
                                                                                    ?>
                                                                                    </li>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </ul>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </li>
                                                                    <?php
                                                                    $task_files = $fgt->tfile;
                                                                    $task_files_array = explode(',', $task_files);
                                                                    if($task_files && $fgt->task_file_it == 'yes'){
                                                                        foreach ($task_files_array as $tf) {
                                                                        ?>
                                                                            <li class="search-list" onclick="return PreviewTaskFile('<?php echo $tf;?>','<?php echo $task_id;?>')"><i class="text-d mdi mdi-file-document"></i> <?php echo $tf; ?></li>
                                                                        <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </ul>
                                                            </li>
                                                            <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                    <?php
                                                }
                                                ?>
                                            </li>
                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-3"></i> Content (<?php echo $goal_platform_count; ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                <?php
                                                $file_itGoalPlatform = $this->Front_model->file_itPlatformProjectWise($portfolio_id,$department_id,$project_id);
                                                if($file_itGoalPlatform){
                                                    ?>
                                                    <ul>
                                                        <?php
                                                        foreach ($file_itGoalPlatform as $agp) { $platform_id = $agp->pc_id;
                                                            ?>
                                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-4"></i> 
                                                                <?php
                                                                if($agp->platform == 'twitter')
                                                                {
                                                                    echo '<i class="fab fa-twitter font-size-18 social-d mr-0" title="Twitter"></i>';
                                                                }else if($agp->platform == 'facebook')
                                                                {
                                                                    echo '<i class="fab fa-facebook font-size-18 social-d mr-0" title="Facebook"></i>';
                                                                }else if($agp->platform == 'instagram')
                                                                {
                                                                    echo '<i class="fab fa-instagram font-size-18 social-d mr-0" title="Instagram"></i>';
                                                                }else if($agp->platform == 'linkedin')
                                                                {
                                                                    echo '<i class="fab fa-linkedin font-size-18 social-d mr-0" title="LinkedIn"></i>';
                                                                }else if($agp->platform == 'google-my-business')
                                                                {
                                                                    echo '<i class="mdi mdi-google-my-business font-size-18 social-d mr-0" title="Google My Business"></i>';
                                                                }else if($agp->platform == 'pinterest')
                                                                {
                                                                    echo '<i class="fab fa-pinterest font-size-18 social-d mr-0" title="Pinterest"></i>';
                                                                }else if($agp->platform == 'youtube')
                                                                {
                                                                    echo '<i class="fab fa-youtube font-size-18 social-d mr-0" title="YouTube"></i>';
                                                                }else if($agp->platform == 'blogger')
                                                                {
                                                                    echo '<i class="fab fa-blogger font-size-18 social-d mr-0" title="Blog"></i>';
                                                                }else if($agp->platform == 'tiktok')
                                                                {
                                                                    echo '<i class="fab fa-tiktok font-size-18 social-d mr-0" title="TikTok"></i>';
                                                                }else{
                                                                    echo $agp->platform;
                                                                }
                                                                ?>
                                                             <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return show_platform_modal('file-cabinet','<?php echo $agp->platform; ?>',<?php echo $platform_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                            <?php
                                                            $platform_files = $agp->pc_file;
                                                            $doc_pc_files = $agp->doc_pc_file;
                                                            if($platform_files || $doc_pc_files){
                                                                ?>
                                                                <ul>
                                                                <?php
                                                                if($platform_files && $agp->cp_file_it == 'yes'){
                                                                    $platform_files_array = explode(',', $platform_files);                                        
                                                                    foreach ($platform_files_array as $cpf) {
                                                                    ?>
                                                                        <li class="search-list" onclick="return PreviewContentFile('<?php echo $cpf; ?>',<?php echo $platform_id;?>)"><i class="text-d mdi mdi-file-document"></i> <?php echo $cpf; ?></li>
                                                                    <?php
                                                                    }                                            
                                                                }
                                                                if($doc_pc_files && $agp->cp_file_it == 'yes'){
                                                                    $doc_pc_files_array = explode(',', $doc_pc_files);
                                                                    foreach ($doc_pc_files_array as $dcpf) {
                                                                    ?>
                                                                        <li class="search-list" onclick="return PreviewContentFile('<?php echo $dcpf; ?>',<?php echo $platform_id;?>)"><i class="text-d mdi mdi-file-document"></i> <?php echo $dcpf; ?></li>
                                                                    <?php
                                                                    }
                                                                } 
                                                                ?>
                                                                </ul>
                                                                <?php                                   
                                                            }
                                                            ?>
                                                            </li>
                                                            <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                    <?php
                                                }
                                                ?>
                                            </li>
                                            <?php
                                            $project_files = $this->Front_model->getProjectfilesbyPid($project_id);
                                            if($project_files && $project_file_it == 'yes'){
                                                foreach ($project_files as $pf) {
                                                    ?>
                                                    <li class="search-list" onclick="return previewModalFullscreen(<?php echo $pf->pfile_id;?>)"><i class="text-d mdi mdi-file-document"></i> <?php echo $pf->pfile; ?></li>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                            <?php
                        }
                        if($file_itProjects2){
                            ?>
                            <ul>
                                <?php
                                foreach ($file_itProjects2 as $aap) {  
                                    $project_id = $aap->pid;
                                    $ap = $this->Front_model->file_itProjectDetail2($project_id);
                                    $project_file_it = $ap->project_file_it;
                                    $goal_task_count = $this->Front_model->file_itTasksCountProjectWise($portfolio_id,$department_id,$project_id); 
                                    $goal_platform_count = $this->Front_model->file_itPlatformCountProjectWise($portfolio_id,$department_id,$project_id);                          
                                    ?>
                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-2"></i> <?php echo $ap->pname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return ProjectOverviewModal(<?php echo $project_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                        <ul>
                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-3"></i> Tasks (<?php echo $goal_task_count; ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                <?php
                                                $file_itGoalTask = $this->Front_model->file_itTasksProjectWise($portfolio_id,$department_id,$project_id); 
                                                if($file_itGoalTask){
                                                    ?>
                                                    <ul>
                                                        <?php
                                                        foreach ($file_itGoalTask as $fgt) {
                                                            $task_id = $fgt->tid;
                                                            $goal_subtask_count = $this->Front_model->file_itSubtaskCountTaskWise($portfolio_id,$department_id,$task_id); 
                                                            ?>
                                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-4"></i> <?php echo $fgt->tname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return TaskOverviewModal(<?php echo $task_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                <ul>
                                                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-5"></i> Subtasks (<?php echo $goal_subtask_count; ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                                        <?php
                                                                        $file_itGoalSubtask = $this->Front_model->file_itSubtasksTaskWise($portfolio_id,$department_id,$task_id); 
                                                                        if($file_itGoalSubtask){
                                                                            ?>
                                                                            <ul>
                                                                                <?php
                                                                                foreach ($file_itGoalSubtask as $fgst) {
                                                                                    $subtask_id = $fgst->stid;
                                                                                    ?>
                                                                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-6"></i> <?php echo $fgst->stname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return SubtaskOverviewModal(<?php echo $subtask_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                                    <?php
                                                                                    $subtask_files = $fgst->stfile;
                                                                                    if($subtask_files && $fgst->subtask_file_it == 'yes'){
                                                                                        $subtask_files_array = explode(',', $subtask_files);
                                                                                        ?>
                                                                                        <ul>
                                                                                            <?php
                                                                                            foreach ($subtask_files_array as $stf) {
                                                                                            ?>
                                                                                                <li class="search-list" onclick="return PreviewSubtaskFile('<?php echo $stf;?>','<?php echo $subtask_id;?>')"><i class="text-d mdi mdi-file-document"></i> <?php echo $stf; ?></li>
                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                        </ul>
                                                                                        <?php
                                                                                    }
                                                                                    ?>
                                                                                    </li>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </ul>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </li>
                                                                    <?php
                                                                    $task_files = $fgt->tfile;
                                                                    $task_files_array = explode(',', $task_files);
                                                                    if($task_files && $fgt->task_file_it == 'yes'){
                                                                        foreach ($task_files_array as $tf) {
                                                                        ?>
                                                                            <li class="search-list" onclick="return PreviewTaskFile('<?php echo $tf;?>','<?php echo $task_id;?>')"><i class="text-d mdi mdi-file-document"></i> <?php echo $tf; ?></li>
                                                                        <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </ul>
                                                            </li>
                                                            <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                    <?php
                                                }
                                                ?>
                                            </li>
                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-3"></i> Content (<?php echo $goal_platform_count; ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                <?php
                                                $file_itGoalPlatform = $this->Front_model->file_itPlatformProjectWise($portfolio_id,$department_id,$project_id);
                                                if($file_itGoalPlatform){
                                                    ?>
                                                    <ul>
                                                        <?php
                                                        foreach ($file_itGoalPlatform as $agp) { $platform_id = $agp->pc_id;
                                                            ?>
                                                            <li class="search-list"><i class="mdi mdi-folder-multiple text-green-4"></i>
                                                            <?php
                                                                if($agp->platform == 'twitter')
                                                                {
                                                                    echo '<i class="fab fa-twitter font-size-18 social-d mr-0" title="Twitter"></i>';
                                                                }else if($agp->platform == 'facebook')
                                                                {
                                                                    echo '<i class="fab fa-facebook font-size-18 social-d mr-0" title="Facebook"></i>';
                                                                }else if($agp->platform == 'instagram')
                                                                {
                                                                    echo '<i class="fab fa-instagram font-size-18 social-d mr-0" title="Instagram"></i>';
                                                                }else if($agp->platform == 'linkedin')
                                                                {
                                                                    echo '<i class="fab fa-linkedin font-size-18 social-d mr-0" title="LinkedIn"></i>';
                                                                }else if($agp->platform == 'google-my-business')
                                                                {
                                                                    echo '<i class="mdi mdi-google-my-business font-size-18 social-d mr-0" title="Google My Business"></i>';
                                                                }else if($agp->platform == 'pinterest')
                                                                {
                                                                    echo '<i class="fab fa-pinterest font-size-18 social-d mr-0" title="Pinterest"></i>';
                                                                }else if($agp->platform == 'youtube')
                                                                {
                                                                    echo '<i class="fab fa-youtube font-size-18 social-d mr-0" title="YouTube"></i>';
                                                                }else if($agp->platform == 'blogger')
                                                                {
                                                                    echo '<i class="fab fa-blogger font-size-18 social-d mr-0" title="Blog"></i>';
                                                                }else if($agp->platform == 'tiktok')
                                                                {
                                                                    echo '<i class="fab fa-tiktok font-size-18 social-d mr-0" title="TikTok"></i>';
                                                                }else{
                                                                    echo $agp->platform;
                                                                }
                                                                ?> 
                                                             <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return show_platform_modal('file-cabinet','<?php echo $agp->platform; ?>',<?php echo $platform_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                            <?php
                                                            $platform_files = $agp->pc_file;
                                                            $doc_pc_files = $agp->doc_pc_file;
                                                            if($platform_files || $doc_pc_files){
                                                                ?>
                                                                <ul>
                                                                <?php
                                                                if($platform_files && $agp->cp_file_it == 'yes'){
                                                                    $platform_files_array = explode(',', $platform_files);                                        
                                                                    foreach ($platform_files_array as $cpf) {
                                                                    ?>
                                                                        <li class="search-list" onclick="return PreviewContentFile('<?php echo $cpf; ?>',<?php echo $platform_id;?>)"><i class="text-d mdi mdi-file-document"></i> <?php echo $cpf; ?></li>
                                                                    <?php
                                                                    }                                            
                                                                }
                                                                if($doc_pc_files && $agp->cp_file_it == 'yes'){
                                                                    $doc_pc_files_array = explode(',', $doc_pc_files);
                                                                    foreach ($doc_pc_files_array as $dcpf) {
                                                                    ?>
                                                                        <li class="search-list" onclick="return PreviewContentFile('<?php echo $dcpf; ?>',<?php echo $platform_id;?>)"><i class="text-d mdi mdi-file-document"></i> <?php echo $dcpf; ?></li>
                                                                    <?php
                                                                    }
                                                                } 
                                                                ?>
                                                                </ul>
                                                                <?php                                   
                                                            }
                                                            ?>
                                                            </li>
                                                            <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                    <?php
                                                }
                                                ?>
                                            </li>
                                            <?php
                                            $project_files = $this->Front_model->getProjectfilesbyPid($project_id);
                                            if($project_files && $project_file_it == 'yes'){
                                                foreach ($project_files as $pf) {
                                                    ?>
                                                    <li class="search-list" onclick="return previewModalFullscreen(<?php echo $pf->pfile_id;?>)"><i class="text-d mdi mdi-file-document"></i> <?php echo $pf->pfile; ?></li>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                            <?php
                        }
                        ?>
                    </li>
                    <li class="task-wise search-list" id="task-<?php echo $deptcnt; ?>"><i class="mdi mdi-folder-multiple text-green-1"></i> Tasks (<?php echo intval($task_count)+intval($single_task_count); ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                        <?php
                        $file_itTasks = $this->Front_model->file_itTasksDeptWise($portfolio_id,$department_id);
                        $file_itSingleTasks = $this->Front_model->file_itSingleTasksDeptWise($portfolio_id,$department_id);
                        if($file_itTasks || $file_itSingleTasks){
                            ?>
                            <ul>
                                <?php
                                if($file_itTasks){
                                    foreach ($file_itTasks as $at) {  
                                        $task_id = $at->tid;
                                        $task_subtask_count = $this->Front_model->file_itSubtaskCountTaskWise($portfolio_id,$department_id,$task_id);                           
                                        $task_single_subtask_count = $this->Front_model->file_itSingleSubtaskCountTaskWise($portfolio_id,$department_id,$task_id);                           
                                        ?>
                                        <li class="search-list"><i class="mdi mdi-folder-multiple text-green-2"></i> <?php echo $at->tname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return TaskOverviewModal(<?php echo $task_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                            <ul>
                                                <li class="search-list"><i class="mdi mdi-folder-multiple text-green-3"></i> Subtasks (<?php echo intval($task_subtask_count)+intval($task_single_subtask_count); ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                    <?php
                                                    $file_itGoalSubtask = $this->Front_model->file_itSubtasksTaskWise($portfolio_id,$department_id,$task_id); 
                                                    $file_itGoalSingleSubtask = $this->Front_model->file_itSingleSubtasksTaskWise($portfolio_id,$department_id,$task_id); 
                                                    if($file_itGoalSubtask || $file_itGoalSingleSubtask){
                                                        ?>
                                                        <ul>
                                                            <?php
                                                            if($file_itGoalSubtask){
                                                                foreach ($file_itGoalSubtask as $fgst) {
                                                                    $subtask_id = $fgst->stid;
                                                                    ?>
                                                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-4"></i> <?php echo $fgst->stname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return SubtaskOverviewModal(<?php echo $subtask_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                    <?php
                                                                    $subtask_files = $fgst->stfile;
                                                                    if($subtask_files && $fgst->subtask_file_it == 'yes'){
                                                                        $subtask_files_array = explode(',', $subtask_files);
                                                                        ?>
                                                                        <ul>
                                                                            <?php
                                                                            foreach ($subtask_files_array as $stf) {
                                                                            ?>
                                                                                <li class="search-list" onclick="return PreviewSubtaskFile('<?php echo $stf;?>','<?php echo $subtask_id;?>')"><i class="text-d mdi mdi-file-document"></i> <?php echo $stf; ?></li>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </ul>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    </li>
                                                                    <?php
                                                                }
                                                            }
                                                            if($file_itGoalSingleSubtask){
                                                                foreach ($file_itGoalSingleSubtask as $fgsst) {
                                                                    $subtask_id = $fgsst->stid;
                                                                    ?>
                                                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-4"></i> <?php echo $fgsst->stname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return SubtaskOverviewModal(<?php echo $subtask_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                    <?php
                                                                    $subtask_files = $fgsst->stfile;
                                                                    if($subtask_files && $fgsst->subtask_file_it == 'yes'){
                                                                        $subtask_files_array = explode(',', $subtask_files);
                                                                        ?>
                                                                        <ul>
                                                                            <?php
                                                                            foreach ($subtask_files_array as $stf) {
                                                                            ?>
                                                                                <li class="search-list" onclick="return PreviewSubtaskFile('<?php echo $stf;?>','<?php echo $subtask_id;?>')"><i class="text-d mdi mdi-file-document"></i> <?php echo $stf; ?></li>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </ul>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    </li>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </ul>
                                                        <?php
                                                    }
                                                    ?>
                                                </li>
                                                <?php
                                                $task_files = $at->tfile;
                                                $task_files_array = explode(',', $task_files);
                                                if($task_files && $at->task_file_it == 'yes'){
                                                    foreach ($task_files_array as $tf) {
                                                    ?>
                                                        <li class="search-list" onclick="return PreviewTaskFile('<?php echo $tf;?>','<?php echo $task_id;?>')"><i class="text-d mdi mdi-file-document"></i> <?php echo $tf; ?></li>
                                                    <?php
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </li>
                                        <?php
                                    }
                                }                    
                                if($file_itSingleTasks){
                                    foreach ($file_itSingleTasks as $asgt) {
                                        $task_id = $asgt->tid;
                                        $task_subtask_count = $this->Front_model->file_itSubtaskCountTaskWise($portfolio_id,$department_id,$task_id);                           
                                        ?>
                                        <li class="search-list"><i class="mdi mdi-folder-multiple text-green-2"></i> <?php echo $asgt->tname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return TaskOverviewModal(<?php echo $task_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                            <ul>
                                                <li class="search-list"><i class="mdi mdi-folder-multiple text-green-3"></i> Subtasks (<?php echo $task_subtask_count; ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                                                    <?php
                                                    $file_itGoalSubtask = $this->Front_model->file_itSubtasksTaskWise($portfolio_id,$department_id,$task_id); 
                                                    if($file_itGoalSubtask){
                                                        ?>
                                                        <ul>
                                                            <?php
                                                            foreach ($file_itGoalSubtask as $fgst) {
                                                                $subtask_id = $fgst->stid;
                                                                ?>
                                                                <li class="search-list"><i class="mdi mdi-folder-multiple text-green-4"></i> <?php echo $fgst->stname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return SubtaskOverviewModal(<?php echo $subtask_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                                                <?php
                                                                $subtask_files = $fgst->stfile;
                                                                if($subtask_files && $fgst->subtask_file_it == 'yes'){
                                                                    $subtask_files_array = explode(',', $subtask_files);
                                                                    ?>
                                                                    <ul>
                                                                        <?php
                                                                        foreach ($subtask_files_array as $stf) {
                                                                        ?>
                                                                            <li class="search-list" onclick="return PreviewSubtaskFile('<?php echo $stf;?>','<?php echo $subtask_id;?>')"><i class="text-d mdi mdi-file-document"></i> <?php echo $stf; ?></li>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                    <?php
                                                                }
                                                                ?>
                                                                </li>
                                                                <?php
                                                            }
                                                            ?>
                                                        </ul>
                                                        <?php
                                                    }
                                                    ?>
                                                </li>
                                                <?php
                                                $task_files = $asgt->tfile;
                                                $task_files_array = explode(',', $task_files);
                                                if($task_files && $asgt->task_file_it == 'yes'){
                                                    foreach ($task_files_array as $tf) {
                                                    ?>
                                                        <li class="search-list" onclick="return PreviewTaskFile('<?php echo $tf;?>','<?php echo $task_id;?>')"><i class="text-d mdi mdi-file-document"></i> <?php echo $tf; ?></li>
                                                    <?php
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                            <?php
                        }                
                        ?>
                    </li>
                    <li class="subtask-wise search-list" id="subtask-<?php echo $deptcnt; ?>"><i class="mdi mdi-folder-multiple text-green-1"></i> Subtasks (<?php echo intval($subtask_count)+intval($single_subtask_count); ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                        <?php
                        $file_itSubtasks = $this->Front_model->file_itSubtasksDeptWise($portfolio_id,$department_id);
                        $file_itSingleSubtasks = $this->Front_model->file_itSingleSubtasksDeptWise($portfolio_id,$department_id);
                        if($file_itSubtasks || $file_itSingleSubtasks){
                            ?>
                            <ul>
                                <?php
                                if($file_itSubtasks){
                                    foreach ($file_itSubtasks as $ast) {   
                                        $subtask_id = $ast->stid;                         
                                        ?>
                                        <li class="search-list"><i class="mdi mdi-folder-multiple text-green-2"></i> <?php echo $ast->stname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return SubtaskOverviewModal(<?php echo $subtask_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                        <?php
                                        $subtask_files = $ast->stfile;
                                        if($subtask_files && $ast->subtask_file_it == 'yes'){
                                            $subtask_files_array = explode(',', $subtask_files);
                                            ?>
                                            <ul>
                                                <?php
                                                foreach ($subtask_files_array as $stf) {
                                                ?>
                                                    <li class="search-list" onclick="return PreviewSubtaskFile('<?php echo $stf;?>','<?php echo $subtask_id;?>')"><i class="text-d mdi mdi-file-document"></i> <?php echo $stf; ?></li>
                                                <?php
                                                }
                                                ?>
                                            </ul>
                                            <?php
                                        }
                                        ?>
                                        </li>
                                        <?php
                                    }
                                }
                                if($file_itSingleSubtasks){
                                    foreach ($file_itSingleSubtasks as $asgst) {
                                        $subtask_id = $asgst->stid;                        
                                        ?>
                                        <li class="search-list"><i class="mdi mdi-folder-multiple text-green-2"></i> <?php echo $asgst->stname; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return SubtaskOverviewModal(<?php echo $subtask_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                        <?php
                                        $subtask_files = $asgst->stfile;
                                        if($subtask_files && $asgst->subtask_file_it == 'yes'){
                                            $subtask_files_array = explode(',', $subtask_files);
                                            ?>
                                            <ul>
                                                <?php
                                                foreach ($subtask_files_array as $stf) {
                                                ?>
                                                    <li class="search-list" onclick="return PreviewSubtaskFile('<?php echo $stf;?>','<?php echo $subtask_id;?>')"><i class="text-d mdi mdi-file-document"></i> <?php echo $stf; ?></li>
                                                <?php
                                                }
                                                ?>
                                            </ul>
                                            <?php
                                        }
                                        ?>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                            <?php
                        }                
                        ?>
                    </li>
                    <!-- <li class="platform-wise search-list" id="platform-<?php echo $deptcnt; ?>"><i class="mdi mdi-folder-multiple text-green-1"></i> Content (<?php echo $platform_count; ?>) <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div>
                        <?php
                        $file_itPlatform = $this->Front_model->file_itPlatformDeptWise($portfolio_id,$department_id);
                        if($file_itPlatform){
                            ?>
                            <ul>
                                <?php
                                foreach ($file_itPlatform as $acp) {   
                                    $platform_id = $acp->pc_id;                         
                                    ?>
                                    <li class="search-list"><i class="mdi mdi-folder-multiple text-green-2"></i> <?php echo $acp->platform; ?> <div class="arrow"><i class="mdi mdi-plus-box-outline"></i></div> <a title="Overview" href="javascript:void(0);" onclick="return show_platform_modal('file-cabinet','<?php echo $acp->platform; ?>',<?php echo $platform_id;?>)"><i class="mdi mdi-eye-outline text-d"></i></a>
                                    <?php
                                    $platform_files = $acp->pc_file;
                                    $doc_pc_files = $acp->doc_pc_file;
                                    if($platform_files || $doc_pc_files){
                                        ?>
                                        <ul>
                                        <?php
                                        if($platform_files && $acp->cp_file_it == 'yes'){
                                            $platform_files_array = explode(',', $platform_files);                                        
                                            foreach ($platform_files_array as $cpf) {
                                            ?>
                                                <li class="search-list" onclick="return PreviewContentFile('<?php echo $cpf; ?>',<?php echo $platform_id;?>)"><i class="text-d mdi mdi-file-document"></i> <?php echo $cpf; ?></li>
                                            <?php
                                            }                                            
                                        }
                                        if($doc_pc_files && $acp->cp_file_it == 'yes'){
                                            $doc_pc_files_array = explode(',', $doc_pc_files);
                                            foreach ($doc_pc_files_array as $dcpf) {
                                            ?>
                                                <li class="search-list" onclick="return PreviewContentFile('<?php echo $dcpf; ?>',<?php echo $platform_id;?>)"><i class="text-d mdi mdi-file-document"></i> <?php echo $dcpf; ?></li>
                                            <?php
                                            }
                                        } 
                                        ?>
                                        </ul>
                                        <?php                                   
                                    }
                                    ?>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                            <?php
                        }
                        ?>
                    </li> -->
                </ul>
            </li>
            <?php 
            $deptcnt++;
        }
    }
?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show active" id="v-pills-grid" role="tabpanel" aria-labelledby="v-pills-grid-tab">
                                <div class="row">
                                    <div class="search-cards">
                                        <div id="show-department" class="row folder-tree-wrapper">
                                            <?php
                                            if($activeDepartments){
                                                $deptcnt=1;
                                                foreach ($activeDepartments as $dept) {
                                                    $portfolio_id = $dept->portfolio_id;
                                                    $department_id = $dept->portfolio_dept_id;
                                                    $goals_count1 = $this->Front_model->file_itGoalsCountDeptWise($portfolio_id,$department_id);
                                                    $goals_count2 = $this->Front_model->file_itAcceptedGoalsCountDeptWise($portfolio_id,$department_id);

                                                    $strategies_count1 = $this->Front_model->file_itStrategiesCountDeptWise($portfolio_id,$department_id);
                                                    $strategies_count2 = $this->Front_model->file_itAcceptedStrategiesCountDeptWise($portfolio_id,$department_id);

                                                    $project_count1 = $this->Front_model->file_itProjectCountDeptWise($portfolio_id,$department_id);
                                                    $project_count2 = $this->Front_model->file_itAcceptedProjectCountDeptWise($portfolio_id,$department_id);

                                                    $task_count = $this->Front_model->file_itTaskCountDeptWise($portfolio_id,$department_id);
                                                    $single_task_count = $this->Front_model->file_itSingleTaskCountDeptWise($portfolio_id,$department_id);

                                                    $subtask_count = $this->Front_model->file_itSubtaskCountDeptWise($portfolio_id,$department_id);
                                                    $single_subtask_count = $this->Front_model->file_itSingleSubtaskCountDeptWise($portfolio_id,$department_id);

                                                    $platform_count = $this->Front_model->file_itPlatformCountDeptWise($portfolio_id,$department_id);
                                                    $dept_del = $this->Front_model->get_PDepartment($department_id);

                                                    $total_count = intval($project_count1)+intval($project_count2)+intval($task_count)+intval($single_task_count)+intval($subtask_count)+intval($single_subtask_count)+intval($goals_count1)+intval($goals_count2)+intval($strategies_count1)+intval($strategies_count2);
                                                    ?>
                                                   <div class="col-xl-4 col-sm-6 search-cards">
                                                        <div class="card border shadow-none mb-2 btn-outline-light">
                                                            <a href="#" onclick="return show_module_folders(<?php echo $portfolio_id; ?>,<?php echo $department_id; ?>,<?php echo $deptcnt; ?>,'department');" class="text-body">
                                                                <div class="p-2">
                                                                    <div class="d-flex">
                                                                        <div class="btn btn-light waves-effect avatar-xs align-self-center me-2">
                                                                            <div class="avatar-title rounded bg-transparent text-dark font-size-20">
                                                                                <i class="mdi mdi-folder-multiple-outline"></i>
                                                                            </div>
                                                                        </div>

                                                                        <div class="overflow-hidden me-auto">
                                                                            <h5 style="font-weight: 600" class="font-size-14 text-truncate mb-1"><?php echo $dept->department; ?></h5>
                                                                            <p class="text-muted text-truncate mb-0"><?php echo $total_count; ?> Folder(s)</p>
                                                                        </div>

                                                                        <div class="ms-2">
                                                                            <p class="text-muted"></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>              
                                                    </div>
                                                <?php 
                                                $deptcnt++;
                                                }
                                            }
                                            ?>
                                        </div>
                                        <div id="show-module_folders"></div>
                                        <div id="show-goal"></div>
                                        <div id="show-kpi"></div>
                                        <div id="show-project"></div>
                                        <div id="show-task_cp_folders"></div>
                                        <div id="show-task"></div>
                                        <div id="show-subtask"></div>
                                        <div id="show-subtask_files"></div>
                                        <div id="show-cp"></div>
                                        <div id="show-cp_files"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->
            </div>
            <!-- end w-100 -->
        </div>
    </div>

    <div class="card filemanager-sidebar ms-lg-2">
        <div class="card-body">
            <!--<div class="text-center">
                <h5 class="font-size-15 mb-4">Storage</h5>
                <div class="apex-charts" id="radial-chart"></div>

                <p class="text-muted mt-4">48.02 GB (76%) of 64 GB used</p>
            </div>-->

            <div>
                <h5 class="font-size-15">Recent Files</h5>

                <?php
                if(isset($_COOKIE["d168_selectedportfolio"]))
                {
                    $portfolio_id = $_COOKIE["d168_selectedportfolio"];
                    $task_files = $this->Front_model->task_5Files($portfolio_id);
                    $single_task_files = $this->Front_model->singleTask_5Files($portfolio_id);
                    $subtask_files = $this->Front_model->subtask_5Files($portfolio_id);
                    $single_subtask_files = $this->Front_model->singleSubtask_5Files($portfolio_id);
                    $platform_files = $this->Front_model->platform_5Files($portfolio_id);
                    $project_files = $this->Front_model->project_5Files($portfolio_id);
                    foreach ($task_files as $tf) {
                        $tf->file_type = 'task';
                    }
                    foreach ($single_task_files as $stf) {
                        $stf->file_type = 'task';
                    }
                    foreach ($subtask_files as $sbtf) {
                        $sbtf->file_type = 'subtask';
                    }
                    foreach ($single_subtask_files as $ssbtf) {
                        $ssbtf->file_type = 'subtask';
                    }
                    foreach ($platform_files as $plf) {
                        $plf->file_type = 'content';
                    }
                    foreach ($project_files as $pf) {
                        $pf->file_type = 'project';
                    }

                    $merged_data =  array_merge($task_files,$single_task_files,$subtask_files,$single_subtask_files,$platform_files,$project_files);
                    if($merged_data){
                        $file_date = array_column($merged_data, 'file_date');
                        array_multisort($file_date, SORT_DESC, $merged_data);
                        $filecnt=1;
                        foreach ($merged_data as $md) {                            
                            $name_array = explode(',', $md->file_name);
                            foreach ($name_array as $na) {
                                if($filecnt <= 5){
                                    ?>
                                    <div class="card border shadow-none mb-2">
                                        <?php
                                        if($md->file_type == 'project')
                                        {
                                            ?>
                                            <a href="javascript:void(0);" onclick="return previewModalFullscreen(<?php echo $md->file_id;?>);" class="text-body">
                                            <?php
                                        }
                                        else if($md->file_type == 'task')
                                        {
                                            ?>
                                            <a href="javascript:void(0);" onclick="return PreviewTaskFile('<?php echo $na; ?>',<?php echo $md->file_id;?>);" class="text-body">
                                            <?php
                                        }
                                        else if($md->file_type == 'subtask')
                                        {
                                            ?>
                                            <a href="javascript:void(0);" onclick="return PreviewSubtaskFile('<?php echo $na; ?>',<?php echo $md->file_id;?>);" class="text-body">
                                            <?php
                                        }
                                        else if($md->file_type == 'content')
                                        {
                                            ?>
                                            <a href="javascript:void(0);" onclick="return PreviewContentFile('<?php echo $na; ?>',<?php echo $md->file_id;?>);" class="text-body">
                                            <?php
                                        }
                                        ?>                                        
                                            <div class="p-2">
                                                <div class="d-flex">
                                                    <div class="avatar-xs align-self-center me-2">
                                                        <div class="avatar-title rounded bg-transparent text-green-0 font-size-20">
                                                            <i class="mdi mdi-file-document"></i>
                                                        </div>
                                                    </div>

                                                    <div class="overflow-hidden me-auto">
                                                        <h5 title="<?php echo $na; ?>" class="font-size-13 text-truncate mb-1"><?php echo $na; ?></h5>
                                                        <p class="text-d text-truncate mb-0"><?php echo ucfirst($md->file_type); ?></p>
                                                        <!-- <p class="text-muted text-truncate mb-0"><?php echo ucfirst($md->file_date); ?></p> -->
                                                    </div>

                                                    <div class="ms-2">
                                                        <p class="text-muted"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <?php
                                }
                                $filecnt++;
                            }                          
                        }
                    }
                }                
                ?>
            </div>
        </div>
    </div>
</div><!-- end row -->                        
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

        <!-- Goal Overview Modal -->
        <div id="GoalOverviewModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#GoalOverviewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="GoalOverviewModal_content">
                    
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Goal Overview Accepted Modal -->
        <div id="GoalOverviewAcceptedModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#GoalOverviewAcceptedModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="GoalOverviewAcceptedModal_content">
                    
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Goal Overview Request Modal -->
        <div id="GoalOverviewRequestModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#GoalOverviewRequestModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="GoalOverviewRequestModal_content">
                    
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Goal Edit Modal -->
        <div id="GoalEditModal" class="modal fade bs-example-modal-lg" aria-labelledby="#GoalEditModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="GoalEditModal_content">
                    
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Strategies Overview Modal -->
        <div id="StrategiesOverviewModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#StrategiesOverviewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="StrategiesOverviewModal_content">
                    
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Strategies Edit Modal -->
        <div id="StrategiesEditModal" class="modal fade bs-example-modal-lg" aria-labelledby="#StrategiesEditModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="StrategiesEditModal_content">
                    
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Project Overview Modal -->
        <div id="ProjectOverviewModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#ProjectOverviewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="ProjectOverviewModal_content">
                    
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Project Overview Accepted Modal -->
        <div id="ProjectOverviewAcceptedModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#ProjectOverviewAcceptedModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="ProjectOverviewAcceptedModal_content">
                    
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Project Overview Request Modal -->
        <div id="ProjectOverviewRequestModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#ProjectOverviewRequestModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="ProjectOverviewRequestModal_content">
                    
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Tasks Overview Modal -->
        <div id="TaskOverviewModal" class="modal fade bs-example-modal-xl" tabindex="-1" aria-labelledby="#TaskOverviewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content" id="TaskOverviewModal_content">
                    
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- Subtasks Overview Modal -->
        <div id="SubtaskOverviewModal" class="modal fade bs-example-modal-xl" tabindex="-1" aria-labelledby="#SubtaskOverviewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content" id="SubtaskOverviewModal_content">
                    
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- MODAL START PREVIEW PLATFORM -->
        <div class="modal fade preview-platform" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row platform-card twitter-card" style="display: none;">
                            <div class="col-md-12">
                                <div class="twitter-content"></div>
                                <div class="row">
                                    <div class="col-md-12 p-0">
                                        <div id="carouselTwitterIndicators" class="carousel slide" data-bs-ride="carousel">
                                            <ol class="carousel-indicators twitter-images-ol">
                                            </ol>
                                            <div class="carousel-inner twitter-images" role="listbox">
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselTwitterIndicators" role="button" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselTwitterIndicators" role="button" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="twitter-icon-card">
                                    <div class="twitter-icon text-center">
                                        <i aria-hidden="true" class="mdi mdi-comment-outline"></i> &nbsp; 0
                                    </div>
                                    <div class="twitter-icon text-center">
                                        <i aria-hidden="true" class="mdi mdi-twitter-retweet"></i> &nbsp; 0
                                    </div>
                                    <div class="twitter-icon text-center">
                                        <i aria-hidden="true" class="mdi mdi-heart-outline"></i> &nbsp; 0
                                    </div>
                                    <div class="twitter-icon text-center">
                                        <i aria-hidden="true" class="mdi mdi-export-variant"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row platform-card facebook-card" style="display: none;">
                            <div class="col-md-12">
                                <div class="facebook-content"></div>
                                <div class="row">
                                    <div class="col-md-12 p-0">
                                        <div id="carouselFBIndicators" class="carousel slide" data-bs-ride="carousel">
                                            <ol class="carousel-indicators facebook-images-ol">
                                            </ol>
                                            <div class="carousel-inner facebook-images" role="listbox">
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselFBIndicators" role="button" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselFBIndicators" role="button" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="facebook-icon-card">
                                    <div class="facebook-icon text-center">
                                        <i aria-hidden="true" class="mdi mdi-thumb-up-outline"></i> Like
                                    </div>
                                    <div class="facebook-icon text-center">
                                        <i aria-hidden="true" class="mdi mdi-chat-processing-outline"></i> Comment
                                    </div>
                                    <div class="facebook-icon text-center">
                                        <i aria-hidden="true" class="mdi mdi-share"></i> Share
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row platform-card instagram-card" style="display: none;">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12 p-0">
                                        <div id="carouselInstaIndicators" class="carousel slide" data-bs-ride="carousel">
                                            <ol class="carousel-indicators instagram-images-ol">
                                            </ol>
                                            <div class="carousel-inner instagram-images" role="listbox">
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselInstaIndicators" role="button" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselInstaIndicators" role="button" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="instagram-icon-card">
                                    <div class="instagram-icon text-center">
                                        <i aria-hidden="true" class="mdi mdi-heart-outline"></i>
                                    </div>
                                    <div class="instagram-icon text-center">
                                        <i aria-hidden="true" class="mdi mdi-chat-outline"></i>
                                    </div>
                                    <div class="instagram-icon text-center">
                                        <i aria-hidden="true" class="mdi mdi-send"></i>
                                    </div>
                                </div>
                                    <div class="instagram-icon text-center float-end">
                                        <i aria-hidden="true" class="mdi mdi-bookmark-outline"></i>
                                    </div>
                                <div class="instagram-content"></div>
                            </div>
                        </div>
                        <div class="row platform-card linkedin-card" style="display: none;">
                            <div class="col-md-12">
                                <div class="linkedin-content"></div>
                                <div class="row">
                                    <div class="col-md-12 p-0">
                                        <div id="carouselLIIndicators" class="carousel slide" data-bs-ride="carousel">
                                            <ol class="carousel-indicators linkedin-images-ol">
                                            </ol>
                                            <div class="carousel-inner linkedin-images" role="listbox">
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselLIIndicators" role="button" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselLIIndicators" role="button" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="linkedin-icon-card">
                                    <div class="linkedin-icon text-center">
                                        <i aria-hidden="true" class="mdi mdi-thumb-up-outline"></i> Like
                                    </div>
                                    <div class="linkedin-icon text-center">
                                        <i aria-hidden="true" class="mdi mdi-chat-processing-outline"></i> Comment
                                    </div>
                                    <div class="linkedin-icon text-center">
                                        <i aria-hidden="true" class="mdi mdi-share"></i> Share
                                    </div>
                                    <div class="linkedin-icon text-center">
                                        <i aria-hidden="true" class="mdi mdi-send"></i> Send
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row platform-card google-my-business-card" style="display: none;">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12 p-0">
                                        <div id="carouselGMBIndicators" class="carousel slide" data-bs-ride="carousel">
                                            <ol class="carousel-indicators google-my-business-images-ol">
                                            </ol>
                                            <div class="carousel-inner google-my-business-images" role="listbox">
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselGMBIndicators" role="button" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselGMBIndicators" role="button" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="google-my-business-content"></div>
                                <div class="google-my-business-icon-card">
                                    <div class="google-my-business-icon text-center">
                                        CTA
                                    </div>
                                </div>
                                <div class="text-center float-end" style="font-size: 18px;">
                                    <i aria-hidden="true" class="mdi mdi-share-variant"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row platform-card pinterest-card" style="display: none;">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12 p-0">
                                        <div id="carouselPinterestIndicators" class="carousel slide" data-bs-ride="carousel">
                                            <ol class="carousel-indicators pinterest-images-ol">
                                            </ol>
                                            <div class="carousel-inner pinterest-images" role="listbox">
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselPinterestIndicators" role="button" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselPinterestIndicators" role="button" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="pinterest-title"></div>
                                <div class="pinterest-content-1"></div>
                                <div class="pinterest-content-2"></div>
                            </div>
                        </div>
                        <div class="row platform-card youtube-card" style="display: none;">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12 p-0">
                                        <div id="carouselYTIndicators" class="carousel slide" data-bs-ride="carousel">
                                            <ol class="carousel-indicators youtube-images-ol">
                                            </ol>
                                            <div class="carousel-inner youtube-images" role="listbox">
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselYTIndicators" role="button" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselYTIndicators" role="button" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="youtube-pc_title"></div>
                                <div class="youtube-content"></div>
                            </div>
                        </div>
                        <div class="row platform-card blogger-card" style="display: none;">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12 p-0">
                                        <div id="carouselBlogIndicators" class="carousel slide" data-bs-ride="carousel">
                                            <ol class="carousel-indicators blogger-images-ol">
                                            </ol>
                                            <div class="carousel-inner blogger-images" role="listbox">
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselBlogIndicators" role="button" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselBlogIndicators" role="button" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="blogger-title"></div>
                                <div class="blogger-content"></div>
                            </div>
                        </div>
                        <div class="row platform-card tiktok-card" style="display: none;">
                            <div class="col-md-12">                        
                                <div class="row">
                                    <div class="col-md-12 p-0">
                                        <div id="carouselTiktokIndicators" class="carousel slide" data-bs-ride="carousel">
                                            <ol class="carousel-indicators tiktok-images-ol">
                                            </ol>
                                            <div class="carousel-inner tiktok-images" role="listbox">
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselTiktokIndicators" role="button" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselTiktokIndicators" role="button" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tiktok-content"></div>
                            </div>
                        </div>
                    </div>            
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- MODAL END PREVIEW PLATFORM -->

        <!-- CP Edit Modal -->
        <div class="modal fade" id="EditCPModalLabel" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
           <div class="modal-dialog modal-xl modal-dialog-scrollable">
               <div class="modal-content" id="EditCPModalLabel_content">
                   
               </div><!-- /.modal-content -->
           </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->  

        <!-- Preview content file modal content -->
        <div id="previewContentModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#previewContentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="previewContentModal_Content">
                    
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal --> 
        <!-- Preview file modal content -->
        <div id="previewModalFullscreen" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#previewModalFullscreenLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="previewModalFullscreen_content">
                    
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- Preview task file modal content -->
        <div id="previewTaskModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#previewTaskModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="PreviewTaskFile_Content">
                    
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Preview subtask file modal content -->
        <div id="previewSubtaskModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#previewSubtaskModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="previewSubtaskModal_content">
                    
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- JAVASCRIPT -->
        <script src="<?php echo base_url();?>assets/libs/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/node-waves/waves.min.js"></script>    
        <!-- apexcharts -->
        <script src="<?php echo base_url();?>assets/libs/apexcharts/apexcharts.min.js"></script>

        <!-- file-manager js -->
        <script src="<?php echo base_url();?>assets/js/pages/file-manager.init.js"></script>
        <?php
        include('footer_links.php');
        ?>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#search-criteria-list').keyup(function(){
                    $('.search-list').hide();
                    $('.search-cards').hide();
                    $('#search-clear-list').css('display','block');
                    var txt = $('#search-criteria-list').val();
                    if($('.all-data').hasClass('active_searched'))
                    {
                        $('.active_searched').each(function(){
                           if($(this).text().toUpperCase().indexOf(txt.toUpperCase()) > -1){
                               $(this).show();
                           }
                        });
                    }
                    else
                    {
                       $('.search-list').each(function(){
                           if($(this).text().toUpperCase().indexOf(txt.toUpperCase()) > -1){
                               $(this).show();
                           }
                        }); 
                       $('.search-cards').each(function(){
                           if($(this).text().toUpperCase().indexOf(txt.toUpperCase()) > -1){
                               $(this).show();
                           }
                        }); 
                    }    
                });
                $("#search-clear-list").click(function(){
                    if($('.all-data').hasClass('active_searched'))
                    {
                        $("#search-criteria-list").val("");
                        $('.active_searched').show();
                        $('#search-clear-list').css('display','none'); 
                    }
                    else
                    {
                        $("#search-criteria-list").val("");
                        $('.search-list').show();
                        $('.search-cards').show();
                        $('#search-clear-list').css('display','none');  
                    }            
                  });
                // $('.folder-tree li').click(function(evt) {
                //     evt.stopPropagation();
                //     $(this).toggleClass('expanded');
                // });

                $(".folder-tree li").bind("click", 
                    $('.folder-tree li').click(function(evt) {
                        evt.stopPropagation();
                        $(this).toggleClass('expanded');
                    })
                );
                $(".folder-tree li a" ).click(function( event ) {
                  event.stopPropagation();
                });

                $("input[name='fileIt_radio']").click(function () {
                    var fileIt_radio = $(this).val();
                    if(fileIt_radio == 'all'){
                        $('.goal-wise').css('display','block');
                        $('.kpi-wise').css('display','block');
                        $('.project-wise').css('display','block');
                        $('.task-wise').css('display','block');
                        $('.subtask-wise').css('display','block');
                        $('.platform-wise').css('display','block');
                    }
                    else if(fileIt_radio == 'goal'){
                        $('.goal-wise').css('display','block');
                        $('.kpi-wise').css('display','none');
                        $('.project-wise').css('display','none');
                        $('.task-wise').css('display','none');
                        $('.subtask-wise').css('display','none');
                        $('.platform-wise').css('display','none');
                    }
                    else if(fileIt_radio == 'kpi'){
                        $('.goal-wise').css('display','none');
                        $('.kpi-wise').css('display','block');
                        $('.project-wise').css('display','none');
                        $('.task-wise').css('display','none');
                        $('.subtask-wise').css('display','none');
                        $('.platform-wise').css('display','none');
                    }
                    else if(fileIt_radio == 'project'){
                        $('.goal-wise').css('display','none');
                        $('.kpi-wise').css('display','none');
                        $('.project-wise').css('display','block');
                        $('.task-wise').css('display','none');
                        $('.subtask-wise').css('display','none');
                        $('.platform-wise').css('display','none');
                    }
                    else if(fileIt_radio == 'task'){
                        $('.goal-wise').css('display','none');
                        $('.kpi-wise').css('display','none');
                        $('.project-wise').css('display','none');
                        $('.task-wise').css('display','block');
                        $('.subtask-wise').css('display','block');
                        $('.platform-wise').css('display','none');
                    }
                    else if(fileIt_radio == 'platform'){
                        $('.goal-wise').css('display','none');
                        $('.kpi-wise').css('display','none');
                        $('.project-wise').css('display','none');
                        $('.task-wise').css('display','none');
                        $('.subtask-wise').css('display','none');
                        $('.platform-wise').css('display','block');
                    }
                });
            });
        

            var activeTab1 = localStorage.getItem('activeTab');
              if(activeTab1){
                //debugger;
                if(activeTab1 == "#v-pills-grid")
                {
                    $('#search-criteria-list').hide();
                    $('#filter_files').hide();

                }else{
                    $('#search-criteria-list').show();
                    $('#filter_files').show();
                }
              }

              $("#v-pills-grid-tab").click(function () {
                $('#search-criteria-list').hide();
                    $('#filter_files').hide();
              });

              $("#v-pills-list-tab").click(function () {
                $('#search-criteria-list').show();
                    $('#filter_files').show();
              });
        </script>
    </body>
</html>
