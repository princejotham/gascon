<?php require '../database/connection.php'; ?>
<h5>Transaction No. <?=sprintf("%09d", $global_transaction_count+1);?></h5>
<?php $total = 0; ?>
<?php
  if($global_purchase_set) {
?>
<div class="table-responsive">
  <table class="table table-bordered" id="invoice" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>Item Code</th>
        <th>Item Name</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Sub Total</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($global_purchase_set as $c): ?>
      <?php
        $subTotal = $c['price'] * $c['qty'];   
        $total += $subTotal;
      ?>
        <tr>
          <td><?=sprintf("%09d", $c['i_code']);?></td>
          <td><?=$c['i_name'];?></td>
          <td><?=num_format($c['price']);?></td>
          <td><?=num_format($c['qty']);?></td>
          <td><?=num_format($c['price']*$c['qty']);?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <div style="text-align: right; font-weight: bold;">
    <p>Grand Total Price: PHP <?=num_format($total);?><br>
    Tendered Price: PHP <span id="am_tendered">0.00</span><br>
    Change: PHP <span id="am_change">0.00</span></p>
    <input type="hidden" id="getTendered" value="">
    <input type="hidden" id="getChange" value="">
  </div>
</div>
<?php
  } else {
    echo "No item(s) to check out.";
  }
?>
