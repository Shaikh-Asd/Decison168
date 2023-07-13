<div class="modal-body">
    <div class="row">
        <?php
        if($tickets_del->attached_files != ""){
            ?>
            <div class="col-lg-12 card">
                <?php 
                if($tickets_del->attached_files != ""){
                    $file_array = explode(',', $tickets_del->attached_files);
                    foreach ($file_array as $fa) {
                        ?>
                        <div class="row">
                            <div class="col-8">
                                <i class="mdi mdi-chevron-double-right me-1 text-d"></i> 
                                <a href="javascript: void(0);" class="nameLink" onclick="return previewTicketFile('<?php echo $fa; ?>',<?php echo $tickets_del->ticket_id; ?>)" title="Preview"><?php echo $fa; ?></a>
                            </div>
                            <div class="col-4">
                                <a href="<?php echo base_url().'superadmin/download_TicketFileAttachment/'.$fa.'/'.$tickets_del->ticket_id; ?>" class="text-dark float-end" title="Download"><i class="bx bx-download h3 m-1 text-d"></i></a>

                                <a href="javascript: void(0);" class="nameLink float-end" onclick="return previewTicketFile('<?php echo $fa; ?>',<?php echo $tickets_del->ticket_id; ?>)" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
                            </div>
                        </div>
                        <?php
                    }
                } 
                ?>
            </div>
            <?php
        }else{
            echo "<h6>No Attached Files...</h6>";
        }
        ?>
    </div>
</div>