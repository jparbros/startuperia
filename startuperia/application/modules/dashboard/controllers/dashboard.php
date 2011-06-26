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
		$content['credits'] = $this->dashboard_model->get_credits();
		$content['stock_value'] = $this->dashboard_model->get_stock_value();
		
		$content['portfolio'] = $this->dashboard_model->portfolio();
		$content['pending_orders'] = $this->dashboard_model->pending_orders();

		$data['content'] = $this->load->view('dashboard', $content, TRUE);		

	  return $this->load->view('main_template', $data);
	}
	
    function view_market_summary() {
      $data['content'] = $this->load->view('dashboard/market_summary', array(), true);
      $this->load->view('main_template', $data);
    }
}
?>