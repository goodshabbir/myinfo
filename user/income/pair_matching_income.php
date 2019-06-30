<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title">Pair Matching Income</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title"><b>Pair Matching Income</b></h4>
            <p class="text-muted font-13 m-b-30">
 
            </p>
            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                   width="100%">
                <thead>
                <tr>
                    <th>S.No.</th>
                    <th>On Closing</th>
                    <th>Total Pair</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Released Date</th>
                </tr>
              </thead>
                <tbody>
                  <?php $i=1; foreach($pairmatch as $row): ?>
                  <tr>
                      <td><?= $i++; ?></td>
                      <td><?= date('d-m-Y', strtotime($row->on_closing)); ?></td>
                      <td><?= $row->pair ?></td>
                      <td><?= $row->amount; ?></td>
                      <td><?php if($row->status==0){ echo "<span class='label label-danger'>Pending</span>"; } else { echo "<span class='label label-success'>Success</span>"; } ?></td>
                      <td><?php if($row->status==0){ echo "<span class='label label-warning'>Yet not released</span>"; } else{ echo date('M d, Y', strtotime($row->released_date)); } ?></td>
                  </tr>

                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
      <?php echo $this->pagination->create_links(); ?>
    </div>
</div>
