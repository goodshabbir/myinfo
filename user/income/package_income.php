<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title">Package Income</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title"><b>Package Income</b></h4>
            <p class="text-muted font-13 m-b-30">

            </p>
            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                   width="100%">
                <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Amount</th>
                    <th>Duration</th>
                    <th>Elapse Time</th>
                    <th>Remaining Time</th>
                    <th>History</th> 
                </tr>
              </thead>
                <tbody>
                  <?php $i=1; foreach($packageIncome as $row): ?>
                  <tr>
                      <td><?= $i++; ?></td>
                      <td><?= $row->amount; ?></td>
                      <td><?= $row->duration; ?></td>
                      <td><?= $row->elapse_time; ?></td>
                      <td><?= $row->remaning_time; ?></td>
                      <td><a href="javascript:;" onclick="showDetails(<?= $row->id ?>,<?= $row->special_amount_id ?>);">Click</a></td>
                  </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
      <?php echo $this->pagination->create_links(); ?>
    </div>
</div>

<div id="custom-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width:55%;">
        <div id="resultt"></div>
    </div><!-- /.modal-dialog -->
</div>

<script>

  function showDetails(id,pid){
    $.ajax({
      url:'<?= site_url('history');?>',
      dataType: 'json',
      type: 'POST',
      data:{rowid:id, packid:pid},
      success: function(result){
      
        $("#resultt").html(result.table);
      },
      error: function(result){
        $.Notification.notify('error','top-right','Something went wrong please contact to support');
      }
    });
    $("#custom-width-modal").modal('show');
  }
</script>
