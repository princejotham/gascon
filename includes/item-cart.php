<?php
  require '../database/connection.php';

  $stmt = $PDO->prepare("SELECT * FROM cart;");
  $stmt->execute();
  $cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="table-responsive">
  <table class="table table-bordered" id="pos" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>Item Code</th>
        <th>Item Name</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Sub</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php $total = 0; ?>
      <?php foreach ($cart_items as $c): ?>
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
          <td>
            <form method="POST" action="process/delete.php">
              <input type="hidden" name="c_id" value="<?=$c['id'];?>">
              <input type="hidden" name="qty" value="<?=$c['qty'];?>">
              <input type="hidden" name="sid" value="<?=$c['stock_id'];?>">
              <button type="submit" class="btn btn-danger btn-xs" name="c_del_btn" style="padding:3px;">
                <i class="fa fa-trash"></i>
              </button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
      <tr>
        <td colspan="4"><button type="submit" data-toggle="modal" data-target="#modalTran" class="btn btn-success btn-xs btn-block">Confirm <i class="fa fa-cart-plus"></i></button></td>

        <?php
          $stmt = $PDO->prepare("SELECT * FROM cart");
          $stmt->execute();
          $purchase_set = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <td colspan="2">Total: <?=num_format($total);?></td>
      </tr>
  </table>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('#pos').DataTable();
  });
</script>

<!-- Add modalTran Modal-->
<div class="modal fade" id="modalTran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="width: 100%;"> <span class="text-center">AJ JR Pharmacy</span> <span style="float: right;"><i class="fa fa-shopping-cart"></i> Invoice</span><br><span style="font-size: 14px;"><?=date("F d, Y H:i:s");?></span></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <div class="modal-body">
        <div id="item-confirm-cart"></div>
      </div>

      <div class="modal-footer">
        <?php if($global_purchase_set): ?>
          <input type="button" id="amount_tendered" class="btn btn-warning" value="Tender Amount">
          <input type="button" id="print_item_tran" class="btn btn-primary" value="Save">
        <?php else: ?>
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div><!-- div modal fade -->


<!-- ============= ALL MODALS ============= -->
<!-- Add modalTran Modal-->
<div class="modal fade" id="modal_amount_tendered" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width: 400px;">
    <div class="modal-content">
      <div class="modal-header">
        <p class="modal-title" id="exampleModalLabel" style="width: 100%;"> <span class="text-center">AJ JR Pharmacy</span> <span style="float: right;"><i class="fa fa-shopping-cart"></i> Invoice</span><br><span style="font-size: 14px;"><?=date("F d, Y H:i:s");?></span></p>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Enter Amount Tender:</label>
        <input type="number" name="" class="form-control" min="0" value="<?=$total?>" id="amount_tedFrom" required>
        <input type="hidden" value="<?=$total?>" id="grand_to">
      </div>

      <div class="modal-footer">
        <input type="submit" name="" class="btn btn-primary" value="Ok" id="ok_tender">
      </div>
    </div>
  </div>
</div><!-- div modal fade -->




<script type="text/javascript">
$(document).on('click', '#ok_tender', function(event) {
  event.preventDefault();
  $('#modal_amount_tendered').modal('hide');
  $('#modalTran').modal('show');
  var grand_total = $('#grand_to').val();
  var amount_tendered = $('#amount_tedFrom').val();
  console.log("grand_total:" + grand_total, "amount_tendered:" + amount_tendered);
  amount_tendered = math_rd(amount_tendered);
  $('#am_tendered').text(amount_tendered);
  $('#getTendered').val(amount_tendered);

  var change = amount_tendered-grand_total;
  change = math_rd(change);
  $('#am_change').text(change);
  $('#getChange').val(math_rd(change));

  console.log(parseFloat(Math.round(change * 100) / 100).toFixed(2));
});

$(document).on('click', '#print_item_tran', function(event) {
  var getTendered = $('#getTendered').val();
  var getChange = $('#getChange').val();
  // window.open('print_sales_tran_pharmacy.php?tender=' + getTendered + '&change=' + getChange,'name','width=auto,height=auto');
  window.location = 'print_sales_tran_pharmacy.php?tender=' + getTendered + '&change=' + getChange,'name';
});

/*  var divToPrint=document.getElementById('print_cart_items');
  var newWin=window.open('','Print-Window');
  newWin.document.open();
  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
  newWin.document.close();
  setTimeout(function(){newWin.close();},10);*/
</script>