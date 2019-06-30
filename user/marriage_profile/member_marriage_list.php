<div class="content">
	<div class="wraper container">
		<!-- Page-Title -->
	<div class="row">
		<div class="col-sm-12">
			<h4 class="page-title">Profile</h4>
			
		</div>
	</div>

		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div class="profile-detail card-box">
					<div>
						<img src="<?= base_url()?>assets/images/users/avatar-1.jpg" class="img-circle" alt="profile-image">
						<hr>
						<h4 class="text-uppercase font-600">About Me</h4>
						<p class="text-muted font-13 m-b-30">
							<?php echo $match->my_self;?>
						</p>
						
						<div class="row m-t-30">
                                       <div class="col-xs-12">
                                           <!-- <h4><b>Specifications:</b></h4> -->
                                           <div class="table-responsive m-t-20">
                                               <table class="table">
                                                   <tbody>
                                                       <tr>
                                                           <td>Full Name</td>
                                                           <td>
                                                               <?= $match->fname.' '.$match->surname;?>
                                                           </td>
                                                       </tr>
                                                       <tr>
                                                           <td>Age</td>
                                                           <td>
                                                               <?= $match->age;?>
                                                           </td>
                                                       </tr>
                                                       <tr>
                                                           <td>Gender</td>
                                                           <td>
                                                              <?= $match->gender;?>
                                                           </td>
                                                       </tr>
                                                       <tr>
                                                           <td>Religions</td>
                                                           <td>
                                                               <?= $match->religions; ?>
                                                           </td>
                                                       </tr>
                                                       <tr>
                                                           <td>Married Status</td>
                                                           <td>
                                                               <?= $match->married_status; ?>
                                                           </td>
                                                       </tr>
                                                       <tr>
                                                           <td>Contact Number</td>
                                                           <td>
                                                               <?php if (!empty($match->contact_no)) {echo $match->contact_no;} else {echo "Contact Number Not Updated";}?>

                                                           </td>
                                                       </tr>
                                                       <tr>
                                                           <td>Email-Id</td>
                                                           <td>
                                                               <?php if (!empty($match->email_id)) {echo $match->email_id;} else {echo "Email-Id Not Updated";}?>

                                                           </td>
                                                       </tr>
                                                       <tr>
                                                           <td>Address</td>
                                                           <td>
                                                               <?= $match->address; ?>
                                                           </td>
                                                       </tr>
                                                       <tr>
                                                           <td>Color</td>
                                                           <td>
                                                               
                                                           </td>
                                                       </tr>
                                                       <tr>
                                                           <td>Hieght</td>
                                                           <td>
                                                               5.2 fit
                                                           </td>
                                                       </tr>
                                                       <tr>
                                                           <td >Gaut</td>
                                                           <td>
                                                              
                                                           </td>
                                                       </tr>
                                                       <tr>
                                                           <td>Kul</td>
                                                           <td>
                                                              
                                                           </td>
                                                       </tr>
                                                   </tbody>
                                               </table>
                                           </div>
                                       </div>
                                   </div>

					</div>
				</div>
			</div>
			<!-- <div class="col-lg-6 col-md-6">
				
				<div class="card-box">
					
					<div class="comment">
						<img src="<?= base_url();?>assets/images/users/avatar-1.jpg" alt="" class="comment-avatar">
						<div class="comment-body">
							<div class="comment-text">
								<div class="comment-header">
									<a href="#" title="">Ajay Gupta</a><span>about 4 hours ago</span>
								</div>
								i'm in the middle of a timelapse animation myself! (Very different
								though.) Awesome stuff.
							</div>
							
						</div>
					</div>
					<div class="comment">
						<img src="<?= base_url();?>assets/images/users/avatar-1.jpg" alt="" class="comment-avatar">
						<div class="comment-body">
							<div class="comment-text">
								<div class="comment-header">
									<a href="#" title="">Ajay Gupta</a><span>about 4 hours ago</span>
								</div>
								i'm in the middle of a timelapse animation myself! (Very different
								though.) Awesome stuff.
							</div>
							
						</div>
					</div>
					<div class="comment">
						<img src="<?= base_url();?>assets/images/users/avatar-1.jpg" alt="" class="comment-avatar">
						<div class="comment-body">
							<div class="comment-text">
								<div class="comment-header">
									<a href="#" title="">Ajay Gupta</a><span>about 4 hours ago</span>
								</div>
								i'm in the middle of a timelapse animation myself! (Very different
								though.) Awesome stuff.
							</div>
							
						</div>
					</div>
					
				</div>
			</div> -->

		</div>



	</div> <!-- container -->
			   
</div>