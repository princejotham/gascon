<?php require_once 'includes/sessionsw.php'; ?>
<?php
  // database connection
  require_once 'database/connection.php';
  try {
    $stmt = $PDO->prepare("SELECT * FROM bottle_sales");
    $stmt->execute();
    $all_bottle = $stmt->fetchAll(PDO::FETCH_ASSOC); 
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
        <li class="nav-item" title="Daily Sales">
          <a class="nav-link" href="sales_ws_daily.php">
            <span class="nav-link-text">Daily Sales</span>
          </a>
        </li>
        <li class="nav-item" title="Monthly Sales">
          <a class="nav-link" href="sales_ws_monthly.php">
            <span class="nav-link-text">Monthly Sales</span>
          </a>
        </li>
        <li class="nav-item" title="Yearly Sales">
          <a class="nav-link" href="sales_ws_yearly.php">
            <span class="nav-link-text">Yearly Sales</span>
          </a>
        </li>
        <li class="nav-item" title="Print Sales">
          <a class="nav-link" href="#" id="report_ws_all">
            <span class="nav-link-text">Print Sales</span>
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
        <li class="nav-item">
          <a class="nav-link" href="stocks_ws.php">Inventory</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="sales_ws.php">Reports</a>
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
        <li class="breadcrumb-item active">All Sales</li>
        </li>
      </ol>

      <div class="row">
        <div class="col-sm-12">
          <!-- All Items -->
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
                      <th>Bottle Name</th>
                      <th>Price</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $total = 0; $no=1; ?>
                    
                    <?php foreach ($all_bottle as $b): ?>
                    
                    <?php
                      $subTotal = $b['price'] * $b['qty'];   
                      $total += $subTotal;
                    ?>
                      
                    <tr>
                      <td><?=$no++;?></td>
                      <td><?=sprintf("%09d", $b["tran_id"]);?></td>
                      <td><?=$b["b_name"];?> <?=$b["stock_id"];?></td>
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
            <div class="card-footer small text-muted hide">Updated yesterday at 11:59 PM</div>
          </div>
        </div>
      </div><!--<div class="row">-->
<?php require 'includes/footer.php'; ?>