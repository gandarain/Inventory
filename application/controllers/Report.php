<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Group Controller
 */
class Report extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model(array(
            'm_category',
            'm_product',
            'm_store',
            'm_order',
            'm_report'
        ));

        $menu_name = sprintf('%s %s', lang('master'), lang('report'));
        LOAD_NAVBAR($menu_name);
    }

    function index() {
        $this->acl->validate_read();
        $data = array();

        if($this->input->post('submit')) {

            if($_POST['from'] == '' || $_POST['to'] == '')
            {
                return JSONRES(_ERROR, 'Please select Date', array(), false);
            }

            $filter = array(
                'product_id'    => $this->input->post('product_id'),
                'store_id'      => $this->input->post('store_id'),
                'from'          => DATE_FORMAT_($_POST['from'], 'Y-m-d H:i:s'),
                'to'            => DATE_FORMAT_($_POST['to'], 'Y-m-d H:i:s'),
            );
            
            $data['records'] = $this->m_report->get($filter);

            $view = $this->load->view('dashboard/report/list_data', $data, TRUE);
            return LOAD_VIEW($view);
        }

        $data['product'] = $this->m_product->dropdown_product();
        $data['store'] = $this->m_store->dropdown_store2();
        $this->template->write_view('content', 'dashboard/report/index', $data, TRUE);
        $this->template->render();
    }

    function detail_report($id)
    {
        $this->acl->validate_read();
        $data = array();
        $data['record'] = $this->m_report->get(array('id' => $id));
        $view = $this->load->view('dashboard/report/detail', $data, TRUE);
        return LOAD_VIEW($view);
    }

}