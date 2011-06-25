<?php

class Startup extends CI_Model {
  
  const companies_url = 'http://api.crunchbase.com/v/1/company/';
  const search_url = 'http://api.crunchbase.com/v/1/search.js';
  const list_entities_url = 'http://api.crunchbase.com/v/1/';
  
  protected $startup_data;
  
  function __construct() {
    parent::__construct();
  }
  
  
  public function get_startup($startup_name){
    return $this->startup_data = $this->get(self::companies_url . $startup_name . ".js");
  }
  
  public function all_startups() {
    return $this->get(self::list_entities_url . 'companies.js');
  }
  
  protected function get($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_PORT, 80);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $respond = curl_exec($curl);
    curl_close($curl);
    return json_decode($respond, true);
  }
  
  
  public function __call($name, $arguments) {
    if (array_key_exists($name, $this->startup_data)) {
      return $this->startup_data[$name];
    }
  }
  

}