<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hr extends CI_Controller {
	/**************************************************************************************************************************************
	*	GLOBAL VARIBLES
	***************************************************************************************************************************************/
	public $employee_no;

	public function set($data)
	{
		$this->employee_no = setCookie('emp_no',$data);	
	}

	public function get()
	{
		$this->employee_no = $this->input->cookie('emp_no', TRUE);;
	}
	/**************************************************************************************************************************************
	*	CONSTRUCT CLASS
	**************************************************************************************************************************************/
	public function __construct()
    {
            parent::__construct();
            $this->login_check();
            $this->load->model('hr_model');
			$this->load->helper('date');
			$this->load->helper('form');
			$this->load->helper('cookie');
			$this->get();

    } //END_CONSTRUCT
   
    /**************************************************************************************************************************************
	*	LOGIN CHECK
	***************************************************************************************************************************************/

    public function login_check(){
    	
    	//print_r ($this->session->userdata('login'));
		$session = $this->session->userdata('login');

    	if ($session['logged_in'] != '1')
			{
				redirect('authentication/index');
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

    /**************************************************************************************************************************************
	*	INDEX
	***************************************************************************************************************************************/
    public function index()
	{
		$this->load->view('default_head');
		$this->load->view('hr_menu');
	
	} //END_INDEX

	/**************************************************************************************************************************************
	*	REMOVE EMPLOYEE
	***************************************************************************************************************************************/
	public function remove_employee_search()
	{
		$data['search'] = 1;
		$this->load->view('default_head');
		$this->load->view('remove_employee_search', $data);

	} //END_REMOVE_EMPLOYEE_SEARCH

	public function remove_employee()
	{
		$data['emp_no'] = $this->input->post('emp_no');

		$this->set($data['emp_no']);
		
		$result = $this->hr_model->remove_search($data);
		$data['employee'] = $result['rows'];
		
		//print ("Controller".$result['is_manager']);

		if ($result['is_manager'] > 0)
		{
			$data['is_manager'] = "TRUE";
		}
		else $data['is_manager'] = "FALSE";
		//print ("Controller".$data['is_manager']);

		if ($result['num_rows'] != 1)
			{
				$data['search'] = 0;
				$this->load->view('default_head');
				$this->load->view('remove_employee_search', $data);
			}
		else
		{
		$this->load->view('default_head', $data);
		$this->load->view('remove_employee', $data);
			}
	} //END_REMOVE_EMPLOYEE

	public function remove_employee_complete()
	{
		$emp_no=$this->employee_no;
		$now = $this->date_now();
		//print $now;
		//echo ($emp_no);
		$this->hr_model->remove_employee($emp_no, $now);

		$this->load->view('default_head');
		$this->load->view('remove_employee_complete');
		
	}


	/**************************************************************************************************************************************
	*	ADD EMPLOYEE
	***************************************************************************************************************************************/
	public function add_employee_view()
	{
		$data['emp_no'] = $this->hr_model->new_emp_number();
		$data['options_dept'] = $this->hr_model->dept_name_options();
		$data['options_title'] = $this->hr_model->title_options();
		
		$this->load->view('default_head');
		$this->load->view('add_employee', $data);
	} // ADD_EMPLOYEE_MENU


	public function add_employee()
	{
		/*  

		------>>>ALL FIELDS MANDATORY<<<----------

		-----------EMPLOYEES TABLES-------------
		-> ADD EMP_NUMBER USING SELECT_MAX() OPERATOR +1
		-> ADD FIRST NAME
		-> ADD LAST NAME
		-> ADD BIRTHDAY   //MAKE SURE BIRTHDAY IS NOT OLDER DEN CURRENT DATE
		-> ADD GENDER
		-> ADD HIRE DATE   //MAKE SURE HIRE DATE IS NOW?
		
		-----------SALARY TABLES-------------
		-> EMP_NO [FK]
		-> ADD SALARY

		-----------TITLE TABLES-------------
		-> EMP_NO [FK]
		-> ADD TITLE

		-----------DEPT_EMP TABLES-------------
		-> EMP_NO [FK]
		-> ADD DEPT_NUMBER


		>>>>>>>>>>>IF MANAGER<<<<<<<<<<<<<<<<<<<<<<
		-----------DEPT_MANAGER TABLES-------------
		-> EMP_NO [FK]
		-> ADD DEPT_NUMBER


		*/

		$now = $this->date_now();
		
		/* EMPLOYEES TABLE */
		$data['birth_date'] = $this->input->post('birth_date');
		$data['first_name'] = $this->input->post('first_name');
		$data['last_name'] = $this->input->post('last_name');
		$data['gender'] = $this->input->post('gender');
		$data['hire_date'] = $now;
  		
  		/* SALARIES TABLE  */
  		$data['salary'] = $this->input->post('salary');
  		$data['from_date'] = $now;
  		$data['to_date'] = "9999-01-01";

  		/* TITLES TABLE    */
  		$data['title'] = $this->input->post('title');
		
  		/* DEPT_EMP TABLE  */
  		$data['dept_no'] = $this->input->post('dept_no');


		$this->hr_model->add_employee($data);
		
		$this->load->view('default_head');
		$this->load->view('add_employee_complete');
	}//END_ADD_EMPLOYEE

	/*****************************************************************************************************************************************
	*	MOVE EMPLOYEE DEPT SEARCH
	******************************************************************************************************************************************/

	public function move_employee_search()
	{
				$data['search'] = 1;
				$this->load->view('default_head');
				$this->load->view('move_employee_search', $data);
	} //END MOVE_EMPLOYEE_SEARCH

	/*****************************************************************************************************************************************
	*	MOVE EMPLOYEE DEPT DISPLAY DETAILS
	******************************************************************************************************************************************/

	public function move_employee()
	{
		/*FIND OUT WHICH DEPARTMENT EMPLOYEE WORKS FOR, THEN POPULATE DROP BOX ACCORDINGLY. 
			-> CHANGE DEPT_EMP
			-> IF MANAGER CHANGE -> DEPT_MANAGER -> CHECK IF DEPT HAS ALREADY GOT MANAGER -> IF YES THEN REJECT
					-> EXPLAIN THAT MANAGER NEEDS TO BE REMOVED FIRST BEFORE CHANGING (MAYBE WANT TO THINK ABOUT SWAP MANAGER FEATURE 
					(HR_MANAGER LOGIN ONLY ???))
		*/	
	
		$data['emp_no'] = $this->input->post('emp_no');

		$this->set($data['emp_no']);
		
		$result = $this->hr_model->move_emp_search($data);
		
		$data['employee'] = $result['rows'];

		$employee = $result['rows'];
		
		$data['options_dept'] = $this->hr_model->dept_name_options();


		//print ("Controller".$result['is_manager']);

		if ($result['is_manager'] > 0)
		{
			$data['is_manager'] = "TRUE";
		}
		else $data['is_manager'] = "FALSE";
		//print ("Controller".$data['is_manager']);

		if ($result['num_rows'] != 1)
			{
				$data['search'] = 0;
				$this->load->view('default_head');
				$this->load->view('move_employee_search', $data);
			}
		else
		{
		$data['options_dept'] = array_diff($data['options_dept'], array($employee[0]->dept_name));
		$this->load->view('default_head', $data);
		$this->load->view('move_employee', $data);
			}

	}//END_MOVE_EMPLOYEE

	/*****************************************************************************************************************************************
	*	MOVE EMPLOYEE DEPT COMPLETE
	******************************************************************************************************************************************/

	public function move_employee_complete()
	{
		$data['emp_no']=$this->employee_no;
		$data['new_dept'] = $this->session->flashdata('new_dept');
		$now = $this->date_now();

		$this->hr_model->move_emp_complete($data, $now);


		//print ($data['emp_no'] . ' moved to: ' .$data['new_dept']);

		$this->load->view('default_head');
		$this->load->view('move_employee_complete');

		/* 
				-> suggest change title
				-> suggest change salary
			*/


	} //END MOVE_EMPLOYEE_VIEW


	/**************************************************************************************************************************************
	*   PROMOTE EMPLOYEE SEARCH
	***************************************************************************************************************************************/

	public function promote_employee_search()
	{
		
		$data['search'] = 1;
		$this->load->view('default_head');
		$this->load->view('promote_employee_search', $data);
		
	}//END_PROMOTE_EMPLOYEE


	/**************************************************************************************************************************************
	*   PROMOTE EMPLOYEE
	***************************************************************************************************************************************/

	public function promote_employee()
	{
		/* CHECK IF ALREADY MANAGER -> IF YES REJECT PROMOTION  OR ASK IF THEY WANT TO MANAGE TWO OR MORE DEPARTMENTS
		-> IF YES THEN JUST ADD EMP_NUMBER AGAINST THE DEPARTMENT AS NORMAL
		-> IF NO THEN RETURN FALSE
						*/
		$data['emp_no'] = $this->input->post('emp_no');
		$this->set($data['emp_no']);

		// CHECK IF MANAGER
		$manager = $this->hr_model->if_manager($data);

		$result = $this->hr_model->promote_emp_search($data);

		if ($result['num_rows'] != 1)
			{
				$data['search'] = 0;
				$this->load->view('default_head');
				$this->load->view('promote_employee_search', $data);
			}
		else
		{
			if ($manager == true)
			{
					$data['search'] = 2;
					$this->load->view('default_head');
					$this->load->view('promote_employee_search', $data);
			}
			else if ($manager == false)
			{
				$data['employee'] = $result['rows'];
				$employee = $result['rows'];
				//print_r ($employee);

				$this->load->view('default_head');
				$this->load->view('promote_employee', $data);
			}
		}
	}//END_PROMOTE_EMPLOYEE

	/**************************************************************************************************************************************
	*   PROMOTE EMPLOYEE
	***************************************************************************************************************************************/

	public function promote_employee_complete()
	{
		/* CHECK IF ALREADY MANAGER -> IF YES REJECT PROMOTION  OR ASK IF THEY WANT TO MANAGE TWO OR MORE DEPARTMENTS
		-> IF YES THEN JUST ADD EMP_NUMBER AGAINST THE DEPARTMENT AS NORMAL
		-> IF NO THEN RETURN FALSE
						*/
		$data['emp_no'] = $this->employee_no;
		$data['dept_no'] = $this->session->flashdata('dept_no');
		$data['now'] = $this->date_now();
		//print_r ($data);

		$this->hr_model->promote_emp_complete($data);

		$this->load->view('default_head');
		$this->load->view('promote_employee_complete');

		/* 
				-> suggest change salary
			*/


	}//END_PROMOTE_EMPLOYEE

	/**************************************************************************************************************************************
	*   DEMOTE EMPLOYEE SEARCH
	***************************************************************************************************************************************/

	public function demote_employee_search()
	{
		/*CHECK IF THEY ARE MANAGER -> IF NOT THEN -> RETURN FALSE -> IF TRUE -> DELETE FROM MANAGER -> SET NOTICE SAYING MANAGER OF 
		DEPARTMENT IS NON-EXISTANT -> UPDATE DEPT_MANAGER TABLE -> UPDATE SALARY -> UPDATE TITLE*/

		$data['search'] = 1;
		$this->load->view('default_head');
		$this->load->view('demote_employee_search', $data);
	}//END_DEMOTE_EMPLOYEE_SEARCH

	/**************************************************************************************************************************************
	*   DEMOTE EMPLOYEE
	***************************************************************************************************************************************/

	public function demote_employee()
	{
		/*CHECK IF THEY ARE MANAGER -> IF NOT THEN -> RETURN FALSE -> IF TRUE -> DELETE FROM MANAGER -> SET NOTICE SAYING MANAGER OF 
		DEPARTMENT IS NON-EXISTANT -> UPDATE DEPT_MANAGER TABLE -> UPDATE SALARY -> UPDATE TITLE*/
		$data['emp_no'] = $this->input->post('emp_no');
		$this->set($data['emp_no']);

		// CHECK IF MANAGER
		$manager = $this->hr_model->if_manager($data);

		$result = $this->hr_model->demote_emp_search($data);
		$data['options_title'] = $this->hr_model->title_options();
		$key = array_search('Manager', $data['options_title']);
		unset($data['options_title'][$key]);
		
		if ($result['num_rows'] != 1)
			{
				$data['search'] = 0;
				$this->load->view('default_head');
				$this->load->view('demote_employee_search', $data);
			}	//END IF
		else
		{
			if ($manager == false)
			{
					$data['search'] = 2;
					$this->load->view('default_head');
					$this->load->view('demote_employee_search', $data);
			}//END IF
			else if ($manager == true)
			{
				$data['employee'] = $result['rows'];

				$this->load->view('default_head');
				$this->load->view('demote_employee', $data);
			} //END ELSE IF
		} //END ELSE

	}//END_DEMOTE_EMPLOYEE
	

	/**************************************************************************************************************************************
	*   DEMOTE EMPLOYEE COMPLETE
	***************************************************************************************************************************************/

	public function demote_employee_complete()
	{
		echo ('COMPLETE');
		$data['emp_no'] = $this->session->flashdata('emp_no');
		$data['title'] = $this->session->flashdata('title');
		$data['now'] = $this->date_now();
	
		$this->hr_model->demote_emp_complete($data);

		$this->load->view('default_head');
		$this->load->view('demote_employee_complete');
			/* 
				-> suggest change salary
			*/
	}

	/**************************************************************************************************************************************
	*   CHANGE SALARY SEARCH
	***************************************************************************************************************************************/

	public function change_salary_search()
	{
		//FIND ONE THAT IS THE LATEST 9999-00-11 -> UPDATE THIS TO NOW() DATE -> ADD NEW SALARY WITH 9999-00-99 TO DATE
		
		$data['search'] = 1;
		$this->load->view('default_head');
		$this->load->view('change_salary_search', $data);

	}//END_CHANGE_SALARY_SEARCH

	/**************************************************************************************************************************************
	*   CHANGE SALARY
	***************************************************************************************************************************************/

	public function change_salary()
	{
		//FIND ONE THAT IS THE LATEST 9999-00-11 -> UPDATE THIS TO NOW() DATE -> ADD NEW SALARY WITH 9999-00-99 TO DATE
		$data['emp_no'] = $this->input->post('emp_no');
		$this->set($data['emp_no']);

		$result = $this->hr_model->change_salary_search($data);

		if ($result['num_rows'] != 1)
			{
				$data['search'] = 0;
				$this->load->view('default_head');
				$this->load->view('change_salary_search', $data);
			}
		else
		{
				$data['employee'] = $result['rows'];
				
				$this->load->view('default_head');
				
				//print_r ($data['employee']);

				$this->load->view('change_salary', $data);
		}
	}//END_CHANGE_SALARY

	/**************************************************************************************************************************************
	*   CHANGE SALARY COMPLETE
	***************************************************************************************************************************************/

	public function change_salary_complete()
	{
		//FIND ONE THAT IS THE LATEST 9999-00-11 -> UPDATE THIS TO NOW() DATE -> ADD NEW SALARY WITH 9999-00-99 TO DATE
		$data['emp_no'] = $this->employee_no;
		$data['salary'] = $this->session->flashdata('salary');
		$data['now'] = $this->date_now();

		//print_r ($data);
		$this->hr_model->change_salary_complete($data);

		$this->load->view('default_head');
		$this->load->view('change_salary_complete');
	}//END_CHANGE_SALARY_COMPLETE

	/**************************************************************************************************************************************
	*   CHANGE JOB TITLE SEARCH
	***************************************************************************************************************************************/

	public function change_title_search()
	{
		//FIND ONE THAT IS THE LATEST 9999-00-11 -> UPDATE THIS TO NOW() DATE -> ADD NEW TITLE WITH 9999-00-99 TO DATE
		//CHECK IF THIS INCLUDES SALARY INCREASE

		$data['search'] = 1;
		$this->load->view('default_head');
		$this->load->view('change_title_search', $data);

	}//END_CHANGE_TITLE_SEARCH

	/**************************************************************************************************************************************
	*   CHANGE JOB TITLE
	***************************************************************************************************************************************/

	public function change_title()
	{
		//FIND ONE THAT IS THE LATEST 9999-00-11 -> UPDATE THIS TO NOW() DATE -> ADD NEW TITLE WITH 9999-00-99 TO DATE
		//CHECK IF THIS INCLUDES SALARY INCREASE
		$data['emp_no'] = $this->input->post('emp_no');
		$this->set($data['emp_no']);

		$result = $this->hr_model->change_title_search($data);
		$manager = $this->hr_model->if_manager($data);


		$data['options_title'] = $this->hr_model->title_options();

		if ($result['num_rows'] != 1)
			{
				$data['search'] = 0;
				$this->load->view('default_head');
				$this->load->view('change_title_search', $data);
			}
		else
		{		
			if ($manager == true)
			{
					//print_r ($manager);
					$data['search'] = 2;
					$this->load->view('default_head');
					$this->load->view('change_title_search', $data);
			}//END IF
			else if ($manager == false)
			{
				$employee = $result['rows'];
				$data['options_title'] = array_diff($data['options_title'], array($employee[0]->title));

				$data['employee'] = $result['rows'];

				$this->load->view('default_head');
				$this->load->view('change_title', $data);
			}//	END ELSE IF
		}//END ELSE
	
	}//END_CHANGE_TITLE	

	/**************************************************************************************************************************************
	*   CHANGE JOB TITLE COMPLETE
	***************************************************************************************************************************************/

	public function change_title_complete()
	{
		//FIND ONE THAT IS THE LATEST 9999-00-11 -> UPDATE THIS TO NOW() DATE -> ADD NEW TITLE WITH 9999-00-99 TO DATE
		//CHECK IF THIS INCLUDES SALARY INCREASE
		$data['emp_no'] = $this->employee_no;
		$data['title'] = $this->session->flashdata('title');
		$data['now'] = $this->date_now();

		//print_r ($data);
		$this->hr_model->change_title_complete($data);

		$this->load->view('default_head');
		$this->load->view('change_title_complete');


	}//END_CHANGE_TITLE_COMPLETE

}//END_CLASS