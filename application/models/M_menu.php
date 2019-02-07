<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Menu Model
 */
class M_menu extends CI_Model
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
        if(!empty($params['class_name']))
            $this->db->like('class_name', $params['class_name']);
        if(!empty($params['method_name']))
            $this->db->like('method_name', $params['method_name']);

        $this->db->from('menu');
        $query = $this->db->get();

        if(!empty($params['id']))
            return $query->row();
        else
            return $query->result();
    }

    function get_groups($params = array()) {
        if(!empty($params['menu_id']))
            $this->db->where('m.id', $params['menu_id']);
        if(!empty($params['group_id']))
            $this->db->where('g.id', $params['group_id']);

        $this->db->select("
            ga.*, ga.id id_acl,
            g.*
            ");
        $this->db->from('groups g');
        $this->db->join('groups_acl ga', 'ga.group_id = g.id');
        $this->db->join('menu m', 'm.id = ga.menu_id');

        $query = $this->db->get()->result();

        return $query;
    }
}