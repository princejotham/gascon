<?php
  require_once 'includes/sessions.php';
  // database connection
  require_once 'database/connection.php';
  try {
    $stmt = $PDO->prepare("SELECT SUM(sub_total) AS ST FROM bottle_sales");
    $stmt->execute();
    $btp = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $PDO->prepare("SELECT SUM(sub_total) AS ST FROM item_sales");
    $stmt->execute();
    $itp = $stmt->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $e) {
    echo $e->getMessage();
  }

?>
<?php include 'includes/header.php'; ?>
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html">Administrator/Owner</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item active" data-toggle="tooltip" data-placement="right" title="Dashboard">
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
          <a href="index.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Dashboard</li>
      </ol>
      <!-- Icon Cards-->
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-shopping-cart"></i>
              </div>
              <div class="mr-5"><h1>PHP<br><small><?=number_format($btp["ST"], 2);?></small></h1></div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
              <span fclass="float-left">Total Sales in Water Station</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-shopping-cart"></i>
              </div>
              <div class="mr-5"><h1>PHP<br><small><?=number_format($itp["ST"], 2);?></small></h1></div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left">Total Sales in Pharmacy</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-shopping-cart"></i>
              </div>
              <div class="mr-5"><h1>PHP<br><small><?=number_format($itp["ST"]+$btp["ST"], 2);?></small></h1></div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left">Over All Total Sales</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
      </div><!--<div class="row">-->


<?php require_once 'includes/sales_table.php'; ?>
<?php include 'includes/footer.php'; ?>