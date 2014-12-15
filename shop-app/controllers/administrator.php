<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrator extends CI_Controller {

    public function index() {
        $this->login();
    }
    function __construct()
    {
        parent::__construct();
        $this->load->model('mo_admin');
    }

    private function setup_admin() {
        
        if (!$this->session->userdata('back_session_admin')) {
            redirect('administrator', 'refresh');
        }
        
        $session = $this->session->userdata('back_session_admin');
        if ($session->au_status != 9) {
            $this->logout();
        }

        $data = array();
        $data['header'] = $this->load->view('back/include/head', $data, TRUE);
        $data['main_menu'] = $this->load->view('back/include/main_menu', $data, TRUE);
        $data['message'] = $this->load->view('back/include/message', $data, TRUE);
        $data['footer'] = $this->load->view('back/include/footer', $data, TRUE);
        return $data;
    }

    private function setup($data=array()) {
         date_default_timezone_set('America/Los_Angeles');
                checkdate(2,29,2004);
            die;
            
        if (!$this->session->userdata('back_session_admin')) {
            redirect('administrator', 'refresh');
        }
        $data['header'] = $this->load->view('back/include/head', $data, TRUE);
        $data['main_menu'] = $this->load->view('back/include/main_menu', $data, TRUE);
        $data['message'] = $this->load->view('back/include/message', $data, TRUE);
        $data['footer'] = $this->load->view('back/include/footer', $data, TRUE);
        return $data;
    }

    public function login() {
         
        if ($this->session->userdata('back_session_admin')) {
            redirect('administrator/dashboard', 'refresh');
        }
        $data = array();
        $data['header'] = $this->load->view('back/include/head', $data, TRUE);
        $data['page'] = $this->load->view('back/login', $data, TRUE);
        $this->load->view('container', $data);
    }

    public function logout() {
        $this->session->unset_userdata('back_session_admin');
        redirect('administrator', 'refresh');
    }

    public function login_check() {
        $this->form_validation->set_rules('id', 'Userid', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|MD5|callback_check_database');
        $this->form_validation->set_error_delimiters('<div class="alert alert-info"><button class="close" data-dismiss="alert"> × </button><i class="fa-fw fa fa-info"></i>', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->login();
        } else {
            redirect('administrator/dashboard', 'refresh');
        }
    }

    public function check_database($password) {
        $username = $this->input->post('id');
        $this->load->model('mo_admin');
        $result = $this->mo_admin->login($username, $password);
        if ($result) {
            $this->session->set_userdata('back_session_admin', $result);
            return TRUE;
        } else {
            $this->form_validation->set_message('check_database', 'Invalid Login');
            return false;
        }
    }

//**************   Dashboard *************************
    public function dashboard() {
        $data = $this->setup(array('title'=>'Admin Dashboard'));
        $data['page'] = $this->load->view('back/deshboard', $data, TRUE);
        $this->load->view('container', $data);
    }

//**************   Queston  *************************
    public function new_question() {
        $data = $this->setup(array('title' => 'New Queston'));
        $data['categorys'] = $this->mo_admin->getCategorys();
        $data['page'] = $this->load->view('back/queston/new', $data, TRUE);
        $this->load->view('container', $data);
    }
    public function save_question(){
            $this->form_validation->set_rules('queston[title]', 'Title', 'trim|required|xss_clean');
            //$this->form_validation->set_rules('queston[question]', 'Question', 'trim|required|xss_clean');
            $this->form_validation->set_error_delimiters('<div class="alert alert-info"><button class="close" data-dismiss="alert"> × </button><i class="fa-fw fa fa-info"></i>', '</div>');
            if ($this->form_validation->run() == TRUE) {
                $id = $this->mo_admin->save_question($this->input->post('queston'));
                redirect("administrator/answers/{$id}");
            }else{
                
                $this->save_question();
            }
    }
    public function update_question(){
            $this->form_validation->set_rules('queston[title]', 'Title', 'trim|required|xss_clean');
            //$this->form_validation->set_rules('queston[question]', 'Question', 'trim|required|xss_clean');
            $this->form_validation->set_error_delimiters('<div class="alert alert-info"><button class="close" data-dismiss="alert"> × </button><i class="fa-fw fa fa-info"></i>', '</div>');
            if ($this->form_validation->run() == TRUE) {
                $id = $this->mo_admin->save_question($this->input->post('queston'));
                redirect("administrator/single_question/{$id}");
            }else{
                
                $this->update_question();
            }
    }
    
    public function view_question() {
        $data = $this->setup(array('title' => 'View Queston'));
        $data['questions'] = $this->mo_admin->getQuestion();
        $data['page'] = $this->load->view('back/queston/view', $data, TRUE);
        $this->load->view('container', $data);
    }
    public function edit_question($id) {
        $data = $this->setup(array('title' => 'Edit Queston'));
        $data['categorys'] = $this->mo_admin->getCategorys();
        $data['question'] = $this->mo_admin->getSingleQuestion($id);
        $data['page'] = $this->load->view('back/queston/edit', $data, TRUE);
        $this->load->view('container', $data);
    }
    public function single_question($id) {
        $data = $this->setup(array('title' => 'Single Queston'));
        $data['question'] = $this->mo_admin->getSingleQuestion($id);
        $data['answers'] = $this->mo_admin->getAnswers($id);
        $data['page'] = $this->load->view('back/queston/single', $data, TRUE);
        $this->load->view('container', $data);
    }
    

//**************   Answer  *************************    
    
    public function answers($id=NULL) {
        if(!empty($id)){
            $data = $this->setup(array('title' => 'Answers'));
            $data['question'] = $this->mo_admin->getSingleQuestion($id);
            $data['answers'] = $this->mo_admin->getAnswers($id);
            $data['page'] = $this->load->view('back/answer/new', $data, TRUE);
            $this->load->view('container', $data);
        }else{
            $this->new_question();
        }
    }
    public function save_answer(){
        $this->mo_admin->save_answer($this->input->post('queston'), $this->input->post('que_id'));
        redirect("administrator/answers/{$this->input->post('que_id')}");
    }
    public function delate_answer(){
        $this->mo_admin->delate_answer($this->input->post('id'));
    }
    

//**************   Category  *************************
    
    public function category() {
        $data = $this->setup(array('title' => 'Category'));
        $data['categorys'] = $this->mo_admin->getCategorys();
        $data['page'] = $this->load->view('back/category', $data, TRUE);
        $this->load->view('container', $data);
    }
    public function save_category(){
            $this->form_validation->set_rules('category[name]', 'Title', 'trim|required|xss_clean|is_unique[categorys.name]');
            $this->form_validation->set_rules('category[parent]', 'Question', 'trim|required|xss_clean');
            $this->form_validation->set_error_delimiters('<div class="alert alert-info"><button class="close" data-dismiss="alert"> × </button><i class="fa-fw fa fa-info"></i>', '</div>');
            if ($this->form_validation->run() == TRUE) {
                $this->mo_admin->save_category($this->input->post('category'));
                redirect("administrator/category/");
            }else{
                $this->category();
            }
    }
    
    /*
     *  Checking Number 
     *  Checking Operator Service (off/on)
     */
    public function check_number($number) {
        if (strlen($number) != 11 && is_numeric($number)) {
            $this->form_validation->set_message('check_number', 'Invalid Number');
            return false;
        }
        if ($this->mo_admin->checkNumber($number)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_number', 'Sorry! Servie off. Please try later');
            return false;
        }
    }    
    
    /*
     *  Checking amount 
     *  Checking User Balence 
     *  Take amount form user Balance
     */
    
    public function check_amount($amount) {
        if ($amount>9 && $this->mo_admin->checkAmount($amount)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_amount', 'Invalid Amount');
            return false;
        }
    }
    

//**************   History  *************************
    public function history() {
        $Search=$this->input->get('search');
        $data = $this->setup(array('title' => 'History'));
        $data['History'] = $this->mo_admin->getRechargeHistory($Search);
        $data['Summery'] = $this->mo_admin->getSummeryByHistory($data['History']);
        $data['page'] = $this->load->view('back/history/history', $data, TRUE);
        $this->load->view('container', $data);
    }
     public function changeStatus() {
        $id = $this->input->post('id');
        $type = $this->input->post('type');
        $this->mo_admin->changeStatus($id, $type);
        if ($type == 'f') {
            echo $_html = "<td class='statusChange'><b class='label label-danger'>Failed</b></td>";
        } else {
            echo $_html = "<td class='statusChange'><b class='label label-success'>Success</b></td>";
        }
    }

//**************   Register  *************************
    public function register() {
        $data = $this->setup(array('title' => 'Registration'));
        $data['page'] = $this->load->view('back/reseller/register', $data, TRUE);
        $this->load->view('container', $data);
    }
    public function save_register(){
            $this->form_validation->set_rules('register[number]', 'Number', 'trim|required|xss_clean|callback_check_number_register');
            $this->form_validation->set_error_delimiters('<div class="alert alert-info"><button class="close" data-dismiss="alert"> × </button><i class="fa-fw fa fa-info"></i>', '</div>');
            if ($this->form_validation->run() == TRUE) {
                $this->mo_admin->save_register($this->input->post('register'));
                redirect('administrator/register');
            }else{
                $this->register();
            }
    }
    
/*
 *  Checking Number 
 *  Checking Operator Service (off/on)
 */
    
    public function check_number_register($number) {
        if ((strlen($number) != 11) && is_numeric($number)) {
            $this->form_validation->set_message('check_number_register', 'Invalid Number');
            return false;
        }
        if (!$this->mo_admin->check_number_register($number)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_number_register', 'Sorry! Number already registered.');
            return false;
        }
    } 
    public function check_number_register_update($number) {
        if ((strlen($number) != 11) && is_numeric($number)) {
            $this->form_validation->set_message('check_number_register_update', 'Invalid Number');
            return false;
        }
        if ($this->mo_admin->check_number_register_update($number, $this->input->post('id'))) {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_number_register_update', 'Sorry! Number already registered.');
            return false;
        }
    } 
    public function register_edit($id) {
        $data = $this->setup(array('title' => 'Edit Reseller'));
        $data['Reseller'] = $this->mo_admin->getReseller_id($id);
        $data['page'] = $this->load->view('back/reseller/edit', $data, TRUE);
        $this->load->view('container', $data);
    }
    public function register_update(){
        $update_id=  $this->input->post('id');
        $this->form_validation->set_rules('register[number]', 'Number', 'trim|required|xss_clean|callback_check_number_register_update');
        $this->form_validation->set_error_delimiters('<div class="alert alert-info"><button class="close" data-dismiss="alert"> × </button><i class="fa-fw fa fa-info"></i>', '</div>');
        if ($this->form_validation->run() == TRUE) {
            $this->mo_admin->update_register($this->input->post('register'), $update_id);
            redirect('administrator/register_edit/'.$update_id);
        }else{
            $this->register_edit($update_id);
        }
    }
    

//**************   Reseller  *************************
    public function reseller() {
        $Search=$this->input->get('search');
        $data = $this->setup(array('title' => 'Resellers'));
        $data['Resellers'] = $this->mo_admin->getResellers($Search);
        $data['page'] = $this->load->view('back/reseller/view', $data, TRUE);
        $this->load->view('container', $data);
    }    
//**************   Payment  *************************
    public function send_payment() {
        $data = $this->setup(array('title' => 'Send Payment'));
        $data['users'] = $this->mo_admin->getUsersList();
        $data['Last10Payment'] = $this->mo_admin->getLast10Payment();
        $data['page'] = $this->load->view('back/payment/new', $data, TRUE);
        $this->load->view('container', $data);
    }
    public function save_payment(){
            $this->form_validation->set_rules('payment[number]', 'Number', 'trim|required|xss_clean|callback_check_number_payment');
            $this->form_validation->set_rules('payment[amount]', 'Amount', 'trim|required|xss_clean|callback_check_amount');

            $this->form_validation->set_error_delimiters('<div class="alert alert-info"><button class="close" data-dismiss="alert"> × </button><i class="fa-fw fa fa-info"></i>', '</div>');
            if ($this->form_validation->run() == TRUE) {
                $this->mo_admin->save_payment($this->input->post('payment'));
                redirect('administrator/send_payment');
            }else{
                $this->send_payment();
            }
    }
    public function view_payment(){
        $data = $this->setup(array('title' => 'View Payments'));
        $data['Payments'] = $this->mo_admin->getPayments();
        $data['page'] = $this->load->view('back/payment/view', $data, TRUE);
        $this->load->view('container', $data);
    }
    public function check_number_payment($number) {
        if (strlen($number) != 11 && is_numeric($number)) {
            $this->form_validation->set_message('check_number_payment', 'Invalid Number');
            return false;
        }
        if ($this->mo_admin->check_number_register($number)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_number_payment', 'Invalid Number');
            return false;
        }
    }   
    
   
    
    
}
// End of Adminstrator
