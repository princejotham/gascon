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
        <li class="nav-item active" title="Yearly Sales">
          <a class="nav-link" href="sales_ws_yearly.php">
            <span class="nav-link-text">Yearly Sales</span>
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
            <div class="col-sm-7">
              <a class="btn btn-primary" href="#" id="sale-report_ws_yearly">Print Sales</a>
            </div>
            <div class="col-sm-5" style="text-align: right;">

                <form id="select-year-water">
                  <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                      <strong>Yearly Sales:</strong>
                    </div>

                    <div class="col-sm-3" style="padding-right: 0;padding-left: 0;">
                      <select class="form-control" name="year" id="year">
                          <option value="2018" <?php if(date("y") == "2018") { echo "selected"; } ?>>2018</option>
                          <option value="2019" <?php if(date("y") == "2019") { echo "selected"; } ?>>2019</option>
                          <option value="2020" <?php if(date("y") == "2020") { echo "selected"; } ?>>2020</option>
                          <option value="2021" <?php if(date("y") == "2021") { echo "selected"; } ?>>2021</option>
                          <option value="2022" <?php if(date("y") == "2022") { echo "selected"; } ?>>2022</option>
                      </select>
                    </div>

                  </div><!-- ./row -->
                </form>

            </div>
          </div>
          <!-- All Items -->
          <div id="sales_table_water"></div>
        </div>
      </div><!--<div class="row">-->
<?php require 'includes/footer.php'; ?>