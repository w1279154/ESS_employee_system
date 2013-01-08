<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Find_employee extends CI_Controller {

	public function __construct()
    {
            parent::__construct();
             $this->login_check();
            $this->load->model('ess_model');
			$this->load->helper('form');
			$this->load->helper('cookie');
			//$this->load->library('pagination');
    } //end construct
	
	  /**************************************************************************************************************************************
	*	LOGIN CHECK
	***************************************************************************************************************************************/
//"https://{$_SERVER['HTTP_HOST']}/w1279154/index.php/authentication"
    public function login_check(){
    	
    	//print_r ($this->session->userdata('login'));
		$session = $this->session->userdata('login');

    	if ($session == null || !$session)
			{
				echo("<div align='right'>No User Logged in, <a href='https://".$_SERVER['HTTP_HOST']."/w1279154/index.php/authentication' class='button_logout' id='auth'>Login</a></div>");
				
			}
			else if ($session['logged_in'] == '1') {
				echo('<div align="right">Logged in as '.$session['username'].', <a class="button_logout" id="auth" onClick="logout()">Logout</a></div>');
			}	
    }

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
		$data_header['options_dept'] = $this->ess_model->dept_name_options();
		
		//sending title_names
		$data_header['options_title'] = $this->ess_model->title_options();
		
		//view_load
		$this->load->view('default_head');
		$this->load->view('search_header', $data_header);
		//print_r ($data_header);
	}//end index
	

	
	public function reset_search(){
		delete_cookie("emp_no");
		delete_cookie("first_name");
		delete_cookie("last_name");
		delete_cookie("title");
		delete_cookie("department");
		
		redirect('find/index');
		}
	
	
	public function search_submit(){
			
			setCookie('emp_no',$this->input->get('emp_no'));
			setCookie('firstname',$this->input->get('firstname'));
			setCookie('lastname',$this->input->get('lastname'));
			setCookie('jobtitle',$this->input->get('jobtitle'));
			setCookie('dept',$this->input->get('dept'));
			
	//	redirect('find/findemp');
	}
	
	public function findemp($sort_by = 'emp_no', $sort_order = 'asc' , $offset = 0)
	{
		$limit = 1000;
		
		/*
			setCookie('emp_no',$this->input->get('emp_no'));
			setCookie('firstname',$this->input->get('firstname'));
			setCookie('lastname',$this->input->get('lastname'));
			setCookie('jobtitle',$this->input->get('jobtitle'));
			setCookie('dept',$this->input->get('dept'));
	*/
		
		
		$data_search['emp_no'] = $this->input->get('emp_no');
		$data_search['first_name'] = $this->input->get('firstname');
		$data_search['last_name'] = $this->input->get('lastname');
		$data_search['title'] = $this->input->get('jobtitle');
		$data_search['department'] = $this->input->get('dept');
				
		$data['fields'] = array(
				'emp_no' => 'ID',
		//		'birth_date' => 'DOB',
				'first_name' => 'First Name',
				'last_name' => 'Last Name',
		//		'gender' => 'Gender',
				'last_name' => 'Last Name',
		//		'hire_date' => 'Hire Date',
				'title' => 'Title',
		//		'salary' => 'Salary (£)',
				'dept_name' => 'Department'
						
		);

		//call results
	 	$results = $this->ess_model->search($limit, $offset, $sort_by, $sort_order, $data_search);		
	
		
		/******************************/
		
		//passing the data
		$data['employees'] = $results['rows'];
		$data['num_results'] = $results['num_rows'];
		
		//passing sort information
		$data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;
				
		/*
		//pagination
		$config = array();
		$config['base_url'] = site_url("ess_controller/search/$sort_by/$sort_order");
		$config['total_rows'] = $data['num_results'];
		$config['per_page'] = $limit;
		$config['uri_segment'] = 5;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		*/	
			
		//echo (json_encode($data));	

		//view load
		$this->index();
		$this->load->view('search_results', $data);
		

	}//end search

}//end class
	

