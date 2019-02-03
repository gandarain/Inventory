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
}