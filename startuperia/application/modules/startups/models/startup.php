<?php

class Startup extends CI_Model {
  
  const companies_url = 'http://api.crunchbase.com/v/1/company/';
  const search_url = 'http://api.crunchbase.com/v/1/search.js';
  const list_entities_url = 'http://api.crunchbase.com/v/1/';
  const image_url = 'http://www.crunchbase.com/';
  const initial_shares = 10000;
  const page_lenght = 20;
  
  protected $startup_data;
  protected $row;
  
  function __construct($startup_name = null) {
    parent::__construct();
    if($startup_name) {
      $this->get_startup($startup_name);
    }
    //$this->load->helper('inflector');
  }
  
  
  public function get_startup($startup_name){
    $this->startup_data = $this->http_get(self::companies_url . $startup_name . ".js");
    $row = $this->exist($startup_name);
    if (!$row) {
      $this->db->insert('startups', array(
        'name' => $this->name,
        'permalink' => $this->permalink, 
        'logo' => self::image_url . $this->image['available_sizes'][0][1], 
        'funding' => $this->funding(),
        'value_per_share' => $this->calculate_price(),
        'shares' => self::initial_shares,
        'available_shares' => self::initial_shares
      )); 
      $this->exist($startup_name);
    }
  }
  
  public function all_startups() {
    
  }
  
  protected function http_get($url, $decode = true) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_PORT, 80);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_BINARYTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_ENCODING , "gzip");
    $respond = curl_exec($curl);
    curl_close($curl);
    return json_decode($respond, $decode);
  }
  
  /*
  /* Check if the startup is in DB
  /* Return a false or the record if exist
  */
  protected function exist($startup_name) {
    $query = $this->db->get_where('startups',array('permalink' => $startup_name));
    if ($query->num_rows() > 0) {
      $this->row = $query->row(0, 'Startup');
      return true;
    } else {
      return false;
    }
  }
  
  public function __get($name) {
    if (array_key_exists($name, $this->startup_data)) {
      return $this->startup_data[$name];
    } elseif (is_object($this->row) && array_key_exists($name, get_object_vars($this->row))){
      return $this->row->$name;
    } elseif ($name == 'long_description'){
      return $this->long_description();
    } elseif ($name == 'todays_change') {
      return $this->todays_change();
    } else {
      return parent::__get($name);
    }
  }
  
  public function get_all_startups() {
    $startups = $this->http_get(self::list_entities_url . 'companies.js');
    foreach($startups as $column) {
      $row = $this->exist($column['permalink']);
      if(!$row){
        $this->get_startup($column['permalink']);
      }
    }
  }
  
  public function funding() {
    $funding = 0;
    foreach($this->funding_rounds as $funding_round) {
      $funding += $funding_round['raised_amount'];
    }
    return $funding;
  }
  
  public function calculate_price(){
    return ($this->funding()/self::initial_shares)/1000;
  }
  
  public function long_description() {
    $overviews = explode('</p>', $this->overview);
    $overview = '';
    while(strlen($overview) <= 800) {
      $overview .=  array_shift($overviews);
    }
    return $overview;
  }
  
  public function month_everage($month, $year){
    $where = array(
      'startups_id =' => $this->id, 
      'created >' => $year.'-'.$month.'-01 00:00:00', 
      'created <=' => $year.'-'.$month.'-31 23:59:59');
    $this->db->where($where);
    $this->db->select_avg('value_per_share');
    $query = $this->db->get('values_history');
    return (is_null($query->row(0)->value_per_share))? 0 : $query->row(0)->value_per_share;
  }
  
  public function avg_last_five_months() {
    $avgs = array();
    for ($i = 1; $i <= 5; $i++) {
      $avgs[date("F", strtotime("-".$i." month") )] = $this->month_everage(date("m", strtotime("-".$i." month") ), date("Y", strtotime("-".$i." month") ));
    }
    return array_reverse($avgs);
  }
  
  public function yesterdays_value(){
    $where = array(
      'startups_id =' => $this->id, 
      'created >' => date("Y-m-d 00:00:00", strtotime("-1 day")), 
      'created <=' => date("Y-m-d 23:59:59", strtotime("-1 day")));
    $this->db->where($where);
    $this->db->select_avg('value_per_share');
    $query = $this->db->get('values_history');
    return (is_null($query->row(0)->value_per_share))? 0 : $query->row(0)->value_per_share;
  }
  
  public function todays_value(){
    $where = array(
      'startups_id =' => $this->id, 
      'created >' => date("Y-m-d 00:00:00"), 
      'created <=' => date("Y-m-d 23:59:59"));
    $this->db->where($where);
    $this->db->select_avg('value_per_share');
    $query = $this->db->get('values_history');
    return (is_null($query->row(0)->value_per_share))? 0 : $query->row(0)->value_per_share;
  }
  
  public function todays_change() {
    return $this->todays_value() - $this->yesterdays_value();
  }
  
}

function cmp($a, $b) {
    if ($a['name'] == $b['name']) {
        return 0;
    }
    return ($a['name'] < $b['name']) ? -1 : 1;
}