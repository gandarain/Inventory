<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Group Controller
 */
class Group extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model(array(
            'm_group',
            'm_user'
        ));

        $menu_name = sprintf('%s %s', lang('master'), lang('groups'));
        LOAD_NAVBAR($menu_name);
    }

    function index() {
        $this->acl->validate_read();
        $data = array();

        if($this->input->post('submit')) {
            $data['records'] = $this->m_group->get_data($this->input->post());

            $view = $this->load->view('dashboard/group/list_data', $data, TRUE);
            return LOAD_VIEW($view);
        }

        $this->template->write_view('content', 'dashboard/group/index', $data, TRUE);
        $this->template->render();
    }

    function create() {
        $this->acl->validate_create();
        $data = array();

        if($this->input->post('submit')) {
            unset($_POST['submit']);

            list($iflag, $imsg) = $this->m_general->insert('groups', $this->input->post());

            return JSONRES($iflag, $imsg);
        }

        $view = $this->load->view('dashboard/group/add', $data, TRUE);
        return LOAD_VIEW($view);
    }

    function update($id) {
        $this->acl->validate_update();
        $data = array();

        if($this->input->post('submit')) {
            unset($_POST['submit']);

            $where = array('id' => $id);
            list($uflag, $umsg) = $this->m_general->update('groups', $this->input->post(), $where);

            return JSONRES($uflag, $umsg);
        }

        $data['record'] = $this->m_group->get_data(array('id' => $id));
        $view = $this->load->view('dashboard/group/edit', $data, TRUE);
        return LOAD_VIEW($view);
    }

    function delete($id) {
        $this->acl->validate_delete();

        $where = array('id' => $id);
        list($dflag, $dmsg) = $this->m_general->delete('groups', $where);

        return JSONRES($dflag, $dmsg);
    }

    function show_user($group_id) {
        $this->acl->validate_read();
        $user_params = array ('group_id' => $group_id);
        $data['record'] = $this->m_user->get_user_groups($user_params);
        $data['group_id'] = $group_id;

        $view = $this->load->view('dashboard/group/list_user', $data, TRUE);
        return LOAD_VIEW($view);
    }

    function create_user($group_id) {
        $this->acl->validate_update();
        
        if($this->input->post('submit')) {
            unset($_POST['submit']);

            // Building our query data
            $insert_data = array();
            if($this->input->post('users')) {
                foreach ($_POST['users'] as $iu => $u) {
                    $new_data = array(
                        'user_id' => $u,
                        'group_id' => $group_id
                    );

                    // Validate user & group
                    $record = $this->m_user->get_user_groups($new_data);
                    if(empty($record))
                        array_push($insert_data, $new_data);
                }

                if(!empty($insert_data)) {
                    // Insert batch, to minimize db process
                    list($iflag, $imsg) = $this->m_general->insert('users_group', $insert_data, true);
                    return JSONRES($iflag, $imsg, array(), true); // to turn on delimiter                
                } else {
                    return JSONRES(_ERROR, lang('msg_failed_saved'), array(), true);
                }
            } else {
                return JSONRES(_WARNING, sprintf(lang('greetings_select1'), lang('user')), array(), true);
            }
        }

        $params_group = array('group_id' => $group_id);
        $data = array();
        $data['records_group'] = $this->m_group->get(array('id'=>$group_id));
        $data['records'] = $this->m_group->get_user($params_group);

        $view = $this->load->view('dashboard/group/add_user', $data, TRUE);
        return LOAD_VIEW($view);
    }

    function delete_user() {
        if($this->input->post('users_group')) {
            list($dflag, $dmsg) = $this->m_group->delete_user($this->input->post('users_group'));

            return JSONRES($dflag, $dmsg);
        } else {
            return JSONRES(_ERROR, sprintf(lang('PleaseSelect1').' %s', lang('User'), lang('msg_op_delete')));
        }
    }

    function show_menu($group_id) {
        $this->acl->validate_read();
        $params_group = array('group_id' => $group_id);
        $data = array();
        $data['menus'] = $this->m_group->get_menu_acl($params_group);

        $view = $this->load->view('dashboard/group/list_menu', $data, TRUE);
        return LOAD_VIEW($view);
    }

    function create_menu($id) {
        $this->acl->validate_create();

        if($this->input->post('submit')) {
            unset($_POST['submit']);
            foreach($_POST['menu'] as $index => $r){
                $new_data = array(
                    'group_id' => $id,
                    'menu_id'=> $r
                );
                list($iflag, $imsg) = $this->m_general->insert('groups_acl', $new_data);
            }

            return JSONRES($iflag, $imsg);
        }

        $data = array();
        $data['group_id'] = $id;

        $params_menu = array('without_group_id' => $id);
        $data['records'] = $this->m_group->get_menu($params_menu);

        $view = $this->load->view('dashboard/group/add_menu', $data, TRUE);
        return LOAD_VIEW($view);
    }

    function update_privilege($acl_id) {
        $this->acl->validate_update();
        if($this->input->post('submit')) {
            // Do Update
            list($uflag, $umsg) = $this->m_general->update('groups_acl', $this->input->post(), array('id' => $acl_id));

            return JSONRES($uflag, $umsg);
        }
    }
}