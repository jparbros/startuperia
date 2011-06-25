<?php
class Home extends CI_Controller {

	function __construct()
	{
		parent::Controller();	
		$this->load->model('home_model');
	}
	
	function index(){
	  print "Hey";
	}
}
?>
