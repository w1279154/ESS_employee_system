<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Find_model extends CI_Model {
    function __construct()
    {
       parent::__construct();
       $this->load->database();
    }//end 
    
	public function search($data_search){
		
		//variables
		$emp_no = $data_search['emp_no'];
		$first_name = $data_search['first_name'];
		$last_name = $data_search['last_name'];
		$title = $data_search['title'];
		$department = $data_search['department'];
	
	   $q = $this->db->select("e.emp_no, e.first_name AS firstname, e.last_name AS lastname, t.title AS jobtitle, d.dept_name AS dept, d.dept_no AS deptid")
	   		->select("IF (`e`.`emp_no` = `dm`.`emp_no` AND `dm`.`to_date` = '9999-01-01', 1, 0) AS ismanager", false)
	   		->from('employees AS e')
			->join('titles AS t', 'e.emp_no = t.emp_no')
			->join('dept_emp AS de', 't.emp_no = de.emp_no')
			->join('departments AS d', 'de.dept_no = d.dept_no')
			->join('dept_manager AS dm', 'dm.emp_no = e.emp_no', 'left')
			->where('t.to_date', '9999-01-01')
			->where('de.to_date', '9999-01-01')
			    ;



			if ($emp_no != '' && $emp_no != null) $q = $q->where('e.emp_no', $emp_no);
			if ($first_name != '' && $first_name != null) $q = $q->where('e.first_name', $first_name);
			if ($last_name != '' && $last_name != null) $q = $q->where('e.last_name', $last_name);
			if ($title != '' && $title != null) $q = $q->where('t.title', $title);
			if ($title == 'Manager') $q = $q->where('dm.to_date', '9999-01-01');
			if ($department != '' && $department != null) $q = $q->where('d.dept_name', $department);
		
		/* $q	= $q->where('t.to_date', '9999-01-01')
			    ->where('de.to_date', '9999-01-01');	
		*/
			
			$ret['rows'] = $q->get()->result();	
	 		$ret['num_rows'] = count($ret['rows']);
		
		return $ret;
		
		
		} //end search
		  
	
	
	public function dept_name_options()
	{
		$rows = $this->db->select('dept_name')
		->from('departments')
		->get()->result();
		
		$dept_names = array('' => '');
		foreach ($rows as $row) {
			$dept_names[$row->dept_name] = $row->dept_name;
		}
		
		return $dept_names;
		
	}//end dept_name_options
	
	
	
	
	
	public function title_options()
	{
		$rows = $this->db->select('DISTINCT(title)')
		->from('titles')
		->get()->result();
		
		$titles = array('' => '');
		foreach ($rows as $row) {
			$titles[$row->title] = $row->title;
		}
		
		return $titles;
		
	}//end title_options
	

	
	
	
}        
         