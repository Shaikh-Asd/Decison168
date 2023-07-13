<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Superadmin_model extends CI_Model {

	function checkLogin($username,$password)
	{
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$query = $this->db->get('super_admin');
		return $query->num_rows();
	}

	function selectLogin($username)
	{
		$this->db->where('username', $username);
		$query = $this->db->get('super_admin');
		return $query->row();
	}

	function count_registered_list()
    {
    	$query = $this->db->query("SELECT COUNT(*) as count_rows FROM registration where verified='yes'");
    	return $query->row_array();
    }

    function registered_list()
	{
		$this->db->order_by('reg_date','DESC');
		$this->db->where('verified', 'yes');
		$query = $this->db->get('registration');
		return $query->result();
	}

	function deactivated_users()
	{
		$this->db->order_by('deleted_date','DESC');
		$query = $this->db->get('registration_deleted');
		return $query->result();
	}

	function quotes_list()
	{
		$this->db->order_by('id','DESC');
		$query = $this->db->get('motivator');
		return $query->result();
	}

	function insert_quote($data2)
	{
		if($this->db->insert('motivator',$data2))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function quote_detail($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('motivator');
		return $query->row();
	}

	function edit_quote($data2,$id)
	{
		$this->db->where('id',$id);
		if($this->db->update('motivator',$data2))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function delete_quote($id)
	{
		$this->db->where('id',$id);
		if($this->db->delete('motivator'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function get_User($reg_id)
	{
		$this->db->where('reg_id', $reg_id);
		$query = $this->db->get('registration');
		return $query->row();
	}

	function check_quote_request($id,$reg_id)
	{
		$this->db->where('qcreated_by', $reg_id);
		$this->db->where('id', $id);
		$query = $this->db->get('motivator');
		return $query->row();
	}

	function pricing_list()
	{
		$this->db->where('coupon_pack', 'no');
		$this->db->where('custom_pack','no');
		$query = $this->db->get('pricing');
		return $query->result();
	}

	function org_pricing_list()
	{
		$this->db->where('pack_status', 'active');
		$this->db->where('stripe_link', 'yes');
		$this->db->where('custom_pack', 'no');
		$this->db->where('coupon_pack', 'no');
		$query = $this->db->get('pricing');
		return $query->result();
	}

	function insert_package($data2)
	{
		if($this->db->insert('pricing',$data2))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function package_detail($id)
	{
		$this->db->where('pack_id', $id);
		$query = $this->db->get('pricing');
		return $query->row();
	}

	function edit_package($data2,$id)
	{
		$this->db->where('pack_id',$id);
		if($this->db->update('pricing',$data2))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function refund_list()
	{
		$this->db->order_by('first_name','ASC');
		$this->db->where('verified', 'yes');
		$this->db->where('refund_status', 'refund');
		$query = $this->db->get('registration');
		return $query->result();
	}

	function updateRegistration($data,$id)
	{
		$this->db->where('reg_id', $id);
		$this->db->update('registration',$data);
	}

	function pricing_labels($id)
	{
		$this->db->order_by('plabel','ASC');
		$this->db->where('pack_id', $id);
		$query = $this->db->get('pricing_labels');
		return $query->row();
	}

	function insert_pricing_labels($data3)
	{
		if($this->db->insert('pricing_labels',$data3))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function edit_pricing_labels($data2,$id)
	{
		$this->db->where('plabel',$id);
		if($this->db->update('pricing_labels',$data2))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function getCountryByCode($code)
	{
		$this->db->where('country_code', $code);
		$query = $this->db->get('countries');
		return $query->row();
	}

	function user_activity($id)
	{
		$this->db->order_by('hid','DESC');
		$this->db->limit('5');
		$this->db->where('h_resource_id', $id);
		$query = $this->db->get('project_history');
		return $query->result();
	}

	function logo_list()
	{
		$this->db->order_by('id','DESC');
		$query = $this->db->get('ad_logo');
		return $query->result();
	}

	function insert_ad_logo($data2)
	{
		if($this->db->insert('ad_logo',$data2))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function logo_detail($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('ad_logo');
		return $query->row();
	}

	function edit_logo($data2,$id)
	{
		$this->db->where('id',$id);
		if($this->db->update('ad_logo',$data2))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function delete_logo($id)
	{
		$this->db->where('id',$id);
		if($this->db->delete('ad_logo'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function check_logo_request($id,$reg_id)
	{
		$this->db->where('lcreated_by', $reg_id);
		$this->db->where('id', $id);
		$query = $this->db->get('ad_logo');
		return $query->row();
	}

	function updateAd_logo($data,$id)
	{
		$this->db->where('lcreated_by',$id);
		$this->db->update('ad_logo',$data);		
	}

	function updateComments($data,$id)
	{
		$this->db->where('project_id', $id);
		$this->db->update('comments',$data);
	}

	function updateComments2($data,$id)
	{
		$this->db->where('c_created_by', $id);
		$this->db->update('comments',$data);
	}

	function updateMotivator($data,$id)
	{
		$this->db->where('qcreated_by',$id);
		$this->db->update('motivator',$data);		
	}

	function get_all_user_portfolio($id)
	{
		$this->db->order_by('portfolio_id','DESC');
		$this->db->where('portfolio_createdby',$id);
		$query = $this->db->get('project_portfolio');
		return $query->result();
	}

	function updateProject_portfolio($data,$id)
	{
		$this->db->where('portfolio_id',$id);
		$this->db->update('project_portfolio',$data);
	}

	function updateProject_portfolio_member($data,$id)
	{
		$this->db->where('portfolio_id',$id);
		$this->db->update('project_portfolio_member',$data);
	}

	function updateProject_portfolio_member2($data,$email)
	{
		$this->db->where('sent_to',$email);
		$this->db->update('project_portfolio_member',$data);
	}

	function updateProject($data,$id)
	{
		$this->db->where('portfolio_id',$id);
		$this->db->update('project',$data);
	}

	function updateProject2($data,$id)
	{
		$this->db->where('pid',$id);
		$this->db->update('project',$data);
	}

	function get_all_project($id)
	{
		$this->db->where('portfolio_id',$id);
		$query = $this->db->get('project');
		return $query->result();
	}

	function get_all_project2($id)
	{
		$this->db->where('pcreated_by',$id);
		$query = $this->db->get('project');
		return $query->result();
	}

	function updateProject_members($data,$id)
	{
		$this->db->where('pid',$id);
		$this->db->update('project_members',$data);
	}

	function updateProject_members2($data,$id)
	{
		$this->db->where('pmember',$id);
		$this->db->or_where('pcreated_by',$id);
		$this->db->update('project_members',$data);
	}

	function updateProject_files($data,$id)
	{
		$this->db->where('pid',$id);
		$this->db->update('project_files',$data);
	}

	function updateProject_files2($data,$id)
	{
		$this->db->where('pcreated_by',$id);
		$this->db->update('project_files',$data);
	}

	function updateProject_invited_members($data,$id)
	{
		$this->db->where('pid',$id);
		$this->db->update('project_invited_members',$data);
	}

	function updateProject_invited_members2($data,$id)
	{
		$this->db->where('sent_from',$id);
		$this->db->or_where('sent_to',$id);
		$this->db->update('project_invited_members',$data);
	}

	function updateProject_request_member($data,$id)
	{
		$this->db->where('pid',$id);
		$this->db->update('project_request_member',$data);
	}

	function updateProject_request_member2($data,$id)
	{
		$this->db->where('member',$id);
		$this->db->update('project_request_member',$data);
	}

	function updateProject_suggested_members($data,$id)
	{
		$this->db->where('pid',$id);
		$this->db->update('project_suggested_members',$data);
	}

	function updateProject_suggested_members2($data,$id)
	{
		$this->db->where('suggest_id',$id);
		$this->db->or_where('suggested_by',$id);
		$this->db->update('project_suggested_members',$data);
	}

	function updateTask($data,$id)
	{
		$this->db->where('tproject_assign',$id);
		$this->db->update('task',$data);
	}

	function updateTask2($data,$id)
	{
		$this->db->where('tcreated_by',$id);
		$this->db->update('task',$data);
	}

	function updateSubtask($data,$id)
	{
		$this->db->where('stproject_assign',$id);
		$this->db->update('subtask',$data);
	}

	function updateSubtask2($data,$id)
	{
		$this->db->where('stcreated_by',$id);
		$this->db->update('subtask',$data);
	}

	function updateContent_planning($data,$id)
	{
		$this->db->where('portfolio_id', $id);
		$this->db->update('content_planning', $data);
	}

	function updateContent_planning2($data,$id)
	{
		$this->db->where('pc_created_by', $id);
		$this->db->update('content_planning', $data);
	}

	function get_all_goals2($id)
	{
		$this->db->where('gcreated_by',$id);
		$query = $this->db->get('goals');
		return $query->result();
	}

	function get_all_strategies2($id)
	{
		$this->db->where('screated_by',$id);
		$query = $this->db->get('strategies');
		return $query->result();
	}

	function editGoal($data,$gid)
	{
		$this->db->where('gid',$gid);
		if($this->db->update('goals',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function editStrategies($data,$sid)
	{
		$this->db->where('sid',$sid);
		if($this->db->update('strategies',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function updateGoals($data,$id)
	{
		$this->db->where('portfolio_id',$id);
		$this->db->update('goals',$data);
	}

	function updateStartegies($data,$id)
	{
		$this->db->where('portfolio_id',$id);
		$this->db->update('strategies',$data);
	}

	function contacted_sales_list()
	{
		$this->db->order_by('cid','DESC');
		$query = $this->db->get('contact_sales');
		return $query->result();
	}

	function delete_contactsales_req($id)
	{
		$this->db->where('cid',$id);
		$this->db->delete('contact_sales');
	}

	function check_cus_plan_made($cid,$reg_id)
	{
		$this->db->where('custom_cid', $cid);
		$this->db->where('custom_reg_id', $reg_id);
		$query = $this->db->get('pricing');
		return $query->row();
	}

	function edit_contact_sales($data2,$cid)
	{
		$this->db->where('cid',$cid);
		if($this->db->update('contact_sales',$data2))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function ad_list()
	{
		$this->db->order_by('aid','DESC');
		$query = $this->db->get('ad_list');
		return $query->result();
	}

	function active_packages()
	{
		$this->db->where('coupon_pack', 'no');
		$this->db->where('custom_pack','no');
		$this->db->where('pack_status','active');
		$query = $this->db->get('pricing');
		return $query->result();
	}

	function update_ad($data)
	{
		$this->db->where('astatus','active');
		if($this->db->update('ad_list',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function insert_ad($data2)
	{
		if($this->db->insert('ad_list',$data2))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function ad_detail($id)
	{
		$this->db->where('aid',$id);
		$query = $this->db->get('ad_list');
		return $query->row();
	}

	function delete_ad($id)
	{
		$this->db->where('aid',$id);
		if($this->db->delete('ad_list'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function update_ad_specfic($data,$id)
	{
		$this->db->where('aid',$id);
		if($this->db->update('ad_list',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function updateContactSales($data,$id)
	{
		$this->db->where('reg_id',$id);
		$this->db->update('contact_sales',$data);
	}

	function coupon_list()
	{
		$this->db->order_by('co_id','DESC');
		$query = $this->db->get('pricing_pack_coupon');
		return $query->result();
	}
	
	function users_active_coupon($co_id)
	{
		$query = $this->db->query("SELECT COUNT(*) as count_rows FROM registration where package_coupon_id='".$co_id."'");
		return $query->row_array();
	}

	function users_active_coupon_list($co_id)
	{
		$this->db->where('package_coupon_id', $co_id);
		$this->db->where('verified', 'yes');
		$this->db->select('used_package_coupon_id,first_name,middle_name,last_name,reg_id,email_address');
		$query = $this->db->get('registration');
		return $query->result();
	}

	function all_users_coupon()
	{
		$this->db->where('used_package_coupon_id !=', '');
		$this->db->where('verified', 'yes');
		$this->db->select('used_package_coupon_id,first_name,middle_name,last_name,reg_id,email_address');
		$query = $this->db->get('registration');
		return $query->result();
	}

	function insert_coupon($data2)
	{
		if($this->db->insert('pricing_pack_coupon',$data2))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function update_coupon($data)
	{
		$this->db->where('co_status','active');
		if($this->db->update('pricing_pack_coupon',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function coupon_detail($co_id)
	{
		$this->db->where('co_id', $co_id);
		$query = $this->db->get('pricing_pack_coupon');
		return $query->row();
	}


	function edit_coupon($data,$co_id)
	{
		$this->db->where('co_id',$co_id);
		if($this->db->update('pricing_pack_coupon',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function get_all_goals($id)
	{
		$this->db->where('portfolio_id',$id);
		$query = $this->db->get('goals');
		return $query->result();
	}

	function updateGoal_members($data,$id)
	{
		$this->db->where('gid',$id);
		$this->db->update('goals_members',$data);
	}

	function updateGoal_invited_members($data,$id)
	{
		$this->db->where('gid',$id);
		$this->db->update('goals_invited_members',$data);
	}

	function updateGoal_suggested_members($data,$id)
	{
		$this->db->where('gid',$id);
		$this->db->update('goals_suggested_members',$data);
	}

	function updateGoal_members2($data,$id)
	{
		$this->db->where('gmember',$id);
		$this->db->or_where('gcreated_by',$id);
		$this->db->update('goals_members',$data);
	}

	function updateGoal_invited_members2($data,$id)
	{
		$this->db->where('sent_from',$id);
		$this->db->or_where('sent_to',$id);
		$this->db->update('goals_invited_members',$data);
	}

	function updateGoal_suggested_members2($data,$id)
	{
		$this->db->where('suggest_id',$id);
		$this->db->or_where('suggested_by',$id);
		$this->db->update('goals_suggested_members',$data);
	}

	// Support functions ------//-----//----//----//----
	
	function getTicketUniqueID($unique_id)
	{
		$this->db->where('unique_id', $unique_id);
		$query = $this->db->get('tickets');
		return $query->num_rows();
	}

	function insert_ticket($data)
	{
		if($this->db->insert('tickets',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function getAllTickets()
	{
		$this->db->order_by('ticket_id', 'DESC');
		$this->db->where('deleted', '0');
		$query = $this->db->get('tickets');
		return $query->result();
	}

	function getMyTickets($user_id)
	{
		$this->db->order_by('ticket_id', 'DESC');
		$this->db->where('deleted', '0');
		$this->db->where('created_by', $user_id);
		$query = $this->db->get('tickets');
		return $query->result();
	}

	function getAssignedTickets($user_id)
	{
		$this->db->order_by('ticket_id', 'DESC');
		$this->db->where('deleted', '0');
		$this->db->where('assignee', $user_id);
		$query = $this->db->get('tickets');
		return $query->result();
	}

	function getTicketById($ticket_id)
	{
		$this->db->where('ticket_id', $ticket_id);
		$query = $this->db->get('tickets');
		return $query->row();
	}

	function update_ticket($data,$ticket_id)
	{
		$this->db->where('ticket_id', $ticket_id);
		$this->db->update('tickets',$data);
	}

	function getStudentById($id)
	{
		$this->db->where('reg_id', $id);
		$query = $this->db->get('registration');
		return $query->row();
	}

	function getSupporters()
	{
		$this->db->where('verified', 'yes');
		$this->db->where('role', 'supporter');
		$this->db->where('supporter_mail', 1);
		$this->db->where('supporter_status', 'active');
		$this->db->where('supporter_approve', 'yes');
		$query = $this->db->get('registration');
		return $query->result();
	}

	function getNotSupporters()
	{
		$this->db->where('verified', 'yes');
		$this->db->where('role !=', 'supporter');
		$this->db->group_start();
		$this->db->where('supporter_mail', 0);
		$this->db->or_where('supporter_approve', 'no');
		$this->db->group_end();
		$query = $this->db->get('registration');
		return $query->result();
	}

	function checkSupporterEmailExists1($email_address)
	{
		$this->db->where('email_address', $email_address);
		$this->db->where('supporter_mail', 1);
		$this->db->group_start();		
		$this->db->or_where('supporter_approve', 'yes');
		$this->db->or_where('supporter_approve', '');
		$this->db->group_end();
		$query = $this->db->get('registration');
		return $query->num_rows();
	}

	function checkSupporterEmailExists2($email_address)
	{
		$this->db->where('email_address', $email_address);
		$this->db->group_start();
		$this->db->where('approve', 'yes');
		$this->db->or_where('approve', '');
		$this->db->group_end();
		$query = $this->db->get('invited_supporter');
		return $query->num_rows();
	}

	function checkSupporterIDExists($reg_id)
	{
		$this->db->where('reg_id', $reg_id);
		$this->db->where('supporter_mail', 1);
		$this->db->group_start();		
		$this->db->or_where('supporter_approve', 'yes');
		$this->db->or_where('supporter_approve', '');
		$this->db->group_end();
		$query = $this->db->get('registration');
		return $query->num_rows();
	}

	function insert_inviteSupporter($data)
	{
		if($this->db->insert('invited_supporter',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function checkIfSupporterApprove($reg_id)
	{
		$this->db->where('reg_id', $reg_id);
		$this->db->where('supporter_approve', 'yes');
		$query = $this->db->get('registration');
		return $query->num_rows();
	}

	function checkIfSupporterDeny($reg_id)
	{
		$this->db->where('reg_id', $reg_id);
		$this->db->where('supporter_approve', 'no');
		$query = $this->db->get('registration');
		return $query->num_rows();
	}

	function checkIfSupporterEmailExists($email_address)
	{
		$this->db->where('email_address', $email_address);
		$query = $this->db->get('registration');
		return $query->row();
	}

	function checkIfSupporterEmailApprove($email_address)
	{
		$this->db->where('email_address', $email_address);
		$this->db->where('approve', 'yes');
		$query = $this->db->get('invited_supporter');
		return $query->num_rows();
	}

	function checkIfSupporterEmailDeny($email_address)
	{
		$this->db->where('email_address', $email_address);
		$this->db->where('approve', 'no');
		$query = $this->db->get('invited_supporter');
		return $query->num_rows();
	}

	function updateInvitedSupporter($data,$email_address)
	{
		$this->db->where('email_address', $email_address);
		$this->db->update('invited_supporter',$data);;
	}

	function checkIfSupporterByEmail($email_address)
	{
		$this->db->where('email_address', $email_address);
		$this->db->where('role', 'supporter');
		$this->db->where('supporter_approve', 'yes');
		$query = $this->db->get('registration');
		return $query->num_rows();
	}

	function getMyNotifiedTickets()
	{
		$this->db->order_by('notify_date', 'DESC');
		$this->db->where('deleted', '0');
		$this->db->where('notify !=', "");
		$query = $this->db->get('tickets');
		return $query->result();
	}

	function getNotifyTicketCount()
	{
		$this->db->order_by('notify_date', 'DESC');
		$this->db->where('deleted', '0');
		$this->db->like('notify', 'ticket_created');
		$query = $this->db->get('tickets');
		return $query->num_rows();
	}

	function count_registered_supporters()
    {
    	$query = $this->db->query("SELECT COUNT(*) as count_rows FROM registration where verified='yes' AND supporter_mail='1'");
    	return $query->row_array();
    }

    function registered_supporters()
	{
		$this->db->order_by('reg_date','ASC');
		$this->db->where('verified', 'yes');
		$this->db->where('supporter_mail', '1');
		$query = $this->db->get('registration');
		return $query->result();
	}

	function getTicketMessages($ticket_id)
	{
		$this->db->where('ticket_id', $ticket_id);
		$query = $this->db->get('ticket_chat');
		return $query->result();
	}

	function insert_ticket_chat($data)
	{
		if($this->db->insert('ticket_chat',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function getTicketChatById($chat_id)
	{
		$this->db->where('chat_id', $chat_id);
		$query = $this->db->get('ticket_chat');
		return $query->row();
	}

	function update_ticket_chat($data,$chat_id)
	{
		$this->db->where('chat_id', $chat_id);
		$this->db->update('ticket_chat',$data);
	}

	function getTicketChatCount($ticket_id)
	{
		$this->db->where('ticket_id', $ticket_id);
		$this->db->group_start();
		$this->db->where('user_role', 'user');
		$this->db->or_where('user_role', 'supporter');
		$this->db->group_end();
		$this->db->where('notify', 0);
		$query = $this->db->get('ticket_chat');
		return $query->num_rows();
	}

	function update_ticket_chat_notify($data,$ticket_id)
	{
		$this->db->where('ticket_id', $ticket_id);
		$this->db->group_start();
		$this->db->where('user_role', 'user');
		$this->db->or_where('user_role', 'supporter');
		$this->db->group_end();
		$this->db->where('notify', 0);
		$this->db->update('ticket_chat',$data);
	}

	function insert_ticket_history($data)
	{
		if($this->db->insert('ticket_history',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function view_history_date($ticket_id)
	{
		$query = $this->db->query("SELECT DATE(h_date) DateOnly from ticket_history where ticket_id = '".$ticket_id."'GROUP BY DateOnly ORDER BY hid DESC");
        return $query->result();
	}

	function view_history($ticket_id,$hdate)
	{
		$this->db->order_by('hid', 'DESC');
		$this->db->like('h_date', $hdate);
		$this->db->where('ticket_id', $ticket_id);
		//$this->db->where('reg_acc_status !=','deactivated');
		$query = $this->db->get('ticket_history');
		return $query->result();
	}

    function registered_supporter_emails()
	{
		$this->db->order_by('sent_on','ASC');
		$this->db->where('approve !=', 'yes');
		$query = $this->db->get('invited_supporter');
		return $query->result();
	}

	function deleteInvitedSupporter($invite_id)
	{
		$this->db->where('invite_id',$invite_id);
		$this->db->delete('invited_supporter');
	}

	function view_all_history($ticket_id)
	{
		$this->db->order_by('hid', 'DESC');
		$this->db->where('ticket_id', $ticket_id);
		$query = $this->db->get('ticket_history');
		return $query->result();
	}

	function view_history_only_date($ticket_id,$only_date)
	{
		$this->db->order_by('hid', 'DESC');
		$this->db->like('h_date', $only_date);
		$this->db->where('ticket_id', $ticket_id);
		$query = $this->db->get('ticket_history');
		return $query->result();
	}

	function view_history_date_range($ticket_id,$start_date,$end_date)
	{
		$query = $this->db->query("SELECT * from ticket_history where ticket_id = '".$ticket_id."' and DATE(h_date) BETWEEN '".$start_date."' and '".$end_date."' ORDER BY hid DESC");
        return $query->result();
	}

	// Support functions ------//-----//----//----//----

	// Community functions-----//-------//---------//----

	function decision_maker()
	{
		$this->db->order_by('expert_apply_date','DESC');
		$this->db->where('verified', 'yes');
		$this->db->where('expert', '1');
		$query = $this->db->get('registration');
		return $query->result();
	}

	// End Community functions-----//-------//---------//----

	//Enterprise Module Start

	function insert_contacted_company($data2)
	{
		if($this->db->insert('contacted_company',$data2))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function get_contacted_company_cid($id)
	{
		$this->db->where('contacted_sales_id', $id);
		$query = $this->db->get('contacted_company');
		return $query->row();
	}

	function update_contacted_company($data2,$id)
	{
		$this->db->where('contacted_sales_id', $id);
		if($this->db->update('contacted_company',$data2))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function insert_contacted_company_emp($data2)
	{
		if($this->db->insert('contacted_company_emp',$data2))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	//Enterprise Module End
}
?>