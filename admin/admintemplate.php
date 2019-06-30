
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="Coderthemes">
		 <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/logo.png">
        <link rel="stylesheet" href="<?php echo base_url("assets/css/sweetalert.css"); ?>" >
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script  src="<?= base_url('assets/css/sweetalert-dev.js'); ?>" ></script>
		
		<title><?php echo $page; ?></title>
		<script>
			var base_url="<?php echo site_url(); ?>";
			</script>
			<!-- Vendor styles -->
			<?php  
				$obj= new jscss_model();
				$css=$obj->get_css($page);
				$js=$obj->get_js($page);
				foreach($css as $csrow)
				{
				?> 
				<link href="<?php echo base_url($csrow); ?>" rel="stylesheet" type="text/css" >
				<?php
				}
			?>
        <script src="<?= base_url();  ?>assets/js/modernizr.min.js"></script>
	</head>
	<body class="fixed-left">
		<!-- Begin page -->
		<div id="wrapper">
            <!-- Top Bar Start -->
            <div class="topbar">
                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        
                        <!-- Image Logo here -->

                        <a href="index.html" class="logo">
                        <i class="icon-c-logo"> <img src="<?= base_url(); ?>assets/images/logo.png" height="42"/> </i>

                            <span><img src="<?= base_url(); ?>assets/images/logo.png" height="50"/></span>

                        </a>

                    </div>
                </div>
                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <div class="pull-left">
                                <button class="button-menu-mobile open-left waves-effect waves-light">
                                    <i class="md md-menu"></i>
                                </button>
                                <span class="clearfix"></span>
                            </div>
                            <ul class="nav navbar-nav navbar-right pull-right">
                                <li class="hidden-xs">
                                    <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="icon-size-fullscreen"></i></a>
                                </li>
                                
                                <!--li class="hidden-xs">

                                    <a href="#" class="right-bar-toggle waves-effect waves-light"><i class="icon-settings"></i></a>

                                </li-->
                                <li class="dropdown top-menu-item-xs">
                                    <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
									<!--img src="<?php echo base_url('uploads/profile/').$this->session->userdata['admin']['profile_image']; ?>" alt="user-img" class="img-circle"-->
									 <?= $this->session->userdata['admin']['email'];?> <i class="fa fa-arrow-down"></i>
									</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?= adminprofile; ?>"><i class="ti-user m-r-10 text-custom"></i> Profile</a></li>
                                        <li class="divider"></li>
                                        <li><a href="<?= change;?>"><i class="fa fa-key m-r-10 text-danger"></i> Change Password</a></li>
                                        <li class="divider"></li>
                                        <li><a href="<?= admin_logout;?>"><i class="ti-power-off m-r-10 text-danger"></i> Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->
            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft" style="overflow: scroll;">
                    <!--- Divider -->
                    <div id="sidebar-menu">
                        <ul>
                        <li class="has_sub">
                            <a href="<?= site_url('admin');?>" class="waves-effect"><i class="ti-home"></i> <span> Dashboard </span> </a>  
                        </li>	
                        <li class="">
							<a href="<?= latest_news;?>" class="waves-effect"><i class="fa fa-newspaper-o"></i> <span>Latest News Section</span>  </a>								   
						</li>
                        <li class="">
							<a href="<?= testmonial;?>" class="waves-effect"><i class="fa fa-quote-left"></i> <span>Testmonial</span>  </a>								   
						</li>
                        <li class="">
							<a href="<?= importent;?>" class="waves-effect"><i class="fa fa-photo"></i> <span>Important Notice</span>  </a>								   
						</li>
                        <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-users"></i> <span>User Information</span> <span class="menu-arrow"></span> </a>
                                <ul class="list-unstyled">
                                    <li><a href="<?= member_profile;?>">User's detail</a></li>
                                    <li><a href="<?= userlist;?>">Registered User's Information</a></li>
                                    <li><a href="free_user">Free user's Information</a></li>
                                    <li><a href="user_plan">User's Plan Information</a></li>
                                    <li><a href="multiple_id_user">User's Multiple ID' Information</a></li>
                                    <li><a href="user_income">User's Income Information</a></li>
                                    <li><a href="payment_history">User's Payment's Information</a></li>
                                </ul> 
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-users"></i> <span>Religions</span> <span class="menu-arrow"></span> </a>
                                <ul class="list-unstyled">
                                    <li><a href="religions">Add Religions</a></li>
                                    <li><a href="caste">Add Caste</a></li>
                                    <li><a href="sub_caste">Add Sub Caste</a></li>
                                </ul> 
                            </li> 
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-users"></i> <span>subscription Plans </span> <span class="menu-arrow"></span> </a>
                                <ul class="list-unstyled">
                                    <li><a href="plans">Add Plans</a></li>
                                </ul> 
                            </li> 
                                
                                <li class="">
									<a href="<?= view_slider;?>" class="waves-effect"><i class="fa fa-file-image-o"></i> <span>Slider</span>  </a>								   
								</li>
                                <li class="">
									<a href="<?= regional; ?>" class="waves-effect"><i class="fa fa-code"></i> <span> Regional Experts</span>  </a>								   
								</li>
                                 
                                <!-- <li class="">
								    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-life-ring"></i> <span> Marriage Folder </span>  </a>								   
							    </li>
                                <li class="">
								    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-paragraph"></i> <span> Personality Folder </span>  </a>								   
							    </li> -->
                               
                                <li class="has_sub">
                                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-history"></i> <span>ePin History</span> <span class="menu-arrow"></span> </a>
                                    <ul class="list-unstyled">
                                        <li><a href="all_epin" title="Binary Income">All ePin</a></li>
                                        <li><a href="<?= epin_history; ?>" title="Level Income">Transfer ePin</a></li>
                                    </ul> 
                                </li>
                                <li class="has_sub">
                                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-info-circle"></i> <span>Income</span> <span class="menu-arrow"></span> </a>
                                    <ul class="list-unstyled">
                                        <li><a href="<?= step_income; ?>" title="Level Income">Step Income</a></li>
                                        <li><a href="<?= matching_income; ?>" title="Binary Income">Matching Income</a></li>
                                    </ul> 
                                </li> 
                                <li class="has_sub">
                                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-cog"></i> <span>Setting</span> <span class="menu-arrow"></span> </a>
                                        <ul class="list-unstyled">
                                            <li><a href="<?= adminprofile; ?>">Update Profile</a></li>
                                            <li><a href="change">Change Password</a></li>
                                            <li><a href="admin_logout">Logout</a></li>
                                        </ul> 
                                    </li> 
                                </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
			<!-- Left Sidebar End -->
			<!-- ============================================================== -->

			<!-- Start right Content here -->

			<!-- ============================================================== -->
			<div class="content-page">
				<!-- Start content -->
				<div class="content">
					<?php $this->load->view('admin/'.$content)?>         
                </div> <!-- content -->
                <footer class="footer">
                    © 2017. All rights reserved. Develop By <a href="http://slashtechnologies.com/" target="_black"> Slash Technologies</a>
                </footer>
            </div>
            <!-- ============================================================== -->

            <!-- End Right content here -->

            <!-- ============================================================== -->
            <!-- Right Sidebar -->
        </div>
        <!-- END wrapper -->
        <script>
            var resizefunc = [];
        </script>
    <?php
     foreach($js as $csrow){
		?> 
		 <script src="<?php echo  base_url($csrow); ?>"></script>
		<?php

	}
   ?>

<?php if (!empty($this->session->flashdata('success'))) {?>
    <script>
        window.onload=function(){
            $.Notification.notify('success','top-right','<?=$this->session->flashdata("success")?>','<?=$this->session->flashdata("message")?>');
        }
    </script>
    <?php }if (!empty($this->session->flashdata('error'))) {?>
        <script>
            window.onload=function(){
                $.Notification.notify('error','top-right','<?=$this->session->flashdata("error")?>','<?=$this->session->flashdata("message")?>');
            }
        </script>
    <?php }?>		
	</body>
</html>