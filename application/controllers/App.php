<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* This is App Controller
*/
class App extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		// $this->template->write_view('sidenavs', 'template/default_sidenavs', true);
		// $this->template->write_view('navs', 'template/default_topnavs.php', true);
		// $this->template->set_template('webcring');
		// $this->load->model('M_member');
	}	

	function index() {
		$this->dashboard();
	}

	function simple_template() {
		$this->template->set_template('default');
		$this->template->write('header', 'This is Header');
		$this->template->write('title', 'My Simple Template', TRUE);
		$this->template->write_view('content', 'tes/mypage', '', true);

		$this->template->render();
	}

	function dashboard() {
		LOAD_NAVBAR('Dashboard');
		$this->template->write_view('content', 'tes/dashboard', '', true);

		$this->template->render();
	}

	function form_ex() {
		LOAD_NAVBAR('Form Example');
		$this->template->write('header', 'This is Header', true);
		$this->template->write_view('content', 'tes/form', '', true);

		$this->template->render();
	}

	function table_ex() {
		LOAD_NAVBAR('Table Example');
		$this->template->write('header', 'Table <small>Some examples</small>', true);
		$this->template->write_view('content', 'tes/table', '', true);

		$this->template->render();

	}
	function table_dyn_ex() {
		LOAD_NAVBAR('Table Dynamics Example');
		$this->template->write('header', 'Table Dynamics <small>Some examples</small>', true);
		$this->template->write_view('content', 'tes/table_dynamic', '', true);

		$this->template->render();

	}
}