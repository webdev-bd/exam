<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Question extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('mo_admin');
        
    }
    
     public function practice_cat($cat=2, $id=NULL) {
        $data = $this->setup(array('title' => 'Practice'));
        $data['ids'] = $this->mo_admin->getQueIds_cat($cat);
        $id = ($id==NULL) ? $data['ids'][0]->id : $id;
        $data['question'] = $this->mo_admin->getQue_cat($cat, $id);
        $data['answers'] = $this->mo_admin->getAnswers($id);
        
        $data['page'] = $this->load->view('back/practice_cat', $data, TRUE);
        $this->load->view('container', $data);
    }

    private function setup($data=array()) {
        if (!$this->session->userdata('back_session_admin')) {
            redirect('administrator', 'refresh');
        }
        $data['header'] = $this->load->view('back/include/head', $data, TRUE);
        $data['main_menu'] = $this->load->view('back/include/main_menu', $data, TRUE);
        $data['message'] = $this->load->view('back/include/message', $data, TRUE);
        $data['footer'] = $this->load->view('back/include/footer', $data, TRUE);
        return $data;
    }
    public function practice_check() {
        $answers = $this->mo_admin->getPracticeCheck($this->input->post('id'));
        $output = array();
        foreach ($answers as $item){
            $output[$item->id] = $item->status;
        }
        $output = (Object) $output;
        echo json_encode($output);
        die;
    }
     
    
}
// End of Adminstrator
