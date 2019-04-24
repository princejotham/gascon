<?php require_once 'includes/sessionsp.php'; ?>
<?php
  // database connection
  require_once 'database/connection.php';
  try {
    $stmt = $PDO->prepare("SELECT * FROM item");
    $stmt->execute();
    $all_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch(PDOException $e) {
    echo $e->getMessage();
  }

  try {
    $stmt = $PDO->prepare("SELECT * FROM stock_item");
    $stmt->execute();
    $all_stocks = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch(PDOException $e) {
    echo $e->getMessage();
  }

  $dateNow = date('Y-m-d');
  foreach ($all_stocks as $s): 
  $xDate = strtotime($s['item_ex']);
  $xDate = date('Y-m-d', $xDate);
  if($xDate <= $dateNow){ 
    try {
      $stmt = $PDO->prepare("INSERT INTO `expire`(`item_qty`, `item_man`, `item_pur`, `item_ex`, `item_id`) 
                            VALUES (?, ?, ?, ?, ?);");
      $stmt->bindValue(1, $s["item_qty"], PDO::PARAM_STR);
      $stmt->bindValue(2, $s["item_man"], PDO::PARAM_STR);
      $stmt->bindValue(3, $s["item_pur"], PDO::PARAM_STR);
      $stmt->bindValue(4, $s["item_ex"], PDO::PARAM_STR);
      $stmt->bindValue(5, $s["item_id"], PDO::PARAM_STR);
      $stmt->execute();

      $stmt = $PDO->prepare("DELETE FROM `stock_item` WHERE `item_id` = ?;");
      $stmt->bindValue(1, $s["item_id"], PDO::PARAM_STR);
      $stmt->execute();
    } catch(PDOException $e) {
      echo $e->getMessage();
    }
  }
  endforeach;
?>
<?php require 'includes/header_pharmacy.php'; ?>



  <!-- Navigation-->  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html">AJ JR Pharmacy</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item active" title="Stocks">
          <a class="nav-link" href="stocks_pharmacy.php">
            <span class="nav-link-text">Stocks</span>
          </a>
        </li>
        <li class="nav-item" title="Category">
          <a class="nav-link" href="category_pharmacy.php">
            <span class="nav-link-text">Category</span>
          </a>
        </li>
        <li class="nav-item" title="Items">
          <a class="nav-link" href="items_pharmacy.php">
            <span class="nav-link-text">Items</span>
          </a>
        </li>
        <li class="nav-item" title="Expired">
          <a class="nav-link" href="expired_pharmacy.php">
            <span class="nav-link-text">Expired</span>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="pharmacy.php">Transaction</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="stocks_pharmacy.php">Inventory</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="sales_pharmacy.php">Reports</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">



      

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="pharmacy.php">Pharmacy</a>
        <li class="breadcrumb-item active">Stocks</li>
        </li>
      </ol>

      <div class="row">
        <div class="col-sm-12">
          <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#NewStockItem">New Stocks</a><br></br>

          <!-- All Items -->
          <div class="card mb-3">
            <div class="card-header" style="background-color: #78ffae;">
              <i class="fa fa-table"></i> Stock List</div>
            <div class="card-body">
              <div class="table-responsive">
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
                    <?php
                      try {
                        $stmt = $PDO->prepare("SELECT * FROM stock_item ORDER BY item_ex ASC");
                        $stmt->execute();
                        $all_stocks = $stmt->fetchAll(PDO::FETCH_ASSOC);
                      } catch(PDOException $e) {
                        echo $e->getMessage();
                      }
                      $dateNow = date('Y-m');
                      foreach ($all_stocks as $s): 
                      $xDate = strtotime($s['item_ex']);
                      $xDate = date('Y-m', $xDate);
                      $class = "text-success";
                      if($xDate <= $dateNow){ 
                              $class = "text-warning";
                      }
                    ?>
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
                      <tr class="<?= $class; ?>">
                        <td><?=$stocks['item_name'];?></td>
                        <td><?=num_format($s['sell_price']);?></td>
                        <td><?=num_format($s['item_qty']);?></td>
                        <td><?=date("F d, Y", strtotime($s['item_man']));?></td>
                        <td><?=date("F d, Y", strtotime($s['item_pur']));?></td>
                        <td><?=date("F d, Y", strtotime($s['item_ex']));?>
                            <?php if($xDate <= $dateNow): ?>
                                <span class="label label-danger">!</span>
                            <?php endif; ?>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted hide">Updated yesterday at 11:59 PM</div>
          </div>
        </div>
      </div><!--<div class="row">-->


    <!-- Add Item Stock Modal-->
    <div class="modal fade" id="NewStockItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Adding new stock</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          
          <form method="POST" action="process/add.php">

            <div class="modal-body">
                <div class="form-group">
                  <label>Item Name:</label>
                  <select class="form-control" name="i_id">
                    <?php foreach ($all_items as $i): ?>
                      <option value="<?=$i['id']?>"><?=$i['item_name']?></option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="form-group">
                  <label>Item Quantity:</label>
                  <input type="number" name="sq" class="form-control">
                </div>

                <div class="form-group">
                  <label>Item Manufactured:</label>
                  <input type="date" name="sm" class="form-control">
                </div>

                <div class="form-group">
                  <label>Purchased Date:</label>
                  <input type="date" name="spd" class="form-control">
                </div>

                <div class="form-group">
                  <label>Expiration Date:</label>
                  <input type="date" name="sed" class="form-control">
                </div>
            </div>

            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <input type="submit" name="ibs" class="btn btn-success" value="Save">
            </div>

          </form>
        </div>
      </div>
    </div>
<?php require 'includes/footer.php'; ?>