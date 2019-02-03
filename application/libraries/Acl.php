<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Acl
{
    public $CI;
    public $mySession;
    public $is_super = 5;
    public $granted = 1;

    public $create = 'create_';
    public $read = 'read_';
    public $update = 'update_';
    public $delete = 'delete_';
    public $report = 'report_';

    public $table_menu = 'menu';
    public $table_group = 'groups';
    public $table_group_acl = 'groups_acl';
    public $table_user = 'users';
    public $table_user_group = 'users_group';

    function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->library('session', 'database');
        $this->CI->load->helper(array('url', 'language'));
    }

    public function getMySession() {
        $this->mySession = $this->CI->session->userdata('user_info');
        if(empty($this->mySession)) {       
            redirect(''); // Redirect to Home Page
        }
    }

    public function has_dashboard_access($display_error = false)
    {
        $this->getMySession();
        $has_access = !empty($this->mySession['dashboard_access']) ? $this->mySession['dashboard_access'] : $this->mySession['special_privilege'];

        if($display_error === true)
        {
            if(!$has_access)
                $this->display_error(lang('msg_nopermission_menu'));
            else
                return true;
        }
        else
        {
            return $has_access;
        }
    }

    private function display_error($message)
    {
        if(requestFromAjax())
        {
            JSONRES(_INFO, $message);
        }
        else 
        {
            $this->CI->session->set_flashdata('flash_message', $message);
            $referer = $this->CI->input->server('HTTP_REFERER') ?: 'app';
            redirect($referer);
        }
    }

    public function noAccess($params = array()) {
        $operation = str_replace('_', '', $params['operation']);
        $menu = $params['menu'];

        if(!empty($params))
        {
            $op_lang = sprintf('msg_op_%s', $operation);
            $message = sprintf(
                '%s %s %s :)',
                lang('msg_nopermission_menu'),
                lang($op_lang),
                !empty($menu) ? 'in <strong>'.$menu.'</strong>' : ''
            );
        }
        else
        {
            $message = lang('msg_nopermission_menu');
        }

        $this->display_error($message);
    }

    public function operationGranted($class, $acl_name = '', $func = '') {
        $this->getMySession();
        $this->CI->db->select("
            a.username,
            c.name group_name, c.special_privilege, c.dashboard_access,
            d.create_, d.read_, d.update_, d.delete_, d.report_,
            e.name menu_name, e.class_name, e.method_name
        ");
        $this->CI->db->from(sprintf('%s a', $this->table_user));
        $this->CI->db->join(sprintf('%s b', $this->table_user_group), 'b.user_id = a.id', 'left');
        $this->CI->db->join(sprintf('%s c', $this->table_group), 'c.id = b.group_id', 'left');
        $this->CI->db->join(sprintf('%s d', $this->table_group_acl), 'd.group_id = b.group_id', 'left');
        $this->CI->db->join(sprintf('%s e', $this->table_menu), 'e.id = d.menu_id', 'left');

        $this->CI->db->where('a.id', $this->mySession['user_id']);
        $privileges = $this->CI->db->get()->result();

        // Checking Special Privilege
        $has_special_privilege = !empty(array_filter(
            $privileges, 
            function($privilege)
            {
                return $privilege->special_privilege == 1;
            }
        ));

        if($has_special_privilege)
            return true;

        // Checking Regular Privilege
        $menu = array();
        $accessed_menu = array('classname' => $class, 'operation' => $acl_name, 'function' => $func);
        $has_privilege = !empty(array_filter(
            $privileges,
            function($privilege) use ($accessed_menu, &$menu)
            {
                // Checking class, operation and function (optional)
                $suitable_class = $accessed_menu['classname'] == $privilege->class_name;
                $suitable_operation = !empty($privilege->$accessed_menu['operation']);
                $suitable_function = true; // Default is true

                if(!empty($accessed_menu['function']))
                    $suitable_function = $accessed_menu['function'] == $privilege->method_name;

                if($suitable_class && $suitable_function && !$suitable_operation) {
                    $menu = $privilege;
                }

                return $suitable_class && $suitable_operation && $suitable_function;
            }
        ));

        if($has_privilege)
            return true;

        $nacc_params = array(
            'menu' => $menu->menu_name,
            'operation' => $acl_name
        );

        $this->noAccess($nacc_params);
    }

    // ******* VALIDATE ******* //
    // Docs
    // Just fill $func_name parameters when you has been register the function name in acl table
    public function validate_read($func_name = '', $classname = '') {
        if(empty($classname)) {
            $classname = $this->getClassName();
        }
        $granted = $this->operationGranted($classname, $this->read, $func_name);
    }

    public function validate_create($func_name = '', $classname = '') {
        if(empty($classname)) {
            $classname = $this->getClassName();
        }
        $granted = $this->operationGranted($classname, $this->create, $func_name);
    }

    public function validate_update($func_name = '', $classname = '') {
        if(empty($classname)) {
            $classname = $this->getClassName();
        }
        $granted = $this->operationGranted($classname, $this->update, $func_name);
    }

    public function validate_delete($func_name = '', $classname = '') {
        if(empty($classname)) {
            $classname = $this->getClassName();
        }
        $granted = $this->operationGranted($classname, $this->delete, $func_name);
    }

    public function validate_report($func_name = '', $classname = '') {
        if(empty($classname)) {
            $classname = $this->getClassName();
        }
        $granted = $this->operationGranted($classname, $this->report, $func_name);
    }

    private function getClassName() {
        return $this->CI->router->fetch_class();
    }

    private function getFunctionName() {
        return $this->CI->router->fetch_method();
    }
}
