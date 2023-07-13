<?php
$get_expert_calls = $this->Front_model->getExpertCalls();
if($get_expert_calls){
    foreach ($get_expert_calls as $gec) {
        $cm_id = $gec->cm_id;
        $min_del = $this->Front_model->callMinutesById($cm_id);
        $booking_date_time = $gec->booking_date.' '.$gec->book_time;
        $bf15_date = date('Y-m-d H:i', strtotime($booking_date_time. ' - 15 minutes'));
        $crr_date = date('Y-m-d H:i');
        if($crr_date == $bf15_date){
            //echo '<script>Swal.fire("Video Session", "Reminder before 15 minutes", "info");</script>';
            $user_del = $this->Front_model->getStudentById($gec->user_id);
            $exp_del = $this->Front_model->getStudentById($gec->expert_id);
            $email_to = $user_del->email_address;
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
            $this->email->subject('Reminder for Virtual Session | Decision 168');
            $this->email->message('                 
              <!doctype html>
              <html lang="en-US">

              <head>
                <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
                <title>Reminder for Virtual Session</title>
                <meta name="description" content="Reminder for Virtual Session">
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
                                                    <h1 style="color:#c7df19; font-weight:600; margin:0;font-size:33px;font-family:Rubik,sans-serif;">Reminder for Virtual Session</h1>
                                                    <span
                                                        style="display:inline-block; vertical-align:middle; margin:29px 0 29px; border-bottom:2px solid #cecece; width:270px;"></span>
                                                    <p style="color:#fff; font-size:15px;line-height:24px;text-align:left; margin:0;">
                                                    Hello '.ucwords($user_del->first_name).' '.ucwords($user_del->last_name).',<br><br>

                                                        You have a Video Session, here\'s your session details:. <br><br>

                                                        Title : '.$min_del->minute.' <br>
                                                        Decision Maker: '.ucwords($exp_del->first_name).' '.ucwords($exp_del->last_name).' <br>
                                                        Starting Time: '.$booking_date_time.' <br>
                                                        Reminder: 15 minutes before
                                                        <br><br> 
                                                        Please click on start button after 15 minutes
                                                    </p>
                                                    <a href="'.base_url('user-all-calls').'"
                                                    style="background:#c7df19;text-decoration:none !important; font-weight:600; margin:20px; color:#fff;border:4px solid #c7df19;text-transform:uppercase; font-size:15px;padding:10px 30px;display:inline-block;border-radius:10px;">Go to Calls</a>
                                                    
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

            $email_to = $exp_del->email_address;
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
            $this->email->subject('Reminder for Virtual Session | Decision 168');
            $this->email->message('                 
              <!doctype html>
              <html lang="en-US">

              <head>
                <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
                <title>Reminder for Virtual Session</title>
                <meta name="description" content="Reminder for Virtual Session">
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
                                                    <h1 style="color:#c7df19; font-weight:600; margin:0;font-size:33px;font-family:Rubik,sans-serif;">Reminder for Virtual Session</h1>
                                                    <span
                                                        style="display:inline-block; vertical-align:middle; margin:29px 0 29px; border-bottom:2px solid #cecece; width:270px;"></span>
                                                    <p style="color:#fff; font-size:15px;line-height:24px;text-align:left; margin:0;">
                                                    Hello '.ucwords($exp_del->first_name).' '.ucwords($exp_del->last_name).',<br><br>

                                                        You have a Video Session, here\'s your session details:. <br><br>

                                                        Title : '.$min_del->minute.' <br>
                                                        User Name: '.ucwords($user_del->first_name).' '.ucwords($user_del->last_name).' <br>
                                                        Starting Time: '.$booking_date_time.' <br>
                                                        Reminder: 15 minutes before
                                                        <br><br> 
                                                        Please click on start button after 15 minutes
                                                    </p>
                                                    <a href="'.base_url('user-all-calls').'"
                                                    style="background:#c7df19;text-decoration:none !important; font-weight:600; margin:20px; color:#fff;border:4px solid #c7df19;text-transform:uppercase; font-size:15px;padding:10px 30px;display:inline-block;border-radius:10px;">Go to Calls</a>
                                                    
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

$getCallBookingdetails = $this->Front_model->getCallBookingdetails($this->session->userdata('d168_id'));
if($getCallBookingdetails){
  foreach ($getCallBookingdetails as $gcbd) {
    $user_today_date = date('Y-m-d H:i:s');
    $user_booked_date = date('Y-m-d H:i:s', strtotime($gcbd->booked_date));
    $aft24_booked_date = date('Y-m-d H:i:s', strtotime($gcbd->booked_date. ' + 24 hours'));
    if(($user_today_date >= $user_booked_date) && ($user_today_date <= $aft24_booked_date)){

    }else{
      // $data_dm = array( 'expert_approval' => 0,
      //                   'reschedule' => 1,
      //                   'booking_date' => '0000-00-00',
      //                   'book_time' => '',
      //                 );
      // $update_call = $this->Front_model->updateCallBooking($data_dm,$gcbd->cid);
      if($gcbd->cid != 0){
        $gcbd_cid = $gcbd->cid;
        $gcbd_user_id = $gcbd->user_id;
        $gcbd_expert_id = $gcbd->expert_id;
        $gcbd_booked_date = date('Y-m-d H:i:s', strtotime($gcbd->booked_date));

        $delete_call1 = $this->Front_model->deleteCallBooking($gcbd_cid);
        $delete_call2 = $this->Front_model->deleteEventCallBooking($gcbd_cid);
        $delete_call3 = $this->Front_model->delete_event($gcbd_cid);
      }
      if($delete_call3){
        $user_del = $this->Front_model->getStudentById($gcbd_user_id);
        $dec_del = $this->Front_model->getStudentById($gcbd_expert_id);
        $email_to = $user_del->email_address;
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
        $this->email->subject('Reschedule your virtual Session | Decision 168');
        $this->email->message('                 
          <!doctype html>
          <html lang="en-US">

          <head>
            <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
            <title>Reschedule your virtual Session</title>
            <meta name="description" content="Reschedule your virtual Session">
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
                                                <h1 style="color:#c7df19; font-weight:600; margin:0;font-size:33px;font-family:Rubik,sans-serif;">Reschedule your virtual Session</h1>
                                                <span
                                                    style="display:inline-block; vertical-align:middle; margin:29px 0 29px; border-bottom:2px solid #cecece; width:270px;"></span>
                                                <p style="color:#fff; font-size:15px;line-height:24px;text-align:left; margin:0;">
                                                Hello '.ucwords($user_del->first_name).' '.ucwords($user_del->last_name).',<br><br>
                                                    Your Video Session that was booked on '.$gcbd_booked_date.' with Decision Maker '.ucwords($dec_del->first_name).' '.ucwords($dec_del->last_name).' has been cancelled, as your payment was not completed within 24 hours. Please Reschedule your Session. 
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
    }
  }
}
?>