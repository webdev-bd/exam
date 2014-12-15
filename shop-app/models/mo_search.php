<?php Class Mo_search extends CI_Model
{
// Account
	public function get_account($id)
	{
		$this->db->select('*');		
		$this->db->from('account');
		$this->db->where('account_user_id', $id);
		$this->db->join('user_info', 'user_info.userinfo_user_id=account.account_user_id', 'left');
 		$query_result=$this->db->get();
		return $query_result->row();
 	}
// Transection
	public function get_transection($id)
	{
		$this->db->select('*');		
		$this->db->from('all_transaetion');
		$this->db->where('transaetion_user_id', $id);
		$this->db->order_by('transaetion_id', 'DESC');
		$this->db->limit(10);
 		$query_result=$this->db->get();
		return $query_result->result();
	}
// Network
	public function get_network($id)
	{
		$this->db->select('account.*, user_info.userinfo_name, user_info.userinfo_date, user_info.userinfo_photo,');		
		$this->db->from('account');
		$this->db->join('user_info', 'user_info.userinfo_user_id=account.account_user_id', 'left');
		$this->db->where('account_upline', $id);
 		$query_result=$this->db->get();
		return $query_result->result();
	}	
// Network
	public function get_sms($id)
	{
		$this->db->select('*');		
		$this->db->from('all_sms');
 		$this->db->where('sms_sender', $id);
		$this->db->order_by('sms_id', 'DESC');
 		$this->db->limit(15);
 		$query_result=$this->db->get();
		return $query_result->result();
	}	
}?>