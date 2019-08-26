<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Group Controller
 */
class Percentage extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model(array(
            'm_group',
            'm_user',
            'm_store',
            'm_percentage'
        ));

        $menu_name = sprintf('%s', lang('percentage'));
        LOAD_NAVBAR($menu_name);
    }

    function index() {
        $this->acl->validate_read();
        $data = array();

        $total_store_acl = $this->m_percentage->count_store();
        $total_store_acl = $total_store_acl->total;
        
        $store = $this->m_percentage->get();
        
        foreach($store as $index => $item) {
            $data[$index] = $this->m_percentage->count_store_acl(array('store_id' => $item->id));
        };
        
        foreach($data as $index => $item) {
            $item->total = round($item->total / $total_store_acl * 100, 0);
        };

        $data['records'] = $data;

        $this->template->write_view('content', 'dashboard/percentage/index', $data, TRUE);
        $this->template->render();
    }

    function order() {
        $this->acl->validate_read();
        $data = array();

        $all_store = $this->m_percentage->get();
        $order = $this->m_percentage->get_order();

        $total_order = $this->m_percentage->count_all_order2();
        $total_order = $total_order->total;

        $order_store = array();
        foreach($all_store as $index => $item) {
            $order_store[$index] = $this->m_percentage->count_store_in_order(array('store_id' => $item->id));
        };

        foreach($order_store as $index => $item) {
            $item->total = round($item->total / $total_order * 100, 0);
        };

        $data['records'] = $order_store;

        $this->template->write_view('content', 'dashboard/percentage/order', $data, TRUE);
        $this->template->render();
    }

}