
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
                <h4 class="m-t-0 header-title"><b>User's Multiple ID' Information</b></h4>
              
                <table id="datatable-buttons" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>User ID </th>
                        <th>User Name </th>
					   	<th>User Mobile No.</th>
						<th>ID's Total </th>
						<th>Registered ID's Total </th>
                        <th>Free ID's Total</th>
                        
                    </tr>
                    </thead>
                    <tbody>
                    <?php $j=1;foreach($user as $row) : 
                        
                        ?>
                    <tr> 
                        <td><?= $j++; ?></td>  
                        <td><?= $row->sponsor_id; ?></td>
                        <td> <?= $row->full_name; ?></td>
                        <td> <?= $row->mobile; ?></td>
                        <td><?= $row->email; ?></td>
                        <td>
                                <?php
                                    $IndaiDate = new DateTime($row->create_at);
                                    $setDateTime = $IndaiDate->format("d-m-Y h:i:s a");
                                    echo $setDateTime;
                                ?>
                          
                        </td>
                        <td></td>
                        
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
