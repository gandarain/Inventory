<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Groups Model
 */
class M_category extends CI_Model
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

        $this->db->from('category');
        $query = $this->db->get();

        if(!empty($params['id']))
            return $query->row();
        else
            return $query->result();
    }

    function check_category_name($name) {
       $query = $this->db->query("SELECT * FROM category WHERE category.name LIKE '$name'");

       return $query->num_rows();
    }

    function get_data($params = array()) {
        if(!empty($params['id']))
            $this->db->where('c.id', $params['id']);
        if(!empty($params['name']))
            $this->db->like('c.name', $params['name']);

        $this->db->from('category c');
        $query = $this->db->get();

        if(!empty($params['id']))
            return $query->row();
        else
            return $query->result();
    }

    function dropdown_category()
    {
        $buffer = array('' => "- " . sprintf(lang('greetings_select1'), lang('category')) . " -");
        $utype = $this->db->order_by('id', 'ASC')->get('category')->result();

        foreach ($utype as $it => $t) {
            $buffer[$t->id] = $t->name;
        }

        return $buffer;
    }

}