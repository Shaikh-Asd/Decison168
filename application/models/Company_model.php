<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_model extends CI_Model {

	function checkLogin($username,$password)
	{
		$this->db->where('cc_status', 'active');
		$this->db->where('cc_username', $username);
		$this->db->where('cc_pwd', $password);
		$query = $this->db->get('contacted_company');
		return $query->num_rows();
	}

	function selectLogin($username)
	{
		$this->db->where('cc_status', 'active');
		$this->db->where('cc_username', $username);
		$query = $this->db->get('contacted_company');
		return $query->row();
	}

	function getCompanyDetail($id)
	{
		$this->db->where('cc_id', $id);
		$query = $this->db->get('contacted_company');
		return $query->row();
	}

	function updateCompanyDetail($data,$id)
	{
		$this->db->where('cc_id', $id);
		$this->db->update('contacted_company',$data);
	}

	function getPackDetail($pack_id)
	{
		//$this->db->where('pack_status', 'active');
		$this->db->where('pack_id', $pack_id);
		$query = $this->db->get('pricing');
		return $query->row();
	}

	function pricing_labels($id)
	{
		$this->db->order_by('plabel','ASC');
		$this->db->where('pack_id', $id);
		$query = $this->db->get('pricing_labels');
		return $query->row();
	}

	function getPackByPriceID($id)
    {
        $this->db->where('stripe_price_id', $id);
        $query = $this->db->get('pricing');
        return $query->row();
    }

    function updateRegistration($data,$cid)
	{
		$this->db->where('used_corporate_id', $cid);
		$this->db->update('registration',$data);
	}

	function getAllActiveCompany()
	{
		$this->db->where('txn_id !=', '');
		$this->db->where('package_use', 'yes');
		$this->db->where('extended_pack', '');
		$this->db->where('cc_status', 'active');
		$query = $this->db->get('contacted_company');
		return $query->result();
	}

	function getAllExtendedCompany()
	{
		$this->db->where('package_use', 'yes');
		$this->db->where('extended_pack', 'yes');
		$this->db->where('cc_status', 'active');
		$query = $this->db->get('contacted_company');
		return $query->result();
	}

	function getStudentById($id)
	{
		$this->db->where('reg_id', $id);
		$query = $this->db->get('registration');
		return $query->row();
	}

	function getAllExtendedExpiredCompany()
	{
		$this->db->where('extended_pack', 'expired');
		//$this->db->where('cc_status', 'active');
		$query = $this->db->get('contacted_company');
		return $query->result();
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

	function getAllUsers($id)
	{
		$this->db->where('used_corporate_id', $id);
		$query = $this->db->get('registration');
		return $query->result();
	}

	function deletePricingLabels($id)
	{
		$this->db->where('pack_id',$id);
		$this->db->delete('pricing_labels');
	}

	function deletePricing($id)
	{
		$this->db->where('pack_id',$id);
		$this->db->delete('pricing');
	}

	function deleteContactedCompany($id)
	{
		$this->db->where('cc_id',$id);
		$this->db->delete('contacted_company');
	}

	function deleteContactedCompanyEmp($id)
	{
		$this->db->where('cc_id',$id);
		$this->db->delete('contacted_company_emp');
	}

	function deleteContactSales($id)
	{
		$this->db->where('cid',$id);
		$this->db->delete('contact_sales');
	}
	//delete emp all data
	function deleteAd_logo($id)
	{
		$this->db->where('lcreated_by',$id);
		$this->db->delete('ad_logo');		
	}

	function deleteComments2($id)
	{
		$this->db->where('c_created_by', $id);
		$this->db->delete('comments');
	}

	function deleteMotivator($id)
	{
		$this->db->where('qcreated_by',$id);
		$this->db->delete('motivator');		
	}

	function deleteRContactSales($id)
	{
		$this->db->where('reg_id',$id);
		$this->db->delete('contact_sales');		
	}

	function get_all_user_portfolio($id)
	{
		$this->db->order_by('portfolio_id','DESC');
		$this->db->where('portfolio_createdby',$id);
		$query = $this->db->get('project_portfolio');
		return $query->result();
	}

	function get_all_goals($id)
	{
		$this->db->where('portfolio_id',$id);
		$query = $this->db->get('goals');
		return $query->result();
	}

	function deleteGoals($id)
	{
		$this->db->where('gid',$id);
		$this->db->delete('goals');
	}

	function deleteGoal_members($id)
	{
		$this->db->where('gid',$id);
		$this->db->delete('goals_members');
	}

	function deleteGoal_invited_members($id)
	{
		$this->db->where('gid',$id);
		$this->db->delete('goals_invited_members');
	}

	function deleteGoal_suggested_members($id)
	{
		$this->db->where('gid',$id);
		$this->db->delete('goals_suggested_members');
	}

	function deleteStartegies_portfolio($id)
	{
		$this->db->where('portfolio_id',$id);
		$this->db->delete('strategies');
	}

	function deleteProject_portfolio($id)
	{
		$this->db->where('portfolio_id',$id);
		$this->db->delete('project_portfolio');
	}

	function deleteProject_portfolio_member($id)
	{
		$this->db->where('portfolio_id',$id);
		$this->db->delete('project_portfolio_member');
	}

	function get_all_project($id)
	{
		$this->db->where('portfolio_id',$id);
		$query = $this->db->get('project');
		return $query->result();
	}

	function deleteProject($id)
	{
		$this->db->where('pid',$id);
		$this->db->delete('project');
	}

	function deleteProject_members($id)
	{
		$this->db->where('pid',$id);
		$this->db->delete('project_members');
	}

	function deleteProject_files($id)
	{
		$this->db->where('pid',$id);
		$this->db->delete('project_files');
	}

	function deleteProject_invited_members($id)
	{
		$this->db->where('pid',$id);
		$this->db->delete('project_invited_members');
	}

	function deleteProject_request_member($id)
	{
		$this->db->where('pid',$id);
		$this->db->delete('project_request_member');
	}

	function deleteProject_suggested_members($id)
	{
		$this->db->where('pid',$id);
		$this->db->delete('project_suggested_members');
	}

	function deleteTask($id)
	{
		$this->db->where('tproject_assign',$id);
		$this->db->delete('task');
	}

	function deleteSubtask($id)
	{
		$this->db->where('stproject_assign',$id);
		$this->db->delete('subtask');
	}

	function deleteComments($id)
	{
		$this->db->where('project_id', $id);
		$this->db->delete('comments');
	}

	function deleteProject_history($id)
	{
		$this->db->where('pid', $id);
		$this->db->delete('project_history');
	}

	function deleteProject_management($id)
	{
		$this->db->where('pid', $id);
		$this->db->delete('project_management');
	}

	function deleteProject_management_fields($id)
	{
		$this->db->where('pid', $id);
		$this->db->delete('project_management_fields');
	}

	function deleteContent_planning($id)
	{
		$this->db->where('portfolio_id', $id);
		$this->db->delete('content_planning');
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

	function deleteStartegies($id)
	{
		$this->db->where('sid',$id);
		$this->db->delete('strategies');
	}

	function get_all_project2($id)
	{
		$this->db->where('pcreated_by',$id);
		$query = $this->db->get('project');
		return $query->result();
	}

	function deleteProject_portfolio_member2($email)
	{
		$this->db->where('sent_to',$email);
		$this->db->delete('project_portfolio_member');
	}

	function deleteProject_members2($id)
	{
		$this->db->where('pmember',$id);
		$this->db->or_where('pcreated_by',$id);
		$this->db->delete('project_members');
	}

	function deleteProject_files2($id)
	{
		$this->db->where('pcreated_by',$id);
		$this->db->delete('project_files');
	}

	function deleteProject_invited_members2($id)
	{
		$this->db->where('sent_from',$id);
		$this->db->or_where('sent_to',$id);
		$this->db->delete('project_invited_members');
	}

	function deleteProject_request_member2($id)
	{
		$this->db->where('member',$id);
		$this->db->delete('project_request_member');
	}

	function deleteProject_suggested_members2($id)
	{
		$this->db->where('suggest_id',$id);
		$this->db->or_where('suggested_by',$id);
		$this->db->delete('project_suggested_members');
	}

	function deleteProject_history2($id)
	{
		$this->db->where('h_resource_id', $id);
		$this->db->delete('project_history');
	}

	function deleteProject_management2($id)
	{
		$this->db->where('powner', $id);
		$this->db->or_where('pmember',$id);
		$this->db->delete('project_management');
	}

	function deleteProject_management_fields2($id)
	{
		$this->db->where('powner', $id);
		$this->db->or_where('pmember',$id);
		$this->db->delete('project_management_fields');
	}

	function deleteGoal_members2($id)
	{
		$this->db->where('gmember',$id);
		$this->db->or_where('gcreated_by',$id);
		$this->db->delete('goals_members');
	}

	function deleteGoal_invited_members2($id)
	{
		$this->db->where('sent_from',$id);
		$this->db->or_where('sent_to',$id);
		$this->db->delete('goals_invited_members');
	}

	function deleteGoal_suggested_members2($id)
	{
		$this->db->where('suggest_id',$id);
		$this->db->or_where('suggested_by',$id);
		$this->db->delete('goals_suggested_members');
	}

	function get_all_task($id)
	{
		$this->db->where('tassignee',$id);
		$this->db->or_where('tcreated_by',$id);
		$query = $this->db->get('task');
		return $query->result();
	}

	function check_getProjectById($id)
    {
    	$this->db->where('pid', $id);
    	$query = $this->db->get('project');
    	return $query->row();
    }

    function updateOnlyTask($data,$id)
	{
		$this->db->where('tid',$id);
		$this->db->update('task',$data);
	}

	function task_getSubtaskId($tid)
	{
		$this->db->where('tid',$tid);
		$query = $this->db->get('subtask');
		return $query->num_rows();
	}

	function updateOnlyTaskSubtask($data,$id)
	{
		$this->db->where('tid',$id);
		$this->db->update('subtask',$data);
	}

	function deleteTaskSubtask_trash($id)
	{
		$this->db->where('tid',$id);
		$this->db->delete('subtask_trash');
	}

	function deleteOnlyTaskSubtask($id)
	{
		$this->db->where('tid',$id);
		$this->db->delete('subtask');
	}

	function deleteOnlyTask($id)
	{
		$this->db->where('tid',$id);
		$this->db->delete('task');
	}

	function deleteTask_trash($id)
	{
		$this->db->where('tid',$id);
		$this->db->delete('task_trash');
	}

	function get_all_subtask($id)
	{
		$this->db->where('stassignee',$id);
		$this->db->or_where('stcreated_by',$id);
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function updateOnlySubtask($data,$id)
	{
		$this->db->where('stid',$id);
		$this->db->update('subtask',$data);
	}

	function deleteSubtask_trash($id)
	{
		$this->db->where('stid',$id);
		$this->db->delete('subtask_trash');
	}

	function deleteOnlySubtask($id)
	{
		$this->db->where('stid',$id);
		$this->db->delete('subtask');
	}

	function get_all_cp($id)
	{
		$this->db->where('written_content_assignee', $id);
    	$this->db->or_where('pc_file_assignee', $id);
    	$this->db->or_where('submit_to_approval', $id);
    	$this->db->or_where('pc_assignee', $id);
    	$this->db->or_where('pc_created_by', $id);
		$query = $this->db->get('content_planning');
		return $query->result();
	}

	function updateOnlyCP($data,$id)
	{
		$this->db->where('pc_id',$id);
		$this->db->update('content_planning',$data);
	}

	function deletecontent_planning_trash($id)
	{
		$this->db->where('pc_id',$id);
		$this->db->delete('content_planning_trash');
	}

	function deleteOnlyCP($id)
	{
		$this->db->where('pc_id',$id);
		$this->db->delete('content_planning');
	}

	function deleteRegistration($id)
	{
		$this->db->where('reg_id',$id);
		$this->db->delete('registration');
	}
	//delete emp all data

	function getCompanyEmps($id)
	{
		$this->db->where('cc_id', $id);
		$query = $this->db->get('contacted_company_emp');
		return $query->result();
	}

	function checkCompanyEmp($email,$id)
	{
		$this->db->where('emp_email',$email);
		$this->db->where('cc_id', $id);
		$query = $this->db->get('contacted_company_emp');
		return $query->row();
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

    function count_emp($id)
	{
		$query = $this->db->query("SELECT COUNT(*) as count_rows FROM contacted_company_emp where cc_id = '".$id."' and emp_status = 'active'");
		return $query->row_array();
	}

	function update_contacted_company_emp($data2,$id)
    {
		$this->db->where('cce_id', $id);
        $this->db->update('contacted_company_emp',$data2);
    }
    //open work new assignee 
    function getCompanyEmpDetail($id)
	{
		$this->db->where('cce_id', $id);
		$query = $this->db->get('contacted_company_emp');
		return $query->row();
	}

    function getStudentByEmailId($email)
	{
		$this->db->where('email_address', $email);
		$query = $this->db->get('registration');
		return $query->row();
	}

	function TMOpenPortfolio($reg_id)
	{
		$this->db->order_by('portfolio_id','DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_archive !=', 'yes');
		$this->db->where('portfolio_file_it !=', 'yes');
		$this->db->where('portfolio_trash !=','yes');
		$this->db->where('portfolio_createdby',$reg_id);
		$query = $this->db->get('project_portfolio');
		return $query->result();
	}

	function TMOpenPortfolio2($sent_to)
    {
        $this->db->where('portfolio_archive !=', 'yes');
        $this->db->where('portfolio_file_it !=', 'yes');
        $this->db->where('portfolio_trash !=','yes');
        $this->db->where('sent_to',$sent_to);
        $query = $this->db->get('project_portfolio_member');
        return $query->result();
    }

	function TMOpenGoals($reg_id,$portfolio_id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->group_start();
    	$this->db->where('gcreated_by', $reg_id);
    	$this->db->or_where('gmanager', $reg_id);
    	$this->db->group_end();
		$this->db->where('portfolio_id', $portfolio_id);
		$this->db->where('g_trash', '');
		$this->db->where('g_archive', '');
		$query = $this->db->get('goals');
		return $query->result();
	}

	function getGoalOpenTM($reg_id,$portfolio_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('gmember', $reg_id);
    	$this->db->where('portfolio_id', $portfolio_id);
    	$this->db->where('g_trash','');
    	$this->db->where('g_archive','');
    	$query = $this->db->get('goals_members');
        return $query->result();
    }

    function TMOpenStrategies($reg_id,$portfolio_id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('screated_by', $reg_id);
		$this->db->where('portfolio_id', $portfolio_id);
		$this->db->where('s_trash', '');
		$this->db->where('s_archive', '');
		$query = $this->db->get('strategies');
		return $query->result();
	}

	function TMOpenProjects($reg_id,$portfolio_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->group_start();
    	$this->db->where('pcreated_by', $reg_id);
    	$this->db->or_where('pmanager', $reg_id);
    	$this->db->group_end();
    	$this->db->where('portfolio_id', $portfolio_id);
    	$this->db->where('ptrash','');
    	$this->db->where('project_archive','');
    	$query = $this->db->get('project');
        return $query->result();
    }

    function TMOpenPlannedContent($reg_id,$portfolio_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->group_start();
    	$this->db->where('written_content_assignee', $reg_id);
    	$this->db->or_where('pc_file_assignee', $reg_id);
    	$this->db->or_where('submit_to_approval', $reg_id);
    	$this->db->or_where('pc_assignee', $reg_id);
    	$this->db->group_end();
    	$this->db->where('portfolio_id', $portfolio_id);
    	$this->db->where('trash','');
    	$this->db->where('cp_archive','');
    	$query = $this->db->get('content_planning');
        return $query->result();
    }

    function TMOpenTasks($reg_id,$portfolio_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->group_start();
    	$this->db->where('tassignee', $reg_id);
    	$this->db->or_where('tcreated_by', $reg_id);
    	$this->db->group_end();
    	$this->db->where('portfolio_id', $portfolio_id);
    	$this->db->where('tproject_assign !=', '0');
    	$this->db->where('trash','');
    	$this->db->where('task_archive','');
    	$query = $this->db->get('task');
        return $query->result();
    }

    function TMOpenSubtasks($reg_id,$portfolio_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->group_start();
    	$this->db->where('stassignee', $reg_id);
    	$this->db->or_where('stcreated_by', $reg_id);
    	$this->db->group_end();
    	$this->db->where('portfolio_id', $portfolio_id);
    	$this->db->where('stproject_assign !=', '0');
    	$this->db->where('strash','');
    	$this->db->where('subtask_archive','');
    	$query = $this->db->get('subtask');
        return $query->result();
    }

    function getProjectOpenTM($reg_id,$portfolio_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('pmember', $reg_id);
    	$this->db->where('portfolio_id', $portfolio_id);
    	$this->db->where('ptrash','');
    	$this->db->where('project_archive','');
    	$query = $this->db->get('project_members');
        return $query->result();
    }

    function TMOpenGoals2($reg_id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->group_start();
    	$this->db->where('gcreated_by', $reg_id);
    	$this->db->or_where('gmanager', $reg_id);
    	$this->db->group_end();
		$this->db->where('g_trash', '');
		$this->db->where('g_archive', '');
		$query = $this->db->get('goals');
		return $query->result();
	}

	function getGoalOpenTM2($reg_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('gmember', $reg_id);
    	$this->db->where('g_trash','');
    	$this->db->where('g_archive','');
    	$query = $this->db->get('goals_members');
        return $query->result();
    }

    function TMOpenStrategies2($reg_id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('screated_by', $reg_id);
		$this->db->where('s_trash', '');
		$this->db->where('s_archive', '');
		$query = $this->db->get('strategies');
		return $query->result();
	}

	function TMOpenProjects2($reg_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->group_start();
    	$this->db->where('pcreated_by', $reg_id);
    	$this->db->or_where('pmanager', $reg_id);
    	$this->db->group_end();
    	$this->db->where('ptrash','');
    	$this->db->where('project_archive','');
    	$query = $this->db->get('project');
        return $query->result();
    }

    function TMOpenPlannedContent2($reg_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->group_start();
    	$this->db->where('written_content_assignee', $reg_id);
    	$this->db->or_where('pc_file_assignee', $reg_id);
    	$this->db->or_where('submit_to_approval', $reg_id);
    	$this->db->or_where('pc_assignee', $reg_id);
    	$this->db->group_end();
    	$this->db->where('trash','');
    	$this->db->where('cp_archive','');
    	$query = $this->db->get('content_planning');
        return $query->result();
    }

    function TMOpenTasks2($reg_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->group_start();
    	$this->db->where('tassignee', $reg_id);
    	$this->db->or_where('tcreated_by', $reg_id);
    	$this->db->group_end();
    	$this->db->where('tproject_assign !=', '0');
    	$this->db->where('trash','');
    	$this->db->where('task_archive','');
    	$query = $this->db->get('task');
        return $query->result();
    }

    function TMOpenSubtasks2($reg_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->group_start();
    	$this->db->where('stassignee', $reg_id);
    	$this->db->or_where('stcreated_by', $reg_id);
    	$this->db->group_end();
    	$this->db->where('stproject_assign !=', '0');
    	$this->db->where('strash','');
    	$this->db->where('subtask_archive','');
    	$query = $this->db->get('subtask');
        return $query->result();
    }

    function getProjectOpenTM2($reg_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('pmember', $reg_id);
    	$this->db->where('ptrash','');
    	$this->db->where('project_archive','');
    	$query = $this->db->get('project_members');
        return $query->result();
    }

    function getCompanyActiveRegEmps($id)
	{		
		$this->db->where('status', 'accepted');
		$this->db->where('emp_status', 'active');
		$this->db->where('cc_id', $id);
		$query = $this->db->get('contacted_company_emp');
		return $query->result();
	}

	function check_if_porttm($id,$sent_to)
	{
		$this->db->where('sent_to', $sent_to);
    	$this->db->where('portfolio_id', $id);
    	$query = $this->db->get('project_portfolio_member');
        return $query->row();
	}

	function delete_portfolio_member($id,$sent_to)
	{
		$this->db->where('sent_to', $sent_to);
		$this->db->where('portfolio_id',$id);
		if($this->db->delete('project_portfolio_member'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function insert_PortfolioMember($data)
    {
    	if($this->db->insert('project_portfolio_member',$data))
    	{
    		return TRUE;
    	}
    	else
    	{
    		return FALSE;
    	}
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

	function check_if_goaltm($gid,$new_reg_id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('gmember', $new_reg_id);
    	$this->db->where('gid', $gid);
    	$query = $this->db->get('goals_members');
        return $query->row();
	}

	function delete_gMember_mem_id($gid,$gmember)
	{
		//$this->db->where('pcreated_by', $this->session->userdata('d168_id'));
		$this->db->where('gid', $gid);
		$this->db->where('gmember', $gmember);
		if($this->db->delete('goals_members'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}		
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

	function insert_ProjectHistory($hdata)
	{
		if($this->db->insert('project_history',$hdata))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function insert_GoalTeamMember($data2)
	{
		if($this->db->insert('goals_members',$data2))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function CheckOpenGoalTM($reg_id,$gid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('gmember', $reg_id);
    	$this->db->where('gid', $gid);
    	$this->db->where('g_trash','');
    	$this->db->where('g_archive','');
    	$query = $this->db->get('goals_members');
        return $query->row();
    }

    function check_if_already_goaltm($reg_id,$portfolio_id,$gid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('gid', $gid);
    	$this->db->where('gmember', $reg_id);
    	$this->db->where('portfolio_id', $portfolio_id);
    	$this->db->where('g_trash','');
    	$this->db->where('g_archive','');
    	$query = $this->db->get('goals_members');
        return $query->num_rows();
    }

    function check_if_goalowner($gid,$new_reg_id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('gcreated_by', $new_reg_id);
    	$this->db->where('gid', $gid);
    	$query = $this->db->get('goals');
        return $query->num_rows();
	}

	function delete_gMember_with_port_id($reg_id,$portfolio_id)
	{
		//$this->db->where('pcreated_by', $this->session->userdata('d168_id'));
		$this->db->where('portfolio_id', $portfolio_id);
		$this->db->where('gmember', $reg_id);
		if($this->db->delete('goals_members'))
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

	function check_if_tm($pid,$new_reg_id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('pmember', $new_reg_id);
    	$this->db->where('pid', $pid);
    	$query = $this->db->get('project_members');
        return $query->row();
	}

	function delete_pMember_mem_id($pid,$pmember)
	{
		//$this->db->where('pcreated_by', $this->session->userdata('d168_id'));
		$this->db->where('pid', $pid);
		$this->db->where('pmember', $pmember);
		if($this->db->delete('project_members'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}		
	}

	function edit_Project($data,$id)
	{
		//$this->db->where('pcreated_by', $this->session->userdata('d168_id'));
		$this->db->where('pid', $id);
		if($this->db->update('project', $data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function getProjectById($id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('pid', $id);
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
    	$query = $this->db->get('project');
    	return $query->row();
    }

    function CheckOpenTM($reg_id,$pid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('pmember', $reg_id);
    	$this->db->where('pid', $pid);
    	$this->db->where('ptrash','');
    	$this->db->where('project_archive','');
    	$query = $this->db->get('project_members');
        return $query->row();
    }

    function check_if_already_tm($reg_id,$portfolio_id,$pid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('pid', $pid);
    	$this->db->where('pmember', $reg_id);
    	$this->db->where('portfolio_id', $portfolio_id);
    	$this->db->where('ptrash','');
    	$this->db->where('project_archive','');
    	$query = $this->db->get('project_members');
        return $query->num_rows();
    }

    function check_if_powner($pid,$new_reg_id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('pcreated_by', $new_reg_id);
    	$this->db->where('pid', $pid);
    	$query = $this->db->get('project');
        return $query->num_rows();
	}

	function insert_TeamMember($data2)
	{
		if($this->db->insert('project_members',$data2))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function delete_pMember_with_port_id($reg_id,$portfolio_id)
	{
		//$this->db->where('pcreated_by', $this->session->userdata('d168_id'));
		$this->db->where('portfolio_id', $portfolio_id);
		$this->db->where('pmember', $reg_id);
		if($this->db->delete('project_members'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}		
	}

	function update_Content($data,$pc_id)
	{
		$this->db->where('pc_id',$pc_id);
		if($this->db->update('content_planning',$data))
		{
		return TRUE;
		}
		else
		{
		return FALSE;
		}
	}

	function update_OpenTask($data,$tid,$tassignee)
	{
		$this->db->where('tid', $tid);
		$this->db->where('tassignee', $tassignee);
		if($this->db->update('task', $data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function edit_NewTask($data,$tid)
    {
    	$this->db->where('tid', $tid);
    	if($this->db->update('task', $data))
    	{
    		return TRUE;
    	}
    	else
    	{
    		return FALSE;
    	}
    }

    function update_OpenSubtask($data,$stid,$stassignee)
	{
		$this->db->where('stid', $stid);
		$this->db->where('stassignee', $stassignee);
		if($this->db->update('subtask', $data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function edit_NewSubtask($data,$stid)
    {
    	$this->db->where('stid', $stid);
    	if($this->db->update('subtask', $data))
    	{
    		return TRUE;
    	}
    	else
    	{
    		return FALSE;
    	}
    }
	//open work new assignee 

	function delete_contacted_company_emp($id)
    {
		$this->db->where('cce_id', $id);
        $this->db->delete('contacted_company_emp');
    }

    function delete_registration($id)
    {
		$this->db->where('reg_id', $id);
        $this->db->delete('registration');
    }

    function insertDeletedRegistration($data)
	{
		if($this->db->insert('registration_deleted',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	//Roles

	function getCompanyRoles($id)
	{
		$this->db->where('cc_id', $id);
		$query = $this->db->get('contacted_company_roles');
		return $query->result();
	}

	function insert_contacted_company_roles($data2)
    {
        if($this->db->insert('contacted_company_roles',$data2))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    function role_detail($id)
	{
		$this->db->where('ccr_id', $id);
		$query = $this->db->get('contacted_company_roles');
		return $query->row();
	}

	function update_contacted_company_roles($data2,$id)
    {
		$this->db->where('ccr_id', $id);
        if($this->db->update('contacted_company_roles',$data2))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    function checkRoleAssigned($id)
	{
		$this->db->where('role_in_comp', $id);
		$query = $this->db->get('registration');
		return $query->num_rows();
	}

	function updateRoleRegistration($data,$id)
	{
		$this->db->where('role_in_comp', $id);
		$this->db->update('registration',$data);
	}

	function delete_role($id)
    {
		$this->db->where('ccr_id', $id);
        $this->db->delete('contacted_company_roles');
    }

    function getCompanyRolesAsc($id)
	{
		$this->db->order_by('role','ASC');
		$this->db->where('cc_id', $id);
		$query = $this->db->get('contacted_company_roles');
		return $query->result();
	}

	function updateRegistrationID($data,$reg_id)
	{
		$this->db->where('reg_id', $reg_id);
		$this->db->update('registration',$data);
	}

	//Roles

	// package usage	

	function getPortfolioCountCorp($cc_corporate_id)
	{
		$query = $this->db->query("SELECT COUNT(*) as portfolio_count_rows FROM project_portfolio where corporate_id='".$cc_corporate_id."' and portfolio_trash = '' and portfolio_archive = '' and portfolio_file_it = '' and reg_acc_status != 'deactivated'");
		return $query->row_array();
	}

	function getGoalCountCorp($cc_corporate_id)
	{
		$query = $this->db->query("SELECT COUNT(*) as goal_count_rows FROM goals where corporate_id='".$cc_corporate_id."' and g_trash = '' and g_archive = '' and g_file_it = '' and reg_acc_status != 'deactivated'");
		return $query->row_array();
	}

	function getStrategiesCountCorp($cc_corporate_id)
	{
		$query = $this->db->query("SELECT COUNT(*) as strategy_count_rows FROM strategies where corporate_id='".$cc_corporate_id."' and s_trash = '' and s_archive = '' and s_file_it = '' and reg_acc_status != 'deactivated'");
		return $query->row_array();
	}

	function getProjectCountCorp($cc_corporate_id)
	{
		$query = $this->db->query("SELECT COUNT(*) as project_count_rows FROM project where corporate_id='".$cc_corporate_id."'  and ptrash = '' and project_archive = '' and project_file_it = '' and (ptype = 'regular' or ptype = 'goal_strategy') and reg_acc_status != 'deactivated'");
		return $query->row_array();
	}

	function getMonthWiseContentCorp($current_month,$current_year,$cc_corporate_id)
	{
		$query = $this->db->query("SELECT COUNT(*) as content_count_rows FROM project where corporate_id='".$cc_corporate_id."' and ptype='content' and month(pcreated_date)='".$current_month."'  and year(pcreated_date)='".$current_year."' and ptrash = '' and project_archive = '' and project_file_it = '' and reg_acc_status != 'deactivated'");
		return $query->row_array();
	}

	// package usage
}
?>