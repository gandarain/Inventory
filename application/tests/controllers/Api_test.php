<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Test Class for Api Controller
 */
class Api_test extends TestCase
{
    protected $api_key;

    public function setUp()
    {

    }

    public function test_login_post()
    {
        /**
         * Empty Params
         */
        $expected = '"status":false,"message":';
        $login_param = array();
        $output = $this->request('POST', 'api/login', $login_param);
        $this->assertContains($expected, $output);
        /**
         * Wrong username or password
         */
        $expected = '"status":false,"message":';
        $login_param = array('username' => 'testing', 'password' => 'testing');
        $output = $this->request('POST', 'api/login', $login_param);
        $this->assertContains($expected, $output);

        /**
         * Login Success
         */
        // $expected = '"status":true,"message":"OK"';
        // $login_param = array(
        //     'username' => 'BOS-A000000',
        //     'password' => '12345'
        // );
        // $output = $this->request('POST', 'api/login', $login_param);
        // $this->assertContains($expected, $output);

        $login_data = json_decode($output);
        $this->api_key = $login_data->data->key;
    }

    public function test_register_post()
    {
        $expected = '"status":true';
        $regist_params = array(
            'username' => 'Testing',
            'password' => '123456',
            'email'     => 'ajul@mail.com'
        );

        $output = $this->request('POST', 'api/register', $regist_params);
        $this->assertContains($expected, $output);
    }
}