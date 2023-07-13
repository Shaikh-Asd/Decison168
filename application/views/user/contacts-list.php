<?php
$page = 'contacts-list';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Contacts List</title>
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
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Contacts List</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Contacts List</a></li> -->
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="datatable5" class="table align-middle table-nowrap table-hover">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th scope="col" style="width: 70px;">DP</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Projects</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        if($Portfolio)
                                                        {
                                                            foreach($Portfolio as $l)
                                                            {
                                                                ?>
                                                                <tr>
                                                                    <td>
                                                                        <?php
                                                                        if($l->photo)
                                                                        {
                                                                            ?>
                                                                            <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $l->portfolio_id;?>');" class="d-inline-block" title="View Portfolio">
                                                                            <img src="<?php echo base_url('assets/portfolio_photos/'.$l->photo);?>" class="rounded-circle avatar-xs" alt="">
                                                                            </a>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                            $fullname = $l->portfolio_name;
                                                                            $member_name = explode(" ", $fullname);
                                                                            $profile_name = "";

                                                                            foreach ($member_name as $n) 
                                                                            {
                                                                              $profile_name .= $n[0];
                                                                            }
                                                                            ?>
                                                                            <div class="avatar-xs">
                                                                                <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $l->portfolio_id;?>');" title="View Portfolio">
                                                                                <span class="avatar-title rounded-circle bg-d text-white font-size-16">
                                                                                    <?php echo strtoupper($profile_name);?>
                                                                                </span>
                                                                                </a>
                                                                            </div>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <h5 class="font-size-14 mb-1"><?php if($l->portfolio_user == 'individual'){ echo $l->portfolio_name.' '.$l->portfolio_lname;}else{ echo $l->portfolio_name;}?></h5>
                                                                        <p class="text-muted mb-0"><?php echo $l->designation;?></p>
                                                                    </td>
                                                                    <td><?php echo $l->email_address;?></td>
                                                                    <td>
                                                                        <?php
                                                                            $count_cp = $this->Front_model->count_Portfolio_project($l->portfolio_id);
                                                                            echo $count_cp['count_rows'];;
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                        if($AcceptedProjectList)
                                                        {
                                                            foreach($AcceptedProjectList as $al)
                                                            {
                                                                ?>
                                                                <tr>
                                                                    <td>
                                                                        <?php
                                                                        if($al->photo)
                                                                        {
                                                                            ?>
                                                                            <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $al->portfolio_id;?>');" class="d-inline-block" title="View Portfolio">
                                                                            <img src="<?php echo base_url('assets/portfolio_photos/'.$al->photo);?>" class="rounded-circle avatar-xs" alt="">
                                                                            </a>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                            $fullname = $al->portfolio_name;
                                                                            $member_name = explode(" ", $fullname);
                                                                            $profile_name = "";

                                                                            foreach ($member_name as $n) 
                                                                            {
                                                                              $profile_name .= $n[0];
                                                                            }
                                                                            ?>
                                                                            <div class="avatar-xs">
                                                                                <a href="javascript: void(0);" onclick="return select_Portfolio('<?php echo $al->portfolio_id;?>');" title="View Portfolio">
                                                                                <span class="avatar-title rounded-circle bg-d text-white font-size-16">
                                                                                    <?php echo strtoupper($profile_name);?>
                                                                                </span>
                                                                                </a>
                                                                            </div>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <h5 class="font-size-14 mb-1"><?php if($al->portfolio_user == 'individual'){ echo $al->portfolio_name.' '.$al->portfolio_lname;}else{ echo $al->portfolio_name;}?></h5>
                                                                        <p class="text-muted mb-0"><?php echo $al->designation;?></p>
                                                                    </td>
                                                                    <td><?php echo $al->email_address;?></td>
                                                                    <td>
                                                                        <?php
                                                                            $count_cp = $this->Front_model->count_Portfolio_project($al->portfolio_id);
                                                                            echo $count_cp['count_rows'];;
                                                                        ?>
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

    </body>

</html>
