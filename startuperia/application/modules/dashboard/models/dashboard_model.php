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
    $this->db->join('values_history', 'startups.id = values_history.startups_id');
    $this->db->where('status', 'accepted');
    $this->db->where('users_id', $this->tank_auth->get_user_id());
    $this->db->last_query();
    $query = $this->db->get();

    return $query;
	}
	
	function pending_orders(){
	  $this->db->select('*');
    $this->db->from('startups');
    $this->db->join('orders', 'startups.id = startups_id');
    $this->db->where('status', 'pending');
    $this->db->where('users_id', $this->tank_auth->get_user_id());
    
    $query = $this->db->get();
    
    return $query;
	}
}