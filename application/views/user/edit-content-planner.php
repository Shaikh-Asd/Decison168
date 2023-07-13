<!-- datepicker css -->
        <link href="<?php echo base_url();?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<?php
if($get_cpd)
{
    $project_id = $get_cpd->pc_project_assign;
    $pdetail = $this->Front_model->ProjectDetailPortfolio($project_id);
    $pcreated_by = $pdetail->pcreated_by;
    $pcb = $this->Front_model->getStudentById($get_cpd->pc_created_by);
    $platform_created_by = ucfirst($pcb->first_name).' '.ucfirst($pcb->last_name);

    if(($pcreated_by == $this->session->userdata('d168_id')) || ($get_cpd->pc_created_by == $this->session->userdata('d168_id')) || ($get_cpd->submit_to_approval == $this->session->userdata('d168_id')) || ($get_cpd->pc_assignee == $this->session->userdata('d168_id')) || ($get_cpd->written_content_assignee == $this->session->userdata('d168_id')))
    {
        $wca_readonly = '';
    }
    else
    {
        $wca_readonly = 'readonly';
    }

    if(($pcreated_by == $this->session->userdata('d168_id')) || ($get_cpd->pc_created_by == $this->session->userdata('d168_id')) || ($get_cpd->submit_to_approval == $this->session->userdata('d168_id')) || ($get_cpd->pc_assignee == $this->session->userdata('d168_id')) || ($get_cpd->pc_file_assignee == $this->session->userdata('d168_id')))
    {
        $pfa_readonly = '';
        $delete_display = 'style="display:block"';
    }
    else
    {
        $pfa_readonly = 'readonly';
        $delete_display = 'style="display:none"';
    }

    if(($pcreated_by == $this->session->userdata('d168_id')) || ($get_cpd->pc_created_by == $this->session->userdata('d168_id')) || ($get_cpd->submit_to_approval == $this->session->userdata('d168_id')) || ($get_cpd->pc_assignee == $this->session->userdata('d168_id')))
    {
        $oa_readonly = '';
    }
    else
    {
        $oa_readonly = 'disabled';
    }
?> 
            <div class="modal-header">
                
                <h5 class="modal-title mt-0 font-weight-semibold" id="EditCPModalLabel">Created By: <?php echo $platform_created_by; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                    if(($pcreated_by == $this->session->userdata('d168_id')) || ($get_cpd->pc_created_by == $this->session->userdata('d168_id')) || ($get_cpd->submit_to_approval == $this->session->userdata('d168_id')) || ($get_cpd->pc_assignee == $this->session->userdata('d168_id')))
                        {
                        ?>
                        <div class="justify-content-end float-end">
                            <a class="btn btn-sm bg-d text-white me-1" href="javascript:void(0)" onclick="return delete_platform('<?php echo $get_cpd->pc_id;?>');" style="display: inline;float: right;padding: 4.5px;"><i class="bx bx-trash"></i> Delete</a>
                            <?php
                            $previous_url = $_SERVER['HTTP_REFERER'];
                            $previous_url_array = explode('/', $previous_url);
                            $previous_page_name = end($previous_url_array);
                            if($previous_page_name == 'file-cabinet'){
                                ?>
                                <a class="btn btn-sm bg-d text-white me-1" href="javascript:void(0)" onclick="return archive_platform('<?php echo $get_cpd->pc_id;?>');" style="display: inline;float: right;padding: 4.5px;"><i class="bx bx-archive-in"></i> Archive</a>
                                <?php
                            }else{
                                ?>
                                <a class="btn btn-sm bg-d text-white me-1" href="javascript:void(0)" onclick="return file_it_platform('<?php echo $get_cpd->pc_id;?>');" style="display: inline;float: right;padding: 4.5px;"><i class="mdi mdi-folder-multiple-plus-outline"></i> File it</a>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                        } 
                    ?>
                <div class="row">
                    <form method="post" name="edit_content_form" id="edit_content_form" enctype="multipart/form-data" autocomplete="off">
                        <input type="hidden" name="pc_id" id="pc_id" value="<?php echo $get_cpd->pc_id;?>">
                        <input type="hidden" name="pc_code" id="pc_code" value="<?php echo $get_cpd->pc_code;?>">
                        <input type="hidden" name="pc_project_assign" id="pc_project_assign" value="<?php echo $get_cpd->pc_project_assign;?>">
                    <div data-repeater-list="outer-group" class="outer">
                        <div data-repeater-item class="outer plan-content-wrapper">
                        <div class="row" id="plan-content-1">
                          <div class="col-md-6">                          
                            <div class="form-group mb-2 platform">
                                <label for="platform" class="col-form-label">Platform <span class="text-danger">*</span></label>
                                <div class="platform-section">
                                    <?php
                                    if($get_cpd->platform == 'twitter')
                                    {
                                        $maxlength = 280;
                                    ?>
                                    <label class="mr-10"><input type="radio" value="twitter" class="PlatformCP90<?php echo $get_cpd->pc_id;?>" id="platform" name="platform1" checked>
                                    <i class="fab fa-twitter font-size-24" title="Twitter"></i></label>
                                    <?php
                                    }
                                    elseif($get_cpd->platform == 'facebook')
                                    {
                                    $maxlength = 63206; 
                                    ?>                               
                                    <label class="mr-10"><input type="radio" value="facebook" class="PlatformCP90<?php echo $get_cpd->pc_id;?>" id="platform" name="platform1" checked>
                                    <i class="fab fa-facebook font-size-24" title="Facebook"></i></label>
                                    <?php
                                    }
                                    elseif($get_cpd->platform == 'instagram')
                                    {
                                        $maxlength = 2200;
                                    ?>
                                    <label class="mr-10"><input type="radio" value="instagram" class="PlatformCP90<?php echo $get_cpd->pc_id;?>" id="platform" name="platform1" checked>
                                    <i class="fab fa-instagram font-size-24" title="Instagram"></i></label>
                                    <?php
                                    }
                                    elseif($get_cpd->platform == 'linkedin')
                                    {
                                        $maxlength = 2985;
                                    ?>
                                    <label class="mr-10"><input type="radio" value="linkedin" class="PlatformCP90<?php echo $get_cpd->pc_id;?>" id="platform" name="platform1" checked>
                                    <i class="fab fa-linkedin font-size-24" title="LinkedIn"></i></label>
                                    <?php
                                    }
                                    elseif($get_cpd->platform == 'google-my-business')
                                    {
                                        $maxlength = 1500;
                                    ?>
                                    <label class="mr-10"><input type="radio" value="google-my-business" class="PlatformCP90<?php echo $get_cpd->pc_id;?>" id="platform" name="platform1" checked>
                                    <i class="mdi mdi-google-my-business font-size-24" title="Google My Business"></i></label>
                                    <?php
                                    }
                                    elseif($get_cpd->platform == 'pinterest')
                                    {
                                       $maxlength = 500;
                                    ?>
                                    <label class="mr-10"><input type="radio" value="pinterest" class="PlatformCP90<?php echo $get_cpd->pc_id;?>" id="platform" name="platform1" checked>
                                    <i class="fab fa-pinterest font-size-24" title="Pinterest"></i></label>
                                    <?php
                                    }
                                    elseif($get_cpd->platform == 'youtube')
                                    {
                                        $maxlength = 5000;
                                    ?>
                                    <label class="mr-10"><input type="radio" value="youtube" class="PlatformCP90<?php echo $get_cpd->pc_id;?>" id="platform" name="platform1" checked>
                                    <i class="fab fa-youtube font-size-24" title="YouTube"></i></label>
                                    <?php
                                    }
                                    elseif($get_cpd->platform == 'blogger')
                                    {
                                        $maxlength = 50000;
                                    ?>
                                    <label class="mr-10"><input type="radio" value="blogger" class="PlatformCP90<?php echo $get_cpd->pc_id;?>" id="platform" name="platform1" checked>
                                    <i class="fab fa-blogger font-size-24" title="Blog"></i></label>
                                    <?php
                                    }
                                    elseif($get_cpd->platform == 'tiktok')
                                    {
                                        $maxlength = 100;
                                    ?>
                                    <label class="mr-10"><input type="radio" value="tiktok" class="PlatformCP90<?php echo $get_cpd->pc_id;?>" id="platform" name="platform1" checked>
                                    <i class="fab fa-tiktok font-size-24" title="TikTok"></i> </label>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <span id="platformErr" class="text-danger"></span>
                            </div>  
                            <?php
                            if($get_cpd->platform == 'pinterest' || $get_cpd->platform == 'youtube' || $get_cpd->platform == 'blogger')
                            {
                            ?>
                            <div class="form-group mb-2 youtube-title">
                                <label for="pc_title" class="col-form-label pc_title_label">Title </label>
                                <input maxlength="100" onkeyup="return onTitleChange(this.value);" id="pc_title" name="pc_title1" type="text" class="form-control youtube-field" placeholder="Enter Title" value="<?php echo $get_cpd->pc_title;?>"  <?php echo $wca_readonly; ?>>
                                <span style="display: none;" class="text-danger title-span"></span>
                                <span id="pc_titleErr" class="text-danger"></span>
                            </div> 
                            <?php
                            }
                            ?>  

                            <div class="form-group mb-2 written_content">
                                <label for="written_content" class="col-form-label written_content_label">Written Content </label>
                                <textarea maxlength="<?php echo $maxlength; ?>" onkeyup="return onWrittenContentChange(this.value);" class="form-control" id="written_content" name="written_content1" rows="5" placeholder="Enter Written Content" <?php echo $wca_readonly; ?>><?php echo $get_cpd->written_content;?></textarea>
                                <span style="display:none;" class="text-danger written-content-span"></span>
                                <span id="written_contentErr" class="text-danger"></span>
                            </div>  

                            <?php
                            if($get_cpd->platform == 'pinterest')
                            {
                            ?>
                            <div class="form-group mb-2 written-content-2">
                                <label for="written_content" class="col-form-label written_content_2_label">Written Content 2</label>
                                <textarea maxlength="<?php echo $maxlength; ?>" onkeyup="return onWrittenContent2Change(this.value);" class="form-control" id="written_content_2" name="written_content_21" rows="5" placeholder="Enter Written Content" <?php echo $wca_readonly; ?>><?php echo $get_cpd->written_content_2;?></textarea>
                                <span style="display:none;" class="text-danger written-content-2-span"></span>
                                <span id="written_content_2Err" class="text-danger"></span>
                            </div> 
                            <?php 
                            }
                            ?>

                            <?php
                            if($get_cpd->platform == 'blogger')
                            {
                            ?>
                            <div class="form-group mb-2 blog-field-div">
                                <label for="target_audience" class="col-form-label target_audience_label">Target Audience</label>
                                <input id="target_audience" name="target_audience1" type="text" class="form-control blog-field" placeholder="Enter Target Audience" value="<?php echo $get_cpd->target_audience;?>" <?php echo $wca_readonly; ?>>
                                <span style="display: none;" class="text-danger target_audience-span"></span>
                                <span id="target_audienceErr" class="text-danger"></span>
                            </div>

                            <div class="form-group mb-2 blog-field-div">
                                <label for="solutions" class="col-form-label solutions_label">Solutions</label>
                                <input id="solutions" name="solutions1" type="text" class="form-control blog-field" placeholder="Enter Solutions" value="<?php echo $get_cpd->solutions;?>" <?php echo $wca_readonly; ?>>
                                <span style="display: none;" class="text-danger solutions-span"></span>
                                <span id="solutionsErr" class="text-danger"></span>
                            </div>

                            <div class="form-group mb-2 blog-field-div">
                                <label for="keywords" class="col-form-label keywords_label">Keywords</label>
                                <input id="keywords" name="keywords1" type="text" class="form-control blog-field" placeholder="Enter Keywords" value="<?php echo $get_cpd->keywords;?>" <?php echo $wca_readonly; ?>>
                                <span style="display: none;" class="text-danger keywords-span"></span>
                                <span id="keywordsErr" class="text-danger"></span>
                            </div>

                            <div class="form-group mb-2 blog-field-div">
                                <label for="internal_links" class="col-form-label internal_links_label">Internal Links</label>
                                <input id="internal_links" name="internal_links1" type="text" class="form-control blog-field" placeholder="Enter Internal Links" value="<?php echo $get_cpd->internal_links;?>" <?php echo $wca_readonly; ?>>
                                <span style="display: none;" class="text-danger internal_links-span"></span>
                                <span id="internal_linksErr" class="text-danger"></span>
                            </div>

                            <div class="form-group mb-2 blog-field-div">
                                <label for="external_links" class="col-form-label external_links_label">External Links</label>
                                <input id="external_links" name="external_links1" type="text" class="form-control blog-field" placeholder="Enter External Links" value="<?php echo $get_cpd->external_links;?>" <?php echo $wca_readonly; ?>>
                                <span style="display: none;" class="text-danger external_links-span"></span>
                                <span id="external_linksErr" class="text-danger"></span>
                            </div>

                            <div class="form-group mb-2 blog-field-div">
                                <label for="meta_title" class="col-form-label meta_title_label">Meta title</label>
                                <input id="meta_title" name="meta_title1" type="text" class="form-control blog-field" placeholder="Enter Meta title" value="<?php echo $get_cpd->meta_title;?>" <?php echo $wca_readonly; ?>>
                                <span style="display: none;" class="text-danger meta_title-span"></span>
                                <span id="meta_titleErr" class="text-danger"></span>
                            </div>  

                            <div class="form-group mb-2 blog-field-div">
                                <label for="meta_description" class="col-form-label meta_description_label">Meta Description</label>
                                <textarea maxlength="<?php echo $maxlength; ?>" id="meta_description" name="meta_description1" class="form-control blog-field" rows="5" placeholder="Enter Meta Description" <?php echo $wca_readonly; ?>><?php echo $get_cpd->meta_description;?></textarea>
                                <span style="display: none;" class="text-danger meta_description-span"></span>
                                <span id="meta_descriptionErr" class="text-danger"></span>
                            </div>
                            <?php
                            }
                            ?>

                            <?php
                            if($get_cpd->platform == 'youtube')
                            {
                            ?>
                            <div class="form-group mb-2 tags">
                                <label for="tags" class="col-form-label tags_label">Tags</label>
                                <textarea maxlength="400" class="form-control" id="tags" name="tags1" rows="5" placeholder="Add Tag" <?php echo $wca_readonly; ?>><?php echo $get_cpd->tags;?></textarea>
                                <span style="display:none;" class="text-danger tags-span"></span>
                                <span id="tagsErr" class="text-danger"></span>
                            </div>
                            <?php 
                            }
                            ?>

                            <?php
                            if($pfa_readonly != 'readonly'){
                                ?>
                            <div class="form-group mb-2 pc_file">
                                <label class="col-form-label pc_file_label">Attach Media</label>
                                <input type="hidden" name="total_content[]" id="total_content" value="1">
                                <input class="form-control limitCPFiles" name="pc_file1[]" id="pc_file" type="file" accept="video/*,image/*" data-id="90<?php echo $get_cpd->pc_id; ?>" multiple="" <?php echo $pfa_readonly; ?> />
                                <span id="limitCPFilesErr90<?php echo $get_cpd->pc_id; ?>" class="text-danger"></span>
                                <span id="pc_file1Err" class="text-danger"></span>
                            </div>
                            <?php
                            }
                            ?>

                            
                            <div class="form-group mb-2 pc_old_file">
                                <label class="col-form-label pc_file_label">Attached Media</label>
                                <div class="refresh_remove_cdelfiles">
                                <?php if(!empty($get_cpd->pc_file))
                                        {
                                            $all_pc_file = explode(',', $get_cpd->pc_file);
                                            $old_cpfile = count($all_pc_file);
                                            //$count = count($pc_file);
                                            if($all_pc_file)
                                            {
                                                ?>
                                                <input type="hidden" id="limitCPOldFiles90<?php echo $get_cpd->pc_id; ?>" name="limitCPOldFiles" value="<?php echo $old_cpfile;?>">
                                                <ul class="list-unstyled fw-medium refresh_pcf_remove" style="border: 1px solid #ced4da;border-radius: 0.25rem;">
                                                    <p></p>
                                                <?php
                                                $count = 0;
                                                foreach($all_pc_file as $pc_file)
                                                {
                                                    ?>
                                                    <li style="padding-left: 30px;" id="field_id<?php echo $count;?>">
                                                        <div class="row">
                                                            <div class="col-8"> 
                                                               <a href="javascript: void(0);" class="nameLink" onclick="return PreviewContentFile('<?php echo $pc_file;?>','<?php echo $get_cpd->pc_id;?>')" title="Preview"><?php echo substr($pc_file, strpos($pc_file, '_') + 1);?></a>
                                                            </div>
                                                            <div class="col-4">
                                                                <a <?php echo $delete_display; ?> href="javascript:void(0)" onclick="return delete_pc_file('<?php echo $count;?>','<?php echo $get_cpd->pc_id;?>');" class="text-dark float-end" title="Delete"><i class="bx bxs-x-square h3 m-1"></i></a>
                                                                <a href="<?php echo base_url().'front/download_ContentFileAttachment/'.$pc_file.'/'.$get_cpd->pc_id;?>" class="text-dark float-end" title="Download"><i class="bx bx-download h3 m-1 text-d"></i></a>
                                                            </div>
                                                        </div></li>
                                                    <?php
                                                     $count++;
                                                }
                                                ?>
                                                </ul>
                                                <?php
                                            }
                                        }?> 
                                    </div>                              
                            </div> 
                            <?php
                            if($get_cpd->platform == 'blogger')
                            {
                                ?>
                            <div class="form-group mb-2 blog-field-div">
                                <label class="col-form-label pc_file_label">Attach Documents</label>
                                <input class="form-control blog-field" name="doc_pc_file1[]" id="doc_pc_file" type="file" data-id="90<?php echo $get_cpd->pc_id; ?>" multiple="" <?php echo $pfa_readonly; ?> />
                                <span id="doc_pc_file1Err" class="text-danger"></span>                               
                            </div>
                            <div class="form-group mb-2 pc_old_file">
                                <label class="col-form-label pc_file_label">Attached Documents</label>
                                <?php if(!empty($get_cpd->doc_pc_file))
                                        {
                                            $all_doc_pc_file = explode(',', $get_cpd->doc_pc_file);
                                            $old_doc_cpfile = count($all_doc_pc_file);
                                            //$count = count($pc_file);
                                            if($all_doc_pc_file)
                                            {
                                                ?>
                                                <ul class="list-unstyled fw-medium refresh_pcf_remove" style="border: 1px solid #ced4da;border-radius: 0.25rem;">
                                                    <p></p>
                                                <?php
                                                $count = 0;
                                                foreach($all_doc_pc_file as $doc_pc_file)
                                                {
                                                    ?>
                                                    <li style="padding-left: 30px;" id="field_id<?php echo $count;?>">
                                                        <div class="row">
                                                            <div class="col-8"> 
                                                               <a href="javascript: void(0);" class="nameLink" onclick="return PreviewContentDocFile('<?php echo $doc_pc_file;?>','<?php echo $get_cpd->pc_id;?>')" title="Preview"><?php echo substr($doc_pc_file, strpos($doc_pc_file, '_') + 1);?></a>
                                                            </div>
                                                            <div class="col-4">
                                                                <a <?php echo $delete_display; ?> href="javascript:void(0)" onclick="return delete_pc_doc_file('<?php echo $count;?>','<?php echo $get_cpd->pc_id;?>');" class="text-dark float-end" title="Delete"><i class="bx bxs-x-square h3 m-1"></i></a>
                                                                <a href="<?php echo base_url().'front/download_ContentDocFileAttachment/'.$doc_pc_file.'/'.$get_cpd->pc_id;?>" class="text-dark float-end" title="Download"><i class="bx bx-download h3 m-1 text-d"></i></a>
                                                            </div>
                                                        </div></li>
                                                    <?php
                                                     $count++;
                                                }
                                                ?>
                                                </ul>
                                                <?php
                                            }
                                        }?>                               
                            </div>
                                <?php
                            }
                            ?>                                           
                          </div>                                                  
                          <div class="col-md-6" style="margin-top: 90px;">                                                   
                            <?php
                            if(!empty($get_cpd->pc_project_assign))
                            {
                               $projtm = $this->Front_model->getAccepted_ProjTM($get_cpd->pc_project_assign);
                                ?>
                                <div class="form-group mb-2">
                                <label for="written_content_assignee" class="col-form-label written_content_assignee_label">Assignee for Written Content </label>
                                
                                    <select name="written_content_assignee1" id="written_content_assignee1" class="form-control written_content_assignee1"  style="line-height: 1.5;" <?php echo $oa_readonly; ?>>
                                    <?php                                           
                                    if($projtm){
                                        foreach ($projtm as $ptm) {
                                            $m = $this->Front_model->getStudentById($ptm->pmember);
                                            if($m->reg_id != $this->session->userdata('d168_id'))
                                                {
                                            ?>
                                            <option value="<?php echo $m->reg_id;?>" <?php if($get_cpd->written_content_assignee == $m->reg_id){ echo "selected";}?>><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                            <?php
                                                }
                                            if($m->reg_id == $this->session->userdata('d168_id'))
                                                {
                                            ?>
                                            <option value="<?php echo $this->session->userdata('d168_id');?>"  <?php if($get_cpd->written_content_assignee == $this->session->userdata('d168_id')){ echo "selected";}?>><span>Assign To Me</span></option>
                                            <?php
                                                }
                                            }
                                            $proj_del = $this->Front_model->getProjectById($ptm->pid);
                                            $m = $this->Front_model->getStudentById($proj_del->pcreated_by);
                                            if($m){
                                                if($m->reg_id != $this->session->userdata('d168_id'))
                                                {
                                                ?>
                                                <option value="<?php echo $m->reg_id;?>" <?php if($get_cpd->written_content_assignee == $m->reg_id){ echo "selected";}?>><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                                <?php
                                                    }
                                                if($m->reg_id == $this->session->userdata('d168_id'))
                                                    {
                                                ?>
                                                <option value="<?php echo $this->session->userdata('d168_id');?>"  <?php if($get_cpd->written_content_assignee == $this->session->userdata('d168_id')){ echo "selected";}?>><span>Assign To Me</span></option>
                                                <?php
                                                }
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                            <option value="<?php echo $this->session->userdata('d168_id');?>"><span>Assign To Me</span></option>
                                            <?php
                                        }
                                    ?>
                                    </select> 
                                    <span id="written_content_assigneeErr" class="text-danger"></span>
                                </div>
                            <?php
                            }
                            else
                            {
                            ?>                            
                            <div class="form-group mb-2">
                                <label for="written_content_assignee" class="col-form-label written_content_assignee_label">Assignee for Written Content </label>
                                
                                    <select name="written_content_assignee1" id="written_content_assignee1" class="form-control written_content_assignee1"  style="line-height: 1.5;" <?php echo $oa_readonly; ?>>
                                    <option value="<?php echo $this->session->userdata('d168_id');?>">Assign To Me</option>
                                    </select> 
                                <span id="written_content_assigneeErr" class="text-danger"></span>
                                
                            </div>
                            <?php
                            }
                            ?>

                            <?php
                            if(!empty($get_cpd->pc_project_assign))
                            {
                               $projtm = $this->Front_model->getAccepted_ProjTM($get_cpd->pc_project_assign);
                                ?>
                                <div class="form-group mb-2">
                                <label for="pc_file_assignee" class="col-form-label pc_file_assignee_label">Assignee for Media files </label>
                                
                                    <select name="pc_file_assignee1" id="pc_file_assignee1" class="form-control pc_file_assignee1"  style="line-height: 1.5;" <?php echo $oa_readonly; ?>>
                                    <?php                                           
                                    if($projtm){
                                        foreach ($projtm as $ptm) {
                                            $m = $this->Front_model->getStudentById($ptm->pmember);
                                            if($m->reg_id != $this->session->userdata('d168_id'))
                                                {
                                            ?>
                                            <option value="<?php echo $m->reg_id;?>" <?php if($get_cpd->pc_file_assignee == $m->reg_id){ echo "selected";}?>><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                            <?php
                                                }
                                            if($m->reg_id == $this->session->userdata('d168_id'))
                                                {
                                            ?>
                                            <option value="<?php echo $this->session->userdata('d168_id');?>" <?php if($get_cpd->pc_file_assignee == $this->session->userdata('d168_id')){ echo "selected";}?>><span>Assign To Me</span></option>
                                            <?php
                                                }
                                            }
                                            $proj_del = $this->Front_model->getProjectById($ptm->pid);
                                            $m = $this->Front_model->getStudentById($proj_del->pcreated_by);
                                            if($m){
                                                if($m->reg_id != $this->session->userdata('d168_id'))
                                                {
                                                ?>
                                                <option value="<?php echo $m->reg_id;?>" <?php if($get_cpd->pc_file_assignee == $m->reg_id){ echo "selected";}?>><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                                <?php
                                                    }
                                                if($m->reg_id == $this->session->userdata('d168_id'))
                                                    {
                                                ?>
                                                <option value="<?php echo $this->session->userdata('d168_id');?>"  <?php if($get_cpd->pc_file_assignee == $this->session->userdata('d168_id')){ echo "selected";}?>><span>Assign To Me</span></option>
                                                <?php
                                                }
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                            <option value="<?php echo $this->session->userdata('d168_id');?>"><span>Assign To Me</span></option>
                                            <?php
                                        }
                                    ?>
                                    </select> 
                                    <span id="pc_file_assigneeErr" class="text-danger"></span>
                                </div>
                            <?php
                            }
                            else
                            {
                            ?>                            
                            <div class="form-group mb-2">
                                <label for="pc_file_assignee" class="col-form-label pc_file_assignee_label">Assignee for Media files </label>
                                
                                    <select name="pc_file_assignee1" id="pc_file_assignee1" class="form-control pc_file_assignee1"  style="line-height: 1.5;" <?php echo $oa_readonly; ?>>
                                    <option value="<?php echo $this->session->userdata('d168_id');?>">Assign To Me</option>
                                    </select> 
                                <span id="pc_file_assigneeErr" class="text-danger"></span>
                                
                            </div>
                            <?php
                            }
                            ?>

                            <?php
                            if(!empty($get_cpd->pc_project_assign))
                            {
                               $projtm = $this->Front_model->getAccepted_ProjTM($get_cpd->pc_project_assign);
                                ?>
                                <div class="form-group mb-2">
                                <label for="submit_to_approval" class="col-form-label submit_to_approval_label">Submit for Approval </label>
                                
                                    <select name="submit_to_approval1" id="submit_to_approval1" class="form-control submit_to_approval1"  style="line-height: 1.5;" <?php echo $oa_readonly; ?>>
                                    <?php                                           
                                    if($projtm){
                                        foreach ($projtm as $ptm) {
                                            $m = $this->Front_model->getStudentById($ptm->pmember);
                                            if($m->reg_id != $this->session->userdata('d168_id'))
                                                {
                                            ?>
                                            <option value="<?php echo $m->reg_id;?>" <?php if($get_cpd->submit_to_approval == $m->reg_id){ echo "selected";}?>><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                            <?php
                                                }
                                            if($m->reg_id == $this->session->userdata('d168_id'))
                                                {
                                            ?>
                                            <option value="<?php echo $this->session->userdata('d168_id');?>"  <?php if($get_cpd->submit_to_approval == $this->session->userdata('d168_id')){ echo "selected";}?>><span>Assign To Me</span></option>
                                            <?php
                                                }
                                            }
                                            $proj_del = $this->Front_model->getProjectById($ptm->pid);
                                            $m = $this->Front_model->getStudentById($proj_del->pcreated_by);
                                            if($m){
                                                if($m->reg_id != $this->session->userdata('d168_id'))
                                                {
                                                ?>
                                                <option value="<?php echo $m->reg_id;?>" <?php if($get_cpd->submit_to_approval == $m->reg_id){ echo "selected";}?>><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                                <?php
                                                    }
                                                if($m->reg_id == $this->session->userdata('d168_id'))
                                                    {
                                                ?>
                                                <option value="<?php echo $this->session->userdata('d168_id');?>"  <?php if($get_cpd->submit_to_approval == $this->session->userdata('d168_id')){ echo "selected";}?>><span>Assign To Me</span></option>
                                                <?php
                                                }
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                            <option value="<?php echo $this->session->userdata('d168_id');?>"><span>Assign To Me</span></option>
                                            <?php
                                        }
                                    ?>
                                    </select> 
                                    <span id="submit_to_approvalErr" class="text-danger"></span>
                                </div>
                            <?php
                            }
                            else
                            {
                            ?>                            
                            <div class="form-group mb-2">
                                <label for="submit_to_approval" class="col-form-label submit_to_approval_label">Submit for Approval </label>
                                
                                    <select name="submit_to_approval1" id="submit_to_approval1" class="form-control submit_to_approval1"  style="line-height: 1.5;" <?php echo $oa_readonly; ?>>
                                    <option value="<?php echo $this->session->userdata('d168_id');?>">Assign To Me</option>
                                    </select> 
                                <span id="submit_to_approvalErr" class="text-danger"></span>
                                
                            </div>
                            <?php
                            }
                            ?>

                            <?php
                            if(!empty($get_cpd->pc_project_assign))
                            {
                               $projtm = $this->Front_model->getAccepted_ProjTM($get_cpd->pc_project_assign);
                                ?>
                                <div class="form-group mb-2">
                                <label for="pc_assignee" class="col-form-label pc_assignee_label">Schedular </label>
                                
                                    <select name="pc_assignee1" id="pc_assignee1" class="form-control pc_assignee1"  style="line-height: 1.5;" <?php echo $oa_readonly; ?>>
                                    <?php                                           
                                    if($projtm){
                                        foreach ($projtm as $ptm) {
                                            $m = $this->Front_model->getStudentById($ptm->pmember);
                                            if($m->reg_id != $this->session->userdata('d168_id'))
                                                {
                                            ?>
                                            <option value="<?php echo $m->reg_id;?>" <?php if($get_cpd->pc_assignee == $m->reg_id){ echo "selected";}?>><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                            <?php
                                                }
                                            if($m->reg_id == $this->session->userdata('d168_id'))
                                                {
                                            ?>
                                            <option value="<?php echo $this->session->userdata('d168_id');?>" <?php if($get_cpd->pc_assignee == $this->session->userdata('d168_id')){ echo "selected";}?>><span>Assign To Me</span></option>
                                            <?php
                                                }
                                            }
                                            $proj_del = $this->Front_model->getProjectById($ptm->pid);
                                            $m = $this->Front_model->getStudentById($proj_del->pcreated_by);
                                            if($m){
                                                if($m->reg_id != $this->session->userdata('d168_id'))
                                                {
                                                ?>
                                                <option value="<?php echo $m->reg_id;?>" <?php if($get_cpd->pc_assignee == $m->reg_id){ echo "selected";}?>><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                                <?php
                                                    }
                                                if($m->reg_id == $this->session->userdata('d168_id'))
                                                    {
                                                ?>
                                                <option value="<?php echo $this->session->userdata('d168_id');?>"  <?php if($get_cpd->pc_assignee == $this->session->userdata('d168_id')){ echo "selected";}?>><span>Assign To Me</span></option>
                                                <?php
                                                }
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                            <option value="<?php echo $this->session->userdata('d168_id');?>"><span>Assign To Me</span></option>
                                            <?php
                                        }
                                    ?>
                                    <option value="" <?php if($get_cpd->pc_assignee == 0){ echo "selected";}?>><span>None</span></option>
                                    </select> 
                                    <span id="pc_assigneeErr" class="text-danger"></span>
                                </div>
                            <?php
                            }
                            else
                            {
                            ?>                            
                            <div class="form-group mb-2">
                                <label for="pc_assignee" class="col-form-label pc_assignee_label">Schedular </label>
                                
                                    <select name="pc_assignee1" id="pc_assignee1" class="form-control pc_assignee1"  style="line-height: 1.5;" <?php echo $oa_readonly; ?>>
                                    <option value="<?php echo $this->session->userdata('d168_id');?>">Assign To Me</option>
                                    </select> 
                                <span id="pc_assigneeErr" class="text-danger"></span>
                                
                            </div>
                            <?php
                            }
                            ?>
                          </div>
                          <?php
                            if(!empty($get_cpd->pc_link))
                            {
                                $pc_link = explode(',', $get_cpd->pc_link);
                                $pc_link_comment = explode(',',$get_cpd->pc_link_comment);
                          ?>
                            <div class="row mb-2">
                                <label class="col-form-label col-lg-12 pc_link_label">Link(s) & Comment(s)</label>
                                <div class="col-lg-5">
                                    <input id="pc_link" name="pc_link1[]" type="text" class="form-control" placeholder="Enter Link" value="<?php echo $pc_link[0];?>">
                                    <span id="pc_linkErr" class="text-danger"></span>
                                </div>
                                <div class="col-lg-5">
                                    <input id="pc_link_comment" name="pc_link_comment1[]" type="text" class="form-control" placeholder="Enter Link Comment" value="<?php if(!empty($pc_link_comment[0])){ echo $pc_link_comment[0]; }?>">
                                    <span id="pc_link_commentErr" class="text-danger"></span>
                                </div>
                                <div class="col-lg-2">
                                    <button type="button" class="add_dup_pc_link1 btn btn-d btn-sm">Add Another link</button>                                                   
                                </div>
                            </div>
                          <?php
                            }
                            else
                            {
                          ?>
                            <div class="row mb-2">
                                <label class="col-form-label col-lg-12 pc_link_label">Link(s) & Comment(s)</label>
                                <div class="col-lg-5">
                                    <input id="pc_link" name="pc_link1[]" type="text" class="form-control" placeholder="Enter Link">
                                    <span id="pc_linkErr" class="text-danger"></span>
                                </div>
                                <div class="col-lg-5">
                                    <input id="pc_link_comment" name="pc_link_comment1[]" type="text" class="form-control" placeholder="Enter Link Comment">
                                    <span id="pc_link_commentErr" class="text-danger"></span>
                                </div>
                                <div class="col-lg-2">
                                    <button type="button" class="add_dup_pc_link1 btn btn-d btn-sm">Add Another link</button>                                                   
                                </div>
                            </div>
                          <?php
                            }
                          ?>
                            <div class="pc_link_div1">
                                <?php
                                    if(!empty($get_cpd->pc_link))
                                    {
                                        $pc_link = explode(',', $get_cpd->pc_link);
                                        $pc_link_comment = explode(',',$get_cpd->pc_link_comment);
                                        $pccount = count($pc_link); 
                                        if($pccount > 0)
                                        {
                                            for ($i=1; $i<$pccount; $i++)
                                            {
                                ?>
                                <div class="row mb-2">
                                    <label class="col-form-label col-lg-12"></label>
                                    <div class="col-lg-5">
                                        <input id="pc_link" name="pc_link1[]" type="text" class="form-control" placeholder="Enter Link" value="<?php echo $pc_link[$i];?>">
                                        <span id="pc_linkErr" class="text-danger"></span>
                                    </div>
                                    <div class="col-lg-5">
                                        <input id="pc_link_comment" name="pc_link_comment1[]" type="text" class="form-control" placeholder="Enter Link Comment" value="<?php if(!empty($pc_link_comment[$i])){ echo $pc_link_comment[$i]; }?>">
                                        <span id="pc_link_commentErr" class="text-danger"></span>
                                    </div>
                                    <div class="col-lg-2 card-title mb-2">
                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle add_dup_pc_link_sec1" style="margin-left: 30px;">
                                            <span class="avatar-title bg-transparent text-reset"><i class="bx bx-plus"></i></span>
                                        </button>
                                        <button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle remove_dup_pc_link1" style="margin-left: 15px;">
                                            <span class="avatar-title bg-transparent text-reset"><i class="bx bx-minus"></i></span>
                                        </button>
                                    </div>
                                </div>
                                <?php
                                            }
                                        }
                                    }
                                ?>
                            </div>
                            <span id="link_validErr1" class="text-danger"></span>                            
                        </div>                                                         
                        </div>
                        <br>                       
                        <div class="justify-content-end float-end">
                            <?php
                            if(!empty($get_cpd->pc_project_assign))
                            {
                                ?>
                            <input type="hidden" name="pid" id="pid" value="<?php echo $get_cpd->pc_project_assign;?>">
                                <?php
                            }
                            else
                            {
                                ?>
                            <input type="hidden" name="pid" id="pid">
                                <?php
                            }
                            ?>                            
                            <button type="submit" id="edit_content_button" class="btn btn-d btn-sm">Save Changes</button>
                            <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                            <a class="btn btn-sm bg-d text-white" data-bs-dismiss="modal" href="#">
                                Cancel 
                            </a>
                        </div>
                    </div>                                    
                </form>
                </div>  
            </div>
<?php
}
else
{
?>
                  <div class="modal-header">
                    <h5 class="modal-title mt-0" id="EditCPModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-2">No Data Available!</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                  </div>
<?php
}
?>  
<script src="<?php echo base_url();?>assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<!-- bootstrap datepicker -->
        <script src="<?php echo base_url();?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url('assets/js/front.js');?>"></script>
<script type="text/javascript">
$('.limitCPFiles').change(function() {
  
    var id = $(this).attr('data-id');
    var platform = $('.PlatformCP'+id).val();
    var get_old_cpfile = $('#limitCPOldFiles'+id).val();
    if(get_old_cpfile == null)
    {
        var old_cpfile = 0;
    }
    else
    {
        var old_cpfile = get_old_cpfile;
    }
    var new_cpfile = this.files.length;
    var total_cpfile = parseInt(old_cpfile) + parseInt(new_cpfile);
    //console.log(total_cpfile);
    //console.log('.PlatformCP'+id);
    if(platform == 'twitter')
    {
      if (total_cpfile > 4)
      {
        $('#limitCPFilesErr'+id).html('Too Many Files Attached');
        $(this).val('');
      }else{
        $('#limitCPFilesErr'+id).html('');
      }
    } 
    if(platform == 'facebook')
    {
      if (total_cpfile > 6)
      {
        $('#limitCPFilesErr'+id).html('Too Many Files Attached');
        $(this).val('');
      }else{
        $('#limitCPFilesErr'+id).html('');
      }
    } 
    if(platform == 'instagram')
    {
      if (total_cpfile > 10)
      {
        $('#limitCPFilesErr'+id).html('Too Many Files Attached');
        $(this).val('');
      }else{
        $('#limitCPFilesErr'+id).html('');
      }
    }
    if(platform == 'linkedin')
    {
      if (total_cpfile > 1)
      {
        $('#limitCPFilesErr'+id).html('Too Many Files Attached');
        $(this).val('');
      }else{
        $('#limitCPFilesErr'+id).html('');
      }
    }
    if(platform == 'google-my-business')
    {
      if (total_cpfile > 10)
      {
        $('#limitCPFilesErr'+id).html('Too Many Files Attached');
        $(this).val('');
      }else{
        $('#limitCPFilesErr'+id).html('');
      }
    }
    if(platform == 'pinterest')
    {
      if (total_cpfile > 5)
      {
        $('#limitCPFilesErr'+id).html('Too Many Files Attached');
        $(this).val('');
      }else{
        $('#limitCPFilesErr'+id).html('');
      }
    }
    if(platform == 'youtube')
    {
      if (total_cpfile > 1)
      {
        $('#limitCPFilesErr'+id).html('Too Many Files Attached');
        $(this).val('');
      }else{
        $('#limitCPFilesErr'+id).html('');
      }
    }
    if(platform == 'blogger')
    {
      if (total_cpfile > 4)
      {
        $('#limitCPFilesErr'+id).html('Too Many Files Attached');
        $(this).val('');
      }else{
        $('#limitCPFilesErr'+id).html('');
      }
    }
    if(platform == 'tiktok')
    {
      if (total_cpfile > 1)
      {
        $('#limitCPFilesErr'+id).html('Too Many Files Attached');
        $(this).val('');
      }else{
        $('#limitCPFilesErr'+id).html('');
      }
    }   
  });
$(document).ready(function(){
//
    $('.plan-content-wrapper textarea, .plan-content-wrapper #pc_title').maxlength({
          alwaysShow: true,
          warningClass: "badge bg-info",
          limitReachedClass: "badge bg-warning"
        });
    var add_dup_pc_link1 = $('.add_dup_pc_link1'); //Add button selector
    var pc_link_div1 = $('.pc_link_div1'); //Input field wrapper
    var pc_linkHTML1 = '<div class="row mb-2"><label class="col-form-label col-lg-12"></label><div class="col-lg-5"><input id="pc_link" name="pc_link1[]" type="text" class="form-control" placeholder="Enter Link"><span id="pc_linkErr" class="text-danger"></span></div><div class="col-lg-5"><input id="pc_link_comment" name="pc_link_comment1[]" type="text" class="form-control" placeholder="Enter Link Comment"><span id="pc_link_commentErr" class="text-danger"></span></div><div class="col-lg-2 card-title mb-2"><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle add_dup_pc_link_sec1" style="margin-left: 30px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-plus"></i></span></button><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle remove_dup_pc_link1" style="margin-left: 15px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-minus"></i></span></button></div></div>'; //New input field html
    var a = 1; //Initial field counter is 1
   
   //Once add button is clicked
    $(add_dup_pc_link1).click(function(){
        $(pc_link_div1).append(pc_linkHTML1); //Add field html
    });
   
    $(pc_link_div1).on('click', '.add_dup_pc_link_sec1', function(e){
        $(pc_link_div1).append(pc_linkHTML1); 
    });

   //Once remove button is clicked
    $(pc_link_div1).on('click', '.remove_dup_pc_link1', function(e){
       e.preventDefault();
       $(this).parent('div').parent('div').remove(); //Remove field html
       a--; //Decrement field counter
    });
});

// function get_pub_cdate2(id)
// {
//     $('#pub_Cdate'+id).datepicker({todayHighlight: true,startDate: new Date()});
// }

function onWrittenContentChange(value){
    var platform = $('#platform:checked').val();
    if(platform == 'twitter'){
        var character_count = 280;
        if(value.length > character_count){
            $('.written-content-span').css('display','block');
            $('.written-content-span').html('Max characters allowed '+character_count+'.');
        }else{
            $('.written-content-span').html('');
            $('.written-content-span').css('display','none');
        }        
    }
    else if(platform == 'facebook'){
        var character_count = 63206;
        if(value.length > character_count){
            $('.written-content-span').css('display','block');
            $('.written-content-span').html('Max characters allowed '+character_count+'.');
        }else{
            $('.written-content-span').html('');
            $('.written-content-span').css('display','none');
        } 
    }
    else if(platform == 'instagram'){
        var character_count = 2200;
        if(value.length > character_count){
            $('.written-content-span').css('display','block');
            $('.written-content-span').html('Max characters allowed '+character_count+'.');
        }else{
            $('.written-content-span').html('');
            $('.written-content-span').css('display','none');
        } 
    }
    else if(platform == 'linkedin'){
        var character_count = 2985;
        if(value.length > character_count){
            $('.written-content-span').css('display','block');
            $('.written-content-span').html('Max characters allowed '+character_count+'.');
        }else{
            $('.written-content-span').html('');
            $('.written-content-span').css('display','none');
        } 
    }
    else if(platform == 'google-my-business'){
        var character_count = 1500;
        if(value.length > character_count){
            $('.written-content-span').css('display','block');
            $('.written-content-span').html('Max characters allowed '+character_count+'.');
        }else{
            $('.written-content-span').html('');
            $('.written-content-span').css('display','none');
        } 
    }
    else if(platform == 'pinterest'){
        var character_count = 500;
        if(value.length > character_count){
            $('.written-content-span').css('display','block');
            $('.written-content-span').html('Max characters allowed '+character_count+'.');
        }else{
            $('.written-content-span').html('');
            $('.written-content-span').css('display','none');
        } 
    }
    else if(platform == 'youtube'){
        var character_count = 5000;
        if(value.length > character_count){
            $('.written-content-span').css('display','block');
            $('.written-content-span').html('Max characters allowed '+character_count+'.');
        }else{
            $('.written-content-span').html('');
            $('.written-content-span').css('display','none');
        } 
    }
    else if(platform == 'blogger'){
        var character_count = 50000;
        if(value.length > character_count){
            $('.written-content-span').css('display','block');
            $('.written-content-span').html('Max characters allowed '+character_count+'.');
        }else{
            $('.written-content-span').html('');
            $('.written-content-span').css('display','none');
        } 
    }
    else if(platform == 'tiktok'){
        var character_count = 100;
        if(value.length > character_count){
            $('.written-content-span').css('display','block');
            $('.written-content-span').html('Max characters allowed '+character_count+'.');
        }else{
            $('.written-content-span').html('');
            $('.written-content-span').css('display','none');
        } 
    }
    else{
        $('.written-content-span').html('');
        $('.written-content-span').css('display','none');
    }
}

function onWrittenContent2Change(value){
    //var plan_content_id = $('#plan-content-1');
    var character_count = 500;
    if(value.length > character_count){
        $('.written-content-2-span').css('display','block');
        $('.written-content-2-span').html('Max characters allowed '+character_count+'.');
    }else{
        $('.written-content-2-span').html('');
        $('.written-content-2-span').css('display','none');
    }      
}

function onTitleChange(value){
    //var plan_content_id = $('#plan-content-'+id);
    var character_count = 100;
    if(value.length > character_count){
        $('.title-span').css('display','block');
        $('.title-span').html('Max characters allowed '+character_count+'.');
    }else{
        $('.title-span').html('');
        $('.title-span').css('display','none');
    }        
}
</script>