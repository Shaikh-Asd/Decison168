<?php
$page = 'pending-projects-request';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Pending Projects Request</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- App favicon -->
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
<!-- DataTables -->
    <link href="<?php echo base_url();?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <?php
include('header_links.php');
?>
<link href="<?php echo base_url();?>assets/css/new-cards.css" rel="stylesheet" type="text/css" />
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
                    <div>                                                                        
                        <h4 class="mb-sm-0 font-size-18">Projects</h4>
                    </div>
                </div>
                <div class="col-9">
                    <div>
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
                            <li class="nav-item">
                                <a class="btn btn-sm btn-d text-white" href="<?php echo base_url('projects-create');?>">
                                    <i class="mdi mdi-plus"></i> Create New
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Pending Projects Request</a></li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title-->
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
?> 
                        <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade" id="v-pills-list" role="tabpanel" aria-labelledby="v-pills-list-tab">
                        <div class="row">
                            <div class="col-lg-12">                                
                            <div class="card card-body">
                                <h4 class="card-title">Pending Projects Request</h4>
                                    <div class="table-responsive">
                                        <table id="datatable3" class="table project-list-table table-nowrap align-middle table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Projects</th>
                                                    <!-- <th scope="col">Status</th> -->
                                                    <th scope="col">Accepted Team</th>
                                                    <th scope="col">Invited Team</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    if($pending_plist)
                                                    {
                                                        //$cnt = 1;
                                                        foreach($pending_plist as $pp)
                                                        {
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <div class="row">
                                                                        <div class="col-2">
                                                                    <?php
                                                                        if($pp->portfolio_id != 0)
                                                                        {
                                                                            $portfolio = $this->Front_model->getPortfolio2($pp->portfolio_id);
                                                                    if($portfolio){
                                                                    if($portfolio->photo)
                                                                            {
                                                                            ?>                                 
                                                                                    <div class="avatar-group-item">
                                                                                        <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" class="d-inline-block" title="View Portfolio">
                                                                                            <img src="<?php echo base_url('assets/portfolio_photos/'.$portfolio->photo);?>" alt="" class="rounded-circle avatar-xs portfolio_logo mb-1">
                                                                                        </a>
                                                                                    </div>
                                                                            <?php
                                                                            }
                                                                            else
                                                                            {
                                                                            ?>
                                                                            <div class="mb-1">
                                                                                <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" class="d-inline-block" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
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
                                                                                </a>
                                                                            </div>
                                                                            <?php
                                                                            } 
                                                                        }
                                                                        } 
                                                                    ?>
                                                                        </div>
                                                                        <div class="col-10">
                                                                    <h5 class="font-size-14"><a href="<?php echo base_url('projects-overview-request/'.$pp->pid)?>" class="nameLink" title="Open Project">
                                                                        <?php
                                                                                echo $pp->pname;
                                                                        ?>  
                                                                        </a>
                                                                        <a href="javascript: void(0);" class="nameLink float-end h4" onclick="return ProjectOverviewRequestModal(<?php echo $pp->pid;?>)" title="Preview Project"><i class="mdi mdi-eye-outline"></i></a>
                                                                    </h5>
                                                                    <p class="text-muted mb-0">
                                                                        <?php
                                                                        if(!empty($pp->pdes))
                                                                        {
                                                                        if(strlen($pp->pdes) > 45)
                                                                            {
                                                                              print_r(substr($pp->pdes,0,45).'...');
                                                                            }
                                                                            else
                                                                            {
                                                                                echo $pp->pdes;
                                                                            }
                                                                        }
                                                                        else
                                                                        {
                                                                            echo "A Goal without Plan is just a Wish!";
                                                                        }
                                                                        ?>
                                                                    </p>
                                                                        </div>
                                                                    </div>                           
                                                                </td>
                                                                <!-- <td><span class="badge bg-d-caps">Completed</span></td> -->
                                                                <td>
                                                                    <?php                                                           $pid = $pp->pid;
                                                                        $ptm = $this->Front_model->ProjectTeamMember($pid);
                                                                        if($ptm)
                                                                        {
                                                                    ?>
                                                                    <div class="avatar-group">
                                                                    <?php
                                                                        foreach($ptm as $pm)
                                                                        {
                                                                            if($pm->status == 'accepted')
                                                                            {
                                                                               if($pm->photo)
                                                                                    {
                                                                                        ?>                                      <div class="avatar-group-item">
                                                                                            <a href="<?php echo base_url('team-view-profile/'.$pm->reg_id)?>" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                                                <img src="<?php echo base_url('assets/student_photos/'.$pm->photo);?>" alt="" class="rounded-circle avatar-xs">
                                                                                            </a>
                                                                                        </div>
                                                                                    <?php
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        $fullname = $pm->first_name.' '.$pm->last_name;
                                                                                        $member_name = explode(" ", $fullname);
                                                                                        $profile_name = "";

                                                                                        foreach ($member_name as $n) 
                                                                                        {
                                                                                          $profile_name .= $n[0];
                                                                                        }
                                                                                        if($pm->status == 'send')
                                                                                        {
                                                                                        ?>
                                                                                        <div class="avatar-group-item">
                                                                                            <a href="<?php echo base_url('team-view-profile/'.$pm->reg_id)?>" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                                                <div class="avatar-xs">
                                                                                                    <span class="avatar-title rounded-circle bg-d text-white font-size-16">   <?php echo strtoupper($profile_name);?>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </a>
                                                                                        </div>
                                                                                        <?php
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                        ?>
                                                                                        <div class="avatar-group-item">
                                                                                            <a href="<?php echo base_url('team-view-profile/'.$pm->reg_id)?>" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                                                <div class="avatar-xs">
                                                                                                    <span class="avatar-title rounded-circle btn-d text-white font-size-16">   <?php echo strtoupper($profile_name);?>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </a>
                                                                                        </div>
                                                                                        <?php
                                                                                        }
                                                                                    }
                                                                                }
                                                                            } 
                                                                        ?>
                                                                    </div>
                                                                    <?php
                                                                        }
                                                                        else
                                                                        {
                                                                            echo "Team Not Selected!";
                                                                        }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php                                                           if($ptm)
                                                                        {
                                                                    ?>
                                                                    <div class="avatar-group">
                                                                    <?php
                                                                        foreach($ptm as $pm)
                                                                        {
                                                                            if($pm->status == 'send')
                                                                            {
                                                                               if($pm->photo)
                                                                                    {
                                                                                        ?>                                      <div class="avatar-group-item">
                                                                                            <a href="<?php echo base_url('team-view-profile/'.$pm->reg_id)?>" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                                                <img src="<?php echo base_url('assets/student_photos/'.$pm->photo);?>" alt="" class="rounded-circle avatar-xs">
                                                                                            </a>
                                                                                        </div>
                                                                                    <?php
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        $fullname = $pm->first_name.' '.$pm->last_name;
                                                                                        $member_name = explode(" ", $fullname);
                                                                                        $profile_name = "";

                                                                                        foreach ($member_name as $n) 
                                                                                        {
                                                                                          $profile_name .= $n[0];
                                                                                        }
                                                                                        if($pm->status == 'send')
                                                                                        {
                                                                                        ?>
                                                                                        <div class="avatar-group-item">
                                                                                            <a href="<?php echo base_url('team-view-profile/'.$pm->reg_id)?>" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                                                <div class="avatar-xs">
                                                                                                    <span class="avatar-title rounded-circle bg-d text-white font-size-16">   <?php echo strtoupper($profile_name);?>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </a>
                                                                                        </div>
                                                                                        <?php
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                        ?>
                                                                                        <div class="avatar-group-item">
                                                                                            <a href="<?php echo base_url('team-view-profile/'.$pm->reg_id)?>" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                                                <div class="avatar-xs">
                                                                                                    <span class="avatar-title rounded-circle btn-d text-white font-size-16">   <?php echo strtoupper($profile_name);?>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </a>
                                                                                        </div>
                                                                                        <?php
                                                                                        }
                                                                                    }
                                                                                }
                                                                            } 
                                                                        ?>
                                                                    </div>
                                                                    <?php
                                                                        }
                                                                        else
                                                                        {
                                                                            echo "Team Not Selected!";
                                                                        }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        //$cnt++;
                                                        }
                                                    }
                                                ?>  
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        </div>
                        <div class="tab-pane fade show active" id="v-pills-grid" role="tabpanel" aria-labelledby="v-pills-grid-tab">
                        <div data-simplebar style="max-height: 800px;">
                            <div class="row">
                            <h4 class='card-title mb-4 mt-4'>Pending Projects Request</h4>
                            <?php
                                if($pending_plist)
                                    {
                                        foreach($pending_plist as $pp)
                                            {
                            ?>
    <div class="col-3">
    <section ng-repeat="new_card in new_cards" class="new_card theme-red" data-color="#52A43A">
          <section class="new_card__part new_card__part-2">
            <div class="new_card__part__side m--back">
              <div class="new_card__part__inner new_card__face">
                <div class="new_card__face__colored-side"></div>
                <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                    <?php
                            if($pp->portfolio_id != 0)
                            {
                                $portfolio = $this->Front_model->getPortfolio2($pp->portfolio_id);
                                if($portfolio){
                                if($portfolio->photo)
                                {
                                ?>                                
                                <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
                                    <img src="<?php echo base_url('assets/portfolio_photos/'.$portfolio->photo);?>" alt="" class="img-thumbnail rounded-circle portfolio_logo">
                                </a>
                                <?php
                                }
                                else
                                {
                                ?>
                                <a href="<?php echo base_url('portfolio-view/'.$portfolio->portfolio_id);?>" title="View Portfolio: <?php if($portfolio->portfolio_user == 'company'){ echo $portfolio->portfolio_name;}elseif($portfolio->portfolio_user == 'individual'){ echo $portfolio->portfolio_name.' '.$portfolio->portfolio_lname;}else{ echo $portfolio->portfolio_name;}?>">
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
                                </a>
                                <?php
                                }
                                } 
                            }
                    ?>
                </div>
                <div class="new_card__face__divider"></div>
                <div class="new_card__face__path theme-purple"></div>
                <div class="new_card__face__from-to">
                  <p class="ng-binding">
                    <a href="<?php echo base_url('projects-overview-request/'.$pp->pid)?>" class="nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php echo $pp->pname;?>">
                        <?php echo $pp->pname;?>
                     </a></p>
                  <p class="ng-binding"><?php
                                                        if(!empty($pp->pdes))
                                                            {
                                                                if(strlen($pp->pdes) > 45)
                                                                    {
                                                                        print_r(substr($pp->pdes,0,45).'...');
                                                                    }
                                                                else
                                                                    {
                                                                        echo $pp->pdes;
                                                                    }
                                                            }
                                                        else
                                                            {
                                                                echo "A Goal without Plan is just a Wish!";
                                                            }
                                                    ?></p>
                </div>
                <div class="new_card__face__deliv-date ng-binding">                  
                  <p class="ng-binding">
                                                        <a href="javascript: void(0);" class="nameLink float-end h4 eye_preview" onclick="return ProjectOverviewRequestModal(<?php echo $pp->pid;?>)" title="Preview Project"><i class="mdi mdi-eye-outline"></i></a></p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--req">
                  <p class="ng-binding"><?php 
                                                    $pid = $pp->pid;
                                                    $ptm = $this->Front_model->ProjectTeamMember($pid);
                                                        if($ptm)
                                                            {
                                                ?>
                                                        <div class="avatar-group">
                                                <?php
                                                        foreach($ptm as $pm)
                                                           {
                                                            if($pm->status == 'accepted' || $pm->status == 'send')
                                                                {
                                                                    if($pm->photo)
                                                                    {
                                                ?>                                 
                                                        <div class="avatar-group-item">
                                                            <a href="<?php echo base_url('team-view-profile/'.$pm->reg_id)?>" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                <img src="<?php echo base_url('assets/student_photos/'.$pm->photo);?>" alt="" class="rounded-circle avatar-xs">
                                                            </a>
                                                        </div>
                                                <?php
                                                                    }
                                                                    else
                                                                    {
                                                                    $fullname = $pm->first_name.' '.$pm->last_name;
                                                                    $member_name = explode(" ", $fullname);
                                                                        $profile_name = "";
                                                                            foreach ($member_name as $n) 
                                                                                {
                                                                                    $profile_name .= $n[0];
                                                                                }
                                                                            if($pm->status == 'send')
                                                                                {
                                                ?>
                                                        <div class="avatar-group-item">
                                                            <a href="<?php echo base_url('team-view-profile/'.$pm->reg_id)?>" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                <div class="avatar-xs">
                                                                    <span class="avatar-title rounded-circle bg-d text-white font-size-16">   <?php echo strtoupper($profile_name);?>
                                                                    </span>
                                                                </div>
                                                            </a>
                                                        </div>
                                                <?php
                                                                            }
                                                                            else
                                                                            {
                                                ?>
                                                        <div class="avatar-group-item">
                                                            <a href="<?php echo base_url('team-view-profile/'.$pm->reg_id)?>" class="text-white" title="<?php echo "View: ".$pm->first_name.' '.$pm->last_name;?>">
                                                                <div class="avatar-xs">
                                                                    <span class="avatar-title rounded-circle btn-d text-white font-size-16">   <?php echo strtoupper($profile_name);?>
                                                                    </span>
                                                                </div>
                                                            </a>
                                                        </div>
                                                <?php
                                                                            }
                                                           }
                                                        }
                                                    } 
                                                ?>
                                                </div>
                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                <div class="avatar-group mb-3">
                                                    Team Not Selected!
                                                </div>
                                                <?php
                                                }
                                                ?></p>
                </div>
              </div>
            </div>
          </section>
        </section>
        <!-- end ngRepeat: new_card in new_cards -->
    </div>  
                            <?php 
                                    }
                                }
                            ?>
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
                                    <!-- Project Overview Request Modal -->
                                    <div id="ProjectOverviewRequestModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="#ProjectOverviewRequestModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
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

    </body>

</html>
