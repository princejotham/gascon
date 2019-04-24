<?php require_once 'includes/sessionsw.php'; ?>
<?php
  // database connection
  require_once 'database/connection.php';
  try {
    $stmt = $PDO->prepare("SELECT * FROM stock_bottle sb INNER JOIN bottle b ON sb.bottle_id = b.id;");
    $stmt->execute();
    $stock_bottle = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $PDO->prepare("SELECT * FROM customer;");
    $stmt->execute();
    $all_customer = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $PDO->prepare("SELECT * FROM cart_bottle;");
    $stmt->execute();
    $cart_bottles = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        <li class="nav-item" title="Customer">
          <a class="nav-link" href="#" data-toggle="modal" data-target="#NewCustomer">
            <span class="nav-link-text">Add Customer</span>
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
        <li class="nav-item active">
          <a class="nav-link" href="clients.php">Clients</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="stocks_ws.php">Inventory</a>
        </li>
        <li class="nav-item">
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
        <li class="breadcrumb-item active">Clients</li>
        <li class="breadcrumb-item"><strong><?=date("F d, Y");?></strong></li>
        </li>
      </ol>

      <div class="row">
        <div class="col-sm-12">

    <!-- Add Customer Modal-->
    <div class="modal fade" id="NewCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Adding New Customer</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>

          <form method="POST" action="process/add.php">

            <div class="modal-body">
                <div class="form-group">
                  <label>Customer Name:</label>
                  <input type="text" name="customer_name" class="form-control">
                </div>

                <div class="form-group">
                  <label>Address:</label>
                  <input type="text" name="customer_address" class="form-control">
                </div>
            </div>

            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <input type="submit" name="client_btn" class="btn btn-success" value="Save">
            </div>

          </form>
        </div>
      </div>
    </div>









          <!-- All Clients -->
          <div class="card mb-3">
            <div class="card-header" style="background-color: #78ffae;">
              All Clients</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="items" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Customer Name</th>
                      <th>Address</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($all_customer as $c): ?>
                      <tr>
                        <td><?=$c['c_name'];?></td>
                        <td><?=$c['c_address'];?></td>
                        <td>

                          <button type="button" class="btn btn-success btn-xs" style="padding:3px;" data-toggle="modal" data-target="#update_btn<?=$c['id'];?>">Update</button>

    <!-- Add Customer Modal-->
    <div class="modal fade" id="update_btn<?=$c['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Updating Customer</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>

          <form method="POST" action="process/update.php">

            <div class="modal-body">
                <div class="form-group">
                  <label>Customer Name:</label>
                  <input type="text" name="customer_name" class="form-control" value="<?=$c['c_name'];?>">
                  <input type="hidden" name="customer_id" value="<?=$c['id'];?>">
                </div>

                <div class="form-group">
                  <label>Address:</label>
                  <input type="text" name="customer_address" class="form-control" value="<?=$c['c_address'];?>">
                </div>
            </div>

            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <input type="submit" name="client_btn" class="btn btn-success" value="Save">
            </div>

          </form>
        </div>
      </div>
    </div>


                          <button type="button" class="btn btn-warning btn-xs" style="padding:3px;" data-toggle="modal" data-target="#CustomerDetails<?=$c['id'];?>">Details</button>


    <!-- Detail Customer Modal-->
    <div class="modal fade" id="CustomerDetails<?=$c['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Customer Details</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>

          <div class="modal-body">
            <h6>Customer Name: <?=$c['c_name'];?></h6>
            <h6>Customer Address: <?=$c['c_address'];?></h6>
            <br>

<div class="">
  <table class="table table-bordered" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>#</th>
        <th>Bottle Name</th>
        <th>Price</th>
      </tr>
    </thead>
    <tbody>

<?php
  $row_no = 1;
  try {
    $stmt = $PDO->prepare("SELECT * FROM sales_trans WHERE `cus_id`=?;");
    $stmt->bindValue(1, $c['id'], PDO::PARAM_STR);
    $stmt->execute();
    $s_trans = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch(PDOException $e) {
    echo $e->getMessage();
  }
?>

      <?php foreach ($s_trans as $s_t): ?>

<?php
  try {
    $stmt = $PDO->prepare("SELECT * FROM bottle_sales WHERE `tran_id`=?;");
    $stmt->bindValue(1, $s_t['trans_no'], PDO::PARAM_STR);
    $stmt->execute();
    $b_sale = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch(PDOException $e) {
    echo $e->getMessage();
  }
?>
      <?php foreach ($b_sale as $bs): ?>

        <tr>
          <td><?=$row_no++;?></td>
          <td><?=$bs['b_name'];?> <?=$bs['stock_id'];?></td>
          <td><?=$bs['price'];?></td>
        </tr>
      <?php endforeach; ?>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
          </div>

          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>
                        </td>
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
<?php require 'includes/footer.php'; ?>