<?php
if($ldetail)
{
?> 
            <div class="modal-header">
                    <h5 class="modal-title mt-0" id="LogoEditModalLabel">Edit Logo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                    <form method="post" name="edit_clogo_form" id="edit_clogo_form" enctype="multipart/form-data" autocomplete="off">
                                            <div data-repeater-list="outer-group" class="outer">
                                                <div data-repeater-item class="outer">
                                                    <input type="hidden" name="id" value="<?php echo $ldetail->id;?>">
                                                   
                                                    <div class="row mb-2">
                                                        <div class="col-lg-2">Logo <span class="text-danger">*</span></div>
                                                        <div class="col-lg-5">
                                                            <a href="javascript: void(0);" class="btn btn-outline-light waves-effect form-control" data-bs-toggle="modal" data-bs-target="#edit_Clogo" id="edit_clogo_text"><i class="fas fa-image"></i> Add / Change Logo</a>
                                                            <input type="hidden" name="clogo_edit" id="clogo_edit">
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <?php
                                                            if(!empty($ldetail->clogo))
                                                            {
                                                            ?>
                                                                <img class="avatar-md" id="clogo_edit-photo" src='<?php echo base_url("assets/clogo_photos/".$ldetail->clogo."")?>'>
                                                                <a href="javascript:void(0)" id="clogo_edit-photo-remove" onclick="return delete_clogo(<?php echo $ldetail->id?>);" title="Delete"><i class="bx bxs-x-square h3 m-1"></i></a>
                                                            <?php
                                                            }
                                                            ?>
                                                            <img class="avatar-md" id="clogo_edit-choosen-photo" style="display: none;">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label class="col-form-label col-lg-2">Link <span class="text-danger">*</span></label>
                                                        <div class="col-lg-10">
                                                            <input id="editlogo_link" name="editlogo_link" type="text" class="form-control" placeholder="Enter Company Link..." value="<?php echo $ldetail->logo_link;?>" required>
                                                            <span id="editlogo_linkErr" class="text-danger"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row float-end">
                                                        <div class="justify-content-end float-end">
                                                            <button type="submit" id="edit_clogo_button" class="btn btn-d btn-sm">Save Changes</button>
                                                            <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                                                        </div>
                                                    </div>                                                 
                                                </div>
                                            </div>                                    
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        </div>
<?php
}
?>  
<script type="text/javascript">
    // FOR EDIT clogo FORM ----------------------------------------
  $('#edit_clogo_form').on('submit',function(event){    
    event.preventDefault(); // Stop page from refreshing
    $('#edit_clogo_button').hide();
    $('#loader2').css('visibility','visible');
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'superadmin/edit_clogo',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:false,
         success: function(data){
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
            $('#edit_clogo_button').show();
            $('#loader2').css('visibility','hidden');  
          }
          else if(data.status == 'link_valid')
          {
              $('#editlogo_linkErr').html('Please Enter Valid Link!');
              $('#edit_clogo_button').show();
              $('#loader2').css('visibility','hidden');           
          }
          else if(data.status == true){
            //debugger;
            window.location.reload();
          }
          //console.log(data);
       }// success msg ends here

     });
  });

function delete_clogo(id)
{   
  var id = id;
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Delete Logo",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'superadmin/delete_clogo',
              type: 'post',
              data: {id: id},
              success: function(data){ 
                $('#clogo_edit-photo').remove();
                $('#clogo_edit-photo-remove').remove();
                $('#clogo'+id).remove();
                Swal.fire("Deleted!", "Successfully.", "success");
              }
            });
          }
      });       
}
</script>