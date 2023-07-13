<?php
$page = 'quotes-list';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Quotes List | Decision168 Super-Admin</title>
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
                        <h4 class="mb-sm-0 font-size-18">Quotes</h4>
                    </div>
                </div>
                <div class="col-9">
                    <div>
                        <ul class="nav nav-pills justify-content-end">
                            <li class="nav-item">
                                <a class="btn btn-sm btn-d text-white" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#Add_Quote">
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
                                            <table id="sa_quote_datatable" class="table align-middle table-hover">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th scope="col" style="display:none;">id</th>
                                                        <th scope="col">Sr.No</th>
                                                        <th scope="col" width="10%">Created By</th>
                                                        <th scope="col" width="5%">Status</th>
                                                        <th scope="col" width="10%">Author</th>
                                                        <th scope="col">Quotes</th>
                                                        <th scope="col">Request</th>
                                                        <th scope="col">Edit</th>
                                                        <th scope="col">Delete</th>
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
                                                                    <td style="display:none;"><?php echo $l->id;?></td>
                                                                    <td><?php echo $cnt;?></td>
                                                                    <td><?php 
                                                                    if($l->qcreated_by == '0')
                                                                    { 
                                                                        echo "You";
                                                                    } 
                                                                    else
                                                                    { 
                                                                        $get_User = $this->Superadmin_model->get_User($l->qcreated_by);
                                                                        if($get_User)
                                                                        {
                                                                            echo $get_User->first_name." ".$get_User->last_name;
                                                                        }
                                                                    } ?></td>
                                                                    <td><?php 
                                                                    if($l->status == 'approved')
                                                                        { 
                                                                            echo "Approved";
                                                                        } 
                                                                    elseif($l->status == 'denied')
                                                                        { 
                                                                            echo "Denied";
                                                                        } 
                                                                    elseif($l->status == 'sent')
                                                                        { 
                                                                            echo "Pending";
                                                                        } ?></td>
                                                                    <td><?php echo $l->writer;?></td>
                                                                    <td><?php echo $l->quote;?></td>
                                                                    <td><?php
                                                                        if($l->status == 'sent')
                                                                        { 
                                                                        ?>
                                                                        <span style="display: flex;">
                                                                        <a href="javascript:void(0)" class="btn btn-d btn-sm me-1" onclick="return QuoteApprove('<?php echo $l->id;?>')">Approve</a>
                                                                        <a href="javascript:void(0)" class="btn bg-d text-white waves-effect waves-light btn-sm" onclick="return QuoteDeny('<?php echo $l->id;?>')">Deny</a>
                                                                        </span>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                            echo "";
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <a href="javascript:void(0)" class="btn btn-d btn-sm" onclick="return QuoteEditModal('<?php echo $l->id;?>')">Edit</a>
                                                                    </td>
                                                                    <td>
                                                                        <a class="btn bg-d text-white waves-effect waves-light btn-sm" href="javascript:void(0)" onclick="return QuoteDeleteModal('<?php echo $l->id;?>')">Delete</a>
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

<!-- Add Quote Modal -->
<div class="modal fade" id="Add_Quote" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">Add Quote</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name="add_quoteForm" id="add_quoteForm" method="post">
                <div class="modal-body">
                    <div class="row mb-2">
                        <label class="col-form-label col-lg-2">Author <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input id="writer" name="writer" type="text" class="form-control" placeholder="Enter Author Name..." required="">
                        <span id="writerErr" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label class="col-form-label col-lg-2">Quote <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <textarea class="form-control" id="quote" name="quote" rows="2" placeholder="Enter Quote..." required=""></textarea>
                            <span id="quoteErr" class="text-danger"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light bg-d text-white" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="add_quoteButton" class="btn btn-d">ADD</button>
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
                                    <!-- Quote Edit Modal -->
                                    <div id="QuoteEditModal" class="modal fade" tabindex="-1" aria-labelledby="#QuoteEditModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content" id="QuoteModal_content">
                                                
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
