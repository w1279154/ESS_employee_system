<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hr_model extends CI_Model {
    function __construct()
    {
       parent::__construct();
       $this->load->database();
    }//end 


    /**************************************************************************************************************************************
	*	
	///////////////////////------------------/////////////////////////////////////////
	*							UTILITIES
	///////////////////////------------------/////////////////////////////////////////
	*
	***************************************************************************************************************************************/


    /**************************************************************************************************************************************
	*	LOG ACTIVITY
	***************************************************************************************************************************************/

    public function record_to_logs($activity)
    {
		$format = 'DATE_COOKIE';
		$time = time();
		$time_date = standard_date($format, $time);	

    	$data = array(
						   'user' => 'admin' ,
						   'activity' => $activity ,
						   'ip_address' => $this->input->ip_address() ,
						   'time_date' => $time_date
					);

				$this->db->insert('logs', $data); 
    } // END RECORD_LOGS


    /**************************************************************************************************************************************
	*	RETURN NEW EMPLOYEE NUMBER
	***************************************************************************************************************************************/
	public function new_emp_number()
	{
		 $new = $this->db->select_max('emp_no')->get('employees')->result();
		 $new[0]->emp_no = $new[0]->emp_no + 1;
		 return $new[0]->emp_no;
	}  //END NEW_EMP_NUMBER

	/**************************************************************************************************************************************
	*	RETURN DEPARATMENT NAME OPTIONS	
	***************************************************************************************************************************************/
	public function dept_name_options()
	{
		$rows = $this->db->select('dept_name, dept_no')
		->from('departments')
		->get()->result();
		
		foreach ($rows as $row) {
			$dept_names[$row->dept_no] = $row->dept_name;
		}
		
		return $dept_names;
		
	}//end dept_name_options
	
	/**************************************************************************************************************************************
	*	RETURN TITLE OPTIONS
	***************************************************************************************************************************************/
	
	public function title_options()
	{
		$rows = $this->db->select('DISTINCT(title)')
		->from('titles')
		->get()->result();

		foreach ($rows as $row) {
			$titles[$row->title] = $row->title;
		}
		
		return $titles;
		
	}//end title_options

	/**************************************************************************************************************************************
	*	RETURN IF MANAGER
	***************************************************************************************************************************************/
	public function if_manager($data)
	{
			$emp_no = $data['emp_no'];
			$q_manager	= $this->db->get_where('dept_manager', array('emp_no' => $emp_no, 'to_date' => '9999-01-01'))->num_rows();

			if ($q_manager != 1)
			{
				$manager = false;
			}
			else 
			{
				$manager = true;
			}

			return $manager;
	} //END IF MANAGER







    /**************************************************************************************************************************************
	*	
	///////////////////////------------------/////////////////////////////////////////
	*					   HR MODEL FUNCTIONS
	///////////////////////------------------/////////////////////////////////////////
	*
	***************************************************************************************************************************************/

    /**************************************************************************************************************************************
	*	REMOVE EMPLOYEE SEARCH
	***************************************************************************************************************************************/
    
	public function remove_search($data){
		
		//variables
		$emp_no = $data['emp_no'];
		//print ($emp_no);
		
	
	   $q = $this->db->select("e.emp_no, e.first_name, e.last_name, e.birth_date, e.gender, e.hire_date, t.title")
	   		->from('employees AS e')
			->join('titles AS t', 'e.emp_no = t.emp_no')
			->where('t.to_date', '9999-01-01')
			->where('e.emp_no', $emp_no);
		
			
			$ret['rows'] = $q->get()->result();	
	 		$ret['num_rows'] = count($ret['rows']);
	 		
			$q_manager	= $this->db->get_where('dept_manager', array('emp_no' => $emp_no, 'to_date' => '9999-01-01'));

	 		$ret['is_manager'] = $q_manager->num_rows();
			

	 		//print ($ret['num_rows']);
	 		//print ("MANAGER:".$ret['is_manager']);

	
		return $ret;
		
		} //end remove_search

	/**************************************************************************************************************************************
	*	REMOVE EMPLOYEE FUNCTION
	***************************************************************************************************************************************/

	public function remove_employee($emp_no, $now)
	{
		//$this->db->delete('dept_emp', array('emp_no' => $emp_no));
		//$this->db->delete('salaries', array('emp_no' => $emp_no));
		//$this->db->delete('titles', array('emp_no' => $emp_no));
		//$this->db->flush_cache();

		//$where = array('emp_no' => $emp_no,'to_date' => '9999-01-01');
		/* THIS DID NOT WORK AS IT DOES NOT ALLOW A FORIEGN KEY TO A NON-EXSISTANT FOREIGN KEY TO BE STORED.
		When the foreign key is deleted, it deletes with it all associated records that uses that foreign key.

				*************IMPORTANT CHANGE SEARCH TO WHERE DEPT EMP === 9999-01-01**************
		*/
																													
		$this->db->start_cache();
		$this->db->where('emp_no', $emp_no);
		$this->db->where('to_date', '9999-01-01');
		$this->db->update('dept_emp', array('to_date' => $now));
		$this->db->stop_cache();
		$this->db->flush_cache();	


		$this->db->start_cache();
		$this->db->where('emp_no', $emp_no);
		$this->db->where('to_date', '9999-01-01');
		$this->db->update('salaries', array('to_date' => $now));
		$this->db->stop_cache();
		$this->db->flush_cache();	
		
		$this->db->start_cache();
		$this->db->where('emp_no', $emp_no);
		$this->db->where('to_date', '9999-01-01');
		$this->db->update('titles', array('to_date' => $now));
		$this->db->stop_cache();
		$this->db->flush_cache();	
 		

		//$this->db->delete('employees', array('emp_no' => $emp_no));

		//if manager    

		/*
			-> CHECK WHICH DEPT MANAGER IS
			-> CHECK HOW MANY RESULTS SHOW
			-> DELETE RECORDS
			-> IF NONE IS LEFT THEN SHOW MESSAGE IN LOGS THAT NO MANAGER FOR DEPARTMENT
		*/
		
		$q = $this->db->get_where('dept_manager', array('emp_no' => $emp_no));
		
		if (count($q) > 0)
		{
			//$this->db->update('dept_manager', array('emp_no' => null), array('emp_no' => $emp_no));
			//$this->db->delete('dept_manager', array('emp_no' => $emp_no));


			$this->db->flush_cache();
		 	$this->db->where('emp_no', $emp_no);
			$this->db->where('to_date', '9999-01-01');
			$this->db->update('dept_manager', array('to_date' => $now));
			$this->db->flush_cache();
		}
		

		//$this->delete_emp($emp_no);

		//store logs for security
		//$this->db->delete('employees', array('emp_no' => $emp_no));
		$this->record_to_logs("remove_employee");
		
		return;
	} //END REMOVE EMPLOYEE

	/**************************************************************************************************************************************
	*	ADD NEW EMPLOYEE
	***************************************************************************************************************************************/
	public function add_employee($data)
	{
	
	$emp_no = $this->new_emp_number();

	$data_employees = array(
						   'emp_no' => $emp_no ,
						   'birth_date' =>  $data['birth_date'],
						   'first_name' =>  $data['first_name'],
						   'last_name' => $data['last_name'],
						   'Gender' => $data['gender'],
						   'hire_date' => $data['hire_date']
					);
	
	$data_salaries = array(
						   'emp_no' => $emp_no ,
						   'salary' => $data['salary'],
						   'from_date' => $data['from_date'],
						   'to_date' => $data['to_date']
					);

	$data_titles = array(
						   'emp_no' => $emp_no ,
						   'title' => $data['title'],
						   'from_date' => $data['from_date'],
						   'to_date' => $data['to_date']
					);

	$data_dept = array(
						   'emp_no' => $emp_no ,
						   'dept_no' => $data['dept_no'],
						   'from_date' => $data['from_date'],
						   'to_date' => $data['to_date']
					);

	$this->db->insert('employees', $data_employees); 
	$this->db->insert('salaries', $data_salaries); 	
	$this->db->insert('titles', $data_titles); 	
	$this->db->insert('dept_emp', $data_dept);

	if ($data['title'] == "Manager")
	{
		$data_manager = array(
						   'emp_no' => $emp_no ,
						   'dept_no' => $data['dept_no'],
						   'from_date' => $data['from_date'],
						   'to_date' => $data['to_date']
					);

		$this->db->insert('dept_manager', $data_manager);
	}

	$this->record_to_logs("add_employee");
	//echo ("completed.");
	}  //END ADD_EMPLOYEE


	/**************************************************************************************************************************************
	*	MOVE EMPLOYEE SEARCH
	***************************************************************************************************************************************/

	public function move_emp_search($data)
	{
			//variables
		$emp_no = $data['emp_no'];
		//print ($emp_no);
		
	
	   	$q = $this->db->select('de.emp_no, e.first_name, e.last_name, e.gender, e.birth_date, d.dept_name, de.from_date, de.to_date')
	   		->from('dept_emp AS de')
	   		->join('departments AS d', 'de.dept_no = d.dept_no')
	   		->join('employees AS e', 'de.emp_no = e.emp_no')
			->where('de.to_date', '9999-01-01')
			->where('de.emp_no', $emp_no);

			$ret['rows'] = $q->get()->result();	
	 		$ret['num_rows'] = count($ret['rows']);
	 		
	 		$this->db->flush_cache();	
			$q_manager	= $this->db->get_where('dept_manager', array('emp_no' => $emp_no, 'to_date' => '9999-01-01'));

	 		$ret['is_manager'] = $q_manager->num_rows();

	 		//print_r ($ret['rows']);
	 	//	print ("MANAGER:".$ret['is_manager']);

	
		return $ret;


	} //END MOVE_EMP_SEARCH

	/**************************************************************************************************************************************
	*	MOVE EMPLOYEE COMPLETE
	***************************************************************************************************************************************/

	public function move_emp_complete($data, $now)
	{
		$emp_no = $data['emp_no'];
		$new_dept = $data['new_dept'];

		
		$this->db->where('emp_no', $emp_no);
		$this->db->where('to_date', '9999-01-01');
		$this->db->update('dept_emp', array('to_date' => $now));
		
		$this->db->flush_cache();

		$q = $this->db->get_where('dept_emp', array('emp_no' => $emp_no, 'dept_no' => $new_dept));

		if ($q->num_rows() != 0)
	 	{
	 		$this->db->flush_cache();
		 	$this->db->where('emp_no', $emp_no);
			$this->db->where('dept_no', $new_dept);
			$this->db->update('dept_emp', array('to_date' => '9999-01-01'));
	 	} //END IF
	 	else 
	 	{
			$this->db->flush_cache();
			$data_dept = array(
							   'emp_no' => $emp_no ,
							   'dept_no' => $new_dept,
							   'from_date' => $now,
							   'to_date' => '9999-01-01'
						);

			$this->db->insert('dept_emp', $data_dept); 
		}	//END ELSE

		$this->db->flush_cache();

		//CHECK IF MANAGER
		$q_manager	= $this->db->get_where('dept_manager', array('emp_no' => $emp_no, 'to_date' => '9999-01-01'));

	 	if ($q_manager->num_rows() != 0)
	 	{
	 		$this->db->flush_cache();

	 		//CHANGE CURRENT DEPT TO DATE
	 		$this->db->where('emp_no', $emp_no);
			$this->db->where('to_date', '9999-01-01');
			$this->db->update('dept_manager', array('to_date' => $now));

			$this->db->flush_cache();
	 		
	 		//CHECK IF THEY WERE MANAGER OF THIS DEPARTMENT PREVIOUSLY
	 		$q = $this->db->get_where('dept_manager', array('emp_no' => $emp_no, 'dept_no' => $new_dept));

		if ($q->num_rows() != 0)
	 	{
	 		$this->db->flush_cache();
		 	$this->db->where('emp_no', $emp_no);
			$this->db->where('dept_no', $new_dept);
			$this->db->update('dept_manager', array('to_date' => '9999-01-01'));
	 	} //END IF
	 	else
	 	{
	 		$this->db->flush_cache();

		 	$this->db->where('emp_no', $emp_no);
			$this->db->where('to_date', '9999-01-01');
			$this->db->update('dept_manager', array('to_date' => $now));
			
			$this->db->flush_cache();

			$data_manager = array(
							   'emp_no' => $emp_no ,
							   'dept_no' => $new_dept,
							   'from_date' => $now,
							   'to_date' => '9999-01-01'
						);

			$this->db->insert('dept_manager', $data_manager); 
		} //END ELSE
		
		$this->db->flush_cache();

	 	} //END IF
	 	$this->record_to_logs("move_employee");
	} //END_MOVE_EMP_COMPLETE


	/**************************************************************************************************************************************
	*	PROMOTE EMPLOYEE SEARCH
	***************************************************************************************************************************************/

	public function promote_emp_search($data)
	{
		$emp_no = $data['emp_no'];


		$q = $this->db->select('e.emp_no, e.first_name, e.last_name, e.gender, e.birth_date, d.dept_name, t.title, de.dept_no')
	   		->from('dept_emp AS de')
	   		->join('departments AS d', 'de.dept_no = d.dept_no')
	   		->join('employees AS e', 'de.emp_no = e.emp_no')
	   		->join('titles AS t', 'e.emp_no = t.emp_no')
			->where('de.to_date', '9999-01-01')
			->where('t.to_date', '9999-01-01')
			->where('de.emp_no', $emp_no);

			$ret['rows'] = $q->get()->result();	
	 		$ret['num_rows'] = count($ret['rows']);
	 		
	 	  	return $ret;
	} //END PROMOTE EMP SEARCH
	
	/**************************************************************************************************************************************
	*	PROMOTE EMPLOYEE COMPLETE
	***************************************************************************************************************************************/

	public function promote_emp_complete($data)
	{
		$emp_no = $data['emp_no'];
		$dept = $data['dept_no'];
		$now = $data['now'];

		$data_manager = array(
							   'emp_no' => $emp_no ,
							   'dept_no' => $dept,
							   'from_date' => $now,
							   'to_date' => '9999-01-01'
						);

			$this->db->insert('dept_manager', $data_manager); 

			
			$this->db->flush_cache();
		 	$this->db->where('emp_no', $emp_no);
			$this->db->where('to_date', '9999-01-01');
			$this->db->update('titles', array('to_date' => $now));
			$this->db->flush_cache();

		$data_titles = array(
						   'emp_no' => $emp_no ,
						   'title' => 'Manager',
						   'from_date' => $now,
						   'to_date' => '9999-01-01'
					);

		$this->db->insert('titles', $data_titles);

			$this->record_to_logs("promote_employee");
	} //END PROMOTE EMP COMPLETE

	/**************************************************************************************************************************************
	*	DEMOTE EMPLOYEE SEARCH
	***************************************************************************************************************************************/

	public function demote_emp_search($data)
	{
		$emp_no = $data['emp_no'];


		$q = $this->db->select('e.emp_no, e.first_name, e.last_name, e.gender, e.birth_date, d.dept_name, t.title, de.dept_no')
	   		->from('dept_emp AS de')
	   		->join('departments AS d', 'de.dept_no = d.dept_no')
	   		->join('employees AS e', 'de.emp_no = e.emp_no')
	   		->join('titles AS t', 'e.emp_no = t.emp_no')
			->where('de.to_date', '9999-01-01')
			->where('t.to_date', '9999-01-01')
			->where('de.emp_no', $emp_no);

			$ret['rows'] = $q->get()->result();	
	 		$ret['num_rows'] = count($ret['rows']);
	 		
	 	  	return $ret;
	} //END DEMOTE EMP SEARCH

	/**************************************************************************************************************************************
	*	DEMOTE EMPLOYEE COMPLETE
	***************************************************************************************************************************************/

	public function demote_emp_complete($data)
	{
		//->change end date to today in manager
		//-> change job title
		//-> decrease salary

		$title = $data['title'];
		$emp_no = $data['emp_no'];
		$now = $data['now'];


		$this->db->flush_cache();
		 	$this->db->where('emp_no', $emp_no);
			$this->db->where('to_date', '9999-01-01');
			$this->db->update('dept_manager', array('to_date' => $now));
			$this->db->flush_cache();

		$this->db->flush_cache();
		 	$this->db->where('emp_no', $emp_no);
			$this->db->where('to_date', '9999-01-01');
			$this->db->where('title', 'Manager');
			$this->db->update('titles', array('to_date' => $now));
		$this->db->flush_cache();

		$data_titles = array(
						   'emp_no' => $emp_no ,
						   'title' => $title,
						   'from_date' => $now,
						   'to_date' => '9999-01-01'
					);

		$this->db->insert('titles', $data_titles);

			$this->record_to_logs("demote_employee");
	}//END_DEMOTE_EMP_COMPLETE

	/**************************************************************************************************************************************
	*	CHANGE SALARY SEARCH
	***************************************************************************************************************************************/

	public function change_salary_search($data)
	{
		$emp_no = $data['emp_no'];

		$q = $this->db->select('e.emp_no, e.first_name, e.last_name, e.gender, e.birth_date, s.salary, s.from_date')
	   		->from('employees AS e')
	   		->join('salaries AS s', 'e.emp_no = s.emp_no')
			->where('s.to_date', '9999-01-01')
			->where('e.emp_no', $emp_no);

			$ret['rows'] = $q->get()->result();	
	 		$ret['num_rows'] = count($ret['rows']);
	 		
	 	  	return $ret;
	} //END CHANGE SALARY SEARCH

	/**************************************************************************************************************************************
	*	CHANGE SALARY COMPLETE
	***************************************************************************************************************************************/

	public function change_salary_complete($data)
	{
		$new_salary = $data['salary'];
		$emp_no = $data['emp_no'];
		$now = $data['now'];

		$this->db->flush_cache();
		 	$this->db->where('emp_no', $emp_no);
			$this->db->where('to_date', '9999-01-01');
			$this->db->update('salaries', array('to_date' => $now));
		$this->db->flush_cache();

		$data_salaries = array(
						   'emp_no' => $emp_no ,
						   'salary' => $new_salary,
						   'from_date' => $now,
						   'to_date' => '9999-01-01'
					);

		$this->db->insert('salaries', $data_salaries);

			$this->record_to_logs("change_salary");
	} //END CHANGE SALARY SEARCH

	/**************************************************************************************************************************************
	*	CHANGE TITLE SEARCH
	***************************************************************************************************************************************/

	public function change_title_search($data)
	{

		$emp_no = $data['emp_no'];

		$q = $this->db->select('e.emp_no, e.first_name, e.last_name, e.gender, e.birth_date, t.title')
	   		->from('employees AS e')
	   		->join('titles AS t', 'e.emp_no = t.emp_no')
			->where('t.to_date', '9999-01-01')
			->where('e.emp_no', $emp_no);

			$ret['rows'] = $q->get()->result();	
	 		$ret['num_rows'] = count($ret['rows']);
	 		
	 	  	return $ret;

	}//END CHANGE_TITLE_SEARCH

	/**************************************************************************************************************************************
	*	CHANGE TITLE VALIDATION
	***************************************************************************************************************************************/

	public function change_title_validation($data)
	{

		$emp_no = $data['emp_no'];
		$now = $data['now'];

		$q = $this->db->select('t.title')
	   		->from('employees AS e')
	   		->join('titles AS t', 'e.emp_no = t.emp_no')
			->where('t.from_date', $now)
			->where('e.emp_no', $emp_no);

			$ret['rows'] = $q->get()->result();	
	 		$ret['num_rows'] = count($ret['rows']);
	 		
	 	  	return $ret;

	}//END CHANGE_TITLE_SEARCH

	/**************************************************************************************************************************************
	*	CHANGE TITLE COMPLETE
	***************************************************************************************************************************************/

	public function change_title_complete($data)
	{
		$new_title = $data['title'];
		$emp_no = $data['emp_no'];
		$now = $data['now'];

		$this->db->flush_cache();
		 	$this->db->where('emp_no', $emp_no);
			$this->db->where('to_date', '9999-01-01');
			$this->db->update('titles', array('to_date' => $now));
		$this->db->flush_cache();

		$data_title = array(
						   'emp_no' => $emp_no ,
						   'title' => $new_title,
						   'from_date' => $now,
						   'to_date' => '9999-01-01'
					);

		$this->db->insert('titles', $data_title);

			$this->record_to_logs("change_title");
	} //END CHANGE SALARY SEARCH
} //END_CLASS       
         