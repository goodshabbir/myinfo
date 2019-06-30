<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title"><b><a href="<?= member_profile;?>" class="btn btn-info">&laquo; Previous</a></b></h4>
            <p class="text-muted m-b-30 font-13">
              Back
              <?php //$userId=$_GET['list']; echo $userId;?>
            </p>
        </div>
    </div>
</div>
<style>

.wizard > .content > .body {
    position: relative;
    width: 95%;
    height: 95%;
    padding: 2.5%;
}

</style>
 <!-- Vertical Steps Example -->
 
 <div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title"><b>User 7<sup>th</sup> Generation Profile</b></h4>
            <p class="text-muted m-b-30 font-13">
               personal information
            </p>
            <div id="wizard-vertical">
                <h3>Normal Information</h3>
                <span class="text-success"><span id="message"></span></span>
                <section>
                <?php if(!empty($ByIDRecord)) { ?>
                <form>
               
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">First Name  <span class="text-danger">*</span></label>
                            <input type="text" disabled class="form-control" value="<?php if (isset($ByIDRecord->fname)) {echo $ByIDRecord->fname;}?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="sur">Surname  <span class="text-danger">*</span></label>
                            <input type="text" disabled  class="form-control" id="surname"value="<?php if (isset($ByIDRecord->surname)) {echo $ByIDRecord->surname;}?>">
                         </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                        <label for="name">Gender<span class="text-danger">*</span></label><br>
                           
                                <input type="text" disabled class="form-control" value="<?php if (isset($ByIDRecord->gender)) {echo $ByIDRecord->gender;}?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                        <label for="name">Age<span class="text-danger">*</label><br>
                            <input type="text" class="form-control" disabled value="<?php if (isset($ByIDRecord->age)) {echo $ByIDRecord->age;} else {set_value('age');}?>">
                            
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name2">Father Name  <span class="text-danger">*</span></label>
                            <input type="text" disabled class="form-control" value="<?php if (isset($ByIDRecord->father_name)) {echo $ByIDRecord->father_name;} else {set_value('father_name');}?>">
                           
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="email_id">Email </label>
                            <input type="text" disabled class="form-control" id="email_id" value="<?php if (isset($ByIDRecord->email_id)) {echo $ByIDRecord->email_id;}?>">
                            <span class="text-danger"></span></span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="contact_no">Contact No </label>
                            <input type="text" disabled class="form-control" value="<?php if (isset($ByIDRecord->contact_no)) {echo $ByIDRecord->contact_no;} ?>">
                            <span class="text-danger"></span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="Country">Country  <span class="text-danger">*</span></label>
                            
                              <input type="text" disabled class="form-control"  value="<?php if (isset($ByIDRecord->country)) {echo $ByIDRecord->country;} ?>">  
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="state">State<span class="text-danger">*</span></label>
                            <select name="state" class="form-control" onchange="Getcites(this.value);">
                                <option>Select State</option>
                                <?php foreach ($state as $rows) {?>                          
                                <option value="<?= $rows->id ?>" <?php if(isset($ByIDRecord->state) && ($ByIDRecord->state==$rows->id)) { echo "selected=selected"; } ?>><?= $rows->name ?></option>
                                </option>
                                <?php }?>
                             </select>
                             <span class="text-danger"><span id="normal-state"></span></span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="city">District  <span class="text-danger">*</span></label>
                            <select name="city" class="form-control" id="showCity">
                                <option value="<?php if(isset($ByIDRecord->city)){echo $ByIDRecord->city;} ?>"> <?php if(isset($ByIDRecord->city)){echo $ByIDRecord->city;} ?></option>
                             </select>
                             <span class="text-danger"><span id="normal-city_"></span></span>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                        <label for="name">Where do you live?<span class="text-danger">*</span></label><br>
                                <label class="radio-inline">
                                <input type="radio" name="where_live" onchange="citess(1);" value="city" id="citys" <?php if(isset($ByIDRecord->where_live)=='city') { echo "checked=:checked" ;} ?> >City
                                </label>
                                <label class="radio-inline">
                                <input type="radio" name="where_live" onchange="citess(0);" value="village" id ="shahar" <?php if (isset($ByIDRecord->where_live) == 'village') {echo "checked=:checked";}?> >Village

                             </label>
                             <span class="text-danger"><span id="normal-where_live"></span></span>
                        </div>
                    </div>
                     
                    <span id="cityd" style="display:none;">
                    
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="Tehsil">House Name </label>
                            <input type="text" disabled class="form-control"  value="<?php if (isset($ByIDRecord->house_no)) {echo $ByIDRecord->house_no;} else {set_value('house_no');}?>">
                            
                        </div> 
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="Tehsil">House No </label>
                            <input type="text" disabled class="form-control"  value="<?php if (isset($ByIDRecord->house_no)) {echo $ByIDRecord->house_no;} else {set_value('house_no');}?>">
                            
                        </div> 
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="Tehsil">Street name </label>
                            <input type="text" disabled class="form-control"  value="<?php if (isset($ByIDRecord->gali_name)) {echo $ByIDRecord->gali_name;} else {set_value('gali_name');}?>">
                            
                        </div> 
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="Tehsil">Street Number </label>
                            <input type="text" disabled class="form-control"  value="<?php if (isset($ByIDRecord->road_no)) {echo $ByIDRecord->road_no;} else {set_value('road_no');}?>">
                            
                        </div> 
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="Tehsil">Road Name </label>
                            <input type="text" disabled class="form-control"  value="<?php if (isset($ByIDRecord->road_name)) {echo $ByIDRecord->road_name;} else {set_value('road_name');}?>">
                            
                        </div> 
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="Tehsil">Name of ward </label>
                            <input type="text" disabled class="form-control"  value="<?php if (isset($ByIDRecord->vard_name)) {echo $ByIDRecord->vard_name;} else {set_value('vard_name');}?>">
                            
                        </div> 
                    </div>
                     <div class="col-lg-6">
                        <div class="form-group">
                            <label for="Tehsil">Number of ward </label>
                            <input type="text" disabled class="form-control"  value="<?php if (isset($ByIDRecord->vard_no)) {echo $ByIDRecord->vard_no;} else {set_value('vard_no');}?>">
                            
                        </div> 
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="Tehsil">Post Office </label>
                            <input type="text" disabled class="form-control"  value="<?php if (isset($ByIDRecord->post_office)) {echo $ByIDRecord->post_office;} else {set_value('post_office');}?>">
                            
                        </div> 
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="Tehsil">Pincode </label>
                            <input type="text" disabled class="form-control"  value="<?php if (isset($ByIDRecord->pincode)) {echo $ByIDRecord->pincode;} else {set_value('pincode');}?>">
                            
                        </div> 
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="Tehsil">Address </label>
                            <textarea type="text" disabled class="form-control"><?php if (isset($ByIDRecord->address)) {echo $ByIDRecord->address;} else {set_value('tehsil');}?></textarea>
                            
                        </div>
                    </div>
                    </span>
                    <span id="villagesd" style="display:none;">
                   
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="Tehsil">House Name </label>
                            <input type="text" disabled class="form-control"  value="<?php if (isset($ByIDRecord->house_name)) {echo $ByIDRecord->house_name;} else {set_value('house_name');}?>">
                            
                        </div> 
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="Tehsil">House No </label>
                            <input type="text" disabled class="form-control"  value="<?php if (isset($ByIDRecord->house_no)) {echo $ByIDRecord->house_no;} else {set_value('house_no');}?>">
                            
                        </div> 
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="Tehsil">Street name </label>
                            <input type="text" disabled class="form-control"  value="<?php if (isset($ByIDRecord->gali_name)) {echo $ByIDRecord->gali_name;} else {set_value('gali_name');}?>">
                            
                        </div> 
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="Tehsil">Road Number </label>
                            <input type="text" disabled class="form-control"  value="<?php if (isset($ByIDRecord->road_no)) {echo $ByIDRecord->road_no;} else {set_value('road_no');}?>">
                            
                        </div> 
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="Tehsil">Road Name </label>
                            <input type="text" disabled class="form-control"  value="<?php if (isset($ByIDRecord->road_name)) {echo $ByIDRecord->road_name;} else {set_value('road_name');}?>">
                            
                        </div> 
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="Tehsil">Name of ward </label>
                            <input type="text" disabled class="form-control"  value="<?php if (isset($ByIDRecord->vard_name)) {echo $ByIDRecord->vard_name;} else {set_value('vard_name');}?>">
                            
                        </div> 
                    </div>
                     <div class="col-lg-6">
                        <div class="form-group">
                            <label for="Tehsil">Number of ward</label>
                            <input type="text"disabled class="form-control"  value="<?php if (isset($ByIDRecord->vard_no)) {echo $ByIDRecord->vard_no;} else {set_value('vard_no');}?>">
                            
                        </div> 
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="Tehsil">Post Office </label>
                            <input type="text" disabled class="form-control"  value="<?php if (isset($ByIDRecord->post_office)) {echo $ByIDRecord->post_office;} else {set_value('post_office');}?>">
                            
                        </div> 
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="Tehsil">Village </label>
                            <input type="text" disabled class="form-control"  value="<?php if (isset($ByIDRecord->panchayat)) {echo $ByIDRecord->panchayat;} else {set_value('panchayat');}?>">
                            
                        </div> 
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="Tehsil">Pincode </label>
                            <input type="text"disabled class="form-control"  value="<?php if (isset($ByIDRecord->pincode)) {echo $ByIDRecord->pincode;} else {set_value('pincode');}?>">
                            
                        </div> 
                    </div>
                     <div class="col-lg-12">
                        <div class="form-group">
                            <label for="Tehsil">Address </label>
                            <textarea type="text" disabled class="form-control"><?php if (isset($ByIDRecord->address)) {echo $ByIDRecord->address;} else {set_value('tehsil');}?></textarea>
                            
                        </div>
                    </div>
                    </span>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="Address">About You <span class="text-danger">*</span></label>
                            <textarea disabled type="text" class="form-control" ><?php if (isset($ByIDRecord->my_self)) {echo $ByIDRecord->my_self;} ?></textarea>
                            <span class="text-danger"><span id="normal-my_self"></span></span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Religions  <span class="text-danger">*</span></label>
                            <input disabled value="<?php if (isset($ByIDRecord->religions_name)) {echo $ByIDRecord->religions_name;}?>" class="form-control">
                                
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="sur">Cast  <span class="text-danger">*</span></label>
                          
                                
                                <input disabled value="<?php if (isset($ByIDRecord->sub_religions)) {echo $ByIDRecord->sub_religions;}?>" class="form-control">
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="form-group">
                        <label for="married_status">Married Status  <span class="text-danger">*</span></label><br>
                            <label class="radio-inline">
                                <input type="radio" name="married_status" value="Unmarried" onclick="show2();" <?php if(isset($ByIDRecord->married_status)=='Unmarried') { echo "checked=:checked" ;} ?> >Unmarried
                                </label>
                                <label class="radio-inline">
                                <input type="radio" name="married_status" value="Married" onclick="show1();" <?php if(isset($ByIDRecord->married_status)=='Married') { echo "checked=:checked" ;} ?> >Married
                                </label>
                             </label>
                             <span class="text-danger"><span id="normal-married_status"></span></span>
                        </div>
                    </div>
                    <div id="div1" class="">
                    <div class="col-lg-6">
                        <div class="form-group">
                        <label for="unmarrid_type">Choose Option  <span class="text-danger">*</span></label><br>
                            <label class="radio-inline">
                                <input type="radio" name="unmarrid_type" value="Divorcee" <?php if(isset($ByIDRecord->unmarrid_type)=='Divorcee') { echo "checked=:checked" ;} ?>>Divorcee(तलाकशुदा )
                               </label>
                                <label class="radio-inline">
                                <input type="radio" name="unmarrid_type" value="widow" <?php if(isset($ByIDRecord->unmarrid_type)=='widow') { echo "checked=:checked" ;} ?>>widow(विधवा )
                                 </label>
                                <label class="radio-inline">
                                <input type="radio" name="unmarrid_type" value="Vidur" <?php if(isset($ByIDRecord->unmarrid_type)=='Vidur') { echo "checked=:checked" ;} ?>>Vidur(विदुर )
                                </label>
                                <label class="radio-inline">
                                     <input type="radio" name="unmarrid_type" value="None"  <?php if(isset($ByIDRecord->unmarrid_type)=='None') { echo "checked=:checked" ;} ?>>None
                                </label>
                        </div>
                    </div>
                    </div>
                   
                    </form>
                    <?php } else{ echo '<p class="text-danger">User Not Updated Normal Information</p>';}?>
                </section>
                <!-----------------Birth Information------------------------------>
                <h3>Birth Information</h3>
                <section>
                <?php if(!empty($birth)){ ?>
                <form>
               
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Date Of Birth  <span class="text-danger">*</span></label>
                            <input type=""  class="form-control" value="<?php if (isset($birth->dob)) { $IndaiDate = new DateTime($birth->dob);$setDateTime = $IndaiDate->format("d-m-Y");echo $setDateTime;}?>">
                            <span class="text-danger"><span id="birthsss-dob"></span></span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="sur">Birth Time  <span class="text-danger">*</span></label>
                            <input type="time" name="time" class="form-control"  value="<?php if (isset($birth->time)) {echo $birth->time;} else {set_value('time');}?>">
                            <span class="text-danger"><span id="birthsss-time"></span></span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Your Birth Of Name <span class="text-danger">*</span></label>
                            <input type="text" name="birth_of_name"class="form-control" value="<?php if (isset($birth->birth_of_name)) {echo $birth->birth_of_name;}?>">
                            <span class="text-danger"><span id="birthsss-birth_of_name"></span></span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Place Of Birth<span class="text-danger">*</span></label>
                            <input type="text" name="place_of_birth"class="form-control" value="<?php if (isset($birth->place_of_birth)) {echo $birth->place_of_birth;}?>">
                            <span class="text-danger"><span id="birthsss-place_of_birth"></span></span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Village</label>
                            <input type="text" name="birth_village" class="form-control"  value="<?php if (isset($birth->birth_village)) {echo $birth->birth_village;} ?>">
                            <span class="text-danger"><span id="birthsss-birth_village"></span></span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Country  <span class="text-danger">*</span></label>
                            <select name="country" class="form-control">
                               <option value="India">India</option>
                            </select>
                            <span class="text-danger"><span id="birthsss-country"></span></span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group"> 
                            <label for="sur">State <span class="text-danger">*</span></label>
                            <select name="state" class="form-control" onchange="Getcites2(this.value);">
                                <option>Select State</option>
                                <?php foreach ($state as $rows) {?>
                                 <option value="<?= $rows->id ?>" <?php if(isset($birth->state) && ($birth->state==$rows->id)) { echo "selected=selected"; } ?>><?= $rows->name ?></option>
                                </option>
                                <?php }?>
                             </select>
                             <span class="text-danger"><span id="birthsss-state"></span></span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">City<span class="text-danger">*</span></label>
                            <select name="city" class="form-control" id="showCity1">
                               <option value="<?php if(isset($birth->city)){echo $birth->city;} ?>"> <?php if(isset($birth->city)){echo $birth->city;} ?></option>
                             </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="sur">Tehsil </label>
                            <input type="text" name="tehsil" class="form-control" value="<?php if (isset($birth->tehsil)) {echo $birth->tehsil;}?>">
                            <span class="text-danger"><span id="birthsss-tehsil"></span></span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="sur">Pin Code:</label>
                            <input type="text" name="pincode"class="form-control" value="<?php if (isset($birth->pincode)) {echo $birth->pincode;}?>">
                            <span class="text-danger"><span id="birthsss-pincode"></span></span>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="name">Birth Address<span class="text-danger">*</span></label>
                            <textarea type="text" name="birth_address"class="form-control" id="name"><?php if (isset($birth->birth_of_name)) {echo $birth->birth_of_name;}?></textarea>
                            <span class="text-danger"><span id="birthsss-birth_address"></span></span>
                        </div>
                    </div>
                    
                    <div class='col-lg-12'>
						<div class="form-group input_fields_wrap_kund">
							<label for="">Upload Kundali (Multiple Upload)</label>
                            <div class="container1_kund">
                                <div><input type="file" name="kundli_img[]" class="form-control" style="padding: 10px; margin: 10px 0px 12px 0px;" required></div>
                               
                            </div>
                             <button class="add_form_field_kund btn btn-pink">AddMore Kundali     &nbsp; <span style="padding: 10px; margin: 10px 0px 12px 0px;">+ </span></button>
                        </div>
                    </div>
                                <?php } else{ echo '<p class="text-danger">User Not Updated Birth Information </p>';}?>
                    
                </section>
                <!---=====================Cast Information=========================----------------->
                <h3>Cast Information</h3>
                <section>
                 <?php if(!empty($cast)){ ?>
                <form>
                   
                    
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Religions  <span class="text-danger">*</span></label>
                            <input type="text" readonly class="form-control" value="<?php if(isset($cast->religions)){echo $cast->religions;}?>">
                             
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="sur">Cast  <span class="text-danger">*</span></label>
                            <input type="text" readonly class="form-control" value="<?php if(isset($cast->dharm)){echo $cast->dharm;}?>">
                            
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Your Gauta<span class="text-danger">*</span></label>
                            <input type="text" readonly class="form-control" id="name" value="<?php if (isset($cast->gauta)) {echo $cast->gauta;}?>">
                            
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="sur">Your Kul</label>
                            <input type="text" readonly class="form-control" id="sur" <?php if (isset($cast->kul)) {echo $cast->kul;}?>">
                            
                        </div>
                    </div>
                   
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="name">Kuldevi Upload Image</label>
                            <input type="file" class="form-control" name="kuldevi_img" id="name">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="sur">Address of Kuldevi</label>
                            <textarea type="text" readonly class="form-control"><?php if (isset($cast->address_of_kuldevi)) {echo $cast->address_of_kuldevi;}?></textarea>
                        </div>

                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Name Of Kuldevata <span class="text-danger">*</span></label>
                            <input type="text" readonly class="form-control" id="name" value="<?php if (isset($cast->kuldevata_name)) {echo $cast->kuldevata_name;} ?>">
                            
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Kuldevata Upload Image</label>
                            <input type="file" class="form-control" name="kuldevata_img" id="name">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="sur">Address of Kuldevata</label>
                            <textarea type="text" readonly class="form-control"><?php if (isset($cast->kuldevata_address)) {echo $cast->kuldevata_address;}?></textarea>
                           
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="Maama">Maama-Gautr <span class="text-danger">*</span></label>
                            <input type="text"accept="" readonly class="form-control" id="Maama" value="<?php if (isset($cast->maama_gautr)) {echo $cast->maama_gautr;} ?>">
                            
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="Maama">Maama-Kul <span class="text-danger">*</span></label>
                            <input type="text"accept=""  readonly class="form-control" id="Maama">
                            
                        </div>
                    </div>
                   
                    </form>
                 <?php } else{ echo '<p class="text-danger">User Not updated Caste Information';}?>
                </section>
                <!----------------------------------Pay Information-------------------------------------------------------->
                <h3>Pay Information</h3>
                <section>
                <?php if(!empty($pay)){ ?>
                <form>
               
                   <h3>Bank Details</h3>
                   <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Bank A/C No<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" readonly  id="name" value="<?php if (isset($pay->account_no)) {echo $pay->account_no;}?>">
                            
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="sur">Bank Name</label>
                            <input type="text"  readonly class="form-control" id="sur" value="<?php if (isset($pay->bank_name)) {echo $pay->bank_name;} ?>">
                            

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="sur">Bank Branch</label>
                            <input type="text" readonly class="form-control" id="sur" value="<?php if (isset($pay->branch))?>">
                            
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="sur">IFSC Code</label>
                            <input type="text" readonly class="form-control" id="sur" value="<?php if (isset($pay->ifsc)) {echo $pay->ifsc;} ?>">
                            
                        </div>
                    </div>
                    <h3>Paytm Details</h3>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="sur">Paytm No</label>
                            <input type="text" readonly class="form-control" id="sur" value="<?php if (isset($pay->paytm_no)) {echo $pay->paytm_no;}?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Paytm UPI Address</label>
                            <input type="text" readonly class="form-control" id="name" value="<?php if (isset($pay->paytm_address)) {echo $pay->paytm_address;}?>">
                        </div>
                    </div>
                    <h3>Bhim Details</h3>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="sur">BHIM No</label>
                            <input type="text" readonly class="form-control" value="<?php if (isset($pay->bhim_no)) {echo $pay->bhim_no;}?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">BHIM UPI Address</label>
                            <input type="text" name='bhim_address'class="form-control" value="<?php if (isset($pay->bhim_address)) {echo $pay->bhim_address;}?>">
                        </div>
                    </div>
                    <h3>GooglePay Details</h3>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Google Pay  <span class="text-danger">*</span></label>
                            <input type="text" readonly class="form-control" value="<?php if (isset($pay->google_pay)) {echo $pay->google_pay;}?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Google Pay upi Address</label>
                            <input type="text" class="form-control" readonly value="<?php if (isset($pay->google_upi)) {echo $pay->google_upi;} ?>">
                        </div>
                    </div>
                    <h3>Phonepe Details</h3>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="sur">Phonepe No</label>
                            <input type="text"readonly class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="Maama">Phonepe upi Address <span class="text-danger">*</span></label>
                            <input type="text" readonly class="form-control" id="Maama" value="<?php if (isset($pay->phonepe_upi)) {echo $pay->phonepe_upi;}?>">
                        </div>
                    </div>
                   
                    </form>
                <?php } else{echo '<p class="text-danger">User Not Updated Pay Information</p>';}?>
                </section>
                <!-----------------------------Special Information--------------------------------------------------->
                <h3>Special Information</h3>
                <section>
                <?php if(!empty($special)){ ?>
                <form >
                   
                     <h3>Personan Details</h3>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="sur">Your Name</label>
                            <input type="text" name="full_name"class="form-control" value="<?php if (isset($special->full_name)) {echo $special->full_name;} else {set_value('full_name');}?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Gender</label>
                            <input type="text" readonly class="form-control" value="<?php if (isset($special->surname)) {echo $special->surname;} else {set_value('surname');}?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">your Color  </label>
                            <input type="text" readonly class="form-control" value="<?php if (isset($special->color)) {echo $special->color;} else {set_value('color');}?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">your Wight  </label>
                            <input type="text" readonly class="form-control"  value="<?php if (isset($special->wight)) {echo $special->wight;} else {set_value('wight');}?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">your Hieght  </label>
                            <input type="text" readonly class="form-control" value="<?php if (isset($special->hieght)) {echo $special->hieght;} else {set_value('hieght');}?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Bloog Group  </label>
                            <input type="text" readonly class="form-control" value="<?php if (isset($special->blood_group)) {echo $special->blood_group;} else {set_value('blood_group');}?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name"> Favourite Game </label>
                            <input type="text" readonly class="form-control"  value="<?php if (isset($special->game)) {echo $special->game;} else {set_value('game');}?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name"> Favourite Food </label>
                            <input type="text" readonly class="form-control" value="<?php if (isset($special->food)) {echo $special->food;} else {set_value('food');}?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name"> Favourite Movie </label>
                            <input type="text" readonly class="form-control" value="<?php if (isset($special->movie)) {echo $special->movie;} else {set_value('movie');}?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name"> Favourite Song </label>
                            <input type="text" readonly class="form-control"  value="<?php if (isset($special->song)) {echo $special->song;} else {set_value('song');}?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name"> Favourite Actor </label>
                            <input type="text" readonly class="form-control" value="<?php if (isset($special->actor)) {echo $special->actor;} else {set_value('actor');}?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name"> Favourite Actoress </label>
                            <input type="text" readonly class="form-control"  value="<?php if (isset($special->actress)) {echo $special->actress;} else {set_value('actress');}?>">
                        </div>
                    </div>                   
                    <h3>Votar Id Details</h3>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="sur">Votar ID No</label>
                            <input type="text" readonly class="form-control" value="<?php if (isset($special->votar_no)) {echo $special->votar_no;} else {set_value('votar_no');}?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Upload Votar ID</label>
                            <input type="file" name='votar_img'class="form-control"  id="name">
                        </div>
                    </div>
                    <h3>Aadhar Card Details</h3>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="sur">Aadhar No</label>
                            <input type="text"  readonly class="form-control" value="<?php if (isset($special->addhar_no)) {echo $special->addhar_no;} else {set_value('addhar_no');}?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Upload Aadhar Id</label>
                            <input type="file" name='addhar_img'class="form-control">
                        </div>
                    </div>
                    <h3>Pan Card Details</h3>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="sur">Pan Card No</label>
                            <input type="text" readonly class="form-control" value="<?php if (isset($special->pan_no)) {echo $special->pan_no;} else {set_value('pan_no');}?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Upload Pancard </label>
                            <input type="file" name='pan_img'class="form-control"  >
                        </div>
                    </div>
                    <h3>Birth Details</h3>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="sur">Birth Certificate No</label>
                            <input type="text" readonly class="form-control" value="<?php if (isset($special->birth_cer_no)) {echo $special->birth_cer_no;} else {set_value('birth_cer_no');}?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Upload Birth Certificate </label>
                            <input type="file" name='birth_img'class="form-control" >
                        </div>
                    </div>
                    <h3>Cast Details</h3>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="sur">Cast Certificate No</label>
                            <input type="text"  readonly class="form-control" value="<?php if (isset($special->cast_cer_no)) {echo $special->cast_cer_no;} else {set_value('cast_cer_no');}?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Upload Cast  </label>
                            <input type="file" name='cast_img'class="form-control">
                        </div>
                    </div>
                    <h3>Income Details</h3>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Income No  </label>
                            <input type="text" readonly class="form-control"  value="<?php if (isset($special->income)) {echo $special->income;} else {set_value('income');}?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Upload Income  </label>
                            <input type="file" name='income_img'class="form-control">
                        </div>
                    </div>
                   
                    </form>
                <?php } else{ echo '<p class="text-danger">User Not updated Special information</p>';}?>
                </section>
                <!--==========================Educational Information===========================-------------->
                <h3>Educational Information</h3>
                <section>
                <?php if(!empty($edu)){ ?>
                <form>
               
                
                    <div class='col-lg-12'>
						<div class="form-group input_fields_wrap">
							<label for="">Upload All Marksheet LKG To 12Th Class (Multiple Upload)</label>
                            <div class="container1">
                                <div><input type="file" name="certificate[]" class="form-control" style="padding: 10px; margin: 10px 0px 12px 0px;" required></div>
                               
                            </div>
                             <button class="add_form_field btn btn-pink">Add More &nbsp; <span style="padding: 10px; margin: 10px 0px 12px 0px;">+ </span></button>
                        </div>
                    </div>
                    <div class='col-lg-12'>
						<div class="form-group input_fields_wrap_sem">
							<label for="">Upload All Marksheet Semester (Multiple Upload)</label>
                            <div class="container1_sem">
                                <div><input type="file" name="sem_certificate[]" class="form-control" style="padding: 10px; margin: 10px 0px 12px 0px;"></div>
                               
                            </div>
                             <button class="add_form_field_sem btn btn-pink">Add More &nbsp; <span style="padding: 10px; margin: 10px 0px 12px 0px;">+ </span></button>
                        </div>
                    </div>
                    <div class='col-lg-12'>
						<div class="form-group input_fields_wrap_master">
							<label for="">Upload All Marksheet Master Dregree (Multiple Upload)</label>
                            <div class="container1_master">
                                <div><input type="file" name="master_certificate[]" class="form-control" style="padding: 10px; margin: 10px 0px 12px 0px;"></div>
                               
                            </div>
                             <button class="add_form_field_master btn btn-pink">Add More &nbsp; <span style="padding: 10px; margin: 10px 0px 12px 0px;">+ </span></button>
                        </div>
                    </div>
                    <div class='col-lg-12'>
						<div class="form-group input_fields_wrap_other">
							<label for="">Upload All Marksheet Other Dregree (Multiple Upload)</label>
                            <div class="container1_other">
                                <div><input type="file" name="other_certificate[]" class="form-control" style="padding: 10px; margin: 10px 0px 12px 0px;" required></div>
                            </div>
                             <button class="add_form_field_other btn btn-pink">Add More &nbsp; <span style="padding: 10px; margin: 10px 0px 12px 0px;">+ </span></button>
                        </div>
                    </div>
                   
                   </form>
                <?php } else{ echo '<p class="text-danger">User Not Updated Education Information</p>'; }?>
                </section>
                <!--=====================Family Information=======================--->
                <h3>Family Information</h3>
                <section>
				<?php if(!empty($family)){ ?>
                <form >
               
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name">No Of Family <span class="text-danger">*</span></label>
                        <input type="text" readonly class="form-control"  value="<?php if (isset($family->no_of_family)) {echo $family->no_of_family;} else {set_value('no_of_family');}?>">
						
					</div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name">In Present No Of Family <span class="text-danger">*</span></label>
                        <input type="text" readonly class="form-control"  value="<?php if (isset($family->present_no_of_family)) {echo $family->present_no_of_family;} else {set_value('present_no_of_family');}?>">
						
					</div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name"> No Of Shivling <span class="text-danger">*</span></label>
                        <input type="text" readonly class="form-control"  value="<?php if (isset($family->sivling)) {echo $family->sivling;} else {set_value('sivling');}?>">
						
                    </div>
                </div>
				<div class="col-lg-6">
                    <div class="form-group">
                        <label for="name"> No Of Brother<span class="text-danger">*</span><span class="text-danger">*</span></label>
                        <input type="text"  readonly class="form-control" value="<?php if (isset($family->no_brother)) {echo $family->no_brother;} ?>">
						
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name"> No Of Sister <span class="text-danger">*</span></label>
                        <input type="text" readonly class="form-control"  value="<?php if (isset($family->no_of_sister)) {echo $family->no_of_sister;} ?>">
						
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name"> Sister Married Status<span class="text-danger">*</span></label>
                       
                            <input type="text" readonly class="form-control"  value="<?php if (isset($family->sister_mstatus)) {echo $family->sister_mstatus;}?>">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name"> Sister Occupation</label>
                        <input type="text" readonly class="form-control"  value="<?php if (isset($family->sister_occupation)) {echo $family->sister_occupation;}?>">
	                 </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name"> Brother Married Status<span class="text-danger">*</span></label>
                            <input type="text" readonly class="form-control"  value="<?php if (isset($family->brother_mstatus)) {echo $family->brother_mstatus;}?>">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name"> Brother Occupation</label>
                        <input type="text" readonly class="form-control" value="<?php if (isset($family->brother_occupation)) {echo $family->brother_occupation;} ?>">
                    </div>
                </div>
                 
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name"> Home Type<span class="text-danger">*</span></label>
                            <input type="text" readonly class="form-control" value="<?php if (isset($family->home_type)) {echo $family->home_type;} ?>">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name"> Length (In Fit) <span class="text-danger">*</span></label>
                        <input type="text" readonly class="form-control"  value="<?php if (isset($family->home_length)) {echo $family->home_length;} else {set_value('home_length');}?>">
						
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name"> Width (In Fit) <span class="text-danger">*</span></label>
                        <input type="text" readonly class="form-control" value="<?php if (isset($family->home_width)) {echo $family->home_width;} else {set_value('home_width');}?>">
						
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="name"> No Of Room<span class="text-danger">*</span></label>
                        <input type="text" readonly class="form-control" value="<?php if (isset($family->no_of_room)) {echo $family->no_of_room;} else {set_value('no_of_room');}?>">
						
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="name"> About Ancestral Property</label>
                        <textarea type="text" readonly class="form-control"><?php if (isset($family->about_property)) {echo $family->about_property;} else {set_value('about_property');}?></textarea>
						
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="name"> About Self Property</label>
                        <textarea type="text" readonly class="form-control"><?php if (isset($family->about_self_property)) {echo $family->about_self_property;} else {set_value('about_self_property');}?></textarea>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name"> Your Speciality<span class="text-danger">*</span></label>
                        <input type="text" readonly class="form-control" value="<?php if (isset($family->speciality)) {echo $family->speciality;} else {set_value('speciality');}?>">
                    </div>
                </div> 
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name"> No Of Children</label>
                        <input type="text" readonly class="form-control" value="<?php if (isset($family->no_of_children)) {echo $family->no_of_children;} else {set_value('no_of_children');}?>">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name"> No Of Baby</label>
                        <input type="text" readonly class="form-control" value="<?php if (isset($family->no_of_baby)) {echo $family->no_of_baby;} else {set_value('no_of_baby');}?>">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name"> No Of Boy</label>
                        <input type="text" readonly class="form-control" value="<?php if (isset($family->no_of_boy)) {echo $family->no_of_boy;} else {set_value('no_of_boy');}?>">
                    </div>
                </div>
                
                 
                </form>
                <?php } else{ echo '<p class="text-danger">User Not Updated Family Information</p>';}?>
                </section>
                <!--========================7 Generation Information==================================-->
                <h3>7<sup>th</sup> Generation Information</h3>
                <section>
                <?php if(!empty($generation)) { ?>
                
					<span class="text-success"><span id="message"></span></span>
					<form>
                       
                    <div class="">
                        <h4>1<sup>St</sup> Generation Information</h4>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Your Father Name<span class="text-danger">*</span> </label>
                            <input type="text" readonly class="form-control"  value="<?php if (isset($generation->father)) {echo $generation->father;} else {set_value('father');}?>">
							
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Your Mother Name<span class="text-danger">*</span></label>
                            <input type="text" readonly class="form-control" value="<?php if (isset($generation->mother)) {echo $generation->mother;} else {set_value('mother');}?>">
							
                        </div>
                    </div>
                    <div class="">
                        <h4>2<sup>nd</sup> Generation Information</h4>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Grandfather<span class="text-danger">*</span> </label>
                            <input type="text" readonly class="form-control"  value="<?php if (isset($generation->grandfather)) {echo $generation->grandfather;} else {set_value('grandfather');}?>">
							
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Grandmother<span class="text-danger">*</span> </label>
                            <input type="text" readonly class="form-control" value="<?php if (isset($generation->grandmother)) {echo $generation->grandmother;} else {set_value('grandmother');}?>">
							
                        </div>
                    </div>
                    <div class="">
                        <h4>3<sup>rd</sup> Generation Information</h4>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Great-Grandfather </label>
                            <input type="text" readonly class="form-control"  value="<?php if (isset($generation->great_grandfather)) {echo $generation->great_grandfather;} else {set_value('great_grandfather');}?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Great-Grandmother </label>
                            <input type="text" readonly class="form-control"  value="<?php if (isset($generation->great_grandmother)) {echo $generation->great_grandmother;} else {set_value('great_grandmother');}?>">
                        </div>
                    </div>
                    <div class="">
                        <h4>4<sup>th</sup> Generation Information</h4>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Great-Grandfather of Father </label>
                            <input type="text" readonly class="form-control"  value="<?php if (isset($generation->great_grandfather_father)) {echo $generation->great_grandfather_father;} else {set_value('great_grandfather_father');}?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Great-Grandmother of Father </label>
                            <input type="text" readonly class="form-control"  value="<?php if (isset($generation->great_grandmother_mother)) {echo $generation->great_grandmother_mother;} else {set_value('great_grandmother_mother');}?>">
                        </div>
                    </div>
                    <div class="">
                        <h4>5<sup>th</sup> Generation Information</h4>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="name">Great-Grandfather of Father of father</label>
                            <input type="text" readonly class="form-control"  value="<?php if (isset($generation->father5)) {echo $generation->father5;} else {set_value('father5');}?>">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="name">Great-Grandmother of Mother of Mother</label>
                            <input type="text" readonly class="form-control"  value="<?php if (isset($generation->mother5)) {echo $generation->mother5;} else {set_value('mother5');}?>">
                        </div>
                    </div>
                    <div class="">
                        <h4>6<sup>th</sup> Generation Information</h4>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="name">6<sup>th</sup> Generation Father Name </label>
                            <input type="text" readonly class="form-control"  value="<?php if (isset($generation->father6)) {echo $generation->father6;} else {set_value('father6');}?>">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="name">6<sup>th</sup> Generation Mother Name  </label>
                            <input type="text" readonly class="form-control"  value="<?php if (isset($generation->mother6)) {echo $generation->mother6;} else {set_value('mother6');}?>">
                        </div>
                    </div>
                    <div class="">
                        <h4>7<sup>th</sup> Generation Information</h4>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">7<sup>th</sup> Generation Father Name</label>
                            <input type="text" readonly class="form-control"  value="<?php if (isset($generation->father7)) {echo $generation->father7;} else {set_value('father7');}?>">
                        </div>
                    </div>
                    <div class="col-lg-6"> 
                        <div class="form-group">
                            <label for="name">7<sup>th</sup> Generation Mother Name</label>
                            <input type="text" readonly class="form-control"  value="<?php if (isset($generation->mother7)) {echo $generation->mother7;} else {set_value('mother7');}?>">
                        </div>
                    </div>
                    
                    </form>
                <?php } else{echo "<p class='text-danger'>User Not updated 7<sup>Th</sup> Generation Information</p>";}?>
                </section>
                <!--=====================Health Information=========================-->
                <h3>Health Information</h3>
                <section>
                <?php if(!empty($health)) { ?>
                    
					<form>
                       
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Are you crippled </label>
                                
								<input type="text" readonly class="form-control"  value="<?php if (isset($health->crippled)) {echo $health->crippled;}?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Which Side(Crippled) </label>
                                
                                    <input type="text" readonly class="form-control"  value="<?php if (isset($health->crippled_side)) {echo $health->crippled_side;}?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Are you lame</label>
                                
                                <input type="text" readonly class="form-control"  value="<?php if (isset($health->lame)) {echo $health->lame;}?>">
                            </div>
                        </div>
                         <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Witch Side(lame) </label>
                                
								<input type="text" readonly class="form-control"  value="<?php if (isset($health->lame_side)) {echo $health->lame_side;}?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Are you dumb</label>
                                
								<input type="text" readonly class="form-control"  value="<?php if (isset($health->dumb)) {echo $health->dumb;}?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Witch Side(lame) </label>
                                
                                    <input type="text" readonly class="form-control"  value="<?php if (isset($health->dumb_side)) {echo $health->dumb_side;}?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Are you deaf </label>
                                
                                <input type="text" readonly class="form-control"  value="<?php if (isset($health->deaf)) {echo $health->deaf;}?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Witch Side(deaf) </label>
                                
                                <input type="text" readonly class="form-control"  value="<?php if (isset($health->deaf_side)) {echo $health->deaf_side;}?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Are you stammering </label>
                                
                                <input type="text" readonly class="form-control"  value="<?php if (isset($health->stammering)) {echo $health->stammering;}?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Stammering in %</label>
                                <input type="text" readonly class="form-control" value="<?php if(isset($health->stammering_per)){echo $health->stammering_per;}else{set_value('stammering_per');}?>">
                                    
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Are you bald </label>
                                   <input type="text" readonly class="form-control" value="<?php if(isset($health->bald)){echo $health->bald;}?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Bald in %</label>
                                
                                   <input type="text" readonly class="form-control" value="<?php if(isset($health->bald_per)){echo $health->bald_per;}?>">
                           </div>
                        </div>
                         <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Any body disease </label>
                                
                                 <input type="text" readonly class="form-control" value="<?php if(isset($health->disease)){echo $health->disease;}?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Body disease Name</label>
                                <input type="text" readonly class="form-control" value="<?php if(isset($health->disease_name)){echo $health->disease_name;}else{set_value('disease_name');}?>">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="name">How long has you been from this disease</label>
                                <input type="text"readonly class="form-control" value="<?php if(isset($health->year_disease)){echo $health->year_disease;}?>">
                            </div>
                        </div>
                         <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Are you Paralysis </label>
                                
                                <input type="text"readonly class="form-control" value="<?php if(isset($health->paralysis)){echo $health->paralysis;}?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Is your accident </label>
                                
                                <input type="text"readonly class="form-control" value="<?php if(isset($health->accident)){echo $health->accident;}?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">When have accident</label>
                                <input type="text" readonly name='year_accident'class="form-control"  value="<?php if(isset($health->year_accident)){echo $health->year_accident;}else{set_value('year_accident');}?>">
                            </div>
                        </div>
                         <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">No. Of accident</label>
                                <input type="text" readonly class="form-control"  value="<?php if(isset($health->accident_no)){echo $health->accident_no;}else{set_value('accident_no');}?>">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="name">About accident</label>
                                <textarea type="text"  readonly class="form-control"><?php if(isset($health->about_accident)){echo $health->about_accident;}else{set_value('about_accident');}?></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">In Present Disease</label>
                                    
                                <input type="text"readonly class="form-control" value="<?php if(isset($health->present_disease)){echo $health->present_disease;}?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Name Of Present Disease</label>
                                <input type="text" readonly class="form-control" value="<?php if(isset($health->Present_disname)){echo $health->Present_disname;}else{set_value('Present_disname');}?>">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="name">Clerical disease</label>
                                <input type="text" readonly class="form-control" value="<?php if(isset($health->clerical_disname)){echo $health->clerical_disname;}else{set_value('clerical_disname');}?>">
                            </div>
                        </div>
                       
                    </form>
                <?php } else{echo '<p class="text-danger">User Not Updated Health Information</p>';}?>
                </section> 
                <!--======================Working Information===========================--->
                <h3>Working Information</h3>

                <section>
                <?php if(!empty($work)) { ?>
					
					<form>
                       
                    <div class="col-lg-12"> 
                        <ul class="nav nav-tabs tabs" style="width: 100%;">
                            <li class="tab" style="width: 25%;">
                                <a href="#home-2" data-toggle="tab" aria-expanded="false" class=""> 
                                    <span class="visible-xs"><i class="fa fa-home"></i></span> 
                                    <span class="hidden-xs">You have a job</span> 
                                </a> 
                            </li> 
                            <li class="tab" style="width: 25%;"> 
                                <a href="#profile-2" data-toggle="tab" aria-expanded="false" class=""> 
                                    <span class="visible-xs"><i class="fa fa-user"></i></span> 
                                    <span class="hidden-xs">Are you businessman </span> 
                                </a> 
                            </li> 
                            
                        <div class="indicator" style="right: 1px; left: 393px;"></div></ul> 
                        <div class="tab-content"> 
                            <div class="tab-pane" id="home-2" style="display: none;"> 
                                <p>
                                    <div class="form-group">
                                        <label for="name">Job Type</label>
                                       
                                            <input type="text"readonly class="form-control" value="<?php if(isset($work->job_type)){echo $work->job_type;}?>">
                                    </div>
                                </p>
                            <p>
                                <div class="form-group">
                                    <label for="name">Your Designation</label>
                                   
                                     <input type="text"readonly class="form-control" value="<?php if(isset($work->designation)){echo $work->designation;}?>">
                                </div>
                            </p>
                            <p>
                                <div class="form-group">
                                    <label for="name">Your Field</label>
                                   
                                    <input type="text"readonly class="form-control" value="<?php if(isset($work->work_field)){echo $work->work_field;}?>">
                                </div>    
                            </p>
                            <p>
                               <div class="form-group">
                                    <label for="name">Your Monthly Salary</label>
                                    
                                    <input type="text"readonly class="form-control" value="<?php if(isset($work->monthly_salary)){echo $work->monthly_salary;}?>">
                                </div>     
                            </p>
                            <p>
                                <div class="form-group">
                                    <label for="name">Your Yearly Income</label>
                                   
                                    <input type="text"readonly class="form-control" value="<?php if(isset($work->yearly_income)){echo $work->yearly_income;}?>">
                                 </div>
                            </p>
                            <p>
                                <div class="form-group">
                                        <label for="name">Working Period</label>
                                    
                                    <input type="text"readonly class="form-control" value="<?php if(isset($work->working_period)){echo $work->working_period;}?>">
                                </div>
                            </p>
                            </div> 
                            <div class="tab-pane" id="profile-2" style="display: none;">
                                <p><div class="form-group">
                                    <label for="name">Starting Business Year </label>
                                        
                                        <input type="text"readonly class="form-control" value="<?php if(isset($work->str_business_year)){echo $work->str_business_year;}?>">
                                </div>
                                </p> 
                                <p>
                                    <div class="form-group">
                                    <label for="name">Name Of Business </label>
                                    
                                    <input type="text"readonly class="form-control" value="<?php if(isset($work->business_name)){echo $work->business_name;}?>">
                                    </div>
                                </p> 
                                <p>
                                    <div class="form-group">
                                    <label for="name">Monthly Income </label>
                                        
                                        <input type="text"readonly class="form-control" value="<?php if(isset($work->month_business_income)){echo $work->month_business_income;}?>">
                                    </div>
                                </p>
                                <p>
                                    <div class="form-group">
                                    <label for="name">Yearly Income </label>
                                         
                                         <input type="text"readonly class="form-control" value="<?php if(isset($work->yearly_business_income)){echo $work->yearly_business_income;}?>">
                                    </div>
                                </p>
                            </div> 
                            
                        </div> 
                    </div>
                   
                </form>
                <?php } else{echo '<p class="text-danger">User Not Updated Work Inforamtion</p>';}?>
                </section>
                <!------======================Marriage Information=============================------->
                <h3>Marriage Information</h3>

                <section>
                <?php if(!empty($mrg)) { ?>
                        
						<form>
                       
                    <div class="col-lg-12"> 
                        <ul class="nav nav-tabs tabs" style="width: 100%;">
                            <li class="tab" style="width: 25%;">
                                <a href="#male" data-toggle="tab" aria-expanded="false" class=""> 
                                    <span class="visible-xs"><i class="fa fa-home"></i></span> 
                                    <span class="hidden-xs">Male</span> 
                                </a> 
                            </li> 
                            <li class="tab" style="width: 25%;"> 
                                <a href="#female" data-toggle="tab" aria-expanded="false" class=""> 
                                    <span class="visible-xs"><i class="fa fa-user"></i></span> 
                                    <span class="hidden-xs">Female</span> 
                                </a> 
                            </li> 
                           
                        <div class="indicator" style="right: 1px; left: 393px;"></div></ul> 
                        <div class="tab-content"> 
                            <div class="tab-pane" id="male" style="display: none;"> 
                               
                                <p>Do you have any divorced women in your own caste
                                 <div class="form-group">
                                        <label for="name">Do you want to marry a girl of your own race </label>
                                	
                                    <input type="text"readonly class="form-control" value="<?php if(isset($mrg->cast_marry)){echo $mrg->cast_marry;}?>">
                                    </div>
                                </p>
                                <p>
                                 <div class="form-group">
                                        <label for="name">Do you have any divorced women in your own caste</label>
                                	
                                    <input type="text"readonly class="form-control" value="<?php if(isset($mrg->devoce_w)){echo $mrg->devoce_w;}?>">
                                    </div>
                                </p>
                                <p>
                                 <div class="form-group">
                                        <label for="name">Number of child(Divorced women)</label>
                                	
                                    <input type="text"readonly class="form-control" value="<?php if(isset($mrg->num_of_child)){echo $mrg->num_of_child;}?>">
                                    </div>
                                </p>
                           		
                           		<p>
                                 <div class="form-group">
                                        <label for="name">Can you marry any widowed woman in your own caste</label>
                                
                                     <input type="text"readonly class="form-control" value="<?php if(isset($mrg->widowed_w)){echo $mrg->widowed_w;}?>">
                                    </div>
                                </p>
                                <p>
                                 <div class="form-group">
                                        <label for="name">Number of child(Widowed women)</label>
                                	
                                    <input type="text"readonly class="form-control" value="<?php if(isset($mrg->num_of_child_win)){echo $mrg->num_of_child_win;}?>">
                                    </div>
                                </p>
                            	<p>
                                 <div class="form-group">
                                        <label for="name">Can you marry any divorced woman in your own caste(Nervous woman)</label>
                                	
                                    <input type="text"readonly class="form-control" value="<?php if(isset($mrg->divorced_w)){echo $mrg->divorced_w;}?>">
                                    </div>
                                </p>
                                <p>
                                 <div class="form-group">
                                        <label for="name">Number of child(Divorced women :Nervous woman)</label>
                                	
                                     <input type="text"readonly class="form-control" value="<?php if(isset($mrg->num_of_child_divorce_n)){echo $mrg->num_of_child_divorce_n;}?>">
                                    </div>
                                </p>
                            </div> 
                            <!-- ==================Female tab================== -->
                            
                            <div class="tab-pane" id="female" style="display: none;">
                                <p>Do you have any divorced man in your own caste
                                 <div class="form-group">
                                        <label for="name">Do you want to marry a boy of your own race </label>
                                	
                                    <input type="text"readonly class="form-control" value="<?php if(isset($mrg->cast_marry)){echo $mrg->cast_marry;}?>">
                                    </div>
                                </p>
                                <p>
                                 <div class="form-group">
                                        <label for="name">Do you have any divorced man in your own caste</label>
                                	
                                    <input type="text"readonly class="form-control" value="<?php if(isset($mrg->devoce_w)){echo $mrg->devoce_w;}?>">
                                    </div>
                                </p>
                                <p>
                                 <div class="form-group">
                                        <label for="name">Number of child(Divorced man)</label>
                                	
                                    <input type="text"readonly class="form-control" value="<?php if(isset($mrg->num_of_child)){echo $mrg->num_of_child;}?>">
                                    </div>
                                </p>
                           		
                           		<p>
                                 <div class="form-group">
                                        <label for="name">Can you marry any Vidur guy in your own caste</label>
                                	
                                    <input type="text"readonly class="form-control" value="<?php if(isset($mrg->vidur_m)){echo $mrg->vidur_m;}?>">
                                    </div>
                                </p>
                                <p>
                                 <div class="form-group">
                                        <label for="name">Number of child(Vidur guy)</label>
                                	
                                    <input type="text"readonly class="form-control" value="<?php if(isset($mrg->num_of_child_vid_m)){echo $mrg->num_of_child_vid_m;}?>">
                                    </div>
                                </p>
                            	<p>
                                 <div class="form-group">
                                        <label for="name">Can you marry any divorced man in your own caste(Nervous woman)</label>
                                	
                                    <input type="text"readonly class="form-control" value="<?php if(isset($mrg->divorced_m)){echo $mrg->divorced_m;}?>">
                                    </div>
                                </p>
                                <p>
                                 <div class="form-group">
                                        <label for="name">Number of child(Divorced man :Nervous man)</label>
                                	
                                    <input type="text"readonly class="form-control" value="<?php if(isset($mrg->num_of_child_divorce_nm)){echo $mrg->num_of_child_divorce_nm;}?>">
                                    </div>
                                </p>
                            <!-- <div class="tab-pane" id="messages-2" style="display: none;">
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p> 
                                    <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p> 
                            </div> 
                            <div class="tab-pane active" id="settings-2" style="display: block;">
                                <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>  
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p> 
                            </div>  -->
                        </div> 
                    </div>
                   
                </form>
                <?php } else{echo '<p class="text-danger">User not updated Marriage Inforamtion</p>';}?>
                </section>
                <h3>Society President </h3>
                 <section>
                 <?php if(!empty($parsad)) { ?>
                        <h3>Describe the president of the society where you live?</h3>
                  
					<form>
                        <div class="col-lg-12"> 
                        <div class="form-group">
                            <label for="name"> Name of the president society </label>
                            
                            <input type="text"readonly class="form-control" value="<?php if(isset($parsad->president_name)){echo $parsad->president_name;}?>">
                        </div>
                    </div>
                    <div class="col-lg-12"> 
                        <div class="form-group">
                            <label for="name">Contact number</label>
                            <input type="text" readonly class="form-control"  value="<?php if (isset($parsad->president_mobile)) {echo $generation->president_mobile;} ?>">
                        </div>
                    </div>
                    <div class="col-lg-12"> 
                        <div class="form-group">
                            <label for="name">Upload President image</label>
                            <input type="file" name='president_img'class="form-control"  value="<?php if (isset($generation->mother7)) {echo $generation->mother7;} else {set_value('mother7');}?>">
                            
                        </div>
                    </div>
                        
                    </form>
                <?php } else{ echo '<p class="text-danger">User Not updated Area President Inforamtion </p>'; }?>
                </section>
                <h3>Finish</h3>
                <section>
                    <div class="form-group clearfix">
                        <div class="col-lg-12">
                            <div class="checkbox checkbox-primary">
                                
                                <label for="checkbox-v"> Thnaks!, User Profile Finish. </label>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div><!-- End row -->
<script>
	function Getcites(id)
	{
		$.ajax({
				url: '<?=site_url('user/getAllCity/')?>'+id,
				success:function(result)
				{
					$('#showCity').html(result);
				}
			});
	}
    function Getcites2(id)

	{
		$.ajax({
				url: '<?=site_url('user/getAllCity/')?>'+id,
				success:function(result)
				{
					$('#showCity1').html(result);
				}
			});
	}

/**===============Where do you live radio Choice======================== */
  function citess(str)
    {
        $("#cityd").css('display','none');
        $("#villagesd").css('display','none');
        if(str==1){
            $("#cityd").css('display','block');
        }else if(str==0){
            $("#villagesd").css('display','block');
        }
    }
function show1(){

  document.getElementById('div1').style.display ='none';

}

function show2(){

  document.getElementById('div1').style.display = 'block';

}
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>

/**==============Kundali AddMore Button======================= */
$(document).ready(function() {
    var max_fields      = 100;
    var wrapper         = $(".container1_kund");
    var add_button_kund      = $(".add_form_field_kund");
  
    var x = 1;
    $(add_button_kund).click(function(e){
        e.preventDefault();
        if(x < max_fields){
            x++;
            $(wrapper).append('<div><input type="file" name="kundli_img[]" class="form-control" style="padding: 10px; margin: 10px 0px 12px 0px;"><i class="delete fa fa-trash text-danger"></i></div>'); //add input box
        }
  else
  {
  alert('You Reached the limits')
  }
    });
  
    $(wrapper).on("click",".delete", function(e){
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
/**==============Certificate AddMore Button======================= */

$(document).ready(function() {
    var max_fields      = 20;
    var wrapper         = $(".container1");
    var add_button      = $(".add_form_field");
  
    var x = 1;
    $(add_button).click(function(e){
        e.preventDefault();
        if(x < max_fields){
            x++;
            $(wrapper).append('<div><input type="file" name="certificate[]" class="form-control" style="padding: 10px; margin: 10px 0px 12px 0px;"><i class="delete fa fa-trash text-danger"></i></div>'); //add input box
        }
  else
  {
  alert('You Reached the limits')
  }
    });
  
    $(wrapper).on("click",".delete", function(e){
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
/**==============Semester Certificate AddMore======================= */
$(document).ready(function() {
    var max_fields      = 20;
    var wrapper         = $(".container1_master");
    var add_button_master      = $(".add_form_field_master");
  
    var x = 1;
    $(add_button_master).click(function(e){
        e.preventDefault();
        if(x < max_fields){
            x++;
            $(wrapper).append('<div><input type="file" name="sem_certificate[]" class="form-control" style="padding: 10px; margin: 10px 0px 12px 0px;"><i class="delete fa fa-trash text-danger"></i></div>'); //add input box
        }
  else
  {
  alert('You Reached the limits')
  }
    });
  
    $(wrapper).on("click",".delete", function(e){
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
/**==============Master Certificate AddMore======================= */
$(document).ready(function() {
    var max_fields      = 20;
    var wrapper         = $(".container1_sem");
    var add_button_sem      = $(".add_form_field_sem");
  
    var x = 1;
    $(add_button_sem).click(function(e){
        e.preventDefault();
        if(x < max_fields){
            x++;
            $(wrapper).append('<div><input type="file" name="master_certificate[]" class="form-control" style="padding: 10px; margin: 10px 0px 12px 0px;"><i class="delete fa fa-trash text-danger"></i></div>'); //add input box
        }
  else
  {
  alert('You Reached the limits')
  }
    });
  
    $(wrapper).on("click",".delete", function(e){
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
/* ==================Yes No Button=============================== */
 
$(function(){ $('.btn').button() });
/**==============Other Certificate AddMore======================= */
$(document).ready(function() {
    var max_fields      = 20;
    var wrapper         = $(".container1_other");
    var add_button_other      = $(".add_form_field_other");
  
    var x = 1;
    $(add_button_other).click(function(e){
        e.preventDefault();
        if(x < max_fields){
            x++;
            $(wrapper).append('<div><input type="file" name="other_certificate[]" class="form-control" style="padding: 10px; margin: 10px 0px 12px 0px;"><i class="delete fa fa-trash text-danger"></i></div>'); //add input box
        }
  else
  {
  alert('You Reached the limits')
  }
    });
  
    $(wrapper).on("click",".delete", function(e){
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>

<?php

if (!empty($this->session->flashdata('message'))) {

    echo "<script>window.onload=function() { $.Notification.notify ('" . $this->session->flashdata('class') . "','top right','" . $this->session->flashdata('message') . "'); } </script>";

}

?>



