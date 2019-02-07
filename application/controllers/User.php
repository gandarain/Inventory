<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User Related Controller
 */
class User extends CI_Controller
{
    private $vclass_user_type = 'user_type';

    function __construct() {
        parent::__construct();
        $this->load->model(array(
            'm_user',
            'm_group'
        ));
    }

    // **** Master User Related Functions **** //
    function index() {
        $this->acl->validate_read();
        $menu_name = lang('master').' '.lang('user');
        $data = array();

        if($this->input->post('submit'))
        {
            $data['records'] = $this->m_user->get_data($this->input->post());

            $view = $this->load->view('dashboard/user/list_data', $data, TRUE);
            return LOAD_VIEW($view);
        }

        LOAD_NAVBAR($menu_name);
        $data['utype'] = $this->m_user->dd_utype();
        $data['status'] = DD_STATUS_USER();
        $this->template->write_view('content', 'dashboard/user/index', $data, TRUE);
        $this->template->render();
    }

    function info_for_admin() {
        echo "Panel ini akan berisikan info untuk Administrator";
    }

    function create() {
        $this->acl->validate_create();

        if($this->input->post('submit')) {
            unset($_POST['submit']);

            // Validate Email
            if(!_valid_email($this->input->post('email')))
                return JSONRES(_ERROR, lang('msg_invalid_email'), array(), true);

            // Validate username, phone & email
            list($vsuccess, $vmsg) = $this->m_user->validate_register($this->input->post());
            if(!$vsuccess)
                return JSONRES(_ERROR, $vmsg, array(), true);

            $_POST['birth'] = FORMAT_DATE_($this->input->post('birth'));
            $_POST['password'] = encrypt($this->input->post('password'));

            list($iflag, $imsg) = $this->m_general->insert('users', $this->input->post());
            return JSONRES($iflag, $imsg, array(), true);
        }

        $data = array();
        $data['utype'] = $this->m_user->dd_utype();
        $data['status'] = DD_STATUS_USER();
        $view =  $this->load->view('dashboard/user/add', $data, TRUE);
        return LOAD_VIEW($view);
    }

    function update($id) {
        $this->acl->validate_update();

        if($this->input->post('submit')) {
            unset($_POST['submit']);

            // Remove empty value
            foreach ($_POST as $key => $value) {
                if($value == '')
                    unset($_POST[$key]);
            }

            // Validate Email
            if(!_valid_email($this->input->post('email')))
                return JSONRES(_ERROR, lang('msg_invalid_email'), array(), true);

            // Validate username, phone & email
            list($vsuccess, $vmsg) = $this->m_user->validate_register($this->input->post());
            if(!$vsuccess)
                return JSONRES(_ERROR, $vmsg, array(), true);

            if($this->input->post('birth'))
                $_POST['birth'] = FORMAT_DATE_($this->input->post('birth'));
            if($this->input->post('password'))
                $_POST['password'] = encrypt($this->input->post('password'));

            list($iflag, $imsg) = $this->m_general->update('users', $this->input->post(), array('id' => $id));

            return JSONRES($iflag, $imsg, array(), true);
        }

        $data = array();
        $data['utype'] = $this->m_user->dd_utype();
        $data['status'] = DD_STATUS_USER();
        $data['record'] = $this->m_user->get_data(array('id' => $id));
        $view = $this->load->view('dashboard/user/edit', $data, TRUE);
        return LOAD_VIEW($view);
    }

    function delete($id) {
        $this->acl->validate_delete();

        // Only update status to inactive
        $value = array('status' => _INACTIVE);
        list($dflag, $dmsg) = $this->m_general->update('users', $value, array('id' => $id));

        return JSONRES($dflag, $dmsg);
    }

    function show_groups($user_id) {
        $this->acl->validate_update();
        $data = array();
        $data['groups'] = $this->m_group->get();
        $data['ugroups'] = $this->m_user->get_user_groups(array('user_id' => $user_id));
        $data['user_id'] = $user_id;

        $view = $this->load->view('dashboard/user/list_groups', $data, TRUE);
        return LOAD_VIEW($view);
    }

    /**
     * Add User into group
     */
    function add_group() {
        $this->acl->validate_update();

        $where = array(
            'user_id' => $this->input->post('user_id'),
            'group_id' => $this->input->post('group_id')
        );
        // Insert or update, to minimize redundancy
        list($flag, $msg) =  $this->m_general->insert_update('users_group', $this->input->post(), $where);

        return JSONRES($flag, $msg);
    }

    /**
     * Delete user from group
     */
    function delete_group() {
        $this->acl->validate_update();

        $where = array(
            'user_id' => $this->input->post('user_id'),
            'group_id' => $this->input->post('group_id')
        );
        list($flag, $msg) =  $this->m_general->delete('users_group', $where);

        return JSONRES($flag, $msg);
    }
    // **** /Master User Related Functions **** //

    // **** Master User Related Functions **** //
    function read_type()
    {
        $this->acl->validate_read(null, $this->vclass_user_type);
        $data = array();
        $menu_name = lang('master').' '.lang('user_type');

        if($this->input->post('submit'))
        {
            unset($_POST['submit']);
            $data['records'] = $this->m_user->get_type($this->input->post());
            echo $this->load->view('dashboard/user/list_type', $data, TRUE);
            die();
        }

        LOAD_NAVBAR($menu_name);
        $this->template->write_view('content', 'dashboard/user/read_type', $data, TRUE);
        $this->template->render();
    }

    function create_type()
    {
        $this->acl->validate_create(null, $this->vclass_user_type);
        
        if($this->input->post('submit'))
        {
            unset($_POST['submit']);
            list($iflag, $imsg) = $this->m_general->insert('users_type', $this->input->post());
            $array = $this->input->post('*');

            JSONRES($iflag, $imsg);
        }
        
        $data = array();
        echo $this->load->view('dashboard/user/add_type', $data, TRUE);
        die();
    }


    function update_type($id)
    {
        $this->acl->validate_update(null, $this->vclass_user_type);

        if($this->input->post('submit'))
        {
            // Do Update
            unset($_POST['submit']);

            list($uflag, $umsg) = $this->m_general->update('users_type', $this->input->post(), array('id' => $id));

            JSONRES($uflag, $umsg);
        }

        $data = array();
        $data['record'] = $this->m_user->get_type(array('id' => $id));
        echo $this->load->view('dashboard/user/edit_type', $data, TRUE);
        die();
    }

    function delete_type($id)
    {
        $this->acl->validate_delete(null, $this->vclass_user_type);
        list($dflag, $dmsg) = $this->m_general->delete('users_type', array('id' => $id));

        JSONRES($dflag, $dmsg);
    }
    // **** /Master User Related Functions **** //
}