<div class="row">
    <div class="col-sm-12">
    <div class="card-box">
        <h4 class="m-t-0 header-title"><b>Change Password By Admin</b></h4>
        
        <div class="row">
            
                <form role="form" method="post" action="<?= generate_password;?>">
                    <input type="hidden" name="id" value="<?php echo $id=$_GET['id'];?>">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label" for="example-input1-group1">New Password Generate</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input type="password" id="example-input1-group1" name="password" value="<?= set_value('password');?>"class="form-control" placeholder="Password">
                            
                        </div>
                            <span class="text-danger"><?= form_error('password');?></span>
                    
                    </div> <!-- form-group -->
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                    <label class="control-label" for="example-input1-group1">Confirm Password</label>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input type="password" id="example-input2-group1" name="cfiorm" class="form-control" placeholder="Confirm Password">
                            
                        </div>
                        <span class="text-danger"><?= form_error('cfiorm');?></span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-purple waves-effect waves-light">Submit</button>
                </form>
            </div>
            
          
           
        
    </div>
    </div>
    </div>