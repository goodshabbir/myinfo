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
         <?php $active = 0; $pending = 0;  foreach($mydownline as $row): if($row->status==1) { $active++; } if($row->status==0) { $pending++; } endforeach; ?>
            <h4 class="m-t-0 header-title"><b>My Dwonline : Total Member <?= count($mydownline) ?></b> Total Active <?= $active ?> Total Pending <?= $pending ?></h4>
            <table id="datatable-buttons" class="table table-striped table-bordered table-hover">
               <thead>
                  <tr>
                  <th>#</th>
                     <th>Name</th>
                     <th>Sponsor ID</th>
                     <th>Joining Date</th>
                     <th>Placement</th>
                     <th>Status</th>
                  </tr>
               </thead>
               <tbody>
                  <?php if(!empty($mydownline)) { $i=1; foreach($mydownline as $row): if($row->status==1) { $active++; } if($row->status==0) { $pending++; }?>
                  <tr>
                     <td><?= $i++; ?></td>
                     <td><?= $row->full_name ?></td>
                     <td><?= $row->sponsor_id ?></td>
                     <td><?= date('M d, Y',strtotime($row->create_at)); ?></td>
                     <td><?= $row->position ?></td>
                     <td><?= $row->status==1 ? "<span class='label label-success'>Active</span>" : "<span class='label label-danger'>Pending</span>" ?></td>
                  </tr>
                  <?php  endforeach; } else { echo "<tr><td colspan='5'> No! Record Found</td></tr>"; } ?> 
               </tbody>
            </table>
            <?php //} else{ echo "<h3><span class='text-danger'>Not Any Posted Blog</span></h3>";} ?>
         </div>
      </div>
   </div>
   <!-- end row -->
</div>
<!-- container -->
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
<!-- jQuery -->
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