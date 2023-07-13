<?php
$page = 'individual-portfolio';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Individual Portfolio</title>
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
                        <h4 class="mb-sm-0 font-size-18">Portfolio</h4>
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
                        </ul>
                    </div>
                </div>
            </div>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Individual Portfolio</a></li>
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
                                    <div class="table-responsive">
                                        <table id="datatable" class="table project-list-table table-nowrap align-middle table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Individual Portfolio</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    if($Portfolio)
                                                    {
                                                        foreach($Portfolio as $c)
                                                        {
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <h5 class="text-truncate font-size-14"><a href="<?php echo base_url('portfolio-projects/'.$c->portfolio_id);?>" class="nameLink">
                                                                        <?php if($c->portfolio_user == 'company'){ echo $c->portfolio_name;}elseif($c->portfolio_user == 'individual'){ echo $c->portfolio_name.' '.$c->portfolio_lname;}else{ echo $c->portfolio_name;}?>
                                                                        </a>
                                                <div class="avatar-group float-end">
                                                <?php
                                                                    if($c->photo)
                                                                    {
                                                ?>                                 
                                                        <div class="avatar-group-item">
                                                            <a href="<?php echo base_url('portfolio-view/'.$c->portfolio_id);?>" class="d-inline-block" title="View Portfolio">
                                                                <img src="<?php echo base_url('assets/portfolio_photos/'.$c->photo);?>" alt="" class="rounded-circle portfolio_logo">
                                                            </a>
                                                        </div>
                                                <?php
                                                                    }
                                                                    else
                                                                    {
                                                                    $fullname = $c->portfolio_name;
                                                                    $member_name = explode(" ", $fullname);
                                                                        $profile_name = "";
                                                                            foreach ($member_name as $n) 
                                                                                {
                                                                                    $profile_name .= $n[0];
                                                                                }
                                                ?>
                                                        <div class="avatar-group-item">
                                                            <a href="<?php echo base_url('portfolio-view/'.$c->portfolio_id);?>" class="d-inline-block" title="View Portfolio">
                                                                <div class="portfolio_logo">
                                                                    <span class="avatar-title rounded-circle btn-d text-white font-size-16">   <?php echo strtoupper($profile_name);?>
                                                                    </span>
                                                                </div>
                                                            </a>
                                                        </div>
                                                <?php
                                                           }
                                                ?>
                                                </div>
                                                                    </h5>
                                                                    <p class="text-muted mb-0">
                                                                        <?php
                                                                            $count_cp = $this->Front_model->count_Portfolio_project($c->portfolio_id);
                                                                            echo "Total Projects :- ".$count_cp['count_rows'];;
                                                                        ?>
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    if($AcceptedProjectList)
                                                    {
                                                        foreach($AcceptedProjectList as $al)
                                                        {
                                                            $c_id = $al->portfolio_id;
                                                        if($c_id != 0)
                                                            {
                                                            $getAllPortfolio = $this->Front_model->getAllPortfolio($c_id);
                                                            if($getAllPortfolio->portfolio_createdby != $this->session->userdata('d168_id'))
                                                            {
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <h5 class="text-truncate font-size-14"><a href="<?php echo base_url('portfolio-projects/'.$getAllPortfolio->portfolio_id);?>" class="nameLink">
                                                                        <?php if($getAllPortfolio->portfolio_user == 'company'){ echo $getAllPortfolio->portfolio_name;}elseif($getAllPortfolio->portfolio_user == 'individual'){ echo $getAllPortfolio->portfolio_name.' '.$getAllPortfolio->portfolio_lname;}else{ echo $getAllPortfolio->portfolio_name;}?>
                                                                    </a>

                                                <div class="avatar-group float-end">
                                                <?php
                                                                    if($getAllPortfolio->photo)
                                                                    {
                                                ?>                                 
                                                        <div class="avatar-group-item">
                                                            <a href="<?php echo base_url('portfolio-view/'.$getAllPortfolio->portfolio_id);?>" class="d-inline-block" title="View Portfolio">
                                                                <img src="<?php echo base_url('assets/portfolio_photos/'.$getAllPortfolio->photo);?>" alt="" class="rounded-circle portfolio_logo">
                                                            </a>
                                                        </div>
                                                <?php
                                                                    }
                                                                    else
                                                                    {
                                                                    $fullname = $getAllPortfolio->portfolio_name;
                                                                    $member_name = explode(" ", $fullname);
                                                                        $profile_name = "";
                                                                            foreach ($member_name as $n) 
                                                                                {
                                                                                    $profile_name .= $n[0];
                                                                                }
                                                ?>
                                                        <div class="avatar-group-item">
                                                            <a href="<?php echo base_url('portfolio-view/'.$getAllPortfolio->portfolio_id);?>" class="d-inline-block" title="View Portfolio">
                                                                <div class="portfolio_logo">
                                                                    <span class="avatar-title rounded-circle btn-d text-white font-size-16">   <?php echo strtoupper($profile_name);?>
                                                                    </span>
                                                                </div>
                                                            </a>
                                                        </div>
                                                <?php
                                                           }
                                                ?>
                                                </div>
                                                                </h5>
                                                                    <p class="text-muted mb-0">
                                                                        <?php
                                                                            $count_cp = $this->Front_model->count_Portfolio_project($getAllPortfolio->portfolio_id);
                                                                            echo "Total Projects :- ".$count_cp['count_rows'];;
                                                                        ?>
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                            <?php
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
                        <!-- end row -->
                        </div>
                        <div class="tab-pane fade show active" id="v-pills-grid" role="tabpanel" aria-labelledby="v-pills-grid-tab">
                        <div data-simplebar style="max-height: 800px;"> 
                        <div class="row">
                            <?php
                                if($Portfolio || $AcceptedProjectList)
                                    {
                                        foreach($Portfolio as $c)
                                            {
                            ?>
                            <div class="col-3 <?php  if(!empty($c->portfolio_user)){ echo $c->portfolio_user;}else{ echo "user_not";}?>">
        <section ng-repeat="new_card in new_cards" class="new_card theme-red" data-color="#52A43A">
          <section class="new_card__part new_card__part-2">
            <div class="new_card__part__side m--back">
              <div class="new_card__part__inner new_card__face">
                <div class="new_card__face__colored-side"></div>
                <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                    <?php
                                if($c->photo)
                                {
                                ?>                                
                                <a href="<?php echo base_url('portfolio-view/'.$c->portfolio_id);?>" title="View Portfolio: <?php if($c->portfolio_user == 'company'){ echo $c->portfolio_name;}elseif($c->portfolio_user == 'individual'){ echo $c->portfolio_name.' '.$c->portfolio_lname;}else{ echo $c->portfolio_name;}?>">
                                    <img src="<?php echo base_url('assets/portfolio_photos/'.$c->photo);?>" alt="" class="img-thumbnail rounded-circle portfolio_logo">
                                </a>
                                <?php
                                }
                                else
                                {
                                ?>
                                <a href="<?php echo base_url('portfolio-view/'.$c->portfolio_id);?>" title="View Portfolio: <?php if($c->portfolio_user == 'company'){ echo $c->portfolio_name;}elseif($c->portfolio_user == 'individual'){ echo $c->portfolio_name.' '.$c->portfolio_lname;}else{ echo $c->portfolio_name;}?>">
                                    <span class="avatar-title img-thumbnail rounded-circle portfolio_logo"><?php 
                                    if($c->portfolio_user == 'company')
                                        { 
                                            $fullname = $c->portfolio_name;
                                            $member_name = explode(" ", $fullname);
                                            $profile_name = "";
                                            foreach ($member_name as $n) 
                                            {
                                              $profile_name .= $n[0];
                                            }
                                            echo strtoupper($profile_name);
                                        }
                                    elseif($c->portfolio_user == 'individual')
                                        { 
                                            $fullname = $c->portfolio_name.' '.$c->portfolio_lname;
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
                                            $fullname = $c->portfolio_name;
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
                    ?>
                </div>
                <div class="new_card__face__divider"></div>
                <div class="new_card__face__path theme-purple"></div>
                <div class="new_card__face__from-to">
                   <p class="ng-binding">
                    <a href="<?php echo base_url('portfolio-projects/'.$c->portfolio_id);?>" class="nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php if($c->portfolio_user == 'company'){ echo $c->portfolio_name;}elseif($c->portfolio_user == 'individual'){ echo $c->portfolio_name.' '.$c->portfolio_lname;}else{ echo $c->portfolio_name;}?>">
                        <?php if($c->portfolio_user == 'company'){ echo $c->portfolio_name;}elseif($c->portfolio_user == 'individual'){ echo $c->portfolio_name.' '.$c->portfolio_lname;}else{ echo $c->portfolio_name;}?>
                     </a></p>
                  <p class="ng-binding"><?php
                        $portfolio_createdby = $this->Front_model->getStudentById($c->portfolio_createdby);
                            if($portfolio_createdby)
                                {
                                    echo $portfolio_createdby->first_name.' '.$portfolio_createdby->last_name;   
                                }
                    ?></p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--req">
                  Projects
                  <p class="ng-binding"><?php
                                                                $count_cp = $this->Front_model->count_Portfolio_project($c->portfolio_id);
                                                                echo $count_cp['count_rows'];;
                                                            ?></p>
                </div>
              </div>
            </div>
          </section>
        </section>
    </div>
        <!-- end ngRepeat: new_card in new_cards -->
                            <?php 
                                    }
                                        foreach($AcceptedProjectList as $al)
                                            {
                                                $c_id = $al->portfolio_id;
                                                if($c_id != 0)
                                                    {
                                                        $getAllPortfolio = $this->Front_model->getAllPortfolio($c_id);
                                                        if($getAllPortfolio->portfolio_createdby != $this->session->userdata('d168_id'))
                                                        {
                            ?>
                            <div class="col-3 <?php  if(!empty($getAllPortfolio->portfolio_user)){ echo $getAllPortfolio->portfolio_user;}else{ echo "user_not";}?>">
        <section ng-repeat="new_card in new_cards" class="new_card theme-red" data-color="#52A43A">
          <section class="new_card__part new_card__part-2">
            <div class="new_card__part__side m--back">
              <div class="new_card__part__inner new_card__face">
                <div class="new_card__face__colored-side"></div>
                <div class="avatar-sm profile-user-wid mb-1 new_card__face__price ng-binding">
                    <?php
                                if($getAllPortfolio->photo)
                                {
                                ?>                                
                                <a href="<?php echo base_url('portfolio-view/'.$getAllPortfolio->portfolio_id);?>" title="View Portfolio: <?php if($getAllPortfolio->portfolio_user == 'company'){ echo $getAllPortfolio->portfolio_name;}elseif($getAllPortfolio->portfolio_user == 'individual'){ echo $getAllPortfolio->portfolio_name.' '.$getAllPortfolio->portfolio_lname;}else{ echo $getAllPortfolio->portfolio_name;}?>">
                                    <img src="<?php echo base_url('assets/portfolio_photos/'.$getAllPortfolio->photo);?>" alt="" class="img-thumbnail rounded-circle portfolio_logo">
                                </a>
                                <?php
                                }
                                else
                                {
                                ?>
                                <a href="<?php echo base_url('portfolio-view/'.$getAllPortfolio->portfolio_id);?>" title="View Portfolio: <?php if($getAllPortfolio->portfolio_user == 'company'){ echo $getAllPortfolio->portfolio_name;}elseif($getAllPortfolio->portfolio_user == 'individual'){ echo $getAllPortfolio->portfolio_name.' '.$getAllPortfolio->portfolio_lname;}else{ echo $getAllPortfolio->portfolio_name;}?>">
                                    <span class="avatar-title img-thumbnail rounded-circle portfolio_logo"><?php 
                                    if($getAllPortfolio->portfolio_user == 'company')
                                        { 
                                            $fullname = $getAllPortfolio->portfolio_name;
                                            $member_name = explode(" ", $fullname);
                                            $profile_name = "";
                                            foreach ($member_name as $n) 
                                            {
                                              $profile_name .= $n[0];
                                            }
                                            echo strtoupper($profile_name);
                                        }
                                    elseif($getAllPortfolio->portfolio_user == 'individual')
                                        { 
                                            $fullname = $getAllPortfolio->portfolio_name.' '.$getAllPortfolio->portfolio_lname;
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
                                            $fullname = $getAllPortfolio->portfolio_name;
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
                    ?>
                </div>
                <div class="new_card__face__divider"></div>
                <div class="new_card__face__path theme-purple"></div>
                <div class="new_card__face__from-to">
                   <p class="ng-binding">
                    <a href="<?php echo base_url('portfolio-projects/'.$getAllPortfolio->portfolio_id);?>" class="nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php if($getAllPortfolio->portfolio_user == 'company'){ echo $getAllPortfolio->portfolio_name;}elseif($getAllPortfolio->portfolio_user == 'individual'){ echo $getAllPortfolio->portfolio_name.' '.$getAllPortfolio->portfolio_lname;}else{ echo $getAllPortfolio->portfolio_name;}?>">
                        <?php if($getAllPortfolio->portfolio_user == 'company'){ echo $getAllPortfolio->portfolio_name;}elseif($getAllPortfolio->portfolio_user == 'individual'){ echo $getAllPortfolio->portfolio_name.' '.$getAllPortfolio->portfolio_lname;}else{ echo $getAllPortfolio->portfolio_name;}?>
                     </a></p>
                  <p class="ng-binding"><?php
                        $portfolio_createdby = $this->Front_model->getStudentById($getAllPortfolio->portfolio_createdby);
                            if($portfolio_createdby)
                                {
                                    echo $portfolio_createdby->first_name.' '.$portfolio_createdby->last_name;   
                                }
                    ?></p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--req">
                  Projects
                  <p class="ng-binding"><?php
                                                                $count_cp = $this->Front_model->count_Portfolio_project($getAllPortfolio->portfolio_id);
                                                                echo $count_cp['count_rows'];;
                                                            ?></p>
                </div>
              </div>
            </div>
          </section>
        </section>
    </div>
        <!-- end ngRepeat: new_card in new_cards -->
                            <?php 
                                                        }
                                                }
                                    }
                                }
                                else
                                {
                                    ?>
                                    <div class="col-xl-3 col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">No Portfolio</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
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