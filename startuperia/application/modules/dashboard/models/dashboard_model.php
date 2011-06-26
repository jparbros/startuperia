<?php

class Dashboard_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	function accepted_orders(){
    $this->db->select('*');
    $this->db->from('startups');
    $this->db->join('orders', 'startups.id = startups_id');
    //$this->db->where('status', 'accepted');
    
    $query = $this->db->get();
    return $query;
	}
	
	function pending_orders(){
	  $this->db->select('*');
    $this->db->from('startups');
    $this->db->join('orders', 'startups.id = startups_id');
    $this->db->where('status', 'pending');
    
    $query = $this->db->get();
    
    return $query;
	}
}