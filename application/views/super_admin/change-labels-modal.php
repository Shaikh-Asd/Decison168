<div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">Change Labels</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            if($plabels)
            { 
            ?>
            <form name="change_labelForm" id="change_labelForm" method="post">
                <input type="hidden" name="label_id" value="<?php echo $plabels->plabel;?>">
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <label class="col-form-label">Portfolio Label <span class="text-danger">*</span></label>
                            <div>
                                <input id="portfolio" name="portfolio" type="text" class="form-control" value="<?php echo $plabels->portfolio;?>" required="">
                            <span id="portfolioErr" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="col-form-label">Goals Label <span class="text-danger">*</span></label>
                            <div>
                                <input id="goals" name="goals" type="text" class="form-control" value="<?php echo $plabels->goals;?>" required="">
                            <span id="goalsErr" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <label class="col-form-label">KPI Label <span class="text-danger">*</span></label>
                            <div>
                                <input id="goals_strategies" name="goals_strategies" type="text" class="form-control" value="<?php echo $plabels->goals_strategies;?>" required="">
                            <span id="goals_strategiesErr" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="col-form-label">KPI Projects Label <span class="text-danger">*</span></label>
                            <div>
                                <input id="goals_strategies_projects" name="goals_strategies_projects" type="text" class="form-control" value="<?php echo $plabels->goals_strategies_projects;?>" required="">
                            <span id="goals_strategies_projectsErr" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <label class="col-form-label">Project Label <span class="text-danger">*</span></label>
                            <div>
                                <input id="projects" name="projects" type="text" class="form-control" value="<?php echo $plabels->projects;?>" required="">
                            <span id="projectsErr" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="col-form-label">Team Member Label <span class="text-danger">*</span></label>
                            <div>
                                <input id="team_members" name="team_members" type="text" class="form-control" value="<?php echo $plabels->team_members;?>" required="">
                            <span id="team_membersErr" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <label class="col-form-label">Task Label <span class="text-danger">*</span></label>
                            <div>
                                <input id="task" name="task" type="text" class="form-control" value="<?php echo $plabels->task;?>" required="">
                            <span id="taskErr" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="col-form-label">Storage Label <span class="text-danger">*</span></label>
                            <div>
                                <input id="storage" name="storage" type="text" class="form-control" value="<?php echo $plabels->storage;?>" required="">
                            <span id="storageErr" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <label class="col-form-label">Accountability Tracking Label <span class="text-danger">*</span></label>
                            <div>
                                <input id="accountability_tracking" name="accountability_tracking" type="text" class="form-control" value="<?php echo $plabels->accountability_tracking;?>" required="">
                            <span id="accountability_trackingErr" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="col-form-label">Document Collaboration Label <span class="text-danger">*</span></label>
                            <div>
                                <input id="document_collaboration" name="document_collaboration" type="text" class="form-control" value="<?php echo $plabels->document_collaboration;?>" required="">
                            <span id="document_collaborationErr" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <label class="col-form-label">Kanban Boards Label <span class="text-danger">*</span></label>
                            <div>
                                <input id="kanban_boards" name="kanban_boards" type="text" class="form-control" value="<?php echo $plabels->kanban_boards;?>" required="">
                            <span id="kanban_boardsErr" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="col-form-label">Motivator Label <span class="text-danger">*</span></label>
                            <div>
                                <input id="motivator" name="motivator" type="text" class="form-control" value="<?php echo $plabels->motivator;?>" required="">
                            <span id="motivatorErr" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <label class="col-form-label">Internal Chat Label <span class="text-danger">*</span></label>
                            <div>
                                <input id="internal_chat" name="internal_chat" type="text" class="form-control" value="<?php echo $plabels->internal_chat;?>" required="">
                            <span id="internal_chatErr" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="col-form-label">Content Planner Label <span class="text-danger">*</span></label>
                            <div>
                                <input id="content_planner" name="content_planner" type="text" class="form-control" value="<?php echo $plabels->content_planner;?>" required="">
                            <span id="content_plannerErr" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <label class="col-form-label">Data Recovery Label <span class="text-danger">*</span></label>
                            <div>
                                <input id="data_recovery" name="data_recovery" type="text" class="form-control" value="<?php echo $plabels->data_recovery;?>" required="">
                            <span id="data_recoveryErr" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="col-form-label">Support Label <span class="text-danger">*</span></label>
                            <div>
                                <input id="email_support" name="email_support" type="text" class="form-control" value="<?php echo $plabels->email_support;?>" required="">
                            <span id="email_supportErr" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light bg-d text-white" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="change_labelButton" class="btn btn-d">Save</button>
                    <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                </div>                
            </form>
            <?php 
            }
            ?>
<script src="<?php echo base_url('assets/js/superadmin.js');?>"></script>