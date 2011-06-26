<?php
class Startups extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('Startup');
  }

  function index(){
    $this->load->library('pagination');

    $config['base_url'] = 'http://example.com/index.php/test/page/';
    $config['total_rows'] = '200';
    $config['per_page'] = '20'; 

    $this->pagination->initialize($config); 

    echo $this->pagination->create_links();
    
    $content['startups'] = $this->Startup->all_startups();
    $data['content'] = $this->load->view('index', $content, TRUE);
    $this->load->view('main_template', $data);
  }
  
  function show(){
    $url = $_SERVER['REQUEST_URI'];
    $params = explode('/',$url);
    $this->Startup->get_startup($params[2]);
    $content['startup'] = $this->Startup;
    $data['content'] = $this->load->view('show', $content, TRUE);
    $this->load->view('main_template', $data);
  }
  
  function action_get_all_startups() {
    $this->Startup->get_all_startups();
  }
}