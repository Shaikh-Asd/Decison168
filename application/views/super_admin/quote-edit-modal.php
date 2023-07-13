<?php
if($qdetail)
{
?> 
            <div class="modal-header">
                    <h5 class="modal-title mt-0" id="QuoteEditModalLabel">Edit Quote</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                    <form method="post" name="edit_quote_form" id="edit_quote_form" enctype="multipart/form-data" autocomplete="off">
                                            <div data-repeater-list="outer-group" class="outer">
                                                <div data-repeater-item class="outer">
                                                    <input type="hidden" name="id" value="<?php echo $qdetail->id;?>">
                                                   <div class="row mb-2">
                                                        <label class="col-form-label col-lg-2">Author <span class="text-danger">*</span></label>
                                                        <div class="col-lg-10">
                                                            <input id="writer" name="writer" type="text" class="form-control" placeholder="Enter Author Name..." required="" value="<?php echo $qdetail->writer;?>">
                                                        <span id="writerErr" class="text-danger"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label class="col-form-label col-lg-2">Quote <span class="text-danger">*</span></label>
                                                        <div class="col-lg-10">
                                                            <textarea class="form-control" id="quote" name="quote" rows="2" placeholder="Enter Quote..." required="" value="<?php echo $qdetail->quote;?>"><?php echo $qdetail->quote;?></textarea>
                                                            <span id="quoteErr" class="text-danger"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row float-end">
                                                        <div class="justify-content-end float-end">
                                                            <button type="submit" id="edit_quote_button" class="btn btn-d btn-sm">Save Changes</button>
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
    // FOR EDIT Quote FORM ----------------------------------------
  $('#edit_quote_form').on('submit',function(event){    
    event.preventDefault(); // Stop page from refreshing
    $('#edit_quote_button').hide();
    $('#loader2').css('visibility','visible');
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'superadmin/edit_quote',
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
            $('#edit_quote_button').show();
            $('#loader2').css('visibility','hidden');  
          }
          else if(data.status == 'link_valid')
          {
            $('#get_quote_clink_editErr').html('Please Enter Valid Link!');
            $('#edit_quote_button').show();
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
</script>