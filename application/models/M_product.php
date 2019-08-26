<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Groups Model
 */
class M_product extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get($params = array()) {
        if(!empty($params['id']))
            $this->db->where('p.id', $params['id']);
        if(!empty($params['name']))
            $this->db->like('name', $params['name']);

        $this->db->select('p.*, c.name as c_name');
        $this->db->join('category c', 'c.id = p.category_id', 'left');
        $this->db->from('product p');
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

    function dropdown_product()
    {
        $buffer = array('' => "- " . sprintf(lang('greetings_select1'), lang('product')) . " -");
        $utype = $this->db->order_by('id', 'ASC')->get('product')->result();

        foreach ($utype as $it => $t) {
            $buffer[$t->id] = $t->name;
        }

        return $buffer;
    }
}