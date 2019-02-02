<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * General Model Class
 * to provide basic query
 */
class M_chapter extends CI_Model
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
    function get($params = array())
    {
        if(!empty($params['id']))
            $this->db->where('id', $params['id']);
        if(!empty($params['chapter_name']))
            $this->db->like('chapter_name', $params['chapter_name']);
        if(!empty($params['district_id']))
            $this->db->like('district_id', $params['district_id']);
        if(!empty($params['province_id']))
            $this->db->like('province_id', $params['province_id']);
        if(!empty($params['regency_id']))
            $this->db->like('regency_id', $params['regency_id']);
        if(!empty($params['village_id']))
            $this->db->like('village_id', $params['village_id']);
        if(!empty($params['resto_name']))
            $this->db->like('resto_name', $params['resto_name']);
        if(!empty($params['date']))
            $this->db->like('date', $params['date']);
        if(!empty($params['lat']))
            $this->db->like('lat', $params['lat']);
        if(!empty($params['lng']))
            $this->db->like('lng', $params['lng']);

        $this->db->select('mc.*');
        $this->db->from('master_chapter mc');

        $query = $this->db->get();

        if(!empty($params['id']))
            return $query->row();
        else
            return $query->result();
    }

    function get_province()
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

    function get_district()
    {
        $buffer = array('' => 'District');

        //select record
        $this->db->select('id, name');
        $query = $this->db->get('districts')->result();

        foreach ($query as $q) {
            $buffer[$q->id] = $q->name;
        }

        return $buffer;
    }

    function get_regency()
    {
        $buffer = array('' => 'Regency');

        //select record
        $this->db->select('id, name');
        $query = $this->db->get('regencies')->result();

        foreach ($query as $q) {
            $buffer[$q->id] = $q->name;
        }

        return $buffer;
    }

    function get_regency2($params=array())
    {
        $buffer = array('' => 'Regency');

        //select record
        $this->db->select('id, name, province_id');
        $this->db->from('regencies r');
        $this->db->where('r.province_id', $params['province_id']);
        $query = $this->db->get()->result();

        foreach ($query as $q) {
            $buffer[$q->id] = $q->name;
        }

        return $buffer;
    }

    function get_village()
    {
        $buffer = array('' => 'Village');

        //select record
        $this->db->select('id, name');
        $query = $this->db->get('villages')->result();

        foreach ($query as $q) {
            $buffer[$q->id] = $q->name;
        }

        return $buffer;
    }
} // End of class