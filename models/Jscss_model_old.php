<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Jscss_model extends CI_Model {
        public function __construct()
        {
                //$this->load->database();
        }
        public function get_css($page)
        {
                $css_array=array();
				$css_array[]="assets/css/bootstrap.min.css";
				$css_array[]="assets/css/core.css";
				$css_array[]="assets/css/components.css";
				$css_array[]="assets/css/icons.css";
				$css_array[]="assets/css/pages.css";
				$css_array[]="assets/css/responsive.css";					
                if($page=='dashboard'){
                     $css_array[]="assets/plugins/morris/morris.css";   
                }

                return $css_array;
               
        }
        public function get_js($page)
        {
			$js_array=array();
			
			 if($page=='dashboard')
			 {
				$js_array[]="assets/js/jquery.min.js";
				$js_array[]="assets/js/bootstrap.min.js";
				$js_array[]="assets/js/detect.js";
				$js_array[]="assets/js/fastclick.js";
				$js_array[]="assets/js/jquery.slimscroll.js";
				$js_array[]="assets/js/jquery.blockUI.js";
				$js_array[]="assets/js/waves.js";
				$js_array[]="assets/js/wow.min.js";
				$js_array[]="assets/js/jquery.nicescroll.js";
				$js_array[]="assets/plugins/morris/morris.min.js";
				$js_array[]="assets/plugins/raphael/raphael-min.js";
				$js_array[]="assets/pages/jquery.dashboard_4.js";
				$js_array[]="assets/js/jquery.core.js";
				$js_array[]="assets/js/jquery.app.js";
				$js_array[]="assets/plugins/waypoints/lib/jquery.waypoints.js";
				$js_array[]="assets/js/jquery.scrollTo.min.js";
			 }
	
			$js_array[]="assets/plugins/notifyjs/js/notify.js";
			$js_array[]="assets/plugins/notifications/notify-metro.js";
			$js_array[]="assets/plugins/counterup/jquery.counterup.min.js";
			$js_array[]="assets/js/jquery.core.js";
			$js_array[]="assets/js/jquery.app.js";
			
			return $js_array;
						   
        }
}
