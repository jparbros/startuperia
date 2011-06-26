<?php
class Orders extends CI_Controller {

	function __construct()
	{
		parent::__construct();	
		$this->load->model('orders_model');
	}
	
	function view_list(){
	  $content['example'] = "general";
		$data['content'] = $this->load->view('ajax/list', $content, TRUE);
		
	  return $this->load->view('main_template', $data);
	}
	
	function action_buy(){
	  $startup = strtolower($this->orders_model->buy());
		if ($startup)
		{
		  redirect('/startups/'.$startup);
    }
    
	}
}
?>