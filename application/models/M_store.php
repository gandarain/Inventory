<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Groups Model
 */
class M_store extends CI_Model
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

    function check_category_name($name) {
       $query = $this->db->query("SELECT * FROM store WHERE store.name LIKE '$name'");

       return $query->num_rows();
    }

    function get_data($params = array()) {
        if(!empty($params['id']))
            $this->db->where('s.id', $params['id']);
        if(!empty($params['name']))
            $this->db->like('s.name', $params['name']);

        $this->db->from('store s');
        $query = $this->db->get();

        if(!empty($params['id']))
            return $query->row();
        else
            return $query->result();
    }

    function dropdown_store()
    {
        $buffer = array();
        $utype = $this->db->order_by('id', 'ASC')->get('store')->result();

        foreach ($utype as $it => $t) {
            $buffer[$t->id] = $t->name;
        }

        return $buffer;
    }

    function dropdown_store2()
    {
        $buffer = array('' => "- " . sprintf(lang('greetings_select1'), lang('store')) . " -");
        $utype = $this->db->order_by('id', 'ASC')->get('store')->result();

        foreach ($utype as $it => $t) {
            $buffer[$t->id] = $t->name;
        }

        return $buffer;
    }

    function get_store_acl($id)
    {
        $this->db->select('*');
        $this->db->from('store_acl sa');
        $this->db->where('sa.product_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    function get_store_product($params = array())
    {
        $this->db->select('sa.store_id, s.name');
        $this->db->join('store s', 's.id = sa.store_id', 'right');
        $this->db->from('store_acl sa');
        $this->db->where('sa.product_id', $params['product_id']);
        $query = $this->db->get();
        return  $query->result();
    }
}