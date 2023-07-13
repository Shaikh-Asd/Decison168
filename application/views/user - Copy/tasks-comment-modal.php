<link rel="stylesheet" href="<?php echo base_url();?>assets/css/mention.css">
<div class="modal-header">
  <h5 class="modal-title mt-0" id="task_attachmentModalLabel"><?php echo $tdetail->tname;?></h5>
  &nbsp;&nbsp;<a href="<?php echo base_url('tasks-overview/'.$tdetail->tid);?>" class="btn btn-sm btn-d text-white">Open</a>
  <button type="button" class="btn-close" onclick="$('#task_commentModal').css('display','none');"></button>
</div>
<div class="modal-body" style="padding: 0.3rem;">
<?php
if($tdetail)
{
    $get_active_Email_ID = $this->Front_model->getStudentById($this->session->userdata('d168_id'));
    $ActiveEmail_ID = "";
    if($get_active_Email_ID)
    {
        $ActiveEmail_ID = $get_active_Email_ID->email_address;
    }
    $check_active_portfolio = $this->Front_model->check_PortfolioMemberActive($tdetail->portfolio_id, $ActiveEmail_ID);
    if($check_active_portfolio)
    {
        $check_pro_createdby = "";
        if(!empty($tdetail->tproject_assign))
        {
            $pro = $this->Front_model->getProjectById($tdetail->tproject_assign);
            if($pro)
            {
                $check_pro_createdby = $pro->pcreated_by;
            }
        }
        $check_pro_member_status = "";
        $check_ProjectMToClear = $this->Front_model->check_ProjectMToClear($tdetail->tproject_assign);
        if($check_ProjectMToClear)
        {
            $check_pro_member_status = $check_ProjectMToClear->status;
        }
        if(($tdetail->tproject_assign != '0') && ($check_pro_member_status != 'accepted') && ($check_pro_createdby != $this->session->userdata('d168_id')))
        {
            $check_suggested = $this->Front_model->check_project_suggested_member($tdetail->tproject_assign);
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                   <div class="card-body">
                    <div class="row mb-2">
                    <?php
                  if($check_suggested)
                    {
                  ?>
                  <div class="col-lg-12">Project Request is not send from Project Owner. Task Name: <?php echo $tdetail->tname;?></div>
                  <?php
                    }
                    elseif((empty($check_suggested)) && ($check_pro_member_status != 'send'))
                    {
                    ?>
                    <div class="col-lg-12">Not Allowed to View Task</div>
                    <?php
                    }
                    else
                    {
                  ?>
                    <div class="col-lg-6">Please Accept the Project to Access Task and its subtask (if any). Task Name: <?php echo $tdetail->tname;?></div>
                    <div class="col-lg-2">
                        <a href="<?php echo base_url('projects-modal-request2/'.$tdetail->tproject_assign.'/'.'1');?>" class="btn btn-sm btn-d waves-effect waves-light float-end">
                             Accept Request
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a href="<?php echo base_url('projects-modal-request2/'.$tdetail->tproject_assign.'/'.'2');?>" class="btn btn-sm bg-d text-white waves-effect waves-light">
                             Request More Info
                        </a>
                    </div>
                  <?php
                    }
                  ?>
                </div>
                   </div>
               </div>
           </div>
        </div>
        <?php
        }
        else
        {
?> 
                    <div data-simplebar style="max-height: 400px;"> 
                        <div class="row"> 
                            <div class="col-lg-12">
                                <div class="card">
<?php
if($tdetail->tproject_assign != '0')
{
   //$comments = $this->Front_model->getProjectComments($tdetail->tproject_assign); 
   $comments = $this->Front_model->getTaskComments($tdetail->tid);
   $check_Powner = $this->Front_model->getProjectById($tdetail->tproject_assign);
   $checkpro_Owner = "";
   $pownerName = "";
   if($check_Powner)
   {
        $Powner_detail = $this->Front_model->getStudentById($check_Powner->pcreated_by);  
        if($Powner_detail)  
        {
            $pownerName = $Powner_detail->first_name.' '.$Powner_detail->last_name;
        }
        if($check_Powner->pcreated_by == $this->session->userdata('d168_id'))
        {
            $checkpro_Owner = "owner";
        }
        else
        {
            $checkpro_Owner = "team";
        }
   }
   if($checkpro_Owner == "owner")
   {
        $mentionList_tmodal = $this->Front_model->MentionList($tdetail->tproject_assign); 
   }
   elseif($checkpro_Owner == "team")
   {
        $mentionList_tmodalforAccepted = $this->Front_model->MentionListforAccepted($tdetail->tproject_assign);
        //print_r($mentionList_tmodalforAccepted);
        $ownerMention[]['name'] = $pownerName;
        //print_r($ownerMention);
        $mentionList_tmodal = array_merge($mentionList_tmodalforAccepted,$ownerMention);
   }
}
else
{
    $comments = $this->Front_model->getTaskComments($tdetail->tid);
    $mentionList_tmodal = array();
}
?>
<!-- Start Comment section -->
<h4 class="card-title">Comment Section</h4>
<div class="w-100 user-chat">
    <div class="card">        
        <div id="scrollbottom_tmodal" class="chat-conversation p-2">
            <ul class="list-unstyled mb-0 append_new_msg_tmodal" data-simplebar style="max-height: 250px;">
                <?php   
                if($comments){
                    $comment_date = "";
                    foreach ($comments as $cm) {
                        $msg_date = date("Y-m-d", strtotime($cm->c_created_date));
                        if($msg_date == $comment_date)
                        {
                            echo '';
                        }
                        elseif($msg_date == date("Y-m-d"))
                        {
                        ?>
                        <li> 
                            <div class="chat-day-title">
                                <span class="title">Today</span>
                            </div>
                        </li>
                        <?php
                        }
                        elseif($msg_date == date("Y-m-d",strtotime("-1 days")))
                        {
                        ?>
                        <li> 
                            <div class="chat-day-title">
                                <span class="title">Yesterday</span>
                            </div>
                        </li>
                        <?php
                        }
                        else
                        {
                        ?>
                        <li> 
                            <div class="chat-day-title">
                                <span class="title"><?php echo date("j M, Y", strtotime($cm->c_created_date));?></span>
                            </div>
                        </li>
                        <?php
                        }
                        $studdel = $this->Front_model->getStudentById($cm->c_created_by);
                        if($cm->c_created_by == $this->session->userdata('d168_id')){
                            $today_date = date("Y-m-d H:i:s");
                            $delete_allow = date('Y-m-d H:i:s',strtotime('+2 hour',strtotime($cm->c_created_date)));
                            ?>
                        <li class="right" id="msg_id_tmodal<?php echo $cm->cid?>">
                            <div class="conversation-list">
                                <?php
                                if(($today_date < $delete_allow) && (empty($cm->delete_msg)))
                                {
                                ?>
                                <div class="dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                      </a>
                                    <div class="dropdown-menu">
                                        <!-- <a class="dropdown-item" href="#">Copy</a>
                                        <a class="dropdown-item" href="#">Save</a>
                                        <a class="dropdown-item" href="#">Forward</a> -->
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="return delete_comment_tmodal('<?php echo $cm->cid?>');">Delete</a>
                                    </div>
                                </div>
                                <?php
                                }
                                ?>
                                <div class="ctext-wrap">
                                    <div class="conversation-name">Me</div>
                                    <?php
                                    if($cm->delete_msg == 'yes')
                                    {
                                    ?>
                                    <p>
                                        <i><i class="mdi mdi-block-helper"></i> You deleted this message</i>
                                    </p>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    <p>
                                        <?php echo $cm->message; ?>
                                    </p>
                                    <?php
                                    }
                                    ?>
                                    <p class="chat-time mb-0 text-muted"><i class="mdi mdi-clock-check-outline me-1"></i> <?php echo date("h:i a", strtotime($cm->c_created_date));?></p>
                                </div>
                            </div>
                        </li>
                            <?php
                        }else{
                            ?>
                        <li>
                            <div class="conversation-list">
                                <!-- <div class="dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                      </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Copy</a>
                                        <a class="dropdown-item" href="#">Save</a>
                                        <a class="dropdown-item" href="#">Forward</a>
                                        <a class="dropdown-item" href="#">Delete</a>
                                    </div>
                                </div> -->
                                <div class="ctext-wrap">
                                    <div class="conversation-name"><?php echo ucfirst($studdel->first_name).' '.ucfirst($studdel->last_name); ?></div>
                                    <?php
                                    if($cm->delete_msg == 'yes')
                                    {
                                    ?>
                                    <p>
                                        <i><i class="mdi mdi-block-helper"></i> this message was deleted</i>
                                    </p>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    <p>
                                        <?php echo $cm->message; ?>
                                    </p>
                                    <?php
                                    }
                                    ?>
                                    <p class="chat-time mb-0 text-muted"><i class="mdi mdi-clock-check-outline me-1"></i> <?php echo date("h:i a", strtotime($cm->c_created_date));?></p>
                                </div>
                            </div>
                        </li>
                            <?php
                        } 
                        $comment_date = $msg_date;                       
                    }
                }else{
                    ?>
                    <p class="text-muted p-2 no_comment">No comments...</p>
                    <?php
                }
                ?>                      
            </ul>
        </div>
        <div class="p-3 chat-input-section">
            <form method="POST" name="comment_form_tmodal" id="comment_form_tmodal" class="comment_form" autocomplete="off">
                <div class="row">
                    <div class="col" style="padding-right: 0px !important;">
                        <div class="position-relative">
                            <input type="text" id="message_tmodal" name="message" class="form-control chat-input" placeholder="Enter Comment...">
                            <span id="messageErr" class="text-danger"></span>
                            <input type="hidden" name="pid" id="pid" value="<?php echo $tdetail->tproject_assign; ?>">
                            <input type="hidden" name="tid" id="tid" value="<?php echo $tdetail->tid; ?>">
                            <input type="hidden" name="stid" id="stid" value="0">
                            <input type="hidden" name="area_type" value="from_modal">
                        </div>
                    </div>
                </div>
                <button type="submit" id="comment_form_tmodal_button" class="btn btn-sm btn-d chat-send waves-effect waves-light mt-1 float-end"><span class="d-none d-sm-inline-block me-2">Send</span> <i class="mdi mdi-send"></i></button>
                <img id="loader6_tmodal" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
            </form>
        </div>
    </div>
</div>
<!-- End Comment section -->
                                    </div>
                                </div><!-- end col -->

                    </div> <!-- end row -->
                </div>          
<?php
    }
}
else
{
?>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Portfolio Owner Inactive You!</h4>
                    </div>
                </div>
            </div>
        </div>
<?php
}
}
?>
</div> 
<!-- <script src="<?php echo base_url('assets/js/front.js');?>"></script> -->
<script src="<?php echo base_url();?>assets/js/mention.js"></script>
<script>
var jArray= <?php echo json_encode($mentionList_tmodal);?>;
//console.log(jArray);
 var myMention = new Mention({
    input: document.querySelector('#message_tmodal'),
    options: jArray
 })
</script>
<script type="text/javascript">
    // FOR COMMENT FORM ----------------------------------------
  $('#comment_form_tmodal').on('submit',function(event){    
    //debugger;
    event.preventDefault(); // Stop page from refreshing
    $('#comment_form_tmodal_button').hide();
    $('#loader6_tmodal').css('visibility','visible');
    var formData = new FormData(this); 
    console.log(formData);
    $.ajax({
         url:base_url+'front/insert_comment',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:false,
         async:false,
         success: function(data){
          $('#comment_form_tmodal_button').show();
          $('#loader6_tmodal').css('visibility','hidden');  
          var m_val = $('#message_tmodal').val();
          if(m_val)
          {
            if (data.status == false)
            {
              //show errors
              $('[id*=Err]').html('');
              $.each(data.errors, function(key, val) {
                  var key =key.replace(/\[]/g, '');
                  key=key+'Err';
                  //console.log(key);    
                  $('#'+ key).html(val);
              })            
            }
            else if(data.status == true){
                $('.no_comment').hide();
                $('#comment_form_tmodal').trigger('reset');
                $('.append_new_msg_tmodal .simplebar-content').append('<li class="right" id="msg_id_tmodal'+data.comment_id+'" style="padding-top:25px"><div class="conversation-list"><div class="dropdown"><a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></a><div class="dropdown-menu"><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_comment_tmodal('+data.comment_id+');">Delete</a></div></div><div class="ctext-wrap"><div class="conversation-name">Me</div><p>'+data.comment_sent+'</p><p class="chat-time mb-0 text-muted"><i class="mdi mdi-clock-check-outline me-1"></i>'+data.comment_date+'</p></div></div></li>');
                $("#scrollbottom_tmodal .simplebar-content-wrapper").scrollTop($("#scrollbottom_tmodal .simplebar-content-wrapper").prop("scrollHeight"));
            }   
          }       
       }// success msg ends here
     });
  });
</script>
<script type="text/javascript">
function delete_comment_tmodal(id)
{ 
//debugger;  
  var id = id; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Delete Comment",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'front/delete_comment',
              type: 'post',
              data: {id: id},
              success: function(data){ 
                $('#msg_id_tmodal'+id).html('<div class="conversation-list"><div class="ctext-wrap"><div class="conversation-name">Me</div><p><i><i class="mdi mdi-block-helper"></i> You deleted this message</i></p><p class="chat-time mb-0 text-muted"></p></div></div>');

                // $('#comment_form').trigger('reset');
                // $('.chat-conversation').load(document.URL + ' .chat-conversation>*');
                // $("#scrollbottom .simplebar-content-wrapper").scrollTop($("#scrollbottom .simplebar-content-wrapper").prop("scrollHeight"));
              }
            });
          }
      });       
}
</script>