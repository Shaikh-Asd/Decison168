<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
|  Stripe API Configuration
| -------------------------------------------------------------------
|
| You will get the API keys from Developers panel of the Stripe account
| Login to Stripe account (https://dashboard.stripe.com/)
| and navigate to the Developers � API keys page
|
|  stripe_api_key        	string   Your Stripe API Secret key.
|  stripe_publishable_key	string   Your Stripe API Publishable key.
|  stripe_currency   		string   Currency code.
*/
// $config['stripe_api_key']         = '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';//secret key 
// $config['stripe_publishable_key'] = 'pk_live_51KLZITECBZEQ4z2NIYI1OtCRxnAfY7CxrholB60hYjuspurmwcH9mNEl5SfM1aOkUJ2CgDE1LDeZQpL66PD7qNtu00TL9kZSGW';//publish key
$config['stripe_api_key']         = 'sk_test_51KLZITECBZEQ4z2Nc1JCodfUN9gnCIzEkReKz1hlnlvTSua4bCK0G9ef4xHClIRghUjcpAeVnOrcgJLIn4cWulK600iA1fOK02';//secret key 
$config['stripe_publishable_key'] = 'pk_test_51KLZITECBZEQ4z2NFQOa4erhztY7yxHZr0aw9qThfNGxWqBI9vKFR1MolJsKDYzkVmwYQwVaVA229U1hvvQVznIe00PJ2IpJDz';//publish key
$config['STRIPE_SUCCESS_URL']        = base_url('insert-checkout-payment-data');
$config['STRIPE_CANCEL_URL']        = base_url('dashboard');
//for company stripe payment
$config['STRIPE_SUCCESS_URL_COMP']        = base_url('insert-checkout-payment-data-comp');
$config['STRIPE_CANCEL_URL_COMP']        = base_url('company/dashboard');
//for company stripe payment
$config['stripe_currency']        = 'usd';