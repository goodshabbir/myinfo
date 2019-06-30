
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="row">
            <div class="col-lg-12">
                <h4 class="m-t-0 header-title text-danger text-center"><b>Please, Upgrade Your Plan</b></h4>
            </div>
                <div class="col-lg-6">
                
                    <h4 class="m-t-0 header-title"><b>Member Details</b></h4>
                    <div class="p-20">
                        <table class="table table table-hover m-0">
                            <tbody>
                                <tr>
                                    <th>User Id Code :</th>
                                     <td><?= $userRecord->sponsor_id; ?></td>
                                </tr>
                                <tr>
                                    <th>Position :</th>
                                     <td><?= $userRecord->position; ?></td>
                                </tr>
                                <tr>
                                    <th>Member Name :</th>
                                    <td><?= $userRecord->full_name; ?></td>
                                </tr>
                                 <tr>
                                    <th>Date Of Registration :</th>
                                    <td><?= $userRecord->create_at; ?></td>
                                </tr>
                                <tr>
                                    <th>Mobile Number :</th>
                                    <td><?= $userRecord->mobile; ?></td>
                                </tr>
                                <tr>
                                    <th>Email-Id :</th>
                                    <td><?= $userRecord->email; ?></td>
                                </tr>
                                <tr>
                                    <th>Activation Date :</th>
                                    <td><?= $userRecord->activation_date; ?></td>
                                </tr>
                                <tr>
                                    <th>Current Plan :</th>
                                    <td><?php if($userRecord->upgrade_plan !=NULL) { echo $userRecord->upgrade_plan;}else{ echo 'N/A';} ?></td>
                                </tr>
                            </tbody>
                        </table> 
                    </div>
                </div>
                <div class="col-lg-6">
                    <h4 class="m-t-0 header-title"><b>Sponsor Details</b></h4>
                    <div class="p-20">
                        <table class="table table table-hover m-0">
                            <tbody>
                                <tr>
                                    <th>Sponsor Id</th>
                                     <td>2345432</td>
                                </tr>
                                <tr>
                                    <th>Sponsor Name</th>
                                    <td>ajeet</td>
                                </tr>                                
                                <tr>
                                    <th>Sponsor Mobile</th>
                                    <td>1234567890</td>
                                </tr>                               
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
 <div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="m-t-0 header-title text-danger"><b>Upgrade Your Plan</b></h4>
                    <form role="form" action="<?= upgrade_plan;?>" method="post">
                            <input type="hidden"  name="id" value="<?= $this->session->userdata['user']['id'];?>">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Choose Plan</label>
                            <select type="text" class="form-control" name="upgrade" required='required'> 
                                <option>Choose</option>
                                <?php foreach($plans as $row) { ?>
                                <option value="<?= $row->plan;?>">₹ <?= $row->plan;?></option>
                                <?php } ?>
                            </select>
                            <span class="text-danger"><?= form_error('upgrade');?></span>
                        </div>
                        
                        <button type="submit" class="btn btn-purple waves-effect waves-light">Upgrade</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- <article>
        <section>
            <div class="about">
                <div class="container">
                    <h2>Upgrade plan</h2>
                    <div class="row">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-6" style="    box-shadow: 0 0 5px #ccc;padding: 30px;">
                           <p class="contact_success_box"><?php if (isset($msg)) {echo $msg;}?>
                            <?php if (!empty($this->session->flashdata('error'))) {?>
                                <div class="alert alert-danger">
                                    <?=$this->session->flashdata('error');?>
                                </div>
                                <?php }?>

                            </p>
                            <p>If you are to do this great work of "MyInformation", then depending on your ability.</p>
                            <p>At least 50 ₹ can also start this work.</p>
                            <p>Or can this work start from ...₹ 100.</p>
                            <p>Or can this work start from ...₹ 200.</p>
                            <p>Or can you start this work from ...₹ 400.</p>
                            <p>Or can you start this work from ...₹ 800. </p>
                            <p>Or can this work start from ...₹ 1000.</p>
                            <p>Or can you start this work from ..₹ 2000.</p>
                            <p>Or can you start this work from ..₹ 4000. </p>
                            
                             <form method="post" action="">
                             <input type="hidden"  name="id" value="<?= $this->session->userdata['user']['id'];?>">
                                <div class="form-group">
                                    <label for="" class="form-label">Choose Your Plan <span class="text-danger">*</span></label>
                                    <select type="text" class="form-control"  name="upgrade_plan">
                                        <option>Choose</option>
                                        <?php foreach($plans as $row) { ?>
                                        <option value="<?= $row->plan;?>">₹ <?= $row->plan;?></option>
                                        <?php } ?>
                                       </select>
                                    <span class="text-danger"><?=form_error('upgrade_plan');?></span>
                                    
                                    <label for="check" class="col-form-label">
                                        
                                    </label>
                                    <input type="submit" class="form-control btn btn-outline-info" value="Upgrade Now">
                                </div>
                            </form>
                             
                        </div>
                        <div class="col-md-3">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </article> -->