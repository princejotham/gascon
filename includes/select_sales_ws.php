<?php
	require_once '../database/connection.php';
	if(isset($_POST['sd'])) {
		$sd = $_POST['sd'];

		try {
			$stmt = $PDO->prepare("SELECT * FROM sales_trans WHERE date_tran LIKE ? AND cus_id != ?;");
			$stmt->bindValue(1, $sd . "%", PDO::PARAM_STR);
			$stmt->bindValue(2, 0, PDO::PARAM_STR);
			$stmt->execute();
			$sales_trans = $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}
?>

          <div class="card mb-3">
            <div class="card-header" style="background-color: #78ffae;">
              <i class="fa fa-table"></i> All Sales <strong style="float: right;"><?=date("F d, Y");?></strong></div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="items" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="width: 30px;">#</th>
                      <th>Transaction No.</th>
                      <th>Total Price</th>
                      <th>Date</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $total = 0; $no=1; ?>
                    
                    <?php foreach ($sales_trans as $t): ?>
                    <?php $subTotal=0; ?>
                    <?php
                      try {
                        $stmt = $PDO->prepare("SELECT * FROM bottle_sales WHERE tran_id = ?");
                        $stmt->bindValue(1, $t["trans_no"], PDO::PARAM_STR);
                        $stmt->execute();
                        $stock_b = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        $stmt = $PDO->prepare("SELECT * FROM customer WHERE id = ?");
                        $stmt->bindValue(1, $t["cus_id"], PDO::PARAM_STR);
                        $stmt->execute();
                        $cus_b = $stmt->fetch(PDO::FETCH_ASSOC);
                      } catch(PDOException $e) {
                        echo $e->getMessage();
                      }

                      foreach ($stock_b as $row) { 
                        $subTotal += $row['price'];

                      } // endforeach
                    ?>
                    <?php $total += $subTotal; ?>

                    <tr>
                      <td><?=$no++;?></td>
                      <td><?=sprintf("%09d", $t["trans_no"]);?></td>
                      <td><?=number_format($subTotal, 2);?></td>
                      <td><?=date("F d, Y", strtotime($t['date_tran']));?></td>
                      <td>


                          <button type="button" class="btn btn-danger btn-xs" style="padding:3px;" data-toggle="modal" data-target="#TransactionDetails<?=$t['trans_no'];?>">Details</button>


    <!-- Detail Transaction Modal-->
    <div class="modal fade" id="TransactionDetails<?=$t['trans_no'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Transaction Details</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>

<?php
  $row_no = 1;
  $grandTotal = 0;
  try {
    $stmt = $PDO->prepare("SELECT * FROM bottle_sales WHERE `tran_id`=?;");
    $stmt->bindValue(1, $t["trans_no"], PDO::PARAM_STR);
    $stmt->execute();
    $b_sale = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch(PDOException $e) {
    echo $e->getMessage();
  }
?>
<?php foreach ($b_sale as $bstotal):
  $grandTotal += $bstotal['price'];
endforeach; ?>

          <div class="modal-body">
            <h6>Customer Name: <?=$cus_b['c_name'];?><span style="float: right;">Date: <?=date("F d, Y", strtotime($t['date_tran']));?></span></h6>
            <h6>Customer Address: <?=$cus_b['c_address'];?><span style="float: right;">Grand Total: PHP <?=number_format($grandTotal, 2);?></span></h6>
            <br>

<div class="">
  <table class="table table-bordered" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>#</th>
        <th>Bottle Name</th>
        <th>Price</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($b_sale as $bs): ?>
        <tr>
          <td><?=$row_no++;?></td>
          <?php if ($bs['b_name'] == "Water Jag"): ?>
          <td><?=$bs['b_name'];?> <?=$bs['stock_id'];?></td>
          <?php else: ?>
          <td><?=$bs['b_name'];?></td>
          <?php endif; ?>
          <td><?=number_format($bs['price'], 2);?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
          </div>

          <div class="modal-footer">
          <input type="hidden" id="tran_date<?=$t['trans_no'];?>" value="<?=date("Y-m-d", strtotime($t['date_tran']));?>">
          <input type="hidden" id="tran_id<?=$t['trans_no'];?>" value="<?=$t['trans_no'];?>">
          <input type="hidden" id="cus_id<?=$cus_b['id'];?>" value="<?=$cus_b['id'];?>">
            <a href="#" class="btn btn-primary" id="print_details_d<?=$t['trans_no'];?>">Print</a>
            <script>
        //sale-report_pharmacy print (details - daily)
        $('#print_details_d<?=$t['trans_no'];?>').click(function(event) {
          var tn = $('#tran_id<?=$t['trans_no'];?>').val();
          var ci = $('#cus_id<?=$cus_b['id'];?>').val();
          var tds = $('#tran_date<?=$t['trans_no'];?>').val();
          window.open('sales_water_print_details.php?tn='+tn+'&ci='+ci+'&td='+tds,'name','width=auto,height=auto');
        });
            </script>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>

                      </td>
                    </tr>

                    <?php endforeach; ?>
                  </tbody>
                  <tr>
                    <td colspan="9" style="text-align: right;"><strong style="font-size: 16pt">Total: PHP <?=$total;?></strong></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted hide">Updated yesterday at 11:59 PM</div>
          </div>