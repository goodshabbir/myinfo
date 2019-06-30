<?php defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
class Auth extends CI_Controller {

	public $datecheck = array();
    public $allorder= array();
    public $alldata = array();
    public $isNotFirstTime = 0;
    public $isRightStart = 0;
    public $tempFirstRightSponsorId="";
    public $tempSponsorArray = array();
    public $downlineleft=array();
    public $downlineright=array();
    public $Activedownlineleft=array();
    public $Activedownlineright=array();

	public function __construct() {
		parent::__construct();
			$this->load->helper(array('form','url','security'));
			$this->load->library(array('session','form_validation'));
			$this->load->model(array('welcome_model','jscss','auth_model','admin_model'));
			$this->load->database();
            //$this->load->library('encrypt');
            
		}
/**============================Admin Login==================================== */
	function login()
	{
		if (!empty($_POST)) {
			$this->form_validation->set_rules('email', 'Email ', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if ($this->form_validation->run() == false) {} else {
				extract($_POST);
				
				if ($data = $this->admin_model->getsinglerow(TBL_USER, array('email' => $email, 'password' => sha1($password), 'type' => 1))) 
				{
					$session = array();
					$session['id'] = $data->id;
					$seesion['type'] = $data->type;
					$session['email'] = $data->email;
					$this->session->set_userdata('admin', $session);
					redirect('admin');
				} else {
						$this->session->set_flashdata('error', 'Invalid login credential');

				} 
			}
		}
		

		$this->load->view('login_admin');

	}


	protected function mydownlines($id){

		$res = $this->welcome_model->getspecificcolomnResult(TBL_TREE,['self_id','child_left','child_right'],[]);
		foreach($res as $row)
		{
	    $this->alldata[$row->self_id] = array($row->child_left , $row->child_right);
	  }
			$this->downlineleft=[];
			$this->downlineright=[];
			$this->leftPending=[];
			$this->rightPending=[];
			$this->isNotFirstTime=0;
			$this->isRightStart=0;
			$this->tempFirstRightSponsorId="";
			
			$this->isDownlineExist($id);
			$common = array_merge($this->downlineleft,$this->downlineright);
			return $this->welcome_model->mydownline($common);
	}

	function getincome($id=null,$self=null){
		$currentDate = date('Y-m-d');
		$res = $this->welcome_model->getspecificcolomnResult(TBL_TREE,['self_id','child_left','child_right'],[]);
		foreach($res as $row)
		{
	      $this->alldata[$row->self_id] = array($row->child_left , $row->child_right);
		}
		$orderData = $this->welcome_model->getspecificcolomnResult(USER_ORDER,['user_id'],[]);
		foreach($orderData as $row){
			$this->allorder[] = $row->user_id;
		}
		$this->isNotFirstTime=0;
    $this->isRightStart=0;
		$this->tempFirstRightSponsorId="";
		$this->isDownlineExist($id);
		$left=[];
		$right=[];
		if(!empty($this->Activedownlineleft)) {
			$dataleft = $this->welcome_model->mybinaryincome($this->Activedownlineleft);
			foreach($dataleft as $row){
				$left[] = $self >=$row->plan ? $row->plan : $self ;
			}
		}
		if(!empty($this->Activedownlineright)){		
			$dataright = $this->welcome_model->mybinaryincome($this->Activedownlineright);
			foreach($dataright as $row){
				$right[] = $self >=$row->plan ? $row->plan : $self ;
			}
		}
		// echo "<pre>"; 
		// // echo "<pre>"; print_r($right);
		$sud = array_values(array_intersect($left, $right));
		$match = [];
		$data = array_count_values($sud);
		$income = 0;
		$lepsdata=[];
		$lepsincome =0;
		$getdata = [];
		for($i=0; $i<count($sud); $i++){
			if($i<20){
				$income += $sud[$i];
				$getdata[]= $sud[$i];
			}else{
				$lepsincome += $sud[$i];
				$lepsdata[] = $sud[$i];
			}
		}
		// echo "GetIncome = ".$income. "LepsIncome = ". $lepsincome; 
		// echo "<pre>"; print_r($getdata);
		// print_r($lepsdata);
		if(count($getdata)>0)
		$this->welcome_model->matchingincome($income,count($getdata),$getdata,$lepsincome,$lepsdata,$id);
	}
	/**============================Admin Login End==================================== */

	/*========================================================================================================= */

	function dummyss($id=null){
		$res = $this->welcome_model->getspecificcolomnResult(TBL_TREE,['self_id','child_left','child_right'],[]);
		foreach($res as $row)
		{
	      $this->alldata[$row->self_id] = array($row->child_left , $row->child_right);
		}
		$plan = $this->welcome_model->getspecificcolomnResult('step_income_plan',[],[]);
		$this->isNotFirstTime=0;
        $this->isRightStart=0;
		$this->tempFirstRightSponsorId="";
		$this->isDownlineExist($id);
		$templeft=[];
		$tempright=[];
		$leftPlan=[];
		$rightPlan=[];
		for($i=0; $i<36; $i++){
			unset($this->downlineleft[$i]);
		}
		for($i=0; $i<36; $i++){
			unset($this->downlineright[$i]);
		}
		$this->downlineleft = array_values($this->downlineleft);
		$this->downlineright = array_values($this->downlineright);
		for($i=0; $i<9; $i++){
			$templeft[] = array('user_id'=>$this->downlineleft[$i]);
			for($j=$i; $j<count($plan);$j++){
				$leftPlan[] = array(
									'sponsor_id' =>$this->downlineleft[$i],
									'upgrade_plan'=>$plan[$j]->plan,
									'plan_benifit' => $plan[$j]->income,
									'binary_benifi' => $plan[$j]->binary_plan
								);
				break;
			}
		}
		for($i=0; $i<9; $i++){
			$tempright[] = array('user_id'=>$this->downlineright[$i]);
			for($j=$i; $j<count($plan);$j++){
				$rightPlan[] = array(
									'sponsor_id' => $this->downlineright[$i],
									'upgrade_plan'=>$plan[$j]->plan,
									'plan_benifit' => $plan[$j]->income,
									'binary_benifi' => $plan[$j]->binary_plan
								);
				break;
			}
		}
		$this->welcome_model->fullinsert(USER_ORDER,array_merge($templeft,$tempright));
		$this->db->update_batch(TBL_USER,$rightPlan,'sponsor_id');
		$this->db->update_batch(TBL_USER,$leftPlan,'sponsor_id');
		echo "<pre>"; print_r($leftPlan);
    }

	/*========================================================================================================= */
	
	private function isDownlineExist($selfid1)
	{
 
		if (array_key_exists($selfid1,$this->alldata))
		{
			if($this->isNotFirstTime){ 
			   
				if($this->isRightStart){
				   
				  $this->tempFirstRightSponsorId="";
				  if(in_array($selfid1,$this->allorder)){
					 $this->Activedownlineright[] = $selfid1;
				  }else{
					$this->downlineright[] = $selfid1;
				  }
 
				}else{
				   if(in_array($selfid1,$this->allorder)){
					$this->Activedownlineleft[] = $selfid1;
				  }else{
					$this->downlineleft[] = $selfid1;
				  }
				}
			}
						if($this->alldata[$selfid1][0]!="" && $this->alldata[$selfid1][1]!=""){
							   
								if($this->isNotFirstTime){
									$this->tempSponsorArray[] = $this->alldata[$selfid1][1];
									$this->isDownlineExist($this->alldata[$selfid1][0]);
								}else{
									$this->isNotFirstTime=1;
									$this->tempFirstRightSponsorId = $this->alldata[$selfid1][1];
									$this->isDownlineExist($this->alldata[$selfid1][0]);
								}
					
						}
						elseif($this->alldata[$selfid1][0]!=""){
								$this->isNotFirstTime=1; 
								$this->isDownlineExist($this->alldata[$selfid1][0]);
 
						}
						elseif($this->alldata[$selfid1][1]!=""){
						  
							if(!$this->isNotFirstTime){
							
								$this->isRightStart=1;
							}
							$this->isNotFirstTime=1;
							$this->isDownlineExist($this->alldata[$selfid1][1]);
 
						}
					  
						elseif(!empty($this->tempSponsorArray)){
								$tempSpoID =  end($this->tempSponsorArray);   
								$key = key($this->tempSponsorArray);
								unset($this->tempSponsorArray[$key]);
								$this->isDownlineExist($tempSpoID);
						}
						elseif($this->tempFirstRightSponsorId!=""){
 
					$this->isRightStart=1;
					$this->isDownlineExist($this->tempFirstRightSponsorId);
			}
						
			   
			
		}
	   
	 }
 
 

}
?>