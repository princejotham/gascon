<?php require_once 'includes/sessionsw.php'; ?>
<?php require 'includes/header_ws.php'; ?>


  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html">Blue Lagoon Water Refilling Station</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item active" title="Daily Sales">
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
        <li class="nav-item" title="Expenses">
          <a class="nav-link" href="expenses_ws_daily.php">
            <span class="nav-link-text">Expenses</span>
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
        <li class="breadcrumb-item active">Daily Sales</li>
        </li>
      </ol>

      <div class="row">
        <div class="col-sm-12">
            <div class="row" style="padding-top: 1em;padding-bottom: 1em;">
            <div class="col-sm-8">
              <a class="btn btn-primary" href="#" id="sale-report_ws_daily">Print Sales</a>
            </div>
            <div class="col-sm-4" style="text-align: right;">
              <form id="select-date-water">
                <strong>Daily Sales:</strong>
                <input type="date" id="sd" class="btn btn-default btn-sm" value="<?php if(isset($_GET['dailyDate'])) { echo $_GET['dailyDate']; } else { echo date("Y-m-d"); } ?>">
              </form>
            </div>
          </div>
          <!-- All Items -->
          <div id="sales_table_water"></div>
        </div>
      </div><!--<div class="row">-->
<?php require 'includes/footer.php'; ?>