<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hr_manager_model extends CI_Model {
    function __construct()
    {
       parent::__construct();
       $this->load->database();
    }//end 

    /**************************************************************************************************************************************
	*	LOG ACTIVITY
	***************************************************************************************************************************************/

    public function record_to_logs($activity)
    {
		$format = 'DATE_COOKIE';
		$time = time();
		$time_date = standard_date($format, $time);	

    	$data = array(
						   'user' => 'hr_manager' ,
						   'activity' => $activity ,
						   'ip_address' => $this->input->ip_address() ,
						   'time_date' => $time_date
					);

				$this->db->insert('logs', $data); 
    } // END RECORD_LOGS

    /**************************************************************************************************************************************
	*	CHANGE COMPANY SALARY COMPLETE
	***************************************************************************************************************************************/

	public function change_company_salary_complete($new_cent, $now)
	{

		$q = $this->db->select("emp_no")
	   		->from('salaries')
			->where('to_date', '9999-01-01');

		$q = $q->get()->result();
		$num_rows = count($q);

		echo ($num_rows);
		echo ('  ');
		echo ($new_cent);
		//print_r ($q);

		foreach ($q as $e)
		{
			/*
				->find current salary
				->calculate new salary
				->update table
			*/
			$emp_no =  $e->emp_no;
			
			$this->db->flush_cache();
		 	
		 	$salary = $this->db->select("salary, from_date")
		 				->from('salaries')
		 				->where('emp_no', $emp_no)
		 				->where('from_date !=', $now)
		 				->where('to_date', '9999-01-01')
		 				->get()->result();			

			$this->db->flush_cache();



			if ((count($salary) == 1))
			{
				//echo (" Old = ".$salary[0]->salary);

			$new_salary = $salary[0]->salary;
			$new_salary = $new_salary * $new_cent;
			//echo (" New = ".$new_salary.", ");

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

			}
			
/*
			$this->db->flush_cache();
		 	$this->db->where('emp_no', $e->emp_no);
			$this->db->where('to_date', '9999-01-01');
			$this->db->update('salaries', array('salary' => $new_salary));
			$this->db->flush_cache();
*/
		} //end foreach

			/*
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
		*/
			$this->record_to_logs("change_company_salary");
	} //END CHANGE SALARY SEARCH



    
} //END_CLASS       
         