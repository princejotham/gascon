<?php require_once 'includes/sessionsp.php'; ?>
<?php
  // database connection
  require_once 'database/connection.php';
  try {
    $stmt = $PDO->prepare("SELECT * FROM category");
    $stmt->execute();
    $all_category = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $row_num = $stmt->rowCount();
  } catch(PDOException $e) {
    echo $e->getMessage();
  }
?>
<?php require 'includes/header_pharmacy.php'; ?>



  <!-- Navigation-->  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html">AJ JR Pharmacy</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" title="Stocks">
          <a class="nav-link" href="stocks_pharmacy.php">
            <span class="nav-link-text">Stocks</span>
          </a>
        </li>
        <li class="nav-item" title="Category">
          <a class="nav-link" href="category_pharmacy.php">
            <span class="nav-link-text">Category</span>
          </a>
        </li>
        <li class="nav-item" title="Items">
          <a class="nav-link" href="items_pharmacy.php">
            <span class="nav-link-text">Items</span>
          </a>
        </li>
        <li class="nav-item" title="Expired">
          <a class="nav-link" href="expired_pharmacy.php">
            <span class="nav-link-text">Expired</span>
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
          <a class="nav-link" href="pharmacy.php">Transaction</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="stocks_pharmacy.php">Inventory</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="category_pharmacy_reports.php">Reports</a>
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
        <li class="breadcrumb-item active">Reports</li>
        </li>
      </ol>

      <div class="row">
        <?php foreach ($all_category as $key): ?>
        <div class="col-sm-3">
          <div class="well">
            <a href="sales_pharmacy.php?cat=<?=$key['id'];?>"><h3 class="p-3 text-center"><?=$key['name']?></h3></a>
          </div>
        </div>
        <?php endforeach; ?>
      </div><!--<div class="row">-->

    <!-- Add Item Modal-->
    <div class="modal fade" id="NewCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Adding new category</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          
          <form method="POST" action="process/add.php">

            <div class="modal-body">

                <div class="form-group">
                  <label>Category Name:</label>
                  <input type="text" name="cn" class="form-control" required>
                </div>

            </div>

            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <input type="submit" name="ci" class="btn btn-success" value="Save">
            </div>

          </form>
        </div>
      </div>
    </div>
<?php require 'includes/footer.php'; ?>