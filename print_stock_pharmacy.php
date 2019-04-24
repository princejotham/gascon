<?php require_once 'includes/sessions.php'; ?>
<?php
  // database connection
  require_once 'database/connection.php';
  try {
    $stmt = $PDO->prepare("SELECT * FROM stock_item");
    $stmt->execute();
    $all_stocks = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                <h1>Stock List of Pharmacy <span style="float: right; font-size: 13pt; font-weight: bold;">Date: <?=date("F d, Y");?></span></h1>
                <table class="table table-bordered" id="items" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Item Name</th>
                      <th>Price</th>
                      <th>Qty</th>
                      <th>Manufactured Date</th>
                      <th>Purchased Date</th>
                      <th>Expiration Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($all_stocks as $s): ?>
                    <?php
                      try {
                        $stmt = $PDO->prepare("SELECT * FROM item WHERE id = ?");
                        $stmt->bindValue(1, $s['item_id'], PDO::PARAM_STR);
                        $stmt->execute();
                        $stocks = $stmt->fetch(PDO::FETCH_ASSOC);
                      } catch(PDOException $e) {
                        echo $e->getMessage();
                      }
                    ?>
                      <tr>
                        <td><?=$stocks['item_name'];?></td>
                        <td><?=$stocks['buy_price'];?></td>
                        <td><?=$s['item_qty'];?></td>
                        <td><?=date("F d, Y", strtotime($s['item_man']));?></td>
                        <td><?=date("F d, Y", strtotime($s['item_pur']));?></td>
                        <td><?=date("F d, Y", strtotime($s['item_ex']));?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>

        </div>
      </div><!--<div class="row">-->



    </div><!-- /.container-fluid-->
  </div><!-- /.content-wrapper-->
    
</body>

</html>