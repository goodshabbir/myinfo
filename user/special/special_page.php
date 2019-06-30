<style>
@media print {
  * {
    display: none;
  }
  #printableTable {
    display: block;
  }
}
</style>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="row"> 
                <div class="col-lg-12"> 
                    <div class="panel-group" id="accordion-test-2"> 
                        <div class="panel panel-default"> 
                            <div class="panel-heading" style="background:#820506;color:#fff;"> 
                                <h4 class="panel-title portlet-title"> 
                                    <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseOne-2" aria-expanded="false" class="collapsed">
                                      My General Information
                                      
                                    </a> 
                                </h4> 
                            </div> 
                            <div id="collapseOne-2" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;"> 
                                <div class="panel-body">
                               
                                <div id="printableTable">
                                   <table class="table table-striped">
                                        <?php if(!empty($IdByNormal)) { ?>
                                        <tr>
                                            <td colspan="2"><p><b>My name(with Surname): </b><?php if(!empty($IdByNormal->fname)){ echo $IdByNormal->fname;}?> <?php if(!empty($IdByNormal->surname)){ echo $IdByNormal->surname;}?></p></td>
                                            
                                        </tr>
                                         <tr>
                                            <td><p><b>Gender: </b><?php if(!empty($IdByNormal->gender)){ echo $IdByNormal->gender;}?></p></td>
                                            <td><p><b>My Country : </b><?php if(!empty($IdByNormal->country)){ echo $IdByNormal->country;}?></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>My State: </b><?php if(!empty($IdByNormal->state)){ echo $IdByNormal->state;}?></p></td>
                                            <td><p><b>District: </b><?php if(!empty($IdByNormal->district)){ echo $IdByNormal->district;}?></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>Tehsil: </b><?php if(!empty($IdByNormal->tehsil)){ echo $IdByNormal->tehsil;}?></p></td>
                                            <td><p><b>Where do you live?: </b><?php if(!empty($IdByNormal->where_live)){ echo $IdByNormal->where_live;}?></p></td>
                                        </tr>
                                        <!------==== Choose City====-->
                                        <?php if($IdByNormal->where_live =='city') { ?>
                                        <tr>
                                            <td><p><b>House number: </b><?php if(!empty($IdByNormal->house_no)){ echo $IdByNormal->house_no;}?></p></td>
                                            <td><p><b>House's name: </b><?php if(!empty($IdByNormal->house_name)){ echo $IdByNormal->house_name;}?></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>Street number: </b><?php if(!empty($IdByNormal->road_no)){ echo $IdByNormal->road_no;}?></p></td>
                                            <td><p><b>Street name: </b><?php if(!empty($IdByNormal->gali_name)){ echo $IdByNormal->gali_name;}?></p></td>
                                        </tr>
                                    
                                        <tr>
                                            <td><p><b>Colony name: </b><?php if(!empty($IdByNormal->colony_name)){ echo $IdByNormal->colony_name;}?></p></td>
                                            <td><p><b>Road name: </b><?php if(!empty($IdByNormal->road_name)){ echo $IdByNormal->road_name;}?></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>Ward number: </b><?php if(!empty($IdByNormal->vard_no)){ echo $IdByNormal->vard_no;}?></p></td>
                                            <td><p><b>Post: </b><?php if(!empty($IdByNormal->post_office)){ echo $IdByNormal->post_office;}?></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>City name: </b><?php if(!empty($IdByNormal->city)){ echo $IdByNormal->city;}?></p></td>
                                            <td><p><b>Pincode: </b><?php if(!empty($IdByNormal->pincode)){ echo $IdByNormal->pincode;}?></p></td>
                                        </tr>
                                       
                                        <tr>
                                            <td><p><b>Contact number: </b>+<?= $IdByNormal->phone_code;?>-<?php if(!empty($IdByNormal->mobile)){ echo $IdByNormal->mobile;}?></p></td>
                                            <td><p><b>Email: </b><?php if(!empty($IdByNormal->email_id)){ echo $IdByNormal->email_id;}?></p></td>
                                        </tr>
                                        <!--======Chioose Village=======--->
                                        <?php } elseif($IdByNormal->where_live =='village') { ?>
                                         <tr>
                                            <td><p><b>House number: </b><?php if(!empty($IdByNormal->house_no)){ echo $IdByNormal->house_no;}?></p></td>
                                            <td><p><b>House's name: </b><?php if(!empty($IdByNormal->house_name)){ echo $IdByNormal->house_name;}?></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>Street number: </b><?php if(!empty($IdByNormal->road_no)){ echo $IdByNormal->road_no;}?></p></td>
                                            <td><p><b>Street name: </b><?php if(!empty($IdByNormal->gali_name)){ echo $IdByNormal->gali_name;}?></p></td>
                                        </tr>
                                    
                                        <tr>
                                            <td><p><b>Colony name: </b><?php if(!empty($IdByNormal->colony_name)){ echo $IdByNormal->colony_name;}?></p></td>
                                            <td><p><b>Road name: </b><?php if(!empty($IdByNormal->road_name)){ echo $IdByNormal->road_name;}?></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>Ward number: </b><?php if(!empty($IdByNormal->vard_no)){ echo $IdByNormal->vard_no;}?></p></td>
                                            <td><p><b>Post: </b><?php if(!empty($IdByNormal->post_office)){ echo $IdByNormal->post_office;}?></p></td>
                                        </tr>
                                        
                                        <tr>
                                            <td><p><b>Village name: </b><?php if(!empty($IdByNormal->panchayat)){ echo $IdByNormal->panchayat;}?></p></td>
                                            <td><p><b>Pincode: </b><?php if(!empty($IdByNormal->pincode)){ echo $IdByNormal->pincode;}?></p></td>
                                        </tr>
                                        <?php } ?>
                                        <!----End City Village-->
                                        
                                        <tr>
                                            <td><p><b>My Religion: </b><?php //if($IdByNormal->religions=='0786'){echo 'Other : '.$IdByNormal->other_religions;}else{ echo $religionsName->religions_name;}?></p></td>
                                            <td><p><b>My Caste : </b><?php //if($IdByNormal->sub_religions=='0786'){echo 'Other : '.$IdByNormal->other_religions;}else{ echo $SubreligionsName->sub_religions;}?></p></td>
                                        </tr>
                                       
                                        <tr>
                                            <td><p><b>My Sub Caste: </b><?php //if($IdByNormal->dharm=='0786'){echo 'Other : '.$IdByNormal->other_dharm;}else{ echo $DharmName->dharm;}?></p></td>
                                            <td><p><b>My Language: </b><?php if(!empty($IdByNormal->language)){ echo $IdByNormal->language;}?></p></td>
                                        </tr>
                                     
                                        <tr>
                                            <td><p><b>My mother tongue: </b><?php if($IdByNormal->mother_tongue=='Other'){ echo 'Other: '.$IdByNormal->other_mother_tongue;}else{ echo $IdByNormal->mother_tongue;}?></p></td>
                                            <td><p><b>Society  : </b><?php if($IdByNormal->community=='Other'){ echo 'Other: '.$IdByNormal->other_community;}else{ echo $IdByNormal->community;}?></p></td>
                                        </tr>
                                        <?php if($IdByNormal->ask_married=='No') { ?>
                                        <?php if($IdByNormal->married_status=='Yes') { ?>
                                        <?php if($IdByNormal->info_married=='Yes') { ?>
                                        <tr>
                                           <td colspan="2"><p><b> Do you want to give all information related to your marriage ?</b><?= $IdByNormal->info_married;?></p></td>
                                        </tr>
                                        <?php } else{?>
                                            <tr>
                                                <td><p><b>
                                               
                                                <?php 
                                                    $ProfileImg= unserialize($IdByNormal->photo_1);
                                                    $ab=1;
                                                    for($i=0;$i < count($ProfileImg); $i++){
                                                        echo '  Passport Size Photo '.$ab++.' :'
                                                ?>
                                              

                                                </b> <img src="<?= base_url('uploads/profile/') . $ProfileImg[$i]; ?>" name="" height="70" width="116" style="margin-top: 10px;">
                                                    <?php } ?>
                                                </p></td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                                 <?php 
                                                    $ProfileImg= unserialize($IdByNormal->photo_1);
                                                    $a=1;
                                                    for($i1=0;$i1 < count($ProfileImg); $i1++){
                                                        echo '  Passport Size Photo '.$a++.' :'
                                                ?>
                                              

                                                </b> <img src="<?= base_url('uploads/profile/') . $ProfileImg[$i1]; ?>" name="" height="70" width="116" style="margin-top: 10px;">
                                                    <?php } ?>
                                            </tr>
                                        <?php } else{ ?>
                                        <tr>
                                            <td><p><b>Are you willing to marry ? </b><?= $IdByNormal->married_status;?></p></td>
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <td><p><b>I am ready to give information related to my marriage  : </b><?php if(!empty($IdByNormal->info_married)){ echo $IdByNormal->info_married;}?></p></td>
                                            <td><p><b>What are your status for getting married ?: </b><?php if(!empty($IdByNormal->unmarrid_type)){ echo $IdByNormal->unmarrid_type;}?></p></td>
                                        </tr>
                                        
                                        <?php } else{ ?>
                                        <tr>
                                            <td><p><b>Are you married ?: </b><?= $IdByNormal->ask_married; ?></td>
                                        </tr>
                                        <?php } ?>
                                        <?php } else{ ?>
                                            <h3 class="text-center"style="color:red">Please,Update Your Profile</h3>
                                        <?php } ?>
                                        <!-- <tr>
                                            <td rowspan="2"><p><b>Name: </b>Ram</p></td>
                                            <td><p><b>Name: </b>Ram</p></td>
                                        </tr>
                                        <tr>
                                             
                                            <td><p><b>Name: </b>Ram</p></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><p><b>Name: </b>Summarise your career here lorem ipsum dolor sit amet, consectetuer adipiscing </p></td>
                                        </tr> -->
                                       
                                    </table>
                                     <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
                                    <button class="btn btn-info" onclick="printDiv()">Print</button>
                                </div>
                                </div> 
                            </div> 
                        </div>
                        <div class="panel panel-default"> 
                            <div class="panel-heading" style="background:#820506;color:#fff;"> 
                                <h4 class="panel-title portlet-title"> 
                                    <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseTwo-2" class="collapsed" aria-expanded="false">
                                       Birth Related Information
                                    </a> 
                                </h4> 
                            </div> 
                            <div id="collapseTwo-2" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;"> 
                                <div class="panel-body">
                                    <?php if(!empty($birth)) { ?>
                                     <div id="BirthArea">
                                   <table class="table table-striped">
                                        <tr>
                                            <td><p><b>Date of birth: </b><?php  
                                            $Date = $birth->dob;
                                            echo date("d-m-Y", strtotime($Date));

                                            ?></p></td>
                                            <td><p><b>Birth time: </b><?= $birth->time;?></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>Birth name: </b><?= $birth->birth_of_name;?></p></td>
                                            <td><p><b>Birth place's name: </b><?= $birth->place_of_birth;?></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>Birth place: </b><?= $birth->birth_village;?></p></td>
                                            <td><p><b>Birth place's tehsil: </b><?= $birth->tehsil;?></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>Birth place's district: </b><?= $birth->district;?></p></td>
                                            <td><p><b>Birth place's state: </b><?= $birth->state;?></p></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><p><b>Birth place's country: </b><?= $birth->country;?></p></td>
                                            
                                        </tr>
                                        <tr>
                                            <td><p><b>Details of my kundli: </b>
                                                 <?php 
                                                    $kundliImg= unserialize($birth->kundli_img);
                                                    $a=1;
                                                    for($i1=0;$i1 < count($kundliImg); $i1++){
                                                       
                                                ?>
                                              

                                                </b> <img src="<?= base_url('uploads/birth_kundali/') . $kundliImg[$i1]; ?>" name="" height="70" width="116" style="margin-top: 10px;">
                                                    <?php } ?>
                                            
                                            </p></td>
                                            
                                        </tr>
                                    </table>
                                     <iframe name="special" width="0" height="0" frameborder="0" src="spacialdata:blank"></iframe>
                                    <button class="btn btn-info" onclick="BirthInfo('BirthArea')">Print</button>
                                </div>
                                
                                <script>
                                        function BirthInfo(divName) 
                                        {
                                            var printContents = document.getElementById(divName).innerHTML;
                                            var originalContents = document.body.innerHTML;
                                            document.body.innerHTML = printContents;
                                            window.print();
                                            document.body.innerHTML = originalContents;
                                        }
                                </script>
                                    <?php } else{ echo '<marquee><h4 style"color:red;"> Sorry! Profile Not Updated,Please,Update your Profile</h4></marquee>';}?>
                                </div> 
                            </div> 
                        </div> 
                        <div class="panel panel-default"> 
                            <div class="panel-heading" style="background:#820506;color:#fff;"> 
                                <h4 class="panel-title portlet-title"> 
                                    <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseTwo-3" class="collapsed" aria-expanded="false">
                                       Caste Related Information
                                    </a> 
                                </h4> 
                            </div> 
                            <div id="collapseTwo-3" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;"> 
                                <div class="panel-body">
                                    <?php if(!empty($caste)) { ?>
                                     <div id="castePrint">
                                   <table class="table table-striped">
                                        <tr>
                                            <td><p><b>My Religion : </b><?= $caste->gauta;?></p></td>
                                            <td><p><b>My Caste: </b><?= $caste->kul;?></p></td>
                                        </tr>
                                         <tr>
                                            <td><p><b>My Sub Caste: </b><?= $caste->gauta;?></p></td>
                                            <td><p><b>My Language: </b><?= $caste->kul;?></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>My mother tongue: </b><?= $caste->gauta;?></p></td>
                                            <td><p><b>Society ( The society in which my caste is involved ): </b><?= $caste->kul;?></p></td>
                                        </tr>
                                        
                                        <tr>
                                            <td><p><b>My gautra: </b><?= $caste->gauta;?></p></td>
                                            <td><p><b>My kul: </b><?= $caste->kul;?></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>My gautra: </b><?= $caste->gauta;?></p></td>
                                            <td><p><b>My kul: </b><?= $caste->kul;?></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>Name of my kuldevi: </b><?= $caste->kuldevi_name;?></p></td>
                                            <td><p><b>Address of my Kuldevi's residence: </b><?= $caste->gauta;?></p></td>
                                            
                                        </tr>
                                        <tr>
                                            <td colspan="2"><p><b>Kuldevi's upload image: </b>
                                            
                                            <?php 
                                                    $kuldeviiImg= unserialize($caste->kuldevi_img);
                                                    $a=1;
                                                    for($i1=0;$i1 < count($kuldeviiImg); $i1++){
                                                       
                                                ?>
                                              

                                                </b> <img src="<?= base_url('uploads/kuldevi/') . $kuldeviiImg[$i1]; ?>" name="" height="70" width="116" style="margin-top: 10px;">
                                                    <?php } ?>
                                            </p></td>
                                            
                                        </tr>
                                        <tr>
                                            <td><p><b>Name of my kuldevta: </b><?= $caste->kuldevata_name;?></p></td>
                                            <td><p><b>Address of my Kuldevta's residence: </b><?= $caste->kuldevata_address;?></p></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><p><b>Kuldevta's image: </b>
                                            
                                            <?php 
                                                    $kuldevata_img= unserialize($caste->kuldevata_img);
                                                    $a=1;
                                                    for($i1=0;$i1 < count($kuldevata_img); $i1++){
                                                       
                                                ?>
                                              

                                                </b> <img src="<?= base_url('uploads/kuldevata/') . $kuldevata_img[$i1]; ?>" name="" height="70" width="116" style="margin-top: 10px;">
                                                    <?php } ?>
                                            </p></td>
                                           
                                        </tr>
                                         <tr>
                                            <td><p><b>My maternal grandfather's gautra: </b><?= $caste->maama_gautr;?></p></td>
                                            <td><p><b>My maternal grandfather's kul: </b><?= $caste->maama_kul;?></p></td>
                                        </tr>
                                         <tr>
                                            <td><p><b>Interesting information related to my society or race that I know</p></td>
                                            <td><p><b>
                                             <?php 
                                                    $info_img= unserialize($caste->info_img);
                                                    $a=1;
                                                    for($i1=0;$i1 < count($info_img); $i1++){
                                                       
                                                ?>
                                              

                                                </b> <img src="<?= base_url('uploads/information/') . $info_img[$i1]; ?>" name="" height="70" width="116" style="margin-top: 10px;">
                                                    <?php } ?>
                                            
                                            </p></td>
                                        </tr>
                                         
                                    </table>
                                     <iframe name="special" width="0" height="0" frameborder="0" src="spacialdata:blank"></iframe>
                                    <button class="btn btn-info" onclick="CasteInfo('castePrint')">Print</button>
                                </div>
                                <script>
                                        function CasteInfo(divName) 
                                        {
                                            var printContents = document.getElementById(divName).innerHTML;
                                            var originalContents = document.body.innerHTML;
                                            document.body.innerHTML = printContents;
                                            window.print();
                                            document.body.innerHTML = originalContents;
                                        }
                                </script>
                                    <?php } else{ echo '<marquee><h4 style"color:red;"> Sorry! Profile Not Updated,Please,Update your Profile</h4></marquee>';}?>
                                </div> 
                            </div> 
                        </div>
                        <div class="panel panel-default"> 
                            <div class="panel-heading" style="background:#820506;color:#fff;"> 
                                <h4 class="panel-title portlet-title"> 
                                    <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseTwo-4" class="collapsed" aria-expanded="false">
                                         Payment Related Information
                                    </a> 
                                </h4> 
                            </div> 
                            <div id="collapseTwo-4" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;"> 
                                <div class="panel-body">
                                    <?php if(!empty($pay)) { ?>
                                     <div id="PayPrint">
                                   <table class="table table-striped">
                                        <tr>
                                            <td><p><b>Name of Bank: </b><?= $pay->bank_name;?></p></td>
                                            <td><p><b>Branch ddress: </b><?= $pay->branch;?></p></td>
                                        </tr>
                                         <tr>
                                            <td><p><b>Account Holder's Name: </b><?= $pay->ac_holder_name;?></p></td>
                                            <td><p><b>Account Number: </b><?= $pay->account_no;?></p></td>
                                        </tr>
                                         <tr>
                                            <td colspan="2"><p><b>IFSC Code: </b><?= $pay->ifsc;?></p></td>
                                            
                                        </tr>
                                        <tr>
                                            <td><p><b>Paytm Number: </b><?= $pay->paytm_no;?></p></td>
                                            <td><p><b>Paytm Upi Address: </b><?= $pay->paytm_address;?></p></td>
                                        </tr>
                                         <tr>
                                            <td><p><b>BHIM Number: </b><?= $pay->bhim_no;?></p></td>
                                            <td><p><b>BHIM Upi Address: </b><?= $pay->bhim_address;?></p></td>
                                        </tr>
                                         <tr>
                                            <td><p><b>Google Pay (Tez) Number: </b><?= $pay->google_pay;?></p></td>
                                            <td><p><b>Google Pay (Tez) Upi Address: </b><?= $pay->google_upi;?></p></td>
                                        </tr>
                                         <tr>
                                            <td><p><b>Phonepe Number: </b><?= $pay->phonepe_no;?></p></td>
                                            <td><p><b>Phonepe Upi Address: </b><?= $pay->phonepe_upi;?></p></td>
                                        </tr>
                                         <tr>
                                            <td><p><b>Payment App's name: </b><?= $pay->other_pay_no;?></p></td>
                                            <td><p><b>Payment App's number: </b><?= $pay->other_upi;?></p></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><p><b>Payment App's Upi Address: </b><?= $pay->other_address;?></p></td>
                                            
                                        </tr>
                                    </table>
                                     <button class="btn btn-info" onclick="PayInfo('PayPrint')">Print</button>
                                </div>
                                <script>
                                        function PayInfo(divName) 
                                        {
                                            var printContents = document.getElementById(divName).innerHTML;
                                            var originalContents = document.body.innerHTML;
                                            document.body.innerHTML = printContents;
                                            window.print();
                                            document.body.innerHTML = originalContents;
                                        }
                                </script>
                                    <?php } else{ echo '<marquee><h4 style"color:red;"> Sorry! Profile Not Updated,Please,Update your Profile</h4></marquee>';}?>
                                </div> 
                            </div> 
                        </div>
                        <div class="panel panel-default"> 
                            <div class="panel-heading" style="background:#820506;color:#fff;"> 
                                <h4 class="panel-title portlet-title"> 
                                    <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseTwo-5" class="collapsed" aria-expanded="false">
                                        Very Special Information
                                    </a> 
                                </h4> 
                            </div> 
                            <div id="collapseTwo-5" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;"> 
                                <div class="panel-body">
                                    <?php if(!empty($specials)) { ?>
                                     <div id="specialPrint">
                                   <table class="table table-striped">
                                        <tr>
                                            <td colspan="2"><p><b>"Voter ID" number: </b><?= $specials->votar_no;?></p></td>
                                            
                                        </tr>
                                        <tr>
                                            <td colspan="2"><p><b>"Voter ID": </b>
                                                <?php 
                                                    $VotarImg= unserialize($specials->votar_img);
                                                   
                                                    for($s=0;$s < count($VotarImg); $s++){
                                                       
                                                ?>
                                                 <img src="<?= base_url('uploads/special/voter/').$VotarImg[$s]; ?>" name="" height="70" width="116" style="margin-top: 10px;">
                                                    <?php } ?>
                                            </p>
                                            </td>
                                          
                                        </tr>
                                        <tr>
                                            <td colspan="2"><p><b>"Aadhar Card" number: </b><?= $specials->aadhar_no;?></p></td>
                                        </tr>
                                        <tr>    
                                            <td><p><b>"Aadhar Card" :</b>
                                                     <?php 
                                                    $aadhar_img= unserialize($specials->aadhar_img);
                                                    $a=1;
                                                    for($i1=0;$i1 < count($aadhar_img); $i1++){
                                                       
                                                ?>
                                                </b> <img src="<?= base_url('uploads/special/addhar/') . $aadhar_img[$i1]; ?>" name="" height="70" width="116" style="margin-top: 10px;">
                                                    <?php } ?>
                                            </p></td>
                                           
                                        </tr>
                                        <tr>
                                            <td><p><b>"PAN Card" number: </b><?= $specials->pan_no;?></p></td>
                                            <td><p><b>"PAN Card" image: </b>
                                            
                                                <?php 
                                                    $panImg= unserialize($specials->pan_img);
                                                  
                                                    for($a=0;$a < count($panImg); $a++){
                                                       
                                                ?>
                                                </b> <img src="<?= base_url('uploads/special/pan/').$panImg[$a]; ?>" name="" height="70" width="116" style="margin-top: 10px;">
                                                 <?php } ?>
                                            </p></td>
                                        </tr>
                                         <tr>
                                            <td><p><b>Birth Certificate number or Marksheet of 10th - Birth Certificate number: </b><?= $specials->birth_cer_no;?></p></td>
                                            <td><p><b>"Birth Certificate or Marksheet of 10th" : </b>
                                            <?php 
                                                    $birthimg= unserialize($specials->birth_img);
                                                    $a=1;
                                                    for($i3=0;$i3 < count($birthimg); $i3++){
                                                       
                                                ?>
                                                </b> <img src="<?= base_url('uploads/special/birth/').$birthimg[$i3]; ?>" name="" height="70" width="116" style="margin-top: 10px;">
                                                 <?php } ?>
                                            </p></td>
                                        </tr>
                                         <tr>
                                            <td><p><b>"Income Certificate": </b><
                                                <?php 
                                                    $income_img= unserialize($specials->income_img);
                                                    $a=1;
                                                    for($i1=0;$i1 < count($income_img); $i1++){
                                                       
                                                ?>
                                                </b> <img src="<?= base_url('uploads/special/income/') . $income_img[$i1]; ?>" name="" height="70" width="116" style="margin-top: 10px;">
                                                 <?php } ?>
                                            </p></td>
                                            <td><p><b>"Disability Certificate": </b>
                                                <?php 
                                                    $disability_img= unserialize($specials->disability_img);
                                                    $a=1;
                                                    for($i1=0;$i1 < count($disability_img); $i1++){
                                                       
                                                ?>
                                                </b> <img src="<?= base_url('uploads/special/income/') . $disability_img[$i1]; ?>" name="" height="70" width="116" style="margin-top: 10px;">
                                                 <?php } ?>
                                            </p></td>
                                        </tr>
                                         <tr>
                                            <td colspan="2"><p><b>Details of particular certificates I received (Certificate's name): </b><?= $specials->speciality_n;?></p></td>
                                            <td><p><b>"Special Certificate": </b>
                                                <?php 
                                                    $speciality_img= unserialize($specials->speciality_img);
                                                    $a=1;
                                                    for($i1=0;$i1 < count($speciality_img); $i1++){
                                                       
                                                ?>
                                                </b> <img src="<?= base_url('uploads/special/speciality_img/') . $speciality_img[$i1]; ?>" name="" height="70" width="116" style="margin-top: 10px;">
                                                 <?php } ?>
                                            
                                            </p></td>
                                        </tr>
                                         <tr>
                                            <td><p><b>My body's color: </b><?= $specials->pan_no;?></p></td>
                                            <td><p><b>My body's height: </b><?= $specials->pan_no;?></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>My body's weight (in Kilograms): </b><?= $specials->wight;?></p></td>
                                            <td><p><b>My body's blood group: </b><?= $specials->blood_group;?></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>My Favourite Food: </b><?= $specials->food;?></p></td>
                                            <td><p><b>My favourite fruit: </b><?= $specials->fruit;?></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>My favourite movie: </b><?= $specials->movie;?></p></td>
                                            <td><p><b>My favourite song: </b><?= $specials->song;?></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>My favourite actor: </b><?= $specials->actor;?></p></td>
                                            <td><p><b>My favourite actress: </b><?= $specials->actress;?></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>My favourite festival: </b><?= $specials->festival;?></p></td>
                                            <td><p><b>I consider them to be my ideal: </b><?= $specials->actress;?></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>Why do I consider these as my ideal ?: </b><?= $specials->my_ideal;?></p></td>
                                            <td><p><b>I'm a believer: </b><?= $specials->believer;?></p></td>
                                        </tr>
                                        <tr>
                                            <td colspan='2'><p><b>I consider them my god: </b><?= $specials->god;?></p></td>
                                        </tr>
                                        
                                    </table>
                                      <button class="btn btn-info" onclick="SpecialInfo('specialPrint')">Print</button>
                                </div>
                                <script>
                                        function SpecialInfo(divName) 
                                        {
                                            var printContents = document.getElementById(divName).innerHTML;
                                            var originalContents = document.body.innerHTML;
                                            document.body.innerHTML = printContents;
                                            window.print();
                                            document.body.innerHTML = originalContents;
                                        }
                                </script>
                                    <?php } else{ echo '<marquee style"color:red;">Sorry! Profile Not Updated,Please,Update your Profile</marquee>';}?>
                                </div>  
                            </div> 
                        </div>
                        <div class="panel panel-default"> 
                            <div class="panel-heading" style="background:#820506;color:#fff;"> 
                                <h4 class="panel-title portlet-title"> 
                                    <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseTwo-6" class="collapsed" aria-expanded="false">
                                        Education Related Information
                                    </a> 
                                </h4> 
                            </div> 
                            <div id="collapseTwo-6" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;"> 
                                <div class="panel-body">
                                    <?php if(!empty($education)) { ?>
                                     <div id="EducationPrint">
                                   <table class="table table-striped">
                                        <tr>
                                            <td><p><b>My education: </b><?= $education->my_education;?></p></td>
                                            <td><p><b>Currently education: </b><?php if($education->current_edu=='Yes') { echo' I am receiving education => Currently Studies => '.$education->study;} else{ echo 'I am not receiving education';}?></p></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><p><b>" School's result " </b></p></td>
                                            
                                        </tr>
                                        <tr>
                                            <th><p><b>Class name</b></p></th>
                                            
                                            <td><p>
                                                <table class="table table-striped">
                                                    <?php 
                                                        $className=unserialize($education->school_name);
                                                        
                                                      foreach($className as $row)
                                                      { 
                                                        foreach($row as $rows)
                                                        { ?>
                                                     <tr> 
                                                        <td><?= $rows; ?>
                                                            <table class="table table-striped">
                                                                
                                                                   <?php
                                                                        $schoolCertificate = unserialize($education->school_certificate);
                                                                    
                                                                        for ($i1 = 0; $i1 < count($schoolCertificate); $i1++) {

                                                                    ?>
                                                                   <td> <img src="<?=base_url('uploads/education/school/') . $schoolCertificate[$i1];?>" name="" height="70" width="116" style="margin-top: 10px;"></td>
                                                                <?php }?>
                                                            </table>
                                                        </td>
                                                    </tr> 
                                                   <?php }
                                                       
                                                      }
                                                    ?>
                                                    
                                                    
                                                    </tr>
                                                </table>
                                            
                                            </p></td>
                                        </tr>
                                    </table>
                                    <button class="btn btn-info" onclick="EducationInfo('EducationPrint')">Print</button>
                                </div>
                                <script>
                                        function EducationInfo(divName) 
                                        {
                                            var printContents = document.getElementById(divName).innerHTML;
                                            var originalContents = document.body.innerHTML;
                                            document.body.innerHTML = printContents;
                                            window.print();
                                            document.body.innerHTML = originalContents;
                                        }
                                </script>
                                    <?php }else{ echo '<marquee><h4 style"color:red;"> Sorry! Profile Not Updated,Please,Update your Profile</h4></marquee>';}?>
                                </div> 
                            </div> 
                        </div>
                        <div class="panel panel-default"> 
                            <div class="panel-heading" style="background:#820506;color:#fff;"> 
                                <h4 class="panel-title portlet-title"> 
                                    <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseTwo-7" class="collapsed" aria-expanded="false">
                                        Family Related Information
                                    </a> 
                                </h4> 
                            </div> 
                            <div id="collapseTwo-7" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;"> 
                                <div class="panel-body">
                                    <?php if(!empty($family)) { ?>
                                     <div id="familyPrint">
                                   <table class="table table-striped">
                                        <tr>
                                            <td><p><b><?php if($IdByNormal->gender== 'Male'){ echo "My wife's name"; }else{echo "My husband's name";} ?>: </b><?= $family->parent;?></p></td>
                                            <td><p><b>I have kids: </b><?= $family->ask_kids;?></p></td>
                                        </tr>
                                    <?php if ($family->ask_kids == 'yes') {?> 
                                        <tr>
                                            <td><p><b>Total number of children: </b><?= $family->total_kids;?></p></td>
                                            <td><p><b>Total number of my sons: </b><?= $family->son_no;?></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>Total number of my daughters: </b><?= $family->daughters_no;?></p></td>
                                            <td><p><b>So far my boys are married: </b><?= $family->no_of_married_boy;?></p></td>
                                        </tr>
                                         <tr>
                                            <td><p><b>So far, my remaining boys are not married: </b><?= $family->remaining_boys;?></p></td>
                                            <td><p><b>So far my girls are married: </b><?= $family->no_of_married_girl;?></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>So far, my remaining girls are not married : </b><?= $family->remaining_girls;?></p></td>
                                            <td><p><b>The total number of members in my family are : </b><?= $family->ask_kids;?></p></td>
                                        </tr>
                                        
                                       
                                    <?php } ?>
                                        <tr>
                                            
                                            <td><p><b>The total number of members in my family are : </b><?= $family->no_of_family;?></p></td>
                                             <td><p><b>Number of members currently living with me: </b><?= $family->present_no_of_family;?></p></td>
                                        </tr>
                                        <tr>
                                            
                                            <td><p><b>The house I live in is: </b><?= $family->home_type;?></p></td>
                                             <td><p><b>The length of the house I live in is(In Fit): </b><?= $family->home_length;?></p></td>
                                        </tr>
                                        <tr>
                                            
                                            <td><p><b>The width of the house in which I live (In Fit) : </b><?= $family->home_width;?></p></td>
                                             <td><p><b>Number of rooms in the house I live in: </b><?= $family->no_of_room;?></p></td>
                                        </tr>
                                        <tr>
                                            
                                            <td><p><b>My total parental property is as follows : </b><?= $family->about_property;?></p></td>
                                             <td><p><b>My total self assets are as follows: </b><?= $family->self_property;?></p></td>
                                        </tr>
                                        <tr>
                                            
                                            <td><p><b>In the event of no father or mother, the name of the chief : </b><?= $family->event_of;?></p></td>
                                             <td><p><b>Chief's mobile number: </b><?= $family->chief_mobile;?></p></td>
                                        </tr>
                                        <tr>
                                            
                                            <td colspan="2"><p><b>Am I the only child of my father : </b><?= $family->ask_only_child;?></p></td>
                                             
                                        </tr>
                                        <?php if($family->ask_only_child=='yes') { ?>
                                        <tr>
                                            <td><p><b>The total number of my real brothers is: </b><?= $family->real_brothers;?></p></td>
                                            <td><p><b>The total number of my real sisters is: </b><?= $family->real_sisters;?></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>The number of my married brothers is: </b><?= $family->real_married_brothers;?></p></td>
                                             <td><p><b>The number of my unmarried brothers is: </b><?= $family->unmarried_brothers_no;?></p></td>
                                        </tr>
                                    <?php } elseif($family->ask_only_child=='no'){?>
                                          <tr>
                                            <td><p><b>Total number of my father's children: </b><?= $family->total_only_child;?></p></td>
                                            <td><p><b>The total number of my real brothers is: </b><?= $family->real_brothers;?></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>The total number of my real sisters is: </b><?= $family->real_sisters;?></p></td>
                                             <td><p><b>The number of my married brothers is: </b><?= $family->real_married_brothers;?></p></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td colspan="2"><p><b>The total number of my real sisters is: </b><?= $family->specialty_me;?></p></td>
                                           
                                    </tr>
                                    
                                    </table>
                                     <button class="btn btn-info" onclick="FamilyInfo('familyPrint')">Print</button>
                                </div>
                                <script>
                                        function FamilyInfo(divName) 
                                        {
                                            var printContents = document.getElementById(divName).innerHTML;
                                            var originalContents = document.body.innerHTML;
                                            document.body.innerHTML = printContents;
                                            window.print();
                                            document.body.innerHTML = originalContents;
                                        }
                                </script>
                                    <?php } else{ echo '<marquee><h4 style"color:red;"> Sorry! Profile Not Updated,Please,Update your Profile</h4></marquee>';}?>
                                </div> 
                            </div> 
                        </div>
                        <div class="panel panel-default"> 
                            <div class="panel-heading" style="background:#820506;color:#fff;"> 
                                <h4 class="panel-title portlet-title"> 
                                    <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseTwo-12" class="collapsed" aria-expanded="false">
                                        7 Generations Information
                                    </a> 
                                </h4> 
                            </div> 
                            <div id="collapseTwo-12" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;"> 
                                <div class="panel-body">
                                    <?php if(!empty($geration)) { ?>
                                     <div id="GenerationsPrint">
                                   <table class="table table-striped">
                                        <tr>
                                            <td><p><b>My father's name: </b><?= $geration->father;?></p></td>
                                            <td><p><b>My father's name Photo: </b>
                                                <img src="http://myinformation.in/myinformation/profile/default.jpg" alt="user-img" class="img-circle">
                                            </p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>My mother's name: </b><?= $geration->mother;?></p></td>
                                            <td><p><b>My mother's name Photo: </b>
                                                <img src="http://myinformation.in/myinformation/profile/default.jpg" alt="user-img" class="">
                                            </p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>My grandfather's name: </b><?= $geration->grandfather;?></p></td>
                                            <td><p><b>My grandfather's name Photo: </b><img src="http://myinformation.in/myinformation/profile/default.jpg" alt="user-img" class="img-circle"></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>My grandmother's name: </b><?= $geration->grandmother;?></p></td>
                                            <td><p><b>My grandmother's name photo: </b><img src="http://myinformation.in/myinformation/profile/default.jpg" alt="user-img" class="img-circle"></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>My great-grandfather's name: </b><?= $geration->great_grandfather;?></p></td>
                                            <td><p><b>My great-grandfather's name photo: </b></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>My great-grandmother's name: </b><?= $geration->great_grandmother;?></p></td>
                                            <td><p><b>My great-grandmother's name photo: </b></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>My great grandfather's father's name: </b><?= $geration->great_grandfather_father;?></p></td>
                                            <td><p><b>My great grandfather's father's name photo: </b></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>My great grandfather's mother's name: </b><?= $geration->great_grandmother_mother;?></p></td>
                                            <td><p><b>My great grandfather's mother's name photo: </b></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>My great grandfather's father's father's name: </b><?= $geration->father5;?></p></td>
                                            <td><p><b>My great grandfather's father's father's name photo: </b></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>My great grandfather's father's mother's name: </b><?= $geration->mother5;?></p></td>
                                            <td><p><b>My great grandfather's father's mother's name photo: </b></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>My great grandfather's father's father's father's name: </b><?= $geration->father6;?></p></td>
                                            <td><p><b>My great grandfather's father's father's father's name photo: </b></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>My great grandfather's father's father's mother's name: </b><?= $geration->mother6;?></p></td>
                                            <td><p><b>My great grandfather's father's father's mother's name photo: </b></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>My great grandfather's father's father's father's father's name: </b><?= $geration->father7;?></p></td>
                                            <td><p><b>My great grandfather's father's father's father's father's name photo: </b></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>My great grandfather's father's father's father's mother's name: </b><?= $geration->mother7;?></p></td>
                                            <td><p><b>My great grandfather's father's father's father's mother's name photo: </b></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>My mother's name: </b><?= $geration->my_mother;?></p></td>
                                            <td><p><b>My mother's name photo: </b></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>My maternal grandmother's name: </b><?= $geration->maternal_grandmother;?></p></td>
                                            <td><p><b>My maternal grandmother's name photo: </b></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>My maternal grandfather's name: </b><?= $geration->maternal_grandfather;?></p></td>
                                            <td><p><b>My maternal grandfather's name photo: </b></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>My maternal grandmother's mother's name: </b><?= $geration->maternal_grandmother_m;?></p></td>
                                            <td><p><b>My maternal grandmother's mother's name photo: </b></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>My maternal grandmother's father's name: </b><?= $geration->maternal_granfather_f;?></p></td>
                                            <td><p><b>My maternal grandmother's father's name photo: </b></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>My maternal grandmother's mother's mother's name: </b><?= $geration->maternal_grandmother_m_m;?></p></td>
                                            <td><p><b>My maternal grandmother's mother's mother's name photo: </b></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>My maternal grandmother's mother's father's name: </b><?= $geration->maternal_grandmother_m_f;?></p></td>
                                            <td><p><b>My maternal grandmother's mother's father's name photo: </b></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>My maternal grandmother's mother's mother's mother's name: </b><?= $geration->maternal_grandmother_m_m_m;?></p></td>
                                            <td><p><b>My maternal grandmother's mother's mother's mother's name photo: </b></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>My maternal grandmother's mother's mother's father's name: </b><?= $geration->maternal_grandmother_m_m_f;?></p></td>
                                            <td><p><b>My maternal grandmother's mother's mother's father's name photo: </b></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>My maternal grandmother's mother's mother's mother's mother's name: </b><?= $geration->maternal_grandmother_m_m_m_m;?></p></td>
                                            <td><p><b>My maternal grandmother's mother's mother's mother's mother's name photo: </b></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>My maternal grandmother's mother's mother's mother's father's name: </b><?= $geration->maternal_grandmother_m_m_m_f;?></p></td>
                                            <td><p><b>My maternal grandmother's mother's mother's mother's father's name photo: </b></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>My maternal grandmother's mother's mother's mother's mother's mother's name: </b><?= $geration->maternal_grandmother_m_m_m_m_m;?></p></td>
                                            <td><p><b>My maternal grandmother's mother's mother's mother's mother's mother's name photo: </b></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>My maternal grandmother's mother's mother's mother's mother's father's name: </b><?= $geration->maternal_grandmother_m_m_m_m_f;?></p></td>
                                            <td><p><b>My maternal grandmother's mother's mother's mother's mother's father's name photo: </b></p></td>
                                        </tr>
                                        
                                    </table>
                                       <button class="btn btn-info" onclick="GenerationsInfo('GenerationsPrint')">Print</button>
                                </div>
                                <script>
                                        function GenerationsInfo(divName) 
                                        {
                                            var printContents = document.getElementById(divName).innerHTML;
                                            var originalContents = document.body.innerHTML;
                                            document.body.innerHTML = printContents;
                                            window.print();
                                            document.body.innerHTML = originalContents;
                                        }
                                </script>
                                    <?php } else{ echo '<marquee><h4 style"color:red;"> Sorry! Profile Not Updated,Please,Update your Profile</h4></marquee>';}?>
                                </div> 
                            </div> 
                        </div>
                        <div class="panel panel-default"> 
                            <div class="panel-heading" style="background:#820506;color:#fff;"> 
                                <h4 class="panel-title portlet-title"> 
                                    <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseTwo-8" class="collapsed" aria-expanded="false">
                                        Health Related Information
                                    </a> 
                                </h4> 
                            </div> 
                            <div id="collapseTwo-8" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;"> 
                                <div class="panel-body">
                                    <?php if(!empty($health)) { ?>
                                     <div id="HealthPrint">
                                   <table class="table table-striped">
                                        <tr>
                                            <td colspan="2"><p><b>Am I disabled ?: </b><?= $health->disabled;?></p></td>
                                        </tr>
                                        <?php if($health->disabled =='Yes') { ?>
                                        <tr>
                                            <td><p><b> My disability is as follows: </b><?= $health->disability_as_f;?></p></td>
                                            <td><p><b>How many years ago did this disability occur ?: </b><?= $health->blindness;?></p></td>
                                        </tr>
                                       <tr>
                                            <td colspan="2"><p><b>  Is this disability a genetic ?: </b><?= $health->disability_genetic;?></p></td>
                                            
                                        </tr>
                                        <?php } ?><!-------=====Am I disabled ? Yes Option if(condition)End====------->
                                        <tr>
                                            <td colspan="2"><p><b>Do I have any special disease ?: </b><?= $health->disability;?></p></td>
                                        </tr>
                                         <?php if($health->disabled =='Yes') { ?>
                                         <tr>
                                            <td><p><b> My special disease is as follows: <?= $health->as_flows;?></p></td>
                                            <td><p><b>How many years ago did this special disease occur ?: <?= $health->disease_year;?></p></td>
                                            <td><p><b> Is this special disease a genetic ?:<?= $health->special_genetic;?> </p></td>
                                        </tr>
                                         <tr>
                                            <td colspan="2"><p><b> Apart from this, is there more troubles in my body ?: </b><?= $health->disability;?></p></td>
                                        </tr>
                                       
                                         <?php } ?><!-------====Do I have any special disease ? if(condition) End=====------>
                                          <?php if($health->disability =='Yes') { ?>
                                            <tr>
                                                <td><p><b>The name of the problems in my body is as follows: <?= $health->disease_year;?></p></td>
                                                <td><p><b>How many years ago did this special disease occur ?: <?= $health->disease_year;?></p></td>
                                                <td><p><b>Is this special disease a genetic ?:<?= $health->special_genetic1;?> </p></td>
                                            </tr>
                                          <?php } ?>
                                        <tr>
                                            <td colspan="2"><p><b>Have I ever had an accident ?: </b><?= $health->accident;?></p></td>
                                        </tr>
                                          <?php if($health->accident =='Yes') { ?>
                                           <tr>
                                                <td colspan="2"><p><b> How many times have my accident ?: </b><?= $health->accident_no;?></p></td>
                                          </tr>
                                          <?php if($health->accident_no =='1') { ?>
                                           <tr>
                                                <td><p><b>When did my accident ? (in which Year ?): <?= $health->year_accident;?></p></td>
                                                <td><p><b>What happened to me in this accident ?: <?= $health->about_accident;?></p></td>
                                               
                                            </tr>
                                          <?php } elseif($health->accident_no =='2') { ?>
                                           <tr>
                                                <td><p><b>When was my first accident ? (in which Year ?): <?= $health->first_accident;?></p></td>
                                                <td><p><b>What happened to me in this accident ?: <?= $health->about_accident;?></p></td>
                                            </tr>
                                            <tr>
                                                <td><p><b>When was my second accident ? (in which Year ? ): <?= $health->second_accident;?></p></td>
                                                <td><p><b>What happened to me in this accident ?: <?= $health->about_accident_se;?></p></td>
                                            </tr>
                                          <?php }elseif($health->accident_no =='3') { ?>
                                            <tr>
                                                <td><p><b>When was my first accident ? (in which Year ? ): <?= $health->first_accident;?></p></td>
                                                <td><p><b>What happened to me in this accident ? : <?= $health->about_accident;?></p></td>
                                                
                                            </tr>
                                            <tr>
                                                <td><p><b>When was my second accident ? (in which Year ? ): <?= $health->second_accident;?></p></td>
                                                <td><p><b>What happened to me in this accident ? : <?= $health->third_accident;?></p></td>
                                                
                                            </tr>
                                            <tr>
                                                <td><p><b>When was my third accident ? (in which Year ? ): <?= $health->third_accident_yeear;?></p></td>
                                                <td><p><b>What happened to me in this accident ? : <?= $health->about_accident_se;?></p></td>
                                                
                                            </tr>
                                          <?php } elseif($health->accident_no =='4') {?>
                                           <tr>
                                                <td><p><b>When was my first accident ? (in which Year ? ): <?= $health->first_accident;?></p></td>
                                                <td><p><b>What happened to me in this accident ? : <?= $health->about_accident;?></p></td>
                                                
                                            </tr>
                                            <tr>
                                                <td><p><b>When was my second accident ? (in which Year ? ): <?= $health->second_accident;?></p></td>
                                                <td><p><b>What happened to me in this accident ? : <?= $health->third_accident;?></p></td>
                                                
                                            </tr>
                                            <tr>
                                                <td><p><b>When was my third accident ? (in which Year ? ): <?= $health->third_accident_yeear;?></p></td>
                                                <td><p><b>What happened to me in this accident ? : <?= $health->about_accident_se;?></p></td>
                                                
                                            </tr>
                                            <tr>
                                                <td><p><b>When was my fourth accident ? (in which Year ? ): <?= $health->fourth_accident;?></p></td>
                                                <td><p><b>What happened to me in this accident ? : <?= $health->fourth_accident_about;?></p></td>
                                                
                                            </tr>
                                          <?php } elseif($health->accident_no =='5') {?>
                                          <tr>
                                                <td><p><b>When was my first accident ? (in which Year ? ): <?= $health->first_accident;?></p></td>
                                                <td><p><b>What happened to me in this accident ? : <?= $health->about_accident;?></p></td>
                                                
                                            </tr>
                                            <tr>
                                                <td><p><b>When was my second accident ? (in which Year ? ): <?= $health->second_accident;?></p></td>
                                                <td><p><b>What happened to me in this accident ? : <?= $health->third_accident;?></p></td>
                                                
                                            </tr>
                                            <tr>
                                                <td><p><b>When was my third accident ? (in which Year ? ): <?= $health->third_accident_yeear;?></p></td>
                                                <td><p><b>What happened to me in this accident ? : <?= $health->about_accident_se;?></p></td>
                                                
                                            </tr>
                                            <tr>
                                                <td><p><b>When was my fourth accident ? (in which Year ? ): <?= $health->fourth_accident;?></p></td>
                                                <td><p><b>What happened to me in this accident ? : <?= $health->fourth_accident_about;?></p></td>
                                                
                                            </tr>
                                            <tr>
                                                <td><p><b>When was my fifth accident ? (in which Year ?: <?= $health->fifth_accident_year;?></p></td>
                                                <td><p><b>What happened to me in this accident ?: <?= $health->fourth_accident_about;?></p></td>
                                                
                                            </tr>
                                          <?php } ?> <!----====How many times have my accident if(condition) close====--->

                                          <?php } ?><!----====Have I ever had an accident  if(condition) close====--->
                                          <tr>
                                                <td><p><b>Am I currently suffering from accident ?: <?= $health->suf_accident;?></p></td>
                                                <td><p><b>So what are the problems I currently suffer ?: <?= $health->problems;?></p></td>
                                            </tr>
                                            <tr>
                                                <td><p><b>So how long have I been suffering from this time ?: <?= $health->this_time;?></p></td>
                                                <td><p><b>Are there any diseases that my family members are receiving genetically from ?: <?= $health->generation_disease;?></p></td>  
                                            </tr>
                                            <?php if($health->generation_disease=='Yes') { ?>
                                            <tr>
                                                <td><p><b>So the name of that disease: <?= $health->disease_name;?></p></td>
                                                <td><p><b>How long have I got this disease ?: <?= $health->got_disease;?></p></td>  
                                            </tr>
                                          <?php } ?>
                                          <tr>
                                                <td colspan="2"><p><b>Do I have problems with blood pressure ?: <?= $health->blood_generation;?></p></td> 
                                          </tr>
                                        <?php if($health->blood_generation=='Yes') { ?>
                                            <tr>
                                                <td><p><b>Since when have I had blood pressure ?: <?= $health->sugar;?></p></td>
                                                <td><p><b>The problem of blood pressure in my family is coming from generation to generation ?: <?= $health->generation_blood;?></p></td>  
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td colspan="2"><p><b> Do I have problems with sugar ?: <?= $health->blood_sugar;?></p></td> 
                                        </tr>
                                          <?php if($health->blood_sugar=='Yes') { ?>
                                            <tr>
                                                <td><p><b>When have I been suffering from sugar ?: <?= $health->problems_sugar;?></p></td>  
                                                <td><p><b>The problem of sugar in my family is coming from generation to generation ?: <?= $health->family_sugar;?></p></td>  
                                          </tr>
                                          <?php } ?>
                                          <tr>
                                            <td colspan="2"><p><b> Do I have acidity problems ?: <?= $health->acidity;?></p></td> 
                                        </tr>
                                        <?php if($health->acidity=='Yes') { ?>
                                            <tr>
                                                <td><p><b>Since when have I had acidity ?: <?= $health->acidity_since;?></p></td>  
                                                <td><p><b>The problem of blood pressure in my family is coming from generation to generation ?: <?= $health->blood_pressure;?></p></td>  
                                          </tr>
                                          <?php } ?>
                                    </table>
                                         <button class="btn btn-info" onclick="HealthInfo('HealthPrint')">Print</button>
                                </div>
                                <script>
                                        function HealthInfo(divName) 
                                        {
                                            var printContents = document.getElementById(divName).innerHTML;
                                            var originalContents = document.body.innerHTML;
                                            document.body.innerHTML = printContents;
                                            window.print();
                                            document.body.innerHTML = originalContents;
                                        }
                                </script>
                                    <?php } else{ echo '<marquee><h4 style"color:red;"> Sorry! Profile Not Updated,Please,Update your Profile</h4></marquee>';}?>
                                </div> 
                            </div> 
                        </div>
                        <div class="panel panel-default"> 
                            <div class="panel-heading" style="background:#820506;color:#fff;"> 
                                <h4 class="panel-title portlet-title"> 
                                    <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseTwo-9" class="collapsed" aria-expanded="false">
                                       Work Related Information
                                    </a> 
                                </h4> 
                            </div> 
                            <div id="collapseTwo-9" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;"> 
                                <div class="panel-body">
                                    <?php if(!empty($work)) { ?>
                                     <div id="WorkPrint">
                                   <table class="table table-striped">
                                        <tr>
                                            <td colspan="2"><p><b>My current situation: </b><?= $work->work_situation;?></p></td>
                                        </tr>
                                        <?php if($work->work_situation =='daily-wages') { ?>
                                        <tr>
                                            <td><p><b>Current work's name: </b><?= $work->work_done;?></p></td>
                                            <td><p><b>Address of work: </b><?= $work->work_address;?></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>Address of work: </b><?= $work->work_address;?></p></td>
                                            <td><p><b>Earnings from my work are accounted for: </b><?= $work->work_earnings;?></p></td>
                                        </tr>
                                        <?php 
                                            if($work->work_earnings == "daily") {
                                        ?>
                                        <tr>
                                            <td colspan="2"><p><b>My daily earning: </b><?= $work->daily_earnings;?></p></td>
                                        </tr>
                                            <?php } elseif($work->work_earnings == "weekly") { ?>
                                                <tr>
                                                    <td colspan="2">My weekly earning: </b><?= $work->weekly_earnings;?></p></td>
                                                </tr>
                                            <?php } elseif($work->work_earnings == "fortnightly") { ?>
                                                <tr>
                                                    <td colspan="2"><p><b>My fortnightly earning: </b><?= $work->weekly_earnings;?></p></td>
                                                </tr>
                                            <?php } ?><!--=================Earnings from my work are accounted for Otion End========------------------>
                                        <tr>
                                            <td><p><b>My estimated monthly earnings: </b><?= $work->estimated_in;?></p></td>
                                            <td><p><b>My estimated annual earnings: </b><?= $work->estimated_ann;?></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>How many years have I been working on the present work ?: </b><?= $work->total_years;?></p></td>
                                            <td><p><b>Do I have the experience of doing all kinds of work ?: </b><?= $work->experience;?></p></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><p><b>Do I do any other work as well as I do ?: </b><?= $work->additional_work;?></p></td>
                                        </tr>
                                        <?php 
                                            if($work->additional_work == "Yes") {
                                        ?>
                                        <tr>
                                            <td colspan="2"><p><b>The number of my extra works is as follows: </b><?= $work->additional_work;?></p></td>
                                        </tr>
                                        <?php if($work->total_additional_work =='1') { ?>
                                            <tr>
                                                <td><p><b>Name of this extra work: </b><?= $work->extra_work;?></p></td>
                                                <td><p><b>Address of work: </b><?= $work->extra_work_addr;?></p></td>
                                            </tr>
                                            <tr>
                                                <td><p><b>Earnings from my work are accounted for: </b><?= $work->accounted;?></p></td>
                                                <td><p><b> My daily earnings: </b><?= $work->my_daily;?></p></td>
                                            </tr>
                                            <tr>
                                                <td><p><b>My estimated monthly earnings: </b><?= $work->my_monthly;?></p></td>
                                                <td><p><b>My estimated annual earnings: </b><?= $work->my_annual;?></p></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><p><b>How many years have I been working on the present work ?: </b><?= $work->years_doing;?></p></td>
                                                
                                            </tr>
                                        <?php } elseif($work->total_additional_work =='2') { ?>
                                            <tr>
                                                <td><p><b>Name of these first additional work : </b><?= $work->extra_work;?></p></td>
                                                <td><p><b>Address of work: </b><?= $work->extra_work_addr;?></p></td>
                                            </tr>
                                            <tr>
                                                <td><p><b>Earnings from my work are accounted for: </b><?= $work->accounted;?></p></td>
                                                <td><p><b> My daily earnings: </b><?= $work->my_daily;?></p></td>
                                            </tr>
                                            <tr>
                                                <td><p><b>My estimated monthly earnings: </b><?= $work->my_monthly;?></p></td>
                                                <td><p><b>My estimated annual earnings: </b><?= $work->my_annual;?></p></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><p><b>How many years have I been working on the present work ?: </b><?= $work->years_doing;?></p></td>
                                                
                                            </tr>
                                            <tr>
                                                <td><p><b>Name of these second additional work : </b><?= $work->extra_work;?></p></td>
                                                <td><p><b>Address of work: </b><?= $work->extra_work_addr;?></p></td>
                                            </tr>
                                            <tr>
                                                <td><p><b>Earnings from my work are accounted for: </b><?= $work->accounted;?></p></td>
                                                <td><p><b> My daily earnings: </b><?= $work->my_daily;?></p></td>
                                            </tr>
                                            <tr>
                                                <td><p><b>My estimated monthly earnings: </b><?= $work->my_monthly;?></p></td>
                                                <td><p><b>My estimated annual earnings: </b><?= $work->my_annual;?></p></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><p><b>How many years have I been working on the present work ?: </b><?= $work->years_doing;?></p></td>
                                                
                                            </tr>
                                        <?php }  elseif($work->total_additional_work =='3') { ?>
                                            <tr>
                                                <td><p><b>Name of these first additional work : </b><?= $work->extra_work;?></p></td>
                                                <td><p><b>Address of work: </b><?= $work->extra_work_addr;?></p></td>
                                            </tr>
                                            <tr>
                                                <td><p><b>Earnings from my work are accounted for: </b><?= $work->accounted;?></p></td>
                                                <td><p><b> My daily earnings: </b><?= $work->my_daily;?></p></td>
                                            </tr>
                                            <tr>
                                                <td><p><b>My estimated monthly earnings: </b><?= $work->my_monthly;?></p></td>
                                                <td><p><b>My estimated annual earnings: </b><?= $work->my_annual;?></p></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><p><b>How many years have I been working on the present work ?: </b><?= $work->years_doing;?></p></td>
                                                
                                            </tr>
                                            <tr>
                                                <td><p><b>Name of these second additional work : </b><?= $work->extra_work;?></p></td>
                                                <td><p><b>Address of work: </b><?= $work->extra_work_addr;?></p></td>
                                            </tr>
                                            <tr>
                                                <td><p><b>Earnings from my work are accounted for: </b><?= $work->accounted;?></p></td>
                                                <td><p><b> My daily earnings: </b><?= $work->my_daily;?></p></td>
                                            </tr>
                                            <tr>
                                                <td><p><b>My estimated monthly earnings: </b><?= $work->my_monthly;?></p></td>
                                                <td><p><b>My estimated annual earnings: </b><?= $work->my_annual;?></p></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><p><b>How many years have I been working on the present work ?: </b><?= $work->years_doing;?></p></td>
                                                
                                            </tr>
                                            <tr>
                                                <td><p><b>Name of these third additional work : </b><?= $work->extra_work2;?></p></td>
                                                <td><p><b>Address of work: </b><?= $work->extra_work_addr;?></p></td>
                                            </tr>
                                            <tr>
                                                <td><p><b>Earnings from my work are accounted for: </b><?= $work->accounted;?></p></td>
                                                <td><p><b> My daily earnings: </b><?= $work->my_daily;?></p></td>
                                            </tr>
                                            <tr>
                                                <td><p><b>My estimated monthly earnings: </b><?= $work->my_monthly;?></p></td>
                                                <td><p><b>My estimated annual earnings: </b><?= $work->my_annual;?></p></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><p><b>How many years have I been working on the present work ?: </b><?= $work->years_doing;?></p></td>
                                                
                                            </tr>
                                        <?php } ?>
                                            <?php } ?><!----============Yes No Option Aditional Work End====================------------------------>
                                         <tr>
                                                <td><p><b>Estimated annual earnings from main work: </b><?= $work->estimated_main_annu;?></p></td>
                                                <td><p><b>Estimated annual earnings of extra works: </b><?= $work->estimated_extry_amt;?></p></td>  
                                        </tr>
                                        <tr>
                                            <td><p><b>My personal estimated annual earnings from all sources: </b><?= $work->all_sources_amt;?></p></td>
                                            <td><p><b>In all respects, the total estimated monthly earnings of my entire family: </b><?= $work->earnings_family;?></p></td>
                                        </tr>
                                        <?php } elseif($work->work_situation =='job'){ ?>
                                            <tr>
                                                <td colspan="2"><p><b>My job is: </b><?= $work->job;?></p></td>
                                            </tr>
                                            <!---private government--->
                                        <?php } elseif($work->work_situation =='business'){  ?>

                                        <?php } elseif($work->work_situation =='Free'){ ?>
                                            
                                        <?php } elseif($work->work_situation =='Retired'){  ?>

                                        <?php } ?>
                                    </table>
                                       <button class="btn btn-info" onclick="WorkInfo('WorkPrint')">Print</button>
                                </div>
                                <script>
                                        function WorkInfo(divName) 
                                        {
                                            var printContents = document.getElementById(divName).innerHTML;
                                            var originalContents = document.body.innerHTML;
                                            document.body.innerHTML = printContents;
                                            window.print();
                                            document.body.innerHTML = originalContents;
                                        }
                                </script>
                                    <?php } else{ echo '<marquee><h4 style"color:red;"> Sorry! Profile Not Updated,Please,Update your Profile</h4></marquee>';}?>
                                </div> 
                            </div> 
                        </div>
                        
                         <div class="panel panel-default"> 
                            <div class="panel-heading" style="background:#820506;color:#fff;"> 
                                <h4 class="panel-title portlet-title"> 
                                    <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseTwo-11" class="collapsed" aria-expanded="false">
                                        Marriage Related Information
                                    </a> 
                                </h4> 
                            </div> 
                            <div id="collapseTwo-11" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;"> 
                                <div class="panel-body">
                                    <?php if(!empty($mrge)) { ?>
                                     <div id="MarriagePrint">
                                        <table class="table table-striped">
                                            <tr>
                                                <th>My Name</th>
                                                <td><?= $IdByNormal->fname?></td>
                                                <th>My father's name </th>
                                                <td><?= $IdByNormal->father_name; ?></td>
                                                <th>Date of birth</th>
                                                <td><?= $birth->dob; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Birth place's name</th>
                                                <td><?= $birth->place_of_birth; ?></td>
                                                <th>Birth time</th>
                                                <td><?= $birth->time; ?></td>
                                                <th>Birth name </th>
                                                <td><?= $birth->birth_of_name; ?></td>
                                            </tr>
                                            <tr>
                                                <th>My Religion</th>
                                                <td><?= $IdByNormal->religions; ?></td>
                                                <th>My Caste</th>
                                                <td><?= $IdByNormal->dharm; ?></td>
                                                <th>My Sub Caste </th>
                                                <td><?php if(!empty( $IdByNormal->dharm)) { echo $IdByNormal->dharm; } ?></td>
                                            </tr>
                                            <tr>
                                                <th>My gatra</th>
                                                <td colspan="2"><?= $caste->gauta; ?></td>
                                                <th> My kul  </th>
                                                <td colspan="2"><?= $caste->kul; ?></td>
                                                
                                            </tr>

                                            <tr>
                                                <td colspan="6">
                                                    <table class="table table-striped" border="1">
                                                        <thead>
                                                            <tr>
                                                                    <th <?php if($work->work_situation =='daily-wages') {?>colspan="5" <?php } elseif($work->work_situation =='job') { ?> colspan="6"<?php } ?>style="text-align:center">
                                                                    My work:
                                                                <?php if($work->work_situation =='daily-wages') {
                                                                    echo 'daily wages';
                                                                }
                                                                elseif($work->work_situation =='unemployed'){
                                                                    echo 'unemployed';
                                                                }
                                                                elseif($work->work_situation =='job'){
                                                                    echo 'job';
                                                                } 
                                                                elseif($work->work_situation =='business'){
                                                                    echo 'business';
                                                                } 
                                                                elseif($work->work_situation =='Free'){
                                                                    echo 'Free';
                                                                } 
                                                                elseif($work->work_situation =='Retired'){
                                                                    echo 'Retired';
                                                                } 
                                                                ?>
                                                                </th>
                                                            </tr>
                                                            <?php if($work->work_situation =='daily-wages') { ?>
                                                            <tr>
                                                                <th>Current work's name</th>
                                                                <th>Address of work</th>
                                                                <th>My estimated monthly earnings</th>
                                                                <th>Do I do any other work as well as I do ?</th>
                                                                <th>My personal estimated annual earnings from all sources</th>
                                                            </tr>   
                                                            <?php  }
                                                                elseif($work->work_situation =='unemployed'){
                                                                    
                                                                ?>
                                                                    unemployed
                                                                
                                                                <?php } elseif($work->work_situation =='job'){ ?>
                                                                <tr>
                                                                    <th> Name of my private job's area</th>
                                                                    <th>My Private Job's Address</th>
                                                                    <th>My post is</th>
                                                                    <th>My monthly salary</th>
                                                                    <th>My annual salary</th>
                                                                    <th>Do I do additional work along with current work ?<!---- Yes Condition pe -----></th> 
                                                                </tr> 
                                                                <?php } elseif($work->job =='government'){?>
                                                                    <tr>
                                                                    <th> Name of my department </th>
                                                                    <th>My government job's address </th>
                                                                    <th>My post is</th>
                                                                    <th>My monthly salary</th>
                                                                    <th>My annual salary</th>
                                                                    <th>Do I do additional work along with current work ?<!---- Yes Condition pe -----></th> 
                                                                </tr> 

                                                                <?php    
                                                                } 
                                                                elseif($work->work_situation =='business'){
                                                                    ?>
                                                                    
                                                                    <tr>
                                                                    <th> Name of business </th>
                                                                    <th>Address of business </th>
                                                                    <th>My daily earnings</th>
                                                                    <th>My estimated monthly earnings</th>
                                                                    <th>Do I do any other business as well as I do ?</th>
                                                                    
                                                                </tr> 
                                                                <?php
                                                                } 
                                                                elseif($work->work_situation =='Free'){
                                                                    echo 'Free';
                                                                } 
                                                                elseif($work->work_situation =='Retired'){
                                                                    ?>
                                                                    <tr>
                                                                    <th>Name of retired department</th>
                                                                    <th>Name of retired post</th>
                                                                    <th>Retirement year</th>
                                                                    <th>My monthly pension </th>
                                                                    <th>My annual pension</th>
                                                                    <th>Do I do any other work as well as I do ?</th>
                                                                    <th>My personal estimated annual earnings from all sources</th>
                                                                    
                                                                </tr> 
                                                                    <?php
                                                                } 
                                                                ?>
                                                            
                                                            
                                                        </thead>
                                                            <?php if($work->work_situation =='daily-wages') { ?>
                                                            <tr> 
                                                                    <td><?= $work->work_done; ?></td>
                                                                    <td><?= $work->work_address; ?></td>
                                                                    <td><i class="fa fa-inr"></i> <?= $work->estimated_in; ?></td>
                                                                    <td><?= $work->additional_work; ?></td>
                                                                    <td><?= $work->all_sources_amt; ?></td>
                                                            </tr>
                                                        
                                                            <?php } elseif($work->work_situation =='unemployed') { ?>
                                                            <tr>
                                                                <td>unemployed</td>
                                                            </tr>    
                                                            <?php } elseif($work->work_situation =='job') { ?>
                                                                <tr>
                                                                    <td><?= $work->private_area1; ?></td>
                                                                    <td><?= $work->private_address; ?></td>
                                                                    <td><?= $work->working_post; ?></td>
                                                                    <td><?= $work->salary_m1; ?></td>
                                                                    <td><?= $work->salary_annual1; ?></td>
                                                                    <!-- <td><?= $work->present_work1; ?></td> -->
                                                                    <!-- <td><?= $work->job_experience; ?></td> -->
                                                                    <td><?php if($work->current_job_eaxtra1=='Yes'){ echo 'Yes'; } ?></td>
                                                                    
                                                                    
                                                            </tr>
                                                                <!------Additional work option Yes------>
                                                                <tr><!---- Yes Condition pe ----->
                                                                    <th colspan="3"> Monthly earnings from this extra work</th>
                                                                    <th colspan="3"> Annual earnings from this extra work</th>
                                                                    
                                                                </tr>
                                                            <tr>
                                                                
                                                                <td colspan="3"><?= $work->Extra_earnings; ?></td>
                                                                <td colspan="3"><?= $work->Extra_Annual; ?></td>
                                                                
                                                            </tr>
                                                            <tr>
                                                                    <td><?= $work->private_area; ?></td>
                                                                    <td><?= $work->private_address1; ?></td>
                                                                    <td><?= $work->working_post1; ?></td>
                                                                    <td><?= $work->salary_m; ?></td>
                                                                    <td><?= $work->salary_annual; ?></td>
                                                                    
                                                                    <td><?php if($work->current_job_eaxtra=='Yes'){ echo 'Yes'; } ?></td>
                                                                    
                                                                    
                                                            </tr>
                                                                <!------Additional work option Yes------>
                                                                <tr><!---- Yes Condition pe ----->
                                                                    <th colspan="3"> Monthly earnings from this extra work</th>
                                                                    <th colspan="3"> Annual earnings from this extra work</th>
                                                                    
                                                                </tr>
                                                            <tr>
                                                                
                                                                <td colspan="3"><?= $work->Extra_earnings1; ?></td>
                                                                <td colspan="3"><?= $work->Extra_Annual1; ?></td>
                                                                
                                                            </tr>
                                                            <?php } elseif($work->work_situation =='business') { ?>
                                                                <tr>
                                                                    <td><?= $work->business; ?></td>
                                                                    <td><?= $work->business_address; ?></td>
                                                                    <td><i class="fa fa-inr"></i> <?= $work->my_ern; ?></td>
                                                                    <td><?= $work->my_m_erny; ?></td>
                                                                    
                                                                        <td><?php if($work->business_kinds=='Yes'){ echo 'Yes'; } ?></td>
                                                                </tr>
                                                                <tr><!---- Yes Condition pe ----->
                                                                    <th colspan="3"> Annual earnings from main business</th>
                                                                    <th colspan="3"> My personal earnings from all sources</th>
                                                                    
                                                                </tr>
                                                            <?php } elseif($work->work_situation =='free') { ?>
                                                            <tr>
                                                                <td>Free</td>
                                                                
                                                            </tr>
                                                            <?php } elseif($work->work_situation =='retired') { ?>
                                                                <tr>
                                                                    <td><?= $work->retired_department; ?></td>
                                                                    <td><?= $work->retired_post; ?></td>
                                                                    <td><i class="fa fa-calendar"></i> <?= $work->rtmnt_year; ?></td>
                                                                    <td><?= $work->m_r_pension; ?></td>
                                                                    <td><?= $work->r_annu_pension; ?></td>
                                                                    <td><?= $work->all_sources_amt; ?></td>
                                                                    
                                                                </tr>
                                                            <?php } ?>
                                                    </table>
                                                </td> 
                                            </tr>
                                            <tr>
                                                <th>My body's height</th>
                                                <td><?= $specials->hieght; ?></td>
                                                <th>My body's blood group</th>
                                                <td><?= $specials->blood_group; ?></td>
                                                <th>My body's color </th>
                                                <td><?= $specials->color; ?></td>
                                            <tr>
                                            <tr>
                                                <th colspan="6">My permanent address </th>
                                            </tr>
                                            <tr>
                                                <td colspan="6">House Number: <?= $IdByNormal->house_no; ?>,Ward number:<?= $IdByNormal->road_no; ?>,Post:<?= $IdByNormal->post_office; ?>,District:<?= $IdByNormal->district; ?> state:<?= $IdByNormal->state; ?> pincode:<?= $IdByNormal->pincode; ?>,My Country:<?= $IdByNormal->country; ?></td>
                                            </tr>
                                            <tr>
                                                
                                                
                                                <th colspan="2">Mobile Number</th>
                                                <td><?= $IdByNormal->contact_no; ?></td>
                                                <th colspan="2">Mama's Gautra</th>
                                                <td><?= $caste->maama_gautr; ?></td>
                                                
                                            </tr>
                                            <tr>
                                                <th colspan="6">My current home address </th>
                                            </tr>
                                            <tr>
                                                <td colspan="6">House Number: <?= $IdByNormal->house_no; ?>,Ward number:<?= $IdByNormal->road_no; ?>,Post:<?= $IdByNormal->post_office; ?>,District:<?= $IdByNormal->district; ?> state:<?= $IdByNormal->state; ?> pincode:<?= $IdByNormal->pincode; ?>,My Country:<?= $IdByNormal->country; ?></td>
                                            </tr>
                                            <tr>
                                                
                                                <th colspan="2">My contact number</th>
                                                <td><?= $IdByNormal->contact_no; ?></td>
                                                <th colspan="2"> My maternal grandfather's gautra</th>
                                                <td><?= $caste->maama_gautr; ?></td>
                                                
                                            </tr>
                                            <tr>
                                                <th colspan="2"> My maternal grandfather's kul </th>
                                                <td><?= $caste->maama_kul; ?></td>
                                                
                                            </tr> 
                                            <tr>
                                                <th colspan="2"> Related to my marriage</th>
                                                <td><?php if($IdByNormal->married_status=='Yes') { }?></td>
                                                <th colspan="2">My marriage status</th>
                                                <td><?php if($IdByNormal->ask_married=='Yes'){ echo 'Married'; } elseif($IdByNormal->ask_married=='No'){ echo 'Unmarried '; } ?></td>
                                            </tr>
                                        </table>
                    
                                        <table class="table table-striped">
                                                <tr>
                                                    <td><p><b>Body Color: </b><?= $special->color;?></p></td>
                                                    <td><p><b>Wight: </b><?= $special->wight;?></p></td>
                                                </tr>
                                                
                                                
                                            </table>
                                     <button class="btn btn-info" onclick="MarriageInfo('MarriagePrint')">Print</button>
                                </div>
                                <script>
                                        function MarriageInfo(divName) 
                                        {
                                            var printContents = document.getElementById(divName).innerHTML;
                                            var originalContents = document.body.innerHTML;
                                            document.body.innerHTML = printContents;
                                            window.print();
                                            document.body.innerHTML = originalContents;
                                        }
                                </script>
                                    <?php } else{ echo '<marquee><h4 style"color:red;"> Sorry! Profile Not Updated,Please,Update your Profile</h4></marquee>';}?>
                                </div> 
                            </div> 
                        </div>
                        <div class="panel panel-default"> 
                            <div class="panel-heading" style="background:#820506;color:#fff;"> 
                                <h4 class="panel-title portlet-title"> 
                                    <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseTwo-21" class="collapsed" aria-expanded="false">
                                       Caste president's Information 
                                    </a> 
                                </h4> 
                            </div> 
                            <div id="collapseTwo-21" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;"> 
                                <div class="panel-body">
                                    <?php if(!empty($president)) { ?>
                                     <div id="PresiPrint">
                                   <table class="table table-striped">
                                        <tr>
                                            <td><p><b>Name of the president of my caste: </b><?= $president->president_name;?></p></td>
                                            <td><p><b>Main mobile number of the president of my caste: </b><?= $president->president_mobile;?></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>Whatsapp number of the president of my caste: </b><?= $president->president_mobile_wht;?></p></td>
                                            <td><p><b>Address of the president of my caste: </b><?= $president->address;?></p></td>
                                        </tr>
                                        <tr>
                                            <td colspan='2'><p><b>photo of the president of the caste </b> 
                                                <?php
                                                    $presidentImg = unserialize($president->president_img);
                                                    
                                                    for ($i1 = 0; $i1 < count($presidentImg); $i1++) {

                                                        ?>
                                                    </b> <img src="<?=base_url('uploads/caste_president/') . $presidentImg[$i1];?>" name="" height="70" width="116" style="margin-top: 10px;">
                                                 <?php } ?>
                                            </p></td>
                                            
                                        </tr>
                                        <tr>
                                            <td><p><b>Name of the president of my society: </b><?= $president->society_name;?></p></td>
                                            <td><p><b>Main mobile number of the president of my society: </b><?= $president->president_mobile2;?></p></td>
                                        </tr>
                                        <tr>
                                            <td><p><b>Whatsapp number of the president of my society: </b><?= $president->wht_no_society;?></p></td>
                                            <td><p><b>Address of the president of my society: </b><?= $president->address_society;?></p></td>
                                        </tr>
                                        <tr>
                                            <td colspan='2'><p><b>photo of the president of the society </b> 
                                                <?php
                                                    $presidentImg2 = unserialize($president->img);
                                                    
                                                    for ($kk = 0; $kk < count($presidentImg2); $kk++) {

                                                        ?>
                                                    </b> <img src="<?=base_url('uploads/caste_president/') . $presidentImg2[$kk];?>" name="" height="70" width="116" style="margin-top: 10px;">
                                                 <?php } ?>
                                            </p></td>
                                            
                                        </tr>
                                    </table>
                                     <button class="btn btn-info" onclick="PresiInfo('PresiPrint')">Print</button>
                                </div>
                                <script>
                                        function PresiInfo(divName) 
                                        {
                                            var printContents = document.getElementById(divName).innerHTML;
                                            var originalContents = document.body.innerHTML;
                                            document.body.innerHTML = printContents;
                                            window.print();
                                            document.body.innerHTML = originalContents;
                                        }
                                </script>
                                    <?php } else{ echo '<marquee><h4 style"color:red;"> Sorry! Profile Not Updated,Please,Update your Profile</h4></marquee>';}?>
                                </div> 
                            </div> 
                        </div> 
                        
                    </div> 
                </div>
                
            </div>
            
        </div>
    </div>
</div>
<script>
        function printDiv()
        {
         window.frames["print_frame"].document.body.innerHTML = document.getElementById("printableTable").innerHTML;
         window.frames["print_frame"].window.focus();
         window.frames["print_frame"].window.print();
       }
       
</script>