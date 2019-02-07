<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User Related Controller
 */
class User extends CI_Controller
{
    private $vclass_user_type = 'user_type';

    function __construct()
    {
        parent::__construct();
        $this->load->model(array(
            'm_user'
        ));
    }

    // **** Master User Type Controller **** //
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
    // **** /Master User Type Controller **** //
}