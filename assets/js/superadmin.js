var base_url = 'http://localhost/decision168/';
$(document).ready(function(){ 
  // FOR LOGIN FORM -------------------------------------------------------
  $('#login_form').on('submit',function(event){   
    event.preventDefault(); // Stop page from refreshing
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'superadmin/check_login',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:false,
         success: function(data){
          if (data.status == false) {
          //show errors
          $('#recaptchaErr').html(data.errors);
        
          }else if(data.status == true){
              window.location = base_url+'super-admin/dashboard';
          }
          //console.log(data);
       }// success msg ends here
     });
  });

  // FOR ADD Quote FORM ----------------------------------------
        $('#add_quoteForm').on('submit',function(event){
          //debugger;          
          event.preventDefault(); // Stop page from refreshing
          $('#add_quoteButton').hide();
          $('#loader2').css('visibility', 'visible');
         var formData = new FormData(this); 
          $.ajax({
               url:base_url+'superadmin/insert_quote',
               type:"POST",
               data:formData,
               contentType:false,
               processData:false,
               cache:true,
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
                  $('#add_quoteButton').show();
                  $('#loader2').css('visibility','hidden'); 
                }
                else if(data.status == true){
                 window.location.reload();
                }
                //console.log(data);
             }// success msg ends here
           });
        });

        // FOR ADD Logo FORM ----------------------------------------
        $('#add_logoForm').on('submit',function(event){
          //debugger;          
          event.preventDefault(); // Stop page from refreshing
          $('#add_logoButton').hide();
          $('#loader2').css('visibility', 'visible');
         var formData = new FormData(this); 
          $.ajax({
               url:base_url+'superadmin/insert_logo',
               type:"POST",
               data:formData,
               contentType:false,
               processData:false,
               cache:true,
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
                  $('#add_logoButton').show();
                  $('#loader2').css('visibility','hidden'); 
                }
                else if(data.status == 'link_valid')
                {
                  $('#logo_linkErr').html('Please Enter Valid Link!');
                  $('#add_logoButton').show();
                  $('#loader2').css('visibility','hidden');           
                }
                else if(data.status == true){
                 window.location.reload();
                }
                //console.log(data);
             }// success msg ends here
           });
        });

  // FOR ADD Package FORM ----------------------------------------
        $('#add_packageForm').on('submit',function(event){
          //debugger;          
          event.preventDefault(); // Stop page from refreshing
          $('#add_packageButton').hide();
          $('#loader2').css('visibility', 'visible');
         var formData = new FormData(this); 
          $.ajax({
               url:base_url+'superadmin/insert_package',
               type:"POST",
               data:formData,
               contentType:false,
               processData:false,
               cache:true,
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
                  $('#add_packageButton').show();
                  $('#loader2').css('visibility','hidden'); 
                }
                else if(data.status == true){
                 window.location.reload();
                }
                //console.log(data);
             }// success msg ends here
           });
        });

  // FOR EDIT Package FORM ----------------------------------------
  $('#edit_package_form').on('submit',function(event){    
    event.preventDefault(); // Stop page from refreshing
    $('#edit_package_button').hide();
    $('#loader2').css('visibility','visible');
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'superadmin/edit_package',
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
            $('#edit_package_button').show();
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

  // FOR Change Label FORM ----------------------------------------
        $('#change_labelForm').on('submit',function(event){
          //debugger;          
          event.preventDefault(); // Stop page from refreshing
          $('#change_labelButton').hide();
          $('#loader2').css('visibility', 'visible');
         var formData = new FormData(this); 
          $.ajax({
               url:base_url+'superadmin/edit_change_labels',
               type:"POST",
               data:formData,
               contentType:false,
               processData:false,
               cache:true,
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
                  $('#change_labelButton').show();
                  $('#loader2').css('visibility','hidden'); 
                }
                else if(data.status == true){
                 //window.location.reload();
                 $('#change_label').modal('hide');
                }
                //console.log(data);
             }// success msg ends here
           });
        });

        // FOR ADD AD HEADER FORM ----------------------------------------
        $('#add_HeaderForm').on('submit',function(event){
          //debugger;          
          event.preventDefault(); // Stop page from refreshing
          $('#add_HeaderButton').hide();
          $('#loader2').css('visibility', 'visible');
         var formData = new FormData(this); 
          $.ajax({
               url:base_url+'superadmin/insert_ad_header',
               type:"POST",
               data:formData,
               contentType:false,
               processData:false,
               cache:true,
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
                  $('#add_HeaderButton').show();
                  $('#loader2').css('visibility','hidden'); 
                }
                else if(data.status == 'adErr')
                {
                  $('#adErr').html(data.photoerr);
                }
                else if(data.status == 'ad_emptyErr')
                {
                  $('#adErr').html('Image is required!');
                }
                else if(data.status == true){
                 window.location.reload();
                }
                //console.log(data);
             }// success msg ends here
           });
        });

        // FOR ADD COUPON FORM ----------------------------------------
        $('#Add_couponForm').on('submit',function(event){
          //debugger;          
          event.preventDefault(); // Stop page from refreshing
          $('#Add_couponButton').hide();
          $('#loader2').css('visibility', 'visible');
         var formData = new FormData(this); 
          $.ajax({
               url:base_url+'superadmin/insert_coupon',
               type:"POST",
               data:formData,
               contentType:false,
               processData:false,
               cache:true,
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
                  $('#Add_couponButton').show();
                  $('#loader2').css('visibility','hidden'); 
                }
                else if(data.status == true){
                 window.location.reload();
                }
                //console.log(data);
             }// success msg ends here
           });
        });

        // FOR EDIT COUPON FORM ----------------------------------------
        $('#coupon_package_form').on('submit',function(event){    
          event.preventDefault(); // Stop page from refreshing
          $('#edit_coupon_button').hide();
          $('#loader2').css('visibility','visible');
         var formData = new FormData(this); 
          $.ajax({
               url:base_url+'superadmin/edit_coupon',
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
                  $('#edit_coupon_button').show();
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

  // Support functions ------//-----//----//----//----

  $('#addSupporterForm').on('submit',function(event){
    //debugger;          
    event.preventDefault(); // Stop page from refreshing
    $('#addSupporterButton').hide();
    $('#loader2').css('visibility', 'visible');
    var formData = new FormData(this); 
    $.ajax({
         url:base_url+'superadmin/addSupporter',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:true,
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
            $('#addSupporterButton').show();
            $('#loader2').css('visibility','hidden'); 
          }
          else if(data.status == 'already_supporter')
          {
             $('#ismemberErr').html('Already a Supporter!');
             $('#addSupporterButton').show();
             $('#loader2').css('visibility', 'hidden');
          }
          else if(data.status == 'already_invited')
          {
             $('#ismemberErr').html('Already Invited!');
             $('#addSupporterButton').show();
             $('#loader2').css('visibility', 'hidden');
          }
          else if(data.status == 'empty_supporter')
          {
             $('#selected_S_memberErr').html('Please select Member To Invite!');
             $('#addSupporterButton').show();
             $('#loader2').css('visibility', 'hidden');
          }
          else if(data.status == true){
           window.location.reload();
          }
          console.log(data);
       }// success msg ends here
     });
  });

  // FOR  EXPORT TO PDF FORM ----------------------------------------
  $('#history_pdf_format_form').on('submit',function(event){
    //debugger;
    event.preventDefault();
    var formData = new FormData(this); 
    Swal.fire({
      title: "You Want To Download History in PDF Format?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            //debugger;
              $.ajax({
                   url:base_url+'superadmin/history_pdf_format',
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
                      $('#history_pdf_format_button').show();
                      $('#loader2').css('visibility','hidden');
                    }
                    else if(data.status == 'empty_option')
                    {
                      $('#empty_optionErr').html('Please Select Any One Option to Export History in PDF Format!');  
                      $('#history_pdf_format_button').show();
                      $('#loader2').css('visibility','hidden');         
                    }
                    else if(data.status == 'not_found')
                    {
                      $('#empty_optionErr').html('No Record Found!');  
                      $('#history_pdf_format_button').show();
                      $('#loader2').css('visibility','hidden'); 
                    }
                    else if(data.status == true)
                    {
                      //debugger;
                      $('#empty_optionErr').html('');  
                      $('#only_date').val('');
                      $('#start_date').val('');
                      $('#end_date').val('');
                      $('#all_history').prop('checked', false);
                      $('#pdf_format_date_options').modal('hide');
                      window.location = base_url+'superadmin/export_pdf_format';
                    }
                    //console.log(data);
                 }// success msg ends here

               });
          }
      }); 
  });

  $( '.assign_supporter' ).select2({
    /* Sort data using localeCompare- task assignee alphabetical order  */
    sorter: data => data.sort((a, b) => a.text.localeCompare(b.text)),
  });

  $( '#supporter_member' ).select2({
    /* Sort data using localeCompare- task assignee alphabetical order  */
    sorter: data => data.sort((a, b) => a.text.localeCompare(b.text)),
  });
  // Support functions ------//-----//----//----//----

});

////////////////////////////////////////////////////////

function logout()
{   
            Swal.fire({
                title: "Are you sure?",
                text: "You want to logout!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#c7df19",
                cancelButtonColor: "#383838",
                confirmButtonText: "Yes"
              }).then(function (result) {
                if (result.value) {
                    $.ajax({
                    url: base_url+'superadmin/logout',
                    type: 'POST', 
                    success: function(html){
                      Swal.fire("Logged Out!", "Successfully.", "success");
                      window.location.reload();
                    }
                  });
                }
            });       
}

//quote edit modal
function QuoteEditModal(id){   
  //debugger;        
           var id = id;
           // AJAX request
           $.ajax({
            url:  base_url+'superadmin/QuoteEdit_Modal',
            type: 'post',
            data: {id: id},
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#QuoteModal_content').html(data);
              // Display Modal
              $('#QuoteEditModal').modal('show'); 
            }
          });
}

function QuoteDeleteModal(id)
{   
  var id = id; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Delete",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'superadmin/delete_quote',
              type: 'post',
              data: {id: id},
              success: function(data){ 
                Swal.fire("Deleted!", "Successfully.", "success");
                window.location.reload();
              }
            });
          }
      });       
}

function QuoteApprove(id)
{   
  var id = id; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Approve",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'superadmin/approve_quote',
              type: 'post',
              data: {id: id},
              success: function(data){ 
                Swal.fire("Approved!", "Successfully.", "success");
                window.location.reload();
              }
            });
          }
      });       
}

function QuoteDeny(id)
{   
  var id = id; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Deny",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'superadmin/deny_quote',
              type: 'post',
              data: {id: id},
              success: function(data){ 
                Swal.fire("Denied!", "Successfully.", "success");
                window.location.reload();
              }
            });
          }
      });       
}

//package edit modal
function PackageEditModal(id){   
  //debugger;        
   var id = id;
   // AJAX request
   $.ajax({
    url:  base_url+'superadmin/PackageEdit_Modal',
    type: 'post',
    data: {id: id},
    success: function(data){ 
      // Add response in Modal body
      //console.log(data);
      $('#PackageEditModal_content').html(data);
      // Display Modal
      $('#PackageEditModal').modal('show'); 
    }
  });
}

//package view modal
function PackageViewModal(id){   
  //debugger;        
   var id = id;
   // AJAX request
   $.ajax({
    url:  base_url+'superadmin/PackageView_Modal',
    type: 'post',
    data: {id: id},
    success: function(data){ 
      // Add response in Modal body
      //console.log(data);
      $('#PackageViewModal_content').html(data);
      // Display Modal
      $('#PackageViewModal').modal('show'); 
    }
  });
}

function refund_complete(reg_id)
{
  var reg_id = reg_id;
  $.ajax({
          url:  base_url+'superadmin/refund_complete',
          type: 'post',
          data: {reg_id: reg_id},
          success: function(data)
          { 
            if(data.status == true)
            {
              window.location.reload();
            }                
          }
        });
}

function Inactive_Pack(id)
{   
  var id = id;
  var status = 'inactive'; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Inactive Package?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'superadmin/change_package_status',
              type: 'post',
              data: {id: id, status: status},
              success: function(data){ 
                Swal.fire("Inactive!", "Successfully.", "success");
                window.location.reload();
              }
            });
          }
      });       
}

function Active_Pack(id)
{   
  var id = id;
  var status = 'active'; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Active Package?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'superadmin/change_package_status',
              type: 'post',
              data: {id: id, status: status},
              success: function(data){ 
                Swal.fire("Active!", "Successfully.", "success");
                window.location.reload();
              }
            });
          }
      });       
}

//change label modal
function change_labelModal(id){   
  //debugger;        
           var id = id;
           // AJAX request
           $.ajax({
            url:  base_url+'superadmin/change_labels',
            type: 'post',
            data: {id: id},
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#change_label_content').html(data);
              // Display Modal
              $('#change_label').modal('show'); 
            }
          });
}

//View Registered Info Modal Modal
function ViewRegisteredInfoModal(id){   
  //debugger;        
           var id = id;
           // AJAX request
           $.ajax({
            url:  base_url+'superadmin/view_registered_info',
            type: 'post',
            data: {id: id},
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#ViewRegisteredInfoModal_content').html(data);
              // Display Modal
              $('#ViewRegisteredInfoModal').modal('show'); 
            }
          });
}

//logo edit modal
function LogoEditModal(id){   
  //debugger;        
           var id = id;
           // AJAX request
           $.ajax({
            url:  base_url+'superadmin/LogoEdit_Modal',
            type: 'post',
            data: {id: id},
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#LogoModal_content').html(data);
              // Display Modal
              $('#LogoEditModal').modal('show'); 
            }
          });
}

function LogoDeleteModal(id)
{   
  var id = id; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Delete",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'superadmin/delete_ad_logo',
              type: 'post',
              data: {id: id},
              success: function(data){ 
                Swal.fire("Deleted!", "Successfully.", "success");
                window.location.reload();
              }
            });
          }
      });       
}

function LogoApprove(id)
{   
  var id = id; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Approve",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'superadmin/approve_logo',
              type: 'post',
              data: {id: id},
              success: function(data){ 
                Swal.fire("Approved!", "Successfully.", "success");
                window.location.reload();
              }
            });
          }
      });       
}

function LogoDeny(id)
{   
  var id = id; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Deny",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'superadmin/deny_logo',
              type: 'post',
              data: {id: id},
              success: function(data){ 
                Swal.fire("Denied!", "Successfully.", "success");
                window.location.reload();
              }
            });
          }
      });       
}

function ActivateUserAccount(id)
{   
  var id = id; 
  var href_link = $('#activate_acc'+id).attr('data-link');
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Activate User Account",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            location.href = base_url+href_link;
          }
      });       
}

function toggle_package_fields()
{
  var pack_stripe_link = $('#pack_stripe_link').val();
  if(pack_stripe_link == 'yes')
  {
    $('#show_pack_validity').show();
    $('#show_pack_price').show().attr("required","required");
    $('#pack_validity').attr("required","required");
    $('#pack_price').attr("required","required");
  }
  else if(pack_stripe_link == 'no')
  {
    $('#show_pack_validity').hide();
    $('#show_pack_price').hide();
    $('#pack_validity').removeAttr("required");
    $('#pack_price').removeAttr("required");
  }
  else
  {
    $('#show_pack_validity').show();
    $('#show_pack_price').show();
    $('#pack_validity').attr("required","required");
    $('#pack_price').attr("required","required");
  }
}

function pass_cus_user_id(contacted_id,user_id)
{
  var contacted_id = contacted_id;
  var user_id = user_id;
  $('#user_id').val(user_id);
  $('#contacted_id').val(contacted_id);
}

function AdDeleteModal(id)
{   
  var id = id; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Delete",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'superadmin/delete_ad_header',
              type: 'post',
              data: {id: id},
              success: function(data){ 
                Swal.fire("Deleted!", "Successfully.", "success");
                window.location.reload();
              }
            });
          }
      });       
}

function Ad_Inactive(id)
{   
  var id = id;
  var status = 'inactive'; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Inactive?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'superadmin/change_ad_status',
              type: 'post',
              data: {id: id, status: status},
              success: function(data){ 
                Swal.fire("Inactive!", "Successfully.", "success");
                window.location.reload();
              }
            });
          }
      });       
}

function Ad_Active(id)
{   
  var id = id;
  var status = 'active'; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Active?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'superadmin/change_ad_status',
              type: 'post',
              data: {id: id, status: status},
              success: function(data){ 
                Swal.fire("Active!", "Successfully.", "success");
                window.location.reload();
              }
            });
          }
      });       
}

//package edit modal
function CouponEditModal(co_id,pack_id){   
  //debugger;        
           var co_id = co_id;
           var pack_id = pack_id;
           // AJAX request
           $.ajax({
            url:  base_url+'superadmin/CouponEdit_Modal',
            type: 'post',
            data: {co_id: co_id, pack_id: pack_id},
            success: function(data){ 
              // Add response in Modal body
              //console.log(data);
              $('#CouponEditModal_content').html(data);
              // Display Modal
              $('#CouponEditModal').modal('show'); 
            }
          });
}

function Coupon_Inactive(id)
{   
  var id = id;
  var status = 'inactive'; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Inactive?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'superadmin/change_coupon_status',
              type: 'post',
              data: {id: id, status: status},
              success: function(data){ 
                Swal.fire("Inactive!", "Successfully.", "success");
                window.location.reload();
              }
            });
          }
      });       
}

function Coupon_Active(id)
{   
  var id = id;
  var status = 'active'; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Active?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'superadmin/change_coupon_status',
              type: 'post',
              data: {id: id, status: status},
              success: function(data){ 
                Swal.fire("Active!", "Successfully.", "success");
                window.location.reload();
              }
            });
          }
      });       
}

function pack_clone_details()
{
  var pack_clone = $('#pack_clone').val();
  //console.log(pack_clone);
  if(pack_clone == 'cus_coupon')
  {
    //console.log('yes');
    $('#pack_name').val(''); 
    $('#pack_portfolio').val(''); 
    $('#pack_goals').val(''); 
    $('#pack_goals_strategies').val(''); 
    $('#pack_projects').val(''); 
    $('#pack_team_members').val(''); 
    $('#pack_tasks').val(''); 
    $('#pack_storage').val(''); 
    $('#pack_content_planner').val(''); 
    $('#pack_tagline').val(''); 
  }
  else
  {
    //console.log('no');
    $.ajax({
        url: base_url+'superadmin/get_pack_field_details',
        method: 'POST',
        data: {pack_clone:pack_clone},  
        success: function(resp) {
            $('#pack_name').val(resp.pack_name);  
            $('#pack_portfolio').val(resp.pack_portfolio);
            $('#pack_goals').val(resp.pack_goals);
            $('#pack_goals_strategies').val(resp.pack_goals_strategies);
            $('#pack_projects').val(resp.pack_projects);
            $('#pack_team_members').val(resp.pack_team_members);
            $('#pack_tasks').val(resp.pack_tasks);
            $('#pack_storage').val(resp.pack_storage);
            $('#pack_content_planner').val(resp.pack_content_planner);
            $('#pack_tagline').val(resp.pack_tagline);                               
        }
    }); 
  }
}

function DeleteContactSalesReq(id)
{   
  var id = id; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Delete Request?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'superadmin/delete_contactsales_req',
              type: 'post',
              data: {id: id, status: status},
              success: function(data){ 
                Swal.fire("Deleted!", "Successfully.", "success");
                window.location.reload();
              }
            });
          }
      });       
}


// Support functions ------//-----//----//----//----
//Preview overview modal
function ticketOverviewModal(id){           
  var id = id;
 // AJAX request
  $.ajax({
    url:  base_url+'superadmin/ticketOverview_Modal',
    type: 'post',
    data: {id: id},
    success: function(data){ 
      // Add response in Modal body
      //console.log(data);
      $('#ticketOverviewModal_content').html(data);
      // Display Modal
      $('#ticketOverviewModal').modal('show'); 
    }
  });
}

//preview modal for task attached file
function previewTicketFile(tfile_name,tid){           
 var tfile_name = tfile_name;
 var tid = tid;
 // AJAX request
 $.ajax({
    url:  base_url+'superadmin/preview_ticket_file',
    type: 'post',
    data: {tfile_name: tfile_name, tid: tid},
    success: function(data){ 
      // Add response in Modal body
      //console.log(data);
      $('#previewTicketFile_Content').html(data);
      // Display Modal
      $('#previewTicketModal').modal('show'); 
    }
  });
}

function ticket_filter()
{
  if($('#all_ticket').is(":checked"))
  {
    $(".my_ticket").show();
    $(".assigned_ticket").show();
  }
  else if($('#my_ticket').is(":checked"))
  {
    $(".my_ticket").show();
    $(".assigned_ticket").hide();
  }
  else if($('#assigned_ticket').is(":checked"))
  {
    $(".my_ticket").hide();
    $(".assigned_ticket").show();
  }
}

function ticket_filter()
{
  if($('#all_ticket').is(":checked"))
  {
    $(".open_ticket").show();
    $(".assigned_ticket").show();
    $(".in_progress_ticket").show();
    $(".in_review_ticket").show();
    $(".pending_ticket").show();
    $(".resolved_ticket").show();
    $(".closed_ticket").show();
    $(".cancelled_ticket").show();
  }
  else if($('#open_ticket').is(":checked"))
  {
    $(".open_ticket").show();
    $(".assigned_ticket").hide();
    $(".in_progress_ticket").hide();
    $(".in_review_ticket").hide();
    $(".pending_ticket").hide();
    $(".resolved_ticket").hide();
    $(".closed_ticket").hide();
    $(".cancelled_ticket").hide();
  }
  else if($('#assigned_ticket').is(":checked"))
  {
    $(".open_ticket").hide();
    $(".assigned_ticket").show();
    $(".in_progress_ticket").hide();
    $(".in_review_ticket").hide();
    $(".pending_ticket").hide();
    $(".resolved_ticket").hide();
    $(".closed_ticket").hide();
    $(".cancelled_ticket").hide();
  }
  else if($('#in_progress_ticket').is(":checked"))
  {
    $(".open_ticket").hide();
    $(".assigned_ticket").hide();
    $(".in_progress_ticket").show();
    $(".in_review_ticket").hide();
    $(".pending_ticket").hide();
    $(".resolved_ticket").hide();
    $(".closed_ticket").hide();
    $(".cancelled_ticket").hide();
  }
  else if($('#in_review_ticket').is(":checked"))
  {
    $(".open_ticket").hide();
    $(".assigned_ticket").hide();
    $(".in_progress_ticket").hide();
    $(".in_review_ticket").show();
    $(".pending_ticket").hide();
    $(".resolved_ticket").hide();
    $(".closed_ticket").hide();
    $(".cancelled_ticket").hide();
  }
  else if($('#pending_ticket').is(":checked"))
  {
    $(".open_ticket").hide();
    $(".assigned_ticket").hide();
    $(".in_progress_ticket").hide();
    $(".in_review_ticket").hide();
    $(".pending_ticket").show();
    $(".resolved_ticket").hide();
    $(".closed_ticket").hide();
    $(".cancelled_ticket").hide();
  }
  else if($('#resolved_ticket').is(":checked"))
  {
    $(".open_ticket").hide();
    $(".assigned_ticket").hide();
    $(".in_progress_ticket").hide();
    $(".in_review_ticket").hide();
    $(".pending_ticket").hide();
    $(".resolved_ticket").show();
    $(".closed_ticket").hide();
    $(".cancelled_ticket").hide();
  }
  else if($('#closed_ticket').is(":checked"))
  {
    $(".open_ticket").hide();
    $(".assigned_ticket").hide();
    $(".in_progress_ticket").hide();
    $(".in_review_ticket").hide();
    $(".pending_ticket").hide();
    $(".resolved_ticket").hide();
    $(".closed_ticket").show();
    $(".cancelled_ticket").hide();
  }
  else if($('#cancelled_ticket').is(":checked"))
  {
    $(".open_ticket").hide();
    $(".assigned_ticket").hide();
    $(".in_progress_ticket").hide();
    $(".in_review_ticket").hide();
    $(".pending_ticket").hide();
    $(".resolved_ticket").hide();
    $(".closed_ticket").hide();
    $(".cancelled_ticket").show();
  }
}

function ticket_filter2()
{
  if($('#all_ticket2').is(":checked"))
  {
    $(".open_ticket").show();
    $(".assigned_ticket").show();
    $(".in_progress_ticket").show();
    $(".in_review_ticket").show();
    $(".pending_ticket").show();
    $(".resolved_ticket").show();
    $(".closed_ticket").show();
    $(".cancelled_ticket").show();
  }
  else if($('#open_ticket2').is(":checked"))
  {
    $(".open_ticket").show();
    $(".assigned_ticket").hide();
    $(".in_progress_ticket").hide();
    $(".in_review_ticket").hide();
    $(".pending_ticket").hide();
    $(".resolved_ticket").hide();
    $(".closed_ticket").hide();
    $(".cancelled_ticket").hide();
  }
  else if($('#assigned_ticket2').is(":checked"))
  {
    $(".open_ticket").hide();
    $(".assigned_ticket").show();
    $(".in_progress_ticket").hide();
    $(".in_review_ticket").hide();
    $(".pending_ticket").hide();
    $(".resolved_ticket").hide();
    $(".closed_ticket").hide();
    $(".cancelled_ticket").hide();
  }
  else if($('#in_progress_ticket2').is(":checked"))
  {
    $(".open_ticket").hide();
    $(".assigned_ticket").hide();
    $(".in_progress_ticket").show();
    $(".in_review_ticket").hide();
    $(".pending_ticket").hide();
    $(".resolved_ticket").hide();
    $(".closed_ticket").hide();
    $(".cancelled_ticket").hide();
  }
  else if($('#in_review_ticket2').is(":checked"))
  {
    $(".open_ticket").hide();
    $(".assigned_ticket").hide();
    $(".in_progress_ticket").hide();
    $(".in_review_ticket").show();
    $(".pending_ticket").hide();
    $(".resolved_ticket").hide();
    $(".closed_ticket").hide();
    $(".cancelled_ticket").hide();
  }
  else if($('#pending_ticket2').is(":checked"))
  {
    $(".open_ticket").hide();
    $(".assigned_ticket").hide();
    $(".in_progress_ticket").hide();
    $(".in_review_ticket").hide();
    $(".pending_ticket").show();
    $(".resolved_ticket").hide();
    $(".closed_ticket").hide();
    $(".cancelled_ticket").hide();
  }
  else if($('#resolved_ticket2').is(":checked"))
  {
    $(".open_ticket").hide();
    $(".assigned_ticket").hide();
    $(".in_progress_ticket").hide();
    $(".in_review_ticket").hide();
    $(".pending_ticket").hide();
    $(".resolved_ticket").show();
    $(".closed_ticket").hide();
    $(".cancelled_ticket").hide();
  }
  else if($('#closed_ticket2').is(":checked"))
  {
    $(".open_ticket").hide();
    $(".assigned_ticket").hide();
    $(".in_progress_ticket").hide();
    $(".in_review_ticket").hide();
    $(".pending_ticket").hide();
    $(".resolved_ticket").hide();
    $(".closed_ticket").show();
    $(".cancelled_ticket").hide();
  }
  else if($('#cancelled_ticket2').is(":checked"))
  {
    $(".open_ticket").hide();
    $(".assigned_ticket").hide();
    $(".in_progress_ticket").hide();
    $(".in_review_ticket").hide();
    $(".pending_ticket").hide();
    $(".resolved_ticket").hide();
    $(".closed_ticket").hide();
    $(".cancelled_ticket").show();
  }
}

function show_FilterOptions()
{
  if($('.filtercollapse').css('display','block'))
  {
    $('.filtercollapse').css('display','none');
  }
  if($('.filtercollapse').css('display','none'))
  {
    $('.filtercollapse').css('display','block');
  }
}

function assignTicket(supporter_id,ticket_id)
{
  Swal.fire({
  title: "Are you sure?",
  text: "You want to Assign the Ticket",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#c7df19",
  cancelButtonColor: "#383838",
  confirmButtonText: "Yes"
  }).then(function (result) {
      if (result.value) {
        // AJAX request
        $.ajax({
          url:  base_url+'superadmin/assign_ticket',
          type: 'post',
          data: {
            supporter_id: supporter_id, ticket_id: ticket_id
          },
          success: function(data){ 
            if(data.status == 'assigned'){
              $('.status-row-'+ticket_id).html('Assigned');
              $('#assign_supporter'+ticket_id).find('option[value=""]').remove();
              Swal.fire("Assigned!", "Successfully.", "success");
            }
          }
        });
      }
  });        
}

function showTicketNotification(status,ticket_id,cnt)
{
  $.ajax({
    url:  base_url+'superadmin/show_ticket_notification',
    type: 'post',
    data: {
      status: status, ticket_id: ticket_id
    },
    success: function(data){ 
      $('#ticket_row'+cnt).remove();
      var notify_count = $("#notification-div a.new_notify_top").length;
      $('#notification-count').html(notify_count);   
      $('#ticketOverviewModal_content').html(data);
      $('#ticketOverviewModal').modal('show');    
    }
  });        
}

function removeTicketNotification(status,ticket_id,cnt)
{
  $.ajax({
    url:  base_url+'superadmin/remove_ticket_notification',
    type: 'post',
    data: {
      status: status, ticket_id: ticket_id
    },
    success: function(data){ 
      $('#ticket_row'+cnt).remove();
      var notify_count = $("#notification-div a.new_notify_top").length;
      $('#notification-count').html(notify_count);       
    }
  });        
}

function AllNotificationClearYes(){    
//debugger;       
Swal.fire({
  title: "Are you sure?",
  text: "You want to Clear All Notification",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#c7df19",
  cancelButtonColor: "#383838",
  confirmButtonText: "Yes"
  }).then(function (result) {
      if (result.value) {
        // AJAX request
         $.ajax({
          url:  base_url+'superadmin/AllNotificationClearYes',
          type: 'post',
          success: function(data){
            //debugger; 
            Swal.fire("Cleared!", "Successfully.", "success");
            window.location.reload();
          }
        });
      }
  });          
}

//Preview comment modal
function ticketCommentModal(id){           
  var id = id;
 // AJAX request
  $.ajax({
    url:  base_url+'superadmin/ticketComment_Modal',
    type: 'post',
    data: {id: id},
    success: function(data){ 
      // Add response in Modal body
      //console.log(data);
      $('#ticketCommentModal_content').html(data);
      // Display Modal
      $('#ticketCommentModal').modal('show'); 
      $('#chat-notification'+id).hide(); 

    }
  });
}

function display_ticket_hlist(ticket_id,hdate)
{
  //debugger;
  if($('#hlist'+hdate).hasClass('shown'))
  {
    $('.clear_list').html('');
    $('#hlist'+hdate).removeClass('shown');
  }
  else
  {
    $('.clear_list').html('');
    $('.clear_list').removeClass('shown');
    var ticket_id = ticket_id;
    var hdate = hdate;
    $.ajax({
        url: base_url+'superadmin/view_ticket_history_date_wise',
        method: 'POST',
        data: {ticket_id:ticket_id, hdate:hdate},  
        success: function(data) {
            $('#hlist'+hdate).html(data);
            $('#hlist'+hdate).addClass('shown');
            //console.log(data);                   
        }
    });
  }
}

function removeSupporter(reg_id,supporter_approve){    
  if(supporter_approve == 'no')
  {
    var popup_text = "You want to Remove";
    var alert_text = "Removed!";
  }else{
    var popup_text = "You want to change the Status";
    var alert_text = "Changed!";
  }
     
Swal.fire({
  title: "Are you sure?",
  text: popup_text,
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#c7df19",
  cancelButtonColor: "#383838",
  confirmButtonText: "Yes"
  }).then(function (result) {
      if (result.value) {
        // AJAX request
         $.ajax({
          url:  base_url+'superadmin/remove_supporter',
          type: 'post',
          data: {
            reg_id:reg_id,
          },
          success: function(data){
            //debugger; 
            Swal.fire(alert_text, "Successfully.", "success");
            window.location.reload();
          }
        });
      }
  });          
}

function removeSupporterEmail(invite_id){         
Swal.fire({
  title: "Are you sure?",
  text: "You want to Remove this Email",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#c7df19",
  cancelButtonColor: "#383838",
  confirmButtonText: "Yes"
  }).then(function (result) {
      if (result.value) {
        // AJAX request
         $.ajax({
          url:  base_url+'superadmin/remove_supporter_email',
          type: 'post',
          data: {
            invite_id:invite_id,
          },
          success: function(data){
            //debugger; 
            Swal.fire("Removed!", "Successfully.", "success");
            window.location.reload();
          }
        });
      }
  });          
}

function deleteTicket(id)
{   
  var id = id; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Delete this Ticket",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'superadmin/delete_ticket',
              type: 'post',
              data: {id: id},
              success: function(data){ 
                Swal.fire("Deleted!", "Successfully.", "success");
                window.location.reload();
              }
            });
          }
      });       
}

//Preview Attach files modal
function ticketAttachFilesModal(id){           
  var id = id;
 // AJAX request
  $.ajax({
    url:  base_url+'superadmin/ticketAttachFiles_Modal',
    type: 'post',
    data: {id: id},
    success: function(data){ 
      // Add response in Modal body
      //console.log(data);
      $('#ticketAttachFilesModal_content').html(data);
      // Display Modal
      $('#ticketAttachFilesModal').modal('show'); 
    }
  });
}
// Support functions ------//-----//----//----//----

// Community functions-----//-------//---------//----

function approveExpert(reg_id){         
  Swal.fire({
    title: "Are you sure?",
    text: "You want to Approve this User as Decision Maker",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#c7df19",
    cancelButtonColor: "#383838",
    confirmButtonText: "Yes"
    }).then(function (result) {
        if (result.value) {
          // AJAX request
           $.ajax({
            url:  base_url+'superadmin/approve_expert',
            type: 'post',
            data: {
              reg_id:reg_id,
            },
            success: function(data){
              //debugger; 
              Swal.fire("Approved!", "Successfully.", "success");
              window.location.reload();
            }
          });
        }
    });          
}

function expertStatus(reg_id,status){         
  Swal.fire({
    title: "Are you sure?",
    text: "You want to change the Status",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#c7df19",
    cancelButtonColor: "#383838",
    confirmButtonText: "Yes"
    }).then(function (result) {
        if (result.value) {
          // AJAX request
           $.ajax({
            url:  base_url+'superadmin/expert_status',
            type: 'post',
            data: {
              reg_id:reg_id, status:status
            },
            success: function(data){
              //debugger; 
              Swal.fire("Changed!", "Successfully.", "success");
              window.location.reload();
            }
          });
        }
    });          
}


  // End Community functions-----//-------//---------//----