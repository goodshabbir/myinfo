
<div class="container">
<div class="row">
  <div class="col-sm-12">
    <div class="card-box">
        <h4 class="page-title"><a href="view_slider" class="btn btn-pink btn-custom btn-rounded waves-effect waves-light"> View Slider</a></h4>
            <h3>Impartent Tips:</h3>
						<p class="tips" style="color:red">slider Standard Image resolution is 1920 * 600.</p>
						<p class="tips" style="color:red">slider Image size should not be greater than 1 MB .</p>
						<p class="tips" style="color:red">always use same resolution for all images of slider.</p>
						<p><a href="<?= BASEURL;?>/uploads/slider/dummy.png" download>Download Click to Image</a></p>
						<a href="<?= BASEURL;?>/uploads/slider/dummy.png" download><img  src="<?= BASEURL;?>/uploads/slider/dummy.png" width="100%" height="300px" /></a>
						
        </div>
    </div>
  </div>
	<div class="col-sm-12">
	
		<div class="card-box">
			<div class="row">
				<form method="post" action="<?= site_url('admin/add_slider'); ?>" enctype="multipart/form-data">
				<!-- <div class="col-md-12">
					<div class="form-group">
							<label for="exampleInputPassword15">Slider Top Heading</label>
						<textarea type="text" name="slider_tagline" class="form-control"></textarea>
							<span class="text-danger"></span>
					</div>
			</div>
			<div class="col-md-12">
					<div class="form-group">
							<label for="exampleInputPassword15">Slider Second Heading</label>
							<textarea type="text" name="description" class="form-control" ></textarea>
							<span class="text-danger"></span>
					</div>
			</div>
				<div class='col-lg-12'>
						<div class="form-group input_fields_wrap">
							<label for="">Slider Image</label>
							<button class="add_field_button btn btn-info" style="margin-left: 246px; margin-bottom:-15px;">Add More</button>
							<input type="file" name="img[]" class="form-control " style="margin-top:-19px;">
							
						</div>
					</div> -->
					<div class="" id="articles">
							<div class="col-md-4"> 
								<label style="margin-top: 8px;">Slider Image</label>
								<input type="file"class="form-control" name="img[]" class="form-control name_list"  />
								<span class="text-danger"><?php //= form_error('img');?></span></span>
							</div>
							<div class="col-md-8">
								<label style="margin-top: 8px;">Slider Top Heading</label>
								<input type="text" class="form-control" name="slider_tagline[]"  />
								<span class="text-danger"><?php //= form_error('slider_tagline');?></span>
							</div>
							<div class="col-md-12"> 
								<label style="margin-top: 8px;">Slider Second Heading</label>
								<input type="text" class="form-control" name="description[]"  class="form-control name_list" />
								<span class="text-danger"><?php //= form_error('description');?></span>
							</div>
					</div>
                    
					<div class='col-lg-12'>
						<div class="form-group text-left m-b-0">
						 <button type="button" name="add" id="add" class="btn btn-danger" style="margin-top: 15px;">Add More</button>
							<button type="submit" class="btn btn-pink waves-effect waves-left"  style="margin-top: 15px;">
								<?='Add Slider'?>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	
	</div>
	</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
        var i = 1;
		var max_field      = 6;
        $('#add').click(function() {
            i++;
			if(i < max_field){
            $('#articles').append('<hr><div id="row' + i + '"><div class="col-md-4"><label style="margin-top: 8px;">Slider Image</label><input type="file" id="quantity" name="img[]"  class="form-control name_list" /></div> <div class="col-md-8"><label style="margin-top: 8px;">Slider Top Heading</label><input type="text" id="price" name="slider_tagline[]"   class="form-control name_list" /></div> <div class="col-md-10"><label style="margin-top: 8px;">Slider Second Heading</label><input type="text" id="" name="description[]" class="form-control name_list" /></div> <div class="col-md-2" ><button style="margin-top:26px;" type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></div></tr>');
			}
			else{
				alert('Sorry! 5 Images Uploaded,your limit are end');
			}
	    });

        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });

    });



	$(document).ready(function() {
    var max_fields      = 5; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><input type="file" class="form-control" name="img[]"/><a href="#" class="remove_field" slyle="margin-left: 268px; color:red"><i class="fa fa-close" ></i></a></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});

</script>