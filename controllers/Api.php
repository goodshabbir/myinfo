<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Api extends REST_Controller {

	 function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('api_model','api');
        date_default_timezone_set('Asia/Kolkata');

    }
    function updateImage_post()
{
    $headers = array();
    foreach (getallheaders() as $name => $value) {
        $headers[$name] = $value;
    }

    $token = $headers['Access-Token'];
    if ($id = $this->verifyToken($token)) {

        $config['upload_path'] = './assets/images/profile/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('image')) {
            $message = array(
                'status' => false,
                'message' => 'Uploaded Image not valid',
            );
            $this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
        } else {
            $data = $this->upload->data();
            $filename = $data['file_name'];
            $this->api->updateRecord(USER, array('image' => $filename), array('id' => $id));
            $message = array(
                'status' => true,
                'message' => 'Profile image updated',
                'data' => PROFILE_PIC . $filename,
            );
            $this->set_response($message, REST_Controller::HTTP_OK);

        }

    } else {
        $message = array(
            'status' => false,
            'message' => 'Invalid Token',
        );
        $this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);
    }
}

    /**================= User Login =============================== */
 public function login_post()
    {
        $data = array('sponsor_id'=>$this->post('sponsor_id'),'password'=>sha1($this->post('password')));
        if($record = $this->api->accesssinglerow(TBL_USER,$data)){
        $accessToken = $this->getRandom(50);
        
        $this->api->updateRecord(TBL_USER,array('access_token'=>$accessToken),array('id'=>$record->id));
        $userRecord = array(
                             'id' => $record->id,
                             'sponsor_id' => $record->sponsor_id,
                             'mobile' => $record->mobile,
                             'full_name'	=> $record->full_name!="" ? $record->full_name : "",
                             'email' => $record->email!="" ? $record->email : "",
                            'password' => $this->post('password'),
                            'access_token' => $accessToken
                            );

                    $message = array(
                    'message' =>'Successfully login',
                    'data' => $userRecord
                    );
         $this->set_response($message, REST_Controller::HTTP_OK);
        }else{
                $message = array(
                'message' =>'Incorrect Credeantial'
                );
            $this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    private function getRandom($length)
    {
        $char = array_merge(range(0,9), range('A', 'Z'), range('a', 'z'));
        $code = '';
        for($i=0; $i < $length; $i++) {
        $code .= $char[mt_rand(0, count($char) - 1)];
    }
    return $code;
    }
    private function verifyToken($token)
    {
        if($record = $this->api->accesssinglerow(TBL_USER,array('access_token'=>$token)))
        {
            if(!empty($record))
            {
            return $record->id; 
            }
        }else{
                return FALSE;
            }
    }
/**================= User Registration =============================== */
    function checkid($id)
    {
        if ($id != '') {
            if ($this->api->getspecificcolomn(TBL_USER, ['sponsor_id'], ['sponsor_id' => $id])) {
                return true;
            } else {
                    $message="Sponsor id not valid";
                    $message = array(
                                'message' => $message,
                                 );
                    $this->set_response($message, REST_Controller::HTTP_OK);
                return false;
            }
        } else {
            
                $message = "Sponsor id field is required";
                $message = array(
                                    'message' => $message,
                                );
                $this->set_response($message, REST_Controller::HTTP_OK);

                 return false;
        }
    }

   function signup_post()
   {
    if($this-> checkid($this->post('sponsor_id')))
    {         
        $sponsor_id       = $this->post('sponsor_id');
        $password         = sha1($this->post('password'));
        $mobile           = $this->post('mobile');
        $full_name        = $this->post('full_name');
        $user_name        = $this->post('user_name');
        $email            = $this->post('email');
        $country_code     = $this->post('country_code');
        $country          = $this->post('country');
        $placement        = $this->post('placement');
        $direct = array();
        if ($placement == "left") {
            $upline_id = $this->check_left_postion($sponsor_id);
            $lastId = $this->api->register($sponsor_id, $upline_id, $placement, $password, $mobile, $user_name, $email, $full_name,$country_code,$country);
            $message = "Dear " . $full_name . " Thanks you for registration in myinformation.in . Your user id is " . $lastId . " and login password is " . $this->post('password') . " ";
            $message = array(
                            'message' =>$message
                            );
            $this->set_response($message, REST_Controller::HTTP_OK);
        } elseif ($placement == "right") {
            $upline_id = $this->check_right_postion($sponsor_id);
            $lastId = $this->api->register($sponsor_id, $upline_id, $placement, $password, $mobile, $user_name, $email, $full_name);
            $message = "Dear " . $full_name . " Thanks you for registration in myinformation.in. ";
            $message = array(
                            'message' =>$message
                            );
            $this->set_response($message, REST_Controller::HTTP_OK);
        } else {
            $message = $placement . 'side already full';
            $message = array(
                                'message' => $message,
                                );
                $this->set_response($message, REST_Controller::HTTP_OK);


        }
    }else{
        $message = 'Sorry! Invalid Sponsor id';
        $message = array(
                        'message' => $message
                        );
        $this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);

    }
} 
   function check_left_postion($id)
    {
        $this->api->getLeftChild($id);
        $get = $this->api->getChildLeftempty();
        return $get->self_id;

    }
   private function checkSpoRightOrNot($self_id,$id)
	{
		if($id!=''){
			$data=$this->api->getAllUpline($id);
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
private function checksposor($id)
    {
		if($data = $this->api->getspecificcolomn(TBL_TREE,['child_left','child_right'],['self_id' => $id])){
			return array('left' => $data->child_left,'right' => $data->child_right);
		}else{
			return false;
		}
	}
    function getsponsorname_get()
    {
		if($name = $this->api->getspecificcolomn(TBL_USER,['full_name'],['sponsor_id'=>$this->get('sponsor_id')])){
		$message = array(
                            'message' => 'Name Found',
                            'user_name'=>$name->full_name
                        );
            $this->set_response($message, REST_Controller::HTTP_OK);

		}else{
			$message = array(
                                'message' => 'Invalid Sponspor Id '
                            );
            $this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);

		}
		
	}
    function check_right_postion($id)
    {
        $this->api->getRightChild($id);
        $get = $this->api->getChildLeftempty();
        return $get->self_id;
    }
    function getcountryisd_get()
    {
        if ($code = $this->api->getallresult(CUNTRY_ISD,[])) 
        {
            $message = array(
                            'message' => 'Country ISD Code Found',
                            'phonecode' => $code,
                            );
            $this->set_response($message, REST_Controller::HTTP_OK);
        } 
    }
    function getcountryname_get()
    {
        if ($code = $this->api->getallresult(CUNTRY_ISD,[])) 
        {
            $message = array(
                            'message' => 'Country Found',
                            'name' => $code,
                            );
            $this->set_response($message, REST_Controller::HTTP_OK);
        } 
    }
    function getcityname_get()
    {
        if ($code = $this->api->getspecificResult(CTY,[],array('state_id'=>$this->get('state_id'))))  
        {
            $message = array(
                'message' => 'Cities Found',
                'phonecode' => $code,
            );
            $this->set_response($message, REST_Controller::HTTP_OK);
        }
    }
    function getstatename_get()
    {
        if ($code = $this->api->getspecificResult(STATE,[],array('country_id'=>$this->get('country_id')))) {
            $message = array(
                'message' => 'State Found',
                'phonecode' => $code,
            );
            $this->set_response($message, REST_Controller::HTTP_OK);
        }
    }

    /**================= User profile =============================== */
	function changepassword_post()
	{
		$headers=array();
		foreach (getallheaders() as $name => $value) {
		    $headers[$name] = $value;
		}
	
		$token = $headers['Access-Token'];
		if($this->verifyToken($token)){
			if($this->api->accesssinglerow(TBL_USER,array('password'=>sha1($this->post('old_password')),'access_token'=>$token))) {
				$this->api->updateRecord(TBL_USER,array('password'=>sha1($this->post('new_password'))),array('access_token'=>$token));

					$message = array(
    						'message' =>'Password changed'
    					);
    				$this->set_response($message, REST_Controller::HTTP_OK);
				
			}else{

				$message = array(
    						'message' =>'Incorrect Old Password'
    					);
    				$this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);
			}
		}else{
			$message = array(
    						'message' =>'Invalid Token'
    					);
    		$this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);
		}
    }
	function userproifile_post()
	{
		$headers=array();
		foreach (getallheaders() as $name => $value) {
		    $headers[$name] = $value;
		}
	
        $token = $headers['Access-Token'];
        if($this->verifyToken($token)){
                $update = array(
                            'full_name' => $this->post('full_name'),
                            'mobile'    => $this->post('mobile'),
                            'gender'    => $this->post('gender'),
                            'email'     => $this->post('email')
                );
              
                if($this->api->numrowscount(TBL_USER,array('email'=>$this->post('email'),'access_token'=>$token))==1 || $this->api->numrowscount(TBL_USER,array('email'=>$this->post('email')))==0)
                {
                    
                    if($this->api->updateRecord(TBL_USER,$update,array('access_token'=>$token)))
                    {
                            $record = $this->api->accesssinglerow(TBL_USER,array('access_token'=>$token));
                            $userRecord = array(
                                'id' 			 => $record->id,
                                'mobile'         => $record->mobile,
                                'full_name'		 => $record->full_name!="" ? $record->full_name : "",
                                'gender'		 => $record->gender!="" ? $record->gender : "",
                                'email'          => $record->email!="" ?  $record->email : "",
                                'image'          => PROFILE_PIC.$record->image, 
                                'access_token'   => $token
                            );
                    
                            $message = array(
                                'message' =>'Profile successfully updated',
                                'data'    => $userRecord
                            );
                            $this->set_response($message, REST_Controller::HTTP_OK);
                    }else{
                            $message = array(
                                'message' =>'Oh! profile already updated'
                            );
                            $this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);
                    }
            }else{
                $message = array(   
                    'message' =>'Email id not exist'
                );
                $this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);
            }

           
        }else{
            $message = array(
                'status' =>FALSE,
                'message' =>'Invalid Token'
            );
            $this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);
        }
    }
    /**==============================Normal information===================================== */
    function normal_information_post()
    {
        $headers=array();
        foreach (getallheaders() as $name => $value) 
        {
		    $headers[$name] = $value;
		}
        $token = $headers['Access-Token'];
        if($id=$this->verifyToken($token))
        {
            if(empty($this->post('fname') &&($this->post('gender'))&&($this->post('email_id')) &&($this->post('district'))
            &&($this->post('father_name')) &&($this->post('contact_no')) &&($this->post('country')) &&($this->post('state')) &&($this->post('city')) &&($this->post('where_live'))
            &&($this->post('where_live')) &&($this->post('house_name')) &&($this->post('house_no')) &&($this->post('vard_no')) &&($this->post('vard_name')) &&($this->post('road_name')) 
            &&($this->post('road_no')) &&($this->post('gali_name')) &&($this->post('post_office')) &&($this->post('panchayat')) &&($this->post('pincode'))
            &&($this->post('married_status')) &&($this->post('tehsil')) &&($this->post('religions')) &&($this->post('unmarrid_type')) 
            &&($this->post('where_livePer')) &&($this->post('road_no_curr')) &&($this->post('gali_name_curr')) &&($this->post('colony_name_curr')) &&($this->post('road_name_curr'))
            &&($this->post('vard_no_curr')) &&($this->post('post_office_2')) &&($this->post('city_2')) &&($this->post('phonecode_2')) &&($this->post('house_no_curr'))
            &&($this->post('house_name_curr')) &&($this->post('panchayat_2')) &&($this->post('pincode_2')) &&($this->post('other_religions')) &&($this->post('other_sub_religions'))
            &&($this->post('other_dharm')) &&($this->post('language')) &&($this->post('mother_tongue')) &&($this->post('other_mother_tongue')) &&($this->post('community'))
            &&($this->post('other_community')) 

            ))
            {
                $RecordData = $this->normalInfor($id);
                        $message = array(
                                            'message' => 'Record Found',
                                            'data' => $RecordData,
                                        ); 
                        $this->set_response($message, REST_Controller::HTTP_OK);

            }
            else{
                    $userRecord=array(
                                    'fname'            => $this->post('fname'),
                                    'gender'           => $this->post('gender'),
                                    'email_id'         => $this->post('email_id'),
                                    'father_name'      => $this->post('father_name'),
                                    'contact_no'       => $this->post('contact_no'),
                                    'country'          => $this->post('country'),
                                    'state'            => $this->post('state'),
                                    'city'             => $this->post('city'),
                                    'district'         => $this->post('district'),
                                    'where_live'       => $this->post('where_live'),
                                    'house_name'       => $this->post('house_name'),
                                    'house_no'         => $this->post('house_no'),
                                    'vard_no'          => $this->post('vard_no'),
                                    'vard_name'        => $this->post('vard_name'),
                                    'road_name'        => $this->post('road_name'),
                                    'road_no'          => $this->post('road_no'),
                                    'gali_name'        => $this->post('gali_name'),
                                    'post_office'      => $this->post('post_office'),
                                    'panchayat'        => $this->post('panchayat'),
                                    'pincode'          => $this->post('pincode'),
                                    'tehsil'           => $this->post('tehsil'),
                                    'colony_name'      => $this->post('colony_name'),
                                    'phone_code'       => $this->post('phone_code'),
                                    'where_livePer'    => $this->post('where_livePer'),
                                    'house_no_curr'    => $this->post('house_no_curr'),
                                    'religions'        => $this->post('religions'),
                                    'sub_religions'    => $this->post('sub_religions'),
                                    'dharm'            => $this->post('dharm'),
                                    'where_livePer'          => $this->post('where_livePer'),
                                    'road_no_curr'        => $this->post('road_no_curr'),
                                    'gali_name_curr'        => $this->post('gali_name_curr'),
                                    'colony_name_curr'          => $this->post('colony_name_curr'),
                                    'road_name_curr'        => $this->post('road_name_curr'),
                                    'vard_no_curr'      => $this->post('vard_no_curr'),
                                    'post_office_2'        => $this->post('post_office_2'),
                                    'city_2'          => $this->post('city_2'),
                                    'phonecode_2'           => $this->post('phonecode_2'),
                                    'house_no_curr'      => $this->post('house_no_curr'),
                                    'house_name_curr'       => $this->post('house_name_curr'),
                                    'panchayat_2'    => $this->post('panchayat_2'),
                                    'pincode_2'        => $this->post('pincode_2'),
                                    'other_religions'    => $this->post('other_religions'),
                                    'sub_religions'            => $this->post('sub_religions'),
                                    'other_sub_religions'   => $this->post('other_sub_religions'),
                                    'other_dharm'    => $this->post('other_dharm'),
                                    'language'        => $this->post('language'),
                                    'mother_tongue'    => $this->post('mother_tongue'),
                                    'other_mother_tongue'            => $this->post('other_mother_tongue'),
                                    'community'   => $this->post('community'),
                                    'other_community'    => $this->post('other_community'),
                                    'married_status'   => $this->post('married_status'),
                                    'unmarrid_type'    => $this->post('unmarrid_type'),
                                    'user_id' =>$id 
                                   
                                );
                if($this->api->getspecificcolomn(NRML_INFO_TBL,['user_id'],['user_id'=>$id]))
                {
                    $this->api->updateRecord(NRML_INFO_TBL,$userRecord,['user_id'=>$id]);
                    
                        $RecordData = $this->normalInfor($id);
                        $message = array(
                                            'message' => 'Normal Information successfully updated',
                                            'data'    =>$RecordData
                                        );
                        $this->set_response($message, REST_Controller::HTTP_OK);

                
                        
                }
                else{
                        $this->api->insertRecord(NRML_INFO_TBL, $userRecord);
                        $message = array( 
                            'message' =>'Oh! Record Saved',
                            'data'    =>$RecordData
                        );
                        $this->set_response($message, REST_Controller::HTTP_OK);
                    }
                
            } 
        }
                else{
                        $message = array(
                            'message' =>'Invalid Token'
                        );
                        $this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);
                    }
               
    }

    private function normalInfor($id)
    {
        $record = $this->api->accesssinglerow(NRML_INFO_TBL, array('user_id' => $id));

        $RecordData = array(
                            
                            'fname' => $record->fname != "" ? $record->fname : "",
                            'surname' => $record->surname != "" ? $record->surname : "",
                            'age' => $record->age != "" ? $record->age : "",
                            'gender' => $record->gender != "" ? $record->gender : "",
                            'email_id' => $record->email_id != "" ? $record->email_id : "",
                            'contact_no' => $record->contact_no != "" ? $record->contact_no : "",
                            'father_name' => $record->father_name != "" ? $record->father_name : "",
                            'country' => $record->country != "" ? $record->country : "",
                            'state' => $record->state != "" ? $record->state : "",
                            'city' => $record->city != "" ? $record->city : "",
                            'where_live' => $record->where_live != "" ? $record->where_live : "",
                            'house_name' => $record->house_name != "" ? $record->house_name : "",
                            'house_no' => $record->house_no != "" ? $record->house_no : "",
                            'vard_no' => $record->vard_no != "" ? $record->vard_no : "",
                            'vard_name' => $record->vard_name != "" ? $record->vard_name : "",
                            'road_name' => $record->road_name != "" ? $record->road_name : "",
                            'road_no' => $record->road_no != "" ? $record->road_no : "",
                            'post_office' => $record->post_office != "" ? $record->post_office : "",
                            'panchayat' => $record->panchayat != "" ? $record->panchayat : "",
                            'pincode' => $record->pincode != "" ? $record->pincode : "",
                            'tehsil' => $record->tehsil != "" ? $record->tehsil : "",
                            'address' => $record->address != "" ? $record->address : "",
                            'my_self' => $record->my_self != "" ? $record->my_self : "",
                            'religions' => $record->religions != "" ? $record->religions : "",
                            'dharm' => $record->dharm != "" ? $record->dharm : "",
                            'married_status' => $record->married_status != "" ? $record->married_status : "",
                            'unmarrid_type' => $record->unmarrid_type != "" ? $record->unmarrid_type : "",
                        );

    return $RecordData;
    }
    
    /**=====================================Birth Inforamtion========================================= */
    
    function birthinfo_post()
    {
        $headers=array();
        foreach (getallheaders() as $name => $value) 
        {
		    $headers[$name] = $value;
		}
        $token = $headers['Access-Token'];
        if($id=$this->verifyToken($token))
        {
            
            $RecordData=[];

            if(empty( $this->post('dob') && $this->post('time') && $this->post('birth_of_name')  && $this->post('age') && $this->post('place_of_birth') 
            && $this->post('birth_village') && $this->post('birth_address') && $this->post('country') && $this->post('state') && $this->post('city') && $this->post('pincode') && $this->post('tehsil'))
            )
            {
             
                $RecordData = $this->BirthInfor($id);
                        $message = array(
                                            'message' => 'Record Found',
                                            'data' => $RecordData,
                                        ); 
                        $this->set_response($message, REST_Controller::HTTP_OK);

            }
            else{
                    $userRecord=array(
                                    'dob'           => $this->post('dob'),
                                    'time'          => $this->post('time'),
                                    'birth_of_name' => $this->post('birth_of_name'),
                                    'age'           => $this->post('age'),
                                    'place_of_birth' => $this->post('place_of_birth'),
                                    'birth_village' => $this->post('birth_village'),
                                    'birth_address' => $this->post('birth_address'),
                                    'country'       => $this->post('country'),
                                    'state'         => $this->post('state'),
                                    'city'          => $this->post('city'),
                                    'pincode'       => $this->post('pincode'),
                                    'tehsil'        => $this->post('tehsil'),
                                    'user_id' =>$id 
                                   
                                );
                if(!empty($_FILES)){
                 
                    $image = $this->imageUpload($_FILES['kundli_img'],'./uploads/birth_kundali','kundli');
                    $userRecord['kundli_img']= serialize($image);
                }
                if($this->api->getspecificcolomn(BIRT_INFO_TBL,['user_id'],['user_id'=>$id]))
                {
                    $this->api->updateRecord(BIRT_INFO_TBL,$userRecord,['user_id'=>$id]);
                    
                        $RecordData = $this->BirthInfor($id);
                        $message = array(
                                            'message' => 'Birth Information successfully updated',
                                            'data'    =>$RecordData
                                        );
                        $this->set_response($message, REST_Controller::HTTP_OK);

                
                        
                }
                else{
                        $this->api->insertRecord(BIRT_INFO_TBL, $userRecord);
                        $message = array( 
                            'message' =>'Oh! Record Saved',
                            'data'    =>$RecordData
                        );
                        $this->set_response($message, REST_Controller::HTTP_OK);
                    }
                
            } 
        }
                else{
                        $message = array(
                            'message' =>'Invalid Token'
                        );
                        $this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);
                    }
               
    }

    private function BirthInfor($id)
    {
        if($record = $this->api->accesssinglerow(BIRT_INFO_TBL, array('user_id' => $id))){
            date_default_timezone_set('Asia/Kolkata');
            $images=[];
            if(!empty($record->kundli_img)){
                $img = unserialize($record->kundli_img);
                for($i=0; $i<count($img); $i++){
                    $images[] = ['image'=>BASEURL."uploads/birth_kundali/".$img[$i]];
                }
            }
            $RecordData = array(
                                
                                'dob'               => $record->dob != "" ? date('Y-m-d',strtotime($record->dob)) : "",
                                'time'              => $record->time != "" ? $record->time : "",
                                'birth_of_name'     => $record->birth_of_name != "" ? $record->birth_of_name : "",
                                'age'               => $record->age != "" ? $record->age : "",
                                'place_of_birth'    => $record->place_of_birth != "" ? $record->place_of_birth : "",
                                'birth_village'     => $record->birth_village != "" ? $record->birth_village : "",
                                'birth_address'     => $record->birth_address != "" ? $record->birth_address : "",
                                'country'           => $record->country != "" ? $record->country : "",
                                'state'             => $record->state != "" ? $record->state : "",
                                'city'              => $record->city != "" ? $record->city : "",
                                'pincode'           => $record->pincode != "" ? $record->pincode : "",
                                'tehsil'            => $record->tehsil != "" ? $record->tehsil : "",
                                'kundli_image'      => $images
                            );

            return $RecordData;
        }
    }
    
    /**=====================================Cats Inforamtion========================================= */

function casteinfo_post()
    {
        $headers=array();
        foreach (getallheaders() as $name => $value) 
        {
		    $headers[$name] = $value;
		}
        $token = $headers['Access-Token'];
        if($id=$this->verifyToken($token))
        {
         
            if(empty($this->post('religions') && $this->post('sub_religions') && $this->post('dharm') && $this->post('gauta') && $this->post('kul') && $this->post('kuldevi_name') 
            && $this->post('address_of_kuldevi') && $this->post('kuldevata_name') && $this->post('kuldevata_address') && $this->post('maama_gautr') && $this->post('maama_kul') 
            ))
            {
                $RecordData = $this->CasteInfor($id);
                        $message = array(
                                            'message' => 'Record Found',
                                            'data' => $RecordData,
                                        ); 
                        $this->set_response($message, REST_Controller::HTTP_OK);

            }
            else{
                    $userRecord=array(
                                    'religions' => $this->post('religions'),
                                    'sub_religions' => $this->post('sub_religions'),
                                    'dharm' => $this->post('dharm'),
                                    'gauta' => $this->post('gauta'),
                                    'kul' => $this->post('kul'),
                                    'kuldevi_name' => $this->post('kuldevi_name'),
                                    'address_of_kuldevi' => $this->post('address_of_kuldevi'),
                                    'kuldevata_name' => $this->post('kuldevata_name'),
                                    'kuldevata_address' => $this->post('kuldevata_address'),
                                    'maama_gautr' => $this->post('maama_gautr'),
                                    'maama_kul' => $this->post('maama_kul'),
                                    'user_id' =>$id 
                                );

                    if(!empty($_FILES['kuldevi'])){
                        $image = $this->singleImage('./uploads/kuldevi','kuldevi');
                        $userRecord['kuldevi_img']= $image;
                    }  
                    
                    if(!empty($_FILES['kuldevta'])){
                        $image = $this->singleImage('./uploads/kuldevata','kuldevta');
                        $userRecord['kuldevata_img']= $image;
                    }  

                if($this->api->getspecificcolomn(CST_INFO_TBL,['user_id'],['user_id'=>$id]))
                {
                    $this->api->updateRecord(CST_INFO_TBL,$userRecord,['user_id'=>$id]);
                    
                        $RecordData = $this->CasteInfor($id);
                        $message = array(
                                            'message' => 'Cast Information successfully updated',
                                            'data'    =>$RecordData
                                        );
                        $this->set_response($message, REST_Controller::HTTP_OK);

                
                        
                }
                else{
                        $this->api->insertRecord(CST_INFO_TBL, $userRecord);
                        $message = array( 
                            'message' =>'Oh! Record Saved',
                            'data'    =>$RecordData
                        );
                        $this->set_response($message, REST_Controller::HTTP_OK);
                    }
                
            } 
        }
                else{
                        $message = array(
                            'message' =>'Invalid Token'
                        );
                        $this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);
                    }
               
    }

    private function CasteInfor($id)
    {
         if($record = $this->api->accesssinglerow(CST_INFO_TBL, array('user_id' => $id))){
            $RecordData = array(
                                
                            'religions' => $record->religions != "" ? $record->religions : "",
                                'sub_religions' => $record->sub_religions != "" ? $record->sub_religions : "",
                                'dharm' => $record->dharm != "" ? $record->dharm : "",
                                'gauta' => $record->gauta != "" ? $record->gauta : "",
                                'kul' => $record->kul != "" ? $record->kul : "",
                                'kuldevi_name' => $record->kuldevi_name != "" ? $record->kuldevi_name : "",
                                'address_of_kuldevi' => $record->address_of_kuldevi != "" ? $record->address_of_kuldevi : "",
                                'kuldevata_name' => $record->kuldevata_name != "" ? $record->kuldevata_name : "",
                                'kuldevata_address' => $record->kuldevata_address != "" ? $record->kuldevata_address : "",
                                'maama_gautr' => $record->maama_gautr != "" ? $record->maama_gautr : "",
                                'maama_kul' => $record->maama_kul != "" ? $record->maama_kul : "",
                                'kuldevi_image' => $record->kuldevi_img!='' ? BASEURL."uploads/kuldevi/".$record->kuldevi_img : "",
                                'kuldevata_img' => $record->kuldevata_img!='' ? BASEURL."uploads/kuldevta/".$record->kuldevata_img : "",
                            );

            return $RecordData;
        }
    }
    
/**=====================================Pay Inforamtion========================================= */

function payinfo_post()
    {
        $headers=array();
        foreach (getallheaders() as $name => $value) 
        {
		    $headers[$name] = $value;
		}
        $token = $headers['Access-Token'];
        if($id=$this->verifyToken($token))
        {
            if(empty($this->post('account_no') && ($this->post('bank_name')) &&($this->post('branch')) &&($this->post('ifsc')) &&($this->post('paytm_no'))&&($this->post('paytm_address')) 
            &&($this->post('bhim_address')) &&($this->post('bhim_no')) &&($this->post('google_pay')) &&($this->post('google_upi')) &&($this->post('phonepe_no')) &&($this->post('phonepe_upi')) &&($this->post('phonepe_upi'))
            ))
            {
                $RecordData = $this->PayInfor($id);
                        $message = array(
                                            'message' => 'Record Found',
                                            'data' => $RecordData,
                                        ); 
                        $this->set_response($message, REST_Controller::HTTP_OK);

            }
            else{
                    $userRecord=array(
                                    'account_no' => $this->post('account_no'),
                                    'bank_name' => $this->post('bank_name'),
                                    'branch' => $this->post('branch'),
                                    'ifsc' => $this->post('ifsc'),
                                    'paytm_no' => $this->post('paytm_no'),
                                    'paytm_address' => $this->post('paytm_address'),
                                    'bhim_address' => $this->post('bhim_address'),
                                    'bhim_no' => $this->post('bhim_no'),
                                    'google_pay' => $this->post('google_pay'),
                                    'google_upi' => $this->post('google_upi'),
                                    'phonepe_no' => $this->post('phonepe_no'),
                                    'phonepe_upi' => $this->post('phonepe_upi'),
                                    'user_id' => $id
                                );
                if($this->api->getspecificcolomn(PAY_INFO_TBL,['user_id'],['user_id'=>$id]))
                {
                    $this->api->updateRecord(PAY_INFO_TBL,$userRecord,['user_id'=>$id]);
                    
                        $RecordData = $this->PayInfor($id);
                        $message = array(
                                            'message' => 'Cast Information successfully updated',
                                            'data'    =>$RecordData
                                        );
                        $this->set_response($message, REST_Controller::HTTP_OK);

                
                        
                }
                else{
                        $this->api->insertRecord(PAY_INFO_TBL, $userRecord);
                        $message = array( 
                            'message' =>'Oh! Record Saved',
                            'data'    =>$RecordData
                        );
                        $this->set_response($message, REST_Controller::HTTP_OK);
                    }
                
            } 
        }
                else{
                        $message = array(
                            'message' =>'Invalid Token'
                        );
                        $this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);
                    }
               
    }

    private function PayInfor($id)
    {
         $record = $this->api->accesssinglerow(PAY_INFO_TBL, array('user_id' => $id));
        $RecordData = array(
                            
                            'account_no' => $record->account_no != "" ? $record->account_no : "",
                            'bank_name' => $record->bank_name != "" ? $record->bank_name : "",
                            'branch' => $record->branch != "" ? $record->branch : "",
                            'ifsc' => $record->ifsc != "" ? $record->ifsc : "",
                            'paytm_no' => $record->paytm_no != "" ? $record->paytm_no : "",
                            'paytm_address' => $record->paytm_address != "" ? $record->paytm_address : "",
                            'bhim_address' => $record->bhim_address != "" ? $record->bhim_address : "",
                            'bhim_no' => $record->bhim_no != "" ? $record->bhim_no : "",
                            'google_pay' => $record->google_pay != "" ? $record->google_pay : "",
                            'google_upi' => $record->google_upi != "" ? $record->google_upi : "",
                            'phonepe_no' => $record->phonepe_no != "" ? $record->phonepe_no : "",
                            'phonepe_upi' => $record->phonepe_upi != "" ? $record->phonepe_upi : ""
                        );

        return $RecordData;
    }
    
/**=====================================Special Inforamtion========================================= */

function specialinfo_post()
    {
        $headers=array();
        foreach (getallheaders() as $name => $value) 
        {
		    $headers[$name] = $value;
		}
        $token = $headers['Access-Token'];
        if($id=$this->verifyToken($token))
        {
            if(empty($this->post('votar_no') && ($this->post('addhar_no')) &&($this->post('pan_no')) &&($this->post('birth_cer_no')) &&($this->post('cast_cer_no'))&&($this->post('income')) 
            &&($this->post('game')) &&($this->post('hieght')) &&($this->post('color')) &&($this->post('wight')) &&($this->post('blood_group')) &&($this->post('food')) &&($this->post('movie'))
            &&($this->post('song')) &&($this->post('actor'))&&($this->post('actress'))
          
            ))
            {
                $RecordData = $this->SpecialInfor($id);
                        $message = array(
                                            'message' => 'Record Found',
                                            'data' => $RecordData,
                                        ); 
                        $this->set_response($message, REST_Controller::HTTP_OK);

            }
            else{
                    $userRecord=array(
                                    'votar_no' => $this->post('votar_no'),
                                    'addhar_no' => $this->post('addhar_no'),
                                    'pan_no' => $this->post('pan_no'),
                                    'birth_cer_no' => $this->post('birth_cer_no'),
                                    'cast_cer_no' => $this->post('cast_cer_no'),
                                    'income' => $this->post('income'),
                                    'game' => $this->post('game'),
                                    'hieght' => $this->post('hieght'),
                                    'color' => $this->post('color'),
                                    'wight' => $this->post('wight'),
                                    'blood_group' => $this->post('blood_group'),
                                    'food' => $this->post('food'),
                                    'movie' => $this->post('movie'),
                                    'song' => $this->post('song'),
                                    'actor' => $this->post('actor'),
                                    'actress' => $this->post('actress'),
                                    'user_id' => $id

                                );
                    
                if(!empty($_FILES['voter_image'])){
                    $voter = $this->singleImage('./uploads/special/voter','voter_image');
                    $userRecord['votar_img']= $voter;
                }  
                if(!empty($_FILES['aadhar_image'])){
                    $adhar = $this->singleImage('./uploads/special/addhar','aadhar_image');
                    $userRecord['addhar_img']= $adhar;
                }  
                if(!empty($_FILES['income_image'])){
                    $income = $this->singleImage('./uploads/special/income','income_image');
                    $userRecord['income_img']= $income;
                }  
                if(!empty($_FILES['cast_image'])){
                    $cast_image = $this->singleImage('./uploads/special/cast','cast_image');
                    $userRecord['cast_img']= $cast_image;
                }  
                if(!empty($_FILES['birth_image'])){
                    $birth_image = $this->singleImage('./uploads/special/birth','birth_image');
                    $userRecord['birth_img']= $birth_image;
                }  
                if(!empty($_FILES['pan_image'])){
                    $pan_image = $this->singleImage('./uploads/special/pan','pan_image');
                    $userRecord['pan_img']= $pan_image;
                }  
                if($this->api->getspecificcolomn(SPCL_INFO_TBL,['user_id'],['user_id'=>$id]))
                {
                    $this->api->updateRecord(SPCL_INFO_TBL,$userRecord,['user_id'=>$id]);
                    
                        $RecordData = $this->SpecialInfor($id);
                        $message = array(
                                            'message' => 'Special Information successfully updated',
                                            'data'    =>$RecordData
                                        );
                        $this->set_response($message, REST_Controller::HTTP_OK);       
                }
                else{
                        $this->api->insertRecord(SPCL_INFO_TBL, $userRecord);
                        $RecordData = $this->SpecialInfor($id);
                        $message = array( 
                            'message' =>'Oh! Record Saved',
                            'data'    =>$RecordData
                        );
                        $this->set_response($message, REST_Controller::HTTP_OK);
                    }
                
            } 
        }
                else{
                        $message = array(
                            'message' =>'Invalid Token'
                        );
                        $this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);
                    }
               
    }

    private function SpecialInfor($id)
    {
         if($record = $this->api->accesssinglerow(SPCL_INFO_TBL, array('user_id' => $id))){
                $RecordData = array(
                                    
                                'votar_no' => $record->votar_no != "" ? $record->votar_no : "",
                                    'addhar_no' => $record->addhar_no != "" ? $record->addhar_no : "",
                                    'pan_no' => $record->pan_no != "" ? $record->pan_no : "",
                                    'birth_cer_no' => $record->birth_cer_no != "" ? $record->birth_cer_no : "",
                                    'cast_cer_no' => $record->cast_cer_no != "" ? $record->cast_cer_no : "",
                                    'income' => $record->income != "" ? $record->income : "",
                                    'game' => $record->game != "" ? $record->game : "",
                                    'hieght' => $record->hieght != "" ? $record->hieght : "",
                                    'color' => $record->color != "" ? $record->color : "",
                                    'wight' => $record->wight != "" ? $record->wight : "",
                                    'blood_group' => $record->blood_group != "" ? $record->blood_group : "",
                                    'food' => $record->food != "" ? $record->food : "",
                                    'movie' => $record->movie != "" ? $record->movie : "",
                                    'song' => $record->song != "" ? $record->song : "",
                                    'actor' => $record->actor != "" ? $record->actor : "",
                                    'actress' => $record->actress != "" ? $record->actress : "",
                                    'votar_img' => $record->votar_img!="" ? BASEURL."uploads/special/voter/".$record->votar_img: "",
                                    'addhar_img' => $record->addhar_img!="" ? BASEURL."uploads/special/addhar/".$record->addhar_img: "",
                                    'income_img' => $record->income_img!="" ? BASEURL."uploads/special/income/".$record->income_img: "",
                                    'cast_img' => $record->cast_img!="" ? BASEURL."uploads/special/cast/".$record->cast_img: "",
                                    'birth_img' => $record->birth_img!="" ? BASEURL."uploads/special/birth/".$record->birth_img: "",
                                    'pan_img' => $record->pan_img!="" ? BASEURL."uploads/special/pan/".$record->pan_img: "",
                                );

                return $RecordData;
        }
    }
    
/**=====================================Family Inforamtion========================================= */

function familyinfo_post()
    {
        $headers=array();
        foreach (getallheaders() as $name => $value) 
        {
		    $headers[$name] = $value;
		}
        $token = $headers['Access-Token'];
        if($id=$this->verifyToken($token))
        {
            if(empty($this->post('no_of_family') && ($this->post('present_no_of_family')) &&($this->post('sivling')) 
            &&($this->post('no_of_sister'))
            &&($this->post('sister_mstatus'))&&($this->post('sister_occupation')) 
            &&($this->post('no_brother')) &&($this->post('brother_mstatus')) &&($this->post('brother_occupation'))
            &&($this->post('home_width')) &&($this->post('home_type')) &&($this->post('home_length'))
            &&($this->post('no_of_baby'))&&($this->post('no_of_room'))&&($this->post('about_property'))
            &&($this->post('self_property'))
            &&($this->post('speciality'))&&($this->post('no_of_children'))&&($this->post('no_of_boy'))
            ))
            {
                $RecordData = $this->FamilyInfor($id);
                        $message = array(
                                            'message' => 'Record Found',
                                            'data' => $RecordData,
                                        ); 
                        $this->set_response($message, REST_Controller::HTTP_OK);

            }
            else{
                    $userRecord=array(
                                    'no_of_family' => $this->post('no_of_family'),
                                    'present_no_of_family' => $this->post('present_no_of_family'),
                                    'sivling' => $this->post('sivling'),
                                    'no_of_sister' => $this->post('no_of_sister'),
                                    'sister_mstatus' => $this->post('sister_mstatus'),
                                    'sister_occupation' => $this->post('sister_occupation'),
                                    'no_brother' => $this->post('no_brother'),
                                    'brother_mstatus' => $this->post('brother_mstatus'),
                                    'brother_occupation' => $this->post('brother_occupation'),
                                    'home_width' => $this->post('home_width'),
                                    'home_type' => $this->post('home_type'),
                                    'home_length' => $this->post('home_length'),
                                    'no_of_baby' => $this->post('no_of_baby'),
                                    'no_of_room' => $this->post('no_of_room'),
                                    'about_property' => $this->post('about_property'),
                                    'self_property' => $this->post('self_property'),
                                    'speciality' => $this->post('speciality'),
                                    'no_of_children' => $this->post('no_of_children'),
                                    'no_of_boy' => $this->post('no_of_boy'),
                                    'user_id' => $id,
                                );
                if($this->api->getspecificcolomn(FMTY_INFO_TBL,['user_id'],['user_id'=>$id]))
                {
                    $this->api->updateRecord(FMTY_INFO_TBL,$userRecord,['user_id'=>$id]);
                    
                        $RecordData = $this->FamilyInfor($id);
                        $message = array(
                                            'message' => 'Generation Information successfully updated',
                                            'data'    =>$RecordData
                                        );
                        $this->set_response($message, REST_Controller::HTTP_OK);       
                }
                else{
                        $this->api->insertRecord(FMTY_INFO_TBL, $userRecord);
                        $message = array( 
                            'message' =>'Oh! Record Saved',
                            'data'    =>$RecordData
                        );
                        $this->set_response($message, REST_Controller::HTTP_OK);
                    }
                
            } 
        }
                else{
                        $message = array(
                            'message' =>'Invalid Token'
                        );
                        $this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);
                    }
               
    }

    private function FamilyInfor($id)
    {
         $record = $this->api->accesssinglerow(FMTY_INFO_TBL, array('user_id' => $id));
        $RecordData = array(
                            
                           'no_of_family' => $record->no_of_family != "" ? $record->no_of_family : "",
                            'present_no_of_family' => $record->present_no_of_family != "" ? $record->present_no_of_family : "",
                            'sivling' => $record->sivling != "" ? $record->sivling : "",
                            'no_of_sister' => $record->no_of_sister != "" ? $record->no_of_sister : "",
                            'sister_mstatus' => $record->sister_mstatus != "" ? $record->sister_mstatus : "",
                            'sister_occupation' => $record->sister_occupation != "" ? $record->sister_occupation : "",
                            'no_brother' => $record->no_brother != "" ? $record->no_brother : "",
                            'brother_mstatus' => $record->brother_mstatus != "" ? $record->brother_mstatus : "",
                            'brother_occupation' => $record->brother_occupation != "" ? $record->brother_occupation : "",
                            'home_width' => $record->home_width != "" ? $record->home_width : "",
                            'home_type' => $record->home_type != "" ? $record->home_type : "",
                            'home_length' => $record->home_length != "" ? $record->home_length : "",
                            'no_of_baby' => $record->no_of_baby != "" ? $record->no_of_baby : "",
                            'no_of_room' => $record->no_of_room != "" ? $record->no_of_room : "",
                            'about_property' => $record->about_property != "" ? $record->about_property : "",
                            'self_property' => $record->self_property != "" ? $record->self_property : "",
                            'speciality' => $record->speciality != "" ? $record->speciality : "",
                            'no_of_children' => $record->no_of_children != "" ? $record->no_of_children : "",
                            'no_of_boy' => $record->no_of_boy != "" ? $record->no_of_boy : ""
                        );

        return $RecordData;
    }
/**=====================================7 Generation Inforamtion========================================= */

function generationinfo_post()
    {
        $headers=array();
        foreach (getallheaders() as $name => $value) 
        {
		    $headers[$name] = $value;
		}
        $token = $headers['Access-Token'];
        if($id=$this->verifyToken($token))
        {
            if(empty($this->post('father') && ($this->post('mother')) &&($this->post('grandfather')) &&($this->post('grandmother')) &&($this->post('great_grandfather'))&&($this->post('great_grandmother')) 
            &&($this->post('great_grandmother')) &&($this->post('great_grandfather_father')) &&($this->post('great_grandmother_mother')) &&($this->post('mother5')) &&($this->post('mother6')) &&($this->post('mother7'))
            
            ))
            {
                $RecordData = $this->GenerationInfor($id);
                        $message = array(
                                            'message' => 'Record Found',
                                            'data' => $RecordData,
                                        ); 
                        $this->set_response($message, REST_Controller::HTTP_OK);

            }
            else{
                    $userRecord=array(
                                    'father' => $this->post('father'),
                                    'mother' => $this->post('mother'),
                                    'grandfather' => $this->post('grandfather'),
                                    'grandmother' => $this->post('grandmother'),
                                    'great_grandfather' => $this->post('great_grandfather'),
                                    'great_grandmother' => $this->post('great_grandmother'),
                                    'great_grandfather_father' => $this->post('great_grandfather_father'),
                                    'great_grandmother_mother' => $this->post('great_grandmother_mother'),
                                    'mother5' => $this->post('mother5'),
                                    'father5' => $this->post('father5'),
                                    'father6' => $this->post('father6'),
                                    'mother6' => $this->post('mother6'),
                                    'mother7' => $this->post('mother7'),
                                    'father7' => $this->post('father7'),
                                    'user_id' => $id,

                                );
                if($this->api->getspecificcolomn(GNRTN_INFO_TBL,['user_id'],['user_id'=>$id]))
                {
                    $this->api->updateRecord(GNRTN_INFO_TBL,$userRecord,['user_id'=>$id]);
                    
                        $RecordData = $this->GenerationInfor($id);
                        $message = array(
                                            'message' => 'Generation Information successfully updated',
                                            'data'    =>$RecordData
                                        );
                        $this->set_response($message, REST_Controller::HTTP_OK);       
                }
                else{
                        $this->api->insertRecord(GNRTN_INFO_TBL, $userRecord);
                        $message = array( 
                            'message' =>'Oh! Record Saved',
                            'data'    =>$RecordData
                        );
                        $this->set_response($message, REST_Controller::HTTP_OK);
                    }
                
            } 
        }
                else{
                        $message = array(
                            'message' =>'Invalid Token'
                        );
                        $this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);
                    }
               
    }

    private function GenerationInfor($id)
    {
         $record = $this->api->accesssinglerow(GNRTN_INFO_TBL, array('user_id' => $id));
        $RecordData = array(
                            
                           'father' => $record->father != "" ? $record->father : "",
                            'mother' => $record->mother != "" ? $record->mother : "",
                            'grandfather' => $record->grandfather != "" ? $record->grandfather : "",
                            'grandmother' => $record->grandmother != "" ? $record->grandmother : "",
                            'great_grandfather' => $record->great_grandfather != "" ? $record->great_grandfather : "",
                            'great_grandmother' => $record->great_grandmother != "" ? $record->great_grandmother : "",
                            'great_grandfather_father' => $record->great_grandfather_father != "" ? $record->great_grandfather_father : "",
                            'great_grandmother_mother' => $record->great_grandmother_mother != "" ? $record->great_grandmother_mother : "",
                            'mother5' => $record->mother5 != "" ? $record->mother5 : "",
                            'father5' => $record->father5 != "" ? $record->father5 : "",
                            'father6' => $record->father6 != "" ? $record->father6 : "",
                            'mother6' => $record->mother6 != "" ? $record->mother6 : "",
                            'mother7' => $record->mother7 != "" ? $record->mother7 : "",
                            'father7' => $record->father7 != "" ? $record->father7 : ""
                        );

        return $RecordData;
    }
   
    
 /**=====================================Health Inforamtion========================================= */

function healthinfo_post()
    {
        $headers=array();
        foreach (getallheaders() as $name => $value) 
        {
		    $headers[$name] = $value;
		}
        $token = $headers['Access-Token'];
        if($id=$this->verifyToken($token))
        {
            if(empty($this->post('crippled') && ($this->post('crippled_side')) &&($this->post('lame')) 
            &&($this->post('lame_side')) &&($this->post('dumb'))&&($this->post('dumb_side')) &&($this->post('deaf'))
            &&($this->post('deaf_side')) &&($this->post('stammering')) &&($this->post('stammering_per')) 
            &&($this->post('bald')) &&($this->post('bald_per')) &&($this->post('disease')) &&($this->post('disease_name'))
            &&($this->post('year_disease')) &&($this->post('paralysis')) &&($this->post('accident')) &&($this->post('year_accident'))
            &&($this->post('accident_no')) &&($this->post('about_accident')) &&($this->post('present_disease'))
            &&($this->post('Present_disname')) &&($this->post('clerical_disname'))
            ))
            {
                $RecordData = $this->HealthInfor($id);
                        $message = array(
                                            'message' => 'Record Found',
                                            'data' => $RecordData,
                                        ); 
                        $this->set_response($message, REST_Controller::HTTP_OK);

            }
            else{
                    $userRecord=array(
                                    'crippled' => $this->post('crippled'),
                                    'crippled_side' => $this->post('crippled_side'),
                                    'lame' => $this->post('lame'),
                                    'lame_side' => $this->post('lame_side'),
                                    'dumb' => $this->post('dumb'),
                                    'dumb_side' => $this->post('dumb_side'),
                                    'deaf' => $this->post('deaf'),
                                    'deaf_side' => $this->post('deaf_side'),
                                    'stammering' => $this->post('stammering'),
                                    'stammering_per' => $this->post('stammering_per'),
                                    'bald' => $this->post('bald'),
                                    'bald_per' => $this->post('bald_per'),
                                    'disease' => $this->post('disease'),
                                    'disease_name' => $this->post('disease_name'),
                                    'year_disease' => $this->post('year_disease'),
                                    'paralysis' => $this->post('paralysis'),
                                    'accident' => $this->post('accident'),
                                    'year_accident' => $this->post('year_accident'),
                                    'accident_no' => $this->post('accident_no'),
                                    'about_accident' => $this->post('about_accident'),
                                    'present_disease' => $this->post('present_disease'),
                                    'Present_disname' => $this->post('Present_disname'),
                                    'clerical_disname' => $this->post('clerical_disname'),
                                    'user_id' => $id

                                );
                if($this->api->getspecificcolomn(HLTH_INFO_TBL,['user_id'],['user_id'=>$id]))
                {
                    $this->api->updateRecord(HLTH_INFO_TBL,$userRecord,['user_id'=>$id]);
                    
                        $RecordData = $this->HealthInfor($id);
                        $message = array(
                                            'message' => 'Health Information successfully updated',
                                            'data'    =>$RecordData
                                        );
                        $this->set_response($message, REST_Controller::HTTP_OK);       
                }
                else{
                        $this->api->insertRecord(HLTH_INFO_TBL, $userRecord);
                        $message = array( 
                            'message' =>'Oh! Record Saved',
                            'data'    =>$RecordData
                        );
                        $this->set_response($message, REST_Controller::HTTP_OK);
                    }
                
            } 
        }
                else{
                        $message = array(
                            'message' =>'Invalid Token'
                        );
                        $this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);
                    }
               
    }

    private function HealthInfor($id)
    {
         $record = $this->api->accesssinglerow(HLTH_INFO_TBL, array('user_id' => $id));
        $RecordData = array(
                            
                           'crippled' => $record->crippled != "" ? $record->crippled : "",
                            'crippled_side' => $record->crippled_side != "" ? $record->crippled_side : "",
                            'lame' => $record->lame != "" ? $record->lame : "",
                            'lame_side' => $record->lame_side != "" ? $record->lame_side : "",
                            'dumb' => $record->dumb != "" ? $record->dumb : "",
                            'dumb_side' => $record->dumb_side != "" ? $record->dumb_side : "",
                            'deaf' => $record->deaf != "" ? $record->deaf : "",
                            'deaf_side' => $record->deaf_side != "" ? $record->deaf_side : "",
                            'stammering' => $record->stammering != "" ? $record->stammering : "",
                            'stammering_per' => $record->stammering_per != "" ? $record->stammering_per : "",
                            'bald' => $record->bald != "" ? $record->bald : "",
                            'bald_per' => $record->bald_per != "" ? $record->bald_per : "",
                            'disease' => $record->disease != "" ? $record->disease : "",
                            'disease_name' => $record->disease_name != "" ? $record->disease_name : "",

                            'year_disease' => $record->year_disease != "" ? $record->year_disease : "",
                            'paralysis' => $record->paralysis != "" ? $record->paralysis : "",
                            'accident' => $record->accident != "" ? $record->accident : "",
                            'year_accident' => $record->year_accident != "" ? $record->year_accident : "",
                            'accident_no' => $record->accident_no != "" ? $record->accident_no : "",
                            'about_accident' => $record->about_accident != "" ? $record->about_accident : "",
                            'present_disease' => $record->present_disease != "" ? $record->present_disease : "",
                            'Present_disname' => $record->Present_disname != "" ? $record->Present_disname : "",
                            'clerical_disname' => $record->clerical_disname != "" ? $record->clerical_disname : ""
                        );

        return $RecordData;
    }
/**=====================================Work Inforamtion========================================= */

function workinfo_post()
    {
        $headers=array();
        foreach (getallheaders() as $name => $value) 
        {
		    $headers[$name] = $value;
		}
        $token = $headers['Access-Token'];
        if($id=$this->verifyToken($token))
        {
            if(empty($this->post('job_type') && ($this->post('designation')) &&($this->post('work_field')) 
            &&($this->post('monthly_salary')) &&($this->post('yearly_income'))&&($this->post('working_period')) &&($this->post('str_business_year'))
            &&($this->post('business_name')) &&($this->post('month_business_income')) &&($this->post('yearly_business_income')) 
           
            ))
            {
                $RecordData = $this->WorkInfor($id);
                        $message = array(
                                            'message' => 'Record Found',
                                            'data' => $RecordData,
                                        ); 
                        $this->set_response($message, REST_Controller::HTTP_OK);

            }
            else{
                    $userRecord=array(
                                    'job_type' => $this->post('job_type'),
                                    'designation' => $this->post('designation'),
                                    'work_field' => $this->post('work_field'),
                                    'monthly_salary' => $this->post('monthly_salary'),
                                    'yearly_income' => $this->post('yearly_income'),
                                    'working_period' => $this->post('working_period'),
                                    'str_business_year' => $this->post('str_business_year'),
                                    'business_name' => $this->post('business_name'),
                                    'month_business_income' => $this->post('month_business_income'),
                                    'yearly_business_income' => $this->post('yearly_business_income'),
                                    'user_id' => $id

                                );
                if($this->api->getspecificcolomn(WRK_INFO_TBL,['user_id'],['user_id'=>$id]))
                {
                    $this->api->updateRecord(WRK_INFO_TBL,$userRecord,['user_id'=>$id]);
                    
                        $RecordData = $this->WorkInfor($id);
                        $message = array(
                                            'message' => 'Work Information successfully updated',
                                            'data'    =>$RecordData
                                        );
                        $this->set_response($message, REST_Controller::HTTP_OK);       
                }
                else{
                        $this->api->insertRecord(WRK_INFO_TBL, $userRecord);
                        $message = array( 
                            'message' =>'Oh! Record Saved',
                            'data'    =>$RecordData
                        );
                        $this->set_response($message, REST_Controller::HTTP_OK);
                    }
                
            } 
        }
                else{
                        $message = array(
                            'message' =>'Invalid Token'
                        );
                        $this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);
                    }
               
    }

    private function WorkInfor($id)
    {
         $record = $this->api->accesssinglerow(WRK_INFO_TBL, array('user_id' => $id));
        $RecordData = array(
                            'job_type' => $record->job_type != "" ? $record->job_type : "",
                            'designation' => $record->designation != "" ? $record->designation : "",
                            'work_field' => $record->work_field != "" ? $record->work_field : "",
                            'monthly_salary' => $record->monthly_salary != "" ? $record->monthly_salary : "",
                            'yearly_income' => $record->yearly_income != "" ? $record->yearly_income : "",
                            'working_period' => $record->working_period != "" ? $record->working_period : "",
                            'str_business_year' => $record->str_business_year != "" ? $record->str_business_year : "",
                            'business_name' => $record->business_name != "" ? $record->business_name : "",
                            'month_business_income' => $record->month_business_income != "" ? $record->month_business_income : "",
                            'yearly_business_income' => $record->yearly_business_income != "" ? $record->yearly_business_income : ""
                            
                            );

        return $RecordData;
    }
 /**=====================================President Inforamtion========================================= */

function societyinfo_post()
    {
        $headers=array();
        foreach (getallheaders() as $name => $value) 
        {
		    $headers[$name] = $value;
		}
        $token = $headers['Access-Token'];
        if($id=$this->verifyToken($token))
        {
            if(empty($this->post('president_name') && ($this->post('president_mobile')) 
           
            ))
            {
                $RecordData = $this->SocityInfor($id);
                        $message = array(
                                            'message' => 'Record Found',
                                            'data' => $RecordData,
                                        ); 
                        $this->set_response($message, REST_Controller::HTTP_OK);

            }
            else{
                    $userRecord=array(
                                   
                                    'president_name' => $this->post('president_name'),
                                    'president_mobile' => $this->post('president_mobile'),
                                    'user_id' => $id

                                );
                if($this->api->getspecificcolomn(PRSTN_INFO_TBL,['user_id'],['user_id'=>$id]))
                {
                    $this->api->updateRecord(PRSTN_INFO_TBL,$userRecord,['user_id'=>$id]);
                    
                        $RecordData = $this->SocityInfor($id);
                        $message = array(
                                            'message' => 'Society Information successfully updated',
                                            'data'    =>$RecordData
                                        );
                        $this->set_response($message, REST_Controller::HTTP_OK);       
                }
                else{
                        $this->api->insertRecord(PRSTN_INFO_TBL, $userRecord);
                        $message = array( 
                            'message' =>'Oh! Record Saved',
                            'data'    =>$RecordData
                        );
                        $this->set_response($message, REST_Controller::HTTP_OK);
                    }
                
            } 
        }
                else{
                        $message = array(
                            'message' =>'Invalid Token'
                        );
                        $this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);
                    }
               
    }

    private function SocityInfor($id)
    {
         $record = $this->api->accesssinglerow(PRSTN_INFO_TBL, array('user_id' => $id));
        $RecordData = array(
                            
                           
                            'president_name' => $record->president_name != "" ? $record->president_name : "",
                            'president_mobile' => $record->president_mobile != "" ? $record->president_mobile : ""
                            
                            );

        return $RecordData;
    }
    /**===============Marriege information================================ */
    function marriageinfo_post()
    {
        $headers=array();
        foreach (getallheaders() as $name => $value) 
        {
		    $headers[$name] = $value;
		}
        $token = $headers['Access-Token'];
        if($id=$this->verifyToken($token))
        {
            if(empty($this->post('cast_marry') && ($this->post('devoce_w')) &&($this->post('num_of_child')) 
            &&($this->post('widowed_w')) &&($this->post('num_of_child_win'))&&($this->post('divorced_w')) &&($this->post('num_of_child_divorce_n'))
            &&($this->post('cast_marry_m')) &&($this->post('devoce_m')) &&($this->post('num_of_child_m')) 
            &&($this->post('vidur_m')) &&($this->post('	num_of_child_vid_m')) &&($this->post('divorced_m'))&&($this->post('num_of_child_divorce_nm'))
            ))
            {
                $RecordData = $this->MarriageInfor($id);
                        $message = array(
                                            'message' => 'Record Found',
                                            'data' => $RecordData,
                                        ); 
                        $this->set_response($message, REST_Controller::HTTP_OK);

            }
            else{
                    $userRecord=array(
                                    'cast_marry' => $this->post('cast_marry'),
                                    'devoce_w' => $this->post('devoce_w'),
                                    'num_of_child' => $this->post('num_of_child'),
                                    'widowed_w' => $this->post('widowed_w'),
                                    'num_of_child_win' => $this->post('num_of_child_win'),
                                    'divorced_w' => $this->post('divorced_w'),
                                    'num_of_child_divorce_n' => $this->post('num_of_child_divorce_n'),
                                    'cast_marry_m' => $this->post('cast_marry_m'),
                                    'devoce_m' => $this->post('devoce_m'),
                                    'num_of_child_m' => $this->post('num_of_child_m'),
                                    'vidur_m' => $this->post('vidur_m'),
                                    'num_of_child_vid_m' => $this->post('num_of_child_vid_m'),
                                    'divorced_m' => $this->post('divorced_m'),
                                    'num_of_child_divorce_nm' => $this->post('num_of_child_divorce_nm'),
                                   
                                    'user_id' => $id

                                );
                if($this->api->getspecificcolomn(MRG_INFO_TBL,['user_id'],['user_id'=>$id]))
                {
                    $this->api->updateRecord(MRG_INFO_TBL,$userRecord,['user_id'=>$id]);
                    
                        $RecordData = $this->MarriageInfor($id);
                        $message = array(
                                            'message' => 'Marriege Information successfully updated',
                                            'data'    =>$RecordData
                                        );
                        $this->set_response($message, REST_Controller::HTTP_OK);       
                }
                else{
                        $this->api->insertRecord(MRG_INFO_TBL, $userRecord);
                        $message = array( 
                            'message' =>'Oh! Record Saved',
                            'data'    =>$RecordData
                        );
                        $this->set_response($message, REST_Controller::HTTP_OK);
                    }
                
            } 
        }
                else{
                        $message = array(
                            'message' =>'Invalid Token'
                        );
                        $this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);
                    }
               
    }

    private function MarriageInfor($id)
    {
         $record = $this->api->accesssinglerow(MRG_INFO_TBL, array('user_id' => $id));
        $RecordData = array(
                            
                           'cast_marry' => $record->cast_marry != "" ? $record->cast_marry : "",
                            'devoce_w' => $record->devoce_w != "" ? $record->devoce_w : "",
                            'num_of_child' => $record->num_of_child != "" ? $record->num_of_child : "",
                            'widowed_w' => $record->widowed_w != "" ? $record->widowed_w : "",
                            'num_of_child_win' => $record->num_of_child_win != "" ? $record->num_of_child_win : "",
                            'divorced_w' => $record->divorced_w != "" ? $record->divorced_w : "",
                            'num_of_child_divorce_n' => $record->num_of_child_divorce_n != "" ? $record->num_of_child_divorce_n : "",
                            'cast_marry_m' => $record->cast_marry_m != "" ? $record->cast_marry_m : "",
                            'devoce_m' => $record->devoce_m != "" ? $record->devoce_m : "",
                            'num_of_child_m' => $record->num_of_child_m != "" ? $record->num_of_child_m : "",
                            'vidur_m' => $record->vidur_m != "" ? $record->vidur_m : "",
                            'num_of_child_vid_m' => $record->num_of_child_vid_m != "" ? $record->num_of_child_vid_m : "",
                            'divorced_m' => $record->divorced_m != "" ? $record->divorced_m : "",
                            
                            'num_of_child_divorce_nm' => $record->num_of_child_divorce_nm != "" ? $record->num_of_child_divorce_nm : ""

                            );

        return $RecordData;
    }
    function getlevelrecords_get()
    {
       
        $headers=array();
        foreach (getallheaders() as $name => $value) 
        {
		    $headers[$name] = $value;
		}
        $token = $headers['Access-Token'];
        
        if($id=$this->verifyToken($token))
        {
          $loginId = $this->api->accesssinglerow(TBL_USER,['id'=>$id]);
           
             $data = $this->api->getlevel($loginId->sponsor_id);
        
        $array = array();
        if (!empty($data)) {
            foreach ($data as $first) {
                $array['level'][] = $first;

                /*=========================for second level===================*/
                $second = $this->api->getlevel($first->sponsor_id);

                if (!empty($second)) {
                    foreach ($second as $sec) {
                        $array['level'][] = $sec;

                        /*=========================for thired level===================*/
                        $third = $this->api->getlevel($sec->sponsor_id);
                        if (!empty($third)) {
                            foreach ($third as $thireded) {
                                $array['level'][] = $thireded;

                                /*========================= for fourth level===================*/
                                $fourth = $this->api->getlevel($thireded->sponsor_id);
                                if (!empty($fourth)) {
                                    foreach ($fourth as $fourthed) {
                                        $array['level'][] = $fourthed;
                                        /*========================= for 5th level===================*/
                                        $fifth = $this->api->getlevel($fourthed->sponsor_id);
                                        if (!empty($fifth)) {
                                            foreach ($fifth as $fipthed) {
                                                $array['level'][] = $fipthed;
                                                /*========================= for 6th level===================*/
                                                $sixth = $this->api->getlevel($fipthed->sponsor_id);
                                                if (!empty($sixth)) {
                                                    foreach ($sixth as $sixed) {
                                                        $array['level'][] = $sixed;
                                                        /*========================= for 7th level===================*/
                                                        $seventh = $this->api->getlevel($sixed->sponsor_id);
                                                        if (!empty($seventh)) {
                                                            foreach ($seventh as $seventhd) {
                                                                $array['level'][] = $seventhd;
                                                                /*========================= for 8th level===================*/
                                                                $eighth = $this->api->getlevel($seventhd->sponsor_id);
                                                                if (!empty($eighth)) {
                                                                    foreach ($eighth as $eightt) {
                                                                        $array['level'][] = $eightt;
                                                                        /*========================= for 9th level===================*/
                                                                        $ninth = $this->api->getlevel($eightt->sponsor_id);
                                                                        if (!empty($ninth)) {
                                                                            foreach ($ninth as $Ninth) {
                                                                                $array['level'][] = $Ninth;
                                                                                /*========================= for 10th level===================*/

                                                                                $tenth = $this->api->getlevel($Ninth->sponsor_id);
                                                                                if (!empty($tenth)) {
                                                                                    foreach ($tenth as $Tenth) {
                                                                                        $array['level'][] = $Tenth;
                                                                                        /*========================= for 11th level===================*/
                                                                                        $eleventh = $this->api->getlevel($Tenth->sponsor_id);
                                                                                        if (!empty($eleventh)) {
                                                                                            foreach ($eleventh as $Eleven) {
                                                                                                $array['level'][] = $Eleven;
                                                                                                /*========================= for 12th level===================*/
                                                                                                $twelfth = $this->api->getlevel($Eleven->sponsor_id);
                                                                                                if (!empty($twelfth)) {
                                                                                                    foreach ($twelfth as $Twol) {
                                                                                                        $array['level'][] = $Twol;
                                                                                                        /*========================= for 13th level===================*/
                                                                                                        $therteenth = $this->api->getlevel($Twol->sponsor_id);
                                                                                                        if (!empty($therteenth)) {
                                                                                                            foreach ($therteenth as $Thertyn) {
                                                                                                                $array['level'][] = $Thertyn;
                                                                                                                /*========================= for 14th level===================*/
                                                                                                                $fourteenth = $this->api->getlevel($Thertyn->sponsor_id);
                                                                                                                if (!empty($fourteenth)) {
                                                                                                                    foreach ($fourteenth as $Fourthn) {
                                                                                                                        $array['level'][] = $Fourthn;
                                                                                                                        /*========================= for 15th level===================*/
                                                                                                                        $fefteenth = $this->api->getlevel($Fourthn->sponsor_id);
                                                                                                                        if (!empty($fefteenth)) {
                                                                                                                            foreach ($fefteenth as $Feptin) {
                                                                                                                                $array['level'][] = $Feptin;
                                                                                                                                /*========================= for 16th level===================*/
                                                                                                                                $sixteenth = $this->api->getlevel($Feptin->sponsor_id);
                                                                                                                                if (!empty($sixteenth)) {
                                                                                                                                    foreach ($sixteenth as $Sixtin) {
                                                                                                                                        $array['level'][] = $Sixtin;
                                                                                                                                        /*========================= for 17th level===================*/
                                                                                                                                        $seventeenth = $this->api->getlevel($Sixtin->sponsor_id);
                                                                                                                                        if (!empty($seventeenth)) {
                                                                                                                                            foreach ($seventeenth as $Seventin) {
                                                                                                                                                $array['level'][] = $Seventin;
                                                                                                                                                /*========================= for 18th level===================*/
                                                                                                                                                $eighteenth = $this->api->getlevel($Seventin->sponsor_id);
                                                                                                                                                if (!empty($eighteenth)) {
                                                                                                                                                    foreach ($eighteenth as $Eightin) {
                                                                                                                                                        $array['level'][] = $Eightin;
                                                                                                                                                        /*========================= for 19th level===================*/
                                                                                                                                                        $ninteenth = $this->api->getlevel($Eightin->sponsor_id);
                                                                                                                                                        if (!empty($ninteenth)) {
                                                                                                                                                            foreach ($ninteenth as $Nintin) {
                                                                                                                                                                $array['level'][] = $Nintin;
                                                                                                                                                                /*========================= for 20th level===================*/
                                                                                                                                                                $twentyth = $this->api->getlevel($Nintin->sponsor_id);
                                                                                                                                                                if (!empty($twentyth)) {
                                                                                                                                                                    foreach ($twentyth as $Townty) {
                                                                                                                                                                        $array['level'][] = $Townty;

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
       
      $message = array(
                        'message' => 'Congratulation! Level Data Found',
                         'data'=>$array
                     );
                    $this->set_response($message, REST_Controller::HTTP_OK);

    }
     else{
            $message = array(
                'message' =>'Invalid Token'
            );
            $this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);
        }
    }
    function getstep_income_get()
    {
        $headers=array();
        foreach (getallheaders() as $name => $value) 
        {
		    $headers[$name] = $value;
		}
        $token = $headers['Access-Token'];
        
        if($id=$this->verifyToken($token))
        {
          $loginId = $this->api->accesssinglerow(TBL_USER,['id'=>$id]);
          if($dataIncome= $this->api->getlevelIncome($loginId->sponsor_id))
            {
           
           foreach($dataIncome as $row)
           {
            unset($row->behalf_of);

           }
            $message = array(
                            'message' => 'Step Income List Found',
                            'data' => $dataIncome
                        );
         $this->set_response($message, REST_Controller::HTTP_OK);
        }
        else{
            $message = array(
                                'message' => 'Step Income Data Not Found',
                            );
            $this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);

        }
        }
        else{
            $message = array(
                            'message' => 'Invalid Token',
                            );
            $this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);

        }
    }
    function getplan_get()
    {
        if ($code = $this->api->getallresult('step_income_plan', [])) 
        {
            $message = array(
                'message' => 'Plan Found',
                'name' => $code,
            );
            $this->set_response($message, REST_Controller::HTTP_OK);
        }

    }
    function create_epin_post()
    {
        $headers = array();
        foreach (getallheaders() as $name => $value) {
            $headers[$name] = $value;
        }

        $token = $headers['Access-Token'];
        if ($id=$this->verifyToken($token)) 
        {
            $loginId = $this->api->accesssinglerow(TBL_USER, ['id' => $id]);
            //echo $loginId->wallet_amount;die;
            $insert = array(
                            'epin_code' => $this->post('epin_code'),
                            'no_of_epin' => $this->post('no_of_epin'),
                            );

            $date = date("Y-m-d H:i:s");
            if($loginId->wallet_amount >= $this->post('epin_code') * $this->post('no_of_epin'))
            {
                $this->api->genratepins($this->post('no_of_epin'), $loginId->sponsor_id, $this->post('epin_code'), $date);
                $message = array(
                                    'message' => 'ePin Created Successfully'
                                    
                                );
                $this->set_response($message, REST_Controller::HTTP_OK);

            }
            else{
                $message = array(
                                    'message' => 'Sorry! not sufficient balance available'
                                );
                $this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);

            }
        } 
        else {
            $message = array(
                
                'message' => 'Invalid Token'
            );
            $this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);
        }

    }
    function getsearch_sponsorid_get()
    {
       
        $result = $this->api->getspecificcolomn(TBL_USER,['full_name'],['sponsor_id'=>$this->get('sponsor_id')]);
     
        if (!empty($result)) 
        {
            $message = array(
                                'message' => 'Great! Soponsor Found',
                                'data'  =>$result
                            );
            $this->set_response($message, REST_Controller::HTTP_OK);

        }
        else {
           $message = array( 
                                'message'=>'Sorry! Invalid Sponsor id',
                            );
            $this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);

        }
      
     
    }
    function TransferEpin_post()
    {
        $headers = array();
        foreach (getallheaders() as $name => $value) {
            $headers[$name] = $value;
        }
        $token = $headers['Access-Token'];
        if ($id = $this->verifyToken($token)) 
        {
            $Fetch = $this->api->accesssinglerow(TBL_USER, ['id' => $id]);
            $fromid = $Fetch->sponsor_id;
             //echo $fromid;die;
            if ($this->api->getspecificcolomn(TBL_USER, ['full_name'], ['sponsor_id' => $toid])) {
                $pin = explode(',', $ids);
                $del_val = 'on';
                if (($key = array_search($del_val, $pin)) !== false) {
                    unset($pin[$key]);
                }
                $pin = array_values($pin);
                $arrayy = array();
                for ($i = 0; $i < count($pin); $i++) 
                {
                    $epindata = $this->api->getspecificcolomn(EPN_TBL, ['price'], ['epin_code' => $pin[$i]]);
                    $arrayy[] = array('epincode' => $pin[$i], 'price' => $epindata->price);
                }
                $this->api->transferepin($arrayy, $toid, $fromid, $pin);
                //$array['success'] = array('success' => 1, 'msg' => 'Pin successfully Transfer to user');
                $message = array(
                                    'message' => 'ePin successfully Transfer to user',
                                    'data' => $epindata,
                                );
                $this->set_response($message, REST_Controller::HTTP_OK);

            } 
            else {
                    $message = array(
                                        'message' => 'Invalid sponsor id',
                                    );
                    $this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);

            }
        }
         else {
            $message = array(
                'message' => 'Invalid Token',
            );
            $this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);

        }
    }

    function educationCertificate_post(){
        $headers = array();
        foreach (getallheaders() as $name => $value) {
            $headers[$name] = $value;
        }
        $token = $headers['Access-Token'];
        if ($id=$this->verifyToken($token)) 
        {
                if(!empty($_FILES['other_certificate'])){
                    $otherCentificate = $this->imageUpload($_FILES['other_certificate'],'./uploads/otherCertificate','other');
                    $update['other_certificate'] =  serialize($otherCentificate);
                }
                if(!empty($_FILES['certificate'])){
                    $certificate = $this->imageUpload($_FILES['certificate'],'./uploads/education','Cetificate');
                    $update['certificate'] =  serialize($certificate);
                }
                if(!empty($_FILES['sem_certificate'])){
                    $semcertificate = $this->imageUpload($_FILES['sem_certificate'],'./uploads/semester','Sem');
                    $update['sem_certificate'] =  serialize($semcertificate);
                }
                if(!empty($_FILES['master_certificate'])){
                    $semcertificate = $this->imageUpload($_FILES['master_certificate'],'./uploads/master','Sem');
                    $update['master_certificate'] =  serialize($semcertificate);
                }
                if($this->api->accesssinglerow('education_information',['user_id'=>$id])){
                        $this->api->updateRecord('education_information',$update,['user_id'=>$id]);
                        $data = $this->certificatelist($id);
                        $message = array(
                            'message' => 'Certificate Updated',
                            'data' => $data
                       );
                        $this->set_response($message, REST_Controller::HTTP_OK);
                }else{
                        $update['user_id'] = $id;
                        $this->api->insertRecord('education_information',$update);
                        $data = $this->certificatelist($id);
                        $message = array(
                            'message' => 'Certificate Addedd',
                            'data'  => $data
                       );
                        $this->set_response($message, REST_Controller::HTTP_OK);
                }
        }else{
            $message = array( 
                'message'=>'Invalid Token',
            );
            $this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);
        }
    }

    private function certificatelist($id){
        $data=[];
            if($record = $this->api->accesssinglerow('education_information',['user_id'=>$id])){
                $other = !empty($record->other_certificate) ?  unserialize($record->other_certificate) : [];
                $certificate = !empty($record->certificate) ?  unserialize($record->certificate) : [];
                $semcertificate = !empty($record->sem_certificate) ?  unserialize($record->sem_certificate) : [];
                $mastercertificate = !empty($record->master_certificate) ?  unserialize($record->master_certificate) : [];

                $data['other_certificate'] = [];
                for($i=0; $i<count($other); $i++){
                  $data['other_certificate'][] = BASEURL."uploads/otherCertificate/".$other[$i];
                }
                $data['certificate'] = [];
                for($i=0; $i<count($certificate); $i++){
                    $data['certificate'][] = BASEURL."uploads/education/".$certificate[$i];
                }
                $data['semester_certificate'] = [];
                for($i=0; $i<count($certificate); $i++){
                    $data['semester_certificate'][] = BASEURL."uploads/semester/".$certificate[$i];
                }
                $data['mester_certificate'] = [];
                for($i=0; $i<count($mastercertificate); $i++){
                    $data['mester_certificate'][] = BASEURL."uploads/semester/".$mastercertificate[$i];
                }
            }
            return $data;
    }
    function uploadImage_post(){
       $data= $this->imageUpload($_FILES['images'],'./profile','title');
       print_r($data);
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
    
    private function imageUpload($files,$path,$title){ // for multiple file uploads
        $config = array(
            'upload_path'   => $path,
            'allowed_types' => 'jpg|gif|png|jpeg',
            'overwrite'     => 1,                       
        );
        $this->load->library('upload', $config);
        $images = array();
        foreach ($files['name'] as $key => $image) {
            $_FILES['images[]']['name']= $files['name'][$key];
            $_FILES['images[]']['type']= $files['type'][$key];
            $_FILES['images[]']['tmp_name']= $files['tmp_name'][$key];
            $_FILES['images[]']['error']= $files['error'][$key];
            $_FILES['images[]']['size']= $files['size'][$key];
            $fileName = $title .'_'. $image;
            $images[] = $fileName;
            $config['file_name'] = $fileName;
            $this->upload->initialize($config);
            if ($this->upload->do_upload('images[]')) {
                $this->upload->data();
            } else {
                return false;
            }
        }
       
        return $images;
    }
   function mydirect_get() 
   {
       $headers = array();
        foreach (getallheaders() as $name => $value) 
        {
            $headers[$name] = $value;
        }
        $token = $headers['Access-Token'];
        if ($id = $this->verifyToken($token)) 
        {
            $Fetch = $this->api->accesssinglerow(TBL_USER, ['id' => $id]);
            $sponsorId = $Fetch->sponsor_id;
           if ($direct = $this->api->mydirect($sponsorId))
           {
               foreach ($direct as $row) 
               {
                    unset($row->gender);
                    unset($row->type);
                    unset($row->user_name);
                    unset($row->email);
                    unset($row->password);
                    unset($row->is_active);
                    unset($row->profile_type);
                    unset($row->upgrade_plan);
                    unset($row->plan_benifit);
                    unset($row->binary_benifi);
                    unset($row->wallet_amount);
                    unset($row->image);
                    unset($row->added_by);
                    unset($row->last_login);
                    unset($row->activate_by);
                    unset($row->activation_date);
                    unset($row->last_date);
                    unset($row->previous_date);
                    unset($row->country_code);
                    unset($row->country);
                    unset($row->access_token);
                    unset($row->id);
                }

                $message = array(
                    'message' => 'My Direct Downline Found',
                    'data' => $direct
                );
                $this->set_response($message, REST_Controller::HTTP_OK);
            }
            else{
                    $message = array(
                                    'message' => 'Sorry! Record Not Found',
                                );
                    $this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);
            }
        }
        else{
                $message = array(
                                'message' => 'Invalid Token',
                            );
                $this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);
        }
   }
   function otherExpenses_get()
   {
        $headers = array();
        foreach (getallheaders() as $name => $value) 
        {
            $headers[$name] = $value;
        }
        $token = $headers['Access-Token'];
        if ($id = $this->verifyToken($token)) 
        {
            $Fetch = $this->api->accesssinglerow(TBL_USER, ['id' => $id]);
            if($Fetch->sponsor_id)
           { 
            if($Data=$this->api->wholeresult('expenses',[], ['user_id' => $id]))
            {
               foreach ($Data as $row) 
               {
                    unset($row->expenses_type);
                    unset($row->salary);
                    unset($row->user_id);
                     
               }
               $message = array(
                                    'message' => 'Records Found',
                                    'data' => $Data,
                                );
                $this->set_response($message, REST_Controller::HTTP_OK);
            }
            else{
                    $message = array(
                            'message' => 'Sorry! Record Not Found',
                        );
                    $this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);
            }
        }
            else{
                    $message = array(
                            'message' => 'Invalid Sponsor Id',
                        );
                $this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);
            }
        }
        else{
                $message = array(
                                'message' => 'Invalid Token',
                            );
                $this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);
        }
   }
   function AddUpdateOtherExpenses_post()
   {
       $headers = array();
        foreach (getallheaders() as $name => $value) 
        {
            $headers[$name] = $value;
        }
             $token = $headers['Access-Token'];
        if ($id = $this->verifyToken($token)) 
        {
            $userRecord = array(
                        'expenses_name' => $this->post('expenses_name'),
                        'expenses_amount' => $this->post('expenses_amount'),
                        'expenses_date' => $this->post('expenses_date'),
                        'remark' => $this->post('remark'),
                        'user_id' => $id,
                    );
           if(!empty($this->post('id'))){
                 $this->api->updateRecord('expenses', $userRecord, ['id' => $this->post('id')]);
                $message = array(
                                    'message' => 'Other Expenses successfully updated',
                                    'data' => $userRecord,
                                );
                $this->set_response($message, REST_Controller::HTTP_OK);

           }else{
                 $lastId= $this->api->insertRecord('expenses', $userRecord);
                   $record = $this->api->getsinglerow('expenses', ['id' => $lastId]);
                    $message = array(
                        'message' => 'Oh! Record Saved',
                        'data' => $record
                    );
                $this->set_response($message, REST_Controller::HTTP_OK);
           }
        
        } 
        else{
                $message = array(
                                'message' => 'Invalid Token',
                                );
                $this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);
        }
   }
   function otherIncome_get()
    {
        $headers = array();
        foreach (getallheaders() as $name => $value)
         {
            $headers[$name] = $value;
        }
        $token = $headers['Access-Token'];
        if ($id = $this->verifyToken($token)) 
        {
            $Fetch = $this->api->accesssinglerow(TBL_USER, ['id' => $id]);
            if($Fetch->sponsor_id)
            {

            if ($Data = $this->api->wholeresult('other_income', [], ['user_id' => $id]))
             {
                 foreach ($Data as $row) 
                 {
                    unset($row->user_id);
                    
                }                                                               

                $message = array(
                    'message' => 'Records Found',
                    'data' => $Data,
                );
                $this->set_response($message, REST_Controller::HTTP_OK);

            } else {
                $message = array(
                    'message' => 'Sorry! Record Not Found',
                );
                $this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);

            }
        } 
        else{
            $message = array(
                            'message' => 'Sory! Invalid Sponsor Id',
                            );
                $this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);      

        }
        } 
        else {
            $message = array(
                'message' => 'Invalid Token',
            );
            $this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);
        }
    }
    function add_update_other_income_post()
    {
        $headers = array();
        foreach (getallheaders() as $name => $value) {
            $headers[$name] = $value;
        }
        $token = $headers['Access-Token'];
        if ($id = $this->verifyToken($token)) {
            $userRecord = array(
                                'income_name' => $this->post('income_name'),
                                'income_source' => $this->post('income_source'),
                                'incom_amount' => $this->post('incom_amount'),
                                'date' => $this->post('date'),
                                'remark' => $this->post('remark'),
                                'user_id' => $id,
                            );
            if (!empty($this->post('id'))) 
            {
                $this->api->updateRecord('other_income', $userRecord, ['id' => $this->post('id')]);
                $message = array(
                    'message' => 'Other Income successfully updated',
                    'data' => $userRecord,
                );
                $this->set_response($message, REST_Controller::HTTP_OK);
            } 
            else {
                    $lastId = $this->api->insertRecord('other_income', $userRecord);
                    $record = $this->api->getsinglerow('other_income', ['id' => $lastId]);
                    $message = array(
                        'message' => 'Oh! Record Saved',
                        //'data' => $record,
                    );
                    $this->set_response($message, REST_Controller::HTTP_OK);
            }

        } else {
            $message = array(
                'message' => 'Invalid Token',
            );
            $this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);
        }
    }
    function MatchingIncome_get()
    {$headers = array();
        foreach (getallheaders() as $name => $value) {
            $headers[$name] = $value;
        }
        $token = $headers['Access-Token'];
        if ($id = $this->verifyToken($token)) 
        {
            $Fetch = $this->api->accesssinglerow(TBL_USER, ['id' => $id]);
           
            if ($match = $this->api->wholeresult('daily_matching_income', [], ['user_id' => $Fetch->sponsor_id]))
             {
                 foreach ($match as $row) 
                {
                    unset($row->access_data);
                    unset($row->id);
                    unset($row->leps_data);
                }

                $message = array(
                    'message' => 'Daily Matching Income Report',
                    'data' => $match,
                );
                $this->set_response($message, REST_Controller::HTTP_OK);

            } 
            else {
                $message = array(
                    'message' => 'Sorry! Record Not Found',
                );
                $this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);

            }


        }
         else {
            $message = array(
                'message' => 'Invalid Token',
            );
            $this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);
        }
    }

}
