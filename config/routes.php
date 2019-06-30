<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['forgot'] = 'welcome/forgot';
$route['auth']   = 'welcome/access';
$route['login'] = 'welcome/user';
$route['signup'] = 'welcome/registration';
$route['about'] = 'welcome/about'; 
$route['faq'] = 'welcome/faq';
$route['contact'] = 'welcome/contact';
$route['regional_experts'] = 'welcome/regional_experts';
$route['privacy_policy'] = 'welcome/privacy_policy';
$route['terms_condition'] = 'welcome/terms_condition';
$route['legal'] = 'welcome/legal';
$route['share_earn'] = 'welcome/share_earn';
$route['our_bank'] = 'welcome/our_bank';
$route['plan_purchase'] = 'welcome/plan_purchase';
$route['packege'] = 'welcome/packege';


$route['tree']  = 'user/graphicalView';
$route['profiles'] = 'user/userprofile';
$route['bank'] = 'user/otherdetails';
$route['personal'] = 'user/personal_details';
$route['setting'] = 'user/setting';
$route['family'] = 'user/fill_family_form';
$route['logout'] = 'user/logout';
$route['my_information'] = 'user/my_information';
$route['profile_matching'] = 'user/profile_matching';
$route['record'] = 'user/send_message';
$route['all_document'] = 'user/all_document';
$route['resume'] = 'user/resume';
$route['plan'] = 'user/plan';
$route['level'] = 'user/level';
$route['upgrade_plan'] = 'user/upgrade_plan';
$route['steps_income'] = 'user/steps_income';
$route['matching_incomes'] = 'user/matching_incomes';
$route['create_pin'] = 'user/create_pin';
$route['transfer_epin'] = 'user/transfer_epin';
$route['activation'] = 'user/activation';
$route['upgration'] = 'user/upgration';
$route['downline'] = 'user/mydownline';
$route['mydirect'] = 'user/mydirect';
$route['expenses'] = 'user/expenses';
$route['edit_expenses'] = 'user/edit_expenses';
$route['other_income'] = 'user/other_income';
$route['edit_other_income'] = 'user/edit_other_income';
$route['special'] = 'user/special';

/**==================admin============================ */

$route['masteradmin'] = 'auth/login';
$route['adminprofile'] = 'admin/adminprofile';
$route['sliders'] = 'admin/sliders';
$route['change'] = 'admin/changepassword';
$route['admin_logout'] = 'admin/admin_logout';
$route['userlist'] = 'admin/userlist';
$route['member_profile'] = 'admin/member_profile';
$route['full_profile'] = 'admin/full_profile';
$route['step_income'] = 'admin/level_ncome';
$route['matching_income'] = 'admin/binary_income';
$route['epin_history'] = 'admin/epin_history';
$route['downline_history'] = 'admin/downline_history';
$route['generate_password'] = 'admin/generate_password';
$route['latest_news'] = 'admin/latest_news';
$route['testmonial'] = 'admin/testmonial';
$route['importent']='admin/importent';
$route['regional']='admin/regional_experts';
$route['view_slider'] = 'admin/view_slider';

$route['religions'] = 'admin/religions';
$route['plans'] = 'admin/plans';
$route['add_plans'] = 'admin/add_plans';
$route['add_religions'] = 'admin/add_religions';
$route['caste'] = 'admin/caste';
$route['add_caste'] = 'admin/add_caste';
$route['sub_caste'] = 'admin/sub_caste';
$route['add_sub_caste'] = 'admin/add_sub_caste';
$route['free_user'] = 'admin/free_user';
$route['all_epin'] = 'admin/all_epin';
$route['user_plan'] = 'admin/user_plan';
$route['user_income'] = 'admin/user_income';
$route['payment_history'] = 'admin/payment_history';
$route['multiple_id_user'] = 'admin/multiple_id_user';


$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
