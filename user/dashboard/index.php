<?php
//print_r($this->session->userdata['user']); die;

$id = $this->session->userdata['user']['id'];

$obj = new welcome_model();

$record = $obj->getsinglerow(TBL_USER, ['id' => $id]);
// print_r($My_Sponsor_User_ID);die;
// echo '<pre>';print_r($record);die;
?>

<div class="row " > 


            <div class="col-sm-12">
          <div class="card-box">
            <h4 class="m-t-0  headingStyle"><b>My Membership Information </b></h4>
            <div class="row">
              <div class="col-lg-6 col-sm-6">
                <div class="widget-inline-box text-center">
                <h4 class="text-muted">My User ID : <?= $record->sponsor_id;?></h4>
                  <h4 class="text-muted">My Name : <?= $record->full_name;?></h4>
                  <h4 class="text-muted">My Registration Date: <?= $record->create_at;?></h4>
                  <h4 class="text-muted">My Activation Date: <?= $record->activation_date;?></h4>
             </div>
            </div>
            <div class="col-lg-6 col-sm-6">
                   <h4 class="text-muted">My Mobile No : <?= $record->mobile;?></h4>
                    <h4 class="text-muted">My Initial  Plan: ₹ <?php if($record->upgrade_plan!=NULL && $record->upgrade_plan!=0) { echo $record->upgrade_plan;}else{ echo '0 '.'N/A';} ?></h4>
                    <h4 class="text-muted">My Current Plan : ₹ <?php if ($record->upgrade_plan != null && $record->upgrade_plan != 0) {echo $record->upgrade_plan;} else {echo '0 ' . 'N/A';}?></h4>
                    
                
              </div>
            </div>
            
          </div>
      </div>
      <div class="col-sm-12">
          <div class="card-box">
            <h4 class="m-t-0  headingStyle"><b>My Sponsor's ID And Upper's ID Information </b></h4>
            <div class="row">
              <div class="col-lg-6 col-sm-6">
                <div class="widget-inline-box text-center">
                    <h4 class="text-muted">My Sponsor's User ID: <?= $My_Sponsor_User_ID->sponsor_id;?> </h4>
                    <h4 class="text-muted">My Sponsor's Name :<?= $My_Sponsor_User_ID->user_name;?> </h4>
                    <h4 class="text-muted">My Sponsor's Mobile No:<?= $My_Sponsor_User_ID->mobile;?> </h4>
                </div>
              </div>
              <div class="col-lg-6 col-sm-6">
                  <h4 class="text-muted">My Upper's User ID:<?= $My_Sponsor_User_ID->sponsor_id;?> </h4>
                  <h4 class="text-muted">My Upper's Name :<?= $My_Sponsor_User_ID->user_name;?> </h4>
                  <h4 class="text-muted">My Upper's Mobile No:<?= $My_Sponsor_User_ID->mobile;?>  </h4>
                </div>
              </div>
            </div>
          </div>
        
     

       <div class="col-sm-12">
          <div class="card-box">
            <h4 class="m-t-0  headingStyle"><b>Upgrade My Plan</b></h4>
            <div class="row">
              <div class="col-lg-12 col-sm-12">
                <div class="widget-inline-box text-center">
                 
                  <h4 class="text-muted">Upgrade My Plan : <a href="activation">Click Here  </a></h4>                 
                </div>
              </div>
              
              </div>
            </div>
          </div>
          </div>
    <div class="row">
		<div class="col-sm-12">
			<div class="card-box" style="margin-bottom:45px">
				<h4 class="page-title"> Send My Refferal Link</i>: <button style="    margin-left: 150px;margin-bottom: 10px;"class="btn btn-pink btn-custom btn-rounded waves-effect waves-light"onclick="copyToClipboard('#p1')" href="<?=base_url('signup?id=') . $record->sponsor_id;?>" ><p id="p1">http://myinformation.in/myinformation/signup?id=<?=$record->sponsor_id;?></p></button></h4>
				 <?=$this->session->flashdata('upgrade');?>
				<div class="col-md-12">
						<script>
						function copyToClipboard(element) {
						  var $temp = $("<input>");
						  $("body").append($temp);
						  $temp.val($(element).text()).select();
						  document.execCommand("copy");
						  $temp.remove();
						}

						</script>       
				</div>
			</div>
		</div>
	</div>

  </div>
<?PHP
if (isset($_GET['success'])) {
    echo "<script>window.onload=function(){ $.Notification.notify('success','top center','Successfully Login','Welcome to ayushvardhanm user panel please'); }</script>";
}
?>
 <script type="text/javascript">
   window.onload=function() {
       var clock;
        var lastdate = <?php //$lastdate;?>;
      clock = $('.clock').FlipClock({
            clockFace: 'DailyCounter',
            autoStart: false,
            callbacks: {
              stop: function() {
            $('.message').css('color','#7b0505');
                $('.message').html('Your reward timeline has been over so now you are eligible only for 50% reward.');
              }
            }
        });
      if(lastdate){
        clock.setTime(lastdate);
        clock.setCountdown(true);
        clock.start();
      }else{
        clock.stop();
      }
    }
  </script>
<?php

?>