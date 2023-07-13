<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends MY_Controller {


public function __construct()
{
    //call CodeIgniter's default Constructor
    parent::__construct();

    //load Model
    $this->load->model('Company_model');
    //load Helper
    $this->load->helper('cf_helper');
    // Load Stripe library & product model
    $this->load->library('stripe_lib');
    //Time Zone
    //date_default_timezone_set("Asia/kolkata");
    //date_default_timezone_set("US/Eastern"); // EST time zone
    date_default_timezone_set("America/New_York"); // EST time zone
}	

public function index()
{
    if(($this->session->userdata('d168_comp_id')) || ($this->session->userdata('d168_comp_id') != ""))
    {
      redirect(base_url('company/dashboard'));   
    }
    else
    {
      redirect(base_url('company/login'));
    }
}

public function dashboard()
  {
    if(($this->session->userdata('d168_comp_id')) || ($this->session->userdata('d168_comp_id') != ""))
    {      
      $this->session->unset_userdata('d168_comp_stripe_price_id');
      $check_packD = $this->Company_model->getCompanyDetail($this->session->userdata('d168_comp_id'));
      if($check_packD)
      {
        $data['packageExpired'] = "no";
        if($check_packD->extended_pack == 'yes')
        {
          $data['packageExpired'] = "yes";
          $this->load->view('company_view/dashboard',$data);
        }
        elseif($check_packD->extended_pack == 'expired')
        {
          redirect(base_url('company/pricing-package'));
        }
        else
        {
          $this->load->view('company_view/dashboard',$data);
        }        
      }    
    }
    else
    {
      redirect(base_url('company/login'));
    }
  }

public function login()
  {
    if(($this->session->userdata('d168_comp_id')) || ($this->session->userdata('d168_comp_id') != ""))
    {
      redirect(base_url('company/dashboard'));    
    }
    else
    {       
      $this->load->view('company_view/login');
    }
  }

public function check_login() //Check Login
  {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('login_username','Username','required');
    $this->form_validation->set_rules('login_password','cc_pwd','required');
      $this->form_validation->set_rules('g-recaptcha-response','Recaptcha','required');
    if ($this->form_validation->run() == FALSE)
    {
      $response['errors'] = validation_errors();
      $response['status'] = FALSE;

      // You can use the Output class here too
      header('Content-type: application/json');
      //echo json_encode($response);
      exit(json_encode($response));
    }
    else
    {
      $username = $this->input->post('login_username');
      $password = $this->input->post('login_password');  

          $data = $this->Company_model->checkLogin($username,md5($password));
          if($data > 0)
          {           
            //$secretKey = "6LeGztMcAAAAABo3gtAjhWfM9J2ZNVKgR5jPwDE1";
            $secretKey = "6Ld21JMaAAAAAKdJWi_bhns9O7kP3C85sordZMdB";
            $responseKey = $this->input->post('g-recaptcha-response');
            $userIP = $this->input->server('REMOTE_ADDR');       
            $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
            $response1 = file_get_contents($url);
            $response1 = json_decode($response1);

            if($response1->success)
            {             
                if(!empty($this->input->post('basic_checkbox_1')))
                {
                    setcookie("d168_comp_username",$username,time()+ (10 * 365 * 24 * 60 * 60),'/');
                    setcookie("d168_comp_password",$password,time()+ (10 * 365 * 24 * 60 * 60),'/');
                }
                else
                {
                    setcookie("d168_comp_username","",time() - 3600,'/');
                    setcookie("d168_comp_password","",time() - 3600,'/');
                } 
                $user = $this->Company_model->selectLogin($username);
                $this->session->set_userdata('d168_comp_id',$user->cc_id);    

                $this->session->set_flashdata('message', 'Successfully Logged In');
                $response['status'] = TRUE;
                header('Content-type: application/json');
                echo json_encode($response); 
            }
            else
            {
              $response['errors'] = 'Verification Failed';
              $response['status'] = FALSE;
              header('Content-type: application/json');
              exit(json_encode($response));
            }
          }
        else
        {
          $response['errors'] = 'Wrong Username or Password';
          $response['status'] = FALSE;
          header('Content-type: application/json');
          exit(json_encode($response));
        }
    }
  }

  public function logout()
  {
      $this->session->unset_userdata('d168_comp_id');
      $this->session->sess_destroy();
  }

  public function update_comp_password()
  {
    if(($this->session->userdata('d168_comp_id')) || ($this->session->userdata('d168_comp_id') != ""))
    {
      $this->form_validation->set_rules('old_password','Current Password','trim|required');
      $this->form_validation->set_rules('new_password','New Password','trim|required|min_length[5]|callback_valid_password');
      $this->form_validation->set_rules('conf_password','Confirm Password','trim|required|required|matches[new_password]');
      
      if ($this->form_validation->run() == FALSE)
      {
          //$errors = array();

          $errors = $this->form_validation->error_array();
          // Loop through $_POST and get the keys
          foreach ($errors as $key => $value)
          {
            // Add the error message for this field
            $errors[$key] = form_error($key);
          }
        
          $response['errors'] = array_filter($errors); // Some might be empty
          $response['status'] = FALSE;
          // You can use the Output class here too
          header('Content-type: application/json');
          //echo json_encode($response);
          exit(json_encode($response));
      }
      else
      {
        $id = $this->session->userdata('d168_comp_id');
        $check_oldPwd = $this->Company_model->getCompanyDetail($id);
        if($check_oldPwd)
        {
          if($check_oldPwd->cc_pwd == md5($this->input->post('old_password')))
          {
            if($check_oldPwd->cc_pwd != md5($this->input->post('new_password')))
            {
              $data = array(  'cc_pwd' => md5($this->input->post('new_password')) );
              $data = $this->security->xss_clean($data); // xss filter
              $this->Company_model->updateCompanyDetail($data,$id);
              $this->session->set_flashdata('message', 'Password Changed Successfully! Login with New Password');

                delete_cookie("d168_comp_password");
                $this->session->unset_userdata('d168_comp_id');
                $response['status'] = TRUE;              
                header('Content-type: application/json');
                echo json_encode($response); 
            }
            else
            {
                $response['status'] = 'new_passwordError';
                header('Content-type: application/json');
                exit(json_encode($response));
            }
          }
          else
          {
              $response['status'] = 'old_passwordError';
              header('Content-type: application/json');
              exit(json_encode($response));
          }
        } 
      }
    }
    else
    {
      redirect(base_url('company/login'));
    } 
  }

  public function pricing_package()
  {
    if(($this->session->userdata('d168_comp_id')) || ($this->session->userdata('d168_comp_id') != ""))
    {
      $this->session->unset_userdata('d168_comp_stripe_price_id');
      $data['compd'] = $this->Company_model->getCompanyDetail($this->session->userdata('d168_comp_id'));
      if($data['compd'])
      {
        $this->load->view('company_view/pricing-package', $data);    
      }
    }
    else
    {      
      redirect(base_url('company/login'));
    }
  }

  function set_price_id_session_comp()
  {
    if(($this->session->userdata('d168_comp_id')) || ($this->session->userdata('d168_comp_id') != ""))
    {
      $this->session->set_userdata('d168_comp_stripe_price_id',$this->input->post('price_id')); 
      $response['status'] = TRUE;
      header('Content-type: application/json');
      echo json_encode($response);  
    }
    else
    {
      redirect(base_url('company/login'));
    }
  }

  function checkout_payment_initialize_comp()
  {
    if(($this->session->userdata('d168_comp_id')) || ($this->session->userdata('d168_comp_id') != ""))
    {
        $getCusID = $this->Company_model->getCompanyDetail($this->session->userdata('d168_comp_id'));
        $stripe_cusID = "";
        if($getCusID)
        {
          $stripe_cusID = $getCusID->stripe_cus_id;
        }
        $pack = $this->Company_model->getPackByPriceID($this->session->userdata('d168_comp_stripe_price_id'));
        $packPrice = $pack->pack_price;
        $packName = $pack->pack_name;
        $packID = $pack->pack_id;
        $packVal = $pack->pack_validity;
        // $currency = 'usd';

        // Set API key
      \Stripe\Stripe::setApiKey($this->config->item('stripe_api_key'));

      $response = array(
          'status' => 0,
          'error' => array(
              'message' => 'Invalid Request!'   
          )
      );

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $input = file_get_contents('php://input');
        $request = json_decode($input); 
      }

      if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(400);
        echo json_encode($response);
        exit;
      }

      if(!empty($request->createCheckoutSession)){
          // Convert product price to cent
          $stripeAmount = round($packPrice*100, 2);

          // Create new Checkout Session for the order
          try {
              if(!empty($stripe_cusID))
              {
                 $checkout_session = \Stripe\Checkout\Session::create([
                    'line_items' => [[
                      'price' => $this->session->userdata('d168_comp_stripe_price_id'),
                      'quantity' => 1,
                        'description' => $packName,
                    ]],
                    'mode' => 'subscription',
                    'customer' =>  $stripe_cusID,
                    'allow_promotion_codes' => true,
                    'success_url' => $this->config->item('STRIPE_SUCCESS_URL_COMP').'?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url' => $this->config->item('STRIPE_CANCEL_URL_COMP'),
                ]);
              }
              else
              {
                $checkout_session = \Stripe\Checkout\Session::create([
                    'line_items' => [[
                      'price' => $this->session->userdata('d168_comp_stripe_price_id'),
                      'quantity' => 1,
                        'description' => $packName,
                    ]],
                    'mode' => 'subscription',
                    'allow_promotion_codes' => true,
                    'success_url' => $this->config->item('STRIPE_SUCCESS_URL_COMP').'?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url' => $this->config->item('STRIPE_CANCEL_URL_COMP'),
                ]);
              } 
          } catch(Exception $e) { 
              $api_error = $e->getMessage(); 
          }
          
          if(empty($api_error) && $checkout_session){
              $response = array(
                  'status' => 1,
                  'message' => 'Checkout Session created successfully!',
                  'sessionId' => $checkout_session->id
              );
          }else{
              $response = array(
                  'status' => 0,
                  'error' => array(
                      'message' => 'Checkout Session creation failed! '.$api_error   
                  )
              );
          }
      }
      // Return response
      echo json_encode($response);
    }
    else
    {
      redirect(base_url('company/login'));
    }
  }

  function insert_checkout_payment_data_comp()
  {
    if(($this->session->userdata('d168_comp_id')) || ($this->session->userdata('d168_comp_id') != ""))
    {
      $pack = $this->Company_model->getPackByPriceID($this->session->userdata('d168_comp_stripe_price_id'));
      $packVal = $pack->pack_validity;
      $payment_id = $statusMsg = '';
      $status = 'error';

      // Check whether stripe checkout session is not empty
      if(!empty($_GET['session_id'])){
          $session_id = $_GET['session_id'];  

              // Set API key
              \Stripe\Stripe::setApiKey($this->config->item('stripe_api_key'));
              
              // Fetch the Checkout Session to display the JSON result on the success page
              try {
                  $checkout_session = \Stripe\Checkout\Session::retrieve($session_id);
              } catch(Exception $e) { 
                  $api_error = $e->getMessage(); 
              }
              if(empty($api_error) && $checkout_session){
                  // Retrieve the details of a PaymentIntent
                  try {
                    // if(is_numeric($packVal))
                    // {
                      $paymentIntent = \Stripe\Subscription::retrieve($checkout_session->subscription);
                    //}
                    // else
                    // {
                    //   $paymentIntent = \Stripe\PaymentIntent::retrieve($checkout_session->payment_intent);
                    // }
                  } catch (\Stripe\Exception\ApiErrorException $e) {
                      $api_error = $e->getMessage();
                  }
                  
                  // Retrieves the details of customer
                  try {
                      $customer = \Stripe\Customer::retrieve($checkout_session->customer);
                  } catch (\Stripe\Exception\ApiErrorException $e) {
                      $api_error = $e->getMessage();
                  }
                  if(empty($api_error) && $paymentIntent){ 
                      // Check whether the payment was successful
                      if(!empty($paymentIntent) && $paymentIntent->status == 'active'){
                  
                          // Transaction details 
                          $transactionID = $paymentIntent->id;
                          $paidAmount = $paymentIntent['plan']->amount;
                          $paidAmount = ($paidAmount/100);
                          $paidCurrency = $paymentIntent['plan']->currency;
                          $payment_status = $paymentIntent->status;
                           
                          // Customer details
                         $customer_id = $customer_name = $customer_email = '';
                          if(!empty($customer)){
                             //echo "<pre>";
                             //print_r($customer);
                            // die();
                            $getCusID = $this->Company_model->getCompanyDetail($this->session->userdata('d168_comp_id'));
                            
                            $getEmail = $this->Company_model->getStudentById($getCusID->contacted_user_id);
                            if($getEmail)
                            {
                              if(!empty($getEmail->txn_id))
                              {
                                // Set API key
                                \Stripe\Stripe::setApiKey($this->config->item('stripe_api_key'));

                                $subscription = \Stripe\Subscription::retrieve($getEmail->txn_id);
                                $subscription->cancel();
                                if($subscription->status == "canceled")
                                {
                                  $upcData = array(
                                          'package_id' => '1',
                                          'package_start' => date('Y-m-d H:i:s'),
                                          'package_expiry' => 'free_forever',
                                          'balance_amount' => '',
                                          'paid_amount' => '',
                                          'card_number' => '0',
                                          'card_exp_month' => '',
                                          'card_exp_year' => '',
                                          'card_cvc' => '',
                                          'paid_amount_currency' => '',
                                          'txn_id' => '',
                                          'payment_status' => '',
                                          'renew' => '',
                                          'old_package' => $getEmail->package_id,
                                          'refund_status' => 'no_refund',
                                        );
                                  $upcData = $this->security->xss_clean($upcData); // xss filter
                                  $this->Company_model->updateRegistrationID($upcData,$getEmail->reg_id);
                                }
                              }
                            }

                            $customer_id = "";
                            if($getCusID)
                            {
                              if(!empty($getCusID->stripe_cus_id))
                              {
                                $customer_id = $getCusID->stripe_cus_id;
                              }
                              else
                              {
                                $customer_id = !empty($customer->id)?$customer->id:''; 
                              }
                            }
                            else
                            {
                              $customer_id = !empty($customer->id)?$customer->id:''; 
                            }                              
                              $customer_name = !empty($customer->name)?$customer->name:'';
                              $customer_email = !empty($customer->email)?$customer->email:'';
                          }
                          
                          $check_type = is_numeric(trim($packVal));
                          if($check_type == 'true')
                          {
                            $pack_expire = date('Y-m-d h:i:s', strtotime('+'.trim($packVal).' day'));
                          }
                          else
                          {
                            $pack_expire = $packVal;
                          } 
                        if($getCusID->package_coupon_id != '0')
                        {
                          $used_coupons = $getCusID->used_package_coupon_id.','.$getCusID->package_coupon_id;
                        }
                        else
                        {                          
                          $used_coupons = $getCusID->used_package_coupon_id;
                        }
                        // Insert tansaction data into the database
                        $upData = array(
                          'package_use' => 'yes',
                          'cc_name_on_card' => $customer->name,
                          'cc_email' => $customer->email,
                          'stripe_cus_id' => $customer_id,
                          'package_start' => date('Y-m-d H:i:s'),
                          'package_expiry' => $pack_expire,
                          'paid_amount' => $paidAmount,
                          'paid_amount_currency' => $paidCurrency,
                          'txn_id' => $transactionID,
                          'payment_status' => $payment_status,
                          'renew' => 'auto',
                          'sub_cancel_reason_notify' => '',
                          'package_coupon_id' => '',
                          'used_package_coupon_id' => $used_coupons,
                          'extended_pack' => '',
                          'extended_mail_sent' => '',
                          'extended_mail_date' => '',
                          'inactivity_date_start' => '',
                          'inactivity_mail_days' => '',
                          'deactive_date' => '',
                          'delete_date' => ''
                        );
                        $upData = $this->security->xss_clean($upData); // xss filter
                        $this->Company_model->updateCompanyDetail($upData,$this->session->userdata('d168_comp_id'));

                        // Update Members pack id
                        $regData = array(
                          'package_id' => $getCusID->package_id,
                          'package_start' => date('Y-m-d H:i:s'),
                          'package_expiry' => $pack_expire,
                        );
                        $regData = $this->security->xss_clean($regData); // xss filter
                        $this->Company_model->updateRegistration($regData,$getCusID->cc_corporate_id);
                        // Update Members pack id

                          $status = 'success';
                          $statusMsg = 'Your Payment has been Successful!';
                          $this->session->set_flashdata('message', 'Package Updated Successfully!');
                          redirect(base_url('company/dashboard'));
                      } elseif(!empty($paymentIntent) && $paymentIntent->status == 'succeeded'){
                          // Transaction details 
                          $transactionID = $paymentIntent->id;
                          $paidAmount = $paymentIntent->amount;
                          $paidAmount = ($paidAmount/100);
                          $paidCurrency = $paymentIntent->currency;
                          $payment_status = $paymentIntent->status;
                           
                          // Customer details
                         $customer_id = $customer_name = $customer_email = '';
                          if(!empty($customer)){
                             //echo "<pre>";
                             //print_r($customer);
                            // die();
                            $getCusID = $this->Company_model->getCompanyDetail($this->session->userdata('d168_comp_id'));

                            $getEmail = $this->Company_model->getStudentById($getCusID->contacted_user_id);
                            if($getEmail)
                            {
                              if(!empty($getEmail->txn_id))
                              {
                                // Set API key
                                \Stripe\Stripe::setApiKey($this->config->item('stripe_api_key'));

                                $subscription = \Stripe\Subscription::retrieve($getEmail->txn_id);
                                $subscription->cancel();
                                if($subscription->status == "canceled")
                                {
                                  $upcData = array(
                                          'package_id' => '1',
                                          'package_start' => date('Y-m-d H:i:s'),
                                          'package_expiry' => 'free_forever',
                                          'balance_amount' => '',
                                          'paid_amount' => '',
                                          'card_number' => '0',
                                          'card_exp_month' => '',
                                          'card_exp_year' => '',
                                          'card_cvc' => '',
                                          'paid_amount_currency' => '',
                                          'txn_id' => '',
                                          'payment_status' => '',
                                          'renew' => '',
                                          'old_package' => $getEmail->package_id,
                                          'refund_status' => 'no_refund',
                                        );
                                  $upcData = $this->security->xss_clean($upcData); // xss filter
                                  $this->Company_model->updateRegistrationID($upcData,$getEmail->reg_id);
                                }
                              }
                            }

                            $customer_id = "";
                            if($getCusID)
                            {
                              if(!empty($getCusID->stripe_cus_id))
                              {
                                $customer_id = $getCusID->stripe_cus_id;
                              }
                              else
                              {
                                $customer_id = !empty($customer->id)?$customer->id:''; 
                              }
                            }
                            else
                            {
                              $customer_id = !empty($customer->id)?$customer->id:''; 
                            }                              
                              $customer_name = !empty($customer->name)?$customer->name:'';
                              $customer_email = !empty($customer->email)?$customer->email:'';
                          }
                          
                          $check_type = is_numeric(trim($packVal));
                          if($check_type == 'true')
                          {
                            $pack_expire = date('Y-m-d h:i:s', strtotime('+'.trim($packVal).' day'));
                          }
                          else
                          {
                            $pack_expire = $packVal;
                          }
                        if($getCusID->package_coupon_id != '0')
                        {
                          $used_coupons = $getCusID->used_package_coupon_id.','.$getCusID->package_coupon_id;
                        }
                        else
                        {                          
                          $used_coupons = $getCusID->used_package_coupon_id;
                        }
                        // Insert tansaction data into the database
                        $upData = array(
                          'package_use' => 'yes',
                          'cc_name_on_card' => $customer->name,
                          'cc_email' => $customer->email,
                          'stripe_cus_id' => $customer_id,
                          'package_id' => $pack->pack_id,
                          'package_start' => date('Y-m-d H:i:s'),
                          'package_expiry' => $pack_expire,
                          'paid_amount' => $paidAmount,
                          'paid_amount_currency' => $paidCurrency,
                          'txn_id' => $transactionID,
                          'payment_status' => $payment_status,
                          'renew' => 'auto',
                          'sub_cancel_reason_notify' => '',
                          'package_coupon_id' => '',
                          'used_package_coupon_id' => $used_coupons,
                          'extended_pack' => '',
                          'extended_mail_sent' => '',
                          'extended_mail_date' => '',
                          'inactivity_date_start' => '',
                          'inactivity_mail_days' => '',
                          'deactive_date' => '',
                          'delete_date' => ''
                        );
                        $upData = $this->security->xss_clean($upData); // xss filter
                        $this->Company_model->updateCompanyDetail($upData,$this->session->userdata('d168_comp_id'));

                        // Update Members pack id
                        $regData = array(
                          'package_id' => $getCusID->package_id,
                          'package_start' => date('Y-m-d H:i:s'),
                          'package_expiry' => $pack_expire,
                        );
                        $regData = $this->security->xss_clean($regData); // xss filter
                        $this->Company_model->updateRegistration($regData,$getCusID->cc_corporate_id);
                        // Update Members pack id

                          $status = 'success';
                          $statusMsg = 'Your Payment has been Successful!';
                          $this->session->set_flashdata('message', 'Package Updated Successfully!');
                          redirect(base_url('company/dashboard'));
                      }else{
                          $statusMsg = "Transaction has been failed!";
                      }
                  }else{
                      $statusMsg = "Unable to fetch the transaction details! $api_error"; 
                  }
              }else{
                  $statusMsg = "Invalid Transaction! $api_error"; 
              }
      }else{
        $statusMsg = "Invalid Request!";
      }
    }
    else
    {
      redirect(base_url('company/login'));
    }
  }

  function auto_renew_package_payment_comp()
  {
   $all_comp = $this->Company_model->getAllActiveCompany();
   if($all_comp)
   {
    foreach($all_comp as $all_cp)
    {
      $pack = $this->Company_model->getPackDetail($all_cp->package_id);
      $packVal = $pack->pack_validity;
      //echo $all_cp->package_id;
      //echo $packVal;
      if(is_numeric($packVal))
      {
        // Set API key
        \Stripe\Stripe::setApiKey($this->config->item('stripe_api_key'));
        $check_subscription = \Stripe\Subscription::retrieve($all_cp->txn_id);
        if($check_subscription)
        {
          $sub_start = date("Y-m-d H:i:s", $check_subscription->current_period_start);
          $sub_end = date("Y-m-d H:i:s", $check_subscription->current_period_end);
          $sub_status = $check_subscription->status;
          // echo $sub_start;
          // echo '<pre>';
          // print_r($check_subscription);
          // die();
          if($sub_status == "active")
          {
            if(($all_cp->package_start != $sub_start) || ($all_cp->package_expiry != $sub_end))
            {
              $upData = array(
                            'package_start' => $sub_start,
                            'package_expiry' => $sub_end,
                          );
              $upData = $this->security->xss_clean($upData); // xss filter
              $this->Company_model->updateCompanyDetail($upData,$all_cp->cc_id);  

              $regData = array(
                          'package_start' => $sub_start,
                          'package_expiry' => $sub_end,
                        );
              $regData = $this->security->xss_clean($regData); // xss filter
              $this->Company_model->updateRegistration($regData,$all_cp->cc_corporate_id);
            }
          }
          elseif(($sub_status == "incomplete_expired") || ($sub_status == "past_due")  || ($sub_status == "canceled") || ($sub_status == "unpaid"))
          {
              $canceled_subscription = \Stripe\Subscription::update(
                $all_cp->txn_id,
                [
                  'cancel_at_period_end' => true,
                ]
              );
              $extended_end = date('Y-m-d h:i:s', strtotime($all_cp->package_expiry. '+31 day'));
              $upData = array(
                            'package_expiry' => $extended_end,
                            'extended_pack' => 'yes',
                            'extended_mail_sent' => '1',
                            'extended_mail_date' => date('Y-m-d'),
                            'paid_amount' => '',
                            'paid_amount_currency' => '',
                            'txn_id' => '',
                            'payment_status' => '',
                          );
              $upData = $this->security->xss_clean($upData); // xss filter
              $this->Company_model->updateCompanyDetail($upData,$all_cp->cc_id);  

              $regData = array(
                          'package_expiry' => $extended_end,
                        );
              $regData = $this->security->xss_clean($regData); // xss filter
              $this->Company_model->updateRegistration($regData,$all_cp->cc_corporate_id);

              $getEmail = $this->Company_model->getStudentById($all_cp->contacted_user_id);
              if($getEmail)
              {
                $email_to = $getEmail->email_address;
                $email_from = 'hello@decision168.com'; 
                //$email_from = 'saramaazkhan123@gmail.com'; 
                $email_name = 'Decision 168';

                $this->load->library('email');  
                $config=array(
                  'charset'=>'utf-8',
                  'wordwrap'=> TRUE,
                  'mailtype' => 'html'
                  );
                $this->email->initialize($config);
                $this->email->from($email_from, $email_name);
                $this->email->set_header('Reply-To', $email_from."\r\n");
                $this->email->set_header('Return-Path', $email_from."\r\n");
                $this->email->set_header('X-Mailer', 'PHP/' . phpversion().'\r\n');
                $this->email->set_header('MIME-Version', '1.0' . "\r\n");
                $this->email->to($email_to);
                $this->email->set_mailtype('html');
                $this->email->subject('Renew Company Pack | Decision 168');
                $this->email->message('             
          <!doctype html>
          <html lang="en-US">

          <head>
            <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
            <title>Renew Company Pack</title>
            <meta name="description" content="Renew Company Pack">
            <style type="text/css">
                a:hover {text-decoration: underline !important;pointer:cursor !important;}
            </style>
          </head>

          <body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
            <!--100% body table-->

            <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
                style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: Open Sans, sans-serif;">
                <tr>
                    <td>
                        <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="height:80px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;">
                                  <a href="'.base_url().'" title="Decision 168" target="_blank">
                                    <img width="50%" src="'.base_url("assets/images/dark-logo-main.png").'" title="Decision 168" alt="Decision 168">
                                  </a>
                                </td>
                            </tr>
                            <tr>
                                <td style="height:20px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                        style="max-width:670px;background:#383838;border:4px solid #dfdddd;text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                        <tr>
                                            <td style="height:40px;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="padding:0 35px;">
                                                <h1 style="color:#c7df19; font-weight:600; margin:0;font-size:33px;font-family:Rubik,sans-serif;">Let\'s get you going!</h1>
                                                <span
                                                    style="display:inline-block; vertical-align:middle; margin:29px 0 29px; border-bottom:2px solid #cecece; width:270px;"></span>
                                                <p style="color:#fff; font-size:15px;line-height:24px;text-align:left; margin:0;">
                                                Hello '.ucfirst($getEmail->first_name).',<br><br>
                                                   Company package has been expired. Please renew pack within 30 Days.
                                                    <br><br>
                                                </p>
                                                    <a href="'.base_url().'company/"
                                                      style="background:#c7df19;text-decoration:none !important; font-weight:600; margin-top:35px; margin-bottom: 20px;color:#fff;text-transform:uppercase; font-size:15px;padding:10px 30px;display:inline-block;border-radius:10px;">Login to company account
                                                    </a> 
                                                    <br><br>
                                                    <p style="color:#fff; font-size:15px;line-height:24px;text-align:left; margin:0;">
                                                    Thanks,
                                                    <br>
                                                    The <span style="color:#c7df19;font-weight: 600;">Decision 168</span> Team
                                                    </p>
                                                    <p style="color:#fff; font-size:15px;line-height:24px;text-align:right; margin:0;">
                                                    <br>
                                                    <img width="20%" src="'.base_url("assets/images/Decision-168.png").'" title="Decision 168" alt="Decision 168">
                                                    <br>
                                                    <a onMouseOver="this.style.pointer=cursor" href="'.base_url().'" style="color:#c7df19;font-size:11px;text-decoration: none;">view it in your browser</a>
                                                    </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height:40px;">&nbsp;</td>
                                        </tr>
                                    </table>
                                </td>
                            <tr>
                                <td style="height:20px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;">
                                <p style="color:rgba(69, 80, 86, 0.7411764705882353);font-size:11px;line-height:15px;margin:0;">Please note: This e-mail was sent from an auto-notification system that cannot accept incoming e-mail. Do not reply to this message.</p>
                                <p style="color:rgba(69, 80, 86, 0.7411764705882353);font-size:11px;line-height:15px;margin:0;">You can’t unsubscribe from important emails about your account like this one.</p>
                                <br>
                                    <p style="font-size:14px; color:#6b6e70; line-height:18px; margin:0 0 0;">&copy; <strong>Copyright 2013 – '.date("Y").'  |  Decision 168, Inc  |  All Rights Reserved </strong></p>
                                </td>
                            </tr>
                            <tr>
                                <td style="height:80px;">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!--/100% body table-->
          </body>

          </html>' 
            );
                $this->email->send();
                //echo $this->email->print_debugger();
            }
          }
        }
      }
    }
   }
  }

  function auto_extended_pack_notify_block_comp()
  {
   $all_comp = $this->Company_model->getAllExtendedCompany();
   if($all_comp)
   {
    foreach($all_comp as $all_cp)
    {
      $getDate = date('Y-m-d'); 
      $getFullDate = date('Y-m-d H:i:s');     
      if($all_cp->extended_mail_sent == '1')//for 15 day mail
      {
        $extended_end = date('Y-m-d', strtotime($all_cp->extended_mail_date. '+15 day'));
        if($getDate == $extended_end)
        {
          //echo $extended_end;
          $upData = array(
                              'extended_mail_sent' => '15',
                              'extended_mail_date' => $extended_end
                            );
          $upData = $this->security->xss_clean($upData); // xss filter
          $this->Company_model->updateCompanyDetail($upData,$all_cp->cc_id);  

          $getEmail = $this->Company_model->getStudentById($all_cp->contacted_user_id);
          if($getEmail)
          {
            $email_to = $getEmail->email_address;
            $email_from = 'hello@decision168.com'; 
            //$email_from = 'saramaazkhan123@gmail.com'; 
            $email_name = 'Decision 168';

            $this->load->library('email');  
            $config=array(
              'charset'=>'utf-8',
              'wordwrap'=> TRUE,
              'mailtype' => 'html'
              );
            $this->email->initialize($config);
            $this->email->from($email_from, $email_name);
            $this->email->set_header('Reply-To', $email_from."\r\n");
            $this->email->set_header('Return-Path', $email_from."\r\n");
            $this->email->set_header('X-Mailer', 'PHP/' . phpversion().'\r\n');
            $this->email->set_header('MIME-Version', '1.0' . "\r\n");
            $this->email->to($email_to);
            $this->email->set_mailtype('html');
            $this->email->subject('Renew Company Pack | Decision 168');
            $this->email->message('             
      <!doctype html>
      <html lang="en-US">

      <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <title>Renew Company Pack</title>
        <meta name="description" content="Renew Company Pack">
        <style type="text/css">
            a:hover {text-decoration: underline !important;pointer:cursor !important;}
        </style>
      </head>

      <body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
        <!--100% body table-->

        <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
            style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: Open Sans, sans-serif;">
            <tr>
                <td>
                    <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="height:80px;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="text-align:center;">
                              <a href="'.base_url().'" title="Decision 168" target="_blank">
                                <img width="50%" src="'.base_url("assets/images/dark-logo-main.png").'" title="Decision 168" alt="Decision 168">
                              </a>
                            </td>
                        </tr>
                        <tr>
                            <td style="height:20px;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                    style="max-width:670px;background:#383838;border:4px solid #dfdddd;text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                    <tr>
                                        <td style="height:40px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td style="padding:0 35px;">
                                            <h1 style="color:#c7df19; font-weight:600; margin:0;font-size:33px;font-family:Rubik,sans-serif;">Let\'s get you going!</h1>
                                            <span
                                                style="display:inline-block; vertical-align:middle; margin:29px 0 29px; border-bottom:2px solid #cecece; width:270px;"></span>
                                            <p style="color:#fff; font-size:15px;line-height:24px;text-align:left; margin:0;">
                                            Hello '.ucfirst($getEmail->first_name).',<br><br>
                                               Company package has been expired. Please renew pack within 15 Days.
                                                <br><br>
                                            </p>
                                                <a href="'.base_url().'company/"
                                                  style="background:#c7df19;text-decoration:none !important; font-weight:600; margin-top:35px; margin-bottom: 20px;color:#fff;text-transform:uppercase; font-size:15px;padding:10px 30px;display:inline-block;border-radius:10px;">Login to company account
                                                </a> 
                                                <br><br>
                                                <p style="color:#fff; font-size:15px;line-height:24px;text-align:left; margin:0;">
                                                Thanks,
                                                <br>
                                                The <span style="color:#c7df19;font-weight: 600;">Decision 168</span> Team
                                                </p>
                                                <p style="color:#fff; font-size:15px;line-height:24px;text-align:right; margin:0;">
                                                <br>
                                                <img width="20%" src="'.base_url("assets/images/Decision-168.png").'" title="Decision 168" alt="Decision 168">
                                                <br>
                                                <a onMouseOver="this.style.pointer=cursor" href="'.base_url().'" style="color:#c7df19;font-size:11px;text-decoration: none;">view it in your browser</a>
                                                </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="height:40px;">&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        <tr>
                            <td style="height:20px;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="text-align:center;">
                            <p style="color:rgba(69, 80, 86, 0.7411764705882353);font-size:11px;line-height:15px;margin:0;">Please note: This e-mail was sent from an auto-notification system that cannot accept incoming e-mail. Do not reply to this message.</p>
                            <p style="color:rgba(69, 80, 86, 0.7411764705882353);font-size:11px;line-height:15px;margin:0;">You can’t unsubscribe from important emails about your account like this one.</p>
                            <br>
                                <p style="font-size:14px; color:#6b6e70; line-height:18px; margin:0 0 0;">&copy; <strong>Copyright 2013 – '.date("Y").'  |  Decision 168, Inc  |  All Rights Reserved </strong></p>
                            </td>
                        </tr>
                        <tr>
                            <td style="height:80px;">&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <!--/100% body table-->
      </body>

      </html>' 
        );
            $this->email->send();
            //echo $this->email->print_debugger();
          }
        }
      }
      elseif($all_cp->extended_mail_sent == '15')//for 30 day mail
      {
        $extended_end = date('Y-m-d', strtotime($all_cp->extended_mail_date. '+15 day'));
        if($getDate == $extended_end)
        {
          //echo $extended_end;
          $upData = array(
                              'extended_mail_sent' => '30',
                              'extended_mail_date' => $extended_end
                            );
          $upData = $this->security->xss_clean($upData); // xss filter
          $this->Company_model->updateCompanyDetail($upData,$all_cp->cc_id);  

          $getEmail = $this->Company_model->getStudentById($all_cp->contacted_user_id);
          if($getEmail)
          {
            $email_to = $getEmail->email_address;
            $email_from = 'hello@decision168.com'; 
            //$email_from = 'saramaazkhan123@gmail.com'; 
            $email_name = 'Decision 168';

            $this->load->library('email');  
            $config=array(
              'charset'=>'utf-8',
              'wordwrap'=> TRUE,
              'mailtype' => 'html'
              );
            $this->email->initialize($config);
            $this->email->from($email_from, $email_name);
            $this->email->set_header('Reply-To', $email_from."\r\n");
            $this->email->set_header('Return-Path', $email_from."\r\n");
            $this->email->set_header('X-Mailer', 'PHP/' . phpversion().'\r\n');
            $this->email->set_header('MIME-Version', '1.0' . "\r\n");
            $this->email->to($email_to);
            $this->email->set_mailtype('html');
            $this->email->subject('Renew Company Pack | Decision 168');
            $this->email->message('             
      <!doctype html>
      <html lang="en-US">

      <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <title>Renew Company Pack</title>
        <meta name="description" content="Renew Company Pack">
        <style type="text/css">
            a:hover {text-decoration: underline !important;pointer:cursor !important;}
        </style>
      </head>

      <body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
        <!--100% body table-->

        <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
            style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: Open Sans, sans-serif;">
            <tr>
                <td>
                    <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="height:80px;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="text-align:center;">
                              <a href="'.base_url().'" title="Decision 168" target="_blank">
                                <img width="50%" src="'.base_url("assets/images/dark-logo-main.png").'" title="Decision 168" alt="Decision 168">
                              </a>
                            </td>
                        </tr>
                        <tr>
                            <td style="height:20px;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                    style="max-width:670px;background:#383838;border:4px solid #dfdddd;text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                    <tr>
                                        <td style="height:40px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td style="padding:0 35px;">
                                            <h1 style="color:#c7df19; font-weight:600; margin:0;font-size:33px;font-family:Rubik,sans-serif;">Let\'s get you going!</h1>
                                            <span
                                                style="display:inline-block; vertical-align:middle; margin:29px 0 29px; border-bottom:2px solid #cecece; width:270px;"></span>
                                            <p style="color:#fff; font-size:15px;line-height:24px;text-align:left; margin:0;">
                                            Hello '.ucfirst($getEmail->first_name).',<br><br>
                                               Company package has been expired. Please renew pack within a day.
                                                <br><br>
                                            </p>
                                                <a href="'.base_url().'company/"
                                                  style="background:#c7df19;text-decoration:none !important; font-weight:600; margin-top:35px; margin-bottom: 20px;color:#fff;text-transform:uppercase; font-size:15px;padding:10px 30px;display:inline-block;border-radius:10px;">Login to company account
                                                </a> 
                                                <br><br>
                                                <p style="color:#fff; font-size:15px;line-height:24px;text-align:left; margin:0;">
                                                Thanks,
                                                <br>
                                                The <span style="color:#c7df19;font-weight: 600;">Decision 168</span> Team
                                                </p>
                                                <p style="color:#fff; font-size:15px;line-height:24px;text-align:right; margin:0;">
                                                <br>
                                                <img width="20%" src="'.base_url("assets/images/Decision-168.png").'" title="Decision 168" alt="Decision 168">
                                                <br>
                                                <a onMouseOver="this.style.pointer=cursor" href="'.base_url().'" style="color:#c7df19;font-size:11px;text-decoration: none;">view it in your browser</a>
                                                </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="height:40px;">&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        <tr>
                            <td style="height:20px;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="text-align:center;">
                            <p style="color:rgba(69, 80, 86, 0.7411764705882353);font-size:11px;line-height:15px;margin:0;">Please note: This e-mail was sent from an auto-notification system that cannot accept incoming e-mail. Do not reply to this message.</p>
                            <p style="color:rgba(69, 80, 86, 0.7411764705882353);font-size:11px;line-height:15px;margin:0;">You can’t unsubscribe from important emails about your account like this one.</p>
                            <br>
                                <p style="font-size:14px; color:#6b6e70; line-height:18px; margin:0 0 0;">&copy; <strong>Copyright 2013 – '.date("Y").'  |  Decision 168, Inc  |  All Rights Reserved </strong></p>
                            </td>
                        </tr>
                        <tr>
                            <td style="height:80px;">&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <!--/100% body table-->
      </body>

      </html>' 
        );
            $this->email->send();
            //echo $this->email->print_debugger();
          }
        }
      }
      elseif($getFullDate > $all_cp->package_expiry)//not renew then inactive accounts
      {
        //echo 'yes';
        $upData = array(
                          'package_expiry' => 'expired',
                          'extended_pack' => 'expired',
                          'inactivity_date_start' => $all_cp->package_expiry,
                          //'cc_status' => 'inactive',
                        );
          $upData = $this->security->xss_clean($upData); // xss filter
          $this->Company_model->updateCompanyDetail($upData,$all_cp->cc_id);

          // $data2 = array(
          //                   'pack_status' => 'inactive',
          //             );
          // $data2 = $this->security->xss_clean($data2); // xss filter
          // $this->Company_model->edit_package($data2,$all_cp->package_id);
      }
    }
   }
  }

  public function auto_expired_pack_notify_delete_comp()
  {
    $getComp = $this->Company_model->getAllExtendedExpiredCompany();
    if($getComp)
    {
      foreach($getComp as $comp)
      {
        if(DateTime::createFromFormat('Y-m-d H:i:s', $comp->inactivity_date_start) !== false)
        {
          $comp_pack_del = date('Y-m-d',strtotime($comp->inactivity_date_start));

          $user = $this->Company_model->getStudentById($comp->contacted_user_id);

          $deactive_date = date('Y-m-d', strtotime($comp_pack_del. '+120 day'));
          $delete_date = date('Y-m-d', strtotime($comp_pack_del. '+180 day'));
          //echo $delete_date.'<br>';
          $today = date('Y-m-d');
          $date1=date_create($comp_pack_del);
          //echo $comp_pack_del;
          $date2=date_create($today);
          $diff=date_diff($date1,$date2);

          $inactivity_days = $diff->format("%a");
          echo $inactivity_days.'<br>';
          //die();
          if($inactivity_days == "60")
          {
            $email_to = $user->email_address;
            $email_from = 'hello@decision168.com'; 
            //$email_from = 'saramaazkhan123@gmail.com'; 
            $email_name = 'Decision 168';

            $this->load->library('email');  
            $config=array(
              'charset'=>'utf-8',
              'wordwrap'=> TRUE,
              'mailtype' => 'html'
              );
            $this->email->initialize($config);
            $this->email->from($email_from, $email_name);
            $this->email->set_header('Reply-To', $email_from."\r\n");
            $this->email->set_header('Return-Path', $email_from."\r\n");
            $this->email->set_header('X-Mailer', 'PHP/' . phpversion().'\r\n');
            $this->email->set_header('MIME-Version', '1.0' . "\r\n");
            $this->email->to($email_to);
            $this->email->set_mailtype('html');
            $this->email->subject('[Action Required] Renew pack to keep your account active | Decision 168');
            $this->email->message(' 
              <!doctype html>
                <html lang="en-US">

                <head>
                  <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
                  <title>[Action Required] Renew pack to keep your account active</title>
                  <meta name="description" content="[Action Required] Renew pack to keep your account active">
                  <style type="text/css">
                      a:hover {text-decoration: underline !important;pointer:cursor !important;}
                  </style>
                </head>

                <body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
                  <!--100% body table-->

                  <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
                      style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: Open Sans, sans-serif;">
                      <tr>
                          <td>
                              <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                      <td style="height:80px;">&nbsp;</td>
                                  </tr>
                                  <tr>
                                      <td style="text-align:center;">
                                        <a href="'.base_url().'" title="Decision 168" target="_blank">
                                          <img width="50%" src="'.base_url("assets/images/dark-logo-main.png").'" title="Decision 168" alt="Decision 168">
                                        </a>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td style="height:20px;">&nbsp;</td>
                                  </tr>
                                  <tr>
                                      <td>
                                          <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                              style="max-width:670px;background:#383838;border:4px solid #dfdddd;text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                              <tr>
                                                  <td style="height:40px;">&nbsp;</td>
                                              </tr>
                                              <tr>
                                                  <td style="padding:0 35px;">
                                                      <h1 style="color:#c7df19; font-weight:600; margin:0;font-size:30px;font-family:Rubik,sans-serif;">Where\'d you go, we miss you around...</h1>
                                                      <span
                                                          style="display:inline-block; vertical-align:middle; margin:29px 0 29px; border-bottom:2px solid #cecece; width:270px;"></span>
                                                      <p style="color:#fff; font-size:15px;line-height:24px;text-align:left; margin:0;">
                                                      Hello '.$user->first_name.' '.$user->last_name.',<br><br>
                                                         It looks like you haven\'t accessed your Decision 168 Platform account for some time now and we wanted to check in. If your account remains inactive, it will be deactivated on '.$deactive_date.'.
                                                          <br><br>
                                                          <ul style="color:#fff; font-size:15px;line-height:24px;text-align:left; margin:0;">
                                                            <li>If you need any help in getting re-started, or maybe some helpful tips or hints, remember to check out our <a href="#" style="color:#c7df19;text-decoration: none;font-weight: 500px;"><strong>FAQs</strong></a>.</li>
                                                            <li>If you don\'t find what you\'re looking for in the FAQs, open a ticket in our support system for a quick response.</li>
                                                          </ul>
                                                      </p>
                                                      <a href="'.base_url().'company/"
                                                      style="background:#c7df19;text-decoration:none !important; font-weight:600; margin-top:35px; margin-bottom: 20px;color:#fff;text-transform:uppercase; font-size:15px;padding:10px 30px;display:inline-block;border-radius:10px;">Login to Company Account
                                                    </a> 
                                                    <br><br>
                                                      <p style="color:#fff; font-size:15px;line-height:24px;text-align:left; margin:0;">
                                                          We\'re here to help,
                                                          <br>
                                                          The <span style="color:#c7df19;font-weight: 600;">Decision 168</span> Team
                                                          </p>
                                                          <p style="color:#fff; font-size:15px;line-height:24px;text-align:right; margin:0;">
                                                          <br>
                                                          <img width="20%" src="'.base_url("assets/images/Decision-168.png").'" title="Decision 168" alt="Decision 168">
                                                          </p>
                                                  </td>
                                              </tr>
                                              <tr>
                                                  <td style="height:40px;">&nbsp;</td>
                                              </tr>
                                          </table>
                                      </td>
                                  <tr>
                                      <td style="height:20px;">&nbsp;</td>
                                  </tr>
                                  <tr>
                                      <td style="text-align:center;">
                                      <p style="color:rgba(69, 80, 86, 0.7411764705882353);font-size:11px;line-height:15px;margin:0;">Please note: This e-mail was sent from an auto-notification system that cannot accept incoming e-mail. Do not reply to this message.</p>
                                      <p style="color:rgba(69, 80, 86, 0.7411764705882353);font-size:11px;line-height:15px;margin:0;">You can’t unsubscribe from important emails about your account like this one.</p>
                                      <br>
                                          <p style="font-size:14px; color:#6b6e70; line-height:18px; margin:0 0 0;">&copy; <strong>Copyright 2013 – '.date("Y").'  |  Decision 168, Inc  |  All Rights Reserved </strong></p>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td style="height:80px;">&nbsp;</td>
                                  </tr>
                              </table>
                          </td>
                      </tr>
                  </table>
                  <!--/100% body table-->
                </body>

                </html>
            ');
            $this->email->send();
            $upData = array(
                              'inactivity_mail_days' => $inactivity_days,
                              'deactive_date' => $deactive_date,
                              'delete_date' => $delete_date
                            );
                  $upData = $this->security->xss_clean($upData); // xss filter
                  $this->Company_model->updateCompanyDetail($upData,$comp->cc_id);
          }
          if($inactivity_days == "90")
          {
            $email_to = $user->email_address;
            $email_from = 'hello@decision168.com'; 
            //$email_from = 'saramaazkhan123@gmail.com'; 
            $email_name = 'Decision 168';

            $this->load->library('email');  
            $config=array(
              'charset'=>'utf-8',
              'wordwrap'=> TRUE,
              'mailtype' => 'html'
              );
            $this->email->initialize($config);
            $this->email->from($email_from, $email_name);
            $this->email->set_header('Reply-To', $email_from."\r\n");
            $this->email->set_header('Return-Path', $email_from."\r\n");
            $this->email->set_header('X-Mailer', 'PHP/' . phpversion().'\r\n');
            $this->email->set_header('MIME-Version', '1.0' . "\r\n");
            $this->email->to($email_to);
            $this->email->set_mailtype('html');
            $this->email->subject('[Action Required] Your Decision 168 account will be cancelled in 30 days | Decision 168');
            $this->email->message(' 
            <!doctype html>
                <html lang="en-US">

                <head>
                  <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
                  <title>[Action Required] Your Decision 168 account will be cancelled in 30 days</title>
                  <meta name="description" content="[Action Required] Your Decision 168 account will be cancelled in 30 days">
                  <style type="text/css">
                      a:hover {text-decoration: underline !important;pointer:cursor !important;}
                  </style>
                </head>

                <body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
                  <!--100% body table-->

                  <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
                      style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: Open Sans, sans-serif;">
                      <tr>
                          <td>
                              <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                      <td style="height:80px;">&nbsp;</td>
                                  </tr>
                                  <tr>
                                      <td style="text-align:center;">
                                        <a href="'.base_url().'" title="Decision 168" target="_blank">
                                          <img width="50%" src="'.base_url("assets/images/dark-logo-main.png").'" title="Decision 168" alt="Decision 168">
                                        </a>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td style="height:20px;">&nbsp;</td>
                                  </tr>
                                  <tr>
                                      <td>
                                          <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                              style="max-width:670px;background:#383838;border:4px solid #dfdddd;text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                              <tr>
                                                  <td style="height:40px;">&nbsp;</td>
                                              </tr>
                                              <tr>
                                                  <td style="padding:0 35px;">
                                                      <h1 style="color:#c7df19; font-weight:600; margin:0;font-size:33px;font-family:Rubik,sans-serif;">Oh no, your account <br> will be cancelled soon...</h1>
                                                      <span
                                                          style="display:inline-block; vertical-align:middle; margin:29px 0 29px; border-bottom:2px solid #cecece; width:270px;"></span>
                                                      <p style="color:#fff; font-size:15px;line-height:24px;text-align:left; margin:0;">
                                                      Hi '.$user->first_name.' '.$user->last_name.',<br><br>
                                                         It looks like you haven\'t accessed your Decision 168 Platform account for some time now and we wanted to check in. Log back in to enjoy what your account offers.
                                                          <br><br>
                                                        <strong>Please remember, if your account remains inactive, it will be deactivated on '.$deactive_date.'.</strong> You will not be able to access products once unsubscribed. Any data will be permanently deleted soon afterwards.
                                                      </p>
                                                      <a href="'.base_url().'company/"
                                                      style="background:#c7df19;text-decoration:none !important; font-weight:600; margin-top:35px; margin-bottom: 20px;color:#fff;text-transform:uppercase; font-size:15px;padding:10px 30px;display:inline-block;border-radius:10px;">Login to Company Account
                                                    </a> 
                                                    <br><br>
                                                      <p style="color:#fff; font-size:15px;line-height:24px;text-align:left; margin:0;">
                                                          We\'re here to help,
                                                          <br>
                                                          The <span style="color:#c7df19;font-weight: 600;">Decision 168</span> Team
                                                          </p>
                                                          <p style="color:#fff; font-size:15px;line-height:24px;text-align:right; margin:0;">
                                                          <br>
                                                          <img width="20%" src="'.base_url("assets/images/Decision-168.png").'" title="Decision 168" alt="Decision 168">
                                                          </p>
                                                  </td>
                                              </tr>
                                              <tr>
                                                  <td style="height:40px;">&nbsp;</td>
                                              </tr>
                                          </table>
                                      </td>
                                  <tr>
                                      <td style="height:20px;">&nbsp;</td>
                                  </tr>
                                  <tr>
                                      <td style="text-align:center;">
                                      <p style="color:rgba(69, 80, 86, 0.7411764705882353);font-size:11px;line-height:15px;margin:0;">Please note: This e-mail was sent from an auto-notification system that cannot accept incoming e-mail. Do not reply to this message.</p>
                                      <p style="color:rgba(69, 80, 86, 0.7411764705882353);font-size:11px;line-height:15px;margin:0;">You can’t unsubscribe from important emails about your account like this one.</p>
                                      <br>
                                          <p style="font-size:14px; color:#6b6e70; line-height:18px; margin:0 0 0;">&copy; <strong>Copyright 2013 – '.date("Y").'  |  Decision 168, Inc  |  All Rights Reserved </strong></p>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td style="height:80px;">&nbsp;</td>
                                  </tr>
                              </table>
                          </td>
                      </tr>
                  </table>
                  <!--/100% body table-->
                </body>

                </html>
            ');
            $this->email->send();
            $upData = array(
                              'inactivity_mail_days' => $inactivity_days,
                              'deactive_date' => $deactive_date,
                              'delete_date' => $delete_date
                            );
                  $upData = $this->security->xss_clean($upData); // xss filter
                  $this->Company_model->updateCompanyDetail($upData,$comp->cc_id);
          }
          if($inactivity_days == "113")
          {
            $email_to = $user->email_address;
            $email_from = 'hello@decision168.com'; 
            //$email_from = 'saramaazkhan123@gmail.com'; 
            $email_name = 'Decision 168';

            $this->load->library('email');  
            $config=array(
              'charset'=>'utf-8',
              'wordwrap'=> TRUE,
              'mailtype' => 'html'
              );
            $this->email->initialize($config);
            $this->email->from($email_from, $email_name);
            $this->email->set_header('Reply-To', $email_from."\r\n");
            $this->email->set_header('Return-Path', $email_from."\r\n");
            $this->email->set_header('X-Mailer', 'PHP/' . phpversion().'\r\n');
            $this->email->set_header('MIME-Version', '1.0' . "\r\n");
            $this->email->to($email_to);
            $this->email->set_mailtype('html');
            $this->email->subject('[Action Required] Your Decision 168 account will be cancelled in one week | Decision 168');
            $this->email->message(' 
            <!doctype html>
                <html lang="en-US">

                <head>
                  <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
                  <title>[Action Required] Your Decision 168 account will be cancelled in one week</title>
                  <meta name="description" content="[Action Required] Your Decision 168 account will be cancelled in one week">
                  <style type="text/css">
                      a:hover {text-decoration: underline !important;pointer:cursor !important;}
                  </style>
                </head>

                <body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
                  <!--100% body table-->

                  <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
                      style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: Open Sans, sans-serif;">
                      <tr>
                          <td>
                              <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                      <td style="height:80px;">&nbsp;</td>
                                  </tr>
                                  <tr>
                                      <td style="text-align:center;">
                                        <a href="'.base_url().'" title="Decision 168" target="_blank">
                                          <img width="50%" src="'.base_url("assets/images/dark-logo-main.png").'" title="Decision 168" alt="Decision 168">
                                        </a>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td style="height:20px;">&nbsp;</td>
                                  </tr>
                                  <tr>
                                      <td>
                                          <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                              style="max-width:670px;background:#383838;border:4px solid #dfdddd;text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                              <tr>
                                                  <td style="height:40px;">&nbsp;</td>
                                              </tr>
                                              <tr>
                                                  <td style="padding:0 35px;">
                                                      <h1 style="color:#c7df19; font-weight:600; margin:0;font-size:33px;font-family:Rubik,sans-serif;">Uh oh, your account <br> will be cancelled soon...</h1>
                                                      <span
                                                          style="display:inline-block; vertical-align:middle; margin:29px 0 29px; border-bottom:2px solid #cecece; width:270px;"></span>
                                                      <p style="color:#fff; font-size:15px;line-height:24px;text-align:left; margin:0;">
                                                      Hi '.$user->first_name.' '.$user->last_name.',<br><br>
                                                         This is a <strong>final reminder that your Decision 168 account will be deactivated on '.$deactive_date.'</strong>. You will not be able to access products and any data will be permanently deleted soon afterwards.
                                                         <br><br>
                                                         You can maintain access to your Decision 168 platform account by logging in before '.$deactive_date.'.
                                                      </p>
                                                      <a href="'.base_url().'company/"
                                                      style="background:#c7df19;text-decoration:none !important; font-weight:600; margin-top:35px; margin-bottom: 20px;color:#fff;text-transform:uppercase; font-size:15px;padding:10px 30px;display:inline-block;border-radius:10px;">Login to Company Account
                                                    </a> 
                                                    <br><br>
                                                      <p style="color:#fff; font-size:15px;line-height:24px;text-align:left; margin:0;">
                                                          Thanks,
                                                          <br>
                                                          The <span style="color:#c7df19;font-weight: 600;">Decision 168</span> Team
                                                          </p>
                                                          <p style="color:#fff; font-size:15px;line-height:24px;text-align:right; margin:0;">
                                                          <br>
                                                          <img width="20%" src="'.base_url("assets/images/Decision-168.png").'" title="Decision 168" alt="Decision 168">
                                                          </p>
                                                  </td>
                                              </tr>
                                              <tr>
                                                  <td style="height:40px;">&nbsp;</td>
                                              </tr>
                                          </table>
                                      </td>
                                  <tr>
                                      <td style="height:20px;">&nbsp;</td>
                                  </tr>
                                  <tr>
                                      <td style="text-align:center;">
                                      <p style="color:rgba(69, 80, 86, 0.7411764705882353);font-size:11px;line-height:15px;margin:0;">Please note: This e-mail was sent from an auto-notification system that cannot accept incoming e-mail. Do not reply to this message.</p>
                                      <p style="color:rgba(69, 80, 86, 0.7411764705882353);font-size:11px;line-height:15px;margin:0;">You can’t unsubscribe from important emails about your account like this one.</p>
                                      <br>
                                          <p style="font-size:14px; color:#6b6e70; line-height:18px; margin:0 0 0;">&copy; <strong>Copyright 2013 – '.date("Y").'  |  Decision 168, Inc  |  All Rights Reserved </strong></p>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td style="height:80px;">&nbsp;</td>
                                  </tr>
                              </table>
                          </td>
                      </tr>
                  </table>
                  <!--/100% body table-->
                </body>

                </html>
            ');
            $this->email->send();
            $upData = array(
                              'inactivity_mail_days' => $inactivity_days,
                              'deactive_date' => $deactive_date,
                              'delete_date' => $delete_date
                            );
                  $upData = $this->security->xss_clean($upData); // xss filter
                  $this->Company_model->updateCompanyDetail($upData,$comp->cc_id);
          }
          if($inactivity_days == "121")
          {
            $upData1 = array(
                              'inactivity_mail_days' => $inactivity_days,
                              'deactive_date' => $deactive_date,
                              'cc_status' => 'inactive',
                              'delete_date' => $delete_date
                            );
                  $upData1 = $this->security->xss_clean($upData1); // xss filter
                  $this->Company_model->updateCompanyDetail($upData1,$comp->cc_id);

            $data2 = array(
                            'pack_status' => 'inactive',
                       );
            $data2 = $this->security->xss_clean($data2); // xss filter
            $this->Company_model->edit_package($data2,$comp->package_id);
            
           $email_to = $user->email_address;
            $email_from = 'hello@decision168.com'; 
            //$email_from = 'saramaazkhan123@gmail.com'; 
            $email_name = 'Decision 168';

            $this->load->library('email');  
            $config=array(
              'charset'=>'utf-8',
              'wordwrap'=> TRUE,
              'mailtype' => 'html'
              );
            $this->email->initialize($config);
            $this->email->from($email_from, $email_name);
            $this->email->set_header('Reply-To', $email_from."\r\n");
            $this->email->set_header('Return-Path', $email_from."\r\n");
            $this->email->set_header('X-Mailer', 'PHP/' . phpversion().'\r\n');
            $this->email->set_header('MIME-Version', '1.0' . "\r\n");
            $this->email->to($email_to);
            $this->email->set_mailtype('html');
            $this->email->subject('[Action Required] Your Decision 168 account has been de-activated | Decision 168');
            $this->email->message(' 
            <!doctype html>
                <html lang="en-US">

                <head>
                  <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
                  <title>[Action Required] Your Decision 168 account has been de-activated</title>
                  <meta name="description" content="[Action Required] Your Decision 168 account has been de-activated">
                  <style type="text/css">
                      a:hover {text-decoration: underline !important;pointer:cursor !important;}
                  </style>
                </head>

                <body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
                  <!--100% body table-->

                  <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
                      style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: Open Sans, sans-serif;">
                      <tr>
                          <td>
                              <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                      <td style="height:80px;">&nbsp;</td>
                                  </tr>
                                  <tr>
                                      <td style="text-align:center;">
                                        <a href="'.base_url().'" title="Decision 168" target="_blank">
                                          <img width="50%" src="'.base_url("assets/images/dark-logo-main.png").'" title="Decision 168" alt="Decision 168">
                                        </a>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td style="height:20px;">&nbsp;</td>
                                  </tr>
                                  <tr>
                                      <td>
                                          <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                              style="max-width:670px;background:#383838;border:4px solid #dfdddd;text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                              <tr>
                                                  <td style="height:40px;">&nbsp;</td>
                                              </tr>
                                              <tr>
                                                  <td style="padding:0 35px;">
                                                      <h1 style="color:#c7df19; font-weight:600; margin:0;font-size:30px;font-family:Rubik,sans-serif;">Your account has been de-activated,<br>but there\'s still hope...</h1>
                                                      <span
                                                          style="display:inline-block; vertical-align:middle; margin:29px 0 29px; border-bottom:2px solid #cecece; width:270px;"></span>
                                                      <p style="color:#fff; font-size:15px;line-height:24px;text-align:left; margin:0;">
                                                      Hi '.$user->first_name.' '.$user->last_name.',<br><br>
                                                         This is a <strong>final notification that your Decision 168 account has been deactivated on '.$deactive_date.'</strong>. You will not be able to access products and any data will be permanently deleted soon.
                                                         <br><br>
                                                         You can still re-gain access to your Decision 168 platform account by reactivating your account before '.$delete_date.'. All data will be deleted at that time.
                                                      </p>
                                                      <p style="color:#fff; font-size:15px;line-height:24px;text-align:left; margin:0;">
                                                          Thanks,
                                                          <br>
                                                          The <span style="color:#c7df19;font-weight: 600;">Decision 168</span> Team
                                                          </p>
                                                          <p style="color:#fff; font-size:15px;line-height:24px;text-align:right; margin:0;">
                                                          <br>
                                                          <img width="20%" src="'.base_url("assets/images/Decision-168.png").'" title="Decision 168" alt="Decision 168">
                                                          </p>
                                                  </td>
                                              </tr>
                                              <tr>
                                                  <td style="height:40px;">&nbsp;</td>
                                              </tr>
                                          </table>
                                      </td>
                                  <tr>
                                      <td style="height:20px;">&nbsp;</td>
                                  </tr>
                                  <tr>
                                      <td style="text-align:center;">
                                      <p style="color:rgba(69, 80, 86, 0.7411764705882353);font-size:11px;line-height:15px;margin:0;">Please note: This e-mail was sent from an auto-notification system that cannot accept incoming e-mail. Do not reply to this message.</p>
                                      <p style="color:rgba(69, 80, 86, 0.7411764705882353);font-size:11px;line-height:15px;margin:0;">You can’t unsubscribe from important emails about your account like this one.</p>
                                      <br>
                                          <p style="font-size:14px; color:#6b6e70; line-height:18px; margin:0 0 0;">&copy; <strong>Copyright 2013 – '.date("Y").'  |  Decision 168, Inc  |  All Rights Reserved </strong></p>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td style="height:80px;">&nbsp;</td>
                                  </tr>
                              </table>
                          </td>
                      </tr>
                  </table>
                  <!--/100% body table-->
                </body>

                </html>
            ');
            $this->email->send(); 
          }
          if($inactivity_days > "180")
          {            
            $getUsers = $this->Company_model->getAllUsers($comp->cc_corporate_id);
            if($getUsers)
            {
              foreach($getUsers as $gu)
              {
                $this->Company_model->deleteAd_logo($gu->reg_id);
                $this->Company_model->deleteComments2($gu->reg_id);
                $this->Company_model->deleteMotivator($gu->reg_id);
                $this->Company_model->deleteRContactSales($gu->reg_id);
                $get_all_user_portfolio = $this->Company_model->get_all_user_portfolio($gu->reg_id);
                if($get_all_user_portfolio)
                {
                  foreach($get_all_user_portfolio as $gaup)
                  {
                    $get_all_goals = $this->Company_model->get_all_goals($gaup->portfolio_id);
                    if($get_all_goals)
                    {
                      foreach($get_all_goals as $ggap)
                      {
                        $this->Company_model->deleteGoals($ggap->gid);
                        $this->Company_model->deleteGoal_members($ggap->gid);
                        $this->Company_model->deleteGoal_invited_members($ggap->gid);
                        $this->Company_model->deleteGoal_suggested_members($ggap->gid);
                      }
                    }
                    $this->Company_model->deleteStartegies_portfolio($gaup->portfolio_id);
                    $this->Company_model->deleteProject_portfolio($gaup->portfolio_id);
                    $this->Company_model->deleteProject_portfolio_member($gaup->portfolio_id);
                    $get_all_project = $this->Company_model->get_all_project($gaup->portfolio_id);
                    if($get_all_project)
                      {
                        foreach($get_all_project as $gap)
                        {
                          $this->Company_model->deleteProject($gap->pid);
                          $this->Company_model->deleteProject_members($gap->pid);
                          $this->Company_model->deleteProject_files($gap->pid); 
                          $this->Company_model->deleteProject_invited_members($gap->pid);
                          $this->Company_model->deleteProject_request_member($gap->pid); 
                          $this->Company_model->deleteProject_suggested_members($gap->pid); 
                          $this->Company_model->deleteTask($gap->pid);
                          $this->Company_model->deleteSubtask($gap->pid);  
                          $this->Company_model->deleteComments($gap->pid);
                          $this->Company_model->deleteProject_history($gap->pid);
                          $this->Company_model->deleteProject_management($gap->pid);
                          $this->Company_model->deleteProject_management_fields($gap->pid);
                        }
                      }
                      $this->Company_model->deleteContent_planning($gaup->portfolio_id);
                  }
                }

                $get_all_goals2 = $this->Company_model->get_all_goals2($gu->reg_id);
                if($get_all_goals2)
                {
                  foreach($get_all_goals2 as $gag2)
                  {
                    $this->Company_model->deleteGoals($gag2->gid);
                    $this->Company_model->deleteGoal_members($gag2->gid);
                    $this->Company_model->deleteGoal_invited_members($gag2->gid);
                    $this->Company_model->deleteGoal_suggested_members($gag2->gid);
                  }
                }

                $get_all_strategies2 = $this->Company_model->get_all_strategies2($gu->reg_id);
                if($get_all_strategies2)
                {
                  foreach($get_all_strategies2 as $gas2)
                  {
                    $this->Company_model->deleteStartegies($gas2->pid);
                  }
                }

                $get_all_project2 = $this->Company_model->get_all_project2($gu->reg_id);
                if($get_all_project2)
                {
                  foreach($get_all_project2 as $gap2)
                  {
                    $this->Company_model->deleteProject($gap2->pid);
                    $this->Company_model->deleteProject_members($gap2->pid);
                    $this->Company_model->deleteProject_files($gap2->pid); 
                    $this->Company_model->deleteProject_invited_members($gap2->pid);
                    $this->Company_model->deleteProject_request_member($gap2->pid); 
                    $this->Company_model->deleteProject_suggested_members($gap2->pid); 
                    $this->Company_model->deleteTask($gap2->pid);
                    $this->Company_model->deleteSubtask($gap2->pid);  
                    $this->Company_model->deleteComments($gap2->pid); 
                    $this->Company_model->deleteProject_history($gap2->pid);
                    $this->Company_model->deleteProject_management($gap2->pid);
                    $this->Company_model->deleteProject_management_fields($gap2->pid);
                  }
                }
                $this->Company_model->deleteProject_portfolio_member2($gu->email_address);
                $this->Company_model->deleteProject_members2($gu->reg_id);
                $this->Company_model->deleteProject_files2($gu->reg_id);
                $this->Company_model->deleteProject_invited_members2($gu->reg_id);
                $this->Company_model->deleteProject_request_member2($gu->reg_id);
                $this->Company_model->deleteProject_suggested_members2($gu->reg_id);
                $this->Company_model->deleteProject_history2($gu->reg_id);
                $this->Company_model->deleteProject_management2($gu->reg_id);
                $this->Company_model->deleteProject_management_fields2($gu->reg_id);
                $this->Company_model->deleteGoal_members2($gu->reg_id);
                $this->Company_model->deleteGoal_invited_members2($gu->reg_id);
                $this->Company_model->deleteGoal_suggested_members2($gu->reg_id);
                //change assignee
                $get_all_task = $this->Company_model->get_all_task($gu->reg_id);
                {
                  foreach($get_all_task as $gat)
                  {
                    $task_getProjectById = $this->Company_model->check_getProjectById($gat->tproject_assign);
                    if(!empty($task_getProjectById))
                    {
                          $upDataT = array(
                                  'tassignee' => $task_getProjectById->pcreated_by,
                                  'tcreated_by' => $task_getProjectById->pcreated_by,
                                );
                          $upDataT = $this->security->xss_clean($upDataT); // xss filter
                          $this->Company_model->updateOnlyTask($upDataT,$gat->tid);

                          $task_getSubtaskId = $this->Company_model->task_getSubtaskId($gat->tid);
                          if($task_getSubtaskId > 0)
                          {
                            $upDataSub = array(
                                  'stassignee' => $task_getProjectById->pcreated_by,
                                  'stcreated_by' => $task_getProjectById->pcreated_by,
                                );
                            $upDataSub = $this->security->xss_clean($upDataSub); // xss filter
                            $this->Company_model->updateOnlyTaskSubtask($upDataSub,$gat->tid);
                            $this->Company_model->deleteTaskSubtask_trash($gat->tid);
                          }
                          $this->Company_model->deleteTask_trash($gat->tid);
                    }
                    else
                    {
                      $task_getSubtaskId = $this->Company_model->task_getSubtaskId($gat->tid);
                        if($task_getSubtaskId > 0)
                        {
                          $this->Company_model->deleteOnlyTaskSubtask($gat->tid);
                          $this->Company_model->deleteTaskSubtask_trash($gat->tid);
                        }
                       $this->Company_model->deleteOnlyTask($gat->tid);
                       $this->Company_model->deleteTask_trash($gat->tid);
                    }
                  }
                }

                $get_all_subtask = $this->Company_model->get_all_subtask($gu->reg_id);
                {
                  foreach($get_all_subtask as $gast)
                  {
                    $subtask_getProjectById = $this->Company_model->check_getProjectById($gast->stproject_assign);
                    if(!empty($subtask_getProjectById))
                    {
                          $upDataST = array(
                                  'stassignee' => $subtask_getProjectById->pcreated_by,
                                  'stcreated_by' => $subtask_getProjectById->pcreated_by,
                                );
                          $upDataST = $this->security->xss_clean($upDataST); // xss filter
                          $this->Company_model->updateOnlySubtask($upDataST,$gast->stid);
                          $this->Company_model->deleteSubtask_trash($gast->stid);
                    }
                    else
                    {
                       $this->Company_model->deleteOnlySubtask($gast->stid);
                       $this->Company_model->deleteSubtask_trash($gast->stid);
                    }
                  }
                }

                $get_all_cp = $this->Company_model->get_all_cp($gu->reg_id);
                {
                  foreach($get_all_cp as $gacp)
                  {
                    $cp_getProjectById = $this->Company_model->check_getProjectById($gacp->pc_project_assign);
                    if(!empty($cp_getProjectById))
                    {
                          $upDataCP = array(
                                  'written_content_assignee' => $cp_getProjectById->pcreated_by,
                                  'pc_file_assignee' => $cp_getProjectById->pcreated_by,
                                  'submit_to_approval' => $cp_getProjectById->pcreated_by,
                                  'pc_assignee' => $cp_getProjectById->pcreated_by,
                                  'pc_created_by' => $cp_getProjectById->pcreated_by,
                                );
                          $upDataCP = $this->security->xss_clean($upDataCP); // xss filter
                          $this->Company_model->updateOnlyCP($upDataCP,$gacp->pc_id);
                          $this->Company_model->deletecontent_planning_trash($gacp->pc_id);
                    }
                    else
                    {
                       $this->Company_model->deleteOnlyCP($gacp->pc_id);
                       $this->Company_model->deletecontent_planning_trash($gacp->pc_id);
                    }
                  }
                }
                $this->Company_model->deleteRegistration($gu->reg_id);
              }
            }
            $this->Company_model->deletePricingLabels($comp->package_id);
            $this->Company_model->deletePricing($comp->package_id);       
            $this->Company_model->deleteContactSales($comp->contacted_sales_id);
            $this->Company_model->deleteContactedCompanyEmp($comp->cc_id);
            $this->Company_model->deleteContactedCompany($comp->cc_id);
          }
        }
      }
    }
  }

  public function reset_password()
  {
    if(($this->session->userdata('d168_comp_id')) || ($this->session->userdata('d168_comp_id') != ""))
    {
      $check_packD = $this->Company_model->getCompanyDetail($this->session->userdata('d168_comp_id'));
      if($check_packD->extended_pack == 'expired')
      {
        redirect(base_url('company/pricing-package'));
      }
      else
      {
        redirect(base_url('company/dashboard'));
      }          
    }
    else
    {      
      $this->load->view('company_view/reset-password');
    }
  }

  public function sent_reset_password() //Insert Forgotpassword
  {
      $this->form_validation->set_rules('username','Username','trim|required');
      $this->form_validation->set_rules('g-recaptcha-response','Recaptcha','required');
      if ($this->form_validation->run() == FALSE)
      {
          $errors = $this->form_validation->error_array();
          // Loop through $_POST and get the keys
          foreach ($errors as $key => $value)
          {
            // Add the error message for this field
            $errors[$key] = form_error($key);
          }
        
          $response['errors'] = array_filter($errors); // Some might be empty
          $response['status'] = FALSE;
          // You can use the Output class here too
          header('Content-type: application/json');
          //echo json_encode($response);
          exit(json_encode($response));
      }
      else
      {
        $secretKey = "6LeGztMcAAAAABo3gtAjhWfM9J2ZNVKgR5jPwDE1";
        //$secretKey = "6Ld21JMaAAAAAKdJWi_bhns9O7kP3C85sordZMdB";
        $responseKey = $this->input->post('g-recaptcha-response');
        $userIP = $this->input->server('REMOTE_ADDR');       
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
        $response1 = file_get_contents($url);
        $response1 = json_decode($response1);

        if($response1->success)
        {                   
          $username = $this->input->post('username');
          $userdata = $this->Company_model->selectLogin($username);                  
          if($userdata)
          {
              $getEmail = $this->Company_model->getStudentById($userdata->contacted_user_id);
              if($getEmail)
              {
                $md5_username = md5($userdata->cc_username);
                $comp_id = $userdata->cc_id;
                $code = uniqid().uniqid();

                $username_from = 'hello@decision168.com'; 
                //$username_from = 'saramaazkhan123@gmail.com'; 
                $username_name = 'Decision 168';

                $this->load->library('email');  
                $config=array(
                  'charset'=>'utf-8',
                  'wordwrap'=> TRUE,
                  'mailtype' => 'html'
                  );
                $this->email->initialize($config);
                $this->email->from($username_from, $username_name);
                $this->email->set_header('Reply-To', $username_from."\r\n");
                $this->email->set_header('Return-Path', $username_from."\r\n");
                $this->email->set_header('X-Mailer', 'PHP/' . phpversion().'\r\n');
                $this->email->set_header('MIME-Version', '1.0' . "\r\n");
                $this->email->to($getEmail->email_address);
                $this->email->set_mailtype('html');
                $this->email->subject('Reset Password | Decision 168');
                $this->email->message('
         
<!doctype html>
          <html lang="en-US">

          <head>
            <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
            <title>Reset Password</title>
            <meta name="description" content="Reset Password">
            <style type="text/css">
                a:hover {text-decoration: underline !important;pointer:cursor !important;}
            </style>
          </head>

          <body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
            <!--100% body table-->

            <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
                style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: Open Sans, sans-serif;">
                <tr>
                    <td>
                        <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="height:80px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;">
                                  <a href="'.base_url().'" title="Decision 168" target="_blank">
                                    <img width="50%" src="'.base_url("assets/images/dark-logo-main.png").'" title="Decision 168" alt="Decision 168">
                                  </a>
                                </td>
                            </tr>
                            <tr>
                                <td style="height:20px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                        style="max-width:670px;background:#383838;border:4px solid #dfdddd;text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                        <tr>
                                            <td style="height:40px;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="padding:0 35px;">
                                                <h1 style="color:#c7df19; font-weight:600; margin:0;font-size:33px;font-family:Rubik,sans-serif;">Did you request a password reset for company?</h1>
                                                <span
                                                    style="display:inline-block; vertical-align:middle; margin:29px 0 29px; border-bottom:2px solid #cecece; width:270px;"></span>
                                                <p style="color:#fff; font-size:15px;line-height:24px;text-align:left; margin:0;">
                                                Hello '.ucfirst($getEmail->first_name).',<br><br>
                                                   We received a request to reset company password for access to the Decision 168 Accountability & Productivity Platform (D168). To reset company password, simply click the unique link below which has been generated for you, and follow the instructions.
                                                    <br><br>
                                                    For the security of your account, the password reset link will expire in 24 hours from when it was sent.
                                                </p>
                                                <a href="'.base_url('change-password-company/'.$comp_id.'/'.$code.'/'.$md5_username).'"
                                                style="background:#c7df19;text-decoration:none !important; font-weight:600; margin-top:35px; margin-bottom: 20px; color:#fff;text-transform:uppercase; font-size:15px;padding:10px 30px;display:inline-block;border-radius:10px;">Reset Your Password</a> 
                                                    <br><br>
                                                    <p style="color:#fff; font-size:15px;line-height:24px;text-align:left; margin:0;">
                                                    <strong>Reset link expired?</strong> You can request another password reset <a onMouseOver="this.style.pointer=cursor" href="'.base_url('company/reset-password').'" style="color:#c7df19;">here</a>. <strong>If you didn\'t make this request and prefer not to change your password</strong> , simply disregard this message and it will remain unchanged.

                                                    <br><br>
                                                    Thanks,
                                                    <br>
                                                    <span style="color:#c7df19;font-weight: 600;">Decision 168</span>
                                                    <br>
                                                    Support Team
                                                    </p>
                                                    <p style="color:#fff; font-size:15px;line-height:24px;text-align:right; margin:0;">
                                                    <br>
                                                    <img width="20%" src="'.base_url("assets/images/Decision-168.png").'" title="Decision 168" alt="Decision 168">
                                                    </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height:40px;">&nbsp;</td>
                                        </tr>
                                    </table>
                                </td>
                            <tr>
                                <td style="height:20px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;">
                                <p style="color:rgba(69, 80, 86, 0.7411764705882353);font-size:11px;line-height:15px;margin:0;">Please note: This e-mail was sent from an auto-notification system that cannot accept incoming e-mail. Do not reply to this message.</p>
                                <p style="color:rgba(69, 80, 86, 0.7411764705882353);font-size:11px;line-height:15px;margin:0;">You can’t unsubscribe from important emails about your account like this one.</p>
                                <br>
                                    <p style="font-size:14px; color:#6b6e70; line-height:18px; margin:0 0 0;">&copy; <strong>Copyright 2013 – '.date("Y").'  |  Decision 168, Inc  |  All Rights Reserved </strong></p>
                                </td>
                            </tr>
                            <tr>
                                <td style="height:80px;">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!--/100% body table-->
          </body>

          </html>' 
              );

              if($this->email->send())
              {
                $data = array(  'mail_code' => $code,
                        'mail_date' => date('Y-m-d H:i:s') 
                      );
                $data = $this->security->xss_clean($data); // xss filter
                $this->Company_model->updateCompanyDetail($data,$comp_id);

                $this->session->set_flashdata('message', 'Reset Link has been send on your Contacted Registered Email Address.. ');
                $response['status'] = TRUE;
                header('Content-type: application/json');
                echo json_encode($response);
              }
              else
              {
                echo $this->email->print_debugger();
              } 
            } 
            else
            {
              $response['errors'] = 'Contacted user is Invalid!';
              $response['status'] = FALSE;
              header('Content-type: application/json');
              exit(json_encode($response));
            }                 
          }
          else
          {
              $response['errors'] = 'Invalid username!';
              $response['status'] = FALSE;
              header('Content-type: application/json');
              exit(json_encode($response));
          }            
      }
      else
      {
        $response['errors'] = 'Verification Failed';
        $response['status'] = FALSE;
        header('Content-type: application/json');
        exit(json_encode($response));
      }
      }
  }

  public function change_password_company()
  {
    if(($this->session->userdata('d168_comp_id')) || ($this->session->userdata('d168_comp_id') != ""))
    {
      redirect(base_url('company/dashboard'));     
    }
    else
    {
      $comp_id = $this->uri->segment(2);
      $segment_code = $this->uri->segment(3);
      $md5_username = $this->uri->segment(4);

      $data['comp_del'] = $this->Company_model->getCompanyDetail($comp_id);
      if($data['comp_del'])
      {
        $compD = $data['comp_del'];
        if($compD->cc_status == 'active')
        {
          $created_on = date_create($data['comp_del']->mail_date);
          $time_limit = '24 hours';
          date_add($created_on,date_interval_create_from_date_string($time_limit)); 
          $expiryDate = date_format($created_on,"Y-m-d H:i:s");
          $currentDate = date('Y-m-d H:i:s');
          if(($expiryDate > $currentDate) && ($data['comp_del']->mail_code == $segment_code))
          {
            $uname = md5($data['comp_del']->cc_username);
            if($md5_username == $uname)
            {
              $this->load->view('company_view/change_password',$data);
            }
            else
            {
              $this->load->view('company_view/pages-404'); 
            }
          }
          else
          {
            echo '<h1> Expired </h1>';
          }
        }               
      }
      else
      {
        $this->load->view('company_view/pages-404'); 
      } 
    }   
  }

  public function insert_change_password() //Change Password
  {
    $this->form_validation->set_rules('username','Username','trim|required');
    $this->form_validation->set_rules('new_password','Password','trim|required|min_length[5]|callback_valid_password');
    $this->form_validation->set_rules('conf_password','Confirm Password','trim|required|required|matches[new_password]');
    $this->form_validation->set_rules('g-recaptcha-response','Recaptcha','required');
    if ($this->form_validation->run() == FALSE)
    {
        //$errors = array();

        $errors = $this->form_validation->error_array();
        // Loop through $_POST and get the keys
        foreach ($errors as $key => $value)
        {
          // Add the error message for this field
          $errors[$key] = form_error($key);
        }
      
        $response['errors'] = array_filter($errors); // Some might be empty
        $response['status'] = FALSE;
        // You can use the Output class here too
        header('Content-type: application/json');
        //echo json_encode($response);
        exit(json_encode($response));
    }
    else
    {
      $secretKey = "6LeGztMcAAAAABo3gtAjhWfM9J2ZNVKgR5jPwDE1";
      //$secretKey = "6Ld21JMaAAAAAKdJWi_bhns9O7kP3C85sordZMdB";
      $responseKey = $this->input->post('g-recaptcha-response');
      $userIP = $this->input->server('REMOTE_ADDR');       
      $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
      $response1 = file_get_contents($url);
      $response1 = json_decode($response1);

      if($response1->success)
      { 
        $id = $this->input->post('cc_id');
        $data = array(  'cc_pwd' => md5($this->input->post('new_password')) );
        $data = $this->security->xss_clean($data); // xss filter
        $this->Company_model->updateCompanyDetail($data,$id);

        $this->session->set_flashdata('message', 'Password Changed Successfully!');
        $response['status'] = TRUE;
        header('Content-type: application/json');
        echo json_encode($response);  
    }
    else
    {
      $response['errors'] = 'Verification Failed';
      $response['status'] = FALSE;
      header('Content-type: application/json');
      exit(json_encode($response));
    }
    }
  }

  public function team_members()
  {
    if(($this->session->userdata('d168_comp_id')) || ($this->session->userdata('d168_comp_id') != ""))
    {
      $check_packD = $this->Company_model->getCompanyDetail($this->session->userdata('d168_comp_id'));
      if($check_packD->extended_pack == 'expired')
      {
        redirect(base_url('company/pricing-package'));
      }
      else
      {
        $data['list'] = $this->Company_model->getCompanyEmps($this->session->userdata('d168_comp_id'));
        $data['exact_totalemp'] = $check_packD->cc_tusers;
        $count_emp = $this->Company_model->count_emp($this->session->userdata('d168_comp_id'));
        $data['count_temp'] = "0";
        if($count_emp)
        {
            $data['count_temp'] = $count_emp['count_rows'];   
        }
        $this->load->view('company_view/team-members',$data);
      }
    }
    else
    {      
      redirect(base_url('company/login'));
    }
  }

  function insert_empform()
  {
    if(($this->session->userdata('d168_comp_id')) || ($this->session->userdata('d168_comp_id') != ""))
    {
      $this->form_validation->set_rules('insert_emp[]','Email address','trim|required|valid_email');
      if ($this->form_validation->run() == FALSE)
      {
        //$errors = array();
        $errors = $this->form_validation->error_array();
        // Loop through $_POST and get the keys
        foreach ($errors as $key => $value)
          {
            // Add the error message for this field
            $errors[$key] = form_error($key);
          }
          
          $response['errors'] = array_filter($errors); // Some might be empty
          $response['status'] = FALSE;
          // You can use the Output class here too
          header('Content-type: application/json');
          //echo json_encode($response);
          exit(json_encode($response));
      }
      else
      {            
        $insert_emp_array = implode(',', $this->input->post('insert_emp'));
        $des = $this->Company_model->getCompanyDetail($this->session->userdata('d168_comp_id'));
        $cc_link = $des->cc_link;
          if(!empty($insert_emp_array[0]))
          {
            $myemp_Array = explode(',', $insert_emp_array);//invite team member array
            foreach($myemp_Array as $em)
            {
              $check_emp = $this->Company_model->checkCompanyEmp($em,$this->session->userdata('d168_comp_id'));
              if(empty($check_emp))
              {
                $inData = array(
                        'cc_id' => $this->session->userdata('d168_comp_id'),
                        'emp_email' => $em,
                        'emp_status' => 'active',
                        'status' => 'sent',
                        'cce_date' => date('Y-m-d'),
                        'contacted_user' => 'no'
                      );
                $inData = $this->security->xss_clean($inData); // xss filter
                $this->Company_model->insert_contacted_company_emp($inData);

                $email_to = $em;
                $email_from = 'hello@decision168.com'; 
                //$email_from = 'saramaazkhan123@gmail.com'; 
                $email_name = 'Decision 168';

                $this->load->library('email');  
                $config=array(
                  'charset'=>'utf-8',
                  'wordwrap'=> TRUE,
                  'mailtype' => 'html'
                  );
                $this->email->initialize($config);
                $this->email->from($email_from, $email_name);
                $this->email->set_header('Reply-To', $email_from."\r\n");
                $this->email->set_header('Return-Path', $email_from."\r\n");
                $this->email->set_header('X-Mailer', 'PHP/' . phpversion().'\r\n');
                $this->email->set_header('MIME-Version', '1.0' . "\r\n");
                $this->email->to($email_to);
                $this->email->set_mailtype('html');
                $this->email->subject('Registration | Decision 168');
                $this->email->message('             
          <!doctype html>
          <html lang="en-US">

          <head>
            <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
            <title>Registration</title>
            <meta name="description" content="Registration">
            <style type="text/css">
                a:hover {text-decoration: underline !important;pointer:cursor !important;}
            </style>
          </head>

          <body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
            <!--100% body table-->

            <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
                style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: Open Sans, sans-serif;">
                <tr>
                    <td>
                        <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="height:80px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;">
                                  <a href="'.base_url().'" title="Decision 168" target="_blank">
                                    <img width="50%" src="'.base_url("assets/images/dark-logo-main.png").'" title="Decision 168" alt="Decision 168">
                                  </a>
                                </td>
                            </tr>
                            <tr>
                                <td style="height:20px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                        style="max-width:670px;background:#383838;border:4px solid #dfdddd;text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                        <tr>
                                            <td style="height:40px;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="padding:0 35px;">
                                                <h1 style="color:#c7df19; font-weight:600; margin:0;font-size:33px;font-family:Rubik,sans-serif;">Let\'s get you going!</h1>
                                                <span
                                                    style="display:inline-block; vertical-align:middle; margin:29px 0 29px; border-bottom:2px solid #cecece; width:270px;"></span>
                                                <p style="color:#fff; font-size:15px;line-height:24px;text-align:left; margin:0;">
                                                Hello ,<br><br>
                                                   Please register to Decision 168 using below option.
                                                    <br><br>
                                                </p>
                                                    <a href="'.$cc_link.'"
                                                      style="background:#c7df19;text-decoration:none !important; font-weight:600; margin-top:35px; margin-bottom: 20px;color:#fff;text-transform:uppercase; font-size:15px;padding:10px 30px;display:inline-block;border-radius:10px;">Register
                                                    </a> 
                                                    <br><br>
                                                    <p style="color:#fff; font-size:15px;line-height:24px;text-align:left; margin:0;">
                                                    We\'re so excited to have you join the Decision 168 community.
                                                    <br><br>
                                                    Thanks,
                                                    <br>
                                                    The <span style="color:#c7df19;font-weight: 600;">Decision 168</span> Team
                                                    </p>
                                                    <p style="color:#fff; font-size:15px;line-height:24px;text-align:right; margin:0;">
                                                    <br>
                                                    <img width="20%" src="'.base_url("assets/images/Decision-168.png").'" title="Decision 168" alt="Decision 168">
                                                    <br>
                                                    <a onMouseOver="this.style.pointer=cursor" href="'.base_url().'" style="color:#c7df19;font-size:11px;text-decoration: none;">view it in your browser</a>
                                                    </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height:40px;">&nbsp;</td>
                                        </tr>
                                    </table>
                                </td>
                            <tr>
                                <td style="height:20px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;">
                                <p style="color:rgba(69, 80, 86, 0.7411764705882353);font-size:11px;line-height:15px;margin:0;">Please note: This e-mail was sent from an auto-notification system that cannot accept incoming e-mail. Do not reply to this message.</p>
                                <p style="color:rgba(69, 80, 86, 0.7411764705882353);font-size:11px;line-height:15px;margin:0;">You can’t unsubscribe from important emails about your account like this one.</p>
                                <br>
                                    <p style="font-size:14px; color:#6b6e70; line-height:18px; margin:0 0 0;">&copy; <strong>Copyright 2013 – '.date("Y").'  |  Decision 168, Inc  |  All Rights Reserved </strong></p>
                                </td>
                            </tr>
                            <tr>
                                <td style="height:80px;">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!--/100% body table-->
          </body>

          </html>' 
            );
                $this->email->send();
              }
            }
          }
          $this->session->set_flashdata('message','Member Added Successfully!');
          $response['status'] = TRUE;
          header('Content-type: application/json');
          echo json_encode($response);          
      }
    }
    else
    {
      redirect(base_url('company/login'));
    }
  }

  public function change_emp_status()
  {
    if(($this->session->userdata('d168_comp_id')) || ($this->session->userdata('d168_comp_id') != ""))
    {
      $id = $this->input->post('id');
      $status = $this->input->post('status');

      if($status == 'active')
      {
        $check_des = $this->Company_model->getCompanyDetail($this->session->userdata('d168_comp_id'));
        $count_emp = $this->Company_model->count_emp($this->session->userdata('d168_comp_id'));
        
        $exact_totalemp = $check_des->cc_tusers;
        $count_temp = $count_emp['count_rows'];

        if($count_temp < $exact_totalemp)
        { 
          $inData = array(
                  'emp_status' => $status,
                );
          $inData = $this->security->xss_clean($inData); // xss filter
          $this->Company_model->update_contacted_company_emp($inData,$id);

          $this->session->set_flashdata('message','Member Activate Successfully!');
          $response['status'] = TRUE;
          header('Content-type: application/json');
          echo json_encode($response);
        }
        else
        {
          $this->session->set_flashdata('message','Limit Exceeds!');
          $response['status'] = TRUE;
          header('Content-type: application/json');
          echo json_encode($response);
        }
      }
      else
      {
        $getEmp = $this->Company_model->getCompanyEmpDetail($id);
        $pm = $this->Company_model->getStudentByEmailId($getEmp->emp_email);
        $data['mem_detail'] = $pm;
        $data['cce_id'] = $id;
        if($pm)
        {
          $reg_id = $pm->reg_id;
          $portfolio_count = 0;
          $goal_count = 0;
          $goal_tm_count = 0;
          $strategies_count = 0;
          $pro_count = 0;
          $plan_count = 0;
          $task_count = 0;
          $subtask_count = 0;
          $pro_tm_count = 0;

          $getPortfolio = $this->Company_model->TMOpenPortfolio($reg_id);
          if($getPortfolio)
          {
            foreach($getPortfolio as $pp)
            {
              $portfolio_count++;

              $portfolio_id = $pp->portfolio_id;

              $getGoals = $this->Company_model->TMOpenGoals($reg_id,$portfolio_id);
              if($getGoals)
              {
                foreach($getGoals as $gg)
                {
                  $goal_count++;
                }
              }
              $getGoalTM = $this->Company_model->getGoalOpenTM($reg_id,$portfolio_id);
              if($getGoalTM)
              {
                foreach($getGoalTM as $ggtm)
                {
                  $goal_tm_count++;
                }
              }
              $getStrategies = $this->Company_model->TMOpenStrategies($reg_id,$portfolio_id);
              if($getStrategies)
              {
                foreach($getStrategies as $ggs)
                {
                  $strategies_count++;
                }
              }
              $getProjects = $this->Company_model->TMOpenProjects($reg_id,$portfolio_id);
              if($getProjects)
              {
                foreach($getProjects as $gp)
                {
                  $pro_count++;
                }
              }
              $getPlannedContent = $this->Company_model->TMOpenPlannedContent($reg_id,$portfolio_id);
              if($getPlannedContent)
              {
                foreach($getPlannedContent as $gpc)
                {
                  $plan_count++;
                }
              }
              $getTasks = $this->Company_model->TMOpenTasks($reg_id,$portfolio_id);
              if($getTasks)
              {
                foreach($getTasks as $gt)
                {
                  $task_count++;
                }
              }
              $getSubtasks = $this->Company_model->TMOpenSubtasks($reg_id,$portfolio_id);
              if($getSubtasks)
              {
                foreach($getSubtasks as $gs)
                {
                  $subtask_count++;
                }
              }
              $getProjectTM = $this->Company_model->getProjectOpenTM($reg_id,$portfolio_id);
              if($getProjectTM)
              {
                foreach($getProjectTM as $gtm)
                {
                  $pro_tm_count++;
                }
              }
            }
          }

          $reg_id_sent_to = $getEmp->emp_email;
          $getPortfolio = $this->Company_model->TMOpenPortfolio2($reg_id_sent_to);
          if($getPortfolio)
          {
            foreach($getPortfolio as $pp)
            {
              $portfolio_count++;
            }
          }

          $getGoals = $this->Company_model->TMOpenGoals2($reg_id);
          if($getGoals)
          {
            foreach($getGoals as $gg)
            {
              $goal_count++;
            }
          }
          $getGoalTM = $this->Company_model->getGoalOpenTM2($reg_id);
          if($getGoalTM)
          {
            foreach($getGoalTM as $ggtm)
            {
              $goal_tm_count++;
            }
          }
          $getStrategies = $this->Company_model->TMOpenStrategies2($reg_id);
          if($getStrategies)
          {
            foreach($getStrategies as $ggs)
            {
              $strategies_count++;
            }
          }
          $getProjects = $this->Company_model->TMOpenProjects2($reg_id);
          if($getProjects)
          {
            foreach($getProjects as $gp)
            {
              $pro_count++;
            }
          }
          $getPlannedContent = $this->Company_model->TMOpenPlannedContent2($reg_id);
          if($getPlannedContent)
          {
            foreach($getPlannedContent as $gpc)
            {
              $plan_count++;
            }
          }
          $getTasks = $this->Company_model->TMOpenTasks2($reg_id);
          if($getTasks)
          {
            foreach($getTasks as $gt)
            {
              $task_count++;
            }
          }
          $getSubtasks = $this->Company_model->TMOpenSubtasks2($reg_id);
          if($getSubtasks)
          {
            foreach($getSubtasks as $gs)
            {
              $subtask_count++;
            }
          }
          $getProjectTM = $this->Company_model->getProjectOpenTM2($reg_id);
          if($getProjectTM)
          {
            foreach($getProjectTM as $gtm)
            {
              $pro_tm_count++;
            }
          }          

          if(($portfolio_count == 0) && ($goal_count == 0) && ($strategies_count == 0) && ($pro_count == 0) && ($task_count == 0) && ($subtask_count == 0) && ($plan_count == 0) && ($pro_tm_count == 0) && ($goal_tm_count == 0))
          {              
            $inData = array(
                      'emp_status' => $status,
                    );
            $inData = $this->security->xss_clean($inData); // xss filter
            $this->Company_model->update_contacted_company_emp($inData,$id);

            $this->session->set_flashdata('message','Member Inactivate Successfully!');
            $response['status'] = TRUE;
            header('Content-type: application/json');
            echo json_encode($response);
          }
          else
          {          
            $data['portfolio_count'] = $portfolio_count;
            $data['goal_count'] = $goal_count;
            $data['goal_tm_count'] = $goal_tm_count;
            $data['strategies_count'] = $strategies_count;
            $data['pro_count'] = $pro_count;
            $data['plan_count'] = $plan_count;
            $data['task_count'] = $task_count;
            $data['subtask_count'] = $subtask_count;
            $data['pro_tm_count'] = $pro_tm_count;

            $this->load->view('company_view/assign-open-work',$data);           
          }            
        }        
      }
    }
    else
    {
      redirect(base_url('company/login'));
    }
  }

  public function forceinactive_emp()
  {
    if(($this->session->userdata('d168_comp_id')) || ($this->session->userdata('d168_comp_id') != ""))
    {
      $id = $this->input->post('id');
      $status = $this->input->post('status');
      
      $inData = array(
                'emp_status' => $status,
              );
      $inData = $this->security->xss_clean($inData); // xss filter
      $this->Company_model->update_contacted_company_emp($inData,$id);

      $this->session->set_flashdata('message','Member Inactivate Successfully!');
      $response['status'] = TRUE;
      header('Content-type: application/json');
      echo json_encode($response);
    }
    else
    {
      redirect(base_url('company/login'));
    }
  }

  public function open_work_new_assignee()
  {
    if(($this->session->userdata('d168_comp_id')) || ($this->session->userdata('d168_comp_id') != ""))
    {
      $this->form_validation->set_rules('new_open_work_assignee','New Assignee','trim|required'); 
      $this->form_validation->set_rules('old_open_work_assignee','Old Assignee','trim|required');  
      $this->form_validation->set_rules('get_cce_id_to_inactive','Member ID','trim|required');       
      if ($this->form_validation->run() == FALSE)
      {
          //$errors = array();

          $errors = $this->form_validation->error_array();
          // Loop through $_POST and get the keys
          foreach ($errors as $key => $value)
          {
            // Add the error message for this field
            $errors[$key] = form_error($key);
          }
        
          $response['errors'] = array_filter($errors); // Some might be empty
          $response['status'] = FALSE;
          // You can use the Output class here too
          header('Content-type: application/json');
          //echo json_encode($response);
          exit(json_encode($response));
      }
      else
      {
        $cce_id = $this->input->post('get_cce_id_to_inactive');
        $reg_id = $this->input->post('old_open_work_assignee');
        $new_reg_id = $this->input->post('new_open_work_assignee');
        $status = 'inactive';
        $check = $this->Company_model->getCompanyEmpDetail($cce_id);
        if($check)
        { 
          $powner = $this->Company_model->getStudentById($reg_id);
          $new_mem = $this->Company_model->getStudentById($new_reg_id);

          $getPortfolio = $this->Company_model->TMOpenPortfolio($reg_id);
          if($getPortfolio)
          {
            foreach($getPortfolio as $pp)
            {
              $portfolio_id = $pp->portfolio_id;
              $reg_id_sent_to = $powner->email_address;
              $new_reg_id_sent_to = $new_mem->email_address;

              $check_if_porttm = $this->Company_model->check_if_porttm($portfolio_id,$reg_id_sent_to);
              if($check_if_porttm)
              {
                $this->Company_model->delete_portfolio_member($portfolio_id,$reg_id_sent_to);
              }

              $check_if_nporttm = $this->Company_model->check_if_porttm($portfolio_id,$new_reg_id_sent_to);
              if($check_if_nporttm)
              {
                $data = array(
                        ' portfolio_createdby' => $new_reg_id,
                    );
                    $data = $this->security->xss_clean($data); // xss filter
                    $this->Company_model->updateProject_portfolio($data,$portfolio_id);

                $data2 = array(
                        'sent_from' => $new_reg_id,
                    );
                    $data2 = $this->security->xss_clean($data2); // xss filter
                    $this->Company_model->updateProject_portfolio_member($data2,$portfolio_id);
              }
              else
              {
                $data = array(
                                    'portfolio_id' => $portfolio_id,
                                    'sent_to' => $new_reg_id_sent_to,
                                    'sent_from' => $new_reg_id,
                                    'status' => 'accepted',
                                    'working_status' => 'active',
                                    'status_date' => date('Y-m-d H:i:s')
                                  );
                    $data = $this->security->xss_clean($data); // xss filter
                    $this->Company_model->insert_PortfolioMember($data);

                $data = array(
                        ' portfolio_createdby' => $new_reg_id,
                    );
                    $data = $this->security->xss_clean($data); // xss filter
                    $this->Company_model->updateProject_portfolio($data,$portfolio_id);

                $data2 = array(
                        'sent_from' => $new_reg_id,
                    );
                    $data2 = $this->security->xss_clean($data2); // xss filter
                    $this->Company_model->updateProject_portfolio_member($data2,$portfolio_id);
              }

              $getGoals = $this->Company_model->TMOpenGoals($reg_id,$portfolio_id);
              if($getGoals)
              {
                foreach($getGoals as $gg)
                {
                  if($gg->gcreated_by == $reg_id)
                  {
                    $check_if_goaltm = $this->Company_model->check_if_goaltm($gg->gid,$new_reg_id);
                    if($check_if_goaltm)
                    {
                      $this->Company_model->delete_gMember_mem_id($gg->gid,$new_reg_id);
                    }
                    $data = array(
                            'gcreated_by' => $new_reg_id,
                        );
                        $data = $this->security->xss_clean($data); // xss filter
                        $this->Company_model->editGoal($data,$gg->gid);
                    $hdata = array(
                                'gid' => $gg->gid,
                                'h_date ' => date('Y-m-d H:i:s'),
                                'h_resource_id' => $powner->reg_id,
                                'h_resource' => $powner->first_name.' '.$powner->last_name,
                                'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Goal '.$gg->gname.' Ownership to '.$new_mem->first_name.' '.$new_mem->last_name,
                            );
                      $hdata = $this->security->xss_clean($hdata); // xss filter
                      $this->Company_model->insert_ProjectHistory($hdata);

                      $data2 = array(
                          'gid' => $gg->gid,
                          'portfolio_id' => $portfolio_id,
                          'gmember' => $new_reg_id,
                          'status' => 'accepted',
                          'gcreated_by' => $new_reg_id,
                          'sent_date' => date('Y-m-d H:i:s'),
                          'sent_notify_clear' => 'yes',
                                            );
                      $data2 = $this->security->xss_clean($data2); // xss filter
                      $this->Company_model->insert_GoalTeamMember($data2);
                  }
                  if($gg->gmanager == $reg_id)
                  {
                    $data2 = array(
                                          'gmanager' => $new_reg_id,
                                      );
                    $data2 = $this->security->xss_clean($data2); // xss filter
                    $this->Company_model->editGoal($data2,$gg->gid);

                      $hdata = array(
                                'gid' => $gg->gid,
                                'h_date ' => date('Y-m-d H:i:s'),
                                'h_resource_id' => $powner->reg_id,
                                'h_resource' => $powner->first_name.' '.$powner->last_name,
                                'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Goal '.$gg->gname.' Manager to '.$new_mem->first_name.' '.$new_mem->last_name,
                            );
                      $hdata = $this->security->xss_clean($hdata); // xss filter
                      $this->Company_model->insert_ProjectHistory($hdata);
                  } 
                  //check if team member in any goal  
                  $check_tm = $this->Company_model->CheckOpenGoalTM($reg_id,$gg->gid);
                  if($check_tm) 
                  {
                    $this->Company_model->delete_gMember_mem_id($gg->gid,$reg_id);
                  } 
                }
              }

              $getGoalTM = $this->Company_model->getGoalOpenTM($reg_id,$portfolio_id);
              if($getGoalTM)
              {
                foreach($getGoalTM as $ggtm)
                {                
                  $check_if_already_goaltm = $this->Company_model->check_if_already_goaltm($new_reg_id,$portfolio_id,$ggtm->gid);
                  if($check_if_already_goaltm == 0)
                  {                  
                    $check_if_goalowner = $this->Company_model->check_if_goalowner($ggtm->gid,$new_reg_id);
                    if($check_if_goalowner == 0)
                    {
                      $data2 = array(
                        'gid' => $ggtm->gid,
                        'portfolio_id' => $ggtm->portfolio_id,
                        'gmember' => trim($new_reg_id),
                        'status' => $ggtm->status,
                        'gcreated_by' => $reg_id,
                        'sent_date' => date('Y-m-d H:i:s'),
                        'sent_notify_clear' => $ggtm->sent_notify_clear,
                                          );
                      $data2 = $this->security->xss_clean($data2); // xss filter
                      $this->Company_model->insert_GoalTeamMember($data2);

                      $hdata = array(
                                'gid' => $ggtm->gid,
                                'h_date ' => date('Y-m-d H:i:s'),
                                'h_resource_id' => $powner->reg_id,
                                'h_resource' => $powner->first_name.' '.$powner->last_name,
                                'h_description' =>  $powner->first_name.' '.$powner->last_name.' Added '.$new_mem->first_name.' '.$new_mem->last_name.' as a team member',
                            );
                      $hdata = $this->security->xss_clean($hdata); // xss filter
                      $this->Company_model->insert_ProjectHistory($hdata);
                    }                  
                  }
                  $this->Company_model->delete_gMember_with_port_id($reg_id,$portfolio_id);
                }
              }

              $getStrategies = $this->Company_model->TMOpenStrategies($reg_id,$portfolio_id);
              if($getStrategies)
              {
                foreach($getStrategies as $ggs)
                {
                  $data = array(
                          'screated_by' => $new_reg_id,
                      );
                      $data = $this->security->xss_clean($data); // xss filter
                      $this->Company_model->editStrategies($data,$ggs->sid);
                  $hdata = array(
                                'sid' => $ggs->sid,
                                'gid' => $ggs->gid,
                                'h_date ' => date('Y-m-d H:i:s'),
                                'h_resource_id' => $powner->reg_id,
                                'h_resource' => $powner->first_name.' '.$powner->last_name,
                                'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer KPI '.$ggs->sname.' Ownership to '.$new_mem->first_name.' '.$new_mem->last_name,
                            );
                      $hdata = $this->security->xss_clean($hdata); // xss filter
                      $this->Company_model->insert_ProjectHistory($hdata);
                }
              }

              $getProjects = $this->Company_model->TMOpenProjects($reg_id,$portfolio_id);
              if($getProjects)
              {
                foreach($getProjects as $gp)
                {
                  if($gp->pcreated_by == $reg_id)
                  {
                    $check_if_tm = $this->Company_model->check_if_tm($gp->pid,$new_reg_id);
                    if($check_if_tm)
                    {
                      $this->Company_model->delete_pMember_mem_id($gp->pid,$new_reg_id);
                    }
                    $data2 = array(
                                          'pcreated_by' => $new_reg_id,
                                      );
                    $data2 = $this->security->xss_clean($data2); // xss filter
                    $this->Company_model->edit_Project($data2,$gp->pid);

                      $get_gs_pid = $this->Company_model->getProjectById($gp->pid);
                      $hdata = array(
                                'pid' => $gp->pid,
                                'gid' => $get_gs_pid->gid,
                                'sid' => $get_gs_pid->sid,
                                'h_date ' => date('Y-m-d H:i:s'),
                                'h_resource_id' => $powner->reg_id,
                                'h_resource' => $powner->first_name.' '.$powner->last_name,
                                'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Project '.$gp->pname.' Ownership to '.$new_mem->first_name.' '.$new_mem->last_name,
                            );
                      $hdata = $this->security->xss_clean($hdata); // xss filter
                      $this->Company_model->insert_ProjectHistory($hdata);
                  }
                  if($gp->pmanager == $reg_id)
                  {
                    $data2 = array(
                                          'pmanager' => $new_reg_id,
                                      );
                    $data2 = $this->security->xss_clean($data2); // xss filter
                    $this->Company_model->edit_Project($data2,$gp->pid);

                      $get_gs_pid = $this->Company_model->getProjectById($gp->pid);
                      $hdata = array(
                                'pid' => $gp->pid,
                                'gid' => $get_gs_pid->gid,
                                'sid' => $get_gs_pid->sid,
                                'h_date ' => date('Y-m-d H:i:s'),
                                'h_resource_id' => $powner->reg_id,
                                'h_resource' => $powner->first_name.' '.$powner->last_name,
                                'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Project '.$gp->pname.' Manager to '.$new_mem->first_name.' '.$new_mem->last_name,
                            );
                      $hdata = $this->security->xss_clean($hdata); // xss filter
                      $this->Company_model->insert_ProjectHistory($hdata);
                  }   
                  //check if team member in any project  
                  $check_tm = $this->Company_model->CheckOpenTM($reg_id,$gp->pid);
                  if($check_tm) 
                  {
                    $this->Company_model->delete_pMember_mem_id($gp->pid,$reg_id);
                  }          
                }
              }

              $getProjectTM = $this->Company_model->getProjectOpenTM($reg_id,$portfolio_id);
              if($getProjectTM)
              {
                foreach($getProjectTM as $gtm)
                {                
                  $check_if_already_tm = $this->Company_model->check_if_already_tm($new_reg_id,$portfolio_id,$gtm->pid);
                  if($check_if_already_tm == 0)
                  {                  
                    $check_if_powner = $this->Company_model->check_if_powner($gtm->pid,$new_reg_id);
                    if($check_if_powner == 0)
                    {
                      $data2 = array(
                        'pid' => $gtm->pid,
                        'portfolio_id' => $gtm->portfolio_id,
                        'pmember' => trim($new_reg_id),
                        'status' => $gtm->status,
                        'pcreated_by' => $reg_id,
                        'sent_date' => date('Y-m-d H:i:s'),
                        'sent_notify_clear' => $gtm->sent_notify_clear,
                                          );
                      $data2 = $this->security->xss_clean($data2); // xss filter
                      $this->Company_model->insert_TeamMember($data2);

                      $get_gs_pid = $this->Company_model->getProjectById($gtm->pid);
                      $hdata = array(
                                'pid' => $gtm->pid,
                                'gid' => $get_gs_pid->gid,
                                'sid' => $get_gs_pid->sid,
                                'h_date ' => date('Y-m-d H:i:s'),
                                'h_resource_id' => $powner->reg_id,
                                'h_resource' => $powner->first_name.' '.$powner->last_name,
                                'h_description' =>  $powner->first_name.' '.$powner->last_name.' Added '.$new_mem->first_name.' '.$new_mem->last_name.' as a team member',
                            );
                      $hdata = $this->security->xss_clean($hdata); // xss filter
                      $this->Company_model->insert_ProjectHistory($hdata);
                    }                  
                  }
                  $this->Company_model->delete_pMember_with_port_id($reg_id,$portfolio_id);
                }
              }

              $getPlannedContent = $this->Company_model->TMOpenPlannedContent($reg_id,$portfolio_id);
              if($getPlannedContent)
              {
                foreach($getPlannedContent as $gpc)
                {
                  if($gpc->written_content_assignee == $reg_id)
                  {
                      $data = array(
                        'written_content_assignee' => $new_reg_id,
                        'pc_created_by' => $reg_id,
                      );

                    $data = $this->security->xss_clean($data); // xss filter
                    $this->Company_model->update_Content($data,$gpc->pc_id);
                    if(!empty($gpc->pc_project_assign))
                        {
                          $get_gs_pid = $this->Company_model->getProjectById($gpc->pc_project_assign);
                          $hdata = array( 
                                'pid' => $gpc->pc_project_assign,
                                'gid' => $get_gs_pid->gid,
                                'sid' => $get_gs_pid->sid,
                                'h_date ' => date('Y-m-d H:i:s'),
                                'h_resource_id' => $powner->reg_id,
                                'h_resource' => $powner->first_name.' '.$powner->last_name,
                                'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Written Content Assignee of platform '.$gpc->platform.' ( '.$gpc->pc_code.' ) to '.$new_mem->first_name.' '.$new_mem->last_name,
                                      );
                          $hdata = $this->security->xss_clean($hdata); // xss filter
                          $this->Company_model->insert_ProjectHistory($hdata);
                        }
                  }
                  if($gpc->pc_file_assignee == $reg_id)
                  {
                      $data = array(
                        'pc_file_assignee' => $new_reg_id,
                        'pc_created_by' => $reg_id,
                      );

                    $data = $this->security->xss_clean($data); // xss filter
                    $this->Company_model->update_Content($data,$gpc->pc_id);
                    if(!empty($gpc->pc_project_assign))
                        {
                          $get_gs_pid = $this->Company_model->getProjectById($gpc->pc_project_assign);
                          $hdata = array( 
                                'pid' => $gpc->pc_project_assign,
                                'gid' => $get_gs_pid->gid,
                                'sid' => $get_gs_pid->sid,
                                'h_date ' => date('Y-m-d H:i:s'),
                                'h_resource_id' => $powner->reg_id,
                                'h_resource' => $powner->first_name.' '.$powner->last_name,
                                'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Media File Assignee of platform '.$gpc->platform.' ( '.$gpc->pc_code.' ) to '.$new_mem->first_name.' '.$new_mem->last_name,
                                      );
                          $hdata = $this->security->xss_clean($hdata); // xss filter
                          $this->Company_model->insert_ProjectHistory($hdata);
                        }
                  }
                  if($gpc->submit_to_approval == $reg_id)
                  {
                      $data = array(
                        'submit_to_approval' => $new_reg_id,
                        'pc_created_by' => $reg_id,
                      );

                    $data = $this->security->xss_clean($data); // xss filter
                    $this->Company_model->update_Content($data,$gpc->pc_id);
                    if(!empty($gpc->pc_project_assign))
                        {
                          $get_gs_pid = $this->Company_model->getProjectById($gpc->pc_project_assign);
                          $hdata = array( 
                                'pid' => $gpc->pc_project_assign,
                                'gid' => $get_gs_pid->gid,
                                'sid' => $get_gs_pid->sid,
                                'h_date ' => date('Y-m-d H:i:s'),
                                'h_resource_id' => $powner->reg_id,
                                'h_resource' => $powner->first_name.' '.$powner->last_name,
                                'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Submit for Approval Assignee of platform '.$gpc->platform.' ( '.$gpc->pc_code.' ) to '.$new_mem->first_name.' '.$new_mem->last_name,
                                      );
                          $hdata = $this->security->xss_clean($hdata); // xss filter
                          $this->Company_model->insert_ProjectHistory($hdata);
                        }
                  }
                  if($gpc->pc_assignee == $reg_id)
                  {
                      $data = array(
                        'pc_assignee' => $new_reg_id,
                        'pc_created_by' => $reg_id,
                      );

                    $data = $this->security->xss_clean($data); // xss filter
                    $this->Company_model->update_Content($data,$gpc->pc_id);
                    if(!empty($gpc->pc_project_assign))
                        {
                          $get_gs_pid = $this->Company_model->getProjectById($gpc->pc_project_assign);
                          $hdata = array( 
                                'pid' => $gpc->pc_project_assign,
                                'gid' => $get_gs_pid->gid,
                                'sid' => $get_gs_pid->sid,
                                'h_date ' => date('Y-m-d H:i:s'),
                                'h_resource_id' => $powner->reg_id,
                                'h_resource' => $powner->first_name.' '.$powner->last_name,
                                'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Scheduler of platform '.$gpc->platform.' ( '.$gpc->pc_code.' ) to '.$new_mem->first_name.' '.$new_mem->last_name,
                                      );
                          $hdata = $this->security->xss_clean($hdata); // xss filter
                          $this->Company_model->insert_ProjectHistory($hdata);
                        }
                  }
                }
              }

              $getTasks = $this->Company_model->TMOpenTasks($reg_id,$portfolio_id);
              if($getTasks)
              {
                foreach($getTasks as $gt)
                {
                  $data = array(
                                          'tassignee' => $new_reg_id,
                                      );
                  $data = $this->security->xss_clean($data); // xss filter
                  $this->Company_model->update_OpenTask($data,$gt->tid,$reg_id);
                  $data1 = array(
                                          'tcreated_by' => $new_reg_id,
                                      );
                  $data1 = $this->security->xss_clean($data1); // xss filter
                  $this->Company_model->edit_NewTask($data1,$gt->tid);
                  $hdata = array(
                                'pid' => $gt->tproject_assign,
                                'gid' => $gt->gid,
                                'sid' => $gt->sid,
                                'h_date ' => date('Y-m-d H:i:s'),
                                'h_resource_id' => $powner->reg_id,
                                'h_resource' => $powner->first_name.' '.$powner->last_name,
                                'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Task '.$gt->tname.' ( '.$gt->tcode.' ) to '.$new_mem->first_name.' '.$new_mem->last_name,
                            );
                      $hdata = $this->security->xss_clean($hdata); // xss filter
                      $this->Company_model->insert_ProjectHistory($hdata);
                }
              }

              $getSubtasks = $this->Company_model->TMOpenSubtasks($reg_id,$portfolio_id);
              if($getSubtasks)
              {
                foreach($getSubtasks as $gs)
                {
                  $data = array(
                                          'stassignee' => $new_reg_id,
                                      );
                  $data = $this->security->xss_clean($data); // xss filter
                  $this->Company_model->update_OpenSubtask($data,$gs->stid,$reg_id);
                  $data1 = array(
                                          'stcreated_by' => $new_reg_id,
                                      );
                  $data1 = $this->security->xss_clean($data1); // xss filter
                  $this->Company_model->edit_NewSubtask($data1,$gs->stid);
                  $hdata = array(
                                'pid' => $gs->stproject_assign,
                                'gid' => $gs->gid,
                                'sid' => $gs->sid,
                                'h_date ' => date('Y-m-d H:i:s'),
                                'h_resource_id' => $powner->reg_id,
                                'h_resource' => $powner->first_name.' '.$powner->last_name,
                                'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Subtask '.$gs->stname.' ( '.$gs->stcode.' ) to '.$new_mem->first_name.' '.$new_mem->last_name,
                            );
                      $hdata = $this->security->xss_clean($hdata); // xss filter
                      $this->Company_model->insert_ProjectHistory($hdata);
                }
              }
            }
          }

          $reg_id_sent_to = $powner->email_address;
          $getPortfolio = $this->Company_model->TMOpenPortfolio2($reg_id_sent_to);
          if($getPortfolio)
          {
            foreach($getPortfolio as $pp)
            {
              $portfolio_id = $pp->portfolio_id;
              $this->Company_model->delete_portfolio_member($portfolio_id,$reg_id_sent_to);
            }
          }

          $getGoals = $this->Company_model->TMOpenGoals2($reg_id);
          if($getGoals)
          {
            foreach($getGoals as $gg)
            {
              if($gg->gcreated_by == $reg_id)
              {
                $check_if_goaltm = $this->Company_model->check_if_goaltm($gg->gid,$new_reg_id);
                if($check_if_goaltm)
                {
                  $this->Company_model->delete_gMember_mem_id($gg->gid,$new_reg_id);
                }
                $data = array(
                        'gcreated_by' => $new_reg_id,
                    );
                    $data = $this->security->xss_clean($data); // xss filter
                    $this->Company_model->editGoal($data,$gg->gid);
                $hdata = array(
                            'gid' => $gg->gid,
                            'h_date ' => date('Y-m-d H:i:s'),
                            'h_resource_id' => $powner->reg_id,
                            'h_resource' => $powner->first_name.' '.$powner->last_name,
                            'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Goal '.$gg->gname.' Ownership to '.$new_mem->first_name.' '.$new_mem->last_name,
                        );
                  $hdata = $this->security->xss_clean($hdata); // xss filter
                  $this->Company_model->insert_ProjectHistory($hdata);

                  $data2 = array(
                      'gid' => $gg->gid,
                      'portfolio_id' => $gg->portfolio_id,
                      'gmember' => $new_reg_id,
                      'status' => 'accepted',
                      'gcreated_by' => $new_reg_id,
                      'sent_date' => date('Y-m-d H:i:s'),
                      'sent_notify_clear' => 'yes',
                                        );
                  $data2 = $this->security->xss_clean($data2); // xss filter
                  $this->Company_model->insert_GoalTeamMember($data2);
              }
              if($gg->gmanager == $reg_id)
              {
                $data2 = array(
                                      'gmanager' => $new_reg_id,
                                  );
                $data2 = $this->security->xss_clean($data2); // xss filter
                $this->Company_model->editGoal($data2,$gg->gid);

                  $hdata = array(
                            'gid' => $gg->gid,
                            'h_date ' => date('Y-m-d H:i:s'),
                            'h_resource_id' => $powner->reg_id,
                            'h_resource' => $powner->first_name.' '.$powner->last_name,
                            'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Goal '.$gg->gname.' Manager to '.$new_mem->first_name.' '.$new_mem->last_name,
                        );
                  $hdata = $this->security->xss_clean($hdata); // xss filter
                  $this->Company_model->insert_ProjectHistory($hdata);
              } 
              //check if team member in any goal  
              $check_tm = $this->Company_model->CheckOpenGoalTM($reg_id,$gg->gid);
              if($check_tm) 
              {
                $this->Company_model->delete_gMember_mem_id($gg->gid,$reg_id);
              } 
            }
          }

          $getGoalTM = $this->Company_model->getGoalOpenTM2($reg_id);
          if($getGoalTM)
          {
            foreach($getGoalTM as $ggtm)
            {                
              $check_if_already_goaltm = $this->Company_model->check_if_already_goaltm($new_reg_id,$ggtm->portfolio_id,$ggtm->gid);
              if($check_if_already_goaltm == 0)
              {                  
                $check_if_goalowner = $this->Company_model->check_if_goalowner($ggtm->gid,$new_reg_id);
                if($check_if_goalowner == 0)
                {
                  $data2 = array(
                    'gid' => $ggtm->gid,
                    'portfolio_id' => $ggtm->portfolio_id,
                    'gmember' => trim($new_reg_id),
                    'status' => $ggtm->status,
                    'gcreated_by' => $reg_id,
                    'sent_date' => date('Y-m-d H:i:s'),
                    'sent_notify_clear' => $ggtm->sent_notify_clear,
                                      );
                  $data2 = $this->security->xss_clean($data2); // xss filter
                  $this->Company_model->insert_GoalTeamMember($data2);

                  $hdata = array(
                            'gid' => $ggtm->gid,
                            'h_date ' => date('Y-m-d H:i:s'),
                            'h_resource_id' => $powner->reg_id,
                            'h_resource' => $powner->first_name.' '.$powner->last_name,
                            'h_description' =>  $powner->first_name.' '.$powner->last_name.' Added '.$new_mem->first_name.' '.$new_mem->last_name.' as a team member',
                        );
                  $hdata = $this->security->xss_clean($hdata); // xss filter
                  $this->Company_model->insert_ProjectHistory($hdata);
                }                  
              }
              $this->Company_model->delete_gMember_with_port_id($reg_id,$ggtm->portfolio_id);
            }
          }

          $getStrategies = $this->Company_model->TMOpenStrategies2($reg_id);
          if($getStrategies)
          {
            foreach($getStrategies as $ggs)
            {
              $data = array(
                      'screated_by' => $new_reg_id,
                  );
                  $data = $this->security->xss_clean($data); // xss filter
                  $this->Company_model->editStrategies($data,$ggs->sid);
              $hdata = array(
                            'sid' => $ggs->sid,
                            'gid' => $ggs->gid,
                            'h_date ' => date('Y-m-d H:i:s'),
                            'h_resource_id' => $powner->reg_id,
                            'h_resource' => $powner->first_name.' '.$powner->last_name,
                            'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer KPI '.$ggs->sname.' Ownership to '.$new_mem->first_name.' '.$new_mem->last_name,
                        );
                  $hdata = $this->security->xss_clean($hdata); // xss filter
                  $this->Company_model->insert_ProjectHistory($hdata);
            }
          }

          $getProjects = $this->Company_model->TMOpenProjects2($reg_id);
          if($getProjects)
          {
            foreach($getProjects as $gp)
            {
              if($gp->pcreated_by == $reg_id)
              {
                $check_if_tm = $this->Company_model->check_if_tm($gp->pid,$new_reg_id);
                if($check_if_tm)
                {
                  $this->Company_model->delete_pMember_mem_id($gp->pid,$new_reg_id);
                }
                $data2 = array(
                                      'pcreated_by' => $new_reg_id,
                                  );
                $data2 = $this->security->xss_clean($data2); // xss filter
                $this->Company_model->edit_Project($data2,$gp->pid);

                  $get_gs_pid = $this->Company_model->getProjectById($gp->pid);
                  $hdata = array(
                            'pid' => $gp->pid,
                            'gid' => $get_gs_pid->gid,
                            'sid' => $get_gs_pid->sid,
                            'h_date ' => date('Y-m-d H:i:s'),
                            'h_resource_id' => $powner->reg_id,
                            'h_resource' => $powner->first_name.' '.$powner->last_name,
                            'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Project '.$gp->pname.' Ownership to '.$new_mem->first_name.' '.$new_mem->last_name,
                        );
                  $hdata = $this->security->xss_clean($hdata); // xss filter
                  $this->Company_model->insert_ProjectHistory($hdata);
              }
              if($gp->pmanager == $reg_id)
              {
                $data2 = array(
                                      'pmanager' => $new_reg_id,
                                  );
                $data2 = $this->security->xss_clean($data2); // xss filter
                $this->Company_model->edit_Project($data2,$gp->pid);

                  $get_gs_pid = $this->Company_model->getProjectById($gp->pid);
                  $hdata = array(
                            'pid' => $gp->pid,
                            'gid' => $get_gs_pid->gid,
                            'sid' => $get_gs_pid->sid,
                            'h_date ' => date('Y-m-d H:i:s'),
                            'h_resource_id' => $powner->reg_id,
                            'h_resource' => $powner->first_name.' '.$powner->last_name,
                            'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Project '.$gp->pname.' Manager to '.$new_mem->first_name.' '.$new_mem->last_name,
                        );
                  $hdata = $this->security->xss_clean($hdata); // xss filter
                  $this->Company_model->insert_ProjectHistory($hdata);
              }   
              //check if team member in any project  
              $check_tm = $this->Company_model->CheckOpenTM($reg_id,$gp->pid);
              if($check_tm) 
              {
                $this->Company_model->delete_pMember_mem_id($gp->pid,$reg_id);
              }          
            }
          }

          $getProjectTM = $this->Company_model->getProjectOpenTM2($reg_id);
          if($getProjectTM)
          {
            foreach($getProjectTM as $gtm)
            {                
              $check_if_already_tm = $this->Company_model->check_if_already_tm($new_reg_id,$gtm->portfolio_id,$gtm->pid);
              if($check_if_already_tm == 0)
              {                  
                $check_if_powner = $this->Company_model->check_if_powner($gtm->pid,$new_reg_id);
                if($check_if_powner == 0)
                {
                  $data2 = array(
                    'pid' => $gtm->pid,
                    'portfolio_id' => $gtm->portfolio_id,
                    'pmember' => trim($new_reg_id),
                    'status' => $gtm->status,
                    'pcreated_by' => $reg_id,
                    'sent_date' => date('Y-m-d H:i:s'),
                    'sent_notify_clear' => $gtm->sent_notify_clear,
                                      );
                  $data2 = $this->security->xss_clean($data2); // xss filter
                  $this->Company_model->insert_TeamMember($data2);

                  $get_gs_pid = $this->Company_model->getProjectById($gtm->pid);
                  $hdata = array(
                            'pid' => $gtm->pid,
                            'gid' => $get_gs_pid->gid,
                            'sid' => $get_gs_pid->sid,
                            'h_date ' => date('Y-m-d H:i:s'),
                            'h_resource_id' => $powner->reg_id,
                            'h_resource' => $powner->first_name.' '.$powner->last_name,
                            'h_description' =>  $powner->first_name.' '.$powner->last_name.' Added '.$new_mem->first_name.' '.$new_mem->last_name.' as a team member',
                        );
                  $hdata = $this->security->xss_clean($hdata); // xss filter
                  $this->Company_model->insert_ProjectHistory($hdata);
                }                  
              }
              $this->Company_model->delete_pMember_with_port_id($reg_id,$gtm->portfolio_id);
            }
          }

          $getPlannedContent = $this->Company_model->TMOpenPlannedContent2($reg_id);
          if($getPlannedContent)
          {
            foreach($getPlannedContent as $gpc)
            {
              if($gpc->written_content_assignee == $reg_id)
              {
                  $data = array(
                    'written_content_assignee' => $new_reg_id,
                    'pc_created_by' => $reg_id,
                  );

                $data = $this->security->xss_clean($data); // xss filter
                $this->Company_model->update_Content($data,$gpc->pc_id);
                if(!empty($gpc->pc_project_assign))
                    {
                      $get_gs_pid = $this->Company_model->getProjectById($gpc->pc_project_assign);
                      $hdata = array( 
                            'pid' => $gpc->pc_project_assign,
                            'gid' => $get_gs_pid->gid,
                            'sid' => $get_gs_pid->sid,
                            'h_date ' => date('Y-m-d H:i:s'),
                            'h_resource_id' => $powner->reg_id,
                            'h_resource' => $powner->first_name.' '.$powner->last_name,
                            'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Written Content Assignee of platform '.$gpc->platform.' ( '.$gpc->pc_code.' ) to '.$new_mem->first_name.' '.$new_mem->last_name,
                                  );
                      $hdata = $this->security->xss_clean($hdata); // xss filter
                      $this->Company_model->insert_ProjectHistory($hdata);
                    }
              }
              if($gpc->pc_file_assignee == $reg_id)
              {
                  $data = array(
                    'pc_file_assignee' => $new_reg_id,
                    'pc_created_by' => $reg_id,
                  );

                $data = $this->security->xss_clean($data); // xss filter
                $this->Company_model->update_Content($data,$gpc->pc_id);
                if(!empty($gpc->pc_project_assign))
                    {
                      $get_gs_pid = $this->Company_model->getProjectById($gpc->pc_project_assign);
                      $hdata = array( 
                            'pid' => $gpc->pc_project_assign,
                            'gid' => $get_gs_pid->gid,
                            'sid' => $get_gs_pid->sid,
                            'h_date ' => date('Y-m-d H:i:s'),
                            'h_resource_id' => $powner->reg_id,
                            'h_resource' => $powner->first_name.' '.$powner->last_name,
                            'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Media File Assignee of platform '.$gpc->platform.' ( '.$gpc->pc_code.' ) to '.$new_mem->first_name.' '.$new_mem->last_name,
                                  );
                      $hdata = $this->security->xss_clean($hdata); // xss filter
                      $this->Company_model->insert_ProjectHistory($hdata);
                    }
              }
              if($gpc->submit_to_approval == $reg_id)
              {
                  $data = array(
                    'submit_to_approval' => $new_reg_id,
                    'pc_created_by' => $reg_id,
                  );

                $data = $this->security->xss_clean($data); // xss filter
                $this->Company_model->update_Content($data,$gpc->pc_id);
                if(!empty($gpc->pc_project_assign))
                    {
                      $get_gs_pid = $this->Company_model->getProjectById($gpc->pc_project_assign);
                      $hdata = array( 
                            'pid' => $gpc->pc_project_assign,
                            'gid' => $get_gs_pid->gid,
                            'sid' => $get_gs_pid->sid,
                            'h_date ' => date('Y-m-d H:i:s'),
                            'h_resource_id' => $powner->reg_id,
                            'h_resource' => $powner->first_name.' '.$powner->last_name,
                            'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Submit for Approval Assignee of platform '.$gpc->platform.' ( '.$gpc->pc_code.' ) to '.$new_mem->first_name.' '.$new_mem->last_name,
                                  );
                      $hdata = $this->security->xss_clean($hdata); // xss filter
                      $this->Company_model->insert_ProjectHistory($hdata);
                    }
              }
              if($gpc->pc_assignee == $reg_id)
              {
                  $data = array(
                    'pc_assignee' => $new_reg_id,
                    'pc_created_by' => $reg_id,
                  );

                $data = $this->security->xss_clean($data); // xss filter
                $this->Company_model->update_Content($data,$gpc->pc_id);
                if(!empty($gpc->pc_project_assign))
                    {
                      $get_gs_pid = $this->Company_model->getProjectById($gpc->pc_project_assign);
                      $hdata = array( 
                            'pid' => $gpc->pc_project_assign,
                            'gid' => $get_gs_pid->gid,
                            'sid' => $get_gs_pid->sid,
                            'h_date ' => date('Y-m-d H:i:s'),
                            'h_resource_id' => $powner->reg_id,
                            'h_resource' => $powner->first_name.' '.$powner->last_name,
                            'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Scheduler of platform '.$gpc->platform.' ( '.$gpc->pc_code.' ) to '.$new_mem->first_name.' '.$new_mem->last_name,
                                  );
                      $hdata = $this->security->xss_clean($hdata); // xss filter
                      $this->Company_model->insert_ProjectHistory($hdata);
                    }
              }
            }
          }

          $getTasks = $this->Company_model->TMOpenTasks2($reg_id);
          if($getTasks)
          {
            foreach($getTasks as $gt)
            {
              $data = array(
                                      'tassignee' => $new_reg_id,
                                  );
              $data = $this->security->xss_clean($data); // xss filter
              $this->Company_model->update_OpenTask($data,$gt->tid,$reg_id);
              $data1 = array(
                                      'tcreated_by' => $new_reg_id,
                                  );
              $data1 = $this->security->xss_clean($data1); // xss filter
              $this->Company_model->edit_NewTask($data1,$gt->tid);
              $hdata = array(
                            'pid' => $gt->tproject_assign,
                            'gid' => $gt->gid,
                            'sid' => $gt->sid,
                            'h_date ' => date('Y-m-d H:i:s'),
                            'h_resource_id' => $powner->reg_id,
                            'h_resource' => $powner->first_name.' '.$powner->last_name,
                            'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Task '.$gt->tname.' ( '.$gt->tcode.' ) to '.$new_mem->first_name.' '.$new_mem->last_name,
                        );
                  $hdata = $this->security->xss_clean($hdata); // xss filter
                  $this->Company_model->insert_ProjectHistory($hdata);
            }
          }

          $getSubtasks = $this->Company_model->TMOpenSubtasks2($reg_id);
          if($getSubtasks)
          {
            foreach($getSubtasks as $gs)
            {
              $data = array(
                                      'stassignee' => $new_reg_id,
                                  );
              $data = $this->security->xss_clean($data); // xss filter
              $this->Company_model->update_OpenSubtask($data,$gs->stid,$reg_id);
              $data1 = array(
                                      'stcreated_by' => $new_reg_id,
                                  );
              $data1 = $this->security->xss_clean($data1); // xss filter
              $this->Company_model->edit_NewSubtask($data1,$gs->stid);
              $hdata = array(
                            'pid' => $gs->stproject_assign,
                            'gid' => $gs->gid,
                            'sid' => $gs->sid,
                            'h_date ' => date('Y-m-d H:i:s'),
                            'h_resource_id' => $powner->reg_id,
                            'h_resource' => $powner->first_name.' '.$powner->last_name,
                            'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Subtask '.$gs->stname.' ( '.$gs->stcode.' ) to '.$new_mem->first_name.' '.$new_mem->last_name,
                        );
                  $hdata = $this->security->xss_clean($hdata); // xss filter
                  $this->Company_model->insert_ProjectHistory($hdata);
            }
          }        

          $inData = array(
                    'emp_status' => $status,
                  );
          $inData = $this->security->xss_clean($inData); // xss filter
          $this->Company_model->update_contacted_company_emp($inData,$cce_id);

          $this->session->set_flashdata('message','Member Inactivate Successfully!');
          $response['status'] = TRUE;
          header('Content-type: application/json');
          echo json_encode($response);
        }
      }
    }
    else
    {
      redirect(base_url('company/login'));
    }
  }

  public function delete_emp()
  {
    if(($this->session->userdata('d168_comp_id')) || ($this->session->userdata('d168_comp_id') != ""))
    {
      $id = $this->input->post('id');
      $status = $this->input->post('status');

      $getEmp = $this->Company_model->getCompanyEmpDetail($id);
      $pm = $this->Company_model->getStudentByEmailId($getEmp->emp_email);
      $data['mem_detail'] = $pm;
      $data['cce_id'] = $id;
      if($pm)
      {
        $reg_id = $pm->reg_id;
        $portfolio_count = 0;
        $goal_count = 0;
        $goal_tm_count = 0;
        $strategies_count = 0;
        $pro_count = 0;
        $plan_count = 0;
        $task_count = 0;
        $subtask_count = 0;
        $pro_tm_count = 0;

        $getPortfolio = $this->Company_model->TMOpenPortfolio($reg_id);
        if($getPortfolio)
        {
          foreach($getPortfolio as $pp)
          {
            $portfolio_count++;

            $portfolio_id = $pp->portfolio_id;

            $getGoals = $this->Company_model->TMOpenGoals($reg_id,$portfolio_id);
            if($getGoals)
            {
              foreach($getGoals as $gg)
              {
                $goal_count++;
              }
            }
            $getGoalTM = $this->Company_model->getGoalOpenTM($reg_id,$portfolio_id);
            if($getGoalTM)
            {
              foreach($getGoalTM as $ggtm)
              {
                $goal_tm_count++;
              }
            }
            $getStrategies = $this->Company_model->TMOpenStrategies($reg_id,$portfolio_id);
            if($getStrategies)
            {
              foreach($getStrategies as $ggs)
              {
                $strategies_count++;
              }
            }
            $getProjects = $this->Company_model->TMOpenProjects($reg_id,$portfolio_id);
            if($getProjects)
            {
              foreach($getProjects as $gp)
              {
                $pro_count++;
              }
            }
            $getPlannedContent = $this->Company_model->TMOpenPlannedContent($reg_id,$portfolio_id);
            if($getPlannedContent)
            {
              foreach($getPlannedContent as $gpc)
              {
                $plan_count++;
              }
            }
            $getTasks = $this->Company_model->TMOpenTasks($reg_id,$portfolio_id);
            if($getTasks)
            {
              foreach($getTasks as $gt)
              {
                $task_count++;
              }
            }
            $getSubtasks = $this->Company_model->TMOpenSubtasks($reg_id,$portfolio_id);
            if($getSubtasks)
            {
              foreach($getSubtasks as $gs)
              {
                $subtask_count++;
              }
            }
            $getProjectTM = $this->Company_model->getProjectOpenTM($reg_id,$portfolio_id);
            if($getProjectTM)
            {
              foreach($getProjectTM as $gtm)
              {
                $pro_tm_count++;
              }
            }
          }
        }

        $reg_id_sent_to = $getEmp->emp_email;
        $getPortfolio = $this->Company_model->TMOpenPortfolio2($reg_id_sent_to);
        if($getPortfolio)
        {
          foreach($getPortfolio as $pp)
          {
            $portfolio_count++;
          }
        }

        $getGoals = $this->Company_model->TMOpenGoals2($reg_id);
        if($getGoals)
        {
          foreach($getGoals as $gg)
          {
            $goal_count++;
          }
        }
        $getGoalTM = $this->Company_model->getGoalOpenTM2($reg_id);
        if($getGoalTM)
        {
          foreach($getGoalTM as $ggtm)
          {
            $goal_tm_count++;
          }
        }
        $getStrategies = $this->Company_model->TMOpenStrategies2($reg_id);
        if($getStrategies)
        {
          foreach($getStrategies as $ggs)
          {
            $strategies_count++;
          }
        }
        $getProjects = $this->Company_model->TMOpenProjects2($reg_id);
        if($getProjects)
        {
          foreach($getProjects as $gp)
          {
            $pro_count++;
          }
        }
        $getPlannedContent = $this->Company_model->TMOpenPlannedContent2($reg_id);
        if($getPlannedContent)
        {
          foreach($getPlannedContent as $gpc)
          {
            $plan_count++;
          }
        }
        $getTasks = $this->Company_model->TMOpenTasks2($reg_id);
        if($getTasks)
        {
          foreach($getTasks as $gt)
          {
            $task_count++;
          }
        }
        $getSubtasks = $this->Company_model->TMOpenSubtasks2($reg_id);
        if($getSubtasks)
        {
          foreach($getSubtasks as $gs)
          {
            $subtask_count++;
          }
        }
        $getProjectTM = $this->Company_model->getProjectOpenTM2($reg_id);
        if($getProjectTM)
        {
          foreach($getProjectTM as $gtm)
          {
            $pro_tm_count++;
          }
        }          

        if(($portfolio_count == 0) && ($goal_count == 0) && ($strategies_count == 0) && ($pro_count == 0) && ($task_count == 0) && ($subtask_count == 0) && ($plan_count == 0) && ($pro_tm_count == 0) && ($goal_tm_count == 0))
        {              
          $this->Company_model->delete_contacted_company_emp($id);

          $data = array(  
                          'stripe_cus_id' => $pm->stripe_cus_id,
                          'reg_id' => $pm->reg_id,
                          'first_name' => $pm->first_name,
                          'middle_name' => $pm->middle_name,
                          'last_name' => $pm->last_name,
                          'email_address' => $pm->email_address,
                          'phone_number' => $pm->phone_number,
                          'deleted_date' => date('Y-m-d H:i:s'),
                          'used_corporate_id' => $pm->used_corporate_id
                       );
          $data = $this->security->xss_clean($data); // xss filter
          $this->Company_model->insertDeletedRegistration($data);

          $this->Company_model->delete_registration($reg_id);

          $this->session->set_flashdata('message','Member Deleted Successfully!');
          $response['status'] = TRUE;
          header('Content-type: application/json');
          echo json_encode($response);
        }
        else
        {          
          $data['portfolio_count'] = $portfolio_count;
          $data['goal_count'] = $goal_count;
          $data['goal_tm_count'] = $goal_tm_count;
          $data['strategies_count'] = $strategies_count;
          $data['pro_count'] = $pro_count;
          $data['plan_count'] = $plan_count;
          $data['task_count'] = $task_count;
          $data['subtask_count'] = $subtask_count;
          $data['pro_tm_count'] = $pro_tm_count;

          $this->load->view('company_view/assign-open-work-del',$data);           
        }            
      }  
    }
    else
    {
      redirect(base_url('company/login'));
    }
  }

  public function open_work_new_assignee_del()
  {
    if(($this->session->userdata('d168_comp_id')) || ($this->session->userdata('d168_comp_id') != ""))
    {
      $this->form_validation->set_rules('new_open_work_assignee_del','New Assignee','trim|required'); 
      $this->form_validation->set_rules('old_open_work_assignee_del','Old Assignee','trim|required');  
      $this->form_validation->set_rules('get_cce_id_to_inactive_del','Member ID','trim|required');       
      if ($this->form_validation->run() == FALSE)
      {
          $errors = $this->form_validation->error_array();
          // Loop through $_POST and get the keys
          foreach ($errors as $key => $value)
          {
            // Add the error message for this field
            $errors[$key] = form_error($key);
          }
        
          $response['errors'] = array_filter($errors); // Some might be empty
          $response['status'] = FALSE;
          // You can use the Output class here too
          header('Content-type: application/json');
          //echo json_encode($response);
          exit(json_encode($response));
      }
      else
      {
        $cce_id = $this->input->post('get_cce_id_to_inactive_del');
        $reg_id = $this->input->post('old_open_work_assignee_del');
        $new_reg_id = $this->input->post('new_open_work_assignee_del');
        
        $check = $this->Company_model->getCompanyEmpDetail($cce_id);
        if($check)
        { 
          $powner = $this->Company_model->getStudentById($reg_id);
          $new_mem = $this->Company_model->getStudentById($new_reg_id);

          $getPortfolio = $this->Company_model->TMOpenPortfolio($reg_id);
          if($getPortfolio)
          {
            foreach($getPortfolio as $pp)
            {
              $portfolio_id = $pp->portfolio_id;
              $reg_id_sent_to = $powner->email_address;
              $new_reg_id_sent_to = $new_mem->email_address;

              $check_if_porttm = $this->Company_model->check_if_porttm($portfolio_id,$reg_id_sent_to);
              if($check_if_porttm)
              {
                $this->Company_model->delete_portfolio_member($portfolio_id,$reg_id_sent_to);
              }

              $check_if_nporttm = $this->Company_model->check_if_porttm($portfolio_id,$new_reg_id_sent_to);
              if($check_if_nporttm)
              {
                $data = array(
                        ' portfolio_createdby' => $new_reg_id,
                    );
                    $data = $this->security->xss_clean($data); // xss filter
                    $this->Company_model->updateProject_portfolio($data,$portfolio_id);

                $data2 = array(
                        'sent_from' => $new_reg_id,
                    );
                    $data2 = $this->security->xss_clean($data2); // xss filter
                    $this->Company_model->updateProject_portfolio_member($data2,$portfolio_id);
              }
              else
              {
                $data = array(
                                    'portfolio_id' => $portfolio_id,
                                    'sent_to' => $new_reg_id_sent_to,
                                    'sent_from' => $new_reg_id,
                                    'status' => 'accepted',
                                    'working_status' => 'active',
                                    'status_date' => date('Y-m-d H:i:s')
                                  );
                    $data = $this->security->xss_clean($data); // xss filter
                    $this->Company_model->insert_PortfolioMember($data);

                $data = array(
                        ' portfolio_createdby' => $new_reg_id,
                    );
                    $data = $this->security->xss_clean($data); // xss filter
                    $this->Company_model->updateProject_portfolio($data,$portfolio_id);

                $data2 = array(
                        'sent_from' => $new_reg_id,
                    );
                    $data2 = $this->security->xss_clean($data2); // xss filter
                    $this->Company_model->updateProject_portfolio_member($data2,$portfolio_id);
              }

              $getGoals = $this->Company_model->TMOpenGoals($reg_id,$portfolio_id);
              if($getGoals)
              {
                foreach($getGoals as $gg)
                {
                  if($gg->gcreated_by == $reg_id)
                  {
                    $check_if_goaltm = $this->Company_model->check_if_goaltm($gg->gid,$new_reg_id);
                    if($check_if_goaltm)
                    {
                      $this->Company_model->delete_gMember_mem_id($gg->gid,$new_reg_id);
                    }
                    $data = array(
                            'gcreated_by' => $new_reg_id,
                        );
                        $data = $this->security->xss_clean($data); // xss filter
                        $this->Company_model->editGoal($data,$gg->gid);
                    $hdata = array(
                                'gid' => $gg->gid,
                                'h_date ' => date('Y-m-d H:i:s'),
                                'h_resource_id' => $powner->reg_id,
                                'h_resource' => $powner->first_name.' '.$powner->last_name,
                                'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Goal '.$gg->gname.' Ownership to '.$new_mem->first_name.' '.$new_mem->last_name,
                            );
                      $hdata = $this->security->xss_clean($hdata); // xss filter
                      $this->Company_model->insert_ProjectHistory($hdata);

                      $data2 = array(
                          'gid' => $gg->gid,
                          'portfolio_id' => $portfolio_id,
                          'gmember' => $new_reg_id,
                          'status' => 'accepted',
                          'gcreated_by' => $new_reg_id,
                          'sent_date' => date('Y-m-d H:i:s'),
                          'sent_notify_clear' => 'yes',
                                            );
                      $data2 = $this->security->xss_clean($data2); // xss filter
                      $this->Company_model->insert_GoalTeamMember($data2);
                  }
                  if($gg->gmanager == $reg_id)
                  {
                    $data2 = array(
                                          'gmanager' => $new_reg_id,
                                      );
                    $data2 = $this->security->xss_clean($data2); // xss filter
                    $this->Company_model->editGoal($data2,$gg->gid);

                      $hdata = array(
                                'gid' => $gg->gid,
                                'h_date ' => date('Y-m-d H:i:s'),
                                'h_resource_id' => $powner->reg_id,
                                'h_resource' => $powner->first_name.' '.$powner->last_name,
                                'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Goal '.$gg->gname.' Manager to '.$new_mem->first_name.' '.$new_mem->last_name,
                            );
                      $hdata = $this->security->xss_clean($hdata); // xss filter
                      $this->Company_model->insert_ProjectHistory($hdata);
                  } 
                  //check if team member in any goal  
                  $check_tm = $this->Company_model->CheckOpenGoalTM($reg_id,$gg->gid);
                  if($check_tm) 
                  {
                    $this->Company_model->delete_gMember_mem_id($gg->gid,$reg_id);
                  } 
                }
              }

              $getGoalTM = $this->Company_model->getGoalOpenTM($reg_id,$portfolio_id);
              if($getGoalTM)
              {
                foreach($getGoalTM as $ggtm)
                {                
                  $check_if_already_goaltm = $this->Company_model->check_if_already_goaltm($new_reg_id,$portfolio_id,$ggtm->gid);
                  if($check_if_already_goaltm == 0)
                  {                  
                    $check_if_goalowner = $this->Company_model->check_if_goalowner($ggtm->gid,$new_reg_id);
                    if($check_if_goalowner == 0)
                    {
                      $data2 = array(
                        'gid' => $ggtm->gid,
                        'portfolio_id' => $ggtm->portfolio_id,
                        'gmember' => trim($new_reg_id),
                        'status' => $ggtm->status,
                        'gcreated_by' => $reg_id,
                        'sent_date' => date('Y-m-d H:i:s'),
                        'sent_notify_clear' => $ggtm->sent_notify_clear,
                                          );
                      $data2 = $this->security->xss_clean($data2); // xss filter
                      $this->Company_model->insert_GoalTeamMember($data2);

                      $hdata = array(
                                'gid' => $ggtm->gid,
                                'h_date ' => date('Y-m-d H:i:s'),
                                'h_resource_id' => $powner->reg_id,
                                'h_resource' => $powner->first_name.' '.$powner->last_name,
                                'h_description' =>  $powner->first_name.' '.$powner->last_name.' Added '.$new_mem->first_name.' '.$new_mem->last_name.' as a team member',
                            );
                      $hdata = $this->security->xss_clean($hdata); // xss filter
                      $this->Company_model->insert_ProjectHistory($hdata);
                    }                  
                  }
                  $this->Company_model->delete_gMember_with_port_id($reg_id,$portfolio_id);
                }
              }

              $getStrategies = $this->Company_model->TMOpenStrategies($reg_id,$portfolio_id);
              if($getStrategies)
              {
                foreach($getStrategies as $ggs)
                {
                  $data = array(
                          'screated_by' => $new_reg_id,
                      );
                      $data = $this->security->xss_clean($data); // xss filter
                      $this->Company_model->editStrategies($data,$ggs->sid);
                  $hdata = array(
                                'sid' => $ggs->sid,
                                'gid' => $ggs->gid,
                                'h_date ' => date('Y-m-d H:i:s'),
                                'h_resource_id' => $powner->reg_id,
                                'h_resource' => $powner->first_name.' '.$powner->last_name,
                                'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer KPI '.$ggs->sname.' Ownership to '.$new_mem->first_name.' '.$new_mem->last_name,
                            );
                      $hdata = $this->security->xss_clean($hdata); // xss filter
                      $this->Company_model->insert_ProjectHistory($hdata);
                }
              }

              $getProjects = $this->Company_model->TMOpenProjects($reg_id,$portfolio_id);
              if($getProjects)
              {
                foreach($getProjects as $gp)
                {
                  if($gp->pcreated_by == $reg_id)
                  {
                    $check_if_tm = $this->Company_model->check_if_tm($gp->pid,$new_reg_id);
                    if($check_if_tm)
                    {
                      $this->Company_model->delete_pMember_mem_id($gp->pid,$new_reg_id);
                    }
                    $data2 = array(
                                          'pcreated_by' => $new_reg_id,
                                      );
                    $data2 = $this->security->xss_clean($data2); // xss filter
                    $this->Company_model->edit_Project($data2,$gp->pid);

                      $get_gs_pid = $this->Company_model->getProjectById($gp->pid);
                      $hdata = array(
                                'pid' => $gp->pid,
                                'gid' => $get_gs_pid->gid,
                                'sid' => $get_gs_pid->sid,
                                'h_date ' => date('Y-m-d H:i:s'),
                                'h_resource_id' => $powner->reg_id,
                                'h_resource' => $powner->first_name.' '.$powner->last_name,
                                'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Project '.$gp->pname.' Ownership to '.$new_mem->first_name.' '.$new_mem->last_name,
                            );
                      $hdata = $this->security->xss_clean($hdata); // xss filter
                      $this->Company_model->insert_ProjectHistory($hdata);
                  }
                  if($gp->pmanager == $reg_id)
                  {
                    $data2 = array(
                                          'pmanager' => $new_reg_id,
                                      );
                    $data2 = $this->security->xss_clean($data2); // xss filter
                    $this->Company_model->edit_Project($data2,$gp->pid);

                      $get_gs_pid = $this->Company_model->getProjectById($gp->pid);
                      $hdata = array(
                                'pid' => $gp->pid,
                                'gid' => $get_gs_pid->gid,
                                'sid' => $get_gs_pid->sid,
                                'h_date ' => date('Y-m-d H:i:s'),
                                'h_resource_id' => $powner->reg_id,
                                'h_resource' => $powner->first_name.' '.$powner->last_name,
                                'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Project '.$gp->pname.' Manager to '.$new_mem->first_name.' '.$new_mem->last_name,
                            );
                      $hdata = $this->security->xss_clean($hdata); // xss filter
                      $this->Company_model->insert_ProjectHistory($hdata);
                  }   
                  //check if team member in any project  
                  $check_tm = $this->Company_model->CheckOpenTM($reg_id,$gp->pid);
                  if($check_tm) 
                  {
                    $this->Company_model->delete_pMember_mem_id($gp->pid,$reg_id);
                  }          
                }
              }

              $getProjectTM = $this->Company_model->getProjectOpenTM($reg_id,$portfolio_id);
              if($getProjectTM)
              {
                foreach($getProjectTM as $gtm)
                {                
                  $check_if_already_tm = $this->Company_model->check_if_already_tm($new_reg_id,$portfolio_id,$gtm->pid);
                  if($check_if_already_tm == 0)
                  {                  
                    $check_if_powner = $this->Company_model->check_if_powner($gtm->pid,$new_reg_id);
                    if($check_if_powner == 0)
                    {
                      $data2 = array(
                        'pid' => $gtm->pid,
                        'portfolio_id' => $gtm->portfolio_id,
                        'pmember' => trim($new_reg_id),
                        'status' => $gtm->status,
                        'pcreated_by' => $reg_id,
                        'sent_date' => date('Y-m-d H:i:s'),
                        'sent_notify_clear' => $gtm->sent_notify_clear,
                                          );
                      $data2 = $this->security->xss_clean($data2); // xss filter
                      $this->Company_model->insert_TeamMember($data2);

                      $get_gs_pid = $this->Company_model->getProjectById($gtm->pid);
                      $hdata = array(
                                'pid' => $gtm->pid,
                                'gid' => $get_gs_pid->gid,
                                'sid' => $get_gs_pid->sid,
                                'h_date ' => date('Y-m-d H:i:s'),
                                'h_resource_id' => $powner->reg_id,
                                'h_resource' => $powner->first_name.' '.$powner->last_name,
                                'h_description' =>  $powner->first_name.' '.$powner->last_name.' Added '.$new_mem->first_name.' '.$new_mem->last_name.' as a team member',
                            );
                      $hdata = $this->security->xss_clean($hdata); // xss filter
                      $this->Company_model->insert_ProjectHistory($hdata);
                    }                  
                  }
                  $this->Company_model->delete_pMember_with_port_id($reg_id,$portfolio_id);
                }
              }

              $getPlannedContent = $this->Company_model->TMOpenPlannedContent($reg_id,$portfolio_id);
              if($getPlannedContent)
              {
                foreach($getPlannedContent as $gpc)
                {
                  if($gpc->written_content_assignee == $reg_id)
                  {
                      $data = array(
                        'written_content_assignee' => $new_reg_id,
                        'pc_created_by' => $reg_id,
                      );

                    $data = $this->security->xss_clean($data); // xss filter
                    $this->Company_model->update_Content($data,$gpc->pc_id);
                    if(!empty($gpc->pc_project_assign))
                        {
                          $get_gs_pid = $this->Company_model->getProjectById($gpc->pc_project_assign);
                          $hdata = array( 
                                'pid' => $gpc->pc_project_assign,
                                'gid' => $get_gs_pid->gid,
                                'sid' => $get_gs_pid->sid,
                                'h_date ' => date('Y-m-d H:i:s'),
                                'h_resource_id' => $powner->reg_id,
                                'h_resource' => $powner->first_name.' '.$powner->last_name,
                                'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Written Content Assignee of platform '.$gpc->platform.' ( '.$gpc->pc_code.' ) to '.$new_mem->first_name.' '.$new_mem->last_name,
                                      );
                          $hdata = $this->security->xss_clean($hdata); // xss filter
                          $this->Company_model->insert_ProjectHistory($hdata);
                        }
                  }
                  if($gpc->pc_file_assignee == $reg_id)
                  {
                      $data = array(
                        'pc_file_assignee' => $new_reg_id,
                        'pc_created_by' => $reg_id,
                      );

                    $data = $this->security->xss_clean($data); // xss filter
                    $this->Company_model->update_Content($data,$gpc->pc_id);
                    if(!empty($gpc->pc_project_assign))
                        {
                          $get_gs_pid = $this->Company_model->getProjectById($gpc->pc_project_assign);
                          $hdata = array( 
                                'pid' => $gpc->pc_project_assign,
                                'gid' => $get_gs_pid->gid,
                                'sid' => $get_gs_pid->sid,
                                'h_date ' => date('Y-m-d H:i:s'),
                                'h_resource_id' => $powner->reg_id,
                                'h_resource' => $powner->first_name.' '.$powner->last_name,
                                'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Media File Assignee of platform '.$gpc->platform.' ( '.$gpc->pc_code.' ) to '.$new_mem->first_name.' '.$new_mem->last_name,
                                      );
                          $hdata = $this->security->xss_clean($hdata); // xss filter
                          $this->Company_model->insert_ProjectHistory($hdata);
                        }
                  }
                  if($gpc->submit_to_approval == $reg_id)
                  {
                      $data = array(
                        'submit_to_approval' => $new_reg_id,
                        'pc_created_by' => $reg_id,
                      );

                    $data = $this->security->xss_clean($data); // xss filter
                    $this->Company_model->update_Content($data,$gpc->pc_id);
                    if(!empty($gpc->pc_project_assign))
                        {
                          $get_gs_pid = $this->Company_model->getProjectById($gpc->pc_project_assign);
                          $hdata = array( 
                                'pid' => $gpc->pc_project_assign,
                                'gid' => $get_gs_pid->gid,
                                'sid' => $get_gs_pid->sid,
                                'h_date ' => date('Y-m-d H:i:s'),
                                'h_resource_id' => $powner->reg_id,
                                'h_resource' => $powner->first_name.' '.$powner->last_name,
                                'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Submit for Approval Assignee of platform '.$gpc->platform.' ( '.$gpc->pc_code.' ) to '.$new_mem->first_name.' '.$new_mem->last_name,
                                      );
                          $hdata = $this->security->xss_clean($hdata); // xss filter
                          $this->Company_model->insert_ProjectHistory($hdata);
                        }
                  }
                  if($gpc->pc_assignee == $reg_id)
                  {
                      $data = array(
                        'pc_assignee' => $new_reg_id,
                        'pc_created_by' => $reg_id,
                      );

                    $data = $this->security->xss_clean($data); // xss filter
                    $this->Company_model->update_Content($data,$gpc->pc_id);
                    if(!empty($gpc->pc_project_assign))
                        {
                          $get_gs_pid = $this->Company_model->getProjectById($gpc->pc_project_assign);
                          $hdata = array( 
                                'pid' => $gpc->pc_project_assign,
                                'gid' => $get_gs_pid->gid,
                                'sid' => $get_gs_pid->sid,
                                'h_date ' => date('Y-m-d H:i:s'),
                                'h_resource_id' => $powner->reg_id,
                                'h_resource' => $powner->first_name.' '.$powner->last_name,
                                'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Scheduler of platform '.$gpc->platform.' ( '.$gpc->pc_code.' ) to '.$new_mem->first_name.' '.$new_mem->last_name,
                                      );
                          $hdata = $this->security->xss_clean($hdata); // xss filter
                          $this->Company_model->insert_ProjectHistory($hdata);
                        }
                  }
                }
              }

              $getTasks = $this->Company_model->TMOpenTasks($reg_id,$portfolio_id);
              if($getTasks)
              {
                foreach($getTasks as $gt)
                {
                  $data = array(
                                          'tassignee' => $new_reg_id,
                                      );
                  $data = $this->security->xss_clean($data); // xss filter
                  $this->Company_model->update_OpenTask($data,$gt->tid,$reg_id);
                  $data1 = array(
                                          'tcreated_by' => $new_reg_id,
                                      );
                  $data1 = $this->security->xss_clean($data1); // xss filter
                  $this->Company_model->edit_NewTask($data1,$gt->tid);
                  $hdata = array(
                                'pid' => $gt->tproject_assign,
                                'gid' => $gt->gid,
                                'sid' => $gt->sid,
                                'h_date ' => date('Y-m-d H:i:s'),
                                'h_resource_id' => $powner->reg_id,
                                'h_resource' => $powner->first_name.' '.$powner->last_name,
                                'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Task '.$gt->tname.' ( '.$gt->tcode.' ) to '.$new_mem->first_name.' '.$new_mem->last_name,
                            );
                      $hdata = $this->security->xss_clean($hdata); // xss filter
                      $this->Company_model->insert_ProjectHistory($hdata);
                }
              }

              $getSubtasks = $this->Company_model->TMOpenSubtasks($reg_id,$portfolio_id);
              if($getSubtasks)
              {
                foreach($getSubtasks as $gs)
                {
                  $data = array(
                                          'stassignee' => $new_reg_id,
                                      );
                  $data = $this->security->xss_clean($data); // xss filter
                  $this->Company_model->update_OpenSubtask($data,$gs->stid,$reg_id);
                  $data1 = array(
                                          'stcreated_by' => $new_reg_id,
                                      );
                  $data1 = $this->security->xss_clean($data1); // xss filter
                  $this->Company_model->edit_NewSubtask($data1,$gs->stid);
                  $hdata = array(
                                'pid' => $gs->stproject_assign,
                                'gid' => $gs->gid,
                                'sid' => $gs->sid,
                                'h_date ' => date('Y-m-d H:i:s'),
                                'h_resource_id' => $powner->reg_id,
                                'h_resource' => $powner->first_name.' '.$powner->last_name,
                                'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Subtask '.$gs->stname.' ( '.$gs->stcode.' ) to '.$new_mem->first_name.' '.$new_mem->last_name,
                            );
                      $hdata = $this->security->xss_clean($hdata); // xss filter
                      $this->Company_model->insert_ProjectHistory($hdata);
                }
              }
            }
          }

          $reg_id_sent_to = $powner->email_address;
          $getPortfolio = $this->Company_model->TMOpenPortfolio2($reg_id_sent_to);
          if($getPortfolio)
          {
            foreach($getPortfolio as $pp)
            {
              $portfolio_id = $pp->portfolio_id;
              $this->Company_model->delete_portfolio_member($portfolio_id,$reg_id_sent_to);
            }
          }

          $getGoals = $this->Company_model->TMOpenGoals2($reg_id);
          if($getGoals)
          {
            foreach($getGoals as $gg)
            {
              if($gg->gcreated_by == $reg_id)
              {
                $check_if_goaltm = $this->Company_model->check_if_goaltm($gg->gid,$new_reg_id);
                if($check_if_goaltm)
                {
                  $this->Company_model->delete_gMember_mem_id($gg->gid,$new_reg_id);
                }
                $data = array(
                        'gcreated_by' => $new_reg_id,
                    );
                    $data = $this->security->xss_clean($data); // xss filter
                    $this->Company_model->editGoal($data,$gg->gid);
                $hdata = array(
                            'gid' => $gg->gid,
                            'h_date ' => date('Y-m-d H:i:s'),
                            'h_resource_id' => $powner->reg_id,
                            'h_resource' => $powner->first_name.' '.$powner->last_name,
                            'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Goal '.$gg->gname.' Ownership to '.$new_mem->first_name.' '.$new_mem->last_name,
                        );
                  $hdata = $this->security->xss_clean($hdata); // xss filter
                  $this->Company_model->insert_ProjectHistory($hdata);

                  $data2 = array(
                      'gid' => $gg->gid,
                      'portfolio_id' => $gg->portfolio_id,
                      'gmember' => $new_reg_id,
                      'status' => 'accepted',
                      'gcreated_by' => $new_reg_id,
                      'sent_date' => date('Y-m-d H:i:s'),
                      'sent_notify_clear' => 'yes',
                                        );
                  $data2 = $this->security->xss_clean($data2); // xss filter
                  $this->Company_model->insert_GoalTeamMember($data2);
              }
              if($gg->gmanager == $reg_id)
              {
                $data2 = array(
                                      'gmanager' => $new_reg_id,
                                  );
                $data2 = $this->security->xss_clean($data2); // xss filter
                $this->Company_model->editGoal($data2,$gg->gid);

                  $hdata = array(
                            'gid' => $gg->gid,
                            'h_date ' => date('Y-m-d H:i:s'),
                            'h_resource_id' => $powner->reg_id,
                            'h_resource' => $powner->first_name.' '.$powner->last_name,
                            'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Goal '.$gg->gname.' Manager to '.$new_mem->first_name.' '.$new_mem->last_name,
                        );
                  $hdata = $this->security->xss_clean($hdata); // xss filter
                  $this->Company_model->insert_ProjectHistory($hdata);
              } 
              //check if team member in any goal  
              $check_tm = $this->Company_model->CheckOpenGoalTM($reg_id,$gg->gid);
              if($check_tm) 
              {
                $this->Company_model->delete_gMember_mem_id($gg->gid,$reg_id);
              } 
            }
          }

          $getGoalTM = $this->Company_model->getGoalOpenTM2($reg_id);
          if($getGoalTM)
          {
            foreach($getGoalTM as $ggtm)
            {                
              $check_if_already_goaltm = $this->Company_model->check_if_already_goaltm($new_reg_id,$ggtm->portfolio_id,$ggtm->gid);
              if($check_if_already_goaltm == 0)
              {                  
                $check_if_goalowner = $this->Company_model->check_if_goalowner($ggtm->gid,$new_reg_id);
                if($check_if_goalowner == 0)
                {
                  $data2 = array(
                    'gid' => $ggtm->gid,
                    'portfolio_id' => $ggtm->portfolio_id,
                    'gmember' => trim($new_reg_id),
                    'status' => $ggtm->status,
                    'gcreated_by' => $reg_id,
                    'sent_date' => date('Y-m-d H:i:s'),
                    'sent_notify_clear' => $ggtm->sent_notify_clear,
                                      );
                  $data2 = $this->security->xss_clean($data2); // xss filter
                  $this->Company_model->insert_GoalTeamMember($data2);

                  $hdata = array(
                            'gid' => $ggtm->gid,
                            'h_date ' => date('Y-m-d H:i:s'),
                            'h_resource_id' => $powner->reg_id,
                            'h_resource' => $powner->first_name.' '.$powner->last_name,
                            'h_description' =>  $powner->first_name.' '.$powner->last_name.' Added '.$new_mem->first_name.' '.$new_mem->last_name.' as a team member',
                        );
                  $hdata = $this->security->xss_clean($hdata); // xss filter
                  $this->Company_model->insert_ProjectHistory($hdata);
                }                  
              }
              $this->Company_model->delete_gMember_with_port_id($reg_id,$ggtm->portfolio_id);
            }
          }

          $getStrategies = $this->Company_model->TMOpenStrategies2($reg_id);
          if($getStrategies)
          {
            foreach($getStrategies as $ggs)
            {
              $data = array(
                      'screated_by' => $new_reg_id,
                  );
                  $data = $this->security->xss_clean($data); // xss filter
                  $this->Company_model->editStrategies($data,$ggs->sid);
              $hdata = array(
                            'sid' => $ggs->sid,
                            'gid' => $ggs->gid,
                            'h_date ' => date('Y-m-d H:i:s'),
                            'h_resource_id' => $powner->reg_id,
                            'h_resource' => $powner->first_name.' '.$powner->last_name,
                            'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer KPI '.$ggs->sname.' Ownership to '.$new_mem->first_name.' '.$new_mem->last_name,
                        );
                  $hdata = $this->security->xss_clean($hdata); // xss filter
                  $this->Company_model->insert_ProjectHistory($hdata);
            }
          }

          $getProjects = $this->Company_model->TMOpenProjects2($reg_id);
          if($getProjects)
          {
            foreach($getProjects as $gp)
            {
              if($gp->pcreated_by == $reg_id)
              {
                $check_if_tm = $this->Company_model->check_if_tm($gp->pid,$new_reg_id);
                if($check_if_tm)
                {
                  $this->Company_model->delete_pMember_mem_id($gp->pid,$new_reg_id);
                }
                $data2 = array(
                                      'pcreated_by' => $new_reg_id,
                                  );
                $data2 = $this->security->xss_clean($data2); // xss filter
                $this->Company_model->edit_Project($data2,$gp->pid);

                  $get_gs_pid = $this->Company_model->getProjectById($gp->pid);
                  $hdata = array(
                            'pid' => $gp->pid,
                            'gid' => $get_gs_pid->gid,
                            'sid' => $get_gs_pid->sid,
                            'h_date ' => date('Y-m-d H:i:s'),
                            'h_resource_id' => $powner->reg_id,
                            'h_resource' => $powner->first_name.' '.$powner->last_name,
                            'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Project '.$gp->pname.' Ownership to '.$new_mem->first_name.' '.$new_mem->last_name,
                        );
                  $hdata = $this->security->xss_clean($hdata); // xss filter
                  $this->Company_model->insert_ProjectHistory($hdata);
              }
              if($gp->pmanager == $reg_id)
              {
                $data2 = array(
                                      'pmanager' => $new_reg_id,
                                  );
                $data2 = $this->security->xss_clean($data2); // xss filter
                $this->Company_model->edit_Project($data2,$gp->pid);

                  $get_gs_pid = $this->Company_model->getProjectById($gp->pid);
                  $hdata = array(
                            'pid' => $gp->pid,
                            'gid' => $get_gs_pid->gid,
                            'sid' => $get_gs_pid->sid,
                            'h_date ' => date('Y-m-d H:i:s'),
                            'h_resource_id' => $powner->reg_id,
                            'h_resource' => $powner->first_name.' '.$powner->last_name,
                            'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Project '.$gp->pname.' Manager to '.$new_mem->first_name.' '.$new_mem->last_name,
                        );
                  $hdata = $this->security->xss_clean($hdata); // xss filter
                  $this->Company_model->insert_ProjectHistory($hdata);
              }   
              //check if team member in any project  
              $check_tm = $this->Company_model->CheckOpenTM($reg_id,$gp->pid);
              if($check_tm) 
              {
                $this->Company_model->delete_pMember_mem_id($gp->pid,$reg_id);
              }          
            }
          }

          $getProjectTM = $this->Company_model->getProjectOpenTM2($reg_id);
          if($getProjectTM)
          {
            foreach($getProjectTM as $gtm)
            {                
              $check_if_already_tm = $this->Company_model->check_if_already_tm($new_reg_id,$gtm->portfolio_id,$gtm->pid);
              if($check_if_already_tm == 0)
              {                  
                $check_if_powner = $this->Company_model->check_if_powner($gtm->pid,$new_reg_id);
                if($check_if_powner == 0)
                {
                  $data2 = array(
                    'pid' => $gtm->pid,
                    'portfolio_id' => $gtm->portfolio_id,
                    'pmember' => trim($new_reg_id),
                    'status' => $gtm->status,
                    'pcreated_by' => $reg_id,
                    'sent_date' => date('Y-m-d H:i:s'),
                    'sent_notify_clear' => $gtm->sent_notify_clear,
                                      );
                  $data2 = $this->security->xss_clean($data2); // xss filter
                  $this->Company_model->insert_TeamMember($data2);

                  $get_gs_pid = $this->Company_model->getProjectById($gtm->pid);
                  $hdata = array(
                            'pid' => $gtm->pid,
                            'gid' => $get_gs_pid->gid,
                            'sid' => $get_gs_pid->sid,
                            'h_date ' => date('Y-m-d H:i:s'),
                            'h_resource_id' => $powner->reg_id,
                            'h_resource' => $powner->first_name.' '.$powner->last_name,
                            'h_description' =>  $powner->first_name.' '.$powner->last_name.' Added '.$new_mem->first_name.' '.$new_mem->last_name.' as a team member',
                        );
                  $hdata = $this->security->xss_clean($hdata); // xss filter
                  $this->Company_model->insert_ProjectHistory($hdata);
                }                  
              }
              $this->Company_model->delete_pMember_with_port_id($reg_id,$gtm->portfolio_id);
            }
          }

          $getPlannedContent = $this->Company_model->TMOpenPlannedContent2($reg_id);
          if($getPlannedContent)
          {
            foreach($getPlannedContent as $gpc)
            {
              if($gpc->written_content_assignee == $reg_id)
              {
                  $data = array(
                    'written_content_assignee' => $new_reg_id,
                    'pc_created_by' => $reg_id,
                  );

                $data = $this->security->xss_clean($data); // xss filter
                $this->Company_model->update_Content($data,$gpc->pc_id);
                if(!empty($gpc->pc_project_assign))
                    {
                      $get_gs_pid = $this->Company_model->getProjectById($gpc->pc_project_assign);
                      $hdata = array( 
                            'pid' => $gpc->pc_project_assign,
                            'gid' => $get_gs_pid->gid,
                            'sid' => $get_gs_pid->sid,
                            'h_date ' => date('Y-m-d H:i:s'),
                            'h_resource_id' => $powner->reg_id,
                            'h_resource' => $powner->first_name.' '.$powner->last_name,
                            'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Written Content Assignee of platform '.$gpc->platform.' ( '.$gpc->pc_code.' ) to '.$new_mem->first_name.' '.$new_mem->last_name,
                                  );
                      $hdata = $this->security->xss_clean($hdata); // xss filter
                      $this->Company_model->insert_ProjectHistory($hdata);
                    }
              }
              if($gpc->pc_file_assignee == $reg_id)
              {
                  $data = array(
                    'pc_file_assignee' => $new_reg_id,
                    'pc_created_by' => $reg_id,
                  );

                $data = $this->security->xss_clean($data); // xss filter
                $this->Company_model->update_Content($data,$gpc->pc_id);
                if(!empty($gpc->pc_project_assign))
                    {
                      $get_gs_pid = $this->Company_model->getProjectById($gpc->pc_project_assign);
                      $hdata = array( 
                            'pid' => $gpc->pc_project_assign,
                            'gid' => $get_gs_pid->gid,
                            'sid' => $get_gs_pid->sid,
                            'h_date ' => date('Y-m-d H:i:s'),
                            'h_resource_id' => $powner->reg_id,
                            'h_resource' => $powner->first_name.' '.$powner->last_name,
                            'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Media File Assignee of platform '.$gpc->platform.' ( '.$gpc->pc_code.' ) to '.$new_mem->first_name.' '.$new_mem->last_name,
                                  );
                      $hdata = $this->security->xss_clean($hdata); // xss filter
                      $this->Company_model->insert_ProjectHistory($hdata);
                    }
              }
              if($gpc->submit_to_approval == $reg_id)
              {
                  $data = array(
                    'submit_to_approval' => $new_reg_id,
                    'pc_created_by' => $reg_id,
                  );

                $data = $this->security->xss_clean($data); // xss filter
                $this->Company_model->update_Content($data,$gpc->pc_id);
                if(!empty($gpc->pc_project_assign))
                    {
                      $get_gs_pid = $this->Company_model->getProjectById($gpc->pc_project_assign);
                      $hdata = array( 
                            'pid' => $gpc->pc_project_assign,
                            'gid' => $get_gs_pid->gid,
                            'sid' => $get_gs_pid->sid,
                            'h_date ' => date('Y-m-d H:i:s'),
                            'h_resource_id' => $powner->reg_id,
                            'h_resource' => $powner->first_name.' '.$powner->last_name,
                            'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Submit for Approval Assignee of platform '.$gpc->platform.' ( '.$gpc->pc_code.' ) to '.$new_mem->first_name.' '.$new_mem->last_name,
                                  );
                      $hdata = $this->security->xss_clean($hdata); // xss filter
                      $this->Company_model->insert_ProjectHistory($hdata);
                    }
              }
              if($gpc->pc_assignee == $reg_id)
              {
                  $data = array(
                    'pc_assignee' => $new_reg_id,
                    'pc_created_by' => $reg_id,
                  );

                $data = $this->security->xss_clean($data); // xss filter
                $this->Company_model->update_Content($data,$gpc->pc_id);
                if(!empty($gpc->pc_project_assign))
                    {
                      $get_gs_pid = $this->Company_model->getProjectById($gpc->pc_project_assign);
                      $hdata = array( 
                            'pid' => $gpc->pc_project_assign,
                            'gid' => $get_gs_pid->gid,
                            'sid' => $get_gs_pid->sid,
                            'h_date ' => date('Y-m-d H:i:s'),
                            'h_resource_id' => $powner->reg_id,
                            'h_resource' => $powner->first_name.' '.$powner->last_name,
                            'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Scheduler of platform '.$gpc->platform.' ( '.$gpc->pc_code.' ) to '.$new_mem->first_name.' '.$new_mem->last_name,
                                  );
                      $hdata = $this->security->xss_clean($hdata); // xss filter
                      $this->Company_model->insert_ProjectHistory($hdata);
                    }
              }
            }
          }

          $getTasks = $this->Company_model->TMOpenTasks2($reg_id);
          if($getTasks)
          {
            foreach($getTasks as $gt)
            {
              $data = array(
                                      'tassignee' => $new_reg_id,
                                  );
              $data = $this->security->xss_clean($data); // xss filter
              $this->Company_model->update_OpenTask($data,$gt->tid,$reg_id);
              $data1 = array(
                                      'tcreated_by' => $new_reg_id,
                                  );
              $data1 = $this->security->xss_clean($data1); // xss filter
              $this->Company_model->edit_NewTask($data1,$gt->tid);
              $hdata = array(
                            'pid' => $gt->tproject_assign,
                            'gid' => $gt->gid,
                            'sid' => $gt->sid,
                            'h_date ' => date('Y-m-d H:i:s'),
                            'h_resource_id' => $powner->reg_id,
                            'h_resource' => $powner->first_name.' '.$powner->last_name,
                            'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Task '.$gt->tname.' ( '.$gt->tcode.' ) to '.$new_mem->first_name.' '.$new_mem->last_name,
                        );
                  $hdata = $this->security->xss_clean($hdata); // xss filter
                  $this->Company_model->insert_ProjectHistory($hdata);
            }
          }

          $getSubtasks = $this->Company_model->TMOpenSubtasks2($reg_id);
          if($getSubtasks)
          {
            foreach($getSubtasks as $gs)
            {
              $data = array(
                                      'stassignee' => $new_reg_id,
                                  );
              $data = $this->security->xss_clean($data); // xss filter
              $this->Company_model->update_OpenSubtask($data,$gs->stid,$reg_id);
              $data1 = array(
                                      'stcreated_by' => $new_reg_id,
                                  );
              $data1 = $this->security->xss_clean($data1); // xss filter
              $this->Company_model->edit_NewSubtask($data1,$gs->stid);
              $hdata = array(
                            'pid' => $gs->stproject_assign,
                            'gid' => $gs->gid,
                            'sid' => $gs->sid,
                            'h_date ' => date('Y-m-d H:i:s'),
                            'h_resource_id' => $powner->reg_id,
                            'h_resource' => $powner->first_name.' '.$powner->last_name,
                            'h_description' =>  $powner->first_name.' '.$powner->last_name.' Transfer Subtask '.$gs->stname.' ( '.$gs->stcode.' ) to '.$new_mem->first_name.' '.$new_mem->last_name,
                        );
                  $hdata = $this->security->xss_clean($hdata); // xss filter
                  $this->Company_model->insert_ProjectHistory($hdata);
            }
          }        

          $this->Company_model->delete_contacted_company_emp($cce_id);

          $data = array(  
                          'stripe_cus_id' => $powner->stripe_cus_id,
                          'reg_id' => $powner->reg_id,
                          'first_name' => $powner->first_name,
                          'middle_name' => $powner->middle_name,
                          'last_name' => $powner->last_name,
                          'email_address' => $powner->email_address,
                          'phone_number' => $powner->phone_number,
                          'deleted_date' => date('Y-m-d H:i:s'),
                          'used_corporate_id' => $powner->used_corporate_id
                       );
          $data = $this->security->xss_clean($data); // xss filter
          $this->Company_model->insertDeletedRegistration($data);

          $this->Company_model->delete_registration($reg_id);

          $this->session->set_flashdata('message','Member Deleted Successfully!');
          $response['status'] = TRUE;
          header('Content-type: application/json');
          echo json_encode($response);
        }
      }
    }
    else
    {
      redirect(base_url('company/login'));
    }
  }

  //Roles

  public function roles()
  {
    if(($this->session->userdata('d168_comp_id')) || ($this->session->userdata('d168_comp_id') != ""))
    {
      $check_packD = $this->Company_model->getCompanyDetail($this->session->userdata('d168_comp_id'));
      if($check_packD->extended_pack == 'expired')
      {
        redirect(base_url('company/pricing-package'));
      }
      else
      {
        $data['list'] = $this->Company_model->getCompanyRoles($this->session->userdata('d168_comp_id'));
        $this->load->view('company_view/roles',$data);
      }
    }
    else
    {      
      redirect(base_url('company/login'));
    }
  }

  function insert_roleform()
  {
    if(($this->session->userdata('d168_comp_id')) || ($this->session->userdata('d168_comp_id') != ""))
    {
      $this->form_validation->set_rules('role','Role','trim|required|is_unique[contacted_company_roles.role]',array('is_unique' => 'Role already exists! Role must be unique!'));
      $this->form_validation->set_rules('rpivilege_option','Option','trim|required');
      if ($this->form_validation->run() == FALSE)
      {
        //$errors = array();
        $errors = $this->form_validation->error_array();
        // Loop through $_POST and get the keys
        foreach ($errors as $key => $value)
          {
            // Add the error message for this field
            $errors[$key] = form_error($key);
          }
          
          $response['errors'] = array_filter($errors); // Some might be empty
          $response['status'] = FALSE;
          // You can use the Output class here too
          header('Content-type: application/json');
          //echo json_encode($response);
          exit(json_encode($response));
      }
      else
      {            
          $rpivilege_option = $this->input->post('rpivilege_option');
          
          if($rpivilege_option == 'all')
          {
            $privilege = 'all';
          }
          else
          {
            if(!empty($this->input->post('cus_privilege')))
            {
              if(in_array('view', $this->input->post('cus_privilege')))
              {
                $privilege = 'view';
              }
              else
              {
                $p = implode(', ',$this->input->post('cus_privilege'));
                $privilege = $p.', task, subtask';
              }              
            }
            else
            {
              $privilege = 'task, subtask';
            }            
          }
          
          // print_r($privilege);
          // die();

          $inData = array(
                        'cc_id' => $this->session->userdata('d168_comp_id'),
                        'role' => $this->input->post('role'),
                        'privilege' => $privilege,
                        'rstatus' => 'active',
                        'ccr_date' => date('Y-m-d'),
                      );
          $inData = $this->security->xss_clean($inData); // xss filter
          $this->Company_model->insert_contacted_company_roles($inData);

          $this->session->set_flashdata('message','Role Added Successfully!');
          $response['status'] = TRUE;
          header('Content-type: application/json');
          echo json_encode($response);          
      }
    }
    else
    {
      redirect(base_url('company/login'));
    }
  }

  public function edit_role()
  {
    if(($this->session->userdata('d168_comp_id')) || ($this->session->userdata('d168_comp_id') != ""))
    {
      $check_packD = $this->Company_model->getCompanyDetail($this->session->userdata('d168_comp_id'));
      if($check_packD->extended_pack == 'expired')
      {
        redirect(base_url('company/pricing-package'));
      }
      else
      {
        $id = $this->input->post('id');
        $data['rdetail'] = $this->Company_model->role_detail($id); 
        $this->load->view('company_view/role-edit-modal',$data); 
      }
    }
    else
    {      
      redirect(base_url('company/login'));
    }
  }

  function update_role()
  {
    if(($this->session->userdata('d168_comp_id')) || ($this->session->userdata('d168_comp_id') != ""))
    {
      $this->form_validation->set_rules('role','Role','trim|required');
      $this->form_validation->set_rules('rpivilege_option','Option','trim|required');
      if ($this->form_validation->run() == FALSE)
      {
        //$errors = array();
        $errors = $this->form_validation->error_array();
        // Loop through $_POST and get the keys
        foreach ($errors as $key => $value)
          {
            // Add the error message for this field
            $errors[$key] = form_error($key);
          }
          
          $response['errors'] = array_filter($errors); // Some might be empty
          $response['status'] = FALSE;
          // You can use the Output class here too
          header('Content-type: application/json');
          //echo json_encode($response);
          exit(json_encode($response));
      }
      else
      {            
          $id = $this->input->post('id');
          $rpivilege_option = $this->input->post('rpivilege_option');
          
          if($rpivilege_option == 'all')
          {
            $privilege = 'all';
          }
          else
          {
            if(!empty($this->input->post('cus_privilege')))
            {
              if(in_array('view', $this->input->post('cus_privilege')))
              {
                $privilege = 'view';
              }
              else
              {
                $p = implode(', ',$this->input->post('cus_privilege'));
                $privilege = $p.', task, subtask';
              }
            }
            else
            {
              $privilege = 'task, subtask';
            }            
          }
          
          // print_r($privilege);
          // die();

          $inData = array(
                        'role' => $this->input->post('role'),
                        'privilege' => $privilege,
                      );
          $inData = $this->security->xss_clean($inData); // xss filter
          $this->Company_model->update_contacted_company_roles($inData,$id);

          $this->session->set_flashdata('message','Role Updated Successfully!');
          $response['status'] = TRUE;
          header('Content-type: application/json');
          echo json_encode($response);          
      }
    }
    else
    {
      redirect(base_url('company/login'));
    }
  }

  public function delete_role()
  {
    if(($this->session->userdata('d168_comp_id')) || ($this->session->userdata('d168_comp_id') != ""))
    {
      $id = $this->input->post('id');

      $checkRoleAssigned = $this->Company_model->checkRoleAssigned($id);
      if($checkRoleAssigned > 0)
      {
        $regData = array(
          'role_in_comp' => 'employee'
        );
        $regData = $this->security->xss_clean($regData); // xss filter
        $this->Company_model->updateRoleRegistration($regData,$id);
      }

      $this->Company_model->delete_role($id);

      $this->session->set_flashdata('message','Role Deleted Successfully!');
      $response['status'] = TRUE;
      header('Content-type: application/json');
      echo json_encode($response);
    }
    else
    {
      redirect(base_url('company/login'));
    }
  }

  function assign_emprole()
  {
    if(($this->session->userdata('d168_comp_id')) || ($this->session->userdata('d168_comp_id') != ""))
    {
      $this->form_validation->set_rules('cce_id','Member ID','trim|required');
      $this->form_validation->set_rules('role_id','Role ID','trim|required');
      if ($this->form_validation->run() == FALSE)
      {
        //$errors = array();
        $errors = $this->form_validation->error_array();
        // Loop through $_POST and get the keys
        foreach ($errors as $key => $value)
          {
            // Add the error message for this field
            $errors[$key] = form_error($key);
          }
          
          $response['errors'] = array_filter($errors); // Some might be empty
          $response['status'] = FALSE;
          // You can use the Output class here too
          header('Content-type: application/json');
          //echo json_encode($response);
          exit(json_encode($response));
      }
      else
      {            
        $cce_id = $this->input->post('cce_id');
        $role_id = $this->input->post('role_id');

        $getEmp = $this->Company_model->getCompanyEmpDetail($cce_id);
        $pm = $this->Company_model->getStudentByEmailId($getEmp->emp_email);
        if($pm)  
        {
          $regData = array(
          'role_in_comp' => $role_id
          );
          $regData = $this->security->xss_clean($regData); // xss filter
          $this->Company_model->updateRegistrationID($regData,$pm->reg_id);
        }

          $this->session->set_flashdata('message','Role Assigned Successfully!');
          $response['status'] = TRUE;
          header('Content-type: application/json');
          echo json_encode($response);          
      }
    }
    else
    {
      redirect(base_url('company/login'));
    }
  }

  public function switch_emprole()
  {
    if(($this->session->userdata('d168_comp_id')) || ($this->session->userdata('d168_comp_id') != ""))
    {
      $check_packD = $this->Company_model->getCompanyDetail($this->session->userdata('d168_comp_id'));
      if($check_packD->extended_pack == 'expired')
      {
        redirect(base_url('company/pricing-package'));
      }
      else
      {
        $cce_id = $this->input->post('id');
        $data['getEmp'] = $this->Company_model->getCompanyEmpDetail($cce_id);
        $data['pm'] = $this->Company_model->getStudentByEmailId($data['getEmp']->emp_email);
        $data['rlist'] = $this->Company_model->getCompanyRolesAsc($this->session->userdata('d168_comp_id'));        
        $this->load->view('company_view/switch-role-modal',$data); 
      }
    }
    else
    {      
      redirect(base_url('company/login'));
    }
  }

  function change_emprole()
  {
    if(($this->session->userdata('d168_comp_id')) || ($this->session->userdata('d168_comp_id') != ""))
    {
      $this->form_validation->set_rules('cce_id_up','Member ID','trim|required');
      $this->form_validation->set_rules('role_id_up','Role ID','trim|required');
      if ($this->form_validation->run() == FALSE)
      {
        //$errors = array();
        $errors = $this->form_validation->error_array();
        // Loop through $_POST and get the keys
        foreach ($errors as $key => $value)
          {
            // Add the error message for this field
            $errors[$key] = form_error($key);
          }
          
          $response['errors'] = array_filter($errors); // Some might be empty
          $response['status'] = FALSE;
          // You can use the Output class here too
          header('Content-type: application/json');
          //echo json_encode($response);
          exit(json_encode($response));
      }
      else
      {            
        $cce_id = $this->input->post('cce_id_up');
        $role_id = $this->input->post('role_id_up');

        $getEmp = $this->Company_model->getCompanyEmpDetail($cce_id);
        $pm = $this->Company_model->getStudentByEmailId($getEmp->emp_email);
        if($pm)  
        {
          $regData = array(
          'role_in_comp' => $role_id
          );
          $regData = $this->security->xss_clean($regData); // xss filter
          $this->Company_model->updateRegistrationID($regData,$pm->reg_id);
        }

          $this->session->set_flashdata('message','Role Switched Successfully!');
          $response['status'] = TRUE;
          header('Content-type: application/json');
          echo json_encode($response);          
      }
    }
    else
    {
      redirect(base_url('company/login'));
    }
  }

  //Roles 

}
?>