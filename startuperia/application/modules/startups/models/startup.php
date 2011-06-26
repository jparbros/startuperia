<?php

class Startup extends CI_Model {
  
  const companies_url = 'http://api.crunchbase.com/v/1/company/';
  const search_url = 'http://api.crunchbase.com/v/1/search.js';
  const list_entities_url = 'http://api.crunchbase.com/v/1/';
  const image_url = 'http://www.crunchbase.com/';
  const page_lenght = 20;
  
  protected $startup_data;
  
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
      $images = $this->image;
      $this->db->insert('startups', array('name' => $this->name,'permalink' => $this->permalink, 'logo' => self::image_url . $images['available_sizes'][0][1])); 
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
      $query->row(0, 'Startup');
    } else {
      return false;
    }
  }
  
  public function __get($name) {
    if (array_key_exists($name, $this->startup_data)) {
      return $this->startup_data[$name];
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
  
}

function cmp($a, $b) {
    if ($a['name'] == $b['name']) {
        return 0;
    }
    return ($a['name'] < $b['name']) ? -1 : 1;
}