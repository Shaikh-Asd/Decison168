<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Superadmin extends MY_Controller {


public function __construct()
{
    //call CodeIgniter's default Constructor
    parent::__construct();

    //load Model
    $this->load->model('Superadmin_model');
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
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      redirect(base_url('super-admin/dashboard'));   
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
}

public function dashboard()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $this->load->view('super_admin/dashboard');    
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

public function login()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      redirect(base_url('super-admin/dashboard'));    
    }
    else
    {       
      $this->load->view('super_admin/login');
    }
  }

public function check_login() //Check Login
  {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('login_username','Username','required');
    $this->form_validation->set_rules('login_password','Password','required');
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

          $data = $this->Superadmin_model->checkLogin($username,md5($password));
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
                   
              $sdel = $this->Superadmin_model->selectLogin($username);
              if($sdel->verified == 'yes'){
                if(!empty($this->input->post('basic_checkbox_1')))
                {
                    setcookie("d168_super_username",$username,time()+ (10 * 365 * 24 * 60 * 60),'/');
                    setcookie("d168_super_password",$password,time()+ (10 * 365 * 24 * 60 * 60),'/');
                }
                else
                {
                    setcookie("d168_super_username","",time() - 3600,'/');
                    setcookie("d168_super_password","",time() - 3600,'/');
                } 
                $user = $this->Superadmin_model->selectLogin($username);
                $this->session->set_userdata('d168_super_id',$user->sa_id);    

                $this->session->set_flashdata('message', 'Successfully Logged In');
                $response['status'] = TRUE;
                header('Content-type: application/json');
                echo json_encode($response);
              }else{
                $response['errors'] = 'Verification link has been sent on your registered email Address. Verify you account to login';
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
      $this->session->unset_userdata('d168_super_id');
      $this->session->sess_destroy();
  }

  public function registered_list()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $data['list'] = $this->Superadmin_model->registered_list();
      $this->load->view('super_admin/registered_list', $data);    
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  public function deactivated_users()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $data['list'] = $this->Superadmin_model->deactivated_users();
      $this->load->view('super_admin/deactivated_users', $data);    
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  public function quotes_list()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $data['list'] = $this->Superadmin_model->quotes_list();
      $this->load->view('super_admin/quotes_list', $data);    
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  function insert_quote()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
    $this->form_validation->set_rules('writer','Writer','trim|required');
    $this->form_validation->set_rules('quote','Quote','trim|required');
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
            $data2 = array(
                            'quote' => $this->input->post('quote'),
                            'writer' => $this->input->post('writer'),
                            'qcreated_date' => date('Y-m-d H:i:s'),
                            'status' => 'approved',
                            'status_date' => date('Y-m-d H:i:s'),
                            'qnotify' => 'seen',
                            'qnotify_clear' => 'yes'
                              );
                        $data2 = $this->security->xss_clean($data2); // xss filter
                        $this->Superadmin_model->insert_quote($data2);

              $this->session->set_flashdata('message','Quote Added Successfully!');
              $response['status'] = TRUE;
              header('Content-type: application/json');
              echo json_encode($response);          
        }
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  public function QuoteEdit_Modal()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $id = $this->input->post('id');
      //echo $id;
      //die();
      $data['qdetail'] = $this->Superadmin_model->quote_detail($id); 
      $this->load->view('super_admin/quote-edit-modal',$data);   
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  function edit_quote()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
    $this->form_validation->set_rules('writer','Writer','trim|required');
    $this->form_validation->set_rules('quote','Quote','trim|required');
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
            $data2 = array(
                            'quote' => $this->input->post('quote'),
                            'writer' => $this->input->post('writer'),
                              );
                        $data2 = $this->security->xss_clean($data2); // xss filter
                        $this->Superadmin_model->edit_quote($data2,$id);

              $this->session->set_flashdata('message','Quote Edited Successfully!');
              $response['status'] = TRUE;
              header('Content-type: application/json');
              echo json_encode($response);        
        }
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  function delete_quote()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
    $id = $this->input->post('id');
    $qdetail = $this->Superadmin_model->quote_detail($id); 
    if($qdetail)
    {
            $this->Superadmin_model->delete_quote($id);

            $this->session->set_flashdata('message','Quote Deleted Successfully!');
            $response['status'] = TRUE;
            header('Content-type: application/json');
            echo json_encode($response);
    }
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  public function quote_approve_request()
  {
    $id = $this->uri->segment(2);
    $reg_id = $this->uri->segment(3);
    $flag_num = $this->uri->segment(4);
    $r = $this->Superadmin_model->check_quote_request($id,$reg_id);
        if(!empty($r))
        {
          if($flag_num == '1')
            {
                if($r->status == 'sent')
                {
                    $data['status'] = 'approved';
                      $data2 = array(
                          'status' => 'approved',
                          'status_date' => date('Y-m-d H:i:s'),
                          'qnotify' => 'seen',
                          'qnotify_clear' => 'yes'
                            );
                      $data2 = $this->security->xss_clean($data2); // xss filter
                      $this->Superadmin_model->edit_quote($data2,$id);
                    $this->load->view('super_admin/qrequest_approved',$data);
                }
                elseif($r->status == 'denied')
                {
                  $data['status'] = 'already_denied';
                  $this->load->view('super_admin/qrequest_denied',$data);
                }
                elseif($r->status == 'approved')
                {
                  $data['status'] = 'already_approved';
                  $this->load->view('super_admin/qrequest_approved',$data);          
                }
            }
            else
            {      
                $this->load->view('super_admin/qrequest_invalid');
            }
        }
        else
        {
          $this->load->view('super_admin/qrequest_invalid');
        }    
  }

  public function quote_deny_request()
  {
    $id = $this->uri->segment(2);
    $reg_id = $this->uri->segment(3);
    $flag_num = $this->uri->segment(4);
    $r = $this->Superadmin_model->check_quote_request($id,$reg_id);
        if(!empty($r))
        {
          if($flag_num == '2')
            {
                if($r->status == 'sent')
                {
                    $data['status'] = 'denied';
                      $data2 = array(
                          'status' => 'denied',
                          'status_date' => date('Y-m-d H:i:s'),
                          'qnotify' => 'seen',
                          'qnotify_clear' => 'yes'
                            );
                      $data2 = $this->security->xss_clean($data2); // xss filter
                      $this->Superadmin_model->edit_quote($data2,$id);
                    $this->load->view('super_admin/qrequest_denied',$data);
                }
                elseif($r->status == 'denied')
                {
                  $data['status'] = 'already_denied';
                  $this->load->view('super_admin/qrequest_denied',$data);
                }
                elseif($r->status == 'approved')
                {
                  $data['status'] = 'already_approved';
                  $this->load->view('super_admin/qrequest_approved',$data);          
                }
            }
            else
            {      
                $this->load->view('super_admin/qrequest_invalid');
            }
        }
        else
        {
          $this->load->view('super_admin/qrequest_invalid');
        }    
  }

  function approve_quote()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
    $id = $this->input->post('id');
    $qdetail = $this->Superadmin_model->quote_detail($id); 
    if($qdetail)
    {
            $data2 = array(
                          'status' => 'approved',
                          'status_date' => date('Y-m-d H:i:s'),
                          'qnotify' => 'seen',
                          'qnotify_clear' => 'yes'
                            );
            $data2 = $this->security->xss_clean($data2); // xss filter
            $this->Superadmin_model->edit_quote($data2,$id);
                $this->session->set_flashdata('message','Quote Approved Successfully!');
                $response['status'] = TRUE;
                header('Content-type: application/json');
                echo json_encode($response);
    }
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  function deny_quote()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
    $id = $this->input->post('id');
    $qdetail = $this->Superadmin_model->quote_detail($id); 
    if($qdetail)
    {
            $data2 = array(
                          'status' => 'denied',
                          'status_date' => date('Y-m-d H:i:s'),
                          'qnotify' => 'seen',
                          'qnotify_clear' => 'yes'
                            );
            $data2 = $this->security->xss_clean($data2); // xss filter
            $this->Superadmin_model->edit_quote($data2,$id);
                $this->session->set_flashdata('message','Quote Denied Successfully!');
                $response['status'] = TRUE;
                header('Content-type: application/json');
                echo json_encode($response);
    }
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  public function pricing_list()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $data['list'] = $this->Superadmin_model->pricing_list();
      $this->load->view('super_admin/pricing_list', $data);    
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  function insert_package()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $this->form_validation->set_rules('pack_name','Package Name','trim|required|is_unique[pricing.pack_name]',array('is_unique' => 'Package name already exists!'));
      $this->form_validation->set_rules('pack_portfolio','Portfolio','trim|required');
      $this->form_validation->set_rules('pack_goals','Goals','trim|required');
      $this->form_validation->set_rules('pack_goals_strategies','KPIs','trim|required');
      //$this->form_validation->set_rules('pack_goals_strategies_projects','KPI projects','trim|required');
      $this->form_validation->set_rules('pack_projects','Projects','trim|required');
      $this->form_validation->set_rules('pack_team_members','Team Members','trim|required');
      $this->form_validation->set_rules('pack_tasks','Tasks','trim|required');
      $this->form_validation->set_rules('pack_storage','Storage','trim|required');
      $this->form_validation->set_rules('pack_content_planner','Content Planner','trim|required');
      $this->form_validation->set_rules('pack_stripe_link','Link with Stripe','trim|required');
      if($this->input->post('pack_creation_page') == 'contacted_page')
      {
        $this->form_validation->set_rules('validity_period','Validity Period','trim|required');
        $this->form_validation->set_rules('user_id','User ID','trim|required');
        $this->form_validation->set_rules('contacted_id','Contacted ID','trim|required');
        $this->form_validation->set_rules('company_name','Company Name','trim|required');
        $this->form_validation->set_rules('company_users','Total Users','trim|required|numeric');
        $this->form_validation->set_rules('company_username','Company Username','trim|required|is_unique[contacted_company.cc_username]',array('is_unique' => 'Username already exists!'));
        $this->form_validation->set_rules('company_password','Company Password','trim|required|min_length[5]|callback_valid_password');
      }
      if($this->input->post('pack_creation_page') == 'pricing_page')
      {
        if($this->input->post('pack_stripe_link') == 'yes')
        {
          $this->form_validation->set_rules('pack_validity','Package Validity','trim|required');
          $this->form_validation->set_rules('pack_price','Package Price','trim|required');
        }
      }
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
          $custom_pack = "no";
          $custom_cid = "";
          $custom_reg_id = "";
          if($this->input->post('pack_creation_page') == 'contacted_page')
          {
              if(is_numeric($this->input->post('pack_validity')))
              {
                 if($this->input->post('pack_validity') == '30')
                 {
                      $validity = ['interval' => 'month'];
                 }
                 elseif($this->input->post('pack_validity') == '365')
                 {
                      $validity = ['interval' => 'year'];
                 }
                 elseif($this->input->post('pack_validity') == '90')
                 {
                      //$validity = 'quarter';
                      $validity = ['interval' => 'month', 'interval_count' => '3'];
                 }
                 elseif($this->input->post('pack_validity') == '180')
                 {
                      //$validity = 'semiannual';
                      $validity = ['interval' => 'month', 'interval_count' => '6'];
                 }
                 elseif($this->input->post('pack_validity') == '270')
                 {
                      $validity = ['interval' => 'month', 'interval_count' => '9'];
                 }
                 else
                 {
                      $validity = $this->input->post('pack_validity');
                 }
                  $price = $this->input->post('pack_price')*100;
                  // Set API key
                  \Stripe\Stripe::setApiKey($this->config->item('stripe_api_key'));
                  $stripe_prod = \Stripe\Product::create(['name' => $this->input->post('pack_name'),]);
                  $stripe_price = \Stripe\Price::create([
                                    'unit_amount_decimal' => $price,
                                    'currency' => 'usd',
                                    'recurring' => $validity,
                                    'product' => $stripe_prod->id,
                                  ]);
                  $stripe_prod = $stripe_prod->id;
                  $stripe_price = $stripe_price->id;
              }
              else
              {
                  $price = $this->input->post('pack_price')*100;
                  // Set API key
                  \Stripe\Stripe::setApiKey($this->config->item('stripe_api_key'));
                  $stripe_prod = \Stripe\Product::create(['name' => $this->input->post('pack_name'),]);
                  $stripe_price = \Stripe\Price::create([
                                    'unit_amount_decimal' => $price,
                                    'currency' => 'usd',
                                    'product' => $stripe_prod->id,
                                  ]);
                  $stripe_prod = $stripe_prod->id;
                  $stripe_price = $stripe_price->id;
              }
              $custom_pack = "yes";
              $custom_cid = $this->input->post('contacted_id');
              $custom_reg_id = $this->input->post('user_id');              
          }
          else
          {
            if($this->input->post('pack_stripe_link') == 'yes')
            {
              if(is_numeric($this->input->post('pack_validity')))
              {
                 if($this->input->post('pack_validity') == '30')
                 {
                      $validity = ['interval' => 'month'];
                 }
                 elseif($this->input->post('pack_validity') == '365')
                 {
                      $validity = ['interval' => 'year'];
                 }
                 elseif($this->input->post('pack_validity') == '90')
                 {
                      //$validity = 'quarter';
                      $validity = ['interval' => 'month', 'interval_count' => '3'];
                 }
                 elseif($this->input->post('pack_validity') == '180')
                 {
                      //$validity = 'semiannual';
                      $validity = ['interval' => 'month', 'interval_count' => '6'];
                 }
                 elseif($this->input->post('pack_validity') == '270')
                 {
                      $validity = ['interval' => 'month', 'interval_count' => '9'];
                 }
                 else
                 {
                      $validity = $this->input->post('pack_validity');
                 }
                  $price = $this->input->post('pack_price')*100;
                  // Set API key
                  \Stripe\Stripe::setApiKey($this->config->item('stripe_api_key'));
                  $stripe_prod = \Stripe\Product::create(['name' => $this->input->post('pack_name'),]);
                  $stripe_price = \Stripe\Price::create([
                                    'unit_amount_decimal' => $price,
                                    'currency' => 'usd',
                                    'recurring' => $validity,
                                    'product' => $stripe_prod->id,
                                  ]);
                  $stripe_prod = $stripe_prod->id;
                  $stripe_price = $stripe_price->id;
              }
              else
              {
                  $price = $this->input->post('pack_price')*100;
                  // Set API key
                  \Stripe\Stripe::setApiKey($this->config->item('stripe_api_key'));
                  $stripe_prod = \Stripe\Product::create(['name' => $this->input->post('pack_name'),]);
                  $stripe_price = \Stripe\Price::create([
                                    'unit_amount_decimal' => $price,
                                    'currency' => 'usd',
                                    'product' => $stripe_prod->id,
                                  ]);
                  $stripe_prod = $stripe_prod->id;
                  $stripe_price = $stripe_price->id;
              }
            }
            else
            {
              $stripe_prod = "";
              $stripe_price = "";
            } 
          }      

          $validity_period = "";
          if($this->input->post('pack_creation_page') == 'contacted_page')
          {
            $validity_period = $this->input->post('validity_period');
          }   

          $data2 = array(
                          'stripe_link' => $this->input->post('pack_stripe_link'),
                          'stripe_product_id' => $stripe_prod,
                          'stripe_price_id' => $stripe_price,
                          'pack_name' => $this->input->post('pack_name'),
                          'pack_validity' => $this->input->post('pack_validity'),
                          'pack_price' => $this->input->post('pack_price'),
                          'pack_portfolio' => $this->input->post('pack_portfolio'),
                          'pack_goals' => $this->input->post('pack_goals'),
                          'pack_goals_strategies' => $this->input->post('pack_goals_strategies'),
                          //'pack_goals_strategies_projects' => $this->input->post('pack_goals_strategies_projects'),
                          'pack_projects' => $this->input->post('pack_projects'),
                          'pack_team_members' => $this->input->post('pack_team_members'),
                          'pack_tasks' => $this->input->post('pack_tasks'),
                          'pack_storage' => $this->input->post('pack_storage'),
                          'pack_content_planner' => $this->input->post('pack_content_planner'),
                          'pack_tagline' => $this->input->post('pack_tagline'),
                          'pack_created_date' => date('Y-m-d'),
                          'pack_status' => 'active',
                          'custom_pack' => $custom_pack,
                          'custom_cid' => $custom_cid,
                          'custom_reg_id' => $custom_reg_id, 
                          'coupon_pack' => 'no', 
                          'validity_period' => $validity_period
                            );
                      $data2 = $this->security->xss_clean($data2); // xss filter
                      $this->Superadmin_model->insert_package($data2);
                      $inserted_id = $this->db->insert_id();

            $data3 = array(
                          'pack_id' => $inserted_id,
                          'portfolio' => 'portfolio',
                          'goals' => 'goals',
                          'goals_strategies' => 'KPIs per goal',
                          'goals_strategies_projects' => 'projects per KPIs',
                          'projects' => 'active projects',
                          'team_members' => 'team members',
                          'task' => 'task',
                          'storage' => 'storage',
                          'accountability_tracking' => 'accountability tracking',
                          'document_collaboration' => 'document collaboration',
                          'kanban_boards' => 'kanban boards',
                          'motivator' => 'motivator',
                          'internal_chat' => 'internal chat',
                          'content_planner' => 'posts / mo. content planner',
                          'data_recovery' => 'data recovery',
                          'email_support' => '24/7 email support',
                            );
                      $data3 = $this->security->xss_clean($data3); // xss filter
                      $this->Superadmin_model->insert_pricing_labels($data3);

          if($this->input->post('pack_creation_page') == 'contacted_page')
          {
            $data2 = array(
                          'response_status' => 'accepted',
                          'response_date' => date('Y-m-d'),
                            );
                      $data2 = $this->security->xss_clean($data2); // xss filter
                      $this->Superadmin_model->edit_contact_sales($data2,$custom_cid);

              $letter = strtolower(substr(trim($this->input->post('company_name')), 0, 3)); 
              $random_num = rand(1, 10000);
              $get_ccode = $letter.$random_num; 
              //echo $get_ccode;
              $cc_link = base_url().'corporate-registration/'.md5($get_ccode);

              $ccdata2 = array(
                          'cc_name' => $this->input->post('company_name'),
                          'cc_tusers' => $this->input->post('company_users'),
                          'cc_username' => $this->input->post('company_username'),
                          'cc_pwd' => md5($this->input->post('company_password')),
                          'cc_createddate' => date('Y-m-d'),
                          'contacted_sales_id' => $custom_cid,
                          'contacted_user_id' => $custom_reg_id,
                          'cc_status' => 'active',
                          'cc_corporate_id' => $get_ccode,
                          'cc_corporate_id_encrypt' => md5($get_ccode),
                          'cc_link' => $cc_link,
                          'package_id' => $inserted_id,
                          'package_use' => 'no'
                            );
                      $ccdata2 = $this->security->xss_clean($ccdata2); // xss filter
                      $this->Superadmin_model->insert_contacted_company($ccdata2);
                      $inserted_cc_id = $this->db->insert_id();
                      $getEmail = $this->Superadmin_model->getStudentById($custom_reg_id);

                      $inData = array(
                        'cc_id' => $inserted_cc_id,
                        'emp_email' => $getEmail->email_address,
                        'emp_status' => 'active',
                        'status' => 'accepted',
                        'cce_date' => date('Y-m-d'),
                        'contacted_user' => 'yes'
                      );
                      $inData = $this->security->xss_clean($inData); // xss filter
                      $this->Superadmin_model->insert_contacted_company_emp($inData);
                      $inserted_cce_id = $this->db->insert_id();

                      $upData = array(
                        'used_corporate_id' => $get_ccode,
                        'cce_id' => $inserted_cce_id,                        
                        'role_in_comp' => 'contacted_user',
                      );
                      $upData = $this->security->xss_clean($upData); // xss filter
                      $this->Superadmin_model->updateRegistration($upData,$custom_reg_id);

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
                $this->email->subject('Company Login Credentials | Decision 168');
                $this->email->message('             
          <!doctype html>
          <html lang="en-US">

          <head>
            <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
            <title>Company Login Credentials</title>
            <meta name="description" content="Company Login Credentials">
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
                                                   Welcome to the Decision 168 Company Accountability & Productivity Platform (D168).
                                                    <br><br>
                                                    Your package has been created and below are your company login credentials. You can change your password after you log in.
                                                    <br><br>
                                                </p>
                                                <p style="color:#fff; font-size:15px;line-height:24px;text-align:left; margin:0;">
                                                      Username: <b style="color:#c7df19;">'.$this->input->post('company_username').'</b>
                                                      <br>
                                                      Password: <b>'.$this->input->post('company_password').'</b>
                                                      <br>
                                                      Registration Link: <b>'.$cc_link.'</b>
                                                </p>
                                                    <a href="'.base_url().'company/"
                                                      style="background:#c7df19;text-decoration:none !important; font-weight:600; margin-top:35px; margin-bottom: 20px;color:#fff;text-transform:uppercase; font-size:15px;padding:10px 30px;display:inline-block;border-radius:10px;">Login to company account
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
                //echo $this->email->print_debugger();
            }
          }

            $this->session->set_flashdata('message','Package Added Successfully!');
            $response['status'] = TRUE;
            header('Content-type: application/json');
            echo json_encode($response);
        }
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  public function PackageEdit_Modal()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $id = $this->input->post('id');
      //echo $id;
      //die();
      $data['pdetail'] = $this->Superadmin_model->package_detail($id); 
      $this->load->view('super_admin/pricing-edit-modal',$data);   
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  function edit_package()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
    $id = $this->input->post('id');
    $pdetail = $this->Superadmin_model->package_detail($id); 
    $this->form_validation->set_rules('pack_name','Package Name','trim|required');
    $this->form_validation->set_rules('pack_portfolio','Portfolio','trim|required');
    $this->form_validation->set_rules('pack_goals','Goals','trim|required');
    $this->form_validation->set_rules('pack_goals_strategies','KPIs','trim|required');
    //$this->form_validation->set_rules('pack_goals_strategies_projects','KPI projects','trim|required');
    $this->form_validation->set_rules('pack_projects','Projects','trim|required');
    $this->form_validation->set_rules('pack_team_members','Team Members','trim|required');
    $this->form_validation->set_rules('pack_tasks','Tasks','trim|required');
    $this->form_validation->set_rules('pack_storage','Storage','trim|required');
    $this->form_validation->set_rules('pack_content_planner','Content Planner','trim|required');
    if($pdetail)
    {
      if($pdetail->stripe_link == 'yes')
      {
        $this->form_validation->set_rules('pack_validity','Package Validity','trim|required');
        $this->form_validation->set_rules('pack_price','Package Price','trim|required');
      }
    }

    if($this->input->post('custom_pack') == 'yes')
    {
      $this->form_validation->set_rules('validity_period','Validity Period','trim|required');
      $this->form_validation->set_rules('custom_cid','Contacted ID','trim|required');
      $this->form_validation->set_rules('company_name','Company Name','trim|required');
      $this->form_validation->set_rules('company_users','Total Users','trim|required|numeric');
      //$this->form_validation->set_rules('company_username','Company Username','trim|required');
    }

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
          $validity_period = "";
          if($this->input->post('custom_pack') == 'yes')
          {
            $ccdata2 = array(
                          'cc_name' => $this->input->post('company_name'),
                          'cc_tusers' => $this->input->post('company_users'),
                          //'cc_username' => $this->input->post('company_username'),
                            );
            $ccdata2 = $this->security->xss_clean($ccdata2); // xss filter
            $this->Superadmin_model->update_contacted_company($ccdata2,$this->input->post('custom_cid'));

            $validity_period = $this->input->post('validity_period');
          }

          if($pdetail->stripe_link == 'yes')
          {
            $new_price_id = $pdetail->stripe_price_id;
            if(($pdetail->pack_name != $this->input->post('pack_name')) || ($pdetail->pack_price != $this->input->post('pack_price')) || ($pdetail->pack_validity != $this->input->post('pack_validity')))
            {
                if(is_numeric($this->input->post('pack_validity')))
                {
                   if($this->input->post('pack_validity') == '30')
                   {
                        $validity = ['interval' => 'month'];
                   }
                   elseif($this->input->post('pack_validity') == '365')
                   {
                        $validity = ['interval' => 'year'];
                   }
                   elseif($this->input->post('pack_validity') == '90')
                   {
                        //$validity = 'quarter';
                        $validity = ['interval' => 'month', 'interval_count' => '3'];
                   }
                   elseif($this->input->post('pack_validity') == '180')
                   {
                        //$validity = 'semiannual';
                        $validity = ['interval' => 'month', 'interval_count' => '6'];
                   }
                   elseif($this->input->post('pack_validity') == '270')
                   {
                        $validity = ['interval' => 'month', 'interval_count' => '9'];
                   }
                   else
                   {
                        $validity = $this->input->post('pack_validity');
                   }
                    $price = $this->input->post('pack_price')*100;
                    // Set API key
                    \Stripe\Stripe::setApiKey($this->config->item('stripe_api_key'));
                    \Stripe\Product::update(
                                  $pdetail->stripe_product_id,
                                  ['name' => $this->input->post('pack_name'),]
                                );
                    if($pdetail->pack_price != $this->input->post('pack_price') || ($pdetail->pack_validity != $this->input->post('pack_validity')))
                    {
                      \Stripe\Price::update(
                                    $pdetail->stripe_price_id,
                                    ['active' => 'false',]
                                  );
                      $stripe_price = \Stripe\Price::create([
                                  'unit_amount_decimal' => $price,
                                  'currency' => 'usd',
                                  'recurring' => $validity,
                                  'product' => $pdetail->stripe_product_id,
                                ]);
                      $new_price_id = $stripe_price->id;
                    }
                    
                }
                else
                {
                    $price = $this->input->post('pack_price')*100;
                    // Set API key
                    \Stripe\Stripe::setApiKey($this->config->item('stripe_api_key'));
                    \Stripe\Product::update(
                                  $pdetail->stripe_product_id,
                                  ['name' => $this->input->post('pack_name'),]
                                );
                    if($pdetail->pack_price != $this->input->post('pack_price') || ($pdetail->pack_validity != $this->input->post('pack_validity')))
                    {
                      \Stripe\Price::update(
                                      $pdetail->stripe_price_id,
                                      ['active' => 'false',]
                                    );
                      $stripe_price = \Stripe\Price::create([
                                    'unit_amount_decimal' => $price,
                                    'currency' => 'usd',
                                    'product' => $pdetail->stripe_product_id,
                                  ]);
                      $new_price_id = $stripe_price->id;
                    }
                }
            }
          }
          else
          {
            $new_price_id = $pdetail->stripe_price_id;
          }
          
          
          $data2 = array(
                          'stripe_price_id' => $new_price_id,
                          'pack_name' => $this->input->post('pack_name'),
                          'pack_validity' => $this->input->post('pack_validity'),
                          'pack_price' => $this->input->post('pack_price'),
                          'pack_portfolio' => $this->input->post('pack_portfolio'),
                          'pack_goals' => $this->input->post('pack_goals'),
                          'pack_goals_strategies' => $this->input->post('pack_goals_strategies'),
                          //'pack_goals_strategies_projects' => $this->input->post('pack_goals_strategies_projects'),
                          'pack_projects' => $this->input->post('pack_projects'),
                          'pack_team_members' => $this->input->post('pack_team_members'),
                          'pack_tasks' => $this->input->post('pack_tasks'),
                          'pack_storage' => $this->input->post('pack_storage'),
                          'pack_content_planner' => $this->input->post('pack_content_planner'),
                          'pack_tagline' => $this->input->post('pack_tagline'),
                          'validity_period' => $validity_period
                            );
                      $data2 = $this->security->xss_clean($data2); // xss filter
                      $this->Superadmin_model->edit_package($data2,$id);

            $this->session->set_flashdata('message','Package Updated Successfully!');
            $response['status'] = TRUE;
            header('Content-type: application/json');
            echo json_encode($response);
        }
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  public function PackageView_Modal()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $id = $this->input->post('id');
      //echo $id;
      //die();
      $data['pdetail'] = $this->Superadmin_model->package_detail($id); 
      $this->load->view('super_admin/pricing-view-modal',$data);   
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  public function refund_list()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $data['list'] = $this->Superadmin_model->refund_list();
      $this->load->view('super_admin/refund_list', $data);    
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  public function refund_complete()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $reg_id = $this->input->post('reg_id');
          $upData = array(
                        'refund_status' => 'refund_succeeded',
                      );
                $upData = $this->security->xss_clean($upData); // xss filter
                $this->Superadmin_model->updateRegistration($upData,$reg_id);
      $response['status'] = TRUE;
      header('Content-type: application/json');
      echo json_encode($response);   
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  public function change_package_status()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $id = $this->input->post('id');
      $status = $this->input->post('status');

      $pdetail = $this->Superadmin_model->package_detail($id); 

      if($pdetail)
      {
        if($pdetail->custom_pack == 'yes')
        {
          $ccdata2 = array(
                          'cc_status' => $status,
                          );
            $ccdata2 = $this->security->xss_clean($ccdata2); // xss filter
            $this->Superadmin_model->update_contacted_company($ccdata2,$pdetail->custom_cid);
        }

        $data2 = array(
                            'pack_status' => $status,
                      );
                        $data2 = $this->security->xss_clean($data2); // xss filter
                        $this->Superadmin_model->edit_package($data2,$id);
        $response['status'] = TRUE;
        header('Content-type: application/json');
        echo json_encode($response);
      }
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  public function change_labels()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $id = $this->input->post('id');
      //echo $id;
      //die();
      $data['plabels'] = $this->Superadmin_model->pricing_labels($id); 
      $this->load->view('super_admin/change-labels-modal',$data);   
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  function edit_change_labels()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
    $this->form_validation->set_rules('portfolio','Portfolio Label','trim|required');
    $this->form_validation->set_rules('goals','Goals Label','trim|required');
    $this->form_validation->set_rules('goals_strategies','KPI Label','trim|required');
    $this->form_validation->set_rules('goals_strategies_projects','KPI Projects Label','trim|required');
    $this->form_validation->set_rules('projects','Project Label','trim|required');
    $this->form_validation->set_rules('team_members','Team Member Label','trim|required');
    $this->form_validation->set_rules('task','Task Label','trim|required');
    $this->form_validation->set_rules('storage','Storage Label','trim|required');
    $this->form_validation->set_rules('accountability_tracking','Accountability Tracking Label','trim|required');
    $this->form_validation->set_rules('document_collaboration','Document Collaboration Label','trim|required');
    $this->form_validation->set_rules('kanban_boards','Kanban Boards Label','trim|required');
    $this->form_validation->set_rules('motivator','Motivator Label','trim|required');
    $this->form_validation->set_rules('internal_chat','Internal Chat Label','trim|required');
    $this->form_validation->set_rules('content_planner','Content Planner Label','trim|required');
    $this->form_validation->set_rules('data_recovery','Data Recovery Label','trim|required');
    $this->form_validation->set_rules('email_support','Support Label','trim|required');
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
          $id = $this->input->post('label_id');
          $data2 = array(
                          'portfolio' => $this->input->post('portfolio'),
                          'goals' => $this->input->post('goals'),
                          'goals_strategies' => $this->input->post('goals_strategies'),
                          'goals_strategies_projects' => $this->input->post('goals_strategies_projects'),
                          'projects' => $this->input->post('projects'),
                          'team_members' => $this->input->post('team_members'),
                          'task' => $this->input->post('task'),
                          'storage' => $this->input->post('storage'),
                          'accountability_tracking' => $this->input->post('accountability_tracking'),
                          'document_collaboration' => $this->input->post('document_collaboration'),
                          'kanban_boards' => $this->input->post('kanban_boards'),
                          'motivator' => $this->input->post('motivator'),
                          'internal_chat' => $this->input->post('internal_chat'),
                          'content_planner' => $this->input->post('content_planner'),
                          'data_recovery' => $this->input->post('data_recovery'),
                          'email_support' => $this->input->post('email_support'),
                            );
                      $data2 = $this->security->xss_clean($data2); // xss filter
                      $this->Superadmin_model->edit_pricing_labels($data2,$id);

            $this->session->set_flashdata('message','Labels Updated Successfully!');
            $response['status'] = TRUE;
            header('Content-type: application/json');
            echo json_encode($response);
        }
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  public function view_registered_info()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $id = $this->input->post('id');
      //echo $id;
      //die();
      $data['user'] = $this->Superadmin_model->get_User($id); 
      $this->load->view('super_admin/view_registered_info',$data);   
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }  

  public function logo_list()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $data['list'] = $this->Superadmin_model->logo_list();
      $this->load->view('super_admin/logo_list', $data);    
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  function insert_logo()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $this->form_validation->set_rules('clogo','Logo','trim|required');
      $this->form_validation->set_rules('logo_link','Link','trim|required');
      $pattern = "/\b(?:(?:http?|https?|ftp):\/\/)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
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
        elseif(!preg_match($pattern, $this->input->post('logo_link')))
        {
          $response['status'] = 'link_valid';
          header('Content-type: application/json');
          //echo json_encode($response);
          exit(json_encode($response));
        }
        else
        {
          $clogo = "";
          if(!empty($_POST['clogo']))
          {   
            $data = $_POST['clogo'];
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $imageName = time().'_'.$this->session->userdata('d168_id').'.png';
            if(file_put_contents('./assets/clogo_photos/'.$imageName, $data))
            {
             $clogo = $imageName;          
            }
          }
          $data2 = array(
                          'clogo' => $clogo,
                          'logo_link' => $this->input->post('logo_link'),
                          'lcreated_date' => date('Y-m-d H:i:s'),
                          'status' => 'approved',
                          'status_date' => date('Y-m-d H:i:s'),
                          'qnotify' => 'yes',
                          'qnotify_clear' => 'no'
                            );
                      $data2 = $this->security->xss_clean($data2); // xss filter
                      $this->Superadmin_model->insert_ad_logo($data2); 

            $this->session->set_flashdata('message','Logo Added Successfully!');
            $response['status'] = TRUE;
            header('Content-type: application/json');
            echo json_encode($response);
        }
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  public function LogoEdit_Modal()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $id = $this->input->post('id');
      $data['ldetail'] = $this->Superadmin_model->logo_detail($id); 
      $this->load->view('super_admin/logo-edit-modal',$data);   
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  function edit_clogo()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $this->form_validation->set_rules('editlogo_link','Link','trim|required');
      $pattern = "/\b(?:(?:http?|https?|ftp):\/\/)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
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
        elseif(!preg_match($pattern, $this->input->post('editlogo_link')))
        {
          $response['status'] = 'link_valid';
          header('Content-type: application/json');
          //echo json_encode($response);
          exit(json_encode($response));
        }
        else
        {
            $id = $this->input->post('id');
            $ldetail = $this->Superadmin_model->logo_detail($id); 
            $clogo = $ldetail->clogo;
            if(!empty($_POST['clogo_edit']))
            {   
              $data = $_POST['clogo_edit'];
              list($type, $data) = explode(';', $data);
              list(, $data)      = explode(',', $data);
              $data = base64_decode($data);
              $imageName = time().'_'.$this->session->userdata('d168_id').'.png';
              if(file_put_contents('./assets/clogo_photos/'.$imageName, $data))
              {
               $clogo = $imageName;          
              }
            }

            $data2 = array(
                            'clogo' => $clogo,
                            'logo_link' => $this->input->post('editlogo_link'),
                              );
                        $data2 = $this->security->xss_clean($data2); // xss filter
                        $this->Superadmin_model->edit_logo($data2,$id);

              $this->session->set_flashdata('message','Logo Edited Successfully!');
              $response['status'] = TRUE;
              header('Content-type: application/json');
              echo json_encode($response);         
        }
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  function delete_ad_logo()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
    $id = $this->input->post('id');
    $ldetail = $this->Superadmin_model->logo_detail($id); 
    if($ldetail)
    {
            $this->Superadmin_model->delete_logo($id);

            $this->session->set_flashdata('message','Logo Deleted Successfully!');
            $response['status'] = TRUE;
            header('Content-type: application/json');
            echo json_encode($response);
    }
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  function delete_clogo()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
    $id = $this->input->post('id');
    $ldetail = $this->Superadmin_model->logo_detail($id); 
    if($ldetail)
    {
            $data2 = array(
                          'clogo' => '',
                            );
            $data2 = $this->security->xss_clean($data2); // xss filter
           $res = $this->Superadmin_model->edit_logo($data2,$id);

            if ($res == true) 
            {
              unlink("assets/clogo_photos/".$ldetail->clogo);
            }

                $this->session->set_flashdata('message','Logo Deleted Successfully!');
                $response['status'] = TRUE;
                header('Content-type: application/json');
                echo json_encode($response);
    }
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  public function logo_approve_request()
  {
    $id = $this->uri->segment(2);
    $reg_id = $this->uri->segment(3);
    $flag_num = $this->uri->segment(4);
    $r = $this->Superadmin_model->check_logo_request($id,$reg_id);
        if(!empty($r))
        {
          if($flag_num == '1')
            {
                if($r->status == 'sent')
                {
                    $data['status'] = 'approved';
                      $data2 = array(
                          'status' => 'approved',
                          'status_date' => date('Y-m-d H:i:s'),
                          'qnotify' => 'seen',
                          'qnotify_clear' => 'yes'
                            );
                      $data2 = $this->security->xss_clean($data2); // xss filter
                      $this->Superadmin_model->edit_logo($data2,$id);
                    $this->load->view('super_admin/lrequest_approved',$data);
                }
                elseif($r->status == 'denied')
                {
                  $data['status'] = 'already_denied';
                  $this->load->view('super_admin/lrequest_denied',$data);
                }
                elseif($r->status == 'approved')
                {
                  $data['status'] = 'already_approved';
                  $this->load->view('super_admin/lrequest_approved',$data);          
                }
            }
            else
            {      
                $this->load->view('super_admin/lrequest_invalid');
            }
        }
        else
        {
          $this->load->view('super_admin/lrequest_invalid');
        }    
  }

  public function logo_deny_request()
  {
    $id = $this->uri->segment(2);
    $reg_id = $this->uri->segment(3);
    $flag_num = $this->uri->segment(4);
    $r = $this->Superadmin_model->check_logo_request($id,$reg_id);
        if(!empty($r))
        {
          if($flag_num == '2')
            {
                if($r->status == 'sent')
                {
                    $data['status'] = 'denied';
                      $data2 = array(
                          'status' => 'denied',
                          'status_date' => date('Y-m-d H:i:s'),
                          'qnotify' => 'seen',
                          'qnotify_clear' => 'yes'
                            );
                      $data2 = $this->security->xss_clean($data2); // xss filter
                      $this->Superadmin_model->edit_logo($data2,$id);
                    $this->load->view('super_admin/lrequest_denied',$data);
                }
                elseif($r->status == 'denied')
                {
                  $data['status'] = 'already_denied';
                  $this->load->view('super_admin/lrequest_denied',$data);
                }
                elseif($r->status == 'approved')
                {
                  $data['status'] = 'already_approved';
                  $this->load->view('super_admin/lrequest_approved',$data);          
                }
            }
            else
            {      
                $this->load->view('super_admin/lrequest_invalid');
            }
        }
        else
        {
          $this->load->view('super_admin/lrequest_invalid');
        }    
  }

  function approve_logo()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
    $id = $this->input->post('id');
    $ldetail = $this->Superadmin_model->logo_detail($id); 
    if($ldetail)
    {
            $data2 = array(
                          'status' => 'approved',
                          'status_date' => date('Y-m-d H:i:s'),
                          'qnotify' => 'seen',
                          'qnotify_clear' => 'yes'
                            );
            $data2 = $this->security->xss_clean($data2); // xss filter
            $this->Superadmin_model->edit_logo($data2,$id);
                $this->session->set_flashdata('message','Logo Approved Successfully!');
                $response['status'] = TRUE;
                header('Content-type: application/json');
                echo json_encode($response);
    }
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  function deny_logo()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
    $id = $this->input->post('id');
    $ldetail = $this->Superadmin_model->logo_detail($id); 
    if($ldetail)
    {
            $data2 = array(
                          'status' => 'denied',
                          'status_date' => date('Y-m-d H:i:s'),
                          'qnotify' => 'seen',
                          'qnotify_clear' => 'yes'
                            );
            $data2 = $this->security->xss_clean($data2); // xss filter
            $this->Superadmin_model->edit_logo($data2,$id);
                $this->session->set_flashdata('message','Logo Denied Successfully!');
                $response['status'] = TRUE;
                header('Content-type: application/json');
                echo json_encode($response);
    }
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  public function user_activate_account_request()
  {
    $user_id = $this->uri->segment(2);
    $flag = $this->uri->segment(3);
    $source = $this->uri->segment(4);
    $userD = $this->Superadmin_model->get_User($user_id);

    if($source == '1')//activate through mail
    {
      if(!empty($userD))
        {
            if(($userD->reg_acc_status == 'deactivated') && ($userD->send_activate_req == 'yes'))
            {
                          $upData1 = array(
                              'inactivity_mail_days' => '',
                              'deactive_date' => '',
                              'reg_acc_status' => 'activated',
                              'send_activate_req' => 'approved',
                              'send_activate_req_date' => date('Y-m-d'),
                            );
                  $upData1 = $this->security->xss_clean($upData1); // xss filter
                  $this->Superadmin_model->updateRegistration($upData1,$user_id);

            $upData2 = array(
                              'reg_acc_status' => '',
                            );
                  $upData2 = $this->security->xss_clean($upData2); // xss filter
                  $this->Superadmin_model->updateAd_logo($upData2,$user_id);

            $upData3 = array(
                              'reg_acc_status' => '',
                            );
                  $upData3 = $this->security->xss_clean($upData3); // xss filter
                  $this->Superadmin_model->updateComments($upData3,$user_id);

            $upData4 = array(
                              'reg_acc_status' => '',
                            );
                  $upData4 = $this->security->xss_clean($upData4); // xss filter
                  $this->Superadmin_model->updateMotivator($upData4,$user_id);

            $upcData4 = array(
                              'reg_acc_status' => '',
                            );
                  $upcData4 = $this->security->xss_clean($upcData4); // xss filter
                  $this->Superadmin_model->updateContactSales($upcData4,$user_id);

            $get_all_user_portfolio = $this->Superadmin_model->get_all_user_portfolio($user_id);
            if($get_all_user_portfolio)
            {
              foreach($get_all_user_portfolio as $gaup)
              {
                  $gupData5 = array(
                              'reg_acc_status' => '',
                            );
                  $gupData5 = $this->security->xss_clean($gupData5); // xss filter
                  $this->Superadmin_model->updateGoals($gupData5,$gaup->portfolio_id);

                  $get_all_goals = $this->Superadmin_model->get_all_goals($gaup->portfolio_id);
                  if($get_all_goals)
                  {
                    foreach($get_all_goals as $ggap)
                    {
                      $upData8 = array(
                              'reg_acc_status' => '',
                            );
                      $upData8 = $this->security->xss_clean($upData8); // xss filter
                      $this->Superadmin_model->updateGoal_members($upData8,$ggap->gid);

                      $upData10 = array(
                              'reg_acc_status' => '',
                            );
                      $upData10 = $this->security->xss_clean($upData10); // xss filter
                      $this->Superadmin_model->updateGoal_invited_members($upData10,$ggap->gid);

                      $upData12 = array(
                              'reg_acc_status' => '',
                            );
                      $upData12 = $this->security->xss_clean($upData12); // xss filter
                      $this->Superadmin_model->updateGoal_suggested_members($upData12,$ggap->gid);
                    }
                  }

                  $supData5 = array(
                              'reg_acc_status' => '',
                            );
                  $supData5 = $this->security->xss_clean($supData5); // xss filter
                  $this->Superadmin_model->updateStartegies($supData5,$gaup->portfolio_id);

                  $upData5 = array(
                              'reg_acc_status' => '',
                            );
                  $upData5 = $this->security->xss_clean($upData5); // xss filter
                  $this->Superadmin_model->updateProject_portfolio($upData5,$gaup->portfolio_id);

                  $upData6 = array(
                              'reg_acc_status' => '',
                            );
                  $upData6 = $this->security->xss_clean($upData6); // xss filter
                  $this->Superadmin_model->updateProject_portfolio_member($upData6,$gaup->portfolio_id);

                  $upData7 = array(
                              'reg_acc_status' => '',
                            );
                  $upData7 = $this->security->xss_clean($upData7); // xss filter
                  $this->Superadmin_model->updateProject($upData7,$gaup->portfolio_id);

                  $get_all_project = $this->Superadmin_model->get_all_project($gaup->portfolio_id);
                  if($get_all_project)
                  {
                    foreach($get_all_project as $gap)
                    {
                      $upData8 = array(
                              'reg_acc_status' => '',
                            );
                      $upData8 = $this->security->xss_clean($upData8); // xss filter
                      $this->Superadmin_model->updateProject_members($upData8,$gap->pid);

                      $upData9 = array(
                              'reg_acc_status' => '',
                            );
                      $upData9 = $this->security->xss_clean($upData9); // xss filter
                      $this->Superadmin_model->updateProject_files($upData9,$gap->pid);

                      $upData10 = array(
                              'reg_acc_status' => '',
                            );
                      $upData10 = $this->security->xss_clean($upData10); // xss filter
                      $this->Superadmin_model->updateProject_invited_members($upData10,$gap->pid);

                      $upData11 = array(
                              'reg_acc_status' => '',
                            );
                      $upData11 = $this->security->xss_clean($upData11); // xss filter
                      $this->Superadmin_model->updateProject_request_member($upData11,$gap->pid);

                      $upData12 = array(
                              'reg_acc_status' => '',
                            );
                      $upData12 = $this->security->xss_clean($upData12); // xss filter
                      $this->Superadmin_model->updateProject_suggested_members($upData12,$gap->pid);

                      $upData13 = array(
                              'reg_acc_status' => '',
                            );
                      $upData13 = $this->security->xss_clean($upData13); // xss filter
                      $this->Superadmin_model->updateTask($upData13,$gap->pid);

                      $upData14 = array(
                              'reg_acc_status' => '',
                            );
                      $upData14 = $this->security->xss_clean($upData14); // xss filter
                      $this->Superadmin_model->updateSubtask($upData14,$gap->pid);

                      $upData16 = array(
                              'reg_acc_status' => '',
                            );
                      $upData16 = $this->security->xss_clean($upData16); // xss filter
                      $this->Superadmin_model->updateComments($upData16,$gap->pid);
                    }
                  }

                  $upData15 = array(
                              'reg_acc_status' => '',
                            );
                  $upData15 = $this->security->xss_clean($upData15); // xss filter
                  $this->Superadmin_model->updateContent_planning($upData15,$gaup->portfolio_id);
              }
            }

            $get_all_goals2 = $this->Superadmin_model->get_all_goals2($user_id);
            if($get_all_goals2)
            {
              foreach($get_all_goals2 as $gag2)
              {
                $data = array(
                        'reg_acc_status' => '',
                    );
                    $data = $this->security->xss_clean($data); // xss filter
                    $this->Superadmin_model->editGoal($data,$gag2->gid);

                $upData8 = array(
                              'reg_acc_status' => '',
                            );
                $upData8 = $this->security->xss_clean($upData8); // xss filter
                $this->Superadmin_model->updateGoal_members($upData8,$gag2->gid);

                $upData10 = array(
                        'reg_acc_status' => '',
                      );
                $upData10 = $this->security->xss_clean($upData10); // xss filter
                $this->Superadmin_model->updateGoal_invited_members($upData10,$gag2->gid);

                $upData12 = array(
                        'reg_acc_status' => '',
                      );
                $upData12 = $this->security->xss_clean($upData12); // xss filter
                $this->Superadmin_model->updateGoal_suggested_members($upData12,$gag2->gid);
              }
            }

            $get_all_strategies2 = $this->Superadmin_model->get_all_strategies2($user_id);
            if($get_all_strategies2)
            {
              foreach($get_all_strategies2 as $gas2)
              {
                $data = array(
                        'reg_acc_status' => '',
                    );
                    $data = $this->security->xss_clean($data); // xss filter
                    $this->Superadmin_model->editStrategies($data,$gas2->sid);
              }
            }

            $get_all_project2 = $this->Superadmin_model->get_all_project2($user_id);
                  if($get_all_project2)
                  {
                    foreach($get_all_project2 as $gap2)
                    {
                      $upDataP7 = array(
                              'reg_acc_status' => '',
                            );
                      $upDataP7 = $this->security->xss_clean($upDataP7); // xss filter
                      $this->Superadmin_model->updateProject2($upDataP7,$gap2->pid);

                      $upDataP8 = array(
                              'reg_acc_status' => '',
                            );
                      $upDataP8 = $this->security->xss_clean($upDataP8); // xss filter
                      $this->Superadmin_model->updateProject_members($upDataP8,$gap2->pid);

                      $upDataP9 = array(
                              'reg_acc_status' => '',
                            );
                      $upDataP9 = $this->security->xss_clean($upDataP9); // xss filter
                      $this->Superadmin_model->updateProject_files($upDataP9,$gap2->pid);

                      $upDataP10 = array(
                              'reg_acc_status' => '',
                            );
                      $upDataP10 = $this->security->xss_clean($upDataP10); // xss filter
                      $this->Superadmin_model->updateProject_invited_members($upDataP10,$gap2->pid);

                      $upDataP11 = array(
                              'reg_acc_status' => '',
                            );
                      $upDataP11 = $this->security->xss_clean($upDataP11); // xss filter
                      $this->Superadmin_model->updateProject_request_member($upDataP11,$gap2->pid);

                      $upDataP12 = array(
                              'reg_acc_status' => '',
                            );
                      $upDataP12 = $this->security->xss_clean($upDataP12); // xss filter
                      $this->Superadmin_model->updateProject_suggested_members($upDataP12,$gap2->pid);

                      $upDataP13 = array(
                              'reg_acc_status' => '',
                            );
                      $upDataP13 = $this->security->xss_clean($upDataP13); // xss filter
                      $this->Superadmin_model->updateTask($upDataP13,$gap2->pid);

                      $upDataP14 = array(
                              'reg_acc_status' => '',
                            );
                      $upDataP14 = $this->security->xss_clean($upDataP14); // xss filter
                      $this->Superadmin_model->updateSubtask($upDataP14,$gap2->pid);

                      $upDataP16 = array(
                              'reg_acc_status' => '',
                            );
                      $upDataP16 = $this->security->xss_clean($upDataP16); // xss filter
                      $this->Superadmin_model->updateComments($upDataP16,$gap2->pid);
                    }
                  }


                  $upDataP15 = array(
                              'reg_acc_status' => '',
                            );
                  $upDataP15 = $this->security->xss_clean($upDataP15); // xss filter
                  $this->Superadmin_model->updateContent_planning2($upDataP15,$user_id);

            $singData1 = array(
                        'reg_acc_status' => '',
                      );
            $singData1 = $this->security->xss_clean($singData1); // xss filter
            $this->Superadmin_model->updateProject_portfolio_member2($singData1,$userD->email_address);

            $singData2 = array(
                        'reg_acc_status' => '',
                      );
            $singData2 = $this->security->xss_clean($singData2); // xss filter
            $this->Superadmin_model->updateProject_members2($singData2,$user_id);

            $singData3 = array(
                        'reg_acc_status' => '',
                      );
            $singData3 = $this->security->xss_clean($singData3); // xss filter
            $this->Superadmin_model->updateProject_files2($singData3,$user_id);

            $singData4 = array(
                        'reg_acc_status' => '',
                      );
            $singData4 = $this->security->xss_clean($singData4); // xss filter
            $this->Superadmin_model->updateProject_invited_members2($singData4,$user_id);

            $singData5 = array(
                        'reg_acc_status' => '',
                      );
            $singData5 = $this->security->xss_clean($singData5); // xss filter
            $this->Superadmin_model->updateProject_request_member2($singData5,$user_id);

            $singData6 = array(
                        'reg_acc_status' => '',
                      );
            $singData6 = $this->security->xss_clean($singData6); // xss filter
            $this->Superadmin_model->updateProject_suggested_members2($singData6,$user_id);

            $singData7 = array(
                        'reg_acc_status' => '',
                      );
            $singData7 = $this->security->xss_clean($singData7); // xss filter
            $this->Superadmin_model->updateTask2($singData7,$user_id);

            $singData8 = array(
                        'reg_acc_status' => '',
                      );
            $singData8 = $this->security->xss_clean($singData8); // xss filter
            $this->Superadmin_model->updateSubtask2($singData8,$user_id); 

            $singData2 = array(
                        'reg_acc_status' => '',
                      );
            $singData2 = $this->security->xss_clean($singData2); // xss filter
            $this->Superadmin_model->updateGoal_members2($singData2,$user_id);

            $singData4 = array(
                        'reg_acc_status' => '',
                      );
            $singData4 = $this->security->xss_clean($singData4); // xss filter
            $this->Superadmin_model->updateGoal_invited_members2($singData4,$user_id);

            $singData6 = array(
                        'reg_acc_status' => '',
                      );
            $singData6 = $this->security->xss_clean($singData6); // xss filter
            $this->Superadmin_model->updateGoal_suggested_members2($singData6,$user_id);        

              $data['mheading'] = 'Account Activated!';
              $data['msg'] = 'Account Activated Successfully!';
              $this->load->view('super_admin/user_acc_activate_req',$data);
            }
            else
            {
              $data['mheading'] = 'Account Already Activated!';
              $data['msg'] = 'Account is already active!';
              $this->load->view('super_admin/user_acc_activate_req',$data);
            }            
        }
        else
        {
          $data['mheading'] = 'Account Not Exists!';
          $data['msg'] = 'This account no longer exists!';
          $this->load->view('super_admin/user_acc_activate_req',$data);
        }
    }

    if($source == '2')//activate through app
    {
      if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
      {
        if(!empty($userD))
        {
                      $upData1 = array(
                              'inactivity_mail_days' => '',
                              'deactive_date' => '',
                              'reg_acc_status' => 'activated',
                              'send_activate_req' => 'approved',
                              'send_activate_req_date' => date('Y-m-d'),
                            );
                  $upData1 = $this->security->xss_clean($upData1); // xss filter
                  $this->Superadmin_model->updateRegistration($upData1,$user_id);

            $upData2 = array(
                              'reg_acc_status' => '',
                            );
                  $upData2 = $this->security->xss_clean($upData2); // xss filter
                  $this->Superadmin_model->updateAd_logo($upData2,$user_id);

            $upData3 = array(
                              'reg_acc_status' => '',
                            );
                  $upData3 = $this->security->xss_clean($upData3); // xss filter
                  $this->Superadmin_model->updateComments($upData3,$user_id);

            $upData4 = array(
                              'reg_acc_status' => '',
                            );
                  $upData4 = $this->security->xss_clean($upData4); // xss filter
                  $this->Superadmin_model->updateMotivator($upData4,$user_id);

            $upcData4 = array(
                              'reg_acc_status' => '',
                            );
                  $upcData4 = $this->security->xss_clean($upcData4); // xss filter
                  $this->Superadmin_model->updateContactSales($upcData4,$user_id);

            $get_all_user_portfolio = $this->Superadmin_model->get_all_user_portfolio($user_id);
            if($get_all_user_portfolio)
            {
              foreach($get_all_user_portfolio as $gaup)
              {
                  $gupData5 = array(
                              'reg_acc_status' => '',
                            );
                  $gupData5 = $this->security->xss_clean($gupData5); // xss filter
                  $this->Superadmin_model->updateGoals($gupData5,$gaup->portfolio_id);

                  $get_all_goals = $this->Superadmin_model->get_all_goals($gaup->portfolio_id);
                  if($get_all_goals)
                  {
                    foreach($get_all_goals as $ggap)
                    {
                      $upData8 = array(
                              'reg_acc_status' => '',
                            );
                      $upData8 = $this->security->xss_clean($upData8); // xss filter
                      $this->Superadmin_model->updateGoal_members($upData8,$ggap->gid);

                      $upData10 = array(
                              'reg_acc_status' => '',
                            );
                      $upData10 = $this->security->xss_clean($upData10); // xss filter
                      $this->Superadmin_model->updateGoal_invited_members($upData10,$ggap->gid);

                      $upData12 = array(
                              'reg_acc_status' => '',
                            );
                      $upData12 = $this->security->xss_clean($upData12); // xss filter
                      $this->Superadmin_model->updateGoal_suggested_members($upData12,$ggap->gid);
                    }
                  }

                  $supData5 = array(
                              'reg_acc_status' => '',
                            );
                  $supData5 = $this->security->xss_clean($supData5); // xss filter
                  $this->Superadmin_model->updateStartegies($supData5,$gaup->portfolio_id);

                  $upData5 = array(
                              'reg_acc_status' => '',
                            );
                  $upData5 = $this->security->xss_clean($upData5); // xss filter
                  $this->Superadmin_model->updateProject_portfolio($upData5,$gaup->portfolio_id);

                  $upData6 = array(
                              'reg_acc_status' => '',
                            );
                  $upData6 = $this->security->xss_clean($upData6); // xss filter
                  $this->Superadmin_model->updateProject_portfolio_member($upData6,$gaup->portfolio_id);

                  $upData7 = array(
                              'reg_acc_status' => '',
                            );
                  $upData7 = $this->security->xss_clean($upData7); // xss filter
                  $this->Superadmin_model->updateProject($upData7,$gaup->portfolio_id);

                  $get_all_project = $this->Superadmin_model->get_all_project($gaup->portfolio_id);
                  if($get_all_project)
                  {
                    foreach($get_all_project as $gap)
                    {
                      $upData8 = array(
                              'reg_acc_status' => '',
                            );
                      $upData8 = $this->security->xss_clean($upData8); // xss filter
                      $this->Superadmin_model->updateProject_members($upData8,$gap->pid);

                      $upData9 = array(
                              'reg_acc_status' => '',
                            );
                      $upData9 = $this->security->xss_clean($upData9); // xss filter
                      $this->Superadmin_model->updateProject_files($upData9,$gap->pid);

                      $upData10 = array(
                              'reg_acc_status' => '',
                            );
                      $upData10 = $this->security->xss_clean($upData10); // xss filter
                      $this->Superadmin_model->updateProject_invited_members($upData10,$gap->pid);

                      $upData11 = array(
                              'reg_acc_status' => '',
                            );
                      $upData11 = $this->security->xss_clean($upData11); // xss filter
                      $this->Superadmin_model->updateProject_request_member($upData11,$gap->pid);

                      $upData12 = array(
                              'reg_acc_status' => '',
                            );
                      $upData12 = $this->security->xss_clean($upData12); // xss filter
                      $this->Superadmin_model->updateProject_suggested_members($upData12,$gap->pid);

                      $upData13 = array(
                              'reg_acc_status' => '',
                            );
                      $upData13 = $this->security->xss_clean($upData13); // xss filter
                      $this->Superadmin_model->updateTask($upData13,$gap->pid);

                      $upData14 = array(
                              'reg_acc_status' => '',
                            );
                      $upData14 = $this->security->xss_clean($upData14); // xss filter
                      $this->Superadmin_model->updateSubtask($upData14,$gap->pid);

                      $upData16 = array(
                              'reg_acc_status' => '',
                            );
                      $upData16 = $this->security->xss_clean($upData16); // xss filter
                      $this->Superadmin_model->updateComments($upData16,$gap->pid);
                    }
                  }

                  $upData15 = array(
                              'reg_acc_status' => '',
                            );
                  $upData15 = $this->security->xss_clean($upData15); // xss filter
                  $this->Superadmin_model->updateContent_planning($upData15,$gaup->portfolio_id);
              }
            }

            $get_all_goals2 = $this->Superadmin_model->get_all_goals2($user_id);
            if($get_all_goals2)
            {
              foreach($get_all_goals2 as $gag2)
              {
                $data = array(
                        'reg_acc_status' => '',
                    );
                    $data = $this->security->xss_clean($data); // xss filter
                    $this->Superadmin_model->editGoal($data,$gag2->gid);

                $upData8 = array(
                              'reg_acc_status' => '',
                            );
                $upData8 = $this->security->xss_clean($upData8); // xss filter
                $this->Superadmin_model->updateGoal_members($upData8,$gag2->gid);

                $upData10 = array(
                        'reg_acc_status' => '',
                      );
                $upData10 = $this->security->xss_clean($upData10); // xss filter
                $this->Superadmin_model->updateGoal_invited_members($upData10,$gag2->gid);

                $upData12 = array(
                        'reg_acc_status' => '',
                      );
                $upData12 = $this->security->xss_clean($upData12); // xss filter
                $this->Superadmin_model->updateGoal_suggested_members($upData12,$gag2->gid);
              }
            }

            $get_all_strategies2 = $this->Superadmin_model->get_all_strategies2($user_id);
            if($get_all_strategies2)
            {
              foreach($get_all_strategies2 as $gas2)
              {
                $data = array(
                        'reg_acc_status' => '',
                    );
                    $data = $this->security->xss_clean($data); // xss filter
                    $this->Superadmin_model->editStrategies($data,$gas2->sid);
              }
            }

            $get_all_project2 = $this->Superadmin_model->get_all_project2($user_id);
                  if($get_all_project2)
                  {
                    foreach($get_all_project2 as $gap2)
                    {
                      $upDataP7 = array(
                              'reg_acc_status' => '',
                            );
                      $upDataP7 = $this->security->xss_clean($upDataP7); // xss filter
                      $this->Superadmin_model->updateProject2($upDataP7,$gap2->pid);

                      $upDataP8 = array(
                              'reg_acc_status' => '',
                            );
                      $upDataP8 = $this->security->xss_clean($upDataP8); // xss filter
                      $this->Superadmin_model->updateProject_members($upDataP8,$gap2->pid);

                      $upDataP9 = array(
                              'reg_acc_status' => '',
                            );
                      $upDataP9 = $this->security->xss_clean($upDataP9); // xss filter
                      $this->Superadmin_model->updateProject_files($upDataP9,$gap2->pid);

                      $upDataP10 = array(
                              'reg_acc_status' => '',
                            );
                      $upDataP10 = $this->security->xss_clean($upDataP10); // xss filter
                      $this->Superadmin_model->updateProject_invited_members($upDataP10,$gap2->pid);

                      $upDataP11 = array(
                              'reg_acc_status' => '',
                            );
                      $upDataP11 = $this->security->xss_clean($upDataP11); // xss filter
                      $this->Superadmin_model->updateProject_request_member($upDataP11,$gap2->pid);

                      $upDataP12 = array(
                              'reg_acc_status' => '',
                            );
                      $upDataP12 = $this->security->xss_clean($upDataP12); // xss filter
                      $this->Superadmin_model->updateProject_suggested_members($upDataP12,$gap2->pid);

                      $upDataP13 = array(
                              'reg_acc_status' => '',
                            );
                      $upDataP13 = $this->security->xss_clean($upDataP13); // xss filter
                      $this->Superadmin_model->updateTask($upDataP13,$gap2->pid);

                      $upDataP14 = array(
                              'reg_acc_status' => '',
                            );
                      $upDataP14 = $this->security->xss_clean($upDataP14); // xss filter
                      $this->Superadmin_model->updateSubtask($upDataP14,$gap2->pid);

                      $upDataP16 = array(
                              'reg_acc_status' => '',
                            );
                      $upDataP16 = $this->security->xss_clean($upDataP16); // xss filter
                      $this->Superadmin_model->updateComments($upDataP16,$gap2->pid);
                    }
                  }


                  $upDataP15 = array(
                              'reg_acc_status' => '',
                            );
                  $upDataP15 = $this->security->xss_clean($upDataP15); // xss filter
                  $this->Superadmin_model->updateContent_planning2($upDataP15,$user_id);

            $singData1 = array(
                        'reg_acc_status' => '',
                      );
            $singData1 = $this->security->xss_clean($singData1); // xss filter
            $this->Superadmin_model->updateProject_portfolio_member2($singData1,$userD->email_address);

            $singData2 = array(
                        'reg_acc_status' => '',
                      );
            $singData2 = $this->security->xss_clean($singData2); // xss filter
            $this->Superadmin_model->updateProject_members2($singData2,$user_id);

            $singData3 = array(
                        'reg_acc_status' => '',
                      );
            $singData3 = $this->security->xss_clean($singData3); // xss filter
            $this->Superadmin_model->updateProject_files2($singData3,$user_id);

            $singData4 = array(
                        'reg_acc_status' => '',
                      );
            $singData4 = $this->security->xss_clean($singData4); // xss filter
            $this->Superadmin_model->updateProject_invited_members2($singData4,$user_id);

            $singData5 = array(
                        'reg_acc_status' => '',
                      );
            $singData5 = $this->security->xss_clean($singData5); // xss filter
            $this->Superadmin_model->updateProject_request_member2($singData5,$user_id);

            $singData6 = array(
                        'reg_acc_status' => '',
                      );
            $singData6 = $this->security->xss_clean($singData6); // xss filter
            $this->Superadmin_model->updateProject_suggested_members2($singData6,$user_id);

            $singData7 = array(
                        'reg_acc_status' => '',
                      );
            $singData7 = $this->security->xss_clean($singData7); // xss filter
            $this->Superadmin_model->updateTask2($singData7,$user_id);

            $singData8 = array(
                        'reg_acc_status' => '',
                      );
            $singData8 = $this->security->xss_clean($singData8); // xss filter
            $this->Superadmin_model->updateSubtask2($singData8,$user_id);     

            $singData2 = array(
                        'reg_acc_status' => '',
                      );
            $singData2 = $this->security->xss_clean($singData2); // xss filter
            $this->Superadmin_model->updateGoal_members2($singData2,$user_id);

            $singData4 = array(
                        'reg_acc_status' => '',
                      );
            $singData4 = $this->security->xss_clean($singData4); // xss filter
            $this->Superadmin_model->updateGoal_invited_members2($singData4,$user_id);

            $singData6 = array(
                        'reg_acc_status' => '',
                      );
            $singData6 = $this->security->xss_clean($singData6); // xss filter
            $this->Superadmin_model->updateGoal_suggested_members2($singData6,$user_id);       
            
          $this->session->set_flashdata('message',' Account Activated Successfully!');
          redirect(base_url('super-admin/registered-list'));
        }
        else
        {
          $this->session->set_flashdata('message',' Account Not Exists!');
          redirect(base_url('super-admin/registered-list'));
        }
      }
      else
      {
        redirect(base_url('super-admin/login'));
      }
    }
  }

  public function contacted_sales_list()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $data['list'] = $this->Superadmin_model->contacted_sales_list();
      $this->load->view('super_admin/contacted_sales_list', $data);    
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  public function delete_contactsales_req()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $id = $this->input->post('id');

      $this->Superadmin_model->delete_contactsales_req($id);       

      $response['status'] = TRUE;
      header('Content-type: application/json');
      echo json_encode($response);
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  public function ad_list()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $data['list'] = $this->Superadmin_model->ad_list();
      $data['active_packages'] = $this->Superadmin_model->active_packages();
      $this->load->view('super_admin/ad_list', $data);    
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  function insert_ad_header()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $this->form_validation->set_rules('pack_id','Package','trim|required');
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
        if(!empty($this->input->post('pack_id')))
        {
          $config['file_name'] = time().'_'.strtolower($_FILES['ad']['name']);
            $config['upload_path'] = 'assets/ad_header/';
            $config['allowed_types'] = 'png|PNG|jpg|JPG|jpeg|JPEG|webp|WEBP';
              //Load upload library and initialize configuration
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
             if($this->upload->do_upload('ad'))
             {
               $fileData = $this->upload->data();
               $uploadImage['image'] = $fileData['file_name'];
               $ad = $uploadImage['image'];
             }
             else
             {
                 $response['status'] = 'adErr';
                 $response['photoerr'] = $this->upload->display_errors();;
                 // You can use the Output class here too
               header('Content-type: application/json');
               //echo json_encode($response);
               exit(json_encode($response));
             }

          $data = array(
                        'astatus' => 'inactive',
                          );
          $data = $this->security->xss_clean($data); // xss filter
          $this->Superadmin_model->update_ad($data);

          $data2 = array(
                        'ad' => $ad,
                        'pack_id' => $this->input->post('pack_id'),
                        'acreated_by' => $this->session->userdata('d168_super_id'),
                        'acreated_date' => date('Y-m-d H:i:s'),
                        'astatus' => 'active',
                          );
                    $data2 = $this->security->xss_clean($data2); // xss filter
                    $this->Superadmin_model->insert_ad($data2); 

          $this->session->set_flashdata('message','Added Successfully!');
          $response['status'] = TRUE;
          header('Content-type: application/json');
          echo json_encode($response);
        }
        else
        {
                  $response['status'] = 'ad_emptyErr';
                 // You can use the Output class here too
               header('Content-type: application/json');
               //echo json_encode($response);
               exit(json_encode($response));
        }            
      }
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  function delete_ad_header()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
    $id = $this->input->post('id');
    $adetail = $this->Superadmin_model->ad_detail($id); 
    if($adetail)
    {
            $this->Superadmin_model->delete_ad($id);

            unlink("assets/ad_header/".$adetail->ad);

            $this->session->set_flashdata('message','Deleted Successfully!');
            $response['status'] = TRUE;
            header('Content-type: application/json');
            echo json_encode($response);
    }
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  public function change_ad_status()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $id = $this->input->post('id');
      $status = $this->input->post('status');
      if($status == 'active')
      {
        $data = array(
                        'astatus' => 'inactive',
                          );
          $data = $this->security->xss_clean($data); // xss filter
          $this->Superadmin_model->update_ad($data);
      }

      $data2 = array(
                          'astatus' => $status,
                    );
                      $data2 = $this->security->xss_clean($data2); // xss filter
                      $this->Superadmin_model->update_ad_specfic($data2,$id);
      $response['status'] = TRUE;
      header('Content-type: application/json');
      echo json_encode($response);
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  public function coupon_list()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $data['list'] = $this->Superadmin_model->coupon_list();
      $data['packs'] = $this->Superadmin_model->org_pricing_list();
      $this->load->view('super_admin/coupon_list', $data);    
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  public function get_pack_field_details()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $pack_id = $this->input->post('pack_clone');
      $pdetail = $this->Superadmin_model->package_detail($pack_id); 

        $response['pack_name'] = "";
        $response['pack_portfolio'] = "";
        $response['pack_goals'] = "";
        $response['pack_goals_strategies'] = "";
        $response['pack_projects'] = "";
        $response['pack_team_members'] = "";
        $response['pack_tasks'] = "";
        $response['pack_storage'] = "";
        $response['pack_content_planner'] = "";
        $response['pack_tagline'] = "";
        if($pdetail)
        {
          $response['pack_name'] = $pdetail->pack_name;
          $response['pack_portfolio'] = $pdetail->pack_portfolio;
          $response['pack_goals'] = $pdetail->pack_goals;
          $response['pack_goals_strategies'] = $pdetail->pack_goals_strategies;
          $response['pack_projects'] = $pdetail->pack_projects;
          $response['pack_team_members'] = $pdetail->pack_team_members;
          $response['pack_tasks'] = $pdetail->pack_tasks;
          $response['pack_storage'] = $pdetail->pack_storage;
          $response['pack_content_planner'] = $pdetail->pack_content_planner;
          $response['pack_tagline'] = $pdetail->pack_tagline;
        }

      header('Content-type: application/json');
      echo json_encode($response);
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  function insert_coupon()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $this->form_validation->set_rules('code','Code','trim|required|is_unique[pricing_pack_coupon.code]',array('is_unique' => 'Code already exists! Code must be unique!'));
      $this->form_validation->set_rules('co_validity','Validity','trim|required');
      $this->form_validation->set_rules('co_limit','Limit','trim|required');
      $this->form_validation->set_rules('pack_name','Package Name','trim|required');
      $this->form_validation->set_rules('pack_portfolio','Portfolio','trim|required');
      $this->form_validation->set_rules('pack_goals','Goals','trim|required');
      $this->form_validation->set_rules('pack_goals_strategies','KPIs','trim|required');
      //$this->form_validation->set_rules('pack_goals_strategies_projects','KPI projects','trim|required');
      $this->form_validation->set_rules('pack_projects','Projects','trim|required');
      $this->form_validation->set_rules('pack_team_members','Team Members','trim|required');
      $this->form_validation->set_rules('pack_tasks','Tasks','trim|required');
      $this->form_validation->set_rules('pack_storage','Storage','trim|required');
      $this->form_validation->set_rules('pack_content_planner','Content Planner','trim|required');
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
        //insert package
          $data2 = array(
                          'stripe_link' => 'no',
                          'pack_name' => $this->input->post('pack_name'),
                          'pack_validity' => $this->input->post('co_validity'),
                          'pack_price' => '0',
                          'pack_portfolio' => $this->input->post('pack_portfolio'),
                          'pack_goals' => $this->input->post('pack_goals'),
                          'pack_goals_strategies' => $this->input->post('pack_goals_strategies'),
                          //'pack_goals_strategies_projects' => $this->input->post('pack_goals_strategies_projects'),
                          'pack_projects' => $this->input->post('pack_projects'),
                          'pack_team_members' => $this->input->post('pack_team_members'),
                          'pack_tasks' => $this->input->post('pack_tasks'),
                          'pack_storage' => $this->input->post('pack_storage'),
                          'pack_content_planner' => $this->input->post('pack_content_planner'),
                          'pack_tagline' => $this->input->post('pack_tagline'),
                          'pack_created_date' => date('Y-m-d'),
                          'pack_status' => 'active',
                          'custom_pack' => 'no',
                          'coupon_pack' => 'yes', 
                            );
                      $data2 = $this->security->xss_clean($data2); // xss filter
                      $this->Superadmin_model->insert_package($data2);
                      $inserted_id = $this->db->insert_id();

          //insert package labels
          $data3 = array(
                          'pack_id' => $inserted_id,
                          'portfolio' => 'portfolio',
                          'goals' => 'goals',
                          'goals_strategies' => 'KPIs per goal',
                          'goals_strategies_projects' => 'projects per KPIs',
                          'projects' => 'active projects',
                          'team_members' => 'team members',
                          'task' => 'task',
                          'storage' => 'storage',
                          'accountability_tracking' => 'accountability tracking',
                          'document_collaboration' => 'document collaboration',
                          'kanban_boards' => 'kanban boards',
                          'motivator' => 'motivator',
                          'internal_chat' => 'internal chat',
                          'content_planner' => 'posts / mo. content planner',
                          'data_recovery' => 'data recovery',
                          'email_support' => '24/7 email support',
                            );
                      $data3 = $this->security->xss_clean($data3); // xss filter
                      $this->Superadmin_model->insert_pricing_labels($data3);

          // $data = array(
          //               'co_status' => 'inactive',
          //                 );
          // $data = $this->security->xss_clean($data); // xss filter
          // $this->Superadmin_model->update_coupon($data);

          $data2 = array(
                        'code' => $this->input->post('code'),
                        'co_validity' => $this->input->post('co_validity'),
                        'created_by' => $this->session->userdata('d168_super_id'),
                        'created_date' => date('Y-m-d H:i:s'),
                        'co_status' => 'active',
                        'co_limit' => $this->input->post('co_limit'),
                        'pack_id' => $inserted_id,
                          );
                    $data2 = $this->security->xss_clean($data2); // xss filter
                    $this->Superadmin_model->insert_coupon($data2); 

          $this->session->set_flashdata('message','Added Successfully!');
          $response['status'] = TRUE;
          header('Content-type: application/json');
          echo json_encode($response); 
      }
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  public function CouponEdit_Modal()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $co_id = $this->input->post('co_id');
      $pack_id = $this->input->post('pack_id');
      //echo $id;
      //die();
      $data['cdetail'] = $this->Superadmin_model->coupon_detail($co_id);
      $data['pdetail'] = $this->Superadmin_model->package_detail($pack_id); 
      $this->load->view('super_admin/coupon-edit-modal',$data);   
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  function edit_coupon()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $this->form_validation->set_rules('code','Code','trim|required');
      $this->form_validation->set_rules('co_validity','Validity','trim|required');
      $this->form_validation->set_rules('co_limit','Limit','trim|required');
      $this->form_validation->set_rules('pack_name','Package Name','trim|required');
      $this->form_validation->set_rules('pack_portfolio','Portfolio','trim|required');
      $this->form_validation->set_rules('pack_goals','Goals','trim|required');
      $this->form_validation->set_rules('pack_goals_strategies','KPIs','trim|required');
      //$this->form_validation->set_rules('pack_goals_strategies_projects','KPI projects','trim|required');
      $this->form_validation->set_rules('pack_projects','Projects','trim|required');
      $this->form_validation->set_rules('pack_team_members','Team Members','trim|required');
      $this->form_validation->set_rules('pack_tasks','Tasks','trim|required');
      $this->form_validation->set_rules('pack_storage','Storage','trim|required');
      $this->form_validation->set_rules('pack_content_planner','Content Planner','trim|required');
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
        $co_id = $this->input->post('co_id');
        $pack_id = $this->input->post('pack_id');
        //insert package
          $data2 = array(
                          'pack_name' => $this->input->post('pack_name'),
                          'pack_validity' => $this->input->post('co_validity'),
                          'pack_price' => '0',
                          'pack_portfolio' => $this->input->post('pack_portfolio'),
                          'pack_goals' => $this->input->post('pack_goals'),
                          'pack_goals_strategies' => $this->input->post('pack_goals_strategies'),
                          //'pack_goals_strategies_projects' => $this->input->post('pack_goals_strategies_projects'),
                          'pack_projects' => $this->input->post('pack_projects'),
                          'pack_team_members' => $this->input->post('pack_team_members'),
                          'pack_tasks' => $this->input->post('pack_tasks'),
                          'pack_storage' => $this->input->post('pack_storage'),
                          'pack_content_planner' => $this->input->post('pack_content_planner'),
                          'pack_tagline' => $this->input->post('pack_tagline'),
                            );
                      $data2 = $this->security->xss_clean($data2); // xss filter
                      $this->Superadmin_model->edit_package($data2,$pack_id);

          $data12 = array(
                        'code' => $this->input->post('code'),
                        'co_validity' => $this->input->post('co_validity'),
                        'co_limit' => $this->input->post('co_limit'),
                          );
                    $data12 = $this->security->xss_clean($data12); // xss filter
                    $this->Superadmin_model->edit_coupon($data12,$co_id); 

          $this->session->set_flashdata('message','Updated Successfully!');
          $response['status'] = TRUE;
          header('Content-type: application/json');
          echo json_encode($response); 
      }
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  public function coupon_used_users()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $co_id = $this->uri->segment(3);
      $data['cdetail'] = $this->Superadmin_model->coupon_detail($co_id);
      $data['all_users_coupon'] = $this->Superadmin_model->all_users_coupon();
      $data['currently_used'] = $this->Superadmin_model->users_active_coupon_list($co_id);
      $this->load->view('super_admin/coupon-used-users',$data);   
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  public function change_coupon_status()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $id = $this->input->post('id');
      $status = $this->input->post('status');
      // if($status == 'active')
      // {
      //   $data = array(
      //                   'co_status' => 'inactive',
      //                     );
      //     $data = $this->security->xss_clean($data); // xss filter
      //     $this->Superadmin_model->update_coupon($data);
      // }

      $data2 = array(
                          'co_status' => $status,
                    );
                      $data2 = $this->security->xss_clean($data2); // xss filter
                      $this->Superadmin_model->edit_coupon($data2,$id);
      $response['status'] = TRUE;
      header('Content-type: application/json');
      echo json_encode($response);
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  // Support functions ------//-----//----//----//----
  
  public function support()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $data['tickets_del'] = $this->Superadmin_model->getAllTickets();
      $data['supporters'] = $this->Superadmin_model->getSupporters();
      $this->load->view('super_admin/support',$data);
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  public function ticketOverview_Modal()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $ticket_id = $this->input->post('id');
      $data['tickets_del'] = $this->Superadmin_model->getTicketById($ticket_id);
      $data['supporters'] = $this->Superadmin_model->getSupporters();
      echo '<div class="modal-header">
        <h5 class="modal-title mt-0" id="ticketOverviewModalLabel">T-'.$data["tickets_del"]->unique_id.'</h5> &nbsp;&nbsp; <a href="'.base_url("super-admin/ticket-overview/".$ticket_id).'" class="btn btn-sm btn-d text-white">Open</a>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>';
      $this->load->view('super_admin/ticket-overview-modal',$data);    
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  public function download_TicketFileAttachment()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $tfile_name = $this->uri->segment(3);
      $pth = file_get_contents('https://support.app.decision168.com/assets/ticket_files/'.$tfile_name);
      $nme = $tfile_name;
      force_download($nme, $pth);
    }
    else
    {
      redirect(base_url('super-admin/login'));
    } 
  }

  public function preview_ticket_file()
  {
        if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
        {
            $tfile_name = $this->input->post('tfile_name');
            $tid = $this->input->post('tid');
            $getExt = pathinfo($tfile_name, PATHINFO_EXTENSION); 
            //echo $getExt;
            if($getExt == 'jpg' || $getExt == 'JPG' || $getExt == 'jpeg' || $getExt == 'JPEG' || $getExt == 'png' || $getExt == 'PNG' || $getExt == 'svg' || $getExt == 'SVG' || $getExt == 'webp' || $getExt == 'WEBP')
            {
              echo '<div class="modal-header">
                    <h5 class="modal-title mt-0" id="previewTaskModalLabel">'.substr($tfile_name, strpos($tfile_name, '_') + 1).'</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body" style="height:400px">
                       <img src="https://support.app.decision168.com/assets/ticket_files/'.$tfile_name .'" height="100%" width="100%">                    
                  </div>
                  <div class="modal-footer">
                      <a href="'.base_url().'superadmin/download_ticketFileAttachment/'.$tfile_name.'/'.$tid.'" class="btn btn-sm btn-d text-white">Download</a>
                  </div>';
            }
            elseif($getExt == 'pdf' || $getExt == 'PDF' || $getExt == 'gif' || $getExt == 'GIF' || $getExt == 'txt' || $getExt == 'TXT')
            {
              echo '<div class="modal-header">
                    <h5 class="modal-title mt-0" id="previewTaskModalLabel">'.substr($tfile_name, strpos($tfile_name, '_') + 1).'</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body" style="height:400px">
                       <iframe src="https://support.app.decision168.com/assets/ticket_files/'.$tfile_name .'" height="100%" width="100%"></iframe>                      
                  </div>
                  <div class="modal-footer">
                      <a href="'.base_url().'superadmin/download_ticketFileAttachment/'.$tfile_name.'/'.$tid.'" class="btn btn-sm btn-d text-white">Download</a>
                  </div>';
            }
            elseif($getExt == 'mp4' || $getExt == 'MP4' || $getExt == 'mov' || $getExt == 'MOV' || $getExt == 'webm' || $getExt == 'WEBM' || $getExt == 'mkv'  || $getExt == 'MKV')
            {
                echo '<div class="modal-header">
                    <h5 class="modal-title mt-0" id="previewTaskModalLabel">'.substr($tfile_name, strpos($tfile_name, '_') + 1).'</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body" style="height:400px">
                      <video height="100%" width="100%" controls autoplay>
                        <source src="https://support.app.decision168.com/assets/ticket_files/'.$tfile_name .'">
                      </video>                            
                  </div>
                  <div class="modal-footer">
                      <a href="'.base_url().'superadmin/download_ticketFileAttachment/'.$tfile_name.'/'.$tid.'" class="btn btn-sm btn-d text-white">Download</a>
                  </div>';
            }
            elseif($getExt == 'csv' || $getExt == 'CSV')
            {
              $url = 'https://support.app.decision168.com/assets/ticket_files/'.$tfile_name;
              echo "<div class='modal-header'>
                    <h5 class='modal-title mt-0' id='previewTaskModalLabel'>".substr($tfile_name, strpos($tfile_name, "_") + 1)."</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                  </div>
                  <div class='modal-body' style='height:400px'>
                      <iframe src='https://docs.google.com/viewer?embedded=true&url=$url' width='100%' height='100%' allowfullscreen webkitallowfullscreen></iframe>                          
                  </div>
                  <div class='modal-footer'>
                      <a href='".base_url()."superadmin/download_ticketFileAttachment/".$tfile_name."/".$tid."' class='btn btn-sm btn-d text-white'>Download</a>
                  </div>";
            }
            else
            {
              $url = 'https://support.app.decision168.com/assets/ticket_files/'.$tfile_name;
              echo "<div class='modal-header'>
                    <h5 class='modal-title mt-0' id='previewTaskModalLabel'>".substr($tfile_name, strpos($tfile_name, "_") + 1)."</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                  </div>
                  <div class='modal-body' style='height:400px'>
                      <iframe src='https://view.officeapps.live.com/op/embed.aspx?src=$url' width='100%' height='100%' allowfullscreen webkitallowfullscreen></iframe>                          
                  </div>
                  <div class='modal-footer'>
                      <a href='".base_url()."superadmin/download_ticketFileAttachment/".$tfile_name."/".$tid."' class='btn btn-sm btn-d text-white'>Download</a>
                  </div>";
            }          
        } 
        else 
        {
            redirect(base_url('super-admin/login'));
        }
  }

  public function assign_ticket()
  {
    $ticket_id = $this->input->post('ticket_id');
    $ticket_del = $this->Superadmin_model->getTicketById($ticket_id);
    $supporter_id = $this->input->post('supporter_id');
    $stud_del = $this->Superadmin_model->getStudentById($supporter_id);
    $status_date = date('Y-m-d H:i:s');
    if($ticket_del->notify != ''){
      $notify = $ticket_del->notify.',';
    }else{
      $notify = '';
    }
    $data = array(  'status' => 'assigned',
                    'assignee' => $supporter_id,
                    'assigned_date' => $status_date,
                    'assigned_by' => 0,
                    'notify' => $notify.'ticket_assigned',
                    'notify_date' => $status_date,
                  );
    $data = $this->security->xss_clean($data); // xss filter
    $this->Superadmin_model->update_ticket($data,$ticket_id);

    $data = array(  'ticket_id' => $ticket_id,
                    'assignee_id' => $supporter_id,
                    'assigned_by' => 0,
                    'h_description' => 'Assigned the Ticket',
                    'h_date' => $status_date,
                  );
    $data = $this->security->xss_clean($data); // xss filter
    $this->Superadmin_model->insert_ticket_history($data);

    $response['status'] = 'assigned';
    $response['username'] = $stud_del->first_name.' '.$stud_del->last_name;

    $email_to = $stud_del->email_address;
    $email_from = 'hello@decision168.com'; 
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
    $this->email->subject('Ticket Assigned By Support Admin| Decision 168');
    $this->email->message('                 
      <!doctype html>
      <html lang="en-US">

      <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <title>Ticket Assigned</title>
        <meta name="description" content="Ticket Assigned">
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
                                            <h1 style="color:#c7df19; font-weight:600; margin:0;font-size:33px;font-family:Rubik,sans-serif;">Ticket Assigned</h1>
                                            <span
                                                style="display:inline-block; vertical-align:middle; margin:29px 0 29px; border-bottom:2px solid #cecece; width:270px;"></span>
                                            <p style="color:#fff; font-size:15px;line-height:24px;text-align:left; margin:0;">
                                            Hello '.ucfirst($stud_del->first_name).' '.ucfirst($stud_del->last_name).',<br><br>
                                                Support Admin has assigned a new ticket T-'.$ticket_del->unique_id.' for Support. Please Sign In to resolve the ticket.      
                                                <br><br> 
                                            </p>
                                            <a href="'.base_url().'"
                                            style="background:#c7df19;text-decoration:none !important; font-weight:600; margin:20px; color:#fff;border:4px solid #c7df19;text-transform:uppercase; font-size:15px;padding:10px 30px;display:inline-block;border-radius:10px;">Sign In</a>
                                            
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

      </html>' 
    );
    $this->email->send();
    $status_date = date('Y-m-d',strtotime($status_date));
    $response['status_date'] = $status_date;
    header('Content-type: application/json');
    echo json_encode($response);
  }

  public function addSupporter()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $supporter_email_array = '';
      if($this->input->post('supporter_email') || $this->input->post('selected_S_member')){
        if($this->input->post('supporter_email'))
        {
          $this->form_validation->set_rules('supporter_email[]','Email Address','valid_email|trim');
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
            $supporter_email_array = $this->input->post('supporter_email');
            foreach ($supporter_email_array as $sea) {
              $supEA = $this->Superadmin_model->checkIfSupporterByEmail($sea);
              if($supEA){
                $response['status'] = 'already_supporter';
                header('Content-type: application/json');
                exit(json_encode($response));
              }

              $supEA1 = $this->Superadmin_model->checkSupporterEmailExists1($sea);
              if($supEA1){
                $response['status'] = 'already_invited';
                header('Content-type: application/json');
                exit(json_encode($response));
              }

              $supEA2 = $this->Superadmin_model->checkSupporterEmailExists2($sea);
              if($supEA2){
                $response['status'] = 'already_invited';
                header('Content-type: application/json');
                exit(json_encode($response));
              }
            }
          }             
        }

        if($this->input->post('selected_S_member'))
        {
          $supporter_member_array = explode(',', $this->input->post('selected_S_member'));
          foreach ($supporter_member_array as $sma) {
            $supEA3 = $this->Superadmin_model->checkSupporterIDExists($sma);
            if($supEA3){
              $response['status'] = 'already_invited';
              header('Content-type: application/json');
              exit(json_encode($response));
            }
          }

          foreach ($supporter_member_array as $sma) {
            $data = array('supporter_mail' => 1, 
                          'supporter_approve' => '',
                          'supporter_status' => 'active',
                          'supporter_mail_date' => date('Y-m-d H:i:s'),
                        );
            $data = $this->security->xss_clean($data); // xss filter
            $this->Superadmin_model->updateRegistration($data,$sma);
            $stud_del = $this->Superadmin_model->getStudentById($sma);
            $email_to = $stud_del->email_address;
            $email_from = 'hello@decision168.com'; 
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
            $this->email->subject('Invitation to be Supporter | Decision 168');
            $this->email->message('                 
              <!doctype html>
              <html lang="en-US">

              <head>
                <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
                <title>Invitation to be Supporter</title>
                <meta name="description" content="Invitation to be Supporter">
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
                                                    <h1 style="color:#c7df19; font-weight:600; margin:0;font-size:33px;font-family:Rubik,sans-serif;">Invitation to be Supporter</h1>
                                                    <span
                                                        style="display:inline-block; vertical-align:middle; margin:29px 0 29px; border-bottom:2px solid #cecece; width:270px;"></span>
                                                    <p style="color:#fff; font-size:15px;line-height:24px;text-align:left; margin:0;">
                                                    Hello '.ucfirst($stud_del->first_name).' '.ucfirst($stud_del->last_name).',<br><br>
                                                        Support Admin has requested you to be a supporter of Decision168 platform. Please click on the appropriate button below to the approve the request. 
                                                        <br><br> 
                                                    </p>
                                                    <a href="'.base_url('supporter-invitation/approve/'.$sma).'"
                                                style="background:#c7df19;text-decoration:none !important; font-weight:600; margin:20px; color:#fff;border:4px solid #c7df19;text-transform:uppercase; font-size:15px;padding:10px 30px;display:inline-block;border-radius:10px;">Approve</a>
                                                <a href="'.base_url('supporter-invitation/deny/'.$sma).'"
                                                    style="text-decoration:none !important; font-weight:600; margin:20px; color:#c7df19;border:4px solid #c7df19;text-transform:uppercase; font-size:15px;padding:10px 30px;display:inline-block;border-radius:10px;">Deny</a> 
                                                    
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

              </html>' 
            );
            $this->email->send();
          }
        }

        if($this->input->post('supporter_email'))
        {
          $supporter_email_array = $this->input->post('supporter_email');
          foreach ($supporter_email_array as $sea) {
            $email_exists = $this->Superadmin_model->checkIfSupporterEmailExists($sea);
            if($email_exists){
              $reg_id = $email_exists->reg_id;
              $data = array('supporter_mail' => 1, 
                            'supporter_approve' => '',
                            'supporter_status' => 'active',
                            'supporter_mail_date' => date('Y-m-d H:i:s'),
                          );
              $data = $this->security->xss_clean($data); // xss filter
              $this->Superadmin_model->updateRegistration($data,$reg_id);
              $stud_del = $this->Superadmin_model->getStudentById($reg_id);
              $email_to = $stud_del->email_address;
              $email_from = 'hello@decision168.com'; 
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
              $this->email->subject('Invitation to be Supporter | Decision 168');
              $this->email->message('                 
                <!doctype html>
                <html lang="en-US">

                <head>
                  <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
                  <title>Invitation to be Supporter</title>
                  <meta name="description" content="Invitation to be Supporter">
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
                                                      <h1 style="color:#c7df19; font-weight:600; margin:0;font-size:33px;font-family:Rubik,sans-serif;">Invitation to be Supporter</h1>
                                                      <span
                                                          style="display:inline-block; vertical-align:middle; margin:29px 0 29px; border-bottom:2px solid #cecece; width:270px;"></span>
                                                      <p style="color:#fff; font-size:15px;line-height:24px;text-align:left; margin:0;">
                                                      Hello '.ucfirst($stud_del->first_name).' '.ucfirst($stud_del->last_name).',<br><br>
                                                          Support Admin has requested you to be a supporter of Decision168 platform. Please click on the appropriate button below to the approve the request. 
                                                          <br><br> 
                                                      </p>
                                                      <a href="'.base_url('supporter-invitation/approve/'.$reg_id).'"
                                                  style="background:#c7df19;text-decoration:none !important; font-weight:600; margin:20px; color:#fff;border:4px solid #c7df19;text-transform:uppercase; font-size:15px;padding:10px 30px;display:inline-block;border-radius:10px;">Approve</a>
                                                  <a href="'.base_url('supporter-invitation/deny/'.$reg_id).'"
                                                      style="text-decoration:none !important; font-weight:600; margin:20px; color:#c7df19;border:4px solid #c7df19;text-transform:uppercase; font-size:15px;padding:10px 30px;display:inline-block;border-radius:10px;">Deny</a> 
                                                      
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

                </html>' 
              );
              $this->email->send();
            }else{
              $data = array('email_address' => $sea, 
                            'approve' => '',
                            'sent_on' => date('Y-m-d H:i:s'),
                          );
              $data = $this->security->xss_clean($data); // xss filter
              $this->Superadmin_model->insert_inviteSupporter($data);
              $email_to = $sea;
              $email_from = 'hello@decision168.com'; 
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
              $this->email->subject('Invitation to be Supporter | Decision 168');
              $this->email->message('                 
                <!doctype html>
                <html lang="en-US">

                <head>
                  <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
                  <title>Invitation to be Supporter</title>
                  <meta name="description" content="Invitation to be Supporter">
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
                                                      <h1 style="color:#c7df19; font-weight:600; margin:0;font-size:33px;font-family:Rubik,sans-serif;">Invitation to be Supporter</h1>
                                                      <span
                                                          style="display:inline-block; vertical-align:middle; margin:29px 0 29px; border-bottom:2px solid #cecece; width:270px;"></span>
                                                      <p style="color:#fff; font-size:15px;line-height:24px;text-align:left; margin:0;">
                                                      Hello '.$sea.',<br><br>
                                                          Support Admin has requested you to be a supporter of Decision168 platform. Pleas e click on the appropriate button below to the approve the request. 
                                                          <br><br> 
                                                      </p>
                                                      <a href="'.base_url('supporter-invitation-through-email/approve/'.$sea).'"
                                                  style="background:#c7df19;text-decoration:none !important; font-weight:600; margin:20px; color:#fff;border:4px solid #c7df19;text-transform:uppercase; font-size:15px;padding:10px 30px;display:inline-block;border-radius:10px;">Approve</a>
                                                  <a href="'.base_url('supporter-invitation-through-email/deny/'.$sea).'"
                                                      style="text-decoration:none !important; font-weight:600; margin:20px; color:#c7df19;border:4px solid #c7df19;text-transform:uppercase; font-size:15px;padding:10px 30px;display:inline-block;border-radius:10px;">Deny</a> 
                                                      
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

                </html>' 
              );
              $this->email->send();
            }
          }            
        }
        $this->session->set_flashdata('message', 'Successfully Invited');
        $response['status'] = TRUE;
        header('Content-type: application/json');
        echo json_encode($response);

      }else{
        $response['status'] = 'empty_supporter';
        header('Content-type: application/json');
        exit(json_encode($response));
      }
    }
    else
    {
      redirect(base_url('login'));
    } 
  }

  public function supporter_invitation()
  {
    $status = $this->uri->segment(2);
    $reg_id = $this->uri->segment(3);

    if($status == 'approve'){
      $check_approve = $this->Superadmin_model->checkIfSupporterApprove($reg_id);
      $check_deny = $this->Superadmin_model->checkIfSupporterDeny($reg_id);
      if($check_approve)
      {
        $data['invite_status'] = 'already_approved';
      }
      else if($check_deny)
      {
        $data['invite_status'] = 'already_denied';
      }
      else
      {
        $data = array('supporter_approve' => 'yes',
                      'role' => 'supporter',
                      'supporter_status' => 'active',
                     );
        $data = $this->security->xss_clean($data); // xss filter
        $this->Superadmin_model->updateRegistration($data,$reg_id);
        $data['invite_status'] = 'approved';
      }
    }else{
      $check_approve = $this->Superadmin_model->checkIfSupporterApprove($reg_id);
      $check_deny = $this->Superadmin_model->checkIfSupporterDeny($reg_id);
      if($check_approve)
      {
        $data['invite_status'] = 'already_approved';
      }
      else if($check_deny)
      {
        $data['invite_status'] = 'already_denied';
      }
      else
      {
        $data = array('supporter_approve' => 'no',
                      'supporter_status' => '',
                    );
        $data = $this->security->xss_clean($data); // xss filter
        $this->Superadmin_model->updateRegistration($data,$reg_id);
        $data['invite_status'] = 'denied';
      }
    }
    $this->load->view('super_admin/supporter_invitation',$data);
  }

  public function supporter_invitation_through_email()
  {
    $status = $this->uri->segment(2);
    $email_address = $this->uri->segment(3);

    $email_exists = $this->Superadmin_model->checkIfSupporterEmailExists($email_address);
    if($email_exists){
      $reg_id = $email_exists->reg_id;
      if($status == 'approve'){
        $check_approve = $this->Superadmin_model->checkIfSupporterApprove($reg_id);
        $check_deny = $this->Superadmin_model->checkIfSupporterDeny($reg_id);
        if($check_approve)
        {
          $data['invite_status'] = 'already_approved';
        }
        else if($check_deny)
        {
          $data['invite_status'] = 'already_denied';
        }
        else
        {
          $data = array('supporter_mail' => '1',
                        'role' => 'supporter',
                        'supporter_approve' => 'yes',
                        'supporter_status' => 'active',
                      );
          $data = $this->security->xss_clean($data); // xss filter
          $this->Superadmin_model->updateRegistration($data,$reg_id);

          $data = array('approve' => 'yes' );
          $data = $this->security->xss_clean($data); // xss filter
          $this->Superadmin_model->updateInvitedSupporter($data,$email_address);

          $data['invite_status'] = 'approved';
        }
      }else{
        $check_approve = $this->Superadmin_model->checkIfSupporterApprove($reg_id);
        $check_deny = $this->Superadmin_model->checkIfSupporterDeny($reg_id);
        if($check_approve)
        {
          $data['invite_status'] = 'already_approved';
        }
        else if($check_deny)
        {
          $data['invite_status'] = 'already_denied';
        }
        else
        {
          $data = array('supporter_approve' => 'no',
                        'supporter_status' => '',
                      );
          $data = $this->security->xss_clean($data); // xss filter
          $this->Superadmin_model->updateRegistration($data,$reg_id);
          $data['invite_status'] = 'denied';
        }
      }
      $this->load->view('super_admin/supporter_invitation',$data);
    }else{
      if($status == 'approve'){
        $check_approve = $this->Superadmin_model->checkIfSupporterEmailApprove($email_address);
        $check_deny = $this->Superadmin_model->checkIfSupporterEmailDeny($email_address);
        if($check_approve)
        {
          $data['invite_status'] = 'already_approved';
        }
        else if($check_deny)
        {
          $data['invite_status'] = 'already_denied';
        }
        else
        {
          $data = array('approve' => 'yes' );
          $data = $this->security->xss_clean($data); // xss filter
          $this->Superadmin_model->updateInvitedSupporter($data,$email_address);
          $data['invite_status'] = 'approved';
        }
        redirect(base_url('register'));
      }else{
        $check_approve = $this->Superadmin_model->checkIfSupporterEmailApprove($email_address);
        $check_deny = $this->Superadmin_model->checkIfSupporterEmailDeny($email_address);
        if($check_approve)
        {
          $data['invite_status'] = 'already_approved';
        }
        else if($check_deny)
        {
          $data['invite_status'] = 'already_denied';
        }
        else
        {
          $data = array('approve' => 'no' );
          $data = $this->security->xss_clean($data); // xss filter
          $this->Superadmin_model->updateInvitedSupporter($data,$email_address);
          $data['invite_status'] = 'denied';
        }
        $this->load->view('super_admin/supporter_invitation',$data);
      }      
    }
  }

  public function remove_ticket_notification(){
    $status = $this->input->post('status');
    $ticket_id = $this->input->post('ticket_id');
    $ticket_del = $this->Superadmin_model->getTicketById($ticket_id);
    $t_array = explode(',', $ticket_del->notify);
    $position = array_search($status,$t_array);
    unset($t_array[$position]);
    if($t_array){
      $notify = implode(',', $t_array);
    }else{
      $notify = "";
    }
    $data = array( 'notify' => $notify );
    $data = $this->security->xss_clean($data); // xss filter
    $this->Superadmin_model->update_ticket($data,$ticket_id);
  }

  public function show_ticket_notification()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $status = $this->input->post('status');
      $ticket_id = $this->input->post('ticket_id');
      $ticket_del = $this->Superadmin_model->getTicketById($ticket_id);
      $t_array = explode(',', $ticket_del->notify);
      $position = array_search($status,$t_array);
      unset($t_array[$position]);
      if($t_array){
        $notify = implode(',', $t_array);
      }else{
        $notify = "";
      }
      $data = array( 'notify' => $notify );
      $data = $this->security->xss_clean($data); // xss filter
      $this->Superadmin_model->update_ticket($data,$ticket_id);
      
      $data['tickets_del'] = $this->Superadmin_model->getTicketById($ticket_id);
      $data['supporters'] = $this->Superadmin_model->getSupporters();
      echo '<div class="modal-header">
        <h5 class="modal-title mt-0" id="ticketOverviewModalLabel">T-'.$data["tickets_del"]->unique_id.'</h5> &nbsp;&nbsp; <a href="'.base_url("super-admin/ticket-overview/".$ticket_id).'" class="btn btn-sm btn-d text-white">Open</a>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>';
      $this->load->view('super_admin/ticket-overview-modal',$data);    
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  public function AllNotificationClearYes()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $ticket_notifications = $this->Superadmin_model->getMyNotifiedTickets();
      if($ticket_notifications){
          $tn_cnt = 1;
          foreach ($ticket_notifications as $tn) {
              $ticket_notify_status = explode(',', $tn->notify);
              if($ticket_notify_status){
                  foreach ($ticket_notify_status as $tns) {
                      if($tns == 'ticket_created'){
                        $status = $tns;
                        $ticket_id = $tn->ticket_id;
                        $ticket_del = $this->Superadmin_model->getTicketById($ticket_id);
                        $t_array = explode(',', $ticket_del->notify);
                        $position = array_search($status,$t_array);
                        unset($t_array[$position]);
                        if($t_array){
                          $notify = implode(',', $t_array);
                        }else{
                          $notify = "";
                        }
                        $data = array( 'notify' => $notify );
                        $data = $this->security->xss_clean($data); // xss filter
                        $this->Superadmin_model->update_ticket($data,$ticket_id);
                      }                      
                      $tn_cnt++;
                  }
              }
          }
      }
    }
    else
    {
      redirect(base_url('login'));
    } 
  }

  public function registered_supporters()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $data['list'] = $this->Superadmin_model->registered_supporters();
      $data['elist'] = $this->Superadmin_model->registered_supporter_emails();
      $this->load->view('super_admin/registered_supporters', $data);    
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  public function ticketComment_Modal()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $ticket_id = $this->input->post('id');
      $data['tickets_del'] = $this->Superadmin_model->getTicketById($ticket_id);
      echo '<div class="modal-header">
        <h5 class="modal-title mt-0" id="ticketCommentModalLabel">T-'.$data["tickets_del"]->unique_id.'</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>';
      $this->load->view('super_admin/ticket-comment-modal',$data);    
    }
    else
    {
      redirect(base_url('login'));
    }
  }

  public function insert_ticket_chat()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $this->form_validation->set_rules('message','Message','trim|required');
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
          $data = array(  'ticket_id' => $this->input->post('ticket_id'),  
                          'message' => $this->input->post('message'),
                          'user_id' => 0,
                          'user_role' => 'superadmin',
                          'status' => 'active',
                          'message_date' => date('Y-m-d H:i:s'),
                        );
          $data = $this->security->xss_clean($data); // xss filter
          $this->Superadmin_model->insert_ticket_chat($data);
          $inserted_id = $this->db->insert_id();   

          $ticket_id = $this->input->post('ticket_id');
          $data['tickets_del'] = $this->Superadmin_model->getTicketById($ticket_id);
          $user_id = $data['tickets_del']->created_by;
          $supporter_id = $data['tickets_del']->assignee;
          $stud_del = $this->Superadmin_model->getStudentById($user_id);
          $supp_del = $this->Superadmin_model->getStudentById($supporter_id);
          if($supp_del){
            $email_to = $stud_del->email_address.','.$supp_del->email_address;
          }else{
            $email_to = $stud_del->email_address;
          }

          $email_from = 'hello@decision168.com'; 
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
          $this->email->subject('Your Ticket has been updated | Decision 168');
          $this->email->message('                 
            <!doctype html>
            <html lang="en-US">

            <head>
              <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
              <title>Your Ticket has been updated</title>
              <meta name="description" content="Your Ticket has been updated">
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
                                                  <h1 style="color:#c7df19; font-weight:600; margin:0;font-size:33px;font-family:Rubik,sans-serif;">Your Ticket has been updated</h1>
                                                  <span
                                                      style="display:inline-block; vertical-align:middle; margin:29px 0 29px; border-bottom:2px solid #cecece; width:270px;"></span>
                                                  <p style="color:#fff; font-size:15px;line-height:24px;text-align:left; margin:0;">
                                                  Hello,<br><br>
                                                      Support Admin have replied to your ticket <br>
                                                      Ticket ID: T-'.$data['tickets_del']->unique_id.' <br>
                                                      Ticket Subject: '.$data['tickets_del']->subject.' <br>
                                                      Opened on: '.$data['tickets_del']->opened_date.'  
                                                      <br><br> 
                                                      You may review the reply and update the ticket if necessary
                                                  </p>
                                                  <a href="'.base_url('').'"
                                                  style="background:#c7df19;text-decoration:none !important; font-weight:600; margin:20px; color:#fff;border:4px solid #c7df19;text-transform:uppercase; font-size:15px;padding:10px 30px;display:inline-block;border-radius:10px;">Sign In</a>
                                                  
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

            </html>' 
          );
          $this->email->send();

          echo '<div class="modal-header">
            <h5 class="modal-title mt-0" id="ticketCommentModalLabel">T-'.$data["tickets_del"]->unique_id.'</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>';
          $this->load->view('super_admin/ticket-comment-modal',$data);
        }
    }
    else
    {
      redirect(base_url('login'));
    }
  }

  public function delete_ticket_chat()
  {
    $chat_id = $this->input->post('chat_id');
    $data = array(  'status' => 'inactive',
                    'delete_date' => date('Y-m-d H:i:s'),
                 );
    $data = $this->security->xss_clean($data); // xss filter
    $this->Superadmin_model->update_ticket_chat($data,$chat_id);
  }

  public function ticketOverview()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $ticket_id = $this->uri->segment(3);
      $data['tickets_del'] = $this->Superadmin_model->getTicketById($ticket_id);
      $data['supporters'] = $this->Superadmin_model->getSupporters();
      $data['view_history_date'] = $this->Superadmin_model->view_history_date($ticket_id);
      $this->load->view('super_admin/ticket-overview',$data);    
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  public function view_ticket_history_date_wise()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $ticket_id = $this->input->post('ticket_id');
      $hdate = $this->input->post('hdate');
      $tickets_del = $this->Superadmin_model->getTicketById($ticket_id);
      $view_history = $this->Superadmin_model->view_history($ticket_id,$hdate);
            if($view_history) 
            {   
              $hist_cnt=0; 
              foreach($view_history as $vh)
              {  
            ?>
            <li class="event-list" style="padding: 0 0 10px 15px !important;">
              <div class="event-timeline-dot">
                <i class="bx bx-right-arrow-circle font-size-18"></i>
              </div>
              <div class="media">
                  <div class="me-3" style="padding-top: 2px;">
                        <h5 class="font-size-14"><?php echo date("H:i", strtotime($vh->h_date));?><i class="bx bx-right-arrow-alt font-size-16 text-d align-middle ms-2"></i></h5>
                  </div>
                <div class="media-body">
                  <div>
                    <?php 
                    $supp_del = $this->Superadmin_model->getStudentById($vh->assignee_id);
                    $stud_del = $this->Superadmin_model->getStudentById($tickets_del->created_by);
                    $ass_del = $this->Superadmin_model->getStudentById($vh->assigned_by);

                    if($vh->h_description == 'Assigned the Ticket' && $vh->assigned_by == 0)
                    {
                      echo 'Support Admin has Assigned the Ticket T-'.$tickets_del->unique_id.' to '.ucfirst($supp_del->first_name).' '.ucfirst($supp_del->last_name).'<small>(Supporter)</small>';
                    }
                    else if($vh->h_description == 'Assigned the Ticket' && $vh->assigned_by != 0)
                    {
                      echo ucfirst($ass_del->first_name).' '.ucfirst($ass_del->last_name).'<small>(Supporter)</small> has Assigned the Ticket T-'.$tickets_del->unique_id.' to '.ucfirst($supp_del->first_name).' '.ucfirst($supp_del->last_name).'<small>(Supporter)</small>';
                    }
                    else if($vh->h_description == 'Reverted the Ticket')
                    {
                      echo ucfirst($supp_del->first_name).' '.ucfirst($supp_del->last_name).'<small>(Supporter)</small> has Reverted the Ticket T-'.$tickets_del->unique_id.' back to Support Admin <br> Reason: '.$vh->assignee_reject_reason;
                    }
                    else if($vh->h_description == 'ticket_in_progress')
                    {
                      echo ucfirst($supp_del->first_name).' '.ucfirst($supp_del->last_name).'<small>(Supporter)</small> has Changed the Ticket T-'.$tickets_del->unique_id.' Status to In Progress';
                    }
                    else if($vh->h_description == 'ticket_in_review')
                    {
                      echo ucfirst($supp_del->first_name).' '.ucfirst($supp_del->last_name).'<small>(Supporter)</small> has Changed the Ticket T-'.$tickets_del->unique_id.' Status to In Review';
                    }
                    else if($vh->h_description == 'ticket_resolved')
                    {
                      echo ucfirst($supp_del->first_name).' '.ucfirst($supp_del->last_name).'<small>(Supporter)</small> has Resolved the Ticket T-'.$tickets_del->unique_id;
                    }
                    else if($vh->h_description == 'ticket_cancelled' && $tickets_del->cancelled_by == 'Supporter')
                    {
                      echo ucfirst($supp_del->first_name).' '.ucfirst($supp_del->last_name).'<small>(Supporter)</small> has Cancelled the Ticket T-'.$tickets_del->unique_id;
                    }
                    else if($vh->h_description == 'ticket_approved_pending')
                    {
                      echo ucfirst($stud_del->first_name).' '.ucfirst($stud_del->last_name).'<small>(User)</small> has Approved the Ticket T-'.$tickets_del->unique_id;
                    }
                    else if($vh->h_description == 'ticket_denied_in_progress')
                    {
                      echo ucfirst($stud_del->first_name).' '.ucfirst($stud_del->last_name).'<small>(User)</small> has Denied the Ticket T-'.$tickets_del->unique_id;
                    }
                    else if($vh->h_description == 'ticket_cancelled' && $tickets_del->cancelled_by == 'User')
                    {
                      echo ucfirst($stud_del->first_name).' '.ucfirst($stud_del->last_name).'<small>(User)</small> has Cancelled the Ticket T-'.$tickets_del->unique_id;
                    }
                    else if($vh->h_description == 'ticket_closed')
                    {
                      echo ucfirst($stud_del->first_name).' '.ucfirst($stud_del->last_name).'<small>(User)</small> has Closed the Ticket T-'.$tickets_del->unique_id;
                    }
                    ?>
                  </div>
                </div>
              </div>
            </li>
            <?php 
              } 
              ?>
              <div class="mb-3"></div>
              <?php                  
            } 
    }
    else
    {
      redirect(base_url('login'));
    }           
  }

  public function remove_supporter()
  {
    $reg_id = $this->input->post('reg_id');
    $stud_del = $this->Superadmin_model->getStudentById($reg_id);
    if($stud_del->supporter_approve == 'no'){
      $data = array(  'supporter_mail' => '0',
                      'supporter_mail_date' => '0000-00-00 00:00:00',
                      'supporter_approve' => '',
                      'supporter_status' => '',
                  );
    }else{
      if($stud_del->supporter_status == 'inactive'){
        $data = array(  'supporter_status' => 'active' );
      }else{
        $data = array(  'supporter_status' => 'inactive' );
      }
    }
    $data = $this->security->xss_clean($data); // xss filter
    $this->Superadmin_model->updateRegistration($data,$reg_id);
  }

  public function remove_supporter_email()
  {
    $invite_id = $this->input->post('invite_id');
    $this->Superadmin_model->deleteInvitedSupporter($invite_id);
  }

  public function delete_ticket(){
    $ticket_id = $this->input->post('id');
    $data = array( 'deleted' => '1' );
    $data = $this->security->xss_clean($data); // xss filter
    $this->Superadmin_model->update_ticket($data,$ticket_id);
  }

  public function chat_history()
  {
    $this->load->view('super_admin/chat_history');
  }

  public function download_chat()
  {
    $ticket_id = $this->uri->segment(3);
    $ticket_chat = $this->Superadmin_model->getTicketMessages($ticket_id);
    $ticket_del = $this->Superadmin_model->getTicketById($ticket_id);
    $stud_del = $this->Superadmin_model->getStudentById($ticket_del->assignee);
    
    require_once(APPPATH.'helpers/tcpdf/tcpdf.php');
    ob_start();//Enables Output Buffering
    // create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    // 
    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH);

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    $pdf->SetAuthor('DECISION 168');
    $pdf->setTitle('Ticket Chat');
    $pdf->SetFont('helvetica');
    $pdf->AddPage();

    // Write Code
    $html = '
      <style>
        .font-size-10 {
          font-size: 10px;
        }
        .font-size-11 {
          font-size: 11px;
        }
        .font-size-12 {
          font-size: 12px;
        }
        .font-size-14 {
          font-size: 14px;
        }
        .font-size-15 {
          font-size: 15px;
        }
        .text-muted{
          color: #74788d;
        }
        .bg-dark {
          color: #ffffff;
          background-color: #343a40;          
        }
        .text-primary{
          color: #556ee6;
        }
        .text-center{
          text-align: center;
        }
        .img-thumbnail{
          border: 1px solid black;
        }
        .text-gray{
          color: #495057;
        }
      </style>
<table>
<tr>
<td colspan="2">
<br>
<span class="font-size-15"><img width="30px" src="'.base_url().'assets/images/chat-icon1.png">&nbsp;<b>'.$ticket_del->subject.'</b></span>
<br>
<span class="font-size-10 text-muted">T-'.$ticket_del->unique_id.'</span> &nbsp;
<span class="font-size-10 text-muted">•</span> &nbsp;
<span class="font-size-10 text-muted">'.date('dS M Y, H:i',strtotime($ticket_del->opened_date)).'</span> &nbsp;
<span class="font-size-10 text-muted">•</span> &nbsp;
<span class="font-size-10 text-muted"><a target="_blank" href="'.base_url().'">DECISION 168</a></span> &nbsp;
<span class="font-size-10 text-muted">•</span> &nbsp;
<span class="badge bg-dark font-size-10"> <b>'.strtoupper($ticket_del->status).'</b> </span>
<br>
<br>';
if($ticket_chat){
  foreach ($ticket_chat as $tm) {
    $supp_del = $this->Superadmin_model->getStudentById($tm->user_id);
    $tm_message = $tm->message;
    $tm_message = preg_replace('/[\x{1F600}-\x{1F64F}\x{2700}-\x{27BF}\x{1F680}-\x{1F6FF}\x{24C2}-\x{1F251}\x{1F30D}-\x{1F567}\x{1F900}-\x{1F9FF}\x{1F300}-\x{1F5FF}]/u', "[emoji]", $tm_message);
    if($tm->status == 'active'){
      if($tm->user_role == 'supporter'){
          $html .= '<span class="text-gray font-size-11">'.$supp_del->first_name.' '.$supp_del->last_name.' (supporter): '.$tm_message.'</span><br>'; 
      }
      else if($tm->user_role == 'superadmin'){
          $html .= '<span class="text-primary font-size-11">Support Admin: '.$tm_message.'</span><br>'; 
      }
      else{
          $html .= '<span class="text-gray font-size-11">'.$supp_del->first_name.' '.$supp_del->last_name.' (user): '.$tm_message.'</span><br>'; 
      }
    }else{
      if($tm->user_role == 'supporter'){
          $html .= '<span class="text-gray font-size-11">'.$supp_del->first_name.' '.$supp_del->last_name.' (supporter): This message was deleted</span><br>';
      }
      else if($tm->user_role == 'superadmin'){
          $html .= '<span class="text-primary font-size-11">Support Admin: You deleted this message</span><br>';
      }
      else{
          $html .= '<span class="text-gray font-size-11">'.$supp_del->first_name.' '.$supp_del->last_name.' (user): This message was deleted</span><br>';
      }   
    }                  
  }
}
$html .='</td>';

if($stud_del){
  $html .='<td>
  <div class="p-2 text-center">';
  if($stud_del->photo){
    $html .='<img height="100px" class="img-thumbnail" src="'.base_url("assets/student_photos/".$stud_del->photo).'" alt="">';
  }else{
    $fullname = $stud_del->first_name.' '.$stud_del->last_name;
    $student_name = explode(" ", $fullname);
    $profile_name = "";

    foreach ($student_name as $sn) {
      $profile_name .= $sn[0];
    }
    $html .='<span style="font-size:35px;color:#556ee6;"><b>'.strtoupper($profile_name).'</b></span><br>';
  }
  $html .='<br>
  <span class="font-size-14"><b>'.$stud_del->first_name.' '.$stud_del->last_name.'</b></span>
  <br>
  <span class="font-size-11 mt-0 text-muted">'.$stud_del->designation.'</span>
  </div>
  </td>';
}

$html .='</tr>
</table>';
    
    // output the HTML content
    $pdf->writeHTML($html, true, false, true, false, '');
    ob_end_clean();

    $pdf->Output('chat-'.$ticket_del->unique_id.'.pdf','D');  
  }

  public function history_pdf_format()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
    $ticket_id = $this->input->post('ticket_id');
    $unique_id = $this->session->set_userdata('unique_id_history',ucwords($this->input->post('unique_id')));
    $this->session->set_userdata('ticket_id_history',$this->input->post('ticket_id'));

    if($this->input->post('chat_history') == '1'){
      $this->session->set_userdata('chat_history','yes');
    }else{
      $this->session->set_userdata('chat_history','no');
    }


    if($this->input->post('all_history') == '1')
    {
      $view_history = $this->Superadmin_model->view_all_history($ticket_id);
      if($view_history)
      { 
           $this->session->set_userdata('view_history',$view_history);

            $response['status'] = true;
            header('Content-type: application/json');
            echo json_encode($response); 
      }
      else
      {
            $response['status'] = 'not_found';
            header('Content-type: application/json');
            echo json_encode($response); 
      }
    }
    else if(!empty($this->input->post('only_date')))
    {
      $view_history = $this->Superadmin_model->view_history_only_date($ticket_id,date("Y-m-d", strtotime($this->input->post('only_date'))));
      if($view_history)
      {
        $this->session->set_userdata('view_history',$view_history);

          $dateSelected = date("F d, Y", strtotime($this->input->post('only_date')));
          $this->session->set_userdata('dateSelected',$dateSelected);
            $response['status'] = true;
            header('Content-type: application/json');
            echo json_encode($response);       
      }
      else
      {
            $response['status'] = 'not_found';
            header('Content-type: application/json');
            echo json_encode($response); 
      }
    }
    else if((!empty($this->input->post('start_date'))) && (!empty($this->input->post('end_date'))))
    {
      $view_history = $this->Superadmin_model->view_history_date_range($ticket_id,date("Y-m-d", strtotime($this->input->post('start_date'))),date("Y-m-d", strtotime($this->input->post('end_date'))));
      if($view_history)
      {
        $this->session->set_userdata('view_history',$view_history);

          $dateSelected = date("F d, Y", strtotime($this->input->post('start_date'))).' - '.date("F d, Y", strtotime($this->input->post('end_date')));
          $this->session->set_userdata('dateSelected',$dateSelected);
            $response['status'] = true;
            header('Content-type: application/json');
            echo json_encode($response);     
      }
      else
      {
            $response['status'] = 'not_found';
            header('Content-type: application/json');
            echo json_encode($response); 
      }
    }
    else
    {
      $response['status'] = 'empty_option';
      header('Content-type: application/json');
      echo json_encode($response);
    }
    }
    else
    {
      redirect(base_url('super-admin/login'));
    } 
  }

  public function export_pdf_format()
  {
    require_once(APPPATH.'helpers/tcpdf/tcpdf.php');
    ob_start();//Enables Output Buffering
    // create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    // 
    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH);

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    $pdf->SetAuthor('DECISION 168');
    $pdf->setTitle('Ticket History');
    $pdf->SetFont('helvetica', '', 10);
    $pdf->AddPage();

    $unique_id = $this->session->userdata('unique_id_history');
    $view_history = $this->session->userdata('view_history');
    $ticket_id = $this->session->userdata('ticket_id_history');
    $tickets_del = $this->Superadmin_model->getTicketById($ticket_id);

    $html = '<table border="1" width="100%" align="center" cellpadding="5px">
        <tr style="background-color:#d2db95;">
          <td><b>Date</b></td>
          <td><b>Time</b></td>
          <td><b>Supporter</b></td>
          <td colspan="3"><b>Activity</b></td>
        </tr>';

    foreach($view_history as $v)
    {
      $supp_del = $this->Superadmin_model->getStudentById($v->assignee_id);
      $stud_del = $this->Superadmin_model->getStudentById($tickets_del->created_by);
      $supporter_name = ucwords($supp_del->first_name).' '.ucwords($supp_del->last_name);
      $ass_del = $this->Superadmin_model->getStudentById($v->assigned_by);

      if($v->h_description == 'Assigned the Ticket' && $v->assigned_by == 0)
      {
        $h_description = 'Support Admin has Assigned the Ticket T-'.$tickets_del->unique_id.' to '.ucfirst($supp_del->first_name).' '.ucfirst($supp_del->last_name).'(Supporter)';
      }
      else if($v->h_description == 'Assigned the Ticket' && $v->assigned_by != 0)
      {
        $h_description = ucfirst($ass_del->first_name).' '.ucfirst($ass_del->last_name).'(Supporter) has Assigned the Ticket T-'.$tickets_del->unique_id.' to '.ucfirst($supp_del->first_name).' '.ucfirst($supp_del->last_name).'(Supporter)';
      }
      else if($v->h_description == 'Reverted the Ticket')
      {
        $h_description = ucfirst($supp_del->first_name).' '.ucfirst($supp_del->last_name).'(Supporter) has Reverted the Ticket T-'.$tickets_del->unique_id.' back to Support Admin, Reason: '.$v->assignee_reject_reason;
      }
      else if($v->h_description == 'ticket_in_progress')
      {
        $h_description = ucfirst($supp_del->first_name).' '.ucfirst($supp_del->last_name).'(Supporter) has Changed the Ticket T-'.$tickets_del->unique_id.' Status to In Progress';
      }
      else if($v->h_description == 'ticket_in_review')
      {
        $h_description = ucfirst($supp_del->first_name).' '.ucfirst($supp_del->last_name).'(Supporter) has Changed the Ticket T-'.$tickets_del->unique_id.' Status to In Review';
      }
      else if($v->h_description == 'ticket_resolved')
      {
        $h_description = ucfirst($supp_del->first_name).' '.ucfirst($supp_del->last_name).'(Supporter) has Resolved the Ticket T-'.$tickets_del->unique_id;
      }
      else if($v->h_description == 'ticket_cancelled' && $tickets_del->cancelled_by == 'Supporter')
      {
        $h_description = ucfirst($supp_del->first_name).' '.ucfirst($supp_del->last_name).'(Supporter) has Cancelled the Ticket T-'.$tickets_del->unique_id;
      }
      else if($v->h_description == 'ticket_approved_pending')
      {
        $h_description = ucfirst($stud_del->first_name).' '.ucfirst($stud_del->last_name).'(User) has Approved the Ticket T-'.$tickets_del->unique_id;
      }
      else if($v->h_description == 'ticket_denied_in_progress')
      {
        $h_description = ucfirst($stud_del->first_name).' '.ucfirst($stud_del->last_name).'(User) has Denied the Ticket T-'.$tickets_del->unique_id;
      }
      else if($v->h_description == 'ticket_cancelled' && $tickets_del->cancelled_by == 'User')
      {
        $h_description = ucfirst($stud_del->first_name).' '.ucfirst($stud_del->last_name).'(User) has Cancelled the Ticket T-'.$tickets_del->unique_id;
      }
      else if($v->h_description == 'ticket_closed')
      {
        $h_description = ucfirst($stud_del->first_name).' '.ucfirst($stud_del->last_name).'(User) has Closed the Ticket T-'.$tickets_del->unique_id;
      }

      $html .= '<tr>
      <td>'.date("D, M d, Y", strtotime($v->h_date)).'</td>
      <td>'.date("H:i:s", strtotime($v->h_date)).'</td>
      <td>'.$supporter_name.'</td>
      <td colspan="3">'.ucwords($h_description).'</td>
      </tr>';    
    }

    $html .= '</table>';

    // output the HTML content
    $pdf->writeHTML($html, true, false, true, false, '');

    if($this->session->userdata('chat_history') == 'yes'){
      $ticket_chat = $this->Superadmin_model->getTicketMessages($ticket_id);
      $ticket_del = $this->Superadmin_model->getTicketById($ticket_id);
      $stud_del = $this->Superadmin_model->getStudentById($ticket_del->assignee);

      $pdf->AddPage();

      // Write Code
      $html = '
        <style>
          .font-size-10 {
            font-size: 10px;
          }
          .font-size-11 {
            font-size: 11px;
          }
          .font-size-12 {
            font-size: 12px;
          }
          .font-size-14 {
            font-size: 14px;
          }
          .font-size-15 {
            font-size: 15px;
          }
          .text-muted{
            color: #74788d;
          }
          .bg-dark {
            color: #ffffff;
            background-color: #343a40;          
          }
          .text-primary{
            color: #556ee6;
          }
          .text-center{
            text-align: center;
          }
          .img-thumbnail{
            border: 1px solid black;
          }
          .text-gray{
            color: #495057;
          }
        </style>
  <table>
  <tr>
  <td colspan="2">
  <br>
  <span class="font-size-15"><img width="30px" src="'.base_url().'assets/images/chat-icon1.png">&nbsp;<b>'.$ticket_del->subject.'</b></span>
  <br>
  <span class="font-size-10 text-muted">T-'.$ticket_del->unique_id.'</span> &nbsp;
  <span class="font-size-10 text-muted">•</span> &nbsp;
  <span class="font-size-10 text-muted">'.date('dS M Y, H:i',strtotime($ticket_del->opened_date)).'</span> &nbsp;
  <span class="font-size-10 text-muted">•</span> &nbsp;
  <span class="font-size-10 text-muted"><a target="_blank" href="'.base_url().'">DECISION 168</a></span> &nbsp;
  <span class="font-size-10 text-muted">•</span> &nbsp;
  <span class="badge bg-dark font-size-10"> <b>'.strtoupper($ticket_del->status).'</b> </span>
  <br>
  <br>';
  if($ticket_chat){
    foreach ($ticket_chat as $tm) {
      $supp_del = $this->Superadmin_model->getStudentById($tm->user_id);
      $tm_message = $tm->message;
      $tm_message = preg_replace('/[\x{1F600}-\x{1F64F}\x{2700}-\x{27BF}\x{1F680}-\x{1F6FF}\x{24C2}-\x{1F251}\x{1F30D}-\x{1F567}\x{1F900}-\x{1F9FF}\x{1F300}-\x{1F5FF}]/u', "[emoji]", $tm_message);
      if($tm->status == 'active'){
        if($tm->user_role == 'supporter'){
            $html .= '<span class="text-gray font-size-11">'.$supp_del->first_name.' '.$supp_del->last_name.' (supporter): '.$tm_message.'</span><br>'; 
        }
        else if($tm->user_role == 'superadmin'){
            $html .= '<span class="text-primary font-size-11">Support Admin: '.$tm_message.'</span><br>'; 
        }
        else{
            $html .= '<span class="text-gray font-size-11">'.$supp_del->first_name.' '.$supp_del->last_name.' (user): '.$tm_message.'</span><br>'; 
        }
      }else{
        if($tm->user_role == 'supporter'){
            $html .= '<span class="text-gray font-size-11">'.$supp_del->first_name.' '.$supp_del->last_name.' (supporter): This message was deleted</span><br>';
        }
        else if($tm->user_role == 'superadmin'){
            $html .= '<span class="text-primary font-size-11">Support Admin: You deleted this message</span><br>';
        }
        else{
            $html .= '<span class="text-gray font-size-11">'.$supp_del->first_name.' '.$supp_del->last_name.' (user): This message was deleted</span><br>';
        }   
      }                  
    }
  }
  $html .='</td>';

  if($stud_del){
    $html .='<td>
    <div class="p-2 text-center">';
    if($stud_del->photo){
      $html .='<img height="100px" class="img-thumbnail" src="'.base_url("assets/student_photos/".$stud_del->photo).'" alt="">';
    }else{
      $fullname = $stud_del->first_name.' '.$stud_del->last_name;
      $student_name = explode(" ", $fullname);
      $profile_name = "";

      foreach ($student_name as $sn) {
        $profile_name .= $sn[0];
      }
      $html .='<span style="font-size:35px;color:#556ee6;"><b>'.strtoupper($profile_name).'</b></span><br>';
    }
    $html .='<br>
    <span class="font-size-14"><b>'.$stud_del->first_name.' '.$stud_del->last_name.'</b></span>
    <br>
    <span class="font-size-11 mt-0 text-muted">'.$stud_del->designation.'</span>
    </div>
    </td>';
  }

  $html .='</tr>
  </table>';
      // output the HTML content
      $pdf->writeHTML($html, true, false, true, false, '');
    }
    
    ob_end_clean();

    $pdf->Output('history-'.$tickets_del->unique_id.'.pdf','D');  
  }

  public function ticketAttachFiles_Modal()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $ticket_id = $this->input->post('id');
      $data['tickets_del'] = $this->Superadmin_model->getTicketById($ticket_id);
      echo '<div class="modal-header">
        <h5 class="modal-title mt-0" id="ticketCommentModalLabel">T-'.$data["tickets_del"]->unique_id.'</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>';
      $this->load->view('super_admin/ticket-attach-files-modal',$data);    
    }
    else
    {
      redirect(base_url('login'));
    }
  }

  // End Support functions ------//-----//----//----//----

  // Community functions-----//-------//---------//----
  
  public function community()
  {
    if(($this->session->userdata('d168_super_id')) || ($this->session->userdata('d168_super_id') != ""))
    {
      $data['list'] = $this->Superadmin_model->decision_maker();
      $this->load->view('super_admin/decision_maker', $data);    
    }
    else
    {
      redirect(base_url('super-admin/login'));
    }
  }

  public function approve_expert(){
    $reg_id = $this->input->post('reg_id');
    $data = array( 'expert_approve' => '1',
                   'expert_approved_date' => date('Y-m-d H:i:s'),
                   'call_notify_clear' => 'no',
                   'call_notify' => 'sent_yes',
                 );
    $data = $this->security->xss_clean($data); // xss filter
    $this->Superadmin_model->updateRegistration($data,$reg_id);

    $stud_del = $this->Superadmin_model->getStudentById($reg_id);
    $email_to = $stud_del->email_address;
    $email_from = 'hello@decision168.com'; 
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
    $this->email->subject('Your Request for Becoming Decision Maker | Decision 168');
    $this->email->message('                 
      <!doctype html>
      <html lang="en-US">

      <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <title>Your Request for Becoming Decision Maker</title>
        <meta name="description" content="Your Request for Becoming Decision Maker">
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
                                            <h1 style="color:#c7df19; font-weight:600; margin:0;font-size:33px;font-family:Rubik,sans-serif;">Your Request for Becoming Decision Maker</h1>
                                            <span
                                                style="display:inline-block; vertical-align:middle; margin:29px 0 29px; border-bottom:2px solid #cecece; width:270px;"></span>
                                            <p style="color:#fff; font-size:15px;line-height:24px;text-align:left; margin:0;">
                                            Hello,<br><br>
                                                Congratulations! Admin has approved your request for becoming Decision Maker for Decision168. Please update your call rates as per the minutes for receiving video sessions.
                                                <br><br> 
                                                
                                            </p>
                                            <a href="'.base_url('').'"
                                            style="background:#c7df19;text-decoration:none !important; font-weight:600; margin:20px; color:#fff;border:4px solid #c7df19;text-transform:uppercase; font-size:15px;padding:10px 30px;display:inline-block;border-radius:10px;">Sign In</a>
                                            
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

      </html>' 
    );
    $this->email->send();
  }

  public function expert_status(){
    $reg_id = $this->input->post('reg_id');
    $status = $this->input->post('status');
    if($status == 'active'){
      $data = array( 'expert_status' => 'inactive');
    }else{
      $data = array( 'expert_status' => 'active');
    }

    $data = $this->security->xss_clean($data); // xss filter
    $this->Superadmin_model->updateRegistration($data,$reg_id);
  }

  // End Community functions-----//-------//---------//----

}
?>