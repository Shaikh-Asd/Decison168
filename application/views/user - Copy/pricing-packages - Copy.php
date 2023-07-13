<?php
$page = 'pricing-packages';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Pricing</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- App favicon -->
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
<!-- Stripe JavaScript library -->
<script src="https://js.stripe.com/v3/"></script>
       <?php
include('header_links.php');
?>
<style type="text/css">
[class^=ribbon-] {
  position: relative;
}
[class^=ribbon-]:before, [class^=ribbon-]:after {
  content: "";
  position: absolute;
}
.ribbon-2 {
  width: 150px;
  height: 50px;
  background: #f00001;
  left: -32px;
}
.ribbon-2:before {
  height: 0;
  width: 0;
  border-bottom: 8px solid #ad0e0f;
  border-left: 8px solid transparent;
  top: -8px;
}
.ribbon-2:after {
  height: 0;
  width: 0;
  border-top: 25px solid transparent;
  border-bottom: 25px solid transparent;
  border-left: 15px solid #f00001;
  right: -15px;
}
.ribbon-content {
  height: inherit;
  margin-bottom: 0;
  background: #37b7c7;
  z-index: 100;
}
.ribbon-content:before {
  height: 0;
  width: 0;
  border-top: 10px solid #26808b;
  border-left: 10px solid transparent;
  bottom: -10px;
}
.ribbon-content:after {
  height: 0;
  width: 0;
  border-top: 10px solid #26808b;
  border-right: 10px solid transparent;
  right: 0;
  bottom: -10px;
}
</style>
<style type="text/css">
    /*.free-trial-btn {
    position: relative;
    color: white;*/
/*    font-family: bitter;*/
    /*font-size: 36px;
    line-height: 20px;*/
/*    padding: 17px 24px 14px 24px;*/
    /*border-radius: 5px;
    background-color: #c7df19;
    box-shadow: 0 6px #b0c51d;
    border: none;
    width: 95%;
    max-width: 960px;
    white-space: normal;
}*/

/*.free-trial-btn:hover {
    box-shadow: 0 4px #b0c51d;
    top: 2px;
    color: #fff;
    text-decoration: none;
}

.free-trial-btn:active, .free-trial-btn:focus, .free-trial-btn:active:focus {
    color: #fff;
    top: 3px;
    box-shadow: 0 3px #b0c51d;
    outline: none;
}

.btn-subtext {
    display: block;
    font-size: 21px;
    font-family: Lato, 'Helvetica Neue', 'Helvetica', Arial, sans-serif;
    font-weight: 300;
}

.free-trial-secondary {
    width: auto;
    font-size: 16px;
}*/
</style>
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
                        <h4 class="mb-sm-0 font-size-18">Pricing</h4>
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
                        </ul>
                    </div>
                </div>
            </div>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <?php
                    if($getMyPack)
                    {
                        if(($getMyPack->package_id == '1') && ($getMyPack->package_coupon_id == '0'))
                        {
                            $active_code = $this->Front_model->check_any_active_code();
                            if($active_code > 0)
                            {
                                $show_but = 'no';
                                $my_used_co_id = explode(',', $getMyPack->used_package_coupon_id); 
                                $get_active_co_id = $this->Front_model->get_active_coupon_id();
                                if($get_active_co_id)
                                {
                                    foreach($get_active_co_id as $gacd)
                                    {
                                        $co_id = $gacd->co_id;
                                        $index = array_search($co_id,$my_used_co_id);
                                        if($index === FALSE)
                                        {
                                            if($show_but == 'no')
                                            {
                                                $show_but = 'yes';
                                            }
                                        }
                                    }
                                }
                                if($show_but == 'yes')
                                {                                
                        ?>
                        <li class="breadcrumb-item">
                            <button type="button" class="btn btn-sm btn-d text-white" data-bs-toggle="modal" data-bs-target="#free_trial_account"><i class="fas fa-angle-double-right me-2"></i>Free Trial</button>
                        </li>
                        <?php
                                }
                            }
                        }
                    }
                    ?>
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
if($getMyPack)
{
   if((!empty($getMyPack->sub_cancel_reason)) && ($getMyPack->sub_cancel_reason_notify == 'yes'))
   {
    ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert" id="sub_cancel_reason_div">
        <i class="mdi mdi-alert-outline me-2"></i>
        <strong>Subscription Canceled</strong> due to Card Expired or for some other reason!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="return sub_cancel_reason_seen();"></button>
    </div>
    <?php
   }
}
?> 
                        <div class="row">                            
                        <!-- Display errors returned by checkout session -->
                        <div id="paymentResponse" class="hidden"></div>
                            <?php
                            $coupon_applied = 'no';
                            if($getMyPack->package_coupon_id != '0')
                            {
                                $coupon_applied = 'yes';
                            }
                            $my_package_price = $this->Front_model->getPackDetail($getMyPack->package_id);
                            if($getPack)
                            { 
                                //if free trial selected then display this
                                if($coupon_applied == 'yes')
                                {
                                    if($my_package_price)
                                    {
                                    $plabels = $this->Front_model->pricing_labels($my_package_price->pack_id);
                                ?>
                                <div class="col-xl-3 col-md-6">
                                    <div class="card plan-box border border-success-cus" style="min-height: 98%;">
                                        <div class="card-body p-4">
                                            <!-- <img src="./assets/images/brands/special-offers.png" style="width: 125px; height: 125px; margin-top: -53px; margin-left: 25%;"> -->                                       
                                            <div class="media" style='min-height: 158px;'>
                                                <div class="media-body">
                                                    <h5><?php echo ucfirst($my_package_price->pack_name);?></h5>
                                                    <p class="text-muted"><?php echo ucfirst($my_package_price->pack_tagline);?></p> 
                                                </div>
                                                <div class="ms-3">
                                                    <i class="bx bx-walk h1 text-d"></i>
                                                </div>
                                            </div>
                                            <div class="py-4">
                                                <h2><sup><small>$</small></sup> <?php echo $my_package_price->pack_price;?>/ <span class="font-size-13">
                                                    <?php 
                                                    if(is_numeric($my_package_price->pack_validity))
                                                    {
                                                       if($my_package_price->pack_validity == '30')
                                                       {
                                                            echo "billed monthly";
                                                       }
                                                       elseif($my_package_price->pack_validity == '365')
                                                       {
                                                            echo "billed annually";
                                                       }
                                                       else
                                                       {
                                                            echo $my_package_price->pack_validity." Days";
                                                       }
                                                    }
                                                    else
                                                    {
                                                        echo ucfirst($my_package_price->pack_validity);
                                                    }
                                                    ?>
                                                    </span></h2>
                                            </div>
                                            <div class="text-center plan-btn">
                                                <?php
                                                if($getMyPack)
                                                {
                                                    if($getMyPack->package_id == $my_package_price->pack_id)
                                                    {
                                                        ?>
                                                            <a href="javascript: void(0);" class="btn bg-d btn-sm waves-effect waves-light text-white">Selected</a>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>

                                            <div class="plan-features mt-5">
                                                
                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $my_package_price->pack_portfolio; if($plabels){ echo ' '.$plabels->portfolio;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $my_package_price->pack_goals; if($plabels){ echo ' '.$plabels->goals;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $my_package_price->pack_goals_strategies; if($plabels){ echo ' '.$plabels->goals_strategies;}?></p>
                                                
                                                <!-- <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $my_package_price->pack_goals_strategies_projects; if($plabels){ echo ' '.$plabels->goals_strategies_projects;}?></p> -->

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $my_package_price->pack_projects; if($plabels){ echo ' '.$plabels->projects;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $my_package_price->pack_team_members; if($plabels){ echo ' '.$plabels->team_members;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $my_package_price->pack_tasks; if($plabels){ echo ' '.$plabels->task;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $my_package_price->pack_storage; if($plabels){ echo ' '.$plabels->storage;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->accountability_tracking;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->document_collaboration;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->kanban_boards;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->motivator;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->internal_chat;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $my_package_price->pack_content_planner; if($plabels){ echo ' '.$plabels->content_planner;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->data_recovery;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->email_support;}?></p>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    }
                                }

                                $check_cus_pack_created = 'no';
                                foreach($getPack as $pk)
                                {
                                    if($pk->custom_reg_id == $this->session->userdata('d168_id'))
                                    {
                                        $check_cus_pack_created = 'yes';
                                    }
                                }
                                foreach($getPack as $pk)
                                {
                                //if coupon is applied
                                if($coupon_applied == 'yes')
                                {
                                    if($pk->pack_id != '1')
                                    {
                                        if($check_cus_pack_created == 'no')
                                        {
                                            $plabels = $this->Front_model->pricing_labels($pk->pack_id);
                                ?>
                                <div class="col-xl-3 col-md-6">
                                    <div class="card plan-box <?php if($getMyPack->package_id == $pk->pack_id){ echo 'border border-success-cus';}?>" style="min-height: 98%;">
                                        <div class="card-body p-4">
                                            <!-- <img src="./assets/images/brands/special-offers.png" style="width: 125px; height: 125px; margin-top: -53px; margin-left: 25%;"> -->                                       
                                            <div class="media" <?php if($pk->stripe_link == 'no')
                                                {  echo "style='min-height: 120px;'";} else { if($pk->pack_id == '3')
                                            { echo "style='min-height: 108px;'";} else{ echo "style='min-height: 158px;'";}}?>>
                                                <div class="media-body">
                                                    <h5><?php echo ucfirst($pk->pack_name);?></h5>
                                                    <p class="text-muted"><?php echo ucfirst($pk->pack_tagline);?></p> 
                                                </div>
                                                <div class="ms-3">
                                                    <?php
                                                    if($pk->pack_id == '1')
                                                    {
                                                    ?>
                                                    <i class="bx bx-walk h1 text-d"></i>
                                                    <?php
                                                    }
                                                    elseif($pk->pack_id == '2')
                                                    {
                                                    ?>
                                                    <i class="bx bx-cycling h1 text-d"></i>
                                                    <?php
                                                    } 
                                                    elseif($pk->pack_id == '3')
                                                    {
                                                    ?>
                                                    <i class="bx bx-car h1 text-d"></i>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <i class="bx bxs-plane-alt h1 text-d"></i>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <?php 
                                            if($pk->pack_id == '3')
                                            {
                                            ?>
                                            <!-- Offer Ribbon start -->
                                            <div class="ribbon-2">
                                                <span>
                                                    <strong style="display: inline-block;padding: 1.2em 1em;position: relative;color: #fff;">SPECIAL OFFER!</strong>
                                                </span>
                                            </div>
                                            <!-- Offer Ribbon end -->
                                            <?php
                                            }
                                            ?>
                                            <div class="py-4">
                                                <?php 
                                                if($pk->stripe_link == 'yes')
                                                {
                                                ?>
                                                <h2><sup><small>$</small></sup> <?php echo $pk->pack_price;?>/ <span class="font-size-13">
                                                    <?php 
                                                    if(is_numeric($pk->pack_validity))
                                                    {
                                                       if($pk->pack_validity == '30')
                                                       {
                                                            echo "billed monthly";
                                                       }
                                                       elseif($pk->pack_validity == '365')
                                                       {
                                                            echo "billed annually";
                                                       }
                                                       else
                                                       {
                                                            echo $pk->pack_validity." Days";
                                                       }
                                                    }
                                                    else
                                                    {
                                                        echo ucfirst($pk->pack_validity);
                                                    }
                                                    ?>
                                                    </span></h2>
                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                <center>
                                                    <h5><strong>Let’s Talk</strong></h5>
                                                    <img src="<?php echo base_url('/assets/images/Decision-168-lets-talk-480x480.png');?>" class="img-fluid" width="25%" height="auto">
                                                </center>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="text-center plan-btn">
                                                <?php
                                                if($getMyPack)
                                                {
                                                    if($getMyPack->package_id == $pk->pack_id)
                                                    {
                                                        ?>
                                                            <a href="javascript: void(0);" class="btn bg-d btn-sm waves-effect waves-light text-white">Selected</a>
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                        if($my_package_price->pack_price <= $pk->pack_price)
                                                        {
                                                            // if($getMyPack->package_id == 1)
                                                            // {
                                                    ?>
                                                    <button class="stripe-button payButton btn btn-d btn-sm waves-effect waves-light" onclick="return create_CheckoutSess('<?php echo $pk->stripe_price_id;?>');">
                                                        <div class="spinner hidden spinner"></div>
                                                        <span class="buttonText">Upgrade</span>
                                                    </button>
                                                    <?php
                                                            // }
                                                            // else
                                                            // {
                                                    ?>
                                                    <!-- <button class="stripe-button payButton btn btn-d btn-sm waves-effect waves-light" onclick="return update_Subscription('<?php echo $pk->stripe_price_id;?>');">
                                                        <div class="spinner hidden spinner"></div>
                                                        <span class="buttonText">Upgrade</span>
                                                    </button> -->
                                                    <?php     
                                                            // }
                                                        }

                                                        // if($pk->pack_id == '1')
                                                        // {
                                                    ?>
                                                    <!-- <a href="javascript: void(0);" onclick="return downgrade_pack();" id="downgrade_pack" class="btn bg-d btn-sm waves-effect waves-light text-white">Downgrade</a>
                                                    <a href="javascript: void(0);" id="downgrade_pack_process" class="btn bg-d btn-sm waves-effect waves-light text-white" style="display:none;">Processing</a> -->
                                                    <?php
                                                        // }
                                                    }
                                                    if($pk->stripe_link == 'no')
                                                    {
                                                    ?>
                                                    <button type="button" class="btn btn-d btn-sm waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#pack_ContactSales">Contact Sales</button>
                                                    <?php
                                                    }
                                                }
                                                ?>
                                            </div>

                                            <div class="plan-features mt-5">
                                                
                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $pk->pack_portfolio; if($plabels){ echo ' '.$plabels->portfolio;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $pk->pack_goals; if($plabels){ echo ' '.$plabels->goals;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $pk->pack_goals_strategies; if($plabels){ echo ' '.$plabels->goals_strategies;}?></p>
                                                
                                                <!-- <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $pk->pack_goals_strategies_projects; if($plabels){ echo ' '.$plabels->goals_strategies_projects;}?></p> -->

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $pk->pack_projects; if($plabels){ echo ' '.$plabels->projects;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $pk->pack_team_members; if($plabels){ echo ' '.$plabels->team_members;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $pk->pack_tasks; if($plabels){ echo ' '.$plabels->task;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $pk->pack_storage; if($plabels){ echo ' '.$plabels->storage;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->accountability_tracking;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->document_collaboration;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->kanban_boards;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->motivator;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->internal_chat;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $pk->pack_content_planner; if($plabels){ echo ' '.$plabels->content_planner;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->data_recovery;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->email_support;}?></p>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                        }
                                        else
                                        {
                                            if($pk->stripe_link == 'yes')
                                            {
                                            $plabels = $this->Front_model->pricing_labels($pk->pack_id);
                                ?>
                                <div class="col-xl-3 col-md-6">
                                    <div class="card plan-box <?php if($getMyPack->package_id == $pk->pack_id){ echo 'border border-success-cus';}?>" style="min-height: 98%;">
                                        <div class="card-body p-4">
                                            <!-- <img src="./assets/images/brands/special-offers.png" style="width: 125px; height: 125px; margin-top: -53px; margin-left: 25%;"> -->                                       
                                            <div class="media" <?php if($pk->stripe_link == 'no')
                                                {  echo "style='min-height: 188px;'";} else { if($pk->pack_id == '3')
                                            { echo "style='min-height: 100px;'";} else{ echo "style='min-height: 150px;'";}}?>>
                                                <div class="media-body">
                                                    <h5><?php echo ucfirst($pk->pack_name);?></h5>
                                                    <p class="text-muted"><?php echo ucfirst($pk->pack_tagline);?></p> 
                                                </div>
                                                <div class="ms-3">
                                                    <?php
                                                    if($pk->pack_id == '1')
                                                    {
                                                    ?>
                                                    <i class="bx bx-walk h1 text-d"></i>
                                                    <?php
                                                    }
                                                    elseif($pk->pack_id == '2')
                                                    {
                                                    ?>
                                                    <i class="bx bx-cycling h1 text-d"></i>
                                                    <?php
                                                    } 
                                                    elseif($pk->pack_id == '3')
                                                    {
                                                    ?>
                                                    <i class="bx bx-car h1 text-d"></i>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <i class="bx bxs-plane-alt h1 text-d"></i>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <?php 
                                            if($pk->pack_id == '3')
                                            {
                                            ?>
                                            <!-- Offer Ribbon start -->
                                            <div class="ribbon-2">
                                                <span>
                                                    <strong style="display: inline-block;padding: 1.2em 1em;position: relative;color: #fff;">SPECIAL OFFER!</strong>
                                                </span>
                                            </div>
                                            <!-- Offer Ribbon end -->
                                            <?php
                                            }
                                            ?>
                                            <div class="py-4">
                                                <?php 
                                                if($pk->stripe_link == 'yes')
                                                {
                                                ?>
                                                <h2><sup><small>$</small></sup> <?php echo $pk->pack_price;?>/ <span class="font-size-13">
                                                    <?php 
                                                    if(is_numeric($pk->pack_validity))
                                                    {
                                                       if($pk->pack_validity == '30')
                                                       {
                                                            echo "billed monthly";
                                                       }
                                                       elseif($pk->pack_validity == '365')
                                                       {
                                                            echo "billed annually";
                                                       }
                                                       else
                                                       {
                                                            echo $pk->pack_validity." Days";
                                                       }
                                                    }
                                                    else
                                                    {
                                                        echo ucfirst($pk->pack_validity);
                                                    }
                                                    ?>
                                                    </span></h2>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="text-center plan-btn">
                                                <?php
                                                if($getMyPack)
                                                {
                                                    if($getMyPack->package_id == $pk->pack_id)
                                                    {
                                                        ?>
                                                            <a href="javascript: void(0);" class="btn bg-d btn-sm waves-effect waves-light text-white">Selected</a>
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                        if($my_package_price->pack_price <= $pk->pack_price)
                                                        {
                                                            // if($getMyPack->package_id == 1)
                                                            // {
                                                    ?>
                                                    <button class="stripe-button payButton btn btn-d btn-sm waves-effect waves-light" onclick="return create_CheckoutSess('<?php echo $pk->stripe_price_id;?>');">
                                                        <div class="spinner hidden spinner"></div>
                                                        <span class="buttonText">Upgrade</span>
                                                    </button>
                                                    <?php
                                                            // }
                                                            // else
                                                            // {
                                                    ?>
                                                    <!-- <button class="stripe-button payButton btn btn-d btn-sm waves-effect waves-light" onclick="return update_Subscription('<?php echo $pk->stripe_price_id;?>');">
                                                        <div class="spinner hidden spinner"></div>
                                                        <span class="buttonText">Upgrade</span>
                                                    </button> -->
                                                    <?php     
                                                            // }
                                                        }

                                                        // if($pk->pack_id == '1')
                                                        // {
                                                    ?>
                                                    <!-- <a href="javascript: void(0);" onclick="return downgrade_pack();" id="downgrade_pack" class="btn bg-d btn-sm waves-effect waves-light text-white">Downgrade</a>
                                                    <a href="javascript: void(0);" id="downgrade_pack_process" class="btn bg-d btn-sm waves-effect waves-light text-white" style="display:none;">Processing</a> -->
                                                    <?php
                                                        // }
                                                    }
                                                }
                                                ?>
                                            </div>

                                            <div class="plan-features mt-5">
                                                
                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $pk->pack_portfolio; if($plabels){ echo ' '.$plabels->portfolio;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $pk->pack_goals; if($plabels){ echo ' '.$plabels->goals;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $pk->pack_goals_strategies; if($plabels){ echo ' '.$plabels->goals_strategies;}?></p>
                                                
                                                <!-- <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $pk->pack_goals_strategies_projects; if($plabels){ echo ' '.$plabels->goals_strategies_projects;}?></p> -->

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $pk->pack_projects; if($plabels){ echo ' '.$plabels->projects;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $pk->pack_team_members; if($plabels){ echo ' '.$plabels->team_members;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $pk->pack_tasks; if($plabels){ echo ' '.$plabels->task;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $pk->pack_storage; if($plabels){ echo ' '.$plabels->storage;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->accountability_tracking;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->document_collaboration;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->kanban_boards;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->motivator;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->internal_chat;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $pk->pack_content_planner; if($plabels){ echo ' '.$plabels->content_planner;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->data_recovery;}?></p>

                                                <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->email_support;}?></p>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                            }
                                        }                                        
                                    }
                                }
                                //if coupon not applied
                                else
                                {
                                    if($check_cus_pack_created == 'no')
                                    {
                                        $plabels = $this->Front_model->pricing_labels($pk->pack_id);
                            ?>
                            <div class="col-xl-3 col-md-6">
                                <div class="card plan-box <?php if($getMyPack->package_id == $pk->pack_id){ echo 'border border-success-cus';}?>" style="min-height: 98%;">
                                    <div class="card-body p-4">
                                        <!-- <img src="./assets/images/brands/special-offers.png" style="width: 125px; height: 125px; margin-top: -53px; margin-left: 25%;"> -->                                       
                                        <div class="media" <?php if($pk->stripe_link == 'no')
                                            {  echo "style='min-height: 120px;'";} else { if($pk->pack_id == '3')
                                        { echo "style='min-height: 108px;'";} else{ echo "style='min-height: 158px;'";}}?>>
                                            <div class="media-body">
                                                <h5><?php echo ucfirst($pk->pack_name);?></h5>
                                                <p class="text-muted"><?php echo ucfirst($pk->pack_tagline);?></p> 
                                            </div>
                                            <div class="ms-3">
                                                <?php
                                                if($pk->pack_id == '1')
                                                {
                                                ?>
                                                <i class="bx bx-walk h1 text-d"></i>
                                                <?php
                                                }
                                                elseif($pk->pack_id == '2')
                                                {
                                                ?>
                                                <i class="bx bx-cycling h1 text-d"></i>
                                                <?php
                                                } 
                                                elseif($pk->pack_id == '3')
                                                {
                                                ?>
                                                <i class="bx bx-car h1 text-d"></i>
                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                <i class="bx bxs-plane-alt h1 text-d"></i>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <?php 
                                        if($pk->pack_id == '3')
                                        {
                                        ?>
                                        <!-- Offer Ribbon start -->
                                        <div class="ribbon-2">
                                            <span>
                                                <strong style="display: inline-block;padding: 1.2em 1em;position: relative;color: #fff;">SPECIAL OFFER!</strong>
                                            </span>
                                        </div>
                                        <!-- Offer Ribbon end -->
                                        <?php
                                        }
                                        ?>
                                        <div class="py-4">
                                            <?php 
                                            if($pk->stripe_link == 'yes')
                                            {
                                            ?>
                                            <h2><sup><small>$</small></sup> <?php echo $pk->pack_price;?>/ <span class="font-size-13">
                                                <?php 
                                                if(is_numeric($pk->pack_validity))
                                                {
                                                   if($pk->pack_validity == '30')
                                                   {
                                                        echo "billed monthly";
                                                   }
                                                   elseif($pk->pack_validity == '365')
                                                   {
                                                        echo "billed annually";
                                                   }
                                                   else
                                                   {
                                                        echo $pk->pack_validity." Days";
                                                   }
                                                }
                                                else
                                                {
                                                    echo ucfirst($pk->pack_validity);
                                                }
                                                ?>
                                                </span></h2>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <center>
                                                <h5><strong>Let’s Talk</strong></h5>
                                                <img src="<?php echo base_url('/assets/images/Decision-168-lets-talk-480x480.png');?>" class="img-fluid" width="25%" height="auto">
                                            </center>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="text-center plan-btn">
                                            <?php
                                            if($getMyPack)
                                            {
                                                if($getMyPack->package_id == $pk->pack_id)
                                                {
                                                    ?>
                                                        <a href="javascript: void(0);" class="btn bg-d btn-sm waves-effect waves-light text-white">Selected</a>
                                                    <?php
                                                }
                                                else
                                                {
                                                    if($my_package_price->pack_price <= $pk->pack_price)
                                                    {
                                                        if($getMyPack->package_id == 1)
                                                        {
                                                ?>
                                                <button class="stripe-button payButton btn btn-d btn-sm waves-effect waves-light" onclick="return create_CheckoutSess('<?php echo $pk->stripe_price_id;?>');">
                                                    <div class="spinner hidden spinner"></div>
                                                    <span class="buttonText">Upgrade</span>
                                                </button>
                                                <?php
                                                        }
                                                        else
                                                        {
                                                ?>
                                                <button class="stripe-button payButton btn btn-d btn-sm waves-effect waves-light" onclick="return update_Subscription('<?php echo $pk->stripe_price_id;?>');">
                                                    <div class="spinner hidden spinner"></div>
                                                    <span class="buttonText">Upgrade</span>
                                                </button>
                                                <?php     
                                                        }
                                                    }

                                                    if($pk->pack_id == '1')
                                                    {
                                                ?>
                                                <a href="javascript: void(0);" onclick="return downgrade_pack();" id="downgrade_pack" class="btn bg-d btn-sm waves-effect waves-light text-white">Downgrade</a>
                                                <a href="javascript: void(0);" id="downgrade_pack_process" class="btn bg-d btn-sm waves-effect waves-light text-white" style="display:none;">Processing</a>
                                                <?php
                                                    }
                                                }
                                                if($pk->stripe_link == 'no')
                                                {
                                                ?>
                                                <button type="button" class="btn btn-d btn-sm waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#pack_ContactSales">Contact Sales</button>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </div>

                                        <div class="plan-features mt-5">
                                            
                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $pk->pack_portfolio; if($plabels){ echo ' '.$plabels->portfolio;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $pk->pack_goals; if($plabels){ echo ' '.$plabels->goals;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $pk->pack_goals_strategies; if($plabels){ echo ' '.$plabels->goals_strategies;}?></p>
                                            
                                            <!-- <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $pk->pack_goals_strategies_projects; if($plabels){ echo ' '.$plabels->goals_strategies_projects;}?></p> -->

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $pk->pack_projects; if($plabels){ echo ' '.$plabels->projects;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $pk->pack_team_members; if($plabels){ echo ' '.$plabels->team_members;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $pk->pack_tasks; if($plabels){ echo ' '.$plabels->task;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $pk->pack_storage; if($plabels){ echo ' '.$plabels->storage;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->accountability_tracking;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->document_collaboration;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->kanban_boards;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->motivator;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->internal_chat;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $pk->pack_content_planner; if($plabels){ echo ' '.$plabels->content_planner;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->data_recovery;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->email_support;}?></p>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                    }
                                    else
                                    {
                                        if($pk->stripe_link == 'yes')
                                        {
                                        $plabels = $this->Front_model->pricing_labels($pk->pack_id);
                            ?>
                            <div class="col-xl-3 col-md-6">
                                <div class="card plan-box <?php if($getMyPack->package_id == $pk->pack_id){ echo 'border border-success-cus';}?>" style="min-height: 98%;">
                                    <div class="card-body p-4">
                                        <!-- <img src="./assets/images/brands/special-offers.png" style="width: 125px; height: 125px; margin-top: -53px; margin-left: 25%;"> -->                                       
                                        <div class="media" <?php if($pk->stripe_link == 'no')
                                            {  echo "style='min-height: 188px;'";} else { if($pk->pack_id == '3')
                                        { echo "style='min-height: 100px;'";} else{ echo "style='min-height: 150px;'";}}?>>
                                            <div class="media-body">
                                                <h5><?php echo ucfirst($pk->pack_name);?></h5>
                                                <p class="text-muted"><?php echo ucfirst($pk->pack_tagline);?></p> 
                                            </div>
                                            <div class="ms-3">
                                                <?php
                                                if($pk->pack_id == '1')
                                                {
                                                ?>
                                                <i class="bx bx-walk h1 text-d"></i>
                                                <?php
                                                }
                                                elseif($pk->pack_id == '2')
                                                {
                                                ?>
                                                <i class="bx bx-cycling h1 text-d"></i>
                                                <?php
                                                } 
                                                elseif($pk->pack_id == '3')
                                                {
                                                ?>
                                                <i class="bx bx-car h1 text-d"></i>
                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                <i class="bx bxs-plane-alt h1 text-d"></i>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <?php 
                                        if($pk->pack_id == '3')
                                        {
                                        ?>
                                        <!-- Offer Ribbon start -->
                                        <div class="ribbon-2">
                                            <span>
                                                <strong style="display: inline-block;padding: 1.2em 1em;position: relative;color: #fff;">SPECIAL OFFER!</strong>
                                            </span>
                                        </div>
                                        <!-- Offer Ribbon end -->
                                        <?php
                                        }
                                        ?>
                                        <div class="py-4">
                                            <?php 
                                            if($pk->stripe_link == 'yes')
                                            {
                                            ?>
                                            <h2><sup><small>$</small></sup> <?php echo $pk->pack_price;?>/ <span class="font-size-13">
                                                <?php 
                                                if(is_numeric($pk->pack_validity))
                                                {
                                                   if($pk->pack_validity == '30')
                                                   {
                                                        echo "billed monthly";
                                                   }
                                                   elseif($pk->pack_validity == '365')
                                                   {
                                                        echo "billed annually";
                                                   }
                                                   else
                                                   {
                                                        echo $pk->pack_validity." Days";
                                                   }
                                                }
                                                else
                                                {
                                                    echo ucfirst($pk->pack_validity);
                                                }
                                                ?>
                                                </span></h2>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="text-center plan-btn">
                                            <?php
                                            if($getMyPack)
                                            {
                                                if($getMyPack->package_id == $pk->pack_id)
                                                {
                                                    ?>
                                                        <a href="javascript: void(0);" class="btn bg-d btn-sm waves-effect waves-light text-white">Selected</a>
                                                    <?php
                                                }
                                                else
                                                {
                                                    if($my_package_price->pack_price <= $pk->pack_price)
                                                    {
                                                        if($getMyPack->package_id == 1)
                                                        {
                                                ?>
                                                <button class="stripe-button payButton btn btn-d btn-sm waves-effect waves-light" onclick="return create_CheckoutSess('<?php echo $pk->stripe_price_id;?>');">
                                                    <div class="spinner hidden spinner"></div>
                                                    <span class="buttonText">Upgrade</span>
                                                </button>
                                                <?php
                                                        }
                                                        else
                                                        {
                                                ?>
                                                <button class="stripe-button payButton btn btn-d btn-sm waves-effect waves-light" onclick="return update_Subscription('<?php echo $pk->stripe_price_id;?>');">
                                                    <div class="spinner hidden spinner"></div>
                                                    <span class="buttonText">Upgrade</span>
                                                </button>
                                                <?php     
                                                        }
                                                    }

                                                    if($pk->pack_id == '1')
                                                    {
                                                ?>
                                                <a href="javascript: void(0);" onclick="return downgrade_pack();" id="downgrade_pack" class="btn bg-d btn-sm waves-effect waves-light text-white">Downgrade</a>
                                                <a href="javascript: void(0);" id="downgrade_pack_process" class="btn bg-d btn-sm waves-effect waves-light text-white" style="display:none;">Processing</a>
                                                <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>

                                        <div class="plan-features mt-5">
                                            
                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $pk->pack_portfolio; if($plabels){ echo ' '.$plabels->portfolio;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $pk->pack_goals; if($plabels){ echo ' '.$plabels->goals;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $pk->pack_goals_strategies; if($plabels){ echo ' '.$plabels->goals_strategies;}?></p>
                                            
                                            <!-- <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $pk->pack_goals_strategies_projects; if($plabels){ echo ' '.$plabels->goals_strategies_projects;}?></p> -->

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $pk->pack_projects; if($plabels){ echo ' '.$plabels->projects;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $pk->pack_team_members; if($plabels){ echo ' '.$plabels->team_members;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $pk->pack_tasks; if($plabels){ echo ' '.$plabels->task;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $pk->pack_storage; if($plabels){ echo ' '.$plabels->storage;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->accountability_tracking;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->document_collaboration;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->kanban_boards;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->motivator;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->internal_chat;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $pk->pack_content_planner; if($plabels){ echo ' '.$plabels->content_planner;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->data_recovery;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->email_support;}?></p>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                        }
                                    }                                
                                }
                                }
                            }
                            ?>

                            
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

<!-- contact sales modal start -->
<div id="pack_ContactSales" class="modal fade" data-bs-backdrop="static" aria-labelledby="pack_ContactSalesLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="pack_ContactSalesLabel">Contact Sales</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" name="insert_ContactSales" id="insert_ContactSales" enctype="multipart/form-data" autocomplete="off">
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <label class="col-form-label">Name <span class="text-danger">*</span></label>
                            <div>
                                <input id="fname" name="fname" type="text" class="form-control" placeholder="Enter Full Name..." value="<?php echo $getMyPack->first_name.' '.$getMyPack->last_name;?>" required="" readonly>
                            <span id="fnameErr" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <label class="col-form-label">Email <span class="text-danger">*</span></label>
                            <div>
                                <input id="email" name="email" type="email" class="form-control" placeholder="Enter Email Address..." value="<?php echo $getMyPack->email_address;?>" required="" readonly>
                            <span id="emailErr" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <label class="col-form-label">Phone <span class="text-danger">*</span></label>
                            <div>
                                <input id="phone" name="phone" type="text" class="form-control" placeholder="Enter Phone number..." value="<?php echo $getMyPack->phone_number;?>" required="" readonly>
                            <span id="phoneErr" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <label class="col-form-label">How many users are you exploring Decision168 for? <span class="text-danger">*</span></label>
                            <div>
                                <select id="total_users" name="total_users" class="form-control" required>
                                    <option value="">Choose</option>
                                    <option value="0-10">0-10</option>
                                    <option value="11-50">11-50</option>
                                    <option value="51-250">51-250</option>
                                    <option value="251-500">251-500</option>
                                    <option value="501+">501+</option>
                                </select>
                                <span id="total_usersErr" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <span id="Already_contactedErr" class="text-danger"></span>

                </div>
                <div class="modal-footer">
                    <img id="loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                    <button type="submit" id="insert_ContactSales_btn" class="btn btn-d btn-sm">Send</button>
                    <button type="button" class="btn bg-d btn-sm text-white" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- contact sales modal end -->

<?php
if($getMyPack)
{
    if(($getMyPack->package_id == '1') && ($getMyPack->package_coupon_id == '0'))
    {
        $active_code = $this->Front_model->check_any_active_code();
        if($active_code > 0)
        {
            $show_but = 'no';
            $my_used_co_id = explode(',', $getMyPack->used_package_coupon_id); 
            $get_active_co_id = $this->Front_model->get_active_coupon_id();
            if($get_active_co_id)
            {
                foreach($get_active_co_id as $gacd)
                {
                    $co_id = $gacd->co_id;
                    $index = array_search($co_id,$my_used_co_id);
                    if($index === FALSE)
                    {
                        if($show_but == 'no')
                        {
                            $show_but = 'yes';
                        }
                    }
                }
            }
            if($show_but == 'yes')
            { 
?>
<!-- free trial modal start -->
<div id="free_trial_account" class="modal fade" data-bs-backdrop="static" aria-labelledby="free_trial_accountLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="free_trial_accountLabel">Free Trial</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" name="free_trial_account_access" id="free_trial_account_access" enctype="multipart/form-data" autocomplete="off">
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <!-- <label class="col-form-label">Code/Coupon <span class="text-danger">*</span></label> -->
                            <div>
                                <input id="code" name="code" type="text" class="form-control" placeholder="Enter Code/Coupon..." required="">
                            <span id="codeErr" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <img id="co_loader2" style="visibility: hidden;" src="<?php echo base_url()?>assets/images/loading.gif">
                    <button type="submit" id="free_trial_account_access_btn" class="btn btn-d btn-sm">Apply</button>
                    <button type="button" class="btn bg-d btn-sm text-white" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- free trial modal end -->
<?php
            }
        }
    }
}
?>

        <!-- JAVASCRIPT -->
<script src="<?php echo base_url();?>assets/libs/jquery/jquery.min.js"></script>
<script>
// Set Stripe publishable key to initialize Stripe.js
const stripe = Stripe('<?php echo $this->config->item('stripe_publishable_key'); ?>');

// Select payment button
const payBtn = document.getElementsByTagName("button");

// Update Payment request handler
function update_Subscription(price_id) {
    setLoading(true);
    var price_id = price_id;
    console.log(price_id);
    //ajax call 
    $.ajax({
         url: "<?php echo base_url('update-subscription');?>",
         type: "post",
         data: { price_id: price_id },
         success: function(data)
          { 
            if(data.status == true)
            {
              window.location.reload();
            }                
          }
    });
    //alert(price_id);
    console.log('set successfully');    
}

// Payment request handler
function create_CheckoutSess(price_id) {
    setLoading(true);
    var price_id = price_id;
    console.log(price_id);
    //ajax call 
    $.ajax({
         url: "<?php echo base_url('set-price-id-session');?>",
         type: "post",
         data: { price_id: price_id },
         success: function(data)
          { 
            if(data.status == true)
            {
              createCheckoutSession().then(function (data) {
                    if(data.sessionId){
                        stripe.redirectToCheckout({
                            sessionId: data.sessionId,
                        }).then(handleResult);
                    }else{
                        handleResult(data);
                    }
                });
            }                
          }
    });
    //alert(price_id);
    console.log('set successfully');    
}
    
// Create a Checkout Session with the selected product
const createCheckoutSession = function (stripe) {
    return fetch("<?php echo base_url('checkout-payment-initialize');?>", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            createCheckoutSession: 1,
        }),
    }).then(function (result) {
        return result.json();
    });
};

// Handle any errors returned from Checkout
const handleResult = function (result) {
    if (result.error) {
        showMessage(result.error.message);
    }
    
    setLoading(false);
};

// Show a spinner on payment processing
function setLoading(isLoading) {
    if (isLoading) {
        // Disable the button and show a spinner
        for (var i = 0; i < payBtn.length; i++) {
                payBtn.disabled = true;
            }        
        document.querySelector(".spinner").classList.remove("hidden");
        document.querySelector(".buttonText").classList.add("hidden");
    } else {
        // Enable the button and hide spinner
        for (var i = 0; i < payBtn.length; i++) {
                payBtn.disabled = false;
            } 
        document.querySelector(".spinner").classList.add("hidden");
        document.querySelector(".buttonText").classList.remove("hidden");
    }
}

// Display message
function showMessage(messageText) {
    const messageContainer = document.querySelector("#paymentResponse");
    
    messageContainer.classList.remove("hidden");
    messageContainer.textContent = messageText;
    
    setTimeout(function () {
        messageContainer.classList.add("hidden");
        messageText.textContent = "";
    }, 5000);
}
</script>
<script src="<?php echo base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/metismenu/metisMenu.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/node-waves/waves.min.js"></script>

    <?php
include('footer_links.php');
?>
    </body>

</html>
