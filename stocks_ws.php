<?php require_once 'includes/sessionsw.php'; ?>
<?php
  // database connection
  require_once 'database/connection.php';
  try {
    $stmt = $PDO->prepare("SELECT * FROM bottle");
    $stmt->execute();
    $all_bottles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $row_num = $stmt->rowCount();
    $stmt = $PDO->prepare("SELECT * FROM stock_bottle WHERE `bottle_qty`=1");
    $stmt->execute();
    $all_stocks = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch(PDOException $e) {
    echo $e->getMessage();
  }
?>
<?php require 'includes/header_ws.php'; ?>


  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html">Blue Lagoon Water Refilling Station</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item active" title="Stocks">
          <a class="nav-link" href="stocks_ws.php">
            <span class="nav-link-text">Stocks</span>
          </a>
        </li>
        <li class="nav-item" title="Bottles">
          <a class="nav-link" href="items_ws.php">
            <span class="nav-link-text">Bottles</span>
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
          <a class="nav-link" href="ws.php">Transaction</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="clients.php">Clients</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="stocks_ws.php">Inventory</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="sales_ws_daily.php">Reports</a>
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
          <a href="ws.php">Water Station</a>
        <li class="breadcrumb-item active">Stocks</li>
        </li>
      </ol>

      <div class="row">
        <div class="col-sm-12">
          <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#NewStockBottle">New Stock</a>
          <br></br>
          <!-- All Items -->
          <div class="card mb-3">
            <div class="card-header" style="background-color: #78ffae;">
              <i class="fa fa-table"></i> Stock List</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="items" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="width:30px;">#</th>
                      <th>Bottle Name</th>
                      <th>Price</th>
                      <th>Qty</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1;
                          $pb=0;
                          $price=0;
                    foreach ($all_stocks as $b): ?>
                    <?php
                      try {
                        $stmt = $PDO->prepare("SELECT * FROM bottle WHERE id = ?");
                        $stmt->bindValue(1, $b['bottle_id'], PDO::PARAM_STR);
                        $stmt->execute();
                        $bottle = $stmt->fetch(PDO::FETCH_ASSOC);
                      } catch(PDOException $e) {
                        echo $e->getMessage();
                      }
                    ?>
                      <?php if ($bottle['bottle_name'] == "Plastic Bottle"):
                        $pb++;
                        $price = $bottle['price'];
                        else: ?>
                        <tr>
                          <td><?=$no++;?></td>
                            <td><?=$bottle['bottle_name']. " " . $b['s_id'];?></td>
                          <td><?=$bottle['price'];?></td>
                          <td><?=$b['bottle_qty'];?></td>
                        </tr>
                      <?php endif; ?>
                    <?php endforeach; ?>
                    <?php
                      if($pb!=0) {
                    ?>
                        <tr>
                          <td><?=$no++;?></td>
                          <td>Plastic Bottle</td>
                          <td><?=$price;?></td>
                          <td><?=$pb;?></td>
                        </tr>
                    <?php
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted hide">Updated yesterday at 11:59 PM</div>
          </div>
        </div>
      </div><!--<div class="row">-->


    <!-- Add Bottle Stock Modal-->
    <div class="modal fade" id="NewStockBottle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                  <select class="form-control" name="b_id">
                    <?php foreach ($all_bottles as $b): ?>
                      <option value="<?=$b['id']?>"><?=$b['bottle_name']?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Quatity:</label>
                  <input type="number" name="sq" class="form-control">
                </div>
            </div>

            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <input type="submit" name="sbb" class="btn btn-success" value="Save">
            </div>

          </form>
        </div>
      </div>
    </div>
<?php require 'includes/footer.php'; ?>