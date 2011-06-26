<?php

class Friends_model extends CI_Model {

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
	
	function all_users(){
  	  $this->db->select('users.id, users.username, users.email, user_profiles.country, user_profiles.website, user_profiles.credits, users.created');
      $this->db->from('users');
      $this->db->join('stocks', 'stocks.users_id = users.id');
      $this->db->join('user_profiles', 'user_profiles.user_id = users.id');
      
      $query = $this->db->get();
      return $query;
	}
	
}
