<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	function demo()
	{
		$ci=& get_instance();
		$ci->load->database();
		$ci->db->from('admin');
		$query=$ci->db->get();
		return $query->num_rows();
	}
/* End of file Front_model.php */
/* Location: ./application/models/Front_model.php */
?>