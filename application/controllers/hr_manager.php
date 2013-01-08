<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hr_manager extends CI_Controller {

	/*******************
	*	CONSTRUCT CLASS
	********************/
	public function __construct()
    {
            parent::__construct();
            $this->login_check();
            $this->load->model('hr_manager_model');
			$this->load->helper('form');
			$this->load->helper('cookie');
			$this->load->helper('date');
    } //END_CONSTRUCT

    /*******************
	*	LOGIN CHECK
	********************/
	public function login_check(){
    	
    	//print_r ($this->session->userdata('login'));
		$session = $this->session->userdata('login');

    	if ($session['logged_in'] != '1' || $session['username'] != 'hr_manager')
			{
				redirect("https://{$_SERVER['HTTP_HOST']}/w1279154/index.php/authentication");
			}
			else {
				echo('<div align="right">Logged in as '.$session['username'].', <a class="button_logout" id="auth" onClick="logout()">Logout</a></div>');
			}	
    }

     /**************************************************************************************************************************************
	*	RETURN DATE
	***************************************************************************************************************************************/
	public function date_now()
	{
		$datestring = "%Y-%m-%d";
		$time = time();
		$date = mdate($datestring, $time);
		return $date;
	}

    /*******************
	*	INDEX
	********************/
    public function index()
	{
	$this->load->view('default_head');
		$this->load->view('hr_menu');
		
	} //END_INDEX
	
	/***********************************
	*   CHANGE ORGANISATIONAL SALARY   
	************************************/

	public function change_company_salary_menu()
	{
		$this->load->view('default_head');
		$this->load->view('change_company_salary_menu');

	}//END_CHANGE_SALARY

	/***********************************
	*   CHANGE WHOLE COMPANY SALARY   
	************************************/

	public function change_company_salary()
	{

		$this->load->view('default_head');
		$this->load->view('change_company_salary');

	}//end change
	public function change_company_salary_complete()
	{
		/*
			->get all emp_no's with to_date = 9999-01-01
			->foreach (emp_no)
				->update salary by x amount

			Note: if salary has been changed today it will
			result in error so make sure you do 
			from_date != $now
			
			when calculating percentage, i.e. 10% times by 1.1
		*/

			$now = $this->date_now();

			$percent = $this->session->flashdata('percentage');

			$change_cent = ($percent)/100;
			$new_cent = $change_cent + 1; 	

			


			$this->hr_manager_model->change_company_salary_complete($new_cent, $now);

			$this->load->view('default_head');
		$this->load->view('change_company_salary_complete');

	}//END_CHANGE_SALARY


	
}//END_CLASS