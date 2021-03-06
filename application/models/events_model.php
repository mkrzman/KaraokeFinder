<?php
class Events_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}



public function get_events($slug = FALSE)
{
	if ($slug === FALSE)
	{
		$query = $this->db->get('events');
		return $query->result_array();
	}

	$query = $this->db->get_where('events', array('slug' => $slug));
	return $query->row_array();
}






}

error_reporting(E_ALL);
ini_set('display_errors', 1);

