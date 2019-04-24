<?php
  // database connection
  require_once 'database/connection.php';
    try {
      $stmt = $PDO->prepare("SELECT * FROM bottle_sales WHERE tran_id = ?");
      $stmt->bindValue(1, $_GET['tn'], PDO::PARAM_STR);
      $stmt->execute();
      $stock_i = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        
      $stmt = $PDO->prepare("SELECT * FROM customer WHERE id = ?");
      $stmt->bindValue(1, $_GET["ci"], PDO::PARAM_STR);
      $stmt->execute();
      $cus_b = $stmt->fetch(PDO::FETCH_ASSOC);

      $stmt = $PDO->prepare("SELECT SUM(sub_total) AS total FROM bottle_sales WHERE tran_id = ?");
      $stmt->bindValue(1, $_GET['tn'], PDO::PARAM_STR);
      $stmt->execute();
      $total_sales = $stmt->fetch(PDO::FETCH_ASSOC);
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
                <h1 style="text-align: center">Blue Lagoon Water Refilling Station</h1>
                <br></br>
                <h2><i class="fa fa-shopping-cart"></i> Invoice <span style="float: right; font-size: 13pt; font-weight: bold; margin-top: 10px;">Date: <?=date("F d, Y");?></span></h2>

<br></br>
            <h6>Customer Name: <?=$cus_b['c_name'];?><span style="float: right;">Date: <?=date("F d, Y", strtotime($_GET['td']));?></span></h6>
            <h6>Customer Address: <?=$cus_b['c_address'];?><span style="float: right;">Grand Total: PHP <?=number_format($total_sales['total'], 2);?></span></h6>
            <br>
  <table class="table table-bordered" id="invoice" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th>#</th>
      <th>Bottle Name</th>
      <th>Price</th>
    </tr>
  </thead>
                  <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($stock_i as $c): ?>
                      <tr>
                        <td><?=$no++?></td>
                        <td><?=$c['b_name'];?></td>
                        <td><?=$c['price'];?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
  </table>
  <h6 style="float: right;">Grand Total Price: PHP <?=$total_sales['total'];?></h6>
              </div>

        </div>
      </div><!--<div class="row">-->



    </div><!-- /.container-fluid-->
  </div><!-- /.content-wrapper-->
    
</body>

</html>