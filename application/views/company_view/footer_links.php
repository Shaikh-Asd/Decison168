<!-- Change Comp PWD Modal -->
<div class="modal fade" id="change_company_passwordModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" name="comp_change_pwd_form" id="comp_change_pwd_form" autocomplete="off">
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="password" name="old_password" id="old_password" class="form-control pl-15" placeholder="Current Password" required="">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i onclick="oldPassword();" class="fa fa-eye" id="togglePassword1"></i></span>
                                </div>
                            </div>
                            <span id="old_passwordErr" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="password" name="new_password" id="new_password" class="form-control pl-15" placeholder="New Password" required="">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i onclick="newPassword();" class="fa fa-eye" id="togglePassword2"></i></span>
                                </div>
                            </div>
                            <span id="new_passwordErr" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="password" name="conf_password" id="conf_password" class="form-control pl-15" placeholder="Confirm Password" required="">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i onclick="confPassword();" class="fa fa-eye" id="togglePassword3"></i></span>
                                </div>
                            </div>
                            <span id="conf_passwordErr" class="text-danger"></span>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-d btn-sm w-md waves-effect waves-light" type="submit">Change Password</button>
                            <button type="button" class="btn btn-sm bg-d text-white ms-1" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
function oldPassword() {
  var x = document.getElementById("old_password");
  var y = document.getElementById("togglePassword1");
  if (x.type === "password") {
    x.type = "text";
    y.classList.replace('fa-eye','fa-eye-slash');
  } else {
    x.type = "password";
    y.classList.replace('fa-eye-slash','fa-eye');
  }
}

function newPassword() {
  var x = document.getElementById("new_password");
  var y = document.getElementById("togglePassword2");
  if (x.type === "password") {
    x.type = "text";
    y.classList.replace('fa-eye','fa-eye-slash');
  } else {
    x.type = "password";
    y.classList.replace('fa-eye-slash','fa-eye');
  }
}

function confPassword() {
  var x = document.getElementById("conf_password");
  var y = document.getElementById("togglePassword3");
  if (x.type === "password") {
    x.type = "text";
    y.classList.replace('fa-eye','fa-eye-slash');
  } else {
    x.type = "password";
    y.classList.replace('fa-eye-slash','fa-eye');
  }
}
</script>
<!-- toastr plugin -->
<script src="<?php echo base_url();?>assets/libs/toastr/build/toastr.min.js"></script><!-- Sweet Alerts js -->
<script src="<?php echo base_url();?>assets/libs/sweetalert2/sweetalert2.min.js"></script>
<!-- App js -->
<script src="<?php echo base_url();?>assets/js/app.js"></script>
        
<script src="<?php echo base_url('assets/js/company.js');?>"></script>