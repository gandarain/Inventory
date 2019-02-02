<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * General Model Class
 * to provide basic query
 */
class M_department extends CI_Model
{
    /**
     * The constructor of M_general 
     */
    function __construct()
    {
        parent::__construct();
    }

    function get_master_department($params = array())
    {
         if(!empty($params['id']))
            $this->db->where('id', $params['id']);
        if(!empty($params['dept_name']))
            $this->db->like('dept_name', $params['dept_name']);

        $this->db->from('master_department');
        $query = $this->db->get();

        if(!empty($params['id']))
            return $query->row();
        else
            return $query->result();
    }

}