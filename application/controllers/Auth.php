<?php

/**
 * 
 */
class Auth extends MY_Controller
{
	protected $access = 'yes';
	function __construct() {
        parent::__construct();
        $this->load->model('Users_model');
        $this->load->model('Country_model');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('session');
        //convert date custom helper that i use to convert date in view file
        $this->load->helper('test');
    }

    public function index()
    {
        $this->form_validation->set_rules('email','Email','required|valid_email');
        $this->form_validation->set_rules('password','Password','required');

        if($this->form_validation->run() == false){
            $this->load->view("auth");
        }else{
            $email = $this->input->post('email');
            $password = md5($this->input->post('password'));

            $check_login = $this->Users_model->check_login($email,$password);
            //echo '<pre>'; print_r($check_login); exit;
            if (empty($check_login)) {
                
                $this->session->set_flashdata('error','Invalid E-mail or Password');
                redirect(base_url().'auth');
            }else{
                
                $check_login['logged_in'] = true;
                $this->session->set_userdata($check_login);
                $this->session->set_flashdata('success','Successfully logged in..');
                redirect(base_url().'users');
            }
            
        }
    }


}