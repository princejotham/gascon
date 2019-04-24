<?php require_once 'includes/sessionsw.php'; ?>
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
<?php require 'includes/header_ws.php'; ?>


  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html">Blue Lagoon Water Refilling Station</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Point of Sales">
          <a class="nav-link" href="ws.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Point of Sales</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Stocks">
          <a class="nav-link" href="stocks_ws.php">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Stocks</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Bottles">
          <a class="nav-link" href="items_ws.php">
            <i class="fa fa-fw fa-book"></i>
            <span class="nav-link-text">Bottles</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Sales">
          <a class="nav-link" href="sales_ws.php">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Sales</span>
          </a>
        </li>
        <li class="nav-item active" data-toggle="tooltip" data-placement="right" title="Expenses">
          <a class="nav-link" href="expenses_ws.php">
            <i class="fa fa-fw fa-file"></i>
            <span class="nav-link-text">Expenses</span>
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
          <a href="ws.php">Water Station</a>
        <li class="breadcrumb-item active">Expenses</li>
        </li>
      </ol>

      <div class="row">
        <div class="col-sm-12">

          <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#NewExpenses">New Expense</a>
          <br></br>
          <!-- All Items -->
          <div class="card mb-3">
            <div class="card-header" style="background-color: #78ffae;">
              <i class="fa fa-table"></i> Expenses List</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="items" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Description</th>
                      <th>Price</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($all_expenses as $e): ?>
                    <tr>
                      <td><?=$e['expense'];?></td>
                      <td><?=$e['price'];?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted hide">Updated yesterday at 11:59 PM</div>
          </div>
        </div>
      </div><!--<div class="row">-->

    <!-- Add Bottle Modal-->
    <div class="modal fade" id="NewExpenses" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Adding new expense</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          
          <form method="POST" action="process/add.php">

            <div class="modal-body">
                <div class="form-group">
                  <label>Description:</label>
                  <input type="text" name="ed" class="form-control" required>
                </div>

                <div class="form-group">
                  <label>Price:</label>
                  <input type="number" name="ep" class="form-control" required>
                </div>
            </div>

            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <input type="submit" name="eb" class="btn btn-success" value="Save">
            </div>

          </form>
        </div>
      </div>
    </div>
<?php require 'includes/footer.php'; ?>