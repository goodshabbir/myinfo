<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="mlm">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/logo.png">
        <title>My Information|UserPanel</title>
        <!--Morris Chart CSS -->
		<script>
			var base_url="<?php echo site_url(); ?>";
		</script>
    <!-- Vendor styles -->
	<?php  $obj= new jscss_model();
			$css=$obj->get_css($page);
			$js=$obj->get_js($page);
			foreach($css as $csrow){
		?> 
			<link href="<?php echo base_url($csrow); ?>" rel="stylesheet"><?php
		}
	?>
        <script src="<?php echo base_url();?>assets/js/modernizr.min.js"></script>
    </head>
    <body class="fixed-left">
        <div id="wrapper">
             <!-- Top Bar Start -->
            <div class="topbar">
                <!-- LOGO -->
               
                <div class="topbar-left">
                
                    <div class="text-center">
                        <a href="<?php echo site_url('user');?>" class="logo"><i class="icon-bold icon-c-logo"></i><span><?php echo $this->session->userdata['user']['sponsor_id']; ?></span></a>
                        
                    </div>
                    
                </div>
                <!-- Button mobile view to collapse sidebar menu -->
                <?php $this->load->view('user/layout/header'); ?>
            </div>
            <!-- Top Bar End -->
            <!-- ========== Left Sidebar Start ========== -->

            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <!--- Divider -->
                     <?php $this->load->view('user/layout/sidebar'); ?>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- END wrapper -->
		<div class="content-page">
                <div class="content">
                    <div class="wraper container">
						<?php $this->load->view("user/".$content); ?>
					</div>
				</div>
		<footer class="footer">
                  <?php $this->load->view('user/layout/footer');?>
        </footer>
		</div>
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
    </body>
    <?php if(!empty($this->session->flashdata('success'))) { ?> 
    <script>
        window.onload=function(){
            $.Notification.notify('success','top-right','<?= $this->session->flashdata("success") ?>','<?= $this->session->flashdata("message") ?>');
        }
    </script>
    <?php } if(!empty($this->session->flashdata('error'))) { ?> 
        <script>
            window.onload=function(){
                $.Notification.notify('error','top-right','<?= $this->session->flashdata("error") ?>','<?= $this->session->flashdata("message") ?>');
            }
        </script>
    <?php }?>
    
</html>