<?php

/**
 * 
 */
class MY_Controller extends CI_Controller
{
	
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
        $this->login_check();
	}

	public function login_check()
	{	

		if($this->access == 'yes'){

			if($this->session->userdata("logged_in")){

				redirect("users");
			}
		}else{
			if(!$this->session->userdata("logged_in")){

				redirect("auth");
			}
		}



	}
}