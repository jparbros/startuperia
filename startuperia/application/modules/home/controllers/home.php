<?php
class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();	
		$this->load->model('home_model');
	}
	
	function index(){
	  $this->load->view('main_template');
	}
}
?>
