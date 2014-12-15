<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Shop 
$route['product/(:any)'] = "home/single/$1";
$route['category/(:any)'] = "home/category/$1";
$route['search'] = "home/search";


//Administrator
$route['administrator'] = "administrator/login";
$route['administrator/signin'] = "administrator/login_check";

$route['default_controller'] = "administrator/login";
$route['404_override'] = '';

/* End of file routes.php */
/* Location: ./application/config/routes.php */