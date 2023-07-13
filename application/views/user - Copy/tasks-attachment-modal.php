<?php
if($tdetail)
{
?>
<div class="modal-header">
  <h5 class="modal-title mt-0" id="task_attachmentModalLabel"><?php echo $tdetail->tname;?></h5>
  &nbsp;&nbsp;<a href="<?php echo base_url('tasks-overview/'.$tdetail->tid);?>" class="btn btn-sm btn-d text-white">Open</a>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-lg-12">
           <div class="card">
                <div class="card-body" style="padding: 0rem 1.25rem !important;">
                    <form method="post" class="mb-3" id="attach_taskfile_form" name="attach_taskfile_form" enctype="multipart/form-data">
                        <label class="col-form-label">Attach File(s)</label>
                        <input class="form-control" name="attach_tfile[]" id="attach_tfile" type="file" multiple="" required />
                        <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                            <span id="attach_tfileErr" class="text-danger"></span>
                        <input type="hidden" name="tid" id="tid" value="<?php echo $tdetail->tid;?>">
                        <input type="hidden" name="tcode" id="tcode" value="<?php echo $tdetail->tcode;?>">
                        <input type="hidden" name="tfile_old" id="tfile_old" value="<?php echo $tdetail->tfile;?>">
                    </form>
                    <?php 
                    if(!empty($tdetail->tfile))
                    {
                        $tfile = explode(',', $tdetail->tfile);
                        $count = count($tfile);
                        if($count > 0)
                        {
                            ?>
                            <ul class="list-unstyled fw-medium" id="reload_attach_tfile">
                            <?php
                            for($i=0; $i<$count; $i++)
                            {
                                $tfile_name = $tfile[$i];
                                ?>
                                <li>
                                    <div class="row">
                                        <div class="col-8">
                                            <i class="mdi mdi-chevron-double-right me-1 text-d"></i> 
                                            <a href="javascript: void(0);" class="nameLink" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>')" title="Preview"><?php echo substr($tfile_name, strpos($tfile_name, '_') + 1);?></a>
                                        </div>
                                        <div class="col-4">
                                            <a href="javascript:void(0)" onclick="return delete_tfile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>');" class="text-dark float-end" title="Delete"><i class="bx bxs-x-square h3 m-1"></i></a>
                                            <a href="<?php echo base_url().'front/download_taskFileAttachment/'.$tfile_name.'/'.$tdetail->tid;?>" class="text-dark float-end" title="Download"><i class="bx bx-download h3 m-1 text-d"></i></a>
                                            <a href="javascript: void(0);" class="nameLink float-end" onclick="return PreviewTaskFile('<?php echo $tfile_name;?>','<?php echo $tdetail->tid;?>')" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
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