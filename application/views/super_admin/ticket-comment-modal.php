<style type="text/css">
    .emojiPickerIconWrap{
        width: 100% !important;
    }
    #message{
        width: 100% !important;
    }
    .emojiPickerIcon{
        height: 36px !important;
        width: 36px !important;
    }
</style>
<div class="modal-body">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <h4 class="card-title">Chat Section</h4>
                <div class="w-100 user-chat">
                    <div class="card">
                        <div id="scrollbottom_tmodal" class="chat-conversation p-2">
                            <ul class="list-unstyled mb-0" data-simplebar style="max-height: 300px;">
                                <?php
                                $data = array(  'notify' => 1,
                                                'notify_date' => date('Y-m-d H:i:s')
                                             );
                                $this->Superadmin_model->update_ticket_chat_notify($data,$tickets_del->ticket_id);
                                
                                $ticket_chat = $this->Superadmin_model->getTicketMessages($tickets_del->ticket_id);
                                if($ticket_chat){
                                    $tm_cnt=1;
                                    $comment_date = "";
                                    foreach ($ticket_chat as $tm) {
                                        $stud_del = $this->Superadmin_model->getStudentById($tm->user_id);
                                        $message_date = date('g:i A',strtotime($tm->message_date));
                                        $msg_date = date("Y-m-d", strtotime($tm->message_date));
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
                                                <span class="title"><?php echo date("j M, Y", strtotime($tm->message_date));?></span>
                                            </div>
                                        </li>
                                        <?php
                                        }
                                        if($tm->user_role == 'user'){
                                            ?>
                                            <li id="ticket_message<?php echo $tm->chat_id; ?>">
                                                <?php
                                                if($tm->status == 'active'){
                                                    ?>
                                                    <div class="conversation-list">
                                                        <div class="ctext-wrap">
                                                            <div class="conversation-name"><?php echo $stud_del->first_name.' '.$stud_del->last_name; ?> <small>(User)</small></div>
                                                            <p>
                                                                <?php 
                                                                $url = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';
                                                                $ticket_message= preg_replace($url, '<a href="$0" target="_blank" title="$0">$0</a>', $tm->message);
                                                                echo $ticket_message; 
                                                                ?>
                                                            </p>
                                                            <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> <?php echo $message_date; ?></p>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }else{
                                                   ?>
                                                   <div class="conversation-list">
                                                        <div class="ctext-wrap">
                                                            <div class="conversation-name"><?php echo $stud_del->first_name.' '.$stud_del->last_name; ?> <small>(User)</small></div>
                                                            <p><i><i class="mdi mdi-block-helper"></i> This message was deleted</i></p>
                                                        </div>
                                                    </div>
                                                    <?php 
                                                }
                                                ?>
                                            </li>
                                            <?php
                                        }else if($tm->user_role == 'supporter'){
                                            ?>
                                            <li id="ticket_message<?php echo $tm->chat_id; ?>">
                                                <?php
                                                if($tm->status == 'active'){
                                                    ?>
                                                    <div class="conversation-list">
                                                        <div class="ctext-wrap">
                                                            <div class="conversation-name"><?php echo $stud_del->first_name.' '.$stud_del->last_name; ?> <small>(Supporter)</small></div>
                                                            <p>
                                                                <?php 
                                                                $url = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';
                                                                $ticket_message= preg_replace($url, '<a href="$0" target="_blank" title="$0">$0</a>', $tm->message);
                                                                echo $ticket_message; 
                                                                ?>
                                                            </p>
                                                            <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> <?php echo $message_date; ?></p>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }else{
                                                   ?>
                                                   <div class="conversation-list">
                                                        <div class="ctext-wrap">
                                                            <div class="conversation-name"><?php echo $stud_del->first_name.' '.$stud_del->last_name; ?> <small>(Supporter)</small></div>
                                                            <p><i><i class="mdi mdi-block-helper"></i> This message was deleted</i></p>
                                                        </div>
                                                    </div>
                                                    <?php 
                                                }
                                                ?>
                                            </li>
                                            <?php
                                        }else if($tm->user_role == 'superadmin'){
                                            ?>
                                            <li class="right" id="ticket_message<?php echo $tm->chat_id; ?>">
                                                <?php
                                                if($tm->status == 'active'){
                                                    ?>
                                                    <div class="conversation-list">
                                                        <div class="dropdown">
                                                            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                              </a>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" onclick="return delete_ticket_chat('<?php echo $tm->chat_id; ?>');" href="javascript:void(0);">Delete</a>
                                                            </div>
                                                        </div>
                                                        <div class="ctext-wrap">
                                                            <div class="conversation-name">Support Admin</div>
                                                            <p>
                                                                <?php 
                                                                $url = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';
                                                                $ticket_message= preg_replace($url, '<a href="$0" target="_blank" title="$0">$0</a>', $tm->message);
                                                                echo $ticket_message; 
                                                                ?>
                                                            </p>
                                                            <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> <?php echo $message_date; ?></p>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }else{
                                                    ?>
                                                    <div class="conversation-list">
                                                        <div class="ctext-wrap">
                                                            <div class="conversation-name">Support Admin</div>
                                                            <p>
                                                                <i><i class="mdi mdi-block-helper"></i> You deleted this message</i>
                                                            </p>
                                                            <p class="chat-time mb-0 text-muted"></p>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </li> 
                                            <?php
                                        }
                                        $comment_date = $msg_date;
                                        $tm_cnt++;                            
                                    }
                                }else{
                                    ?>
                                    <p class="text-muted p-2 no_ticket_message">No message...</p>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="p-2 chat-input-section">
                            <?php
                            if($tickets_del->status == 'cancelled' || $tickets_del->status == 'closed'){
                                ?>
                                <span class="text-muted mt-4">Ticket is <?php echo $tickets_del->status; ?>..</span> &nbsp;&nbsp;
                                <?php
                                $ticket_chat = $this->Superadmin_model->getTicketMessages($tickets_del->ticket_id);
                                if($ticket_chat){
                                ?>
                                    <button type="button" onclick="window.location='<?php echo base_url('super-admin/download-chat/'.$tickets_del->ticket_id); ?>'"; class="btn btn-sm btn-d waves-effect waves-light float-end"><span class="d-none d-sm-inline-block me-2">Download Chat</span> <i class="mdi mdi-download"></i></button>
                                    <?php
                                }
                            }else{
                                ?>
                                <form method="post" class="ticket_chat_form" id="ticket_chat_form" enctype="multipart/form-data" autocomplete="off">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="position-relative">
                                                <input type="text" id="message" name="message" class="form-control chat-input" placeholder="Enter Message..." required="">                                            
                                                <span id="messageErr" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <input type="hidden" name="ticket_id" id="ticket_id" value="<?php echo $tickets_del->ticket_id; ?>">

                                            <?php
                                            $ticket_chat = $this->Superadmin_model->getTicketMessages($tickets_del->ticket_id);
                                            if($ticket_chat){
                                            ?>
                                                <button type="button" onclick="window.location='<?php echo base_url('super-admin/download-chat/'.$tickets_del->ticket_id); ?>'"; class="btn btn-sm btn-d waves-effect waves-light mt-2"><span class="d-none d-sm-inline-block me-2">Download Chat</span> <i class="mdi mdi-download"></i></button>
                                                <?php
                                            }
                                            ?>

                                            <button type="submit" id="ticket_chat_button" class="btn btn-sm btn-d chat-send waves-effect waves-light float-end mt-2"><span class="d-none d-sm-inline-block me-2">Send</span> <i class="mdi mdi-send"></i></button>
                                            <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                                        </div>
                                    </div>
                                </form>
                                <?php
                            }
                            ?>
                        </div>
                        <p class="download-content" style="display: none;"><?php
                        $ticket_chat = $this->Superadmin_model->getTicketMessages($tickets_del->ticket_id);
                        if($ticket_chat){
                            foreach ($ticket_chat as $tm) {
                                $supp_del = $this->Superadmin_model->getStudentById($tm->user_id);
                                if($tm->status == 'active'){
                                    if($tm->user_role == 'supporter'){
                                        echo $tm->message_date." - ".$supp_del->first_name." ".$supp_del->last_name."(Supporter): ".$tm->message."\r\n"; 
                                    }
                                    else if($tm->user_role == 'superadmin'){
                                        echo $tm->message_date." - Support Admin: ".$tm->message."\r\n"; 
                                    }
                                    else{
                                        echo $tm->message_date." - ".$supp_del->first_name." ".$supp_del->last_name."(User): ".$tm->message."\r\n"; 
                                    }
                                }else{
                                    if($tm->user_role == 'supporter'){
                                        echo $tm->message_date." - ".$supp_del->first_name." ".$supp_del->last_name.": This message was deleted\r\n";
                                    }
                                    else if($tm->user_role == 'superadmin'){
                                        echo $tm->message_date." - Support Admin: You deleted this message\r\n";
                                    }
                                    else{
                                        echo $tm->message_date." - ".$supp_del->first_name." ".$supp_del->last_name.": This message was deleted\r\n";
                                    }   
                                }                  
                            }
                        }
                        ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#message').emojiPicker({
        position: 'left',
        width: '100%',
        height: '230px'
    });
    $('#ticket_chat_form').on('submit',function(event){    
    event.preventDefault(); // Stop page from refreshing
    $('#ticket_chat_button').hide();
    $('#loader2').css('visibility','visible');
    var formData = new FormData(this); 
    $.ajax({
      url:base_url+'superadmin/insert_ticket_chat',
      type:"POST",
      data:formData,
      contentType:false,
      processData:false,
      cache:false,
      success: function(data){
        $('#ticket_chat_button').show();
        $('#loader2').css('visibility','hidden'); 
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
        else{ 
            $('.no_ticket_message').hide();
            $('#ticket_chat_form').trigger('reset');
            $('#ticketCommentModal_content').html(data);
            $("#scrollbottom_tmodal .simplebar-content-wrapper").scrollTop($("#scrollbottom_tmodal .simplebar-content-wrapper").prop("scrollHeight"));
        }
        // console.log(data);
    }// success msg ends here
     });
  });

function delete_ticket_chat(chat_id)
{ 
//debugger;  
  var chat_id = chat_id; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Delete the Chat",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'superadmin/delete_ticket_chat',
              type: 'post',
              data: {chat_id: chat_id},
              success: function(data){ 
                $('#ticket_message'+chat_id).html('<div class="conversation-list"><div class="ctext-wrap"><div class="conversation-name">Support Admin</div><p><i><i class="mdi mdi-block-helper"></i> You deleted this message</i></p><p class="chat-time mb-0 text-muted"></p></div></div>');
              }
            });
          }
      });       
}

function saveFile(){
    
    // Get the data from each element on the form
    var msg = $('.download-content').html();
    
    // This variable stores all the data.
    var data = msg;
    
    // Convert the text to BLOB.
    let textToBLOB = new Blob([data], {type: 'text/html'});
    let sFileName = 'chat-T<?php echo $tickets_del->unique_id; ?>.txt';      // The file to save the data.

    var newLink = document.createElement("a");
    newLink.download = sFileName;

    if (window.webkitURL != null) {
        newLink.href = window.webkitURL.createObjectURL(textToBLOB);
    }
    else {
        newLink.href = window.URL.createObjectURL(textToBLOB);
        newLink.style.display = "none";
        document.body.appendChild(newLink);
    }

    newLink.click(); 
}
</script>