<?php

class Dashboard_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	function get_credits($user_id){
	  $this->db->select("credits");
	  $this->db->from("user_profiles");
      $this->db->where('user_id', $user_id);

	  $query = $this->db->get();
	  $result = $query->result();
      return $result[0]->credits;
	}
	
	function get_stock_value($user_id){
      $this->db->select('SUM(total_value) as stocks_value');
      $this->db->from('stocks');
      $this->db->where('stocks.users_id', $user_id);
      
      $query = $this->db->get();
      $result = $query->result();
      return $result[0]->stocks_value;
	}
	
	function get_startups($user_id){
	  $this->db->select("count(*) as startups");
	  $this->db->from("startups");
	  $this->db->join("stocks", "stocks.startups_id=startups.id");
	  $this->db->where('stocks.users_id', $user_id);
	  $query = $this->db->get();
	  $result=$query->result();
	  return $result[0]->startups;
	}
	
	function portfolio($user_id){
    $this->db->select('name, symbol, startups.value_per_share as vps, SUM(stocks.shares) as total_shares, sum(total_value) as value');
    $this->db->from('startups');
    $this->db->join('stocks', 'startups.id = stocks.startups_id');
    $this->db->where('stocks.users_id', $user_id);
    $this->db->group_by('users_id, name');
    
    $query = $this->db->get();
    return $query;
	}
	
	function pending_orders($user_id){
	  $this->db->select('*');
    $this->db->from('startups');
    $this->db->join('orders', 'startups.id = startups_id');
    $this->db->where('status', 'pending');
    $this->db->where('users_id', $user_id);
    
    $query = $this->db->get();
    return $query;
	}
}