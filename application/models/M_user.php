<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model for User Module
 */
class M_user extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Login Query
     */
    public function login($params = array()) {
        if(empty($params))
            return array(false, lang('msg_login_invalid'));
        elseif(empty($params['username']))
            return array(false, sprintf(lang('msg_param_required'), lang('useraname')));
        elseif(empty($params['password']))
            return array(false, sprintf(lang('msg_param_required'), lang('password')));

        $this->db->select("
            u.id, u.username, u.name, u.email, u.phone, u.status, u.profile_picture, u.utype
            ");
        $this->db->from('users u');
        $this->db->where('u.username', $params['username']);
        $this->db->where('u.password', $params['password']);

        $query = $this->db->get()->row();

        return array(true, $query);
    }

    public function get_user_groups($params = array())
    {
        $this->db->select("
            a.username, a.name, a.phone, a.email,
            b.user_id, b.group_id, b.id ug_id,
            c.name group_name, c.special_privilege, c.dashboard_access,
            c.description group_desc
            ");
        $this->db->from('users a');
        $this->db->join('users_group b', 'b.user_id = a.id');
        $this->db->join('groups c', 'c.id = b.group_id');

        if(!empty($params['username']))
            $this->db->where('a.username', $params['username']);
        if(!empty($params['id']))
            $this->db->where('a.id', $params['id']);
        if(!empty($params['user_id']))
            $this->db->where('b.user_id', $params['user_id']);
        if(!empty($params['group_id']))
            $this->db->where('b.group_id', $params['group_id']);

        $query = $this->db->get();

        return $query->result();
    }
}