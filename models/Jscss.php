<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Jscss extends CI_Model {
	public function __construct()
	{
			
	}

	function css($page){
		$css_array = array();
		$css_array[] = 'assets/css/material/bootstrap.min.css?v4.0.1';
		$css_array[] = 'assets/css/material/bootstrap-extend.min.css?v4.0.1';
		$css_array[] = 'assets/css/site.minfd53.css?v4.0.1';
		$css_array[] = 'assets/css/material/animsition.min.css?v4.0.1';
		$css_array[] = 'assets/css/material/asScrollable.min.css?v4.0.1';
		$css_array[] = 'assets/css/material/switchery.min.css?v4.0.1';
		$css_array[] = 'assets/css/material/introjs.min.css?v4.0.1';
		$css_array[] = 'assets/css/material/slidePanel.min.css?v4.0.1';
		$css_array[] = 'assets/css/material/flag-icon.min.css?v4.0.1';
		$css_array[] = 'assets/css/material/waves.min.css?v4.0.1';
		$css_array[] = 'assets/css/material/chartist.min.css?v4.0.1';
		$css_array[] = 'assets/css/material/jquery-jvectormap.min.css?v4.0.1';
		$css_array[] = 'assets/css/material/chartist-plugin-tooltip.min.css?v4.0.1';
		//$css_array[] = 'assets/css/examples/css/dashboard/v1.minfd53.css?v4.0.1';
		$css_array[] = 'assets/css/material/material-design.min.css?v4.0.1';
		//$css_array[] = 'assets/css/material/brand-icons.min.css';

		if($page=='user_list' || $page=='employee' || $page=='newlist' || $page=='activekyc' || $page=='pendingkyc' || $page=='rejectedkyc'){
			 $css_array[] = 'assets/css/datatable/dataTables.bootstrap4.min.css';
		}
        if($page=='isStartOrNot' || $page=='pause_request'){
            $css_array[] = 'assets/css/loaders.css';
        }
		return $css_array;
	}

	function js($page){

		$js_array = array();
		$js_array[] = 'assets/js/materail/email-decode.min.js';
		$js_array[] = 'assets/js/materail/babel-external-helpers.js';
		$js_array[] = 'assets/js/materail/jquery.min.js';
		$js_array[] = 'assets/js/toster/jquery.toast.js';
		$js_array[] = 'assets/js/toster/toastr.js';
		$js_array[] = 'assets/js/materail/popper.min.js';
		$js_array[] = 'assets/js/materail/bootstrap.min.js';
		$js_array[] = 'assets/js/materail/animsition.min.js';
		$js_array[] = 'assets/js/materail/jquery.mousewheel.min.js';
		$js_array[] = 'assets/js/materail/jquery-asScrollbar.min.js';
		$js_array[] = 'assets/js/materail/jquery-asScrollable.min.js';
		$js_array[] = 'assets/js/materail/jquery-asHoverScroll.min.js';
		$js_array[] = 'assets/js/materail/waves.min.js';

		 $js_array[] = 'assets/js/materail/switchery.min.js';
		 $js_array[] = 'assets/js/materail/intro.min.js';
		 $js_array[] = 'assets/js/materail/screenfull.min.js';
		 $js_array[] = 'assets/js/materail/jquery-slidePanel.min.js';
	
        // $js_array[] ="assets/examples/js/advanced/maps-google.minfd53.js?v4.0.1";

		


		$js_array[] = 'assets/js/materail/State.min.js';
		$js_array[] = 'assets/js/materail/Component.min.js';  // load website
		$js_array[] = 'assets/js/materail/Plugin.min.js';
		$js_array[] = 'assets/js/materail/Base.min.js';   // load website
		$js_array[] = 'assets/js/materail/Config.min.js'; 

		 $js_array[] = 'assets/js/Section/Menubar.minfd53.js';
		 $js_array[] = 'assets/js/Section/Sidebar.minfd53.js';
		  $js_array[] = 'assets/js/Section/PageAside.minfd53.js';
		 $js_array[] = 'assets/js/Plugin/menu.minfd53.js';  // sidebar
		 $js_array[] = 'assets/js/materail/colors.min.js';  // sidebar

		 $js_array[] = 'assets/js/config/tour.minfd53.js';

		 $js_array[] = 'assets/js/Site.minfd53.js';

		
	
		  $js_array[] = 'assets/examples/js/dashboard/v1.minfd53.js'; // load website
		

		  if($page=='index'){

				$js_array[] = 'assets/js/materail/chartist.min.js';
				$js_array[] = 'assets/js/materail/chartist-plugin-tooltip.min.js?v4.0.1';
				$js_array[] = 'assets/js/materail/jquery-jvectormap.min.js?v4.0.1';
				$js_array[] = 'assets/js/materail/jquery-jvectormap-world-mill-en.js';
				$js_array[] = 'assets/js/materail/jquery.matchHeight-min.js';
				$js_array[] = 'assets/js/materail/jquery.peity.min.js';
				$js_array[] = 'assets/js/materail/asscrollable.min.js';
				$js_array[] = 'assets/js/materail/slidepanel.min.js';
				$js_array[] = 'assets/js/materail/switchery.min.js';
				$js_array[] = 'assets/js/materail/matchheight.min.js';
				$js_array[] = 'assets/js/materail/jvectormap.min.js';
				$js_array[] = 'assets/js/materail/peity.min.js';
		  }
		  if($page=='user_list' || $page=='employee' || $page=='newlist' || $page=='activekyc' || $page=='pendingkyc' || $page=='rejectedkyc'){
			  $js_array[] = 'assets/js/Plugin/datatable/jquery.dataTables.js';
			  $js_array[] = 'assets/js/Plugin/datatable/dataTables.bootstrap4.js';
          }
          
		return $js_array;
	}
} 
?>
