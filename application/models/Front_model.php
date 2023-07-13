<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front_model extends CI_Model {

	function insertRegistration($data)
	{
		if($this->db->insert('registration',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function insertDeletedRegistration($data)
	{
		if($this->db->insert('registration_deleted',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function checkLogin($email,$password)
	{
		$this->db->where('email_address', $email);
		$this->db->where('password', $password);
		$query = $this->db->get('registration');
		return $query->num_rows();
	}

	function selectLogin($email)
	{
		$this->db->where('email_address', $email);
		$query = $this->db->get('registration');
		return $query->row();
	}

	function check_re_created_acc($email)
	{
		$this->db->where('email_address', $email);
		$query = $this->db->get('registration_deleted');
		return $query->row();
	}

	function delete_registration_deleted($email)
	{
		$this->db->where('email_address',$email);
		if($this->db->delete('registration_deleted'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function updateRegistration($data,$id)
	{
		$this->db->where('reg_id', $id);
		$this->db->update('registration',$data);
	}

	function getStudentById($id)
	{
		$this->db->where('reg_id', $id);
		$query = $this->db->get('registration');
		return $query->row();
	}
	 
    function insert_NewProject($data)
	{
		if($this->db->insert('project',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function get_SideBar_Portfolio($sideb_email)
	{
		$this->db->order_by('pp.portfolio_name','ASC');
		$this->db->where('ppm.reg_acc_status !=','deactivated');
		$this->db->where('ppm.working_status','active');
		$this->db->where('ppm.status','accepted');
		$this->db->where('pp.portfolio_archive !=', 'yes');
		$this->db->where('pp.portfolio_file_it !=', 'yes');
		$this->db->where('pp.portfolio_trash !=','yes');
		$this->db->where('ppm.sent_to', $sideb_email);
		$this->db->select('*, ppm.portfolio_id as ppm_port_id, pp.portfolio_id as portfolio_id');
		$this->db->from('project_portfolio_member as ppm');
		$this->db->join('project_portfolio as pp','ppm.portfolio_id = pp.portfolio_id');
		$query = $this->db->get();
		return $query->result();
	}

	function get_SideBar_ALLPortfolio($sideb_email)
	{
		$this->db->order_by('pp.portfolio_name','ASC');
		$this->db->where('ppm.reg_acc_status !=','deactivated');
		$this->db->where('ppm.working_status','active');
		$this->db->where('ppm.status','accepted');
		$this->db->where('ppm.sent_to', $sideb_email);
		$this->db->select('*, ppm.portfolio_id as ppm_port_id, pp.portfolio_id as portfolio_id');
		$this->db->from('project_portfolio_member as ppm');
		$this->db->join('project_portfolio as pp','ppm.portfolio_id = pp.portfolio_id');
		$query = $this->db->get();
		return $query->result();
	}

	function Portfolio()
	{
		$this->db->order_by('portfolio_id','DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_archive !=', 'yes');
		$this->db->where('portfolio_file_it !=', 'yes');
		$this->db->where('portfolio_trash !=','yes');
		$this->db->where('portfolio_createdby',$this->session->userdata('d168_id'));
		$query = $this->db->get('project_portfolio');
		return $query->result();
	}

	function AcceptedProjectListPortfolio()
	{
		$this->db->order_by('p.portfolio_id', 'DESC');
		$this->db->group_by('p.portfolio_id');
		$this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->where('p.ptrash !=', 'yes');
		$this->db->where('p.project_archive !=', 'yes');
		$this->db->where('p.project_file_it !=', 'yes');
		$this->db->where('pm.status', 'accepted');
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');
        $this->db->from('project as p');
        $this->db->join('project_members as pm','pm.pid = p.pid');
        $query = $this->db->get();
        return $query->result();
	}

	function CompanyPortfolio()
	{
		$this->db->order_by('portfolio_id','DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_archive !=', 'yes');
		$this->db->where('portfolio_file_it !=', 'yes');
		$this->db->where('portfolio_trash !=','yes');
		$this->db->where('portfolio_createdby',$this->session->userdata('d168_id'));
		$this->db->where('portfolio_user','company');
		$query = $this->db->get('project_portfolio');
		return $query->result();
	}

	function AcceptedProjectListCompanyPortfolio()
	{
		$this->db->order_by('p.portfolio_id', 'DESC');
		$this->db->group_by('p.portfolio_id');
		$this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->where('pp.portfolio_archive !=', 'yes');
		$this->db->where('pp.portfolio_file_it !=', 'yes');
		$this->db->where('p.ptrash !=', 'yes');
		$this->db->where('pm.status', 'accepted');
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));
		$this->db->where('pp.portfolio_user','company');
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');
        $this->db->from('project as p');
        $this->db->join('project_members as pm','pm.pid = p.pid');
        $this->db->join('project_portfolio as pp','pp.portfolio_id = p.portfolio_id');
        $query = $this->db->get();
        return $query->result();
	}

	function IndividualPortfolio()
	{
		$this->db->order_by('portfolio_id','DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_archive !=', 'yes');
		$this->db->where('portfolio_file_it !=', 'yes');
		$this->db->where('portfolio_trash !=','yes');
		$this->db->where('portfolio_createdby',$this->session->userdata('d168_id'));
		$this->db->where('portfolio_user','individual');
		$query = $this->db->get('project_portfolio');
		return $query->result();
	}

	function AcceptedProjectListIndividualPortfolio()
	{
		$this->db->order_by('p.portfolio_id', 'DESC');
		$this->db->group_by('p.portfolio_id');
		$this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->where('pp.portfolio_archive !=', 'yes');
		$this->db->where('pp.portfolio_file_it !=', 'yes');
		$this->db->where('pp.portfolio_trash !=', 'yes');
		$this->db->where('pm.status', 'accepted');
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));
		$this->db->where('pp.portfolio_user','individual');
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');
        $this->db->from('project as p');
        $this->db->join('project_members as pm','pm.pid = p.pid');
        $this->db->join('project_portfolio as pp','pp.portfolio_id = p.portfolio_id');
        $query = $this->db->get();
        return $query->result();
	}

	function getAllPortfolio($c_id)
	{
		$this->db->order_by('portfolio_id','DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_archive !=', 'yes');
		$this->db->where('portfolio_file_it !=', 'yes');
		$this->db->where('portfolio_trash !=','yes');
		$this->db->where('portfolio_id',$c_id);
		$query = $this->db->get('project_portfolio');
		return $query->row();
	}

	function portfolio_projectsNotArc($c_id)
	{
		$this->db->order_by('pid','DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_id',$c_id);
		$this->db->where('ptrash !=','yes');
		$query = $this->db->get('project');
		return $query->result();
	}

	function portfolio_projectsTrash($c_id)
	{
		$this->db->order_by('pid','DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_id',$c_id);
		$query = $this->db->get('project');
		return $query->result();
	}

	function portfolio_projectsRetriveTrash($c_id)
	{
		$this->db->order_by('pid','DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('psingle_trash !=','yes');
		$this->db->where('portfolio_id',$c_id);
		$query = $this->db->get('project');
		return $query->result();
	}

	function portfolio_projects($c_id)
	{
		$this->db->order_by('pid','DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_id',$c_id);
		$this->db->where('project_archive !=','yes');
		$this->db->where('project_file_it !=','yes');
		$this->db->where('ptrash !=','yes');
		$query = $this->db->get('project');
		return $query->result();
	}

	function portfolio_tasks($c_id)
	{
		$this->db->order_by('tid', 'DESC');
		$this->db->select('t.tid,t.tcode,t.tname,t.tpriority,t.tstatus,t.tdue_date,t.tproject_assign,p.pname,p.pcreated_by,CONCAT_WS(" ", r.first_name,r.last_name) AS name');
		$this->db->where('t.reg_acc_status !=','deactivated');
		$this->db->where('t.portfolio_id',$c_id);
		$this->db->where('t.trash !=', 'yes');
		$this->db->where('t.task_archive !=', 'yes');
		$this->db->where('t.task_file_it !=', 'yes');
		$this->db->from('task as t');
        $this->db->join('registration as r', 'r.reg_id = t.tassignee');
        $this->db->join('project as p','p.pid = t.tproject_assign');
        $query = $this->db->get();
		return $query->result();
	}

	function portfolio_tasksNew($c_id)
	{
		$this->db->order_by('tid', 'DESC');
		$this->db->select('*');
		$this->db->where('t.reg_acc_status !=','deactivated');
		$this->db->where('t.portfolio_id',$c_id);
		$this->db->where('t.trash !=', 'yes');
		$this->db->where('t.task_archive !=', 'yes');
		$this->db->where('t.task_file_it !=', 'yes');
		$this->db->from('task as t');
        $this->db->join('registration as r', 'r.reg_id = t.tassignee');
        $this->db->join('project as p','p.pid = t.tproject_assign');
        $query = $this->db->get();
		return $query->result();
	}

	function portfolio_tasksNewByProj($c_id,$pid)
	{
		$this->db->order_by('tid', 'DESC');
		$this->db->select('*');
		$this->db->where('t.reg_acc_status !=','deactivated');
		$this->db->where('t.portfolio_id',$c_id);
		$this->db->where('t.trash !=', 'yes');
		$this->db->where('t.task_archive !=', 'yes');
		$this->db->where('t.task_file_it !=', 'yes');
		$this->db->where('t.tproject_assign', $pid);
		$this->db->from('task as t');
        $this->db->join('registration as r', 'r.reg_id = t.tassignee');
        $this->db->join('project as p','p.pid = t.tproject_assign');
        $query = $this->db->get();
		return $query->result();
	}

	function portfolio_subtasks($c_id)
	{
		$this->db->order_by('stid', 'DESC');
		$this->db->select('t.tname,t.tid,st.stid,st.stcode,st.stname,st.stpriority,st.ststatus,st.stdue_date,st.stproject_assign,p.pname,p.pcreated_by,CONCAT_WS(" ", r.first_name,r.last_name) AS name');
		$this->db->where('st.portfolio_id',$c_id);
		$this->db->where('st.strash !=', 'yes');
		$this->db->where('t.task_archive !=', 'yes');
		$this->db->where('t.task_file_it !=', 'yes');
		$this->db->where('st.subtask_archive !=', 'yes');
		$this->db->where('st.subtask_file_it !=', 'yes');
		$this->db->where('st.reg_acc_status !=','deactivated');
		$this->db->from('subtask as st');
        $this->db->join('registration as r', 'r.reg_id = st.stassignee');
        $this->db->join('project as p','p.pid = st.stproject_assign');
        $this->db->join('task as t','t.tid = st.tid');
        $query = $this->db->get();
		return $query->result();
	}

	function portfolio_team_member($c_id,$portfolio_createdby)
	{
		$this->db->group_by('pmember');
		$this->db->where('pmember !=',$portfolio_createdby);
		$this->db->where('pm.portfolio_id',$c_id);
		$this->db->where('status','accepted');
		$this->db->where('pm.ptrash !=', 'yes');
		$this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->select('r.reg_id,r.first_name,r.last_name,r.photo,pm_id,pm.status,pm.pmember');
        $this->db->from('registration as r');
        $this->db->join('project_members as pm', 'pm.pmember = r.reg_id');
        $query = $this->db->get();
        return $query->result();
	}

	function portfolio_team_member_project($c_id)
	{
		$this->db->group_by('pmember');
		$this->db->where('pm.portfolio_id',$c_id);
		$this->db->where('pm.ptrash !=', 'yes');
		$this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->select('r.reg_id,r.first_name,r.last_name,r.photo,pm_id,pm.status,pm.pmember');
        $this->db->from('registration as r');
        $this->db->join('project_members as pm', 'pm.pmember = r.reg_id');
        $query = $this->db->get();
        return $query->result();
	}

	function Check_port_tm($pmember,$pid)
	{
		$this->db->where('pm.pmember', $pmember);
		$this->db->where('pm.ptrash !=', 'yes');
		$this->db->where('pm.pid', $pid);
		$this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->select('r.reg_id,r.first_name,r.last_name,pm.status,pm.pcreated_by,pm.pmember');
        $this->db->from('registration as r');
        $this->db->join('project_members as pm', 'pm.pmember = r.reg_id');
        $query = $this->db->get();
        return $query->row();
	}

	function insert_NewPortfolio($data)
	{
		if($this->db->insert('project_portfolio',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function getPortfolioNotArc($c_id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_createdby',$this->session->userdata('d168_id'));
		$this->db->where('portfolio_id',$c_id);
		$query = $this->db->get('project_portfolio');
		return $query->row();
	}

	function getPortfolio($c_id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_archive !=', 'yes');
		$this->db->where('portfolio_file_it !=', 'yes');
		$this->db->where('portfolio_createdby',$this->session->userdata('d168_id'));
		$this->db->where('portfolio_id',$c_id);
		$query = $this->db->get('project_portfolio');
		return $query->row();
	}

	function getPortfolio2($c_id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_archive !=', 'yes');
		$this->db->where('portfolio_file_it !=', 'yes');
		$this->db->where('portfolio_id',$c_id);
		$query = $this->db->get('project_portfolio');
		return $query->row();
	}

	function getPortfolioName($c_id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_id',$c_id);
		$query = $this->db->get('project_portfolio');
		return $query->row();
	}

	function getPortfolio3($c_id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_archive !=', 'yes');
		$this->db->where('portfolio_file_it !=', 'yes');
		$this->db->where('portfolio_trash !=','yes');
		$this->db->where('portfolio_id',$c_id);
		$query = $this->db->get('project_portfolio');
		return $query->row();
	}

	function UpdatePortfolio($data,$c_id)
	{
		$this->db->where('portfolio_id',$c_id);
		if($this->db->update('project_portfolio',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function UpdatePortfolioMemberArchive($data2,$c_id)
	{
		$this->db->where('portfolio_id',$c_id);
		if($this->db->update('project_portfolio_member',$data2))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function UpdatePortfolioProjectArchive($data3,$c_id)
	{
		$this->db->where('portfolio_id',$c_id);
		if($this->db->update('project',$data3))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function UpdatePortfolioProjectRetrieveArchive($data3,$c_id)
	{
		$this->db->where('psingle_trash','');
		$this->db->where('portfolio_id',$c_id);
		if($this->db->update('project',$data3))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function UpdatePortfolioTaskArchive($data10,$c_id)
	{
		$this->db->where('portfolio_id',$c_id);
		if($this->db->update('task',$data10))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function UpdatePortfolioTaskArchiveRetrive($data10,$c_id)
	{
		$this->db->where('tsingle_trash','');
		$this->db->where('portfolio_id',$c_id);
		if($this->db->update('task',$data10))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function UpdatePortfolioSubtaskArchive($data11,$c_id)
	{
		$this->db->where('portfolio_id',$c_id);
		if($this->db->update('subtask',$data11))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function UpdatePortfolioSubtaskArchiveRetrieve($data11,$c_id)
	{
		$this->db->where('stsingle_trash','');
		$this->db->where('portfolio_id',$c_id);
		if($this->db->update('subtask',$data11))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function getPortfolioAllTaskNotArc($port_id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('trash !=','yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('portfolio_id',$port_id);
		$query = $this->db->get('task');
		return $query->result();
	}

	function getPortfolioAllTaskTrash($port_id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_id',$port_id);
		$query = $this->db->get('task');
		return $query->result();
	}

	function getProjectAllTaskTrash($pid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('tproject_assign',$pid);
		$query = $this->db->get('task');
		return $query->result();
	}

	function getPortfolioAllSubtaskNotArc($port_id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('strash !=','yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('portfolio_id',$port_id);
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function getPortfolioAllSubtaskTrash($port_id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_id',$port_id);
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function getProjectAllSubtaskTrash($pid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('stproject_assign',$pid);
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function getProjectAllTaskNotArc($id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('trash !=','yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$this->db->where('tproject_assign',$id);
		$query = $this->db->get('task');
		return $query->result();
	}

	function getProjectAllSubtaskNotArc($id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('strash !=','yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$this->db->where('stproject_assign',$id);
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function getTaskAllSubtaskNotArc($id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('strash !=','yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$this->db->where('tid',$id);
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function ArchivePortfolio()
	{
		$this->db->order_by('portfolio_id','DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_archive','yes');
		$this->db->where('portfolio_trash !=','yes');
		$this->db->where('portfolio_createdby',$this->session->userdata('d168_id'));
		$query = $this->db->get('project_portfolio');
		return $query->result();
	}

	function TrashPortfolio()
	{
		$this->db->order_by('portfolio_id','DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_trash','yes');
		$this->db->where('portfolio_createdby',$this->session->userdata('d168_id'));
		$query = $this->db->get('project_portfolio');
		return $query->result();
	}

	function check_request_member($pid,$reg_id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('pid',$pid);
		$this->db->where('member',$reg_id);
		$this->db->where('status','sent');
		$query = $this->db->get('project_request_member');
		return $query->num_rows();
	}

	function insert_project_request_member($data)
	{
		if($this->db->insert('project_request_member',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function update_project_request_member($data,$pid,$member)
	{
		$this->db->where('pid',$pid);
		$this->db->where('member',$member);
		if($this->db->update('project_request_member',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function ProjectListByPortfolio($get_port_id)
	{
		$this->db->order_by('portfolio_id', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_id', $get_port_id);
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$this->db->where('pcreated_by', $this->session->userdata('d168_id'));
		$query = $this->db->get('project');
		return $query->result();
	}

	function AcceptedProjectListByPortfolio($get_port_id)
	{
		$this->db->order_by('p.portfolio_id', 'DESC');
		$this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->where('p.portfolio_id', $get_port_id);
		$this->db->where('p.ptrash !=', 'yes');
		$this->db->where('p.project_archive !=', 'yes');
		$this->db->where('p.project_file_it !=', 'yes');
		$this->db->where('pm.status', 'accepted');
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');
        $this->db->from('project as p');
        $this->db->join('project_members as pm','pm.pid = p.pid');
        $query = $this->db->get();
        return $query->result();
	}

	function ProjectListByPortfolioRegular($get_port_id)
	{
		$this->db->order_by('portfolio_id', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->group_start();
		$this->db->where('ptype', 'regular');
		$this->db->or_where('ptype', 'goal_strategy');
		$this->db->group_end();
		$this->db->where('portfolio_id', $get_port_id);
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$this->db->where('pcreated_by', $this->session->userdata('d168_id'));
		$query = $this->db->get('project');
		return $query->result();
	}

	function AcceptedProjectListByPortfolioRegular($get_port_id)
	{
		$this->db->order_by('p.portfolio_id', 'DESC');
		$this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->group_start();
		$this->db->where('ptype', 'regular');
		$this->db->or_where('ptype', 'goal_strategy');
		$this->db->group_end();
		$this->db->where('p.portfolio_id', $get_port_id);
		$this->db->where('p.ptrash !=', 'yes');
		$this->db->where('p.project_archive !=', 'yes');
		$this->db->where('p.project_file_it !=', 'yes');
		$this->db->where('pm.status', 'accepted');
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');
        $this->db->from('project as p');
        $this->db->join('project_members as pm','pm.pid = p.pid');
        $query = $this->db->get();
        return $query->result();
	}

	function PendingProjectListByPortfolio($get_port_id)
	{
		$this->db->order_by('p.portfolio_id', 'DESC');
		$this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->where('p.portfolio_id', $get_port_id);
		$this->db->where('p.ptrash', '');
		$this->db->where('p.project_archive', '');
		$this->db->where('p.project_file_it', '');
		$this->db->where('pm.status', 'send');
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');
        $this->db->from('project as p');
        $this->db->join('project_members as pm','pm.pid = p.pid');
        $query = $this->db->get();
        return $query->result();
	}

	function PendingProjectListByPortfolioRegular($get_port_id)
	{
		$this->db->order_by('p.portfolio_id', 'DESC');
		$this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->group_start();
		$this->db->where('ptype', 'regular');
		$this->db->or_where('ptype', 'goal_strategy');
		$this->db->group_end();
		$this->db->where('p.portfolio_id', $get_port_id);
		$this->db->where('p.ptrash', '');
		$this->db->where('p.project_archive', '');
		$this->db->where('p.project_file_it', '');
		$this->db->where('pm.status', 'send');
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');
        $this->db->from('project as p');
        $this->db->join('project_members as pm','pm.pid = p.pid');
        $query = $this->db->get();
        return $query->result();
	}

	function ReadMoreProjectListByPortfolio($get_port_id)
	{
		$this->db->order_by('p.portfolio_id', 'DESC');
		$this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->where('p.portfolio_id', $get_port_id);
		$this->db->where('p.ptrash !=', 'yes');
		$this->db->where('p.project_archive !=', 'yes');
		$this->db->where('p.project_file_it !=', 'yes');
		$this->db->where('pm.status', 'read_more');
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');
        $this->db->from('project as p');
        $this->db->join('project_members as pm','pm.pid = p.pid');
        $query = $this->db->get();
        return $query->result();
	}

	function ReadMoreProjectListByPortfolioRegular($get_port_id)
	{
		$this->db->order_by('p.portfolio_id', 'DESC');
		$this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->group_start();
		$this->db->where('ptype', 'regular');
		$this->db->or_where('ptype', 'goal_strategy');
		$this->db->group_end();
		$this->db->where('p.portfolio_id', $get_port_id);
		$this->db->where('p.ptrash !=', 'yes');
		$this->db->where('p.project_archive !=', 'yes');
		$this->db->where('p.project_file_it !=', 'yes');
		$this->db->where('pm.status', 'read_more');
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');
        $this->db->from('project as p');
        $this->db->join('project_members as pm','pm.pid = p.pid');
        $query = $this->db->get();
        return $query->result();
	}

	function ProjectList()
	{
		$this->db->order_by('portfolio_id', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$this->db->where('pcreated_by', $this->session->userdata('d168_id'));
		$query = $this->db->get('project');
		return $query->result();
	}

	function ProjectDetail($id)
	{		
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('pcreated_by', $this->session->userdata('d168_id'));
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$this->db->where('pid',$id);
		$query = $this->db->get('project');
		return $query->row();
	}

	function ProjectDetailCheck($id)
	{		
		// $this->db->group_start();
		// $this->db->where('pcreated_by', $this->session->userdata('d168_id'));
		// $this->db->or_where('pmanager', $this->session->userdata('d168_id'));
		// $this->db->group_end();
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$this->db->where('pid',$id);
		$query = $this->db->get('project');
		return $query->row();
	}

	function ProjectDetail2($id)
	{		
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$this->db->where('pid',$id);
		$query = $this->db->get('project');
		return $query->row();
	}

	function ProjectDetailPortfolio($id)
	{		
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$this->db->where('pid',$id);
		$query = $this->db->get('project');
		return $query->row();
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

	function edit_project_files($data2,$id)
	{
		$this->db->where('pid', $id);
		if($this->db->update('project_files', $data2))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function edit_project_invited_members($data3,$id)
	{
		$this->db->where('pid', $id);
		if($this->db->update('project_invited_members', $data3))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function edit_project_management($data4,$id)
	{
		$this->db->where('pid', $id);
		if($this->db->update('project_management', $data4))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function edit_project_management_fields($data5,$id)
	{
		$this->db->where('pid', $id);
		if($this->db->update('project_management_fields', $data5))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function edit_project_members($data6,$id)
	{
		$this->db->where('pid', $id);
		if($this->db->update('project_members', $data6))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function edit_project_suggested_members($data7,$id)
	{
		$this->db->where('pid', $id);
		if($this->db->update('project_suggested_members', $data7))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function edit_project_tasks($data8,$id)
	{
		$this->db->where('tproject_assign', $id);
		if($this->db->update('task', $data8))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function edit_project_tasksSentTrash($data8,$id)
	{
		$this->db->where('tsingle_trash','');
		$this->db->where('tproject_assign', $id);
		if($this->db->update('task', $data8))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function edit_project_tasksRetrieve($data8,$id)
	{
		$this->db->where('tsingle_trash','p_yes');
		$this->db->where('tproject_assign', $id);
		if($this->db->update('task', $data8))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function getTasksProject($pid)
	{
		$this->db->order_by('tid','DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('tproject_assign',$pid);
		$this->db->where('task_archive', '');
		$this->db->where('task_file_it', '');
		$this->db->where('trash','');
		$query = $this->db->get('task');
		return $query->result();
	}

	function getTasksProjectLinks($pid)
	{
		$this->db->order_by('tid','DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('tlink !=','');
		$this->db->where('tproject_assign',$pid);
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$query = $this->db->get('task');
		return $query->result();
	}

	function getSubtasksProjectLinks($pid)
	{
		$this->db->order_by('stid','DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('stlink !=','');
		$this->db->where('stproject_assign',$pid);
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function getTasksDetail($tid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('tid',$tid);
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$query = $this->db->get('task');
		return $query->row();
	}

	function getMemberProject($pid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$this->db->where('pid',$pid);
		$query = $this->db->get('project_members');
		return $query->result();
	}

	function get_project_trash_date($get_today_date)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('ptrash_date',$get_today_date);
		$query = $this->db->get('project');
		return $query->result();
	}

	function delete_project($id)
	{
		$this->db->where('pid',$id);
		if($this->db->delete('project'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function delete_project_files($id)
	{
		$this->db->where('pid',$id);
		if($this->db->delete('project_files'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function delete_project_invited_members($id)
	{
		$this->db->where('pid',$id);
		if($this->db->delete('project_invited_members'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function delete_project_management($id)
	{
		$this->db->where('pid',$id);
		if($this->db->delete('project_management'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function delete_project_management_fields($id)
	{
		$this->db->where('pid',$id);
		if($this->db->delete('project_management_fields'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function delete_project_members($id)
	{
		$this->db->where('pid',$id);
		if($this->db->delete('project_members'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function delete_project_suggested_members($id)
	{
		$this->db->where('pid',$id);
		if($this->db->delete('project_suggested_members'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function delete_project_history($id)
	{
		$this->db->where('pid',$id);
		if($this->db->delete('project_history'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function delete_project_request_member($id)
	{
		$this->db->where('pid',$id);
		if($this->db->delete('project_request_member'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function delete_project_tasks($id)
	{
		$this->db->where('tproject_assign',$id);
		if($this->db->delete('task'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function delete_project_subtasks($id)
	{
		$this->db->where('stproject_assign',$id);
		if($this->db->delete('subtask'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function get_task_trash_date($get_today_date)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('trash_date',$get_today_date);
		$query = $this->db->get('task');
		return $query->result();
	}

	function delete_task($id)
	{
		$this->db->where('tid',$id);
		if($this->db->delete('task'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function delete_task_t_trash($id)
	{
		$this->db->where('tid',$id);
		if($this->db->delete('task_trash'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function delete_task_subtask_trash($id)
	{
		$this->db->where('tid',$id);
		if($this->db->delete('subtask_trash'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function delete_task_st_trash($id)
	{
		$this->db->where('stid',$id);
		if($this->db->delete('subtask_trash'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function delete_task_subtask($id)
	{
		$this->db->where('tid',$id);
		if($this->db->delete('subtask'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function get_portfolio_trash_date($get_today_date)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_trash_date',$get_today_date);
		$query = $this->db->get('project_portfolio');
		return $query->result();
	}

	function delete_portfolio($id)
	{
		$this->db->where('portfolio_id',$id);
		if($this->db->delete('project_portfolio'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function delete_portfolio_member($id)
	{
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

	function delete_portfolio_project($id)
	{
		$this->db->where('portfolio_id',$id);
		if($this->db->delete('project'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function delete_portfolio_task($id)
	{
		$this->db->where('portfolio_id',$id);
		if($this->db->delete('task'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function delete_portfolio_subtask($id)
	{
		$this->db->where('portfolio_id',$id);
		if($this->db->delete('subtask'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function insert_ProjectFile($data1)
	{
		if($this->db->insert('project_files',$data1))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function ProjectFile($pid)
	{
		$this->db->order_by('pfile_id','DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('pid', $pid);
		$this->db->where('project_archive', '');
		$this->db->where('project_file_it', '');
		$this->db->where('ptrash', '');
		$query = $this->db->get('project_files');
		return $query->result();
	}

	function TaskFile($pid)
	{
		$this->db->order_by('tid','DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('tfile !=','');
		$this->db->where('tproject_assign', $pid);
		$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$query = $this->db->get('task');
		return $query->result();
	}

	function getTaskById($tid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('tid', $tid);
		$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$query = $this->db->get('task');
		return $query->row();
	}

	function pfile_detail($id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('pfile_id', $id);
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$this->db->where('ptrash !=', 'yes');
		$query = $this->db->get('project_files');
		return $query->row();
	}
	
	function download_PFileAttachment($id,$pfile_id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('pfile_id', $pfile_id);
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('pid',$id);
		$query = $this->db->get('project_files');
		return $query->row();
	}

	function get_pfile_trash($get_today_date)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('ptrash_date',$get_today_date);
		$query = $this->db->get('project_files');
		return $query->result();
	}

	function delete_pfile($pfile_id)
	{
		$this->db->where('pfile_id',$pfile_id);
		if($this->db->delete('project_files'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function Team_Members()
	{
		$this->db->where('verified', 'yes');
		$this->db->where('reg_id !=', $this->session->userdata('d168_id'));
		$query = $this->db->get('registration');
		return $query->result();
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

	function Edit_Team_Members($id)
	{		
		$query = $this->db->query('select r.reg_id,r.first_name,r.last_name from registration r where r.reg_id !="'.$this->session->userdata('d168_id').'" and r.reg_acc_status != "deactivated" and verified = "yes" and NOT EXISTS(select * from project_members pm where pm.pmember = r.reg_id and pm.reg_acc_status != "deactivated" and pm.ptrash != "yes" and project_archive != "yes" and project_file_it != "yes" and pm.pid = "'.$id.'")');
        
        return $query->result();
	}

	function ProjectTeamMember($pid)
	{
		$this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->where('pm.pid', $pid);
		$this->db->where('pm.project_archive !=', 'yes');
		$this->db->where('pm.project_file_it !=', 'yes');
		$this->db->where('pm.ptrash !=', 'yes');
		$this->db->select('r.reg_id,r.first_name,r.last_name,r.photo,pm_id,pm.status,pm.pmember');
        $this->db->from('registration as r');
        $this->db->join('project_members as pm', 'pm.pmember = r.reg_id');
        $query = $this->db->get();
        return $query->result();
	}

	function CheckProjectTeamMember($pid)
	{
		$this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->where('pm.pid', $pid);
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));
		$this->db->where('pm.ptrash !=', 'yes');
		$this->db->where('pm.project_archive !=', 'yes');
		$this->db->where('pm.project_file_it !=', 'yes');
		$this->db->select('r.reg_id,r.first_name,r.last_name,r.photo,pm_id,pm.status,pm.pmember');
        $this->db->from('registration as r');
        $this->db->join('project_members as pm', 'pm.pmember = r.reg_id');
        $query = $this->db->get();
        return $query->result();
	}

	function delete_pMember($pid,$pm_id)
	{
		//$this->db->where('pcreated_by', $this->session->userdata('d168_id'));
		$this->db->where('pid', $pid);
		$this->db->where('pm_id', $pm_id);
		if($this->db->delete('project_members'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}		
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

	function getEmailID($t)
	{
		$this->db->where('reg_id', $t);
		$query = $this->db->get('registration');
		return $query->row();
	}

	function project_request($p_id,$reg_id,$pmember_id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('pm_id', $pmember_id);
		$this->db->where('pmember', $reg_id);
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$this->db->where('pid', $p_id);
		$query = $this->db->get('project_members');
		return $query->num_rows();
	}

	function project_request_status($p_id,$reg_id,$pmember_id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('pm_id', $pmember_id);
		$this->db->where('pmember', $reg_id);
		$this->db->where('pid', $p_id);
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$query = $this->db->get('project_members');
		return $query->row();
	}

	function update_project_request($data3,$p_id,$reg_id,$pmember_id)
	{
		$this->db->where('pm_id', $pmember_id);
		$this->db->where('pmember', $reg_id);
		$this->db->where('pid', $p_id);
		$this->db->where('ptrash !=', 'yes');
		if($this->db->update('project_members',$data3))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function AcceptedProjectList()
	{
		$this->db->order_by('p.portfolio_id', 'DESC');
		$this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->where('p.ptrash !=', 'yes');
		$this->db->where('p.project_archive !=', 'yes');
		$this->db->where('p.project_file_it !=', 'yes');
		$this->db->where('pm.status', 'accepted');
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');
        $this->db->from('project as p');
        $this->db->join('project_members as pm','pm.pid = p.pid');
        $query = $this->db->get();
        return $query->result();
	}

	function PendingProjectList()
	{
		$this->db->order_by('p.portfolio_id', 'DESC');
		$this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->where('p.ptrash', '');
		$this->db->where('p.project_archive', '');
		$this->db->where('p.project_file_it', '');
		$this->db->where('pm.status', 'send');
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');
        $this->db->from('project as p');
        $this->db->join('project_members as pm','pm.pid = p.pid');
        $query = $this->db->get();
        return $query->result();
	}

	function ReadMoreProjectList()
	{
		$this->db->order_by('p.portfolio_id', 'DESC');
		$this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->where('p.ptrash !=', 'yes');
		$this->db->where('p.project_archive !=', 'yes');
		$this->db->where('p.project_file_it !=', 'yes');
		$this->db->where('pm.status', 'read_more');
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');
        $this->db->from('project as p');
        $this->db->join('project_members as pm','pm.pid = p.pid');
        $query = $this->db->get();
        return $query->result();
	}

    function check_invited_email($email,$pid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('pid',$pid);
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
	    $this->db->where('sent_from', $this->session->userdata('d168_id'));
	    $this->db->where('sent_to', $email);
	    $query = $this->db->get('project_invited_members');
	    return $query->row();
	}

	function insert_InviteMember($data4)
	{
	    if($this->db->insert('project_invited_members',$data4))
	    {
	      return TRUE;
	    }
	    else
	    {
	      return FALSE;
	    }
	}

	function check_invite_request($p_id,$imember_id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('pid', $p_id);
		$this->db->where('im_id', $imember_id);
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$query = $this->db->get('project_invited_members');
		return $query->num_rows();
	}

	function getProjectInviteById($p_id,$imember_id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('pid', $p_id);
		$this->db->where('im_id', $imember_id);
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$query = $this->db->get('project_invited_members');
		return $query->row();
	}

	function check_invite_reject_request($p_id,$imember_id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('pid', $p_id);
		$this->db->where('im_id', $imember_id);
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$query = $this->db->get('project_invited_members');
		return $query->row();
	}

	function update_invite_reject_request($data,$p_id,$imember_id)
	{
		$this->db->where('pid', $p_id);
		$this->db->where('im_id', $imember_id);
		$this->db->where('ptrash !=', 'yes');
		if($this->db->update('project_invited_members', $data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function InvitedProjectMember($pid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('pid', $pid);
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$query = $this->db->get('project_invited_members');
		return $query->result();
	}

	function checkInviteMemberEmail($email)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('sent_to', $email);
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$query = $this->db->get('project_invited_members');
		return $query->result();
	}

	function update_invite_request($data5,$email)
	{
		$this->db->where('status', 'pending');
		$this->db->where('sent_to', $email);
		$this->db->where('ptrash !=', 'yes');
		if($this->db->update('project_invited_members', $data5))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function delete_iMember($pid,$im_id)
	{
		$this->db->where('sent_from', $this->session->userdata('d168_id'));
		$this->db->where('pid', $pid);
		$this->db->where('im_id', $im_id);
		if($this->db->delete('project_invited_members'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}		
	}

	function ProjectDetailAccepted($id)
	{	
		$this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));
		$this->db->where('p.ptrash !=', 'yes');
		$this->db->where('p.project_archive !=', 'yes');
		$this->db->where('p.project_file_it !=', 'yes');
		$this->db->where('pm.status', 'accepted');
		$this->db->where('p.pid', $id);
		$this->db->select('*,p.pid as pid,p.pmanager as pmanager,pm.pid as pm_id,p.pcreated_by as pcreated_by,pm.pcreated_by as pm_pcreated_by');
        $this->db->from('project as p');
        $this->db->join('project_members as pm', 'pm.pid = p.pid');
        $query = $this->db->get();
        return $query->row();
	}

	function ProjectDetailRequest($id)
	{		
		$this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));
		$this->db->where('p.ptrash !=', 'yes');
		$this->db->where('p.project_archive !=', 'yes');
		$this->db->where('p.project_file_it !=', 'yes');
		$this->db->group_start();
		$this->db->where('pm.status', 'read_more');	
		$this->db->or_where('pm.status', 'send');
		$this->db->group_end();
		$this->db->where('p.pid', $id);
		$this->db->select('*,p.pid as pid,p.pmanager as pmanager,pm.pid as pm_id,p.pcreated_by as pcreated_by,pm.pcreated_by as pm_pcreated_by');
        $this->db->from('project as p');
        $this->db->join('project_members as pm', 'pm.pid = p.pid');
        $query = $this->db->get();
        return $query->row();
	}

	function project_request2($p_id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('pmember', $this->session->userdata('d168_id'));
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$this->db->where('pid', $p_id);
		$query = $this->db->get('project_members');
		return $query->num_rows();
	}

	function project_request_status2($p_id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('pmember', $this->session->userdata('d168_id'));
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$this->db->where('pid', $p_id);
		$query = $this->db->get('project_members');
		return $query->row();
	}

	function update_project_request2($data3,$p_id)
	{
		$this->db->where('pmember', $this->session->userdata('d168_id'));
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('pid', $p_id);
		if($this->db->update('project_members',$data3))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function suggest_Team_Members($id)
	{		
		$query = $this->db->query('select r.reg_id,r.first_name,r.last_name from registration r where r.reg_id !="'.$this->session->userdata('d168_id').'" and r.reg_acc_status != "deactivated" and verified = "yes" and NOT EXISTS(select * from project_members pm where ((pm.pcreated_by = r.reg_id) or (pm.pmember = r.reg_id)) and pm.reg_acc_status != "deactivated" and pm.ptrash != "yes" and pm.project_archive != "yes" and pm.project_file_it != "yes" and pm.pid = "'.$id.'")');
        
        return $query->result();
	}

	function check_suggested($pid,$t)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('suggest_id', $t);
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$this->db->where('pid', $pid);
		$query = $this->db->get('project_suggested_members');
		return $query->row();
	}

	function check_suggested2($pid,$t)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('suggest_id', $t);
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$this->db->where('pid', $pid);
		$query = $this->db->get('project_suggested_members');
		return $query->num_rows();
	}

	function check_if_suggested($pid,$t)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('suggest_id', $t);
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$this->db->where('pid', $pid);
		$query = $this->db->get('project_suggested_members');
		return $query->num_rows();
	}

	function check_pro_member2($pid,$t)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('pmember', $t);
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$this->db->where('pid', $pid);
		$query = $this->db->get('project_members');
		return $query->num_rows();
	}

	function insert_SuggestTeamMember($data2)
	{
		if($this->db->insert('project_suggested_members', $data2))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function SuggestedProjectMember($pid)
	{
		$this->db->where('spm.reg_acc_status !=','deactivated');
		$this->db->where('spm.pid', $pid);
		$this->db->where('spm.ptrash !=', 'yes');
		$this->db->where('spm.project_archive !=', 'yes');
		$this->db->where('spm.project_file_it !=', 'yes');
		$this->db->select('r.reg_id,r.first_name,r.last_name,r.photo,spm.s_id,spm.suggest_id,spm.status');
        $this->db->from('registration as r');
        $this->db->join('project_suggested_members as spm', 'spm.suggest_id = r.reg_id');
        $query = $this->db->get();
        return $query->result();
	}

	function RequestAsProjectMember($pid)
	{
		$this->db->order_by('prm.req_id','DESC');
		$this->db->where('prm.reg_acc_status !=','deactivated');
		$this->db->where('prm.pid', $pid);
		$this->db->where('prm.status', 'sent');
		$this->db->select('r.reg_id,r.first_name,r.last_name,r.photo,prm.req_id,prm.member,prm.status,prm.mode');
        $this->db->from('registration as r');
        $this->db->join('project_request_member as prm', 'prm.member = r.reg_id');
        $query = $this->db->get();
        return $query->result();
	}

	function update_SuggestTeamMember($data,$pid,$suggest_id)
	{
		$this->db->where('pid', $pid);
		$this->db->where('suggest_id', $suggest_id);
		$this->db->where('ptrash !=', 'yes');
		if($this->db->update('project_suggested_members', $data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function check_TeamRequestSend($suggest_id,$pid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('pmember', $suggest_id);
		$this->db->where('pid', $pid);
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$query = $this->db->get('project_members');
		return $query->num_rows();
	}

	function insert_projectManagement($data4)
	{
		if($this->db->insert('project_management', $data4))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function check_edit_permission($p_id)
	{
		$this->db->where('pmember', $this->session->userdata('d168_id'));
		$this->db->where('pid', $p_id);
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$query = $this->db->get('project_management');
		return $query->row();
	}

	function check_project_management($p_id,$m_id,$pmember_id)
	{
		$this->db->where('pmember', $pmember_id);
		$this->db->where('pid', $p_id);
		$this->db->where('m_id', $m_id);
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$query = $this->db->get('project_management');
		return $query->row();
	}

	function update_project_management_request($data3,$p_id,$m_id,$pmember_id)
	{
		$this->db->where('pmember', $pmember_id);
		$this->db->where('pid', $p_id);
		$this->db->where('m_id', $m_id);
		$this->db->where('ptrash !=', 'yes');
		if($this->db->update('project_management', $data3))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function edit_accepted_Project($data,$id)
	{
		$this->db->where('pid', $id);
		$this->db->where('ptrash !=', 'yes');
		if($this->db->update('project', $data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function update_project_management($data3,$id,$member_id)
	{
		$this->db->where('pid', $id);
		$this->db->where('pmember', $member_id);
		$this->db->where('ptrash !=', 'yes');
		if($this->db->update('project_management', $data3))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function count_total_portfolio($getEmail)
	{
		$query = $this->db->query("SELECT COUNT(*) as count_rows FROM project_portfolio_member as ppm, project_portfolio as pp where ppm.portfolio_id=pp.portfolio_id and ppm.sent_to='".$getEmail."' and ppm.status='accepted' and ppm.reg_acc_status != 'deactivated' and ppm.working_status='active' and pp.portfolio_trash!='yes' and pp.portfolio_archive!='yes' ");
		return $query->row_array();
	}

	function view_member_project_count($reg_id)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM project_members as pm, project as p where pm.pid=p.pid and pm.pmember='".$reg_id."' and pm.status='accepted' and pm.reg_acc_status != 'deactivated' and pm.project_archive != 'yes' and pm.project_file_it != 'yes' and pm.ptrash!='yes' and (p.ptype = 'regular' or p.ptype = 'goal_strategy')");
        return $query->row_array();
    }

    function view_created_project_count($reg_id)
    {
    	$query = $this->db->query("SELECT COUNT(*) as count_rows FROM project where pcreated_by='".$reg_id."' and project_archive !='yes' and project_file_it !='yes' and reg_acc_status != 'deactivated' and ptrash!='yes' and (ptype = 'regular' or ptype = 'goal_strategy')");
    	return $query->row_array();
    }

    function count_portfolio_project($c_id)
    {
    	$query = $this->db->query("SELECT COUNT(*) as count_rows FROM project where portfolio_id='".$c_id."' and ptrash!='yes' and reg_acc_status != 'deactivated' and project_archive!='yes' and project_file_it!='yes' and (ptype = 'regular' or ptype = 'goal_strategy')");
    	return $query->row_array();
    }

    function view_member_project_content_count($reg_id)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM project_members as pm, project as p where pm.pid=p.pid and pm.pmember='".$reg_id."' and pm.status='accepted' and pm.reg_acc_status != 'deactivated' and pm.project_archive != 'yes' and pm.project_file_it != 'yes' and pm.ptrash!='yes' and p.ptype = 'content'");
        return $query->row_array();
    }

    function view_created_project_content_count($reg_id)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM project where pcreated_by='".$reg_id."' and project_archive !='yes' and project_file_it !='yes' and reg_acc_status != 'deactivated' and ptrash!='yes' and ptype = 'content'");
        return $query->row_array();
    }

    function count_portfolio_project_content($c_id)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM project where portfolio_id='".$c_id."' and ptrash!='yes' and reg_acc_status != 'deactivated' and project_archive!='yes' and project_file_it!='yes' and ptype = 'content'");
        return $query->row_array();
    }

    function count_Portfolio_task($c_id)
    {
    	$query = $this->db->query("SELECT COUNT(*) as count_rows FROM task where portfolio_id='".$c_id."' and trash!='yes' and task_archive!='yes' and task_file_it!='yes' and reg_acc_status != 'deactivated'");
    	return $query->row_array();
    }

    function check_invited_suggestemail($im,$pid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('pid',$pid);
	    $this->db->where('sent_to', $im);
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
	    $query = $this->db->get('project_invited_members');
	    return $query->row();
	}

	function SuggestedInviteProjectMember($pid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('pid', $pid);
		$this->db->where('already_register', 'no');
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
	    $query = $this->db->get('project_suggested_members');
        return $query->result();
	}

	function check_project_members($pid,$powner_id,$member_id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('pid', $pid);
		$this->db->where('pcreated_by', $powner_id);
		$this->db->where('pmember', $member_id);
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$query = $this->db->get('project_members');
		return $query->row();
	}

	function check_project_dates($pid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('pid', $pid);
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$query = $this->db->get('project');
		return $query->row();
	}

	function insert_ProjectMFields($data)
	{
		if($this->db->insert('project_management_fields', $data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function check_notify_project_management($pid)
	{
		$this->db->where('status', 'sent');
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$this->db->where('powner', $this->session->userdata('d168_id'));
		$this->db->where('pid', $pid);
		$query = $this->db->get('project_management');
		return $query->row();
	}

	function check_notify_project_suggested($pid)
	{
		$this->db->order_by('s_id','DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('status', 'suggested');
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$this->db->where('pid', $pid);
		$query = $this->db->get('project_suggested_members');
		return $query->row();
	}

	function check_project_suggested_member($pid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('status', 'suggested');
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$this->db->where('suggest_id', $this->session->userdata('d168_id'));
		$this->db->where('pid', $pid);
		$query = $this->db->get('project_suggested_members');
		return $query->num_rows();
	}

	function check_notify_project_task($pid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('tnotify', 'yes');
		$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$this->db->where('tassignee', $this->session->userdata('d168_id'));
		$this->db->where('tproject_assign', $pid);
		$query = $this->db->get('task');
		return $query->row();
	}

	function check_notify_tm_task($tassignee,$pid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('tnotify', 'yes');
		$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$this->db->where('tassignee', $tassignee);
		$this->db->where('tproject_assign', $pid);
		$query = $this->db->get('task');
		return $query->row();
	}

	function task_notification()
	{
		$this->db->order_by('t.tid', 'DESC');
		$this->db->where('t.reg_acc_status !=','deactivated');
		$this->db->where('p.project_archive', '');
		$this->db->where('p.project_file_it', '');
		$this->db->where('t.tnotify', 'yes');
		$this->db->where('t.trash', '');
		$this->db->where('t.task_archive', '');
		$this->db->where('t.task_file_it', '');
		$this->db->where('t.tassignee', $this->session->userdata('d168_id'));
		$this->db->select('*');
		$this->db->from('task as t');
		$this->db->join('project as p', 'p.pid = t.tproject_assign');
		$query = $this->db->get();
		return $query->result();
	}

	function check_task_review_sent()
	{
		$this->db->order_by('tid', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('task_archive', '');
		$this->db->where('task_file_it', '');
		$this->db->where('trash', '');
		$this->db->where('review_notify', 'sent_yes');
		$this->db->where('review', 'sent');
		$this->db->where('tassignee', $this->session->userdata('d168_id'));
		$query = $this->db->get('task');
		return $query->result();
	}

	function check_task_review_deny()
	{
		$this->db->order_by('tid', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('task_archive', '');
		$this->db->where('task_file_it', '');
		$this->db->where('trash', '');
		$this->db->where('review_notify', 'sent_yes');
		$this->db->where('review', 'denied');
		$this->db->where('tassignee', $this->session->userdata('d168_id'));
		$query = $this->db->get('task');
		return $query->result();
	}

	function check_task_review_approve()
	{
		$this->db->order_by('tid', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('task_archive', '');
		$this->db->where('task_file_it', '');
		$this->db->where('trash', '');
		$this->db->where('review_notify', 'sent_yes');
		$this->db->where('review', 'approved');
		$this->db->where('tassignee', $this->session->userdata('d168_id'));
		$query = $this->db->get('task');
		return $query->result();
	}

	function check_edit_request($pid)
	{
		$this->db->where('r.reg_acc_status !=','deactivated');
		$this->db->where('pmf.ap_fields','');
		$this->db->where('pmf.ptrash !=', 'yes');
		$this->db->where('pmf.project_archive !=', 'yes');
		$this->db->where('pmf.project_file_it !=', 'yes');
		$this->db->where('pmf.powner', $this->session->userdata('d168_id'));
		$this->db->where('pmf.pid', $pid);
		$this->db->select('pmf.*,r.first_name,r.last_name');
        $this->db->from('registration as r');
        $this->db->join('project_management_fields as pmf', 'pmf.pmember = r.reg_id');
        $query = $this->db->get();
        return $query->result();
	}

	function update_project_management_field1($data1,$m_id)
	{
		$this->db->where('m_id', $m_id);
		$this->db->where('ptrash !=', 'yes');
		if($this->db->update('project_management', $data1))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function update_project_management_field2($data2,$id)
	{
		$this->db->where('id', $id);
		$this->db->where('ptrash !=', 'yes');
		if($this->db->update('project_management_fields', $data2))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function  get_project_management_fields($id)
	{
		$this->db->where('id', $id);
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$query = $this->db->get('project_management_fields');
		return $query->row();
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

	function view_history($pid,$hdate)
	{
		$this->db->order_by('hid', 'DESC');
		$this->db->like('h_date', $hdate);
		$this->db->where('pid', $pid);
		//$this->db->where('reg_acc_status !=','deactivated');
		$query = $this->db->get('project_history');
		return $query->result();
	}

	function view_history_date($pid)
	{
		$query = $this->db->query("SELECT DATE(h_date) DateOnly from project_history where pid = '".$pid."'GROUP BY DateOnly ORDER BY hid DESC");
        return $query->result();
	}

	function view_history_only_date($pid,$only_date)
	{
		$this->db->order_by('hid', 'DESC');
		$this->db->like('h_date', $only_date);
		$this->db->where('pid', $pid);
		//$this->db->where('reg_acc_status !=','deactivated');
		$query = $this->db->get('project_history');
		return $query->result();
	}

	function view_all_history($pid)
	{
		$this->db->order_by('hid', 'DESC');
		//$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('pid', $pid);
		$query = $this->db->get('project_history');
		return $query->result();
	}

	function view_history_date_range($pid,$start_date,$end_date)
	{
		$query = $this->db->query("SELECT * from project_history where pid = '".$pid."' and DATE(h_date) BETWEEN '".$start_date."' and '".$end_date."' ORDER BY hid DESC");
        return $query->result();
	}

	function select_project_tm($pid)
	{
		$this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->where('pm.status', 'accepted');
		$this->db->where('pm.ptrash !=', 'yes');
		$this->db->where('pm.project_archive !=', 'yes');
		$this->db->where('pm.project_file_it !=', 'yes');
		$this->db->where('pm.pid', $pid);
		$this->db->select('r.reg_id,r.first_name,r.last_name,pm.status,pm.pcreated_by,pm.pmember');
        $this->db->from('registration as r');
        $this->db->join('project_members as pm', 'pm.pmember = r.reg_id');
        $query = $this->db->get();
        return $query->result();
	}

	function insert_NewTask($data)
	{
		if($this->db->insert('task',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function CreatedTaskList($get_port_id)
	{
		$this->db->order_by('tid', 'DESC');
		$this->db->select('*');
		$this->db->where('t.reg_acc_status !=','deactivated');
		$this->db->where('t.portfolio_id', $get_port_id);
		$this->db->where('t.tcreated_by', $this->session->userdata('d168_id'));
		$this->db->where('t.trash !=', 'yes');
		$this->db->where('t.task_archive !=', 'yes');
		$this->db->where('t.task_file_it !=', 'yes');
		$this->db->where('pp.portfolio_archive !=', 'yes');
		$this->db->where('pp.portfolio_file_it !=', 'yes');
		$this->db->from('task as t');
        $this->db->join('project_portfolio as pp','pp.portfolio_id = t.portfolio_id');
        //$this->db->join('project as p','p.pid = t.tproject_assign');
        $query = $this->db->get();
		return $query->result();
	}

	function CreatedSubTaskList($get_port_id)
	{
		$this->db->group_by('st.tid');
		$this->db->order_by('st.stid', 'DESC');
		$this->db->select('*,st.tid as s_tid,t.tid as t_id');
		$this->db->where('st.reg_acc_status !=','deactivated');
		$this->db->where('st.portfolio_id', $get_port_id);
		$this->db->where('st.stcreated_by', $this->session->userdata('d168_id'));
		$this->db->where('st.strash !=', 'yes');
		$this->db->where('pp.portfolio_archive !=', 'yes');
		$this->db->where('pp.portfolio_file_it !=', 'yes');
		$this->db->where('t.task_archive !=', 'yes');
		$this->db->where('t.task_file_it !=', 'yes');
		$this->db->where('st.subtask_archive !=', 'yes');
		$this->db->where('st.subtask_file_it !=', 'yes');
		$this->db->where('pp.portfolio_archive !=', 'yes');
		$this->db->where('pp.portfolio_file_it !=', 'yes');
		$this->db->from('subtask as st');
        $this->db->join('task as t','t.tid = st.tid');
        $this->db->join('project_portfolio as pp','pp.portfolio_id = st.portfolio_id');
        //$this->db->join('project as p','p.pid = st.stproject_assign');
        $query = $this->db->get();
		return $query->result();
	}

	function CreatedTaskList_Project($get_port_id,$get_pid)
	{
		$this->db->order_by('tid', 'DESC');
		$this->db->select('*');
		$this->db->where('t.reg_acc_status !=','deactivated');
		$this->db->where('t.tproject_assign', $get_pid);
		$this->db->where('t.portfolio_id', $get_port_id);
		$this->db->where('t.tcreated_by', $this->session->userdata('d168_id'));
		$this->db->where('t.trash !=', 'yes');
		$this->db->where('t.task_archive !=', 'yes');
		$this->db->where('t.task_file_it !=', 'yes');
		$this->db->where('pp.portfolio_archive !=', 'yes');
		$this->db->where('pp.portfolio_file_it !=', 'yes');
		$this->db->from('task as t');
        $this->db->join('project_portfolio as pp','pp.portfolio_id = t.portfolio_id');
        $this->db->join('project as p','p.pid = t.tproject_assign');
        $query = $this->db->get();
		return $query->result();
	}

	function CreatedSubTaskList_Project($get_port_id,$get_pid)
	{
		$this->db->group_by('st.tid');
		$this->db->order_by('st.stid', 'DESC');
		$this->db->select('*,st.tid as s_tid,t.tid as t_id');
		$this->db->where('st.reg_acc_status !=','deactivated');
		$this->db->where('st.stproject_assign', $get_pid);
		$this->db->where('st.portfolio_id', $get_port_id);
		$this->db->where('st.stcreated_by', $this->session->userdata('d168_id'));
		$this->db->where('st.strash !=', 'yes');
		$this->db->where('pp.portfolio_archive !=', 'yes');
		$this->db->where('pp.portfolio_file_it !=', 'yes');
		$this->db->where('t.task_archive !=', 'yes');
		$this->db->where('t.task_file_it !=', 'yes');
		$this->db->where('st.subtask_archive !=', 'yes');
		$this->db->where('st.subtask_file_it !=', 'yes');
		$this->db->where('pp.portfolio_archive !=', 'yes');
		$this->db->where('pp.portfolio_file_it !=', 'yes');
		$this->db->from('subtask as st');
        $this->db->join('task as t','t.tid = st.tid');
        $this->db->join('project_portfolio as pp','pp.portfolio_id = st.portfolio_id');
        $this->db->join('project as p','p.pid = st.stproject_assign');
        $query = $this->db->get();
		return $query->result();
	}

	function AssignedTasklist()
	{
		$this->db->order_by('tid', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('tassignee', $this->session->userdata('d168_id'));
		$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$query = $this->db->get('task');
		return $query->result();
	}

	function AssignedTaskTrashlist()
	{
		$this->db->order_by('tid', 'DESC');
		$this->db->group_start();
    	$this->db->where('tcreated_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('tassignee', $this->session->userdata('d168_id'));
    	$this->db->group_end();
    	$this->db->where('t.reg_acc_status !=','deactivated');
		$this->db->where('trash', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$this->db->select('*');
		$this->db->from('registration as r');
		$this->db->join('task as t','t.tassignee = r.reg_id');
		$query = $this->db->get();
		return $query->result();
	}

	function TodayTasks($today)
	{
		$this->db->order_by('tdue_date', 'ASC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('tdue_date', $today);
		$this->db->where('tassignee', $this->session->userdata('d168_id'));
		$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$query = $this->db->get('task');
		return $query->result();
	}

	function TodayTasksDashboard($today)
	{
		$this->db->order_by('tdue_date', 'ASC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('tdue_date', $today);
		$this->db->where('tassignee', $this->session->userdata('d168_id'));
		$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$this->db->where('tstatus !=', 'done');
		$query = $this->db->get('task');
		return $query->result();
	}

	function TodayTasksTrashlist($today)
	{
		$this->db->order_by('tid', 'DESC');
		$this->db->where('tdue_date', $today);
		$this->db->group_start();
    	$this->db->where('tcreated_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('tassignee', $this->session->userdata('d168_id'));
    	$this->db->group_end();
    	$this->db->where('t.reg_acc_status !=','deactivated');
		$this->db->where('trash', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$this->db->select('*');
		$this->db->from('registration as r');
		$this->db->join('task as t','t.tassignee = r.reg_id');
		$query = $this->db->get();
		return $query->result();
	}
	
	function TomorrowTasks($tomorrow)
	{
		$this->db->order_by('tid', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('tdue_date', $tomorrow);
		$this->db->where('tassignee', $this->session->userdata('d168_id'));
		$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$query = $this->db->get('task');
		return $query->result();
	}

	function TomorrowTasksTrashlist($tomorrow)
	{
		$this->db->order_by('tid', 'DESC');
		$this->db->where('tdue_date', $tomorrow);
		$this->db->group_start();
    	$this->db->where('tcreated_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('tassignee', $this->session->userdata('d168_id'));
    	$this->db->group_end();
    	$this->db->where('t.reg_acc_status !=','deactivated');
		$this->db->where('trash', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$this->db->select('*');
		$this->db->from('registration as r');
		$this->db->join('task as t','t.tassignee = r.reg_id');
		$query = $this->db->get();
		return $query->result();
	}

	function WeekTasks($FirstDay,$LastDay)
	{
		$query = $this->db->query("SELECT * from task where tassignee = '".$this->session->userdata('d168_id')."' and trash != 'yes' and task_archive != 'yes' and task_file_it != 'yes' and tdue_date BETWEEN '".$FirstDay."' and '".$LastDay."' and reg_acc_status != 'deactivated' ORDER BY tdue_date ASC");
        return $query->result();
	}

	function WeekTasksDashboard($FirstDay,$LastDay)
	{
		$query = $this->db->query("SELECT * from task where tassignee = '".$this->session->userdata('d168_id')."' and trash != 'yes' and task_archive != 'yes' and task_file_it != 'yes' and tdue_date BETWEEN '".$FirstDay."' and '".$LastDay."' and reg_acc_status != 'deactivated' and tstatus != 'done' ORDER BY tdue_date ASC");
        return $query->result();
	}

	function WeekTasksTrashlist($FirstDay,$LastDay)
	{
		$query = $this->db->query("SELECT * FROM `registration` as `r` JOIN `task` as `t` ON `t`.`tassignee` = `r`.`reg_id` where (tcreated_by = '".$this->session->userdata('d168_id')."' or tassignee = '".$this->session->userdata('d168_id')."')  and t.reg_acc_status != 'deactivated' and trash = 'yes' and tdue_date BETWEEN '".$FirstDay."' and '".$LastDay."' ORDER BY tid DESC");
        return $query->result();
	}

	function OverdueTasks($currentDate)
	{
		$this->db->order_by('tid', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('tdue_date <',$currentDate);
		$this->db->where('tassignee', $this->session->userdata('d168_id'));
		$this->db->where('trash','');
		$this->db->where('task_archive', '');
		$this->db->where('task_file_it', '');
		$query = $this->db->get('task');
		return $query->result();
	}

	function OverdueTasksDashboard($currentDate)
	{
		$this->db->order_by('tid', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('tdue_date <',$currentDate);
		$this->db->where('tassignee', $this->session->userdata('d168_id'));
		$this->db->where('trash','');
		$this->db->where('task_archive', '');
		$this->db->where('task_file_it', '');
		$this->db->where('tstatus !=', 'done');
		$query = $this->db->get('task');
		return $query->result();
	}

	function OverdueTasksTrashlist($currentDate)
	{
		$this->db->order_by('tid', 'DESC');
		$this->db->where('tdue_date <',$currentDate);
		$this->db->group_start();
    	$this->db->where('tcreated_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('tassignee', $this->session->userdata('d168_id'));
    	$this->db->group_end();
    	$this->db->where('t.reg_acc_status !=','deactivated');
		$this->db->where('trash','yes');
		$this->db->where('tstatus !=','done');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$this->db->select('*');
		$this->db->from('registration as r');
		$this->db->join('task as t','t.tassignee = r.reg_id');
		$query = $this->db->get();
		return $query->result();
	}

	function TrashTasks($port_id)
	{
		$this->db->order_by('date(tstatus_date)', 'DESC');
		$this->db->where('t.reg_acc_status !=','deactivated');
		$this->db->where('trash','yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('t.portfolio_id', $port_id);
		$this->db->group_start();
    	$this->db->where('tcreated_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('tassignee', $this->session->userdata('d168_id'));
    	$this->db->or_where('p.pcreated_by', $this->session->userdata('d168_id'));
    	$this->db->group_end();
		$this->db->select('*');
		$this->db->from('registration as r');
		$this->db->join('task as t','t.tassignee = r.reg_id');
		$this->db->join('project as p','p.pid = t.tproject_assign');
		$query = $this->db->get();
		return $query->result();
	}

	function TrashSingleTasks($port_id)
	{
		$this->db->order_by('date(tstatus_date)', 'DESC');
		$this->db->where('t.reg_acc_status !=','deactivated');
		$this->db->where('tproject_assign','0');
		$this->db->where('trash','yes');
		$this->db->where('portfolio_id', $port_id);
		$this->db->where('task_archive !=', 'yes');
		$this->db->group_start();
    	$this->db->where('tcreated_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('tassignee', $this->session->userdata('d168_id'));
    	$this->db->group_end();
		$this->db->select('*');
		$this->db->from('registration as r');
		$this->db->join('task as t','t.tassignee = r.reg_id');
		$query = $this->db->get();
		return $query->result();
	}

	function ArchiveTasks($port_id)
	{
		$this->db->order_by('date(tstatus_date)', 'DESC');
		$this->db->where('t.reg_acc_status !=','deactivated');
		$this->db->where('trash !=','yes');
		$this->db->where('task_archive', 'yes');
		$this->db->where('t.portfolio_id', $port_id);
		$this->db->group_start();
    	$this->db->where('tcreated_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('tassignee', $this->session->userdata('d168_id'));
    	$this->db->or_where('p.pcreated_by', $this->session->userdata('d168_id'));
    	$this->db->group_end();
		$this->db->select('*');
		$this->db->from('registration as r');
		$this->db->join('task as t','t.tassignee = r.reg_id');
		$this->db->join('project as p','p.pid = t.tproject_assign');
		$query = $this->db->get();
		return $query->result();
	}

	function ArchiveSingleTasks($port_id)
	{
		$this->db->order_by('date(tstatus_date)', 'DESC');
		$this->db->where('t.reg_acc_status !=','deactivated');
		$this->db->where('tproject_assign','0');
		$this->db->where('trash !=','yes');
		$this->db->where('task_archive', 'yes');
		$this->db->where('portfolio_id', $port_id);
		$this->db->group_start();
    	$this->db->where('tcreated_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('tassignee', $this->session->userdata('d168_id'));
    	$this->db->group_end();
		$this->db->select('*');
		$this->db->from('registration as r');
		$this->db->join('task as t','t.tassignee = r.reg_id');
		$query = $this->db->get();
		return $query->result();
	}

	function p_tasks($id)
	{
		$this->db->order_by('tid', 'DESC');
    	$this->db->group_by('tassignee');
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$this->db->where('tproject_assign', $id);
		$query = $this->db->get('task');
		return $query->result();
	}

	function pro_all_tasks($id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$this->db->where('tproject_assign', $id);
		$query = $this->db->get('task');
		return $query->result();
	}

	function p_subtasks($id)
	{
		$this->db->order_by('stid', 'DESC');
    	$this->db->group_by('stassignee');
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$this->db->where('stproject_assign', $id);
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function check_task_assign($tid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('tid', $tid);
		$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$this->db->where('tassignee', $this->session->userdata('d168_id'));
		$query = $this->db->get('task');
		return $query->row();
	}

	function check_task_assignProOwner($tid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('tid', $tid);
		$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$query = $this->db->get('task');
		return $query->row();
	}

	function get_task_details($tid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('tid', $tid);
		$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$query = $this->db->get('task');
		return $query->row();
	}

	function update_Task($data,$tid,$tassignee)
	{
		$this->db->where('tid', $tid);
		$this->db->where('tassignee', $this->session->userdata('d168_id'));
		if($this->db->update('task', $data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function update_TaskProOwner($data,$tid)
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

	function TaskDetail($id)
	{
		$this->db->where('t.reg_acc_status !=','deactivated');
		$this->db->where('t.tid', $id);
		$this->db->where('t.trash !=', 'yes');
		$this->db->where('t.task_archive !=', 'yes');
		$this->db->where('t.task_file_it !=', 'yes');
		$this->db->select('*');
        $this->db->from('registration as r');
        $this->db->join('task as t', 't.tcreated_by = r.reg_id');
        $query = $this->db->get();
        return $query->row();
	}

	function progress_done($pid)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM task where tproject_assign='".$pid."' and trash != 'yes' and task_archive != 'yes' and task_file_it != 'yes' and tstatus='done' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function progress_total($pid)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM task where tproject_assign='".$pid."' and trash != 'yes' and task_archive != 'yes' and task_file_it != 'yes' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function sub_progress_done($pid)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM subtask where stproject_assign='".$pid."' and strash != 'yes' and subtask_archive != 'yes' and subtask_file_it != 'yes' and ststatus='done' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function sub_progress_total($pid)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM subtask where stproject_assign='".$pid."' and strash != 'yes' and subtask_archive != 'yes' and subtask_file_it != 'yes' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function progress_done2()
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM task where (tcreated_by='".$this->session->userdata('d168_id')."' or tassignee='".$this->session->userdata('d168_id')."') and trash != 'yes' and task_archive != 'yes' and task_file_it != 'yes' and tstatus='done' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function progress_total2()
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM task where (tcreated_by='".$this->session->userdata('d168_id')."' or tassignee='".$this->session->userdata('d168_id')."') and trash != 'yes' and task_archive != 'yes' and task_file_it != 'yes' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function sub_progress_done2()
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM subtask where (stcreated_by='".$this->session->userdata('d168_id')."' or stassignee='".$this->session->userdata('d168_id')."') and strash != 'yes' and subtask_archive != 'yes' and subtask_file_it != 'yes' and ststatus='done' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function sub_progress_total2()
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM subtask where (stcreated_by='".$this->session->userdata('d168_id')."' or stassignee='".$this->session->userdata('d168_id')."') and strash != 'yes' and subtask_archive != 'yes' and subtask_file_it != 'yes' and reg_acc_status != 'deactivated'");
        return $query->row_array();
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

    function getProjectById2($id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
    	$this->db->where('pid', $id);
    	$query = $this->db->get('project');
    	return $query->row();
    }

    function getProjectDetailID($id)
    {
    	$this->db->where('pid', $id);
    	$query = $this->db->get('project');
    	return $query->row();
    }
    
    function progress_done3($pid,$tassignee)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM task where tassignee='".$tassignee."' and trash != 'yes' and task_archive != 'yes' and task_file_it != 'yes' and tproject_assign ='".$pid."' and tstatus='done' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function progress_total3($pid,$tassignee)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM task where tassignee='".$tassignee."' and trash != 'yes' and task_archive != 'yes' and task_file_it != 'yes' and tproject_assign ='".$pid."' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function sub_progress_done3($pid,$tassignee)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM subtask where stassignee='".$tassignee."' and strash != 'yes' and subtask_archive != 'yes' and subtask_file_it != 'yes' and stproject_assign ='".$pid."' and ststatus='done' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function sub_progress_total3($pid,$tassignee)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM subtask where stassignee='".$tassignee."' and strash != 'yes' and subtask_archive != 'yes' and subtask_file_it != 'yes' and stproject_assign ='".$pid."' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function team_member_tasks_list($pid,$tassignee)
    {
    	$this->db->order_by('tid', 'DESC');
    	$this->db->where('t.reg_acc_status !=','deactivated');
    	$this->db->where('tassignee', $tassignee);
		$this->db->where('tproject_assign', $pid);
		$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$this->db->select('t.tid,t.tcode,t.tname,t.tpriority,t.tstatus,t.review,t.tdue_date,CONCAT_WS(" ", r.first_name,r.last_name) AS name');
		$this->db->from('registration as r');
        $this->db->join('task as t', 't.tassignee = r.reg_id');
        $query = $this->db->get();
		return $query->result();
    }

    function team_member_tasks_listNew($pid,$tassignee)
    {
    	$this->db->order_by('tid', 'DESC');
    	$this->db->where('t.reg_acc_status !=','deactivated');
    	$this->db->where('tassignee', $tassignee);
		$this->db->where('tproject_assign', $pid);
		$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$this->db->select('*');
		$this->db->from('registration as r');
        $this->db->join('task as t', 't.tassignee = r.reg_id');
        $query = $this->db->get();
		return $query->result();
    }

    function team_member_subtasks_list($pid,$tassignee)
    {
    	$this->db->order_by('stid', 'DESC');
    	$this->db->where('st.reg_acc_status !=','deactivated');
		$this->db->where('t.task_archive !=', 'yes');
		$this->db->where('t.task_file_it !=', 'yes');
    	$this->db->where('st.stassignee', $tassignee);
		$this->db->where('st.stproject_assign', $pid);
		$this->db->where('st.strash !=', 'yes');
		$this->db->where('st.subtask_archive !=', 'yes');
		$this->db->where('st.subtask_file_it !=', 'yes');
		$this->db->select('t.tname,st.stid,st.stcode,st.stname,st.stpriority,st.ststatus,st.sreview,st.stdue_date,CONCAT_WS(" ", r.first_name,r.last_name) AS name');
		$this->db->from('registration as r');
        $this->db->join('subtask as st', 'st.stassignee = r.reg_id');
        $this->db->join('task as t','t.tid = st.tid');
        $query = $this->db->get();
		return $query->result();
    }

    function team_member_subtasks_listNew($pid,$tassignee)
    {
		$this->db->group_by('st.tid');
    	$this->db->order_by('stid', 'DESC');
    	$this->db->where('st.reg_acc_status !=','deactivated');
		$this->db->where('t.task_archive !=', 'yes');
		$this->db->where('t.task_file_it !=', 'yes');
    	$this->db->where('st.stassignee', $tassignee);
		$this->db->where('st.stproject_assign', $pid);
		$this->db->where('st.strash !=', 'yes');
		$this->db->where('st.subtask_archive !=', 'yes');
		$this->db->where('st.subtask_file_it !=', 'yes');
		$this->db->select('*,st.tid as s_tid,t.tid as t_id');
		$this->db->from('registration as r');
        $this->db->join('subtask as st', 'st.stassignee = r.reg_id');
        $this->db->join('task as t','t.tid = st.tid');
        $query = $this->db->get();
		return $query->result();
    }

    function check_task($tid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('tid', $tid);
    	$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
    	// $this->db->group_start();
    	// $this->db->where('tcreated_by', $this->session->userdata('d168_id'));
    	// $this->db->or_where('tassignee', $this->session->userdata('d168_id'));
    	// $this->db->group_end();
    	$query = $this->db->get('task');
    	return $query->row();
    }

    function check_Donetask($tid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('tid', $tid);
    	$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$this->db->where('tstatus', 'done');
    	// $this->db->group_start();
    	// $this->db->where('tcreated_by', $this->session->userdata('d168_id'));
    	// $this->db->or_where('tassignee', $this->session->userdata('d168_id'));
    	// $this->db->group_end();
    	$query = $this->db->get('task');
    	return $query->row();
    }

    function check_task2($tid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('tid', $tid);
    	$this->db->where('trash', 'yes');
		$this->db->where('task_archive !=', 'yes');
		//$this->db->where('task_file_it !=', 'yes');
    	// $this->db->group_start();
    	// $this->db->where('tcreated_by', $this->session->userdata('d168_id'));
    	// $this->db->or_where('tassignee', $this->session->userdata('d168_id'));
    	// $this->db->group_end();
    	$query = $this->db->get('task');
    	return $query->row();
    }

    function check_task2_new($tid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('tid', $tid);
    	$this->db->where('trash', 'yes');
    	// $this->db->group_start();
    	// $this->db->where('tcreated_by', $this->session->userdata('d168_id'));
    	// $this->db->or_where('tassignee', $this->session->userdata('d168_id'));
    	// $this->db->group_end();
    	$query = $this->db->get('task');
    	return $query->row();
    }

    function view_left_task_count($reg_id)
    {
    	$query = $this->db->query("SELECT COUNT(*) as count_rows FROM task where tassignee='".$reg_id."' and trash != 'yes' and task_archive != 'yes' and task_file_it != 'yes' and (tstatus = 'to_do' or tstatus = 'in_progress') and reg_acc_status != 'deactivated'");
    	return $query->row_array();
    }

    function view_left_subtask_count($reg_id)
    {
    	$query = $this->db->query("SELECT COUNT(*) as count_rows FROM subtask where stassignee='".$reg_id."' and strash != 'yes' and subtask_archive != 'yes' and subtask_file_it != 'yes' and (ststatus = 'to_do' or ststatus = 'in_progress') and reg_acc_status != 'deactivated'");
    	return $query->row_array();
    }

    function view_done_task_count($reg_id)
    {
    	$query = $this->db->query("SELECT COUNT(*) as count_rows FROM task where tassignee='".$reg_id."' and trash != 'yes' and task_archive != 'yes' and task_file_it != 'yes' and tstatus='done' and reg_acc_status != 'deactivated'");
    	return $query->row_array();
    }

    function view_task_count($reg_id)
    {
    	$query = $this->db->query("SELECT COUNT(*) as count_rows FROM task where tassignee='".$reg_id."' and trash != 'yes' and reg_acc_status != 'deactivated'");
    	return $query->row_array();
    }

    function view_today_task_count($reg_id)
    {
    	$query = $this->db->query("SELECT COUNT(*) as count_rows FROM task where tassignee='".$reg_id."' and trash != 'yes' and task_archive != 'yes' and task_file_it != 'yes' and tdue_date='".date('Y-m-d')."' and reg_acc_status != 'deactivated'");
    	return $query->row_array();
    }

    function view_today_subtask_count($reg_id)
    {
    	$query = $this->db->query("SELECT COUNT(*) as count_rows FROM subtask where stassignee='".$reg_id."' and strash != 'yes' and subtask_archive != 'yes' and subtask_file_it != 'yes' and stdue_date='".date('Y-m-d')."' and reg_acc_status != 'deactivated'");
    	return $query->row_array();
    }

    function view_tomorrow_task_count($reg_id)
    {
    	$query = $this->db->query("SELECT COUNT(*) as count_rows FROM task where tassignee='".$reg_id."' and trash != 'yes' and task_archive != 'yes' and task_file_it != 'yes' and tdue_date='".date('Y-m-d', strtotime('+1 day'))."' and reg_acc_status != 'deactivated'");
    	return $query->row_array();
    }

    function view_tomorrow_subtask_count($reg_id)
    {
    	$query = $this->db->query("SELECT COUNT(*) as count_rows FROM subtask where stassignee='".$reg_id."' and strash != 'yes' and subtask_archive != 'yes' and subtask_file_it != 'yes' and stdue_date='".date('Y-m-d', strtotime('+1 day'))."' and reg_acc_status != 'deactivated'");
    	return $query->row_array();
    }

    function view_week_task_count($reg_id)
    {
    	$FirstDay = date('Y-m-d', strtotime('+1 day'));
    	$query = $this->db->query("SELECT COUNT(*) as count_rows FROM task where tassignee='".$reg_id."' and trash != 'yes' and task_archive != 'yes' and task_file_it != 'yes' and tdue_date BETWEEN '".date('Y-m-d', strtotime('+1 day'))."' and '".date('Y-m-d', strtotime($FirstDay .' +6 days'))."' and reg_acc_status != 'deactivated'");
    	return $query->row_array();
    }

    function view_week_subtask_count($reg_id)
    {
    	$FirstDay = date('Y-m-d', strtotime('+1 day'));
    	$query = $this->db->query("SELECT COUNT(*) as count_rows FROM subtask where stassignee='".$reg_id."' and strash != 'yes' and subtask_archive != 'yes' and subtask_file_it != 'yes' and stdue_date BETWEEN '".date('Y-m-d', strtotime('+1 day'))."' and '".date('Y-m-d', strtotime($FirstDay .' +6 days'))."' and reg_acc_status != 'deactivated'");
    	return $query->row_array();
    }

    function view_overdue_task_count($reg_id)
    {
    	$query = $this->db->query("SELECT COUNT(*) as count_rows FROM task where tassignee='".$reg_id."' and trash != 'yes' and task_archive != 'yes' and task_file_it != 'yes' and tdue_date<'".date('Y-m-d')."' and tstatus != 'done' and reg_acc_status != 'deactivated'");
    	return $query->row_array();
    }

    function view_overdue_subtask_count($reg_id)
    {
    	$query = $this->db->query("SELECT COUNT(*) as count_rows FROM subtask where stassignee='".$reg_id."' and strash != 'yes' and subtask_archive != 'yes' and subtask_file_it != 'yes' and stdue_date<'".date('Y-m-d')."' and ststatus != 'done' and reg_acc_status != 'deactivated'");
    	return $query->row_array();
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

    function edit_TaskNotify($data,$pid,$tassignee,$tid)
    {
    	$this->db->where('tnotify','yes');
    	$this->db->where('tassignee', $tassignee);
    	$this->db->where('tproject_assign', $pid);
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

    function edit_TaskReviewNotify($data,$pid,$tassignee,$tid)
    {
    	$this->db->where('tassignee', $tassignee);
    	$this->db->where('tproject_assign', $pid);
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

    function project_tasks_list($pid)
    {
    	$this->db->order_by('tid', 'DESC');
    	$this->db->where('t.reg_acc_status !=','deactivated');
		$this->db->where('tproject_assign', $pid);
		$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$this->db->select('t.tid,t.tcode,t.tname,t.tpriority,t.tstatus,t.review,t.tdue_date,CONCAT_WS(" ", r.first_name,r.last_name) AS name');
		$this->db->from('registration as r');
        $this->db->join('task as t', 't.tassignee = r.reg_id');
        $query = $this->db->get();
		return $query->result();
    }

    function project_tasks_listNew($pid)
    {
    	$this->db->order_by('tid', 'DESC');
    	$this->db->where('t.reg_acc_status !=','deactivated');
		$this->db->where('tproject_assign', $pid);
		$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$this->db->select('*');
		$this->db->from('registration as r');
        $this->db->join('task as t', 't.tassignee = r.reg_id');
        $query = $this->db->get();
		return $query->result();
    }

    function project_subtasks_list($pid)
    {
    	$this->db->order_by('st.stid', 'DESC');
    	$this->db->where('st.reg_acc_status !=','deactivated');
		$this->db->where('t.task_archive !=', 'yes');
		$this->db->where('t.task_file_it !=', 'yes');
		$this->db->where('st.stproject_assign', $pid);
		$this->db->where('st.strash !=', 'yes');
		$this->db->where('st.subtask_archive !=', 'yes');
		$this->db->where('st.subtask_file_it !=', 'yes');
		$this->db->select('t.tname,st.stid,st.stcode,st.stname,st.stpriority,st.ststatus,st.sreview,st.stdue_date,CONCAT_WS(" ", r.first_name,r.last_name) AS name');
		$this->db->from('registration as r');
        $this->db->join('subtask as st', 'st.stassignee = r.reg_id');
        $this->db->join('task as t','t.tid = st.tid');
        $query = $this->db->get();
		return $query->result();
    }

  //   function getTeamMembersbyPid($pid)
  //   {
  //   	$this->db->order_by('pm_id', 'DESC');
  //   	$this->db->where('status','accepted');
		// $this->db->where('p.pid', $pid);
		// $this->db->where('ptrash !=', 'yes');
		// $this->db->select('CONCAT_WS(" ", r.first_name,r.last_name) AS fullname');
		// $this->db->from('registration as r');
  //       $this->db->join('project_members as p', 'p.pmember = r.reg_id');
  //       $query = $this->db->get();
		// return $query->result();
  //   }

    function check_assignee_status($tid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('tid', $tid);
		$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$this->db->where('tassignee', $this->session->userdata('d168_id'));
		$query = $this->db->get('task');
		return $query->row();
	}

	function ArchiveProjects($port_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_id', $port_id);
    	$this->db->where('pcreated_by', $this->session->userdata('d168_id'));
		$this->db->where('project_archive','yes');
		$this->db->where('ptrash !=','yes');
    	$query = $this->db->get('project');
    	return $query->result();
    }

	function TrashProjects($port_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_id', $port_id);
    	$this->db->where('pcreated_by', $this->session->userdata('d168_id'));
		$this->db->where('ptrash', 'yes');
		$this->db->where('project_archive !=', 'yes');
    	$query = $this->db->get('project');
    	return $query->result();
    }

    function check_project_trash($id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('pid', $id);
    	$this->db->where('ptrash', 'yes');
    	$this->db->where('pcreated_by', $this->session->userdata('d168_id'));
    	$query = $this->db->get('project');
    	return $query->row();
    }

    function check_project_archive($id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('pid', $id);
    	$this->db->where('project_archive', 'yes');
    	$this->db->where('pcreated_by', $this->session->userdata('d168_id'));
    	$query = $this->db->get('project');
    	return $query->row();
    }

    function checkProjectPorfolioArchive($port_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('portfolio_id',$port_id);
    	$this->db->where('portfolio_archive','yes');
    	$query = $this->db->get('project_portfolio');
    	return $query->num_rows();
    }

    function checkProjectPorfolioTrash($port_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('portfolio_id',$port_id);
    	$this->db->where('portfolio_trash','yes');
    	$query = $this->db->get('project_portfolio');
    	return $query->num_rows();
    }

    function check_task_archive($id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('tid', $id);
    	$this->db->where('task_archive', 'yes');
    	$query = $this->db->get('task');
    	return $query->row();
    }

    function checkTaskProjectArchive($pid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('pid',$pid);
    	$this->db->where('project_archive','yes');
    	$query = $this->db->get('project');
    	return $query->num_rows();
    }

    function checkTaskProjectTrash($pid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('pid',$pid);
    	$this->db->where('ptrash','yes');
    	$query = $this->db->get('project');
    	return $query->num_rows();
    }

    function checkFileProjectTrash($pid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('pid',$pid);
    	$this->db->where('ptrash','yes');
    	$query = $this->db->get('project');
    	return $query->num_rows();
    }

    function checkFileTaskTrash($tid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('tid',$tid);
    	$this->db->where('trash','yes');
    	$query = $this->db->get('task');
    	return $query->num_rows();
    }

    function check_tfile_task_trash($trash_id,$tid)
    {
    	$this->db->where('tid', $tid);
    	$this->db->where('trash_id', $trash_id);
    	$this->db->where('task_trash', 'yes');
    	$query = $this->db->get('task_trash');
    	return $query->row();
    }

    function checkFileSubtaskTrash($stid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('stid',$stid);
    	$this->db->where('strash','yes');
    	$query = $this->db->get('subtask');
    	return $query->num_rows();
    }

    function check_stfile_subtask_trash($strash_id,$stid)
    {
    	$this->db->where('stid', $stid);
    	$this->db->where('strash_id', $strash_id);
    	$this->db->where('stask_trash', 'yes');
    	$query = $this->db->get('subtask_trash');
    	return $query->row();
    }

    function check_subtask_archive($id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('stid', $id);
    	$this->db->where('subtask_archive', 'yes');
    	$query = $this->db->get('subtask');
    	return $query->row();
    }

    function checkSubtaskTaskArchive($tid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('tid',$tid);
    	$this->db->where('task_archive','yes');
    	$query = $this->db->get('task');
    	return $query->num_rows();
    }

    function checkSubtaskTaskTrash($tid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('tid',$tid);
    	$this->db->where('trash','yes');
    	$query = $this->db->get('task');
    	return $query->num_rows();
    }

    function TrashProjectFiles($port_id)
    {
    	$this->db->where('pf.reg_acc_status !=','deactivated');
		$this->db->where('p.portfolio_id', $port_id);
		$this->db->where('pf.ptrash', 'yes');
		$this->db->select('*,pf.ptrash_date as pfptrash_date');
		$this->db->from('project_files as pf');
		$this->db->join('project as p','p.pid = pf.pid');
    	$query = $this->db->get();
    	return $query->result();
    }

    function check_pfile_trash($pfile_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('pfile_id', $pfile_id);
    	$this->db->where('ptrash', 'yes');
    	$query = $this->db->get('project_files');
    	return $query->row();
    }

    function edit_project_files_by_pfileId($data2,$pfile_id)
	{
		$this->db->where('pfile_id', $pfile_id);
		if($this->db->update('project_files', $data2))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function insert_task_trash($data)
	{
		if($this->db->insert('task_trash',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function TrashTaskFiles($port_id)
    {
    	$this->db->where('t.reg_acc_status !=','deactivated');
		$this->db->where('t.portfolio_id', $port_id);
		$this->db->select('t.portfolio_id,t.tcode,t.tname,tt.tfile,tt.tid,tt.trash_id,tt.pid,tt.task_trash_date');
		$this->db->from('task_trash as tt');
		$this->db->join('task as t','t.tid = tt.tid');
    	$query = $this->db->get();
    	return $query->result();
    }

    function delete_task_trash($trash_id)
	{
		$this->db->where('trash_id',$trash_id);
		if($this->db->delete('task_trash'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function get_tfile_trash($get_today_date)
	{
		$this->db->where('task_trash_date',$get_today_date);
		$query = $this->db->get('task_trash');
		return $query->result();
	}

	function delete_tfile_trash($trash_id)
	{
		$this->db->where('trash_id',$trash_id);
		if($this->db->delete('task_trash'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

    function Motivator()
    {
    	$query = $this->db->query("SELECT * FROM `motivator` WHERE status = 'approved' and reg_acc_status != 'deactivated' ORDER BY rand() LIMIT 1;");
        return $query->row();
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

    function check_PortfolioMember($port_id,$im)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('portfolio_trash !=', 'yes');
    	$this->db->where('portfolio_archive !=', 'yes');
    	$this->db->where('portfolio_file_it !=', 'yes');
    	$this->db->where('sent_to', $im);
    	$this->db->where('portfolio_id', $port_id);
    	$query = $this->db->get('project_portfolio_member');
    	return $query->row();
    }

    function check_PortfolioMemberActive($port_id,$im)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('working_status', 'active');
    	$this->db->where('sent_to', $im);
    	$this->db->where('portfolio_id', $port_id);
    	$query = $this->db->get('project_portfolio_member');
    	return $query->row();
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

    function getPortfolioMember($pim_id,$port_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('portfolio_trash !=', 'yes');
    	$this->db->where('portfolio_archive !=', 'yes');
    	$this->db->where('portfolio_file_it !=', 'yes');
    	$this->db->where('portfolio_id', $port_id);
    	$this->db->where('pim_id', $pim_id);
    	$query = $this->db->get('project_portfolio_member');
    	return $query->row();
    }

    function checkPortfolioMemberEmail($email,$port_id)
    {
    	$this->db->where('portfolio_id', $port_id);
    	$this->db->where('sent_to', $email);
    	$query = $this->db->get('project_portfolio_member');
    	return $query->num_rows();
    }

    function update_PortfolioMember($data2,$pim_id)
    {
    	$this->db->where('pim_id', $pim_id);
    	if($this->db->update('project_portfolio_member',$data2))
    	{
    		return TRUE;
    	}
    	else
    	{
    		return FALSE;
    	}
    }

    function check_portTM($email)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('portfolio_trash !=', 'yes');
    	$this->db->where('portfolio_archive !=', 'yes');
    	$this->db->where('portfolio_file_it !=', 'yes');
    	$this->db->where('status','pending');
    	$this->db->where('sent_to',$email);
    	$query = $this->db->get('project_portfolio_member');
    	return $query->result();
    }
	
    function update_InvitePortfolioMember($idata,$email)
    {
    	$this->db->where('status','pending');
    	$this->db->where('sent_to',$email);
    	if($this->db->update('project_portfolio_member',$idata))
    	{
    		return TRUE;
    	}
    	else
    	{
    		return FALSE;
    	}
    }

    function getAll_Accepted_PortTM($portfolio_id)
    {
    	$this->db->order_by('sent_to','ASC');
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('portfolio_archive !=', 'yes');
    	$this->db->where('portfolio_file_it !=', 'yes');
    	$this->db->where('portfolio_id',$portfolio_id);
    	$this->db->where('status','accepted');
    	$query = $this->db->get('project_portfolio_member');
    	return $query->result();
    }

    function getAccepted_PortTM($portfolio_id)
    {
    	$this->db->order_by('sent_to','ASC');
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('portfolio_archive !=', 'yes');
    	$this->db->where('portfolio_file_it !=', 'yes');
    	$this->db->where('portfolio_id',$portfolio_id);
    	$this->db->where('status','accepted');
    	$this->db->where('working_status','active');
    	$query = $this->db->get('project_portfolio_member');
    	return $query->result();
    }

    function check_pm($reg_id,$pid,$port_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('portfolio_id',$port_id);
    	$this->db->where('pmember',$reg_id);
    	$this->db->where('pid',$pid);
    	$query = $this->db->get('project_members');
    	return $query->row();
    }

    function update_PortfolioMemberPIM($data2,$email,$port_id)
    {
    	$this->db->where('portfolio_id',$port_id);
    	$this->db->where('sent_to', $email);
    	if($this->db->update('project_portfolio_member',$data2))
    	{
    		return TRUE;
    	}
    	else
    	{
    		return FALSE;
    	}
    }

    function insert_NewSubtask($data)
	{
		if($this->db->insert('subtask',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function Check_Task_Subtasks($tid)
	{
		$this->db->order_by('stid','DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$this->db->where('tid',$tid);
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function Check_Task_Subtasks2($tid)
	{
		$this->db->order_by('stid','DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('strash !=','yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$this->db->where('tid',$tid);
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function Check_Task_ALL_Subtasks2($tid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('strash !=','yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$this->db->where('tid',$tid);
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function SubtaskDetail($id)
	{
		$this->db->where('st.reg_acc_status !=','deactivated');
		$this->db->where('st.stid', $id);
		$this->db->where('st.strash !=', 'yes');
		$this->db->where('st.subtask_archive !=', 'yes');
		$this->db->where('st.subtask_file_it !=', 'yes');
		$this->db->select('*');
        $this->db->from('registration as r');
        $this->db->join('subtask as st', 'st.stcreated_by = r.reg_id');
        $query = $this->db->get();
        return $query->row();
	}

	function check_subtask_assignee_status($stid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('stid', $stid);
		$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$this->db->where('stassignee', $this->session->userdata('d168_id'));
		$query = $this->db->get('subtask');
		return $query->row();
	}

	function check_subtask($stid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('stid', $stid);
    	$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
    	// $this->db->group_start();
    	// $this->db->where('stcreated_by', $this->session->userdata('d168_id'));
    	// $this->db->or_where('stassignee', $this->session->userdata('d168_id'));
    	// $this->db->group_end();
    	$query = $this->db->get('subtask');
    	return $query->row();
    }

    function check_Donesubtask($stid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('stid', $stid);
    	$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$this->db->where('ststatus','done');
    	// $this->db->group_start();
    	// $this->db->where('stcreated_by', $this->session->userdata('d168_id'));
    	// $this->db->or_where('stassignee', $this->session->userdata('d168_id'));
    	// $this->db->group_end();
    	$query = $this->db->get('subtask');
    	return $query->row();
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

    function getSubtasksProject($pid)
	{
		$this->db->order_by('stid','DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('stproject_assign',$pid);
		$this->db->where('subtask_archive', '');
		$this->db->where('subtask_file_it', '');
		$this->db->where('strash', '');
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function edit_project_subtasks($data9,$id)
	{
		$this->db->where('stproject_assign', $id);
		if($this->db->update('subtask', $data9))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function edit_project_subtasksSentTrash($data9,$id)
	{
		$this->db->where('stsingle_trash','');
		$this->db->where('stproject_assign', $id);
		if($this->db->update('subtask', $data9))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function edit_project_subtasksRetrieve($data9,$id)
	{
		$this->db->where('stsingle_trash','p_yes');
		$this->db->where('stproject_assign', $id);
		if($this->db->update('subtask', $data9))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function edit_task_subtasks($data9,$tid)
	{
		$this->db->where('tid', $tid);
		if($this->db->update('subtask', $data9))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function edit_task_subtasksRetrieve($data9,$tid)
	{
		$this->db->where('stsingle_trash !=','yes');
		$this->db->where('tid', $tid);
		if($this->db->update('subtask', $data9))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function getSubtaskById($stid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('stid', $stid);
		$this->db->where('strash !=', 'yes');
		$query = $this->db->get('subtask');
		return $query->row();
	}

	function insert_subtask_trash($data)
	{
		if($this->db->insert('subtask_trash',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function TrashSubtasks($port_id)
	{
		$this->db->order_by('date(ststatus_date)', 'DESC');
		$this->db->where('st.reg_acc_status !=','deactivated');
		$this->db->where('strash','yes');
		$this->db->where('subtask_archive !=','yes');
		$this->db->where('st.portfolio_id', $port_id);
		$this->db->group_start();
    	$this->db->where('stcreated_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('stassignee', $this->session->userdata('d168_id'));
    	$this->db->or_where('p.pcreated_by', $this->session->userdata('d168_id'));
    	$this->db->group_end();
		$this->db->select('*');
		$this->db->from('registration as r');
		$this->db->join('subtask as st','st.stassignee = r.reg_id');
		$this->db->join('project as p','p.pid = st.stproject_assign');
		$query = $this->db->get();
		return $query->result();
	}

	function TrashSingleSubtasks($port_id)
	{
		$this->db->order_by('date(ststatus_date)', 'DESC');
		$this->db->where('st.reg_acc_status !=','deactivated');
		$this->db->where('stproject_assign','0');
		$this->db->where('strash','yes');
		$this->db->where('subtask_archive !=','yes');
		$this->db->where('portfolio_id', $port_id);
		$this->db->group_start();
    	$this->db->where('stcreated_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('stassignee', $this->session->userdata('d168_id'));
    	$this->db->group_end();
		$this->db->select('*');
		$this->db->from('registration as r');
		$this->db->join('subtask as st','st.stassignee = r.reg_id');
		$query = $this->db->get();
		return $query->result();
	}

	function ArchiveSubtasks($port_id)
	{
		$this->db->order_by('date(ststatus_date)', 'DESC');
		$this->db->where('st.reg_acc_status !=','deactivated');
		$this->db->where('strash !=','yes');
		$this->db->where('subtask_archive','yes');
		$this->db->where('st.portfolio_id', $port_id);
		$this->db->group_start();
    	$this->db->where('stcreated_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('stassignee', $this->session->userdata('d168_id'));
    	$this->db->or_where('p.pcreated_by', $this->session->userdata('d168_id'));
    	$this->db->group_end();
		$this->db->select('*');
		$this->db->from('registration as r');
		$this->db->join('subtask as st','st.stassignee = r.reg_id');
		$this->db->join('project as p','p.pid = st.stproject_assign');
		$query = $this->db->get();
		return $query->result();
	}

	function ArchiveSingleSubtasks($port_id)
	{
		$this->db->order_by('date(ststatus_date)', 'DESC');
		$this->db->where('st.reg_acc_status !=','deactivated');
		$this->db->where('stproject_assign','0');
		$this->db->where('strash !=','yes');
		$this->db->where('subtask_archive','yes');
		$this->db->where('portfolio_id', $port_id);
		$this->db->group_start();
    	$this->db->where('stcreated_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('stassignee', $this->session->userdata('d168_id'));
    	$this->db->group_end();
		$this->db->select('*');
		$this->db->from('registration as r');
		$this->db->join('subtask as st','st.stassignee = r.reg_id');
		$query = $this->db->get();
		return $query->result();
	}

	function TrashSubtaskFiles($port_id)
    {
    	$this->db->where('st.reg_acc_status !=','deactivated');
		$this->db->where('portfolio_id', $port_id);
		$this->db->select('st.portfolio_id,st.stcode,st.stname,stt.stfile,stt.stid,stt.strash_id,stt.pid,stt.stask_trash_date');
		$this->db->from('subtask_trash as stt');
		$this->db->join('subtask as st','st.stid = stt.stid');
    	$query = $this->db->get();
    	return $query->result();
    }

    function check_subtask2($stid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('stid', $stid);
    	$this->db->where('strash', 'yes');
    	// $this->db->group_start();
    	// $this->db->where('stcreated_by', $this->session->userdata('d168_id'));
    	// $this->db->or_where('stassignee', $this->session->userdata('d168_id'));
    	// $this->db->group_end();
    	$query = $this->db->get('subtask');
    	return $query->row();
    }

    function delete_subtask_trash($strash_id)
	{
		$this->db->where('strash_id',$strash_id);
		if($this->db->delete('subtask_trash'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function get_stfile_trash($get_today_date)
	{
		$this->db->where('stask_trash_date',$get_today_date);
		$query = $this->db->get('subtask_trash');
		return $query->result();
	}

	function delete_stfile_trash($strash_id)
	{
		$this->db->where('strash_id',$strash_id);
		if($this->db->delete('subtask_trash'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function check_subtask_assign($stid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('stid', $stid);
		$this->db->where('stassignee', $this->session->userdata('d168_id'));
		$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$query = $this->db->get('subtask');
		return $query->row();
	}

	function check_subtask_assign2($stid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('stid', $stid);
		//$this->db->where('stassignee', $this->session->userdata('d168_id'));
		$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$query = $this->db->get('subtask');
		return $query->row();
	}

	function check_subtask_assignProOwner($stid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('stid', $stid);
		$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$query = $this->db->get('subtask');
		return $query->row();
	}

	function update_Subtask($data,$stid,$stassignee)
	{
		$this->db->where('stid', $stid);
		$this->db->where('stassignee', $this->session->userdata('d168_id'));
		if($this->db->update('subtask', $data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function update_SubtaskProOwner($data,$stid)
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

	function AssignedSubtasklist()
	{
		$this->db->order_by('stid', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('stassignee', $this->session->userdata('d168_id'));
		$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function AssignedSubtasklist_Task()
	{
		$this->db->group_by('tid');
		$this->db->order_by('stid', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('stassignee', $this->session->userdata('d168_id'));
		$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function AssignedSubtaskTrashlist()
	{
		$this->db->order_by('stid', 'DESC');
		$this->db->where('st.reg_acc_status !=','deactivated');
		$this->db->group_start();
    	$this->db->where('stcreated_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('stassignee', $this->session->userdata('d168_id'));
    	$this->db->group_end();
		$this->db->where('strash', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$this->db->select('*');
		$this->db->from('registration as r');
		$this->db->join('subtask as st','st.stassignee = r.reg_id');
		$query = $this->db->get();
		return $query->result();
	}

	function TodaySubtasks($today)
	{
		$this->db->order_by('stdue_date', 'ASC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('stdue_date', $today);
		$this->db->where('stassignee', $this->session->userdata('d168_id'));
		$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function TodaySubtasksDashboard($today)
	{
		$this->db->order_by('stdue_date', 'ASC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('stdue_date', $today);
		$this->db->where('stassignee', $this->session->userdata('d168_id'));
		$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$this->db->where('ststatus !=', 'done');
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function TodaySubtasklist_Task($today)
	{
		$this->db->group_by('tid');
		$this->db->order_by('stid', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('stdue_date', $today);
		$this->db->where('stassignee', $this->session->userdata('d168_id'));
		$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function TodaySubtasksTrashlist($today)
	{
		$this->db->order_by('stid', 'DESC');
		$this->db->where('st.reg_acc_status !=','deactivated');
		$this->db->where('stdue_date', $today);
		$this->db->group_start();
    	$this->db->where('stcreated_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('stassignee', $this->session->userdata('d168_id'));
    	$this->db->group_end();
		$this->db->where('strash', 'yes');
		$this->db->select('*');
		$this->db->from('registration as r');
		$this->db->join('subtask as st','st.stassignee = r.reg_id');
		$query = $this->db->get();
		return $query->result();
	}

	function TomorrowSubtasks($tomorrow)
	{
		$this->db->order_by('stid', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('stdue_date', $tomorrow);
		$this->db->where('stassignee', $this->session->userdata('d168_id'));
		$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function TomorrowSubtasksTrashlist($tomorrow)
	{
		$this->db->order_by('stid', 'DESC');
		$this->db->where('st.reg_acc_status !=','deactivated');
		$this->db->where('stdue_date', $tomorrow);
		$this->db->group_start();
    	$this->db->where('stcreated_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('stassignee', $this->session->userdata('d168_id'));
    	$this->db->group_end();
		$this->db->where('strash', 'yes');
		$this->db->select('*');
		$this->db->from('registration as r');
		$this->db->join('subtask as st','st.stassignee = r.reg_id');
		$query = $this->db->get();
		return $query->result();
	}

	function WeekSubtasks($FirstDay,$LastDay)
	{
		$query = $this->db->query("SELECT * from subtask where stassignee = '".$this->session->userdata('d168_id')."' and strash != 'yes' and subtask_archive != 'yes' and subtask_file_it != 'yes' and stdue_date BETWEEN '".$FirstDay."' and '".$LastDay."' and reg_acc_status != 'deactivated' ORDER BY stdue_date ASC");
        return $query->result();
	}

	function WeekSubtasksDashboard($FirstDay,$LastDay)
	{
		$query = $this->db->query("SELECT * from subtask where stassignee = '".$this->session->userdata('d168_id')."' and strash != 'yes' and subtask_archive != 'yes' and subtask_file_it != 'yes' and stdue_date BETWEEN '".$FirstDay."' and '".$LastDay."' and reg_acc_status != 'deactivated' and ststatus != 'done' ORDER BY stdue_date ASC");
        return $query->result();
	}

	function WeekSubtaskslist_Task($FirstDay,$LastDay)
	{
		$query = $this->db->query("SELECT * from subtask where stassignee = '".$this->session->userdata('d168_id')."' and strash != 'yes' and subtask_archive != 'yes' and subtask_file_it != 'yes' and stdue_date BETWEEN '".$FirstDay."' and '".$LastDay."' and reg_acc_status != 'deactivated' GROUP BY tid ORDER BY stid DESC");
        return $query->result();
	}

	function WeekSubtasksTrashlist($FirstDay,$LastDay)
	{
		$query = $this->db->query("SELECT * FROM `registration` as `r` JOIN `subtask` as `st` ON `st`.`stassignee` = `r`.`reg_id` where (stcreated_by = '".$this->session->userdata('d168_id')."' or stassignee = '".$this->session->userdata('d168_id')."')  and st.reg_acc_status != 'deactivated'and strash = 'yes' and stdue_date BETWEEN '".$FirstDay."' and '".$LastDay."' ORDER BY stid DESC");
        return $query->result();
	}

	function OverdueSubtasks($currentDate)
	{
		$this->db->order_by('stid', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('stdue_date <',$currentDate);
		$this->db->where('stassignee', $this->session->userdata('d168_id'));
		$this->db->where('strash','');
		$this->db->where('subtask_archive', '');
		$this->db->where('subtask_file_it', '');
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function OverdueSubtasksDashboard($currentDate)
	{
		$this->db->order_by('stid', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('stdue_date <',$currentDate);
		$this->db->where('stassignee', $this->session->userdata('d168_id'));
		$this->db->where('strash','');
		$this->db->where('subtask_archive', '');
		$this->db->where('subtask_file_it', '');
		$this->db->where('ststatus !=', 'done');
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function OverdueSubtasksTrashlist($currentDate)
	{
		$this->db->order_by('stid', 'DESC');
		$this->db->where('st.reg_acc_status !=','deactivated');
		$this->db->where('stdue_date <',$currentDate);
		$this->db->group_start();
    	$this->db->where('stcreated_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('stassignee', $this->session->userdata('d168_id'));
    	$this->db->group_end();
		$this->db->where('strash','yes');
		$this->db->where('ststatus !=','done');
		$this->db->select('*');
		$this->db->from('registration as r');
		$this->db->join('subtask as st','st.stassignee = r.reg_id');
		$query = $this->db->get();
		return $query->result();
	}

	function subtask_notification()
	{
		$this->db->order_by('stid', 'DESC');
		$this->db->where('st.reg_acc_status !=','deactivated');
		$this->db->where('st.stnotify', 'yes');
		$this->db->where('st.strash', '');
		$this->db->where('st.subtask_archive', '');
		$this->db->where('st.subtask_file_it', '');
		$this->db->where('st.stassignee', $this->session->userdata('d168_id'));
		$this->db->select('*');
		$this->db->from('subtask as st');
		$this->db->join('project as p', 'p.pid = st.stproject_assign');
		$query = $this->db->get();
		return $query->result();
	}

	function edit_SubtaskNotify($data,$pid,$stassignee,$stid)
    {
    	$this->db->where('stnotify','yes');
    	$this->db->where('stassignee', $stassignee);
    	$this->db->where('stproject_assign', $pid);
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

    function edit_SubtaskReviewNotify($data,$pid,$stassignee,$stid)
    {
    	$this->db->where('stassignee', $stassignee);
    	$this->db->where('stproject_assign', $pid);
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

    function getSubtasksDetail($stid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('stid',$stid);
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$query = $this->db->get('subtask');
		return $query->row();
	}

	function get_subtask_details($stid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('stid', $stid);
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$this->db->where('strash !=', 'yes');
		$query = $this->db->get('subtask');
		return $query->row();
	}

	function check_subtask_review_sent()
	{
		$this->db->order_by('stid', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('subtask_archive', '');
		$this->db->where('subtask_file_it', '');
		$this->db->where('strash', '');
		$this->db->where('sreview_notify', 'sent_yes');
		$this->db->where('sreview', 'sent');
		$this->db->where('stassignee', $this->session->userdata('d168_id'));
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function check_subtask_review_deny()
	{
		$this->db->order_by('stid', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('subtask_archive', '');
		$this->db->where('subtask_file_it', '');
		$this->db->where('strash', '');
		$this->db->where('sreview_notify', 'sent_yes');
		$this->db->where('sreview', 'denied');
		$this->db->where('stassignee', $this->session->userdata('d168_id'));
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function check_subtask_review_approve()
	{
		$this->db->order_by('stid', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('subtask_archive', '');
		$this->db->where('subtask_file_it', '');
		$this->db->where('strash', '');
		$this->db->where('sreview_notify', 'sent_yes');
		$this->db->where('sreview', 'approved');
		$this->db->where('stassignee', $this->session->userdata('d168_id'));
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function check_tasks_subtasks($tid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('tid', $tid);
		$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function get_subtask_trash_date($get_today_date)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('strash_date',$get_today_date);
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function delete_subtask($id)
	{
		$this->db->where('stid',$id);
		if($this->db->delete('subtask'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function SubtaskFile($pid)
	{
		$this->db->order_by('stid','DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('stfile !=','');
		$this->db->where('stproject_assign', $pid);
		$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function get_totalSubtask_count($tid)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM subtask where tid='".$tid."' and strash!='yes' and subtask_archive!='yes' and subtask_file_it!='yes' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function task_notification_clear()
    {
        $this->db->order_by('t.tid', 'DESC');
        $this->db->where('t.reg_acc_status !=','deactivated');
        $this->db->where('p.project_archive', '');
        $this->db->where('p.project_file_it', '');
        $this->db->where('t.tnotify_clear','no');
        $this->db->where('t.tnotify', 'yes');
        $this->db->where('t.trash', '');
        $this->db->where('t.task_archive', '');
        $this->db->where('t.task_file_it', '');
        $this->db->where('t.tassignee', $this->session->userdata('d168_id'));
        $this->db->select('*');
        $this->db->from('task as t');
        $this->db->join('project as p', 'p.pid = t.tproject_assign');
        $query = $this->db->get();
        return $query->result();
    }

    function check_TaskToClear($id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('tid',$id);
    	$query = $this->db->get('task');
        return $query->row();
    }

    function OverdueTasks_clear($currentDate)
    {
        $this->db->order_by('tid', 'DESC');
        $this->db->where('reg_acc_status !=','deactivated');
        $this->db->where('tdue_date_clear','no');
        $this->db->where('tdue_date <',$currentDate);
        $this->db->where('tassignee', $this->session->userdata('d168_id'));
        $this->db->where('trash','');
        $this->db->where('task_archive', '');
        $this->db->where('task_file_it', '');
        $query = $this->db->get('task');
        return $query->result();
    }

    function OverdueSubtasks_clear($currentDate)
    {
        $this->db->order_by('stid', 'DESC');
        $this->db->where('reg_acc_status !=','deactivated');
        $this->db->where('stdue_date_clear','no');
        $this->db->where('stdue_date <',$currentDate);
        $this->db->where('stassignee', $this->session->userdata('d168_id'));
        $this->db->where('strash','');
        $this->db->where('subtask_archive', '');
        $this->db->where('subtask_file_it', '');
        $query = $this->db->get('subtask');
        return $query->result();
    }

    function PendingProjectList_clear()
    {
        $this->db->order_by('p.portfolio_id', 'DESC');
        $this->db->where('pm.reg_acc_status !=','deactivated');
        $this->db->where('p.ptrash', '');
        $this->db->where('p.project_archive', '');
        $this->db->where('p.project_file_it', '');
        $this->db->where('pm.status', 'send');
        $this->db->where('pm.pmember', $this->session->userdata('d168_id'));
        $this->db->where('pm.sent_notify_clear','no');
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');
        $this->db->from('project as p');
        $this->db->join('project_members as pm','pm.pid = p.pid');
        $query = $this->db->get();
        return $query->result();
    }

    function check_ProjectMToClear($id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('pmember',$this->session->userdata('d168_id'));
    	$this->db->where('pid',$id);
    	$query = $this->db->get('project_members');
        return $query->row();
    }

    function check_task_review_sent_clear()
    {
        $this->db->order_by('tid', 'DESC');
        $this->db->where('reg_acc_status !=','deactivated');
        $this->db->where('task_archive', '');
        $this->db->where('task_file_it', '');
        $this->db->where('trash', '');
        $this->db->where('review_notify', 'sent_yes');
        $this->db->where('review', 'sent');
        $this->db->where('review_clear','no');
        $this->db->where('tassignee', $this->session->userdata('d168_id'));
        $query = $this->db->get('task');
        return $query->result();
    }

	function check_task_review_deny_clear()
    {
        $this->db->order_by('tid', 'DESC');
        $this->db->where('reg_acc_status !=','deactivated');
        $this->db->where('task_archive', '');
        $this->db->where('task_file_it', '');
        $this->db->where('trash', '');
        $this->db->where('review_notify', 'sent_yes');
        $this->db->where('review', 'denied');
        $this->db->where('review_clear','no');
        $this->db->where('tassignee', $this->session->userdata('d168_id'));
        $query = $this->db->get('task');
        return $query->result();
    }

	function check_task_review_approve_clear()
    {
        $this->db->order_by('tid', 'DESC');
        $this->db->where('reg_acc_status !=','deactivated');
        $this->db->where('task_archive', '');
        $this->db->where('task_file_it', '');
        $this->db->where('trash', '');
        $this->db->where('review_notify', 'sent_yes');
        $this->db->where('review', 'approved');
        $this->db->where('review_clear','no');
        $this->db->where('tassignee', $this->session->userdata('d168_id'));
        $query = $this->db->get('task');
        return $query->result();
    }

    function ProjectFile_clear($pid)
    {
        $this->db->order_by('pfile_id','DESC');
        $this->db->where('reg_acc_status !=','deactivated');
        $this->db->where('pid', $pid);
        $this->db->where('project_archive', '');
        $this->db->where('project_file_it', '');
        $this->db->where('ptrash', '');
        $this->db->where('pfnotify_clear !=','');
        $query = $this->db->get('project_files');
        return $query->result();
    }

    function getTasksProject_clear($pid)
    {
        $this->db->order_by('tid','DESC');
        $this->db->where('reg_acc_status !=','deactivated');
        $this->db->where('tproject_assign',$pid);
        $this->db->where('task_archive', '');
        $this->db->where('task_file_it', '');
        $this->db->where('trash','');
        $this->db->where('tfnotify_clear !=','');
        $query = $this->db->get('task');
        return $query->result();
    }

    function getSubtasksProject_clear($pid)
    {
        $this->db->order_by('stid','DESC');
        $this->db->where('reg_acc_status !=','deactivated');
        $this->db->where('stproject_assign',$pid);
        $this->db->where('subtask_archive', '');
        $this->db->where('subtask_file_it', '');
        $this->db->where('strash', '');
        $this->db->where('stfnotify_clear !=','');
        $query = $this->db->get('subtask');
        return $query->result();
    }

    function subtask_notification_clear()
    {
        $this->db->order_by('stid', 'DESC');
        $this->db->where('st.reg_acc_status !=','deactivated');
        $this->db->where('st.stnotify', 'yes');
        $this->db->where('st.strash', '');
        $this->db->where('st.subtask_archive', '');
        $this->db->where('st.subtask_file_it', '');
        $this->db->where('st.stassignee', $this->session->userdata('d168_id'));
        $this->db->where('st.stnotify_clear','no');
        $this->db->select('*');
        $this->db->from('subtask as st');
        $this->db->join('project as p', 'p.pid = st.stproject_assign');
        $query = $this->db->get();
        return $query->result();
    }

    function check_SubtaskToClear($id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('stid',$id);
    	$query = $this->db->get('subtask');
        return $query->row();
    }

    function check_subtask_review_sent_clear()
    {
        $this->db->order_by('stid', 'DESC');
        $this->db->where('reg_acc_status !=','deactivated');
        $this->db->where('subtask_archive', '');
        $this->db->where('subtask_file_it', '');
        $this->db->where('strash', '');
        $this->db->where('sreview_notify', 'sent_yes');
        $this->db->where('sreview', 'sent');
        $this->db->where('stassignee', $this->session->userdata('d168_id'));
        $this->db->where('sreview_clear','no');
        $query = $this->db->get('subtask');
        return $query->result();
    }

	function check_subtask_review_deny_clear()
    {
        $this->db->order_by('stid', 'DESC');
        $this->db->where('reg_acc_status !=','deactivated');
        $this->db->where('subtask_archive', '');
        $this->db->where('subtask_file_it', '');
        $this->db->where('strash', '');
        $this->db->where('sreview_notify', 'sent_yes');
        $this->db->where('sreview', 'denied');
        $this->db->where('stassignee', $this->session->userdata('d168_id'));
        $this->db->where('sreview_clear','no');
        $query = $this->db->get('subtask');
        return $query->result();
    }

	function check_subtask_review_approve_clear()
    {
        $this->db->order_by('stid', 'DESC');
        $this->db->where('reg_acc_status !=','deactivated');
        $this->db->where('subtask_archive', '');
        $this->db->where('subtask_file_it', '');
        $this->db->where('strash', '');
        $this->db->where('sreview_notify', 'sent_yes');
        $this->db->where('sreview', 'approved');
        $this->db->where('stassignee', $this->session->userdata('d168_id'));
        $this->db->where('sreview_clear','no');
        $query = $this->db->get('subtask');
        return $query->result();
    }

    function get_newTaskbySessID()
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('tassignee', $this->session->userdata('d168_id'));
    	$this->db->where('tnotify_clear','no');
        $query = $this->db->get('task');
        return $query->result();
    }

    function get_newSubtaskbySessID()
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('stassignee', $this->session->userdata('d168_id'));
    	$this->db->where('stnotify_clear','no');
        $query = $this->db->get('subtask');
        return $query->result();
    }

    function get_projfilebySessID()
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('pfnotify_clear !=','');
        $query = $this->db->get('project_files');
        return $query->result();
    }

    function get_taskfilebySessID()
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('tfnotify_clear !=','');
        $query = $this->db->get('task');
        return $query->result();
    }

    function get_subtaskfilebySessID()
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('stfnotify_clear !=','');
        $query = $this->db->get('subtask');
        return $query->result();
    }

    function get_taskreviewbySessID()
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('tassignee', $this->session->userdata('d168_id'));
    	$this->db->where('review_clear','no');
        $query = $this->db->get('task');
        return $query->result();
    }

    function get_subtaskreviewbySessID()
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('stassignee', $this->session->userdata('d168_id'));
    	$this->db->where('sreview_clear','no');
        $query = $this->db->get('subtask');
        return $query->result();
    }

    function get_pendingprojbySessID()
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('pmember', $this->session->userdata('d168_id'));
    	$this->db->where('sent_notify_clear','no');
        $query = $this->db->get('project_members');
        return $query->result();
    }

    function get_oduetaskbySessID($currentDate)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('tdue_date <',$currentDate);
    	$this->db->where('tassignee', $this->session->userdata('d168_id'));
    	$this->db->where('tdue_date_clear','no');
        $query = $this->db->get('task');
        return $query->result();
    }

    function get_oduesubtaskbySessID($currentDate)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('stdue_date <',$currentDate);
    	$this->db->where('stassignee', $this->session->userdata('d168_id'));
    	$this->db->where('stdue_date_clear','no');
        $query = $this->db->get('subtask');
        return $query->result();
    }

    function get_contentplanningbySessID()
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('pc_notify_clear !=','');
        $query = $this->db->get('content_planning');
        return $query->result();
    }

    function pcn_allAssigneesByPID($pcn_pid)
    {
    	$this->db->order_by('pc_id', 'DESC');
    	$this->db->where('cp.reg_acc_status !=','deactivated');
    	$this->db->where('trash', '');
		$this->db->where('cp_archive', '');
		$this->db->where('cp_file_it', '');
        $this->db->where('cp.pc_notify !=', '');
    	$this->db->where('cp.pc_project_assign',$pcn_pid);
    	$this->db->from('content_planning as cp');
		$this->db->join('project as p', 'p.pid = cp.pc_project_assign');
		$query = $this->db->get();
		return $query->result();
    }

    function pcn_allAssigneesByPID_clear($pcn_pid)
    {
    	$this->db->order_by('pc_id', 'DESC');
    	$this->db->where('cp.reg_acc_status !=','deactivated');
    	$this->db->where('trash', '');
		$this->db->where('cp_archive', '');
		$this->db->where('cp_file_it', '');
        $this->db->where('cp.pc_notify_clear !=','');
        $this->db->where('cp.pc_notify !=', '');
    	$this->db->where('cp.pc_project_assign',$pcn_pid);
    	$this->db->from('content_planning as cp');
		$this->db->join('project as p', 'p.pid = cp.pc_project_assign');
		$query = $this->db->get();
		return $query->result();
    }

    function get_new_cpNotify($pid,$pc_id)
    {
    	$this->db->where('cp.reg_acc_status !=','deactivated');
    	$this->db->where('pc_project_assign',$pid);
    	$this->db->where('pc_id',$pc_id);
    	$this->db->from('content_planning as cp');
		$this->db->join('project as p', 'p.pid = cp.pc_project_assign');
		$query = $this->db->get();
		return $query->result();
    }


	function getCountries()
	{
		$query = $this->db->get('countries');
		return $query->result();
	}

	function getCountryByCode($code)
	{
		$this->db->where('country_code', $code);
		$query = $this->db->get('countries');
		return $query->row();
	}

	function insert_NewContent($data)
	{
		if($this->db->insert('content_planning',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function contentPlanningDetails()
   	{
    	$this->db->select('cp.*');
       	$this->db->from('content_planning as cp');
       	$this->db->join('project as proj','cp.pc_project_assign = proj.pid'); 
       	$this->db->join('project_portfolio as port','cp.portfolio_id = port.portfolio_id'); 
       	$this->db->group_start();
       	$this->db->where('cp.pc_created_by',$this->session->userdata('d168_id'));
       	$this->db->or_where('cp.written_content_assignee',$this->session->userdata('d168_id'));
       	$this->db->or_where('cp.pc_file_assignee',$this->session->userdata('d168_id'));
       	$this->db->or_where('cp.submit_to_approval',$this->session->userdata('d168_id'));
       	$this->db->or_where('cp.pc_assignee',$this->session->userdata('d168_id'));     	
       	$this->db->or_where('proj.pcreated_by',$this->session->userdata('d168_id'));
       	$this->db->group_end(); 
       	$this->db->where('cp.reg_acc_status !=','deactivated');
		$this->db->where('port.portfolio_trash !=', 'yes');
		$this->db->where('proj.ptrash !=', 'yes');
		$this->db->where('cp.trash !=', 'yes');
		$this->db->where('cp.cp_archive !=', 'yes');
		$this->db->where('cp.cp_file_it !=', 'yes');
       	$this->db->group_by('cp.pc_project_assign');
		$this->db->order_by('cp.pc_id', 'DESC');
		$query = $this->db->get();
		return $query->result();
   	}

   	function contentPlanningPublishDate($port_id)
   	{
    	$this->db->select('cp.*');
       	$this->db->from('content_planning as cp');
       	$this->db->join('project as proj','cp.pc_project_assign = proj.pid'); 
       	$this->db->join('project_portfolio as port','cp.portfolio_id = port.portfolio_id'); 
       	$this->db->group_start();
       	$this->db->where('cp.pc_created_by',$this->session->userdata('d168_id'));
       	$this->db->or_where('cp.written_content_assignee',$this->session->userdata('d168_id'));
       	$this->db->or_where('cp.pc_file_assignee',$this->session->userdata('d168_id'));
       	$this->db->or_where('cp.submit_to_approval',$this->session->userdata('d168_id'));
       	$this->db->or_where('cp.pc_assignee',$this->session->userdata('d168_id'));     	
       	$this->db->or_where('proj.pcreated_by',$this->session->userdata('d168_id'));
       	$this->db->group_end(); 
       	$this->db->where('cp.reg_acc_status !=','deactivated');
		$this->db->where('port.portfolio_trash !=', 'yes');
		$this->db->where('proj.ptrash !=', 'yes');
		$this->db->where('cp.trash !=', 'yes');
		$this->db->where('cp.cp_archive !=', 'yes');
		$this->db->where('cp.cp_file_it !=', 'yes');
		$this->db->where('cp.portfolio_id', $port_id);
       	$this->db->group_by('cp.publish_date');
		$this->db->order_by('cp.publish_date', 'ASC');
		$query = $this->db->get();
		return $query->result();
   	}

	function getContentPlanningByDel($id)
	{
		// $this->db->where('pc_project_assign', $id);
		// $this->db->group_start();     	
  //      	$this->db->where('pc_created_by',$this->session->userdata('d168_id'));
  //      	$this->db->or_where('written_content_assignee',$this->session->userdata('d168_id'));
  //      	$this->db->or_where('pc_file_assignee',$this->session->userdata('d168_id'));
  //      	$this->db->or_where('submit_to_approval',$this->session->userdata('d168_id'));
  //      	$this->db->or_where('pc_assignee',$this->session->userdata('d168_id'));
  //      	$this->db->group_end(); 
		// $this->db->where('trash !=', 'yes');
		// $this->db->where('cp_archive !=', 'yes');
		// $this->db->where('cp_file_it !=', 'yes');
		// $this->db->order_by('pc_id', 'ASC');
		// $query = $this->db->get('content_planning');
		// return $query->result();

		$this->db->select('cp.*');
       	$this->db->from('content_planning as cp');
       	$this->db->join('project as proj','cp.pc_project_assign = proj.pid'); 
       	$this->db->where('pc_project_assign', $id); 
       	$this->db->group_start();
       	$this->db->where('cp.pc_created_by',$this->session->userdata('d168_id'));
       	$this->db->or_where('cp.written_content_assignee',$this->session->userdata('d168_id'));
       	$this->db->or_where('cp.pc_file_assignee',$this->session->userdata('d168_id'));
       	$this->db->or_where('cp.submit_to_approval',$this->session->userdata('d168_id'));
       	$this->db->or_where('cp.pc_assignee',$this->session->userdata('d168_id'));     	
       	$this->db->or_where('proj.pcreated_by',$this->session->userdata('d168_id'));
       	$this->db->group_end(); 
       	$this->db->where('cp.reg_acc_status !=','deactivated');
		$this->db->where('proj.ptrash !=', 'yes');
		$this->db->where('cp.trash !=', 'yes');
		$this->db->where('cp.cp_archive !=', 'yes');
		$this->db->where('cp.cp_file_it !=', 'yes');
		$this->db->where('cp.reg_acc_status !=','deactivated');
		$this->db->order_by('cp.pc_id', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	function getContentPlanningByDel2($id,$date)
	{
		$this->db->select('cp.*');
       	$this->db->from('content_planning as cp');
       	$this->db->join('project as proj','cp.pc_project_assign = proj.pid'); 
       	$this->db->where('pc_project_assign', $id); 
       	$this->db->where('publish_date', $date);
       	$this->db->group_start();
       	$this->db->where('cp.pc_created_by',$this->session->userdata('d168_id'));
       	$this->db->or_where('cp.written_content_assignee',$this->session->userdata('d168_id'));
       	$this->db->or_where('cp.pc_file_assignee',$this->session->userdata('d168_id'));
       	$this->db->or_where('cp.submit_to_approval',$this->session->userdata('d168_id'));
       	$this->db->or_where('cp.pc_assignee',$this->session->userdata('d168_id'));     	
       	$this->db->or_where('proj.pcreated_by',$this->session->userdata('d168_id'));
       	$this->db->group_end(); 
       	$this->db->where('cp.reg_acc_status !=','deactivated');
		$this->db->where('proj.ptrash !=', 'yes');
		$this->db->where('cp.trash !=', 'yes');
		$this->db->where('cp.cp_archive !=', 'yes');
		$this->db->where('cp.cp_file_it !=', 'yes');
		$this->db->order_by('cp.pc_id', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	function getAccepted_ProjTM($pid)
	{
		$this->db->order_by('status_date', 'asc');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('pid', $pid);
		//$this->db->where('status', 'accepted');
		$query = $this->db->get('project_members');
		return $query->result();
	}

    function getPortfolioById($id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('portfolio_id', $id);
		$this->db->where('portfolio_trash !=', 'yes');
    	$query = $this->db->get('project_portfolio');
    	return $query->row();
    }

	function getContentPlanningById($id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('pc_id', $id);
		$query = $this->db->get('content_planning');
		return $query->row();
	}

	function getContentPlanningData($id)
    {
   	   $this->db->where('reg_acc_status !=','deactivated');
       $this->db->where('pc_id',$id);
       $query = $this->db->get('content_planning');
       return $query->row();
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

	function insert_content_planning_trash($data)
	{
		if($this->db->insert('content_planning_trash',$data))
		{
		return TRUE;
		}
		else
		{
		return FALSE;
		}
	}

	function portProjectList($port_id)
	{
		$this->db->order_by('pid','DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_id',$port_id);
		$this->db->where('pcreated_by', $this->session->userdata('d168_id'));
		$this->db->where('ptrash !=','yes');
		$query = $this->db->get('project');
		return $query->result();
	}

	function acceptedPortProjectList2($port_id)
	{
		$this->db->order_by('p.portfolio_id', 'DESC');
		$this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->where('p.portfolio_id',$port_id);
		$this->db->where('p.ptrash !=', 'yes');
		$this->db->where('pm.status', 'accepted');
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');
        $this->db->from('project as p');
        $this->db->join('project_members as pm','pm.pid = p.pid');
        $query = $this->db->get();
        return $query->result();
	}

	function acceptedPortProjectList($port_id)
	{
		$this->db->order_by('p.portfolio_id', 'DESC');
		$this->db->group_by('p.portfolio_id');
		$this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->where('p.portfolio_id',$port_id);
		$this->db->where('p.ptrash !=', 'yes');
		$this->db->where('pm.status', 'accepted');
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');
        $this->db->from('project as p');
        $this->db->join('project_members as pm','pm.pid = p.pid');
        $query = $this->db->get();
        return $query->result();
	}

	function Project_Planned_Content($id)
    {
    	$this->db->order_by('pc_id','DESC');
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('trash !=','yes');
    	$this->db->where('cp_archive !=','yes');
    	$this->db->where('cp_file_it !=','yes');
    	$this->db->where('pc_project_assign',$id);
        $query = $this->db->get('content_planning');
        return $query->result();
    }

    function Project_ALL_Planned_Content($id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('trash !=','yes');
    	$this->db->where('cp_archive !=','yes');
    	$this->db->where('cp_file_it !=','yes');
    	$this->db->where('pc_project_assign',$id);
        $query = $this->db->get('content_planning');
        return $query->result();
    }

    function getPortfolioAllCPTrash($port_id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_id',$port_id);
		$query = $this->db->get('content_planning');
		return $query->result();
	}

	function UpdatePortfolioCPArchive($data12,$c_id)
	{
		$this->db->where('portfolio_id',$c_id);
		if($this->db->update('content_planning',$data12))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function getPortfolioAllCPNotArc($port_id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('trash !=','yes');
		$this->db->where('cp_archive !=', 'yes');
		$this->db->where('portfolio_id',$port_id);
		$query = $this->db->get('content_planning');
		return $query->result();
	}

	function UpdatePortfolioCPArchiveRetrive($data12,$c_id)
	{
		$this->db->where('cpsingle_trash','');
		$this->db->where('portfolio_id',$c_id);
		if($this->db->update('content_planning',$data12))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

    function get_project_planned_platform($pc_project_assign)
    {
    	$this->db->order_by('cp.pc_id','DESC');
    	$this->db->where('cp.reg_acc_status !=','deactivated');
    	$this->db->where('cp.pc_project_assign',$pc_project_assign);
    	$this->db->select('*, cpp.pc_project_assign as cpp_pc_project_assign');
        $this->db->from('content_planning as cp');
        $this->db->join('content_planning_project as cpp','cpp.pc_project_assign = cp.pc_project_assign');
        $query = $this->db->get();
        return $query->result();
    }

    function edit_project_cpSentTrash($data10,$id)
	{
		$this->db->where('cpsingle_trash','');
		$this->db->where('pc_project_assign', $id);
		if($this->db->update('content_planning', $data10))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function getProjectAllCPNotArc($id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('trash !=','yes');
		$this->db->where('cp_archive !=', 'yes');
		$this->db->where('cp_file_it !=', 'yes');
		$this->db->where('pc_project_assign',$id);
		$query = $this->db->get('content_planning');
		return $query->result();
	}

	function edit_project_cp($data10,$id)
	{
		$this->db->where('pc_project_assign', $id);
		if($this->db->update('content_planning', $data10))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function edit_project_cpRetrieve($data10,$id)
	{
		$this->db->where('cpsingle_trash','p_yes');
		$this->db->where('pc_project_assign', $id);
		if($this->db->update('content_planning', $data10))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function delete_cp_t_trash($id)
	{
		$this->db->where('pc_id',$id);
		if($this->db->delete('content_planning_trash'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function delete_portfolio_cp($id)
	{
		$this->db->where('portfolio_id',$id);
		if($this->db->delete('content_planning'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function getProjectAllCPTrash($pid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('pc_project_assign',$pid);
		$query = $this->db->get('content_planning');
		return $query->result();
	}

	function delete_project_cp($id)
	{
		$this->db->where('pc_project_assign',$id);
		if($this->db->delete('content_planning'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function check_platform($pc_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('pc_id', $pc_id);
    	$this->db->where('trash !=', 'yes');
		$this->db->where('cp_archive !=', 'yes');
		$this->db->where('cp_file_it !=', 'yes');
    	$query = $this->db->get('content_planning');
    	return $query->row();
    }

    function TrashPlatform($port_id)
	{
		$this->db->order_by('date(trash_date)', 'DESC');
		$this->db->where('trash','yes');
		$this->db->where('cp_archive !=', 'yes');
		$this->db->where('cp.portfolio_id', $port_id);
		$this->db->where('cp.reg_acc_status !=','deactivated');
		$this->db->group_start();
    	$this->db->where('cp.pc_created_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('cp.submit_to_approval', $this->session->userdata('d168_id'));
    	$this->db->or_where('cp.pc_assignee', $this->session->userdata('d168_id'));
    	$this->db->or_where('p.pcreated_by', $this->session->userdata('d168_id'));
    	$this->db->group_end();
		$this->db->select('*');
		$this->db->from('content_planning as cp');
		$this->db->join('project as p','p.pid = cp.pc_project_assign');
		$query = $this->db->get();
		return $query->result();
	}

	function check_platform2($pc_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('pc_id', $pc_id);
    	$this->db->where('trash', 'yes');
		$this->db->where('cp_archive !=', 'yes');
		$this->db->where('cp_file_it !=', 'yes');
    	$query = $this->db->get('content_planning');
    	return $query->row();
    }

    function check_platform2_new($pc_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('pc_id', $pc_id);
    	$this->db->where('trash', 'yes');
    	$query = $this->db->get('content_planning');
    	return $query->row();
    }

    function get_platform_trash_date($get_today_date)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('trash_date',$get_today_date);
		$query = $this->db->get('content_planning');
		return $query->result();
	}

	function delete_platform($id)
	{
		$this->db->where('pc_id',$id);
		if($this->db->delete('content_planning'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function get_platformfile_trash($get_today_date)
	{
		$this->db->where('pc_trash_date',$get_today_date);
		$query = $this->db->get('content_planning_trash');
		return $query->result();
	}

	function delete_platformfile_trash($trash_id)
	{
		$this->db->where('pc_trash_id',$trash_id);
		if($this->db->delete('content_planning_trash'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function check_DonePlatform($pc_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('pc_id', $pc_id);
    	$this->db->where('trash !=', 'yes');
		$this->db->where('cp_archive !=', 'yes');
		$this->db->where('cp_file_it !=', 'yes');
		$this->db->where('pc_status', 'done');
        $query = $this->db->get('content_planning');
    	return $query->row();
    }

    function ArchivePlatform($port_id)
	{
		$this->db->order_by('date(cp_archive_date)', 'DESC');
		$this->db->where('cp.reg_acc_status !=','deactivated');
		$this->db->where('trash !=','yes');
		$this->db->where('cp_archive', 'yes');
		$this->db->where('cp.portfolio_id', $port_id);
		$this->db->group_start();
    	$this->db->where('cp.pc_created_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('cp.submit_to_approval', $this->session->userdata('d168_id'));
    	$this->db->or_where('cp.pc_assignee', $this->session->userdata('d168_id'));
    	$this->db->or_where('p.pcreated_by', $this->session->userdata('d168_id'));
    	$this->db->group_end();
		$this->db->select('*');
		$this->db->from('content_planning as cp');
		$this->db->join('project as p','p.pid = cp.pc_project_assign');
		$query = $this->db->get();
		return $query->result();
	}

	function check_platform_archive($id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('pc_id', $id);
    	$this->db->where('cp_archive', 'yes');
    	$query = $this->db->get('content_planning');
    	return $query->row();
    }

	function PortfoliocontentPlanningDetails($port_id)
   	{
    	$this->db->select('cp.*');
       	$this->db->from('content_planning as cp');
       	$this->db->join('project as proj','cp.pc_project_assign = proj.pid'); 
       	$this->db->join('project_portfolio as port','cp.portfolio_id = port.portfolio_id'); 
       	$this->db->group_start();
       	$this->db->where('cp.pc_created_by',$this->session->userdata('d168_id'));
       	$this->db->or_where('cp.written_content_assignee',$this->session->userdata('d168_id'));
       	$this->db->or_where('cp.pc_file_assignee',$this->session->userdata('d168_id'));
       	$this->db->or_where('cp.submit_to_approval',$this->session->userdata('d168_id'));
       	$this->db->or_where('cp.pc_assignee',$this->session->userdata('d168_id'));     	
       	$this->db->or_where('proj.pcreated_by',$this->session->userdata('d168_id'));
       	$this->db->group_end(); 
		$this->db->where('port.portfolio_trash !=', 'yes');
		$this->db->where('proj.ptrash !=', 'yes');
		$this->db->where('cp.trash !=', 'yes');
		$this->db->where('cp.cp_archive !=', 'yes');
		$this->db->where('cp.cp_file_it !=', 'yes');
		$this->db->where('cp.portfolio_id', $port_id);
		$this->db->where('cp.reg_acc_status !=','deactivated');
       	$this->db->group_by('cp.pc_project_assign');
		$this->db->order_by('cp.pc_id', 'DESC');
		$query = $this->db->get();
		return $query->result();
   	}

  //  	function PortfoliocontentPlanningDetailsProjects($port_id)
  //  	{
  //   	$this->db->order_by('p_publish', 'DESC');
		// $this->db->where('ptype', 'content');
		// $this->db->where('portfolio_id', $port_id);
		// $this->db->where('ptrash !=', 'yes');
		// $this->db->where('project_archive !=', 'yes');
		// $this->db->where('project_file_it !=', 'yes');
		// $this->db->where('pcreated_by', $this->session->userdata('d168_id'));
		// $query = $this->db->get('project');
		// return $query->result();
  //  	}

   	function PortfoliocontentPlanningDetails2($port_id,$cdate)
   	{
    	$this->db->select('cp.*');
       	$this->db->from('content_planning as cp');
       	$this->db->join('project as proj','cp.pc_project_assign = proj.pid'); 
       	$this->db->join('project_portfolio as port','cp.portfolio_id = port.portfolio_id'); 
       	$this->db->group_start();
       	$this->db->where('cp.pc_created_by',$this->session->userdata('d168_id'));
       	$this->db->or_where('cp.written_content_assignee',$this->session->userdata('d168_id'));
       	$this->db->or_where('cp.pc_file_assignee',$this->session->userdata('d168_id'));
       	$this->db->or_where('cp.submit_to_approval',$this->session->userdata('d168_id'));
       	$this->db->or_where('cp.pc_assignee',$this->session->userdata('d168_id'));     	
       	$this->db->or_where('proj.pcreated_by',$this->session->userdata('d168_id'));
       	$this->db->group_end(); 
		$this->db->where('port.portfolio_trash !=', 'yes');
		$this->db->where('proj.ptrash !=', 'yes');
		$this->db->where('cp.trash !=', 'yes');
		$this->db->where('cp.cp_archive !=', 'yes');
		$this->db->where('cp.cp_file_it !=', 'yes');
		$this->db->where('cp.portfolio_id', $port_id);
		$this->db->where('cp.publish_date', $cdate);
		$this->db->where('cp.reg_acc_status !=','deactivated');
       	$this->db->group_by('cp.pc_project_assign');
		$this->db->order_by('cp.pc_id', 'DESC');
		$query = $this->db->get();
		return $query->result();
   	}

   	function insert_NewComment($data)
	{
		if($this->db->insert('comments',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function getProjectComments($pid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('project_id', $pid);
    	$query = $this->db->get('comments');
    	return $query->result();
    } 

    function getTaskComments($tid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('subtask_id', '0');
    	$this->db->where('task_id', $tid);
    	$query = $this->db->get('comments');
    	return $query->result();
    } 

    function getSubtaskComments($stid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('subtask_id', $stid);
    	$query = $this->db->get('comments');
    	return $query->result();
    }

    function update_Comment($data,$id)
	{
		$this->db->where('c_created_by', $this->session->userdata('d168_id'));
		$this->db->where('cid', $id);
		if($this->db->update('comments',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function get_comment($id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('cid', $id);
		$query = $this->db->get('comments');
		return $query->row();
	}

    function check_task_arrive_review_clear()
    {
        $this->db->order_by('t.tid', 'DESC');
        $this->db->where('t.reg_acc_status !=','deactivated');
        $this->db->where('t.task_archive', '');
        $this->db->where('t.task_file_it', '');
        $this->db->where('t.trash', '');
        $this->db->where('t.po_review_notify', 'sent_yes');
        $this->db->where('t.review', 'sent');
        $this->db->where('t.po_review_clear','no');
        $this->db->group_start();
        $this->db->where('p.pcreated_by', $this->session->userdata('d168_id'));
        $this->db->or_where('p.pmanager', $this->session->userdata('d168_id'));
        $this->db->group_end();
		$this->db->from('task as t');
		$this->db->join('project as p','p.pid = t.tproject_assign');
		$query = $this->db->get();
        return $query->result();
    }

    function check_task_arrive_review()
    {
        $this->db->order_by('t.tid', 'DESC');
        $this->db->where('t.reg_acc_status !=','deactivated');
        $this->db->where('t.task_archive', '');
        $this->db->where('t.task_file_it', '');
        $this->db->where('t.trash', '');
        $this->db->where('t.po_review_notify', 'sent_yes');
        $this->db->where('t.review', 'sent');
        $this->db->group_start();
        $this->db->where('p.pcreated_by', $this->session->userdata('d168_id'));
        $this->db->or_where('p.pmanager', $this->session->userdata('d168_id'));
        $this->db->group_end();
		$this->db->from('task as t');
		$this->db->join('project as p','p.pid = t.tproject_assign');
		$query = $this->db->get();
        return $query->result();
    }

    function get_taskarrivereviewbySessID()
    {
    	$this->db->where('t.reg_acc_status !=','deactivated');
    	$this->db->where('t.po_review_clear','no');
    	$this->db->group_start();
        $this->db->where('p.pcreated_by', $this->session->userdata('d168_id'));
        $this->db->or_where('p.pmanager', $this->session->userdata('d168_id'));
        $this->db->group_end();
		$this->db->from('task as t');
		$this->db->join('project as p','p.pid = t.tproject_assign');
		$query = $this->db->get();
        return $query->result();
    }

    function edit_TaskArriveReviewNotify($data,$pid,$tid)
    {
    	$this->db->where('tproject_assign', $pid);
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

    function check_subtask_arrive_review_clear()
    {
        $this->db->order_by('st.stid', 'DESC');
        $this->db->where('st.reg_acc_status !=','deactivated');
        $this->db->where('st.subtask_archive', '');
        $this->db->where('st.subtask_file_it', '');
        $this->db->where('st.strash', '');
        $this->db->where('st.po_sreview_notify', 'sent_yes');
        $this->db->where('st.sreview', 'sent');
        $this->db->where('st.po_sreview_clear','no');
        $this->db->group_start();
        $this->db->where('p.pcreated_by', $this->session->userdata('d168_id'));
        $this->db->or_where('p.pmanager', $this->session->userdata('d168_id'));
        $this->db->group_end();
        $this->db->from('subtask as st');
		$this->db->join('project as p','p.pid = st.stproject_assign');
		$query = $this->db->get();
        return $query->result();
    }

    function check_subtask_arrive_review()
	{
		$this->db->order_by('st.stid', 'DESC');
		$this->db->where('st.reg_acc_status !=','deactivated');
		$this->db->where('st.subtask_archive', '');
		$this->db->where('st.subtask_file_it', '');
		$this->db->where('st.strash', '');
		$this->db->where('st.po_sreview_notify', 'sent_yes');
		$this->db->where('st.sreview', 'sent');
		$this->db->group_start();
        $this->db->where('p.pcreated_by', $this->session->userdata('d168_id'));
        $this->db->or_where('p.pmanager', $this->session->userdata('d168_id'));
        $this->db->group_end();
		$this->db->from('subtask as st');
		$this->db->join('project as p','p.pid = st.stproject_assign');
		$query = $this->db->get();
		return $query->result();
	}

	function get_subtaskarrivereviewbySessID()
    {
    	$this->db->where('st.reg_acc_status !=','deactivated');
    	$this->db->where('st.po_sreview_clear','no');
        $this->db->group_start();
        $this->db->where('p.pcreated_by', $this->session->userdata('d168_id'));
        $this->db->or_where('p.pmanager', $this->session->userdata('d168_id'));
        $this->db->group_end();
		$this->db->from('subtask as st');
		$this->db->join('project as p','p.pid = st.stproject_assign');
		$query = $this->db->get();
        return $query->result();
    }

    function edit_SubtaskArriveReviewNotify($data,$pid,$stid)
    {
    	$this->db->where('stproject_assign', $pid);
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

    function check_portfolio_accepted_notify_clear()
    {
    	$this->db->where('ppm.reg_acc_status !=','deactivated');
    	$this->db->where('pp.portfolio_archive', '');
    	$this->db->where('pp.portfolio_file_it', '');
    	$this->db->where('pp.portfolio_trash', '');
    	$this->db->where('ppm.status','accepted');
    	$this->db->where('ppm.status_notify_clear','no');
    	$this->db->where('ppm.status_notify','yes');
        $this->db->where('pp.portfolio_createdby', $this->session->userdata('d168_id'));
		$this->db->from('project_portfolio_member as ppm');
		$this->db->join('project_portfolio as pp','pp.portfolio_id = ppm.portfolio_id');
		$query = $this->db->get();
        return $query->result();
    }

    function check_portfolio_accepted_notify()
    {
    	$this->db->where('ppm.reg_acc_status !=','deactivated');
    	$this->db->where('pp.portfolio_archive', '');
    	$this->db->where('pp.portfolio_file_it', '');
    	$this->db->where('pp.portfolio_trash', '');
    	$this->db->where('ppm.status','accepted');
    	$this->db->where('ppm.status_notify','yes');
        $this->db->where('pp.portfolio_createdby', $this->session->userdata('d168_id'));
		$this->db->from('project_portfolio_member as ppm');
		$this->db->join('project_portfolio as pp','pp.portfolio_id = ppm.portfolio_id');
		$query = $this->db->get();
        return $query->result();
    }

    function check_PPMToClear($id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('pim_id',$id);
    	$query = $this->db->get('project_portfolio_member');
        return $query->row();
    }

    function check_portfolio_accepted_req($pim_id,$port_id)
    {
    	$this->db->where('ppm.reg_acc_status !=','deactivated');
    	$this->db->where('ppm.pim_id', $pim_id);
    	$this->db->where('ppm.portfolio_id', $port_id);
    	$this->db->where('pp.portfolio_archive','');
    	$this->db->where('pp.portfolio_file_it','');
    	$this->db->where('pp.portfolio_trash', '');
    	$this->db->where('ppm.status_notify','yes');
		$this->db->from('project_portfolio_member as ppm');
		$this->db->join('project_portfolio as pp','pp.portfolio_id = ppm.portfolio_id');
		$query = $this->db->get();
        return $query->row();
    }

    function get_portfolio_accepted_notification($pim_id)
    {
    	$this->db->where('ppm.reg_acc_status !=','deactivated');
    	$this->db->where('ppm.pim_id', $pim_id);
    	$this->db->where('pp.portfolio_archive', '');
    	$this->db->where('pp.portfolio_file_it', '');
    	$this->db->where('pp.portfolio_trash', '');
    	$this->db->where('ppm.status_notify','yes');
        $this->db->where('pp.portfolio_createdby', $this->session->userdata('d168_id'));
		$this->db->from('project_portfolio_member as ppm');
		$this->db->join('project_portfolio as pp','pp.portfolio_id = ppm.portfolio_id');
		$query = $this->db->get();
        return $query->result();
    }

    function check_project_accepted_notify_clear()
    {
    	$this->db->where('p.reg_acc_status !=','deactivated');
    	$this->db->where('p.project_archive', '');
    	$this->db->where('p.project_file_it', '');
    	$this->db->where('p.ptrash', '');
    	$this->db->where('pm.status','accepted');
    	$this->db->where('pm.status_notify_clear','no');
    	$this->db->where('pm.status_notify','yes');
    	$this->db->group_start();
        $this->db->where('p.pcreated_by', $this->session->userdata('d168_id'));
        $this->db->or_where('p.pmanager', $this->session->userdata('d168_id'));
        $this->db->group_end();
    	$this->db->where('pm.pmember !=', $this->session->userdata('d168_id'));
		$this->db->from('project_members as pm');
		$this->db->join('project as p','p.pid = pm.pid');
		$query = $this->db->get();
        return $query->result();
    }

    function check_project_accepted_notify()
    {
    	$this->db->where('pm.reg_acc_status !=','deactivated');
    	$this->db->where('p.project_archive', '');
    	$this->db->where('p.project_file_it', '');
    	$this->db->where('p.ptrash', '');
    	$this->db->where('pm.status','accepted');
    	$this->db->where('pm.status_notify','yes');
    	$this->db->group_start();
        $this->db->where('p.pcreated_by', $this->session->userdata('d168_id'));
        $this->db->or_where('p.pmanager', $this->session->userdata('d168_id'));
        $this->db->group_end();
    	$this->db->where('pm.pmember !=', $this->session->userdata('d168_id'));
		$this->db->from('project_members as pm');
		$this->db->join('project as p','p.pid = pm.pid');
		$query = $this->db->get();
        return $query->result();
    }

    function check_ProPMToClear($id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('pm_id',$id);
    	$query = $this->db->get('project_members');
        return $query->row();
    }

    function check_project_accepted_req($pm_id,$pid)
    {
    	$this->db->where('pm.reg_acc_status !=','deactivated');
    	$this->db->where('pm.pm_id', $pm_id);
    	$this->db->where('p.pid', $pid);
    	$this->db->where('p.project_archive', '');
    	$this->db->where('p.project_file_it', '');
    	$this->db->where('p.ptrash', '');
    	$this->db->where('pm.status','accepted');
    	$this->db->where('pm.status_notify','yes');
        $this->db->where('p.pcreated_by', $this->session->userdata('d168_id'));
		$this->db->from('project_members as pm');
		$this->db->join('project as p','p.pid = pm.pid');
		$query = $this->db->get();
        return $query->row();
    }

    function edit_project_members_notify($data2,$id)
	{
		$this->db->where('pm_id', $id);
		if($this->db->update('project_members', $data2))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function get_project_accepted_notification($pm_id)
    {
    	$this->db->where('pm.reg_acc_status !=','deactivated');
    	$this->db->where('pm.pm_id', $pm_id);
    	$this->db->where('p.project_archive', '');
    	$this->db->where('p.project_file_it', '');
    	$this->db->where('p.ptrash', '');
    	$this->db->where('pm.status_notify','yes');
    	$this->db->group_start();
        $this->db->where('p.pcreated_by', $this->session->userdata('d168_id'));
        $this->db->or_where('p.pmanager', $this->session->userdata('d168_id'));
        $this->db->group_end();
		$this->db->from('project_members as pm');
		$this->db->join('project as p','p.pid = pm.pid');
		$query = $this->db->get();
        return $query->result();
    }

    function check_project_invite_accepted_notify_clear()
    {
    	$this->db->where('pm.reg_acc_status !=','deactivated');
    	$this->db->where('p.project_archive', '');
    	$this->db->where('p.project_file_it', '');
    	$this->db->where('p.ptrash', '');
    	$this->db->where('pm.status','accepted');
    	$this->db->where('pm.status_notify_clear','no');
    	$this->db->where('pm.status_notify','yes');
    	$this->db->group_start();
        $this->db->where('p.pcreated_by', $this->session->userdata('d168_id'));
        $this->db->or_where('p.pmanager', $this->session->userdata('d168_id'));
        $this->db->group_end();
		$this->db->from('project_invited_members as pm');
		$this->db->join('project as p','p.pid = pm.pid');
		$query = $this->db->get();
        return $query->result();
    }

    function check_project_invite_accepted_notify()
    {
    	$this->db->where('pm.reg_acc_status !=','deactivated');
    	$this->db->where('p.project_archive', '');
    	$this->db->where('p.project_file_it', '');
    	$this->db->where('p.ptrash', '');
    	$this->db->where('pm.status','accepted');
    	$this->db->where('pm.status_notify','yes');
    	$this->db->group_start();
        $this->db->where('p.pcreated_by', $this->session->userdata('d168_id'));
        $this->db->or_where('p.pmanager', $this->session->userdata('d168_id'));
        $this->db->group_end();
		$this->db->from('project_invited_members as pm');
		$this->db->join('project as p','p.pid = pm.pid');
		$query = $this->db->get();
        return $query->result();
    }

    function check_ProIPMToClear($id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('im_id',$id);
    	$query = $this->db->get('project_invited_members');
        return $query->row();
    }

    function check_project_invite_accepted_req($im_id,$pid)
    {
    	$this->db->where('pm.reg_acc_status !=','deactivated');
    	$this->db->where('pm.im_id', $im_id);
    	$this->db->where('p.pid', $pid);
    	$this->db->where('p.project_archive', '');
    	$this->db->where('p.project_file_it', '');
    	$this->db->where('p.ptrash', '');
    	$this->db->where('pm.status','accepted');
    	$this->db->where('pm.status_notify','yes');
        $this->db->where('p.pcreated_by', $this->session->userdata('d168_id'));
		$this->db->from('project_invited_members as pm');
		$this->db->join('project as p','p.pid = pm.pid');
		$query = $this->db->get();
        return $query->row();
    }

    function edit_project_invite_members_notify($data2,$id)
	{
		$this->db->where('im_id', $id);
		if($this->db->update('project_invited_members', $data2))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function get_Portfolio_To_Remind()
	{
		$this->db->where('ppm.reg_acc_status !=','deactivated');
		$this->db->where('pp.portfolio_archive', '');
		$this->db->where('pp.portfolio_file_it', '');
    	$this->db->where('pp.portfolio_trash', '');
    	$this->db->where('ppm.status','pending');
        $this->db->where('pp.portfolio_createdby', $this->session->userdata('d168_id'));
		$this->db->from('project_portfolio_member as ppm');
		$this->db->join('project_portfolio as pp','pp.portfolio_id = ppm.portfolio_id');
		$query = $this->db->get();
        return $query->result();
	}

	function update_portfolio_reminder_date($rdata,$id)
	{
		$this->db->where('pim_id', $id);
		if($this->db->update('project_portfolio_member', $rdata))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function AssignedTasklistPortfolio($get_port_id)
	{
		$this->db->order_by('tid', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_id', $get_port_id);
		$this->db->where('tassignee', $this->session->userdata('d168_id'));
		$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$query = $this->db->get('task');
		return $query->result();
	}

	function AssignedSubtasklist_TaskPortfolio($get_port_id)
	{
		$this->db->group_by('tid');
		$this->db->order_by('stid', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_id', $get_port_id);
		$this->db->where('stassignee', $this->session->userdata('d168_id'));
		$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function AssignedTaskTrashlistPortfolio($get_port_id)
	{
		$this->db->order_by('tid', 'DESC');
		$this->db->group_start();
    	$this->db->where('tcreated_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('tassignee', $this->session->userdata('d168_id'));
    	$this->db->group_end();
    	$this->db->where('t.reg_acc_status !=','deactivated');
		$this->db->where('portfolio_id', $get_port_id);
		$this->db->where('trash', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$this->db->select('*');
		$this->db->from('registration as r');
		$this->db->join('task as t','t.tassignee = r.reg_id');
		$query = $this->db->get();
		return $query->result();
	}

	function AssignedSubtasklistPortfolio($get_port_id)
	{
		$this->db->order_by('stid', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_id', $get_port_id);
		$this->db->where('stassignee', $this->session->userdata('d168_id'));
		$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function AssignedSubtaskTrashlistPortfolio($get_port_id)
	{
		$this->db->order_by('stid', 'DESC');
		$this->db->group_start();
    	$this->db->where('stcreated_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('stassignee', $this->session->userdata('d168_id'));
    	$this->db->group_end();
    	$this->db->where('st.reg_acc_status !=','deactivated');
		$this->db->where('portfolio_id', $get_port_id);
		$this->db->where('strash', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$this->db->select('*');
		$this->db->from('registration as r');
		$this->db->join('subtask as st','st.stassignee = r.reg_id');
		$query = $this->db->get();
		return $query->result();
	}

	function ProjectListgetPortfolio($get_port_id)
	{
		$this->db->order_by('portfolio_id', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_id', $get_port_id);
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$this->db->where('pcreated_by', $this->session->userdata('d168_id'));
		$query = $this->db->get('project');
		return $query->result();
	}

	function AcceptedProjectListgetPortfolio($get_port_id)
	{
		$this->db->order_by('p.portfolio_id', 'DESC');
		$this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->where('p.portfolio_id', $get_port_id);
		$this->db->where('p.ptrash !=', 'yes');
		$this->db->where('p.project_archive !=', 'yes');
		$this->db->where('p.project_file_it !=', 'yes');
		$this->db->where('pm.status', 'accepted');
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');
        $this->db->from('project as p');
        $this->db->join('project_members as pm','pm.pid = p.pid');
        $query = $this->db->get();
        return $query->result();
	}

	function AssignedTasklistPortfolioReplace($port_id,$pid)
	  {
	    $this->db->order_by('tid', 'DESC');
	    $this->db->where('reg_acc_status !=','deactivated');
	    $this->db->where('portfolio_id', $port_id);
	    $this->db->where('tproject_assign', $pid);
	    $this->db->where('tassignee', $this->session->userdata('d168_id'));
	    $this->db->where('trash !=', 'yes');
	    $this->db->where('task_archive !=', 'yes');
	    $this->db->where('task_file_it !=', 'yes');
	    $query = $this->db->get('task');
	    return $query->result();
	  }

	function AssignedSubtasklist_TaskPortfolioReplace($port_id,$pid)
	{
	    $this->db->group_by('tid');
	    $this->db->order_by('stid', 'DESC');
	    $this->db->where('reg_acc_status !=','deactivated');
	    $this->db->where('portfolio_id', $port_id);
	    $this->db->where('stproject_assign', $pid);
	    $this->db->where('stassignee', $this->session->userdata('d168_id'));
	    $this->db->where('strash !=', 'yes');
	    $this->db->where('subtask_archive !=', 'yes');
	    $this->db->where('subtask_file_it !=', 'yes');
	    $query = $this->db->get('subtask');
	    return $query->result();
	}

	function AssignedTaskTrashlistPortfolioReplace($port_id,$pid)
	{
	    $this->db->order_by('tid', 'DESC');
	    $this->db->where('t.reg_acc_status !=','deactivated');
	    $this->db->group_start();
	      $this->db->where('tcreated_by', $this->session->userdata('d168_id'));
	      $this->db->or_where('tassignee', $this->session->userdata('d168_id'));
	      $this->db->group_end();
	    $this->db->where('portfolio_id', $port_id);
	    $this->db->where('tproject_assign', $pid);
	    $this->db->where('trash', 'yes');
	    $this->db->where('task_archive !=', 'yes');
	    $this->db->where('task_file_it !=', 'yes');
	    $this->db->select('*');
	    $this->db->from('registration as r');
	    $this->db->join('task as t','t.tassignee = r.reg_id');
	    $query = $this->db->get();
	    return $query->result();
	}

	function AssignedSubtasklistPortfolioReplace($port_id,$pid)
	{
	    $this->db->order_by('stid', 'DESC');
	    $this->db->where('reg_acc_status !=','deactivated');
	    $this->db->where('portfolio_id', $port_id);
	    $this->db->where('stproject_assign', $pid);
	    $this->db->where('stassignee', $this->session->userdata('d168_id'));
	    $this->db->where('strash !=', 'yes');
	    $this->db->where('subtask_archive !=', 'yes');
	    $this->db->where('subtask_file_it !=', 'yes');
	    $query = $this->db->get('subtask');
	    return $query->result();
	}

	function AssignedSubtaskTrashlistPortfolioReplace($port_id,$pid)
	{
	    $this->db->order_by('stid', 'DESC');
	    $this->db->where('st.reg_acc_status !=','deactivated');
	    $this->db->group_start();
	      $this->db->where('stcreated_by', $this->session->userdata('d168_id'));
	      $this->db->or_where('stassignee', $this->session->userdata('d168_id'));
	      $this->db->group_end();
	    $this->db->where('portfolio_id', $port_id);
	    $this->db->where('stproject_assign', $pid);
	    $this->db->where('strash', 'yes');
	    $this->db->where('subtask_archive !=', 'yes');
	    $this->db->where('subtask_file_it !=', 'yes');
	    $this->db->select('*');
	    $this->db->from('registration as r');
	    $this->db->join('subtask as st','st.stassignee = r.reg_id');
	    $query = $this->db->get();
	    return $query->result();
	}

	function AssignedTasklistByProj($pid)
	{
		$this->db->order_by('tid', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('tassignee', $this->session->userdata('d168_id'));
		$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$this->db->where('tproject_assign', $pid);
		$query = $this->db->get('task');
		return $query->result();
	}

	function AssignedSubtasklist_TaskByProj($pid)
	{
		$this->db->group_by('tid');
		$this->db->order_by('stid', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('stassignee', $this->session->userdata('d168_id'));
		$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$this->db->where('stproject_assign', $pid);
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function AssignedTaskTrashlistByProj($pid)
	{
		$this->db->order_by('tid', 'DESC');
		$this->db->group_start();
    	$this->db->where('tcreated_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('tassignee', $this->session->userdata('d168_id'));
    	$this->db->group_end();
    	$this->db->where('t.reg_acc_status !=','deactivated');
		$this->db->where('trash', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$this->db->where('tproject_assign', $pid);
		$this->db->select('*');
		$this->db->from('registration as r');
		$this->db->join('task as t','t.tassignee = r.reg_id');
		$query = $this->db->get();
		return $query->result();
	}

	function AssignedSubtasklistByProj($pid)
	{
		$this->db->order_by('stid', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('stassignee', $this->session->userdata('d168_id'));
		$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$this->db->where('stproject_assign', $pid);
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function AssignedSubtaskTrashlistByProj($pid)
	{
		$this->db->order_by('stid', 'DESC');
		$this->db->group_start();
    	$this->db->where('stcreated_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('stassignee', $this->session->userdata('d168_id'));
    	$this->db->group_end();
    	$this->db->where('st.reg_acc_status !=','deactivated');
		$this->db->where('strash', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$this->db->where('stproject_assign', $pid);
		$this->db->select('*');
		$this->db->from('registration as r');
		$this->db->join('subtask as st','st.stassignee = r.reg_id');
		$query = $this->db->get();
		return $query->result();
	}

	function TodayTasksByProj($today,$pid)
	{
		$this->db->order_by('tid', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('tdue_date', $today);
		$this->db->where('tassignee', $this->session->userdata('d168_id'));
		$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$this->db->where('tproject_assign', $pid);
		$query = $this->db->get('task');
		return $query->result();
	}

	function TodaySubtasklist_TaskByProj($today,$pid)
	{
		$this->db->group_by('tid');
		$this->db->order_by('stid', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('stdue_date', $today);
		$this->db->where('stassignee', $this->session->userdata('d168_id'));
		$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$this->db->where('stproject_assign', $pid);
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function TodayTasksTrashlistByProj($today,$pid)
	{
		$this->db->order_by('tid', 'DESC');
		$this->db->where('tdue_date', $today);
		$this->db->group_start();
    	$this->db->where('tcreated_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('tassignee', $this->session->userdata('d168_id'));
    	$this->db->group_end();
    	$this->db->where('t.reg_acc_status !=','deactivated');
		$this->db->where('trash', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$this->db->where('tproject_assign', $pid);
		$this->db->select('*');
		$this->db->from('registration as r');
		$this->db->join('task as t','t.tassignee = r.reg_id');
		$query = $this->db->get();
		return $query->result();
	}

	function TodaySubtasksByProj($today,$pid)
	{
		$this->db->order_by('stid', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('stdue_date', $today);
		$this->db->where('stassignee', $this->session->userdata('d168_id'));
		$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$this->db->where('stproject_assign', $pid);
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function TodaySubtasksTrashlistByProj($today,$pid)
	{
		$this->db->order_by('stid', 'DESC');
		$this->db->where('stdue_date', $today);
		$this->db->group_start();
    	$this->db->where('stcreated_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('stassignee', $this->session->userdata('d168_id'));
    	$this->db->group_end();
    	$this->db->where('st.reg_acc_status !=','deactivated');
		$this->db->where('strash', 'yes');
		$this->db->where('stproject_assign', $pid);
		$this->db->select('*');
		$this->db->from('registration as r');
		$this->db->join('subtask as st','st.stassignee = r.reg_id');
		$query = $this->db->get();
		return $query->result();
	}

	function WeekTasksByProj($FirstDay,$LastDay,$pid)
	{
		$query = $this->db->query("SELECT * from task where tproject_assign = '".$pid."' and tassignee = '".$this->session->userdata('d168_id')."' and trash != 'yes' and task_archive != 'yes' and task_file_it != 'yes' and tdue_date BETWEEN '".$FirstDay."' and '".$LastDay."' and reg_acc_status != 'deactivated' ORDER BY tid DESC");
        return $query->result();
	}

	function WeekSubtaskslist_TaskByProj($FirstDay,$LastDay,$pid)
	{
		$query = $this->db->query("SELECT * from subtask where stproject_assign = '".$pid."' and stassignee = '".$this->session->userdata('d168_id')."' and strash != 'yes' and subtask_archive != 'yes' and subtask_file_it != 'yes' and stdue_date BETWEEN '".$FirstDay."' and '".$LastDay."' and reg_acc_status != 'deactivated' GROUP BY tid ORDER BY stid DESC");
        return $query->result();
	}

	function WeekTasksTrashlistByProj($FirstDay,$LastDay,$pid)
	{
		$query = $this->db->query("SELECT * FROM `registration` as `r` JOIN `task` as `t` ON `t`.`tassignee` = `r`.`reg_id` where tproject_assign = '".$pid."' and (tcreated_by = '".$this->session->userdata('d168_id')."' or tassignee = '".$this->session->userdata('d168_id')."') and trash = 'yes' and t.reg_acc_status != 'deactivated' and tdue_date BETWEEN '".$FirstDay."' and '".$LastDay."' ORDER BY tid DESC");
        return $query->result();
	}

	function WeekSubtasksByProj($FirstDay,$LastDay,$pid)
	{
		$query = $this->db->query("SELECT * from subtask where stproject_assign = '".$pid."' and stassignee = '".$this->session->userdata('d168_id')."' and strash != 'yes' and subtask_archive != 'yes' and subtask_file_it != 'yes' and stdue_date BETWEEN '".$FirstDay."' and '".$LastDay."' and reg_acc_status != 'deactivated' ORDER BY stid DESC");
        return $query->result();
	}

	function WeekSubtasksTrashlistByProj($FirstDay,$LastDay,$pid)
	{
		$query = $this->db->query("SELECT * FROM `registration` as `r` JOIN `subtask` as `st` ON `st`.`stassignee` = `r`.`reg_id` where stproject_assign = '".$pid."' and (stcreated_by = '".$this->session->userdata('d168_id')."' or stassignee = '".$this->session->userdata('d168_id')."') and strash = 'yes' and stdue_date BETWEEN '".$FirstDay."' and '".$LastDay."' and st.reg_acc_status != 'deactivated' ORDER BY stid DESC");
        return $query->result();
	}

	function getTaskSubtaskToCheck($tid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('strash !=','yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
    	$this->db->where('tid',$tid);
    	$query = $this->db->get('subtask');
    	return $query->num_rows();
    }

    function getTaskSubtaskToCheckList($tid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('strash !=','yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
    	$this->db->where('tid',$tid);
    	$query = $this->db->get('subtask');
    	return $query->result();
    }

    function check_t_avail($pid)
	{
		$this->db->order_by('tid', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('tproject_assign', $pid);
		$this->db->where('tassignee', $this->session->userdata('d168_id'));
		$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$query = $this->db->get('task');
		return $query->num_rows();
	}

	function check_st_avail($pid)
	{
		$this->db->order_by('stid', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('stproject_assign', $pid);
		$this->db->where('stassignee', $this->session->userdata('d168_id'));
		$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$query = $this->db->get('subtask');
		return $query->num_rows();
	}

	function check_t_avail2($pid)
	{
		$this->db->order_by('tid', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('tproject_assign', $pid);
		//$this->db->where('tassignee', $this->session->userdata('d168_id'));
		$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$query = $this->db->get('task');
		return $query->num_rows();
	}

	function check_st_avail2($pid)
	{
		$this->db->order_by('stid', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('stproject_assign', $pid);
		//$this->db->where('stassignee', $this->session->userdata('d168_id'));
		$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$query = $this->db->get('subtask');
		return $query->num_rows();
	}

	function check_today_t_avail($pid,$today)
	{
		$this->db->order_by('tid', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('tdue_date', $today);
		$this->db->where('tproject_assign', $pid);
		$this->db->where('tassignee', $this->session->userdata('d168_id'));
		$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$query = $this->db->get('task');
		return $query->num_rows();
	}

	function check_today_st_avail($pid,$today)
	{
		$this->db->order_by('stid', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('stdue_date', $today);
		$this->db->where('stproject_assign', $pid);
		$this->db->where('stassignee', $this->session->userdata('d168_id'));
		$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$query = $this->db->get('subtask');
		return $query->num_rows();
	}

	function check_week_t_avail($pid,$FirstDay,$LastDay)
	{
		$query = $this->db->query("SELECT * FROM `task` where tproject_assign = '".$pid."' and tassignee = '".$this->session->userdata('d168_id')."' and trash != 'yes' and task_archive != 'yes' and task_file_it != 'yes' and tdue_date BETWEEN '".$FirstDay."' and '".$LastDay."' and reg_acc_status != 'deactivated' ORDER BY tid DESC");
        return $query->num_rows();
	}

	function check_week_st_avail($pid,$FirstDay,$LastDay)
	{
		$query = $this->db->query("SELECT * FROM `subtask` where stproject_assign = '".$pid."' and stassignee = '".$this->session->userdata('d168_id')."' and strash != 'yes' and subtask_archive != 'yes' and subtask_file_it != 'yes' and stdue_date BETWEEN '".$FirstDay."' and '".$LastDay."' and reg_acc_status != 'deactivated' ORDER BY stid DESC");
        return $query->num_rows();
	}

	function getTaskWEEKSubtaskToCheckList($tid,$FirstDay,$LastDay)
	{
		$query = $this->db->query("SELECT * from subtask where tid = '".$tid."' and strash != 'yes' and subtask_archive != 'yes' and subtask_file_it != 'yes' and stdue_date BETWEEN '".$FirstDay."' and '".$LastDay."' and reg_acc_status != 'deactivated' ORDER BY stid DESC");
        return $query->result();
	}

	function getTaskTODAYSubtaskToCheckList($tid,$today)
	{
		$this->db->order_by('stid', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('tid', $tid);
		$this->db->where('stdue_date', $today);
		$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function MentionList($pid)
	{
		$this->db->order_by('r.first_name', 'ASC');
		$this->db->select('CONCAT_WS(" ", r.first_name,r.last_name) AS name');
		$this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->where('status', 'accepted');
		$this->db->where('pid', $pid);
		$this->db->where('pm.ptrash !=', 'yes');
		$this->db->where('pm.project_archive !=', 'yes');
		$this->db->where('pm.project_file_it !=', 'yes');
		$this->db->from('project_members as pm');
        $this->db->join('registration as r', 'r.reg_id = pm.pmember');
        $query = $this->db->get();
		return $query->result();
	}

	function MentionListforAccepted($pid)
	{
		$this->db->order_by('r.first_name', 'ASC');
		$this->db->select('CONCAT_WS(" ", r.first_name,r.last_name) AS name');
		$this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->where('status', 'accepted');
		$this->db->where('pmember !=',$this->session->userdata('d168_id'));
		$this->db->where('pid', $pid);
		$this->db->where('pm.ptrash !=', 'yes');
		$this->db->where('pm.project_archive !=', 'yes');
		$this->db->where('pm.project_file_it !=', 'yes');
		$this->db->from('project_members as pm');
        $this->db->join('registration as r', 'r.reg_id = pm.pmember');
        $query = $this->db->get();
		return $query->result();
	}

	function ProjectComment_clear($pid)
    {
        $this->db->order_by('c.cid','DESC');
        $this->db->where('c.reg_acc_status !=','deactivated');
        $this->db->where('c.delete_msg','');
        $this->db->where('c.project_id', $pid);
        $this->db->where('p.project_archive', '');
        $this->db->where('p.project_file_it', '');
        $this->db->where('p.ptrash', '');
        $this->db->where('c.c_notify_clear !=','');
        $this->db->from('comments as c');
        $this->db->join('project as p', 'p.pid = c.project_id');
        $query = $this->db->get();
        return $query->result();
    }

    function ProjectComment($pid)
    {
        $this->db->order_by('c.cid','DESC');
        $this->db->where('c.reg_acc_status !=','deactivated');
        $this->db->where('c.delete_msg','');
        $this->db->where('c.project_id', $pid);
        $this->db->where('p.project_archive', '');
        $this->db->where('p.project_file_it', '');
        $this->db->where('p.ptrash', '');
        $this->db->where('c.c_notify !=','');
        $this->db->from('comments as c');
        $this->db->join('project as p', 'p.pid = c.project_id');
        $query = $this->db->get();
        return $query->result();
    }

    function update_CommentbyCid($data,$cid)
	{
		$this->db->where('cid', $cid);
		if($this->db->update('comments',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function get_projectcommentbySessID()
    {
    	$this->db->where('reg_acc_status !=','deactivated');
        $this->db->where('delete_msg','');
    	$this->db->where('c_notify_clear !=','');
        $query = $this->db->get('comments');
        return $query->result();
    }

    function ProjectListByPortfolioContent($get_port_id)
	{
		$this->db->order_by('p_publish', 'ASC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('ptype', 'content');
		$this->db->where('portfolio_id', $get_port_id);
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$this->db->where('pcreated_by', $this->session->userdata('d168_id'));
		$query = $this->db->get('project');
		return $query->result();
	}

	function AcceptedProjectListByPortfolioContent($get_port_id)
	{
		$this->db->order_by('p_publish', 'ASC');
		$this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->where('ptype', 'content');
		$this->db->where('p.portfolio_id', $get_port_id);
		$this->db->where('p.ptrash !=', 'yes');
		$this->db->where('p.project_archive !=', 'yes');
		$this->db->where('p.project_file_it !=', 'yes');
		$this->db->where('pm.status', 'accepted');
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');
        $this->db->from('project as p');
        $this->db->join('project_members as pm','pm.pid = p.pid');
        $query = $this->db->get();
        return $query->result();
	}

	function PendingProjectListByPortfolioContent($get_port_id)
	{
		$this->db->order_by('p_publish', 'ASC');
		$this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->where('ptype', 'content');
		$this->db->where('p.portfolio_id', $get_port_id);
		$this->db->where('p.ptrash', '');
		$this->db->where('p.project_archive', '');
		$this->db->where('p.project_file_it', '');
		$this->db->where('pm.status', 'send');
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');
        $this->db->from('project as p');
        $this->db->join('project_members as pm','pm.pid = p.pid');
        $query = $this->db->get();
        return $query->result();
	}

	function ReadMoreProjectListByPortfolioContent($get_port_id)
	{
		$this->db->order_by('p_publish', 'ASC');
		$this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->where('ptype', 'content');
		$this->db->where('p.portfolio_id', $get_port_id);
		$this->db->where('p.ptrash !=', 'yes');
		$this->db->where('p.project_archive !=', 'yes');
		$this->db->where('p.project_file_it !=', 'yes');
		$this->db->where('pm.status', 'read_more');
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');
        $this->db->from('project as p');
        $this->db->join('project_members as pm','pm.pid = p.pid');
        $query = $this->db->get();
        return $query->result();
	}

	function check_pro_to_content($pid)
	{
		$this->db->order_by('pid', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('regularproj_to_contentproj', $pid);
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
    	$query = $this->db->get('project');
    	return $query->row();
	}

	function check_content_to_pro($pid)
	{
		$this->db->order_by('pid', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('pid', $pid);
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
    	$query = $this->db->get('project');
    	return $query->row();
	}

	function ProjectListRegular()
    {
        $this->db->order_by('portfolio_id', 'DESC');
        $this->db->where('reg_acc_status !=','deactivated');
        $this->db->group_start();
		$this->db->where('ptype', 'regular');
		$this->db->or_where('ptype', 'goal_strategy');
		$this->db->group_end();
        $this->db->where('ptrash !=', 'yes');
        $this->db->where('project_archive !=', 'yes');
        $this->db->where('project_file_it !=', 'yes');
        $this->db->where('pcreated_by', $this->session->userdata('d168_id'));
        $query = $this->db->get('project');
        return $query->result();
    }

    function AcceptedProjectListRegular()
    {
        $this->db->order_by('p.portfolio_id', 'DESC');
        $this->db->where('pm.reg_acc_status !=','deactivated');
        $this->db->group_start();
		$this->db->where('p.ptype', 'regular');
		$this->db->or_where('p.ptype', 'goal_strategy');
		$this->db->group_end();
        $this->db->where('p.ptrash !=', 'yes');
        $this->db->where('p.project_archive !=', 'yes');
        $this->db->where('p.project_file_it !=', 'yes');
        $this->db->where('pm.status', 'accepted');
        $this->db->where('pm.pmember', $this->session->userdata('d168_id'));
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');
        $this->db->from('project as p');
        $this->db->join('project_members as pm','pm.pid = p.pid');
        $query = $this->db->get();
        return $query->result();
    }

    function PendingProjectListRegular()
    {
        $this->db->order_by('p.portfolio_id', 'DESC');
        $this->db->where('pm.reg_acc_status !=','deactivated');
        $this->db->group_start();
		$this->db->where('p.ptype', 'regular');
		$this->db->or_where('p.ptype', 'goal_strategy');
		$this->db->group_end();
        $this->db->where('p.ptrash', '');
        $this->db->where('p.project_archive', '');
        $this->db->where('p.project_file_it', '');
        $this->db->where('pm.status', 'send');
        $this->db->where('pm.pmember', $this->session->userdata('d168_id'));
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');
        $this->db->from('project as p');
        $this->db->join('project_members as pm','pm.pid = p.pid');
        $query = $this->db->get();
        return $query->result();
    }

    function ReadMoreProjectListRegular()
    {
        $this->db->order_by('p.portfolio_id', 'DESC');
        $this->db->where('pm.reg_acc_status !=','deactivated');
        $this->db->group_start();
		$this->db->where('p.ptype', 'regular');
		$this->db->or_where('p.ptype', 'goal_strategy');
		$this->db->group_end();
        $this->db->where('p.ptrash !=', 'yes');
        $this->db->where('p.project_archive !=', 'yes');
        $this->db->where('p.project_file_it !=', 'yes');
        $this->db->where('pm.status', 'read_more');
        $this->db->where('pm.pmember', $this->session->userdata('d168_id'));
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');
        $this->db->from('project as p');
        $this->db->join('project_members as pm','pm.pid = p.pid');
        $query = $this->db->get();
        return $query->result();
    }

    function portfolio_projectsRegular($c_id)
    {
        $this->db->order_by('pid','DESC');
        $this->db->where('reg_acc_status !=','deactivated');
        $this->db->group_start();
		$this->db->where('ptype', 'regular');
		$this->db->or_where('ptype', 'goal_strategy');
		$this->db->group_end();
        $this->db->where('portfolio_id',$c_id);
        $this->db->where('project_archive !=','yes');
        $this->db->where('project_file_it !=','yes');
        $this->db->where('ptrash !=','yes');
        $query = $this->db->get('project');
        return $query->result();
    }

    function ProjectListContent()
    {
        $this->db->order_by('portfolio_id', 'DESC');
        $this->db->where('reg_acc_status !=','deactivated');
        $this->db->where('ptype', 'content');
        $this->db->where('ptrash !=', 'yes');
        $this->db->where('project_archive !=', 'yes');
        $this->db->where('project_file_it !=', 'yes');
        $this->db->where('pcreated_by', $this->session->userdata('d168_id'));
        $query = $this->db->get('project');
        return $query->result();
    }

    function AcceptedProjectListContent()
    {
        $this->db->order_by('p.portfolio_id', 'DESC');
        $this->db->where('pm.reg_acc_status !=','deactivated');
        $this->db->where('p.ptype', 'content');
        $this->db->where('p.ptrash !=', 'yes');
        $this->db->where('p.project_archive !=', 'yes');
        $this->db->where('p.project_file_it !=', 'yes');
        $this->db->where('pm.status', 'accepted');
        $this->db->where('pm.pmember', $this->session->userdata('d168_id'));
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');
        $this->db->from('project as p');
        $this->db->join('project_members as pm','pm.pid = p.pid');
        $query = $this->db->get();
        return $query->result();
    }

    function PendingProjectListContent()
    {
        $this->db->order_by('p.portfolio_id', 'DESC');
        $this->db->where('pm.reg_acc_status !=','deactivated');
        $this->db->where('p.ptype', 'content');
        $this->db->where('p.ptrash', '');
        $this->db->where('p.project_archive', '');
        $this->db->where('p.project_file_it', '');
        $this->db->where('pm.status', 'send');
        $this->db->where('pm.pmember', $this->session->userdata('d168_id'));
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');
        $this->db->from('project as p');
        $this->db->join('project_members as pm','pm.pid = p.pid');
        $query = $this->db->get();
        return $query->result();
    }

    function ReadMoreProjectListContent()
    {
        $this->db->order_by('p.portfolio_id', 'DESC');
        $this->db->where('pm.reg_acc_status !=','deactivated');
        $this->db->where('p.ptype', 'content');
        $this->db->where('p.ptrash !=', 'yes');
        $this->db->where('p.project_archive !=', 'yes');
        $this->db->where('p.project_file_it !=', 'yes');
        $this->db->where('pm.status', 'read_more');
        $this->db->where('pm.pmember', $this->session->userdata('d168_id'));
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');
        $this->db->from('project as p');
        $this->db->join('project_members as pm','pm.pid = p.pid');
        $query = $this->db->get();
        return $query->result();
    }

    function portfolio_projectsContent($c_id)
    {
        $this->db->order_by('pid','DESC');
        $this->db->where('reg_acc_status !=','deactivated');
        $this->db->where('ptype','content');
        $this->db->where('portfolio_id',$c_id);
        $this->db->where('project_archive !=','yes');
        $this->db->where('project_file_it !=','yes');
        $this->db->where('ptrash !=','yes');
        $query = $this->db->get('project');
        return $query->result();
    }

    function check_content_request_user($pid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
        $this->db->where('pmember', $this->session->userdata('d168_id'));
        $this->db->where('pid',$pid);
        $this->db->where('project_archive !=','yes');
        $this->db->where('project_file_it !=','yes');
        $this->db->where('ptrash !=','yes');
        $query = $this->db->get('project_members');
        return $query->row();
    }

    function check_user_request($pid,$member_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
        $this->db->where('pmember', $member_id);
        $this->db->where('pid',$pid);
        $this->db->where('project_archive !=','yes');
        $this->db->where('project_file_it !=','yes');
        $this->db->where('ptrash !=','yes');
        $query = $this->db->get('project_members');
        return $query->num_rows();
    }

    function ProjectListbyPortCookie($port_id)
	{
		$this->db->order_by('portfolio_id', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_id', $port_id);
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$this->db->where('pcreated_by', $this->session->userdata('d168_id'));
		$query = $this->db->get('project');
		return $query->result();
	}

	function AcceptedProjectListbyPortCookie($port_id)
	{
		$this->db->order_by('p.portfolio_id', 'DESC');
		$this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->where('p.portfolio_id', $port_id);
		$this->db->where('p.ptrash !=', 'yes');
		$this->db->where('p.project_archive !=', 'yes');
		$this->db->where('p.project_file_it !=', 'yes');
		$this->db->where('pm.status', 'accepted');
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');
        $this->db->from('project as p');
        $this->db->join('project_members as pm','pm.pid = p.pid');
        $query = $this->db->get();
        return $query->result();
	}

	function getPackDetail($pack_id)
	{
		//$this->db->where('pack_status', 'active');
		$this->db->where('pack_id', $pack_id);
		$query = $this->db->get('pricing');
		return $query->row();
	}

	function getPortfolioCount()
	{
		$query = $this->db->query("SELECT COUNT(*) as portfolio_count_rows FROM project_portfolio where portfolio_createdby='".$this->session->userdata('d168_id')."' and portfolio_trash = '' and portfolio_archive = '' and portfolio_file_it = '' and reg_acc_status != 'deactivated'");
		return $query->row_array();
	}

	function getProjectCount($port_id)
	{
		$query = $this->db->query("SELECT COUNT(*) as project_count_rows FROM project where pcreated_by='".$this->session->userdata('d168_id')."'  and ptrash = '' and project_archive = '' and project_file_it = '' and portfolio_id = '".$port_id."' and (ptype = 'regular' or ptype = 'goal_strategy') and reg_acc_status != 'deactivated'");
		return $query->row_array();
	}

	function getTaskCount($port_id)
	{
		$query = $this->db->query("SELECT COUNT(*) as task_count_rows FROM task where tcreated_by='".$this->session->userdata('d168_id')."' and trash = '' and task_archive = '' and task_file_it = '' and portfolio_id = '".$port_id."' and reg_acc_status != 'deactivated'");
		return $query->row_array();
	}

	function getContentProjectCount()
	{
		$query = $this->db->query("SELECT COUNT(*) as content_count_rows FROM project where pcreated_by='".$this->session->userdata('d168_id')."' and ptype='content' and reg_acc_status != 'deactivated'");
		return $query->row_array();
	}

	function getPortfolioMemberCount($portfolio_id)
	{
		$query = $this->db->query("SELECT COUNT(*) as portfolio_member_count_rows FROM project_portfolio_member where sent_from='".$this->session->userdata('d168_id')."'  and portfolio_id='".$portfolio_id."' and reg_acc_status != 'deactivated'");
		return $query->row_array();
	}

	function getProject_TaskCount($pid)
	{
		$query = $this->db->query("SELECT COUNT(*) as task_count_rows FROM task where tcreated_by='".$this->session->userdata('d168_id')."' and tproject_assign = '".$pid."' and reg_acc_status != 'deactivated'");
		return $query->row_array();
	}

	function getMonthWiseContent($current_month,$current_year,$port_id)
	{
		$query = $this->db->query("SELECT COUNT(*) as content_count_rows FROM project where pcreated_by='".$this->session->userdata('d168_id')."' and ptype='content' and month(pcreated_date)='".$current_month."'  and year(pcreated_date)='".$current_year."' and ptrash = '' and project_archive = '' and project_file_it = '' and portfolio_id = '".$port_id."' and reg_acc_status != 'deactivated'");
		return $query->row_array();
	}

	function getAllPack()
	{
		$this->db->group_start();
		$this->db->where('custom_pack', 'no');
    	$this->db->or_where('custom_reg_id', $this->session->userdata('d168_id'));
    	$this->db->group_end();
		$this->db->where('coupon_pack', 'no');
		$this->db->where('pack_status', 'active');
		$query = $this->db->get('pricing');
		return $query->result();
	}

	function check_code($code)
	{		
		$query = $this->db->query("SELECT * FROM `pricing_pack_coupon` WHERE BINARY `code` = '".$code."' and `co_status` = 'active';");
		return $query->row();
	}

	function check_any_active_code()
	{
		$this->db->where('co_status', 'active');
		$query = $this->db->get('pricing_pack_coupon');
		return $query->num_rows();
	}

	function get_active_coupon_id()
	{
		$this->db->where('co_status', 'active');
		$query = $this->db->get('pricing_pack_coupon');
		return $query->result();
	}

	function users_active_coupon($co_id)
	{
		$query = $this->db->query("SELECT COUNT(*) as count_rows FROM registration where package_coupon_id='".$co_id."'");
		return $query->row_array();
	}

	function all_users_coupon()
	{
		$this->db->where('used_package_coupon_id !=', '');
		$this->db->where('verified', 'yes');
		$this->db->select('used_package_coupon_id');
		$query = $this->db->get('registration');
		return $query->result();
	}

	// function getMyCusPack()
	// {
	// 	$this->db->where('custom_reg_id', $this->session->userdata('d168_id'));
	// 	$this->db->where('custom_pack', 'yes');
	// 	$this->db->where('pack_status', 'active');
	// 	$query = $this->db->get('pricing');
	// 	return $query->result();
	// }

	function getPackDetailArray($pack_id)
	{
		//$this->db->where('pack_status', 'active');
		$this->db->where('pack_id', $pack_id);
		$query = $this->db->get('pricing');
		return $query->row_array();
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
    	$this->db->where('project_file_it','');
    	$query = $this->db->get('project');
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
    	$this->db->where('task_file_it','');
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
    	$this->db->where('subtask_file_it','');
    	$query = $this->db->get('subtask');
        return $query->result();
    }

    function CheckOpenTM($reg_id,$pid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('pmember', $reg_id);
    	$this->db->where('pid', $pid);
    	$this->db->where('ptrash','');
    	$this->db->where('project_archive','');
    	$this->db->where('project_file_it','');
    	$query = $this->db->get('project_members');
        return $query->row();
    }

    function getProjectOpenTM($reg_id,$portfolio_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('pmember', $reg_id);
    	$this->db->where('portfolio_id', $portfolio_id);
    	$this->db->where('ptrash','');
    	$this->db->where('project_archive','');
    	$this->db->where('project_file_it','');
    	$query = $this->db->get('project_members');
        return $query->result();
    }

    function getGoalOpenTM($reg_id,$portfolio_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('gmember', $reg_id);
    	$this->db->where('portfolio_id', $portfolio_id);
    	$this->db->where('g_trash','');
    	$this->db->where('g_archive','');
    	$this->db->where('g_file_it','');
    	$query = $this->db->get('goals_members');
        return $query->result();
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

	function check_if_tm($pid,$new_reg_id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('pmember', $new_reg_id);
    	$this->db->where('pid', $pid);
    	$query = $this->db->get('project_members');
        return $query->row();
	}

	function check_if_powner($pid,$new_reg_id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('pcreated_by', $new_reg_id);
    	$this->db->where('pid', $pid);
    	$query = $this->db->get('project');
        return $query->num_rows();
	}

	function check_if_tm2($pid,$new_reg_id)
	{
		$this->db->where('pmember', $new_reg_id);
    	$this->db->where('pid', $pid);
    	$query = $this->db->get('project_members');
        return $query->row();
	}

	function check_if_psm2($pid,$new_reg_id)
	{
		$this->db->where('suggest_id', $new_reg_id);
    	$this->db->where('pid', $pid);
    	$query = $this->db->get('project_suggested_members');
        return $query->row();
	}

	function delete_if_psm2($pid,$pmember)
	{
		//$this->db->where('pcreated_by', $this->session->userdata('d168_id'));
		$this->db->where('pid', $pid);
		$this->db->where('suggest_id', $pmember);
		if($this->db->delete('project_suggested_members'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}		
	}

	function check_if_prm2($pid,$new_reg_id)
	{
		$this->db->where('member', $new_reg_id);
    	$this->db->where('pid', $pid);
    	$query = $this->db->get('project_request_member');
        return $query->row();
	}

	function delete_if_prm2($pid,$pmember)
	{
		//$this->db->where('pcreated_by', $this->session->userdata('d168_id'));
		$this->db->where('pid', $pid);
		$this->db->where('member', $pmember);
		if($this->db->delete('project_request_member'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}		
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
    	$this->db->where('cp_file_it','');
    	$query = $this->db->get('content_planning');
        return $query->result();
    }

    function check_project_request_member_notify_clear()
    {
    	$this->db->where('pm.reg_acc_status !=','deactivated');
    	$this->db->where('p.project_archive', '');
    	$this->db->where('p.project_file_it', '');
    	$this->db->where('p.ptrash', '');
    	$this->db->where('pm.status','sent');
    	$this->db->where('pm.mreq_notify_clear','no');
    	$this->db->where('pm.mreq_notify','yes');
    	$this->db->group_start();
        $this->db->where('p.pcreated_by', $this->session->userdata('d168_id'));
        $this->db->or_where('p.pmanager', $this->session->userdata('d168_id'));
        $this->db->group_end();
		$this->db->from('project_request_member as pm');
		$this->db->join('project as p','p.pid = pm.pid');
		$this->db->join('registration as r','r.reg_id = pm.member');
		$query = $this->db->get();
        return $query->result();
    }

    function check_project_membership_req($req_id,$pid)
    {
    	$this->db->where('pm.reg_acc_status !=','deactivated');
    	$this->db->where('pm.req_id', $req_id);
    	$this->db->where('p.pid', $pid);
    	$this->db->where('p.project_archive', '');
    	$this->db->where('p.project_file_it', '');
    	$this->db->where('p.ptrash', '');
    	$this->db->where('pm.status','sent');
    	$this->db->where('pm.mreq_notify','yes');
        $this->db->group_start();
        $this->db->where('p.pcreated_by', $this->session->userdata('d168_id'));
        $this->db->or_where('p.pmanager', $this->session->userdata('d168_id'));
        $this->db->group_end();
		$this->db->from('project_request_member as pm');
		$this->db->join('project as p','p.pid = pm.pid');
		$this->db->join('registration as r','r.reg_id = pm.member');
		$query = $this->db->get();
        return $query->row();
    }

    function edit_project_membership_req_notify($data2,$req_id)
	{
		$this->db->where('req_id',$req_id);
		if($this->db->update('project_request_member',$data2))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function check_project_membership_req2($req_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('req_id', $req_id);
    	$query = $this->db->get('project_request_member');
        return $query->row();
    }

    function check_project_membership_notify($pid)
    {
    	$this->db->where('pm.reg_acc_status !=','deactivated');
    	$this->db->where('p.pid', $pid);
    	$this->db->where('pm.status','sent');
    	$this->db->where('pm.mreq_notify_clear','no');
    	$this->db->where('pm.mreq_notify','yes');
    	$this->db->group_start();
        $this->db->where('p.pcreated_by', $this->session->userdata('d168_id'));
        $this->db->or_where('p.pmanager', $this->session->userdata('d168_id'));
        $this->db->group_end();
		$this->db->from('project_request_member as pm');
		$this->db->join('project as p','p.pid = pm.pid');
		$query = $this->db->get();
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
    	$this->db->where('project_file_it','');
    	$query = $this->db->get('project_members');
        return $query->num_rows();
    }

    function AssignedTasklistDateFilter($port_id,$start_date,$end_date)
	{
		$query = $this->db->query("SELECT * from task where portfolio_id = '".$port_id."' and tassignee = '".$this->session->userdata('d168_id')."' and trash != 'yes' and task_archive != 'yes' and task_file_it != 'yes' and tdue_date BETWEEN '".$start_date."' and '".$end_date."' and reg_acc_status != 'deactivated' ORDER BY tid DESC");
        return $query->result();
	}

	function AssignedSubtasklist_TaskDateFilter($port_id,$start_date,$end_date)
	{
		$query = $this->db->query("SELECT * from subtask where portfolio_id = '".$port_id."' and stassignee = '".$this->session->userdata('d168_id')."' and strash != 'yes' and subtask_archive != 'yes' and subtask_file_it != 'yes' and stdue_date BETWEEN '".$start_date."' and '".$end_date."' and reg_acc_status != 'deactivated' GROUP BY tid ORDER BY stid DESC");
        return $query->result();
	}

	function AssignedSubtasklistDateFilter($port_id,$start_date,$end_date)
	{
		$query = $this->db->query("SELECT * from subtask where portfolio_id = '".$port_id."' and stassignee = '".$this->session->userdata('d168_id')."' and strash != 'yes' and subtask_archive != 'yes' and subtask_file_it != 'yes' and stdue_date BETWEEN '".$start_date."' and '".$end_date."' and reg_acc_status != 'deactivated' ORDER BY stid DESC");
        return $query->result();
	}

	function CreatedTaskListDateFilter($port_id,$start_date,$end_date)
  	{
    	$query = $this->db->query("SELECT * from task as t JOIN project_portfolio as pp ON pp.portfolio_id = t.portfolio_id where t.portfolio_id = '".$port_id."' and t.tcreated_by = '".$this->session->userdata('d168_id')."' and t.trash != 'yes' and t.task_archive != 'yes' and t.task_file_it != 'yes' and pp.portfolio_archive != 'yes' and pp.portfolio_file_it != 'yes' and t.tdue_date BETWEEN '".$start_date."' and '".$end_date."' and t.reg_acc_status != 'deactivated' ORDER BY t.tid DESC");
        return $query->result();
  	}

  	function CreatedSubTaskListDateFilter($port_id,$start_date,$end_date)
  	{
    	$query = $this->db->query("SELECT *,st.tid as s_tid,t.tid as t_id from subtask as st, task as t, project_portfolio as pp where t.tid = st.tid and pp.portfolio_id = st.portfolio_id and st.portfolio_id = '".$port_id."' and st.stcreated_by = '".$this->session->userdata('d168_id')."' and st.strash != 'yes' and st.strash != 'yes' and st.subtask_archive != 'yes' and st.subtask_file_it != 'yes' and pp.portfolio_archive != 'yes' and pp.portfolio_file_it != 'yes' and st.stdue_date BETWEEN '".$start_date."' and '".$end_date."'  and st.reg_acc_status != 'deactivated' GROUP BY st.tid ORDER BY st.stid DESC");
        return $query->result();
  	}

	function Check_Task_Subtasks2_date_range($tid,$start_date,$end_date)
	{
	    $query = $this->db->query("SELECT * from subtask where tid = '".$tid."' and strash != 'yes' and subtask_archive != 'yes' and subtask_file_it != 'yes' and stdue_date BETWEEN '".$start_date."' and '".$end_date."' and reg_acc_status != 'deactivated' ORDER BY stid DESC");
	        return $query->result();
	}

	function portfolio_tasksNewDateFilter($port_id,$start_date,$end_date)
  	{
    	$query = $this->db->query("SELECT * from task as t, registration as r, project as p where r.reg_id = t.tassignee and p.pid = t.tproject_assign and t.portfolio_id = '".$port_id."' and t.trash != 'yes' and t.task_archive != 'yes' and t.task_file_it != 'yes' and t.tdue_date BETWEEN '".$start_date."' and '".$end_date."' and t.reg_acc_status != 'deactivated' ORDER BY tid DESC");
        return $query->result();
  	}

  	function portfolio_subtasksNewDateFilter($port_id,$start_date,$end_date)
  	{
    	$query = $this->db->query("SELECT *,st.tid as s_tid,t.tid as t_id from subtask as st, task as t, project_portfolio as pp where t.tid = st.tid and pp.portfolio_id = st.portfolio_id and st.portfolio_id = '".$port_id."' and st.strash != 'yes' and st.subtask_archive != 'yes' and st.subtask_file_it != 'yes' and pp.portfolio_archive != 'yes' and pp.portfolio_file_it != 'yes' and st.stdue_date BETWEEN '".$start_date."' and '".$end_date."' and st.reg_acc_status != 'deactivated' GROUP BY st.tid ORDER BY st.stid DESC");
        return $query->result();
  	}

  	function getTasksbyID($tid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('tid',$tid);
		$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$query = $this->db->get('task');
		return $query->row();
	}

	function getSubtasksbyID($stid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('stid',$stid);
		$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$query = $this->db->get('subtask');
		return $query->row();
	}

	function All_AssignedTasklistDateFilter($start_date,$end_date)
	{
		$query = $this->db->query("SELECT * from task where tassignee = '".$this->session->userdata('d168_id')."' and trash != 'yes' and task_archive != 'yes' and task_file_it != 'yes' and tdue_date BETWEEN '".$start_date."' and '".$end_date."' and reg_acc_status != 'deactivated' ORDER BY tid DESC");
        return $query->result();
	}

	function All_AssignedSubtasklist_TaskDateFilter($start_date,$end_date)
	{
		$query = $this->db->query("SELECT * from subtask where stassignee = '".$this->session->userdata('d168_id')."' and strash != 'yes' and subtask_archive != 'yes' and subtask_file_it != 'yes' and stdue_date BETWEEN '".$start_date."' and '".$end_date."' and reg_acc_status != 'deactivated' GROUP BY tid ORDER BY stid DESC");
        return $query->result();
	}

	function All_AssignedSubtasklistDateFilter($start_date,$end_date)
	{
		$query = $this->db->query("SELECT * from subtask where stassignee = '".$this->session->userdata('d168_id')."' and strash != 'yes' and subtask_archive != 'yes' and subtask_file_it != 'yes' and stdue_date BETWEEN '".$start_date."' and '".$end_date."' and reg_acc_status != 'deactivated' ORDER BY stid DESC");
        return $query->result();
	}

	function project_tasks_listNewDateFilter($pid,$port_id,$start_date,$end_date)
  	{
    	$query = $this->db->query("SELECT * from task as t JOIN registration as r ON t.tassignee = r.reg_id where t.tproject_assign = '".$pid."' and t.portfolio_id = '".$port_id."' and t.trash != 'yes' and t.task_archive != 'yes' and t.task_file_it != 'yes' and t.tdue_date BETWEEN '".$start_date."' and '".$end_date."' and t.reg_acc_status != 'deactivated' ORDER BY t.tid DESC");
        return $query->result();
  	}

  	function project_subtasks_listNewDateFilter($pid,$port_id,$start_date,$end_date)
  	{
    	$query = $this->db->query("SELECT * from subtask as st JOIN registration as r ON st.stassignee = r.reg_id where st.stproject_assign = '".$pid."' and st.portfolio_id = '".$port_id."' and st.strash != 'yes' and st.subtask_archive != 'yes' and st.subtask_file_it != 'yes' and st.stdue_date BETWEEN '".$start_date."' and '".$end_date."' and st.reg_acc_status != 'deactivated' GROUP BY st.tid ORDER BY st.stid DESC");
        return $query->result();
  	}

  	function progress_done_date_range($pid,$start_date,$end_date)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM task where tproject_assign='".$pid."' and trash != 'yes' and task_archive != 'yes' and task_file_it != 'yes' and tstatus='done' and tdue_date BETWEEN '".$start_date."' and '".$end_date."' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function progress_total_date_range($pid,$start_date,$end_date)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM task where tproject_assign='".$pid."' and trash != 'yes' and task_archive != 'yes' and task_file_it != 'yes' and tdue_date BETWEEN '".$start_date."' and '".$end_date."' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function sub_progress_done_date_range($pid,$start_date,$end_date)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM subtask where stproject_assign='".$pid."' and strash != 'yes' and subtask_archive != 'yes' and subtask_file_it != 'yes' and ststatus='done' and stdue_date BETWEEN '".$start_date."' and '".$end_date."' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function sub_progress_total_date_range($pid,$start_date,$end_date)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM subtask where stproject_assign='".$pid."' and strash != 'yes' and subtask_archive != 'yes' and subtask_file_it != 'yes' and stdue_date BETWEEN '".$start_date."' and '".$end_date."' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function team_member_tasks_listNewDateFilter($pid,$port_id,$tassignee,$start_date,$end_date)
  	{
    	$query = $this->db->query("SELECT * from task as t JOIN registration as r ON t.tassignee = r.reg_id where t.tproject_assign = '".$pid."' and t.portfolio_id = '".$port_id."' and tassignee = '".$tassignee."' and t.trash != 'yes' and t.task_archive != 'yes' and t.task_file_it != 'yes' and t.tdue_date BETWEEN '".$start_date."' and '".$end_date."' and t.reg_acc_status != 'deactivated' ORDER BY t.tid DESC");
        return $query->result();
  	}

  	function team_member_subtasks_listNewDateFilter($pid,$port_id,$tassignee,$start_date,$end_date)
  	{
    	$query = $this->db->query("SELECT *,st.tid as s_tid from subtask as st JOIN registration as r ON st.stassignee = r.reg_id where st.stproject_assign = '".$pid."' and st.portfolio_id = '".$port_id."' and st.stassignee = '".$tassignee."' and st.strash != 'yes' and st.subtask_archive != 'yes' and st.subtask_file_it != 'yes' and st.stdue_date BETWEEN '".$start_date."' and '".$end_date."' and st.reg_acc_status != 'deactivated' GROUP BY st.tid ORDER BY st.stid DESC");
        return $query->result();
  	}

  	function progress_done3_date_range($pid,$tassignee,$start_date,$end_date)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM task where tassignee='".$tassignee."' and trash != 'yes' and task_archive != 'yes' and task_file_it != 'yes' and tproject_assign ='".$pid."' and tstatus='done' and tdue_date BETWEEN '".$start_date."' and '".$end_date."' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function progress_total3_date_range($pid,$tassignee,$start_date,$end_date)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM task where tassignee='".$tassignee."' and trash != 'yes' and task_archive != 'yes' and task_file_it != 'yes' and tproject_assign ='".$pid."' and tdue_date BETWEEN '".$start_date."' and '".$end_date."' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function sub_progress_done3_date_range($pid,$tassignee,$start_date,$end_date)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM subtask where stassignee='".$tassignee."' and strash != 'yes' and subtask_archive != 'yes' and subtask_file_it != 'yes' and stproject_assign ='".$pid."' and ststatus='done' and stdue_date BETWEEN '".$start_date."' and '".$end_date."' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function sub_progress_total3_date_range($pid,$tassignee,$start_date,$end_date)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM subtask where stassignee='".$tassignee."' and strash != 'yes' and subtask_archive != 'yes' and subtask_file_it != 'yes' and stproject_assign ='".$pid."' and stdue_date BETWEEN '".$start_date."' and '".$end_date."' and reg_acc_status != 'deactivated'");
        return $query->row_array();
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

	function ad_logo()
    {
    	$query = $this->db->query("SELECT * FROM `ad_logo` WHERE status = 'approved' and reg_acc_status != 'deactivated' ORDER BY rand() LIMIT 1;");
        return $query->row();
    }

    function getAllRegisteredUserBday()
	{
		$this->db->where('dob !=', '0000-00-00');
		$this->db->where('verified', 'yes');
		$query = $this->db->get('registration');
		return $query->result();
	}

	function getAllRegisteredUser()
	{
		//$this->db->where('verified', 'yes');
		$query = $this->db->get('registration');
		return $query->result();
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

	function check_getPortfolio_Owner($id)
    {
    	$this->db->where('portfolio_id', $id);
    	$query = $this->db->get('project_portfolio');
    	return $query->row();
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

	function updateCP_Proj($data,$id)
	{
		$this->db->where('pc_project_assign',$id);
		$this->db->update('content_planning',$data);
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

	function updateProjectManager($data,$id)
	{
		$this->db->where('pmanager',$id);
		$this->db->update('project',$data);
	}

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

	function deleteOnlyTaskSubtask($id)
	{
		$this->db->where('tid',$id);
		$this->db->delete('subtask');
	}

	function deleteTaskSubtask_trash($id)
	{
		$this->db->where('tid',$id);
		$this->db->delete('subtask_trash');
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

	function deleteOnlySubtask($id)
	{
		$this->db->where('stid',$id);
		$this->db->delete('subtask');
	}

	function deleteSubtask_trash($id)
	{
		$this->db->where('stid',$id);
		$this->db->delete('subtask_trash');
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

	function deleteOnlyCP($id)
	{
		$this->db->where('pc_id',$id);
		$this->db->delete('content_planning');
	}

	function deletecontent_planning_trash($id)
	{
		$this->db->where('pc_id',$id);
		$this->db->delete('content_planning_trash');
	}

	function deleteRegistration($id)
	{
		$this->db->where('reg_id',$id);
		$this->db->delete('registration');
	}

	//////Calendar Part Start///////

	function getActiveEvents($id)
	{
		$this->db->where('student_id', $id);
		$this->db->where('status', 'active');
		$this->db->order_by('event_start_date DESC, event_start_time DESC, id DESC');
		$query = $this->db->get('events');
		return $query->result();
	}

	function getDraggableEvents($id)
	{
		$this->db->order_by('id', 'DESC');
		$this->db->where('student_id', $id);
		$this->db->where('show_draggable_event', 1);
		$this->db->where('status', 'active');
		$query = $this->db->get('draggable_events');
		return $query->result();
	}

	function gettime_24hrs()
	{
		$this->db->where('status', 'active');
		$this->db->order_by('id', 'asc');
		$query = $this->db->get('time_24hours');
		return $query->result();
	}

	function gettime_12hrs()
	{
		$this->db->where('status', 'active');
		$this->db->order_by('id', 'asc');
		$query = $this->db->get('time_12hours');
		return $query->result();
	}

	function getDraggableEventsCount($id,$event_name)
	{
		$this->db->where('student_id', $id);
		$this->db->where('event_name', $event_name);
		$this->db->where('show_draggable_event', 1);
		$this->db->where('status', 'active');
		$query = $this->db->get('draggable_events');
		return $query->num_rows();
	}

	function insertDraggableEvent($data){
		if($this->db->insert('draggable_events',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function getCalendarMonthEvents($id,$month_year)
	{
		$this->db->where('student_id', $id);
		$this->db->where('status', 'active');
		$this->db->group_start();
		$this->db->like('date_array', $month_year); 
		// $this->db->or_like('event_end_date', $month_year); 
		$this->db->group_end();
		$query = $this->db->get('events');
		return $query->result();
		
	}

	function getCalendarMonthMeetings($id,$month_year)
	{
		$this->db->group_start();
        $this->db->like('date_array', $month_year); 
        // $this->db->or_like('event_end_date', $month_year); 
        $this->db->group_end();
        $this->db->where('e.status', 'active');
        $this->db->where('em.status', 'accepted');
        $this->db->where('em.member', $id);
        $this->db->select('*');
        $this->db->from('events as e');
        $this->db->join('events_meeting as em','em.event_id = e.id');
        $query = $this->db->get();
        return $query->result();
	}

	function getDataByUniqueId($unique_key)
	{
		$this->db->where('unique_key', $unique_key);
		$query = $this->db->get('events');
		return $query->result();
	}

	function getDataIsLast($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('events');

		$this->db->where('unique_key', $query->row()->unique_key);
		$this->db->where('id >=',$id);
		$query_result = $this->db->get('events');
		return $query_result->result();
	}

	function getCalendarDlEvents($id,$day_list)
	{
		$this->db->where('student_id', $id);
		$this->db->where('status', 'active');
	    $this->db->group_start();
		$this->db->where('event_start_date', $day_list); 
		$this->db->or_like('event_start_date', date("Y-m", strtotime($day_list))); 
		$this->db->or_like('event_end_date', date("Y-m", strtotime($day_list))); 
		$this->db->group_end();
		$query = $this->db->get('events');
		return $query->result();
	}

	function getCalendarDlMeetings($id,$day_list)
	{
        $this->db->group_start();
        $this->db->where('event_start_date', $day_list); 
        $this->db->or_like('event_start_date', date("Y-m", strtotime($day_list))); 
        $this->db->or_like('event_end_date', date("Y-m", strtotime($day_list))); 
        $this->db->group_end();
        $this->db->where('e.status', 'active');
        $this->db->where('em.status', 'accepted');
        $this->db->where('em.member', $id);
        $this->db->select('*');
        $this->db->from('events as e');
        $this->db->join('events_meeting as em','em.event_id = e.id');
        $query = $this->db->get();
        return $query->result();
	}

	function getCalendarWeekEvents($student_id,$date1,$date2)
	{
		$d1=date("Y-m", strtotime($date1));
		$d2=date("Y-m", strtotime($date2));
		$this->db->where('student_id', $student_id);
		$this->db->where('status', 'active');
		$this->db->group_start();
		$this->db->where("event_start_date BETWEEN '$date1' AND '$date2'"); 
		$this->db->or_where("'$date1' BETWEEN event_start_date AND event_end_date"); 
		$this->db->or_where("'$date2' BETWEEN event_start_date AND event_end_date"); 
		$this->db->group_end();
		$query = $this->db->get('events');
		return $query->result();
	}

	function getCalendarWeekMeetings($student_id,$date1,$date2)
	{
        $d1=date("Y-m", strtotime($date1));
        $d2=date("Y-m", strtotime($date2));
        $this->db->group_start();
        $this->db->where("event_start_date BETWEEN '$date1' AND '$date2'"); 
        $this->db->or_where("'$date1' BETWEEN event_start_date AND event_end_date"); 
        $this->db->or_where("'$date2' BETWEEN event_start_date AND event_end_date"); 
        $this->db->group_end();
        $this->db->where('e.status', 'active');
        $this->db->where('em.status', 'accepted');
        $this->db->where('em.member', $student_id);
        $this->db->select('*');
        $this->db->from('events as e');
        $this->db->join('events_meeting as em','em.event_id = e.id');
        $query = $this->db->get();
        return $query->result();
	}

	function view_selected_event_info($id)
	{
		$this->db->where('id', $id);
		$event_data=$this->db->get('events');
		$this->db->where('unique_key', $event_data->row()->unique_key);
		$query = $this->db->get('events');
		return $query->result();
		
	}

	function view_selected_event_info_list($id)
	{
		$this->db->where('id', $id);
		// $event_data=$this->db->get('events');
		// $this->db->where('unique_key', $event_data->row()->unique_key);
		$query = $this->db->get('events');
		return $query->result();
		
	}

	function deleteEvent($id,$delete_check)
	{
		// $this->db->where('id', $id);
		// $this->db->delete('events');
		if($delete_check == 0){
			$this->db->where('id', $id);
			$query_result = $this->db->get('events');

			$this->db->where('id', $id);
			$this->db->delete('events');
			return $query_result->result();
		}else if($delete_check == 2){

			$this->db->where('id', $id);
			$query=$this->db->get('events');
			//// get data
			$this->db->where('unique_key', $query->row()->unique_key);
			$this->db->where('id >=',$id);
			$query_result = $this->db->get('events');
			//  end
			$this->db->where('unique_key', $query->row()->unique_key);
			$this->db->where('id >=',$id);
			$this->db->delete('events');
			return $query_result->result();
			
		}else{
			$this->db->where('id', $id);
			$query=$this->db->get('events');
			$this->db->where('unique_key', $query->row()->unique_key);
			$this->db->delete('events');
			return $query->result();
		}
		
	}

	function getEventData($id)
	{
		$this->db->where('id', $id);
		$event_data=$this->db->get('events');
		return $event_data->result();
	}

	function getEventDetail($id)
	{
		$this->db->where('id', $id);
		$query=$this->db->get('events');
		return $query->row();
	}

	function getEventDataFollowing($id)
	{
		$this->db->where('id', $id);
		$event_data=$this->db->get('events');
		$this->db->where('unique_key', $event_data->row()->unique_key);
		$this->db->where('id >=',$id);
		$query = $this->db->get('events');
		return $query->result();
	}

	function getDraggableEventById($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('draggable_events');
		return $query->row();
	}

	function updateDraggableEvent($data,$id)
	{
		$this->db->where('id', $id);
		$this->db->update('draggable_events',$data);
	}

	function deleteDraggableEvent($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('draggable_events');
	}

	function insertEvent($data)
	{
		if($this->db->insert('events',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
  	
  	function updateEvent($data,$id)
	{
		$this->db->where('id', $id);
		$this->db->update('events',$data);
	}
	
	function getAllEventsReminder()
	{
		$this->db->where('event_reminder_send', '');
		$this->db->where('event_reminder !=', 'No reminder');
		$this->db->where('status', 'active');
		$query = $this->db->get('events');
		return $query->result();
	}

	function getRemEventUser($id)
	{
		$this->db->where('reg_acc_status !=', 'deactivated');
		$this->db->where('verified', 'yes');
		$this->db->where('reg_id', $id);
		$query = $this->db->get('registration');
		return $query->row();
	}

	function getUserEventsReminder()
	{
		$this->db->where('student_id', $this->session->userdata('d168_id'));
		$this->db->where('in_app_reminder', '');
		$this->db->where('event_reminder !=', 'No reminder');
		$this->db->where('status', 'active');
		$query = $this->db->get('events');
		return $query->result();
	}

	function insert_eventsTodo($data)
	{
		if($this->db->insert('events_todo',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function getEventTodo($id,$event_id)
	{
		$this->db->where('student_id',$id);
		$this->db->where('event_id',$event_id);
		$this->db->where('status', 'active');
		$this->db->order_by('id','DESC');
		$query = $this->db->get('events_todo');
		return $query->result();
	}

	function getCompleteEventTodoCount($id,$event_id)
	{
		$this->db->where('student_id',$id);
		$this->db->where('event_id',$event_id);
		$this->db->where('is_completed', 'yes');
		$this->db->where('status', 'active');
		$query = $this->db->get('events_todo');
		return $query->num_rows();
	}

	function edit_events_todo($data,$id)
    {
    	$this->db->where('id', $id);
    	if($this->db->update('events_todo', $data))
    	{
    		return TRUE;
    	}
    	else
    	{
    		return FALSE;
    	}
    }

    function delete_events_todo($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('events_todo');
	}

    function getUserEventsInsideTodoReminder()
	{
		$this->db->order_by('id','DESC');
		$this->db->where('student_id', $this->session->userdata('d168_id'));
		$this->db->where('task_in_app_reminder', '');
		$this->db->where('task_reminder !=', 'No reminder');
		$this->db->where('status', 'active');
		$query = $this->db->get('events_todo');
		return $query->result();
	}

	function getAllEventsInsideTodoReminder()
	{
		$this->db->where('task_reminder_send', '');
		$this->db->where('task_reminder !=', 'No reminder');
		$this->db->where('status', 'active');
		$query = $this->db->get('events_todo');
		return $query->result();
	}

	function get_events($id)
	{
		$this->db->where('id', $id);
		$query=$this->db->get('events');
		return $query->row();
	}

	function get_events_series($id,$unique_key)
	{
		$this->db->where('id >=',$id);
		$this->db->where('unique_key', $unique_key);
		$query = $this->db->get('events');
		return $query->result();
	}

	function get_events_all_series($unique_key)
	{
		$this->db->where('unique_key', $unique_key);
		$query = $this->db->get('events');
		return $query->result();
	}

	// function update_events_todo_series($sql_q)
	// {
	// 	//echo "yes";
	// 	//print_r($sql_q);
 //      $cnt_sql_q = count($sql_q);
 //  //     echo $cnt_sql_q;
	// 	for($q_id=0; $q_id<$cnt_sql_q; $q_id++)
	//       {
	//         echo $sql_q[$cnt_sql_q];
	//       }

	// 	$this->db->trans_start();
	//       for($q_id=0; $q_id<$cnt_sql_q; $q_id++)
	//       {
	//         $this->db->query("UPDATE `events_todo` SET `event_id` = '627', `parent_event_id` = '627' WHERE `event_id` = '626'");
	//       }
	// 	$this->db->trans_complete(); 
	// 	if ($this->db->trans_status() === false) {
	// 	    //return FALSE;
	// 	    echo "no";
	// 	    $this->db->trans_rollback();
	// 	}
	// 	else
	// 	{
	// 		//return TRUE;
	// 		echo "yes";
	// 		$this->db->trans_commit();
	// 	}
	// }

	function deleteEventTodo($id,$delete_check)
	{
		if($delete_check == 0){
			$this->db->where('event_id', $id);
			$query_result = $this->db->get('events_todo');

			$this->db->where('event_id', $id);
			$this->db->delete('events_todo');
			return $query_result->result();
		}else if($delete_check == 2){

			$this->db->where('id', $id);
			$query=$this->db->get('events');
			//// get data
			$this->db->where('event_unique_key', $query->row()->unique_key);
			$this->db->where('event_id >=',$id);
			$query_result = $this->db->get('events_todo');
			//  end
			$this->db->where('event_unique_key', $query->row()->unique_key);
			$this->db->where('event_id >=',$id);
			$this->db->delete('events_todo');
			return $query_result->result();
			
		}else{
			$this->db->where('id', $id);
			$query=$this->db->get('events');
			$this->db->where('event_unique_key', $query->row()->unique_key);
			$this->db->delete('events_todo');
			return $query->result();
		}
		
	}

	function getEventTime($id)
	{
		$this->db->where('id', $id);
		$event_data=$this->db->get('events');
		return $event_data->row();
	}

	function getEventTimeUniqueKeyFirst($unique_key)
	{
		$this->db->order_by('id','ASC');
		$this->db->where('unique_key', $unique_key);
		$event_data=$this->db->get('events');
		return $event_data->row();
	}

	function getEventTimeUniqueKey($unique_key)
	{
		$this->db->order_by('id','DESC');
		$this->db->where('unique_key', $unique_key);
		$event_data=$this->db->get('events');
		return $event_data->row();
	}

	function gettime_12hrs_inside_todo($event_start_time,$event_end_time)
	{
		$query = $this->db->query("SELECT * from time_12hours where STR_TO_DATE(`time`, '%h:%i %p') BETWEEN '".$event_start_time."' and '".$event_end_time."' and status = 'active' ORDER BY id ASC");
        return $query->result();
	}

	function getEventSpecificTodo($id,$event_id)
	{
		$this->db->where('id',$id);
		$this->db->where('event_id',$event_id);
		$this->db->where('status', 'active');
		$query = $this->db->get('events_todo');
		return $query->row();
	}

	function getAll_NextEvents($today)
	{
		$query = $this->db->query("SELECT * from events where event_start_date >= '".$today."' and student_id = '".$this->session->userdata('d168_id')."' and status = 'active' and created_type = 'event' ORDER BY event_start_date ASC");
        return $query->result();
	}

	function getAll_PrevEvents($today)
	{
		$query = $this->db->query("SELECT * from events where event_start_date < '".$today."' and student_id = '".$this->session->userdata('d168_id')."' and status = 'active' and created_type = 'event' ORDER BY event_start_date ASC");
        return $query->result();
	}

	function getAll_NextTodos($today)
	{
		$query = $this->db->query("SELECT * from events where event_start_date >= '".$today."' and student_id = '".$this->session->userdata('d168_id')."' and status = 'active' and created_type = 'task' ORDER BY event_start_date ASC");
        return $query->result();
	}

	function getAll_PrevTodos($today)
	{
		$query = $this->db->query("SELECT * from events where event_start_date < '".$today."' and student_id = '".$this->session->userdata('d168_id')."' and status = 'active' and created_type = 'task' ORDER BY event_start_date ASC");
        return $query->result();
	}

	function getAll_NextReminders($today)
	{
		$query = $this->db->query("SELECT * from events where event_start_date >= '".$today."' and student_id = '".$this->session->userdata('d168_id')."' and status = 'active' and created_type = 'reminder' ORDER BY event_start_date ASC");
        return $query->result();
	}

	function getAll_PrevReminders($today)
	{
		$query = $this->db->query("SELECT * from events where event_start_date < '".$today."' and student_id = '".$this->session->userdata('d168_id')."' and status = 'active' and created_type = 'reminder' ORDER BY event_start_date ASC");
        return $query->result();
	}

	function view_selected_inside_todo_info_list($id)
	{
		$this->db->where('id',$id);
		$this->db->where('status', 'active');
		$this->db->order_by('id','DESC');
		$query = $this->db->get('events_todo');
		return $query->row();
	}

	function TodayCalEvents($today)
	{
		$query = $this->db->query("SELECT * from events where '".$today."' BETWEEN events.event_start_date and events.event_end_date and student_id = '".$this->session->userdata('d168_id')."' and status = 'active' and created_type != 'reminder' ORDER BY event_start_date ASC");
        return $query->result();
	}

	function WeekCalEvents($FirstDay,$LastDay)
	{
		$query = $this->db->query("SELECT * from events where student_id = '".$this->session->userdata('d168_id')."' and event_start_date BETWEEN '".$FirstDay."' and '".$LastDay."' and created_type != 'reminder' ORDER BY event_start_date ASC");
        return $query->result();
	}

	function TodayCalInsideTodo($today)
	{
		$query = $this->db->query("SELECT * from events_todo where task_start_date = '".$today."' and student_id = '".$this->session->userdata('d168_id')."' and status = 'active' ORDER BY task_start_date ASC");
        return $query->result();
	}

	function WeekCalInsideTodo($FirstDay,$LastDay)
	{
		$query = $this->db->query("SELECT * from events_todo where student_id = '".$this->session->userdata('d168_id')."' and task_start_date BETWEEN '".$FirstDay."' and '".$LastDay."' ORDER BY task_start_date ASC");
        return $query->result();
	}

	function insert_events_meeting($data)
    {
    	if($this->db->insert('events_meeting',$data))
    	{
    		return TRUE;
    	}
    	else
    	{
    		return FALSE;
    	}
    }

    function get_events_meeting($event_id)
	{
		$this->db->order_by('first_name','ASC');
		$this->db->where('em.event_id',$event_id);
		//$this->db->where('em.status', 'accepted');
		$this->db->select('first_name,last_name,email_address,em.member');
        $this->db->from('events_meeting as em');
        $this->db->join('registration as r','r.reg_id = em.member');
        $query = $this->db->get();
        return $query->result();
	}

	function get_events_meeting_invitees($event_id)
	{
		$this->db->order_by('first_name','ASC');
		$this->db->where('em.event_id',$event_id);
		$this->db->where('em.status', 'invited');
		$this->db->select('first_name,last_name,email_address,em.member,em.event_unique_key,em.mid');
        $this->db->from('events_meeting as em');
        $this->db->join('registration as r','r.reg_id = em.member');
        $query = $this->db->get();
        return $query->result();
	}

	function get_events_meeting_attendees($event_id)
	{
		$this->db->order_by('first_name','ASC');
		$this->db->where('em.event_id',$event_id);
		$this->db->where('em.status', 'accepted');
		$this->db->select('first_name,last_name,email_address,em.member,em.event_unique_key,em.mid');
        $this->db->from('events_meeting as em');
        $this->db->join('registration as r','r.reg_id = em.member');
        $query = $this->db->get();
        return $query->result();
	}

	function check_evt_meeting_pm($reg_id,$event_id)
    {
    	//$this->db->where('status','active');
    	$this->db->where('member',$reg_id);
    	$this->db->where('event_id',$event_id);
    	$query = $this->db->get('events_meeting');
    	return $query->row();
    }

    function check_evt_meeting_invited_ids($unique_key,$member)
    {
    	//$this->db->where('status','active');
    	$this->db->where('event_unique_key',$unique_key);
    	$this->db->where('member',$member);
    	$query = $this->db->get('events_meeting_invited_members');
    	return $query->row();
    }

    function getEventMeeting($event_id)
	{
		$this->db->where('event_id',$event_id);
		$query = $this->db->get('events_meeting');
		return $query->result();
	}

	function getEventMeetingUniqueKey($event_id)
	{
		$this->db->where('event_id',$event_id);
		$query = $this->db->get('events_meeting');
		return $query->result();
	}

	function getEventMeetingMem($event_id)
	{
		$this->db->where('id',$event_id);
		$query = $this->db->get('events');
		return $query->row();
	}

	function delete_meeting_member($event_id,$member)
	{
		$this->db->where('event_id', $event_id);
		$this->db->where('member', $member);
		if($this->db->delete('events_meeting'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}		
	}

	function delete_meeting($event_unique_key)
	{
		$this->db->where('event_unique_key', $event_unique_key);
		if($this->db->delete('events_meeting'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}		
	}

	function deleteEventMeeting($id,$delete_check)
	{
		if($delete_check == 0){
			$this->db->where('id', $id);
			$query_result = $this->db->get('events');

			$this->db->where('event_id', $id);
			$this->db->delete('events_meeting');
			return $query_result->result();
		}else if($delete_check == 2){

			$this->db->where('id', $id);
			$query=$this->db->get('events');
			//// get data
			$this->db->where('unique_key', $query->row()->unique_key);
			$this->db->where('id >=',$id);
			$query_result = $this->db->get('events');
			//  end
			$this->db->where('event_unique_key', $query->row()->unique_key);
			$this->db->where('event_id >=',$id);
			$this->db->delete('events_meeting');
			return $query_result->result();
			
		}else{
			$this->db->where('id', $id);
			$query=$this->db->get('events');
			$this->db->where('event_unique_key', $query->row()->unique_key);
			$this->db->delete('events_meeting');
			return $query->result();
		}
		
	}

	function SentMeetingInvites($unique_key)
	{
		$query = $this->db->query("SELECT * FROM `events_meeting` WHERE event_unique_key = '".$unique_key."' and status = 'invite' GROUP BY member;");
        return $query->result();
	}

	function getMeetingInvites_inApp_notify_clear()
	{
		$this->db->order_by('status_date','DESC');
		$this->db->group_by('event_unique_key');
		$this->db->group_start();
    	$this->db->where('status', 'invited');
    	$this->db->or_where('status', 'invite');
    	$this->db->group_end();
    	$this->db->where('m_notify_clear','');
		$this->db->where('member',$this->session->userdata('d168_id'));
		$query = $this->db->get('events_meeting');
		return $query->result();
	}

	function getMeetingInvites_inApp_notify()
	{
		$this->db->order_by('status_date','DESC');
		$this->db->group_by('event_unique_key');
		$this->db->group_start();
    	$this->db->where('status', 'invited');
    	$this->db->or_where('status', 'invite');
    	$this->db->group_end();
		$this->db->where('member',$this->session->userdata('d168_id'));
		$query = $this->db->get('events_meeting');
		return $query->result();
	}

	function update_meeting_invites($data,$member,$unique_key)
    {
		$this->db->where('member', $member);
		$this->db->where('event_unique_key', $unique_key);    	
    	if($this->db->update('events_meeting',$data))
    	{
    		return TRUE;
    	}
    	else
    	{
    		return FALSE;
    	}
    }

    function getEventMeetingDetail($unique_key)
	{
		$this->db->where('unique_key',$unique_key);
		$query = $this->db->get('events');
		return $query->row();
	}

	function CheckMeetingInvite($unique_key,$member)
	{
		$this->db->where('member',$member);
		$this->db->where('event_unique_key',$unique_key);
		$query = $this->db->get('events_meeting');
		return $query->row();
	}

	function get_all_evt_meetings($event_id)
	{
		$this->db->where('em.m_event_reminder_send', '');
		$this->db->where('em.event_id',$event_id);
		$this->db->where('em.status', 'accepted');
		$this->db->select('*');
        $this->db->from('events_meeting as em');
        $this->db->join('events as e','e.id = em.event_id');
        $query = $this->db->get();
        return $query->result();
	}

	function updateEventMeeting($data,$mid)
	{
		$this->db->where('mid', $mid);
		$this->db->update('events_meeting',$data);
	}

	function getUserEventsMeetingReminder()
	{
		$this->db->where('em.member', $this->session->userdata('d168_id'));
		$this->db->where('em.m_in_app_reminder', '');
		$this->db->where('e.event_reminder !=', 'No reminder');
		$this->db->where('em.status', 'accepted');
		$this->db->where('e.status', 'active');
		$this->db->select('*');
        $this->db->from('events_meeting as em');
        $this->db->join('events as e','e.id = em.event_id');
        $query = $this->db->get();
        return $query->result();
	}

	function check_events_meeting_invited_members($im,$unique_key)
	{
		$this->db->where('removed','');
		$this->db->where('member',$im);
		$this->db->where('event_unique_key',$unique_key);
		$query = $this->db->get('events_meeting_invited_members');
		return $query->num_rows();
	}

	function check_events_meeting_invited_members2($im,$unique_key)
	{
		$this->db->where('removed','');
		$this->db->where('member',$im);
		$this->db->where('event_unique_key',$unique_key);
		$query = $this->db->get('events_meeting_invited_members');
		return $query->row();
	}

	function insert_events_meeting_invited_members($data)
    {
    	if($this->db->insert('events_meeting_invited_members',$data))
    	{
    		return TRUE;
    	}
    	else
    	{
    		return FALSE;
    	}
    }

    function CheckMeetingInvitedMembers($unique_key,$imid)
	{
		$this->db->where('removed','');
		$this->db->where('imid',$imid);
		$this->db->where('event_unique_key',$unique_key);
		$query = $this->db->get('events_meeting_invited_members');
		return $query->row();
	}

	function getMeetingInvitedMembers($imid)
	{
		$this->db->where('imid',$imid);
		$query = $this->db->get('events_meeting_invited_members');
		return $query->row();
	}

	function CheckMeetingInvitedMemberEmail($email)
	{
		$this->db->where('removed','');
		// $this->db->where('status','invited');
		$this->db->where('status','accepted');
		$this->db->where('member',$email);
		$query = $this->db->get('events_meeting_invited_members');
		return $query->result();
	}

	function update_events_meeting_invited_members($data,$imid)
    {
		$this->db->where('imid', $imid);   	
    	if($this->db->update('events_meeting_invited_members',$data))
    	{
    		return TRUE;
    	}
    	else
    	{
    		return FALSE;
    	}
    }

    function get_events_meeting_more_invited($unique_key)
	{
		$this->db->order_by('member','ASC');
		$this->db->where('event_unique_key',$unique_key);	
		$this->db->where('removed', '');
		$this->db->where('status', 'invited');
		$query = $this->db->get('events_meeting_invited_members');
        return $query->result();
	}

	function get_meeting_members_emailids($unique_key)
	{
		$this->db->order_by('member','ASC');
		$this->db->where('event_unique_key',$unique_key);	
		$this->db->where('removed', '');
		$query = $this->db->get('events_meeting_invited_members');
        return $query->result();
	}

	function get_events_meeting_more_invited_accpeted($unique_key)
	{
		$this->db->order_by('member','ASC');
		$this->db->where('event_unique_key',$unique_key);	
		$this->db->where('removed', '');
		$this->db->where('status', 'accepted');
		$query = $this->db->get('events_meeting_invited_members');
        return $query->result();
	}

	function getMeetingMemberDetail($mid)
	{
		$this->db->where('mid',$mid);
		$query = $this->db->get('events_meeting');
		return $query->row();
	}

	function delete_meetingMember($unique_key,$member)
	{
		$this->db->where('event_unique_key', $unique_key);
		$this->db->where('member', $member);
		if($this->db->delete('events_meeting'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	// function getMeetingMemberInvitedDetail($member,$unique_key)
	// {
	// 	$this->db->where('member',$member);
	// 	$this->db->where('event_unique_key',$unique_key);
	// 	$query = $this->db->get('events_meeting_invited_members');
	// 	return $query->row();
	// }

	function delete_meetingMemberInvited($imid)
	{
		$this->db->where('imid', $imid);
		if($this->db->delete('events_meeting_invited_members'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function delete_meetingMemberInvitedEmail($unique_key,$member)
	{
		$this->db->where('event_unique_key', $unique_key);
		$this->db->where('member', $member);
		if($this->db->delete('events_meeting_invited_members'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function check_events_meeting_members2($im,$unique_key)
	{
		$this->db->where('member',$im);
		$this->db->where('event_unique_key',$unique_key);
		$query = $this->db->get('events_meeting');
		return $query->row();
	}

	function get_all_evt_meetings_invited_users($unique_key)
	{
		$this->db->where('removed', '');
		$this->db->where('status', 'accepted');
		$this->db->where('event_unique_key',$unique_key);
		$query = $this->db->get('events_meeting_invited_members');
		return $query->result();
	}

	function update_EventFile($data,$event_id)
	{
		$this->db->where('id',$event_id);
		if($this->db->update('events',$data))
		{
		return TRUE;
		}
		else
		{
		return FALSE;
		}
	}

	function view_selected_single_event_info($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('events');
		return $query->row();
		
	}

  	//////Calendar Part End///////

	//////Goal & Strategies Part Start///////
	function insert_PortfolioDepartment($data)
    {
    	if($this->db->insert('project_portfolio_department',$data))
    	{
    		return TRUE;
    	}
    	else
    	{
    		return FALSE;
    	}
    }

    function get_PortfolioDepartment($id)
	{
		$this->db->order_by('portfolio_dept_id','DESC');
		$this->db->where('portfolio_id',$id);
		$this->db->where('dstatus', 'active');
		$query = $this->db->get('project_portfolio_department');
		return $query->result();
	}

	function get_PortfolioAllDepartment($id)
	{
		$this->db->order_by('portfolio_dept_id','DESC');
		$this->db->where('portfolio_id',$id);
		$query = $this->db->get('project_portfolio_department');
		return $query->result();
	}

	function edit_PortfolioDepartment($data,$id)
    {
    	$this->db->where('portfolio_dept_id', $id);
    	if($this->db->update('project_portfolio_department', $data))
    	{
    		return TRUE;
    	}
    	else
    	{
    		return FALSE;
    	}
    }

    function get_PDepartment($id)
	{
		$this->db->where('portfolio_dept_id',$id);
		$query = $this->db->get('project_portfolio_department');
		return $query->row();
	}

	function getGoalCount($port_id)
	{
		$query = $this->db->query("SELECT COUNT(*) as goal_count_rows FROM goals where gcreated_by='".$this->session->userdata('d168_id')."' and g_trash = '' and g_archive = '' and g_file_it = '' and portfolio_id = '".$port_id."' and reg_acc_status != 'deactivated'");
		return $query->row_array();
	}

	function insert_NewGoal($data)
	{
		if($this->db->insert('goals',$data))
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

	function insert_GoalInviteMember($data4)
	{
	    if($this->db->insert('goals_invited_members',$data4))
	    {
	      return TRUE;
	    }
	    else
	    {
	      return FALSE;
	    }
	}

	function check_GoalTeamRequestSend($suggest_id,$gid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('gmember', $suggest_id);
		$this->db->where('gid', $gid);
		$this->db->where('g_trash !=', 'yes');
		$this->db->where('g_archive !=', 'yes');
		$this->db->where('g_file_it !=', 'yes');
		$query = $this->db->get('goals_members');
		return $query->num_rows();
	}

	function check_goal_invited_email($email,$gid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('gid',$gid);
		$this->db->where('g_trash !=', 'yes');
		$this->db->where('g_archive !=', 'yes');
		$this->db->where('g_file_it !=', 'yes');
	    $this->db->where('sent_from', $this->session->userdata('d168_id'));
	    $this->db->where('sent_to', $email);
	    $query = $this->db->get('goals_invited_members');
	    return $query->row();
	}

	function goal_request($gid,$reg_id,$gmid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('gmid', $gmid);
		$this->db->where('gmember', $reg_id);
		$this->db->where('g_trash !=', 'yes');
		$this->db->where('g_archive !=', 'yes');
		$this->db->where('g_file_it !=', 'yes');
		$this->db->where('gid', $gid);
		$query = $this->db->get('goals_members');
		return $query->num_rows();
	}

	function goal_request2($gid,$gmid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('gmember', $this->session->userdata('d168_id'));
		$this->db->where('g_trash !=', 'yes');
		$this->db->where('g_archive !=', 'yes');
		$this->db->where('g_file_it !=', 'yes');
		$this->db->where('gid', $gid);
		$this->db->where('gmid', $gmid);
		$query = $this->db->get('goals_members');
		return $query->num_rows();
	}

	function goal_request_status($gid,$reg_id,$gmid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('gmid', $gmid);
		$this->db->where('gmember', $reg_id);
		$this->db->where('g_trash !=', 'yes');
		$this->db->where('g_archive !=', 'yes');
		$this->db->where('g_file_it !=', 'yes');
		$this->db->where('gid', $gid);
		$query = $this->db->get('goals_members');
		return $query->row();
	}

	function goal_request_status2($gmid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('gmember', $this->session->userdata('d168_id'));
		$this->db->where('g_trash !=', 'yes');
		$this->db->where('g_archive !=', 'yes');
		$this->db->where('g_file_it !=', 'yes');
		$this->db->where('gmid', $gmid);
		$query = $this->db->get('goals_members');
		return $query->row();
	}

	function update_goal_request_member($data,$gmid)
	{
		$this->db->where('gmid',$gmid);
		if($this->db->update('goals_members',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function check_goal_invite_request($igm_id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('igm_id', $igm_id);
		$this->db->where('g_trash !=', 'yes');
		$this->db->where('g_archive !=', 'yes');
		$this->db->where('g_file_it !=', 'yes');
		$query = $this->db->get('goals_invited_members');
		return $query->num_rows();
	}

	function check_goal_invite_reject_request($igm_id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('igm_id', $igm_id);
		$this->db->where('g_trash !=', 'yes');
		$this->db->where('g_archive !=', 'yes');
		$this->db->where('g_file_it !=', 'yes');
		$query = $this->db->get('goals_invited_members');
		return $query->row();
	}

	function update_goal_invite_request($data,$igm_id)
	{
		$this->db->where('igm_id',$igm_id);
		if($this->db->update('goals_invited_members',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function checkGoalInviteMemberEmail($email)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('sent_to', $email);
		$this->db->where('g_trash !=', 'yes');
		$this->db->where('g_archive !=', 'yes');
		$this->db->where('g_file_it !=', 'yes');
		$query = $this->db->get('goals_invited_members');
		return $query->result();
	}

	function PendingGoalList_clear()
    {
        $this->db->order_by('g.portfolio_id', 'DESC');
        $this->db->where('gm.reg_acc_status !=','deactivated');
        $this->db->where('g.g_trash', '');
        $this->db->where('g.g_archive', '');
        $this->db->where('g.g_file_it', '');
        $this->db->where('gm.status', 'send');
        $this->db->where('gm.gmember', $this->session->userdata('d168_id'));
        $this->db->where('gm.sent_notify_clear','no');
        $this->db->select('*, g.gid as gid, gm.gid as gm_pid');
        $this->db->from('goals as g');
        $this->db->join('goals_members as gm','gm.gid = g.gid');
        $query = $this->db->get();
        return $query->result();
    }

    function PendingGoalList()
    {
        $this->db->order_by('g.portfolio_id', 'DESC');
        $this->db->where('gm.reg_acc_status !=','deactivated');
        $this->db->where('g.g_trash', '');
        $this->db->where('g.g_archive', '');
        $this->db->where('g.g_file_it', '');
        $this->db->where('gm.status', 'send');
        $this->db->where('gm.gmember', $this->session->userdata('d168_id'));
        $this->db->select('*, g.gid as gid, gm.gid as gm_pid');
        $this->db->from('goals as g');
        $this->db->join('goals_members as gm','gm.gid = g.gid');
        $query = $this->db->get();
        return $query->result();
    }

    function GoalTeamMember($gid)
	{
		$this->db->where('gm.reg_acc_status !=','deactivated');
		$this->db->where('gm.gid', $gid);
		$this->db->where('gm.g_archive !=', 'yes');
		$this->db->where('gm.g_file_it !=', 'yes');
		$this->db->where('gm.g_trash !=', 'yes');
		$this->db->select('r.reg_id,r.first_name,r.last_name,r.photo,gm.gmid,gm.status,gm.gmember');
        $this->db->from('registration as r');
        $this->db->join('goals_members as gm', 'gm.gmember = r.reg_id');
        $query = $this->db->get();
        return $query->result();
	}

	function GoalTeamMemberAccepted($gid)
	{
		$this->db->where('gm.reg_acc_status !=','deactivated');
		$this->db->where('gm.gid', $gid);
		$this->db->where('gm.status','accepted');
		$this->db->where('gm.g_archive !=', 'yes');
		$this->db->where('gm.g_file_it !=', 'yes');
		$this->db->where('gm.g_trash !=', 'yes');
		$this->db->select('r.reg_id,r.first_name,r.last_name,r.photo,gm.gmid,gm.status,gm.gmember');
        $this->db->from('registration as r');
        $this->db->join('goals_members as gm', 'gm.gmember = r.reg_id');
        $query = $this->db->get();
        return $query->result();
	}

	function InvitedGoalMember($gid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('gid', $gid);
		$this->db->where('g_trash !=', 'yes');
		$this->db->where('g_archive !=', 'yes');
		$this->db->where('g_file_it !=', 'yes');
		$query = $this->db->get('goals_invited_members');
		return $query->result();
	}

	function SuggestedGoalMember($gid)
    {
        $this->db->where('gpm.reg_acc_status !=','deactivated');
        $this->db->where('gpm.gid', $gid);
        $this->db->where('gpm.g_trash !=', 'yes');
        $this->db->where('gpm.g_archive !=', 'yes');
        $this->db->where('gpm.g_file_it !=', 'yes');
        $this->db->select('r.reg_id,r.first_name,r.last_name,r.photo,gpm.gs_id,gpm.suggest_id,gpm.status');
        $this->db->from('registration as r');
        $this->db->join('goals_suggested_members as gpm', 'gpm.suggest_id = r.reg_id');
        $query = $this->db->get();
        return $query->result();
    }

    function SuggestedInviteGoalMember($gid)
    {
        $this->db->where('reg_acc_status !=','deactivated');
        $this->db->where('gid', $gid);
        $this->db->where('already_register', 'no');
        $this->db->where('g_trash !=', 'yes');
        $this->db->where('g_archive !=', 'yes');
        $this->db->where('g_file_it !=', 'yes');
        $query = $this->db->get('goals_suggested_members');
        return $query->result();
    }

    function check_g_suggested($gid,$t)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('suggest_id', $t);
		$this->db->where('g_trash !=', 'yes');
		$this->db->where('g_archive !=', 'yes');
		$this->db->where('g_file_it !=', 'yes');
		$this->db->where('gid', $gid);
		$query = $this->db->get('goals_suggested_members');
		return $query->row();
	}

    function check_g_suggested2($gid,$t)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('suggest_id', $t);
		$this->db->where('g_trash !=', 'yes');
		$this->db->where('g_archive !=', 'yes');
		$this->db->where('g_file_it !=', 'yes');
		$this->db->where('gid', $gid);
		$query = $this->db->get('goals_suggested_members');
		return $query->num_rows();
	}

	function insert_GSuggestTeamMember($data2)
	{
		if($this->db->insert('goals_suggested_members', $data2))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function check_notify_goal_suggested($gid)
	{
		$this->db->order_by('gs_id','DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('status', 'suggested');
		$this->db->where('g_trash !=', 'yes');
		$this->db->where('g_archive !=', 'yes');
		$this->db->where('g_file_it !=', 'yes');
		$this->db->where('gid', $gid);
		$query = $this->db->get('goals_suggested_members');
		return $query->row();
	}	

	function check_invited_goalsuggestemail($im,$gid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('gid',$gid);
	    $this->db->where('sent_to', $im);
		$this->db->where('g_trash !=', 'yes');
		$this->db->where('g_archive !=', 'yes');
		$this->db->where('g_file_it !=', 'yes');
	    $query = $this->db->get('goals_invited_members');
	    return $query->row();
	}

	function check_GoalMToClear($id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('gmember',$this->session->userdata('d168_id'));
    	$this->db->where('gid',$id);
    	$query = $this->db->get('goals_members');
        return $query->row();
    }

    function edit_goals_members($data6,$id)
	{
    	$this->db->where('gmember',$this->session->userdata('d168_id'));
		$this->db->where('gid', $id);
		if($this->db->update('goals_members', $data6))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function get_pendinggoalbySessID()
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('gmember', $this->session->userdata('d168_id'));
    	$this->db->where('sent_notify_clear','no');
        $query = $this->db->get('goals_members');
        return $query->result();
    }

    function getGoalMemberDetailbyGID($gid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('gmember', $this->session->userdata('d168_id'));
		$this->db->where('g_trash !=', 'yes');
		$this->db->where('g_archive !=', 'yes');
		$this->db->where('g_file_it !=', 'yes');
		$this->db->where('gid', $gid);
		$query = $this->db->get('goals_members');
		return $query->row();
    }

	function GoalsList($get_port_id)
	{
		$this->db->order_by('gid','DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_id', $get_port_id);
		$this->db->where('g_trash !=', 'yes');
		$this->db->where('g_archive !=', 'yes');
		$this->db->where('g_file_it !=', 'yes');
		$this->db->where('gcreated_by', $this->session->userdata('d168_id'));
		$query = $this->db->get('goals');
		return $query->result();
	}

	function AcceptedGoalsAllList($get_port_id)
    {
        $this->db->order_by('g.gid', 'DESC');
        $this->db->where('gm.reg_acc_status !=','deactivated');
        $this->db->where('g.portfolio_id', $get_port_id);
        $this->db->where('g.g_trash !=', 'yes');
        $this->db->where('g.g_archive !=', 'yes');
        $this->db->where('g.g_file_it !=', 'yes');
        $this->db->where('gm.status', 'accepted');        
        $this->db->where('g.gcreated_by !=', $this->session->userdata('d168_id'));
        $this->db->where('gm.gmember', $this->session->userdata('d168_id'));
        $this->db->select('*, g.gid as gid, gm.gid as pm_gid');
        $this->db->from('goals as g');
        $this->db->join('goals_members as gm','gm.gid = g.gid');
        $query = $this->db->get();
        return $query->result();
    }

    function PendingGoalsAllList($get_port_id)
    {
        $this->db->order_by('g.gid', 'DESC');
        $this->db->where('gm.reg_acc_status !=','deactivated');
        $this->db->where('g.portfolio_id', $get_port_id);
        $this->db->where('g.g_trash !=', 'yes');
        $this->db->where('g.g_archive !=', 'yes');
        $this->db->where('g.g_file_it !=', 'yes');
        $this->db->where('gm.status', 'send');        
        $this->db->where('g.gcreated_by !=', $this->session->userdata('d168_id'));
        $this->db->where('gm.gmember', $this->session->userdata('d168_id'));
        $this->db->select('*, g.gid as gid, gm.gid as pm_gid');
        $this->db->from('goals as g');
        $this->db->join('goals_members as gm','gm.gid = g.gid');
        $query = $this->db->get();
        return $query->result();
    }

    function ReadMoreGoalsAllList($get_port_id)
    {
        $this->db->order_by('g.gid', 'DESC');
        $this->db->where('gm.reg_acc_status !=','deactivated');
        $this->db->where('g.portfolio_id', $get_port_id);
        $this->db->where('g.g_trash !=', 'yes');
        $this->db->where('g.g_archive !=', 'yes');
        $this->db->where('g.g_file_it !=', 'yes');
        $this->db->where('gm.status', 'read_more');        
        $this->db->where('g.gcreated_by !=', $this->session->userdata('d168_id'));
        $this->db->where('gm.gmember', $this->session->userdata('d168_id'));
        $this->db->select('*, g.gid as gid, gm.gid as pm_gid');
        $this->db->from('goals as g');
        $this->db->join('goals_members as gm','gm.gid = g.gid');
        $query = $this->db->get();
        return $query->result();
    }

    function check_gm($reg_id,$gid,$port_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('portfolio_id',$port_id);
    	$this->db->where('gmember',$reg_id);
    	$this->db->where('gid',$gid);
    	$query = $this->db->get('goals_members');
    	return $query->row();
    }

    // function AcceptedGoalsStrategiesProjectNestedList($get_gid)
	// {
	// 	$this->db->order_by('p.sid', 'DESC');
	// 	$this->db->group_by('p.sid');
	// 	$this->db->where('pm.reg_acc_status !=','deactivated');
	// 	//$this->db->where('ptype', 'goal_strategy');
	// 	$this->db->where('p.gid', $get_gid);
	// 	$this->db->where('p.ptrash !=', 'yes');
	// 	$this->db->where('p.project_archive !=', 'yes');
	// 	$this->db->where('p.project_file_it !=', 'yes');
	// 	$this->db->where('pm.status', 'accepted');
	// 	$this->db->where('pm.pmember', $this->session->userdata('d168_id'));
    //     $this->db->select('p.sid');
    //     $this->db->from('project as p');
    //     $this->db->join('project_members as pm','pm.pid = p.pid');
    //     $query = $this->db->get();
    //     return $query->result();
	// }

    // function PendingGoalsStrategiesProjectNestedList($get_gid)
	// {
	// 	$this->db->order_by('p.sid', 'DESC');
	// 	$this->db->group_by('p.sid');
	// 	$this->db->where('pm.reg_acc_status !=','deactivated');
	// 	//$this->db->where('ptype', 'goal_strategy');
	// 	$this->db->where('p.gid', $get_gid);
	// 	$this->db->where('p.ptrash', '');
	// 	$this->db->where('p.project_archive', '');
	// 	$this->db->where('p.project_file_it', '');
	// 	$this->db->where('pm.status', 'send');
	// 	$this->db->where('pm.pmember', $this->session->userdata('d168_id'));
    //     $this->db->select('p.sid');
    //     $this->db->from('project as p');
    //     $this->db->join('project_members as pm','pm.pid = p.pid');
    //     $query = $this->db->get();
    //     return $query->result();
	// }

	// function ReadMoreGoalsStrategiesProjectNestedList($get_gid)
	// {
	// 	$this->db->order_by('p.sid', 'DESC');
	// 	$this->db->group_by('p.sid');
	// 	$this->db->where('pm.reg_acc_status !=','deactivated');
	// 	//$this->db->where('ptype', 'goal_strategy');
	// 	$this->db->where('p.gid', $get_gid);
	// 	$this->db->where('p.ptrash !=', 'yes');
	// 	$this->db->where('p.project_archive !=', 'yes');
	// 	$this->db->where('p.project_file_it !=', 'yes');
	// 	$this->db->where('pm.status', 'read_more');
	// 	$this->db->where('pm.pmember', $this->session->userdata('d168_id'));
    //     $this->db->select('p.sid');
    //     $this->db->from('project as p');
    //     $this->db->join('project_members as pm','pm.pid = p.pid');
    //     $query = $this->db->get();
    //     return $query->result();
	// }

	function GoalDetail($id)
	{		
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('g_trash !=', 'yes');
		$this->db->where('g_archive !=', 'yes');
		$this->db->where('g_file_it !=', 'yes');
		$this->db->where('gid',$id);
		$query = $this->db->get('goals');
		return $query->row();
	}

	function GoalDetailAccepted($id)
    {
        $this->db->where('gm.reg_acc_status !=','deactivated');
        $this->db->where('gm.gmember', $this->session->userdata('d168_id'));
        $this->db->where('g.g_trash !=', 'yes');
        $this->db->where('g.g_archive !=', 'yes');
        $this->db->where('g.g_file_it !=', 'yes');
        $this->db->where('gm.status', 'accepted'); 
		$this->db->where('gm.gid', $id);       
        $this->db->select('*, g.gid as gid, gm.gid as pm_gid');
        $this->db->from('goals as g');
        $this->db->join('goals_members as gm','gm.gid = g.gid');
        $query = $this->db->get();
        return $query->num_rows();
    }

    function GoalDetailRequest($id)
    {
        $this->db->where('gm.reg_acc_status !=','deactivated');
        $this->db->where('gm.gmember', $this->session->userdata('d168_id'));
        $this->db->where('g.g_trash !=', 'yes');
        $this->db->where('g.g_archive !=', 'yes');
        $this->db->where('g.g_file_it !=', 'yes');
        $this->db->group_start();
        $this->db->where('gm.status', 'send'); 
		$this->db->or_where('gm.status', 'read_more');
    	$this->db->group_end();
		$this->db->where('gm.gid', $id);       
        $this->db->select('*, g.gid as gid, gm.gid as pm_gid');
        $this->db->from('goals as g');
        $this->db->join('goals_members as gm','gm.gid = g.gid');
        $query = $this->db->get();
        return $query->row();
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

	function GoalsAllStrategiesList($get_goal_id)
	{
		$this->db->order_by('sid','DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('gid', $get_goal_id);
		$this->db->where('s_trash !=', 'yes');
		$this->db->where('s_archive !=', 'yes');
		$this->db->where('s_file_it !=', 'yes');
		$query = $this->db->get('strategies');
		return $query->result();
	}

	// function GoalsStrategiesList($get_goal_id)
	// {
	// 	$this->db->order_by('sid','DESC');
	// 	$this->db->where('reg_acc_status !=','deactivated');
	// 	$this->db->where('gid', $get_goal_id);
	// 	$this->db->where('s_trash !=', 'yes');
	// 	$this->db->where('s_archive !=', 'yes');
	// 	$this->db->where('s_file_it !=', 'yes');
	// 	$this->db->where('screated_by', $this->session->userdata('d168_id'));
	// 	$query = $this->db->get('strategies');
	// 	return $query->result();
	// }

	function getStrategiesCount($port_id,$gid)
	{
		$query = $this->db->query("SELECT COUNT(*) as strategy_count_rows FROM strategies where screated_by='".$this->session->userdata('d168_id')."' and s_trash = '' and s_archive = '' and s_file_it = '' and portfolio_id = '".$port_id."' and gid = '".$gid."' and reg_acc_status != 'deactivated'");
		return $query->row_array();
	}

	function getStrategiesProjectCount($port_id,$sid)
	{
		$query = $this->db->query("SELECT COUNT(*) as project_count_rows FROM project where pcreated_by='".$this->session->userdata('d168_id')."' and portfolio_id = '".$port_id."' and sid = '".$sid."' and reg_acc_status != 'deactivated'");
		return $query->row_array();
	}

	function insert_NewStrategies($data)
	{
		if($this->db->insert('strategies',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function strategies_progress_done($gid)
    {
        $query = $this->db->query("SELECT COUNT(*) as s_count_rows FROM strategies where gid='".$gid."' and s_trash != 'yes' and s_archive != 'yes' and s_file_it != 'yes' and sprogress='done' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function strategies_progress_total($gid)
    {
        $query = $this->db->query("SELECT COUNT(*) as s_count_rows FROM strategies where gid='".$gid."' and s_trash != 'yes' and s_archive != 'yes' s_file_it != 'yes' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function StrategyDetail($id)
	{		
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('s_trash !=', 'yes');
		$this->db->where('s_archive !=', 'yes');
		$this->db->where('s_file_it !=', 'yes');
		$this->db->where('sid',$id);
		$query = $this->db->get('strategies');
		return $query->row();
	}

	function StrategyDetailGid($id)
	{		
		$this->db->where('sid',$id);
		$query = $this->db->get('strategies');
		return $query->row();
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

	// function GoalsStrategiesProjectList($get_strategy_id)
	// {
	// 	$this->db->order_by('pid', 'DESC');
	// 	$this->db->where('reg_acc_status !=','deactivated');
	// 	//$this->db->where('ptype', 'goal_strategy');
	// 	$this->db->where('sid', $get_strategy_id);
	// 	$this->db->where('ptrash !=', 'yes');
	// 	$this->db->where('project_archive !=', 'yes');
	// 	$this->db->where('project_file_it !=', 'yes');
	// 	$this->db->where('pcreated_by', $this->session->userdata('d168_id'));
	// 	$query = $this->db->get('project');
	// 	return $query->result();
	// }

	// function AcceptedGoalsStrategiesProjectList($get_strategy_id)
	// {
	// 	$this->db->order_by('p.pid', 'DESC');
	// 	$this->db->where('pm.reg_acc_status !=','deactivated');
	// 	//$this->db->where('ptype', 'goal_strategy');
	// 	$this->db->where('p.sid', $get_strategy_id);
	// 	$this->db->where('p.ptrash !=', 'yes');
	// 	$this->db->where('p.project_archive !=', 'yes');
	// 	$this->db->where('p.project_file_it !=', 'yes');
	// 	$this->db->where('pm.status', 'accepted');
	// 	$this->db->where('pm.pmember', $this->session->userdata('d168_id'));
    //     $this->db->select('*, p.pid as pid, pm.pid as pm_pid');
    //     $this->db->from('project as p');
    //     $this->db->join('project_members as pm','pm.pid = p.pid');
    //     $query = $this->db->get();
    //     return $query->result();
	// }

	// function PendingGoalsStrategiesProjectList($get_strategy_id)
	// {
	// 	$this->db->order_by('p.pid', 'DESC');
	// 	$this->db->where('pm.reg_acc_status !=','deactivated');
	// 	//$this->db->where('ptype', 'goal_strategy');
	// 	$this->db->where('p.sid', $get_strategy_id);
	// 	$this->db->where('p.ptrash', '');
	// 	$this->db->where('p.project_archive', '');
	// 	$this->db->where('p.project_file_it', '');
	// 	$this->db->where('pm.status', 'send');
	// 	$this->db->where('pm.pmember', $this->session->userdata('d168_id'));
    //     $this->db->select('*, p.pid as pid, pm.pid as pm_pid');
    //     $this->db->from('project as p');
    //     $this->db->join('project_members as pm','pm.pid = p.pid');
    //     $query = $this->db->get();
    //     return $query->result();
	// }

	// function ReadMoreGoalsStrategiesProjectList($get_strategy_id)
	// {
	// 	$this->db->order_by('p.pid', 'DESC');
	// 	$this->db->where('pm.reg_acc_status !=','deactivated');
	// 	//$this->db->where('ptype', 'goal_strategy');
	// 	$this->db->where('p.sid', $get_strategy_id);
	// 	$this->db->where('p.ptrash !=', 'yes');
	// 	$this->db->where('p.project_archive !=', 'yes');
	// 	$this->db->where('p.project_file_it !=', 'yes');
	// 	$this->db->where('pm.status', 'read_more');
	// 	$this->db->where('pm.pmember', $this->session->userdata('d168_id'));
    //     $this->db->select('*, p.pid as pid, pm.pid as pm_pid');
    //     $this->db->from('project as p');
    //     $this->db->join('project_members as pm','pm.pid = p.pid');
    //     $query = $this->db->get();
    //     return $query->result();
	// }

	function Strategy_tasks($id)
	{
		$this->db->order_by('tid', 'DESC');
    	//$this->db->group_by('tassignee');
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$this->db->where('sid', $id);
		$query = $this->db->get('task');
		return $query->result();
	}

	function Strategy_subtasks($id)
	{
		$this->db->order_by('stid', 'DESC');
    	//$this->db->group_by('stassignee');
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$this->db->where('sid', $id);
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function Strategyprogress_done($sid)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM task where sid='".$sid."' and trash != 'yes' and task_archive != 'yes' and task_file_it != 'yes' and tstatus='done' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function Strategyprogress_total($sid)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM task where sid='".$sid."' and trash != 'yes' and task_archive != 'yes' and task_file_it != 'yes' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function Strategysub_progress_done($sid)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM subtask where sid='".$sid."' and strash != 'yes' and subtask_archive != 'yes' and subtask_file_it != 'yes' and ststatus='done' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function Strategysub_progress_total($sid)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM subtask where sid='".$sid."' and strash != 'yes' and subtask_archive != 'yes' and subtask_file_it != 'yes' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function StrategyAllProjectsList($get_strategy_id)
	{
		$this->db->order_by('pid', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		//$this->db->where('ptype', 'goal_strategy');
		$this->db->where('sid', $get_strategy_id);
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$query = $this->db->get('project');
		return $query->result();
	}

	function Goal_tasks($id)
	{
		$this->db->order_by('tid', 'DESC');
    	//$this->db->group_by('tassignee');
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it !=', 'yes');
		$this->db->where('gid', $id);
		$query = $this->db->get('task');
		return $query->result();
	}

	function Goal_subtasks($id)
	{
		$this->db->order_by('stid', 'DESC');
    	//$this->db->group_by('stassignee');
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$this->db->where('gid', $id);
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function Goalprogress_done($gid)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM task where gid='".$gid."' and trash != 'yes' and task_archive != 'yes' and task_file_it != 'yes' and tstatus='done' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function Goalprogress_total($gid)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM task where gid='".$gid."' and trash != 'yes' and task_archive != 'yes' and task_file_it != 'yes' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function Goalsub_progress_done($gid)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM subtask where gid='".$gid."' and strash != 'yes' and subtask_archive != 'yes' and subtask_file_it != 'yes' and ststatus='done' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function Goalsub_progress_total($gid)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM subtask where gid='".$gid."' and strash != 'yes' and subtask_archive != 'yes' and subtask_file_it != 'yes' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function view_history_date_goal($gid)
	{
		$query = $this->db->query("SELECT DATE(h_date) DateOnly from project_history where gid = '".$gid."'GROUP BY DateOnly ORDER BY hid DESC");
        return $query->result();
	}

	function view_history_goal($gid,$hdate)
	{
		$this->db->order_by('hid', 'DESC');
		$this->db->like('h_date', $hdate);
		$this->db->where('gid', $gid);
		//$this->db->where('reg_acc_status !=','deactivated');
		$query = $this->db->get('project_history');
		return $query->result();
	}

	function view_history_only_date_goal($gid,$only_date)
	{
		$this->db->order_by('hid', 'DESC');
		$this->db->like('h_date', $only_date);
		$this->db->where('gid', $gid);
		//$this->db->where('reg_acc_status !=','deactivated');
		$query = $this->db->get('project_history');
		return $query->result();
	}

	function view_history_date_range_goal($gid,$start_date,$end_date)
	{
		$query = $this->db->query("SELECT * from project_history where gid = '".$gid."' and DATE(h_date) BETWEEN '".$start_date."' and '".$end_date."' ORDER BY hid DESC");
        return $query->result();
	}

	function view_all_history_goal($gid)
	{
		$this->db->order_by('hid', 'DESC');
		//$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('gid', $gid);
		$query = $this->db->get('project_history');
		return $query->result();
	}

	function view_history_date_strategy($sid)
	{
		$query = $this->db->query("SELECT DATE(h_date) DateOnly from project_history where sid = '".$sid."'GROUP BY DateOnly ORDER BY hid DESC");
        return $query->result();
	}

	function view_history_strategy($sid,$hdate)
	{
		$this->db->order_by('hid', 'DESC');
		$this->db->like('h_date', $hdate);
		$this->db->where('sid', $sid);
		//$this->db->where('reg_acc_status !=','deactivated');
		$query = $this->db->get('project_history');
		return $query->result();
	}

	function view_history_only_date_strategy($sid,$only_date)
	{
		$this->db->order_by('hid', 'DESC');
		$this->db->like('h_date', $only_date);
		$this->db->where('sid', $sid);
		//$this->db->where('reg_acc_status !=','deactivated');
		$query = $this->db->get('project_history');
		return $query->result();
	}

	function view_history_date_range_strategy($sid,$start_date,$end_date)
	{
		$query = $this->db->query("SELECT * from project_history where sid = '".$sid."' and DATE(h_date) BETWEEN '".$start_date."' and '".$end_date."' ORDER BY hid DESC");
        return $query->result();
	}

	function view_all_history_strategy($sid)
	{
		$this->db->order_by('hid', 'DESC');
		//$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('sid', $sid);
		$query = $this->db->get('project_history');
		return $query->result();
	}

	function GoalsAllStrategiesList_not_in_trash($id)
	{
		$this->db->order_by('sid','DESC');
		$this->db->where('gid', $id);
		$this->db->where('s_single_trash', '');
		$query = $this->db->get('strategies');
		return $query->result();
	}

	function GoalsAllStrategiesList_in_trash($id)
	{
		$this->db->order_by('sid','DESC');
		$this->db->where('gid', $id);
		$this->db->where('s_single_trash', 'g_yes');
		$query = $this->db->get('strategies');
		return $query->result();
	}

	function StrategyAllProjectsList_not_in_trash($id)
	{
		$this->db->order_by('pid', 'DESC');
		$this->db->where('sid', $id);
		$this->db->where('psingle_trash', '');
		$query = $this->db->get('project');
		return $query->result();
	}

	function StrategyAllProjectsList_in_trash($id)
	{
		$this->db->order_by('pid', 'DESC');
		$this->db->where('sid', $id);
		$this->db->where('psingle_trash', 'g_yes');
		$query = $this->db->get('project');
		return $query->result();
	}

	function StrategyAllProjectsList_in_trash_strategybulk($id)
	{
		$this->db->order_by('pid', 'DESC');
		$this->db->where('sid', $id);
		$this->db->where('psingle_trash', 's_yes');
		$query = $this->db->get('project');
		return $query->result();
	}

	function TrashGoals($port_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_id', $port_id);
    	$this->db->where('gcreated_by', $this->session->userdata('d168_id'));
		$this->db->where('g_trash', 'yes');
		$this->db->where('g_archive !=', 'yes');
    	$query = $this->db->get('goals');
    	return $query->result();
    }

    function TrashStrategies($port_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_id', $port_id);
    	$this->db->where('screated_by', $this->session->userdata('d168_id'));
		$this->db->where('s_trash', 'yes');
		$this->db->where('s_archive !=', 'yes');
    	$query = $this->db->get('strategies');
    	return $query->result();
    }

    function check_goal_trash($id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('gid', $id);
    	$this->db->where('g_trash', 'yes');
    	$this->db->where('gcreated_by', $this->session->userdata('d168_id'));
    	$query = $this->db->get('goals');
    	return $query->row();
    }

    function edit_goal_tasksRetrieve($data8,$id)
	{
		$this->db->where('tsingle_trash','g_yes');
		$this->db->where('tproject_assign', $id);
		if($this->db->update('task', $data8))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function edit_goal_subtasksRetrieve($data9,$id)
	{
		$this->db->where('stsingle_trash','g_yes');
		$this->db->where('stproject_assign', $id);
		if($this->db->update('subtask', $data9))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function edit_goal_cpRetrieve($data10,$id)
	{
		$this->db->where('cpsingle_trash','g_yes');
		$this->db->where('pc_project_assign', $id);
		if($this->db->update('content_planning', $data10))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function check_strategy_trash($id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('sid', $id);
    	$this->db->where('s_trash', 'yes');
    	$this->db->where('screated_by', $this->session->userdata('d168_id'));
    	$query = $this->db->get('strategies');
    	return $query->row();
    }

    function checkStrategyGoalTrash($gid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('gid',$gid);
    	$this->db->where('g_trash','yes');
    	$query = $this->db->get('goals');
    	return $query->num_rows();
    }

    function edit_strategy_tasksRetrieve($data8,$id)
	{
		$this->db->where('tsingle_trash','s_yes');
		$this->db->where('tproject_assign', $id);
		if($this->db->update('task', $data8))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function edit_strategy_subtasksRetrieve($data9,$id)
	{
		$this->db->where('stsingle_trash','s_yes');
		$this->db->where('stproject_assign', $id);
		if($this->db->update('subtask', $data9))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function edit_strategy_cpRetrieve($data10,$id)
	{
		$this->db->where('cpsingle_trash','s_yes');
		$this->db->where('pc_project_assign', $id);
		if($this->db->update('content_planning', $data10))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function portfolio_goalsTrash($c_id)
	{
		$this->db->order_by('gid','DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_id',$c_id);
		$query = $this->db->get('goals');
		return $query->result();
	}

	function portfolio_strategiesTrash($c_id)
	{
		$this->db->order_by('sid','DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_id',$c_id);
		$query = $this->db->get('strategies');
		return $query->result();
	}

	function UpdatePortfolioGoal($data,$c_id)
	{
		$this->db->where('portfolio_id',$c_id);
		if($this->db->update('goals',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function UpdatePortfolioStrategies($data,$c_id)
	{
		$this->db->where('portfolio_id',$c_id);
		if($this->db->update('strategies',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function checkProjectStrategyTrash($sid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('sid',$sid);
    	$this->db->where('s_trash','yes');
    	$query = $this->db->get('strategies');
    	return $query->num_rows();
    }

    function UpdatePortfolioGoalArchiveRetrieve($data,$c_id)
	{
		$this->db->where('gsingle_trash','');
		$this->db->where('portfolio_id',$c_id);
		if($this->db->update('goals',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function UpdatePortfolioStrategiesArchiveRetrieve($data,$c_id)
	{
		$this->db->where('s_single_trash','');
		$this->db->where('portfolio_id',$c_id);
		if($this->db->update('strategies',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function delete_portfolio_goals($id)
	{
		$this->db->where('portfolio_id',$id);
		if($this->db->delete('goals'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function delete_portfolio_strategies($id)
	{
		$this->db->where('portfolio_id',$id);
		if($this->db->delete('strategies'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function delete_portfolio_dept($id)
	{
		$this->db->where('portfolio_id',$id);
		if($this->db->delete('project_portfolio_department'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function get_goal_trash_date($get_today_date)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('g_trash_date',$get_today_date);
		$query = $this->db->get('goals');
		return $query->result();
	}

	function delete_goal($id)
	{
		$this->db->where('gid',$id);
		if($this->db->delete('goals'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function GoalsAllStrategiesList_to_delete($id)
	{
		$this->db->order_by('sid','DESC');
		$this->db->where('gid', $id);
		$query = $this->db->get('strategies');
		return $query->result();
	}

	function delete_strategies($id)
	{
		$this->db->where('sid',$id);
		if($this->db->delete('strategies'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function StrategyAllProjectsList_to_delete($get_strategy_id)
	{
		$this->db->order_by('pid', 'DESC');
		$this->db->where('sid', $get_strategy_id);
		$query = $this->db->get('project');
		return $query->result();
	}

	function get_strategies_trash_date($get_today_date)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('s_trash_date',$get_today_date);
		$query = $this->db->get('strategies');
		return $query->result();
	}

	function ArchiveGoals($port_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_id', $port_id);
    	$this->db->where('gcreated_by', $this->session->userdata('d168_id'));
		$this->db->where('g_archive','yes');
		$this->db->where('g_trash !=','yes');
    	$query = $this->db->get('goals');
    	return $query->result();
    }

    function ArchiveStrategies($port_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_id', $port_id);
    	$this->db->where('screated_by', $this->session->userdata('d168_id'));
		$this->db->where('s_archive','yes');
		$this->db->where('s_trash !=','yes');
    	$query = $this->db->get('strategies');
    	return $query->result();
    }

    function check_goal_archive($id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('gid', $id);
    	$this->db->where('g_archive', 'yes');
    	$this->db->where('gcreated_by', $this->session->userdata('d168_id'));
    	$query = $this->db->get('goals');
    	return $query->row();
    }

    function check_strategy_archive($id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('sid', $id);
    	$this->db->where('s_archive', 'yes');
    	$this->db->where('screated_by', $this->session->userdata('d168_id'));
    	$query = $this->db->get('strategies');
    	return $query->row();
    }

    function checkStrategyGoalArchive($gid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('gid',$gid);
    	$this->db->where('g_archive','yes');
    	$query = $this->db->get('goals');
    	return $query->num_rows();
    }

    function checkProjectStrategyArchive($sid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('sid',$sid);
    	$this->db->where('s_archive','yes');
    	$query = $this->db->get('strategies');
    	return $query->num_rows();
    }

    function GoalsAllStrategiesListASC($get_goal_id)
	{
		$this->db->order_by('sid','ASC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('gid', $get_goal_id);
		$this->db->where('s_trash !=', 'yes');
		$this->db->where('s_archive !=', 'yes');
		$this->db->where('s_file_it !=', 'yes');
		$query = $this->db->get('strategies');
		return $query->result();
	}

	function StrategyAllProjectsListASC($get_strategy_id)
	{
		$this->db->order_by('pid', 'ASC');
		$this->db->where('reg_acc_status !=','deactivated');
		//$this->db->where('ptype', 'goal_strategy');
		$this->db->where('sid', $get_strategy_id);
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$query = $this->db->get('project');
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
		$this->db->where('g_file_it', '');
		$query = $this->db->get('goals');
		return $query->result();
	}

	function TMOpenStrategies($reg_id,$portfolio_id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('screated_by', $reg_id);
		$this->db->where('portfolio_id', $portfolio_id);
		$this->db->where('s_trash', '');
		$this->db->where('s_archive', '');
		$this->db->where('s_file_it', '');
		$query = $this->db->get('strategies');
		return $query->result();
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

	function get_all_goals($id)
	{
		$this->db->where('portfolio_id',$id);
		$query = $this->db->get('goals');
		return $query->result();
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

	function deleteGoals_portfolio($id)
	{
		$this->db->where('portfolio_id',$id);
		$this->db->delete('goals');
	}

	function deleteStartegies_portfolio($id)
	{
		$this->db->where('portfolio_id',$id);
		$this->db->delete('strategies');
	}

	function deleteGoals($id)
	{
		$this->db->where('gid',$id);
		$this->db->delete('goals');
	}

	function deleteStartegies($id)
	{
		$this->db->where('sid',$id);
		$this->db->delete('strategies');
	}

	function get_pro_managers_gid($gid)
	{
		$this->db->order_by('pid', 'ASC');
		$this->db->group_by('pmanager');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('pmanager !=', '0');
		$this->db->where('gid', $gid);
		$this->db->where('ptrash', '');
		$this->db->where('project_archive', '');
		$this->db->where('project_file_it', '');
		$query = $this->db->get('project');
		return $query->result();
	}

	function get_pro_managers_sid($sid)
	{
		$this->db->order_by('pid', 'ASC');
		$this->db->group_by('pmanager');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('pmanager !=', '0');
		$this->db->where('sid', $sid);
		$this->db->where('ptrash', '');
		$this->db->where('project_archive', '');
		$this->db->where('project_file_it', '');
		$query = $this->db->get('project');
		return $query->result();
	}

	// function GoalsStrategiesAllList()
 //    {
 //        $this->db->order_by('portfolio_id', 'DESC');
 //        $this->db->where('reg_acc_status !=','deactivated');
 //        $this->db->where('ptype', 'goal_strategy');
 //        $this->db->where('ptrash !=', 'yes');
 //        $this->db->where('project_archive !=', 'yes');
 //        $this->db->where('project_file_it !=', 'yes');
 //        $this->db->where('pcreated_by', $this->session->userdata('d168_id'));
 //        $query = $this->db->get('project');
 //        return $query->result();
 //    }

	function check_GoalPMToClear($id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('gmid',$id);
    	$query = $this->db->get('goals_members');
        return $query->row();
    }

    function delete_gMember($gmid)
	{
		$this->db->where('gmid', $gmid);
		if($this->db->delete('goals_members'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}		
	}

	function GoalTMOpenStrategies($reg_id,$portfolio_id,$gid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('screated_by', $reg_id);
		$this->db->where('gid', $gid);
		$this->db->where('portfolio_id', $portfolio_id);
		$this->db->where('s_trash', '');
		$this->db->where('s_archive', '');
		$this->db->where('s_file_it', '');
		$query = $this->db->get('strategies');
		return $query->result();
	}

	function GoalTMOpenProjects($reg_id,$portfolio_id,$gid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->group_start();
    	$this->db->where('pcreated_by', $reg_id);
    	$this->db->or_where('pmanager', $reg_id);
    	$this->db->group_end();
		$this->db->where('gid', $gid);
    	$this->db->where('portfolio_id', $portfolio_id);
    	$this->db->where('ptrash','');
    	$this->db->where('project_archive','');
    	$this->db->where('project_file_it','');
    	$query = $this->db->get('project');
        return $query->result();
    }

    function GoalTMOpenPlannedContent($reg_id,$portfolio_id,$gid)
    {
    	$this->db->where('cp.reg_acc_status !=','deactivated');
    	$this->db->group_start();
    	$this->db->where('cp.written_content_assignee', $reg_id);
    	$this->db->or_where('cp.pc_file_assignee', $reg_id);
    	$this->db->or_where('cp.submit_to_approval', $reg_id);
    	$this->db->or_where('cp.pc_assignee', $reg_id);
    	$this->db->group_end();
		$this->db->where('p.gid', $gid);
    	$this->db->where('cp.portfolio_id', $portfolio_id);
    	$this->db->where('cp.trash','');
    	$this->db->where('cp.cp_archive','');
    	$this->db->where('cp.cp_file_it','');
    	$this->db->select('*');
        $this->db->from('content_planning as cp');
        $this->db->join('project as p','p.pid = cp.pc_project_assign');
        $query = $this->db->get();
        return $query->result();
    }

    function GoalTMOpenTasks($reg_id,$portfolio_id,$gid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->group_start();
    	$this->db->where('tassignee', $reg_id);
    	$this->db->or_where('tcreated_by', $reg_id);
    	$this->db->group_end();
		$this->db->where('gid', $gid);
    	$this->db->where('portfolio_id', $portfolio_id);
    	$this->db->where('tproject_assign !=', '0');
    	$this->db->where('trash','');
    	$this->db->where('task_archive','');
    	$this->db->where('task_file_it','');
    	$query = $this->db->get('task');
        return $query->result();
    }

    function GoalTMOpenSubtasks($reg_id,$portfolio_id,$gid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->group_start();
    	$this->db->where('stassignee', $reg_id);
    	$this->db->or_where('stcreated_by', $reg_id);
    	$this->db->group_end();
		$this->db->where('gid', $gid);
    	$this->db->where('portfolio_id', $portfolio_id);
    	$this->db->where('stproject_assign !=', '0');
    	$this->db->where('strash','');
    	$this->db->where('subtask_archive','');
    	$this->db->where('subtask_file_it','');
    	$query = $this->db->get('subtask');
        return $query->result();
    }

    function GoalgetProjectOpenTM($reg_id,$portfolio_id,$gid)
    {
    	$this->db->where('pm.reg_acc_status !=','deactivated');
    	$this->db->where('pm.pmember', $reg_id);
		$this->db->where('p.gid', $gid);
    	$this->db->where('pm.portfolio_id', $portfolio_id);
    	$this->db->where('pm.ptrash','');
    	$this->db->where('pm.project_archive','');
    	$this->db->where('pm.project_file_it','');
    	$this->db->select('*, p.pid as pid, pm.pid as pm_pid');
        $this->db->from('project_members as pm');
        $this->db->join('project as p','p.pid = pm.pid');
        $query = $this->db->get();
        return $query->result();
    }

    function delete_iGMember($gid,$igm_id)
	{
		$this->db->where('gid', $gid);
		$this->db->where('igm_id', $igm_id);
		if($this->db->delete('goals_invited_members'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}		
	}

	function update_GoalSuggestTeamMember($data,$gid,$suggest_id)
	{
		$this->db->where('gid', $gid);
		$this->db->where('suggest_id', $suggest_id);
		if($this->db->update('goals_suggested_members', $data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function edit_goal_invited_members($data3,$id)
	{
		$this->db->where('gid', $id);
		if($this->db->update('goals_invited_members', $data3))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function edit_goal_members($data6,$id)
	{
		$this->db->where('gid', $id);
		if($this->db->update('goals_members', $data6))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function edit_goal_suggested_members($data7,$id)
	{
		$this->db->where('gid', $id);
		if($this->db->update('goals_suggested_members', $data7))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function getMemberGoal($gid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('gid',$gid);
		$query = $this->db->get('goals_members');
		return $query->result();
	}

	function check_if_already_goaltm($reg_id,$portfolio_id,$gid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('gid', $gid);
    	$this->db->where('gmember', $reg_id);
    	$this->db->where('portfolio_id', $portfolio_id);
    	$this->db->where('g_trash','');
    	$this->db->where('g_archive','');
    	$this->db->where('g_file_it','');
    	$query = $this->db->get('goals_members');
        return $query->num_rows();
    }

    function check_if_goaltm($gid,$new_reg_id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('gmember', $new_reg_id);
    	$this->db->where('gid', $gid);
    	$query = $this->db->get('goals_members');
        return $query->row();
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

	function updateGoalManager($data,$id)
	{
		$this->db->where('gmanager',$id);
		$this->db->update('goals',$data);
	}

	function check_if_gtm2($gid,$new_reg_id)
	{
		$this->db->where('gmember', $new_reg_id);
    	$this->db->where('gid', $gid);
    	$query = $this->db->get('goals_members');
        return $query->row();
	}

	function check_if_gsm2($gid,$new_reg_id)
	{
		$this->db->where('suggest_id', $new_reg_id);
    	$this->db->where('gid', $gid);
    	$query = $this->db->get('goals_suggested_members');
        return $query->row();
	}

	function delete_if_gsm2($gid,$gmember)
	{
		//$this->db->where('pcreated_by', $this->session->userdata('d168_id'));
		$this->db->where('gid', $gid);
		$this->db->where('suggest_id', $gmember);
		if($this->db->delete('goals_suggested_members'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}		
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

    //////Goal & Strategies Part End///////

    function insert_contact_sales($data)
	{
		if($this->db->insert('contact_sales',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function check_contacted()
	{
		$this->db->where('reg_id', $this->session->userdata('d168_id'));
        $query = $this->db->get('contact_sales');
        return $query->row();
	}

	function active_ad()
	{
		$this->db->order_by('aid','DESC');
		$this->db->where('astatus','active');
		$query = $this->db->get('ad_list');
		return $query->row();
	}

	function updateContactSales($data,$id)
	{
		$this->db->where('reg_id',$id);
		$this->db->update('contact_sales',$data);
	}

	function deleteContactSales($id)
	{
		$this->db->where('reg_id',$id);
		$this->db->delete('contact_sales');		
	}

	//////--- File Cabinet Part Start ---///////

	function file_itcheck_platform2($pc_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('pc_id', $pc_id);
    	$this->db->where('trash', 'yes');
		$this->db->where('cp_archive !=', 'yes');
    	$query = $this->db->get('content_planning');
    	return $query->row();
    }

	function file_itcheck_platform($pc_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('pc_id', $pc_id);
    	$this->db->where('trash !=', 'yes');
		$this->db->where('cp_archive !=', 'yes');
    	$query = $this->db->get('content_planning');
    	return $query->row();
    }

	function file_itProjectDetailPortfolio($id)
	{		
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('pid',$id);
		$query = $this->db->get('project');
		return $query->row();
	}

	function file_itcheck_subtask($stid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('stid', $stid);
    	$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
    	$query = $this->db->get('subtask');
    	return $query->row();
    }

	function file_itgetTaskById($tid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('tid', $tid);
		$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$query = $this->db->get('task');
		return $query->row();
	}

	function file_itcheck_task($tid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('tid', $tid);
    	$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
    	$query = $this->db->get('task');
    	return $query->row();
    }

	function file_itgetMemberProject($pid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('pid',$pid);
		$query = $this->db->get('project_members');
		return $query->result();
	}

	function download_PFileAttachmentfile_it($id,$pfile_id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('pfile_id', $pfile_id);
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('pid',$id);
		$query = $this->db->get('project_files');
		return $query->row();
	}

	function pfile_detailfile_it($id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('pfile_id', $id);
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('ptrash !=', 'yes');
		$query = $this->db->get('project_files');
		return $query->row();
	}

	function check_strategy_file_it($id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('sid', $id);
    	$this->db->where('s_file_it', 'yes');
    	$this->db->where('screated_by', $this->session->userdata('d168_id'));
    	$query = $this->db->get('strategies');
    	return $query->row();
    }

	function check_goal_file_it($id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('gid', $id);
    	$this->db->where('g_file_it', 'yes');
    	$this->db->where('gcreated_by', $this->session->userdata('d168_id'));
    	$query = $this->db->get('goals');
    	return $query->row();
    }

	function check_platform_file_it($id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('pc_id', $id);
    	$this->db->where('cp_file_it', 'yes');
    	$query = $this->db->get('content_planning');
    	return $query->row();
    }

	function checkSubtaskTaskfile_it($tid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('tid',$tid);
    	$this->db->where('task_file_it','yes');
    	$query = $this->db->get('task');
    	return $query->num_rows();
    }

	function check_subtask_file_it($id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('stid', $id);
    	$this->db->where('subtask_file_it', 'yes');
    	$query = $this->db->get('subtask');
    	return $query->row();
    }

	function checkTaskProjectfile_it($pid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('pid',$pid);
    	$this->db->where('project_file_it','yes');
    	$query = $this->db->get('project');
    	return $query->num_rows();
    }

	function check_task_file_it($id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('tid', $id);
    	$this->db->where('task_file_it', 'yes');
    	$query = $this->db->get('task');
    	return $query->row();
    }

	function checkProjectStrategyfile_it($sid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('sid',$sid);
    	$this->db->where('s_file_it','yes');
    	$query = $this->db->get('strategies');
    	return $query->num_rows();
    }

	function check_project_file_it($id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('pid', $id);
    	$this->db->where('project_file_it', 'yes');
    	$query = $this->db->get('project');
    	return $query->row();
    }

	function checkStrategyGoalfile_it($gid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('gid',$gid);
    	$this->db->where('g_file_it','yes');
    	$query = $this->db->get('goals');
    	return $query->num_rows();
    }

	function checkProjectPorfoliofile_it($port_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('portfolio_id',$port_id);
    	$this->db->where('portfolio_file_it','yes');
    	$query = $this->db->get('project_portfolio');
    	return $query->num_rows();
    }

	function file_itcheck_subtask_assignee_status($stid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('stid', $stid);
		$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it', 'yes');
		$this->db->where('stassignee', $this->session->userdata('d168_id'));
		$query = $this->db->get('subtask');
		return $query->row();
	}

	function file_itcheck_assignee_status($tid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('tid', $tid);
		$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it', 'yes');
		$this->db->where('tassignee', $this->session->userdata('d168_id'));
		$query = $this->db->get('task');
		return $query->row();
	}

	function file_itCheck_Task_Subtasks2($tid)
	{
		$this->db->order_by('stid','DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('strash !=','yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it', 'yes');
		$this->db->where('tid',$tid);
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function file_itcheck_project_suggested_member($pid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('status', 'suggested');
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it', 'yes');
		$this->db->where('suggest_id', $this->session->userdata('d168_id'));
		$this->db->where('pid', $pid);
		$query = $this->db->get('project_suggested_members');
		return $query->num_rows();
	}

	function file_itProjectFile($pid)
	{
		$this->db->order_by('pfile_id','DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('pid', $pid);
		$this->db->where('project_archive', '');
		$this->db->where('project_file_it', 'yes');
		$this->db->where('ptrash', '');
		$query = $this->db->get('project_files');
		return $query->result();
	}

	function file_itCheckProjectTeamMember($pid)
	{
		$this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->where('pm.pid', $pid);
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));
		$this->db->where('pm.ptrash !=', 'yes');
		$this->db->where('pm.project_archive !=', 'yes');
		$this->db->where('pm.project_file_it', 'yes');
		$this->db->select('r.reg_id,r.first_name,r.last_name,r.photo,pm_id,pm.status,pm.pmember');
        $this->db->from('registration as r');
        $this->db->join('project_members as pm', 'pm.pmember = r.reg_id');
        $query = $this->db->get();
        return $query->result();
	}

	function file_itprogress_done($pid)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM task where tproject_assign='".$pid."' and trash != 'yes' and task_archive != 'yes' and task_file_it = 'yes' and tstatus='done' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function file_itprogress_total($pid)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM task where tproject_assign='".$pid."' and trash != 'yes' and task_archive != 'yes' and task_file_it = 'yes' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function file_itsub_progress_done($pid)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM subtask where stproject_assign='".$pid."' and strash != 'yes' and subtask_archive != 'yes' and subtask_file_it = 'yes' and ststatus='done' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function file_itsub_progress_total($pid)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM subtask where stproject_assign='".$pid."' and strash != 'yes' and subtask_archive != 'yes' and subtask_file_it = 'yes' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

	function file_itSubtaskDetail($id)
	{
		$this->db->where('st.reg_acc_status !=','deactivated');
		$this->db->where('st.stid', $id);
		$this->db->where('st.strash !=', 'yes');
		$this->db->where('st.subtask_archive !=', 'yes');
		$this->db->where('st.subtask_file_it', 'yes');
		$this->db->select('*');
        $this->db->from('registration as r');
        $this->db->join('subtask as st', 'st.stcreated_by = r.reg_id');
        $query = $this->db->get();
        return $query->row();
	}

	function file_itTaskDetail($id)
	{
		$this->db->where('t.reg_acc_status !=','deactivated');
		$this->db->where('t.tid', $id);
		$this->db->where('t.trash !=', 'yes');
		$this->db->where('t.task_archive !=', 'yes');
		$this->db->where('t.task_file_it', 'yes');
		$this->db->select('*');
        $this->db->from('registration as r');
        $this->db->join('task as t', 't.tcreated_by = r.reg_id');
        $query = $this->db->get();
        return $query->row();
	}

	function file_itp_tasks($id)
	{
		$this->db->order_by('tid', 'DESC');
    	$this->db->group_by('tassignee');
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it', 'yes');
		$this->db->where('tproject_assign', $id);
		$query = $this->db->get('task');
		return $query->result();
	}

	function file_itp_subtasks($id)
	{
		$this->db->order_by('stid', 'DESC');
    	$this->db->group_by('stassignee');
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it', 'yes');
		$this->db->where('stproject_assign', $id);
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function file_itEdit_Team_Members($id)
	{		
		$query = $this->db->query('select r.reg_id,r.first_name,r.last_name from registration r where r.reg_id !="'.$this->session->userdata('d168_id').'" and r.reg_acc_status != "deactivated" and verified = "yes" and NOT EXISTS(select * from project_members pm where pm.pmember = r.reg_id and pm.reg_acc_status != "deactivated" and pm.ptrash != "yes" and project_archive != "yes" and project_file_it = "yes" and pm.pid = "'.$id.'")');
        
        return $query->result();
	}

	function file_itStrategyAllProjectsList($get_strategy_id)
	{
		$this->db->order_by('pid', 'DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		//$this->db->where('ptype', 'goal_strategy');
		$this->db->where('sid', $get_strategy_id);
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it', 'yes');
		$query = $this->db->get('project');
		return $query->result();
	}

	function file_itGoalsAllStrategiesList($get_goal_id)
	{
		$this->db->order_by('sid','DESC');
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('gid', $get_goal_id);
		$this->db->where('s_trash !=', 'yes');
		$this->db->where('s_archive !=', 'yes');
		$this->db->where('s_file_it', 'yes');
		$query = $this->db->get('strategies');
		return $query->result();
	}

	function file_itStrategyprogress_done($sid)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM task where sid='".$sid."' and trash != 'yes' and task_archive != 'yes' and tstatus='done' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function file_itStrategyprogress_total($sid)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM task where sid='".$sid."' and trash != 'yes' and task_archive != 'yes' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function file_itStrategysub_progress_done($sid)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM subtask where sid='".$sid."' and strash != 'yes' and subtask_archive != 'yes' and ststatus='done' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function file_itStrategysub_progress_total($sid)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM subtask where sid='".$sid."' and strash != 'yes' and subtask_archive != 'yes' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

	function file_itGoalprogress_done($gid)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM task where gid='".$gid."' and trash != 'yes' and task_archive != 'yes' and tstatus='done' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function file_itGoalprogress_total($gid)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM task where gid='".$gid."' and trash != 'yes' and task_archive != 'yes' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function file_itGoalsub_progress_done($gid)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM subtask where gid='".$gid."' and strash != 'yes' and subtask_archive != 'yes' and ststatus='done' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

    function file_itGoalsub_progress_total($gid)
    {
        $query = $this->db->query("SELECT COUNT(*) as count_rows FROM subtask where gid='".$gid."' and strash != 'yes' and subtask_archive != 'yes' and reg_acc_status != 'deactivated'");
        return $query->row_array();
    }

	function file_itgetGoalCount($port_id)
	{
		$query = $this->db->query("SELECT COUNT(*) as goal_count_rows FROM goals where gcreated_by='".$this->session->userdata('d168_id')."' and g_trash = '' and g_archive = '' and portfolio_id = '".$port_id."' and reg_acc_status != 'deactivated'");
		return $query->row_array();
	}

	function file_itgetStrategiesCount($port_id,$gid)
	{
		$query = $this->db->query("SELECT COUNT(*) as strategy_count_rows FROM strategies where screated_by='".$this->session->userdata('d168_id')."' and s_trash = '' and s_archive = '' and portfolio_id = '".$port_id."' and gid = '".$gid."' and reg_acc_status != 'deactivated'");
		return $query->row_array();
	}

	function file_itgetPortfolio2($c_id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_archive !=', 'yes');
		$this->db->where('portfolio_id',$c_id);
		$query = $this->db->get('project_portfolio');
		return $query->row();
	}

	function file_itGoalDetailAccepted($id)
    {
        $this->db->where('gm.reg_acc_status !=','deactivated');
        $this->db->where('gm.gmember', $this->session->userdata('d168_id'));
        $this->db->where('g.g_trash !=', 'yes');
        $this->db->where('g.g_archive !=', 'yes');
        $this->db->where('gm.status', 'accepted'); 
		$this->db->where('gm.gid', $id);       
        $this->db->select('*, g.gid as gid, gm.gid as pm_gid');
        $this->db->from('goals as g');
        $this->db->join('goals_members as gm','gm.gid = g.gid');
        $query = $this->db->get();
        return $query->num_rows();
    }

	function file_itgetTasksDetail($tid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('tid',$tid);
		$this->db->where('task_archive !=', 'yes');
		$query = $this->db->get('task');
		return $query->row();
	}

	function file_itget_task_details($tid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('tid', $tid);
		$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$query = $this->db->get('task');
		return $query->row();
	}

	function file_itgetProjectById($id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('pid', $id);
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
    	$query = $this->db->get('project');
    	return $query->row();
    }

    function file_itgetProjectById2($id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('project_archive !=', 'yes');
    	$this->db->where('pid', $id);
    	$query = $this->db->get('project');
    	return $query->row();
    }

	function file_itcheck_DonePlatform($pc_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('pc_id', $pc_id);
    	$this->db->where('trash !=', 'yes');
		$this->db->where('cp_archive !=', 'yes');
		$this->db->where('pc_status', 'done');
        $query = $this->db->get('content_planning');
    	return $query->row();
    }

	function file_itcheck_sflag($stid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('stid', $stid);
    	$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
    	$query = $this->db->get('subtask');
    	return $query->row();
    }

	function file_itcheck_Donesubtask($stid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('stid', $stid);
    	$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('ststatus','done');
    	$query = $this->db->get('subtask');
    	return $query->row();
    }

	function file_itgetTaskAllSubtaskNotFile($id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('strash !=','yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('tid',$id);
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function file_itcheck_flag($tid)
	{
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('tid', $tid);
    	$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
    	$query = $this->db->get('task');
    	return $query->row();
    }
	function file_itcheck_Donetask($tid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('tid', $tid);
    	$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('tstatus', 'done');
    	$query = $this->db->get('task');
    	return $query->row();
    }

	function file_itgetProjectAllCPNotArc($id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('trash !=','yes');
		$this->db->where('cp_archive !=', 'yes');
		$this->db->where('pc_project_assign',$id);
		$query = $this->db->get('content_planning');
		return $query->result();
	}

	function file_itgetProjectAllTaskNotArc($id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('trash !=','yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('tproject_assign',$id);
		$query = $this->db->get('task');
		return $query->result();
	}

	function file_itgetProjectAllSubtaskNotArc($id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('strash !=','yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('stproject_assign',$id);
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function file_itgetTaskAllSubtaskNotArc($id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('strash !=','yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('tid',$id);
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function file_itStrategy_tasks($id)
	{
		$this->db->order_by('tid', 'DESC');
    	//$this->db->group_by('tassignee');
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('sid', $id);
		$query = $this->db->get('task');
		return $query->result();
	}

	function file_itStrategy_subtasks($id)
	{
		$this->db->order_by('stid', 'DESC');
    	//$this->db->group_by('stassignee');
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('sid', $id);
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function file_itGoal_tasks($id)
	{
		$this->db->order_by('tid', 'DESC');
    	//$this->db->group_by('tassignee');
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('gid', $id);
		$query = $this->db->get('task');
		return $query->result();
	}

	function file_itGoal_subtasks($id)
	{
		$this->db->order_by('stid', 'DESC');
    	//$this->db->group_by('stassignee');
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('gid', $id);
		$query = $this->db->get('subtask');
		return $query->result();
	}

    function file_itStrategyDetail($id)
	{		
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('s_trash !=', 'yes');
		$this->db->where('s_archive !=', 'yes');
		$this->db->where('sid',$id);
		$query = $this->db->get('strategies');
		return $query->row();
	}

	function file_itGoalDetail($id)
	{		
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('g_trash !=', 'yes');
		$this->db->where('g_archive !=', 'yes');
		$this->db->where('gid',$id);
		$query = $this->db->get('goals');
		return $query->row();
	}

	function file_itProjectDetail2($id)
	{		
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('pid',$id);
		$query = $this->db->get('project');
		return $query->row();
	}

	function file_itProjectDetail($id)
	{		
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('pcreated_by', $this->session->userdata('d168_id'));
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('pid',$id);
		$query = $this->db->get('project');
		return $query->row();
	}

	function getTaskAllSubtaskNotFile($id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('strash !=','yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it !=', 'yes');
		$this->db->where('tid',$id);
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function file_itGoalsCountDeptWise($port_id,$dept_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_id', $port_id);
		$this->db->where('gdept', $dept_id);
    	$this->db->where('gcreated_by', $this->session->userdata('d168_id'));
		$this->db->where('g_archive !=','yes');
		$this->db->where('g_file_it','yes');
		$this->db->where('g_trash !=','yes');
    	$query = $this->db->get('goals');
    	return $query->num_rows();
    }

	function file_itAcceptedGoalsCountDeptWise($port_id,$dept_id)
    {
        $this->db->order_by('p.portfolio_id', 'DESC');
        $this->db->group_by('p.gid');
        $this->db->where('p.gid !=','0');
        $this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->where('p.portfolio_id', $port_id);
		$this->db->where('p.dept_id', $dept_id);
        $this->db->where('p.ptrash !=', 'yes');
        $this->db->where('p.project_archive !=', 'yes');
        $this->db->where('p.project_file_it','yes');
        $this->db->where('g.g_file_it','yes');
        $this->db->where('pm.status', 'accepted');
        $this->db->where('pm.pmember', $this->session->userdata('d168_id'));
        $this->db->select('p.gid');
        $this->db->from('project as p');
        $this->db->join('project_members as pm','pm.pid = p.pid');
        $this->db->join('goals as g','g.gid = p.gid');
        $query = $this->db->get();
        return $query->num_rows();
    }

    function file_itStrategiesCountDeptWise($port_id,$dept_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_id', $port_id);
		$this->db->where('gdept_id', $dept_id);
    	$this->db->where('screated_by', $this->session->userdata('d168_id'));
		$this->db->where('s_archive !=','yes');
		$this->db->where('s_file_it','yes');
		$this->db->where('s_trash !=','yes');
    	$query = $this->db->get('strategies');
    	return $query->num_rows();
    }

    function file_itAcceptedStrategiesCountDeptWise($port_id,$dept_id)
    {
        $this->db->order_by('p.portfolio_id', 'DESC');
        $this->db->group_by('p.sid');
        $this->db->where('p.sid !=','0');
        $this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->where('p.portfolio_id', $port_id);
		$this->db->where('p.dept_id', $dept_id);
        $this->db->where('p.ptrash !=', 'yes');
        $this->db->where('p.project_archive !=', 'yes');
        $this->db->where('p.project_file_it','yes');
        $this->db->where('s.s_file_it','yes');
        $this->db->where('pm.status', 'accepted');
        $this->db->where('pm.pmember', $this->session->userdata('d168_id'));
        $this->db->select('p.sid');
        $this->db->from('project as p');
        $this->db->join('project_members as pm','pm.pid = p.pid');
        $this->db->join('strategies as s','s.sid = p.sid');
        $query = $this->db->get();
        return $query->num_rows();
    }

	function file_itProjectCountDeptWise($port_id,$dept_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_id', $port_id);
		$this->db->where('dept_id', $dept_id);
    	$this->db->where('pcreated_by', $this->session->userdata('d168_id'));
		$this->db->where('project_archive !=','yes');
		$this->db->where('project_file_it','yes');
		$this->db->where('ptrash !=','yes');
    	$query = $this->db->get('project');
    	return $query->num_rows();
    }

    function file_itAcceptedProjectCountDeptWise($port_id,$dept_id)
	{
		$this->db->order_by('p.portfolio_id', 'DESC');
		$this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->where('p.portfolio_id', $port_id);
		$this->db->where('p.dept_id', $dept_id);
		$this->db->where('p.ptrash !=', 'yes');
		$this->db->where('p.project_archive !=', 'yes');
		$this->db->where('p.project_file_it','yes');
		$this->db->where('pm.status', 'accepted');
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');
        $this->db->from('project as p');
        $this->db->join('project_members as pm','pm.pid = p.pid');
        $query = $this->db->get();
        return $query->num_rows();
	}

    function file_itTaskCountDeptWise($port_id,$dept_id)
	{
		$this->db->order_by('date(tstatus_date)', 'DESC');
		$this->db->where('t.reg_acc_status !=','deactivated');
		$this->db->where('trash !=','yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it', 'yes');
		$this->db->where('t.portfolio_id', $port_id);
		$this->db->where('t.dept_id', $dept_id);
		$this->db->group_start();
    	$this->db->where('tcreated_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('tassignee', $this->session->userdata('d168_id'));
    	$this->db->or_where('p.pcreated_by', $this->session->userdata('d168_id'));
    	$this->db->group_end();
		$this->db->select('*');
		$this->db->from('registration as r');
		$this->db->join('task as t','t.tassignee = r.reg_id');
		$this->db->join('project as p','p.pid = t.tproject_assign');
		$query = $this->db->get();
		return $query->num_rows();
	}

	function file_itSingleTaskCountDeptWise($port_id,$dept_id)
	{
		$this->db->order_by('date(tstatus_date)', 'DESC');
		$this->db->where('t.reg_acc_status !=','deactivated');
		$this->db->where('tproject_assign','0');
		$this->db->where('trash !=','yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it', 'yes');
		$this->db->where('portfolio_id', $port_id);
		$this->db->where('t.dept_id', $dept_id);
		$this->db->group_start();
    	$this->db->where('tcreated_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('tassignee', $this->session->userdata('d168_id'));
    	$this->db->group_end();
		$this->db->select('*');
		$this->db->from('registration as r');
		$this->db->join('task as t','t.tassignee = r.reg_id');
		$query = $this->db->get();
		return $query->num_rows();
	}

	function file_itSubtaskCountDeptWise($port_id,$dept_id)
	{
		$this->db->order_by('date(ststatus_date)', 'DESC');
		$this->db->where('st.reg_acc_status !=','deactivated');
		$this->db->where('strash !=','yes');
		$this->db->where('subtask_archive !=','yes');
		$this->db->where('subtask_file_it','yes');
		$this->db->where('st.portfolio_id', $port_id);
		$this->db->where('st.dept_id', $dept_id);
		$this->db->group_start();
    	$this->db->where('stcreated_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('stassignee', $this->session->userdata('d168_id'));
    	$this->db->or_where('p.pcreated_by', $this->session->userdata('d168_id'));
    	$this->db->group_end();
		$this->db->select('*');
		$this->db->from('registration as r');
		$this->db->join('subtask as st','st.stassignee = r.reg_id');
		$this->db->join('project as p','p.pid = st.stproject_assign');
		$query = $this->db->get();
		return $query->num_rows();
	}

	function file_itSingleSubtaskCountDeptWise($port_id,$dept_id)
	{
		$this->db->order_by('date(ststatus_date)', 'DESC');
		$this->db->where('st.reg_acc_status !=','deactivated');
		$this->db->where('stproject_assign','0');
		$this->db->where('strash !=','yes');
		$this->db->where('subtask_archive !=','yes');
		$this->db->where('subtask_file_it','yes');
		$this->db->where('portfolio_id', $port_id);
		$this->db->where('st.dept_id', $dept_id);
		$this->db->group_start();
    	$this->db->where('stcreated_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('stassignee', $this->session->userdata('d168_id'));
    	$this->db->group_end();
		$this->db->select('*');
		$this->db->from('registration as r');
		$this->db->join('subtask as st','st.stassignee = r.reg_id');
		$query = $this->db->get();
		return $query->num_rows();
	}

	function file_itPlatformCountDeptWise($port_id,$dept_id)
	{
		$this->db->order_by('date(cp_file_it_date)', 'DESC');
		$this->db->where('cp.reg_acc_status !=','deactivated');
		$this->db->where('trash !=','yes');
		$this->db->where('cp_archive !=', 'yes');
		$this->db->where('cp_file_it', 'yes');
		$this->db->where('cp.portfolio_id', $port_id);
		$this->db->where('cp.dept_id', $dept_id);
		$this->db->group_start();
    	$this->db->where('cp.pc_created_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('cp.submit_to_approval', $this->session->userdata('d168_id'));
    	$this->db->or_where('cp.pc_assignee', $this->session->userdata('d168_id'));
    	$this->db->or_where('p.pcreated_by', $this->session->userdata('d168_id'));
    	$this->db->group_end();
		$this->db->select('*');
		$this->db->from('content_planning as cp');
		$this->db->join('project as p','p.pid = cp.pc_project_assign');
		$query = $this->db->get();
		return $query->num_rows();
	}

	//////////////////////////////////////////////////////////////////////////

	function file_itGoalsDeptWise($port_id,$dept_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_id', $port_id);
		$this->db->where('gdept', $dept_id);
    	$this->db->where('gcreated_by', $this->session->userdata('d168_id'));
		$this->db->where('g_archive !=','yes');
		$this->db->where('g_file_it','yes');
		$this->db->where('g_trash !=','yes');
    	$query = $this->db->get('goals');
    	return $query->result();
    }

    function file_itAcceptedGoalsDeptWise($port_id,$dept_id)
    {
        $this->db->order_by('p.portfolio_id', 'DESC');
        $this->db->group_by('p.gid');
        $this->db->where('p.gid !=','0');
        $this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->where('p.portfolio_id', $port_id);
		$this->db->where('p.dept_id', $dept_id);
        $this->db->where('p.ptrash !=', 'yes');
        $this->db->where('p.project_archive !=', 'yes');
        $this->db->where('p.project_file_it','yes');
        $this->db->where('g.g_file_it','yes');
        $this->db->where('pm.status', 'accepted');
        $this->db->where('pm.pmember', $this->session->userdata('d168_id'));
        $this->db->select('p.gid');
        $this->db->from('project as p');
        $this->db->join('project_members as pm','pm.pid = p.pid');
        $this->db->join('goals as g','g.gid = p.gid');
        $query = $this->db->get();
        return $query->result();
    }

    function file_itStrategiesDeptWise($port_id,$dept_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_id', $port_id);
		$this->db->where('gdept_id', $dept_id);
    	$this->db->where('screated_by', $this->session->userdata('d168_id'));
		$this->db->where('s_archive !=','yes');
		$this->db->where('s_file_it','yes');
		$this->db->where('s_trash !=','yes');
    	$query = $this->db->get('strategies');
    	return $query->result();
    }

    function file_itAcceptedStrategiesDeptWise($port_id,$dept_id)
    {
        $this->db->order_by('p.portfolio_id', 'DESC');
        $this->db->group_by('p.sid');
        $this->db->where('p.sid !=','0');
        $this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->where('p.portfolio_id', $port_id);
		$this->db->where('p.dept_id', $dept_id);
        $this->db->where('p.ptrash !=', 'yes');
        $this->db->where('p.project_archive !=', 'yes');
        $this->db->where('p.project_file_it','yes');
        $this->db->where('s.s_file_it','yes');
        $this->db->where('pm.status', 'accepted');
        $this->db->where('pm.pmember', $this->session->userdata('d168_id'));
        $this->db->select('p.sid');
        $this->db->from('project as p');
        $this->db->join('project_members as pm','pm.pid = p.pid');
        $this->db->join('strategies as s','s.sid = p.sid');
        $query = $this->db->get();
        return $query->result();
    }

    function file_itProjectsDeptWise($port_id,$dept_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_id', $port_id);
		$this->db->where('dept_id', $dept_id);
    	$this->db->where('pcreated_by', $this->session->userdata('d168_id'));
		$this->db->where('project_archive !=','yes');
		$this->db->where('project_file_it','yes');
		$this->db->where('ptrash !=','yes');
    	$query = $this->db->get('project');
    	return $query->result();
    }

    function file_itAcceptedProjectsDeptWise($port_id,$dept_id)
	{
		$this->db->order_by('p.portfolio_id', 'DESC');
		$this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->where('p.portfolio_id', $port_id);
		$this->db->where('p.dept_id', $dept_id);
		$this->db->where('p.ptrash !=', 'yes');
		$this->db->where('p.project_archive !=', 'yes');
		$this->db->where('p.project_file_it','yes');
		$this->db->where('pm.status', 'accepted');
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');
        $this->db->from('project as p');
        $this->db->join('project_members as pm','pm.pid = p.pid');
        $query = $this->db->get();
        return $query->result();
	}

    function file_itTasksDeptWise($port_id,$dept_id)
	{
		$this->db->order_by('date(tstatus_date)', 'DESC');
		$this->db->where('t.reg_acc_status !=','deactivated');
		$this->db->where('trash !=','yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it', 'yes');
		$this->db->where('t.portfolio_id', $port_id);
		$this->db->where('t.dept_id', $dept_id);
		$this->db->group_start();
    	$this->db->where('tcreated_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('tassignee', $this->session->userdata('d168_id'));
    	$this->db->or_where('p.pcreated_by', $this->session->userdata('d168_id'));
    	$this->db->group_end();
		$this->db->select('*');
		$this->db->from('registration as r');
		$this->db->join('task as t','t.tassignee = r.reg_id');
		$this->db->join('project as p','p.pid = t.tproject_assign');
		$query = $this->db->get();
		return $query->result();
	}

	function file_itSingleTasksDeptWise($port_id,$dept_id)
	{
		$this->db->order_by('date(tstatus_date)', 'DESC');
		$this->db->where('t.reg_acc_status !=','deactivated');
		$this->db->where('tproject_assign','0');
		$this->db->where('trash !=','yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it', 'yes');
		$this->db->where('portfolio_id', $port_id);
		$this->db->where('t.dept_id', $dept_id);
		$this->db->group_start();
    	$this->db->where('tcreated_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('tassignee', $this->session->userdata('d168_id'));
    	$this->db->group_end();
		$this->db->select('*');
		$this->db->from('registration as r');
		$this->db->join('task as t','t.tassignee = r.reg_id');
		$query = $this->db->get();
		return $query->result();
	}

	function file_itSubtasksDeptWise($port_id,$dept_id)
	{
		$this->db->order_by('date(ststatus_date)', 'DESC');
		$this->db->where('st.reg_acc_status !=','deactivated');
		$this->db->where('strash !=','yes');
		$this->db->where('subtask_archive !=','yes');
		$this->db->where('subtask_file_it','yes');
		$this->db->where('st.portfolio_id', $port_id);
		$this->db->where('st.dept_id', $dept_id);
		$this->db->group_start();
    	$this->db->where('stcreated_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('stassignee', $this->session->userdata('d168_id'));
    	$this->db->or_where('p.pcreated_by', $this->session->userdata('d168_id'));
    	$this->db->group_end();
		$this->db->select('*');
		$this->db->from('registration as r');
		$this->db->join('subtask as st','st.stassignee = r.reg_id');
		$this->db->join('project as p','p.pid = st.stproject_assign');
		$query = $this->db->get();
		return $query->result();
	}

	function file_itSingleSubtasksDeptWise($port_id,$dept_id)
	{
		$this->db->order_by('date(ststatus_date)', 'DESC');
		$this->db->where('st.reg_acc_status !=','deactivated');
		$this->db->where('stproject_assign','0');
		$this->db->where('strash !=','yes');
		$this->db->where('subtask_archive !=','yes');
		$this->db->where('subtask_file_it','yes');
		$this->db->where('portfolio_id', $port_id);
		$this->db->where('st.dept_id', $dept_id);
		$this->db->group_start();
    	$this->db->where('stcreated_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('stassignee', $this->session->userdata('d168_id'));
    	$this->db->group_end();
		$this->db->select('*');
		$this->db->from('registration as r');
		$this->db->join('subtask as st','st.stassignee = r.reg_id');
		$query = $this->db->get();
		return $query->result();
	}

	function file_itPlatformDeptWise($port_id,$dept_id)
	{
		$this->db->order_by('date(cp_file_it_date)', 'DESC');
		$this->db->where('cp.reg_acc_status !=','deactivated');
		$this->db->where('trash !=','yes');
		$this->db->where('cp_archive !=', 'yes');
		$this->db->where('cp_file_it', 'yes');
		$this->db->where('cp.portfolio_id', $port_id);
		$this->db->where('cp.dept_id', $dept_id);
		$this->db->group_start();
    	$this->db->where('cp.pc_created_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('cp.submit_to_approval', $this->session->userdata('d168_id'));
    	$this->db->or_where('cp.pc_assignee', $this->session->userdata('d168_id'));
    	$this->db->or_where('p.pcreated_by', $this->session->userdata('d168_id'));
    	$this->db->group_end();
		$this->db->select('*');
		$this->db->from('content_planning as cp');
		$this->db->join('project as p','p.pid = cp.pc_project_assign');
		$query = $this->db->get();
		return $query->result();
	}

    function file_itStrategiesCountGoalWise($port_id,$dept_id,$gid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_id', $port_id);
		$this->db->where('gdept_id', $dept_id);
		$this->db->where('gid', $gid);
		$this->db->where('s_archive !=','yes');
		$this->db->where('s_file_it','yes');
		$this->db->where('s_trash !=','yes');
    	$query = $this->db->get('strategies');
    	return $query->num_rows();
    }

    function file_itStrategiesGoalWise($port_id,$dept_id,$gid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_id', $port_id);
		$this->db->where('gdept_id', $dept_id);
		$this->db->where('gid', $gid);
		$this->db->where('s_archive !=','yes');
		$this->db->where('s_file_it','yes');
		$this->db->where('s_trash !=','yes');
    	$query = $this->db->get('strategies');
    	return $query->result();
    }

    function file_itProjectsCountStrategyWise($port_id,$dept_id,$sid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_id', $port_id);
		$this->db->where('dept_id', $dept_id);
		$this->db->where('sid', $sid);
    	$this->db->where('pcreated_by', $this->session->userdata('d168_id'));
		$this->db->where('project_archive !=','yes');
		$this->db->where('project_file_it','yes');
		$this->db->where('ptrash !=','yes');
    	$query = $this->db->get('project');
    	return $query->num_rows();
    }

    function file_itAcceptedProjectsCountStrategyWise($port_id,$dept_id,$sid)
    {
        $this->db->order_by('p.portfolio_id', 'DESC');
        $this->db->where('p.sid !=','0');
        $this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->where('p.portfolio_id', $port_id);
		$this->db->where('p.dept_id', $dept_id);
		$this->db->where('p.sid', $sid);
        $this->db->where('p.ptrash !=', 'yes');
        $this->db->where('p.project_archive !=', 'yes');
        $this->db->where('p.project_file_it','yes');
        $this->db->where('pm.status', 'accepted');
        $this->db->where('pm.pmember', $this->session->userdata('d168_id'));
        $this->db->select('p.pid');
        $this->db->from('project as p');
        $this->db->join('project_members as pm','pm.pid = p.pid');
        $query = $this->db->get();
        return $query->num_rows();
    }

    function file_itProjectsStrategyWise($port_id,$dept_id,$sid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('portfolio_id', $port_id);
		$this->db->where('dept_id', $dept_id);
		$this->db->where('sid', $sid);
    	$this->db->where('pcreated_by', $this->session->userdata('d168_id'));
		$this->db->where('project_archive !=','yes');
		$this->db->where('project_file_it','yes');
		$this->db->where('ptrash !=','yes');
    	$query = $this->db->get('project');
    	return $query->result();
    }

    function file_itAcceptedProjectsStrategyWise($port_id,$dept_id,$sid)
    {
        $this->db->order_by('p.portfolio_id', 'DESC');
        $this->db->where('p.sid !=','0');
        $this->db->where('pm.reg_acc_status !=','deactivated');
		$this->db->where('p.portfolio_id', $port_id);
		$this->db->where('p.dept_id', $dept_id);
		$this->db->where('p.sid', $sid);
        $this->db->where('p.ptrash !=', 'yes');
        $this->db->where('p.project_archive !=', 'yes');
        $this->db->where('p.project_file_it','yes');
        $this->db->where('pm.status', 'accepted');
        $this->db->where('pm.pmember', $this->session->userdata('d168_id'));
        $this->db->select('p.pid');
        $this->db->from('project as p');
        $this->db->join('project_members as pm','pm.pid = p.pid');
        $query = $this->db->get();
        return $query->result();
    }

    function file_itTasksCountProjectWise($port_id,$dept_id,$pid)
	{
		$this->db->order_by('date(tstatus_date)', 'DESC');
		$this->db->where('t.reg_acc_status !=','deactivated');
		$this->db->where('trash !=','yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it', 'yes');
		$this->db->where('t.portfolio_id', $port_id);
		$this->db->where('t.dept_id', $dept_id);
		$this->db->where('t.tproject_assign', $pid);
		$this->db->group_start();
    	$this->db->where('tcreated_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('tassignee', $this->session->userdata('d168_id'));
    	$this->db->or_where('p.pcreated_by', $this->session->userdata('d168_id'));
    	$this->db->group_end();
		$this->db->select('*');
		$this->db->from('registration as r');
		$this->db->join('task as t','t.tassignee = r.reg_id');
		$this->db->join('project as p','p.pid = t.tproject_assign');
		$query = $this->db->get();
		return $query->num_rows();
	}

	function file_itTasksProjectWise($port_id,$dept_id,$pid)
	{
		$this->db->order_by('date(tstatus_date)', 'DESC');
		$this->db->where('t.reg_acc_status !=','deactivated');
		$this->db->where('trash !=','yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it', 'yes');
		$this->db->where('t.portfolio_id', $port_id);
		$this->db->where('t.dept_id', $dept_id);
		$this->db->where('t.tproject_assign', $pid);
		$this->db->group_start();
    	$this->db->where('tcreated_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('tassignee', $this->session->userdata('d168_id'));
    	$this->db->or_where('p.pcreated_by', $this->session->userdata('d168_id'));
    	$this->db->group_end();
		$this->db->select('*');
		$this->db->from('registration as r');
		$this->db->join('task as t','t.tassignee = r.reg_id');
		$this->db->join('project as p','p.pid = t.tproject_assign');
		$query = $this->db->get();
		return $query->result();
	}

	function file_itSubtaskCountTaskWise($port_id,$dept_id,$tid)
	{
		$this->db->order_by('date(ststatus_date)', 'DESC');
		$this->db->where('st.reg_acc_status !=','deactivated');
		$this->db->where('strash !=','yes');
		$this->db->where('subtask_archive !=','yes');
		$this->db->where('subtask_file_it','yes');
		$this->db->where('st.portfolio_id', $port_id);
		$this->db->where('st.dept_id', $dept_id);
		$this->db->where('st.tid', $tid);
		$this->db->group_start();
    	$this->db->where('stcreated_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('stassignee', $this->session->userdata('d168_id'));
    	$this->db->or_where('p.pcreated_by', $this->session->userdata('d168_id'));
    	$this->db->group_end();
		$this->db->select('*');
		$this->db->from('registration as r');
		$this->db->join('subtask as st','st.stassignee = r.reg_id');
		$this->db->join('project as p','p.pid = st.stproject_assign');
		$query = $this->db->get();
		return $query->num_rows();
	}

	function file_itSubtasksTaskWise($port_id,$dept_id,$tid)
	{
		$this->db->order_by('date(ststatus_date)', 'DESC');
		$this->db->where('st.reg_acc_status !=','deactivated');
		$this->db->where('strash !=','yes');
		$this->db->where('subtask_archive !=','yes');
		$this->db->where('subtask_file_it','yes');
		$this->db->where('st.portfolio_id', $port_id);
		$this->db->where('st.dept_id', $dept_id);
		$this->db->where('st.tid', $tid);
		$this->db->group_start();
    	$this->db->where('stcreated_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('stassignee', $this->session->userdata('d168_id'));
    	$this->db->or_where('p.pcreated_by', $this->session->userdata('d168_id'));
    	$this->db->group_end();
		$this->db->select('*');
		$this->db->from('registration as r');
		$this->db->join('subtask as st','st.stassignee = r.reg_id');
		$this->db->join('project as p','p.pid = st.stproject_assign');
		$query = $this->db->get();
		return $query->result();
	}

	function file_itSingleSubtaskCountTaskWise($port_id,$dept_id,$tid)
	{
		$this->db->order_by('date(ststatus_date)', 'DESC');
		$this->db->where('st.reg_acc_status !=','deactivated');
		$this->db->where('stproject_assign','0');
		$this->db->where('strash !=','yes');
		$this->db->where('subtask_archive !=','yes');
		$this->db->where('subtask_file_it','yes');
		$this->db->where('portfolio_id', $port_id);
		$this->db->where('st.dept_id', $dept_id);
		$this->db->where('st.tid', $tid);
		$this->db->group_start();
    	$this->db->where('stcreated_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('stassignee', $this->session->userdata('d168_id'));
    	$this->db->group_end();
		$this->db->select('*');
		$this->db->from('registration as r');
		$this->db->join('subtask as st','st.stassignee = r.reg_id');
		$query = $this->db->get();
		return $query->num_rows();
	}

	function file_itSingleSubtasksTaskWise($port_id,$dept_id,$tid)
	{
		$this->db->order_by('date(ststatus_date)', 'DESC');
		$this->db->where('st.reg_acc_status !=','deactivated');
		$this->db->where('stproject_assign','0');
		$this->db->where('strash !=','yes');
		$this->db->where('subtask_archive !=','yes');
		$this->db->where('subtask_file_it','yes');
		$this->db->where('portfolio_id', $port_id);
		$this->db->where('st.dept_id', $dept_id);
		$this->db->where('st.tid', $tid);
		$this->db->group_start();
    	$this->db->where('stcreated_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('stassignee', $this->session->userdata('d168_id'));
    	$this->db->group_end();
		$this->db->select('*');
		$this->db->from('registration as r');
		$this->db->join('subtask as st','st.stassignee = r.reg_id');
		$query = $this->db->get();
		return $query->result();
	}

	function file_itPlatformCountProjectWise($port_id,$dept_id,$pid)
	{
		$this->db->order_by('date(cp_file_it_date)', 'DESC');
		$this->db->where('cp.reg_acc_status !=','deactivated');
		$this->db->where('trash !=','yes');
		$this->db->where('cp_archive !=', 'yes');
		$this->db->where('cp_file_it', 'yes');
		$this->db->where('cp.portfolio_id', $port_id);
		$this->db->where('cp.dept_id', $dept_id);
		$this->db->where('cp.pc_project_assign', $pid);
		$this->db->group_start();
    	$this->db->where('cp.pc_created_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('cp.submit_to_approval', $this->session->userdata('d168_id'));
    	$this->db->or_where('cp.pc_assignee', $this->session->userdata('d168_id'));
    	$this->db->or_where('p.pcreated_by', $this->session->userdata('d168_id'));
    	$this->db->group_end();
		$this->db->select('*');
		$this->db->from('content_planning as cp');
		$this->db->join('project as p','p.pid = cp.pc_project_assign');
		$query = $this->db->get();
		return $query->num_rows();
	}

	function file_itPlatformProjectWise($port_id,$dept_id,$pid)
	{
		$this->db->order_by('date(cp_file_it_date)', 'DESC');
		$this->db->where('cp.reg_acc_status !=','deactivated');
		$this->db->where('trash !=','yes');
		$this->db->where('cp_archive !=', 'yes');
		$this->db->where('cp_file_it', 'yes');
		$this->db->where('cp.portfolio_id', $port_id);
		$this->db->where('cp.dept_id', $dept_id);
		$this->db->where('cp.pc_project_assign', $pid);
		$this->db->group_start();
    	$this->db->where('cp.pc_created_by', $this->session->userdata('d168_id'));
    	$this->db->or_where('cp.submit_to_approval', $this->session->userdata('d168_id'));
    	$this->db->or_where('cp.pc_assignee', $this->session->userdata('d168_id'));
    	$this->db->or_where('p.pcreated_by', $this->session->userdata('d168_id'));
    	$this->db->group_end();
		$this->db->select('*');
		$this->db->from('content_planning as cp');
		$this->db->join('project as p','p.pid = cp.pc_project_assign');
		$query = $this->db->get();
		return $query->result();
	}

	function getProjectfilesbyPid($pid)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('pid', $pid);
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('ptrash !=', 'yes');
		$query = $this->db->get('project_files');
		return $query->result();
	}

	function task_5Files($port_id)
    {
        $this->db->limit(5);
        $this->db->order_by('date(tcreated_date)', 'DESC');
        $this->db->where('t.reg_acc_status !=','deactivated');
        $this->db->where('trash !=','yes');
        $this->db->where('task_archive !=', 'yes');
        $this->db->where('t.task_file_it','yes');
        $this->db->where('t.portfolio_id', $port_id);
        $this->db->where('t.tfile !=', "");
        $this->db->group_start();
        $this->db->where('tcreated_by', $this->session->userdata('d168_id'));
        $this->db->or_where('tassignee', $this->session->userdata('d168_id'));
        $this->db->or_where('p.pcreated_by', $this->session->userdata('d168_id'));
        $this->db->group_end();
        $this->db->select('t.tid AS file_id, t.tfile AS file_name, t.tfnotify_date AS file_date');
        $this->db->from('registration as r');
        $this->db->join('task as t','t.tassignee = r.reg_id');
        $this->db->join('project as p','p.pid = t.tproject_assign');
        $query = $this->db->get();
        return $query->result();
    }

    function singleTask_5Files($port_id)
    {
        $this->db->limit(5);
        $this->db->order_by('date(tcreated_date)', 'DESC');
        $this->db->where('t.reg_acc_status !=','deactivated');
        $this->db->where('tproject_assign','0');
        $this->db->where('trash !=','yes');
        $this->db->where('task_archive !=', 'yes');
        $this->db->where('t.task_file_it','yes');
        $this->db->where('portfolio_id', $port_id);
        $this->db->where('t.tfile !=', "");
        $this->db->group_start();
        $this->db->where('tcreated_by', $this->session->userdata('d168_id'));
        $this->db->or_where('tassignee', $this->session->userdata('d168_id'));
        $this->db->group_end();
        $this->db->select('t.tid AS file_id, t.tfile AS file_name, t.tfnotify_date AS file_date');
        $this->db->from('registration as r');
        $this->db->join('task as t','t.tassignee = r.reg_id');
        $query = $this->db->get();
        return $query->result();
    }

    function subtask_5Files($port_id)
    {
        $this->db->limit(5);
        $this->db->order_by('date(stcreated_date)', 'DESC');
        $this->db->where('st.reg_acc_status !=','deactivated');
        $this->db->where('strash !=','yes');
        $this->db->where('subtask_archive !=','yes');
        $this->db->where('st.subtask_file_it','yes');
        $this->db->where('st.portfolio_id', $port_id);
        $this->db->where('st.stfile !=', "");
        $this->db->group_start();
        $this->db->where('stcreated_by', $this->session->userdata('d168_id'));
        $this->db->or_where('stassignee', $this->session->userdata('d168_id'));
        $this->db->or_where('p.pcreated_by', $this->session->userdata('d168_id'));
        $this->db->group_end();
        $this->db->select('st.stid AS file_id, st.stfile AS file_name, st.stfnotify_date AS file_date');
        $this->db->from('registration as r');
        $this->db->join('subtask as st','st.stassignee = r.reg_id');
        $this->db->join('project as p','p.pid = st.stproject_assign');
        $query = $this->db->get();
        return $query->result();
    }

    function singleSubtask_5Files($port_id)
    {
        $this->db->limit(5);
        $this->db->order_by('date(stcreated_date)', 'DESC');
        $this->db->where('st.reg_acc_status !=','deactivated');
        $this->db->where('stproject_assign','0');
        $this->db->where('strash !=','yes');
        $this->db->where('subtask_archive !=','yes');
        $this->db->where('st.subtask_file_it','yes');
        $this->db->where('portfolio_id', $port_id);
        $this->db->where('st.stfile !=', "");
        $this->db->group_start();
        $this->db->where('stcreated_by', $this->session->userdata('d168_id'));
        $this->db->or_where('stassignee', $this->session->userdata('d168_id'));
        $this->db->group_end();
        $this->db->select('st.stid AS file_id, st.stfile AS file_name, st.stfnotify_date AS file_date');
        $this->db->from('registration as r');
        $this->db->join('subtask as st','st.stassignee = r.reg_id');
        $query = $this->db->get();
        return $query->result();
    }

    function platform_5Files($port_id)
    {
        $this->db->limit(5);
        $this->db->order_by('date(pc_created_date)', 'DESC');
        $this->db->where('cp.reg_acc_status !=','deactivated');
        $this->db->where('trash !=','yes');
        $this->db->where('cp_archive !=', 'yes');
        $this->db->where('cp.cp_file_it','yes');
        $this->db->where('cp.portfolio_id', $port_id);
        $this->db->where('cp.pc_file !=', "");
        $this->db->group_start();
        $this->db->where('cp.pc_created_by', $this->session->userdata('d168_id'));
        $this->db->or_where('cp.submit_to_approval', $this->session->userdata('d168_id'));
        $this->db->or_where('cp.pc_assignee', $this->session->userdata('d168_id'));
        $this->db->or_where('p.pcreated_by', $this->session->userdata('d168_id'));
        $this->db->group_end();
        $this->db->select('cp.pc_id AS file_id, cp.pc_file AS file_name, cp.pc_notify_date AS file_date');
        $this->db->from('content_planning as cp');
        $this->db->join('project as p','p.pid = cp.pc_project_assign');
        $query = $this->db->get();
        return $query->result();
    }

    function project_5Files($port_id)
    {
        $this->db->limit(5);
        $this->db->order_by('date(pfile_date)', 'DESC');
        $this->db->group_by('pf.pfile_id');
        $this->db->where('pf.reg_acc_status !=','deactivated');
        $this->db->where('pf.project_archive !=', 'yes');
        $this->db->where('pf.ptrash !=', 'yes');
        $this->db->where('pf.project_file_it','yes');
        $this->db->where('p.portfolio_id', $port_id);
        $this->db->group_start();
        $this->db->where('p.pcreated_by', $this->session->userdata('d168_id'));
         $this->db->or_where('pm.pmember', $this->session->userdata('d168_id'));    
        $this->db->group_end();    
        $this->db->where('pf.pfile !=', "");
        $this->db->select('pf.pfile_id AS file_id, pf.pfile AS file_name, pf.pfile_date AS file_date');
        $this->db->from('project_files as pf');
        $this->db->join('project as p','p.pid = pf.pid');
        $this->db->join('project_members as pm','pm.pid = pf.pid');
        $query = $this->db->get();
        return $query->result();
    }
  	//////File Cabinet Part End///////

  	//////Report Part Start///////

    // portfolio report work start
	function count_goals($c_id)
	{
		$query = $this->db->query("SELECT COUNT(*) as count_rows FROM goals where portfolio_id='".$c_id."' and g_trash!='yes' and g_archive!='yes' and g_file_it!='yes' and reg_acc_status != 'deactivated'");
		return $query->row_array();
	}
// count active portfolio member
	function get_active_port_report($portfolio_id)
	{
		$query = $this->db->query("SELECT COUNT(*) as count_rows FROM project_portfolio_member where portfolio_id='".$portfolio_id."' and reg_acc_status!='deactivated' and portfolio_archive!='yes' and portfolio_file_it!='yes' and status = 'accepted' and working_status = 'active'");
		return $query->row_array();
	}

// count inactive portfolio member
	function get_inactive_port_report($portfolio_id)
	{
		$query = $this->db->query("SELECT COUNT(*) as count_rows FROM project_portfolio_member where portfolio_id='".$portfolio_id."' and reg_acc_status!='deactivated' and portfolio_archive!='yes' and portfolio_file_it!='yes' and status = 'accepted' and working_status = 'inactive'");
		return $query->row_array();
	}

	// deaprtmet chart start
	function get_dep_pro($portfolio_id,$departmen_id)
	{
			$query = $this->db->query("SELECT pcreated_date FROM project where portfolio_id='".$portfolio_id."' and dept_id='".$departmen_id."' and reg_acc_status!='deactivated' and ptrash =' ' and ptype!= 'content'  ORDER BY pcreated_date ASC");
			return $query->result();
	}

	function get_dep_cnt($portfolio_id,$departmen_id)
	{
			$query = $this->db->query("SELECT p_publish FROM project where portfolio_id='".$portfolio_id."' and dept_id='".$departmen_id."' and reg_acc_status!='deactivated' and ptrash =' ' and ptype = 'content' ORDER BY p_publish ASC");
			return $query->result();
	}

	function get_dep_task($portfolio_id,$departmen_id)
	{
		$query = $this->db->query("SELECT tdue_date FROM task where portfolio_id='".$portfolio_id."' and dept_id='".$departmen_id."' and reg_acc_status!='deactivated' and trash =' '   ORDER BY tdue_date ASC");
		return $query->result();
	}

	function get_dep_goal($portfolio_id,$departmen_id)
	{
			$query = $this->db->query("SELECT gstart_date FROM goals where portfolio_id='".$portfolio_id."' and gdept='".$departmen_id."' and reg_acc_status!='deactivated' and g_trash =' '  ORDER BY gstart_date ASC");
			return $query->result();
	}

	// deaprtmet chart end
	// deaprtmet date range chart start
	function get_dep_rangepro($portfolio_id,$departmen_id,$deptstart,$deptend)
	{
			$query = $this->db->query("SELECT pcreated_date FROM project where portfolio_id='".$portfolio_id."' and dept_id='".$departmen_id."' and pcreated_date BETWEEN '".$deptstart."' and '".$deptend."' and reg_acc_status!='deactivated' and ptrash =' ' and ptype!= 'content'  ORDER BY pcreated_date ASC");
			return $query->result();
	}

	function get_dep_rangecnt($portfolio_id,$departmen_id,$deptstart,$deptend)
	{
			$query = $this->db->query("SELECT p_publish FROM project where portfolio_id='".$portfolio_id."' and dept_id='".$departmen_id."' and p_publish BETWEEN '".$deptstart."' and '".$deptend."' and reg_acc_status!='deactivated' and ptrash =' ' and ptype = 'content' ORDER BY p_publish ASC");
			return $query->result();
	}

	function get_dep_rangetask($portfolio_id,$departmen_id,$deptstart,$deptend)
	{
		$query = $this->db->query("SELECT tdue_date FROM task where portfolio_id='".$portfolio_id."' and dept_id='".$departmen_id."' and tdue_date BETWEEN '".$deptstart."' and '".$deptend."' and reg_acc_status!='deactivated' and trash =' '   ORDER BY tdue_date ASC");
		return $query->result();
	}

	function get_dep_rangegoal($portfolio_id,$departmen_id,$deptstart,$deptend)
	{
			$query = $this->db->query("SELECT gstart_date FROM goals where portfolio_id='".$portfolio_id."' and gdept='".$departmen_id."' and gstart_date BETWEEN '".$deptstart."' and '".$deptend."' and reg_acc_status!='deactivated' and g_trash =' '  ORDER BY gstart_date ASC");
			return $query->result();
	}

	// deaprtmet date range chart end

	// member chart start
	function get_mem_pro($portfolio_id,$uid)
	{
		$query = $this->db->query("SELECT pcreated_date FROM project where portfolio_id='".$portfolio_id."' and pcreated_by='".$uid."' and reg_acc_status!='deactivated' and ptrash =' ' and ptype!= 'content' ORDER BY pcreated_date ASC");
		return $query->result();
	}

	function get_mem_cnt($portfolio_id,$uid)
	{
		$query = $this->db->query("SELECT p_publish FROM project where portfolio_id='".$portfolio_id."' and pcreated_by='".$uid."' and reg_acc_status!='deactivated' and ptrash =' ' and ptype = 'content' ORDER BY p_publish ASC");
		return $query->result();
	}

	function get_mem_task($portfolio_id,$uid)
	{
		$query = $this->db->query("SELECT tdue_date FROM task where portfolio_id='".$portfolio_id."' and tcreated_by='".$uid."' and reg_acc_status!='deactivated' and trash =' ' ORDER BY tdue_date ASC");
		return $query->result();
	}

	function get_mem_goal($portfolio_id,$uid)
	{
		$query = $this->db->query("SELECT gstart_date FROM goals where portfolio_id='".$portfolio_id."' and gcreated_by='".$uid."' and reg_acc_status!='deactivated' and g_trash =' ' ORDER BY gstart_date ASC");
		return $query->result();
	}

	function get_mem_dep($portfolio_id,$uid)
	{
		$query = $this->db->query("SELECT createddate FROM project_portfolio_department where portfolio_id='".$portfolio_id."' and createdby='".$uid."' and dstatus='active'  ORDER BY createddate ASC");
		return $query->result();
	}

	function get_mem_pln($portfolio_id,$uid)
	{
		$query = $this->db->query("SELECT pc_created_date FROM content_planning where portfolio_id='".$portfolio_id."' and pc_created_by='".$uid."' and reg_acc_status!='deactivated' and trash =' '  ORDER BY pc_created_date ASC");
		return $query->result();
	}

	// member chart end
	// member date range chart start
	function get_mem_rangepro($portfolio_id,$uid,$teamstart,$teamend)
	{
		$query = $this->db->query("SELECT pcreated_date FROM project where portfolio_id='".$portfolio_id."' and pcreated_by='".$uid."' and pcreated_date BETWEEN '".$teamstart."' and '".$teamend."' and reg_acc_status!='deactivated' and ptrash =' ' and ptype!= 'content' ORDER BY pcreated_date ASC");
		return $query->result();
	}

	function get_mem_rangecnt($portfolio_id,$uid,$teamstart,$teamend)
	{
		$query = $this->db->query("SELECT p_publish FROM project where portfolio_id='".$portfolio_id."' and pcreated_by='".$uid."' and p_publish BETWEEN '".$teamstart."' and '".$teamend."' and reg_acc_status!='deactivated' and ptrash =' ' and ptype = 'content' ORDER BY p_publish ASC");
		return $query->result();
	}

	function get_mem_rangetask($portfolio_id,$uid,$teamstart,$teamend)
	{
		$query = $this->db->query("SELECT tdue_date FROM task where portfolio_id='".$portfolio_id."' and tcreated_by='".$uid."' and tdue_date BETWEEN '".$teamstart."' and '".$teamend."' and reg_acc_status!='deactivated' and trash =' ' ORDER BY tdue_date ASC");
		return $query->result();
	}

	function get_mem_rangegoal($portfolio_id,$uid,$teamstart,$teamend)
	{
		$query = $this->db->query("SELECT gstart_date FROM goals where portfolio_id='".$portfolio_id."' and gcreated_by='".$uid."' and gstart_date BETWEEN '".$teamstart."' and '".$teamend."' and reg_acc_status!='deactivated' and g_trash =' ' ORDER BY gstart_date ASC");
		return $query->result();
	}

	function get_mem_rangedep($portfolio_id,$uid,$teamstart,$teamend)
	{
		$query = $this->db->query("SELECT createddate FROM project_portfolio_department where portfolio_id='".$portfolio_id."' and createdby='".$uid."' and createddate BETWEEN '".$teamstart."' and '".$teamend."' and dstatus='active'  ORDER BY createddate ASC");
		return $query->result();
	}

	function get_mem_rangepln($portfolio_id,$uid,$teamstart,$teamend)
	{
		$query = $this->db->query("SELECT pc_created_date FROM content_planning where portfolio_id='".$portfolio_id."' and pc_created_date BETWEEN '".$teamstart."' and '".$teamend."' and pc_created_by='".$uid."' and reg_acc_status!='deactivated' and trash =' '  ORDER BY pc_created_date ASC");
		return $query->result();
	}

	// member date range chart end
	// goal chart start
	function get_goal_kpi($portfolio_id,$goal_id)
	{
			$query = $this->db->query("SELECT screated_date FROM strategies where portfolio_id='".$portfolio_id."' and gid='".$goal_id."' and reg_acc_status!='deactivated' and s_trash =' '  ORDER BY screated_date ASC");
			return $query->result();
	}

	function get_goal_pro($portfolio_id,$goal_id)
	{
			$query = $this->db->query("SELECT pcreated_date FROM project where portfolio_id='".$portfolio_id."' and gid='".$goal_id."' and reg_acc_status!='deactivated' and ptrash =' ' and ptype!= 'content' ORDER BY pcreated_date ASC");
			return $query->result();
	}

	function get_goal_cnt($portfolio_id,$goal_id)
	{
			$query = $this->db->query("SELECT p_publish FROM project where portfolio_id='".$portfolio_id."' and gid='".$goal_id."' and reg_acc_status!='deactivated' and ptrash =' ' and ptype = 'content' ORDER BY p_publish ASC");
			return $query->result();
	}

	function get_goal_task($portfolio_id,$goal_id)
	{
			$query = $this->db->query("SELECT tdue_date FROM task where portfolio_id='".$portfolio_id."' and gid='".$goal_id."' and reg_acc_status!='deactivated' and trash =' ' ORDER BY tdue_date ASC");
			return $query->result();
	}

	// goal chart end
	// goal date range chart start
	function get_goal_rangekpi($portfolio_id,$goal_id,$goalstart,$goalend)
	{
			$query = $this->db->query("SELECT screated_date FROM strategies where portfolio_id='".$portfolio_id."' and gid='".$goal_id."' and screated_date BETWEEN '".$goalstart."' and '".$goalend."' and reg_acc_status!='deactivated' and s_trash =' '  ORDER BY screated_date ASC");
			return $query->result();
	}

	function get_goal_rangepro($portfolio_id,$goal_id,$goalstart,$goalend)
	{
			$query = $this->db->query("SELECT pcreated_date FROM project where portfolio_id='".$portfolio_id."' and gid='".$goal_id."' and pcreated_date BETWEEN '".$goalstart."' and '".$goalend."' and reg_acc_status!='deactivated' and ptrash =' ' and ptype!= 'content' ORDER BY pcreated_date ASC");
			return $query->result();
	}

	function get_goal_rangecnt($portfolio_id,$goal_id,$goalstart,$goalend)
	{
			$query = $this->db->query("SELECT p_publish FROM project where portfolio_id='".$portfolio_id."' and gid='".$goal_id."' and p_publish BETWEEN '".$goalstart."' and '".$goalend."' and reg_acc_status!='deactivated' and ptrash =' ' and ptype = 'content' ORDER BY p_publish ASC");
			return $query->result();
	}

	function get_goal_rangetask($portfolio_id,$goal_id,$goalstart,$goalend)
	{
			$query = $this->db->query("SELECT tdue_date FROM task where portfolio_id='".$portfolio_id."' and gid='".$goal_id."' and tdue_date BETWEEN '".$goalstart."' and '".$goalend."' and reg_acc_status!='deactivated' and trash =' ' ORDER BY tdue_date ASC");
			return $query->result();
	}

	// goal date range chart end
	// content chart start
	function get_cnt_pt1($portfolio_id,$cnt_id)
	{
			$query = $this->db->query("SELECT pc_created_date FROM content_planning where portfolio_id='".$portfolio_id."' and pc_project_assign='".$cnt_id."' and platform = 'twitter' and reg_acc_status!='deactivated' and trash =' ' ORDER BY pc_created_date ASC");
			return $query->result();
	}
	function get_cnt_pt2($portfolio_id,$cnt_id)
	{
			$query = $this->db->query("SELECT pc_created_date FROM content_planning where portfolio_id='".$portfolio_id."' and pc_project_assign='".$cnt_id."' and platform = 'facebook' and reg_acc_status!='deactivated' and trash =' '    ORDER BY pc_created_date ASC");
			return $query->result();
	}

	function get_cnt_pt3($portfolio_id,$cnt_id)
	{
			$query = $this->db->query("SELECT pc_created_date FROM content_planning where portfolio_id='".$portfolio_id."' and pc_project_assign='".$cnt_id."' and platform = 'instagram' and reg_acc_status!='deactivated' and trash =' '    ORDER BY pc_created_date ASC");
			return $query->result();
	}

	function get_cnt_pt4($portfolio_id,$cnt_id)
	{
			$query = $this->db->query("SELECT pc_created_date FROM content_planning where portfolio_id='".$portfolio_id."' and pc_project_assign='".$cnt_id."' and platform = 'linkedin' and reg_acc_status!='deactivated' and trash =' '    ORDER BY pc_created_date ASC");
			return $query->result();
	}

	function get_cnt_pt5($portfolio_id,$cnt_id)
	{
			$query = $this->db->query("SELECT pc_created_date FROM content_planning where portfolio_id='".$portfolio_id."' and pc_project_assign='".$cnt_id."' and platform = 'google-my-business' and reg_acc_status!='deactivated' and trash =' '    ORDER BY pc_created_date ASC");
			return $query->result();
	}

	function get_cnt_pt6($portfolio_id,$cnt_id)
	{
			$query = $this->db->query("SELECT pc_created_date FROM content_planning where portfolio_id='".$portfolio_id."' and pc_project_assign='".$cnt_id."' and platform = 'pinterest' and reg_acc_status!='deactivated' and trash =' '    ORDER BY pc_created_date ASC");
			return $query->result();
	}

	function get_cnt_pt7($portfolio_id,$cnt_id)
	{
			$query = $this->db->query("SELECT pc_created_date FROM content_planning where portfolio_id='".$portfolio_id."' and pc_project_assign='".$cnt_id."' and platform = 'youtube' and reg_acc_status!='deactivated' and trash =' '    ORDER BY pc_created_date ASC");
			return $query->result();
	}
	function get_cnt_pt8($portfolio_id,$cnt_id)
	{
			$query = $this->db->query("SELECT pc_created_date FROM content_planning where portfolio_id='".$portfolio_id."' and pc_project_assign='".$cnt_id."' and platform = 'blogger' and reg_acc_status!='deactivated' and trash =' '    ORDER BY pc_created_date ASC");
			return $query->result();
	}

	function get_cnt_pt9($portfolio_id,$cnt_id)
	{
			$query = $this->db->query("SELECT pc_created_date FROM content_planning where portfolio_id='".$portfolio_id."' and pc_project_assign='".$cnt_id."' and platform = 'tiktok' and reg_acc_status!='deactivated' and trash =' '    ORDER BY pc_created_date ASC");
			return $query->result();
	}
	function get_cnt_pln($portfolio_id,$cnt_id)
	{
			$query = $this->db->query("SELECT pc_created_date FROM content_planning where portfolio_id='".$portfolio_id."' and pc_project_assign='".$cnt_id."' and reg_acc_status!='deactivated' and trash =' '    ORDER BY pc_created_date ASC");
			return $query->result();
	}

	

	// content chart end
	
// content date range chart start
function get_cnt_rangept1($portfolio_id,$cnt_id,$contstart,$contend)
{
		$query = $this->db->query("SELECT pc_created_date FROM content_planning where portfolio_id='".$portfolio_id."' and pc_project_assign='".$cnt_id."' and pc_created_date BETWEEN '".$contstart."' and '".$contend."' and platform = 'twitter' and reg_acc_status!='deactivated' and trash =' ' ORDER BY pc_created_date ASC");
		return $query->result();
}
function get_cnt_rangept2($portfolio_id,$cnt_id,$contstart,$contend)
{
		$query = $this->db->query("SELECT pc_created_date FROM content_planning where portfolio_id='".$portfolio_id."' and pc_project_assign='".$cnt_id."' and pc_created_date BETWEEN '".$contstart."' and '".$contend."' and platform = 'facebook' and reg_acc_status!='deactivated' and trash =' '    ORDER BY pc_created_date ASC");
		return $query->result();
}

function get_cnt_rangept3($portfolio_id,$cnt_id,$contstart,$contend)
{
		$query = $this->db->query("SELECT pc_created_date FROM content_planning where portfolio_id='".$portfolio_id."' and pc_project_assign='".$cnt_id."' and pc_created_date BETWEEN '".$contstart."' and '".$contend."' and platform = 'instagram' and reg_acc_status!='deactivated' and trash =' '    ORDER BY pc_created_date ASC");
		return $query->result();
}

function get_cnt_rangept4($portfolio_id,$cnt_id,$contstart,$contend)
{
		$query = $this->db->query("SELECT pc_created_date FROM content_planning where portfolio_id='".$portfolio_id."' and pc_project_assign='".$cnt_id."' and pc_created_date BETWEEN '".$contstart."' and '".$contend."' and platform = 'linkedin' and reg_acc_status!='deactivated' and trash =' '    ORDER BY pc_created_date ASC");
		return $query->result();
}

function get_cnt_rangept5($portfolio_id,$cnt_id,$contstart,$contend)
{
		$query = $this->db->query("SELECT pc_created_date FROM content_planning where portfolio_id='".$portfolio_id."' and pc_project_assign='".$cnt_id."' and pc_created_date BETWEEN '".$contstart."' and '".$contend."' and platform = 'google-my-business' and reg_acc_status!='deactivated' and trash =' '    ORDER BY pc_created_date ASC");
		return $query->result();
}

function get_cnt_rangept6($portfolio_id,$cnt_id,$contstart,$contend)
{
		$query = $this->db->query("SELECT pc_created_date FROM content_planning where portfolio_id='".$portfolio_id."' and pc_project_assign='".$cnt_id."' and pc_created_date BETWEEN '".$contstart."' and '".$contend."' and platform = 'pinterest' and reg_acc_status!='deactivated' and trash =' '    ORDER BY pc_created_date ASC");
		return $query->result();
}

function get_cnt_rangept7($portfolio_id,$cnt_id,$contstart,$contend)
{
		$query = $this->db->query("SELECT pc_created_date FROM content_planning where portfolio_id='".$portfolio_id."' and pc_project_assign='".$cnt_id."' and pc_created_date BETWEEN '".$contstart."' and '".$contend."' and platform = 'youtube' and reg_acc_status!='deactivated' and trash =' '    ORDER BY pc_created_date ASC");
		return $query->result();
}
function get_cnt_rangept8($portfolio_id,$cnt_id,$contstart,$contend)
{
		$query = $this->db->query("SELECT pc_created_date FROM content_planning where portfolio_id='".$portfolio_id."' and pc_project_assign='".$cnt_id."' and pc_created_date BETWEEN '".$contstart."' and '".$contend."' and platform = 'blogger' and reg_acc_status!='deactivated' and trash =' '    ORDER BY pc_created_date ASC");
		return $query->result();
}

function get_cnt_rangept9($portfolio_id,$cnt_id,$contstart,$contend)
{
		$query = $this->db->query("SELECT pc_created_date FROM content_planning where portfolio_id='".$portfolio_id."' and pc_project_assign='".$cnt_id."' and pc_created_date BETWEEN '".$contstart."' and '".$contend."' and platform = 'tiktok' and reg_acc_status!='deactivated' and trash =' '    ORDER BY pc_created_date ASC");
		return $query->result();
}
function get_cnt_rangepln($portfolio_id,$cnt_id,$contstart,$contend)
{
		$query = $this->db->query("SELECT pc_created_date FROM content_planning where portfolio_id='".$portfolio_id."' and pc_project_assign='".$cnt_id."' and pc_created_date BETWEEN '".$contstart."' and '".$contend."' and reg_acc_status!='deactivated' and trash =' '    ORDER BY pc_created_date ASC");
		return $query->result();
}	
function get_pro_rangetask($portfolio_id,$project_id,$contstart,$contend)
{
		$query = $this->db->query("SELECT tdue_date FROM task where portfolio_id='".$portfolio_id."' and tproject_assign='".$project_id."' and tdue_date BETWEEN '".$contstart."' and '".$contend."' and reg_acc_status!='deactivated' and trash =' '  ORDER BY tdue_date ASC ");
		return $query->result();
}

function get_pro_rangemember($portfolio_id,$project_id,$contstart,$contend)
{
		$query = $this->db->query("SELECT pmember, sent_date FROM project_members where portfolio_id='".$portfolio_id."' and pid='".$project_id."' and pmember BETWEEN '".$contstart."' and '".$contend."' and reg_acc_status!='deactivated' and ptrash =' '  ORDER BY sent_date ASC");
		return $query->result();
}

// content date range chart end

	// project chart start
	function get_pro_task($portfolio_id,$project_id)
	{
			$query = $this->db->query("SELECT tdue_date FROM task where portfolio_id='".$portfolio_id."' and tproject_assign='".$project_id."' and reg_acc_status!='deactivated' and trash =' '  ORDER BY tdue_date ASC ");
			return $query->result();
	}

	function get_pro_member($portfolio_id,$project_id)
	{
			$query = $this->db->query("SELECT pmember, sent_date FROM project_members where portfolio_id='".$portfolio_id."' and pid='".$project_id."' and reg_acc_status!='deactivated' and ptrash =' '  ORDER BY sent_date ASC");
			return $query->result();
	}

	// project chart end

	// project date range chart start
	function get_pro_rangetask2($portfolio_id,$project_id,$prjtstart,$prjtend)
	{
			$query = $this->db->query("SELECT tdue_date FROM task where portfolio_id='".$portfolio_id."' and tproject_assign='".$project_id."' and tdue_date BETWEEN '".$prjtstart."' and '".$prjtend."' and reg_acc_status!='deactivated' and trash =' '  ORDER BY tdue_date ASC ");
			return $query->result();
	}

	function get_pro_rangemember2($portfolio_id,$project_id,$prjtstart,$prjtend)
	{
			$query = $this->db->query("SELECT pmember, sent_date FROM project_members where portfolio_id='".$portfolio_id."' and pid='".$project_id."' and sent_date BETWEEN '".$prjtstart."' and '".$prjtend."' and reg_acc_status!='deactivated' and ptrash =' '  ORDER BY sent_date ASC");
			return $query->result();
	}

	// project date range chart end

	// task chart start
	function get_todo_task($portfolio_id)
	{

			$query = $this->db->query("SELECT COUNT(*) as count_rows FROM task where portfolio_id='".$portfolio_id."' and reg_acc_status!='deactivated' and trash =' ' and tstatus = 'to_do' ORDER BY tdue_date ASC");
			return $query->row_array();

	}

	function get_todo_tasks($portfolio_id,$x)
	{
				$query = $this->db->query("SELECT tcreated_date, tdue_date FROM task where portfolio_id='".$portfolio_id."' and reg_acc_status!='deactivated' and trash =' ' and tstatus = 'to_do'  ORDER BY tdue_date ASC");
				return $query->result();

		}

	function get_prog_tasks($portfolio_id)
	{
			$query = $this->db->query("SELECT tcreated_date, tdue_date FROM task where portfolio_id='".$portfolio_id."' and reg_acc_status!='deactivated' and trash=' ' and tstatus = 'in_progress'  ORDER BY tdue_date ASC");
			return $query->result();

	}

	function get_rev_tasks($portfolio_id)
	{
			$query = $this->db->query("SELECT tcreated_date, tdue_date FROM task where portfolio_id='".$portfolio_id."' and reg_acc_status!='deactivated' and trash=' ' and tstatus = 'in_review'  ORDER BY tdue_date ASC");
			return $query->result();
	}

	function get_done_tasks($portfolio_id)
	{
			$query = $this->db->query("SELECT tcreated_date, tdue_date FROM task where portfolio_id='".$portfolio_id."' and reg_acc_status!='deactivated' and trash =' ' and tstatus = 'done'  ORDER BY tdue_date ASC");
			return $query->result();
	}

	// task chart end

	// subtask chart start
	function get_todo_subtask($portfolio_id)
	{

			$query = $this->db->query("SELECT COUNT(*) as count_rows FROM subtask where portfolio_id='".$portfolio_id."' and reg_acc_status!='deactivated' and strash =' ' and tstatus = 'to_do' ORDER BY tdue_date ASC");
			return $query->row_array();

	}

	function get_todo_subtasks($portfolio_id,$x)
	{
				$query = $this->db->query("SELECT stcreated_date, stdue_date FROM subtask where portfolio_id='".$portfolio_id."' and reg_acc_status!='deactivated' and strash =' ' and ststatus = 'to_do'  ORDER BY stdue_date ASC");
				return $query->result();

	}

	
	function get_prog_subtasks($portfolio_id)
	{
			$query = $this->db->query("SELECT stcreated_date, stdue_date FROM subtask where portfolio_id='".$portfolio_id."' and reg_acc_status!='deactivated' and strash=' ' and ststatus = 'in_progress'  ORDER BY stdue_date ASC");
			return $query->result();

	}

	
	function get_rev_subtasks($portfolio_id)
	{
			$query = $this->db->query("SELECT stcreated_date, stdue_date FROM subtask where portfolio_id='".$portfolio_id."' and reg_acc_status!='deactivated' and strash=' ' and ststatus = 'in_review'  ORDER BY stdue_date ASC");
			return $query->result();
	}

	
	function get_done_subtasks($portfolio_id)
	{
			$query = $this->db->query("SELECT stcreated_date, stdue_date FROM subtask where portfolio_id='".$portfolio_id."' and reg_acc_status!='deactivated' and strash =' ' and ststatus = 'done'  ORDER BY stdue_date ASC");
			return $query->result();
	}

	// subtask chart end
    function InsertTemplate($data)
	{
		if($this->db->insert('report_template',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function getTemplateDetail($c_id)
	{	
		$this->db->where('portfolio_id',$c_id);
		$this->db->where('user_id',$this->session->userdata('d168_id'));
		$query = $this->db->get('report_template');
		return $query->result();
	}

	function checkReportTemplate($id)
    {
    	$this->db->where('id', $id);
    	$query = $this->db->get('report_template');
    	return $query->row();
    }

	
	function getTemplateDetails($pid)
	{
		$this->db->where('user_id', $this->session->userdata('d168_id'));
		$this->db->where('portfolio_id', $pid);
		$query = $this->db->get('report_template');
		return $query->result();
	}
	
	function getTemplateById($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('report_template');
		return $query->row();
	}

	function delete_template($id)
	{
		$this->db->where('id',$id);
		if($this->db->delete('report_template'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	// portfolio report work end

	// User report work start

// deaprtmet chart start
function get_dep_userpro($portfolio_id,$departmen_id)
{
					$this->db->order_by('p.portfolio_id', 'DESC');	
		$this->db->where('pm.reg_acc_status !=','deactivated');	
		$this->db->group_start();	
		$this->db->where('ptype', 'regular');	
		$this->db->or_where('ptype', 'goal_strategy');	
		$this->db->group_end();	
		$this->db->group_start();	
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));	
		$this->db->or_where('p.pcreated_by', $this->session->userdata('d168_id'));	
		$this->db->group_end();	
		$this->db->where('p.portfolio_id', $portfolio_id);	
		$this->db->where('p.dept_id', $departmen_id);	
		$this->db->where('p.ptrash !=', 'yes');	
		$this->db->where('p.project_archive !=', 'yes');	
		$this->db->where('p.project_file_it !=', 'yes');	
		$this->db->where('pm.status', 'accepted');	
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');	
        $this->db->from('project as p');	
        $this->db->join('project_members as pm','pm.pid = p.pid');	
        $query = $this->db->get();	
        return $query->result();			
}

function get_dep_usercnt($portfolio_id,$departmen_id)
{
		$this->db->order_by('p.portfolio_id', 'DESC');	
		$this->db->where('pm.reg_acc_status !=','deactivated');	
		$this->db->where('ptype', 'content');	
		$this->db->group_start();	
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));	
		$this->db->or_where('p.pcreated_by', $this->session->userdata('d168_id'));	
		$this->db->group_end();	
		$this->db->where('p.portfolio_id', $portfolio_id);	
		$this->db->where('p.dept_id', $departmen_id);	
		$this->db->where('p.ptrash !=', 'yes');	
		$this->db->where('p.project_archive !=', 'yes');	
		$this->db->where('p.project_file_it !=', 'yes');	
		$this->db->where('pm.status', 'accepted');	
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');	
        $this->db->from('project as p');	
        $this->db->join('project_members as pm','pm.pid = p.pid');	
        $query = $this->db->get();	
        return $query->result();
}

function get_dep_usertask($portfolio_id,$departmen_id)
{
	$query = $this->db->query("SELECT tdue_date FROM task where portfolio_id='".$portfolio_id."' and tassignee='".$this->session->userdata('d168_id')."' and dept_id='".$departmen_id."' and reg_acc_status!='deactivated' and trash =' '   ORDER BY tdue_date ASC");	
	return $query->result();
}

function get_dep_usergoal($portfolio_id,$departmen_id)
{
		$this->db->order_by('g.portfolio_id', 'DESC');	
		$this->db->where('gm.reg_acc_status !=','deactivated');	
		$this->db->where('g.portfolio_id', $portfolio_id);	
		$this->db->where('g.gdept', $departmen_id);	
		$this->db->where('gm.gmember', $this->session->userdata('d168_id'));	
		$this->db->where('g.g_archive !=', 'yes');	
		$this->db->where('g.g_file_it !=', 'yes');	
		$this->db->where('g.g_trash !=', 'yes');	
		$this->db->where('gm.status','accepted');	
        $this->db->select('*, g.gid as gid, gm.gid as gm_gid');	
        $this->db->from('goals as g');	
        $this->db->join('goals_members as gm','gm.gid = g.gid');	
        $query = $this->db->get();	
        return $query->result();
}

// deaprtmet chart end

// deaprtmet date range user chart start
function get_dep_userrangepro($portfolio_id,$departmen_id,$deptstart,$deptend)
{
		$this->db->order_by('p.portfolio_id', 'DESC');	
		$this->db->where('pm.reg_acc_status !=','deactivated');	
		$this->db->group_start();	
		$this->db->where('ptype', 'regular');	
		$this->db->or_where('ptype', 'goal_strategy');	
		$this->db->group_end();	
		$this->db->group_start();	
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));	
		$this->db->or_where('p.pcreated_by', $this->session->userdata('d168_id'));	
		$this->db->group_end();	
		$this->db->where('p.portfolio_id', $portfolio_id);	
		$this->db->where('p.dept_id', $departmen_id);	
		$this->db->where('p.ptrash !=', 'yes');	
		$this->db->where('p.project_archive !=', 'yes');	
		$this->db->where('p.project_file_it !=', 'yes');	
		$this->db->where('pm.status', 'accepted');	
		$this->db->where("p.pcreated_date BETWEEN '".$deptstart."' and '".$deptend."'");	
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');	
        $this->db->from('project as p');	
        $this->db->join('project_members as pm','pm.pid = p.pid');	
        $query = $this->db->get();	
        return $query->result();
}

function get_dep_userrangecnt($portfolio_id,$departmen_id,$deptstart,$deptend)
{
		$this->db->order_by('p.portfolio_id', 'DESC');	
		$this->db->where('pm.reg_acc_status !=','deactivated');	
		$this->db->where('ptype', 'content');	
		$this->db->group_start();	
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));	
		$this->db->or_where('p.pcreated_by', $this->session->userdata('d168_id'));	
		$this->db->group_end();	
		$this->db->where('p.portfolio_id', $portfolio_id);	
		$this->db->where('p.dept_id', $departmen_id);	
		$this->db->where('p.ptrash !=', 'yes');	
		$this->db->where('p.project_archive !=', 'yes');	
		$this->db->where('p.project_file_it !=', 'yes');	
		$this->db->where('pm.status', 'accepted');	
		$this->db->where("p.p_publish BETWEEN '".$deptstart."' and '".$deptend."'");	
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');	
        $this->db->from('project as p');	
        $this->db->join('project_members as pm','pm.pid = p.pid');	
        $query = $this->db->get();	
        return $query->result();
}

function get_dep_userrangetask($portfolio_id,$departmen_id,$deptstart,$deptend)
{
	$query = $this->db->query("SELECT tdue_date FROM task where portfolio_id='".$portfolio_id."' and dept_id='".$departmen_id."' and tassignee='".$this->session->userdata('d168_id')."' and tassignee='".$this->session->userdata('d168_id')."' and tdue_date BETWEEN '".$deptstart."' and '".$deptend."' and reg_acc_status!='deactivated' and trash =' '   ORDER BY tdue_date ASC");	
	return $query->result();
}

function get_dep_userrangegoal($portfolio_id,$departmen_id,$deptstart,$deptend)
{
		$this->db->order_by('g.portfolio_id', 'DESC');	
		$this->db->where('gm.reg_acc_status !=','deactivated');	
		$this->db->where('g.portfolio_id', $portfolio_id);	
		$this->db->where('g.gdept', $departmen_id);	
		$this->db->where('gm.gmember', $this->session->userdata('d168_id'));	
		$this->db->where('g.g_archive !=', 'yes');	
		$this->db->where('g.g_file_it !=', 'yes');	
		$this->db->where('g.g_trash !=', 'yes');	
		$this->db->where('gm.status','accepted');	
		$this->db->where("g.gstart_date BETWEEN '".$deptstart."' and '".$deptend."'");	
        $this->db->select('*, g.gid as gid, gm.gid as gm_gid');	
        $this->db->from('goals as g');	
        $this->db->join('goals_members as gm','gm.gid = g.gid');	
        $query = $this->db->get();	
        return $query->result();
}

// deaprtmet date range user chart end

// member chart start
function get_mem_userpro($portfolio_id,$uid)
{
	$this->db->order_by('p.portfolio_id', 'DESC');	
		$this->db->where('pm.reg_acc_status !=','deactivated');	
		$this->db->group_start();	
		$this->db->where('ptype', 'regular');	
		$this->db->or_where('ptype', 'goal_strategy');	
		$this->db->group_end();	
		$this->db->where('p.portfolio_id', $portfolio_id);	
		$this->db->group_start();	
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));	
		$this->db->or_where('p.pcreated_by', $uid);	
		$this->db->group_end();	
		$this->db->where('p.ptrash !=', 'yes');	
		$this->db->where('p.project_archive !=', 'yes');	
		$this->db->where('p.project_file_it !=', 'yes');	
		$this->db->where('pm.status', 'accepted');	
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');	
        $this->db->from('project as p');	
        $this->db->join('project_members as pm','pm.pid = p.pid');	
        $query = $this->db->get();	
        return $query->result();
}

function get_mem_usercnt($portfolio_id,$uid)
{
	$this->db->order_by('p.portfolio_id', 'DESC');	
		$this->db->where('pm.reg_acc_status !=','deactivated');	
		$this->db->where('ptype', 'content');	
		$this->db->where('p.portfolio_id', $portfolio_id);	
		$this->db->group_start();	
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));	
		$this->db->or_where('p.pcreated_by', $uid);	
		$this->db->group_end();	
		$this->db->where('p.ptrash !=', 'yes');	
		$this->db->where('p.project_archive !=', 'yes');	
		$this->db->where('p.project_file_it !=', 'yes');	
		$this->db->where('pm.status', 'accepted');	
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');	
        $this->db->from('project as p');	
        $this->db->join('project_members as pm','pm.pid = p.pid');	
        $query = $this->db->get();	
        return $query->result();
}

function get_mem_usertask($portfolio_id,$uid)
{
	$query = $this->db->query("SELECT tdue_date FROM task where portfolio_id='".$portfolio_id."' and tassignee='".$uid."' and reg_acc_status!='deactivated' and trash =' ' ORDER BY tdue_date ASC");	
	return $query->result();
}

function get_mem_usergoal($portfolio_id,$uid)
{
	$this->db->order_by('g.portfolio_id', 'DESC');	
		$this->db->where('gm.reg_acc_status !=','deactivated');	
		$this->db->where('g.portfolio_id', $portfolio_id);	
		$this->db->where('gm.gmember', $this->session->userdata('d168_id'));	
		$this->db->where('g.g_archive !=', 'yes');	
		$this->db->where('g.g_file_it !=', 'yes');	
		$this->db->where('g.g_trash !=', 'yes');	
		$this->db->where('gm.status','accepted');	
        $this->db->select('*, g.gid as gid, gm.gid as gm_gid');	
        $this->db->from('goals as g');	
        $this->db->join('goals_members as gm','gm.gid = g.gid');	
        $query = $this->db->get();	
        return $query->result();
}

function get_mem_userdep($portfolio_id,$uid)
{
	$query = $this->db->query("SELECT createddate FROM project_portfolio_department where portfolio_id='".$portfolio_id."' and createdby='".$uid."' and dstatus='active'  ORDER BY createddate ASC");
	return $query->result();
}

function get_mem_userpln($portfolio_id,$uid)
{
	$query = $this->db->query("SELECT pc_created_date FROM content_planning where portfolio_id='".$portfolio_id."' and pc_created_by='".$uid."' and reg_acc_status!='deactivated' and trash =' '  ORDER BY pc_created_date ASC");
	return $query->result();
}

// member chart end

// goal chart start
function get_goal_userkpi($portfolio_id,$goal_id)
{
		$query = $this->db->query("SELECT screated_date FROM strategies where portfolio_id='".$portfolio_id."' and screated_by='".$this->session->userdata('d168_id')."' and gid='".$goal_id."' and reg_acc_status!='deactivated' and s_trash =' '  ORDER BY screated_date ASC");
		return $query->result();
}

function get_goal_userpro($portfolio_id,$goal_id)
{
		$this->db->order_by('p.portfolio_id', 'DESC');	
		$this->db->where('pm.reg_acc_status !=','deactivated');	
		$this->db->group_start();	
		$this->db->where('p.ptype', 'regular');	
		$this->db->or_where('p.ptype', 'goal_strategy');	
		$this->db->group_end();	
		$this->db->group_start();	
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));	
		$this->db->or_where('p.pcreated_by', $this->session->userdata('d168_id'));	
		$this->db->group_end();	
		$this->db->where('p.portfolio_id', $portfolio_id);	
		$this->db->where('p.gid', $goal_id);	
		$this->db->where('p.ptrash !=', 'yes');	
		$this->db->where('p.project_archive !=', 'yes');	
		$this->db->where('p.project_file_it !=', 'yes');	
		$this->db->where('pm.status', 'accepted');	
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');	
        $this->db->from('project as p');	
        $this->db->join('project_members as pm','pm.pid = p.pid');	
        $query = $this->db->get();	
        return $query->result();
}

function get_goal_usercnt($portfolio_id,$goal_id)
{
		$this->db->order_by('p.portfolio_id', 'DESC');	
		$this->db->where('pm.reg_acc_status !=','deactivated');	
		$this->db->where('p.ptype', 'content');	
		$this->db->group_start();	
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));	
		$this->db->or_where('p.pcreated_by', $this->session->userdata('d168_id'));	
		$this->db->group_end();	
		$this->db->where('p.portfolio_id', $portfolio_id);	
		$this->db->where('p.gid', $goal_id);	
		$this->db->where('p.ptrash !=', 'yes');	
		$this->db->where('p.project_archive !=', 'yes');	
		$this->db->where('p.project_file_it !=', 'yes');	
		$this->db->where('pm.status', 'accepted');	
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');	
        $this->db->from('project as p');	
        $this->db->join('project_members as pm','pm.pid = p.pid');	
        $query = $this->db->get();	
        return $query->result();
}

function get_goal_usertask($portfolio_id,$goal_id)
{
		$query = $this->db->query("SELECT tdue_date FROM task where portfolio_id='".$portfolio_id."' and  tassignee ='".$this->session->userdata('d168_id')."' and gid='".$goal_id."' and reg_acc_status!='deactivated' and trash =' ' ORDER BY tdue_date ASC");	
		return $query->result();
}

// goal chart end

// goal date range user chart start
function get_goal_rangeuserkpi($portfolio_id,$goal_id,$goalstart,$goalend)
{
		$query = $this->db->query("SELECT screated_date FROM strategies where portfolio_id='".$portfolio_id."' and gid='".$goal_id."' and screated_by='".$this->session->userdata('d168_id')."' and screated_date BETWEEN '".$goalstart."' and '".$goalend."' and reg_acc_status!='deactivated' and s_trash =' '  ORDER BY screated_date ASC");
		return $query->result();
}

function get_goal_rangeuserpro($portfolio_id,$goal_id,$goalstart,$goalend)
{
		$this->db->order_by('p.portfolio_id', 'DESC');	
		$this->db->where('pm.reg_acc_status !=','deactivated');	
		$this->db->group_start();	
		$this->db->where('p.ptype', 'regular');	
		$this->db->or_where('p.ptype', 'goal_strategy');	
		$this->db->group_end();	
		$this->db->group_start();	
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));	
		$this->db->or_where('p.pcreated_by', $this->session->userdata('d168_id'));	
		$this->db->group_end();	
		$this->db->where('p.portfolio_id', $portfolio_id);	
		$this->db->where('p.gid', $goal_id);	
		$this->db->where('p.ptrash !=', 'yes');	
		$this->db->where('p.project_archive !=', 'yes');	
		$this->db->where('p.project_file_it !=', 'yes');	
		$this->db->where('pm.status', 'accepted');	
		$this->db->where("p.pcreated_date BETWEEN '".$goalstart."' and '".$goalend."'");	
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');	
        $this->db->from('project as p');	
        $this->db->join('project_members as pm','pm.pid = p.pid');	
        $query = $this->db->get();	
        return $query->result();
}

function get_goal_rangeusercnt($portfolio_id,$goal_id,$goalstart,$goalend)
{
		$this->db->order_by('p.portfolio_id', 'DESC');	
		$this->db->where('pm.reg_acc_status !=','deactivated');	
		$this->db->where('p.ptype', 'content');	
		$this->db->group_start();	
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));	
		$this->db->or_where('p.pcreated_by', $this->session->userdata('d168_id'));	
		$this->db->group_end();	
		$this->db->where('p.portfolio_id', $portfolio_id);	
		$this->db->where('p.gid', $goal_id);	
		$this->db->where('p.ptrash !=', 'yes');	
		$this->db->where('p.project_archive !=', 'yes');	
		$this->db->where('p.project_file_it !=', 'yes');	
		$this->db->where('pm.status', 'accepted');	
		$this->db->where("p.p_publish BETWEEN '".$goalstart."' and '".$goalend."'");	
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');	
        $this->db->from('project as p');	
        $this->db->join('project_members as pm','pm.pid = p.pid');	
        $query = $this->db->get();	
        return $query->result();
}

function get_goal_rangeusertask($portfolio_id,$goal_id,$goalstart,$goalend)
{
		$query = $this->db->query("SELECT tdue_date FROM task where portfolio_id='".$portfolio_id."' and gid='".$goal_id."'  and tassignee ='".$this->session->userdata('d168_id')."' and tdue_date BETWEEN '".$goalstart."' and '".$goalend."' and reg_acc_status!='deactivated' and trash =' ' ORDER BY tdue_date ASC");	
		return $query->result();
}

// goal date range user chart end

// content chart start
function get_cnt_userpln($portfolio_id,$cnt_id)
{
		$query = $this->db->query("SELECT pc_created_date FROM content_planning where portfolio_id='".$portfolio_id."' and pc_created_by='".$this->session->userdata('d168_id')."' OR pc_assignee='".$this->session->userdata('d168_id')."' and pc_project_assign='".$cnt_id."' and reg_acc_status!='deactivated' and trash =' '    ORDER BY pc_created_date ASC");	
		return $query->result();
}

function get_user_cnt1($portfolio_id,$cnt_id)
{
		$this->db->select('pc_created_date');	
		$this->db->from('content_planning');	
		$this->db->where('portfolio_id', $portfolio_id);	
		$this->db->group_start();	
		$this->db->where('pc_created_by', $this->session->userdata('d168_id'));	
		$this->db->or_where('pc_assignee', $this->session->userdata('d168_id'));	
		$this->db->group_end();	
		$this->db->where('pc_project_assign', $cnt_id);	
		$this->db->where('platform ', 'twitter');	
		$this->db->where('reg_acc_status !=', 'deactivated');	
		$this->db->where('trash', '');	
		$this->db->order_by('pc_created_date', 'ASC');	
		$query = $this->db->get();	
		return $query->result();
}
function get_user_cnt2($portfolio_id,$cnt_id)
{
		$this->db->select('pc_created_date');	
		$this->db->from('content_planning');	
		$this->db->where('portfolio_id', $portfolio_id);	
		$this->db->group_start();	
		$this->db->where('pc_created_by', $this->session->userdata('d168_id'));	
		$this->db->or_where('pc_assignee', $this->session->userdata('d168_id'));	
		$this->db->group_end();	
		$this->db->where('pc_project_assign', $cnt_id);	
		$this->db->where('platform ', 'facebook');	
		$this->db->where('reg_acc_status !=', 'deactivated');	
		$this->db->where('trash', '');	
		$this->db->order_by('pc_created_date', 'ASC');	
		$query = $this->db->get();	
		return $query->result();
}

function get_user_cnt3($portfolio_id,$cnt_id)
{
		$this->db->select('pc_created_date');	
		$this->db->from('content_planning');	
		$this->db->where('portfolio_id', $portfolio_id);	
		$this->db->group_start();	
		$this->db->where('pc_created_by', $this->session->userdata('d168_id'));	
		$this->db->or_where('pc_assignee', $this->session->userdata('d168_id'));	
		$this->db->group_end();	
		$this->db->where('pc_project_assign', $cnt_id);	
		$this->db->where('platform ', 'instagram');	
		$this->db->where('reg_acc_status !=', 'deactivated');	
		$this->db->where('trash', '');	
		$this->db->order_by('pc_created_date', 'ASC');	
		$query = $this->db->get();	
		return $query->result();
}

function get_user_cnt4($portfolio_id,$cnt_id)
{
		$this->db->select('pc_created_date');	
		$this->db->from('content_planning');	
		$this->db->where('portfolio_id', $portfolio_id);	
		$this->db->group_start();	
		$this->db->where('pc_created_by', $this->session->userdata('d168_id'));	
		$this->db->or_where('pc_assignee', $this->session->userdata('d168_id'));	
		$this->db->group_end();	
		$this->db->where('pc_project_assign', $cnt_id);	
		$this->db->where('platform ', 'linkedin');	
		$this->db->where('reg_acc_status !=', 'deactivated');	
		$this->db->where('trash', '');	
		$this->db->order_by('pc_created_date', 'ASC');	
		$query = $this->db->get();	
		return $query->result();
}

function get_user_cnt5($portfolio_id,$cnt_id)
{
		$this->db->select('pc_created_date');	
		$this->db->from('content_planning');	
		$this->db->where('portfolio_id', $portfolio_id);	
		$this->db->group_start();	
		$this->db->where('pc_created_by', $this->session->userdata('d168_id'));	
		$this->db->or_where('pc_assignee', $this->session->userdata('d168_id'));	
		$this->db->group_end();	
		$this->db->where('pc_project_assign', $cnt_id);	
		$this->db->where('platform ', 'google-my-business');	
		$this->db->where('reg_acc_status !=', 'deactivated');	
		$this->db->where('trash', '');	
		$this->db->order_by('pc_created_date', 'ASC');	
		$query = $this->db->get();	
		return $query->result();
}

function get_user_cnt6($portfolio_id,$cnt_id)
{
		$this->db->select('pc_created_date');	
		$this->db->from('content_planning');	
		$this->db->where('portfolio_id', $portfolio_id);	
		$this->db->group_start();	
		$this->db->where('pc_created_by', $this->session->userdata('d168_id'));	
		$this->db->or_where('pc_assignee', $this->session->userdata('d168_id'));	
		$this->db->group_end();	
		$this->db->where('pc_project_assign', $cnt_id);	
		$this->db->where('platform ', 'pinterest');	
		$this->db->where('reg_acc_status !=', 'deactivated');	
		$this->db->where('trash', '');	
		$this->db->order_by('pc_created_date', 'ASC');	
		$query = $this->db->get();	
		return $query->result();
}

function get_user_cnt7($portfolio_id,$cnt_id)
{
		$this->db->select('pc_created_date');	
		$this->db->from('content_planning');	
		$this->db->where('portfolio_id', $portfolio_id);	
		$this->db->group_start();	
		$this->db->where('pc_created_by', $this->session->userdata('d168_id'));	
		$this->db->or_where('pc_assignee', $this->session->userdata('d168_id'));	
		$this->db->group_end();	
		$this->db->where('pc_project_assign', $cnt_id);	
		$this->db->where('platform ', 'youtube');	
		$this->db->where('reg_acc_status !=', 'deactivated');	
		$this->db->where('trash', '');	
		$this->db->order_by('pc_created_date', 'ASC');	
		$query = $this->db->get();	
		return $query->result();
}
function get_user_cnt8($portfolio_id,$cnt_id)
{
		$this->db->select('pc_created_date');	
		$this->db->from('content_planning');	
		$this->db->where('portfolio_id', $portfolio_id);	
		$this->db->group_start();	
		$this->db->where('pc_created_by', $this->session->userdata('d168_id'));	
		$this->db->or_where('pc_assignee', $this->session->userdata('d168_id'));	
		$this->db->group_end();	
		$this->db->where('pc_project_assign', $cnt_id);	
		$this->db->where('platform ', 'blogger');	
		$this->db->where('reg_acc_status !=', 'deactivated');	
		$this->db->where('trash', '');	
		$this->db->order_by('pc_created_date', 'ASC');	
		$query = $this->db->get();	
		return $query->result();
}

function get_user_cnt9($portfolio_id,$cnt_id)
{
		$this->db->select('pc_created_date');	
		$this->db->from('content_planning');	
		$this->db->where('portfolio_id', $portfolio_id);	
		$this->db->group_start();	
		$this->db->where('pc_created_by', $this->session->userdata('d168_id'));	
		$this->db->or_where('pc_assignee', $this->session->userdata('d168_id'));	
		$this->db->group_end();	
		$this->db->where('pc_project_assign', $cnt_id);	
		$this->db->where('platform ', 'tiktok');	
		$this->db->where('reg_acc_status !=', 'deactivated');	
		$this->db->where('trash', '');	
		$this->db->order_by('pc_created_date', 'ASC');	
		$query = $this->db->get();	
		return $query->result();
}

// content chart end

// content user chart date range start
function get_cnt_userrangepln($portfolio_id,$cnt_id,$start_date,$end_date)
{
       $query = $this->db->query("SELECT pc_created_date FROM content_planning where portfolio_id='".$portfolio_id."' and pc_created_by='".$this->session->userdata('d168_id')."' OR pc_assignee='".$this->session->userdata('d168_id')."' and pc_project_assign='".$cnt_id."' and DATE(pc_created_date) BETWEEN '".$start_date."' and '".$end_date."' and reg_acc_status!='deactivated' and trash =' '    ORDER BY pc_created_date ASC");	
        return $query->result();
}

function get_pro_userrangetask($portfolio_id,$project_id,$start_date,$end_date)
{
        $query = $this->db->query("SELECT tdue_date FROM task where portfolio_id='".$portfolio_id."'and  tassignee='".$this->session->userdata('d168_id')."' and tproject_assign='".$project_id."' and DATE(tdue_date) BETWEEN '".$start_date."' and '".$end_date."' and reg_acc_status!='deactivated' and trash =' '  ORDER BY tdue_date ASC ");	
        return $query->result();
}

function get_pro_userrangemember($portfolio_id,$project_id,$start_date,$end_date)
{
        $this->db->order_by('p.portfolio_id', 'DESC');	
		$this->db->where('pm.reg_acc_status !=','deactivated');	
		$this->db->group_start();	
		$this->db->where('p.ptype', 'regular');	
		$this->db->or_where('p.ptype', 'goal_strategy');	
		$this->db->group_end();	
		$this->db->group_start();	
		$this->db->where('p.pcreated_by', $this->session->userdata('d168_id'));	
		$this->db->or_where('pm.pmember', $this->session->userdata('d168_id'));	
		$this->db->group_end();	
		$this->db->where('p.portfolio_id', $portfolio_id);	
		$this->db->where('p.pid', $project_id);	
		$this->db->where('p.ptrash !=', 'yes');	
		$this->db->where('p.project_archive !=', 'yes');	
		$this->db->where('p.project_file_it !=', 'yes');	
		$this->db->where('pm.status', 'accepted');	
		$this->db->where("DATE(pm.sent_date) BETWEEN '".$start_date."' and '".$end_date."'");	
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');	
        $this->db->from('project as p');	
        $this->db->join('project_members as pm','pm.pid = p.pid');	
        $query = $this->db->get();	
        return $query->result();
}

function get_userrange_cnt1($portfolio_id,$cnt_id,$start_date,$end_date)
{
        $this->db->select('pc_created_date');	
		$this->db->from('content_planning');	
		$this->db->where('portfolio_id', $portfolio_id);	
		$this->db->group_start();	
		$this->db->where('pc_created_by', $this->session->userdata('d168_id'));	
		$this->db->or_where('pc_assignee', $this->session->userdata('d168_id'));	
		$this->db->group_end();	
		$this->db->where('pc_project_assign', $cnt_id);	
		$this->db->where('platform ', 'twitter');	
		$this->db->where("pc_created_date BETWEEN '".$start_date."' and '".$end_date."'");	
		$this->db->where('reg_acc_status !=', 'deactivated');	
		$this->db->where('trash', '');	
		$this->db->order_by('pc_created_date', 'ASC');	
		$query = $this->db->get();	
		return $query->result();
}
function get_userrange_cnt2($portfolio_id,$cnt_id,$start_date,$end_date)
{
        $this->db->select('pc_created_date');	
		$this->db->from('content_planning');	
		$this->db->where('portfolio_id', $portfolio_id);	
		$this->db->group_start();	
		$this->db->where('pc_created_by', $this->session->userdata('d168_id'));	
		$this->db->or_where('pc_assignee', $this->session->userdata('d168_id'));	
		$this->db->group_end();	
		$this->db->where('pc_project_assign', $cnt_id);	
		$this->db->where('platform ', 'facebook');	
		$this->db->where("pc_created_date BETWEEN '".$start_date."' and '".$end_date."'");	
		$this->db->where('reg_acc_status !=', 'deactivated');	
		$this->db->where('trash', '');	
		$this->db->order_by('pc_created_date', 'ASC');	
		$query = $this->db->get();	
		return $query->result();
}

function get_userrange_cnt3($portfolio_id,$cnt_id,$start_date,$end_date)
{
        $this->db->select('pc_created_date');	
		$this->db->from('content_planning');	
		$this->db->where('portfolio_id', $portfolio_id);	
		$this->db->group_start();	
		$this->db->where('pc_created_by', $this->session->userdata('d168_id'));	
		$this->db->or_where('pc_assignee', $this->session->userdata('d168_id'));	
		$this->db->group_end();	
		$this->db->where('pc_project_assign', $cnt_id);	
		$this->db->where('platform ', 'instagram');	
		$this->db->where("pc_created_date BETWEEN '".$start_date."' and '".$end_date."'");	
		$this->db->where('reg_acc_status !=', 'deactivated');	
		$this->db->where('trash', '');	
		$this->db->order_by('pc_created_date', 'ASC');	
		$query = $this->db->get();	
		return $query->result();
}

function get_userrange_cnt4($portfolio_id,$cnt_id,$start_date,$end_date)
{
        $this->db->select('pc_created_date');	
		$this->db->from('content_planning');	
		$this->db->where('portfolio_id', $portfolio_id);	
		$this->db->group_start();	
		$this->db->where('pc_created_by', $this->session->userdata('d168_id'));	
		$this->db->or_where('pc_assignee', $this->session->userdata('d168_id'));	
		$this->db->group_end();	
		$this->db->where('pc_project_assign', $cnt_id);	
		$this->db->where('platform ', 'linkedin');	
		$this->db->where("pc_created_date BETWEEN '".$start_date."' and '".$end_date."'");	
		$this->db->where('reg_acc_status !=', 'deactivated');	
		$this->db->where('trash', '');	
		$this->db->order_by('pc_created_date', 'ASC');	
		$query = $this->db->get();	
		return $query->result();
}

function get_userrange_cnt5($portfolio_id,$cnt_id,$start_date,$end_date)
{
        $this->db->select('pc_created_date');	
		$this->db->from('content_planning');	
		$this->db->where('portfolio_id', $portfolio_id);	
		$this->db->group_start();	
		$this->db->where('pc_created_by', $this->session->userdata('d168_id'));	
		$this->db->or_where('pc_assignee', $this->session->userdata('d168_id'));	
		$this->db->group_end();	
		$this->db->where('pc_project_assign', $cnt_id);	
		$this->db->where('platform ', 'google-my-business');	
		$this->db->where("pc_created_date BETWEEN '".$start_date."' and '".$end_date."'");	
		$this->db->where('reg_acc_status !=', 'deactivated');	
		$this->db->where('trash', '');	
		$this->db->order_by('pc_created_date', 'ASC');	
		$query = $this->db->get();	
		return $query->result();
}

function get_userrange_cnt6($portfolio_id,$cnt_id,$start_date,$end_date)
{
        $this->db->select('pc_created_date');	
		$this->db->from('content_planning');	
		$this->db->where('portfolio_id', $portfolio_id);	
		$this->db->group_start();	
		$this->db->where('pc_created_by', $this->session->userdata('d168_id'));	
		$this->db->or_where('pc_assignee', $this->session->userdata('d168_id'));	
		$this->db->group_end();	
		$this->db->where('pc_project_assign', $cnt_id);	
		$this->db->where('platform ', 'pinterest');	
		$this->db->where("pc_created_date BETWEEN '".$start_date."' and '".$end_date."'");	
		$this->db->where('reg_acc_status !=', 'deactivated');	
		$this->db->where('trash', '');	
		$this->db->order_by('pc_created_date', 'ASC');	
		$query = $this->db->get();	
		return $query->result();
}

function get_userrange_cnt7($portfolio_id,$cnt_id,$start_date,$end_date)
{
        $this->db->select('pc_created_date');	
		$this->db->from('content_planning');	
		$this->db->where('portfolio_id', $portfolio_id);	
		$this->db->group_start();	
		$this->db->where('pc_created_by', $this->session->userdata('d168_id'));	
		$this->db->or_where('pc_assignee', $this->session->userdata('d168_id'));	
		$this->db->group_end();	
		$this->db->where('pc_project_assign', $cnt_id);	
		$this->db->where('platform ', 'youtube');	
		$this->db->where("pc_created_date BETWEEN '".$start_date."' and '".$end_date."'");	
		$this->db->where('reg_acc_status !=', 'deactivated');	
		$this->db->where('trash', '');	
		$this->db->order_by('pc_created_date', 'ASC');	
		$query = $this->db->get();	
		return $query->result();
}		

function get_userrange_cnt8($portfolio_id,$cnt_id,$start_date,$end_date)
{
        $this->db->select('pc_created_date');	
		$this->db->from('content_planning');	
		$this->db->where('portfolio_id', $portfolio_id);	
		$this->db->group_start();	
		$this->db->where('pc_created_by', $this->session->userdata('d168_id'));	
		$this->db->or_where('pc_assignee', $this->session->userdata('d168_id'));	
		$this->db->group_end();	
		$this->db->where('pc_project_assign', $cnt_id);	
		$this->db->where('platform ', 'blogger');	
		$this->db->where("pc_created_date BETWEEN '".$start_date."' and '".$end_date."'");	
		$this->db->where('reg_acc_status !=', 'deactivated');	
		$this->db->where('trash', '');	
		$this->db->order_by('pc_created_date', 'ASC');	
		$query = $this->db->get();	
		return $query->result();
}

function get_userrange_cnt9($portfolio_id,$cnt_id,$start_date,$end_date)
{
        $this->db->select('pc_created_date');	
		$this->db->from('content_planning');	
		$this->db->where('portfolio_id', $portfolio_id);	
		$this->db->group_start();	
		$this->db->where('pc_created_by', $this->session->userdata('d168_id'));	
		$this->db->or_where('pc_assignee', $this->session->userdata('d168_id'));	
		$this->db->group_end();	
		$this->db->where('pc_project_assign', $cnt_id);	
		$this->db->where('platform ', 'tiktok');	
		$this->db->where("pc_created_date BETWEEN '".$start_date."' and '".$end_date."'");	
		$this->db->where('reg_acc_status !=', 'deactivated');	
		$this->db->where('trash', '');	
		$this->db->order_by('pc_created_date', 'ASC');	
		$query = $this->db->get();	
		return $query->result();
}

// content user chart date range end
// project chart start
function get_pro_usertask($portfolio_id,$project_id)
{
		$query = $this->db->query("SELECT tdue_date FROM task where portfolio_id='".$portfolio_id."'and tassignee ='".$this->session->userdata('d168_id')."' and tproject_assign='".$project_id."' and reg_acc_status!='deactivated'  and trash =' '  ORDER BY tdue_date ASC ");	
		return $query->result();
}

function get_pro_usermember($portfolio_id,$project_id)
{
		// $query = $this->db->query("SELECT pmember, sent_date FROM project_members where portfolio_id='".$portfolio_id."' and pcreated_by='".$this->session->userdata('d168_id')."' OR pmember ='".$this->session->userdata('d168_id')."' and pid='".$project_id."' and reg_acc_status!='deactivated' and ptrash =' '  ORDER BY sent_date ASC");	
		// return $query->result();	
		$this->db->order_by('p.portfolio_id', 'DESC');	
		$this->db->where('pm.reg_acc_status !=','deactivated');	
		$this->db->group_start();	
		$this->db->where('p.ptype', 'regular');	
		$this->db->or_where('p.ptype', 'goal_strategy');	
		$this->db->group_end();	
		$this->db->group_start();	
		$this->db->where('p.pcreated_by', $this->session->userdata('d168_id'));	
		$this->db->or_where('pm.pmember', $this->session->userdata('d168_id'));	
		$this->db->group_end();	
		$this->db->where('p.portfolio_id', $portfolio_id);	
		$this->db->where('p.pid', $project_id);	
		$this->db->where('p.ptrash !=', 'yes');	
		$this->db->where('p.project_archive !=', 'yes');	
		$this->db->where('p.project_file_it !=', 'yes');	
		$this->db->where('pm.status', 'accepted');	
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');	
        $this->db->from('project as p');	
        $this->db->join('project_members as pm','pm.pid = p.pid');	
        $query = $this->db->get();	
        return $query->result();
}

// project chart end


// project chart date range start
function get_pro_daterangeusertask($portfolio_id,$project_id,$start_date,$end_date)
{
		$query = $this->db->query("SELECT tdue_date FROM task where portfolio_id='".$portfolio_id."'and tassignee ='".$this->session->userdata('d168_id')."' and tproject_assign='".$project_id."' and DATE(tdue_date) BETWEEN '".$start_date."' and '".$end_date."' and reg_acc_status!='deactivated' and ptype!='regular' ORand ptype!='goal_strategy' and trash =' '  ORDER BY tdue_date ASC ");	
		return $query->result();
}

function get_pro_daterangeusermember($portfolio_id,$project_id,$start_date,$end_date)
{
		// $query = $this->db->query("SELECT pmember, sent_date FROM project_members where portfolio_id='".$portfolio_id."' and pcreated_by='".$this->session->userdata('d168_id')."' and pid='".$project_id."' and DATE(sent_date) BETWEEN '".$start_date."' and '".$end_date."' and reg_acc_status!='deactivated' and ptrash =' '  ORDER BY sent_date ASC");	
		// return $query->result();	
		$this->db->order_by('p.portfolio_id', 'DESC');	
		$this->db->where('pm.reg_acc_status !=','deactivated');	
		$this->db->group_start();	
		$this->db->where('p.ptype', 'regular');	
		$this->db->or_where('p.ptype', 'goal_strategy');	
		$this->db->group_end();	
		$this->db->group_start();	
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));	
		$this->db->or_where('p.pcreated_by', $this->session->userdata('d168_id'));	
		$this->db->group_end();	
		$this->db->where('p.portfolio_id', $portfolio_id);	
		$this->db->where('p.pid', $project_id);	
		$this->db->where('p.ptrash !=', 'yes');	
		$this->db->where('p.project_archive !=', 'yes');	
		$this->db->where('p.project_file_it !=', 'yes');	
		$this->db->where('pm.status', 'accepted');	
		$this->db->where("DATE(pm.sent_date) BETWEEN '".$start_date."' and '".$end_date."'");	
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');	
        $this->db->from('project as p');	
        $this->db->join('project_members as pm','pm.pid = p.pid');	
        $query = $this->db->get();	
        return $query->result();
}

// project chart date range end

// task chart start
function get_todo_usertask($portfolio_id)
{

		$query = $this->db->query("SELECT COUNT(*) as count_rows FROM task where portfolio_id='".$portfolio_id."' and tcreated_by='".$this->session->userdata('d168_id')."' and reg_acc_status!='deactivated' and trash =' ' and tstatus = 'to_do' ORDER BY tdue_date ASC");
		return $query->row_array();

}

function get_todo_usertasks($portfolio_id,$x)
{
			$query = $this->db->query("SELECT tcreated_date, tdue_date FROM task where portfolio_id='".$portfolio_id."' and 	tassignee='".$this->session->userdata('d168_id')."' and reg_acc_status!='deactivated' and trash =' ' and tstatus = 'to_do'  ORDER BY tdue_date ASC");
			return $query->result();

	}

function get_prog_usertasks($portfolio_id)
{
		$query = $this->db->query("SELECT tcreated_date, tdue_date FROM task where portfolio_id='".$portfolio_id."' and 	tassignee='".$this->session->userdata('d168_id')."'  and reg_acc_status!='deactivated' and trash=' ' and tstatus = 'in_progress'  ORDER BY tdue_date ASC");
		return $query->result();

}

function get_rev_usertasks($portfolio_id)
{
		$query = $this->db->query("SELECT tcreated_date, tdue_date FROM task where portfolio_id='".$portfolio_id."' and  	tassignee='".$this->session->userdata('d168_id')."' and reg_acc_status!='deactivated' and trash=' ' and tstatus = 'in_review'  ORDER BY tdue_date ASC");
		return $query->result();
}

function get_done_usertasks($portfolio_id)
{
		$query = $this->db->query("SELECT tcreated_date, tdue_date FROM task where portfolio_id='".$portfolio_id."' and 	tassignee='".$this->session->userdata('d168_id')."' and reg_acc_status!='deactivated' and trash =' ' and tstatus = 'done'  ORDER BY tdue_date ASC");
		return $query->result();
}

// task chart end

// subtask chart start

function get_usertodo_subtasks($portfolio_id,$x)
	{
				$query = $this->db->query("SELECT stcreated_date, stdue_date FROM subtask where portfolio_id='".$portfolio_id."' and  stassignee='".$this->session->userdata('d168_id')."' and  reg_acc_status!='deactivated' and strash =' ' and ststatus = 'to_do'  ORDER BY stdue_date ASC");	
				return $query->result();

	}
	
	function get_userprog_subtasks($portfolio_id)
	{
			$query = $this->db->query("SELECT stcreated_date, stdue_date FROM subtask where portfolio_id='".$portfolio_id."' and  stassignee='".$this->session->userdata('d168_id')."' and reg_acc_status!='deactivated' and strash=' ' and ststatus = 'in_progress'  ORDER BY stdue_date ASC");	
			return $query->result();

	}
	function get_userrev_subtasks($portfolio_id)
	{
			$query = $this->db->query("SELECT stcreated_date, stdue_date FROM subtask where portfolio_id='".$portfolio_id."' and stassignee='".$this->session->userdata('d168_id')."' and reg_acc_status!='deactivated' and strash=' ' and ststatus = 'in_review'  ORDER BY stdue_date ASC");	
			return $query->result();
	}
	
	function get_userdone_subtasks($portfolio_id)
	{
			$query = $this->db->query("SELECT stcreated_date, stdue_date FROM subtask where portfolio_id='".$portfolio_id."' and stassignee='".$this->session->userdata('d168_id')."' and reg_acc_status!='deactivated' and strash =' ' and ststatus = 'done'  ORDER BY stdue_date ASC");	
			return $query->result();
	}
	// subtask chart end

function count_portfolio_Userproject($c_id)
{
	$query = $this->db->query("SELECT COUNT(*) as count_rows FROM project where portfolio_id='".$c_id."' and pcreated_by='".$this->session->userdata('d168_id')."' and ptrash!='yes' and reg_acc_status != 'deactivated' and project_archive!='yes' and project_file_it!='yes' and (ptype = 'regular' or ptype = 'goal_strategy')");
	return $query->row_array();
}

function count_portfolio_project_Usercontent($c_id)
{
		$query = $this->db->query("SELECT COUNT(*) as count_rows FROM project where portfolio_id='".$c_id."' and pcreated_by='".$this->session->userdata('d168_id')."' and ptrash!='yes' and reg_acc_status != 'deactivated' and project_archive!='yes' and project_file_it!='yes' and ptype = 'content'");
		return $query->row_array();
}

function count_Portfolio_Usertask($c_id)
{
	$query = $this->db->query("SELECT COUNT(*) as count_rows FROM task where portfolio_id='".$c_id."' and tcreated_by='".$this->session->userdata('d168_id')."' and trash!='yes' and task_archive!='yes' and task_file_it!='yes' and reg_acc_status != 'deactivated'");
	return $query->row_array();
}

function count_Usergoals($c_id)
{
	$query = $this->db->query("SELECT COUNT(*) as count_rows FROM goals where portfolio_id='".$c_id."' and gcreated_by='".$this->session->userdata('d168_id')."' and g_trash!='yes' and g_archive!='yes' and g_file_it!='yes' and reg_acc_status != 'deactivated'");
	return $query->row_array();
}

	function portfolio_UserDepartment($id,$uid)
{
	$this->db->order_by('portfolio_dept_id','DESC');
	$this->db->where('portfolio_id',$id);
	// $this->db->where('createdby',$uid);
	$this->db->where('dstatus', 'active');
	$query = $this->db->get('project_portfolio_department');
	return $query->result();
}

function portfolio_Usergoals($c_id,$stdsid)
{
	$this->db->order_by('g.portfolio_id', 'DESC');	
		$this->db->where('gm.reg_acc_status !=','deactivated');	
		$this->db->where('g.portfolio_id', $c_id);	
		$this->db->where('gm.gmember', $this->session->userdata('d168_id'));	
		$this->db->where('g.g_archive !=', 'yes');	
		$this->db->where('g.g_file_it !=', 'yes');	
		$this->db->where('g.g_trash !=', 'yes');	
		$this->db->where('gm.status','accepted');	
        $this->db->select('*, g.gid as gid, gm.gid as gm_gid');	
        $this->db->from('goals as g');	
        $this->db->join('goals_members as gm','gm.gid = g.gid');	
        $query = $this->db->get();	
        return $query->result();
}

function portfolio_UserContent($c_id,$stdsid)
{
		$this->db->order_by('p.portfolio_id', 'DESC');	
		$this->db->where('p.ptype', 'content');	
		$this->db->group_start();	
		$this->db->group_start();	
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));	
		$this->db->where('pm.reg_acc_status !=','deactivated');	
		$this->db->where('pm.status', 'accepted');	
		$this->db->group_end();	
		$this->db->or_where('p.pcreated_by', $this->session->userdata('d168_id'));	
		$this->db->group_end();	
		$this->db->where('p.portfolio_id', $c_id);	
		$this->db->where('p.ptrash !=', 'yes');	
		$this->db->where('p.project_archive !=', 'yes');	
		$this->db->where('p.project_file_it !=', 'yes');	
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');	
        $this->db->from('project as p');	
        $this->db->join('project_members as pm','pm.pid = p.pid', 'left');	
        $query = $this->db->get();	
        return $query->result();
}


function portfolio_Userprojects($c_id,$stdsid)
{
		$this->db->order_by('p.portfolio_id', 'DESC');	
		$this->db->group_start();	
		$this->db->where('ptype', 'regular');	
		$this->db->or_where('ptype', 'goal_strategy');	
		$this->db->group_end();	
		$this->db->group_start();	
		$this->db->group_start();	
		$this->db->where('pm.pmember', $this->session->userdata('d168_id'));	
		$this->db->where('pm.reg_acc_status !=','deactivated');	
		$this->db->where('pm.status', 'accepted');	
		$this->db->group_end();	
		$this->db->or_where('p.pcreated_by', $this->session->userdata('d168_id'));	
		$this->db->group_end();	
		$this->db->where('p.portfolio_id', $c_id);	
		$this->db->where('p.ptrash !=', 'yes');	
		$this->db->where('p.project_archive !=', 'yes');	
		$this->db->where('p.project_file_it !=', 'yes');	
        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');	
        $this->db->from('project as p');	
        $this->db->join('project_members as pm','pm.pid = p.pid', 'left');	
        $query = $this->db->get();	
        return $query->result();
}

function PortfolioDetail($id)
{
	$this->db->where('reg_acc_status !=','deactivated');
	$this->db->where('portfolio_createdby', $this->session->userdata('d168_id'));
	$this->db->where('portfolio_trash !=', 'yes');
	$this->db->where('portfolio_archive !=', 'yes');
	$this->db->where('portfolio_file_it !=', 'yes');
	$this->db->where('portfolio_id',$id);
	$query = $this->db->get('project_portfolio');
	return $query->row();
}

function checkUserReportTemplate($id)
    {
    	$this->db->where('id', $id);
    	$query = $this->db->get('report_usertemplate');
    	return $query->row();
    }

	function getUserTemplate($pid)
	{
		$this->db->where('user_id', $this->session->userdata('d168_id'));
		$this->db->where('portfolio_id', $pid);
		$query = $this->db->get('report_usertemplate');
		return $query->result();
	}

  function getUserTemplateById($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('report_usertemplate');
		return $query->row();
	}

  function delete_Usertemplate($id)
	{
		$this->db->where('id',$id);
		if($this->db->delete('report_usertemplate'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

  function InsertUserTemplate($data)
	{
		if($this->db->insert('report_usertemplate',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function portfolio_Allgoals($c_id)	
	{	
		$this->db->order_by('gid','DESC');	
		$this->db->where('reg_acc_status !=','deactivated');	
		$this->db->where('g_archive !=', 'yes');	
		$this->db->where('g_file_it !=', 'yes');	
		$this->db->where('g_trash !=', 'yes');	
		$this->db->where('portfolio_id',$c_id);	
		$query = $this->db->get('goals');	
		return $query->result();	
	}	
	function get_cnt_usermember($portfolio_id,$project_id)	
	{		
			// $query = $this->db->query("SELECT pmember, sent_date FROM project_members where portfolio_id='".$portfolio_id."' and pcreated_by='".$this->session->userdata('d168_id')."' OR pmember ='".$this->session->userdata('d168_id')."' and pid='".$project_id."' and reg_acc_status!='deactivated' and ptrash =' '  ORDER BY sent_date ASC");	
			// return $query->result();	
			$this->db->order_by('p.portfolio_id', 'DESC');	
			$this->db->where('pm.reg_acc_status !=','deactivated');	
			$this->db->where('p.ptype', 'content');	
			$this->db->group_start();	
			$this->db->where('p.pcreated_by', $this->session->userdata('d168_id'));	
			$this->db->or_where('pm.pmember', $this->session->userdata('d168_id'));	
			$this->db->group_end();	
			$this->db->where('p.portfolio_id', $portfolio_id);	
			$this->db->where('p.pid', $project_id);	
			$this->db->where('p.ptrash !=', 'yes');	
			$this->db->where('p.project_archive !=', 'yes');	
			$this->db->where('p.project_file_it !=', 'yes');	
			$this->db->where('pm.status', 'accepted');	
	        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');	
	        $this->db->from('project as p');	
	        $this->db->join('project_members as pm','pm.pid = p.pid');	
	        $query = $this->db->get();	
	        return $query->result();	
	}	
	function get_cnt_userrangetask($portfolio_id,$project_id,$start_date,$end_date)	
	{	
	        $query = $this->db->query("SELECT tdue_date FROM task where portfolio_id='".$portfolio_id."'and  tassignee='".$this->session->userdata('d168_id')."' and tproject_assign='".$project_id."' and DATE(tdue_date) BETWEEN '".$start_date."' and '".$end_date."' and reg_acc_status!='deactivated' and ptype!='regular' OR ptype!='goal_strategy' and trash =' '  ORDER BY tdue_date ASC ");	
	        return $query->result();	
	}	
	function get_cnt_userrangemember($portfolio_id,$project_id,$start_date,$end_date)	
	{		
	        // $query = $this->db->query("SELECT pmember, sent_date FROM project_members where portfolio_id='".$portfolio_id."' and pcreated_by='".$this->session->userdata('d168_id')."' OR pmember='".$this->session->userdata('d168_id')."' and pid='".$project_id."' and DATE(sent_date) BETWEEN '".$start_date."' and '".$end_date."' and reg_acc_status!='deactivated' and ptrash =' '  ORDER BY sent_date ASC");	
	        // return $query->result();	
			$this->db->order_by('p.portfolio_id', 'DESC');	
			$this->db->where('pm.reg_acc_status !=','deactivated');	
			$this->db->where('p.ptype', 'content');	
			$this->db->group_start();	
			$this->db->where('p.pcreated_by', $this->session->userdata('d168_id'));	
			$this->db->or_where('pm.pmember', $this->session->userdata('d168_id'));	
			$this->db->group_end();	
			$this->db->where('p.portfolio_id', $portfolio_id);	
			$this->db->where('p.pid', $project_id);	
			$this->db->where('p.ptrash !=', 'yes');	
			$this->db->where('p.project_archive !=', 'yes');	
			$this->db->where('p.project_file_it !=', 'yes');	
			$this->db->where('pm.status', 'accepted');	
			$this->db->where("DATE(pm.sent_date) BETWEEN '".$start_date."' and '".$end_date."'");	
	        $this->db->select('*, p.pid as pid, pm.pid as pm_pid');	
	        $this->db->from('project as p');	
	        $this->db->join('project_members as pm','pm.pid = p.pid');	
	        $query = $this->db->get();	
	        return $query->result();	
	}	
	function get_cnt_usertask($portfolio_id,$project_id)	
	{	
			$query = $this->db->query("SELECT tdue_date FROM task where portfolio_id='".$portfolio_id."'and tassignee ='".$this->session->userdata('d168_id')."' and tproject_assign='".$project_id."' and reg_acc_status!='deactivated' and trash =' '  ORDER BY tdue_date ASC ");	
			return $query->result();	
	}
// User report work end

  	//////Report Part End///////

  	//////Support Part Start///////

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

  	//////Support Part End///////

  	// Tour functions ------//-----//----//----//----

	function checkMyTour($reg_id,$tour)
	{
		$this->db->where('reg_id', $reg_id);
		$this->db->where('name', $tour);
		$query = $this->db->get('tour');
		return $query->num_rows();
	}

	function insertInTour($data)
	{
		if($this->db->insert('tour',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	// End Tour functions ------//-----//----//----//----

	// New functions for archive --------//--------//-----------

	function archiveProjectDetail($id)
	{		
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('pcreated_by', $this->session->userdata('d168_id'));
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it', 'yes');
		$this->db->where('pid',$id);
		$query = $this->db->get('project');
		return $query->row();
	}

	function archivegetProjectAllTaskNotArc($id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('trash !=','yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it', 'yes');
		$this->db->where('tproject_assign',$id);
		$query = $this->db->get('task');
		return $query->result();
	}

	function archivegetProjectAllSubtaskNotArc($id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('strash !=','yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it', 'yes');
		$this->db->where('stproject_assign',$id);
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function archivegetProjectAllCPNotArc($id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('trash !=','yes');
		$this->db->where('cp_archive !=', 'yes');
		$this->db->where('cp_file_it', 'yes');
		$this->db->where('pc_project_assign',$id);
		$query = $this->db->get('content_planning');
		return $query->result();
	}

	function archivecheck_Donetask($tid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('tid', $tid);
    	$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it', 'yes');
		$this->db->where('tstatus', 'done');
    	$query = $this->db->get('task');
    	return $query->row();
    }

    function archivegetTaskAllSubtaskNotArc($id)
	{
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('strash !=','yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it', 'yes');
		$this->db->where('tid',$id);
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function archivecheck_Donesubtask($stid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('stid', $stid);
    	$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it', 'yes');
		$this->db->where('ststatus','done');
    	$query = $this->db->get('subtask');
    	return $query->row();
    }

    function archivecheck_DonePlatform($pc_id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('pc_id', $pc_id);
    	$this->db->where('trash !=', 'yes');
		$this->db->where('cp_archive !=', 'yes');
		$this->db->where('cp_file_it', 'yes');
		$this->db->where('pc_status', 'done');
        $query = $this->db->get('content_planning');
    	return $query->row();
    }

    function archivegetProjectById($id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('pid', $id);
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it', 'yes');
    	$query = $this->db->get('project');
    	return $query->row();
    }

    function archiveGoalDetail($id)
	{		
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('g_trash !=', 'yes');
		$this->db->where('g_archive !=', 'yes');
		$this->db->where('g_file_it', 'yes');
		$this->db->where('gid',$id);
		$query = $this->db->get('goals');
		return $query->row();
	}

	function archiveGoal_tasks($id)
	{
		$this->db->order_by('tid', 'DESC');
    	//$this->db->group_by('tassignee');
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it', 'yes');
		$this->db->where('gid', $id);
		$query = $this->db->get('task');
		return $query->result();
	}

	function archiveGoal_subtasks($id)
	{
		$this->db->order_by('stid', 'DESC');
    	//$this->db->group_by('stassignee');
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it', 'yes');
		$this->db->where('gid', $id);
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function archiveStrategyDetail($id)
	{		
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('s_trash !=', 'yes');
		$this->db->where('s_archive !=', 'yes');
		$this->db->where('s_file_it', 'yes');
		$this->db->where('sid',$id);
		$query = $this->db->get('strategies');
		return $query->row();
	}

	function archiveStrategy_tasks($id)
	{
		$this->db->order_by('tid', 'DESC');
    	//$this->db->group_by('tassignee');
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('trash !=', 'yes');
		$this->db->where('task_archive !=', 'yes');
		$this->db->where('task_file_it', 'yes');
		$this->db->where('sid', $id);
		$query = $this->db->get('task');
		return $query->result();
	}

	function archiveStrategy_subtasks($id)
	{
		$this->db->order_by('stid', 'DESC');
    	//$this->db->group_by('stassignee');
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('strash !=', 'yes');
		$this->db->where('subtask_archive !=', 'yes');
		$this->db->where('subtask_file_it', 'yes');
		$this->db->where('sid', $id);
		$query = $this->db->get('subtask');
		return $query->result();
	}

	function getGoalById($id)
	{		
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('g_trash !=', 'yes');
		$this->db->where('gid',$id);
		$query = $this->db->get('goals');
		return $query->row();
	}

	function getStrategyById($id)
	{		
		$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('s_trash !=', 'yes');
		$this->db->where('sid',$id);
		$query = $this->db->get('strategies');
		return $query->row();
	}

	function getPortProjectById($id)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
		$this->db->where('ptrash !=', 'yes');
    	$this->db->where('pid', $id);
    	$query = $this->db->get('project');
    	return $query->row();
    }

    function getProjTaskById($tid)
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('trash !=','yes');
    	$this->db->where('tid',$tid);
    	$query = $this->db->get('task');
    	return $query->row();
    }

    // Start time tracking Functions ///////////////////////////	
  	function getTaskByflag()	
	{	
		$this->db->select('*,task.tid');	
		$this->db->from('task');	
		$this->db->join('subtask', 'task.tid = subtask.tid', 'left');	
		$this->db->where('(task.flag = 1 OR subtask.sflag = 1)');	
		$this->db->group_start();	
    	$this->db->where('trash !=','yes');	
    	$this->db->or_where('strash !=','yes');	
		$this->db->group_end();	
			
		$this->db->group_start();	
		$this->db->where('task.portfolio_id', $_COOKIE["d168_selectedportfolio"]);	
		$this->db->where('task.tassignee', $this->session->userdata('d168_id'));	
		$this->db->or_where('subtask.portfolio_id', $_COOKIE["d168_selectedportfolio"]);	
		$this->db->where('subtask.stassignee', $this->session->userdata('d168_id'));	
		$this->db->group_end();	
		$query = $this->db->get();		
		if ($query->num_rows() > 0) {	
			// Flags are set to 1	
			return $query->result_array();	
		} else {	
			// Flags are not set to 1	
			return false;	
		}	
	}	
	// End time tracking Functions ///////////////////////////

	// Start Community Functions ///////////////////////////

    function insertExpertPhones($data)
	{
		if($this->db->insert('expert_phone_numbers',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function decision_maker($reg_id)
	{
		$this->db->order_by('expert_approved_date','DESC');
		$this->db->where('reg_id !=', $reg_id);
		$this->db->where('verified', 'yes');
		$this->db->where('expert', '1');
		$this->db->where('expert_approve', '1');
		$this->db->where('expert_status', 'active');
		$this->db->where('call_rate_set', '1');
		$query = $this->db->get('registration');
		return $query->result();
	}

	function insertCallBooking($data)
	{
		if($this->db->insert('expert_call_booking',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function pendingRequest($reg_id)
	{
		$this->db->order_by('booking_date','DESC');
		$this->db->where('expert_id', $reg_id);
		$this->db->where('paid', 0);
		$query = $this->db->get('expert_call_booking');
		return $query->result();
	}

	function updateCallBooking($data,$cid)
	{
		$this->db->where('cid', $cid);
		$this->db->update('expert_call_booking',$data);
	}

	function allCalls($reg_id)
	{
		$this->db->order_by('booking_date','DESC');
		$this->db->where('expert_id', $reg_id);
		$query = $this->db->get('expert_call_booking');
		return $query->result();
	}

	function callById($cid)
	{
		$this->db->where('cid', $cid);
		$query = $this->db->get('expert_call_booking');
		return $query->row();
	}

	function userCallsCount($user_id)
	{
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('expert_call_booking');
		return $query->num_rows();
	}

	function userPendingRequest($reg_id)
	{
		$this->db->order_by('booking_date','DESC');
		$this->db->where('user_id', $reg_id);
		$this->db->where('paid', 0);
		$query = $this->db->get('expert_call_booking');
		return $query->result();
	}

	function userAllCalls($reg_id)
	{
		$this->db->order_by('booking_date','DESC');
		$this->db->where('user_id', $reg_id);
		$query = $this->db->get('expert_call_booking');
		return $query->result();
	}

	function getApproveExpertNotify_clear()
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('reg_id', $this->session->userdata('d168_id'));
    	$this->db->where('call_notify_clear','no');
        $query = $this->db->get('registration');
        return $query->result();
    }

	function getApproveExpertNotify()
    {
    	$this->db->where('reg_acc_status !=','deactivated');
    	$this->db->where('reg_id', $this->session->userdata('d168_id'));
    	$this->db->where('call_notify','sent_yes');
        $query = $this->db->get('registration');
        return $query->result();
    }

	function callMinutes()
    {
    	$this->db->order_by('cm_id','ASC');
    	$this->db->where('status','active');
        $query = $this->db->get('expert_call_minute');
        return $query->result();
    }

	function callRateByCId($cm_id,$expert_id)
    {
    	$this->db->where('cm_id',$cm_id);
    	$this->db->where('expert_id', $expert_id);
        $query = $this->db->get('expert_call_rate');
        return $query->row();
    }

	function insertCallRate($data)
	{
		if($this->db->insert('expert_call_rate',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function update_call_rate($data,$cm_id,$expert_id)
    {
    	$this->db->where('cm_id',$cm_id);
    	$this->db->where('expert_id', $expert_id);
        $this->db->update('expert_call_rate',$data);
    }

    function delete_call_rate($cm_id,$expert_id)
	{
		$this->db->where('cm_id',$cm_id);
    	$this->db->where('expert_id', $expert_id);
		$this->db->delete('expert_call_rate');		
	}

	function countExpertCallRate($expert_id)
    {
    	$this->db->where('expert_id', $expert_id);
        $query = $this->db->get('expert_call_rate');
        return $query->num_rows();
    }

	function expertCallRate($expert_id)
    {
    	$this->db->order_by('cm_id','ASC');
    	$this->db->where('expert_id', $expert_id);
        $query = $this->db->get('expert_call_rate');
        return $query->result();
    }

	function callMinutesById($cm_id)
    {
    	$this->db->where('cm_id',$cm_id);
        $query = $this->db->get('expert_call_minute');
        return $query->row();
    }

	function expertLessCallRate($expert_id)
    {
    	$this->db->order_by('cm_id','ASC');
    	$this->db->where('expert_id', $expert_id);
        $query = $this->db->get('expert_call_rate');
        return $query->row();
    }

	function getCallBookingdetails($reg_id)
	{
		$this->db->where('user_id', $reg_id);
		$this->db->where('paid', 0);
		$query = $this->db->get('expert_call_booking');
		return $query->result();
	}

	function getCalendarMonthCallBookings($id,$month_year)
	{
		$this->db->group_start();
        $this->db->like('date_array', $month_year); 
        $this->db->group_end();
        $this->db->where('e.status', 'active');
        //$this->db->where('e.expert_approval', '1');
        $this->db->where('ec.expert_id', $id);
        $this->db->select('*');
        $this->db->from('events as e');
        $this->db->join('events_call_booking as ec','ec.event_id = e.id');
        $query = $this->db->get();
        return $query->result();
	}

	function getCalendarDlCallBookings($id,$day_list)
	{
        $this->db->group_start();
        $this->db->where('event_start_date', $day_list); 
        $this->db->or_like('event_start_date', date("Y-m", strtotime($day_list))); 
        $this->db->or_like('event_end_date', date("Y-m", strtotime($day_list))); 
        $this->db->group_end();
        $this->db->where('e.status', 'active');
        //$this->db->where('e.expert_approval', '1');
        $this->db->where('ec.expert_id', $id);
        $this->db->select('*');
        $this->db->from('events as e');
        $this->db->join('events_call_booking as ec','ec.event_id = e.id');
        $query = $this->db->get();
        return $query->result();
	}

	function getCalendarWeekCallBookings($student_id,$date1,$date2)
	{
        $d1=date("Y-m", strtotime($date1));
        $d2=date("Y-m", strtotime($date2));
        $this->db->group_start();
        $this->db->where("event_start_date BETWEEN '$date1' AND '$date2'"); 
        $this->db->or_where("'$date1' BETWEEN event_start_date AND event_end_date"); 
        $this->db->or_where("'$date2' BETWEEN event_start_date AND event_end_date"); 
        $this->db->group_end();
        $this->db->where('e.status', 'active');
        //$this->db->where('e.expert_approval', '1');
        $this->db->where('ec.expert_id', $id);
        $this->db->select('*');
        $this->db->from('events as e');
        $this->db->join('events_call_booking as ec','ec.event_id = e.id');
        $query = $this->db->get();
        return $query->result();
	}

	function insertEventCallBooking($data)
	{
		if($this->db->insert('events_call_booking',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function updateEventCallBooking($data,$cid)
	{
		$this->db->where('call_id', $cid);
		$this->db->update('events',$data);
	}

	function get_events_call_booking($event_id)
	{
		$this->db->where('ec.event_id',$event_id);
		$this->db->select('first_name,last_name,email_address,ec.expert_id');
        $this->db->from('events_call_booking as ec');
        $this->db->join('registration as r','r.reg_id = ec.expert_id');
        $query = $this->db->get();
        return $query->row();
	}

	function getCallBookingByExpert($reg_id)
	{
		$this->db->where('expert_id', $reg_id);
		$query = $this->db->get('expert_call_booking');
		return $query->result();
	}

	function deleteCallBooking($cid)
	{
		$this->db->where('cid', $cid);
		$this->db->delete('expert_call_booking');
	}

	function deleteEventCallBooking($cid)
	{
		$this->db->where('call_id', $cid);
		$this->db->delete('events_call_booking');
	}

	function delete_event($cid)
	{
		$this->db->where('call_id', $cid);
		$this->db->delete('events');
	}

	function getExpertCalls()
	{
		$this->db->where('paid', 1);
		$this->db->where('call_completed', 0);
		$this->db->group_start();
		$this->db->where('booking_date =', date('Y-m-d'));
		$this->db->or_where('booking_date >', date('Y-m-d'));
		$this->db->group_end();
		$query = $this->db->get('expert_call_booking');
		return $query->result();
	}

	// End Community Functions ///////////////////////////

    //////////corporate section////////////

	function checkCompanyEncrypt($cor_id)
	{
		$this->db->where('extended_pack !=', 'expired');
		$this->db->where('cc_status', 'active');
		$this->db->where('cc_corporate_id_encrypt', $cor_id);
		$query = $this->db->get('contacted_company');
		return $query->row();
	}

	function checkCompany($cor_id)
	{
		$this->db->where('package_use', 'yes');
		$this->db->where('extended_pack !=', 'expired');
		$this->db->where('cc_status', 'active');
		$this->db->where('cc_corporate_id', $cor_id);
		$query = $this->db->get('contacted_company');
		return $query->row();
	}

	function checkCompanyEmp($email,$cc_id)
	{
		$this->db->where('emp_status', 'active');
		$this->db->where('emp_email', $email);
		$this->db->where('cc_id', $cc_id);
		$query = $this->db->get('contacted_company_emp');
		return $query->row();
	}

	function update_contacted_company_emp($data2,$id)
    {
		$this->db->where('cce_id', $id);
        $this->db->update('contacted_company_emp',$data2);
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

	function getCompany($cor_id)
	{
		$this->db->where('cc_corporate_id', $cor_id);
		$query = $this->db->get('contacted_company');
		return $query->row();
	}

	function getCompanyRoles($ccr_id)
	{
		$this->db->where('ccr_id', $ccr_id);
		$query = $this->db->get('contacted_company_roles');
		return $query->row();
	}

	function getPortfolioCountCorp()
	{
		$query = $this->db->query("SELECT COUNT(*) as portfolio_count_rows FROM project_portfolio where corporate_id='".$this->session->userdata('d168_user_cor_id')."' and portfolio_trash = '' and portfolio_archive = '' and portfolio_file_it = '' and reg_acc_status != 'deactivated'");
		return $query->row_array();
	}

	function getTaskCountCorp($port_id)
	{
		$query = $this->db->query("SELECT COUNT(*) as task_count_rows FROM task where corporate_id='".$this->session->userdata('d168_user_cor_id')."' and trash = '' and task_archive = '' and task_file_it = '' and portfolio_id = '".$port_id."' and reg_acc_status != 'deactivated'");
		return $query->row_array();
	}

	function getProject_TaskCountCorp($pid)
	{
		$query = $this->db->query("SELECT COUNT(*) as task_count_rows FROM task where corporate_id='".$this->session->userdata('d168_user_cor_id')."' and tproject_assign = '".$pid."' and reg_acc_status != 'deactivated'");
		return $query->row_array();
	}

	function getMonthWiseContentCorp($current_month,$current_year,$port_id)
	{
		$query = $this->db->query("SELECT COUNT(*) as content_count_rows FROM project where corporate_id='".$this->session->userdata('d168_user_cor_id')."' and ptype='content' and month(pcreated_date)='".$current_month."'  and year(pcreated_date)='".$current_year."' and ptrash = '' and project_archive = '' and project_file_it = '' and portfolio_id = '".$port_id."' and reg_acc_status != 'deactivated'");
		return $query->row_array();
	}

	function getStrategiesCountCorp($port_id,$gid)
	{
		$query = $this->db->query("SELECT COUNT(*) as strategy_count_rows FROM strategies where corporate_id='".$this->session->userdata('d168_user_cor_id')."' and s_trash = '' and s_archive = '' and s_file_it = '' and portfolio_id = '".$port_id."' and gid = '".$gid."' and reg_acc_status != 'deactivated'");
		return $query->row_array();
	}

	function getGoalCountCorp($port_id)
	{
		$query = $this->db->query("SELECT COUNT(*) as goal_count_rows FROM goals where corporate_id='".$this->session->userdata('d168_user_cor_id')."' and g_trash = '' and g_archive = '' and g_file_it = '' and portfolio_id = '".$port_id."' and reg_acc_status != 'deactivated'");
		return $query->row_array();
	}

	function getProjectCountCorp($port_id)
	{
		$query = $this->db->query("SELECT COUNT(*) as project_count_rows FROM project where corporate_id='".$this->session->userdata('d168_user_cor_id')."'  and ptrash = '' and project_archive = '' and project_file_it = '' and portfolio_id = '".$port_id."' and (ptype = 'regular' or ptype = 'goal_strategy') and reg_acc_status != 'deactivated'");
		return $query->row_array();
	}

	function getPortfolioMemberCountCorp($portfolio_id)
	{
		$query = $this->db->query("SELECT COUNT(*) as portfolio_member_count_rows FROM project_portfolio_member as ppm JOIN project_portfolio as pp ON pp.portfolio_id = ppm.portfolio_id where pp.corporate_id='".$this->session->userdata('d168_user_cor_id')."'  and ppm.portfolio_id='".$portfolio_id."' and ppm.reg_acc_status != 'deactivated'");
		return $query->row_array();
	}
	//////////corporate section////////////

	// request to preview files if view only selected in role

	function check_file_preview_access($pid)
	{		
		$this->db->where('req_by', $this->session->userdata('d168_id'));
		$this->db->where('pid', $pid);
		$query = $this->db->get('file_preview_access');
		return $query->row();
	}

	function insert_file_preview_access_req($data)
	{
		if($this->db->insert('file_preview_access',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function file_preview_permission_notify_clear()
	{		
		$this->db->where('f.req_status','sent');
		$this->db->where('f.req_notify','yes');
		$this->db->where('f.req_notify_clear', 'no');
		$this->db->where('p.reg_acc_status !=','deactivated');
		$this->db->where('p.ptrash !=', 'yes');
		$this->db->where('p.project_archive !=', 'yes');
		$this->db->where('p.project_file_it !=', 'yes');
		$this->db->group_start();
		$this->db->where('p.pcreated_by', $this->session->userdata('d168_id'));	
		$this->db->or_where('p.pmanager', $this->session->userdata('d168_id'));
		$this->db->group_end();
		$this->db->select('*,p.pid as pid,f.pid as f_pid');
        $this->db->from('file_preview_access as f');
        $this->db->join('project as p', 'p.pid = f.pid');
        $query = $this->db->get();
        return $query->result();
	}

	function file_preview_permission_notify()
	{		
		$this->db->where('f.req_status','sent');
		$this->db->where('f.req_notify','yes');
		$this->db->where('p.reg_acc_status !=','deactivated');
		$this->db->where('p.ptrash !=', 'yes');
		$this->db->where('p.project_archive !=', 'yes');
		$this->db->where('p.project_file_it !=', 'yes');
		$this->db->group_start();
		$this->db->where('p.pcreated_by', $this->session->userdata('d168_id'));	
		$this->db->or_where('p.pmanager', $this->session->userdata('d168_id'));
		$this->db->group_end();
		$this->db->select('*,p.pid as pid,f.pid as f_pid');
        $this->db->from('file_preview_access as f');
        $this->db->join('project as p', 'p.pid = f.pid');
        $query = $this->db->get();
        return $query->result();
	}

	function update_file_preview_access_req($data,$id)
	{
		$this->db->where('fpid',$id);
		if($this->db->update('file_preview_access',$data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function get_file_preview_access($fpid)
	{		
		$this->db->where('fpid', $fpid);
		$query = $this->db->get('file_preview_access');
		return $query->row();
	}

	function file_preview_permission_resp_notify_clear()
	{		
		$this->db->where('f.req_by',$this->session->userdata('d168_id'));
		$this->db->where('f.res_notify','yes');
		$this->db->where('f.res_notify_clear', 'no');
		$this->db->where('p.reg_acc_status !=','deactivated');
		$this->db->where('p.ptrash !=', 'yes');
		$this->db->where('p.project_archive !=', 'yes');
		$this->db->where('p.project_file_it !=', 'yes');
		$this->db->select('*,p.pid as pid,f.pid as f_pid');
        $this->db->from('file_preview_access as f');
        $this->db->join('project as p', 'p.pid = f.pid');
        $query = $this->db->get();
        return $query->result();
	}

	function file_preview_permission_resp_notify()
	{		
		$this->db->where('f.req_by',$this->session->userdata('d168_id'));
		$this->db->where('f.res_notify','yes');
		$this->db->where('p.reg_acc_status !=','deactivated');
		$this->db->where('p.ptrash !=', 'yes');
		$this->db->where('p.project_archive !=', 'yes');
		$this->db->where('p.project_file_it !=', 'yes');
		$this->db->select('*,p.pid as pid,f.pid as f_pid');
        $this->db->from('file_preview_access as f');
        $this->db->join('project as p', 'p.pid = f.pid');
        $query = $this->db->get();
        return $query->result();
	}

	function check_pro_member_exists($pid,$t)
	{
		$this->db->where('pmember', $t);
		$this->db->where('ptrash !=', 'yes');
		$this->db->where('project_archive !=', 'yes');
		$this->db->where('project_file_it !=', 'yes');
		$this->db->where('pid', $pid);
		$query = $this->db->get('project_members');
		return $query->row();
	}

	// request to preview files if view only selected in role
	
  // Notes work start

  function insert_note($data)
  {
	  if($this->db->insert('notes',$data))
	  {
		  return TRUE;
	  }
	  else
	  {
		  return FALSE;
	  }
  }


  function getNotes($id)
  {
	  $this->db->order_by('updated_at', 'DESC');
	  $this->db->where('port_id ',$id);
	  $this->db->where('user_id ',$this->session->userdata('d168_id'));
	  $query = $this->db->get('notes');
	  return $query->result();
  }
  function getNotesById($id)
  {
	  $this->db->where('id ',$id);
	  $query = $this->db->get('notes');
	  return $query->result();
  }

  function update_note($data,$id)
  {
	  $this->db->where('id',$id);
	  if($this->db->update('notes',$data))
	  {
		  return TRUE;
	  }
	  else
	  {
		  return FALSE;
	  }
  }


  function deleteNote($id)
  {
	  $this->db->where('id',$id);
	  if($this->db->delete('notes'))
	  {
		  return TRUE;
	  }
	  else
	  {
		  return FALSE;
	  }
  }

// Notes work end

}
/* End of file Front_model.php */
/* Location: ./application/helpers/Front_model.php */
?>