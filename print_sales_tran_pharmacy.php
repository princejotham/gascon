<?php require_once 'includes/sessionsp.php'; ?>
<?php
  // database connection
  require_once 'database/connection.php';
    try {
      // get all purchase
      $stmt = $PDO->prepare("SELECT * FROM cart");
      $stmt->execute();
      $purchase_set = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo $e->getMessage();

      header("Location: ../pharmacy.php");
      exit();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Gascon Integrated Business Control System</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
    <script src="vendor/jquery/jquery.min.js"></script>
  <script type="text/javascript">
//     // print();
$(document).ready(function(event) {
/*  $('#print_cancel').hide();
  $('#print_receipt').hide();*/
  alert('Item(s) checked out.');
  print();
  window.location = "pharmacy.php";
});
  </script>
</head>
<body>

      <div class="row justify-content-center">
      <div class="col-lg-5">  
<div class="table-responsive" style="padding: 1em;">
  <h1 style="text-align: center">AJ JR Pharmacy</h1>
  <br></br>
  <h2><i class="fa fa-shopping-cart"></i> Invoice <span style="float: right; font-size: 13pt; font-weight: bold; margin-top: 10px;">Date: <?=date("F d, Y H:i:s");?></span></h2>
  <?php
    $stmt = $PDO->prepare("SELECT * FROM sales_trans");
    $stmt->execute();
    $next_t = $stmt->rowCount();
  ?>
  <h5>Transaction No. <?=sprintf("%09d", $next_t+1);?></h5>

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
      <?php $total = 0; ?>
      <?php foreach ($purchase_set as $c): ?>
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
    Tendered Price: PHP <span id="am_tendered"><?=$_GET['tender']?></span><br>
    Change: PHP <span id="am_change"></span><?=$_GET['change']?></p>  </div>
</div>
      <!-- <p class="text-right"><button class="btn btn-primary" id="print_receipt">Print</button> <a href="pharmacy.php" class="btn btn-danger" id="print_cancel">Cancel</a></p> -->
      </div>

      </div><!--<div class="row">-->



    </div><!-- /.container-fluid-->
  </div><!-- /.content-wrapper-->
    
</body>

</html>
<?php
    try {
      if($purchase_set)
      {
          $stmt = $PDO->prepare("SELECT * FROM sales_trans");
          $stmt->execute();
          $row_num = $stmt->rowCount();
          $grand_total = 0;
        foreach($purchase_set as $row)
        {
          $stmt = $PDO->prepare("INSERT INTO item_sales (item_code, price, qty, sub_total, tran_id, item_name) VALUES (?, ?, ?, ?, ?, ?)");
          $stmt->bindValue(1, $row['i_code'], PDO::PARAM_STR);
          $stmt->bindValue(2, $row['price'], PDO::PARAM_STR);
          $stmt->bindValue(3, $row['qty'], PDO::PARAM_STR);
          $stmt->bindValue(4, $row['qty']*$row['price'], PDO::PARAM_STR);
          $stmt->bindValue(5, $row_num+1, PDO::PARAM_STR);
          $stmt->bindValue(6, $row['i_name'], PDO::PARAM_STR);
          $stmt->execute();
          $sub_total = $row['qty']*$row['price'];
          $grand_total += $sub_total;
        }

        $stmt = $PDO->prepare("INSERT INTO sales_trans (trans_no, grand_total, tendered, amountchange) VALUES (?, ?, ?, ?)");
        $stmt->bindValue(1, $row_num+1, PDO::PARAM_STR);
        $stmt->bindValue(2, num_format($grand_total), PDO::PARAM_STR);
        $stmt->bindValue(3, $_GET['tender'], PDO::PARAM_STR);
        $stmt->bindValue(4, $_GET['change'], PDO::PARAM_STR);
        $stmt->execute();

        $stmt = $PDO->prepare("DELETE FROM cart");
        $stmt->execute();
      }

    } catch (PDOException $e) {
      echo $e->getMessage();
    }
?>