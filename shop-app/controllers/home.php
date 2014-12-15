<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
 	public function index()
	{
		$this->home();
  	}
        public function __construct()
        {
            parent::__construct();
            $this->load->model('mo_shop');
        }
	// Default Functions
 	public function setup($data=array())
	{
 		$data['header']=$this->load->view('include/head', $data, TRUE);
 		$data['main_menu']=$this->load->view('include/main_menu', $data, TRUE);
 		$data['message']=$this->load->view('include/message', $data, TRUE);
 		$data['footer']=$this->load->view('include/footer', $data, TRUE);
		return $data;
	}
	public function home()
	{
		$data=$this->setup();
   		$data['page']=$this->load->view('homepage', $data, TRUE);
 		$this->load->view('container', $data);
 	} 
        
        
// Single        
	public function single($slug)
	{
                $product=$this->mo_shop->get_single_product($slug);
		$data=$this->setup(array('title'=>$product->title));
                
   		$data['single']=$product;
   		$data['homeslider']=$this->load->view('helper/homeslider', $data, TRUE);
   		
                $data['product']=$this->mo_shop->get_whats_new();
   		$data['_whats_new']=$this->load->view('helper/make_list', $data, TRUE);
   		
                $data['_bestSellerRight']=$this->load->view('helper/productListRight', $data, TRUE);
                
   		$data['page']=$this->load->view('single', $data, TRUE);
 		$this->load->view('container', $data);
 	} 


// Category        
	public function category($slug)
	{
                $cat=$this->mo_shop->get_category($slug);
		$data=$this->setup(array('title'=>$cat->cat_title));
                
   		
                $data['product']=$this->mo_shop->get_products_category($cat->cat_id);
   		$data['category_products']=$this->load->view('helper/make_list', $data, TRUE);
   		
                $data['product']=$this->mo_shop->get_whats_new();
   		$data['_whats_new']=$this->load->view('helper/make_list', $data, TRUE);
   		
                $data['_bestSellerRight']=$this->load->view('helper/productListRight', $data, TRUE);
                
   		$data['page']=$this->load->view('category', $data, TRUE);
 		$this->load->view('container', $data);
 	} 


// Search        
	public function search()
	{
                $value=  $this->input->get('value');
		$data=$this->setup(array('title'=>'Search By: '.$value));
                
                $data['product']=$this->mo_shop->get_products_search($value);
   		$data['SerachResult']=$this->load->view('helper/make_list', $data, TRUE);
   		
                $data['product']=$this->mo_shop->get_whats_new();
   		$data['_whats_new']=$this->load->view('helper/make_list', $data, TRUE);
   		
                $data['_bestSellerRight']=$this->load->view('helper/productListRight', $data, TRUE);
                
   		$data['page']=$this->load->view('search', $data, TRUE);
 		$this->load->view('container', $data);
 	} 

	
}//End controller