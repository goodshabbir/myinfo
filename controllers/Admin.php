<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."/Auth.php");
class Admin extends Auth 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url','security'));
        $this->load->library(array('form_validation','session','pagination'));
		$this->load->model(array('admin_model','auth_model','jscss_model')); 
	if (empty($this->session->userdata['admin'])) 
	{
    	redirect(base_url());
	}
	date_default_timezone_set('Asia/Kolkata');
	}
	
	public function index()
	{
		$this->data['page']="Admin";
		$this->data['content']="dashboard/index";
		$this->load->view('admin/admintemplate',$this->data);
	}
	function view_slider()
	{
		$this->data['slider']= $this->admin_model->wholeresult('slider',[],[]);
		$this->data['page'] = "slider";
		$this->data['content'] = "slider/view";
		$this->load->view('admin/admintemplate', $this->data);
	}
	//sliders
	function sliders()
	{
		$this->data['page'] = "slider";
		$this->data['content'] = "slider/index";
		$this->load->view('admin/admintemplate', $this->data);
	}
	function add_slider()
	{
		$allImag = count($_FILES['img']['name']);
		$ext = array('jpg', 'png', 'gif');
		$img = array();
		$rand = rand(10000000, 99999999);
		for ($i = 0; $i < $allImag; $i++) {
			$temp = explode(".", $_FILES["img"]["name"][$i]);
			$newfilename = round(microtime(true)) . '.' . end($temp);
			$tmpFilePath = $_FILES['img']['tmp_name'][$i];
			if ($tmpFilePath != "") {
				$extension = pathinfo($_FILES['img']['name'][$i], PATHINFO_EXTENSION);
				if (in_array($extension, $ext)) {

					$img[] = $rand . $newfilename[$i];

				} else {
					redirect(view_slider);
				}

				$newFilePath = "uploads/slider/" . $rand . $newfilename[$i];
				if (move_uploaded_file($tmpFilePath, $newFilePath)) {
				}
			}
		}

		$save1['slider_tagline'] = $this->input->post('slider_tagline');
		$save2['description'] = $this->input->post('description');
		$save['slider_tagline'] = serialize($save1);
		$save['description'] = serialize($save2);
		$save['slider_img'] = serialize($img);

		$this->admin_model->insertRecord('slider', $save);
		$this->session->set_flashdata('success', 'Great!');
		$this->session->set_flashdata('message', 'Slider Uploaded Successfully');
		redirect(view_slider);

	}
	public function delete_slider()
	{
		$id=$_GET['id'];
		$this->admin_model->deleteSlider($id);
		$this->session->set_flashdata('error', 'Delete!');
		$this->session->set_flashdata('message', 'Slider Deleted Successfully');

		redirect(view_slider,'refresh');
	}
	private function imageupload($path,$name)
    {
        $config['upload_path']          = $path;
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($name))
        {
            $message = array('message' => 'Only jpg , jpeg, gif, png file allowed','success'=>0);
        }
        else
        {
            $data = $this->upload->data();
            $message = array('message' => $data['file_name'],'success'=>1);
        }
        return $message;
    }
	function adminprofile()
	{
		$id = $this->session->userdata['admin']['id'];
		$this->form_validation->set_rules('full_name', 'Full name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('mobile', 'Mobile', 'required');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		if ($this->form_validation->run() == false) {} else {
			$save = array();
			$save = $_POST;
			if (!empty($_FILES['image']['name'])) {
				$path = './profile';
				$data = $this->imageupload($path, $_FILES['image']['name']);
				if ($data['success'] == 0) {
					$this->session->set_flashdata('class', 'error');
					$this->session->set_flashdata('success', $data['message']);
				} else {
					$save['image'] = $data['message'];
				}
			}
			if ($this->admin_model->updateRecord(TBL_USER, $save, ['id' => $id])) 
			{
				$this->session->set_flashdata('class', 'custom');
				$this->session->set_flashdata('message', 'Profile successfully updated');
			}
		}
		$this->data['profile'] = $this->admin_model->getsinglerow(TBL_USER, ['id' => $id]);
		$this->data['page'] = 'profile';
		$this->data['content'] = 'profile/profile';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function changepassword()
	{
		$id = $this->session->userdata['admin']['id'];
		$this->form_validation->set_rules('old_password', 'Old Password', 'required');
		$this->form_validation->set_rules('password', 'New Password', 'required');
		$this->form_validation->set_rules('con_password', 'Confirm Password', 'required|matches[password]');
		if ($this->form_validation->run() == false) {} else {
			extract($_POST);
			if ($this->admin_model->getsinglerow(TBL_USER, ['password' => sha1($old_password), 'id' => $id])) {

				$this->admin_model->updateRecord(TBL_USER, ['password' => sha1($password)], ['id' => $id]);

				$this->session->set_flashdata('class', 'custom');
				$this->session->set_flashdata('message', 'Password successfully updated');

			} else {
				$this->session->set_flashdata('class', 'error');
				$this->session->set_flashdata('message', 'Old password not correct');
			}
		}
		$this->data['page'] = 'changepassword';
		$this->data['content'] = 'profile/changepassword';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function userlist()
	{
		$this->data['user']= $this->admin_model->wholeresult(TBL_USER,[],['type'=>0]);
		$this->data['page'] = 'userlist';
		$this->data['content'] = 'user/index';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function free_user()
	{
		$this->data['user']= $this->admin_model->wholeresult(TBL_USER,[],['type'=>0,'upgrade_plan'=>0]);
		$this->data['page'] = 'Free user';
		$this->data['content'] = 'user/free_member';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function user_plan()
	{
		$this->data['user']= $this->admin_model->wholeresult(TBL_USER,[],['type'=>0]);
		$this->data['page'] = 'Free user';
		$this->data['content'] = 'user/user_plan_page';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function user_income()
	{
		$this->data['user']= $this->admin_model->wholeresult(TBL_USER,[],['type'=>0]);
		$this->data['page'] = 'Free user';
		$this->data['content'] = 'user/user_income_page';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function payment_history()
	{
		$this->data['user']= $this->admin_model->wholeresult(TBL_USER,[],['type'=>0]);
		$this->data['page'] = 'payment history';
		$this->data['content'] = 'user/payment_history_page';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function multiple_id_user()
	{
		$this->data['user']= $this->admin_model->multipleIdUser();
		echo '<pre>';print_r($this->data['user']);die;
		$this->data['page'] = 'payment history';
		$this->data['content'] = 'user/multiple_id_user_page';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function active_inactive($id)
	{
		$status=$this->input->post('status');
		$response=$this->admin_model->ActivInactive($status,$id); 
		if($response > 0)
		{
			$this->session->set_flashdata('success','Great!');
            $this->session->set_flashdata('message','User Status Change Successfully');
			redirect(userlist);
		}
		else{
				$this->session->set_flashdata('success','Great!');
				$this->session->set_flashdata('message','Sorry! Some thing Wrong');
				redirect(userlist);
		}
	}
	function member_profile()
	{
		$this->data['user'] = $this->admin_model->wholeresult(TBL_USER, [], ['type' => 0]);
		$this->data['page'] = 'User Profile List';
		$this->data['content'] = 'user/member_profile_list';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function full_profile()
	{
		$userId = $_GET['list'];
		
		$this->data['ByIDRecord'] = $this->admin_model->getsinglerow(NRML_INFO_TBL, ['user_id'=>$userId]);
		$this->data['birth'] = $this->admin_model->getsinglerow(BIRT_INFO_TBL, ['user_id' => $userId]);
		$this->data['pay'] = $this->admin_model->getsinglerow(PAY_INFO_TBL, ['user_id' => $userId]);
		$this->data['special'] = $this->admin_model->getsinglerow(SPCL_INFO_TBL, ['user_id' => $userId]);
		$this->data['cast'] = $this->admin_model->getsinglerow(CST_INFO_TBL, ['user_id' => $userId]);
		$this->data['family'] = $this->admin_model->getsinglerow(FMTY_INFO_TBL, ['user_id' => $userId]);
		$this->data['generation'] = $this->admin_model->getsinglerow(GNRTN_INFO_TBL, ['user_id' => $userId]);
		$this->data['health'] = $this->admin_model->getsinglerow(HLTH_INFO_TBL, ['user_id' => $userId]);
		$this->data['parsad'] = $this->admin_model->getsinglerow(PRSTN_INFO_TBL, ['user_id' => $userId]);
		$this->data['edu'] = $this->admin_model->getsinglerow(EDU_INFO_TBL, ['user_id' => $userId]);
		$this->data['work'] = $this->admin_model->getsinglerow(WRK_INFO_TBL, ['user_id' => $userId]);
		$this->data['mrg'] = $this->admin_model->getsinglerow(MRG_INFO_TBL, ['user_id' => $userId]);

		$this->data['page'] = 'User Full Profile';
		$this->data['content'] = 'user/get_full_profile_user_wise';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function level_ncome()
	{
		$this->data['Lincome'] = $this->admin_model->getlevelIncome();
		$this->data['page'] = 'Step Income';
		$this->data['content'] = 'income/level_income';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function changestatus($id)
	{
		$status=$this->input->post('status');
		$response=$this->admin_model->change($status,$id); 
		if($response > 0)
		{
			$this->session->set_flashdata('success','Great!');
            $this->session->set_flashdata('message','Amount Release Successfully');
			redirect(step_income);
		}else{
			echo "Some Error Occured";
		}
	}
	function binary_income()
	{
		$this->data['user'] = $this->admin_model->wholeresult(TBL_USER, [], ['type' => 0]);
		$this->data['page'] = 'Matching Income';
		$this->data['content'] = 'income/binary_income';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function all_epin()
	{
		$this->data['epin'] = $this->admin_model->wholeresult('epin', [],[]);
		$this->data['page'] = 'epin history';
		$this->data['content'] = 'epin/all_epin_history';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function epin_history()
	{
		$this->data['epin'] = $this->admin_model->wholeresult(TRNFR_EPN_TBL, [],[]);
		$this->data['page'] = 'epin history';
		$this->data['content'] = 'epin/transfer_epin_history';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function downline_history()
	{
		$sponsorId=$_GET['id'];
		$this->data['mydownline']= Auth::mydownlines($sponsorId);
		$this->data['page'] = 'mydownline';
		$this->data['content'] = 'user/mydownline';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function generate_password()
	{
		
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('cfiorm', 'Password', 'required|matches[cfiorm]');
			if ($this->form_validation->run() == false) 
			{} 	else {
					$userId = $_GET['id'];
					$update['password'] = sha1($this->input->post('password'));
				
					if($this->admin_model->updateRecord(TBL_USER,$update,['id'=>$userId])){
						$this->session->set_flashdata('success', 'Great!');
						$this->session->set_flashdata('message', ' Great! Successfully New Password Generated.');
					}else{
						$this->session->set_flashdata('error', 'sorry!');
						$this->session->set_flashdata('message', ' oh! Something wrong.');

					}
					redirect(userlist);
				}
		
		$this->data['page'] = 'ChangePassword';
		$this->data['content'] = 'user/password';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function latest_news()
	{
		
		$this->data['newss'] = $this->welcome_model->wholeresult('latest_news', [], []);
		
		if (!empty($_POST)) {
			$this->form_validation->set_rules('heading', 'News Description', 'required');
			
			if ($this->form_validation->run() == false) {
				$this->data['page'] = 'news';
				$this->data['content'] = 'news/news';
				$this->load->view('admin/admintemplate', $this->data);
			} 
			else {
				
					date_default_timezone_set('Asia/Kolkata');
					$newss['created_at']=date("Y-m-d H:i:s");
					$newss['heading'] = $this->input->post('heading');
					$newss['title'] = $this->input->post('title');
					//echo '<pre>';die;print_r($newss);die;
					$this->admin_model->insertRecord('latest_news', $newss);
					$this->session->set_flashdata('success', 'Great!');
					$this->session->set_flashdata('message', 'News  Successfully Add');
					redirect(latest_news);
				}

		} else {

			$this->data['page'] = 'news';
			$this->data['content'] = 'news/news';
			$this->load->view('admin/admintemplate', $this->data);

		}


	}
 function delete_news()
	{
		$id=base64_decode($_GET['id']);
		$this->admin_model->deleteNews($id);
		$this->session->set_flashdata('error', 'Delete!');
		$this->session->set_flashdata('message', 'News Delete Successfully');

		redirect(latest_news);
	}
	public function testmonial()
	{
		$this->data['testData'] = $this->admin_model->wholeresult('testmonials', [], []);
		$this->data['state'] = $this->welcome_model->AllState();
		$this->data['page'] = 'testmonial';
		$this->data['content'] = 'testmonial/testmonial_page';
		$this->load->view('admin/admintemplate', $this->data);

	}
	public function getAllCity($id)
	{
		$data = $this->welcome_model->getCity($id);
		echo "<option> Select City</option>";
		
		foreach($data as $row)
		{
			echo "<option value='$row->name'>$row->name</option>";
		}
	}
	public function addtestmonial()
	{
		$this->data['testData'] = $this->admin_model->wholeresult('testmonials',[],[]);
		$this->data['state'] = $this->welcome_model->AllState();
		if(!empty($_POST))
			{ 
				$this->form_validation->set_rules('client_name', 'name', 'required|xss_clean');
				$this->form_validation->set_rules('position', 'Position', 'required|xss_clean');
				$this->form_validation->set_rules('description', 'Decription', 'required|xss_clean');
				$this->form_validation->set_rules('state', 'state', 'required|xss_clean');
				$this->form_validation->set_rules('city', 'city', 'required|xss_clean');


				if($this->form_validation->run()==FALSE)
				{
					if (empty($_FILES['img']['name']))
					{
						$this->form_validation->set_rules('img', 'image', 'required|xss_clean');
						$this->session->set_flashdata('error', 'Formate!');
						$this->session->set_flashdata('message', 'Sorry Image Wrong Format');

					}
					$this->data['page'] = 'testmonial';
					$this->data['content'] = 'testmonial/testmonial_page';
					$this->load->view('admin/admintemplate', $this->data);

				}
				else{
						$allImag = count($_FILES['img']['name']);
						$ext = array('jpg','png','gif');
						$img=array();
						$rand= rand(10000000,99999999);
						for($i=0; $i<$allImag; $i++) 
						{
							$temp = explode(".", $_FILES["img"]["name"][$i]);
							$newfilename = round(microtime(true)) . '.' . end($temp);
							$tmpFilePath = $_FILES['img']['tmp_name'][$i];
							if ($tmpFilePath != "")
							{
							   $extension = pathinfo($_FILES['img']['name'][$i],PATHINFO_EXTENSION);
							  if(in_array($extension,$ext))
							  {
								
								  $img[] = $rand.$newfilename[$i];
								 
							  }else{ 
								 redirect(testmonial);
								}
							   
							   $newFilePath = "uploads/testmonial/" .$rand.$newfilename[$i];
							   if(move_uploaded_file($tmpFilePath, $newFilePath))
							   {	   
							   }
							}
						}
						//date_default_timezone_set('Asia/Kolkata');
						//$TestmonialData['create_date']=date("Y-m-d H:i:s");
						$TestmonialData['client_name']=$this->input->post('client_name');
						$TestmonialData['position']=$this->input->post('position');
						$TestmonialData['description']=$this->input->post('description');
						$TestmonialData['state']=$this->input->post('state');
						$TestmonialData['city']=$this->input->post('city');
						$TestmonialData['img']= serialize($img);
						
						$this->admin_model->insertRecord('testmonials',$TestmonialData);
						$this->session->set_flashdata('success', 'Great!');
						$this->session->set_flashdata('message', 'Testmonial  Successfully Add');
						redirect(testmonial);
					}
				
			}
			else{
				$this->data['page'] = 'testmonial';
				$this->data['content'] = 'testmonial/testmonial_page';
				$this->load->view('admin/admintemplate', $this->data);

			}
		
	}
	
	public function delete_testmonial()
	{
		$id=base64_decode($_GET['id']);
		$this->admin_model->deleteTestmonial($id);
		$this->session->set_flashdata('error', 'Delete!');
		$this->session->set_flashdata('message', 'Testmonial Delete Successfully');

		redirect(testmonial);
	}
	function marriage()
	{
		$this->data['page'] = 'Marriage';
		$this->data['content'] = 'other/marriage_page ';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function personality()
	{
		$this->data['page'] = 'Personality';
		$this->data['content'] = 'other/personality_page ';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function importent()
	{
		$this->data['imp'] = $this->admin_model->wholeresult('impartent_note', [], []);
;
		$this->data['page'] = 'importent';
		$this->data['content'] = 'other/impartent';
		$this->load->view('admin/admintemplate', $this->data);

	}
	public function addimportent_note()
	{
		$this->data['imp'] = $this->admin_model->wholeresult('impartent_note',[],[]);
		
		if(!empty($_POST))
			{ 
				$this->form_validation->set_rules('description', 'description', 'required|xss_clean');		
				if($this->form_validation->run()==FALSE)
				{
					$this->data['page'] = 'importent';
					$this->data['content'] = 'other/impartent';
					$this->load->view('admin/admintemplate', $this->data);
				}
				else{
						$imp['date']=date("Y-m-d H:i:s");
						$imp['description']=$this->input->post('description');
						$this->admin_model->insertRecord('impartent_note',$imp);
						$this->session->set_flashdata('success', 'Great!');
						$this->session->set_flashdata('message', 'Record Add Successfully');
						redirect(importent,'refresh');
					}
				
			}
		else{
				$this->data['page'] = 'impartent';
				$this->data['content'] = 'other/impartent';
				$this->load->view('admin/admintemplate', $this->data);
			}
	}
	public function delete_importent()
	{
		$id=base64_decode($_GET['id']);
		$this->admin_model->deleteImportent($id);
		$this->session->set_flashdata('error', 'Delete!');
		$this->session->set_flashdata('message', 'Record Deleted Successfully');

		redirect(importent);
	}
	function regional_experts()
	{
		$this->data['regi'] = $this->admin_model->wholeresult('regional_experts', [], []);
		$this->data['page'] = 'Regional Experts';
		$this->data['content'] = 'other/regional_experts';
		$this->load->view('admin/admintemplate', $this->data);
	}

	public function addregional_experts()
	{
		$this->data['regi'] = $this->admin_model->wholeresult('regional_experts',[],[]);
		
		if(!empty($_POST))
			{ 
				$this->form_validation->set_rules('first_name', 'First name', 'required|xss_clean');	
				$this->form_validation->set_rules('last_name', 'Surname', 'required|xss_clean');	
				$this->form_validation->set_rules('languege', 'languege', 'required|xss_clean');
				$this->form_validation->set_rules('mobile', 'Mobile Number', 'required|xss_clean');
				$this->form_validation->set_rules('region', 'Region', 'required|xss_clean');

	
				if($this->form_validation->run()==FALSE)
				{
					$this->data['page'] = 'Regional Experts';
					$this->data['content'] = 'other/regional_experts';
					$this->load->view('admin/admintemplate', $this->data);
				}
				else{
						$regi['date']=date("Y-m-d H:i:s");
						$regi['first_name']=$this->input->post('first_name');
						$regi['last_name']=$this->input->post('last_name');
						$regi['languege'] = $this->input->post('languege');
						$regi['mobile'] = $this->input->post('mobile');
						$regi['region'] = $this->input->post('region');

						$this->admin_model->insertRecord('regional_experts',$regi);
						$this->session->set_flashdata('success', 'Great!');
						$this->session->set_flashdata('message', 'Record Add Successfully');
						redirect(regional,'refresh');
					}
				
			}
		else{
				$this->data['page'] = 'Regional Experts';
				$this->data['content'] = 'other/regional_experts';
				$this->load->view('admin/admintemplate', $this->data);
			}
	}
	
	public function delete_regional()
	{
		$id=base64_decode($_GET['id']);
		$this->admin_model->deleteRegional($id);
		$this->session->set_flashdata('error', 'Delete!');
		$this->session->set_flashdata('message', 'Record Deleted Successfully');

		redirect(regional);
	}
	public function religions()
	{
		
		$this->data['religions'] = $this->admin_model->wholeresult('religions_', [], []);
		$this->data['page']="religions";
		$this->data['content']="religions/religions_list";
		$this->load->view('admin/admintemplate',$this->data);
	}
	function add_religions($id=null)
	{
		$this->data['religions'] = $this->admin_model->wholeresult('religions_', [], []);
		if (!empty($id)) {
		
			$this->data['IdByR'] = $this->admin_model->getsinglerow('religions_', ['id' => $id]);

			$this->data['page'] = "religions";
			$this->data['content'] = "religions/religions_list";
			$this->load->view('admin/admintemplate', $this->data);

		} else {
			if (!empty($_POST)) {
				$this->form_validation->set_rules('religions_name', 'Religions', 'required');

				if ($this->form_validation->run() == false) {
					$this->data['page'] = "religions";
					$this->data['content'] = "religions/religions_list";
					$this->load->view('admin/admintemplate', $this->data);

				} 
				else {
						
					if (!empty($this->input->post('id'))) 
					{
						$this->admin_model->updateRecord('religions_', $_POST, ['id' => $this->input->post('id')]);
						$this->session->set_flashdata('success', 'Update!');
						$this->session->set_flashdata('message', 'Religions Successfully Updated');
						redirect(religions, 'refresh');


					} 
					else {
							$this->welcome_model->insertRecord('religions_', $_POST);
							$this->session->set_flashdata('success', 'Great!');
							$this->session->set_flashdata('message', 'Religions Successfully Added');
							redirect(religions,'refresh');
					}
				}
			} 
			else {
				$this->data['page'] = "religions";
				$this->data['content'] = "religions/religions_list";
				$this->load->view('admin/admintemplate', $this->data);

			}
		}

	}
	public function plans()
	{
		
		$this->data['plans'] = $this->admin_model->wholeresult('step_income_plan', [], []);
		$this->data['page']="plans_list";
		$this->data['content']="plans/plans_list";
		$this->load->view('admin/admintemplate',$this->data);
	}
	function add_plans($id=null)
	{
		$this->data['plans'] = $this->admin_model->wholeresult('step_income_plan', [], []);
		if (!empty($id)) {
		
			$this->data['IdByR'] = $this->admin_model->getsinglerow('step_income_plan', ['id' => $id]);

			$this->data['page'] = "plans_list";
			$this->data['content'] = "plans/plans_list";
			$this->load->view('admin/admintemplate', $this->data);

		} else {
			if (!empty($_POST)) {
				$this->form_validation->set_rules('plan', 'Plan', 'required');
				$this->form_validation->set_rules('income', 'Income', 'required');
				$this->form_validation->set_rules('binary_plan', 'Binary plan', 'required');
				$this->form_validation->set_rules('p1', 'Paragraph 1', 'required');
				$this->form_validation->set_rules('p2', 'Paragraph 2', 'required');
				$this->form_validation->set_rules('p3', 'Paragraph 3', 'required');
				$this->form_validation->set_rules('p4', 'Paragraph 4', 'required');

				if ($this->form_validation->run() == false) {
					$this->data['page'] = "plans_list";
					$this->data['content'] = "plans/plans_list";
					$this->load->view('admin/admintemplate', $this->data);

				} 
				else {
						
					if (!empty($this->input->post('id'))) 
					{
						$this->admin_model->updateRecord('step_income_plan', $_POST, ['id' => $this->input->post('id')]);
						$this->session->set_flashdata('success', 'Update!');
						$this->session->set_flashdata('message', 'Plans Successfully Updated');
						redirect(add_plans, 'refresh');


					} 
					else {
							$this->welcome_model->insertRecord('step_income_plan', $_POST);
							$this->session->set_flashdata('success', 'Great!');
							$this->session->set_flashdata('message', 'Plans Successfully Added');
							redirect(add_plans,'refresh');
					}
				}
			} 
			else {
				$this->data['page'] = "plans_list";
				$this->data['content'] = "plans/plans_list";
				$this->load->view('admin/admintemplate', $this->data);

			}
		}

	}
	public function caste()
	{
		//$this->data['caste'] = $this->admin_model->wholeresult('sub_religion_', [], []);
		$this->data['caste']=$this->admin_model->getReligions();
		$this->data['religions'] = $this->admin_model->wholeresult('religions_', [], []);
		$this->data['page']="religions";
		$this->data['content']="religions/caste_list";
		$this->load->view('admin/admintemplate',$this->data);
	}
	function add_caste($id=null)
	{
		//$this->data['caste'] = $this->admin_model->wholeresult('sub_religion_', [], []);
		$this->data['caste'] = $this->admin_model->getReligions();
		
		$this->data['religions'] = $this->admin_model->wholeresult('religions_', [], []);
		if (!empty($id)) {
			$Rid=$this->uri->segment(3);
			
			$this->data['IdByR'] = $this->admin_model->getsinglerow('sub_religion_', ['id' => $id]);
			$this->data['Rselected'] = $this->admin_model->getsinglerow('sub_religion_', ['id' => $Rid]);
			//echo '<pre>';print_r($this->data['Rselected']);die;
			$this->data['page'] = "religions";
			$this->data['content'] = "religions/caste_list";
			$this->load->view('admin/admintemplate', $this->data);


		} else {
			if (!empty($_POST)) {
				$this->form_validation->set_rules('sub_religions', 'caste', 'required');

				if ($this->form_validation->run() == false) {
					$this->data['page'] = "religions";
					$this->data['content'] = "religions/caste_list";
					$this->load->view('admin/admintemplate', $this->data);


				} else {

					if (!empty($this->input->post('id'))) {
						$this->admin_model->updateRecord('sub_religion_', $_POST, ['id' => $this->input->post('id')]);
						$this->session->set_flashdata('success', 'Update!');
						$this->session->set_flashdata('message', 'Caste Successfully Updated');
						redirect(caste,'refresh');

					} else {
						$this->welcome_model->insertRecord('sub_religion_', $_POST);
						$this->session->set_flashdata('success', 'Great!');
						$this->session->set_flashdata('message', 'Caste Successfully Added');
						redirect(caste,'refresh');
					}
				}
			} else {
				$this->data['page'] = "religions";
				$this->data['content'] = "religions/caste_list";
				$this->load->view('admin/admintemplate', $this->data);


			}
		}	

	}
	function getcast()
	{
		$id = $_GET['id'];
		$data = $this->admin_model->wholeresult('sub_religion_', [], ['religions_id' => $id]);
		$array = [];
		foreach ($data as $row) {
			$array[] = "<option value='$row->id'>$row->sub_religions</option>";
		}
		//$temp = "<option value='0786'>Other</option>";
		//array_push($array, $temp);
		echo json_encode($array);
	}

	public function sub_caste()
	{
		//$this->data['sub'] = $this->admin_model->wholeresult('sub_religion_category_', [], []);
		$this->data['sub'] = $this->admin_model->AllReligions();
		$this->data['religions'] = $this->admin_model->wholeresult('religions_', [], []);
		$this->data['page']="religions";
		$this->data['content']="religions/sub_caste_list";
		$this->load->view('admin/admintemplate',$this->data);
	}
	function add_sub_caste($id=null)
	{
		//var_dump($id);die;
		$this->data['sub'] = $this->admin_model->AllReligions();
		$this->data['religions'] = $this->admin_model->wholeresult('religions_', [], []);
		$this->data['sub'] = $this->admin_model->wholeresult('sub_religion_category_', [], []);

		if (!empty($id)) 
		{
			$Rid=$this->uri->segment(3);
			$this->data['Rselected'] = $this->admin_model->getsinglerow('sub_religion_', ['id' => $Rid]);
			
			$this->data['sub'] = $this->admin_model->AllReligions();
			$this->data['IdByR'] = $this->admin_model->getsinglerow('sub_religion_category_', ['id' => $id]);
			$this->data['page'] = "religions";
			$this->data['content'] = "religions/sub_caste_list";
			
			$this->load->view('admin/admintemplate', $this->data);


		} 
		else 
		{
			if (!empty($_POST)) 
			{
				$this->form_validation->set_rules('dharm', 'Sub Caste', 'required');

				if ($this->form_validation->run() == false)
				{
					$this->data['page'] = "religions";
					$this->data['content'] = "religions/sub_caste_list";
					$this->load->view('admin/admintemplate', $this->data);


				} 
				else 
				{

					if (!empty($this->input->post('id'))) 
					{
						$this->admin_model->updateRecord('sub_religion_category_', $_POST, ['id' => $this->input->post('id')]);
						$this->session->set_flashdata('success', 'Update!');
						$this->session->set_flashdata('message', 'Sub Caste Successfully Updated');
						redirect(sub_caste, 'refresh');

					} 
					else 
					{
						$this->welcome_model->insertRecord('sub_religion_category_', $_POST);
						$this->session->set_flashdata('success', 'Great!');
						$this->session->set_flashdata('message', 'Sub Caste Successfully Added');
						redirect(sub_caste, 'refresh');
					}
				}
			} 
			else 
			{
				$this->data['page'] = "religions";
				$this->data['content'] = "religions/sub_caste_list";
				$this->load->view('admin/admintemplate', $this->data);


			}
		}
	}
	function admin_logout()
	{
		$session = array('id', 'id');
		$this->session->unset_userdata($session);
		$this->session->sess_destroy();
		redirect(BASEURL);
	}

}

?>

