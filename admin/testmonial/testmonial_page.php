
<div class="row">

	<div class="col-sm-12">
		
		<div class="card-box table-responsive">
			<h4 class="m-t-0 header-title"><b>Testmonial</b></h4>			
				<form action="<?= site_url('admin/addtestmonial'); ?>" method="post" enctype="multipart/form-data" >
				<?php if(isset($_GET['error']))
					{
						echo "<h3 style='color:red'>Sorry,Image Format Wrong</h3>";
					}
				?>
					<div class='col-lg-6'>
						<div class="form-group">
							<label for="">Full Name<span class="error">*</span></label>
							<input type="text"  name="client_name"  class="form-control" value="<?= set_value('client_name');?>" placeholder="Enter Full Name">
								
							<span class="error"><?php echo form_error('client_name'); ?></span>
						</div>
					
					</div>
					<div class='col-lg-6'>
						<div class="form-group">
							<label for="">Designation<span class="error">*</span></label>
							<input type="text"  name="position"  class="form-control" vvalue="<?= set_value('position');?>" placeholder="Enter Company Position">
								
							<span class="error"><?php echo form_error('position'); ?></span>
						</div>
					</div>
					<div class='col-lg-4'>
						<div class="form-group">
							<label for="">State</label>
							<!-- <select name="state" class="form-control" onchange="Getcites(this.value);">
                                <option>Select State</option>
                                <?php  foreach ($state as $rows) {?>                          
                                <option value="<?= $rows->name ?>"><?= $rows->name ?></option>
                                </option>
                                <?php }?>
                             </select> -->
							 <input type="text"  name="state"  class="form-control" value="<?= set_value('state');?>" placeholder="Enter state">
							<span class="error"><?php echo form_error('state'); ?></span>
						</div>
					</div>
					<div class='col-lg-4'>
						<div class="form-group">
							<label for="">City</label>
							<!-- <select name="city" class="form-control" id="showCity">
                               <option value=""></option>
                             </select> -->
							<input type="text"  name="city"  class="form-control" value="<?= set_value('city');?>" placeholder="Enter city">	
							<span class="error"><?php echo form_error('city'); ?></span>
						</div>
					</div>
					<div class='col-lg-4'>
						<div class="form-group">
							<label for="">Upload Image<span class="error">*</span></label>
							<input type="file"  name="img[]" accept="image/*" class="form-control" value="" required>
								
							<span class="error"><?php echo form_error('img'); ?></span>
						</div>
					</div>
					<div class='col-lg-12'>
						<div class="form-group">
							<label for="">Testmonial Description<span class="error">*</span></label>
							<textarea type="text" name="description" class="form-control"><?= set_value('description');?></textarea>
							<span class="error"><?php echo form_error('description'); ?></span>
						</div>
					</div>
					<div class='col-lg-12'>
					<div class="form-group text-left m-b-0">
						<button class="btn btn-pink waves-effect waves-left" type="submit">
							Add
						</button>
					</div>
					</div>
				</form>
			</div>
		</div>
		</div>
</div>
<div class="container">
	<!-- Page-Title -->
	<div class="row">
<div class="col-sm-12">
		<div class="card-box">
		
			<div class="row">
				<div class="col-lg-12">
					<h4 class="m-t-0 header-title"><b>Testmonial</b></h4>
					<div class="p-20">
						<div class="table-responsive">
						<?php if(!empty($testData)) { ?>
							<table class="table m-0">
								<thead>
									<tr>
										<th>#</th>
										<th>Client Name</th>
										<th>Position</th>
										<th>Description</th>
										<th>Image</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $j=1; foreach($testData as $row){ ?>
								  <tr>
									<td><?php echo $j++; ?></td>
									<td><?=  $row->client_name; ?></td>
									<td><?=  $row->position; ?></td>
									<td>
										<?php 
										 $img = unserialize($row->img); 
												for($i=0; $i<count($img);$i++){
										?>
											<img src="<?= base_url('uploads/testmonial/').$img[$i]; ?>" width="200" height="150">
										<?php } ?></td>
									<td>" <?=  $row->description; ?>" </td>
									<td>
										<a href="<?php echo site_url('admin/delete_testmonial?id='.base64_encode($row->id)); ?>" class="pr-10" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
									</td>
								  </tr>
								  <?php } ?>
								</tbody>
							</table>
								<?php } else{ echo '<h3 style="color:red">Testmonial Data Not Found</h3>';}?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<script>
	function Getcites(id)
	{
		$.ajax({
				url: '<?=site_url('admin/getAllCity/')?>'+id,
				success:function(result)
				{
					$('#showCity').html(result);
				}
			});
	}
</script>