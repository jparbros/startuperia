<?php
class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();	
		$this->load->library('is_login');
		$this->load->model('dashboard_model');
	}
	
	function index(){
	    $user_id = ($this->uri->segment(2)!==false)?$this->uri->segment(2):$this->tank_auth->get_user_id();
		
	    $content['example'] = "general";

		$content['companies_owned'] = $this->dashboard_model->get_startups();
		$content['credits'] = $this->dashboard_model->get_credits($user_id);
		$content['stocks_value'] = $this->dashboard_model->get_stock_value($user_id);
		
		$content['portfolio'] = $this->dashboard_model->portfolio($user_id);
		$content['pending_orders'] = $this->dashboard_model->pending_orders($user_id);
        $content['method'] = $method = ($this->uri->segment(2)===false)?'logged':'get';
		$data['content'] = $this->load->view('dashboard', $content, TRUE);		

	  return $this->load->view('main_template', $data);
	}
	
}
?>