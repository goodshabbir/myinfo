<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title">Download Your Payout</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title"><b>Download Payout list</b><a href="javascript:;" class="label label-success" style="float:right;" onclick="downloadall('<?= $this->session->userdata['user']['user_id'] ?>')">Download All</a></h4>
            <p class="text-muted font-13 m-b-30">
 
            </p>
            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                   width="100%">
                <thead>
                <tr>
                    <th>S.No.</th>
                    <th>On Closing</th>
                    <th>Download</th>
                    
                </tr>
              </thead>
                <tbody>
                  <?php  $i=1; foreach($closingDate as $row): ?>
                  <tr>
                      <td><?= $i++; ?></td>
                      <td><?= date('d-m-Y', strtotime($row->closing_date)); ?></td>
                      <td><a href="javascript:;" onclick="downloadList('<?= date('Y-m-d',strtotime($row->closing_date)) ?>','<?= $this->session->userdata['user']['user_id'] ?>')">Download</a></td>
                  </tr>

                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
      <?php echo $this->pagination->create_links(); ?>
    </div>
</div>

<script>
function downloadList(date,spoID){
    $.ajax({
        url:'<?= site_url('income/checkIsEligible');?>',
        type: 'POST',
        data: { date: date,sponsor_id: spoID },
        success: function(result){
             if(result==1){
                 window.location.href='<?= site_url('payoutDownload?spoid=')?>'+spoID+'&date='+date;
             }else{
                 $.Notification.notify('error','top-right','Sorry! dont have a record here behalf of closing date and sponsor id');
             }
        },error: function(result){
            $.Notification.notify('error','top-right','Opps! something went wrong');
        }
    });
}
function downloadall(spoid){
    $.ajax({
        url: '<?= site_url('income/eligibleforall')?>',
        type:'POST',
        data:{ id: spoid },
        success: function(result){
            if(result==1){
                window.location.href='<?= site_url('income/fullpayout?spoid=')?>'+spoid;
            }else{
                $.Notification.notify('error','top-right','Sorry! dont have a record here behalf of closing date and sponsor id');
            }
        },error: function(result){
            $.Notification.notify('error','top-right','Opps! something went wrong');
        }
    });
}
</script>
