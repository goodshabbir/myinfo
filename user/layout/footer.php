<?php $id=$this->session->userdata['user']['id'];

$obj= new welcome_model();

$record=$obj->getsinglerow(TBL_USER,['id' => $id]);
$notes=$obj->getsinglrowLimit('impartent_note',[]);

?>
<h3 style="color:red;"><marquee><?=$notes->description; ?>।</marquee></h3>
© 2018. All rights reserved. <?php if($record->last_login!='') { ?> Last Login :- <?= date('M d, Y h:i a',strtotime($record->last_login)); } ?>

<div class="container">

    <div class="modal fade" id="myModal" role="dialog">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-body">

                    <div id="imgResult"></div>

                </div>

                <div class="modal-footer">

                    <button type="button" data-dismiss="modal"><label class="label label-danger">Close</label></button>

                </div>

            </div>

        </div>

    </div>

</div>
<script type="text/javascript">

    function googleTranslateElementInit() {

        new google.translate.TranslateElement({ pageLanguage: 'en' }, 'google_translate_element');

    }

</script>



<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<script>

     function showImage(id) {

         $.ajax({

             url: '<?php echo site_url('user/showImage/'); ?>'+id,

             success: function(result)

             {

                 $("#imgResult").html(result);

             }

         });

           $("#myModal").modal('show');

     }

 </script>