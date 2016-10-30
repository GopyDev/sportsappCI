<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pois_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('cookie');
		$this->load->helper('date');
	}

	/**
	 * events
	 *
	 * @return object Events
	 * @author Bandst
	 **/
	public function pois()
	{
		return $this->db->where('status >=', 1)
                            ->order_by("title", "asc")
                            ->get('pois');
	}

	/**
	 * published events
	 *
	 * @return object Events
	 * @author Bandst
	 **/
	public function published_pois()
	{
		return $this->db->where('status', 2)
                            ->order_by("title", "asc")
                            ->get('pois');
	}

	/**
	 * get_pois_users
	 *
	 * @return array
	 * @author Bandst
	 **/
	public function get_pois_users($id)
	{
		return $this->db->select('pois_users.user_id as id, users.username, users.email')
		                ->where('pois_users.poi_id', $id)
		                ->join('users', 'pois_users.user_id=users.id')
		                ->get('pois_users');
	}
	
	public function get_poi($id)
	{
		return $this->db->where('id', $id)
                            ->get('pois');
	}
	
	public function edit_poi($id, $data)
	{
		return $this->db->where('id', $id)
                            ->update('pois', $data);
	}
	
	public function publish($id)
	{
		return $this->db->where('id', $id)
                            ->update('pois', array("status" => 2));
	}
	
	public function unpublish($id)
	{
		return $this->db->where('id', $id)
                            ->update('pois', array("status" => 1));
	}
	
	public function delete($id)
	{
		return $this->db->where('id', $id)
                            ->update('pois', array("status" => 0));
	}
	
	public function create_poi($data, $user_id) {		
		$this->db->insert('pois', $data);
		$poi_id = $this->db->insert_id();
		
		$this->add_to_user($user_id, $poi_id);
		
		return $poi_id;
	}

	/**
	 * add_to_user
	 *
	 * @return bool
	 * @author Bandst
	 **/
	public function add_to_user($user_id, $poi_id)
	{
		$return = 0;
		
		if ($this->db->insert('pois_users', array( 'user_id' => $user_id, 'poi_id' => $poi_id)))
		{
			// Return the number of groups added
			$return += 1;
		}

		return $return;
	}
    
}
