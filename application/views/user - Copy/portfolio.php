<?php
$page = 'portfolio';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Portfolio</title>
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
                                <a class="nav-link" id="v-pills-list-tab" data-bs-toggle="pill" href="#v-pills-list" role="tab" aria-controls="v-pills-list" aria-selected="false" onclick="return hide_portfolio_filter_option();">
                                    <i class="mdi mdi-format-list-bulleted"></i>
                                </a>
                            </li>
                            <li class="nav-item me-2">
                                <a class="nav-link active" id="v-pills-grid-tab" data-bs-toggle="pill" href="#v-pills-grid" role="tab" aria-controls="v-pills-grid" aria-selected="true" onclick="return show_portfolio_filter_option();">
                                    <i class="mdi mdi-view-grid-outline"></i>
                                </a>
                            </li>
<?php
if(empty($this->session->userdata('d168_user_cor_id')))
{
$getMydetail = $this->Front_model->getStudentById($this->session->userdata('d168_id'));
if($getMydetail)
{
if(DateTime::createFromFormat('Y-m-d H:i:s', $getMydetail->package_expiry) !== false)
    {
      if($getMydetail->package_expiry <= date('Y-m-d H:i:s'))
      {
        ?>
        <li class="nav-item">
            <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Create New</a>
        </li>
        <?php
      }
      else
      {
        $getPackDetail = $this->Front_model->getPackDetail($getMydetail->package_id);
        $getPortfolioCount = $this->Front_model->getPortfolioCount();
        if($getPackDetail)
        {
          $total_portfolio = trim($getPackDetail->pack_portfolio);
          $used_portfolio = trim($getPortfolioCount['portfolio_count_rows']);
          $check_type = is_numeric($total_portfolio);
          if($check_type == 'true')
          {
            if($used_portfolio < $total_portfolio)
            {
              ?>
                <li class="nav-item">
                    <a class="btn btn-sm btn-d text-white" href="<?php echo base_url('portfolio-create');?>">
                        <i class="mdi mdi-plus"></i> Create New
                    </a>
                </li>
              <?php
            }
            else
            {
                ?>
                <li class="nav-item">
                    <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Create New</a>
                </li>
                <?php
            }
          }
          else
          {
            ?>
            <li class="nav-item">
                <a class="btn btn-sm btn-d text-white" href="<?php echo base_url('portfolio-create');?>">
                    <i class="mdi mdi-plus"></i> Create New
                </a>
            </li>
            <?php
          }
        }
      }
    }
    else
    {
        $getPackDetail = $this->Front_model->getPackDetail($getMydetail->package_id);
        $getPortfolioCount = $this->Front_model->getPortfolioCount();
        if($getPackDetail)
        {
          $total_portfolio = trim($getPackDetail->pack_portfolio);
          $used_portfolio = trim($getPortfolioCount['portfolio_count_rows']);
          $check_type = is_numeric($total_portfolio);
          if($check_type == 'true')
          {
            if($used_portfolio < $total_portfolio)
            {
              ?>
                <li class="nav-item">
                    <a class="btn btn-sm btn-d text-white" href="<?php echo base_url('portfolio-create');?>">
                        <i class="mdi mdi-plus"></i> Create New
                    </a>
                </li>
              <?php
            }
            else
            {
                ?>
                <li class="nav-item">
                    <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Create New</a>
                </li>
                <?php
            }
          }
          else
          {
            ?>
            <li class="nav-item">
                <a class="btn btn-sm btn-d text-white" href="<?php echo base_url('portfolio-create');?>">
                    <i class="mdi mdi-plus"></i> Create New
                </a>
            </li>
            <?php
          }
        }
    }
} 
}
else
{
  if($this->session->userdata('d168_user_role_in_comp') != 'employee')
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
            if(in_array('portfolio', $cus_privilege))
            {
              $privilege = "yes";
            }
          }
          else
          {
            $privilege = "yes";
          }
        }      
      }
      if(($this->session->userdata('d168_user_role_in_comp') == 'contacted_user') || ($privilege == 'yes'))
      {
        if(DateTime::createFromFormat('Y-m-d H:i:s', $getCompPackInfo->package_expiry) !== false)
        {
          if($getCompPackInfo->package_expiry <= date('Y-m-d H:i:s'))
          {
            ?>
            <li class="nav-item">
                <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Create New</a>
            </li>
            <?php
          }
          else
          {
            $getPackDetail = $this->Front_model->getPackDetail($getCompPackInfo->package_id);
            $getPortfolioCount = $this->Front_model->getPortfolioCountCorp();
            if($getPackDetail)
            {
              $total_portfolio = trim($getPackDetail->pack_portfolio);
              $used_portfolio = trim($getPortfolioCount['portfolio_count_rows']);
              $check_type = is_numeric($total_portfolio);
              if($check_type == 'true')
              {
                if($used_portfolio < $total_portfolio)
                {
                  ?>
                    <li class="nav-item">
                        <a class="btn btn-sm btn-d text-white" href="<?php echo base_url('portfolio-create');?>">
                            <i class="mdi mdi-plus"></i> Create New
                        </a>
                    </li>
                  <?php
                }
                else
                {
                    ?>
                    <li class="nav-item">
                        <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d text-white"><i class="mdi mdi-plus"></i> Create New</a>
                    </li>
                    <?php
                }
              }
              else
              {
                ?>
                <li class="nav-item">
                    <a class="btn btn-sm btn-d text-white" href="<?php echo base_url('portfolio-create');?>">
                        <i class="mdi mdi-plus"></i> Create New
                    </a>
                </li>
                <?php
              }
            }
          }
        }
      }
    }    
  }
}
?>
                            
                        </ul>
                    </div>
                </div>
            </div>
            <div class="page-title-center" id="portfolio_filter_option">
                <div class="row row d-none d-sm-block">
                    <div class="col-12">
                        <ul class="nav nav-pills justify-content-end">
                            <li class="nav-item me-3">
                                <div class="text-center">
                                   <input class="form-check-input" name="filter_port" type="radio" id="all_portfolio" onclick="return all_portfolio_filter();" checked>
                                   <label class="form-check-label">All</label>
                                </div>
                            </li>
                            <li class="nav-item me-3">
                                <div class="text-center">
                                   <input class="form-check-input" name="filter_port" type="radio" id="company_portfolio" onclick="return portfolio_filter();">
                                   <label class="form-check-label">Company</label>
                                </div>
                            </li>
                            <li class="nav-item me-3">
                                <div class="text-center">
                                   <input class="form-check-input" name="filter_port" type="radio" id="individual_portfolio" onclick="return portfolio_filter();">
                                   <label class="form-check-label">Individual</label>
                                </div>
                            </li>
                            <li class="nav-item me-3">
                                <div class="text-center">
                                   <input class="form-check-input" name="filter_port" type="radio" id="not_assigned_portfolio" onclick="return portfolio_filter();">
                                   <label class="form-check-label">Not Assigned</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row d-block d-sm-none">
                    <div class="col-6"></div>
                    <div class="col-6">
                        <div class="btn-group me-1 mt-2">
                            <button class="btn btn-d btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Filter By <i class="mdi mdi-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript: void(0);"><input class="form-check-input" name="filter_port2" type="radio" id="all_portfolio2" onclick="return all_portfolio_filter2();" checked>
                                   <label class="form-check-label">All</label></a>
                                <a class="dropdown-item" href="javascript: void(0);"><input class="form-check-input" name="filter_port2" type="radio" id="company_portfolio2" onclick="return portfolio_filter2();">
                                   <label class="form-check-label">Company</label></a>
                                <a class="dropdown-item" href="javascript: void(0);"><input class="form-check-input" name="filter_port2" type="radio" id="individual_portfolio2" onclick="return portfolio_filter2();">
                                   <label class="form-check-label">Individual</label></a>
                                <a class="dropdown-item" href="javascript: void(0);"><input class="form-check-input" name="filter_port2" type="radio" id="not_assigned_portfolio2" onclick="return portfolio_filter2();">
                                   <label class="form-check-label">Not Assigned</label></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Portfolio</a></li> -->
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title-->
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
                        <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade" id="v-pills-list" role="tabpanel" aria-labelledby="v-pills-list-tab">
                        <div class="row">
                            <div class="col-lg-12">                                
                            <div class="card card-body">
                                    <div class="table-responsive">
                            <table id="port_datatable" class="table project-list-table table-nowrap align-middle table-bordered" style="width: 100%;">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Type</th>
                                                        <th scope="col">View</th>
                                                        <th scope="col">Edit</th>
                                                        <th scope="col">Archive</th>
                                                        <th scope="col">Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        if($AllPortfolio)
                                                        {
                                                            foreach($AllPortfolio as $c)
                                                            {
                                                                ?>
                                                                <tr>
                                                                    <td>
                                                                        <?php if($c->portfolio_user == 'company'){ echo $c->portfolio_name;}elseif($c->portfolio_user == 'individual'){ echo $c->portfolio_name.' '.$c->portfolio_lname;}else{ echo $c->portfolio_name;}?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $c->portfolio_user;?>
                                                                    </td>
                                                                    <td>
                                                                    <?php
                                                                    if(($c->portfolio_archive != 'yes') && ($c->portfolio_trash != 'yes'))
                                                                    {
                                                                    ?>
                                                                        <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $c->portfolio_id;?>');" class="btn btn-d btn-sm">View</a>
                                                                    <?php
                                                                    }
                                                                    else
                                                                    {
                                                                        echo "---";
                                                                    }
                                                                    ?>
                                                                    </td>
                                                                    <?php
                                                                    if($c->portfolio_createdby == $this->session->userdata('d168_id'))
                                                                    {
                                                                    ?>
                                                                    <td>
                                                                    <?php
                                                                    if(($c->portfolio_archive != 'yes') && ($c->portfolio_trash != 'yes'))
                                                                    {
                                                                        if($privilege_only_view == 'no') 
                                                                        {
                                                                    ?>
                                                                        <a href="<?php echo base_url('portfolio-edit/'.$c->portfolio_id);?>" class="btn btn-d btn-sm">Edit</a>
                                                                    <?php
                                                                        }
                                                                    }
                                                                    else
                                                                    {
                                                                        echo "---";
                                                                    }
                                                                    ?>
                                                                    </td>
                                                                    <td>
                                                                    <?php
                                                                    if($c->portfolio_archive != 'yes')
                                                                    {
                                                                        if($c->portfolio_trash != 'yes')
                                                                        {
                                                                            if($privilege_only_view == 'no') 
                                                                            {
                                                                    ?>
                                                                        <a class="btn bg-d text-white waves-effect waves-light btn-sm" href="javascript:void(0)" onclick="return ArchivePortfolio(<?php echo $c->portfolio_id;?>);">Archive</a>
                                                                    <?php
                                                                            }
                                                                        }
                                                                        else
                                                                        {
                                                                            echo "---";
                                                                        }
                                                                    }
                                                                    else
                                                                    {
                                                                        if($privilege_only_view == 'no') 
                                                                        {
                                                                    ?>
                                                                        <a href="javascript:void(0)" onclick="return portfolio_unarchived('<?php echo $c->portfolio_id;?>');" class="btn btn-d btn-sm" id="unarchived_link<?php echo $c->portfolio_id;?>">Reopen</a>
                                                                    <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                    </td>
                                                                    <td>
                                                                    <?php
                                                                    if($c->portfolio_trash != 'yes')
                                                                    {
                                                                        if($c->portfolio_archive != 'yes')
                                                                        {
                                                                            if($privilege_only_view == 'no') 
                                                                            {
                                                                    ?>
                                                                        <a href="javascript:void(0)" onclick="return DeletePortfolioModal(<?php echo $c->portfolio_id?>);" class="btn btn-danger btn-sm" >Delete</a>
                                                                    <?php
                                                                            }
                                                                        }
                                                                        else
                                                                        {
                                                                            echo "---";
                                                                        }
                                                                    }
                                                                    else
                                                                    {
                                                                        if($privilege_only_view == 'no') 
                                                                        {
                                                                    ?>
                                                                        <a href="javascript:void(0)" onclick="return portfolio_retrieve('<?php echo $c->portfolio_id;?>');" class="btn btn-d btn-sm" id="retrieve_link<?php echo $c->portfolio_id;?>">Restore</a>
                                                                        <p class="text-danger" style="display:inline;">( All Data will be<br>deleted permanently after<br>30days of deleted date! )</p>
                                                                    <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                    </td>
                                                                    <?php
                                                                    }
                                                                    else
                                                                    {
                                                                    ?>
                                                                    <td>
                                                                        ---
                                                                    </td>
                                                                    <td>
                                                                        ---
                                                                    </td>
                                                                    <td>
                                                                        ---
                                                                    </td>
                                                                    <?php
                                                                    }
                                                                    ?>
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
                        <!-- end row -->
                        </div>
                        <div class="tab-pane fade show active" id="v-pills-grid" role="tabpanel" aria-labelledby="v-pills-grid-tab">
<div class="row">
    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-8"></div>
    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4">
        <div class="input-group mb-2">
            <input type="text" class="form-control" placeholder="Search..." id="search-criteria" style="line-height: 0.5;">
            <button type="button" class="btn bg-transparent" style="line-height: 0.5;margin-left: -40px; z-index: 100;display:none;" id="search-clear">
              <i class="fa fa-times"></i>
            </button>
        </div>
    </div>
</div>
                        <div data-simplebar style="max-height: 800px;"> 
                        <div class="row">
                            <?php
                                if($Portfolio)
                                    {
                                        foreach($Portfolio as $c)
                                            {
                            ?>
        <div class="col-md-6 col-xs-12 col-lg-3 search-cards <?php  if(!empty($c->portfolio_user)){ echo $c->portfolio_user;}else{ echo "user_not";}?>">
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
                                <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $c->portfolio_id;?>');" title="View Portfolio: <?php if($c->portfolio_user == 'company'){ echo $c->portfolio_name;}elseif($c->portfolio_user == 'individual'){ echo $c->portfolio_name.' '.$c->portfolio_lname;}else{ echo $c->portfolio_name;}?>">
                                    <img src="<?php echo base_url('assets/portfolio_photos/'.$c->photo);?>" alt="" class="img-thumbnail rounded-circle portfolio_logo">
                                </a>
                                <?php
                                }
                                else
                                {
                                ?>
                                <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $c->portfolio_id;?>');" title="View Portfolio: <?php if($c->portfolio_user == 'company'){ echo $c->portfolio_name;}elseif($c->portfolio_user == 'individual'){ echo $c->portfolio_name.' '.$c->portfolio_lname;}else{ echo $c->portfolio_name;}?>">
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
                    <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $c->portfolio_id;?>');" class="nameLink" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover" data-bs-content="<?php if($c->portfolio_user == 'company'){ echo $c->portfolio_name;}elseif($c->portfolio_user == 'individual'){ echo $c->portfolio_name.' '.$c->portfolio_lname;}else{ echo $c->portfolio_name;}?>">
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
                  <a href="<?php echo base_url('portfolio-projects/'.$c->portfolio_id);?>" style="color: #383838;" title="View Projects">Projects</a>
                  <p class="ng-binding"><?php
                                                                $count_cp = $this->Front_model->count_Portfolio_project($c->portfolio_id);
                                                                echo $count_cp['count_rows'];;
                                                            ?></p>
                </div>
                <div class="new_card__face__stats new_card__face__stats--pledge">
                  <a href="<?php echo base_url('portfolio-tasks/'.$c->portfolio_id);?>" style="color: #383838;" title="View Tasks">Tasks</a>
                  <p class="ng-binding"><?php
                                                $count_ct = $this->Front_model->count_Portfolio_task($c->portfolio_id);
                                                    if($count_ct)
                                                    {
                                                        echo $count_ct['count_rows'];   
                                                    }
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
                                    <!-- Delete Portfolio Modal -->
                                    <div id="DeletePortfolioModal" class="modal fade" tabindex="-1" aria-labelledby="#DeletePortfolioModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content" id="DeletePortfolioModal_content">
                                                
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
<script type="text/javascript">
    $('#search-criteria').keyup(function(){
        //debugger;
    $('.search-cards').hide();
    $('#search-clear').css('display','block');
    var txt = $('#search-criteria').val();
    $('.search-cards').each(function(){
       if($(this).text().toUpperCase().indexOf(txt.toUpperCase()) > -1){
           $(this).show();
       }
    });
});
    $("#search-clear").click(function(){
            $("#search-criteria").val("");
            $('.search-cards').show();
            $('#search-clear').css('display','none');
          });
</script>
    </body>

</html>
