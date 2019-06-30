<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title"><b>Plan</b></h4>
            <p class="text-muted m-b-30 font-13">
               Step Income.
            </p>
            <p>If you are to do this great work of "MyInformation", then depending on your ability ...</p>
            <p>At least 50 ₹ can also start this work.</p>
            <p>Or can this work start from ...... 100 ₹.</p>
            <p>Or can this work start from ...... 200 ₹.</p>
            <p>Or can you start this work from ...... 400 ₹.</p>
            <p>Or can you start this work from ...... 800 ₹. </p>
            <p>Or can this work start from ...... 1000 ₹.</p>
            <p>Or can you start this work from ....... 2000 ₹.</p>
            <p>Or can you start this work from ...... 4000 ₹. </p>
            <table id="demo-foo-row-toggler" class="table toggle-circle table-hover default breakpoint footable-loaded footable">
                <thead>
                    <tr>
                        <th>#</span></th>
                        <th>Plan</th>
                        <th>Income</span></th>
                    </tr>
                </thead>
                <tbody>
                     <?php $i=1; foreach($income as $row) { ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><i class="fa fa-inr"></i> <?= $row->plan; ?></td>
                       <td><i class="fa fa-inr"></i> <?= $row->income; ?></td>
                       
                    </tr>
                     <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>