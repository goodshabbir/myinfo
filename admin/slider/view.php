<div class="row">
<div class="col-sm-12">
<div class="card-box">
    <div class="row">
        <div class="col-lg-12">
            <h4 class="m-t-0 header-title"><b>Slider List</b></h4>
            <br>
            <a href="sliders" class="btn btn-pink btn-custom btn-rounded waves-effect waves-light">Add Slider</a>
            <div class="p-20">
            <?php if(!empty($slider)) { ?>
                <table class="table m-0">
                    
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Top Tag Line</th>
                            <th>Description</th>
                            <th class="text-center">Slider Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $j=1;foreach($slider as $row) :
                    
                        ?>
                        <tr>
                            <td><?= $j++; ?></td>
                            <td>
                               <?= $row->slider_tagline; ?>
                            
                        </td>
                            <td>
                                <?= $row->description; ?>  
                            </td>
                            <td class="col-md-12">
                                <?php $i=1; $img = unserialize($row->slider_img);
                                    for ($i = 0; $i < count($img); $i++) {
                                 ?>
										<div class="col-md-4"><img src="<?php echo base_url('uploads/slider/') . $img[$i]; ?>" style="width:230px;margin-top: 5px;"></div>
								<?php }?>
                            
                            </td>
                            <td>
                                <a href="<?php echo site_url('admin/delete_slider?id=' . $row->id);?>"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php } else{ ?>
                <h3 style="color:red;">Slider Not Found..</h3>
            <?php } ?>
            </div>

        </div>
      
    </div>
</div>
</div>
</div>