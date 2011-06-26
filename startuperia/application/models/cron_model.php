<?php

class Cron_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	function get_all_startups(){
	  $query = $this->db->query('SELECT * FROM startups;');
	  $result = $query->result();
	  return $result;
	}
	
	function get_buy_volume($id){
	  $this->db->select('SUM(quantity) AS buy_volume');
      $this->db->from('orders');
      $this->db->where('startups_id', $id);
      $this->db->where('status', 'accepted');
      $this->db->where('type', 'buy');
      $query = $this->db->get();
	  $result = $query->result();
	  return ($result[0]->buy_volume)?$result[0]->buy_volume:0;
	}
	
	function get_sell_volume($id){
	  $this->db->select('SUM(quantity) AS sell_volume');
      $this->db->from('orders');
      $this->db->where('startups_id', $id);
      $this->db->where('status', 'accepted');
      $this->db->where('type', 'sell');
	  $query = $this->db->get();
      $result = $query->result();
	  return ($result[0]->sell_volume)?$result[0]->sell_volume:0;
	}
	
    public function set_new_value($id, $new_value){
          $this->db->insert(
          	'values_history',
            array(
              'startups_id' => $id,
              'value_per_share' => $new_value,
             )
           );
           $this->db->where('id', $id);
           $this->db->update('startups', array('value_per_share' => $new_value) ); 
    }
}
