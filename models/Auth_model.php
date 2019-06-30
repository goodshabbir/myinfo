<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function getsinglerow($table,$where){
		return $this->db->get_where($table,$where)->row();
	}
	
	function accessallrecored($table,$where){
		return $this->db->get_where($table,$where)->result();
	}

	function accesfewrows($table,$select,$where){
				$this->db->select(implode(',',$select));
		return $this->db->get_where($table,$where)->row();
	}

	function accesmultirows($table,$select,$where){
		$this->db->select(implode(',',$select));
	return $this->db->get_where($table,$where)->result();
	}

	function insertRecord(string $table,array $array){
		$this->db->insert($table, $array);
		return $this->db->insert_id();
	}
	function updateRecord($table,$data,$where){
		$this->db->update($table,$data,$where);
		return $this->db->affected_rows();
	}
	function removeData($table,$where){
		$this->db->delete($table,$where);
	}
	function accessrecordwithjoin($select,$from,$to,$join,$where,$what,$yourQuery){

		$custum = '';
        $possition = 0;
        $rows = 1;
		if(!empty($yourQuery)){
			for($i=0; $i<count($yourQuery); $i++){
             
                if(empty($yourQuery[$i]['key'])){
                    $possition=1;
                }
                if(empty($yourQuery[$i]['key']) && ($yourQuery[$i]['value'])=='row'){
                    $rows=0;
                }
                $custum.= $yourQuery[$i]['key']. " " .$yourQuery[$i]['value'];
			}
		}
		$custumwhere = '';
		if(!empty($where)){
			 $data = array();
        			 foreach ($where as $key => $value) {
        			 	$data[] = $key."=".$value;
        			 }
        	$custumwhere = " WHERE ".implode(' and ', $data);
        }
        $temp = $custumwhere;
        $tempj = chop($custum,'row');
        if($possition==1){
           $custum = $temp;
           $custumwhere = $tempj;
        }
        
		$query = "SELECT ". implode(',', $select). " FROM ". $from. " ". $what. " JOIN  ".$to." ON ". implode('=', $join). " ".$custumwhere." ".$custum  ;
	    $result = $this->db->query($query);
        //echo $this->db->last_query(); die;
		return $rows==1 ? $result->result(): $result->row();
		echo $this->db->last_query(); die;
	}
	
} 
?>
