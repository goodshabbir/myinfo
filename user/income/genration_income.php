<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title">Genration Income</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title"><b>Genration Income</b></h4>
            <p class="text-muted font-13 m-b-30">

            </p>
            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                   width="100%">
                <thead>
                <tr>
                    <th>S.No.</th>
                    <th>On Closing</th>
                    <th>Amount</th>
                    <th>Total Member</th>
                    <th>Member List</th>
                    <th>Status</th>
                    <th>Released Date</th>
                </tr>
              </thead>
                <tbody>
                  <?php $directIncome= array(); $i=1; foreach($directIncome as $row): ?>
                  <tr>
                      <td><?= $i++; ?></td>
                      <td><?= date('d-m-Y', strtotime($row->on_closing)); ?></td>
                      <td><?php if($row->status==0){ echo "<span class='label label-danger'>Pending</span>"; } else { echo $row->amount; }?></td>
                      <td><?= $row->member_count; ?></td>
                      <td><a href="javascript:;" data-toggle="modal" data-target="#tabs-modal-<?= $row->id ;?>" class="label label-info">View</a></td>
                      <td><?php if($row->status==0){ echo "<span class='label label-danger'>Pending</span>"; } else { echo "<span class='label label-success'>Success</span>"; } ?></td>
                      <td><?php if($row->status==0){ echo "<span class='label label-warning'>Yet not released</span>"; } else{ date('M d, Y', strtotime($row->paid_date)); } ?></td>
                  </tr>

                  <!--====================================modal start ========================================-->
                  <div id="tabs-modal-<?= $row->id ;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                      <div class="modal-dialog">
                          <div class="modal-content p-0">

                              <ul class="nav nav-tabs navtab-bg nav-justified">
                                  <li class="">
                                      <a href="#home-2-<?= $row->id ;?>" data-toggle="tab" aria-expanded="true">
                                          <span class="visible-xs"><i class="fa fa-home"></i></span>
                                          <span class="hidden-xs">Active List</span>
                                      </a>
                                  </li>
                                  <li class="">
                                      <a href="#profile-2-<?= $row->id ;?>" data-toggle="tab" aria-expanded="false">
                                          <span class="visible-xs"><i class="fa fa-user"></i></span>
                                          <span class="hidden-xs">Pending List</span>
                                      </a>
                                  </li>
                              </ul>
                              <div class="tab-content">
                                  <div class="tab-pane  active" id="home-2-<?= $row->id ;?>">
                                      <div class="row">
                                          <div class="col-md-6">
                                            <input class="form-control" disabled="disabled" value="User ID">
                                          </div>
                                          <div class="col-md-6">
                                              <input class="form-control" disabled="disabled" value="User Name">
                                          </div>
                                      </div>
                                      <div class="row">
                                        <?php $id = unserialize($row->active_member_list); for($i=0; $i<count($id); $i++) {?>
                                          <div class="col-md-6">
                                              <input class="form-control" disabled="disabled" value="<?= $id[$i]['sponsor_id']?>">
                                          </div>
                                          <div class="col-md-6">
                                              <input class="form-control" disabled="disabled" value="<?= $id[$i]['member_name']; ?>">

                                          </div>
                                            <?php } ?>
                                      </div>
                                  </div>
                                  <div class="tab-pane" id="profile-2-<?= $row->id ;?>">
                                    <div class="row">
                                        <div class="col-md-6">
                                          <input class="form-control" disabled="disabled" value="User ID">
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control" disabled="disabled" value="User Name">
                                        </div>
                                    </div>
                                    <div class="row">
                                      <?php $id = unserialize($row->pending_member_list); for($i=0; $i<count($id); $i++) {?>
                                        <div class="col-md-6">
                                            <input class="form-control" disabled="disabled" value="<?= $id[$i]['sponsor_id']?>">
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control" disabled="disabled" value="<?= $id[$i]['member_name']; ?>">

                                        </div>
                                          <?php } ?>
                                    </div>
                                  </div>
                              </div>
                          </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
                  </div>
                                    <!--==============================modal end ===================================-->
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
      <?php echo $this->pagination->create_links(); ?>
    </div>
</div>
