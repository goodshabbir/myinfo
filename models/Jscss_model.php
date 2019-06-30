<?php defined('BASEPATH') OR exit('No direct script access allowed');
Class Jscss_model extends CI_Model{
	public function __construct()
        {
                //$this->load->database();
        }
    public function get_css($page)
        {
			$css_array=array();
			$css_array[]="assets/plugins/morris/morris.css";
			$css_array[]="assets/css/bootstrap.min.css";
			$css_array[]="assets/css/core.css";
			$css_array[]="assets/css/components.css";
			$css_array[]="assets/css/icons.css";
			$css_array[]="assets/css/pages.css";
			$css_array[]="assets/css/responsive.css";
			$css_array[]="assets/css/style.css";
			$css_array[]='assets/plugins/jquery.steps/css/jquery.steps.css';

			if($page=='ecash_request' || $page=='requeststatus')
            {
                $css_array[]="assets/plugins/custombox/css/custombox.css";
            }
			if($page=='closingDate'){
				$css_array[]="assets/plugins/fullcalendar/css/fullcalendar.min.css";
			}
			if($page=='pospond'){
				$css_array[] ='assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css';
			}
			if($page=='index'){
				$css_array[]="assets/css/flipclock.css";
			}
			if($page=='levelinfo'){
				$css_array[] ='assets/plugins/datatables/jquery.dataTables.min.css';
				$css_array[] ='assets/plugins/datatables/fixedColumns.dataTables.min.css';
			}
			return $css_array;
		}
	public function get_js($page)
        {
			$js_array=array();
			$js_array[]="assets/js/jquery.min.js";
			$js_array[]="assets/js/bootstrap.min.js";
			$js_array[]="assets/js/detect.js";
			$js_array[]="assets/js/fastclick.js";
			$js_array[]="assets/js/jquery.slimscroll.js";
			$js_array[]="assets/js/jquery.blockUI.js";
			$js_array[]="assets/js/waves.js";
			$js_array[]="assets/js/wow.min.js";
			$js_array[]="assets/js/jquery.nicescroll.js";
			$js_array[]="assets/js/jquery.scrollTo.min.js";
			$js_array[]="assets/js/jquery.core.js";
			$js_array[]="assets/js/jquery.app.js";
			$js_array[]="assets/plugins/notifyjs/js/notify.js";
			$js_array[]="assets/plugins/notifications/notify-metro.js";
			$js_array[]='assets/plugins/jquery.steps/js/jquery.steps.min.js';
			$js_array[]='assets/plugins/jquery-validation/js/jquery.validate.min.js"';
			$js_array[]='assets/pages/jquery.wizard-init.js';
            if($page=='ecash_request' || $page=='requeststatus' )
            {
                $js_array[]="assets/plugins/custombox/js/custombox.min.js";
                $js_array[]="assets/plugins/custombox/js/legacy.min.js";
            }
			if($page=='closingDate'){
				$js_array[]="assets/plugins/jquery-ui/jquery-ui.min.js";
				$js_array[]="assets/plugins/moment/moment.js";
				$js_array[]="assets/plugins/fullcalendar/js/fullcalendar.min.js";
				$js_array[]="assets/pages/jquery.fullcalendar.js";

			}
			if($page=='pospond'){
				$js_array[] ='assets/plugins/timepicker/bootstrap-timepicker.js';
				$js_array[] ='assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js';
				$js_array[] = 'assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js';
				$js_array[] ='assets/pages/jquery.form-pickers.init.js';
			}
			if($page=='index'){
				$js_array[]="assets/js/flipclock.js";
			}
			if($page=='levelinfo'){

				$js_array[]="assets/plugins/datatables/jquery.dataTables.min.js";
				$js_array[]="assets/plugins/datatables/dataTables.bootstrap.js";
				$js_array[]="assets/pages/datatables.init.js";

			}
			if($page=='my information'){

				$js_array[]="assets/plugins/datatables/jquery.dataTables.min.js";
				$js_array[]="assets/plugins/datatables/dataTables.bootstrap.js";
				$js_array[]="assets/pages/datatables.init.js";

			}
			return $js_array;

		}
}
?>
