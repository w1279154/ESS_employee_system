<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authentication extends CI_Controller {

	public function __construct()
    {
            parent::__construct();
            $this->load->model('user_model');
			$this->load->helper('form');
			$this->load->helper('url');
		
    } //end construct
	
	
	public function index()
	{
		$data['login'] = 0;
		//VIEW_LOAD
		$this->load->view('login', $data);
		
	} //END INDEX
	
	public function logout()
	{
		$this->user_model->delete_session();
		redirect("http://{$_SERVER['HTTP_HOST']}/w1279154/");
	}

	public function auth()
	{
		$data['username'] = $this->input->post('username');
		$data['password'] = $this->input->post('password');
		
		//print_r ($data);
		
		$result = $this->user_model->user_auth($data);
		
		//print_r ($result['session']);
		
		//$this->load->view('login');
		if ($result['check'] == true)
		{
			redirect("http://{$_SERVER['HTTP_HOST']}/w1279154/index.php/hr/index");		
		} //END IF
		else if($result['check'] == false) {
			$data['login'] = 1;
			$this->load->view('login', $data);			
		}
		
		//print_r ($this->session->userdata('login'));
	} //END AUTH

	public function auth_remove_employee()
	{
		$data['username'] = $this->input->post('username');
		$data['password'] = $this->input->post('password');

		$result = $this->user_model->user_auth($data);	

		if ($result['check'] == true)
		{
			redirect("http://{$_SERVER['HTTP_HOST']}/w1279154/index.php/hr/remove_employee_complete");
		} //END IF
		else if($result['check'] == false) {
			$this->load->view('auth_failed');
			$this->user_model->delete_session();
		}
		
	} //END AUTH

	public function auth_move_employee()
	{
		$data['username'] = $this->input->post('username');
		$data['password'] = $this->input->post('password');
		$new_dept = $this->input->post('new_dept');

		$this->session->set_flashdata('new_dept', $new_dept);

		$result = $this->user_model->user_auth($data);	

		if ($result['check'] == true)
		{
			redirect("http://{$_SERVER['HTTP_HOST']}/w1279154/index.php/hr/move_employee_complete");
		} //END IF
		else if($result['check'] == false) {
			$this->load->view('auth_failed');
			$this->user_model->delete_session();		
		}
		
	} //END AUTH

	public function auth_promote_employee()
	{
		$data['username'] = $this->input->post('username');
		$data['password'] = $this->input->post('password');
		$dept_no = $this->input->post('dept_no');

		$this->session->set_flashdata('dept_no', $dept_no);

		$result = $this->user_model->user_auth($data);	

		if ($result['check'] == true)
		{
			redirect("http://{$_SERVER['HTTP_HOST']}/w1279154/index.php/hr/promote_employee_complete");
		} //END IF
		else if($result['check'] == false) {
			$this->load->view('auth_failed');
			$this->user_model->delete_session();
		}
		
	} //END AUTH

	public function auth_demote_employee()
	{
		$data['username'] = $this->input->post('username');
		$data['password'] = $this->input->post('password');
		$emp_no = $this->input->post('emp_no');
		$new_title = $this->input->post('title');
		


		$this->session->set_flashdata('emp_no', $emp_no);
		$this->session->set_flashdata('title', $new_title);

		$result = $this->user_model->user_auth($data);	

		if ($result['check'] == true)
		{
			redirect("http://{$_SERVER['HTTP_HOST']}/w1279154/index.php/hr/demote_employee_complete");
		} //END IF
		else if($result['check'] == false) {
			$this->load->view('auth_failed');
			$this->user_model->delete_session();		
		}
		
	} //END AUTH


	public function auth_change_salary()
	{
		$data['username'] = $this->input->post('username');
		$data['password'] = $this->input->post('password');
		$emp_no = $this->input->post('emp_no');
		$new_salary = $this->input->post('salary');

		$this->session->set_flashdata('emp_no', $emp_no);
		$this->session->set_flashdata('salary', $new_salary);

		$result = $this->user_model->user_auth($data);	

		if ($result['check'] == true)
		{
			redirect("http://{$_SERVER['HTTP_HOST']}/w1279154/index.php/hr/change_salary_complete");
		} //END IF
		else if($result['check'] == false) {
			$this->load->view('auth_failed');
			$this->user_model->delete_session();		
		}

	} //END AUTH

	public function auth_change_title()
	{
		$data['username'] = $this->input->post('username');
		$data['password'] = $this->input->post('password');
		
		$emp_no = $this->input->post('emp_no');
		$new_title = $this->input->post('title');

		$this->session->set_flashdata('emp_no', $emp_no);
		$this->session->set_flashdata('title', $new_title);

		$result = $this->user_model->user_auth($data);	

		if ($result['check'] == true)
		{
			redirect("http://{$_SERVER['HTTP_HOST']}/w1279154/index.php/hr/change_title_complete");
		} //END IF
		else if($result['check'] == false) {
			$this->load->view('auth_failed');
			$this->user_model->delete_session();		
		}

	} //END AUTH

	public function auth_change_company_salary()
	{
		$data['username'] = $this->input->post('username');
		$data['password'] = $this->input->post('password');
		$percent = $this->input->post('percentage');

		$this->session->set_flashdata('percentage', $percent);

		$result = $this->user_model->user_auth($data);	

		if ($result['check'] == true && $result['username'] == "hr_manager")
		{
			redirect("http://{$_SERVER['HTTP_HOST']}/w1279154/index.php/hr_manager/change_company_salary_complete");
		} //END IF
		else if($result['check'] == false) {
			$this->load->view('auth_failed');
			$this->user_model->delete_session();		
		}
		
	} //END AUTH 
} //END CLASS