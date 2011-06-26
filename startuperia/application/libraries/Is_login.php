<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Is_login {

    function __construct()
    {

		$CI =& get_instance();
		$CI->load->library('session');
		$CI->load->library('tank_auth');
	  
    if(!$CI->session->userdata('username'))
    {
			redirect();
		}
    }

	}

?>
