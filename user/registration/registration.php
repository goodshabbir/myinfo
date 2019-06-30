<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6" style="box-shadow: 0 0 5px #ccc;padding: 30px;">
        <form action="<?= signup; ?>" method="post">
        <input type="hidden" name="from_user" value="1">
            <div class="text-danger">
                <?php if (!empty($this->session->flashdata('msg'))) {?>
                <div class="alert alert-<?=$this->session->flashdata('class')?> alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?=$this->session->flashdata('msg')?>
                </div>
                <?php }?>
            </div>
            <div class="form-group">
                <label for="" class="form-label">Sponsor Id Code<span class="text-danger">*</span></label>
                <br><b><span id="msgs"></span></b>
                <input type="text" class="form-control" name="sponsor_id" <?php if(!empty($_GET['id'])) { echo "readonly"; } ?> onkeyup="checkdata(this.value,'1');" value="<?php if(!empty($_GET['id'])) { echo $_GET['id']; } else { echo set_value('sponsor_id'); } ?>" id="spo" placeholder="Enter sponsor id">
                <span class="text-danger"><?= form_error('sponsor_id')?></span>
                
                
                <label for="sab" class="col-form-label" style="width:49%"> <input type="radio" name="placement" value="left" checked="" id="sab"> Left</label>
                <label for="saba" class="col-form-label" style="width:49%"><input type="radio" name="placement" value="right" id="saba"> Right</label>
               <span class="text-danger"><?= form_error('placement')?></span>

                <label for="" class="col-form-label">User Id Code <span class="text-danger">*</span></label>
                    <input type="text"  name="user_name"  value="<?= set_value('user_name'); ?>"class="form-control" id="NAME" placeholder="Enter User name">
                 <span class="text-danger"><?= form_error('user_name')?></span>
                <label for="" class="col-form-label">Your Name <span class="text-danger">*</span></label>
                    <input type="text" value="<?= set_value('full_name'); ?>"  name="full_name" class="form-control" id="NAME1" placeholder="Enter Name">
               <span class="text-danger"><?= form_error('full_name')?></span>
                <label for="" class="col-form-label">Country<span class="text-danger">*</span></label>
                    <select name="Country" class="form-control">
                    <option>India</option>
                    <option>Pakistan</option>
                    <option>Nepal</option>
                    </select>
                    
               <span class="text-danger"><?= form_error('Country')?></span>
                <label for="" class="col-form-label">Contact No.<span class="text-danger">*</span></label>
                    <select name="" class="" style="position: absolute;padding: 6px;border-radius: 3px;z-index: 99;margin: 26px 0px 0 -83px;">
                    <option>+91</option>
                    <option>+92</option>
                    <option>+977</option>
                    </select>
                    <input type="text" value="<?= set_value('mobile'); ?>" name="mobile" class="form-control" id="MOBILE" placeholder="Enter Mobile Number" style="position: relative;padding-left: 13%;">
               <span class="text-danger"><?= form_error('mobile')?></span>

                <label for="" class="col-form-label">E-Mail<span class="text-danger">*</span></label>
                    <input type="text" value="<?= set_value('email'); ?>" name="email" class="form-control" id="EMAIL" placeholder="Enter Email Id">
                <span class="text-danger"><?= form_error('email')?></span>

                <label for="" class="col-form-label">Password <span class="text-danger">*</span></label>
                <input type="password" value="<?= set_value('password'); ?>" class="form-control" name="password" id="PASS" value="" placeholder="Password">
                <span class="text-danger"><?= form_error('password')?></span>
                <label for="" class="col-form-label">Confirm Password <span class="text-danger">*</span></label>
                <input type="password" class="form-control" name="confirm" id="txtconfirmpass" placeholder="Confirm Password">
                     <span class="text-danger"><?= form_error('confirm')?></span>
                <label for="check" class="col-form-label">
                    <input type="checkbox" name="checkbox" id="chk11">
                    Agree to terms and Condition <span class="text-danger">*</span></label>
                     <span class="text-danger"><?= form_error('checkbox')?></span>
                <input type="submit" class="form-control btn btn-info" id="" value="Register">
                <img src="/Content/loader.gif" class="loader" style="display:none;width:25px">
            </div>
            
        </form>
        
    </div>
    <div class="col-md-3">
    </div>
</div>
<script>
   function checkdata(id,value){
       var msg= '';
            if(value==1){
                 msg =  $("#msgs").html('loading...');
                }else{
                    msg =  $("#msgu").html('loading...');
                }
        $.ajax({
            url: '<?= site_url("welcome/getname") ?>',
            dataType:'json',
            type:'POST',
            data:{id:id},
            beforeSend: function(result){
               msg;
            },error: function(result){
                msg;
            },success: function(result){
                if(value==1){
                    if(result.success==1){
                        $("#msgs").css('color','rgb(243, 86, 5)');
                        $("#msgs").html(result.msg);
                    }else{
                        $("#msgs").css('color','red');
                        $("#msgs").html(result.msg);
                    }
                }else{
                    if(result.success==1){
                        $("#msgu").css('color','green');
                        $("#msgu").html(result.msg);
                    }else{
                        $("#msgu").css('color','red');
                        $("#msgu").html(result.msg);
                    }
                }
            }
        });
    }
</script>
<script>
   
$("#UpLoginFormName").on('keyup change blur', function(){
    var selfid = $("#self_idd").val();
    console.log(selfid+'='+this.value);
		$.ajax({
      url: '<?php echo site_url('welcome/getupsponsornmae/')?>'+this.value,
      method : 'GET',
      data : {sponsor_id : selfid ,upline_id : this.value},
			success: function(result){
        console.log(result);
				if(result!=false)
				{
					$("#up_result").css('color','green');
					$("#up_result").css('font-size','12px');
					$("#up_result").html(result);
				}
				else
				{
					$("#up_result").css('color','#ff0000');
					$("#up_result").css('font-size','12px');
					$("#up_result").html('Invalid Upline Sponsor id');
				}
			}
		});
	});
	</script> 