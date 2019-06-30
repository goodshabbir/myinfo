

<div class="row">

<div class="col-sm-12">
  <div class="card-box">
    <h4 class="m-t-0 header-title headingStyle"><b>Members Information</b></h4>
        <div class="row">
          <div class="col-lg-3 col-sm-3">
            <div class="widget-inline-box text-center">
              <h3>800 <b data-plugin="counterup"><?php //$directIncome;?></b></h3>
                <h4 class="text-muted">Total Register Members</h4>
             </div>
            </div>
            <div class="col-lg-3 col-sm-3">
              <div class="widget-inline-box text-center">
                <h3>700 <b data-plugin="counterup"><?php //$directIncome?></b></h3>
                        <h4 class="text-muted">Total  Pending Members</h4>
              </div>
            </div>
            <div class="col-lg-3 col-sm-3">
              <div class="widget-inline-box text-center">
                <h3>30 <b data-plugin="counterup"><?php //$directIncome?></b></h3>
                        <h4 class="text-muted">Total  Block Members</h4>
              </div>
            </div>
            <div class="col-lg-3 col-sm-3">
              <div class="widget-inline-box text-center">
                <h3>4 <b data-plugin="counterup"><?php //$directIncome?></b></h3>
                <h4 class="text-muted">Total Active Members</h4>
               </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12">
          <div class="card-box">
            <h4 class="m-t-0 header-title headingStyle"><b>Total Income</b></h4>
            <div class="row">
              <div class="col-lg-6 col-sm-6">
                <div class="widget-inline-box text-center">
                  <h3><i class="text-custom  fa fa-money"></i> <b data-plugin="counterup"><?php //$directIncome;?></b></h3>
                  <h4 class="text-muted">Total Step income</h4>
                </div>
              </div>
              <div class="col-lg-6 col-sm-6">
                <div class="widget-inline-box text-center">
                  <h3><i class="text-custom fa fa-money"></i> <b data-plugin="counterup"><?php //$coreIncome;?></b></h3>
                  <h4 class="text-muted">Total Matching income</h4>
                </div>
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