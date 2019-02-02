<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function escape_user_id($str)
{
    return str_replace('%20',' ',$str);
}
