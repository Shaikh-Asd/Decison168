<?php
$page = 'ad-list';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Ad List | Decision168 Super-Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- App favicon -->
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
<!-- DataTables -->
    <link href="<?php echo base_url();?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="<?php echo base_url();?>assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
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
                        <h4 class="mb-sm-0 font-size-18">Ad's</h4>
                    </div>
                </div>
                <div class="col-9">
                    <div>
                        <ul class="nav nav-pills justify-content-end">
                            <li class="nav-item">
                                <a class="btn btn-sm btn-d text-white" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#Add_Header">
                                    <i class="mdi mdi-plus"></i> Add New
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Quotes List</a></li> -->
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
                                            <table id="datatable" class="table align-middle table-nowrap table-hover">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th scope="col" width="12%">Sr.No</th>
                                                        <th scope="col" width="45%">Ad</th>
                                                        <th scope="col" width="20%">Package</th>
                                                        <th scope="col" width="20%">Status</th>
                                                        <th scope="col" width="20%">Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        if($list)
                                                        {
                                                            $cnt = 1;
                                                            foreach($list as $l)
                                                            {
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $cnt;?></td>
                                                                    <td><img src="<?php echo base_url('/assets/ad_header/'.$l->ad);?>" class="img-fluid"></td>
                                                                    <td><?php 
                                                                    $pdetail = $this->Superadmin_model->package_detail($l->pack_id);
                                                                    if($pdetail)
                                                                    {
                                                                        echo $pdetail->pack_name;
                                                                    }
                                                                    ?></td>
                                                                    <td><?php 
                                                                    if($l->astatus == 'active')
                                                                        { 
                                                                    ?>
                                                                    <a href="javascript:void(0)" class="btn btn-d btn-sm me-1" onclick="return Ad_Inactive('<?php echo $l->aid;?>')">Active</a>
                                                                    <?php
                                                                        } 
                                                                    elseif($l->astatus == 'inactive')
                                                                        { 
                                                                    ?>
                                                                    <a href="javascript:void(0)" class="btn bg-d text-white waves-effect waves-light btn-sm" onclick="return Ad_Active('<?php echo $l->aid;?>')">Inactive</a>
                                                                    <?php
                                                                        } 
                                                                    ?></td>
                                                                    <td>
                                                                        <a class="btn bg-d text-white waves-effect waves-light btn-sm" href="javascript:void(0)" onclick="return AdDeleteModal('<?php echo $l->aid;?>')">Delete</a>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                                $cnt++;
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

<!-- Add Logo Modal -->
<div class="modal fade" id="Add_Header" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">Upload Ad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name="add_HeaderForm" id="add_HeaderForm" method="post">
                <div class="modal-body">                    
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <label>Image <span class="text-danger">* (Size : 500px x 60px)</span></label>
                            <input class="form-control" name="ad" id="ad" type="file" accept="image/*"/>
                            <span id="adErr" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <label>Link Package<span class="text-danger">*</span></label>
                            <select name="pack_id" id="pack_id" class="select2 form-control" data-placeholder="Link Package...">
                            <?php
                            if($active_packages)
                            { 
                                foreach($active_packages as $ap)
                                {
                                ?>
                                <option value="<?php echo $ap->pack_id?>"><span><?php echo $ap->pack_name;?></span></option>
                                <?php   
                                }
                            }
                            ?>
                            </select>
                            <span id="pack_idErr" class="text-danger"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light bg-d text-white" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="add_HeaderButton" class="btn btn-d">ADD</button>
                    <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                </div>                
            </form>
        </div>
    </div>
</div>  
                
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
<script src="<?php echo base_url();?>assets/libs/select2/js/select2.min.js"></script>
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
