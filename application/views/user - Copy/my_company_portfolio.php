<?php
$page = 'my-company-portfolio';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>My Company Portfolio</title>
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
            <div class="row align-items-center">
                <div class="col-3">
                    <div>                                                                        
                        <h4 class="mb-sm-0 font-size-18">Portfolio</h4>
                    </div>
                </div>
                <div class="col-9">
                    
                </div>
            </div>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">My Company Portfolio</a></li>
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
?> 
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="datatable5" class="table align-middle table-nowrap table-hover">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th scope="col" style="display: none;">ID</th>
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
                                                        if($Portfolio)
                                                        {
                                                            foreach($Portfolio as $c)
                                                            {
                                                                ?>
                                                                <tr>
                                                                    <td style="display: none;">
                                                                        <h5 class="font-size-14 mb-1"><?php echo $c->portfolio_id;?></h5>
                                                                    </td>
                                                                    <td>
                                                                        <h5 class="font-size-14 mb-1"><?php if($c->portfolio_user == 'company'){ echo $c->portfolio_name;}else{ echo $c->portfolio_name;}?></h5>
                                                                    </td>
                                                                    <td>
                                                                        <h5 class="font-size-14 mb-1"><?php echo $c->portfolio_user;?></h5>
                                                                    </td>
                                                                    <td>
                                                                        <a href="<?php echo base_url('portfolio-view/'.$c->portfolio_id);?>" class="btn btn-d btn-sm">View</a>
                                                                    </td>
                                                                    <td>
                                                                        <a href="<?php echo base_url('portfolio-edit/'.$c->portfolio_id);?>" class="btn btn-d btn-sm">Edit</a>
                                                                    </td>
                                                                    <td>
                                                                        <a class="btn bg-d text-white waves-effect waves-light btn-sm" href="javascript:void(0)" onclick="return ArchivePortfolio(<?php echo $c->portfolio_id;?>);">Archive</a>
                                                                    </td>
                                                                    <td>
                                                                        <a href="javascript:void(0)" onclick="return DeletePortfolio(<?php echo $c->portfolio_id?>);" class="btn btn-danger btn-sm" >Delete</a>
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