<?php require_once 'includes/sessions.php'; ?>
<?php
  // database connection
  require_once 'database/connection.php';
  try {
    if (isset($_GET['year'])) {
      $stmt = $PDO->prepare("SELECT * FROM bottle_sales WHERE sales_date LIKE ?");
      $stmt->bindValue(1, $_GET['year'] . "%", PDO::PARAM_STR);
      $stmt->execute();
      $bottle_sales = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    } else {
      $stmt = $PDO->prepare("SELECT * FROM bottle_sales");
      $stmt->execute();
      $bottle_sales = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
  } catch(PDOException $e) {
    echo $e->getMessage();
  }
?>
<?php require 'includes/header.php'; ?>

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
        <li class="breadcrumb-item active">Water Station</li>
        <li class="breadcrumb-item active">Sales</li>
        </li>
      </ol>

      <div class="row">
        <div class="col-sm-12">
            <div class="row" style="padding-top: 1em;padding-bottom: 1em;">
              <div class="col-sm-6">
                <button class="btn btn-success btn-sm" id="sale-report_wsy">PRINT SALES
                    <span class="fa fa-print" aria-hidden="true"></span>
                </button>
                <a href="admin_financial_ws.php" class="btn btn-primary btn-sm">Daily Sales</a>
                <a href="admin_financial_ws_monthly.php" class="btn btn-primary btn-sm">Monthly Sales</a>
                <a href="admin_financial_ws_yearly.php" class="btn btn-primary btn-sm active">Yearly Sales</a>
              </div>
              <div class="col-sm-6" style="text-align: right;">
                <form action="admin_financial_ws_yearly.php" method="GET">
                  <div class="row">
                    <div class="col-sm-4" style="padding-left: 0;">
                    </div>
                    <div class="col-sm-4">
                      <strong>Yearly Sales:</strong>
                    </div>

                    <div class="col-sm-2" style="padding-right: 0;padding-left: 0;">
                      <select class="form-control" name="year" id="year">
                          <option value="2018" <?php if(isset($_GET['year'])) { if($_GET['year'] == "2018") {echo 'selected';} } 
                                                      else { if(date("Y") == "2018") { echo "selected"; } } ?>>2018</option>
                          <option value="2019" <?php if(isset($_GET['year'])) { if($_GET['year'] == "2019") {echo 'selected';} } 
                                                      else { if(date("Y") == "2019") { echo "selected"; } } ?>>2019</option>
                          <option value="2020" <?php if(isset($_GET['year'])) { if($_GET['year'] == "2020") {echo 'selected';} } 
                                                      else { if(date("Y") == "2020") { echo "selected"; } } ?>>2020</option>
                          <option value="2021" <?php if(isset($_GET['year'])) { if($_GET['year'] == "2021") {echo 'selected';} } 
                                                      else { if(date("Y") == "2021") { echo "selected"; } } ?>>2021</option>
                          <option value="2022" <?php if(isset($_GET['year'])) { if($_GET['year'] == "2022") {echo 'selected';} } 
                                                      else { if(date("Y") == "2022") { echo "selected"; } } ?>>2022</option>
                      </select>
                    </div>

                    <div class="col-sm-2">
                     <input type="submit" name="btn_month" class="btn btn-warning btn-sm" value="Select">
                    </div>

                  </div>
                </form>
              </div>
          </div>

          <!-- All Items -->
          <div class="card mb-3">
            <div class="card-header" style="background-color: #78ffae;">
              <i class="fa fa-table"></i> All Sales</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="items" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Transaction No.</th>
                      <th>Bottle No.</th>
                      <th>Bottle Name</th>
                      <th>Price</th>
                      <th>Qty</th>
                      <th>Sub Total</th>
                      <th>Customer Name</th>
                      <th>Address</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $total = 0; ?>
                    
                    <?php foreach ($bottle_sales as $b): ?>
                    
                    <?php
                      $subTotal = $b['price'] * $b['qty'];   
                      $total += $subTotal;
                    ?>
                      
                    <tr>
                      <td><?=sprintf("%07d", $b["tran_id"]);?></td>
                      <td><?php if($b["bottle_no"] != 0) { echo $b["bottle_no"]; } ?></td>
                      <td><?=$b["b_name"];?></td>
                      <td><?=$b["price"];?></td>
                      <td><?=$b["qty"];?></td>
                      <td><?=$b["sub_total"];?></td>
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
                      <td><?=$stock_b['cu_name'];?></td>
                      <td><?=$stock_b['cu_add'];?></td>
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