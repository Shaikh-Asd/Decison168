<?php
$page = 'pricing-list';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Pricing List | Decision168 Super-Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- App favicon -->
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
<!-- DataTables -->
    <link href="<?php echo base_url();?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="<?php echo base_url();?>assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

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
                        <h4 class="mb-sm-0 font-size-18">Pricing</h4>
                    </div>
                </div>
                <div class="col-9">
                    <div>
                        <ul class="nav nav-pills justify-content-end">
                            <li class="nav-item">
                                <a class="btn btn-sm btn-d text-white" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#Add_Package">
                                    <i class="mdi mdi-plus"></i> Add Package
                                </a>
                            </li>
                            <!-- <li class="nav-item ms-2">
                                <a class="btn btn-sm btn-d text-white" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#change_label">
                                    <i class="mdi mdi-file-replace-outline"></i> Change Labels
                                </a>
                            </li> -->
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
?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="sa_pricing_datatable" class="table align-middle table-hover">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th scope="col" style="display:none;">id</th>
                                                        <th scope="col">Sr.No</th>
                                                        <th scope="col" width="12%">Package</th>
                                                        <th scope="col">Validity (in Days)</th>
                                                        <th scope="col">Price (in $)</th>
                                                        <th scope="col">Portfolios</th>
                                                        <!-- <th scope="col">Goals - KPIs - Projects</th> -->
                                                        <th scope="col">Goals - KPIs</th>
                                                        <th scope="col">Projects</th>
                                                        <!-- <th scope="col">Team Members</th> -->
                                                        <!-- <th scope="col">Tasks</th> -->
                                                        <th scope="col">Storage</th>
                                                        <!-- <th scope="col">Accountablility Tracking</th> -->
                                                        <!-- <th scope="col">Document Collaboration</th> -->
                                                        <!-- <th scope="col">Kanban Boards</th> -->
                                                        <!-- <th scope="col">Motivator</th> -->
                                                        <!-- <th scope="col">Internal Chat</th> -->
                                                        <th scope="col">Content Planner (posts / mo)</th>
                                                        <!-- <th scope="col">Data Recovery</th> -->
                                                        <th scope="col">Custom Package</th>
                                                        <th scope="col">Created Date</th>
                                                        <th scope="col">Edit</th>
                                                        <th scope="col">Labels</th>
                                                        <th scope="col">Status</th>
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
                                                                    <td style="display:none;"><?php echo $l->pack_id;?></td>
                                                                    <td><?php echo $cnt;?></td>
                                                                    <td><?php echo $l->pack_name;?></td>
                                                                    <td><?php echo $l->pack_validity;?></td>
                                                                    <td><?php echo $l->pack_price;?></td>
                                                                    <td><?php echo $l->pack_portfolio;?></td>
                                                                    <!-- <td><?php echo $l->pack_goals.' - '.$l->pack_goals_strategies.' - '.$l->pack_goals_strategies_projects;?></td> -->
                                                                    <td><?php echo $l->pack_goals.' - '.$l->pack_goals_strategies;?></td>
                                                                    <td><?php echo $l->pack_projects;?></td>
                                                                    <!-- <td><?php echo $l->pack_team_members;?></td> -->
                                                                    <!-- <td><?php echo $l->pack_tasks;?></td> -->
                                                                    <td><?php echo $l->pack_storage;?></td>
                                                                    <!-- <td><?php echo $l->pack_acc_tracking;?></td> -->
                                                                    <!-- <td><?php echo $l->pack_doc_collaboration;?></td> -->
                                                                    <!-- <td><?php echo $l->pack_kanban_boards;?></td> -->
                                                                    <!-- <td><?php echo $l->pack_motivator;?></td> -->
                                                                    <!-- <td><?php echo $l->pack_internal_chat;?></td> -->
                                                                    <td><?php echo $l->pack_content_planner;?></td>
                                                                    <!-- <td><?php echo $l->pack_data_recovery;?></td> -->
                                                                    <td><?php echo ucfirst($l->custom_pack);?></td>
                                                                    <td><?php echo $l->pack_created_date;?></td>
                                                                    <td>
                                                                        <a href="javascript:void(0)" class="btn btn-d btn-sm" onclick="return PackageEditModal('<?php echo $l->pack_id;?>')">Edit</a>
                                                                    </td>
                                                                    <td>
                                                                        <a class="btn btn-sm btn-d text-white ms-2" href="javascript:void(0)" onclick="return change_labelModal('<?php echo $l->pack_id;?>');">Change</a>
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                        if($l->pack_status == "active")
                                                                        {
                                                                        ?>
                                                                        <a href="javascript:void(0)" class="btn btn-d btn-sm" onclick="return Inactive_Pack('<?php echo $l->pack_id;?>')">Active</a>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <a href="javascript:void(0)" class="btn bg-d btn-sm text-white" onclick="return Active_Pack('<?php echo $l->pack_id;?>')">Inactive</a>
                                                                        <?php
                                                                        }
                                                                        ?>
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

<!-- Add Package Modal -->
<div class="modal fade" id="Add_Package" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">Add Package</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name="add_packageForm" id="add_packageForm" method="post">
                <input type="hidden" name="pack_creation_page" id="pack_creation_page" value="pricing_page">
                <input type="hidden" name="user_id" id="user_id">
                <input type="hidden" name="contacted_id" id="contacted_id">
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <label class="col-form-label">Link with Stripe <span class="text-danger">*</span></label>
                            <select id="pack_stripe_link" name="pack_stripe_link" class="form-control" required="" onchange="return toggle_package_fields();">
                                <option value="">Choose</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                            <span id="pack_stripe_linkErr" class="text-danger"></span>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <label class="col-form-label">Package Name <span class="text-danger">*</span></label>
                            <div>
                                <input id="pack_name" name="pack_name" type="text" class="form-control" placeholder="Enter Package Name..." required="">
                            <span id="pack_nameErr" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-6" id="show_pack_validity">
                            <label class="col-form-label">Package Validity <span class="text-danger">* (in Days)</span><i class="bx bx-info-circle h4" style="cursor: pointer;padding-left: 10px;" title="30 - One Month&#010;90 - 3 Months&#010;180 - 6 Months&#010;270 - 9 Months&#010;365 - One Year"></i></label>
                            <div>
                                <input id="pack_validity" name="pack_validity" type="text" class="form-control" placeholder="Enter Package Validity..." required="">
                            <span id="pack_validityErr" class="text-danger"></span>
                            </div>
                        </div>
                    
                        <div class="col-lg-6" id="show_pack_price">
                            <label class="col-form-label">Package Price <span class="text-danger">* (in $)</span></label>
                            <div>
                                <input id="pack_price" name="pack_price" type="text" class="form-control" placeholder="Enter Package Price..." required="">
                            <span id="pack_priceErr" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="col-form-label">Total Portfolio <span class="text-danger">*</span></label>
                            <div>
                                <input id="pack_portfolio" name="pack_portfolio" type="text" class="form-control" placeholder="Enter Total Portfolio..." required="">
                            <span id="pack_portfolioErr" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <label class="col-form-label">Total Goals <span class="text-danger">*</span></label>
                            <div>
                                <input id="pack_goals" name="pack_goals" type="text" class="form-control" placeholder="Enter Total Goals..." required="">
                            <span id="pack_goalsErr" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="col-form-label">Total KPIs <span class="text-danger">* (per goal)</span></label>
                            <div>
                                <input id="pack_goals_strategies" name="pack_goals_strategies" type="text" class="form-control" placeholder="Enter Total KPIs..." required="">
                            <span id="pack_goals_strategiesErr" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <!-- <div class="col-lg-6">
                            <label class="col-form-label">Total KPI Projects<span class="text-danger">* (per KPI)</span></label>
                            <div>
                                <input id="pack_goals_strategies_projects" name="pack_goals_strategies_projects" type="text" class="form-control" placeholder="Enter Total KPI Projects..." required="">
                            <span id="pack_goals_strategies_projectssErr" class="text-danger"></span>
                            </div>
                        </div> -->
                        <div class="col-lg-6">
                            <label class="col-form-label">Total Projects <span class="text-danger">* (per portfolio)</span></label>
                            <div>
                                <input id="pack_projects" name="pack_projects" type="text" class="form-control" placeholder="Enter Total Projects..." required="">
                            <span id="pack_projectsErr" class="text-danger"></span>
                            </div>
                        </div>
                    <!-- </div>

                    <div class="row mb-2"> -->
                        <div class="col-lg-6">
                            <label class="col-form-label">Total Team Members <span class="text-danger">* (per portfolio)</span></label>
                            <div>
                                <input id="pack_team_members" name="pack_team_members" type="text" class="form-control" placeholder="Enter Total Team Members..." required="">
                            <span id="pack_team_membersErr" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="col-form-label">Total Tasks <span class="text-danger">* (per project)</span></label>
                            <div>
                                <input id="pack_tasks" name="pack_tasks" type="text" class="form-control" placeholder="Enter Total Tasks..." required="">
                            <span id="pack_tasksErr" class="text-danger"></span>
                            </div>
                        </div>
                    <!-- </div>

                    <div class="row mb-2"> -->
                        <div class="col-lg-6">
                            <label class="col-form-label">Total Storage <span class="text-danger">*</span></label>
                            <div>
                                <input id="pack_storage" name="pack_storage" type="text" class="form-control" placeholder="Enter Total Storage..." required="">
                            <span id="pack_storageErr" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="col-form-label">Total Content Planner <span class="text-danger">* (portfolio posts / mo)</span></label>
                            <div>
                                <input id="pack_content_planner" name="pack_content_planner" type="text" class="form-control" placeholder="Enter Total Content Planner..." required="">
                            <span id="pack_content_plannerErr" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <label class="col-form-label">Package Tagline</label>
                            <div>
                                <input id="pack_tagline" name="pack_tagline" type="text" class="form-control" placeholder="Enter Package Tagline...">
                            <span id="pack_taglineErr" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light bg-d text-white" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="add_packageButton" class="btn btn-d">ADD</button>
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
                                    <!-- Package Edit Modal -->
                                    <div id="PackageEditModal" class="modal fade" tabindex="-1" aria-labelledby="#QuoteEditModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content" id="PackageEditModal_content">
                                                
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
<!-- Change Modal -->
<div class="modal fade" id="change_label" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" id="change_label_content">
            
        </div>
    </div>
</div>
        <!-- JAVASCRIPT -->
<script src="<?php echo base_url();?>assets/libs/jquery/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/metismenu/metisMenu.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/node-waves/waves.min.js"></script> 
<!-- Required datatable js -->
<script src="<?php echo base_url();?>assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="<?php echo base_url();?>assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/jszip/jszip.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="<?php echo base_url();?>assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
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
