<?php require_once 'includes/sessionsw.php'; ?>
<?php
  // database connection
  require_once 'database/connection.php';
  try {
    $stmt = $PDO->prepare("SELECT * FROM bottle");
    $stmt->execute();
    $all_bottles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $row_num = $stmt->rowCount();
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
        <li class="nav-item" title="Stocks">
          <a class="nav-link" href="stocks_ws.php">
            <span class="nav-link-text">Stocks</span>
          </a>
        </li>
        <li class="nav-item active" title="Bottles">
          <a class="nav-link" href="items_ws.php">
            <span class="nav-link-text">Bottles</span>
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
          <a class="nav-link" href="ws.php">Transaction</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="clients.php">Clients</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="stocks_ws.php">Inventory</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="sales_ws.php">Reports</a>
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
        <li class="breadcrumb-item active">Items</li>
        </li>
      </ol>

      <div class="row">
        <div class="col-sm-12">

          <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#NewBottle">New Bottle</a>
          <br></br>
          <!-- All Items -->
          <div class="card mb-3">
            <div class="card-header" style="background-color: #78ffae;">
              <i class="fa fa-table"></i> Bottle List</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="items" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th class="hide">Bottle Code</th>
                      <th>Bottle Name</th>
                      <th>Price</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($all_bottles as $b): ?>
                    <tr>
                      <td class="hide"><?=sprintf("%09d", $b['id']);?></td>
                      <td><?=$b['bottle_name'];?></td>
                      <td><?=$b['price'];?></td>
                      <td><a href="#" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#UpdateBottle<?=$b['id'];?>">Update</a></td>
                    </tr>

    <!-- edit Bottle Modal-->
    <div class="modal fade" id="UpdateBottle<?=$b['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Adding new bottle</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          
          <form method="POST" action="process/update.php">

            <div class="modal-body">
                <div class="form-group hide">
                  <label>Bottle Code:</label>
                  <input type="hidden" name="id" value="<?=$b['id'];?>">
                  <input type="text" class="form-control" disabled value="<?=sprintf("%09d", $b['id']);?>">
                </div>

                <div class="form-group">
                  <label>Bottle Name:</label>
                  <input type="text" name="bn" class="form-control" value="<?=$b['bottle_name'];?>">
                </div>

                <div class="form-group">
                  <label>Price:</label>
                  <input type="number" name="bp" class="form-control" value="<?=$b['price'];?>">
                </div>
            </div>

            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <input type="submit" name="ubb" class="btn btn-success" value="Save">
            </div>

          </form>
        </div>
      </div>
    </div>
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
    <div class="modal fade" id="NewBottle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Adding new bottle</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          
          <form method="POST" action="process/add.php">

            <div class="modal-body">
                <div class="form-group hide">
                  <label>Bottle Code:</label>
                  <input type="text" class="form-control" disabled value="<?=sprintf("%09d", $row_num+1);?>">
                </div>

                <div class="form-group">
                  <label>Bottle Name:</label>
                  <input type="text" name="bn" class="form-control">
                </div>

                <div class="form-group">
                  <label>Price:</label>
                  <input type="number" name="bp" class="form-control">
                </div>
            </div>

            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <input type="submit" name="bb" class="btn btn-success" value="Save">
            </div>

          </form>
        </div>
      </div>
    </div>
<?php require 'includes/footer.php'; ?>