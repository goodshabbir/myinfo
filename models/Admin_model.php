<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	function insertRecord($table, $Arrayy)
	{
		return $this->db->insert($table, $Arrayy);
	}
	function getsinglerow($table, $where)
	{
		return $this->db->get_where($table, $where)->row();
	}
	function updateRecord($table, $data, $where)
	{
		return $this->db->update($table, $data, $where);
	}
	public function getInfo($id)
	{
		return $this->db->get_where('users',array('id'=>$id))->row();
	}
	public function updateadminprofile($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('users',$data);
		return $this->db->affected_rows();
	}
	public function checkpassword($id,$old)
	{
		return $this->db->get_where('users',array('id'=>$id,'password'=>md5($old)))->row();
	}
	public function updatepassword($id,$data)
	{
		 $this->db->where('id',$id);
		 $this->db->update('users',$data);
	}	
	function wholeresult($table, $select, $where)
	{
		$this->db->select(implode(',', $select));
		return $this->db->get_where($table, $where)->result();
	}
	function getlevelIncome()
	{
		$this->db->select('user.full_name, user.sponsor_id,user.mobile,user.email,level_income.level,level_income.level_income,level_income.on_month,level_income.create_at,level_income.status,level_income.behalf_of,level_income.id');
		$this->db->from('level_income');
		$this->db->join('user', 'user.sponsor_id=level_income.sponsor_id', 'inner');
		
		return $this->db->get()->result();
	}
	public function change($status,$id)
	{ 
		$this->db->where('id',$id);
		$this->db->update('level_income',array('status'=>$status));
		return $this->db->affected_rows() ;
	}
	public function ActivInactive($status,$id)
	{ 
		$this->db->where('id',$id);
		$this->db->update('user',array('is_active'=>$status));
		return $this->db->affected_rows() ;
	}
	public function deleteTestmonial($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('testmonials');
	}
	public function deleteSlider($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('slider');
	}
	public function deleteNews($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('latest_news');
	}
	public function deleteImportent($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('impartent_note');
	}
	public function deleteRegional($id)
	{
		$this->db->where('id',$id);
		$this->db->delete(' regional_experts');
	}
	
	/*======================================== */
	function getReligions()
	{
		$this->db->select('religions_.religions_name,sub_religion_.religions_id,sub_religion_.sub_religions,sub_religion_.id');
		$this->db->from('sub_religion_');
		$this->db->join('religions_', 'religions_.id=sub_religion_.religions_id', 'inner');
		$this->db->order_by('id','desc');
		return $this->db->get()->result();
	}
	function AllReligions()
	{
		$sql="SELECT sub_religion_category_.*, t1.sub_religions as subreName , t1.religions_id as rid , religions_.religions_name as mainname FROM sub_religion_category_ LEFT JOIN sub_religion_ t1 ON sub_religion_category_.religions_id=t1.id LEFT JOIN religions_ ON t1.religions_id=religions_.id";
		return	$this->db->query($sql)->result();
	}
	

	function multipleIdUser()
	{
		
	}
}

?>