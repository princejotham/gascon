<?php require_once 'includes/sessions.php'; ?>
<?php
  // database connection
  require_once 'database/connection.php';
  try {
    if (isset($_GET['date'])) {
      $stmt = $PDO->prepare("SELECT * FROM item_sales WHERE sales_date LIKE ?");
      $stmt->bindValue(1, $_GET['date'] . "%", PDO::PARAM_STR);
      $stmt->execute();
      $item_sales = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    } else {
      $stmt = $PDO->prepare("SELECT * FROM item_sales");
      $stmt->execute();
      $item_sales = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
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
                <h1>Sales List of Pharmacy <span style="float: right; font-size: 13pt; font-weight: bold;">Date: <?=date("F d, Y");?></span></h1>
                <table class="table table-bordered" id="items" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Transaction No.</th>
                      <th>Item Code</th>
                      <th>Item Name</th>
                      <th>Price</th>
                      <th>Qty</th>
                      <th>Sub Total</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $total = 0; ?>
                    <?php foreach ($item_sales as $i_sales): ?>
                    
                    <?php
                      $subTotal = $i_sales['price'] * $i_sales['qty'];   
                      $total += $subTotal;
                    ?>

                    <?php
                      try {
                        $stmt = $PDO->prepare("SELECT * FROM item_sales WHERE tran_id = ?;");
                        $stmt->bindValue(1, $i_sales['tran_id'], PDO::PARAM_STR);
                        $stmt->execute();
                        $Sales = $stmt->fetch(PDO::FETCH_ASSOC);
                      } catch(PDOException $e) {
                        echo $e->getMessage();
                      }
                    ?>
                    <tr>
                      <td><?=sprintf("%07d", $i_sales['tran_id']);?></td>
                      <td><?=sprintf("%09d", $i_sales['item_code']);?></td>
                      <td><?=$i_sales['item_name'];?></td>
                      <td><?=$i_sales['price'];?></td>
                      <td><?=$i_sales['qty'];?></td>
                      <td><?=$i_sales['price']*$i_sales['qty'];?></td>
                      <td><?=date("F d, Y", strtotime($i_sales['sales_date']));?></td>
                    </tr>

                    <?php endforeach; ?>
                  </tbody>
                  <tr>
                    <td colspan="7" style="text-align: right;"><strong style="font-size: 16pt">Total: PHP <?=$total;?></strong></td>
                  </tr>
                </table>
              </div>

        </div>
      </div><!--<div class="row">-->



    </div><!-- /.container-fluid-->
  </div><!-- /.content-wrapper-->
    
</body>

</html>