<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Groups Model
 */
class M_report extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get($params = array()) {
        if(!empty($params['id']))
            $this->db->where('o.id', $params['id']);
        if(!empty($params['product_id']))
            $this->db->where('o.product_id', $params['product_id']);
        if(!empty($params['store_id']))
            $this->db->where('o.store_id', $params['store_id']);
        if(!empty($params['from']) && isset($params['from']) && $params['from'] != '' && !empty($params['to']) && isset($params['to']) && $params['to'] != ''){
            $this->db->where('date(o.date) >=', $params['from']);
            $this->db->where('date(o.date) <=', $params['to']);
        }
        if(!empty($params['name']))
            $this->db->like('p.name', $params['name']);

        $this->db->select('o.*, c.name as c_name, s.name as s_name, p.name as p_name, p.total as p_total, p.price');
        $this->db->join('product p', 'p.id = o.product_id', 'right');
        $this->db->join('store s', 's.id = o.store_id', 'right');
        $this->db->join('category c', 'c.id = o.category_id', 'right');
        $this->db->from('orders o');
        $query = $this->db->get();

        if(!empty($params['id']))
            return $query->row();
        else
            return $query->result();
    }

}