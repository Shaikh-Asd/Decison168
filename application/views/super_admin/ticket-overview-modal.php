<link href="<?php echo base_url();?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="<?php echo base_url();?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
<style type="text/css">
	.ticket-modal .form-select{
		display: inline-block;
	}
	.ticket-modal .select2-container{
		width: 50% !important;
	}
</style>
<div class="modal-body ticket-modal" data-simplebar style="max-height: 400px;">
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<h5><i class="cus_cal_color7 event-color-cus-icon event-color-icon"></i>&nbsp; <b>Subject:</b> <?php 
							echo $tickets_del->subject; ?></h5>
							<small class="ml-25"><strong>Opened On:</strong>
								<?php
								$date_opened = date('dS M Y',strtotime($tickets_del->opened_date));
								echo $date_opened;
								?>
							</small>
						</div>
					</div>
					<div class="row mt-4">
						<div class="col-md-12">
							<p>
								<i class="fas fa-align-left align-middle me-1 text-d"></i>
								<strong>Description:</strong> <br>
								<span class="ml-25 pdes"><?php echo $tickets_del->description; ?></span>
							</p>
						</div>
						<div class="col-md-6">
							<p>
								<i class="fas fa-exclamation-triangle align-middle me-1 text-d"></i>
								<strong>Type:</strong> <?php echo $tickets_del->type; ?>
							</p>
						</div>
						<div class="col-md-6">
							<p>
								<i class="fas fa-sort-amount-up align-middle me-1 text-d"></i>
								<strong>Priority:</strong> <?php echo $tickets_del->priority; ?>
							</p>
						</div>
						<div class="col-md-6">
							<p>
								<i class="fas fa-user-plus align-middle me-1 text-d"></i>
								<strong>Created By:</strong> 
								<?php
								if($tickets_del->created_by != 0){
									$stud_del = $this->Superadmin_model->getStudentById($tickets_del->created_by);
									echo $stud_del->first_name.' '.$stud_del->last_name;
								}
								?>
							</p>
						</div>
						<div class="col-md-6">
							<p>
								<i class="fas fa-calendar-check align-middle me-1 text-d"></i>
								<strong>Created On:</strong> 
								<?php
								if($tickets_del->opened_date != '0000-00-00 00:00:00'){
									$opened_date = date('dS M Y',strtotime($tickets_del->opened_date));
									echo $opened_date;
								}
								?>
							</p>
						</div>
						<div class="col-md-6">
							<p>
								<i class="fas fa-user-cog align-middle me-1 text-d"></i>
								<strong>Assignee: </strong>
								<span class="assignee-row-<?php echo $tickets_del->ticket_id; ?>">
								<?php
                                if($tickets_del->status == 'closed' || $tickets_del->status == 'cancelled' || $tickets_del->status == 'resolved'){
                                    $assg_del = $this->Superadmin_model->getStudentById($tickets_del->assignee);
                                    if($assg_del){
                                    	echo $assg_del->first_name.' '.$assg_del->last_name;
                                    }                                    
                                }else{
                                    ?>                                    
									<select id="assign_supporter" class="form-select select2" onchange="return assignTicket(this.value,<?php echo $tickets_del->ticket_id; ?>);">                                        
                                        <?php
                                        if($tickets_del->assignee == 0){ ?><option value="">Assign</option><?php }
                                        if($supporters){
                                            foreach ($supporters as $sp) {
                                                ?>
                                                <option value="<?php echo $sp->reg_id; ?>" <?php if($tickets_del->assignee == $sp->reg_id){ echo 'selected'; } ?> ><?php echo $sp->first_name.' '.$sp->last_name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>									
                                    <?php
                                }
                                ?>
                                </span>								
							</p>
						</div>
						<div class="col-md-6">
							<p>
								<i class="fas fa-calendar-check align-middle me-1 text-d"></i>
								<strong>Assigned On:</strong> 
								<?php
								if($tickets_del->assigned_date != '0000-00-00 00:00:00'){
									$assigned_date = date('dS M Y',strtotime($tickets_del->assigned_date));
									echo $assigned_date;
								}
								?>
							</p>
						</div>
						<div class="col-md-12">
							<p><i class="fas fa-user-check align-middle me-1 text-d"></i>
							<strong>Assigned By:</strong> 
								<?php
								if($tickets_del->assigned_by != 0 && $tickets_del->assignee != 0){
									$stud_del = $this->Superadmin_model->getStudentById($tickets_del->assigned_by);
									echo $stud_del->first_name.' '.$stud_del->last_name;
								}else if($tickets_del->assigned_by == 0 && $tickets_del->assignee != 0){
									echo 'Support Admin';
								}
								?>
							</p>
						</div>
						<?php
						if($tickets_del->assignee_comment != ""){
							?>
							<div class="col-md-12">
								<p>
									<i class="fas fa-comment-dots align-middle me-1 text-d"></i>
									<strong>Assignee Comment:</strong> 
									<?php
									if($tickets_del->assignee_comment != ""){
										echo $tickets_del->assignee_comment;
									}
									?>
								</p>
							</div>
							<?php
						}
						?>
						<div class="col-md-6">
							<p>
								<i class="fas fa-toggle-on align-middle me-1 text-d"></i>
								<strong>Status:</strong> 
								<span class="status-row-<?php echo $tickets_del->ticket_id; ?>">
									<?php 
	                                if($tickets_del->status == 'open'){
	                                    echo 'Open';
	                                }else if($tickets_del->status == 'assigned'){
	                                    echo 'Assigned';
	                                }else if($tickets_del->status == 'in progress'){
	                                    echo 'In Progress';
	                                }else if($tickets_del->status == 'in review'){
	                                    echo 'In Review'; 
	                                }else if($tickets_del->status == 'pending'){
	                                    echo 'Pending'; 
	                                }else if($tickets_del->status == 'resolved'){
	                                    echo 'Resolved'; 
	                                }else if($tickets_del->status == 'closed'){
	                                    echo 'Closed'; 
	                                }else if($tickets_del->status == 'cancelled'){
	                                    echo 'Cancelled'; 
	                                }
	                                ?>
								</span>
							</p>
						</div>
						<?php
						if($tickets_del->status == 'resolved'){
							?>
							<div class="col-md-6">
								<p>
									<i class="fas fa-calendar-alt align-middle me-1 text-d"></i>
									<strong>Resolved On:</strong> 
									<?php
									if($tickets_del->resolved_date != '0000-00-00 00:00:00'){
										$resolved_date = date('dS M Y',strtotime($tickets_del->resolved_date));
										echo $resolved_date;
									}
									?>
								</p>
							</div>
							<?php
						}else if($tickets_del->status == 'closed'){
							?>
							<div class="col-md-6">
								<p>
									<i class="fas fa-calendar-alt align-middle me-1 text-d"></i>
									<strong>Closed On:</strong> 
									<?php
									if($tickets_del->closed_date != '0000-00-00 00:00:00'){
										$closed_date = date('dS M Y',strtotime($tickets_del->closed_date));
										echo $closed_date;
									}
									?>
								</p>
							</div>
							<?php
						}else if($tickets_del->status == 'cancelled'){
							?>
							<div class="col-md-6">
								<p>
									<i class="fas fa-calendar-alt align-middle me-1 text-d"></i>
									<strong>Cancelled On:</strong> 
									<?php
									if($tickets_del->cancelled_date != '0000-00-00 00:00:00'){
										$cancelled_date = date('dS M Y',strtotime($tickets_del->cancelled_date));
										echo $cancelled_date;
									}
									?>
								</p>
							</div>
							<?php
						}else{
							?>
							<div class="col-md-6">
							</div>
							<?php
						}
						?>
						<?php
						if($tickets_del->attached_files != ""){
							?>
							<div class="col-md-12">
								<p>
									<i class="fas fa-paperclip align-middle me-1 text-d"></i>
									<strong>Attached Files:</strong>
									<?php 
									if($tickets_del->attached_files != ""){
										$file_array = explode(',', $tickets_del->attached_files);
										foreach ($file_array as $fa) {
											?>
											<div class="row">
		                                        <div class="col-9">
		                                            <i class="mdi mdi-chevron-double-right me-1 text-d"></i> 
		                                            <a href="javascript: void(0);" class="nameLink" onclick="return previewTicketFile('<?php echo $fa; ?>',<?php echo $tickets_del->ticket_id; ?>)" title="Preview"><?php echo $fa; ?></a>
		                                        </div>
		                                        <div class="col-3">
		                                            <a href="<?php echo base_url().'superadmin/download_TicketFileAttachment/'.$fa.'/'.$tickets_del->ticket_id; ?>" class="text-dark float-end" title="Download"><i class="bx bx-download h3 m-1 text-d"></i></a>

		                                            <a href="javascript: void(0);" class="nameLink float-end" onclick="return previewTicketFile('<?php echo $fa; ?>',<?php echo $tickets_del->ticket_id; ?>)" title="Preview"><i class="bx bx-search-alt h3 m-1 text-d"></i></a>
		                                        </div>
		                                    </div>
											<?php
										}
									} 
									?>
								</p>
							</div>
							<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url();?>assets/libs/select2/js/select2.min.js"></script>
<script src="<?php echo base_url();?>assets/js/pages/form-advanced.init.js"></script>