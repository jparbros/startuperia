<?php
class Cron extends CI_Controller {

	function __construct()
	{
		parent::__construct();	
		$this->load->model('Cron_model');
		if($_SERVER['HTTP_HOST']!='localhost'){
		  die();
		}
	}
	
	function update_values() {
	  $startups = $this->Cron_model->get_all_startups();
	  $total = count($startups);
	  for($x=0;$x<$total;$x++) {
	    $buy_volume = $this->Cron_model->get_buy_volume($startups[$x]->id);
	    $sell_volume = $this->Cron_model->get_sell_volume($startups[$x]->id);
	    $difference = $buy_volume - $sell_volume;
	    $change = 0.001 * $difference;
	    $new_value = $startups[$x]->value_per_share - $change;
	    if ($change!=0) {
	      $this->Cron_model->set_new_value($startups[$x]->id, $new_value);
	    };
	    echo "{$startups[$x]->name}: {$startups[$x]->value_per_share} -> $new_value ($change)\n"; 
	  }
	}
	
	function upddfgate_values(){
	    $user_id = ($this->uri->segment(2)!==false)?$this->uri->segment(2):$this->tank_auth->get_user_id();
		
	    $content['example'] = "general";

		$content['companies_owned'] = $this->dashboard_model->get_startups($user_id);
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