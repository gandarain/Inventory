<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Groups Model
 */
class M_order extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get($params = array()) {
        if(!empty($params['id']))
            $this->db->where('o.id', $params['id']);
        if(!empty($params['name']))
            $this->db->like('p.name', $params['name']);

        $this->db->select('o.*, c.name as c_name, s.name as s_name, p.name as p_name, p.total as p_total');
        $this->db->join('product p', 'p.id = o.product_id', 'left');
        $this->db->join('store s', 's.id = o.store_id', 'left');
        $this->db->join('category c', 'c.id = o.category_id', 'left');
        $this->db->from('orders o');
        $query = $this->db->get();

        if(!empty($params['id']))
            return $query->row();
        else
            return $query->result();
    }

    function check_category_name($name) {
       $query = $this->db->query("SELECT * FROM product WHERE product.name LIKE '$name'");

       return $query->num_rows();
    }

    function get_data($params = array()) {
        if(!empty($params['id']))
            $this->db->where('p.id', $params['id']);
        if(!empty($params['name']))
            $this->db->like('p.name', $params['name']);

        $this->db->select("p.*, c.name as c_name, GROUP_CONCAT( s.name SEPARATOR ', ') AS store", false);
        $this->db->from('product p');
        $this->db->join('store_acl sa', 'p.id = sa.product_id', 'left');
        $this->db->join('store s', 'sa.store_id = s.id', 'left');
        $this->db->join('category c', 'p.category_id = c.id', 'left');
        $this->db->group_by('p.id, p.name, p.description');

        $query = $this->db->get();

        if(!empty($params['id']))
            return $query->row();
        else
            return $query->result();
    }

    function get_total_product($params = array()){
        $this->db->select('total');
        $this->db->from('product');
        $this->db->where('id', $params['id']);
        $query = $this->db->get()->row();

        return $query;
    }

}