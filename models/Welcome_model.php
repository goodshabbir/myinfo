<?php defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('memory_limit', '-1');
date_default_timezone_set('Asia/Kolkata');
class Welcome_model extends CI_Model {
  public  $alldata=array();
  public  $allupline=array();
  public  $downlinedata=array();
  public  $counter=array();
  public  $epin = array();
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function checklogin($id,$pwd){
		$this->db->select('*');
		$this->db->where("(sponsor_id=$id OR user_name=$id)");
		$this->db->where('password',sha1($pwd));
		return $this->db->get(TBL_USER)->row();
	}
	function insertRecord($table, $Arrayy)
	{
		return $this->db->insert($table, $Arrayy);
	}
	function getsinglerow($table,$where){
		return $data = $this->db->get_where($table,$where)->row();
		//echo $this->db->last_query();
		//print_r($data); die;
	}
	function updateRecord($table,$data,$where){
		return $this->db->update($table,$data,$where);
	}
	 function getsinglrowLimit($table, $where)
	{	
		$this->db->select('*');
		$this->db->order_by('id','desc');
		$this->db->limit(1); 
		return $this->db->get_where($table, $where)->row();
		
	}

/**==========================================Registration Start==================================================== */
function getspecificcolomn($table, $select, $where)
{
    $this->db->select(implode(',', $select));
    return $this->db->get_where($table, $where)->row();
}
function wholeresult($table, $select, $where)
{
    $this->db->select(implode(',', $select));
    return $this->db->get_where($table, $where)->result();
}

function getLeftChild($sponser_id)
{

    $Id = $this->db->get_where('tree', ['self_id' => $sponser_id])->row();
    $child_left = $Id->child_left;
    if (!empty($child_left)) {
        $this->getLeftChild($Id->child_left);
    } else {
        $this->array = $Id;

    }

}
function getChildLeftempty()
{
    return $this->array;
}
private function epin() 
	{
		  $randnum = mt_rand(100000000,999999999);
			$this->db->select('epin_code');
			$res=$this->db->get_where('epin',array('epin_code'=>$randnum));
			if($res->num_rows() > 0){
				  return $this->epin();
			}else{
				 return  $this->epin[]=$randnum;
			}

	}
function genratepins($qty,$id,$price,$date){
	for($i=0;$i<$qty; $i++){
		$this->epin();
	}
	$main = array();
	for($i=0;$i<count($this->epin); $i++){
		$main[] = array('epin_code'=>$this->epin[$i],'user_id'=>$id,'price'=>$price,'created_at'=>$date);
	}
	$this->db->insert_batch('epin', $main);
	$total = $qty*$price;
	$this->db->set("wallet_amount","wallet_amount-$total" ,false);
	$this->db->where('sponsor_id',$id);
	$this->db->update('user');

}
private function generateSponsorId() 
	{
		  $randnum = mt_rand(10000000,99999999);
			$this->db->select('self_id');
			$res=$this->db->get_where('tree',array('self_id'=>$randnum));
			if($res->num_rows() > 0){
				  return $this->generateSponsorId();
			}else{
				 return  $randnum;
			}

	}

public function register($sponsor_id,$upline_id,$placement,$password,$mobile,$user_name,$email,$full_name,$country,$countries_isd_code)
	{

		$selfleft="";
		$baseid=date('yd0000');
    	$selfusernewid=$this->generateSponsorId();
		$this->db->trans_start();
        $insert['sponsor_id']=$selfusernewid;
		$insert['password']=sha1($password);
		$insert['mobile']=$mobile;
		$insert['full_name']=$full_name;
		$insert['user_name']=$user_name;
		$insert['position']=$placement;
		$insert['country']=$country;
		$insert['countries_isd_code'] = $countries_isd_code;

		$insert['email']=$email;
		$this->db->insert(TBL_USER,$insert);
		$userID=$this->db->insert_id();
		//=========================================================================INSERT START TREE TABLE ===================================================
		$tree['self_id']=$selfusernewid;
		$tree['upline_id']=$upline_id;
		$tree['added_by']=$sponsor_id;
		$tree['user_id']=$userID;
		$this->db->insert(TBL_TREE,$tree);
		$selfuserID=$this->db->insert_id();


		if($placement=="left")
		{
			$this->db->update(TBL_TREE,array('child_left' => $selfusernewid ) ,array('self_id' =>$upline_id));
		}
		else
		{
			$this->db->update(TBL_TREE,array('child_right' => $selfusernewid ) ,array('self_id' =>$upline_id));
		}
		

	$this->db->trans_complete();
		return $selfusernewid;


	}
function getAllUpline($selfid)
{
    $this->db->select('self_id,upline_id');
    $this->db->from('tree');
    $res = $this->db->get()->result();
    $dataarray = array();
    foreach ($res as $row) {
        $this->alldata[$row->self_id] = $row->upline_id;
    }
    unset($res);
    $this->isExist($selfid);
    $this->alldata = "";
    //echo count($this->allupline);
    //echo "<pre>";print_r($this->allupline);die;
    return $this->allupline;

}
function isExist($selfid1)
{

    if (array_key_exists($selfid1, $this->alldata)) {
        if ($this->alldata[$selfid1] != 0) {
            $newid = $this->alldata[$selfid1];
            $this->allupline[$selfid1] = $newid;
            $this->isExist($newid);
        }
    }
    $this->alldata = array();
}
function getspecificcolomnResult($table, $select, $where)
{
    $this->db->select(implode(',', $select));
    return $this->db->get_where($table, $where)->result();
}

function getRightChild($sponser_id)
{
    $Id = $this->db->get_where('tree', ['self_id' => $sponser_id])->row();
    if (!empty($Id->child_right)) {
        $this->getRightChild($Id->child_right);
    } else {
        return $this->array = $Id;
    }
}

/**==========================================Registration End==================================================== */
public function getCountryList()
{
	return	$q=$this->db->get('countries')->result();
	//print_r($q);die;
}
public function getstateRecored($id)
{
	return $this->db->get_where('states',array('country_id'=>$id))->result();
}
public function getstate()
{
	return $this->db->get('states')->result();
}
public function getcityRecored($id)
{
	 return $this->db->get_where('cities',array('state_id'=>$id))->result();
}
	public function AllState()
	{
		$this->db->select('*');
		$this->db->from('states');
		return $this->db->get()->result();
	}
	public function getCity($id)
	{
		return $this->db->get_where('cities',array('state_id'=>$id))->result();
	}
	function getsinglerowByuser($userId)
	{
		return $data= $this->db->get_where('normal_information',array('user_id'=>$userId))->row();
	}
	function getsinglerowBirth($userId)
	{
		return $data= $this->db->get_where('birth_information',array('user_id'=>$userId))->row();
	} 
	function getsinglerowCast($userId)
	{
		return $data= $this->db->get_where('cost_info',array('user_id'=>$userId))->row();
	}
	function getsinglerowPay($userId)
	{
		return $data= $this->db->get_where('pay_information',array('user_id'=>$userId))->row();
	}
	function getsinglerowSpecialay($userId)
	{
		return $data= $this->db->get_where('special_information',array('user_id'=>$userId))->row();
	}	
	function getsinglerowFamily($userId)
	{	
		return $data= $this->db->get_where('family_information',array('user_id'=>$userId))->row();	
	}
	function getsinglerowGeneration($userId)
	{
		return $data= $this->db->get_where('generation_information',array('user_id'=>$userId))->row();	
	}
	function getsinglerowHealth($userId)
	{
		return $data= $this->db->get_where('health_information',array('user_id'=>$userId))->row();	
	}
	function getsinglerowWork($userId)
	{
		return $data= $this->db->get_where('work_information',array('user_id'=>$userId))->row();	
	}
	function SameCasteMarrige()
	{
		 $matchs[] = $this->db->get_where('cost_info')->row();
	
		$result = array();
		foreach($matchs as $row)
		{
			return $this->db->order_by('id','desc')->get_where('marriage_information',array('cast_marry'=>'yes'))->result();
			// $this->db->get_where('normal_information', array('religions'=>$row->religions))->result();
			$result[] = $row;

		}
		//echo '<pre>';print_r($row->religions);die;
	
		return $result;		

	}
	function getReligions($Self_id)
	{
		$rel[]=$this->db->get_where('cost_info', array('user_id' => $Self_id))->row();
		if(!empty($rel))
		{
		foreach($rel as $row)
		{
			$result=$this->db->get_where('normal_information' ,array('religions'=>$row->religions,'dharm'=>$row->dharm))->result();
			//echo '<pre>';print_r($result);die;
		}
		return $result;
	}else{ echo 'Error';}
		
	}
	function getSubReligions($Self_id)
	{
		return $this->db->order_by('id', 'desc')->get_where('normal_information', array('user_id' => $Self_id))->row();

	}
	function matchingUser($id)
	{
		return $this->db->get_where('normal_information' ,array('user_id'=>$id))->row();
	}
	function getAllPlan()
	{
		return $this->db->get_where('step_income_plan')->result();

	}
	function getlevel($id){
		$this->db->select('user.full_name, user.sponsor_id,user.mobile,user.email,user.position,tree.added_by');
		$this->db->from('tree');
		$this->db->join('user','user.sponsor_id=tree.self_id','inner');
		$this->db->where('tree.added_by',$id);
		return $this->db->get()->result();
	}
	
	public function get_autocomplete($search_data)
	{
		$this->db->select('sponsor_id, id');
		$this->db->like('sponsor_id', $search_data);
		return $this->db->get('user', 10)->result();
	}
	
	function levlele($id){
			$this->db->select(TBL_TREE.'.added_by,'.TBL_USER.'.plan_benifit as profit');
			$this->db->from(TBL_TREE);
			$this->db->join(TBL_USER,TBL_TREE.'.self_id='.TBL_USER.'.sponsor_id');
			$this->db->where(TBL_TREE.'.self_id',$id);
			return $data = $this->db->get()->row();
			echo $this->db->last_query();
			echo "<pre>"; print_r($data); die;

	}

	function mydirect($id){
		$this->db->select(TBL_TREE.'.added_by,'.TBL_USER.'.*');
		$this->db->from(TBL_TREE);
		$this->db->join(TBL_USER,TBL_TREE.'.self_id='.TBL_USER.'.sponsor_id');
		$this->db->where(TBL_TREE.'.added_by',$id);
		return $data = $this->db->get()->result();
		echo $this->db->last_query();
		echo "<pre>"; print_r($data); die;

}
	function forlevelupdatation($sponsor_id,$level,$Pamount,$month,$behalf_id){

		//echo "Sponsor id = ".$sponsor_id. "Level is = ".$level. " Percentage= ".$percentage. " Behalf id = ".$behalf_id. " BV= ".$bv. "Amount". $amount. "On Month=".$month."</br>";
		/**
		 *  sponsor id = level archiver id  
		 *  
		 *  behalf_id = a sponsor who have purchased the product and $sponsor_id id get the level benifit like level 1,2,3,4 or 5
		 *
		 */
							$this->db->select('full_name as name');
		  $behalf_of_name = $this->db->get_where(TBL_USER,array('sponsor_id'=>$behalf_id))->row();
	
		  $benifit = $this->getspecificcolomn(TBL_USER,['plan_benifit as profit'],['sponsor_id'=>$sponsor_id]);

		  $amount = $benifit->profit >= $Pamount ? $Pamount : $benifit->profit;

		   date_default_timezone_set('Asia/Kolkata');
		   $date = date('Y-m-d H:i:s');
	
		   if($getData = $this->db->get_where(TBL_LEVEL_INCOME,array('sponsor_id'=>$sponsor_id,'level'=>$level,'on_month'=>$month))->row()){
	
				$unserilaize_array = unserialize($getData->behalf_of);
				$unserilaize_array[] = array('member_name'=>$behalf_of_name->name,'sponsor_id'=>$behalf_id,'purchase_amount'=>$amount,'on_date'=>$date);
				$this->db->set('level_income',"level_income+$amount",false);
				$this->db->update(TBL_LEVEL_INCOME,array('behalf_of'=> serialize($unserilaize_array)),array('sponsor_id'=>$sponsor_id,'level'=>$level,'on_month'=>$month));
	
		   }else{
			   $temp_array = array();
			   $temp_array[] = array('member_name'=>$behalf_of_name->name,'sponsor_id'=>$behalf_id,'purchase_amount'=>$amount,'on_date'=>$date);
			  
			   $insert['sponsor_id']    = $sponsor_id;
			   $insert['level']         = $level;
			   $insert['behalf_of']     = serialize($temp_array);
			   $insert['level_income']  = $amount;
			   $insert['on_month']      = $month;
			  // echo "<pre>"; print_r($insert);
			   $this->db->insert(TBL_LEVEL_INCOME,$insert);
		   }
	   }
	
	   // update transfer epin

	   function transferepin($epin,$tospo,$fromid,$pin){
		   $insert['no_of_epin'] = serialize($epin);
		   $insert['from_user'] = $fromid;
		   $insert['to_user'] = $tospo;
		   $insert['transfer_date'] = date('Y-m-d H:i:s');
		   $this->insertRecord(TRNFR_EPN_TBL,$insert);
		   $this->db->where_in('epin_code',$pin);
		   $this->db->update('epin',array('user_id'=>$tospo));
	   }

	   function mydownline($data){
		   $this->db->where_in('sponsor_id',$data);
		   return $this->db->get(TBL_USER)->result();
	   }
  function devitEpin($userId)
  {
	  	$query="SELECT epin_transfer.*,pehla.sponsor_id as firstid,pehla.full_name as firstName, pehla.id , dusra.id, dusra.sponsor_id as dusraid, dusra.full_name as dusraName FROM epin_transfer LEFT JOIN user as pehla ON epin_transfer.from_user=pehla.sponsor_id LEFT JOIN user as dusra ON dusra.sponsor_id = epin_transfer.to_user";
		return $this->db->query($query)->result();

  }
  function creditEpin($userId)
  {
	  	// $this->db->select('user.full_name,user.mobile,user.email,epin_transfer.no_of_epin,epin_transfer.from_user,epin_transfer.to_user,epin_transfer.transfer_date,epin_transfer.id');
		// $this->db->from('epin_transfer');
		// $this->db->join('user', 'user.sponsor_id=epin_transfer.from_user', 'inner');
		// $this->db->where('epin_transfer.to_user',$userId);
		// return $this->db->get()->result();
		return $this->db->get_where('epin_transfer', array('to_user' => $userId))->result();
  }
  function getlevelIncome($userId)
	{
		$this->db->select('user.full_name, user.sponsor_id,user.mobile,user.email,level_income.level,level_income.level_income,level_income.on_month,level_income.create_at,level_income.status,level_income.behalf_of,level_income.id,level_income.sponsor_id');
		$this->db->from('level_income');
		$this->db->join('user', 'user.sponsor_id=level_income.sponsor_id', 'inner');
		$this->db->where('level_income.sponsor_id',$userId);

		return $this->db->get()->result();
	}
	function fullinsert($table,$data){
		$this->db->insert_batch($table,$data);
	}
	function updateBatch($table,$data){
		
		$this->db->update_batch(TBL_USER, $data,'sponsor_id');
		echo $this->db->last_query();
	}

	function mybinaryincome($data){
				$this->db->select('binary_benifi as plan');
				$this->db->where_in('sponsor_id',$data);
		return  $this->db->order_by('binary_benifi','DESC')->get(TBL_USER)->result();
	}

	function matchingincome($income,$pair,$accessData,$lepsincome,$lepsData,$user_id){
		
			$insert['on_pair'] = $pair;
			$insert['income'] = $income;
			$insert['leps_income'] = $lepsincome;
			$insert['access_data'] = serialize($accessData);
			$insert['leps_data'] = serialize($lepsData);

			if($data = $this->getsinglerow(MATCHING_INCOME,['user_id'=>$user_id,'on_date'=>date('Y-m-d')])){
				
				$this->updateRecord(MATCHING_INCOME,$insert,['user_id'=>$user_id,'on_date'=>date('Y-m-d')]);

			}else{
				$insert['user_id']= $user_id;	
				$insert['on_date'] = date('Y-m-d');
				$this->insertRecord(MATCHING_INCOME,$insert);
			}
	}
	function getMatchingIncome()
	{
		$this->db->select('user.full_name, user.sponsor_id,user.mobile,user.email,user.position,tree.added_by');
		$this->db->from('tree');
		$this->db->join('user','user.sponsor_id=tree.self_id','inner');
		$this->db->where('tree.added_by',$id);
		return $this->db->get()->result();
	}
	function getTopMatchIncome()
	{
    	// $this->db->select_max('income');
    	// $this->db->from('daily_matching_income');
    	// $query = $this->db->get();
    	// $result=$query->result();
		// echo '<pre>';print_r($result);die;
		$this->db->select('user.full_name, user.sponsor_id,user.mobile,user.email,daily_matching_income.income,daily_matching_income.user_id');
		$this->db->from('daily_matching_income');
		$this->db->join('user','user.sponsor_id=daily_matching_income.user_id','inner');
		return $this->db->get()->result();
	}
	function getRelegionsNameById($UserId)
	{
		$this->db->select('normal_information.user_id,normal_information.religions, religions.religions_name,religions.id');
		$this->db->from('religions');
		$this->db->join('normal_information', 'normal_information.religions=religions.id', 'inner');
		$this->db->where('normal_information.user_id', $UserId);
		return $this->db->get()->row();
	}
	function getSubRelegionsNameById($UserId)
	{
		$this->db->select('normal_information.user_id,normal_information.sub_religions, sub_religion.sub_religions,sub_religion.id');
		$this->db->from('sub_religion');
		$this->db->join('normal_information', 'normal_information.sub_religions=sub_religion.id', 'inner');
		$this->db->where('normal_information.user_id', $UserId);
		return $this->db->get()->row();

	}
	function getSubRelegionsCategoryNameById($UserId)
	{
		$this->db->select('normal_information.user_id,normal_information.dharm, sub_religion_category.dharm,sub_religion_category.id');
		$this->db->from('sub_religion_category');
		$this->db->join('normal_information', 'normal_information.dharm=sub_religion_category.id', 'inner');
		$this->db->where('normal_information.user_id', $UserId);
		return $this->db->get()->row();

	} 
	function getRelegionNameById($UserId)
	{
		$this->db->select('normal_information.user_id,normal_information.religions, normal_information.sub_religions, normal_information.dharm,religions.id,religions.religions_name');
		$this->db->from('religions');
		$this->db->join('normal_information', 'normal_information.religions=religions.id', 'inner');
		$this->db->where('normal_information.user_id', $UserId);
		return $this->db->get()->row();

	}
	function getCasteNameById($UserId)
	{
		$this->db->select('normal_information.user_id,normal_information.religions, normal_information.sub_religions, normal_information.dharm,sub_religion.religions_id,sub_religion.sub_religions');
		$this->db->from('sub_religion');
		$this->db->join('normal_information', 'normal_information.sub_religions=sub_religion.religions_id', 'inner');
		$this->db->where('normal_information.user_id', $UserId);
		return $this->db->get()->row();

	}


} 
?>