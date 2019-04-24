<?php require_once 'includes/sessions.php'; ?>
<?php
  // database connection
  require_once 'database/connection.php';
  try {
    if (isset($_GET['month'])) {
      $stmt = $PDO->prepare("SELECT * FROM item_sales WHERE sales_date LIKE ?");
      $stmt->bindValue(1, $_GET['year'] . "-" . $_GET['month'] . "%", PDO::PARAM_STR);
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
        <li class="breadcrumb-item active">Pharmacy</li>
        <li class="breadcrumb-item active">Sales</li>
        </li>
      </ol>

      <div class="row">
        <div class="col-sm-12">
              <div class="row" style="padding-top: 1em;padding-bottom: 1em;">
              <div class="col-sm-6">
                <button class="btn btn-success btn-sm" id="sale-reportm">PRINT SALES
                    <span class="fa fa-print" aria-hidden="true"></span>
                </button>
                <a href="admin_financial_pharmacy.php" class="btn btn-primary btn-sm">Daily Sales</a>
                <a href="admin_financial_pharmacy_monthly.php" class="btn btn-primary btn-sm active">Monthly Sales</a>
                <a href="admin_financial_pharmacy_yearly.php" class="btn btn-primary btn-sm">Yearly Sales</a>
              </div>
              <div class="col-sm-6" style="text-align: right;">
                <form action="admin_financial_pharmacy_monthly.php" method="GET">
                  <div class="row">
                    <div class="col-sm-4">
                      <strong>Monthly Sales:</strong>
                    </div>

                    <div class="col-sm-4" style="padding-left: 0;">
                      <select class="form-control" name="month" id="month">
                          <option value="01" <?php if(isset($_GET['month'])) { if($_GET['month'] == "01") {echo 'selected';} } 
                                                    else { if(date("m") == "01") { echo "selected"; } } ?>>January</option>
                          <option value="02" <?php if(isset($_GET['month'])) { if($_GET['month'] == "02") {echo 'selected';} } 
                                                    else { if(date("m") == "02") { echo "selected"; } } ?>>Febuary</option>
                          <option value="03" <?php if(isset($_GET['month'])) { if($_GET['month'] == "03") {echo 'selected';} }
                                                    else { if(date("m") == "03") { echo "selected"; } } ?>>March</option>
                          <option value="04" <?php if(isset($_GET['month'])) { if($_GET['month'] == "04") {echo 'selected';} }
                                                    else { if(date("m") == "04") { echo "selected"; } } ?>>April</option>
                          <option value="05" <?php if(isset($_GET['month'])) { if($_GET['month'] == "05") {echo 'selected';} }
                                                    else { if(date("m") == "05") { echo "selected"; } } ?>>May</option>
                          <option value="06" <?php if(isset($_GET['month'])) { if($_GET['month'] == "06") {echo 'selected';} }
                                                    else { if(date("m") == "06") { echo "selected"; } } ?>>June</option>
                          <option value="07" <?php if(isset($_GET['month'])) { if($_GET['month'] == "07") {echo 'selected';} }
                                                    else { if(date("m") == "07") { echo "selected"; } } ?>>July</option>
                          <option value="08" <?php if(isset($_GET['month'])) { if($_GET['month'] == "08") {echo 'selected';} }
                                                    else { if(date("m") == "08") { echo "selected"; } } ?>>August</option>
                          <option value="09" <?php if(isset($_GET['month'])) { if($_GET['month'] == "09") {echo 'selected';} }
                                                    else { if(date("m") == "09") { echo "selected"; } } ?>>September</option>
                          <option value="10" <?php if(isset($_GET['month'])) { if($_GET['month'] == "10") {echo 'selected';} }
                                                    else { if(date("m") == "10") { echo "selected"; } } ?>>October</option>
                          <option value="11" <?php if(isset($_GET['month'])) { if($_GET['month'] == "11") {echo 'selected';} }
                                                    else { if(date("m") == "11") { echo "selected"; } } ?>>November</option>
                          <option value="12" <?php if(isset($_GET['month'])) { if($_GET['month'] == "12") {echo 'selected';} }
                                                    else { if(date("m") == "12") { echo "selected"; } } ?>>December</option>
                      </select>
                    </div>

                    <div class="col-sm-2" style="padding-right: 0;padding-left: 0;">
                      <select class="form-control" name="year" id="year">
                          <option value="2018" <?php if(isset($_GET['year'])) { if($_GET['year'] == "2018") {echo 'selected';} } ?>>2018</option>
                          <option value="2019" <?php if(isset($_GET['year'])) { if($_GET['year'] == "2019") {echo 'selected';} } ?>>2019</option>
                          <option value="2020" <?php if(isset($_GET['year'])) { if($_GET['year'] == "2020") {echo 'selected';} } ?>>2020</option>
                          <option value="2021" <?php if(isset($_GET['year'])) { if($_GET['year'] == "2021") {echo 'selected';} } ?>>2021</option>
                          <option value="2022" <?php if(isset($_GET['year'])) { if($_GET['year'] == "2022") {echo 'selected';} } ?>>2022</option>
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
            <div class="card-footer small text-muted hide">Updated yesterday at 11:59 PM</div>
          </div>
        </div>
      </div><!--<div class="row">-->
<?php require 'includes/footer.php'; ?>