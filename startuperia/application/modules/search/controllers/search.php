<?php
class Search extends CI_Controller {

	function __construct()
	{
		parent::__construct();	
		$this->load->model('search_model');
		$this->load->model('Startups/Startup');
	}
	
	function view_startups(){
    $q = $this->input->post('q_startups');
	  //$q = "Twitter";
	  redirect(base_url() . 'startups/show/'.$q);
	  /*if ($q)
		{
			$this->session->set_userdata('q_startups', $q);
		}
		else
		{
			$this->session->set_userdata('q_startups', NULL);
		}
		//print $q;
		//print $this->session->userdata('q_startups');
		$this->Startup->get_startup($this->session->userdata('q_startups'));
    $content['startup'] = $this->Startup;
    //$content['startup'] = '';
		$data['content'] = $this->load->view('show', $content, TRUE);
    $this->load->view('main_template', $data);
    */
    
	}

}