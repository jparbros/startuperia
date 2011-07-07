<?php
class Startups extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->library('is_login');
    $this->load->model('Startup');
  }

  function index(){
    $this->load->library('pagination');
    
    $url = $_SERVER['REQUEST_URI'];
    $params = explode('=',$url);
    if(empty($params[1])) {
      $params[1] = 0;
    }
    $content['startups'] = $this->Startup->all_startups($params[1]);    

    $config['base_url'] = base_url() . 'startups?';
    $config['total_rows'] = $this->Startup->all_startups_size;
    $config['per_page'] = $this->Startup->page_lenght; 
    $config['page_query_string'] = TRUE;

    $this->pagination->initialize($config); 

    $content['pagination_links'] = $this->pagination->create_links();
    
    
    $data['content'] = $this->load->view('index', $content, TRUE);
    $this->load->view('main_template', $data);
  }
  
  function show(){
    $url = $_SERVER['REQUEST_URI'];
    $params = explode('/',$url);
    $this->Startup->get_startup($params[3]);
    $content['startup'] = $this->Startup;
    $data['content'] = $this->load->view('show', $content, TRUE);
    $this->load->view('main_template', $data);
  }
  
  function search() {
    if($this->Startup->search($_POST['q_startup'])) {
      redirect(base_url() . 'startups/show/'.$_POST['q_startup']);
    } else {
      
    }
  }
  
  function get_all_startups() {
    for ($i = 1; $i <= 1000; $i++) {
      $this->Startup->all_startups($i*20);
    }
  }
  
}