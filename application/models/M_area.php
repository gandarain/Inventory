<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * General Model Class
 * to provide basic query
 */
class M_area extends CI_Model
{
    /**
     * The constructor of M_general 
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get Menu
     * @param array $params - Contain paramters of function
     * @return object - Query results
     */

    function get_province($params = array())
    {
        if(!empty($params['id']))
            $this->db->where('id', $params['id']);
        if(!empty($params['name']))
            $this->db->like('name', $params['name']);

        $query = $this->db->get('provinces');

        if(!empty($params['id']))
            return $query->row();
        else
            return $query->result();
    }

    function get_province2()
    {
        $buffer = array('' => 'Province');

        // Select record
        $this->db->select('id, name');
        $query = $this->db->get('provinces')->result();

        foreach($query as $q) {
            $buffer[$q->id] = $q->name;
        }

        return $buffer;
    }

    function get_regency($params=array())
    {
        $buffer = array('' => 'Regency');

        //select record
        $this->db->select('id, name');

        if(!empty($params['province_id']))
            $this->db->where('province_id', $params['province_id']);
        
        $query = $this->db->get('regencies')->result();

        foreach ($query as $q) {
            $buffer[$q->id] = $q->name;
        }

        return $buffer;
    }

    function get_regency2($params = array())
    {
        if(!empty($params['id']))
            $this->db->where('r.id', $params['id']);
        if(!empty($params['province_id']))
            $this->db->where('r.province_id', $params['province_id']);
        if(!empty($params['name']))
            $this->db->like('r.name', $params['name']);

        $this->db->select('r.*, p.name as p_name, p.id as p_id');
        $this->db->from('regencies r');
        $this->db->join('provinces p', 'p.id = r.province_id');
        $this->db->limit(250);

        $query = $this->db->get();

        if(!empty($params['id']))
            return $query->row();
        else
            return $query->result();
    }

    function get_district($params=array())
    {
        $buffer = array('' => 'District');

        //select record
        $this->db->select('id, name');

        if(!empty($params['regency_id']))
            $this->db->where('regency_id', $params['regency_id']);
        
        $query = $this->db->get('districts')->result();

        foreach ($query as $q) {
            $buffer[$q->id] = $q->name;
        }

        return $buffer;
    }

    function get_district2($params = array())
    {
        if(!empty($params['id']))
            $this->db->where('d.id', $params['id']);
        if(!empty($params['regency_id']))
            $this->db->where('d.regency_id', $params['regency_id']);
        if(!empty($params['name']))
            $this->db->like('d.name', $params['name']);

        $this->db->select('d.*, r.name as r_name, r.id as r_id');
        $this->db->from('districts d');
        $this->db->join('regencies r', 'r.id = d.regency_id');
        $this->db->limit(250);

        $query = $this->db->get();

        if(!empty($params['id']))
            return $query->row();
        else
            return $query->result();
    }


    function get_village($params=array())
    {
        $buffer = array('' => 'Village');

        //select record
        $this->db->select('id, name');

        if(!empty($params['district_id']))
            $this->db->where('district_id', $params['district_id']);
        
        $query = $this->db->get('villages')->result();

        foreach ($query as $q) {
            $buffer[$q->id] = $q->name;
        }

        return $buffer;
    }

    function get_village2($params = array())
    {
        if(!empty($params['id']))
            $this->db->where('v.id', $params['id']);
        if(!empty($params['regency_id']))
            $this->db->where('v.regency_id', $params['regency_id']);
        if(!empty($params['name']))
            $this->db->like('v.name', $params['name']);

        $this->db->select('v.*, d.name as d_name, d.id as d_id');
        $this->db->from('villages v');
        $this->db->join('districts d', 'd.id = v.district_id');
        $this->db->limit(250);

        $query = $this->db->get();

        if(!empty($params['id']))
            return $query->row();
        else
            return $query->result();
    }
} // End of class