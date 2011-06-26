<?php
class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();	
		
		$this->load->model('dashboard_model');
	}
	
	function index(){
	  $content['example'] = "general";
		//$data['content'] = $this->load->view('ajax/orders_accepted', $content, TRUE);
		$content['accepted_orders'] = $this->dashboard_model->accepted_orders();
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