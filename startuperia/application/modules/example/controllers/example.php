<?php
class Example extends CI_Controller {

	function __construct()
	{
		parent::__construct();	
		$this->load->model('example_model');
	}
	
	function index(){
	  print "Hey asas";
	}
	
	function view_general(){
    $content = "general";
	  $data['extra_heading'] = "<script src='".base_url()."js/modules/example/example.js' type='text/javascript'></script>\n";
		$data['content'] = $this->load->view('ajax/example', $content, TRUE);
		
	  return $this->load->view('main_template', $data);
	}
	
	function action_general(){
	  $data['resp'] = "{'successMsg' : '<span>Titulo</span><p>salvado</p>'}";	  
	  return $this->load->view('resp_json', $data);
	}
	
	function ajax_general(){
	  $data['example'] = "via ajax";
	  return $this->load->view('ajax/example', $data);
	}
}
?>
