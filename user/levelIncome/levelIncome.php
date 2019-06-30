<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title">Level Income</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title"><b>User Level Income</b></h4>
            <p class="text-muted font-13 m-b-30">
            </p>
            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                   width="100%">
                <thead>
                <tr>
                    <th>S.No.</th>
                    <th>User Id</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Level</th>
                    <th>For Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                  <?php $levelincome= array(); $i=1; foreach($levelincome as $row): ?>
                  <tr>
                      <td><?= $i++; ?></td>
                      <td><?= $row->user_id; ?></td>
                      <td><?= $row->first_name. " ".$row->last_name ?></td>
                      <td><?= $row->amount; ?></td>
                      <td><?= $row->level; ?></td>
                      <td><?= $row->closing_date; ?></td>
                      <td><?php if($row->status==0){ echo "<lable class='label label-danger'>Pending<lable>"; } else { echo "<label class='label label-success'>Relesead</label>"; } ?></td>
                      <td><?= anchor(site_url('admin/levelincome'),'Go Release' ,'class="label label-warning"'); ?></td>
                  </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
