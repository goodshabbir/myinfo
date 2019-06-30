<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('memory_limit', '-1');
class Front_model extends CI_Model
{
	public  $alldata=array();
	public  $allupline=array();
	public  $downlinedata=array();
	public  $counter=array();
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		date_default_timezone_set('Asia/Kolkata');	
	}
	function InsertAllData($tableName, $array)
	{
		$this->db->insert($tableName, $array);
	}
	
	private function checkSpoRightOrNot($self_id,$id){
		if($id!=''){
			$data=$this->welcome_model->getAllUpline($id);
			if (array_key_exists($self_id,$data) || in_array($self_id, $data)){
				  return true;
			}
      else{
         return false;
  		}
		}else{
       return false;
		}
	}

	private function checksposor($id){
		if($data = $this->welcome_model->getspecificcolomn(TBL_TREE,['child_left','child_right'],['self_id' => $id])){
			return array('left' => $data->child_left,'right' => $data->child_right);
		}else{
			return false;
		}
	}
	function getname(){
		$array = array();
		if($name = $this->welcome_model->getspecificcolomn(TBL_USER,['full_name'],['sponsor_id'=>$this->input->post('id')])){
			$array = array('success' => 1,'msg' => $name->full_name);
		}else{
			$array = array('success' => 0,'msg' => 'Invalid Enter Sponsor Id');
		}
		echo json_encode($array);
	}
	function access(){
		if(!empty($_POST)){
			$this->form_validation->set_rules('email','Email ','required|valid_email');
			$this->form_validation->set_rules('password','Password','required');
			if($this->form_validation->run()==false){}else{
				extract($_POST);
				if($data = $this->welcome_model->getsinglerow(USER,array('email'=>$email,'password'=>sha1($password),'type'=>1))){
						
						$session = array();
						$session['id'] = $data->id;
						$seesion['type'] = $data->type;
						$session['email'] = $data->email;
						$this->session->set_userdata('admin',$session);
						redirect(dashboard);
				}else{
					$this->session->set_flashdata('heading','Opps! Wrong Credential');
					$this->session->set_flashdata('error','Entered email or password not matched');
				}
			}
		}
		$this->load->view('login');
	}
	
}
?>
