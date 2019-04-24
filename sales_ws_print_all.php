<?php require_once 'includes/sessionsw.php'; ?>
<?php
  // database connection
  require_once 'database/connection.php';
  try {
    $stmt = $PDO->prepare("SELECT * FROM bottle_sales");
    $stmt->execute();
    $bottle_sales = $stmt->fetchAll(PDO::FETCH_ASSOC); 
  } catch(PDOException $e) {
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
        <div class="col-sm-12">
              <div class="table-responsive" style="padding: 1em;">
                <h1>Sales List of Water Station <span style="float: right; font-size: 13pt; font-weight: bold;">Date: <?=date("F d, Y");?></span></h1>
                <table class="table table-bordered" id="items" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="width: 30px;">#</th>
                      <th>Bottle Name</th>
                      <th>Price</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $total = 0; $no=1; ?>
                    
                    <?php foreach ($bottle_sales as $b): ?>
                    
                    <?php
                      $subTotal = $b['price'] * $b['qty'];   
                      $total += $subTotal;
                    ?>
                      
                    <tr>
                      <td><?=$no++;?></td>
                      <td><?=$b["b_name"];?></td>
                      <td><?=$b["price"];?></td>
                      <?php
                        try {
                          $stmt = $PDO->prepare("SELECT * FROM sales_trans WHERE trans_no = ?");
                          $stmt->bindValue(1, $b["tran_id"], PDO::PARAM_STR);
                          $stmt->execute();
                          $stock_b = $stmt->fetch(PDO::FETCH_ASSOC);
                        } catch(PDOException $e) {
                          echo $e->getMessage();
                        }
                      ?>
                      <td><?=date("F d, Y", strtotime($stock_b['date_tran']));?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                  <tr>
                    <td colspan="9" style="text-align: right;"><strong style="font-size: 16pt">Total: PHP <?=$total;?></strong></td>
                  </tr>
                </table>
              </div>

        </div>
      </div><!--<div class="row">-->



    </div><!-- /.container-fluid-->
  </div><!-- /.content-wrapper-->
    
</body>

</html>