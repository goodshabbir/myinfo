<?php defined('BASEPATH') OR exit('No direct script access allowed');

function userid(){
	$CI =& get_instance();
	return !empty($CI->session->userdata['user']['id']) ? $CI->session->userdata['user']['id'] : ""; 
}
function sponsorid(){
	$CI =& get_instance();
	return !empty($CI->session->userdata['user']['sponsor_id']) ? $CI->session->userdata['user']['sponsor_id'] : "";
}
?>