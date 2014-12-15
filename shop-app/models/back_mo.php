<?php Class Back_mo extends CI_Model
{
# SMS Bulk	
	public function send_bulk($to, $massage)
	{
 		$url = "http://cmp.robi.com.bd//WS/CMPWebService.asmx/SendTextMessage?";
		$post_data ="Username=stmartin&Password=ikbal!cmp&From=8801833148665&To=$to&Message=$massage";
		$ch = curl_init();curl_setopt($ch, CURLOPT_URL, "$url");curl_setopt($ch, CURLOPT_HEADER, 0);curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);	$result = curl_exec($ch);curl_close($ch);
 	}		
	
 // New register 	
	public function check_upline($id)
	{
		$this->db->select('account_total_sponsor, account_sponsor_leavl');				
		$this->db->where('account_user_id', $id);
		$this->db->from('account');
		$query_result=$this->db->get();		
		if($query_result->num_rows()==1)
		{
			return true;
/*			$row=$query_result->row();
			if($row->account_total_sponsor==$row->account_sponsor_leavl){return false;}else {return true;}			
*/		}else {return false;}
	}	
	public function check_agent($id)
	{
		$this->db->select('account_agent');				
		$this->db->where('account_user_id', $id);
		$this->db->from('account');
		$query_result=$this->db->get();		
		if($query_result->num_rows()==1)
		{
			return true;
			//$row=$query_result->row();
			//if($row->account_agent==1){return true;}else {return false;}			
		}else {return false;}
	}	
	public function check_rb_number($code)
	{
		$this->db->select('rb_amount');		
		$this->db->from('rb_number');
 		$this->db->where('rb_code', $code);
 		$this->db->where('rb_status', 0);
 		$query_result = $this->db->get();		
		if($query_result->num_rows()==1)
		{
			$row=$query_result->row();
			return $row->rb_amount;
		}else 
		{ return false;}
		
	}	
	public function save_new_user($user, $rb)
	{
		$amount=$this->check_rb_number($rb)-1500;
		$this->sold_rbnumber($user['account_user_id'], $rb);		
        $this->db->set('account_balance', $amount);
        $this->db->set('account_status', 1);
        $this->db->insert('account',$user);				
		$this->sponsor_bill($user['account_upline'], $user['account_user_id']);
		
		// SMS
		$massage='Welcome, You are successfully join at MRP. Upline '.$user['account_upline'].' Agent '.$user['account_agent_id'].' PIN '.$user['account_pin'].' Account Balance 0.00';
		$this->send_bulk($user['account_user_id'], $massage);
		
	}
	private function sold_rbnumber($user, $rb)
	{
        $this->db->set('rb_buy', $user);
        $this->db->set('rb_status', 1);
        $this->db->where('rb_code', $rb);
        $this->db->update('rb_number');
	}

//---------------MRP100 Sponsor Bill Update.... -----------------
	public function sponsor_bill($account_upline, $new_user)
	{
		$this->give_company_comison(500);
		$sql='';
		for($i=1;$i<=4;$i++)
		{
			$lavel_bill=$this->level_bill($i);
			
			//if($i==1){$this->update_total_sponsor($account_upline);}
			
			$this->db->select('*');		
			$this->db->from('account');
 			$this->db->where('account_user_id', $account_upline);
			$query_result = $this->db->get();
			$uplini_user=$query_result->row();
			
			$update_balance=$uplini_user->account_balance+$lavel_bill;
			$this->give_level_bill($account_upline, $update_balance);
			
			$sql.="(NULL, '".$account_upline."', ".$lavel_bill.", 1, ".$update_balance.", CURDATE(), '".$i." Level Bill of ".$new_user."'),";
			
			if($uplini_user->account_upline!=0)
			{
				$account_upline=$uplini_user->account_upline;		
			}else{
 				$this->give_level_bill_to_admin($i);	
				break;
			}
  		}
		if($sql!='')
		{
			$sql=substr($sql, 0, -1);
			$sql.=';';
			$sql='INSERT INTO `all_transaetion` (`transaetion_id`, `transaetion_user_id`, `transaetion_amount`, `transaetion_type`, `transaetion_balance`, `transaetion_date`, `transaetion_description`) VALUES  '.$sql;
			$this->db->query($sql);		
		}
	}	
	private function give_level_bill_to_admin($level)
	{
 		$bill=0;
		for($j=$level+1;$j<=4;$j++)
		{
			$bill+=$this->level_bill($j);
 		}
		$this->give_company_upline($bill);
		
	}
	private function give_level_bill($id, $amount)
	{
        $this->db->set('account_balance', $amount);
        $this->db->where('account_user_id', $id);
        $this->db->update('account');
	}
	private function give_company_upline($comison)
	{
        $this->db->set('account_balance', 'account_balance+'.$comison, FALSE);
        $this->db->where('account_user_id', '01999999002');
        $this->db->update('account');
	}
	private function give_company_comison($comison)
	{
        $this->db->set('account_balance', 'account_balance+'.$comison, FALSE);
        $this->db->where('account_user_id', '01999999001');
        $this->db->update('account');
	}
	private function update_total_sponsor($id)// Not using now
	{
        $this->db->set('account_total_sponsor', 'account_total_sponsor+1', FALSE);
        $this->db->where('account_user_id', $id);
        $this->db->update('account');

		$this->db->select('account_total_sponsor, account_upline');		
		$this->db->from('account');
        $this->db->where('account_user_id', $id);
 		$query_result = $this->db->get();
		$row=$query_result->row();
		
		if($row->account_total_sponsor==5)
		{
			$this->db->set('account_sponsor_leavl', 'account_sponsor_leavl+2', FALSE);
			$this->db->where('account_user_id', $row->account_upline);
			$this->db->update('account');
		}
	}
	private function level_bill($level)
	{
		switch ($level)
		{
		case 1:
 			return 500;
		break;
		case 2:
 			return 250;
		break;
		case 3:
 			return 150;
		break;
		case 4:
 			return 100;
		break;
   		}
	}
//---------------END MRP100 Sponsor Bill Update.... -----------------

// account
 
	public function get_all_account()
	{
		$this->db->select('*');		
		$this->db->from('account');
 		$query_result = $this->db->get();
		return $query_result->result();
	}
	public function get_all_transaetion()
	{
		$this->db->select('*');		
		$this->db->from('all_transaetion');
 		$query_result = $this->db->get();
		return $query_result->result();
	}
 	public function make_code()
	{

		$this->load->helper('string');
		for($i=0;$i<100;$i++):
		$code=random_string('numeric', 16);				
        $this->db->set('rb_code', $code);		
        $this->db->set('rb_amount', 1500);
        $this->db->set('rb_date', 'CURDATE()', false);
        $this->db->insert('rb_number');
		endfor;
 	}
// Create user Online
	public function save_new_user_online($data)
	{
        $this->db->set('userinfo_date', 'CURDATE()', false);
        $this->db->insert('user_info', $data);
 	}
// For Administrator

	public function login($username, $password)
	{
		$this->db->select('*');
		$this->db->from('admin_user');
		$this->db->where('au_userid', $username);
		$this->db->where('au_pass', $password);
		$this->db->where('au_status > 0');
 		$query=$this->db->get();
		if($query->num_rows()==1){return $query->row();}else{return false;}
	}
// Manager	
	public function get_all_administrator()
	{		
 		$this->db->select('*');
		$this->db->from('admin_user');
 		$query_result = $this->db->get();
		return $query_result->result();
	}	
 	public function update_manager_status($data)
    {
        $this->db->set('au_status', $data['status']);
         $this->db->where('au_id', $data['id']);
        $this->db->update('admin_user');
    }
    public function save_manager($data)
     {
         $this->db->insert('admin_user',$data);
     }
// *********  RB *********
 	public function get_rb_report()
	{
 		$this->db->from('rb_number');
        $this->db->where('rb_status', 0);	
		$data['unsold']=$this->db->count_all_results();	
		
 		$this->db->from('rb_number');
        $this->db->where('rb_status', 1);	
		$data['sold']=$this->db->count_all_results();	
		
 		$this->db->from('rb_number');
        $this->db->where('rb_manager', 0);	
        $this->db->where('rb_status', 0);	
		$data['bcp']=$this->db->count_all_results();	
		return $data; 	
 	}
 	public function get_rb_search($rb)
	{
		$this->db->select('rb_number.*, rb_manager.rm_name');
 		$this->db->from('rb_number');
        $this->db->where('rb_number.rb_code', $rb);	
		$this->db->join('rb_manager', 'rb_number.rb_manager=rb_manager.rm_id', 'left');
 		$query_result = $this->db->get();
		return $query_result->row();
  	}
    public function save_rb_manager($data)
     {
         $this->db->insert('rb_manager',$data);
     }
 	public function get_rb_manager()
	{
		$this->db->select('*');
 		$this->db->from('rb_manager');
  		$query_result = $this->db->get();
		return $query_result->result();
  	}
    public function save_rb_create($data)
     {
		$this->load->helper('string');
            for($i=0;$i<$data['amount']; $i++)
		  {
		
			$rb=array();
			$rb['rb_code']=$this->get_rb_code();	
			$rb['rb_amount']=1500.00;	
			$rb['rb_manager']=$data['rb_manager'];	
			$this->db->set('rb_date', 'CURDATE()', false);
			$this->db->insert('rb_number',$rb);
		  }
 			
 			
      }
	private function get_rb_code()
	{
		$code=random_string('numeric', 16);		
		$this->db->from('rb_number');
		$this->db->where('rb_code', $code);	
		if($this->db->count_all_results()==0 && strlen($code)==16)
		{
			return $code;
		}else{
			return random_string('numeric', 16);	
			}
 		
 	}
 	public function view_rb_by_manager($rb)
	{
		$this->db->select('rb_number.*, rb_manager.rm_name');
 		$this->db->from('rb_number');
        $this->db->where('rb_number.rb_manager', $rb);	
		$this->db->join('rb_manager', 'rb_number.rb_manager=rb_manager.rm_id', 'left');
 		$query_result = $this->db->get();
		return $query_result->result();
  	}
	
}?>