<?php Class Mo_account extends CI_Model
{
// Default Functions
	public function get_login_id()
	{
		$user=$this->session->userdata('back_session');
		return $user['id'];
  	}	
// Login 	
	public function login($username, $password)
	{
		$this->db->select('userinfo_user_id, userinfo_name');
		$this->db->from('user_info');
		$this->db->where('userinfo_user_id', $username);
		$this->db->where('userinfo_pass', $password);
 		$this->db->where('userinfo_status > 0');
 		$query=$this->db->get();
		if($query->num_rows()==1){return $query->row();}else{return false;}
	}
// Profile
 	public function get_profile()
	{
		$this->db->select('*');		
		$this->db->from('user_info');
		$this->db->where('userinfo_user_id', $this->get_login_id());
 		$query_result=$this->db->get();
		return $query_result->row();
	}
 	public function update_profile($user)
	{
		$this->db->set('userinfo_name', $user['name']);		
		$this->db->set('userinfo_email', $user['email']);		
		$this->db->set('userinfo_national_id', $user['national_id']);		
		$this->db->set('userinfo_address', $user['address']);		
		$this->db->where('userinfo_user_id', $this->get_login_id());
		$this->db->update('user_info');
 	}
	public function profile_picture_save($data)
	{
        $this->db->set('userinfo_photo',$data['photo']);
        $this->db->where('userinfo_user_id', $this->get_login_id());
        $this->db->update('user_info');
	}	
	public function profile_chang_pass_save($data)
	{
         $this->db->set('userinfo_pass',$data['new_pass']);
        $this->db->where('userinfo_user_id', $this->get_login_id());
        $this->db->update('user_info');
	}  
 	public function check_old_pass($pass)
	{
		$this->db->select('userinfo_id');		
		$this->db->from('user_info');
		$this->db->where('userinfo_user_id', $this->get_login_id());
		$this->db->where('userinfo_pass', $pass);
 		$query_result=$this->db->get();
		if($query_result->num_rows()==1){return TRUE;}else{return false;}
	}
// Account
	public function get_account()
	{
		$this->db->select('*');		
		$this->db->from('account');
		$this->db->where('account_user_id', $this->get_login_id());
 		$query_result=$this->db->get();
		return $query_result->row();
	}

// Transection
	public function get_transection()
	{
		$this->db->select('*');		
		$this->db->from('all_transaetion');
		$this->db->where('transaetion_user_id', $this->get_login_id());
		$this->db->order_by('transaetion_id', 'DESC');
		$this->db->limit(20);
 		$query_result=$this->db->get();
		return $query_result->result();
	}

// Network
	public function get_network()
	{
		$network=array();
		$this->db->select('account.*, user_info.userinfo_name, user_info.userinfo_date, user_info.userinfo_photo');		
		$this->db->from('account');
		$this->db->join('user_info', 'user_info.userinfo_user_id=account.account_user_id', 'left');
		$this->db->where('account_upline', $this->get_login_id());
 		$query_result=$this->db->get();
		$level_01=$query_result->result();
		$network['level01']=$level_01;
		
		$level_02=array();$i=0;
		foreach($level_01 as $item)
		{
			$this->db->select('account.*, user_info.userinfo_name, user_info.userinfo_date, user_info.userinfo_photo');		
			$this->db->from('account');
			$this->db->join('user_info', 'user_info.userinfo_user_id=account.account_user_id', 'left');
			$this->db->where('account_upline', $item->account_user_id);
			$query_result=$this->db->get();
 			$level_02[$i]=$query_result->result();
			$i++;
		}
		$network['level02']=$level_02;
		
		$level_03=array();$i=0;
  		foreach ($network['level02'] as $net_item)
		{
 			if(!empty($net_item))
			{   
				foreach($net_item as $level_02_item)
				{
					$this->db->select('account.*, user_info.userinfo_name, user_info.userinfo_date, user_info.userinfo_photo');		
					$this->db->from('account');
					$this->db->join('user_info', 'user_info.userinfo_user_id=account.account_user_id', 'left');
					$this->db->where('account_upline', $level_02_item->account_user_id);
					$query_result=$this->db->get();
					$level_03[$i]=$query_result->result();
					$i++;
				}
			}
 		}
		$network['level03']=$level_03;
		
		$level_04=array();$i=0;
  		foreach ($network['level03'] as $net_item)
		{
 			if(!empty($net_item))
			{   
				foreach($net_item as $level_03_item)
				{
					$this->db->select('account.*, user_info.userinfo_name, user_info.userinfo_date, user_info.userinfo_photo');		
					$this->db->from('account');
					$this->db->join('user_info', 'user_info.userinfo_user_id=account.account_user_id', 'left');
					$this->db->where('account_upline', $level_03_item->account_user_id);
					$query_result=$this->db->get();
					$level_04[$i]=$query_result->result();
					$i++;
				}
			}
 		}
		$network['level04']=$level_04;
 		return $network;
	}
	public function get_account_net_single($id)
	{
		$this->db->select('*');		
		$this->db->from('account');
		$this->db->where('account_user_id', $id);
 		$query_result=$this->db->get();
		return $query_result->row();
	}
	public function get_network_net_single($id)
	{
		$this->db->select('account.*, user_info.userinfo_name, user_info.userinfo_date, user_info.userinfo_photo,');		
		$this->db->from('account');
		$this->db->join('user_info', 'user_info.userinfo_user_id=account.account_user_id', 'left');
		$this->db->where('account_upline', $id);
 		$query_result=$this->db->get();
		return $query_result->result();
	}
	
// Agent
	public function add_agent($id)
	{
        $this->db->set('account_agent', 1);
        $this->db->where('account_user_id', $id);
        $this->db->update('account');
	}	
	public function cancel_agent($id)
	{
        $this->db->set('account_agent', 0);
        $this->db->where('account_user_id', $id);
        $this->db->update('account');
	}	
	public function get_all_agents()
	{
		$this->db->select('*');		
		$this->db->from('account');
		$this->db->where('account_agent', 1);
		$this->db->join('user_info', 'user_info.userinfo_user_id=account.account_user_id', 'left');
		$this->db->order_by('account_id', ' DESC');
 		$query_result=$this->db->get();
		return $query_result->result();
	}
	public function get_all_agent_down($id)
	{
		$this->db->select('*');		
		$this->db->from('account');
		$this->db->where('account_agent_id', $id);
		$this->db->join('user_info', 'user_info.userinfo_user_id=account.account_user_id', 'left');
		$this->db->order_by('account_id', ' DESC');
 		$query_result=$this->db->get();
		return $query_result->result();
	}
	public function new_user_agent()
	{
		$this->db->select('*');		
		$this->db->from('user_info');
		$this->db->where('userinfo_status', 2);
		$this->db->join('account', 'user_info.userinfo_user_id=account.account_user_id', 'left');
		$this->db->order_by('userinfo_id', 'DESC');
 		$query_result=$this->db->get();
		return $query_result->result();
	}	
	public function addtolocal($id)
	{
        $this->db->set('userinfo_status', 1);
        $this->db->where('userinfo_user_id', $id);
        $this->db->update('user_info');
	}	
	
// Change User 	ID
 	public function change_account_id_save($data)
	{
		// update on Account
        $this->db->set('account_user_id', $data['new_id']);
        $this->db->where('account_user_id', $data['current_id']);
        $this->db->update('account');
		
        $this->db->set('account_upline', $data['new_id']);
        $this->db->where('account_upline', $data['current_id']);
        $this->db->update('account');
		
		// update on All Transaetion
        $this->db->set('transaetion_user_id', $data['new_id']);
        $this->db->where('transaetion_user_id', $data['current_id']);
        $this->db->update('all_transaetion');
  		
		// update on  RB Number
        $this->db->set('rb_buy', $data['new_id']);
        $this->db->where('rb_buy', $data['current_id']);
        $this->db->update('rb_number');
  		
		// update on  RB Number
        $this->db->set('userinfo_user_id', $data['new_id']);
        $this->db->where('userinfo_user_id', $data['current_id']);
        $this->db->update('user_info');
	}
	
 	public function change_account_pin_save($data)
	{
		// update on Account
        $this->db->set('account_pin', $data['new_pin']);
        $this->db->where('account_user_id', $data['current_id']);
        $this->db->update('account');
	}
	
// Withdraw
	public function get_pending_withdraw_bkash()
	{
		$this->db->select('*');		
		$this->db->from('withdraw');
		$this->db->where('wd_transection_type', 1);
		$this->db->where('wd_status', 0);
  		$query_result=$this->db->get();
		return $query_result->result();
	}
	public function get_pending_withdraw_dbbl()
	{
		$this->db->select('*');		
		$this->db->from('withdraw');
		$this->db->where('wd_transection_type', 2);
		$this->db->where('wd_status', 0);
  		$query_result=$this->db->get();
		return $query_result->result();
	}
	public function withdraw_process($id)
	{
		$this->db->set('wd_status', 1);		
		$this->db->where('wd_id', $id);
		$this->db->update('withdraw');
 	}
// Save contact us Massage 	
	public function save_contact_massage($data)
	{
		$this->db->set('contact_us_date', 'CURDATE()', false);
		$this->db->insert('contact_us', $data);
	}
	public function get_contact_massages()
	{
		$this->db->select('*');		
		$this->db->from('contact_us');
		$this->db->order_by('contact_us_id', 'DESC');
   		$query_result=$this->db->get();
		return $query_result->result();
	}
	public function delete_contact_massage($id)
	{
		$this->db->where('contact_us_id', $id);
		$this->db->delete('contact_us');
 	}
	
// ******   ADMIN Massage     ******	
	public function save_admin_massage($massage)
	{
        $this->db->set('ao_value', $massage);
		$this->db->where('ao_key', 'admin_massage');
        $this->db->update('admin_option');
 	}
	public function get_admin_massage()
	{
		$this->db->select('ao_value');
 		$this->db->from('admin_option');
        $this->db->where('ao_key', 'admin_massage');	
 		$query_result=$this->db->get();
		$row=$query_result->row();
		return $row->ao_value;
 	}
	
// ******   Notices     ******	
	public function get_notices()
	{
		$this->db->select('*');
 		$this->db->from('notice');
        $this->db->order_by('notice_id', 'DESC');	
 		$query_result=$this->db->get();
		return $query_result->result();
 	}
// ******   Pages     ******	
	public function get_page($id)
	{
		$this->db->select('*');
 		$this->db->from('pages');
        $this->db->where('page_id', $id);	
 		$query_result=$this->db->get();
		return $query_result->row();
 	}
	public function update_contect_page($content)
	{
  		$this->db->set('page_content', $content);
        $this->db->where('page_id', 1);	
        $this->db->update('pages');	
  	}
	
	public function change_check_forget_pass($id, $user_pin)
	{
  		$this->db->from('account');
        $this->db->where('account_pin', $user_pin);	
        $this->db->where('account_user_id', $id);	
 		
		if($this->db->count_all_results()==1){
		
		$str_pass=rand(99999,11111);
        $this->db->set('userinfo_pass',  MD5($str_pass));
        $this->db->where('userinfo_user_id', $id);
        $this->db->update('user_info');
		
		 				
		$massage="Your New Password $str_pass";
 		
		$this->db->select('account_balance');
		$this->db->from('account');
		$this->db->where('account_user_id', $id);
		$query_result=$this->db->get();
		$balance=$query_result->row();
		$balance=$balance->account_balance;		
		if($balance>0)
		{
			$update_balance_recive=$balance-1;
 			$this->db->set('account_balance', $update_balance_recive);
			$this->db->where('account_user_id', $id);
			$this->db->update('account');
			
			$transection=array();
			$transection['transaetion_user_id']=$id;
			$transection['transaetion_amount']=1;
			$transection['transaetion_type']=1;
			$transection['transaetion_balance']=$update_balance_recive;
			$transection['transaetion_description']='SMS Charge';
			$this->db->set('transaetion_date', 'CURDATE()', false);
			$this->db->insert('all_transaetion', $transection);		
			
			$massage.=" Your Current Balance: $update_balance_recive";
			
			$url = "http://cmp.robi.com.bd//WS/CMPWebService.asmx/SendTextMessage?";
			$post_data ="Username=stmartin&Password=ikbal!cmp&From=8801833148665&To=$id&Message=$massage";
			$ch = curl_init();curl_setopt($ch, CURLOPT_URL, "$url");curl_setopt($ch, CURLOPT_HEADER, 0);curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);	$result = curl_exec($ch);curl_close($ch);
			
			// *** UPdate SMS Count ***
			$this->db->set('account_balance', 'account_balance+1',  FALSE);
			$this->db->where('account_user_id', '01999999003');
			$this->db->update('account');
		}
		
		


 		return true;		
		}else { return false;}
		
	}  
	
	
}?>