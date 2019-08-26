<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Group Controller
 */
class Store extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model(array(
            'm_group',
            'm_user',
            'm_store'
        ));

        $menu_name = sprintf('%s %s', lang('master'), lang('store'));
        LOAD_NAVBAR($menu_name);
    }

    function index() {
        $this->acl->validate_read();
        $data = array();

        if($this->input->post('submit')) {
            $data['records'] = $this->m_store->get($this->input->post());

            $view = $this->load->view('dashboard/store/list_data', $data, TRUE);
            return LOAD_VIEW($view);
        }

        $this->template->write_view('content', 'dashboard/store/index', $data, TRUE);
        $this->template->render();
    }

    function create() {
        $this->acl->validate_create();
        $data = array();

        if($this->input->post('submit')) {
            unset($_POST['submit']);

            $data = $this->m_store->check_category_name($this->input->post('name'));
            
            if(isset($data) && !$data){
                list($iflag, $imsg) = $this->m_general->insert('store', $this->input->post());
                return JSONRES($iflag, $imsg);
            } else {
                return JSONRES(_ERROR, lang('error_name') , array(), false);
            }
        }
        $view = $this->load->view('dashboard/store/add', $data, TRUE);
        return LOAD_VIEW($view);
    }

    function update($id) {
        $this->acl->validate_update();
        $data = array();

        if($this->input->post('submit')) {
            unset($_POST['submit']);

            $where = array('id' => $id);
            list($uflag, $umsg) = $this->m_general->update('store', $this->input->post(), $where);

            return JSONRES($uflag, $umsg);
        }

        $data['record'] = $this->m_store->get_data(array('id' => $id));
        $view = $this->load->view('dashboard/store/edit', $data, TRUE);
        return LOAD_VIEW($view);
    }

    function delete($id) {
        $this->acl->validate_delete();

        $where = array('id' => $id);
        list($dflag, $dmsg) = $this->m_general->delete('store', $where);

        return JSONRES($dflag, $dmsg);
    }

}