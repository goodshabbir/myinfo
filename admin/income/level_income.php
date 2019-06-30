
    <link href="<?= BASEURL; ?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    
    <link href="<?= BASEURL; ?>assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= BASEURL; ?>assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    
    <link href="<?= BASEURL; ?>assets/plugins/datatables/dataTables.colVis.css" rel="stylesheet" type="text/css"/>
    <link href="<?= BASEURL; ?>assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= BASEURL; ?>assets/plugins/datatables/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css"/>
<div class="container">
    <div class="row">
    	 <div class="col-sm-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title"><b>Step Income Member list</b></h4>
              
                <table id="datatable-buttons" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Sponsor Id</th>
                        <th>Level</th>
                        <th>User Info</th>
                        <th>Generated Date</th>
                        <th>Income</th>
                        <th>On Month</th>
                        <th>Behalf Of User</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $j=1;foreach($Lincome as $row) : 
                        $userInfo=unserialize($row->behalf_of);
                        ?>
                    <tr> 
                        <td><?= $j++; ?></td>  
                        <td><?= $row->sponsor_id; ?></td>
                        <td><?= $row->level; ?></td>
                        <td><strong>Name:<strong> <?= $row->full_name; ?><br><strong>Mobile:</strong> <?= $row->mobile; ?><br><strong>Email:</strong> <?= $row->email; ?></td>
                        <td><?=  $row->create_at;?></td>
                        <td><i class="fa fa-inr"></i> <?= $row->level_income; ?></td>
					   <td>
					   <?php
							 $IndaiDate = new DateTime($row->on_month);
							$setDateTime = $IndaiDate->format("d-Y");
                            echo $setDateTime;
                           
					   ?>
					   </td>
                      <td class="button-demo js-modal-buttons">
                            <div class="modal fade" id="mdModal3<?= $row->id;?>" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="">
                                            <h3 class="modal-title" id="defaultModalLabel"> Behalf Of User Information</h3>
                                        </div>
                                        <div class="modal-body" >
                                        <div class="col-md-12 body">
                                       
                                        <table style="width:100%">
                                        <?php foreach($userInfo as $member) { ?>
                                            <tr>
                                                <th>Member Name:</th>
                                                <td><?= $member['member_name'];?></td>
                                            </tr>
                                            <tr>
                                                <th>Sponsor Id</th>
                                                <td><?= $member['sponsor_id'];?></td>
                                            </tr>
                                            <tr>
                                                <th>Amount</th>
                                                <td><i class="fa fa-inr"></i> <?= $member['purchase_amount'];?></td>
                                            </tr>
                                            <tr>
                                                <th>On Date</th>
                                                <td><?= $member['on_date'];?></td>
                                            </tr>
                                        <?php } ?>
                                             
                                            </table>    

                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                                <button type="button" class="btn btn-pink waves-effect" data-dismiss="modal" >CLOSE</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <button type="button" data-color="purple"data-toggle="modal" data-target="#mdModal3<?= $row->id;?>" class="btn btn-pink btn-custom btn-rounded waves-effect waves-light">Get Info</button>
                        </td>
                       <td>
                          <?php if($row->status ==0){echo '<span class="btn btn-pink waves-effect waves-light btn-xs">Pending</span>';}elseif($row->status==1){echo '<span class="btn btn-success waves-effect waves-light btn-xs">Released</span>';} ?>  
                       </td>
                       <td>
                           <form method="post" action="<?= site_url('admin/changestatus/'.$row->id); ?>" >
                                <select name="status" style="text-align:center;background-color: #71bf0b;color: white;font-size: 13px;border-radius: 60px;font-weight: 600;padding: 2px;"  onchange="this.form.submit();" >
                                    <option value="" style="background-color:violet ;text-align:center;border-radius: 60px;font-weight: 600;padding: 2px;" >Select Status</option>
                                    <!--<option value="0" style="background-color:red;text-align:center;border-radius: 60px;font-weight: 600;padding: 2px;"<?php if($row->status == 0){ echo "selected='seleceted'";  } ?> >Pending</option>-->
                                    <option value="1" style="background-color:green;text-align:center;border-radius: 60px;font-weight: 600;padding: 2px;" <?php if($row->status == 1){ echo "selected='seleceted'";  } ?>>Release</option>
                                </select>
                            </form> 
                       <td>
                    </tr> 
                   
            <?php endforeach;  ?> 
                    </tbody>
                </table>
        <?php //} else{ echo "<h3><span class='text-danger'>Not Any Posted Blog</span></h3>";} ?>
            </div>
        </div>
    </div>
 
</div> <!-- container -->

        </div> <!-- content -->

    </div>
   
</div>
<script>
    var resizefunc = [];
</script>
<!-- jQuery  -->
<script src="<?= BASEURL; ?>assets/js/jquery.min.js"></script>
<script src="<?= BASEURL; ?>assets/js/bootstrap.min.js"></script>
<script src="<?= BASEURL; ?>assets/js/detect.js"></script>
<script src="<?= BASEURL; ?>assets/js/fastclick.js"></script>
<script src="<?= BASEURL; ?>assets/js/jquery.slimscroll.js"></script>
<script src="<?= BASEURL; ?>assets/js/jquery.blockUI.js"></script>
<script src="<?= BASEURL; ?>assets/js/waves.js"></script>
<script src="<?= BASEURL; ?>assets/js/wow.min.js"></script>
<script src="<?= BASEURL; ?>assets/js/jquery.nicescroll.js"></script>
<script src="<?= BASEURL; ?>assets/js/jquery.scrollTo.min.js"></script>

<script src="<?= BASEURL; ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= BASEURL; ?>assets/plugins/datatables/dataTables.bootstrap.js"></script>

<script src="<?= BASEURL; ?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="<?= BASEURL; ?>assets/plugins/datatables/buttons.bootstrap.min.js"></script>
<script src="<?= BASEURL; ?>assets/plugins/datatables/jszip.min.js"></script>
<script src="<?= BASEURL; ?>assets/plugins/datatables/pdfmake.min.js"></script>
<script src="<?= BASEURL; ?>assets/plugins/datatables/vfs_fonts.js"></script>
<script src="<?= BASEURL; ?>assets/plugins/datatables/buttons.html5.min.js"></script>
<script src="<?= BASEURL; ?>assets/plugins/datatables/buttons.print.min.js"></script>
<script src="<?= BASEURL; ?>assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
<script src="<?= BASEURL; ?>assets/plugins/datatables/dataTables.keyTable.min.js"></script>
<script src="<?= BASEURL; ?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="<?= BASEURL; ?>assets/plugins/datatables/responsive.bootstrap.min.js"></script>
<script src="<?= BASEURL; ?>assets/plugins/datatables/dataTables.scroller.min.js"></script>
<script src="<?= BASEURL; ?>assets/plugins/datatables/dataTables.colVis.js"></script>
<script src="<?= BASEURL; ?>assets/plugins/datatables/dataTables.fixedColumns.min.js"></script>

<script src="<?= BASEURL; ?>assets/pages/datatables.init.js"></script>



<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable').dataTable();
        $('#datatable-keytable').DataTable({keys: true});
        $('#datatable-responsive').DataTable();
        $('#datatable-colvid').DataTable({
            "dom": 'C<"clear">lfrtip',
            "colVis": {
                "buttonText": "Change columns"
            }
        });
        $('#datatable-scroller').DataTable({
            ajax: "<?= BASEURL; ?>assets/plugins/datatables/json/scroller-demo.json",
            deferRender: true,
            scrollY: 380,
            scrollCollapse: true,
            scroller: true
        });
        var table = $('#datatable-fixed-header').DataTable({fixedHeader: true});
        var table = $('#datatable-fixed-col').DataTable({
            scrollY: "300px",
            scrollX: true,
            scrollCollapse: true,
            paging: false,
            fixedColumns: {
                leftColumns: 1,
                rightColumns: 1
            }
        });
    });
    TableManageButtons.init();

</script>

</body>
</html>
