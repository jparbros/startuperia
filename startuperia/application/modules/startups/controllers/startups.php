<?php
class Startups extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('Startup');
  }

  function index(){
    print_r($this->Startup->all_startups());
    //echo $this->Startup->name();
    $this->load->view('index');
  }
}