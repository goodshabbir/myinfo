<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Payout.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table border='1'>
  <tr>
    <td>S.No</td>
    <td>Sponsor ID</td>
    <td>Active Member</td>
    <td>Direct Sponsor Income</td>
    <td>Core Income</td>
    <td>On Pair</td>
    <td>Left Member</td>
    <td>Right Member</td>
    <td>Pair Income</td>
    <td>Reward Income</td>
    <td>Genration Income</td>
    <td>Base Income</td>
    <td>TDS(5%)</td>
    <td>Admin(10%)</td>
    <td>Total Income</td>
    <td>On Closing</td>
    <td>Status<td>
  </tr>
  <?php $total =0; $baseIncome =0;  $tds=0; $admin=0; $reserve=0; $i=1; foreach($payoutlist as $row): 
    
    $baseIncome = $row->direct_income + $row->core_income + $row->pair_income + $row->reward_income + $row->genration_income + $row->temp_sudDire;
    $tds   = $baseIncome * 5/100;
    $admin = $baseIncome * 10/100;
    $reserve = $tds+$admin;
    $total = $baseIncome - $reserve ;
    ?>
  <tr>
    <td><?= $i++; ?></td>
    <td><?= $row->sponsor_id ?></td>
    <td><?= $row->active_member ?></td>
    <td><?= $row->direct_income + $row->temp_sudDire ?></td>
    <td><?= $row->core_income ?></td>
    <td><?= $row->on_pair ?></td>
    <td><?= $row->leftcount ?></td>
    <td><?= $row->rightcount ?></td>
    <td><?= $row->pair_income ?></td>
    <td><?= $row->reward_income ?></td>
    <td><?= $row->genration_income ?></td>
    <td><?= $baseIncome; ?></td>
    <td><?= $tds; ?></td>
    <td><?= $admin; ?></td>
    <td><?= $total; ?></td>
    <td><?= $row->on_closing ?></td>
    <td><?php if($row->status==0) { echo "Pending"; } else { echo "Paid" ; } ?></td>
  </tr>
<?php endforeach; ?>
</table>