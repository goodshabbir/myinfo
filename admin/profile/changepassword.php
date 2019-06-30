<div class="row">

    <div class="col-sm-12">

        <div class="card-box">

            <h4 class="m-t-0 header-title">Update Password</h4>

        </div>

    </div>

</div>



<div class="row">

    <div class="col-sm-12">

        <div class="card-box">

            <h4 class="m-t-0 header-title"><b>Update Password</b></h4>

            <?= form_open('',array('method'=>'post')); ?>

            <div class="row">

                <div class="col-md-4">

                    <div class="p-20">

                        <h5><b>Old password</b></h5>

                        <p class="text-muted m-b-15 font-13">

                        Enter here your old password

                        </p>

                        <input type="password" name="old_password" class="form-control" value=""/>

                        <span class="text-danger"><?= form_error('old_password'); ?></span>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="p-20">

                        <h5><b>New Password</b></h5>

                        <p class="text-muted m-b-15 font-13">

                        Enter here new password.

                        </p>

                        <input type="password" class="form-control"  name="password"  />

                        <span class="text-danger"><?= form_error('password'); ?></span>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="p-20">

                        <h5><b>Confirm Password</b></h5>

                        <p class="text-muted m-b-15 font-13">

                          Enter her confim new password.

                        </p>

                        <input type="password" class="form-control" name="con_password" id="alloptions" />

                        <span class="text-danger"><?= form_error('con_password'); ?></span>

                    </div>

                </div>

                <div class="col-md-6"></div>

                <div class="col-md-6">

                    <div class="p-20">

                     <button class="btn btn-info pull-right">Submit</button>

                    </div>

                </div>

            </div>

        <?= form_close(); ?>

        </div>

    </div>

</div>
<?php 
    if(!empty($this->session->flashdata('message'))){
        echo "<script>window.onload=function() { $.Notification.notify ('".$this->session->flashdata('class')."','top right','".$this->session->flashdata('message')."'); } </script>";
    }
?>



