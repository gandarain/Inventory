<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * General Model Class
 * to provide basic query
 */
class M_member extends CI_Model
{
    /**
     * The constructor of M_general 
     */
    function __construct()
    {
        parent::__construct();
    }

    function get_master_member($params = array())
    {
         if(!empty($params['id']))
            $this->db->where('id', $params['id']);
        if(!empty($params['name']))
            $this->db->like('name', $params['name']);

        $this->db->select('*');
        $this->db->from('master_member mm');
        $this->db->join('master_department md', 'md.id = mm.dept_id');
        $query = $this->db->get();

        if(!empty($params['id']))
            return $query->row();
        else
            return $query->result();
    }

    function department()
    {
        $buffer = array('' => '- pilih Department-');

        // Select record
        $this->db->select('id, dept_name');
        $query = $this->db->get('master_department')->result();

        foreach($query as $q) {
            $buffer[$q->id] = $q->dept_name;
        }

        return $buffer;
    }

}