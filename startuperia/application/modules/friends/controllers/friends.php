<?php
class Friends extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('is_login');
		$this->load->model('Friends_model');
	}
	
	function index(){
      $content['users'] = $this->Friends_model->all_users();
	  $data['content'] = $this->load->view('friends/all', $content, true);
      $this->load->view('main_template', $data);
	}
}
?>
