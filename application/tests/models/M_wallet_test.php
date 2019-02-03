<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class M_wallet_test extends TestCase
{
    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->model('m_wallet');
        $this->obj = $this->CI->m_wallet;
    }

    public function test_wallet_confirm_get()
    {
        $expected = 2;
        $actual = $this->obj->myfunction();

        $this->assertEquals($expected, $actual);
    }
}