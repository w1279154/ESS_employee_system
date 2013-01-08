<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Find extends CI_Controller {

	public function __construct()
    {
            parent::__construct();
            $this->load->model('find_model');
			$this->load->helper('form');
			$this->load->helper('cookie');
		
    } //end construct
	
	/**************************************************************************************************************************************
	*	FIND INDEX
	***************************************************************************************************************************************/

	public function index()
	{
		//get cookies
		$data_header['emp_no'] = $this->input->get('emp_no'); //SENDS ENTERED EMPLOYEE NUMBER FROM GET
		$data_header['firstname'] = $this->input->get('firstname'); //SENDS ENTERED FIRSTNAME FROM GET
		$data_header['lastname'] = $this->input->get('lastname'); //SENDS ENTERED LASTNAME FROM GET
		$data_header['jobtitle'] = $this->input->get('jobtitle'); //SENDS ENTERED JOBTITLE FROM GET
		$data_header['dept'] = $this->input->get('dept');	//SENDS ENTERED DEPT FROM GET

		
		//sending department_names
		$data_header['options_dept'] = $this->find_model->dept_name_options();
		
		//sending title_names
		$data_header['options_title'] = $this->find_model->title_options();
		
		//login_DETAILS
		$session = $this->session->userdata('login');  

		//view_load
		$this->load->view('default_head', $session); //LOADS HEADER
		$this->load->view('search_header', $data_header); //LOADS SEARCH HEADER
		//print_r ($data_header);
	}//end index
	
	/**************************************************************************************************************************************
	*	FIND EMPLOYEES
	***************************************************************************************************************************************/
	
	
	public function findemp()
	{

		$data_search['emp_no'] = $this->input->get('emp_no');
		$data_search['first_name'] = $this->input->get('firstname');
		$data_search['last_name'] = $this->input->get('lastname');
		$data_search['title'] = $this->input->get('jobtitle');
		$data_search['department'] = $this->input->get('dept');
				
		//call results
	 	$results = $this->find_model->search($data_search);		
	
		
		/******************************/
		
		//passing the data
		$data['count'] = $results['num_rows'];
		$data['results'] = $results['rows'];
				
	

		echo (json_encode($data));	//ECHOS JSON ENCODED RESULTS FOR THE SEARCH TOOL

	}//end search

}//end class
	

