<!-- Stripe JavaScript library -->
<script src="https://js.stripe.com/v2/"></script>
    
<!-- jQuery is used only for this example; it isn't required to use Stripe -->
<script src="<?php echo base_url('assets/libs/jquery/jquery.min.js'); ?>"></script>
    
<script>
// Set your publishable key
Stripe.setPublishableKey('<?php echo $this->config->item('stripe_publishable_key'); ?>');

// Callback to handle the response from stripe
function stripeResponseHandler(status, response) {
        //debugger;
    if (response.error) {
        // Enable the submit button
        //$('#payBtn').removeAttr("disabled");
        // Display the errors on the form
        $(".card-errors").html('<p>'+response.error.message+'</p>');
    } else {
        var form$ = $("#paymentFrm");
        // Get token id
        var token = response.id;
        // Insert the token into the form
        form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
        // Submit form to the server
        form$.get(0).submit();
    }
}

$(document).ready(function() {
       // debugger;
//$("#paymentFrm").submit();
    // On form submit
    //$("#paymentFrm").submit(function() {
       // debugger;
              
        // Create single-use token to charge the user
        Stripe.createToken({
            number: $('#card_number').val(),
            exp_month: $('#card_exp_month').val(),
            exp_year: $('#card_exp_year').val(),
            cvc: $('#card_cvc').val()
        }, stripeResponseHandler);
        
        // Submit from callback
        return false;
   // });
});
</script>
</head>
<form action="<?php echo base_url('front/renew_payment');?>" method="POST" id="paymentFrm" >
    <input type="hidden" name="pack_id" value="<?php echo $package['pack_id']; ?>" readonly>
    <input type="hidden" name="pack_name" value="<?php echo $package['pack_name']; ?>" readonly>
    <input type="hidden" name="pack_price" value="<?php echo $package['pack_price']; ?>" readonly>
    <input type="hidden" name="pack_validity" value="<?php echo $package['pack_validity']; ?>" readonly>
    <input type="hidden" name="left_amt" value="<?php echo $package['left_amt']; ?>" readonly>
    <input type="hidden" name="name" id="name" value="<?php echo $package['name'];?>" readonly required="">
    <input type="hidden" name="email" id="email" value="<?php echo $package['email'];?>" readonly required="">
    <input type="hidden" name="card_number" id="card_number" value="<?php echo $package['card_number'];?>" readonly required="">
    <input type="hidden" name="card_exp_month" id="card_exp_month" value="<?php echo $package['card_exp_month'];?>" readonly required="">
    <input type="hidden" name="card_exp_year" id="card_exp_year" value="<?php echo $package['card_exp_year'];?>" readonly required="">
    <input type="hidden" name="card_cvc" id="card_cvc" value="<?php echo $package['card_cvc'];?>" readonly required="">
    <!-- <button type="submit" class="btn btn-success" id="payBtn">Pay</button> -->
</form>