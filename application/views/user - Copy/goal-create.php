<?php
$page = 'goal-create';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Goal Create</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- App favicon -->
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">

        <link href="<?php echo base_url();?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo base_url();?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

        <!-- dropzone css -->
        <link href="<?php echo base_url();?>assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />

        <?php
include('header_links.php');
?>
    </head>

    <body data-sidebar="dark">
        <!-- Begin page -->
        <div id="layout-wrapper">

            <?php
            include('header.php');
            ?>
<!-- ========== Left Sidebar Start ========== -->
            <?php
            include('sidebar.php');
            ?>
<!-- Left Sidebar End -->
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <div class="row align-items-center">
                <div class="col-3">
                    <div>
                        <h4 class="mb-sm-0 font-size-18">Create</h4>
                    </div>
                </div>
                <div class="col-9">
                    <div>
                        <ul class="nav nav-pills justify-content-end">
                            <li class="nav-item me-2">
                                <a class="btn btn-sm bg-d text-white" href="javascript: history.go(-2)">
                                    <i class="mdi mdi-keyboard-backspace"></i> Back
                                </a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="btn btn-sm bg-d text-white" href="<?php echo base_url('goals-list');?>">
                                    <i class="mdi mdi-card-text-outline"></i> Goal List
                                </a>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </div>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Project Create</a></li> -->
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
<?php
if(($this->session->flashdata('message')) && ($this->session->flashdata('message') != ""))
{
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
<i class="mdi mdi-check-all me-2"></i>
<?php echo $this->session->flashdata('message'); ?>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
}
?> 
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">

                                        <ul role="tablist" class="cus_wiz_ul">
                                            <li role="tab" class="cus_wiz_li">
                                                <a class="cus_wiz_a cus_wiz_a_current" id="current_section">
                                                <span class="cus_wiz_current_number" id="current_section_number">1.</span> 
                                                Goal
                                                </a>
                                            </li>
                                            <li role="tab" class="cus_wiz_li">
                                                <a class="cus_wiz_a" id="next_section">
                                                <span class="cus_wiz_number" id="next_section_number">2.</span>
                                                KPIs
                                                </a>
                                            </li>
                                        </ul>


                                    <div class="mt-4 p-3" id="current_section_div">
                                        <form method="post" name="create_goal_form" id="create_goal_form" enctype="multipart/form-data" autocomplete="off">
                                        <div class="row mb-2">
                                            <label for="gname" class="col-form-label col-lg-2">Objective/Goal <span class="text-danger">*</span></label>
                                            <div class="col-lg-10">
                                                <input id="gname" name="gname" type="text" class="form-control" placeholder="Enter Objective/Goal..." required="">
                                                <span id="gnameErr" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="gdept" class="col-form-label col-lg-2">Identify Department <span class="text-danger">*</span></label>
                                            <div class="col-lg-10">
                                                <select class="form-select select2" name="gdept" id="gdept" required>
                                                    <option value="">Select Department</option>
                                                    <?php
                                                    if(isset($_COOKIE["d168_selectedportfolio"]))
                                                    {
                                                    $check_port_dept = $this->Front_model->get_PortfolioDepartment($_COOKIE["d168_selectedportfolio"]);
                                                    if($check_port_dept) 
                                                    {
                                                        foreach($check_port_dept as $p_dept)
                                                        {
                                                        ?>
                                                        <option value="<?php echo $p_dept->portfolio_dept_id;?>"><?php echo $p_dept->department;?></option>
                                                        <?php  
                                                        }         
                                                    }
                                                    }
                                                    ?>
                                                </select>
                                                <span id="gdeptErr" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <label for="pname" class="col-form-label col-lg-2">Assign Goal Manager</label>
                                            <div class="col-lg-10">  
                                                <?php
                                                if(isset($_COOKIE["d168_selectedportfolio"]))
                                                {
                                                    $porttm = $this->Front_model->getAccepted_PortTM($_COOKIE["d168_selectedportfolio"]);
                                                ?>
                                                <select name="project_manager" id="project_manager" class=" form-control pro_team_member" data-placeholder="Assign Goal Manager..." onchange="return manager_selected();">
                                                    <option value=""><span>Select Goal Manager</span></option>
                                                    <?php                                           
                                                    if($porttm){
                                                        foreach ($porttm as $ptm) {
                                                            $m = $this->Front_model->selectLogin($ptm->sent_to);
                                                            if($m){
                                                            if($m->reg_id != $this->session->userdata('d168_id'))
                                                                {
                                                            ?>
                                                            <option value="<?php echo $m->reg_id;?>"><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                                            <?php
                                                                }
                                                            if($m->reg_id == $this->session->userdata('d168_id'))
                                                                {
                                                            ?>
                                                            <option value="<?php echo $this->session->userdata('d168_id');?>"><span>Assign To Me</span></option>
                                                            <?php
                                                                }
                                                            }
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                                <?php
                                                }
                                                ?>                 
                                            </div>
                                        </div>


                                        <div class="row mb-2">
                                            <label for="pname" class="col-form-label col-lg-2">Add Team Members</label>
                                            <div class="col-lg-8" id="select2-team_member-container">
                                                <?php
                                                if(isset($_COOKIE["d168_selectedportfolio"]))
                                                {
                                                    $porttm = $this->Front_model->getAccepted_PortTM($_COOKIE["d168_selectedportfolio"]);
                                                ?>
                                                <select name="team_member" id="team_member" class=" form-control pro_team_member" multiple="multiple" data-placeholder="Add Team Members..." onchange="return Team_Members();">
                                                    <?php                                           
                                                    if($porttm){
                                                        foreach ($porttm as $ptm) {
                                                            $m = $this->Front_model->selectLogin($ptm->sent_to);
                                                            if($m){
                                                            if($m->reg_id != $this->session->userdata('d168_id'))
                                                                {
                                                            ?>
                                                            <option value="<?php echo $m->reg_id;?>"><span><?php echo $m->first_name." ".$m->last_name; ?></span></option>
                                                            <?php
                                                                }
                                                            }
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                                <?php
                                                }
                                                ?>                                                
                                                <input type="hidden" name="selected_T_member" id="selected_T_member">
                                            </div>
                                            <div class="col-lg-2">
                                                <button type="button" class="add_dup_member btn btn-d btn-sm">Invite More Member</button>                                                    
                                            </div>
                                        </div>
                                        <div class="imember_div">
                                        </div>
                                        <span id="err_valid" class="text-danger"></span>

                                        <div class="row mb-3">
                                            <label class="col-form-label col-lg-2">Duration <span class="text-danger">*</span></label>
                                            <div class="col-lg-10">
                                            <div class="input-daterange input-group goal_Cdate" id="datepicker6"  data-date-format="yyyy-m-d" data-date-autoclose="true" data-provide="datepicker" data-date-container="#datepicker6">
                                                <input type="text" class="form-control" name="gstart_date" id="gstart_date" placeholder="Start Date" required>
                                                <input type="text" class="form-control" name="gend_date" id="gend_date" placeholder="End Date">
                                            </div>
                                            <span class="text-danger" id="gstart_dateErr"></span>
                                            <span class="text-danger" id="gend_dateErr"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="gdes" class="col-form-label col-lg-2"> Description</label>
                                            <div class="col-lg-10">
                                                <textarea class="form-control" id="gdes" name="gdes" rows="3" placeholder="Enter Description..."></textarea>
                                            </div>
                                        </div>
                                        <div class="row justify-content-end mt-4">
                                            <div class="col-lg-9">
                                                <a class="btn btn-sm bg-d text-white" href="javascript: history.go(-1)">
                                                 Cancel 
                                                </a>
                                            </div>
                                            <div class="col-lg-3">
                                                <img id="loader2" class="float-end" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                                                <button type="submit" id="create_goal_button" class="btn btn-d btn-sm float-end">Save & Next</button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>

                                    <div class="mt-4 p-3" id="next_section_div" style="display:none;">
                                        <form method="post" name="create_strategies_form" id="create_strategies_form" enctype="multipart/form-data" autocomplete="off">
                                        <div class="row mb-2">
                                            <label for="sname" class="col-form-label col-lg-2">KPI <span class="text-danger">*</span></label>
                                            <div class="col-lg-10">
                                                <input id="sname1" name="sname1" type="text" class="form-control" placeholder="Enter KPI..." required="">
                                                <span id="sname1Err" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="sdes" class="col-form-label col-lg-2"> Description</label>
                                            <div class="col-lg-10">
                                                <textarea class="form-control" id="sdes1" name="sdes1" rows="3" placeholder="Enter Description..."></textarea>
                                            </div>
                                        </div>

                                        <div class="row strategies_wrapper">         
                                        </div> 

                                        <input type="hidden" name="increase_cnt" id="increase_cnt" value="1">
                                        <input type="hidden" name="gid" id="new_gid">
                                        <input type="hidden" name="gdept" id="new_gdept">
                                        <?php
                                        if(!empty($this->input->post('port_id')))
                                        {
                                        ?>
                                        <input type="hidden" name="portfolio_id" value="<?php echo $this->input->post('port_id');?>">
                                        <?php
                                        } 
                                        elseif(isset($_COOKIE["d168_selectedportfolio"]))
                                        {
                                        ?>
                                        <input type="hidden" name="portfolio_id" value="<?php echo $_COOKIE["d168_selectedportfolio"];?>">
                                        <?php
                                        }
                                        ?>                                        
                                        <div class="row justify-content-end">
                                            <div class="col-lg-10">
<?php
if(empty($this->session->userdata('d168_user_cor_id')))
{
$getMydetail = $this->Front_model->getStudentById($this->session->userdata('d168_id'));
if($getMydetail)
{
    if(DateTime::createFromFormat('Y-m-d H:i:s', $getMydetail->package_expiry) !== false)
    {
      if($getMydetail->package_expiry <= date('Y-m-d H:i:s'))
      {
        ?>
        <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-sm btn-d">Add More KPIs</a>
        <?php
      }
      else
      {
        $getPackDetail = $this->Front_model->getPackDetail($getMydetail->package_id);
        $getStrategiesCount = $this->Front_model->getStrategiesCount($_COOKIE["d168_selectedportfolio"],$this->input->post('gid'));
        if($getPackDetail)
        {
          $total_strategies = trim($getPackDetail->pack_goals_strategies);
          $used_strategies = trim($getStrategiesCount['strategy_count_rows']);
          $check_type = is_numeric($total_strategies);
          if($check_type == 'true')
          {
            $used_s = $used_strategies + 1;
            if($used_s < $total_strategies)
            {
              ?>
                <input type="hidden" name="pass_totalS" id="pass_totalS" value="<?php echo $total_strategies;?>">
                <input type="hidden" name="used_totalS" id="used_totalS" value="<?php echo $used_s;?>">
                <button type="button" class="add_strategies btn btn-d btn-sm">Add More KPIs</button>
              <?php
            }
            else
            {
                ?>
                <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d">Add More KPIs</a>
                <?php
            }
          }
          else
          {
            ?>
            <input type="hidden" name="pass_totalS" id="pass_totalS" value="">
                <input type="hidden" name="used_totalS" id="used_totalS" value="">
            <button type="button" class="add_strategies btn btn-d btn-sm">Add More KPIs</button>
            <?php
          }
        } 
      }
    }
    else
    {
        $getPackDetail = $this->Front_model->getPackDetail($getMydetail->package_id);
        $getStrategiesCount = $this->Front_model->getStrategiesCount($_COOKIE["d168_selectedportfolio"],$this->input->post('gid'));
        if($getPackDetail)
        {
          $total_strategies = trim($getPackDetail->pack_goals_strategies);
          $used_strategies = trim($getStrategiesCount['strategy_count_rows']);
          $check_type = is_numeric($total_strategies);
          if($check_type == 'true')
          {
            $used_s = $used_strategies + 1;
            if($used_s < $total_strategies)
            {
              ?>
                <input type="hidden" name="pass_totalS" id="pass_totalS" value="<?php echo $total_strategies;?>">
                <input type="hidden" name="used_totalS" id="used_totalS" value="<?php echo $used_s;?>">
                <button type="button" class="add_strategies btn btn-d btn-sm">Add More KPIs</button>
              <?php
            }
            else
            {
                ?>
                <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d">Add More KPIs</a>
                <?php
            }
          }
          else
          {
            ?>
            <input type="hidden" name="pass_totalS" id="pass_totalS" value="">
                <input type="hidden" name="used_totalS" id="used_totalS" value="">
            <button type="button" class="add_strategies btn btn-d btn-sm">Add More KPIs</button>
            <?php
          }
        }
    }
} 
}
else
{
  if($this->session->userdata('d168_user_role_in_comp') != 'employee')
  {
    $getCompPackInfo = $this->Front_model->getCompany($this->session->userdata('d168_user_cor_id'));
    if($getCompPackInfo)
    {
      $privilege = "no";
      if(is_numeric($this->session->userdata('d168_user_role_in_comp')))
      {
        $getCompRolesInfo = $this->Front_model->getCompanyRoles($this->session->userdata('d168_user_role_in_comp'));  
        if($getCompRolesInfo)
        {
          if($getCompRolesInfo->privilege != 'all')
          {
            $cus_privilege = explode(', ',trim($getCompRolesInfo->privilege));
            if(in_array('strategies', $cus_privilege))
            {
              $privilege = "yes";
            }
          }
          else
          {
            $privilege = "yes";
          }
        }      
      }
      if(($this->session->userdata('d168_user_role_in_comp') == 'contacted_user') || ($privilege == 'yes'))
      {
        if(DateTime::createFromFormat('Y-m-d H:i:s', $getCompPackInfo->package_expiry) !== false)
        {
          if($getCompPackInfo->package_expiry <= date('Y-m-d H:i:s'))
          {
            ?>
            <a href="javascript: void(0);" onclick="return Expire_Package_popup();" class="btn btn-sm btn-d">Add More KPIs</a>
            <?php
          }
          else
          {
            $getPackDetail = $this->Front_model->getPackDetail($getCompPackInfo->package_id);
            $getStrategiesCount = $this->Front_model->getStrategiesCountCorp($_COOKIE["d168_selectedportfolio"],$this->input->post('gid'));
            if($getPackDetail)
            {
              $total_strategies = trim($getPackDetail->pack_goals_strategies);
              $used_strategies = trim($getStrategiesCount['strategy_count_rows']);
              $check_type = is_numeric($total_strategies);
              if($check_type == 'true')
              {
                $used_s = $used_strategies + 1;
                if($used_s < $total_strategies)
                {
                  ?>
                    <input type="hidden" name="pass_totalS" id="pass_totalS" value="<?php echo $total_strategies;?>">
                    <input type="hidden" name="used_totalS" id="used_totalS" value="<?php echo $used_s;?>">
                    <button type="button" class="add_strategies btn btn-d btn-sm">Add More KPIs</button>
                  <?php
                }
                else
                {
                    ?>
                    <a href="javascript: void(0);" onclick="return limit_Exceeds_popup();" class="btn btn-sm btn-d">Add More KPIs</a>
                    <?php
                }
              }
              else
              {
                ?>
                <input type="hidden" name="pass_totalS" id="pass_totalS" value="">
                    <input type="hidden" name="used_totalS" id="used_totalS" value="">
                <button type="button" class="add_strategies btn btn-d btn-sm">Add More KPIs</button>
                <?php
              }
            } 
          }
        }
      }
    }    
  }
}
?>
<span class="text-danger ms-4" id="display_add_strategiesErr"></span>
                                            </div>
                                            <div class="col-lg-2">
                                                <button type="submit" id="create_strategies_button" class="btn btn-d btn-sm float-end">Create</button>
                                                <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                                            </div>
                                        </div>
                                        </form>
                                    </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
                
                <?php
                include('footer.php');
                ?>
                            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->
  
        <!-- JAVASCRIPT -->
<script src="<?php echo base_url();?>assets/libs/jquery/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/metismenu/metisMenu.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/node-waves/waves.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/select2/js/select2.min.js"></script>
        <!-- bootstrap datepicker -->
        <script src="<?php echo base_url();?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

        <!-- dropzone plugin -->
        <script src="<?php echo base_url();?>assets/libs/dropzone/min/dropzone.min.js"></script>
<!-- form advanced init -->
<script src="<?php echo base_url();?>assets/js/pages/form-advanced.init.js"></script>
        <?php
include('footer_links.php');
?>
<script type="text/javascript">
//ADD strategies
var add_strategies = $('.add_strategies'); //Add button selector
var strategies_wrapper = $('.strategies_wrapper'); //Input field wrapper
var pass_totalS = $('#pass_totalS').val();
//var increase_cnt = $('#increase_cnt').val();

if(!y2)
{
var y2 = 1;
}
var x2 = 1; //Initial field counter is 1
var y2 = y2;
//Once add button is clicked
$(add_strategies).click(function(){
    var used_totalS = $('#used_totalS').val();
        y2++;
        used_totalS++;
        var strategiesHTML = '<div><hr><div class="row mb-2"><label for="sname" class="col-form-label col-lg-2">KPI <span class="text-danger">*</span></label><div class="col-lg-10"><input id="sname'+y2+'" name="sname'+y2+'" type="text" class="form-control" placeholder="Enter KPI..." required=""><span id="sname'+y2+'Err" class="text-danger"></span></div></div><div class="row mb-2"><label for="sdes" class="col-form-label col-lg-2"> Description</label><div class="col-lg-10"><textarea class="form-control" id="sdes'+y2+'" name="sdes'+y2+'" rows="3" placeholder="Enter Description..."></textarea></div></div><div class="row mb-4"><div class="col-10"></div><div class="col-2"><button class="bg-d btn btn-sm remove_strategies text-white" type="button">Remove KPI</button></div></div></div>'; //New input field html 
        if(pass_totalS != "")
        {
            if(used_totalS <= pass_totalS)
            {
                $(strategies_wrapper).append(strategiesHTML); //Add field html
                $('#increase_cnt').val(y2);
                $('#used_totalS').val(used_totalS);
            }
            else
            {
                $('#display_add_strategiesErr').html('Limit Exceeds! Upgrade your package to add KPIs in goal!');
            }
        }
        else
        {
            $(strategies_wrapper).append(strategiesHTML); //Add field html
            $('#increase_cnt').val(y2);
        }        
});
//Once remove button is clicked
$(strategies_wrapper).on('click', '.remove_strategies', function(e){
    e.preventDefault();
    console.log(pass_totalS);
    console.log(used_totalS);
    $(this).parent('div').parent('div').parent('div').remove(); //Remove field html
    x2--; //Decrement field counter
    var used_totalS = $('#used_totalS').val();
        used_totalS--;
        $('#used_totalS').val(used_totalS);
        $('#display_add_strategiesErr').html('');
});
</script>
<script type="text/javascript">
$(document).ready(function(){
    //debugger;
   var add_dup_member = $('.add_dup_member'); //Add button selector
   var imember_div = $('.imember_div'); //Input field wrapper
   var memberHTML = '<div class="row mb-2"><label class="col-form-label col-lg-2"></label><div class="col-lg-8"><input type="email" id="imemail" name="imemail[]" class="form-control" placeholder="Enter Email ID to Invite Member..."><span id="imemailErr" class="text-danger"></span></div><div class="col-lg-2 card-title mb-2"><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle add_dup_member2" style="margin-left: 30px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-plus"></i></span></button><button type="button" class="btn btn-light position-relative p-0 avatar-xs rounded-circle remove_dup_member" style="margin-left: 15px;"><span class="avatar-title bg-transparent text-reset"><i class="bx bx-minus"></i></span></button></div></div>'; //New input field html
   var x = 1; //Initial field counter is 1
   
   //Once add button is clicked
   $(add_dup_member).click(function(){
    //debugger;
           $(imember_div).append(memberHTML); //Add field html
   });
   
   $(imember_div).on('click', '.add_dup_member2', function(e){
      //debugger;
           $(imember_div).append(memberHTML); 
   });

   //Once remove button is clicked
   $(imember_div).on('click', '.remove_dup_member', function(e){
       e.preventDefault();
       $(this).parent('div').parent('div').remove(); //Remove field html
       x--; //Decrement field counter
   });
});
</script>
<?php
if(isset($_COOKIE["d168_selectedportfolio"])){ // if portfolio selected
?>
    <script type="text/javascript">
        var tour_session = localStorage.getItem('tour_session');
        if(tour_session)
        {
          if(tour_session == "goal-create")
          {
            localStorage.setItem('tour_session', 'no');
            var steps = [ 
                {
                    title: "DECISION 168",
                    content: "<p class='popover-content'>Here you can create your Goal</p>"
                }, 
                {
                    title: "Goal: Name",
                    id: "gname",
                    content: "<p class='popover-content'>Enter Objective/Goal</p>"
                },
                {
                    title: "Goal: Department",
                    id: "select2-gdept-container",
                    content: "<p class='popover-content'>Select Department for the Goal</p>"
                },
                {
                    title: "Goal: Manager",
                    id: "select2-project_manager-container",
                    content: "<p class='popover-content'>Assign Manager for the Goal</p>"
                },
                {
                    title: "Goal: Team Members",
                    id: "select2-team_member-container",
                    content: "<p class='popover-content'>Add Team Members for the Goal</p>"
                }, 
                {
                    title: "Goal: Start Date",
                    id: "gstart_date",
                    content: "<p class='popover-content'>Select Start Date for the Goal</p>"
                }, 
                {
                    title: "Goal: End Date",
                    id: "gend_date",
                    content: "<p class='popover-content'>Select End Date for the Goal</p>"
                }, 
                {
                    title: "Goal: Description",
                    id: "gdes",
                    content: "<p class='popover-content'>Enter Goal Description</p>"
                },
                {
                    title: "Goal: Submit",
                    id: "create_goal_button",
                    content: "<p class='popover-content'>Click here to Create Goal</p>"
                }
            ];
            var my_tour = new Tour(steps);
            my_tour.show();            
          }
        }
    </script>
    <?php
}
?>
    </body>
</html>