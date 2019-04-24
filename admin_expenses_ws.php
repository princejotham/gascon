<?php require_once 'includes/sessions.php'; ?>
<?php
  // database connection
  require_once 'database/connection.php';
  try {
    $stmt = $PDO->prepare("SELECT * FROM expenses");
    $stmt->execute();
    $all_expenses = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        <li class="nav-item active" data-toggle="tooltip" data-placement="right" title="Monitoring">
          <a class="nav-link" href="monitoring.php">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Monitoring</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Financial">
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
          <a href="monitoring.php">Monitoring</a>
        <li class="breadcrumb-item active">Water Station</li>
        <li class="breadcrumb-item active">Worker Expenses</li>
        </li>
      </ol>

      <div class="row">
        <div class="col-sm-12">
          <button class="btn btn-success btn-sm" id="report_expenses">PRINT EXPENSES
              <span class="fa fa-print" aria-hidden="true"></span>
          </button>
          <br></br>
          <!-- All Expenses -->
          <div class="card mb-3">
            <div class="card-header" style="background-color: #78ffae;">
              <i class="fa fa-table"></i> All Expenses</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="items" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Expense</th>
                      <th>Price</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $total=0; ?>
                    <?php foreach ($all_expenses as $e): ?>
                    <?php
                      $total+=$e['price'];
                    ?>
                    <tr>
                      <td><?=$e['expense'];?></td>
                      <td><?=$e['price'];?></td>
                      <td><?=date("F d, Y", strtotime($e['e_date']));?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>

                    <tr>
                      <td colspan="3" style="text-align: right;font-weight: bold;">Total Price: <?=$total;?></td>
                    </tr>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted hide">Updated yesterday at 11:59 PM</div>
          </div>
        </div>
      </div><!--<div class="row">-->
<?php require 'includes/footer.php'; ?>