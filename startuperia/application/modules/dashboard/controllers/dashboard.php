<?php
class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();	
		$this->load->library('is_login');
		$this->load->model('dashboard_model');
	}
	
	function index(){
	  $content['example'] = "general";

		$content['companies_owned'] = $this->dashboard_model->get_startups();
		$content['portfolio'] = $this->dashboard_model->portfolio();
		$content['pending_orders'] = $this->dashboard_model->pending_orders();

		$data['content'] = $this->load->view('dashboard', $content, TRUE);		

	  return $this->load->view('main_template', $data);
	}
}
?>