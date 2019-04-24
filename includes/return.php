
    <!-- Add Refill Modal-->
    <div class="modal fade" id="return" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Customer Return</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>

            <div class="modal-body">
              <?php if (isset($_GET["c_id"])): ?>


<h6>Customer Name: <?=$_GET['c_name'];?></h6>
<h6>Customer Address: <?=$_GET['c_address'];?></h6>
<br>

<div class="table-responsive">
  <table class="table table-bordered" id="refill_cus" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>Bottle Name</th>
        <th>Price</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
<?php
  try {
    $stmt = $PDO->prepare("SELECT * FROM sales_trans WHERE `cus_id`=?;");
    $stmt->bindValue(1, $_GET['c_id'], PDO::PARAM_STR);
    $stmt->execute();
    $s_trans = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch(PDOException $e) {
    echo $e->getMessage();
  }
?>

      <?php foreach ($s_trans as $s_t): ?>

<?php
  try {
    //$stmt = $PDO->prepare("SELECT * FROM bottle_sales WHERE `tran_id`=?;");
  $sql = "SELECT bs.`id`, bs.`stock_id`, bs.`b_name`, bs.`price`, bs.`tran_id` FROM `bottle_sales` bs
        INNER JOIN (
          SELECT `stock_id`, MAX(`tran_id`) AS MinID
            FROM `bottle_sales`
            GROUP BY `stock_id`
        ) tm ON bs.`stock_id`=tm.`stock_id` AND bs.`tran_id`=tm.`MinID` WHERE bs.`tran_id`=? AND bs.`return_bot` = 0";
    $stmt = $PDO->prepare($sql);
    $stmt->bindValue(1, $s_t['trans_no'], PDO::PARAM_STR);
    $stmt->execute();
    $b_sale = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch(PDOException $e) {
    echo $e->getMessage();
  }
?>
      <?php foreach ($b_sale as $bs): ?>
<?php if ($bs['b_name'] == "Water Jag"): ?>

        <tr>
          <td><?=$bs['b_name'];?> <?=$bs['stock_id'];?></td>
          <td><?=$bs['price'];?></td>
          <td>
            <form method="POST" action="process/add.php">
              <input type="hidden" name="id" value="<?=$bs['id'];?>">
              <input type="hidden" name="sbid" value="<?=$bs['stock_id'];?>">
              <input type="hidden" name="bname" value="<?=$bs['b_name'];?>">
              <input type="hidden" name="bp" value="<?=$bs['price'];?>">
              <input type="hidden" name="refill" value="1">

              <?php if (isset($_GET["c_id"]) AND isset($_GET["c_name"])): ?>
                <input type="hidden" name="c_name" value="<?=$_GET['c_name'];?>">
                <input type="hidden" name="c_address" value="<?=$_GET['c_address'];?>">
                <input type="hidden" name="c_id" value="<?=$_GET['c_id'];?>">
              <?php else: ?>
                <input type="hidden" name="c_name" value="">
                <input type="hidden" name="c_address" value="">
                <input type="hidden" name="c_id" value="">
              <?php endif; ?>
              <button type="submit" name="ba_cart_return" class="btn btn-success btn-xs" style="padding:3px;">Return Water Jag</button>
            </form>
          </td>
        </tr>
<?php endif; ?>
      <?php endforeach; ?>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>






              <?php else: ?>  
              <h5>Please select customer</h5>
              <?php endif; ?>
            </div>

            <div class="modal-footer">
            </div><!-- end modal footer -->

          </form>
        </div>
      </div>
    </div><!-- end modal -->