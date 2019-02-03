<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'/libraries/REST_Controller.php');

/**
 * Main API Class (Sub Parent Class for another API Controller)
 * extends REST_Controller
 */
class Api extends REST_Controller
{
    protected $limit_default = 0; // Default Limit data (unlimited)

    function __construct()
    {
        parent::__construct();

        // $this->load->library('mailer');

        $is_development = (ENVIRONMENT === 'development');

        // get language encoding
        $lang = $this->uri->segment(2);
        // Set Language
        _LANG_LOADER('general', $lang);

        $is_lang_encoding = strlen($lang) == 2;
        $endpoint = ($is_lang_encoding) ? $this->uri->segment(3) : $lang;

        /**
         * Function to be accessed without authentication
         */
        $skip_auth = array('login', 'register', 'forgot');

        /** 
         * Basic Authentication
         */
        $auth = _BASIC_AUTH($is_development);
        $this->rest->key = $auth['key'];

        if(!in_array($endpoint, $skip_auth)) {
            if($auth['status'] !== 1) {
                $this->_response(
                    FALSE,
                    sprintf(lang('text_rest_invalid_api_key')),
                    REST_Controller::HTTP_FORBIDDEN
                );
            }
        }
    }

    /**
     * Login function and register api key
     */
    function login_post() 
    {
        $http_data = $this->post(null, true);

        $required_data = array('username', 'password');
        $xhr = $this->validate_http_data($http_data, $required_data);

        $this->load->model('m_user');
        $filter = array(
            'username' => $xhr['username'],
            'password' => encrypt($xhr['password'])
        );
        list($flag, $user) = $this->m_user->login($filter);

        if(!empty($user)) {
            if($flag !== true)
                $this->_response(FALSE, $user);

            // Save api key
            // NOTE One user one key
            $key_data = array(
                'username' => $user->username,
                'app_key' => encrypt($user->username.":".$user->id.":".time()),
                'date_created' => time()
            );
            $key_filter = array('username' => $user->username);
            list($flag, $msg) = $this->m_general->insert_update('keys', $key_data, $key_filter);

            if($flag) {
                $user_info = array(
                    'username'          => $user->username,
                    'user_id'           => $user->id,
                    'name'              => $user->name,
                    'email'             => $user->email,
                    'phonenumber'       => $user->phone,
                    // 'address'           => $user->address,
                    'profile_picture'   => $user->profile_picture,
                    'utype'             => $user->utype,
                    'app_key'           => $key_data['app_key']
                );

                $this->_response(TRUE, $user_info);
            } else {
                $this->_response(FALSE, sprintf(lang('something_went_wrong'), $msg));
            }
        } else {
            $this->_response(FALSE, lang('invalid_login'));
        }
    }

    function register_post()
    {
        $http_data = $this->post(null, true);
        $required_data = array('username', 'password', 'email');
        $xhr = $this->validate_http_data($http_data);

        $this->_response(true, 'testing');
    }

    /**
     * Change Password
     */
    function change_password_post()
    {
        $http_data = $this->post(null, true);
        $required_data = array('username', 'old_password', 'new_password');
        $xhr = $this->validate_http_data($http_data);

        // Get User
        $where = array(
            'username' => $xhr['username'],
            'password' => encrypt($xhr['old_password'])
        );
        $users = $this->m_general->get('users', $where, array('result' => 'row'));

        if(!empty($users)) {
            // Update password
            $values = array('password' => encrypt($xhr['new_password']));
            list($flag, $msg) = $this->m_general->update('users', $values, $where);

            if($flag) {
                $this->_response(TRUE, lang('msg_edit_success'));
            } else {
                $this->_response(FALSE, sprintf(lang('something_went_wrong'), $msg));
            }
        } else {
            $this->_response(FALSE, lang('invalid_login'));
        }
    }

    /**
    * Forgot Password
    */

    function forgot_password_post()
    {
        $http_data = $this->post(null, true);
        $required_data = array('email');
        $xhr = $this->validate_http_data($http_data, $required_data);

        $where = array(
            'email' => $xhr['email']
        );

        $options = array(
            'result' => 'row'           
        );

        $email = $this->m_general->get('users', $where, $options);

        if(!empty($email))
        {
            // $new_password = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5);
            // // $new_password = '123456';
            // $message = 
            // "
            // <html>
            //     <body>
            //     your new password <span>{$new_password}</span>   
            //     </body>
            // </html>
            // ";

            // $config = Array(
            //     'protocol' => 'smtp',
            //     'smtp_host' => 'ssl://smtp.googlemail.com',
            //     'smtp_port' => 465,
            //     'smtp_user' => 'stia.software@gmail.com',
            //     'smtp_pass' => 'C424053!',
            //     '_smptp_auth' => TRUE,
            //     'mailtype'  => 'html', 
            //     'charset'   => 'iso-8859-1'
            // );
            // $this->load->library('email', $config);
            // $this->email->set_newline("\r\n");
            
            // // Set to, from, message, etc.
            // $this->email->from('stia.software@gmail.com', 'IBOS Mobile');
            // $this->email->to($xhr['email']); 

            // $this->email->subject('IBOS Change Password');
            // $this->email->message($message);  
            
            // $result = $this->email->send();

            // $result = $this->mailer->sendEmail(
            //     $xhr['email'],
            //     "IBOS Change Password",
            //     $message
            // );

            if($result)
            {
                // var_dump($result);
                // Update password
                $values = array('passw' => encrypt($new_password));
                list($flag, $msg) = $this->m_general->update('users', $values, $where);

                if($flag) {
                    $this->_response(TRUE, lang('msg_edit_success'));
                } else {
                    $this->_response(FALSE, sprintf(lang('something_went_wrong'), $msg));
                }
            }
            else
                $this->_response(FALSE, lang('msg_profile_not_found'));
        }
        else 
            $this->_response(FALSE, lang('msg_profile_not_found'));

    }

    /**
     * Shortcut for Response function inside REST_Controller
     *
     * @param boolean $status Status of Http response
     * @param string/array $messsage Message of Http Response or Response Data
     * @param integer $code Http Code Response
     * @param boolean $continue Continue executing codes after return response
     *
     * @return 
     */
    function _response($status, $message = null, $code = null, $continue = FALSE) {
        if(isset($_ENV['UNIT_TEST']) && $_ENV['UNIT_TEST'] === TRUE)
            $continue = TRUE;

        if(empty($status))
            $status = false;

        if(empty($code))
            $code = REST_Controller::HTTP_OK;

        if(empty($message)) {
            if($status === TRUE) {
                $arr_msg = array('message' => $this->http_status_codes[$code]);
                $message = $arr_msg;
            } else {
                $message = $this->http_status_codes[$code];
            }
        }

        if($status === true && ($code == REST_Controller::HTTP_OK || $code == REST_Controller::HTTP_CREATED)) {
            $response = array(
                'status' => $status,
                'message' => 'OK',
                'data' => $message
            );

            $this->response($response, REST_Controller::HTTP_OK, $continue);
        } else {
            $response = array(
                'status' => $status,
                'message' => $message
            );

            $this->response($response, $code, $continue);
        }
    }

    /**
     * Custom validation for incoming parameters from Http/Https
     *
     * @param string $http_data Received data through Http/Https
     * @param array $required_data Required http data
     *
     * @return object Http data in Array Type
     */
    function validate_http_data($http_data, $required_data = array()) {
        $error = false;

        if(is_array($http_data))
            $datajson = $http_data;
        else
            $datajson = json_decode($http_data);

        // if(count($datajson) == 0) {
        //     $this->_response(FALSE, lang('msg_request_data_empty'), REST_Controller::HTTP_BAD_REQUEST);
        // }

        $data_array = (array)$datajson;
        if(!empty($required_data)) {
            foreach ($required_data as $rd) {
                if(!array_key_exists($rd, $data_array) OR !$this->not_empty($data_array[$rd])) {
                    $error = true;
                    break;
                }
            }
        }

        if($error === true)
            $this->_response(FALSE, sprintf(lang('msg_param_required'), $rd));
        else
            return $data_array;
    }

    private function not_empty($data)
    {
        if(is_array($data)) {
            return count($data) > 0;
        } else {
            $data = trim($data);

            return isset($data) && $data != '';
        }
    }
}