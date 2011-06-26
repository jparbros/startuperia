<?php

class Search_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	function search_startups(){
	  $this->db->from("startups");
	  
	  if ($this->session->userdata('q_startups') != NULL)
		{
			$this->db->like('name', $this->session->userdata('q_startups')); 
		}
		
		$this->db->distinct();
		$this->db->limit(15, $offset);
		$query = $this->db->get();
		print $this->db->last_query();
		
		return $query;
	}
}