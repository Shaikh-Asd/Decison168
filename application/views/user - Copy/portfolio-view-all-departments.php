<!-- DataTables -->
<link href="<?php echo base_url();?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<?php
if($allportd)
{
?> 
            <div class="modal-header">
                    <h5 class="modal-title mt-0" id="PortfolioViewMembersModalLabel">All Portfolio Departments</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table mb-0" id="datatable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Departments</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if($allportd)
                                                {       
                                                foreach($allportd as $pd)
                                                {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <fieldset class="description">
                                                          <div class="description-details">
                                                            <p class="description-content"><?php echo $pd->department;?></p>
                                                            <i class="fas fa-pencil-alt" onclick="return editable_field_pd();"></i>
                                                          </div>
                                                          <div class="description-edit">
                                                            <input name="pdname" id="pdname" value="<?php echo $pd->department;?>" required="">
                                                            <div class="description-controls float-end">
                                                              <a onclick="return dont_edit_pd();"><i class="fas fa-times btn btn-sm bg-d text-white waves-effect waves-light"></i></a>
                                                              <i class="fas fa-check me-2 btn btn-d btn-sm waves-effect waves-light edit_yes_but_pd<?php echo $pd->portfolio_dept_id;?>" onclick="return edit_yes_pd();"  data-class="pdept_editable" data-name="pdname_field" data-id="<?php echo $pd->portfolio_dept_id;?>"></i>
                                                            </div>
                                                          </div>
                                                              <span class="text-danger req_dfield" style="display: none;">Field is required</span>
                                                        </fieldset>
                                                    </td>
                                                    <td>
                                                    <?php
                                                    if($pd->dstatus == "active")
                                                    {
                                                    ?>
                                                    <a href="javascript:void(0)" id="success_dstatus<?php echo $pd->portfolio_dept_id;?>" class="btn btn-d btn-sm" onclick="return Inactive_PortfolioDepartment('<?php echo $pd->portfolio_dept_id;?>')">Active</a>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <a href="javascript:void(0)" id="success_dstatus<?php echo $pd->portfolio_dept_id;?>" class="btn bg-d btn-sm text-white" onclick="return Active_PortfolioDepartment('<?php echo $pd->portfolio_dept_id;?>')">Inactive</a>
                                                    <?php
                                                    }
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
                    <!-- end row -->
                </div>
<?php
}
?>  
<!-- Required datatable js -->
<script src="<?php echo base_url();?>assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Datatable init js -->
<script src="<?php echo base_url();?>assets/js/pages/datatables.init.js"></script>  
<!-- <script src="<?php echo base_url('assets/js/front.js');?>"></script> -->