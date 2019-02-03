<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* This is App Controller
*/
class App extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(array(
			'm_user'
		));
		// $this->template->write_view('sidenavs', 'template/default_sidenavs', true);
		// $this->template->write_view('navs', 'template/default_topnavs.php', true);
		// $this->template->set_template('webcring');
		// $this->load->model('M_member');
	}	

	function index() {
		$this->dashboard();
	}

	function login() {
		$submit = $this->input->post('submit');

		if($submit) {
			$this->form_validation->set_rules('username', lang('username'), 'required');
			$this->form_validation->set_rules('password', lang('password'), 'required');

			if($this->form_validation->run() !== TRUE) {
				return JSONRES(_ERROR, validation_errors());
			}

			$filter = array(
				'username' => $this->input->post('username'),
				'password' => encrypt($this->input->post('password'))
			);
			list($flag, $user) = $this->m_user->login($filter);

			if(!empty($user)) {
				if($flag !== true)
					return JSONRES(_ERROR, $user);

				// Store data to session
				$this->session->set_userdata('user_info', (array)$user);
				$addons = array('redirect' => base_url('app/dashboard'));
				return JSONRES(_SUCCESS, sprintf(lang('greetings_login'), $user->name), $addons);
			} else {
				return JSONRES(_ERROR, lang('msg_login_invalid'));
			}
		}

		$this->template->set_template('simple');
		$this->template->write('title', lang('login'), TRUE);
		$this->template->write_view('content', 'dashboard/front/login', array(), true);
		$this->template->render();
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