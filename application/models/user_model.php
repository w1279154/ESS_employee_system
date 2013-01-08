<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {
    function __construct()
    {
       parent::__construct();
       $this->load->database();
    }//end 

public function user_auth($data){
	
	$salt1 = "hu5541n";
	$salt2 = "d17w04r";
	
	$user = $data['username'];
	$pass = sha1($salt1.$data['password'].$salt2);
	
	$q = $this->db->select("name, username")
	   		->from('authentication')
			->where('username', $user)
			->where('password', $pass);
			
			$ret['rows'] = $q->get()->result();	
	 		$ret['num_rows'] = count($ret['rows']);
			
			//print ($user);
			//print ($pass);
			//print ($ret['num_rows']);
			
			
			
			if ($ret['num_rows'] == '1')
			{
				
				foreach ($ret['rows'] as $row) {
					$session['name'] = $row->name;
					$session['username'] = $row->username;
					$session['logged_in'] = TRUE;
					$result['session'] = $session;
				}
				
				$this->session->set_userdata('login', $session);
				
				$result['username'] = $row->username;
				$result['check'] = true;
				return $result;				
			}
			else {
					$session['name'] = 'none';
					$session['username'] = 'none';
					$session['logged_in'] = FALSE;
					$result['session'] = $session;
					$result['check'] = false;
					
					$this->session->set_userdata('login', $session);
				return $result;	
			} 
			
			return $result;
	
} //END USER_AUTH


public function delete_session()
{
	/*
					$session['name'] = 'none';
					$session['username'] = 'none';
					$session['logged_in'] = FALSE;
					
					$this->session->set_userdata('login', $session);
	*/
					$this->session->sess_destroy();
				return;
}

}//end class