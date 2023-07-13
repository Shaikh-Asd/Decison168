<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		//Time Zone
		date_default_timezone_set("Asia/kolkata");
	}

	// callback function for allowing alphabets and space
	public function alpha_space($str) 
	{
	    if ( ! preg_match("/^([a-z ])+$/i", $str)){
	    	// custom error message
			$this->form_validation->set_message('alpha_space', 'The {field} field may only contain alphabetical characters.');
	        return false;
	    }
	    else{
	    	return true;
	    }
	}

	//callback function for creating strong password 
	public function valid_password($password = '')
	{
		$password = trim($password);

		$regex_lowercase = '/[a-z]/';
		$regex_uppercase = '/[A-Z]/';
		$regex_number = '/[0-9]/';
		$regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';

		if (empty($password))
		{
			$this->form_validation->set_message('valid_password', 'The {field} field is required.');

			return FALSE;
		}

		if (preg_match_all($regex_lowercase, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field must be at least one lowercase letter.');

			return FALSE;
		}

		if (preg_match_all($regex_uppercase, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field must be at least one uppercase letter.');

			return FALSE;
		}

		if (preg_match_all($regex_number, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field must have at least one number.');

			return FALSE;
		}

		if (preg_match_all($regex_special, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field must have at least one special character.');

			return FALSE;
		}

		if (strlen($password) < 5)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field must be at least 5 characters in length.');

			return FALSE;
		}

		if (strlen($password) > 32)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field cannot exceed 32 characters in length.');

			return FALSE;
		}

		return TRUE;
	}

	// callback function for allowing alphabets , numbers , full stop and comma.
	public function customAlpha($str) 
	{
	    if ( !preg_match('/^[a-z0-9 .,\-]+$/i',$str) ){
	    	// custom error message
			$this->form_validation->set_message('customAlpha', 'The {field} field may only contain alphabetical characters and numbers.');
	        return false;
	    }
	    else{
	    	return true;
	    }
	}

	// callback function for allowing alphabets , numbers , full stop and comma.
	public function customNumber($str) 
	{
	    if ( !preg_match('/^[0-9]+$/i',$str) ){
	    	// custom error message
			$this->form_validation->set_message('customNumber', 'The {field} field may only contain numbers.');
	        return false;
	    }
	    else{
	    	return true;
	    }
	}

	// callback function for allowing date.
	public function customNumDate($str) 
	{
	    if ( !preg_match('/^(((0)[0-9])|((1)[0-2]))(\/)([0-2][0-9]|(3)[0-1])(\/)\d{4}$/i',$str) ){
	    	// custom error message
			$this->form_validation->set_message('customNumDate', 'The {field} field may only contain date format (mm/dd/yyyy).');
	        return false;
	    }
	    else{

	    	return true;
	    }
	}
}
/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
?>