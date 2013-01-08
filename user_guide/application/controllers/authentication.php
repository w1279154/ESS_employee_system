<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authentication extends CI_Controller {

	public function __construct()
    {
            parent::__construct();
            $this->load->model('user_model');  //loads model
			$this->load->helper('form');	//loads form helper
			$this->load->helper('url');		//loads url helper
		
    } //end construct
	
	/**************************************************************************************************************************************
	*	INDEX
	***************************************************************************************************************************************/
	public function index()
	{
		$data['login'] = 0;
		//VIEW_LOAD
		$this->load->view('login', $data);
		
	} //END INDEX
	

	/**************************************************************************************************************************************
	*	LOGOUT
	***************************************************************************************************************************************/

	public function logout()
	{
		$this->user_model->delete_session();  //DELETES SESSION
		redirect("http://{$_SERVER['HTTP_HOST']}/w1279154/");  //REDIRECTS TO BASE URL
	}

	/**************************************************************************************************************************************
	*	AUTHENTICATION CLASS
	***************************************************************************************************************************************/

	public function auth()
	{
		$data['username'] = $this->input->post('username');  //GRABS USERNAME INPUT
		$data['password'] = $this->input->post('password');  //GRABS PASSWORD INPUT
		
		$result = $this->user_model->user_auth($data); //CALLS USER_AUTH MODEL AND SENDS PASSWORD AND USER FOR VALIDATION
		
		if ($result['check'] == true)  //TRUE MEANS PASSWORD AND USER IS CORRECT
		{
			redirect("http://{$_SERVER['HTTP_HOST']}/w1279154/index.php/hr/index");		//REDIRECTS TO HR CONTROLLER INDEX WHICH IS THE MAIN MENU
		} //END IF
		else if($result['check'] == false) {
			$data['login'] = 1;		//GIVES VIEW INFO ABOUT WHAT MESSAGE TO DISPLAY
			$this->load->view('login', $data); //LOADS LOGIN VIEW
		} //END ELSE IF

	} //END AUTH

	/**************************************************************************************************************************************
	*	AUTHENTICATION FOR REMOVE EMPLOYEE
	***************************************************************************************************************************************/

	public function auth_remove_employee()
	{
		$data['username'] = $this->input->post('username');  //GRABS USERNAME INPUT
		$data['password'] = $this->input->post('password');	 //GRABS PASSWORD INPUT

		$result = $this->user_model->user_auth($data);	//AUTHENTICATES USER

		if ($result['check'] == true) 
		{
			redirect("http://{$_SERVER['HTTP_HOST']}/w1279154/index.php/hr/remove_employee_complete");  //REDIRECTS TO REMOVE EMPLOYEE COMPLETE
		} //END IF
		else if($result['check'] == false) {
			$this->load->view('auth_failed');  //AUTHENTICATION FAILED PAGE
			$this->user_model->delete_session();  //DELETES SESSIONS FOR SECURITY
		} //END ELSE IF
		
	} //END AUTH

	/**************************************************************************************************************************************
	*	AUTHENTICATION FOR MOVE EMPLOYEE
	***************************************************************************************************************************************/

	public function auth_move_employee()
	{
		$data['username'] = $this->input->post('username');
		$data['password'] = $this->input->post('password');
		$new_dept = $this->input->post('new_dept');  //GETS NEW DEPT NAME

		$this->session->set_flashdata('new_dept', $new_dept);  //SETS DEPT TO FLASHDATA

		$result = $this->user_model->user_auth($data);

		if ($result['check'] == true)
		{
			redirect("http://{$_SERVER['HTTP_HOST']}/w1279154/index.php/hr/move_employee_complete");
		} //END IF
		else if($result['check'] == false) {
			$this->load->view('auth_failed');
			$this->user_model->delete_session();		
		}//END ELSE IF
		
	} //END AUTH

	/**************************************************************************************************************************************
	*	AUTHENTICATION FOR PROMOTE EMPLOYEE
	***************************************************************************************************************************************/

	public function auth_promote_employee()
	{
		$data['username'] = $this->input->post('username');
		$data['password'] = $this->input->post('password');
		$dept_no = $this->input->post('dept_no');

		$this->session->set_flashdata('dept_no', $dept_no);  //SETS FLASHDATA TO DEPT NUMBER

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

	/**************************************************************************************************************************************
	*	AUTHENTICATION FOR DEMOTE EMPLOYEE
	***************************************************************************************************************************************/

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

	/**************************************************************************************************************************************
	*	AUTHENTICATION FOR CHANGE SALARY
	***************************************************************************************************************************************/

	public function auth_change_salary()
	{
		$data['username'] = $this->input->post('username');
		$data['password'] = $this->input->post('password');
		
		$emp_no = $this->input->post('emp_no'); //GETS EMPLOYEE NUMBER
		$new_salary = $this->input->post('salary');  //GETS NEW SALARY

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

	/**************************************************************************************************************************************
	*	AUTHENTICATION FOR CHANGE TITLE
	***************************************************************************************************************************************/

	public function auth_change_title()
	{
		$data['username'] = $this->input->post('username');
		$data['password'] = $this->input->post('password');
		
		$emp_no = $this->input->post('emp_no'); //GETS EMPLOYEE NUMBER
		$new_title = $this->input->post('title'); //GETS NEW TITLE

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

	/**************************************************************************************************************************************
	*	AUTHENTICATION FOR CHANGE COMPANY SALARY
	***************************************************************************************************************************************/

	public function auth_change_company_salary()
	{
		$data['username'] = $this->input->post('username');
		$data['password'] = $this->input->post('password');
		$percent = $this->input->post('percentage'); //GETS THE PERCENTAGE

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