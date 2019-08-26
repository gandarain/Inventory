<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Groups Model
 */
class M_percentage extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get($params = array()) {
        if(!empty($params['id']))
            $this->db->where('id', $params['id']);
        if(!empty($params['name']))
            $this->db->like('name', $params['name']);

        $this->db->from('store');
        $query = $this->db->get();

        if(!empty($params['id']))
            return $query->row();
        else
            return $query->result();
    }

    function count_store($params = array()) {
        $this->db->select('COUNT(sa.id) as total');
        $this->db->from('store_acl sa');
        $query = $this->db->get();

        return $query->row();
    }

    function count_store_acl($params = array()) {
        if(!empty($params['id']))
            $this->db->where('id', $params['id']);
        if(!empty($params['store_id']))
            $this->db->where('sa.store_id', $params['store_id']);

        $this->db->select('COUNT(sa.id) as total, s.name');
        $this->db->join('store s', 's.id = sa.store_id', 'left');
        $this->db->from('store_acl sa');
        $query = $this->db->get();

        if(!empty($params['store_id']))
            return $query->row();
        else
            return $query->result();
    }

    function count_all_order($params = array()) {
        $this->db->select('COUNT(o.id) as total');
        $this->db->from('orders o');
        $query = $this->db->get();

        return $query->row();
    }

    function get_order($params = array()) {
        if(!empty($params['id']))
            $this->db->where('id', $params['id']);
        if(!empty($params['name']))
            $this->db->like('name', $params['name']);

        $this->db->from('orders');
        $query = $this->db->get();

        if(!empty($params['id']))
            return $query->row();
        else
            return $query->result();
    }

    function get_order2($params = array()) {
        $this->db->select('o.total');
        $this->db->from('orders o');
        $this->db->join('store s', 'o.store_id = s.id', 'left');
        $this->db->where('o.store_id', $params['id']);
        $query = $this->db->get();
        
        return $query->result();
    }

    function count_store2($params = array()) {
        $this->db->select('COUNT(s.id) as total, s.id');
        $this->db->from('store s');
        $query = $this->db->get();

        return $query->row();
    }

    function count_store_in_order($params = array()) {
        $this->db->select('SUM(o.total) as total, s.name');
        $this->db->from('orders o');
        $this->db->join('store s', 'o.store_id = s.id', 'left');
        $this->db->where('store_id', $params['store_id']);

        $query = $this->db->get();
        return $query->row();
    }

    function count_all_order2($params = array()) {
        $this->db->select('SUM(o.total) as total');
        $this->db->from('orders o');
        $query = $this->db->get();

        return $query->row();
    }

}