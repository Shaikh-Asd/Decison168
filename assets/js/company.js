var base_url = 'http://localhost/decision168/';
$(document).ready(function(){ 
  // FOR LOGIN FORM -------------------------------------------------------
  $('#login_form').on('submit',function(event){ 
    //debugger;  
    event.preventDefault(); // Stop page from refreshing
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'company/check_login',
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
              window.location = base_url+'company/dashboard';
          }
          //console.log(data);
       }// success msg ends here
     });
  });

  // FOR CHANGE COMP PASSWORD FORM ----------------------------------------
  $('#comp_change_pwd_form').on('submit',function(event){    
    event.preventDefault(); // Stop page from refreshing
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'company/update_comp_password',
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
          }
          else if(data.status == 'old_passwordError')
          {
            $('#old_passwordErr').html('Please Enter Correct Current Password!');
            $('#new_passwordErr').html('');
          }
          else if(data.status == 'new_passwordError')
          {
            $('#new_passwordErr').html('New Password cannot be Current Password!');
            $('#old_passwordErr').html('');
          }
          else if(data.status == true){
            Swal.fire("Login with New Password!", "Password Changed!", "success");
            window.location.reload();
          }
       }// success msg ends here

     });
  });

  // FOR RESET PASSWORD FORM -------------------------------------------------------
  $('#reset_form').on('submit',function(event){   
    event.preventDefault(); // Stop page from refreshing
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'company/sent_reset_password',
         type:"POST",
         data:formData,
         contentType:false,
         processData:false,
         cache:false,
         success: function(data){
          if (data.status == false) {
          //show errors
          $('#email_addressErr').html(data.errors);
          $('#recaptchaErr').html(data.errors);
          }
          else if(data.status == 'inactive_status'){
            $('#reg_in_message').html(data.reg_in_message);
            $('#hide_msg').hide();
            $('#reg_in_message').show();
          }
          else if(data.status == true){
              window.location = base_url+'company/reset-password';
              
          }
          //console.log(data);
       }// success msg ends here
     });
  });

  // FOR CHANGE PASSWORD FORM ----------------------------------------
  $('#cp_form').on('submit',function(event){    
    event.preventDefault(); // Stop page from refreshing
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'company/insert_change_password',
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
            $('#recaptchaErr').html(data.errors);
          }
          else if(data.status == true){
            window.location = base_url+'company/login';
          }
          //console.log(data);
       }// success msg ends here
     });
  });

  // FOR ADD emp FORM ----------------------------------------
  $('#add_empForm').on('submit',function(event){
    //debugger;          
    event.preventDefault(); // Stop page from refreshing
    $('#add_empButton').hide();
    $('#loader2').css('visibility', 'visible');
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'company/insert_empform',
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
            $('#add_empButton').show();
            $('#loader2').css('visibility','hidden'); 
          }
          else if(data.status == true){
           window.location.reload();
          }
          //console.log(data);
       }// success msg ends here
     });
  });

  // Open Work New Assignee to inactive current assignee FORM ----------------------------------------
  $('#OpenWorkNewAssignee').on('submit',function(event){
    //debugger;          
    event.preventDefault(); // Stop page from refreshing
    $('#OpenWorkNotNowButton').hide();
    $('#OpenWorkNewAssigneeButton').hide();
    $('#cloader2').css('visibility', 'visible');
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'company/open_work_new_assignee',
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
            $('#OpenWorkNotNowButton').hide();
            $('#OpenWorkNewAssigneeButton').show();
            $('#cloader2').css('visibility','hidden'); 
          }
          else if(data.status == true){
              window.location.reload();
          }
          //console.log(data);
       }// success msg ends here
     });
  });

  // Open Work New Assignee to delete emp ----------------------------------------
  $('#OpenWorkNewAssigneeDel').on('submit',function(event){
    //debugger;          
    event.preventDefault(); // Stop page from refreshing
    $('#OpenWorkNewAssigneeDelButton').hide();
    $('#dcloader2').css('visibility', 'visible');
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'company/open_work_new_assignee_del',
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
            $('#OpenWorkNewAssigneeDelButton').show();
            $('#dcloader2').css('visibility','hidden'); 
          }
          else if(data.status == true){
              window.location.reload();
          }
          //console.log(data);
       }// success msg ends here
     });
  });

  // Role

  $('#add_roleForm').on('submit',function(event){
    //debugger;          
    event.preventDefault(); // Stop page from refreshing
    $('#add_roleButton').hide();
    $('#loader2').css('visibility', 'visible');
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'company/insert_roleform',
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
            $('#add_roleButton').show();
            $('#loader2').css('visibility','hidden'); 
          }
          else if(data.status == true){
           window.location.reload();
          }
          //console.log(data);
       }// success msg ends here
     });
  });

  $('#update_role_form').on('submit',function(event){
    //debugger;          
    event.preventDefault(); // Stop page from refreshing
    $('#update_role_button').hide();
    $('#loader2').css('visibility', 'visible');
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'company/update_role',
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
            $('#update_role_button').show();
            $('#loader2').css('visibility','hidden'); 
          }
          else if(data.status == true){
           window.location.reload();
          }
          //console.log(data);
       }// success msg ends here
     });
  });

  // FOR assign emp role FORM ----------------------------------------
  $('#assign_emproleForm').on('submit',function(event){
    //debugger;          
    event.preventDefault(); // Stop page from refreshing
    $('#assign_emproleButton').hide();
    $('#loader2').css('visibility', 'visible');
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'company/assign_emprole',
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
            $('#assign_emproleButton').show();
            $('#loader2').css('visibility','hidden'); 
          }
          else if(data.status == true){
           window.location.reload();
          }
          //console.log(data);
       }// success msg ends here
     });
  });

  $('#switch_role_form').on('submit',function(event){
    //debugger;          
    event.preventDefault(); // Stop page from refreshing
    $('#switch_role_button').hide();
    $('#uploader2').css('visibility', 'visible');
   var formData = new FormData(this); 
    $.ajax({
         url:base_url+'company/change_emprole',
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
            $('#switch_role_button').show();
            $('#uploader2').css('visibility','hidden'); 
          }
          else if(data.status == true){
           window.location.reload();
          }
          //console.log(data);
       }// success msg ends here
     });
  });

  // Role

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
                    url: base_url+'company/logout',
                    type: 'POST', 
                    success: function(html){
                      Swal.fire("Logged Out!", "Successfully.", "success");
                      window.location.reload();
                    }
                  });
                }
            });       
}

function Inactive_Emp(id)
{   
  var id = id;
  var status = 'inactive'; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Inactive Employee?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'company/change_emp_status',
              type: 'post',
              data: {id: id, status: status},
              success: function(data){ 
                if(data.status == true)
                {
                  //Swal.fire("Inactive!", "Successfully.", "success");
                  window.location.reload();                  
                }
                else
                {
                  $('#CompOpenWorkModal_content').html(data);
                  // Display Modal
                  $('#CompOpenWorkModal').modal('show'); 
                }
              }
            });
          }
      });       
}

function Active_Emp(id)
{   
  var id = id;
  var status = 'active'; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Active Employee?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'company/change_emp_status',
              type: 'post',
              data: {id: id, status: status},
              success: function(data){ 
                //Swal.fire("Active!", "Successfully.", "success");
                window.location.reload();
              }
            });
          }
      });       
}

function ForceInactive_Emp(id)
{   
  var id = id;
  var status = 'inactive'; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Inactive Employee?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'company/forceinactive_emp',
              type: 'post',
              data: {id: id, status: status},
              success: function(data){ 
                  //Swal.fire("Inactive!", "Successfully.", "success");
                  window.location.reload();
              }
            });
          }
      });       
}

function delete_Emp(id)
{   
  var id = id;
  var status = 'inactive'; 
    Swal.fire({
      title: "Are you sure?",
      text: "You want to Delete Employee?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'company/delete_emp',
              type: 'post',
              data: {id: id, status: status},
              success: function(data){ 
                if(data.status == true)
                {
                  window.location.reload();                  
                }
                else
                {
                  $('#CompOpenWorkModalDel_content').html(data);
                  // Display Modal
                  $('#CompOpenWorkModalDel').modal('show'); 
                }
              }
            });
          }
      });       
}

function choose_rpivilege_option(val)
{
  var opt = val;
  if(opt == 'all')
  {
    $('.selected_rpivilege_option').val('all');
  }
  else if(opt == 'cus')
  {
    $('.selected_rpivilege_option').val('custom');
  }
  else
  {
    $('.selected_rpivilege_option').val('all');
  }
}

//edit modal
function edit_role(id){   
  //debugger;        
   var id = id;
   // AJAX request
   $.ajax({
    url:  base_url+'company/edit_role',
    type: 'post',
    data: {id: id},
    success: function(data){ 
      // Add response in Modal body
      //console.log(data);
      $('#EditRoleModal_content').html(data);
      // Display Modal
      $('#EditRoleModal').modal('show'); 
    }
  });
}

function choose_rpivilege_option_up(val)
{
  //debugger;
  var opt = val;
  if(opt == 'all')
  {
    $('.selected_rpivilege_option_up').val('all');
    $('.rpivilege_opt_all_class').addClass('active');
    $('.rpivilege_opt_cus_class').removeClass('active');
  }
  else if(opt == 'cus')
  {
    $('.selected_rpivilege_option_up').val('custom');
    $('.rpivilege_opt_all_class').removeClass('active');
    $('.rpivilege_opt_cus_class').addClass('active');
  }
  else
  {
    $('.selected_rpivilege_option_up').val('all');
    $('.rpivilege_opt_all_class').addClass('active');
    $('.rpivilege_opt_cus_class').removeClass('active');
  }
}

function delete_role(id)
{   
  var id = id;
    Swal.fire({
      title: "Are you sure you want to Delete?",
      text: "If this role is assigned to anyone then that member will be treated as normal member!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#c7df19",
      cancelButtonColor: "#383838",
      confirmButtonText: "Yes"
      }).then(function (result) {
          if (result.value) {
            // AJAX request
             $.ajax({
              url:  base_url+'company/delete_role',
              type: 'post',
              data: {id: id},
              success: function(data){ 
                  window.location.reload(); 
              }
            });
          }
      });       
}

//assign role
function assign_emprole(id){   
  //debugger;        
  var id = id;
  // Display Modal
  $('#cce_id').val(id);
  $('#assign_emprolemodal').modal('show'); 
}

//switch role
function switch_emprole(id){   
  //debugger;        
  var id = id;
   // AJAX request
   $.ajax({
    url:  base_url+'company/switch_emprole',
    type: 'post',
    data: {id: id},
    success: function(data){ 
      // Add response in Modal body
      //console.log(data);
      $('#SwitchRoleModal_content').html(data);
      // Display Modal
      $('#SwitchRoleModal').modal('show'); 
    }
  });
}

function view_option_visible_edit()
{
    if($('#view_only_opt_edit').prop('checked') == true)
    {
        $('.other_opt_edit').prop('checked', false);
        $('.other_opt_edit').attr('disabled', true); 
    }
    else
    {
        $('.other_opt_edit').removeAttr('disabled'); 
    } 
}

function view_option_disable_edit()
{
    if($('.other_opt_edit:checkbox:checked').prop('checked') == true)
    {
        $('#view_only_opt_edit').prop('checked', false);
        $('#view_only_opt_edit').attr('disabled', true); 
    }
    else
    {
        $('#view_only_opt_edit').removeAttr('disabled'); 
    } 
}