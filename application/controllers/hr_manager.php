<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hr_manager extends CI_Controller {

	/*******************
	*	CONSTRUCT CLASS
	********************/
	public function __construct()
    {
            parent::__construct();
            $this->login_check();
            $this->load->model('ess_model');
			$this->load->helper('form');
			$this->load->helper('cookie');
    } //END_CONSTRUCT

    /*******************
	*	LOGIN CHECK
	********************/

    public function login_check(){
    	
    	print_r ($this->session->userdata('login'));
		$session = $this->session->userdata('login');

    	if ($session['logged_in'] != '1')
			{
				redirect('authentication/index');
			}	
    }

    /*******************
	*	INDEX
	********************/
    public function index()
	{
		
	
	} //END_INDEX
	
	/***********************************
	*   CHANGE ORGANISATIONAL SALARY   
	************************************/

	public function change_company_salary()
	{


	}//END_CHANGE_SALARY

	
}//END_CLASS