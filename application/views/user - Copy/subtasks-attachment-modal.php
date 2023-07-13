<?php
if($stdetail)
{
?>
<div class="modal-header">
  <h5 class="modal-title mt-0" id="subtask_attachmentModalLabel"><?php echo $stdetail->stname;?></h5>
  &nbsp;&nbsp;<a href="<?php echo base_url('subtasks-overview/'.$stdetail->stid);?>" class="btn btn-sm btn-d text-white">Open</a>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-lg-12">
           <div class="card">
                <div class="card-body" style="padding: 0rem 1.25rem !important;">
                    <form method="post" class="mb-3" id="attach_subtaskfile_form" name="attach_subtaskfile_form" enctype="multipart/form-data">
                        <label class="col-form-label">Attach File(s)</label>
                        <input class="form-control" name="attach_stfile[]" id="attach_stfile" type="file" multiple="" required />
                        <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                            <span id="attach_stfileErr" class="text-danger"></span>
                        <input type="hidden" name="stid" value="<?php echo $stdetail->stid;?>">
                        <input type="hidden" name="stcode" value="<?php echo $stdetail->stcode;?>">
                        <input type="hidden" name="stfile_old" value="<?php echo $stdetail->stfile;?>">
                    </form>
                    <?php 
                    if(!empty($stdetail->stfile))
                    {
                        $stfile = explode(',', $stdetail->stfile);
                        $count = count($stfile);
                        if($count > 0)
                        {
                            ?>
                            <ul class="list-unstyled fw-medium">
                            <?php
                            for($i=0; $i<$count; $i++)
                            {
                                $stfile_name = $stfile[$i];
                                ?>
                                <li>
                                    <div class="row">
                                        <div class="col-8">
                                            <i class="mdi mdi-chevron-double-right me-1 text-d"></i> <a href="javascript: void(0);" onclick="return PreviewSubtaskFile('<?php echo $stfile_name;?>','<?php echo $stdetail->stid;?>')" title="Preview" class="nameLink"><?php echo substr($stfile_name, strpos($stfile_name, '_') + 1);?></a>    
                                        </div>
                                        <div class="col-4">
                                            <a href="javascript:void(0)" onclick="return delete_subtaskfile('<?php echo $stfile_name;?>','<?php echo $stdetail->stid;?>');" class="text-dark float-end" title="Delete"><i class="bx bxs-x-square h3 m-1"></i></a>
                                            <a href="<?php echo base_url().'front/download_subtaskFileAttachment/'.$stfile_name.'/'.$stdetail->stid;?>" class='text-dark float-end'><i class="bx bx-download h3 m-1 text-d"></i></a>
                                            <a href="javascript: void(0);" onclick="return PreviewSubtaskFile('<?php echo $stfile_name;?>','<?php echo $stdetail->stid;?>')" title="Preview" class="nameLink"><i class="bx bx-search-alt h3 m-1 text-d float-end"></i></a>        
                                        </div>
                                    </div></li>
                                <?php
                            }
                            ?>
                            </ul>
                            <?php
                        }
                    }
                    ?>
                </div>
           </div>
       </div>
    </div>
</div>          
<?php
}
?>
<script src="<?php echo base_url('assets/js/front.js');?>"></script>