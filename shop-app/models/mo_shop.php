<?php Class Mo_shop extends CI_Model
{
     public function get_whats_new() {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(8);
        $this->db->where('what_new', 1);
        $query_result = $this->db->get();
        
        $row= $query_result->result();
        foreach ($row as $key=>$item){
        $this->db->select('*');
        $this->db->from('product_img');
        $this->db->where('pi_product', $item->id);
        $query_result = $this->db->get();
        $item->images=$query_result->result();
        }
        return $row;
    }  
    
     public function get_must_popular() {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(8);
        $this->db->where('must_popular', 1);
        $query_result = $this->db->get();
        
        $row= $query_result->result();
        foreach ($row as $key=>$item){
        $this->db->select('*');
        $this->db->from('product_img');
        $this->db->where('pi_product', $item->id);
        $query_result = $this->db->get();
        $item->images=$query_result->result();
        }
        return $row;
    }  
    
    public function get_single_product($slug){
        $this->db->select('products.*, category.cat_title, category.cat_slug');
        $this->db->from('products');
        $this->db->where('slug', $slug);
        $this->db->join('category', 'category.cat_id=products.cat', 'left');
        $query_result = $this->db->get();
        $row= $query_result->row();
        
        $this->db->select('*');
        $this->db->from('product_img');
        $this->db->where('pi_product', $row->id);
        $query_result = $this->db->get();
        $row->images=$query_result->result();
        return $row;
    }
// Category
    public function get_category($slug){
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('cat_slug', $slug);
        $query_result = $this->db->get();
        return $query_result->row();
    }
    public function get_all_category() {
        $this->db->select('cat_id, cat_parent, cat_title, cat_slug, cat_counter');
        $this->db->from('category');
        $this->db->where('cat_status >', 0);
        $this->db->where('cat_parent', 0);
        $this->db->order_by('cat_order', 'ASC');
        $query_result = $this->db->get();
        $category = $query_result->result();

        foreach ($category as $key => $item) {
            $this->db->select('cat_id, cat_parent, cat_title, cat_slug, cat_counter');
            $this->db->from('category');
            $this->db->where('cat_status >', 0);
            $this->db->where('cat_parent', $item->cat_id);
            $this->db->order_by('cat_order', 'ASC');
            $query_result = $this->db->get();
            $category[$key]->sub = $query_result->result();
        }
        return $category;
    }  
     public function get_products_category($id) {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('cat', $id);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(9);
        $query_result = $this->db->get();
        
        $row= $query_result->result();
        foreach ($row as $key=>$item){
        $this->db->select('*');
        $this->db->from('product_img');
        $this->db->where('pi_product', $item->id);
        $query_result = $this->db->get();
        $item->images=$query_result->result();
        }
        return $row;
    }      

// Search     
    
    public function get_products_search($value) {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->like('title', $value);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(9);
        $query_result = $this->db->get();
        
        $row= $query_result->result();
        foreach ($row as $key=>$item){
        $this->db->select('*');
        $this->db->from('product_img');
        $this->db->where('pi_product', $item->id);
        $query_result = $this->db->get();
        $item->images=$query_result->result();
        }
        return $row;
    }      
    
    
}// End Model