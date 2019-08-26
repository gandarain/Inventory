<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Group Controller
 */
class Product extends CI_Controller
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
        ));

        $menu_name = sprintf('%s %s', lang('master'), lang('product'));
        LOAD_NAVBAR($menu_name);
    }

    function index() {
        $this->acl->validate_read();
        $data = array();

        if($this->input->post('submit')) {
            $data['records'] = $this->m_product->get_data($this->input->post());

            $view = $this->load->view('dashboard/product/list_data', $data, TRUE);
            return LOAD_VIEW($view);
        }

        $this->template->write_view('content', 'dashboard/product/index', $data, TRUE);
        $this->template->render();
    }

    function create() {
        $this->acl->validate_create();
        $data = array();

        if($this->input->post('submit')) {
            unset($_POST['submit']);

            $data = $this->m_product->check_category_name($this->input->post('name'));
            
            if(isset($data) && !$data){
                $product = array (
                    'name'          => $this->input->post('name'),
                    'description'   => $this->input->post('description'),
                    'category_id'   => $this->input->post('category_id'),
                    'total'         => $this->input->post('total'),
                    'price'         => $this->input->post('price')
                );

                list($iflag, $imsg) = $this->m_general->insert('product', $product);
                
                $product_id = $this->db->insert_id();
                $store_id = $this->input->post('store_id');
                foreach ($store_id as $store) {
                    $store_acl = array(
                        'product_id'    => $product_id,
                        'store_id'      => $store
                    );
                    list($iflag, $imsg) = $this->m_general->insert('store_acl', $store_acl);
                }

                return JSONRES($iflag, $imsg);
            } else {
                return JSONRES(_ERROR, lang('error_name') , array(), false);
            }
        }
        $data['category'] = $this->m_category->dropdown_category();
        $data['store'] = $this->m_store->dropdown_store();
        $view = $this->load->view('dashboard/product/add', $data, TRUE);
        return LOAD_VIEW($view);
    }

    function update($id) {
        $this->acl->validate_update();
        $data = array();

        if($this->input->post('submit')) {
            unset($_POST['submit']);

            // delete old data
            $where_store_acl = array('product_id' => $id);
            list($uflag, $umsg) = $this->m_general->delete('store_acl', $where_store_acl);

            $where = array('id' => $id);
            $product = array (
                'name'          => $this->input->post('name'),
                'description'   => $this->input->post('description'),
                'category_id'   => $this->input->post('category_id'),
                'total'         => $this->input->post('total'),
                'price'         => $this->input->post('price')
            );
            list($uflag, $umsg) = $this->m_general->update('product', $product, $where);

            $store_id = $this->input->post('store_id');
            foreach ($store_id as $store) {
                $store_acl = array(
                    'product_id' => $id,
                    'store_id'=> $store
                );
                list($uflag, $umsg) = $this->m_general->insert('store_acl', $store_acl);
            }

            return JSONRES($uflag, $umsg);
        }

        $data['record'] = $this->m_product->get_data(array('id' => $id));
        $data['category'] = $this->m_category->dropdown_category();
        $data['store'] = $this->m_store->dropdown_store();
        $data['assigned_to'] = $this->m_store->get_store_acl($id);
        $view = $this->load->view('dashboard/product/edit', $data, TRUE);
        return LOAD_VIEW($view);
    }

    function delete($id) {
        $this->acl->validate_delete();

        $where = array('id' => $id);
        list($dflag, $dmsg) = $this->m_general->delete('product', $where);

        $product_id = array('product_id' => $id);
        list($uflag, $umsg) = $this->m_general->delete('store_acl', $product_id);

        return JSONRES($dflag, $dmsg);
    }

    function increase_product($id) {
        $this->acl->validate_update();
        $data = array();

        if($this->input->post('submit')) {
            unset($_POST['submit']);

            $add_product = $this->input->post('total');
            $current_product = $this->m_product->get_total_product(array('id' => $id));
            $total_product = $current_product->total + $add_product;

            $product = array(
                'total'     => $total_product
            );

            list($uflag, $umsg) = $this->m_general->update('product', $product, array('id' => $id));

            return JSONRES($uflag, $umsg, array(), true);
        }

        $data['record'] = $this->m_product->get_data(array('id' => $id));
        $view = $this->load->view('dashboard/product/increase', $data, TRUE);
        return LOAD_VIEW($view);
    }

    function decrease_product($id) {
        $this->acl->validate_update();
        $data = array();

        if($this->input->post('submit')) {
            unset($_POST['submit']);

            $add_product = $this->input->post('total');
            $current_product = $this->m_product->get_total_product(array('id' => $id));
            $total_product = $current_product->total - $add_product;

            $product = array(
                'total'     => $total_product
            );

            list($uflag, $umsg) = $this->m_general->update('product', $product, array('id' => $id));

            return JSONRES($uflag, $umsg, array(), true);
        }

        $data['record'] = $this->m_product->get_data(array('id' => $id));
        $view = $this->load->view('dashboard/product/decrease', $data, TRUE);
        return LOAD_VIEW($view);
    }

}