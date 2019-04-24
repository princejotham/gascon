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
        <li class="nav-item" title="Daily Expenses">
          <a class="nav-link" href="expenses_ws_daily.php">
            <span class="nav-link-text">Daily Expenses</span>
          </a>
        </li>
        <li class="nav-item active" title="Monthly Expenses">
          <a class="nav-link" href="expenses_ws_monthly.php">
            <span class="nav-link-text">Monthly Expenses</span>
          </a>
        </li>
        <li class="nav-item" title="Yearly Expenses">
          <a class="nav-link" href="expenses_ws_yearly.php">
            <span class="nav-link-text">Yearly Expenses</span>
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
        <li class="breadcrumb-item active">Monthly Expenses</li>
        </li>
      </ol>

      <div class="row">
        <div class="col-sm-12">
            <div class="row" style="padding-top: 1em;padding-bottom: 1em;">
            <div class="col-sm-7">
              <a class="btn btn-primary" href="#" id="expenses-report_ws_daily">Print Expenses</a>
            </div>
            <div class="col-sm-5" style="text-align: right;">
                <form id="select-month-ex">
                  <div class="row">
                    <div class="col-sm-4">
                      <strong>Monthly Sales:</strong>
                    </div>

                    <div class="col-sm-4" style="padding-left: 0;">
                      <select class="form-control" name="month" id="month">
                          <option value="01" <?php if(date("m") == "01") { echo "selected"; } ?>>January</option>
                          <option value="02" <?php if(date("m") == "02") { echo "selected"; } ?>>Febuary</option>
                          <option value="03" <?php if(date("m") == "03") { echo "selected"; } ?>>March</option>
                          <option value="04" <?php if(date("m") == "04") { echo "selected"; } ?>>April</option>
                          <option value="05" <?php if(date("m") == "05") { echo "selected"; } ?>>May</option>
                          <option value="06" <?php if(date("m") == "06") { echo "selected"; } ?>>June</option>
                          <option value="07" <?php if(date("m") == "07") { echo "selected"; } ?>>July</option>
                          <option value="08" <?php if(date("m") == "08") { echo "selected"; } ?>>August</option>
                          <option value="09" <?php if(date("m") == "09") { echo "selected"; } ?>>September</option>
                          <option value="10" <?php if(date("m") == "10") { echo "selected"; } ?>>October</option>
                          <option value="11" <?php if(date("m") == "11") { echo "selected"; } ?>>November</option>
                          <option value="12" <?php if(date("m") == "12") { echo "selected"; } ?>>December</option>
                      </select>
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
          <div id="expenses_table_water"></div>
        </div>
      </div><!--<div class="row">-->
<?php require 'includes/footer.php'; ?>