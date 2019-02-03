<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Do basic authentication, check the validity of API Key
 * basic auth will be skipped when the project state is in development
 *
 * @param boolean $development Development project status, wheter true or false
 * @return array
 */
function _BASIC_AUTH($development)
{
    $CI = &get_instance();

    $headers = $CI->input->request_headers();

    if($development === true)
        return array('status' => 1, 'key' => '');
    if(empty($headers['authorization']))
        return array('status' => 0, 'key' => '');

    $key = $headers['authorization'];
    $authed = $CI->db->where('key', $key)->get('keys')->num_rows();

    return array('status' => $authed, 'key' => $key);
}

/**
 * Offset query calculation
 *
 * @param integer $limit Limit amount (Showed data per Page), default is 0 (unlimited)
 * @param integer $page Current page value, default is 1
 *
 * @return integer Offset value
 */
function offset_data_calc($limit = 0, $page = 1)
{
    $offset = $limit * ($page-1);

    return $offset;
}