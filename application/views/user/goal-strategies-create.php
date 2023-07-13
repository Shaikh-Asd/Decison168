<?php
$page = 'goal-create';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>KPIs Create</title>
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

    <body data-sidebar="dark" onload="return get_portfolio_id();">
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
                                <a class="btn btn-sm bg-d text-white" href="javascript: history.go(-1)">
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
                                        <h4 class="card-title mb-2">Create KPIs</h4>
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
                                        <input type="hidden" name="gid" value="<?php echo $this->input->post('gid');?>">
                                        <input type="hidden" name="gdept" value="<?php echo $this->input->post('gdept');?>">
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
                                                <button type="submit" id="create_strategies_button" class="btn btn-d btn-sm">Create</button>
                                                <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                                                <a class="btn btn-sm bg-d text-white" href="javascript: history.go(-1)">
                                                 Cancel 
                                                </a>
                                            </div>
                                        </div>
                                        </form>
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
    </body>

</html>
