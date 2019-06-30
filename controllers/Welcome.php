<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
			$this->load->helper(array('form','url'));
			$this->load->library(array('session','form_validation'));
			$this->load->model(array('welcome_model','jscss_model'));
		}
	function index()
	{
		$data['test'] = $this->welcome_model->wholeresult('testmonials', [], []);
		$data['slider'] = $this->welcome_model->wholeresult('slider', [], []);
		$data['mtchincm'] = $this->welcome_model->getTopMatchIncome();
		$this->load->view('index',$data);
	}
	function plan_purchase()
	{
		extract($_POST);
		
		if(!empty($this->session->userdata['user']['id']))
		{
			
			// echo '<pre>';print_r($_POST);die;
		}else{
			redirect(login);
		}
	}
	function returnurl()
	{
		$this->load->view('thankyou');
	}
	function  packege()
	{
		$data['plans'] = $this->welcome_model->wholeresult(STEP_INCOME, [], []);
		$this->load->view('packege_page',$data);
	}
	function user(){
		$this->form_validation->set_rules('sponsor_id','Login Id','required');
		$this->form_validation->set_rules('password','Password','required');
		if($this->form_validation->run()==false){}else{
			extract($_POST);
			if($data = $this->welcome_model->checklogin($sponsor_id,$password)) {
					if($data->is_active==1)
					{ 
						
					$session = array();
					$session['id'] = $data->id;
					$session['sponsor_id'] = $sponsor_id;
					$session['upgrade_plan'] = $upgrade_plan;
					$this->session->set_userdata('user',$session);
					if($data->status==0)
					{
					 redirect('user/model');
					}
					else{
					redirect('user');

					}
					
					}elseif($data->is_active==0)
					{
						$message ='Sorry! You are temporary Block';
						$this->session->set_flashdata('class', 'danger');
						$this->session->set_flashdata('error', $message);
						//redirect('login');
					}
			}else{

				$this->session->set_flashdata('error','Invalid login credential');
			}
		}
		$this->load->view('login');
	}
	

	function test($sponsor_id='PW12345678',$upline_id='PW12345677'){
		if($this->checkSpoRightOrNot($sponsor_id,$upline_id)){
			echo "sahi hai";
		}else{
			echo "galat hai";
		}
		//$this->welcome_model->getAllUpline($id);
	}
	
/**==========================================Registration Start==================================================== */
function checkid($id)
{
    if ($id != '') {
        if ($this->welcome_model->getspecificcolomn(TBL_USER, ['sponsor_id'], ['sponsor_id' => $id])) {
            return true;
        } else {
            $this->form_validation->set_message('checkid', 'Sponsor id not valid');
            return false;
        }
    } else {
        $this->form_validation->set_message('checkid', 'Sponsor id field is required');
        return false;
    }
}
public function registration()
	{
		$this->data['country'] = $this->welcome_model->wholeresult('country_isd_code', [], []);
		extract($_POST);
		$this->form_validation->set_rules('sponsor_id', 'Sponsor Id', 'required|callback_checkid');
		$this->form_validation->set_rules('placement', 'Choose position', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('confirm', 'Confirm Password', 'required|matches[password]');
		$this->form_validation->set_rules('mobile', 'Mobile Number', 'required');
		$this->form_validation->set_rules('full_name', 'Your Name', 'required');
		$this->form_validation->set_rules('checkbx', 'Term and condition', 'required');
		if ($this->form_validation->run() == false)
		{
			
		} else {
			
			if (($placement == 'left' || $placement == 'right')) {
				$direct = array();

				if ($placement == "left") {
					$upline_id = $this->check_left_postion($sponsor_id);
					$lastId = $this->welcome_model->register($sponsor_id, $upline_id, $placement, $password, $mobile, $user_name, $email, $full_name,$country,$countries_isd_code);
					$message = "Dear " . $full_name . " Thanks you for registration in myinformation.in . Your user id is " . $lastId . " and login password is " . $password . " ";
					$this->session->set_flashdata('class', 'success');
					$this->session->set_flashdata('msg', $message);
					//$this->message($message, $mobile);
					if(isset($from_user) && ($from_user==1)){
						redirect('user/refferal_signup');
					}else{
						redirect(signup);
					}
				} elseif ($placement == "right") {
					$upline_id = $this->check_right_postion($sponsor_id);
					$lastId = $this->welcome_model->register($sponsor_id, $upline_id, $placement, $password, $mobile, $user_name, $email, $full_name,$country,$countries_isd_code);
					$message = "Dear " . $full_name . " Thanks you for registration in myinformation.in . Your user id is " . $lastId . " and login password is " . $password . " ";
					$this->session->set_flashdata('class', 'success');
					$this->session->set_flashdata('msg', $message);

					//$this->message($message, $mobile);
					if (isset($from_user) && ($from_user == 1)) {
						redirect('user/refferal_signup');
					} else {
						redirect(signup);
					}

				} else {
					$message = $placement . 'side already full';
					$this->session->set_flashdata('class', 'danger');
					$this->session->set_flashdata('msg', $message);
	

				}

			} else {
				$message = "Oho! you have to try another action on this site so don`t have a permision for try thired party entry here heheheh";die;
				$this->session->set_flashdata('class', 'warning');
				$this->session->set_flashdata('msg', $message);


			}
		} //end else
		
		if (isset($from_user) && ($from_user == 1)) {
			$this->data['page'] = 'signup';
			$this->data['content'] = 'registration/registration';
			$this->load->view('user/template', $this->data);

		}else{
			$this->load->view('register', $this->data);
		}

	}
	function check_left_postion($id)
	{
		$this->welcome_model->getLeftChild($id);
		$get = $this->welcome_model->getChildLeftempty();
		return $get->self_id;

	}
	private function checkSpoRightOrNot($self_id,$id)
	{
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

function check_right_postion($id)
{
    $this->welcome_model->getRightChild($id);
    $get = $this->welcome_model->getChildLeftempty();
    return $get->self_id;
}
	public function getupsponsornmae($id=null)

	{

		$self_id=$this->input->get('sponsor_id');

		$upline_id=$this->input->get('upline_id');

		if($upline_id!=''){

			$data=$this->front_model->getAllUpline($upline_id);

			//print_r($data);

			if (array_key_exists($self_id,$data) || in_array($self_id,$data)){

					$sponsordata=$this->front_model->getupsponsornmae($upline_id);

					echo $sponsordata->user_name;

			}

			else{

				 return false;

			}

		}else{

			 return false;

		}

	}
/**==========================================Registration End==================================================== */	
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
	function about()
	{
		$this->load->view('about');
	}
	function faq()
	{
		$this->load->view('faq');
	}
	function contact()
	{
		$this->load->view('contact');
	}
	function regional_experts()
	{
		$data['regional']=$this->welcome_model->wholeresult('regional_experts',[],[]);
		$this->load->view('regional_experts',$data);
	}
	function privacy_policy()
	{
		$this->load->view('privacy_policy');
	}
	function terms_condition()
	{
   	 $this->load->view('terms_use');
	}
	function legal()
	{
   	 $this->load->view('legal');
	}
	function share_earn()
	{
   	 $this->load->view('share_earn');
	}
	function our_bank()
	{
   	 $this->load->view('our_bank');
	}
	function forgot()
	{
		$this->load->view('forgot');
	}
	
	
	
}
