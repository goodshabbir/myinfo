<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();	
	}

	public function all_users($limit ,$start,$keyword)
	{
	    $this -> db -> select('*');
		$this -> db -> from('users');
		$this->db->where('user_group',2);
		if($keyword!='' && !empty($keyword))
		{
			$this->db->like('user_name',$keyword);
			$this->db->or_like('sponsor_id',$keyword);
			$this->db->or_like('full_name ',$keyword);
			$this->db->or_like('mobile_no',$keyword);
		}
		$this -> db -> limit($limit,$start);
		$query=$this->db->get();
	    return $query->result();    
	}
	
	public function all_record_count($keyword)
	{
		 $this -> db -> select('*');
		 $this -> db -> from('users');
		 $this->db->where('user_group',2);
		 if($keyword!='' && !empty($keyword))
			{
				$this->db->like('user_name',$keyword);
				$this->db->or_like('sponsor_id',$keyword);
				$this->db->or_like('full_name ',$keyword);
				$this->db->or_like('mobile_no',$keyword);
			}
		$query=$this->db->get();
	    return $query->num_rows();  
    }
	public function change($status,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('users',array('status'=>$status));
		return $this->db->affected_rows() ;
	}
	
		// $this->db->select("self_id.sposorId");
      	// $this->db->from('users');
      	// $this->db->join('tree', 'users.sposorId = tree.sposorId');
      	// $query = $this->db->get();

		// if($query->num_rows() != 0)
		// {
		// 	return $query->result();
		// }
		// else
		// {
		// 	return false;
		// }
	
	
}
?>
