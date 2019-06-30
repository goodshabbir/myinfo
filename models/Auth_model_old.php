<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
	class Auth_model extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		function accessrecord($table, $array)
		{
			return $this->db->get_where($table,$array)->row();
		}
		
		public function getUserById($id)
		{
			return $this->db->get_where('users',array('id'=>$id))->row();
		}
		public function update_user($userdata,$id)
		{
			if($this->db->update("users",$userdata ,array('id'=>$id)))
			{
				return true;
			}else
				{
					return false;
				}
		}
		
			
 
}

		