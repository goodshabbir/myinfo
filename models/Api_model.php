<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Api_model extends CI_model {

      public  $alldata=array();
      public  $allupline=array();
      public  $downlinedata=array();
      public  $counter=array();
      public  $epin = array();
	 function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function accesssinglerow($tableName,$where)
    {
        return $this->db->get_where($tableName,$where)->row();
    }
    function numrowscount($table, $where)
    {
        return $this->db->get_where($table, $where)->num_rows();
    }
    function updateRecord($tableName, $data, $where)
    {
        $this->db->update($tableName, $data, $where);
        return $this->db->affected_rows();
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
    public function register($sponsor_id, $upline_id, $placement, $password, $mobile, $user_name, $email, $full_name,$country_code,$country)
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
        $insert['email']=$email;
        $insert['country_code']=$country_code;
        $insert['country'] = $country;
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
    function getspecificcolomn($table, $select, $where)
    {
        $this->db->select(implode(',', $select));
        return $this->db->get_where($table, $where)->row();
    }
    function getspecificResult($table, $select, $where)
    {
        $this->db->select(implode(',', $select));
        return $this->db->get_where($table, $where)->result();
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
        return $this->allupline;
    }
    function isExist($selfid1)
    {
    if (array_key_exists($selfid1, $this->alldata)) 
    {
        if ($this->alldata[$selfid1] != 0) {
            $newid = $this->alldata[$selfid1];
            $this->allupline[$selfid1] = $newid;
            $this->isExist($newid);
        }
    }
    $this->alldata = array();
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
    function getallresult($table, $array)
    {
        return $this->db->get_where($table, $array)->result();
    }
    function insertRecord($table, $Arrayy)
    {
        return $this->db->insert($table, $Arrayy);
    }
    function AllReligionWithJoin()
    {
        $this->db->select('religions.religions_name,sub_religion.religions_id,sub_religion.sub_religions');
        $this->db->from('religions');
        $this->db->join('sub_religion','sub_religion.sub_religion_id=religions.id','Left');
        $query=$this->db->get();
    }
    function getlevel($id)
    {
        $this->db->select('user.full_name, user.sponsor_id,user.mobile,user.email,user.position,tree.added_by');
        $this->db->from('tree');
        $this->db->join('user', 'user.sponsor_id=tree.self_id', 'inner');
        $this->db->where('tree.added_by', $id);
        return $this->db->get()->result();
    }
    function getlevelIncome($userId)
    {
        $this->db->select('user.full_name, user.sponsor_id,user.mobile,user.email,level_income.level,level_income.level_income,level_income.on_month,level_income.create_at,level_income.status,level_income.behalf_of,level_income.id,level_income.sponsor_id');
        $this->db->from('level_income');
        $this->db->join('user', 'user.sponsor_id=level_income.sponsor_id', 'inner');
        $this->db->where('level_income.sponsor_id', $userId);

        return $this->db->get()->result();
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
    function genratepins($qty, $id, $price, $date)
    {
        for ($i = 0; $i < $qty; $i++) {
            $this->epin();
        }
        $main = array();
        for ($i = 0; $i < count($this->epin); $i++) {
            $main[] = array('epin_code' => $this->epin[$i], 'user_id' => $id, 'price' => $price, 'created_at' => $date);
        }
        $this->db->insert_batch('epin', $main);
        $total = $qty * $price;
        $this->db->set("wallet_amount", "wallet_amount-$total", false);
        $this->db->where('sponsor_id', $id);
        $this->db->update('user');

    }
    function transferepin($epin, $tospo, $fromid, $pin)
    {
        $insert['no_of_epin'] = serialize($epin);
        $insert['from_user'] = $fromid;
        $insert['to_user'] = $tospo;
        $insert['transfer_date'] = date('Y-m-d H:i:s');
        $this->insertRecord(TRNFR_EPN_TBL, $insert);
        $this->db->where_in('epin_code', $pin);
        $this->db->update('epin', array('user_id' => $tospo));
    }
    function mydirect($id)
    {
		$this->db->select(TBL_TREE.'.added_by,'.TBL_USER.'.*');
		$this->db->from(TBL_TREE);
		$this->db->join(TBL_USER,TBL_TREE.'.self_id='.TBL_USER.'.sponsor_id');
		$this->db->where(TBL_TREE.'.added_by',$id);
		return $data = $this->db->get()->result();
    }
    function wholeresult($table, $select, $where)
    {
        $this->db->select(implode(',', $select));
        return $this->db->get_where($table, $where)->result();
    }
  function getsinglerow($table, $where)
    {
        return $data = $this->db->get_where($table, $where)->row();
    }


}
