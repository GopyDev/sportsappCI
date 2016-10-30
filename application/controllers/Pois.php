<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pois extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->model('pois_model');
		$this->load->helper(array('url','language'));

		$this->form_validation->set_error_delimiters("", "<br/>");
	}

	// redirect if needed, otherwise display the user list
	function index()
	{
		$this->data['title'] = "Events";
		$this->data['description'] = "This is the admin panel for the Events, Details and Map App Template on Codecanyon";
		$this->data['keywords'] = "admin, panel, codecanyon, app, template, details, map, events";
		$this->data['section'] = "pois";

		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		else
		{
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['user'] = $this->ion_auth->user()->row();
			
			//list the events
			$this->data['events'] = $this->pois_model->pois()->result();
			foreach ($this->data['events'] as $k => $event)
			{
				$this->data['events'][$k]->users = $this->pois_model->get_pois_users($event->id)->result();
			}

			$this->output->set_template('admin');
			$this->_render_page('pois/index', $this->data);
		}
	}

	// redirect if needed, otherwise display the user list
	function index_json()
	{
		$this->data['data']['events'] = $this->pois_model->published_pois()->result();
		
		$this->_json_out('json/api', $this->data);
	}

	// create a new poi
	function create_poi()
    {
		$this->data['title'] = "Create Event";
		$this->data['description'] = "This is the admin panel for the Events, Details and Map App Template on Codecanyon";
		$this->data['keywords'] = "admin, panel, codecanyon, app, template, details, map, events";
		$this->data['section'] = "pois";

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }

        // validate form input
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('lat', 'Latitude', 'trim|required|decimal');
        $this->form_validation->set_rules('lng', 'Longitude', 'trim|required|decimal');
        $this->form_validation->set_rules('url', 'Url', 'trim|prep_url');
        $this->form_validation->set_rules('email', 'E-mail', 'trim|valid_email');
        $this->form_validation->set_rules('brief_description', 'Short description', 'trim|max_length[160]');
		
        if ($this->form_validation->run() == true)
        {
            $poi_data = array(
                'title' 				=> $this->input->post('title'),
                'lat'  					=> $this->input->post('lat'),
                'lng'    				=> $this->input->post('lng'),
                'brief_description'		=> $this->input->post('brief_description'),
                'description'			=> $this->input->post('description'),
                'address'				=> $this->input->post('address'),
                'phone'					=> $this->input->post('phone'),
                'email'					=> $this->input->post('email'),
                'url'					=> $this->input->post('url'),
                'start_date_time'		=> $this->input->post('start_date_time'),
                'end_date_time'			=> $this->input->post('end_date_time'),
            );
        }
		
		$this->data["user"] = $this->ion_auth->user()->row();
		
        if ($this->form_validation->run() == true && $this->pois_model->create_poi($poi_data, $this->data["user"]->id))
        {
            // check to see if we are creating the user
            // redirect them back to the admin page
            $this->session->set_flashdata('message', "Event created succesfully");
            redirect("pois", 'refresh');
        }
        else
        {
            // display the create user form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));

            $this->data['poititle'] = array(
                'name'  => 'title',
                'id'    => 'title',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('title'),
            );
            $this->data['lat'] = array(
                'name'  => 'lat',
                'id'    => 'lat',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('lat'),
            );
            $this->data['lng'] = array(
                'name'  => 'lng',
                'id'    => 'lng',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('lng'),
            );
            $this->data['brief_description'] = array(
                'name'  => 'brief_description',
                'id'    => 'brief_description',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('brief_description'),
            );
            $this->data['description'] = array(
                'name'  => 'description',
                'id'    => 'description',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('description'),
            );
            $this->data['address'] = array(
                'name'  => 'address',
                'id'    => 'address',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('address'),
            );
            $this->data['phone'] = array(
                'name'  => 'phone',
                'id'    => 'phone',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('phone'),
            );
            $this->data['email'] = array(
                'name'  => 'email',
                'id'    => 'email',
                'type'  => 'email',
                'value' => $this->form_validation->set_value('email'),
            );
            $this->data['url'] = array(
                'name'  => 'url',
                'id'    => 'url',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('url'),
            );
            $this->data['start_date_time'] = array(
                'name'  => 'start_date_time',
                'id'    => 'start_date_time',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('start_date_time'),
            );
            $this->data['end_date_time'] = array(
                'name'  => 'end_date_time',
                'id'    => 'end_date_time',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('end_date_time'),
            );
			
			$this->output->set_template('admin');
            $this->_render_page('pois/create_poi', $this->data);
        }
    }
	

	// edit a poi
	function edit_poi($id)
	{
		$this->data['title'] = "Edit Event";
		$this->data['description'] = "This is the admin panel for the Events, Details and Map App Template on Codecanyon";
		$this->data['keywords'] = "admin, panel, codecanyon, app, template, details, map, events";
		$this->data['section'] = "pois";

		if (!$this->ion_auth->logged_in())
		{
			redirect('auth', 'refresh');
		}

		$this->data["user"] = $this->ion_auth->user()->row();
		
		$poi = $this->pois_model->get_poi($id)->row();
		$this->data["event"] = $poi;

		// validate form input
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('lat', 'Latitude', 'trim|required|decimal');
        $this->form_validation->set_rules('lng', 'Longitude', 'trim|required|decimal');
        $this->form_validation->set_rules('url', 'Url', 'trim|prep_url');
        $this->form_validation->set_rules('email', 'E-mail', 'trim|valid_email');
        $this->form_validation->set_rules('brief_description', 'Short description', 'trim|max_length[160]');

		if (isset($_POST) && !empty($_POST))
		{

			if ($this->form_validation->run() === TRUE)
			{
				$poi_data = array(
					'title' 				=> $this->input->post('title'),
					'lat'  					=> $this->input->post('lat'),
					'lng'    				=> $this->input->post('lng'),
					'brief_description'		=> $this->input->post('brief_description'),
					'description'			=> $this->input->post('description'),
					'address'				=> $this->input->post('address'),
					'phone'					=> $this->input->post('phone'),
					'email'					=> $this->input->post('email'),
					'url'					=> $this->input->post('url'),
					'start_date_time'		=> $this->input->post('start_date_time'),
					'end_date_time'			=> $this->input->post('end_date_time'),
				);

				// check to see if we are updating the user
				if($this->pois_model->edit_poi($poi->id, $poi_data))
			    {
			    	// redirect them back to the admin page if admin, or to the base url if non admin
				    $this->session->set_flashdata('message', 'Event updated succesfully');
				    redirect('event/'.$poi->id, 'refresh');
			    }
			    else
			    {
			    	// redirect them back to the admin page if admin, or to the base url if non admin
				    $this->session->set_flashdata('message', 'Error updating event' );
				    redirect('event/'.$poi->id, 'refresh');

			    }

			}
		}

		// display the edit user form
		$this->data['csrf'] = $this->_get_csrf_nonce();

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));

		$this->data['poititle'] = array(
			'name'  => 'title',
			'id'    => 'title',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('title', $poi->title),
		);
		$this->data['lat'] = array(
			'name'  => 'lat',
			'id'    => 'lat',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('lat', $poi->lat),
		);
		$this->data['lng'] = array(
			'name'  => 'lng',
			'id'    => 'lng',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('lng', $poi->lng),
		);
		$this->data['brief_description'] = array(
			'name'  => 'brief_description',
			'id'    => 'brief_description',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('brief_description', $poi->brief_description),
		);
		$this->data['description'] = array(
			'name'  => 'description',
			'id'    => 'description',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('description', $poi->description),
		);
		$this->data['address'] = array(
			'name'  => 'address',
			'id'    => 'address',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('address', $poi->address),
		);
		$this->data['phone'] = array(
			'name'  => 'phone',
			'id'    => 'phone',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('phone', $poi->phone),
		);
		$this->data['email'] = array(
			'name'  => 'email',
			'id'    => 'email',
			'type'  => 'email',
			'value' => $this->form_validation->set_value('email', $poi->email),
		);
		$this->data['url'] = array(
			'name'  => 'url',
			'id'    => 'url',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('url', $poi->url),
		);
		$this->data['start_date_time'] = array(
			'name'  => 'start_date_time',
			'id'    => 'start_date_time',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('start_date_time', $poi->start_date_time),
		);
		$this->data['end_date_time'] = array(
			'name'  => 'end_date_time',
			'id'    => 'end_date_time',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('end_date_time', $poi->end_date_time),
		);


		$this->output->set_template('admin');
		$this->_render_page('pois/edit_poi', $this->data);
	}

	// publish the poi
	function publish($id)
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth', 'refresh');
		}
		
		$this->pois_model->publish($id);

		$this->session->set_flashdata('message', 'Event published succesfully');
		redirect("pois", 'refresh');
	}

	// unpublish the poi
	function unpublish($id)
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth', 'refresh');
		}
		
		$this->pois_model->unpublish($id);

		$this->session->set_flashdata('message', 'Event unpublished succesfully');
		redirect("pois", 'refresh');
	}

	// delete the event
	function delete($id = NULL)
	{
		$this->data['title'] = "Delete event";
		$this->data['description'] = "This is the admin panel for the Events, Details and Map App Template on Codecanyon";
		$this->data['keywords'] = "admin, panel, codecanyon, app, template, details, map, events";
		$this->data['section'] = "users";
		
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}

		$id = (int) $id;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', 'Confirm', 'required');
		$this->form_validation->set_rules('id', 'Id', 'required|alpha_numeric');

		if ($this->form_validation->run() == FALSE)
		{
			// insert csrf check
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['event'] = $this->pois_model->get_poi($id)->row();

			$this->data["user"] = $this->ion_auth->user()->row();
			
			$this->output->set_template('admin');

			$this->_render_page('pois/delete_poi', $this->data);
		}
		else
		{
			// do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes')
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
				{
					show_error($this->lang->line('error_csrf'));
				}

				// do we have the right userlevel?
				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
				{
					$this->pois_model->delete($id);
					$this->session->set_flashdata('message', 'Event deleted succesfully');
				}
			}

			// redirect them back to the auth page
			redirect('pois', 'refresh');
		}
	}


	function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
			$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function _render_page($view, $data=null, $returnhtml=false)//I think this makes more sense
	{
		$this->output->set_common_meta($data["title"], $data["description"], $data["keywords"]);
		$this->load->css('assets/css/bootstrap.min.css');
		$this->load->css('assets/css/bootstrap-theme.min.css');
		$this->load->css('assets/css/font-awesome.css');
		$this->load->css('assets/css/bootstrap-wysihtml5.css');
		$this->load->css('assets/css/jquery.datetimepicker.css');
		$this->load->css('assets/css/ol.css');
		$this->load->css('assets/css/style.css');
		if ($view=='auth/login' || $view=='auth/forgot_password') {
			$this->load->css('assets/css/pages/signin.css');
		} else {
			$this->load->css('assets/css/pages/dashboard.css');
		}
		$this->load->js('assets/js/jquery.min.js');
		$this->load->js('assets/js/bootstrap.min.js');
		$this->load->js('assets/js/signin.js');
		$this->load->js('assets/js/wysihtml5.min.js');
		$this->load->js('assets/js/bootstrap-wysihtml5.min.js');
		$this->load->js('assets/js/ol.js');
		$this->load->js('assets/js/jquery.datetimepicker.full.min.js');

		$this->viewdata = (empty($data)) ? $this->data: $data;

		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);

		if ($returnhtml) return $view_html;//This will return html on 3rd argument being true
	}

	function _json_out($view, $data=null)//I think this makes more sense
	{
		$this->viewdata = (empty($data)) ? $this->data: $data;

		$view_html = $this->load->view($view, $this->viewdata);
	}

}
