<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Group Controller
 */
class Order extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model(array(
            'm_group',
            'm_user',
            'm_category',
            'm_product',
            'm_store',
            'm_order',
        ));

        $menu_name = sprintf('%s %s', lang('master'), lang('order'));
        LOAD_NAVBAR($menu_name);
    }

    function index() {
        $this->acl->validate_read();
        $data = array();

        if($this->input->post('submit')) {
            $data['records'] = $this->m_order->get($this->input->post());

            $view = $this->load->view('dashboard/order/list_data', $data, TRUE);
            return LOAD_VIEW($view);
        }

        $this->template->write_view('content', 'dashboard/order/index', $data, TRUE);
        $this->template->render();
    }

    function create() {
        $this->acl->validate_create();
        $data = array();

        if($this->input->post('submit')) {
            unset($_POST['submit']);

            $product = $this->m_product->get(array('id' => $this->input->post('product_id')));
            $category_id = $product->category_id;

            if($product->total <= $_POST['total'])
            {
                return JSONRES(_ERROR, 'Maaf total produk yang tersedia tidak mencukupi, silahkan update jumlah produk', array(), false);
            }
            
            $order = array (
                'product_id'    => $this->input->post('product_id'),
                'category_id'   => $category_id,
                'store_id'      => $this->input->post('store_id'),
                'total'         => $this->input->post('total'),
                'date'          => DATE_FORMAT_($_POST['date'], 'Y-m-d H:i:s'),
            );

            list($iflag, $imsg) = $this->m_general->insert('orders', $order);

            $total_product = $product->total - $this->input->post('total');
            
            $product = array(
                'total'     => $total_product
            );

            list($uflag, $umsg) = $this->m_general->update('product', $product, array('id' => $this->input->post('product_id')));

            return JSONRES($iflag, $imsg);
        }

        $data['product'] = $this->m_product->dropdown_product();
        $data['store'] = $this->m_store->dropdown_store2();
        $view = $this->load->view('dashboard/order/add', $data, TRUE);
        return LOAD_VIEW($view);
    }

    function update($id) {
        $this->acl->validate_update();
        $data = array();

        if($this->input->post('submit')) {
            unset($_POST['submit']);

            $product = $this->m_product->get(array('id' => $this->input->post('product_id')));
            $category_id = $product->category_id;
            
            $data = array (
                'product_id'    => $this->input->post('product_id'),
                'category_id'   => $category_id,
                'store_id'      => $this->input->post('store_id'),
                'total'         => $this->input->post('total'),
            );

            $where = array('id' => $id);

            list($uflag, $umsg) = $this->m_general->update('orders', $data, $where);

            return JSONRES($uflag, $umsg);
        }

        $data['product'] = $this->m_product->dropdown_product();
        $data['store'] = $this->m_store->dropdown_store2();
        $data['record'] = $this->m_order->get(array('id' => $id));
        $view = $this->load->view('dashboard/order/edit', $data, TRUE);
        return LOAD_VIEW($view);
    }

    function delete($id) {
        $this->acl->validate_delete();

        $product = $this->m_order->get(array('id' => $id));
        $product_total = (int)$product->p_total;
        $total_store = (int)$product->total;
        $total_product = $product_total + $total_store;

        $data = array(
            'total' => $total_product
        );

        list($uflag, $umsg) = $this->m_general->update('product', $data, array('id' => $product->product_id));

        $where = array('id' => $id);

        list($dflag, $dmsg) = $this->m_general->delete('orders', $where);

        return JSONRES($dflag, $dmsg);
    }

    function update_dropdown_store($product_id){
        $result = $this->m_store->get_store_product(array('product_id' => $product_id));
        return JSONRES(_SUCCESS, $result);
    }

}