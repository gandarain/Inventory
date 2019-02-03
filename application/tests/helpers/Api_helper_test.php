<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Test Case Class
 */
class Api_helper_test extends TestCase
{
    private $login = array(
        'username' => 'BOS-A000000',
        'password' => '12345'
    );

    public function setUp()
    {
    }

    public function test_offset_data_calc()
    {
        $expected = 20;
        $actual = offset_data_calc(10, 3);
        $this->assertEquals($expected, $actual);
    }

    public function test_basic_auth()
    {
        $this->request->setHeader('Authorization', 'testing');
        /**
         * Skip Basic Auth
         */
        $expected = array('status' => 1, 'key' => '');
        $actual = _BASIC_AUTH(true);
        $this->assertEquals($expected, $actual);
        /**
         * Do Wrong Basic Auth
         */
        $expected = array('status' => 0, 'key' => 'testing');
        $actual = _BASIC_AUTH(false);
        $this->assertEquals($expected, $actual);
    }
}