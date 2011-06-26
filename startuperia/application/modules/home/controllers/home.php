<?php
class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();	
		$this->load->model('home_model');
		if($this->session->userdata('username'))
    {
			redirect('dashboard');
		}
	}
	
	function index(){
	  $data['content'] = "";
	  $this->load->view('home.php', $data);
	}
}
?>
