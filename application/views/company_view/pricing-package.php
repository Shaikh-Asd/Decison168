<?php
$page = 'pricing-packages';
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
        <meta charset="utf-8" />
<title>Pricing | Decision168</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- App favicon -->
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
<!-- Stripe JavaScript library -->
<script src="https://js.stripe.com/v3/"></script>
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
if($compd)
{
   if((!empty($compd->sub_cancel_reason)) && ($compd->sub_cancel_reason_notify == 'yes'))
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
                            $getCompPackDetail = $this->Company_model->getPackDetail($compd->package_id);
                            if($getCompPackDetail)
                            { 
                                $plabels = $this->Company_model->pricing_labels($getCompPackDetail->pack_id);
                            ?>
                            <div class="col-xl-3 col-md-6">
                                <div class="card plan-box border border-success-cus" style="min-height: 98%;">
                                    <div class="card-body p-4">
                                        <!-- <img src="./assets/images/brands/special-offers.png" style="width: 125px; height: 125px; margin-top: -53px; margin-left: 25%;"> -->                                       
                                        <div class="media" style="min-height: 158px;">
                                            <div class="media-body">
                                                <h5><?php echo ucfirst($getCompPackDetail->pack_name);?></h5>
                                                <p class="text-muted"><?php echo ucfirst($getCompPackDetail->pack_tagline);?></p> 
                                            </div>
                                            <div class="ms-3">
                                                <i class="bx bxs-plane-alt h1 text-d"></i>
                                            </div>
                                        </div>
                                        <div class="py-4">
                                            <?php 
                                            if($getCompPackDetail->stripe_link == 'yes')
                                            {
                                            ?>
                                            <h2><sup><small>$</small></sup> <?php echo $getCompPackDetail->pack_price;?>/ <span class="font-size-13">
                                                <?php 
                                                if(is_numeric($getCompPackDetail->pack_validity))
                                                {
                                                   if($getCompPackDetail->pack_validity == '30')
                                                   {
                                                        echo "billed monthly";
                                                   }
                                                   elseif($getCompPackDetail->pack_validity == '90')
                                                   {
                                                        echo "3 Months";
                                                   }
                                                   elseif($getCompPackDetail->pack_validity == '180')
                                                   {
                                                        echo "6 Months";
                                                   }
                                                   elseif($getCompPackDetail->pack_validity == '270')
                                                   {
                                                        echo "9 Months";
                                                   }
                                                   elseif($getCompPackDetail->pack_validity == '365')
                                                   {
                                                        echo "billed annually";
                                                   }
                                                   else
                                                   {
                                                        echo $getCompPackDetail->pack_validity." Days";
                                                   }
                                                }
                                                else
                                                {
                                                    echo ucfirst($getCompPackDetail->pack_validity);
                                                }
                                                ?>
                                                </span></h2>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="text-center plan-btn">
                                            <?php
                                            if($compd)
                                            {
                                                if(($compd->package_use == 'yes') && (empty($compd->extended_pack)))
                                                {
                                                    ?>
                                                        <a href="javascript: void(0);" class="btn bg-d btn-sm waves-effect waves-light text-white">Selected</a>
                                                    <?php
                                                }
                                                else
                                                {
                                                ?>
                                                <button class="stripe-button payButton btn btn-d btn-sm waves-effect waves-light" onclick="return create_CheckoutSess('<?php echo $getCompPackDetail->stripe_price_id;?>');">
                                                    <div class="spinner hidden spinner"></div>
                                                    <span class="buttonText">Pay</span>
                                                </button>
                                                <?php 
                                                }
                                            }
                                            ?>
                                        </div>

                                        <div class="plan-features mt-5">
                                            
                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $getCompPackDetail->pack_portfolio; if($plabels){ echo ' '.$plabels->portfolio;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $getCompPackDetail->pack_goals; if($plabels){ echo ' '.$plabels->goals;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $getCompPackDetail->pack_goals_strategies; if($plabels){ echo ' '.$plabels->goals_strategies;}?></p>
                                            
                                            <!-- <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $getCompPackDetail->pack_goals_strategies_projects; if($plabels){ echo ' '.$plabels->goals_strategies_projects;}?></p> -->

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $getCompPackDetail->pack_projects; if($plabels){ echo ' '.$plabels->projects;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $getCompPackDetail->pack_team_members; if($plabels){ echo ' '.$plabels->team_members;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $getCompPackDetail->pack_tasks; if($plabels){ echo ' '.$plabels->task;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $getCompPackDetail->pack_storage; if($plabels){ echo ' '.$plabels->storage;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->accountability_tracking;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->document_collaboration;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->kanban_boards;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->motivator;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->internal_chat;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php echo $getCompPackDetail->pack_content_planner; if($plabels){ echo ' '.$plabels->content_planner;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->data_recovery;}?></p>

                                            <p><i class="bx bx-checkbox-square text-d mr-2"></i> <?php if($plabels){ echo ' '.$plabels->email_support;}?></p>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl col-md">
                                <div class="card plan-box border">
                                    <div class="card-body p-4">
                                        <!-- <img src="./assets/images/brands/special-offers.png" style="width: 125px; height: 125px; margin-top: -53px; margin-left: 25%;"> -->                                       
                                        <div class="media">
                                            <div class="media-body">
                                                <h5>Overall Package Usage</h5> 
                                            </div>
                                            <div class="ms-3">
                                                <i class="bx bxs-package h1 text-d"></i>
                                            </div>
                                        </div>
                                        <div class="plan-features mt-3">
                                            
                                            <div class="row">
                                                <div class="col-6"> 
                                                    <p><i class="bx bx-checkbox-square text-d mr-2"></i>
                                                    Total Portfolio Used: 
                                                    <?php
                                                    $getPortUsed = $this->Company_model->getPortfolioCountCorp($compd->cc_corporate_id);
                                                    $usedPort = trim($getPortUsed['portfolio_count_rows']);
                                                    echo $usedPort;
                                                    ?>     
                                                    </p>
                                                </div>
                                                <div class="col-6">
                                                    Remaining Portfolio: 
                                                    <?php
                                                    if(is_numeric($getCompPackDetail->pack_portfolio))
                                                    {
                                                        $totalPort = $getCompPackDetail->pack_portfolio;
                                                        $remPort = $totalPort - $usedPort;
                                                        echo $remPort;
                                                    }
                                                    ?> 
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-6"> 
                                                    <p><i class="bx bx-checkbox-square text-d mr-2"></i>
                                                    Total Goal Used: 
                                                    <?php
                                                    $getGoalUsed = $this->Company_model->getGoalCountCorp($compd->cc_corporate_id);
                                                    $usedGoal = trim($getGoalUsed['goal_count_rows']);
                                                    echo $usedGoal;
                                                    ?>     
                                                    </p>
                                                </div>
                                                <div class="col-6">
                                                    Remaining Goals: 
                                                    <?php
                                                    if((is_numeric($getCompPackDetail->pack_portfolio)) && (is_numeric($getCompPackDetail->pack_goals)))
                                                    {
                                                        $totalGoal = $getCompPackDetail->pack_portfolio * $getCompPackDetail->pack_goals;
                                                        $remGoal = $totalGoal - $usedGoal;
                                                        echo $remGoal;
                                                    }
                                                    ?> 
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-6"> 
                                                    <p><i class="bx bx-checkbox-square text-d mr-2"></i>
                                                    Total KPIs Used: 
                                                    <?php
                                                    $getKpiUsed = $this->Company_model->getStrategiesCountCorp($compd->cc_corporate_id);
                                                    $usedKpi = trim($getKpiUsed['strategy_count_rows']);
                                                    echo $usedKpi;
                                                    ?>     
                                                    </p>
                                                </div>
                                                <div class="col-6">
                                                    Remaining KPIs: 
                                                    <?php
                                                    if((is_numeric($getCompPackDetail->pack_portfolio)) && (is_numeric($getCompPackDetail->pack_goals)) && (is_numeric($getCompPackDetail->pack_goals_strategies)))
                                                    {
                                                        $totalKpi = $getCompPackDetail->pack_portfolio * $getCompPackDetail->pack_goals * $getCompPackDetail->pack_goals_strategies;
                                                        $remKpi = $totalKpi - $usedKpi;
                                                        echo $remKpi;
                                                    }      
                                                    ?> 
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-6"> 
                                                    <p><i class="bx bx-checkbox-square text-d mr-2"></i>
                                                    Total Projects Used: 
                                                    <?php
                                                    $getProUsed = $this->Company_model->getProjectCountCorp($compd->cc_corporate_id);
                                                    $usedPro = trim($getProUsed['project_count_rows']);
                                                    echo $usedPro;
                                                    ?>     
                                                    </p>
                                                </div>
                                                <div class="col-6">
                                                    Remaining Projects: 
                                                    <?php
                                                    if((is_numeric($getCompPackDetail->pack_portfolio)) && (is_numeric($getCompPackDetail->pack_projects)))
                                                    {
                                                        $totalPro = $getCompPackDetail->pack_portfolio * $getCompPackDetail->pack_projects;
                                                        $remPro = $totalPro - $usedPro;
                                                        echo $remPro;
                                                    }      
                                                    ?> 
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-6"> 
                                                    <p><i class="bx bx-checkbox-square text-d mr-2"></i>
                                                    Total Posts / Mo. Content Planner Used: 
                                                    <?php
                                                    $current_month = date('m');
                                                    $current_year = date('Y');
                                                    $getProUsed = $this->Company_model->getMonthWiseContentCorp($current_month,$current_year,$compd->cc_corporate_id);
                                                    $usedPro = trim($getProUsed['content_count_rows']);
                                                    echo $usedPro;
                                                    ?>     
                                                    </p>
                                                </div>
                                                <div class="col-6">
                                                    Remaining Posts / Mo. Content Planner: 
                                                    <?php
                                                    if((is_numeric($getCompPackDetail->pack_portfolio)) && (is_numeric($getCompPackDetail->pack_projects)))
                                                    {
                                                        $totalPro = $getCompPackDetail->pack_portfolio * $getCompPackDetail->pack_projects;
                                                        $remPro = $totalPro - $usedPro;
                                                        echo $remPro;
                                                    }      
                                                    ?> 
                                                </div>
                                            </div>
                                                                                    
                                        </div>
                                    </div>
                                </div>
                            </div>                             
                            <?php
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


        <!-- JAVASCRIPT -->
<script src="<?php echo base_url();?>assets/libs/jquery/jquery.min.js"></script>
<script>
// Set Stripe publishable key to initialize Stripe.js
const stripe = Stripe('<?php echo $this->config->item('stripe_publishable_key'); ?>');

// Select payment button
const payBtn = document.getElementsByTagName("button");

// Update Payment request handler
// function update_Subscription(price_id) {
//     setLoading(true);
//     var price_id = price_id;
//     console.log(price_id);
//     //ajax call 
//     $.ajax({
//          url: "<?php echo base_url('update-subscription');?>",
//          type: "post",
//          data: { price_id: price_id },
//          success: function(data)
//           { 
//             if(data.status == true)
//             {
//               window.location.reload();
//             }                
//           }
//     });
//     //alert(price_id);
//     console.log('set successfully');    
// }

// Payment request handler
function create_CheckoutSess(price_id) {
    setLoading(true);
    var price_id = price_id;
    console.log(price_id);
    //ajax call 
    $.ajax({
         url: "<?php echo base_url('set-price-id-session-comp');?>",
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
    return fetch("<?php echo base_url('checkout-payment-initialize-comp');?>", {
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
