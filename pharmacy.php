<?php require_once 'includes/sessionsp.php'; ?>
<?php
  require_once 'database/connection.php';
  try {
    $sql = "SELECT si.`id`, si.`item_qty`, si.`item_man`, si.`item_pur`, si.`item_ex`, si.`item_id` FROM `stock_item` si
      INNER JOIN (
        SELECT `item_id`, MIN(`item_ex`) AS MinDate
          FROM `stock_item`
          GROUP BY `item_id`
      ) tm ON si.`item_id`=tm.`item_id` AND si.`item_ex`=tm.`MinDate`";

    $stmt = $PDO->prepare($sql);
    $stmt->execute();
    $stock_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch(PDOException $e) {
    echo $e->getMessage();
  }
?>
<?php require 'includes/header_pharmacy.php'; ?>
<style type="text/css">
  footer.sticky-footer {
    width: 100%;
  }
  .content-wrapper {
    margin-left: 0;
  }
</style>


  <!-- Navigation-->  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html">AJ JR Pharmacy</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="pharmacy.php">Transaction</a>
        </li>
        <li class="nav-item">
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
        <li class="breadcrumb-item active">Point of Sales</li>
        <li class="breadcrumb-item"><strong><?=date("F d, Y");?></strong></li>
        </li>
      </ol>

      <div class="row">
        <div class="col-sm-6">

          <!-- All Items -->
          <?php require_once 'includes/p_all_items.php'; ?>
        </div>
        <div class="col-sm-6">

          <!-- POS -->
          <div class="card mb-3">
            <div class="card-header" style="background-color: #f34242;color:#fff">
              <i class="fa fa-shopping-cart"></i> Invoice</div>
            <div class="card-body">
              <div id="item-cart"></div>
            </div>
            <div class="card-footer small text-muted hide">Updated yesterday at 11:59 PM</div>
          </div>

        </div>
      </div><!--<div class="row">-->





<?php $total = 0; ?>
<?php
  foreach ($global_purchase_set as $c):
  $subTotal = $c['price'] * $c['qty'];   
  $total += $subTotal;
?>
<?php endforeach; ?>
















<?php require 'includes/footer.php'; ?>