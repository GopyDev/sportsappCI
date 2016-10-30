<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->model('pois_model');
	}

    /**
     * This is the dashboard controller for the admin panel.
     */
	public function index() {
		$this->data['title'] = "Dashboard";
		$this->data['description'] = "This is the admin panel for the Events, Details and Map App Template on Codecanyon";
		$this->data['keywords'] = "admin, panel, codecanyon, app, template, details, map, events";
		$this->data['section'] = "dashboard";
        
        if (!$this->ion_auth->logged_in()) { // user is logged in
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		} else {
			$this->data['users_count'] = count($this->ion_auth->users()->result());
			$this->data['user'] = $this->ion_auth->user()->row();
			
			//list the events
			$this->data['events'] = $this->pois_model->pois()->result();
			$this->data['events_count'] = count($this->data['events']);
			
			$this->_render_page('dashboard', $this->data);
        }
	}

	function _render_page($view, $data=null, $returnhtml=false)//I think this makes more sense
	{
		$this->output->set_template('admin');
		$this->output->set_common_meta($data["title"], $data["description"], $data["keywords"]);
		$this->load->css('assets/css/bootstrap.min.css');
		$this->load->css('assets/css/bootstrap-responsive.min.css');
		$this->load->css('assets/css/font-awesome.css');
		$this->load->css('assets/css/ol.css');
		$this->load->css('assets/css/style.css');
		$this->load->css('assets/css/pages/dashboard.css');
		$this->load->js('assets/js/jquery.min.js');
		$this->load->js('assets/js/bootstrap.min.js');
		$this->load->js('assets/js/signin.js');
		$this->load->js('assets/js/ol.js');

		$this->viewdata = (empty($data)) ? $this->data: $data;

		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);

		if ($returnhtml) return $view_html;//This will return html on 3rd argument being true
	}
}
