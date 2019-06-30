 
       
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="row">

  <div class="col-sm-12">
    <div class="card-box">
      <h4 class="m-t-0 header-title headingStyle"><b>Member Policy</b></h4>
          <div class="panel-body">

            <p><b>1.</b> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
            <p><b>2.</b> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
            <p><b>3.</b> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
            <p><b>4.</b> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
            <p><b>5.</b> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
            <p><b>6.</b> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
            <p><b>7.</b> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
          <button class="btn btn-default" data-toggle="modal"  data-target=".bs-example-modal-lg">Update</button> </center>
          </div>
    </div>
  </div>
</div>
<div class="container">
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"  id="onload">

    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title"><i class="fa fa-exclamation-circle"></i>Please, Firstly Update Member Type</h4>
        </div>
        <div class="modal-body">
          <form method="post" action="<?= site_url('user/update_member');?>">
                <div class="row__"> 
                      <input type="hidden" name="id" value="<?= $this->session->userdata['user']['id'];?>">  
                    <label class="radio-inline">
                    <input type="radio" name="profile_type" value="1" required >Personal Member
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="profile_type" value="2">Associated Member
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="profile_type" value="0">Both Member
                  </label>
                  <span class="text-danger"><?= form_error('profile_type');?></span>
                </div> 
              </div> 
              <div class="modal-footer">
                <button type="submit" class="btn btn-default" >Update</button>
              </div>
          </form>

        </div>
        
      </div>

    </div>
</div>

<script>
   $(window).load(function(){
                $('#onload').modal('show');
      });
</script>