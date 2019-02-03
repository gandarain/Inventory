<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Main Controller
 */
class Main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->acl->getMySession();
    }

    public function index() {
    	$this->dashboard();
    }

    public function dashboard() {
        $this->acl->has_dashboard_access();
        LOAD_NAVBAR('Dashboard');
        $this->template->write_view('content', 'tes/dashboard', '', true);

        $this->template->render();
    }

    public function simple_template() {
        $this->template->set_template('default');
        $this->template->write('header', 'This is Header');
        $this->template->write('title', 'My Simple Template', TRUE);
        $this->template->write_view('content', 'tes/mypage', '', true);

        $this->template->render();
    }

    public function form_ex() {
        LOAD_NAVBAR('Form Example');
        $this->template->write('header', 'This is Header', true);
        $this->template->write_view('content', 'tes/form', '', true);

        $this->template->render();
    }

    public function table_ex() {
        LOAD_NAVBAR('Table Example');
        $this->template->write('header', 'Table <small>Some examples</small>', true);
        $this->template->write_view('content', 'tes/table', '', true);

        $this->template->render();

    }
    public function table_dyn_ex() {
        LOAD_NAVBAR('Table Dynamics Example');
        $this->template->write('header', 'Table Dynamics <small>Some examples</small>', true);
        $this->template->write_view('content', 'tes/table_dynamic', '', true);

        $this->template->render();

    }
}