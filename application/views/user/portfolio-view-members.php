<!-- DataTables -->
<link href="<?php echo base_url();?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<?php
if($allporttm)
{
?> 
            <div class="modal-header">
                    <h5 class="modal-title mt-0" id="PortfolioViewMembersModalLabel">All Portfolio Members</h5>
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
                                                    <th>Team Member</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $port_owner = $this->Front_model->getPortfolioById($id);
                                                $port_owner_id = "";
                                                if($port_owner)
                                                {
                                                    $port_owner_id = $port_owner->portfolio_createdby;
                                                }
                                                foreach($allporttm as $aptm)
                                                {

                                                    $pm = $this->Front_model->selectLogin($aptm->sent_to);
                                                    if($pm)
                                                    {                                                         if($port_owner_id != $pm->reg_id)
                                                        {
                                                        ?>
                                                        <tr>
                                                            <td>
                                                            <?php 
                                                            echo $pm->first_name.' '.$pm->last_name;?>
                                                            </td>
                                                            <td>
                                                            <?php
                                                            if($aptm->working_status == "active")
                                                            {
                                                            ?>
                                                            <a href="javascript:void(0)" id="success_status<?php echo $aptm->pim_id;?>" class="btn btn-d btn-sm" onclick="return Inactive_PortfolioMember('<?php echo $aptm->pim_id;?>')">Active</a>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <a href="javascript:void(0)" id="success_status<?php echo $aptm->pim_id;?>" class="btn bg-d btn-sm text-white" onclick="return Active_PortfolioMember('<?php echo $aptm->pim_id;?>')">Inactive</a>
                                                            <?php
                                                            }
                                                            ?>
                                                            </td>
                                                        </tr>
                                                        <?php
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
<script src="<?php echo base_url('assets/js/front.js');?>"></script>