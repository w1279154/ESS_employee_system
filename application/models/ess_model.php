<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ess_model extends CI_Model {
    function __construct()
    {
       parent::__construct();
       $this->load->database();
    }//end 
    
	public function search($limit, $offset, $sort_by, $sort_order, $data_search){
		
		//variables
		$emp_no = $data_search['emp_no'];
		$first_name = $data_search['first_name'];
		$last_name = $data_search['last_name'];
		$title = $data_search['title'];
		$department = $data_search['department'];
		
		//$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		//$sort_columns = array('e.emp_no', 'e.birth_date', 'e.first_name', 'e.last_name', 'e.gender', 'e.hire_date', 's.salary', 't.title');
		//$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'e.emp_no';
		
		//results query
		// $q = $this->db->select("SQL_CALC_FOUND_ROWS e.emp_no, e.birth_date, e.first_name, e.last_name, e.gender, e.hire_date, t.title, s.salary, d.dept_name", FALSE)
		
	
	   $q = $this->db->select("e.emp_no, e.first_name, e.last_name, t.title, d.dept_name")
	   		->from('employees AS e')
			->join('titles AS t', 'e.emp_no = t.emp_no')
			//->join('salaries AS s', 't.emp_no = s.emp_no')
			->join('dept_emp AS de', 't.emp_no = de.emp_no')
			->join('departments AS d', 'de.dept_no = d.dept_no');
			//->join('dept_manager AS dm', 'd.dept_no = dm.dept_no')
			//->order_by($sort_by, $sort_order)
			//->group_by('e.emp_no')
			//->limit($limit, $offset);
			//->where('t.to_date', '9999-01-01')
			//->where('de.to_date', '9999-01-01');		
			//->limit($limit);
			
				
			if ($emp_no != '' && $emp_no != null) $q = $q->where('e.emp_no', $emp_no);
			if ($first_name != '' && $first_name != null) $q = $q->where('e.first_name', $first_name);
			if ($last_name != '' && $last_name != null) $q = $q->where('e.last_name', $last_name);
			if ($title != '' && $title != null) $q = $q->where('t.title', $title);
			if ($department != '' && $department != null) $q = $q->where('d.dept_name', $department);

			
			
		
		 $q	= $q->where('t.to_date', '9999-01-01')
			->where('de.to_date', '9999-01-01');	
		
			
			$ret['rows'] = $q->get()->result();	
	 		$ret['num_rows'] = count($ret['rows']);
			
			//$ret['num_rows'] = $this->count_results($data_search);
			
			
		//print_r (count($ret['rows'])); //return;
		
		//print_r ("returned rows :::".$ret['num_rows']);		
	
		return $ret;
		
		
		} //end search
		  
	public function count_results($data_search){
		
		//varibles 
		$emp_no = $data_search['emp_no'];
		$first_name = $data_search['first_name'];
		$last_name = $data_search['last_name'];
		$title = $data_search['title'];
		$department = $data_search['department'];
		
		$q = $this->db->select(count)
	   		->from('employees AS e')
			->join('titles AS t', 'e.emp_no = t.emp_no')
			->join('dept_emp AS de', 't.emp_no = de.emp_no')
			->join('departments AS d', 'de.dept_no = d.dept_no');
			
		if ($emp_no != '' && $emp_no != null) $q = $q->where('e.emp_no', $emp_no);
			if ($first_name != '' && $first_name != null) $q = $q->like('e.first_name', $first_name, 'both');
			if ($last_name != '' && $last_name != null) $q = $q->like('e.last_name', $last_name, 'both');
			if ($title != '' && $title != null) $q = $q->where('t.title', $title)->where('t.to_date', '9999-01-01');
			if ($department != '' && $department != null) $q = $q->like('d.dept_name', $department, 'both');
				
		$rows= $q->get()->result();	
	 	$count = count($rows);
		return $count;
		}//end count
		  
		
	
	
	
	
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
	
	
	
	
	
	
	
	
	
	
	
		public function search__all($limit, $offset, $sort_by, $sort_order) {
        
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		$sort_columns = array('emp_no', 'birth_date', 'first_name', 'last_name', 'gender', 'hire_date');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'emp_no';
		
		//results query
	   $q = $this->db->select('emp_no, birth_date, first_name, last_name, gender, hire_date')
	   		->from('employees')
	   		->limit($limit, $offset)
			->order_by($sort_by, $sort_order);
			
		$ret['rows'] = $q->get()->result();
		
		print_r ($ret['rows']); return;
		
		//count query
		$q = $this->db->select('COUNT(*) as count', FALSE)
		->from('employees');
		
		$tmp = $q->get()->result();
		
		$ret['num_rows'] = $tmp[0]->count;
		
		return $ret;
	   
	      }//end search
	
	
	
}        
         