
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
                <h4 class="m-t-0 header-title"><b>ePin History</b></h4>
              
                <table id="datatable-buttons" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Cr Sponsor</th>
                        <th>To User</th>
                        <th>ePin Info</th>
                        <th>Transfer Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $j=1;foreach($epin as $row) : 
                        $epinInfo=unserialize($row->no_of_epin);
                        ?>
                    <tr> 
                        <td><?= $j++; ?></td>  
                        <td>
                            Sponsor: <?= $row->from_user; ?><br>Name: <?= $row->full_name; ?>
                        </td>
                        <td><?= $row->to_user; ?></td>
                        <td class="button-demo js-modal-buttons">
                            <div class="modal fade" id="mdModal3<?= $row->id;?>" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="">
                                            <h3 class="modal-title" id="defaultModalLabel"> Transfer ePin History</h3>
                                        </div>
                                        <div class="modal-body" >
                                        <div class="col-md-12 body">
                                       
                                        <table id="datatable-buttons" class="table table-striped table-bordered table-hover">
                                         <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>ePin Code:</th>
                                                <th>ePin Price</th>
                                            </tr>
                                            </thead>
                                        <?php $saba=1; foreach($epinInfo as $pin) { ?>
                                       
                                            <tbody>
                                            <tr>
                                                 <td><?= $saba++;?></td>
                                                <td><?= $pin['epincode'];?></td>
                                                <td><i class="fa fa-inr"></i> <?= $pin['price'];?></td>
                                            </tr>
                                            </tbody>
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
                        <button type="button" data-color="purple"data-toggle="modal" data-target="#mdModal3<?= $row->id;?>" class="btn btn-pink btn-custom btn-rounded waves-effect waves-light">Get ePin Info</button>
                        </td>
                        <td><?= $row->transfer_date; ?></td>
					  
                    </tr>
                   
            <?php endforeach;  ?> 
                    </tbody>
                </table>
        <?php //} else{ echo "<h3><span class='text-danger'>Not Any Posted Blog</span></h3>";} ?>
            </div>
        </div>
    </div>
    
    <!-- end row -->


</div> <!-- container -->

        </div> <!-- content -->

    </div>
    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->


   
</div>
<!-- END wrapper -->

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
