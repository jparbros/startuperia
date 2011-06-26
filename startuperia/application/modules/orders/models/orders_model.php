<?php

class Orders_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	function buy(){
	  //print_r($_POST);
	  $startup = $_POST['startup'];
	  $query = $this->db->get_where('startups', array('name' => $startup));
	  $result = $query->result();
	  $startup_id = $result[0]->id;
	  $available_shares = $result[0]->available_shares - $_POST['shares'];

	  if ($startup_id)
		{
		  $data = array(
  	    'startups_id' => $startup_id,
  	    'users_id' => $this->tank_auth->get_user_id(),
  	    'value' => number_format($_POST['price'],2,'.',','),
  	    'quantity' => $_POST['shares'],
  	    'type' => 'buy',
  	    'status' => 'accepted'
  	  );

  	  $this->db->insert('orders', $data);
  	  unset($data);
  	  
  	  $data = array(
  	    'available_shares' => $available_shares
  	  );
  	  
  	  $this->db->where('id', $startup_id);
  	  $this->db->update('startups', $data);
  	  
  	  $this->stocks($startup_id);
  	  //print $this->db->last_query();
  	  return $startup;
		}else{
		  return false;
		}
	  
	}
	
	function stocks($startup_id){
	  //$this->db->from('st');
	  $user_id = $this->tank_auth->is_logged_in();
    $stocks = $this->create_stocks($startup_id, $user_id);

	  $query = $this->db->get_where('stocks', array('startups_id' => $startup_id, 'users_id' =>$user_id));
	  //print $this->db->last_query();
	  //print_r($query);
	  $stocks_user = $query->result();
	  
	  $data = array(
      'startups_id' => $startup_id,
      'users_id' => $user_id,
      'shares' => $stocks['shares'],
      'total_value' => $stocks['total_value']
    );
    
    //print_r($stocks_user);
	  if(!$stocks_user[0]->id and isset($stocks_user)){
	    $this->db->insert('stocks', $data);
	  }else{
	    $data = array(
        'shares' => $stocks['shares'],
        'total_value' => $stocks['total_value']
      );
	    $this->db->update('stocks', $data);
	  }
	}
	
	function create_stocks($startup_id, $user_id){
	  $this->db->select("SUM(value) as total_value, SUM(quantity) as shares");
	  $query = $this->db->get_where('orders', array('startups_id' => $startup_id, 'users_id' =>$user_id));
	  $this->db->last_query();
	  $results = $query->result();
	  $total_value = $results[0]->total_value;
	  $shares = $results[0]->shares;
	  //print_r($results);
	  
	  return array('shares' => $shares, 'total_value' => $total_value);
	}
	
	
}