<?php
//print_r($this->session->userdata['user']); die;

$id = $this->session->userdata['user']['id'];

$obj = new welcome_model();

$record = $obj->getsinglerow(TBL_USER, ['id' => $id]);
// print_r($My_Sponsor_User_ID);die;
// echo '<pre>';print_r($record);die;
?>
<div class="container">
    <!-- Page-Title -->
    
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
 <div class="row">
        <div class="col-sm-12">
		<h4 class="page-title">Marriage Profile-Match</h4>
        </div>
    </div>
   <div class="row">
    <div class="col-sm-12" align="center">
        <form id='form-id'>
            <div class="radio radio-info radio-inline">
                <input id='watch-me' name='test' type='radio' />
                <label for="inlineRadio1">  I want to show this biodata - In my caste  </label>
            </div>
            <div class="radio radio-pink radio-inline">
                <input id='see-me' name='test' type='radio' />
                <label for="inlineRadio1">   In other caste too </label>
            </div>
            <!-- <div class="radio radio-perpul radio-inline">
                <input id='look-me' name='test' type='radio' /> 
                <label for="inlineRadio1">  In my caste </label>
            </div> -->
        </form>
        <br><br>
        <div id='show-me' style='display:none; border:2px solid #ccc'>
           <div class="panel panel-default m-t-20">
                <div class="panel-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mails m-0">
                            <tbody>                   
                                <tr class="unread">
                                    <td class="mail-select">
                                        <div class="checkbox checkbox-primary m-r-15">
                                            <input id="checkbox1" type="checkbox">
                                            <label for="checkbox1"></label>
                                        </div>
                                        <div class="comment">
                                            <img src="<?= base_url();?>assets/images/users/avatar-1.jpg" alt="" class="comment-avatar">
                                        </div>
                                    </td>        
                                    <td>
                                    bvb
                                    </td> 
                                    <td>
                                    b
                                    </td> 
                                    <td>
                                    v
                                    </td>  
                                    <td class="hidden-xs">
                                    f
                                    </td>
                                    <td style="width: 20px;">
                                         <a href="<?= record;?>" class="email-msg"><i class="fa fa-eye"></i></a>                                     </td>                           
                                </tr>
                        
                            </tbody>
                        </table>
                    </div>       
                </div> <!-- panel body -->
            </div> <!-- panel -->  
        </div>
        <div id='show-me-two' style='display:none; border:2px solid #ccc'>
            <div class="panel panel-default m-t-20">
                <div class="panel-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mails m-0">
                            <tbody>                   
                                <tr class="unread">
                                    <td class="mail-select">
                                        <div class="checkbox checkbox-primary m-r-15">
                                            <input id="checkbox1" type="checkbox">
                                            <label for="checkbox1"></label>
                                        </div>
                                        <div class="comment">
                                            <img src="<?= base_url();?>assets/images/users/avatar-1.jpg" alt="" class="comment-avatar">
                                        </div>
                                    </td>        
                                    <td>
                                    Sdd
                                    </td> 
                                    <td>
                                    XXs
                                    </td> 
                                    <td>
                                    vDD
                                    </td>  
                                    <td class="hidden-xs">
                                    FF
                                    </td>
                                    <td style="width: 20px;">
                                        <a href="<?= record;?>" class="email-msg"><i class="fa fa-eye"></i></a>                                    </td>                           
                                </tr>
                        
                            </tbody>
                        </table>
                    </div>       
                </div> <!-- panel body -->
            </div> <!-- panel -->  
        </div>
        <!-- <div id='show-me-three' style='display:none; border:2px solid #ccc'>
            
        </div> -->
          
 </div>
</div>
<script>
$(document).ready(function () 
 { 
  $("#watch-me").click(function()
  {
    $("#show-me:hidden").show('slow');
   $("#show-me-two").hide();
   $("#show-me-three").hide();
   });
   $("#watch-me").click(function()
  {
    if($('watch-me').prop('checked')===false)
   {
    $('#show-me').hide();
   }
  });
  
  $("#see-me").click(function()
  {
    $("#show-me-two:hidden").show('slow');
   $("#show-me").hide();
   $("#show-me-three").hide();
   });
   $("#see-me").click(function()
  {
    if($('see-me-two').prop('checked')===false)
   {
    $('#show-me-two').hide();
   }
  });
  $("#look-me").click(function()
  {
    $("#show-me-three:hidden").show('slow');
   $("#show-me").hide();
   $("#show-me-two").hide();
   });
   $("#look-me").click(function()
  {
    if($('see-me-three').prop('checked')===false)
   {
    $('#show-me-three').hide();
   }
  });
  
 });

</script>
   
</div><!-- End row -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
    var max_fields      = 5;
    var wrapper         = $(".container1_kund");
    var add_button_kund      = $(".add_form_field_kund");
  
    var x = 1;
    $(add_button_kund).click(function(e){
        e.preventDefault();
        if(x < max_fields){
            x++;
            $(wrapper).append('<div><input type="file" name="marriage_profile[]" class="form-control" style="padding: 10px; margin: 10px 0px 12px 0px;"><i class="delete fa fa-trash text-danger"></i></div>'); //add input box
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