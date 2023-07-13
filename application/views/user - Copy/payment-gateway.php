<!DOCTYPE html>
<html lang="en-US">
<head>
<title>Decision 168 Payment Gateway</title>
<!-- App favicon -->
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/Decision-168.png">
<meta charset="utf-8">

<!-- Stylesheet file -->
<link rel="stylesheet" href="<?php echo base_url('assets/css/pay_style.css'); ?>">
	
<!-- Stripe JavaScript library -->
<script src="https://js.stripe.com/v2/"></script>
	
<!-- jQuery is used only for this example; it isn't required to use Stripe -->
<script src="<?php echo base_url('assets/libs/jquery/jquery.min.js'); ?>"></script>
	
<script>
// Set your publishable key
Stripe.setPublishableKey('<?php echo $this->config->item('stripe_publishable_key'); ?>');

// Callback to handle the response from stripe
function stripeResponseHandler(status, response) {
	if (response.error) {
		// Enable the submit button
		$('#payBtn').removeAttr("disabled");
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
	// On form submit
	$("#paymentFrm").submit(function() {
		// Disable the submit button to prevent repeated clicks
		$('#payBtn').attr("disabled", "disabled");
		
		// Create single-use token to charge the user
		Stripe.createToken({
			number: $('#card_number').val(),
			exp_month: $('#card_exp_month').val(),
			exp_year: $('#card_exp_year').val(),
			cvc: $('#card_cvc').val()
		}, stripeResponseHandler);
		
		// Submit from callback
		return false;
	});
});
</script>
</head>
<body class="pay_body">
<div class="container">
	<div class="panel">
		<div class="panel-heading">
			<h3 class="panel-title">
				<a href="<?php echo base_url();?>" class="d-block auth-logo">
			        <img src="<?php echo base_url();?>assets/images/logo-main.png" alt="" height="50" class="auth-logo-dark">
			    </a>
			</h3>
			<div class="row">
					<div class="left">
						<h4><b>Package:</b> <span style="color: #c7df19;"><?php echo $package['pack_name']; ?></span></h4>
					</div>
					<div class="right">
						<h4><b>Price:</b> <span style="color: #c7df19;"><?php echo '$'.$package['pack_price']; ?></span></h4>
					</div>
			</div>
		</div>
		<div class="panel-body">
			<!-- Display errors returned by createToken -->
			<div class="card-errors"></div>
			
			<!-- Payment form -->
			<form action="" method="POST" id="paymentFrm">
				<input type="hidden" name="pack_id" value="<?php echo $package['pack_id']; ?>" readonly>
				<input type="hidden" name="pack_name" value="<?php echo $package['pack_name']; ?>" readonly>
				<input type="hidden" name="pack_price" value="<?php echo $package['pack_price']; ?>" readonly>
				<input type="hidden" name="pack_validity" value="<?php echo $package['pack_validity']; ?>" readonly>
				<input type="hidden" name="left_amt" value="<?php echo $package['left_amt']; ?>" readonly>
				<div class="form-group">
					<label>NAME</label>
					<input type="text" name="name" id="name" placeholder="Enter name" value="<?php echo $fname.' '.$lname;?>" readonly required="" autofocus="">
				</div>
				<div class="form-group">
					<label>EMAIL</label>
					<input type="email" name="email" id="email" placeholder="Enter email" value="<?php echo $email;?>" readonly required="">
				</div>
				<div class="form-group">
					<label>CARD NUMBER</label>
					<input type="text" name="card_number" id="card_number" placeholder="1234 1234 1234 1234" autocomplete="off" required="">
				</div>
				<div class="row">
					<div class="left">
						<div class="form-group">
							<label>EXPIRY DATE</label>
							<div class="col-1">
								<input type="text" name="card_exp_month" id="card_exp_month" placeholder="MM" required="">
							</div>
							<div class="col-2">
								<input type="text" name="card_exp_year" id="card_exp_year" placeholder="YYYY" required="">
							</div>
						</div>
					</div>
					<div class="right">
						<div class="form-group">
							<label>CVC CODE</label>
							<input type="text" name="card_cvc" id="card_cvc" placeholder="CVC" autocomplete="off" required="">
						</div>
					</div>
				</div>
				<div class="form-group">
					<span style="color:red;">Auto Renewal Payment!</span>
				</div>
				<button type="submit" class="btn btn-success" id="payBtn">Pay</button>
			</form>
		</div>
	</div>
</div>
</body>
</html>