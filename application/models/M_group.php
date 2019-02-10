<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Groups Model
 */
class M_group extends CI_Model
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

        $this->db->from('groups');
        $query = $this->db->get();

        if(!empty($params['id']))
            return $query->row();
        else
            return $query->result();
    }

    function get_data($params = array()) {
        if(!empty($params['id']))
            $this->db->where('g.id', $params['id']);
        if(!empty($params['name']))
            $this->db->like('g.name', $params['name']);

        $this->db->from('groups g');
        $query = $this->db->get();

        if(!empty($params['id']))
            return $query->row();
        else
            return $query->result();
    }

    function get_user($params = array()) {
        $this->db->select('u.id, u.name, u.username, u.email, u.phone');
        $this->db->from('users u');
        $this->db->where('u.utype <', UTYPE_REGULAR);

        if(!empty($params['group_id'])) //nama variabel yg ada di dalam params array
        {
            // Exclude from passed group_id
            $eliminator = "select user_id from users_group where group_id = ".$params['group_id'];
            $this->db->where_not_in('u.id', $eliminator, FALSE);
        }

        // Only select user outside group_id
        $query = $this->db->get()->result();
        return $query;
    }

    function delete_user($ug_id) {
        if(is_array($ug_id))
            $this->db->where_in('id', $ug_id);
        else
            $this->db->where('id', $ug_id);

        $result = $this->db->delete('users_group');

        return array($result, DELETE_iFLAG($result));
    }

    function get_menu($params = array()) {
        $this->db->select("m.*");
        $this->db->distinct();
        $this->db->from('menu m');
        $this->db->join('groups_acl ga', 'ga.menu_id = m.id', 'left');
        $this->db->join('groups g', 'g.id = ga.group_id', 'left');

        if(!empty($params['group_id']))
            $this->db->where('g.id', $params['group_id']);

        if(!empty($params['without_group_id'])) {
            // Exclude from passed without_group_id
            $eliminator = "SELECT menu_id FROM groups_acl WHERE group_id = ".$params['without_group_id'];
            $this->db->or_where_not_in('m.id', $eliminator, FALSE);
        }

        // Only select user outside group_id
        $query = $this->db->get()->result();
        return $query;
    }

    function get_menu_acl($params = array()) {
        $this->db->select("
            m.*, ga.id acl_id,
            ga.create_,
            ga.read_,
            ga.update_,
            ga.delete_,
            ga.report_
            ");
        $this->db->from('menu m');
        $this->db->join('groups_acl ga', 'ga.menu_id = m.id');
        $this->db->join('groups g', 'g.id = ga.group_id');

        if(!empty($params['group_id']))
            $this->db->where('g.id', $params['group_id']);

        // Only select user outside group_id
        $query = $this->db->get()->result();
        return $query;
    }
}