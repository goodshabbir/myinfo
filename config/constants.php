<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//$user = array();

$user = array('login','signup','tree','bank','profiles','setting','logout','my_information','profile_matching','send_message','all_document','resume','plan','level','upgrade_plan','steps_income','matching_incomes','create_pin','transfer_epin','activation','upgration','about','faq','contact','regional_experts','privacy_policy','terms_condition','expenses','edit_expenses','other_income','edit_other_income','special','legal','share_earn','our_bank','plan_purchase','packege');

$admin =array('masteradmin','adminprofile','sliders','change','admin_logout','userlist','member_profile','full_profile','step_income','matching_income','epin_history','downline_history','generate_password','latest_news','testmonial','importent','regional','view_slider','religions','add_religions','caste','add_caste','sub_caste','add_sub_caste','free_user','all_epin','user_plan','user_income','payment_history','multiple_id_user','plans','add_plans');  

defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);


defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');


defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

define('BASEURL','http://myinformation.in/myinformation/');
define('PROFILE_PIC',BASEURL.'profile/');
define('FRONT',BASEURL.'myinformation/');
define('SLIDER',BASEURL.'uploads/slider/');

define('TBL_USER','user');
define('TBL_TREE','tree');
define('TBL_OTHER','other_details');
define('NRML_INFO_TBL','normal_information');
define('BIRT_INFO_TBL','birth_information');
define('PAY_INFO_TBL','pay_information');
define('SPCL_INFO_TBL','special_information');
define('CST_INFO_TBL','cost_info');
define('EDU_INFO_TBL','education_information');
define('FMTY_INFO_TBL','family_information');
define('GNRTN_INFO_TBL','generation_information');
define('HLTH_INFO_TBL','health_information');
define('WRK_INFO_TBL','work_information');
define('MRG_INFO_TBL','marriage_information');
define('PRSTN_INFO_TBL','president_information');
define('EPN_TBL', 'epin');
define('TRNFR_EPN_TBL', 'epin_transfer');
define('TBL_LEVEL_INCOME', 'level_income');
define('CUNTRY_ISD', 'countries');
define('CTY', 'cities');
define('STATE', 'states');
define('STEP_INCOME', 'step_income_plan');
define('USER_ORDER', 'user_order');
define('slider', 'SLDR');
define('latestnews', 'LTST_NWS');
define('testmonials', 'TSTMNL');
define('MATCHING_INCOME', 'daily_matching_income');



defined($user[0]) OR define('login', BASEURL.'/login');
defined($user[1]) OR define('signup', BASEURL.'/signup');
defined($user[2]) OR define('tree',BASEURL.'/tree');
defined($user[3]) OR define('bank',BASEURL.'/bank');
defined($user[4]) OR define('profiles',BASEURL.'/profiles');
defined($user[5]) OR define('setting',BASEURL.'/setting');
defined($user[6]) OR define('logout',BASEURL.'/logout');
defined($user[7]) OR define('my_information',BASEURL.'/my_information');
defined($user[8]) OR define('profile_matching',BASEURL.'/profile_matching');
defined($user[9]) OR define('record',BASEURL.'/record');
defined($user[10]) or define('all_document', BASEURL . '/all_document');
defined($user[11]) or define('resume', BASEURL . '/resume');
defined($user[12]) or define('plan', BASEURL . '/plan');
defined($user[13]) or define('level', BASEURL . '/level');
defined($user[14]) or define('upgrade_plan', BASEURL . '/upgrade_plan');
defined($user[15]) or define('steps_income', BASEURL . '/steps_income');
defined($user[16]) or define('matching_incomes', BASEURL . '/matching_incomes');
defined($user[17]) or define('create_pin', BASEURL . '/create_pin');
defined($user[18]) or define('transfer_epin', BASEURL . '/transfer_epin');
defined($user[19]) or define('activation', BASEURL . '/activation');
defined($user[20]) or define('upgration', BASEURL . '/upgration');
defined($user[21]) or define('about', BASEURL . '/about');
defined($user[22]) or define('faq', BASEURL . '/faq');
defined($user[23]) or define('contact', BASEURL . '/contact');
defined($user[24]) or define('regional_experts', BASEURL . '/regional_experts');
defined($user[25]) or define('privacy_policy', BASEURL . '/privacy_policy');
defined($user[26]) or define('terms_condition', BASEURL . '/terms_condition');
defined($user[27]) or define('expenses', BASEURL . '/expenses');
defined($user[28]) or define('edit_expenses', BASEURL . '/edit_expenses');
defined($user[29]) or define('other_income', BASEURL . '/other_income');
defined($user[30]) or define('edit_other_income', BASEURL . '/edit_other_income');
defined($user[31]) or define('special', BASEURL . '/special');
defined($user[32]) or define('legal', BASEURL . '/legal');
defined($user[33]) or define('share_earn', BASEURL . '/share_earn');
defined($user[34]) or define('our_bank', BASEURL . '/our_bank');
defined($user[35]) or define('plan_purchase', BASEURL . '/plan_purchase');
defined($user[36]) or define('packege', BASEURL . '/packege');



/**==============================Admin Panel====================================== */
defined($admin[0]) or define('masteradmin', BASEURL . '/masteradmin');
defined($admin[1]) or define('adminprofile', BASEURL . '/adminprofile');
defined($admin[2]) or define('sliders', BASEURL . '/sliders');
defined($admin[3]) or define('change', BASEURL . '/change'); /**=====Change Password== */
defined($admin[4]) or define('admin_logout', BASEURL . '/admin_logout');
defined($admin[5]) or define('userlist', BASEURL . '/userlist');
defined($admin[6]) or define('member_profile', BASEURL . '/member_profile');
defined($admin[7]) or define('full_profile', BASEURL . '/full_profile');
defined($admin[8]) or define('step_income', BASEURL . '/step_income');
defined($admin[9]) or define('matching_income', BASEURL . '/matching_income');
defined($admin[10]) or define('epin_history', BASEURL . '/epin_history');
defined($admin[11]) or define('downline_history', BASEURL . '/downline_history');
defined($admin[12]) or define('generate_password', BASEURL . '/generate_password');
defined($admin[13]) or define('latest_news', BASEURL . '/latest_news');
defined($admin[14]) or define('testmonial', BASEURL . '/testmonial');
defined($admin[15]) or define('importent', BASEURL . '/importent');
defined($admin[16]) or define('regional', BASEURL . '/regional');
defined($admin[17]) or define('view_slider', BASEURL . '/view_slider');
defined($admin[18]) or define('religions', BASEURL . '/religions');
defined($admin[19]) or define('add_religions', BASEURL . '/add_religions');
defined($admin[20]) or define('caste', BASEURL . '/caste');
defined($admin[21]) or define('add_caste', BASEURL . '/add_caste');
defined($admin[22]) or define('sub_caste', BASEURL . '/sub_caste');
defined($admin[23]) or define('add_sub_caste', BASEURL . '/add_sub_caste');
defined($admin[24]) or define('free_user', BASEURL . '/free_user');
defined($admin[25]) or define('all_epin', BASEURL . '/all_epin');
defined($admin[26]) or define('user_plan', BASEURL . '/user_plan');
defined($admin[27]) or define('user_income', BASEURL . '/user_income');
defined($admin[28]) or define('payment_history', BASEURL . '/payment_history');
defined($admin[29]) or define('multiple_id_user', BASEURL . '/multiple_id_user');
defined($admin[30]) or define('plans', BASEURL . '/plans');
defined($admin[31]) or define('add_plans', BASEURL . '/add_plans');




