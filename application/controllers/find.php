<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Find extends CI_Controller {

	public function __construct()
    {
            parent::__construct();
            $this->load->model('find_model');
			$this->load->helper('form');
			$this->load->helper('cookie');
		
    } //end construct
	

	public function index()
	{
		//get cookies
		$data_header['emp_no'] = $this->input->get('emp_no');
		$data_header['firstname'] = $this->input->get('firstname');
		$data_header['lastname'] = $this->input->get('lastname');
		$data_header['jobtitle'] = $this->input->get('jobtitle');
		$data_header['dept'] = $this->input->get('dept');	
		
		//print_r ($data_header);
		
		//sending department_names
		$data_header['options_dept'] = $this->find_model->dept_name_options();
		
		//sending title_names
		$data_header['options_title'] = $this->find_model->title_options();
		
		//login
		  	
		$session = $this->session->userdata('login');  

		//view_load
		$this->load->view('default_head', $session);
		$this->load->view('search_header', $data_header);
		//print_r ($data_header);
	}//end index
	

	
	
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
				
	

		echo (json_encode($data));	

	}//end search

}//end class
	

