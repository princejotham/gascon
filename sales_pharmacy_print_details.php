<?php
  // database connection
  require_once 'database/connection.php';
    try {
      $stmt = $PDO->prepare("SELECT * FROM item_sales WHERE tran_id = ?");
      $stmt->bindValue(1, $_GET['tn'], PDO::PARAM_STR);
      $stmt->execute();
      $stock_i = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo $e->getMessage();
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
  <script type="text/javascript">
    print();
  </script>
</head>
<body>

      <div class="row">
        <div class="col-sm-6">
              <div class="table-responsive" style="padding: 1em;">
                <h1 style="text-align: center">AJ JR Pharmacy</h1>
                <br></br>
                <h2><i class="fa fa-shopping-cart"></i> Invoice <span style="float: right; font-size: 13pt; font-weight: bold; margin-top: 10px;">Date: <?=date("F d, Y");?></span></h2>

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
                    <?php foreach ($stock_i as $c): ?>
                    <?php
                      $subTotal = $c['price'] * $c['qty'];   
                      $total += $subTotal;
                    ?>
                      <tr>
                        <td><?=sprintf("%09d", $c['item_code']);?></td>
                        <td><?=$c['item_name'];?></td>
                        <td><?=num_format($c['price']);?></td>
                        <td><?=num_format($c['qty']);?></td>
                        <td><?=num_format($c['price']*$c['qty']);?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
  </table>

  <div style="text-align: right; font-weight: bold;">
    <p>Grand Total Price: PHP <?=num_format($total);?><br>
    Tendered Price: PHP <span id="am_tendered"><?=num_format($_GET['tendered']);?></span><br>
    Change: PHP <span id="am_change"><?=num_format($_GET['change']);?></span></p>
  </div>
              </div>

        </div>
      </div><!--<div class="row">-->



    </div><!-- /.container-fluid-->
  </div><!-- /.content-wrapper-->
    
</body>

</html>