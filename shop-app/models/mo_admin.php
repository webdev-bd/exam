<?php Class Mo_admin extends CI_Model
{
    private function getLoginID(){
        $user=$this->session->userdata('back_session_admin');
	return $user->id;        
    }    
   
    
//  Administrator Login
    public function login($username, $password){
            $this->db->select('id, name, status');
            $this->db->from('users');
            $this->db->where('user_id', $username);
            $this->db->where('user_password', $password);
            $this->db->where('status >', 0);
            $query=$this->db->get();
            if($query->num_rows()==1){return $query->row();}else{return false;}
    }    

// ----------    Question     ----------------    
    
  public function save_question($data) {
      foreach ($data as $key=>$value){
            $this->db->set($key , $value);
      }
      if(empty($data['id'])){
        $this->db->set('user_id', $this->getLoginID());
        $this->db->set('create_date',  'CURDATE()', false);
        $this->db->insert('questions');
        $msg['message'] = "Question successfully Added.";
        $this->session->set_userdata($msg);
        return $this->db->insert_id();
      }else {
        $this->db->where('id', $data['id']);
        $this->db->update('questions');
        $msg['message'] = "Question successfully Update.";
        $this->session->set_userdata($msg);
         return $data['id'];
      }
    }
    
    
    public function getQuestion(){
        $this->db->select('*');
        $this->db->from('questions');
        $this->db->where('user_id', $this->getLoginID());
        $this->db->order_by('id', 'DESC');
        $query_result = $this->db->get();
        return $query_result->result();
    }    
    public function getSingleQuestion($id){
        $this->db->select('*');
        $this->db->from('questions');
        $this->db->where('id', $id);
        $query_result = $this->db->get();
        return $query_result->row();
    }    
    
// ----------    Answer     ----------------    
    
  public function save_answer($data, $id) {
      foreach ($data as $value){
        $status = (isset($value['right']) &&  $value['right']=='on') ? 1 : 0;
        $this->db->set('answer' , $value['title']);
        $this->db->set('question_id', $id);
        $this->db->set('status', $status);
        if(isset($value['id'])){
            $this->db->where('id', $value['id']);
            $this->db->update('answers');
        }else{
            $this->db->insert('answers');
        }
      }
        $msg['message'] = "Answers successfully update.";
        $this->session->set_userdata($msg);
    }
  public function delate_answer($id) {
        $this->db->where('id', $id);
        $this->db->delete('answers');
    }
    
    public function getAnswers($id){
        $this->db->select('*');
        $this->db->from('answers');
        $this->db->where('question_id', $id);
        $this->db->order_by('id', 'ASC');
        $query_result = $this->db->get();
        return $query_result->result();
    }   
    
    
// ----------    Question     ----------------    
    
  public function save_category($data) {
        $this->db->set('name' , $data['name']);
      if(empty($data['id'])){
        $this->db->insert('categorys');
        $msg['message'] = "Category successfully Added.";
      }else {
        $this->db->where('id', $data['id']);
        $this->db->update('categorys');
        $msg['message'] = "Category successfully Update.";
      }
        $this->session->set_userdata($msg);
    }
        
    public function getCategorys(){
        $this->db->select('*');
        $this->db->from('categorys');
        $this->db->where('parent_id !=', 0);
        $query_result = $this->db->get();
        return $query_result->result();
    }   
    
    
    
    public function checkAmount($amount){
            $this->db->select('balance');
            $this->db->from('client');
            $this->db->where('id', $this->getLoginID());
            $query=$this->db->get();
            $row=$query->row();
            $subAmount=$row->balance-$amount;
            if ($subAmount>0) {
                $this->takeBalance($subAmount);
                return TRUE;
            }
            return FALSE;
    }   
    public function checkNumber($number){
        $operator_name = $this->operator($number);
        if ($operator_name!=FALSE) {
            $this->db->select($operator_name);
            $this->db->from('flexiload_active');
            $this->db->where('id', 1);
            $query = $this->db->get();
            $row = $query->row();
            return $row->$operator_name;
        }
        return FALSE;
    }   
    
    private function takeBalance ($amount, $id=NULL){
        $id=($id===NULL) ? $this->getLoginID() : $id;
        $this->db->set('balance', $amount);
        $this->db->where('id', $id);
        $this->db->update('client');
    }
    private function sendBalance ($amount, $id){
        $this->db->select('balance');
        $this->db->from('client');
        $this->db->where('loginname', $id);
        $query=$this->db->get();
        $row=$query->row();
        $newAmount=$row->balance+$amount;    
        
        
        $this->db->set('balance', $newAmount);
        $this->db->where('loginname', $id);
        $this->db->update('client');
        
        return $newAmount;
    }
 
    
}// mo_admin