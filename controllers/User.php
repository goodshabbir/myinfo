<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."/Auth.php");
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 3000);
class User extends Auth {
   public $i=0;
   public $mybenifit=0;
   public function __construct() {
		parent::__construct();
			$this->load->helper(array('form','url','encrypt'));
			$this->load->library(array('session','form_validation'));
            $this->load->model(array('welcome_model','jscss_model'));
            $this->load->database();
            if(empty($this->session->userdata['user'])){
                redirect(login);
            }  
            date_default_timezone_set('Asia/Kolkata');
            $income = $this->welcome_model->getspecificcolomn(TBL_USER,['binary_benifi'],['sponsor_id'=>sponsorid()]);
            $this->mybenifit = $income->binary_benifi;
        }
      
       
    function model()
    {
       $this->data['page'] = 'model';
        $this->data['content'] = 'dashboard/model';
        $this->load->view('user/template',$this->data); 
    }
    function update_member()
    {
        $id=$this->session->userdata['user']['id'];
        if(!empty($_POST))
        {
          $this->form_validation->set_rules('profile_type', 'Member type', 'required');
           
            if($this->form_validation->run() == false)
            {
                $this->data['page'] = 'model';
                $this->data['content'] = 'dashboard/model';
                $this->load->view('user/template',$this->data); 
            }else{
                    $up['profile_type']=$this->input->post('profile_type');
                    if($this->welcome_model->updateRecord(TBL_USER,$up,['id' => $id])){
                    $this->session->set_flashdata('class','custom');
                    $this->session->set_flashdata('success','Member Type updated successfully');
                    redirect(activation);
                }
            }  
        }
    } 
     private function singleImage($path,$imagename){

            $config['upload_path']          = $path;
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload($imagename))
            {                   
                return false;
            }
            else
            {
                $data = $this->upload->data();
                return  $data['file_name'];
            }
    }
    function index()
    {
        $sposorId=$this->session->userdata['user']['sponsor_id'];
        $sponser=$this->welcome_model->getsinglerow(TBL_TREE,['self_id' => $sposorId]);
       
        $addedby=$sponser->added_by;
        $this->data['My_Sponsor_User_ID']=$this->welcome_model->getsinglerow(TBL_USER,['sponsor_id' => $addedby]);
        // print_r($data);die;
        if($this->mybenifit!=0)
        Auth :: getincome(sponsorid(),$this->mybenifit);
       
        $this->data['page'] = 'index';
        $this->data['content'] = 'dashboard/index';
        $this->load->view('user/template',$this->data);
    }
    function graphicalView(){
        $this->data['page'] = 'graphical_view';
        $this->data['content'] = 'geneoalogy/graphical_view';
        $this->load->view('user/template',$this->data);
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
    private function MultipleImageUpload($files,$path,$title)
    { 
       $tempp = array_filter($files['name']);
        // for multiple file uploads
        $config = array(
            'upload_path'   => $path,
            'allowed_types' => 'jpg|gif|png|jpeg',
            'overwrite'     => 1,                       
        ); 
        $this->load->library('upload', $config);
        $images = array();
        foreach($tempp as $key => $image) 
        {
            $_FILES['images[]']['name']= $files['name'][$key];
            $_FILES['images[]']['type']= $files['type'][$key];
            $_FILES['images[]']['tmp_name']= $files['tmp_name'][$key];
            $_FILES['images[]']['error']= $files['error'][$key];
            $_FILES['images[]']['size']= $files['size'][$key];
            $fileName = $title .'_'. $image;
            $images[] = $fileName;
            $config['file_name'] = $fileName;
            $this->upload->initialize($config);
            if($this->upload->do_upload('images[]')) 
            {
                $this->upload->data();
            } else {
                return false;
            }
        }
       //print_r($images);die;
        return $images;
    }
    function userprofile()
    {
        $id = $this->session->userdata['user']['id'];
        $this->form_validation->set_rules('full_name','Full name','required');
        $this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('mobile','Mobile','required');
        $this->form_validation->set_rules('gender','Gender','required');
        if($this->form_validation->run()==false){}else{
            $save = array();
            $save = $_POST;
            if(!empty($_FILES['image']['name'])){
                $path = './profile';
                $data = $this->imageupload($path,$_FILES['image']['name']);
                if($data['success']==0){
                    $this->session->set_flashdata('class','error');
                    $this->session->set_flashdata('success',$data['message']);
                }else{
                    $save['image'] = $data['message'];
                }
            }
            
           //echo '<pre>'; print_r($save);die;
            if($this->welcome_model->updateRecord(TBL_USER,$save,['id' => $id])){
                $this->session->set_flashdata('class','custom');
                $this->session->set_flashdata('success','Profile updated successfully');
            }
        }
        $this->data['profile'] = $this->welcome_model->getsinglerow(TBL_USER,['id' => $id]);
        $this->data['page'] = 'show_profile';
        $this->data['content'] = 'Profile_manager/show_profile';
        $this->load->view('user/template',$this->data);
    }
    function setting(){
        $id = $this->session->userdata['user']['id'];
        $this->form_validation->set_rules('old_password','Old Password','required');
        $this->form_validation->set_rules('password','New Password','required');
        $this->form_validation->set_rules('con_password','Confirm Password','required|matches[password]');
        if($this->form_validation->run()==false){}else{
            extract($_POST);
            if($this->welcome_model->getsinglerow(TBL_USER,['password'=>sha1($old_password),'id' => $id])){
                
                    $this->welcome_model->updateRecord(TBL_USER,['password' => sha1($password)],['id' => $id]);

                    $this->session->set_flashdata('class','custom');
                    $this->session->set_flashdata('message','Password successfully updated');

            }else{
                    $this->session->set_flashdata('class','error');
                    $this->session->set_flashdata('message','Old password not correct');
            }
        }
        $this->data['page'] = 'show_profile';
        $this->data['content'] = 'Profile_manager/setting';
        $this->load->view('user/template',$this->data);
    }
    public function personal_details()
    {
        $this->data['page'] = 'other_details';
        $this->data['content'] = 'Profile_manager/other_details';
        $this->load->view('user/template',$this->data);
    }
    // public function getAllCity($id)
	// {
	// 	$data = $this->welcome_model->getCity($id);
	// 	echo "<option> Select City</option>";
	// 	foreach($data as $row)
	// 	{
	// 		echo "<option value='$row->name'>$row->name</option>";
	// 	}
    // }
    public function getallstate($id)
	 {
		  $data=$this->welcome_model->getstateRecored($id);
		  foreach($data as $row)
		  {
		  echo "<option value='$row->id'>$row->name</option>";
		  }
	 }
	public function getallcity($id)
	 {
		  $data=$this->welcome_model->getcityRecored($id);
		  foreach($data as $row)
		  {
		  echo "<option value='$row->name'>$row->name</option>";
		  }
     }
    //  public function getallCountry()
	//  {
	// 	  $data=$this->welcome_model->getCountryList();
	//  }
    public function my_information()
    { 
        $data=$this->welcome_model->getCountryList();
        // print_r($data);die;
        $userId= $this->session->userdata['user']['id'];
        $this->data['byId']=$this->welcome_model->getsinglerow('user',['id'=>$userId]);
        $this->data['state']=$this->welcome_model->AllState();
        $this->data['country'] = $this->welcome_model->wholeresult('countries', [], []);
        $this->data['religionsName'] = $this->welcome_model->getRelegionNameById($userId);
        $this->data['subRName'] = $this->welcome_model->getCasteNameById($userId);


        $this->data['dharm'] = $this->welcome_model->wholeresult('religions', [], []);
        $this->data['subReli'] = $this->welcome_model->wholeresult('sub_religion', [], []);
        $this->data['districts'] = $this->welcome_model->wholeresult('districts', [], []);
        $data=$this->data['ByIDRecord']=$this->welcome_model->getsinglerowByuser($userId);
        
        $this->data['birth']=$this->welcome_model->getsinglerowBirth($userId);
        $this->data['cast']=$this->welcome_model->getsinglerowCast($userId);
        
        $this->data['pay']=$this->welcome_model->getsinglerowPay($userId);
        $this->data['special']=$this->welcome_model->getsinglerowSpecialay($userId);
		$this->data['family']=$this->welcome_model->getsinglerowFamily($userId);
		$this->data['generation']=$this->welcome_model->getsinglerowGeneration($userId);
		$this->data['health']=$this->welcome_model->getsinglerowHealth($userId);
        $this->data['work']=$this->welcome_model->getsinglerowWork($userId);
        $this->data['spclById']=$this->welcome_model->getsinglerow(NRML_INFO_TBL,['user_id' => $userId]);
        $this->data['education'] = $this->welcome_model->getsinglerow(EDU_INFO_TBL, ['user_id' => $userId]);
        $this->data['mrge'] = $this->welcome_model->getsinglerow('marriage_information', ['user_id' => $userId]);
        $this->data['president'] = $this->welcome_model->getsinglerow(PRSTN_INFO_TBL, ['user_id' => $userId]);

        $this->data['page'] = 'my_information';
        $this->data['content'] = 'myinformaion/my_information';
        $this->load->view('user/template',$this->data);
    }
    
    function dummy()
    {
       
            $array =[];
            $this->form_validation->set_rules('fname','your name','required');
            $this->form_validation->set_rules('gender','your gender','required');
            $this->form_validation->set_rules('father_name','father name','required');
            //$this->form_validation->set_rules('married_status','married status','required');
            // $this->form_validation->set_rules('religions','religions','required');
            // $this->form_validation->set_rules('language','language','required');
            // $this->form_validation->set_rules('district','district','required');
            // $this->form_validation->set_rules('state','state','required');
            // $this->form_validation->set_rules('country','country','required');
            
            if($this->form_validation->run()==false){
                    $array = array('fname' => form_error('fname'),
                                    'gender' => form_error('gender'),
                                    'father_name' => form_error('father_name'),
                                    //'married_status' => form_error('married_status'),
                                    // 'language' => form_error('language'),
                                    // 'district' => form_error('district'),
                                    // 'religions' => form_error('religions'),
                                    // 'state' => form_error('state'),
                                    // 'country' => form_error('country')
                                 );

            }
            else{
                extract($_POST);
                $data =$_POST;
                $countryName =  $this->welcome_model->getspecificcolomn('countries',['name'],['id'=>$country]);
                $stateName =  $this->welcome_model->getspecificcolomn('states',['name'],['id'=>$state]);
                $data['country'] =   $countryName->name;
                $data['state'] =   $stateName->name;
            //    echo "<pre>"; print_r($data); die;
                    $id=userid(); 
                    $istrue=1;
                   $arrayFilter=array_values(array_filter($_FILES['photo_1']['name']));
                    if(!empty($arrayFilter)){
                         $image = $this->MultipleImageUpload($_FILES['photo_1'], './uploads/profile', 'photo_1');
                         if($image!=false){
                                $data['photo_1'] = serialize($image);
                         }else{
                            $istrue=0;  
                         }
                    } 
                 
                if($istrue!=0){
                    if ($this->welcome_model->getsinglerow(NRML_INFO_TBL, ['user_id' => $id])) {
                    $this->welcome_model->updateRecord(NRML_INFO_TBL, $data, ['user_id' => $id]);
                    $array = array('success' =>  'General Information Successfully Updated');
                } else {
                        $this->welcome_model->insertRecord(NRML_INFO_TBL,$data);
                        $array = array('success' => ' General Information Successfully Saved');
                    }

                }else{
                      $array = array('success' => 'Wrong Format');
                }   
               
            }
           // echo '<pre>';print_r($array);die;
           echo json_encode($array);

    }
   public function birth_info()
   {
        $array = [];
        $this->form_validation->set_rules('birth_of_name', 'birth-name', 'required');
        $this->form_validation->set_rules('place_of_birth', 'palce of birth', 'required');
        $this->form_validation->set_rules('birth_village', 'birth_village', 'required');
        $this->form_validation->set_rules('tehsil', 'tehsil', 'required');
        if ($this->form_validation->run() == false) 
        {
            $array = array(
                            'birth_of_name' => form_error('birth_of_name'),
                            'place_of_birth' => form_error('place_of_birth'),
                            'birth_village' => form_error('birth_village'),
                            'tehsil' => form_error('tehsil'),
                        );


        } else {
            $data = $_POST;
            $id = userid();
            $istrue = 1;
            $arrayFilter = array_values(array_filter($_FILES['kundli_img']['name']));
            if (!empty($arrayFilter)) {
                $image = $this->MultipleImageUpload($_FILES['kundli_img'], './uploads/birth_kundali', 'kundli_img');
                if ($image != false) {
                    $data['kundli_img'] = serialize($image);
                } else {
                    $istrue = 0;
                }
            }

            if ($istrue != 0) {
                if ($this->welcome_model->getsinglerow(BIRT_INFO_TBL, ['user_id' => $id])) {
                    $this->welcome_model->updateRecord(BIRT_INFO_TBL, $data, ['user_id' => $id]);
                    $array = array('success' => 'Birth Information Successfully Updated');
                } else {
                    $this->welcome_model->insertRecord(BIRT_INFO_TBL, $data);
                    $array = array('success' => ' Birth Information Successfully Saved');
                }

            } else {
                $array = array('success' => 'Wrong Format');
            }

        }
        echo json_encode($array);

   }
   function cast_information()
    {
       $array = [];
        $this->form_validation->set_rules('gauta', 'your gauta', 'required');
        $this->form_validation->set_rules('kul', 'your kul', 'required');
        $this->form_validation->set_rules('kuldevi_name', 'kuldevi name', 'required');
        $this->form_validation->set_rules('address_of_kuldevi', 'address of kuldevi', 'required');
        $this->form_validation->set_rules('kuldevata_name', 'kuldevata name', 'required');
        $this->form_validation->set_rules('kuldevata_address', 'kuldevata address', 'required');
        $this->form_validation->set_rules('maama_gautr', 'maama-gautr', 'required');
        $this->form_validation->set_rules('maama_kul', 'maama-kul', 'required');

        

        if ($this->form_validation->run() == false) {
            $array = array(
                        'gauta' => form_error('gauta'),
                        'kul' => form_error('kul'),
                        'kuldevi_name' => form_error('kuldevi_name'),
                        'address_of_kuldevi' => form_error('address_of_kuldevi'),
                        'kuldevata_name' => form_error('kuldevata_name'),
                        'kuldevata_address' => form_error('kuldevata_address'),
                        'maama_gautr' => form_error('maama_gautr'),
                        'maama_kul' => form_error('maama_kul'),
                    );

        } else {
                $data = $_POST;
                $id = userid();
                $istrue = 1;
                /*=========--------------Kuldevi Image--------========================== */
                $arrayFilter = array_values(array_filter($_FILES['kuldevi_img']['name']));
                if (!empty($arrayFilter)) {
                    $image = $this->MultipleImageUpload($_FILES['kuldevi_img'], './uploads/kuldevi', 'kuldevi_img');
                    if ($image != false) {
                        $data['kuldevi_img'] = serialize($image);
                    } else {
                        $istrue = 0;
                    }
                } 
                /*=========--------------Kuldevata Image--------========================== */
                $arrayFilterKul = array_values(array_filter($_FILES['kuldevata_img']['name']));
                if (!empty($arrayFilterKul)) {
                    $imageKul = $this->MultipleImageUpload($_FILES['kuldevata_img'], './uploads/kuldevata', 'kuldevata_img');
                    if ($imageKul != false) {
                        $data['kuldevata_img'] = serialize($imageKul);
                    } else {
                        $istrue = 0;
                    }
                }
                /*=========----------------------========================== */
                $arrayFilterInfo = array_values(array_filter($_FILES['info_img']['name']));
                if (!empty($arrayFilterInfo)) {
                    $imageInfo = $this->MultipleImageUpload($_FILES['info_img'], './uploads/information', 'info_img');
                    if ($imageInfo != false) {
                        $data['info_img'] = serialize($imageInfo);
                    } else {
                        $istrue = 0;
                    }
                }

            //if ($istrue != 0) {
                if ($this->welcome_model->getsinglerow(CST_INFO_TBL, ['user_id' => $id])) {
                    $this->welcome_model->updateRecord(CST_INFO_TBL, $data, ['user_id' => $id]);
                    $array = array('success' => 'Caste Information Successfully Updated');
                } else {
                    $this->welcome_model->insertRecord(CST_INFO_TBL, $data);
                    $array = array('success' => ' Caste Information Successfully Saved');
                }

            //  } else {
            //    $array = array('success' => 'Wrong Format');
            // }

        }
        echo json_encode($array);

    }
    function pay_information()
    {
        $array =[];
        if($this->form_validation->run()==false){ 
        }else{
                $id=userid();
                $add1['ac_holder_name']=$this->input->post('ac_holder_name');
                $add2['account_no']=$this->input-> post('account_no');
                $add3['bank_name']=$this->input->post ('bank_name');
                $add4['branch']=$this->input->post('branch');
                $add5['ifsc']=$this->input->post('ifsc');

                $save['ac_holder_name']=serialize($add1);
                $save['account_no']=serialize($add2);
                $save['branch']=serialize($add3);
                $save['bank_name']=serialize($add4);
                $save['ifsc']=serialize($add5);

                $save['paytm_no']=$this->input-> post('paytm_no');
                $save['paytm_address']=$this->input->post('paytm_address');
                $save['bhim_address']=$this->input->post('bhim_address');
                $save['bhim_no']=$this->input->post('bhim_no');
                $save['google_pay']=$this->input->post ('google_pay');
                $save['phonepe_no']=$this->input->post ('phonepe_no');
                $save['google_upi']=$this->input->post ('google_upi');
                $save['phonepe_upi']=$this->input->post  ('phonepe_upi');
                $save['user_id']=$id;
            if($this->welcome_model->getsinglerow(PAY_INFO_TBL,['user_id'=>$id])){
                $this->welcome_model->updateRecord(PAY_INFO_TBL,$save,['user_id'=>$id]);
                $array=array('success' => 'Record Updated');	
           }else{
            $this->welcome_model->insertRecord(PAY_INFO_TBL,$save);
            $array=array('success' => 'Record Saved');	
           }
        }
       
       echo json_encode($array);
       
    }


    function special_information()
    {
        $array = [];
        $this->form_validation->set_rules('votar_no', 'Voter number', 'required');
        if ($this->form_validation->run() == false)
         {
            $array = array(
                        'votar_no' => form_error('votar_no'),
                        
                    );

        } else {
            $data = $_POST;
            $id = userid();
            $istrue = 1;
            /*=============------------------Votar Id------================ */

            $arrayFilter = array_values(array_filter($_FILES['votar_img']['name']));
            if (!empty($arrayFilter)) {
                $image = $this->MultipleImageUpload($_FILES['votar_img'], './uploads/special/voter', 'votar_img');
                if ($image != false) {
                    $data['votar_img'] = serialize($image);
                } else {
                    $istrue = 0;
                }
            }
            /*=============------------------Aadhar Cart------================ */

            $arrayFilterAd = array_values(array_filter($_FILES['aadhar_img']['name']));
            if (!empty($arrayFilterAd)) {
                $imageAd = $this->MultipleImageUpload($_FILES['aadhar_img'], './uploads/special/addhar', 'aadhar_img');
                if ($imageAd != false) {
                    $data['aadhar_img'] = serialize($imageAd);
                } else {
                    $istrue = 0;
                }
            }
            /*=============------------------ Pan Card------================ */
            $arrayFilterPan = array_values(array_filter($_FILES['pan_img']['name']));
            if (!empty($arrayFilterPan)) {
                $imagePan = $this->MultipleImageUpload($_FILES['pan_img'], './uploads/special/pan', 'pan_img');
                if ($imagePan != false) {
                    $data['pan_img'] = serialize($imagePan);
                } else {
                    $istrue = 0;
                }
            }
           /*=============------------------ Birth Certificate------================ */
            $arrayFilterBRTH = array_values(array_filter($_FILES['birth_img']['name']));
            if (!empty($arrayFilterBRTH)) {
                $imageBRTH = $this->MultipleImageUpload($_FILES['birth_img'], './uploads/special/birth', 'birth_img');
                if ($imageBRTH != false) {
                    $data['birth_img'] = serialize($imageBRTH);
                } else {
                    $istrue = 0;
                }
            }
            /*=============------------------ Birth Certificate------================ */
            $arrayFilterINCM = array_values(array_filter($_FILES['income_img']['name']));
            if (!empty($arrayFilterINCM)) {
                $imageINCM = $this->MultipleImageUpload($_FILES['income_img'], './uploads/special/income', 'income_img');
                if ($imageINCM != false) {
                    $data['income_img'] = serialize($imageINCM);
                } else {
                    $istrue = 0;
                }
            }
           
            $arrayFilterDes = array_values(array_filter($_FILES['disability_img']['name']));
            if (!empty($arrayFilterDes)) {
                $imageDes = $this->MultipleImageUpload($_FILES['disability_img'], './uploads/special/income', 'disability_img');
                if ($imageDes != false) {
                    $data['disability_img'] = serialize($imageDes);
                } else {
                    $istrue = 0;
                }
            }
            /*=============------------------ speciality_img------================ */
            $arrayFilterDes1 = array_values(array_filter($_FILES['speciality_img']['name']));
            if (!empty($arrayFilterDes1)) {
                $imageDes1 = $this->MultipleImageUpload($_FILES['speciality_img'], './uploads/special/speciality_img', 'speciality_img');
                if ($imageDes1 != false) {
                    $data['speciality_img'] = serialize($imageDes1);
                } else {
                    $istrue = 0;
                }
            }
            if ($istrue != 0) {
                if ($this->welcome_model->getsinglerow(SPCL_INFO_TBL, ['user_id' => $id])) {
                    $this->welcome_model->updateRecord(SPCL_INFO_TBL, $data, ['user_id' => $id]);
                    $array = array('success' => 'Special Information Successfully Updated');
                } else {
                    $this->welcome_model->insertRecord(SPCL_INFO_TBL, $data);
                    $array = array('success' => ' Special Information Successfully Saved');
                }

            } else {
                $array = array('success' => 'Wrong Format');
            }

        }
        
        echo json_encode($array);

       
    }
    function education_information()
    {
        
        $array = [];
        $this->form_validation->set_rules('my_education', 'my education', 'required');
        if ($this->form_validation->run() == false) {
            $array = array(
                'my_education' => form_error('my_education')
            );

        } 
        else {
            $data = $_POST;
           
            $id = userid();
            $istrue = 1;
            /*=========--------------School's  Education--------========================== */
            $arrayFilter = array_values(array_filter($_FILES['school_certificate']['name']));
            if (!empty($arrayFilter)) {
                $image = $this->MultipleImageUpload($_FILES['school_certificate'], './uploads/education/school', 'school_certificate');
                if ($image != false) {
                    $data['school_certificate'] = serialize($image);
                } else {
                    $istrue = 0;
                }
            }
            /*=========--------------Collage certificate Image--------========================== */
            $arrayFilterCLLG = array_values(array_filter($_FILES['certificate']['name']));
            if (!empty($arrayFilterCLLG)) {
                $imageCLLG = $this->MultipleImageUpload($_FILES['certificate'], './uploads/education/college', 'certificate');
                if ($imageCLLG != false) {
                    $data['certificate'] = serialize($imageCLLG);
                } else {
                    $istrue = 0;
                }
            }
            /*=========-------------------Other certificate---========================== */
            $arrayFilterInfo = array_values(array_filter($_FILES['other_certificate']['name']));
            if (!empty($arrayFilterInfo)) {
                $imageInfo = $this->MultipleImageUpload($_FILES['other_certificate'], './uploads/education/other', 'other_certificate');
                if ($imageInfo != false) {
                    $data['other_certificate'] = serialize($imageInfo);
                } else {
                    $istrue = 0;
                }
            }
           
            $schooName['school_name']           =    $this->input->post('school_name');
            $CollageName['collage_class_name']  =    $this->input->post('collage_class_name');
            $OtherName['other_class_name']      =    $this->input->post('other_class_name');

            $data['school_name'] =  serialize($schooName);
            $data['collage_class_name'] = serialize($CollageName);
            $data['other_class_name'] = serialize($OtherName);

             
            if ($istrue != 0) {
            if ($this->welcome_model->getsinglerow(EDU_INFO_TBL, ['user_id' => $id])) {
                $this->welcome_model->updateRecord(EDU_INFO_TBL, $data, ['user_id' => $id]);
                $array = array('success' => 'Education Information Successfully Updated');
            } else {
                $this->welcome_model->insertRecord(EDU_INFO_TBL, $data);
                $array = array('success' => ' Education Information Successfully Saved');
            }

             } else {
               $array = array('success' => 'Wrong Format');
             }

        }
        echo json_encode($array);

        
    }

	function family_information()
    {
        $array =[];
        if($_POST['Mstatus']=='Married')
        {
            // $this->form_validation->set_rules('home_length','home length','required');
            // $this->form_validation->set_rules('home_width','home width','required');
            // $this->form_validation->set_rules('no_of_room','number of room','required');
		if($this->form_validation->run()==false){
				$array = array(//'no_of_family' => form_error('no_of_family'),
								// 'present_no_of_family' => form_error('present_no_of_family'),
								// 'home_length' => form_error('home_length'),
								// 'home_width' => form_error('home_width'),
								// 'no_of_room' => form_error('no_of_room')
                                );
            }
            }else{
                $id=userid('id');
                if($this->welcome_model->getsinglerow(FMTY_INFO_TBL,['user_id'=>$id])){
                    $this->welcome_model->updateRecord(FMTY_INFO_TBL,$_POST,['user_id'=>$id]);
                    $array=array('success' => 'Family Information Successfully Updated');	
               }else{
                $this->welcome_model->insertRecord(FMTY_INFO_TBL,$_POST);
                $array=array('success' => 'Family Information Successfully Saved');	
               }
            }
           echo json_encode($array);

    }
        
    function generation_information()
    {
        $array = [];
         $this->form_validation->set_rules('father', 'father', 'required');
        // $this->form_validation->set_rules('mother', 'mother', 'required');
        // $this->form_validation->set_rules('grandfather', 'grandfather', 'required');
        // $this->form_validation->set_rules('grandmother', 'grandmother', 'required');
        if ($this->form_validation->run() == false) 
        {
            $array = array('father' => form_error('father')
                                // 'mother' => form_error('mother'),
                                // 'grandfather' => form_error('grandfather'),
                                // 'grandmother' => form_error('grandmother'),
                            );
        } 
        else {
            $data = $_POST;
            $id = userid();
            $istrue = 1;
            /*=========------------------father_img----========================== */
            $arrayFilter = array_values(array_filter($_FILES['father_img']['name']));
            if (!empty($arrayFilter)) {
                $image = $this->MultipleImageUpload($_FILES['father_img'], './uploads/generation', 'father_img');
                if ($image != false) {
                    $data['father_img'] = serialize($image);
                } else {
                    $istrue = 0;
                }
            }
            /*=========--------------mother_img--------========================== */
            $arrayFilterCLLG = array_values(array_filter($_FILES['mother_img']['name']));
            if (!empty($arrayFilterCLLG)) {
                $imageCLLG = $this->MultipleImageUpload($_FILES['mother_img'], './uploads/generation', 'mother_img');
                if ($imageCLLG != false) {
                    $data['mother_img'] = serialize($imageCLLG);
                } else {
                    $istrue = 0;
                }
            }
            /*=========----------------------========================== */
            $arrayFilterInfo = array_values(array_filter($_FILES['grandfather_img']['name']));
            if (!empty($arrayFilterInfo)) {
                $imageInfo = $this->MultipleImageUpload($_FILES['grandfather_img'], './uploads/generation', 'grandfather_img');
                if ($imageInfo != false) {
                    $data['grandfather_img'] = serialize($imageInfo);
                } else {
                    $istrue = 0;
                }
            }
            /*=========----------------------========================== */
            $arrayFilterInfo1 = array_values(array_filter($_FILES['grandmother_img']['name']));
            if (!empty($arrayFilterInfo1)) {
                $imageInfo1 = $this->MultipleImageUpload($_FILES['grandmother_img'], './uploads/generation', 'grandmother_img');
                if ($imageInfo1 != false) {
                    $data['grandmother_img'] = serialize($imageInfo1);
                } else {
                    $istrue = 0;
                }
            }
            /*=========----------------------========================== */
            $arrayFilterInfo2 = array_values(array_filter($_FILES['great_grandfather_img']['name']));
            if (!empty($arrayFilterInfo2)) {
                $imageInfo2 = $this->MultipleImageUpload($_FILES['great_grandfather_img'], './uploads/generation', 'great_grandfather_img');
                if ($imageInfo2 != false) {
                    $data['great_grandfather_img'] = serialize($imageInfo2);
                } else {
                    $istrue = 0;
                }
            }
            /*=========----------------------========================== */
            $arrayFilterInfo3 = array_values(array_filter($_FILES['great_grandmother_img']['name']));
            if (!empty($arrayFilterInfo3)) {
                $imageInfo3 = $this->MultipleImageUpload($_FILES['great_grandmother_img'], './uploads/generation', 'great_grandmother_img');
                if ($imageInfo3 != false) {
                    $data['great_grandmother_img'] = serialize($imageInfo3);
                } else {
                    $istrue = 0;
                }
            }
            /*----------------------------------------------------------*/
            $arrayFilterInfo4 = array_values(array_filter($_FILES['great_grandfather_father_img']['name']));
            if (!empty($arrayFilterInfo4)) {
                $imageInfo4 = $this->MultipleImageUpload($_FILES['great_grandfather_father_img'], './uploads/generation', 'great_grandfather_father_img');
                if ($imageInfo4 != false) {
                    $data['great_grandfather_father_img'] = serialize($imageInfo4);
                } else {
                    $istrue = 0;
                }
            }
            /*----------------------------------------------------------*/
            $arrayFilterInfo5 = array_values(array_filter($_FILES['great_grandmother_mother_img']['name']));
            if (!empty($arrayFilterInfo5)) {
                $imageInfo5 = $this->MultipleImageUpload($_FILES['great_grandmother_mother_img'], './uploads/generation', 'great_grandmother_mother_img');
                if ($imageInfo5 != false) {
                    $data['great_grandmother_mother_img'] = serialize($imageInfo5);
                } else {
                    $istrue = 0;
                }
            }
            /*----------------------------------------------------------*/
            $arrayFilter6 = array_values(array_filter($_FILES['mother5_img']['name']));
            if (!empty($arrayFilter6)) {
                $image6 = $this->MultipleImageUpload($_FILES['mother5_img'], './uploads/generation', 'mother5_img');
                if ($image6 != false) {
                    $data['mother5_img'] = serialize($image6);
                } else {
                    $istrue = 0;
                }
            }
            /*----------------------------------------------------------*/

            $arrayFilter7 = array_values(array_filter($_FILES['father5_img']['name']));
            if (!empty($arrayFilter7)) {
                $image7 = $this->MultipleImageUpload($_FILES['father5_img'], './uploads/generation', 'father5_img');
                if ($image7 != false) {
                    $data['father5_img'] = serialize($image7);
                } else {
                    $istrue = 0;
                }
            }
            /*----------------------------------------------------------*/
            $arrayFilter8 = array_values(array_filter($_FILES['mother6_img']['name']));
            if (!empty($arrayFilter8)) {
                $image8 = $this->MultipleImageUpload($_FILES['mother6_img'], './uploads/generation', 'mother6_img');
                if ($image8 != false) {
                    $data['mother6_img'] = serialize($image8);
                } else {
                    $istrue = 0;
                }
            }
            /*----------------------------------------------------------*/
            $arrayFilter9 = array_values(array_filter($_FILES['mother7_img']['name']));
            if (!empty($arrayFilter9)) {
                $image9 = $this->MultipleImageUpload($_FILES['mother7_img'], './uploads/generation', 'mother7_img');
                if ($image9 != false) {
                    $data['mother7_img'] = serialize($image9);
                } else {
                    $istrue = 0;
                }
            }
            /*----------------------------------------------------------*/
            $arrayFilter1m = array_values(array_filter($_FILES['maternal1']['name']));
            if (!empty($arrayFilter1m)) {
                $imagess1 = $this->MultipleImageUpload($_FILES['maternal1'], './uploads/generation', 'maternal1');
                if ($imagess1 != false) {
                    $data['maternal1'] = serialize($imagess1);
                } else {
                    $istrue = 0;
                }
            }
            /*---------------------------------------------------------*/
            $arrayFilter11 = array_values(array_filter($_FILES['maternal_grandmother_m_m_m_m_m_img']['name']));
            if (!empty($arrayFilter11)) {
                $image11 = $this->MultipleImageUpload($_FILES['maternal_grandmother_m_m_m_m_m_img'], './uploads/generation', 'maternal_grandmother_m_m_m_m_m_img');
                if ($image11 != false) {
                    $data['maternal_grandmother_m_m_m_m_m_img'] = serialize($image11);
                } else {
                    $istrue = 0;
                }
            }
            /*----------------------------------------------------------*/
            $arrayFilter12 = array_values(array_filter($_FILES['maternal_grandmother_m_m_m_f_img']['name']));
            if (!empty($arrayFilter12)) {
                $image12 = $this->MultipleImageUpload($_FILES['maternal_grandmother_m_m_m_f_img'], './uploads/generation', 'maternal_grandmother_m_m_m_f_img');
                if ($image12 != false) {
                    $data['maternal_grandmother_m_m_m_f_img'] = serialize($image12);
                } else {
                    $istrue = 0;
                }
            }
            /*----------------------------------------------------------*/
            $arrayFilter13 = array_values(array_filter($_FILES['maternal_grandmother_m_m_m_m_img']['name']));
            if (!empty($arrayFilter13)) {
                $image13 = $this->MultipleImageUpload($_FILES['maternal_grandmother_m_m_m_m_img'], './uploads/generation', 'maternal_grandmother_m_m_m_m_img');
                if ($image13 != false) {
                    $data['maternal_grandmother_m_m_m_m_img'] = serialize($image13);
                } else {
                    $istrue = 0;
                }
            }
            /*----------------------------------------------------------*/
            $arrayFilter14 = array_values(array_filter($_FILES['maternal_grandmother_m_m_f_img']['name']));
            if (!empty($arrayFilter14)) {
                $image14 = $this->MultipleImageUpload($_FILES['maternal_grandmother_m_m_f_img'], './uploads/generation', 'maternal_grandmother_m_m_f_img');
                if ($image14 != false) {
                    $data['maternal_grandmother_m_m_f_img'] = serialize($image14);
                } else {
                    $istrue = 0;
                }
            }
            /*----------------------------------------------------------*/
            $arrayFilter15 = array_values(array_filter($_FILES['maternal_grandmother_m_m_m_img']['name']));
            if (!empty($arrayFilter15)) {
                $image15 = $this->MultipleImageUpload($_FILES['maternal_grandmother_m_m_m_img'], './uploads/generation', 'maternal_grandmother_m_m_m_img');
                if ($image15 != false) {
                    $data['maternal_grandmother_m_m_m_img'] = serialize($image15);
                } else {
                    $istrue = 0;
                }
            }
            /*----------------------------------------------------------*/
            $arrayFilter16 = array_values(array_filter($_FILES['maternal_grandmother_m_f_img']['name']));
            if (!empty($arrayFilter16)) {
                $image16 = $this->MultipleImageUpload($_FILES['maternal_grandmother_m_f_img'], './uploads/generation', 'maternal_grandmother_m_f_img');
                if ($image16 != false) {
                    $data['maternal_grandmother_m_f_img'] = serialize($image16);
                } else {
                    $istrue = 0;
                }
            }
            /*----------------------------------------------------------*/
            $arrayFilter17 = array_values(array_filter($_FILES['maternal_grandmother_m_m_img']['name']));
            if (!empty($arrayFilter17)) {
                $image17 = $this->MultipleImageUpload($_FILES['maternal_grandmother_m_m_img'], './uploads/generation', 'maternal_grandmother_m_m_img');
                if ($image17 != false) {
                    $data['maternal_grandmother_m_m_img'] = serialize($image17);
                } else {
                    $istrue = 0;
                }
            }
            /*----------------------------------------------------------*/
            $arrayFilter17 = array_values(array_filter($_FILES['maternal_grandmother_m_m_img']['name']));
            if (!empty($arrayFilter17)) {
                $image17 = $this->MultipleImageUpload($_FILES['maternal_grandmother_m_m_img'], './uploads/generation', 'maternal_grandmother_m_m_img');
                if ($image17 != false) {
                    $data['maternal_grandmother_m_m_img'] = serialize($image17);
                } else {
                    $istrue = 0;
                }
            }
            /*----------------------------------------------------------*/
            $arrayFilter18 = array_values(array_filter($_FILES['maternal_granfather_f_img']['name']));
            if (!empty($arrayFilter18)) {
                $image18 = $this->MultipleImageUpload($_FILES['maternal_granfather_f_img'], './uploads/generation', 'maternal_granfather_f_img');
                if ($image18 != false) {
                    $data['maternal_granfather_f_img'] = serialize($image18);
                } else {
                    $istrue = 0;
                }
            }
            /*----------------------------------------------------------*/
            $arrayFilter19 = array_values(array_filter($_FILES['maternal_grandmother_m_img']['name']));
            if (!empty($arrayFilter19)) {
                $image19 = $this->MultipleImageUpload($_FILES['maternal_grandmother_m_img'], './uploads/generation', 'maternal_grandmother_m_img');
                if ($image19 != false) {
                    $data['maternal_grandmother_m_img'] = serialize($image19);
                } else {
                    $istrue = 0;
                }
            }

            /*----------------------------------------------------------*/
            $arrayFilter20 = array_values(array_filter($_FILES['maternal_grandfather_img']['name']));
            if (!empty($arrayFilter20)) {
                $image20 = $this->MultipleImageUpload($_FILES['maternal_grandfather_img'], './uploads/generation', 'maternal_grandfather_img');
                if ($image20 != false) {
                    $data['maternal_grandfather_img'] = serialize($image20);
                } else {
                    $istrue = 0;
                }
            }
            /*----------------------------------------------------------*/
            $arrayFilter21 = array_values(array_filter($_FILES['maternal_grandmother_img']['name']));
            if (!empty($arrayFilter21)) {
                $image21 = $this->MultipleImageUpload($_FILES['maternal_grandmother_img'], './uploads/generation', 'maternal_grandmother_img');
                if ($image21 != false) {
                    $data['maternal_grandmother_img'] = serialize($image21);
                } else {
                    $istrue = 0;
                }
            }
            /*----------------------------------------------------------*/
            $arrayFilter22 = array_values(array_filter($_FILES['my_mother_img']['name']));
            if (!empty($arrayFilter21)) {
                $image22 = $this->MultipleImageUpload($_FILES['my_mother_img'], './uploads/generation', 'my_mother_img');
                if ($image22 != false) {
                    $data['my_mother_img'] = serialize($image22);
                } else {
                    $istrue = 0;
                }
            }

            // if ($istrue != 0) {
            if ($this->welcome_model->getsinglerow(GNRTN_INFO_TBL, ['user_id' => $id])) {
                $this->welcome_model->updateRecord(GNRTN_INFO_TBL, $data, ['user_id' => $id]);
                $array = array('success' => 'Gereration Information Successfully Updated');
            } else {
                $this->welcome_model->insertRecord(GNRTN_INFO_TBL, $data);
                $array = array('success' => ' Gereration Information Successfully Saved');
            }

            //  } else {
            //    $array = array('success' => 'Wrong Format');
            //  }

        }
        echo json_encode($array);
    }
	function health_information()
    {
       // echo '<pre>';print_r($_POST);die;
		$array =[];
		$this->form_validation->set_rules('disabled','disabled','required');
		//$this->form_validation->set_rules('crippled_side','in which side of crippled ','required'); 
		
		if($this->form_validation->run()==false){
				$array = array('disabled' => form_error('disabled'),
					            //'mother' => form_error('crippled_side')
						        );
            }else{
                $id=userid('id');
                if($this->welcome_model->getsinglerow(HLTH_INFO_TBL,['user_id'=>$id])){
                    $this->welcome_model->updateRecord(HLTH_INFO_TBL,$_POST,['user_id'=>$id]);
                    $array=array('success' => 'Health Information Successfully Updated');	
               }else{
                $this->welcome_model->insertRecord(HLTH_INFO_TBL,$_POST);
                $array=array('success' => 'Health Information Successfully Saved');	
               }
            }
            
           echo json_encode($array);

    }
      
    function working_information()
    {  	
    $array =[];
    
    $this->form_validation->set_rules('work_situation','current situation ','required');
   
    
    if($this->form_validation->run()==false)
    {
        $array = array('work_situation' => form_error('work_situation'),);
    }else{
        $id=userid('id');
        if($this->welcome_model->getsinglerow(WRK_INFO_TBL,['user_id'=>$id])){
            $this->welcome_model->updateRecord(WRK_INFO_TBL,$_POST,['user_id'=>$id]);
            $array=array('success' => 'Work Information Successfully');
        }else{
            $this->welcome_model->insertRecord(WRK_INFO_TBL,$_POST);
            $array=array('success' => 'Work Information Successfully Saved');
        }
    }
    
    echo json_encode($array);
        
    }
    
    function marriage_information()
    {
        $array =[];
       //$this->form_validation->set_rules('cast_marry','caste marry','required');
        //$this->form_validation->set_rules('devoce_w','devoce woman','required'); 
        
        if($this->form_validation->run()==false){
            //$array = array();
            // $array = array('cast_marry' => form_error('cast_marry'),
              // 'devoce_w' => form_error('devoce_w') 
                
           //);
        }else{
            $id=userid('id');
            if($this->welcome_model->getsinglerow(MRG_INFO_TBL,['user_id'=>$id])){
                $this->welcome_model->updateRecord(MRG_INFO_TBL,$_POST,['user_id'=>$id]);
                $array=array('success' => 'Record Updated');
            }else{
                $this->welcome_model->insertRecord(MRG_INFO_TBL,$_POST);
                $array=array('success' => 'Record Saved');
            }
        }
        echo json_encode($array);
        
    }
    function president_information()
{
    
    $array = [];
        $this->form_validation->set_rules('president_name', 'name', 'required');
        if ($this->form_validation->run() == false) {
            $array = array(
                        'president_name' => form_error('president_name')
                    );

        } else {
                $data = $_POST;
                $id = userid();
                $istrue = 1;
                /*=========-------------- Image--------========================== */
                $arrayFilter = array_values(array_filter($_FILES['president_img']['name']));
                if (!empty($arrayFilter)) {
                    $image = $this->MultipleImageUpload($_FILES['president_img'], './uploads/caste_president', 'president_img');
                    if ($image != false) {
                        $data['president_img'] = serialize($image);
                    } else {
                        $istrue = 0;
                    }
                } 
                /*=========-------------- Image--------========================== */
                $arrayFilterKul = array_values(array_filter($_FILES['img']['name']));
                if (!empty($arrayFilterKul)) {
                    $imageKul = $this->MultipleImageUpload($_FILES['img'], './uploads/caste_president', 'img');
                    if ($imageKul != false) {
                        $data['img'] = serialize($imageKul);
                    } else {
                        $istrue = 0;
                    }
                }
                

            if ($istrue != 0) {
                if ($this->welcome_model->getsinglerow(PRSTN_INFO_TBL, ['user_id' => $id])) {
                    $this->welcome_model->updateRecord(PRSTN_INFO_TBL, $data, ['user_id' => $id]);
                    $array = array('success' => 'Caste President Information Successfully Updated');
                } else {
                    $this->welcome_model->insertRecord(PRSTN_INFO_TBL, $data);
                    $array = array('success' => ' Caste President Information Successfully Saved');
                }

             } else {
               $array = array('success' => 'Wrong Format');
            }

        }
        echo json_encode($array);

}
    function profile_matching()
    { 
        $Self_id=userid('id');
        // $this->data['religion'] = $this->welcome_model->getReligions($Self_id);
        // $this->data['subreli'] = $this->welcome_model->getSubReligions($Self_id);
        $this->data['page'] = 'marriage_profile';
        $this->data['content'] = 'marriage_profile/marriage_profile';
        $this->load->view('user/template',$this->data);
    }
   public function add_photos_marriage()
	{
		$Self_id=userid('id');
        $this->data['religion'] = $this->welcome_model->getReligions($Self_id);
        $this->data['subreli'] = $this->welcome_model->getSubReligions($Self_id);
		
		if(!empty($_POST))
			{ 
				//$this->form_validation->set_rules('first_name', 'First name', 'required|xss_clean');	
				if($this->form_validation->run()==FALSE)
				{
					$this->data['page'] = 'marriage_profile';
                    $this->data['content'] = 'marriage_profile/marriage_profile';
                    $this->load->view('user/template',$this->data);
				}
				else{
                        
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
                                    redirect(profile_matching,'refresh');
                                }

                                $newFilePath = "uploads/marriage/" . $rand . $newfilename[$i];
                                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                                }
                            }
                        } 
                        $photo['marriage_profile_img']= serialize($img);
                        if($this->input->post('id')){
						$this->welcome_model->updateRecord('normal_information',$photo,$this->input->post('id'));
						$this->session->set_flashdata('success', 'Great!');
						$this->session->set_flashdata('message', 'Profile Updated Successfully');
                        redirect(profile_matching,'refresh');
                    }
                    }
					}
				
			
		else{
				$this->data['page'] = 'marriage_profile';
                $this->data['content'] = 'marriage_profile/marriage_profile';
                $this->load->view('user/template',$this->data);
			}
	}
	

	function send_message()
	{
        //$user_id = userid('id');
       // $this->data['match'] = $this->welcome_model->FetchDataMultipleTBL($user_id);
        $matchId=$_GET['id'];
        //echo $matchId;die;
        $this->data['match']=$this->welcome_model->matchingUser($matchId);
        $this->data['page'] = 'marriage_profile';
        $this->data['content'] = 'marriage_profile/member_marriage_list';
        $this->load->view('user/template',$this->data);
    }
    function all_document()
    {
        $this->data['page'] = 'my_information';
        $this->data['content'] = 'myinformaion/document';
        $this->load->view('user/template', $this->data);
    }
    function resume()
    {
        $userId= userid('id');
        $this->data['byId']=$this->welcome_model->getsinglerow('user',['id'=>$userId]);
        $data=$this->data['ByIDRecord'] =   $this->welcome_model->getsinglerow(NRML_INFO_TBL,['user_id' => $userId]);
        $this->data['work']             =   $this->welcome_model->getsinglerow(WRK_INFO_TBL,['user_id' => $userId]);
        $this->data['special']         =   $this->welcome_model->getsinglerow(SPCL_INFO_TBL,['user_id' => $userId]);
        $this->data['education']        =   $this->welcome_model->getsinglerow(EDU_INFO_TBL, ['user_id' => $userId]);
    
        $this->data['page'] = 'resume';
        $this->data['content'] = 'resume/resume';
        $this->load->view('user/template', $this->data);
    }
    function plan()
    {
        $this->data['income']=$this->welcome_model->getAllPlan();
        $this->data['page'] = 'plan';
        $this->data['content'] = 'plan/plan';
        $this->load->view('user/template', $this->data);
    }   
    function level() 
    { 
        $id= $this->session->userdata['user']['sponsor_id'];
        $data = $this->welcome_model->getlevel($id);
        //echo '<pre>';print_r($data);die;

        $array= array();
        if(!empty($data)){
            foreach($data as $first){
                 $array['first'][] = $first;

                 /*========================= for second level===================*/
                 $second = $this->welcome_model->getlevel($first->sponsor_id);

                 if(!empty($second)){
                     foreach($second as $sec){
                        $array['second'][] = $sec;

                         /*========================= for thired level===================*/
                         $third = $this->welcome_model->getlevel($sec->sponsor_id);
                         if(!empty($third))
                         {
                             foreach($third as $thireded)
                             {
                                $array['third'][] = $thireded;

                            /*========================= for fourth level===================*/
                                $fourth = $this->welcome_model->getlevel($thireded->sponsor_id);
                                if(!empty($fourth))
                                {
                                    foreach($fourth as $fourthed)
                                    {
                                        $array['fourth'][] = $fourthed;
                                    /*========================= for 5th level===================*/
                                        $fifth = $this->welcome_model->getlevel($fourthed->sponsor_id);
                                        if(!empty($fifth))
                                        {
                                            foreach($fifth as $fipthed)
                                            {
                                                $array['fifth'][] = $fipthed;
                                             /*========================= for 6th level===================*/
                                                 $sixth = $this->welcome_model->getlevel($fipthed->sponsor_id);
                                                 if(!empty($sixth))
                                                 {
                                                     foreach($sixth as $sixed)
                                                     {
                                                         $array['sixth'][] =   $sixed;
                                                         /*========================= for 7th level===================*/
                                                          $seventh = $this->welcome_model->getlevel($sixed->sponsor_id);
                                                          if(!empty($seventh))
                                                          {
                                                              foreach($seventh as $seventhd)
                                                              {
                                                                  $array['seventh'][]    =   $seventhd;
                                                                 /*========================= for 8th level===================*/
                                                                   $eighth = $this->welcome_model->getlevel($seventhd->sponsor_id);
                                                                   if(!empty($eighth))
                                                                   {
                                                                       foreach($eighth as $eightt)
                                                                       {
                                                                           $array['eighth'][]    =  $eightt;
                                                                           /*========================= for 9th level===================*/
                                                                           $ninth = $this->welcome_model->getlevel($eightt->sponsor_id);
                                                                            if(!empty($ninth))
                                                                            {
                                                                                foreach($ninth as $Ninth)
                                                                                {
                                                                                    $array['ninth'][]  =   $Ninth;
                                                                                    /*========================= for 10th level===================*/

                                                                                    $tenth  = $this->welcome_model->getlevel($Ninth->sponsor_id);
                                                                                    if(!empty($tenth)){
                                                                                        foreach($tenth as $Tenth){
                                                                                            $array['tenth'][]  = $Tenth;
                                                                                            /*========================= for 11th level===================*/
                                                                                            $eleventh = $this->welcome_model->getlevel($Tenth->sponsor_id);
                                                                                            if(!empty($eleventh)){
                                                                                                foreach($eleventh as $Eleven){
                                                                                                    $array['eleventh'][]  =   $Eleven;
                                                                                                    /*========================= for 12th level===================*/
                                                                                                $twelfth = $this->welcome_model->getlevel($Eleven->sponsor_id);
                                                                                                if(!empty($twelfth)){
                                                                                                    foreach($twelfth as $Twol){
                                                                                                        $array['twelfth'][]  =   $Twol;
                                                                                                /*========================= for 13th level===================*/
                                                                                                $therteenth = $this->welcome_model->getlevel($Twol->sponsor_id);
                                                                                                if(!empty($therteenth)){
                                                                                                    foreach($therteenth as $Thertyn){
                                                                                                        $array['therteenth'][]  =   $Thertyn;
                                                                                                /*========================= for 14th level===================*/
                                                                                                $fourteenth = $this->welcome_model->getlevel($Thertyn->sponsor_id);
                                                                                                if(!empty($fourteenth)){
                                                                                                    foreach($fourteenth as $Fourthn){
                                                                                                        $array['fourteenth'][]  =   $Fourthn;
                                                                                                        /*========================= for 15th level===================*/
                                                                                                    $fefteenth = $this->welcome_model->getlevel($Fourthn->sponsor_id);
                                                                                                    if (!empty($fefteenth)) {
                                                                                                        foreach ($fefteenth as $Feptin) {
                                                                                                            $array['fefteenth'][] = $Feptin;
                                                                                                    /*========================= for 16th level===================*/
                                                                                                    $sixteenth = $this->welcome_model->getlevel($Feptin->sponsor_id);
                                                                                                    if (!empty($sixteenth)) {
                                                                                                        foreach ($sixteenth as $Sixtin) {
                                                                                                            $array['sixteenth'][] = $Sixtin;
                                                                                                        /*========================= for 17th level===================*/
                                                                                                        $seventeenth = $this->welcome_model->getlevel($Sixtin->sponsor_id);
                                                                                                        if (!empty($seventeenth)) {
                                                                                                            foreach ($seventeenth as $Seventin) {
                                                                                                                $array['seventeenth'][] = $Seventin;
                                                                                                        /*========================= for 18th level===================*/
                                                                                                        $eighteenth = $this->welcome_model->getlevel($Seventin->sponsor_id);
                                                                                                        if (!empty($eighteenth)) {
                                                                                                            foreach ($eighteenth as $Eightin) {
                                                                                                                $array['eighteenth'][] = $Eightin;
                                                                                                        /*========================= for 19th level===================*/
                                                                                                        $ninteenth  = $this->welcome_model->getlevel($Eightin->sponsor_id);
                                                                                                        if (!empty($ninteenth)) {
                                                                                                            foreach ($ninteenth as $Nintin) {
                                                                                                                $array['ninteenth'][] = $Nintin;
                                                                                                            /*========================= for 20th level===================*/
                                                                                                        $twentyth = $this->welcome_model->getlevel($Nintin->sponsor_id);
                                                                                                        if (!empty($twentyth)) {
                                                                                                            foreach ($twentyth as $Townty) {
                                                                                                                $array['twentyth'][] = $Townty;

                                                                                                            }
                                                                                                        }

                                                                                                            }
                                                                                                        }


                                                                                                            }
                                                                                                        }


                                                                                                            }
                                                                                                        }


                                                                                                        }
                                                                                                    }

                                                                                                        }
                                                                                                    }

                                                                                                        
                                                                                                    }
                                                                                                }
                                                                                                    } 
                                                                                                    }                                                                                                      
                                                                                                    }
                                                                                                    }
                                                                                                }
                                                                                            }
                                                                                        

                                                                                        }
                                                                                        
                                                                                    }
                                                                                }
                                                                            }

                                                                       }
                                                                   }
                                                              }
                                                          } 
                                                     }
                                                 }

                                            }
                                        }


                                    }
                                   
                                }

                             }
                         }

                     }
                 }
            } 
        }
       
        $this->data['leveldata']=$array;
        $this->data['page'] = 'level'; 
        $this->data['content'] = 'level/level';
        $this->load->view('user/template', $this->data);

    }
    function steps_income()
    {
        $userId             =   $this->session->userdata['user']['sponsor_id'];
        //$data['incm']       =   $this->welcome_model->getsinglerow(TBL_USER,['id' => $userId]);
       // $data['treeData']   =   $this->welcome_model->getsinglerow(TBL_TREE,['id' => $userId]);
        $this->data['Lincome']         =   $this->welcome_model->getlevelIncome($userId);
    
       // $date               =   date('Y-m-d', strtotime($data['incm']->create_at));
       $this->data['page'] = 'income';
       $this->data['content'] = 'income/step_income';
       $this->load->view('user/template', $this->data);
    }
    function matching_incomes()
    { 
        $sponsorId=$this->session->userdata['user']['sponsor_id'];
        $this->data['income']=$this->welcome_model->wholeresult('daily_matching_income', [],['user_id' => $sponsorId]);
        $this->data['page'] = 'income';
        $this->data['content'] = 'income/matching_income';
        $this->load->view('user/template', $this->data);
    }
    function search($id)
    {
        $result = $this->welcome_model->getspecificcolomn(TBL_USER,['full_name'],['sponsor_id'=>$id]);
        if (!empty($result)) {
            $array['success'] = array('name'=>$result->full_name);
        }else {
            $array['error'] = array('name'=>'Invalid Sponsor id');
        }
        echo json_encode($array);

    }
    function create_pin()
    {
        $sponsorId=$this->session->userdata['user']['sponsor_id'];
        $userId=$this->session->userdata['user']['id'];
        $this->data['epin'] = $this->welcome_model->wholeresult(EPN_TBL, [],['user_id' => $sponsorId]);
        $this->data['plans'] = $this->welcome_model->getAllPlan();
        if(!empty($_POST))
        {
            $this->form_validation->set_rules('epin_code', 'Choose ePin', 'required');
            $this->form_validation->set_rules('no_of_epin', 'Number of epin', 'required');
            if($this->form_validation->run() == false)
            {
                $this->data['page'] = 'income';
                $this->data['content'] = 'income/create_pin';
                $this->load->view('user/template', $this->data);  
            }else{
                    $data['wallet'] = $this->welcome_model->getsinglerow(TBL_USER, ['sponsor_id' => $sponsorId]);
                    $date= date("Y-m-d H:i:s");
                    if($data['wallet']->wallet_amount >= $this->input->post('epin_code') * $this->input->post('no_of_epin'))
                    {
                        $this->welcome_model->genratepins($this->input->post('no_of_epin'), $sponsorId,$this->input->post('epin_code'),$date);
                        $this->session->set_flashdata('createPin','<div class="alert alert-success alert-dismissible">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Congratulation! ePin Created Successfully</strong> 
                                                        </div>'
                                                    );
                        redirect(create_pin);
                    }else{
                        $this->session->set_flashdata('amt','Sorry! not sufficient balance available');
                        $this->data['page'] = 'income';
                        $this->data['content'] = 'income/create_pin';
                        $this->load->view('user/template', $this->data);

                    }
                }
            
        }else{
           
            $this->data['page'] = 'income';
            $this->data['content'] = 'income/create_pin';
            $this->load->view('user/template', $this->data);

        }
        
    }
    function upgrade_plan()
    {
        $id = $this->session->userdata['user']['id'];
        $this->data['userRecord'] = $this->welcome_model->getsinglerow(TBL_USER, ['id' => $id]);
        $this->data['plans'] = $this->welcome_model->getAllPlan();
        if (!empty($_POST)) {
            $this->form_validation->set_rules('upgrade', 'Choose plan type', 'required');
            if ($this->form_validation->run() == false) {
                $this->data['page'] = 'Plan';
                $this->data['content'] = 'plan/upgrade_plan';
                $this->load->view('user/template', $this->data);
            } else {
                $update['create_at'] = date("Y-m-d H:i:s");
                $update['upgrade_plan'] = $this->input->post('upgrade');
                if (!empty($this->input->post('id'))) {
                    $this->welcome_model->updateRecord(TBL_USER, $update, ['id' => $this->input->post('id')]);
                    $this->session->set_flashdata('upgrade', '<div class="alert alert-success alert-dismissible">
                                                <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong> Contratulation! Your Account Activated Successfully</strong>
                                                </div>');
                    redirect('user');
                } else {

                }
            }
        } else {
            $this->data['page'] = 'Plan';
            $this->data['content'] = 'plan/upgrade_plan';
            $this->load->view('user/template', $this->data);
        }
    }
    function letest($id=NULL,$amount=1){
            $this->levelinfo($id,$amount,$id);
    }
    function levelinfo($id,$amount,$fromId){
            date_default_timezone_set('Asia/Kolkata');
            $month = date('Ym');
            $array = array();
            $data = $this->welcome_model->levlele($id);
            if(!empty($data->added_by && $this->i <20 )){
            
            if($this->i==0){
                $level=1;
                $this->welcome_model->forlevelupdatation($data->added_by,$level,$amount,$month,$fromId);
            }
            if($this->i==1){
            
                $level=2;
                $this->welcome_model->forlevelupdatation($data->added_by,$level,$amount,$month,$fromId);
            }
            if($this->i==2){
                $level=3;
              
                $this->welcome_model->forlevelupdatation($data->added_by,$level,$amount,$month,$fromId);
            
            }
            if($this->i==3){
                $level=4;
             
                $this->welcome_model->forlevelupdatation($data->added_by,$level,$amount,$month,$fromId);
            }
            if($this->i==4){
            
                $level=5;
                $this->welcome_model->forlevelupdatation($data->added_by,$level,$amount,$month,$fromId);
            
            }
            if($this->i==5){
            
                $level=6;
                $this->welcome_model->forlevelupdatation($data->added_by,$level,$amount,$month,$fromId);
            
            }
            if($this->i==6){
            
                $level=7;
                $this->welcome_model->forlevelupdatation($data->added_by,$level,$amount,$month,$fromId);
            
            }
            if($this->i==7){
            
                $level=8;
                $this->welcome_model->forlevelupdatation($data->added_by,$level,$amount,$month,$fromId);
            
            }
            if($this->i==8){
            
                $level=9;
                $this->welcome_model->forlevelupdatation($data->added_by,$level,$amount,$month,$fromId);
            }
            if($this->i==9){
            
                $level=10;
                $this->welcome_model->forlevelupdatation($data->added_by,$level,$amount,$month,$fromId);
            }
            if($this->i==10){
            
                $level=11;
                $this->welcome_model->forlevelupdatation($data->added_by,$level,$amount,$month,$fromId);
            }
            if($this->i==11){
            
                $level=12;
                $this->welcome_model->forlevelupdatation($data->added_by,$level,$amount,$month,$fromId);
            }
            if($this->i==12){
            
                $level=13;
                $this->welcome_model->forlevelupdatation($data->added_by,$level,$amount,$month,$fromId);
            }
            if($this->i==13){
            
                $level=14;
                $this->welcome_model->forlevelupdatation($data->added_by,$level,$amount,$month,$fromId);
            }
            if($this->i==14){
            
                $level=15;
                $this->welcome_model->forlevelupdatation($data->added_by,$level,$amount,$month,$fromId);
            }
            if($this->i==15){
            
                $level=16;
                $this->welcome_model->forlevelupdatation($data->added_by,$level,$amount,$month,$fromId);
            }
            if($this->i==16){
            
                $level=17;
                $this->welcome_model->forlevelupdatation($data->added_by,$level,$amount,$month,$fromId);
            }
            if($this->i==17){
            
                $level=18;
                $this->welcome_model->forlevelupdatation($data->added_by,$level,$amount,$month,$fromId);
            }
            if($this->i==18){
            
                $level=19;
                $this->welcome_model->forlevelupdatation($data->added_by,$level,$amount,$month,$fromId);
            }
            if($this->i==19){
            
                $level=20;
                $this->welcome_model->forlevelupdatation($data->added_by,$level,$amount,$month,$fromId);
            }
            $this->i++; 
            $this->levelinfo($data->added_by,$amount,$fromId);
            //echo "<pre>"; print_r($data);
         
            
        }
    }

    function activation(){
        $this->form_validation->set_rules('epin','E-pin','required|numeric');
        $this->form_validation->set_rules('method','Method','required|numeric');
        if($this->form_validation->run()==false){}else{
            extract($_POST);
            if($getin = $this->welcome_model->getspecificcolomn(EPN_TBL,['epin_code','price'],['epin_code'=>$epin,'is_used'=>0])){
                $income = $this->welcome_model->getsinglerow(STEP_INCOME,['plan'=>$getin->price]);
                if($method==1){
                         if($this->welcome_model->getspecificcolomn(TBL_USER,['status'],['status'=>0])){
                                $this->welcome_model->updateRecord(EPN_TBL,['is_used'=>1,'reason'=>'Activated self id'],['epin_code'=>$epin]);
                                $this->welcome_model->updateRecord(TBL_USER,['binary_benifi'=>$income->binary_plan,'plan_benifit'=>$income->income,'status'=>1,'upgrade_plan'=>$income->plan],['id'=>userid()]);
                                $this->welcome_model->updateRecord(TBL_TREE,['is_active'=>1,'is_active_date'=>date('Y-m-d')],['user_id'=>userid()]);
                                $this->levelinfo(sponsorid(), $income->income,sponsorid());
                                if($this->welcome_model->getsinglerow(USER_ORDER,['user_id!='=>sponsorid()]))// is allow only activation time  
                                $this->welcome_model->insertData(USER_ORDER,['user_id'=>sponsorid()]);
                                $this->session->set_flashdata('success','Great!');
                                $this->session->set_flashdata('message','Yo! your id successfully activated');
                            }else{
                            $this->session->set_flashdata('error','Opps! Sorry');
                            $this->session->set_flashdata('message','Your id already activated please go to upgration');
                         } 
                }elseif($method==2){
                    if($this->welcome_model->getspecificcolomn(TBL_USER,['status'],['status>'=>1])){
                        $this->welcome_model->updateRecord(EPN_TBL,['is_used'=>1,'reason'=>'Upgrade self id'],['epin_code'=>$epin]);
                        $this->welcome_model->updateRecord(TBL_USER,['binary_benifi'=>$income->binary_plan,'plan_benifit'=>$income->income,'status'=>1,'upgrade_plan'=>$income->plan],['id'=>userid()]);
                        $this->welcome_model->updateRecord(TBL_TREE,['is_active'=>1,'is_active_date'=>date('Y-m-d')],['user_id'=>userid()]);
                        $this->levelinfo(sponsorid(), $income->income,sponsorid());
                        $this->session->set_flashdata('success','Great!');
                        $this->session->set_flashdata('message','Yo! your id successfully activated');
                    }else{
                       $this->session->set_flashdata('error','Opps! Sorry');
                       $this->session->set_flashdata('message','Your id not activated please go to activate first');
                    } 
                }else{
                    $this->session->set_flashdata('error','Opps! Invalid Parameter');
                    $this->session->set_flashdata('message','Ohh! you trying to another method for activation or upgration');
                }
            }else{
                $this->session->set_flashdata('error','Opps! something went wrong');
                $this->session->set_flashdata('message','E-pin not valid');
            }
        }
        $this->data['page'] = 'activation_upgration';
        $this->data['content'] = 'activation/activation_upgration';
        $this->load->view('user/template', $this->data);
    }
    function transferpin(){
        extract($_POST);
        $fromid= $this->session->userdata['user']['sponsor_id'];
        if($this->welcome_model->getspecificcolomn(TBL_USER,['full_name'],['sponsor_id'=>$toid])){
            $pin = explode(',',$ids);
            $del_val = 'on';
            if (($key = array_search($del_val, $pin)) !== false) {
                unset($pin[$key]);
            }
            $pin = array_values($pin); 
            $arrayy=array();
            for($i=0;$i<count($pin);$i++)
            {
               $epindata=$this->welcome_model->getspecificcolomn(EPN_TBL,['price'],['epin_code'=>$pin[$i]]); 
                $arrayy[]=array('epincode'=>$pin[$i],'price'=>$epindata->price);
            }
            $this->welcome_model->transferepin($arrayy,$toid,$fromid,$pin);
            $array['success']= array('success'=>1,'msg'=>'Pin successfully Transfer to user');
        }else{
            $array['success'] = array('success'=>0,'msg'=>'Invalid sponsor id');
        }
        echo json_encode($array);
    }
    /*===================Transfer Epin History============================*/
    function transfer_epin() 
    {
        
        $userId = $this->session->userdata['user']['sponsor_id'];
       
        $this->data['history'] = $this->welcome_model->devitEpin($userId);
        $this->data['page'] = 'income';
        $this->data['content'] = 'income/transfer_epin';
        $this->load->view('user/template', $this->data);

    }
    function transfer_epin_history()
    {
        //table Name TRNFR_EPN_TBL
        $userId = $this->session->userdata['user']['sponsor_id'];

        $this->data['epin'] = $this->welcome_model->creditEpin($userId);

        $this->data['page'] = 'income';
        $this->data['content'] = 'income/transfer_epin_self';
        $this->load->view('user/template', $this->data);

    }
    function mydownline(){

        $this->data['mydownline']= Auth::mydownlines(sponsorid());
        $this->data['page'] = 'mydownline';
        $this->data['content'] = 'geneoalogy/mydownline';
        $this->load->view('user/template', $this->data);

    }
    function mydirect()
    {
        $this->data['mydirect'] = $this->welcome_model->mydirect(sponsorid());
        $this->data['page'] = 'mydirect';
        $this->data['content'] = 'geneoalogy/mydirect';
        $this->load->view('user/template', $this->data);
    }
    function expenses()
    {
         $id=$this->session->userdata['user']['id'];
         $this->data['expen'] = $this->welcome_model->wholeresult('expenses',[], ['user_id' => $id]);
         $this->data['page'] = 'expenses';
         $this->data['content'] = 'income/expenses';
         $this->load->view('user/template', $this->data);
    }
    function edit_expenses($id = null)
    {
        $userId=$this->session->userdata['user']['id'];
        if (!empty($id)) 
        {
            $this->data['IdBy'] = $this->welcome_model->getsinglerow('expenses', ['id' => $id]);
            $this->data['page'] = 'expenses';
            $this->data['content'] = 'income/add_expenses';
            $this->load->view('user/template', $this->data);
    } 
    else {
        if (!empty($_POST)) 
        {
            $this->form_validation->set_rules('expenses_name', 'expenses name', 'required');
            $this->form_validation->set_rules('expenses_amount', 'expenses amount', 'required');
            $this->form_validation->set_rules('expenses_date', 'expenses date', 'required');

            if ($this->form_validation->run() == false)
            {
                $this->data['page'] = 'expenses';
                $this->data['content'] = 'income/add_expenses';
                $this->load->view('user/template', $this->data);
            } 
            else {
                    $save['expenses_name'] = $this->input->post('expenses_name');
                    $save['expenses_amount'] = $this->input->post('expenses_amount');
                    $save['expenses_date'] = $this->input->post('expenses_date');
                    $save['current_date'] = date("Y-m-d H:i:s");
                    $save['remark'] = $this->input->post('remark');
                    $save['user_id'] = $userId ;
                if (!empty($this->input->post('id'))) {

                    $this->welcome_model->updateRecord('expenses', $save, ['id' => $this->input->post('id')]);
                    $this->session->set_flashdata('success', 'Update!');
                    $this->session->set_flashdata('message', 'Record Updated Successfully');
                    redirect(expenses);
                } else {
                    $this->welcome_model->insertRecord('expenses', $save);
                    $this->session->set_flashdata('success', 'Add!');
                    $this->session->set_flashdata('message', 'Record Inserted Successfully');
                    redirect(expenses);
                }
            }
        } else {
                    $this->data['page'] = 'expenses';
                    $this->data['content'] = 'income/add_expenses';
                    $this->load->view('user/template', $this->data);

        }
    }

    }
    function other_income()
    {
        $id = $this->session->userdata['user']['id'];
        $this->data['income'] = $this->welcome_model->wholeresult('other_income', [], ['user_id' => $id]);
        $this->data['page'] = 'other income';
        $this->data['content'] = 'income/other/other_income_list';
        $this->load->view('user/template', $this->data);
    }
    function edit_other_income($id = null)
    {
        $userId = $this->session->userdata['user']['id'];
        if (!empty($id))
         {
            $this->data['IdBy'] = $this->welcome_model->getsinglerow('other_income', ['id' => $id]);
            $this->data['page'] = 'Income';
            $this->data['content'] = 'income/other/add_other_income';
            $this->load->view('user/template', $this->data);
        } 
        else {
            if (!empty($_POST)) 
            {
                $this->form_validation->set_rules('income_source', 'source', 'required');
                $this->form_validation->set_rules('incom_amount', 'amount', 'required');
                $this->form_validation->set_rules('date', 'date', 'required');

                if ($this->form_validation->run() == false) 
                {
                    $this->data['page'] = 'Income';
                    $this->data['content'] = 'income/other/add_other_income';
                    $this->load->view('user/template', $this->data);
                }
                 else {
                        $save['income_name'] = $this->input->post('income_name');
                        $save['income_source'] = $this->input->post('income_source');
                        $save['incom_amount'] = $this->input->post('incom_amount');
                        $save['date'] = $this->input->post('date');
                        $save['remark'] = $this->input->post('remark');
                        $save['user_id'] = $userId;
                    if (!empty($this->input->post('id'))) 
                    {

                        $this->welcome_model->updateRecord('other_income', $save, ['id' => $this->input->post('id')]);
                        $this->session->set_flashdata('success', 'Update!');
                        $this->session->set_flashdata('message', 'Record Updated Successfully');
                        redirect(other_income);
                    } else {
                        $this->welcome_model->insertRecord('other_income', $save);
                        $this->session->set_flashdata('success', 'Add!');
                        $this->session->set_flashdata('message', 'Record Inserted Successfully');
                        redirect(other_income);
                    }
                }
            }
            else {
                $this->data['page'] = 'Income';
                $this->data['content'] = 'income/other/add_other_income';
                $this->load->view('user/template', $this->data);

            }
        }


    }
    function refferal_signup()
    {
        $this->data['page'] = 'signup';
        $this->data['content'] = 'registration/registration';
        $this->load->view('user/template', $this->data);
    }
    function special()
    {
        $userId=$this->session->userdata['user']['id'];
        $this->data['special']           = $this->welcome_model->getsinglerowSpecialay($userId);
        $this->data['religionsName']     = $this->welcome_model->getRelegionsNameById($userId);
        $this->data['SubreligionsName']  = $this->welcome_model->getSubRelegionsNameById($userId);
        $this->data['DharmName']         = $this->welcome_model->getSubRelegionsCategoryNameById($userId);
        $this->data['IdByNormal']        = $this->welcome_model->getsinglerow(NRML_INFO_TBL,['user_id'=>$userId]);
        $this->data['birth']             = $this->welcome_model->getsinglerow(BIRT_INFO_TBL,['user_id'=>$userId]);
        $this->data['caste']             = $this->welcome_model->getsinglerow(CST_INFO_TBL,['user_id'=>$userId]);
        $this->data['pay']               = $this->welcome_model->getsinglerow(PAY_INFO_TBL,['user_id'=>$userId]);
        $this->data['specials']          = $this->welcome_model->getsinglerow(SPCL_INFO_TBL,['user_id'=>$userId]);
        $this->data['education']         = $this->welcome_model->getsinglerow(EDU_INFO_TBL,['user_id'=>$userId]);
        $this->data['family']            = $this->welcome_model->getsinglerow(FMTY_INFO_TBL,['user_id'=>$userId]);
        $this->data['geration']          = $this->welcome_model->getsinglerow(GNRTN_INFO_TBL,['user_id'=>$userId]);
        $this->data['health']            = $this->welcome_model->getsinglerow(HLTH_INFO_TBL,['user_id'=>$userId]);
        $this->data['work']              = $this->welcome_model->getsinglerow(WRK_INFO_TBL,['user_id'=>$userId]);
        $this->data['mrge']              = $this->welcome_model->getsinglerow(MRG_INFO_TBL,['user_id'=>$userId]);
        $this->data['president']         = $this->welcome_model->getsinglerow(PRSTN_INFO_TBL,['user_id'=>$userId]);

        $this->data['page'] = 'Special profile';
        $this->data['content'] = 'special/special_page';
        $this->load->view('user/template', $this->data);
    }
/* ==================================Android View Page Start============================================================ */
    public function graph()
    {
        $this->load->view('user/android/graphical_view');
    }
    public function my_downline()
    {
        $this->data['mydownline']= Auth::mydownlines(sponsorid());
        $this->load->view('user/android/mydownline', $this->data);
    }
    public function my_direct()
    { 
        $this->data['mydirect'] = $this->welcome_model->mydirect(sponsorid());
        $this->load->view('user/android/mydirect', $this->data);
    }
/* ==================================Android View Page End============================================================ */
function tree_demo()
{
        $this->data['page'] = 'demo';
        $this->data['content'] = 'geneoalogy/tree';
        $this->load->view('user/template', $this->data);
}

/*================06-march-2019  getcast And Subcast Ajax ==================== */

function getcast(){
    $Rid = $_GET['id'];
  
    $data = $this->welcome_model->wholeresult('sub_religion',[],['religions_id'=> $Rid ]);
    $array = [];
    foreach($data as $row){
        $array[]= "<option value=$row->religions_id>$row->sub_religions</option>";
    }
    $temp = "<option value='0786'>Other</option>";
    array_push($array,$temp);
    echo json_encode($array);
}
function getsub_cast()
{
    $id = $_GET['id'];
    $data = $this->welcome_model->wholeresult('sub_religion_category',[],['sub_religion_id'=>$id]);
    $array = [];
    foreach($data as $row){
        $array[]= "<option value=$row->sub_religion_id>$row->dharm</option>";
    }
    $temp = "<option value='0786'>Other</option>";
    array_push($array,$temp);
    echo json_encode($array);
}

    function logout()
    {
        $session = array('id','sponsor_id');
        $this->session->unset_userdata($session); 
        $this->session->sess_destroy();
        redirect(logout);
    }

    
}
