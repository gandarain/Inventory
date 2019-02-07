<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Menu Controller
 */
class Menu extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // Prepare layout except content
        LOAD_NAVBAR(lang('master').' '.lang('menu'));

        $this->load->model(array(
            'm_menu',
            'm_group'
        ));
    }

    function index()
    {
        $this->acl->validate_read();
        $data = array();

        if($this->input->post('submit'))
        {
            unset($_POST['submit']);
            $data['records'] = $this->m_menu->get($this->input->post());
            echo $this->load->view('dashboard/menu/list_data', $data, TRUE);
            die();
        }

        $this->template->write_view('content', 'dashboard/menu/index', $data, true);
        $this->template->render();
    }

    function create()
    {
        $this->acl->validate_create();

        if($this->input->post('submit'))
        {
            unset($_POST['submit']);

            list($iflag, $imsg) = $this->m_general->insert('menu', $this->input->post());

            JSONRES($iflag, $imsg);
        }

        $data = array();
        echo $this->load->view('dashboard/menu/add', $data, TRUE);
        die();
    }

    function update($id)
    {
        $this->acl->validate_update();

        if($this->input->post('submit'))
        {
            // Do Update
            unset($_POST['submit']);

            list($uflag, $umsg) = $this->m_general->update('menu', $this->input->post(), array('id' => $id));

            JSONRES($uflag, $umsg);
        }

        $data = array();
        $data['record'] = $this->m_menu->get(array('id' => $id));
        echo $this->load->view('dashboard/menu/edit', $data, TRUE);
        die();
    }

    function delete($id)
    {
        $this->acl->validate_delete();
        list($dflag, $dmsg) = $this->m_general->delete('menu', array('id' => $id));

        JSONRES($dflag, $dmsg);
    }

    /**
     * Groups Operation
     */
    function show_groups($menu_id)
    {
        $this->acl->validate_read();
        $data['records'] = $this->m_menu->get_groups(array('menu_id' => $menu_id));

        $view = $this->load->view('dashboard/menu/list_groups', $data, TRUE);
        return LOAD_VIEW($view);
    }

    function delete_group()
    {
        $this->acl->validate_delete();
        unset($_POST['submit']);
        list($dflag, $dmsg) = $this->m_general->delete('groups_acl', $this->input->post());

        return JSONRES($dflag, $dmsg);
    }

    function add_group($menu_id)
    {
        $this->acl->validate_update();
        $submit = $this->input->post('submit');
        
        if($submit)
        {
            unset($_POST['submit']);

            // Insert or update, to minimize redundancy
            list($iflag, $imsg) = $this->m_general->insert_update('groups_acl', $this->input->post(), $this->input->post());
            return JSONRES($iflag, $imsg);            
        }

        $params_group = array('menu_id' => $menu_id);
        $data = array();
        $data['menu_id'] = $menu_id;
        $data['groups'] = $this->m_group->get(); // Get All Groups
        $data['mgroups'] = $this->m_menu->get_groups($params_group);

        $view = $this->load->view('dashboard/menu/add_group', $data, TRUE);

        return LOAD_VIEW($view);
    }

    function update_acl($id_acl)
    {
        $this->acl->validate_update();
        if($this->input->post())
        {
            list($uflag, $umsg) = $this->m_general->update('groups_acl', $this->input->post(), array('id' => $id_acl));

            return JSONRES($uflag, $umsg);
        }
    }
    /**
     * /Groups Operation
     */
}