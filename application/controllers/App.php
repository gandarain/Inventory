<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* This is App Controller
*/
class App extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array(
            'm_user'
        ));
    }

    function index() {
        $this->login();
    }

    function login() {
        $submit = $this->input->post('submit');

        if($submit) {
            $this->form_validation->set_rules('username', lang('username'), 'required');
            $this->form_validation->set_rules('password', lang('password'), 'required');

            if($this->form_validation->run() !== TRUE) {
                return JSONRES(_ERROR, validation_errors());
            }

            $filter = array(
                'username' => $this->input->post('username'),
                'password' => encrypt($this->input->post('password'))
            );
            list($flag, $user) = $this->m_user->login($filter);

            if(!empty($user)) {
                if($flag !== true)
                    return JSONRES(_ERROR, $user);

                // NOTE This is for API Login
                // Save API key
                // $plain = sprintf('%s:%s:%s', $user_data->username, $user_data->id, time());
                // $key_values = array('app_key' => encrypt($plain));
                // $key_filter = array('id' => $user_data->id);
                // list($uflag, $umsg) = $this->m_general->insert_update('users', $key_values, $key_filter);
                // if(!$uflag)
                //     JSONRES(_ERROR, $umsg);

                // Get Dashboard Access
                $user_group = $this->m_user->get_user_groups(array('username' => $user->username));

                $dashboard_access = !empty(array_filter($user_group, function($arr) {
                    return $arr->dashboard_access == 1 || $arr->special_privilege == 1;
                }));
                $special_access = !empty(array_filter($user_group, function($arr) {
                    return $arr->special_privilege == 1;
                }));

                $user_info = array(
                    'username'          => $user->username,
                    'user_id'           => $user->id,
                    'name'              => $user->name,
                    'email'             => $user->email,
                    'phonenumber'       => $user->phone,
                    // 'address'           => $user->address,
                    'profile_picture'   => $user->profile_picture,
                    'utype'             => $user->utype,
                    // 'app_key'           => $key_values['app_key'],
                    'dashboard_access'  => $dashboard_access,
                    'special_access'    => $special_access
                );

                // Store data to session
                $this->session->set_userdata('user_info', $user_info);
                $addons = array('redirect' => base_url('main/dashboard'));
                return JSONRES(_SUCCESS, sprintf(lang('greetings_login'), $user->name), $addons);
            } else {
                return JSONRES(_ERROR, lang('msg_login_invalid'));
            }
        }

        $this->template->set_template('simple');
        $this->template->write('title', lang('login'), TRUE);
        $this->template->write_view('content', 'dashboard/front/login', array(), true);
        $this->template->render();
    }

    public function logout() {
        $this->_reset_session();
        redirect();
    }

    protected function _reset_session() 
    {
        $this->session->set_userdata('user_info', null);
        $this->session->set_userdata('is_authed', null);
        unset($_SESSION);
    }

}