<?php
require_once 'database/connection.php';
try {
  $grand_total_sell = 0;
  $grand_total_buy = 0;
  $grand_total_b_stock = 0;

  $stmt = $PDO->prepare("SELECT SUM(price) AS e_price FROM expenses");
  $stmt->execute();
  $e = $stmt->fetch(PDO::FETCH_ASSOC);

  $stmt = $PDO->prepare("SELECT SUM(sub_total) AS ST FROM item_sales");
  $stmt->execute();
  $total_item_sales = $stmt->fetch(PDO::FETCH_ASSOC);

  $stmt = $PDO->prepare("SELECT SUM(sub_total) AS ST FROM bottle_sales");
  $stmt->execute();
  $total_bottle_sales = $stmt->fetch(PDO::FETCH_ASSOC);

  $stmt = $PDO->prepare("SELECT * FROM stock_bottle WHERE bottle_qty = ?");
  $stmt->bindValue(1, 1, PDO::PARAM_STR);
  $stmt->execute();
  $stock_bottle = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach ($stock_bottle as $key) {
    $stmt = $PDO->prepare("SELECT SUM(price) AS ST FROM bottle WHERE id = ?");
    $stmt->bindValue(1, $key['bottle_id'], PDO::PARAM_STR);
    $stmt->execute();
    $total_bottle_stock = $stmt->fetch(PDO::FETCH_ASSOC);    
    $grand_total_b_stock += $total_bottle_stock['ST'];
  }

  $stmt = $PDO->prepare("SELECT * FROM stock_item");
  $stmt->execute();
  $stock_item = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach ($stock_item as $key) {
    $stmt = $PDO->prepare("SELECT * FROM item WHERE id=?");
    $stmt->bindValue(1, $key['item_id'], PDO::PARAM_STR);
    $stmt->execute();
    $item = $stmt->fetch(PDO::FETCH_ASSOC);
    $sub_total_buy = $item['buy_price'] * $key['item_qty'];
    $sub_total_sell = $item['sell_price'] * $key['item_qty'];
    $grand_total_buy += $sub_total_buy;
    $grand_total_sell += $sub_total_sell;
  }

  $st0 = $total_item_sales['ST']+$total_bottle_sales['ST']+$grand_total_b_stock;
  $grand_total_sell += $st0;

  $st1 = $total_item_sales['ST']+$total_bottle_sales['ST']+$grand_total_b_stock;
  $grand_total_buy += $st1;
} catch(PDOException $e) {
  echo $e->getMessage();
}
?>
<?php
require_once 'includes/sessions.php';
include 'includes/header.php';
?>
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html">Administrator/Owner</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="index.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Monitoring">
          <a class="nav-link" href="monitoring.php">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Monitoring</span>
          </a>
        </li>
        <li class="nav-item active" data-toggle="tooltip" data-placement="right" title="Financial">
          <a class="nav-link" href="financial.php">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Financial</span>
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
          <a href="financial.php">Financial</a>
        </li>
      </ol>
      <!-- Icon Cards-->
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
              </div>
              <div style="text-align: center;">
                <p style="color: #fff;text-transform: uppercase;">Total Assets of <br>Businesses</p>
                <h3>PHP <?=number_format($grand_total_sell, 2);?></h3>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
              </div>
              <div style="text-align: center;">
                <p style="color: #fff;text-transform: uppercase;">Total Revenues of <br>Businesses</p>
                <h3>PHP <?=number_format($grand_total_buy, 2);?></h3>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
              </div>
              <div style="text-align: center;">
                <p style="color: #fff;text-transform: uppercase;">Total Expenses of <br>Businesses</p>
                <h3>PHP <?=number_format($e["e_price"], 2);?></h3>
              </div>
            </div>
          </div>
        </div>
      </div><!--<div class="row">-->






<?php include 'includes/footer.php'; ?>