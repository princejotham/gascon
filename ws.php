<?php require_once 'includes/sessionsw.php'; ?>
<?php
  // database connection
  require_once 'database/connection.php';
  try {
    $stmt = $PDO->prepare("SELECT * FROM stock_bottle sb INNER JOIN bottle b ON sb.bottle_id = b.id WHERE `bottle_qty`=1;");
    $stmt->execute();
    $stock_bottle = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $PDO->prepare("SELECT * FROM customer;");
    $stmt->execute();
    $all_customer = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $PDO->prepare("SELECT * FROM cart_bottle;");
    $stmt->execute();
    $cart_bottles = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $PDO->prepare("SELECT * FROM expenses;");
    $stmt->execute();
    $expenses = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        <li class="nav-item" title="Expense">
          <a class="nav-link" href="#" data-toggle="modal" data-target="#NewExpense">
            <span class="nav-link-text">Expense</span>
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
        <li class="nav-item active">
          <a class="nav-link" href="ws.php">Transaction</a>
        </li>
        <li class="nav-item">
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
        <li class="breadcrumb-item active">Point of Sales</li>
        <li class="breadcrumb-item"><strong><?=date("F d, Y");?></strong></li>
        </li>
      </ol>

      <div class="row">
        <div class="col-sm-6">

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
              <input type="submit" name="customer_btn" class="btn btn-success" value="Save">
            </div>

          </form>
        </div>
      </div>
    </div>

    <!-- Add Expense Modal-->
    <div class="modal fade" id="NewExpense" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Adding New Expense</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>

          <form method="POST" action="process/add.php">

            <div class="modal-body">
                <div class="form-group">
                  <label>Expense Description:</label>
                  <input type="text" name="expense_desc" class="form-control">
                </div>

                <div class="form-group">
                  <label>Price:</label>
                  <input type="text" name="expense_price" class="form-control">
                </div>

                <div class="form-group">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                  <input type="submit" name="expense_btn" class="btn btn-success" value="Save">
                </div>
            </div>

            <div class="modal-footer">
              <!-- all expenses -->
                  <div class="col-sm-12">
                    <h3>All Expenses</h3>
              <div class="table-responsive">
                <table class="table table-bordered" id="expenses" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Expense Description</th>
                      <th>Amount</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($expenses as $e): ?>
                      <tr>
                        <td><?=$e['expense'];?></td>
                        <td><?=$e['price'];?></td>
                        <td><?=date("F d, Y", strtotime($e['e_date']));?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
                  </div>
            </div><!-- end modal footer -->

          </form>
        </div>
      </div>
    </div>

          <form method="POST" action="process/add.php">

                <div class="row">
                  <div class="col-sm-9">
                    
                    <div class="form-group">
                      <label>Customer Name:</label>
                      <select class="form-control" name="customer" required>
                        <option value="">Please select customer</option>
                        <?php foreach ($all_customer as $c): ?>
                        <option value="<?=$c['id'];?>" <?php if(isset($_GET['c_id'])) { if($_GET['c_id'] == $c['id']) { echo " selected"; } } ?>><?=$c['c_name'];?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>

                  </div>
                  <div class="col-sm-3">

                    <div class="form-group">
                      <input type="submit" name="select_cus" class="btn btn-warning" value="Select" style="margin-top: 30px;">
                    </div>

                  </div>
                </div>

          </form>

          <!-- All Bottles -->
          <div class="card mb-3">
            <div class="card-header" style="background-color: #78ffae;">
              <i class="fa fa-table"></i> Bottles</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="items" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Bottle Name</th>
                      <th>Price</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
<?php
  $ALL_BOTTLES = allBottles();
  foreach ($ALL_BOTTLES as $_bottle):
    $total_qty = countStocksByBottleID($_bottle['id']);
    // echo $_bottle['bottle_name'] . ': ' . $total_qty['qty'] . '<br>';
  endforeach;
?>
                    <?php foreach ($stock_bottle as $b): ?>
                      <tr>
                        <?php if ($b['bottle_name'] != "Water Jag"): ?>
                          <td><?=$b['bottle_name'];?></td>
                        <?php else: ?>
                         <td><?=$b['bottle_name'];?> <?=$b['s_id'];?></td>
                        <?php endif; ?>
                        <td><?=$b['price'];?></td>
                        <td>
                          <form method="POST" action="process/add.php">
                            <input type="hidden" name="sbid" value="<?=$b['s_id'];?>">
                            <input type="hidden" name="bid" value="<?=$b['id'];?>">
                            <input type="hidden" name="bp" value="<?=$b['price'];?>">
                            <input type="hidden" name="bname" value="<?=$b['bottle_name'];?>">
                            <?php if (isset($_GET["c_id"]) AND isset($_GET["c_name"])): ?>
                              <input type="hidden" name="c_name" value="<?=$_GET['c_name'];?>">
                              <input type="hidden" name="c_address" value="<?=$_GET['c_address'];?>">
                              <input type="hidden" name="c_id" value="<?=$_GET['c_id'];?>">
                            <?php else: ?>
                              <input type="hidden" name="c_name" value="">
                              <input type="hidden" name="c_address" value="">
                              <input type="hidden" name="c_id" value="">
                            <?php endif; ?>
                            <button type="submit" name="ba_cart" class="btn btn-success btn-xs" style="padding:3px;"><i class="fa fa-cart-plus"></i></button>
                          </form>
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
        <div class="col-sm-6">

          <!-- POS -->
          <div class="card mb-3">
            <div class="card-header" style="background-color: #f34242;color:#fff">
              <i class="fa fa-shopping-cart"></i> Invoice</div>
            <div class="card-body">

              <a href="#" class="btn btn-primary btn-xs" style="color:#fff;float:right;margin-left: 10px;" data-toggle="modal" data-target="#return">Return</a>
              <a href="#" class="btn btn-danger btn-xs" style="color:#fff;float:right;" data-toggle="modal" data-target="#refill">Refill</a>

    <!-- Add Refill Modal-->
    <div class="modal fade" id="refill" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Customer Refill</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>

            <div class="modal-body">
              <?php if (isset($_GET["c_id"])): ?>


<h6>Customer Name: <?=$_GET['c_name'];?></h6>
<h6>Customer Address: <?=$_GET['c_address'];?></h6>
<br>

<div class="table-responsive">
  <table class="table table-bordered" id="refill_cus" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>Bottle Name</th>
        <th>Price</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
<?php
  try {
    $stmt = $PDO->prepare("SELECT * FROM sales_trans WHERE `cus_id`=?;");
    $stmt->bindValue(1, $_GET['c_id'], PDO::PARAM_STR);
    $stmt->execute();
    $s_trans = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch(PDOException $e) {
    echo $e->getMessage();
  }
?>

      <?php foreach ($s_trans as $s_t): ?>

<?php
  try {
    //$stmt = $PDO->prepare("SELECT * FROM bottle_sales WHERE `tran_id`=?;");
$sql = "SELECT bs.`id`, bs.`stock_id`, bs.`b_name`, bs.`price`, bs.`tran_id` FROM `bottle_sales` bs
        INNER JOIN (
          SELECT `stock_id`, MAX(`tran_id`) AS MinID
            FROM `bottle_sales`
            GROUP BY `stock_id`
        ) tm ON bs.`stock_id`=tm.`stock_id` AND bs.`tran_id`=tm.`MinID` WHERE bs.`tran_id`=? AND bs.`return_bot` = 0";
    $stmt = $PDO->prepare($sql);
    $stmt->bindValue(1, $s_t['trans_no'], PDO::PARAM_STR);
    $stmt->execute();
    $b_sale = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch(PDOException $e) {
    echo $e->getMessage();
  }
?>
      <?php foreach ($b_sale as $bs): ?>

<?php if ($bs['b_name'] == "Water Jag"): ?>

        <tr>
          <td><?=$bs['b_name'];?> <?=$bs['stock_id'];?></td>
          <td><?=$bs['price'];?></td>
          <td>
            <form method="POST" action="process/add.php">
              <input type="hidden" name="sbid" value="<?=$bs['stock_id'];?>">
              <input type="hidden" name="bname" value="<?=$bs['b_name'];?>">
              <input type="hidden" name="bp" value="<?=$bs['price'];?>">
              <input type="hidden" name="refill" value="1">

              <?php if (isset($_GET["c_id"]) AND isset($_GET["c_name"])): ?>
                <input type="hidden" name="c_name" value="<?=$_GET['c_name'];?>">
                <input type="hidden" name="c_address" value="<?=$_GET['c_address'];?>">
                <input type="hidden" name="c_id" value="<?=$_GET['c_id'];?>">
              <?php else: ?>
                <input type="hidden" name="c_name" value="">
                <input type="hidden" name="c_address" value="">
                <input type="hidden" name="c_id" value="">
              <?php endif; ?>
              <button type="submit" name="ba_cart_refill" class="btn btn-success btn-xs" style="padding:3px;"><i class="fa fa-cart-plus"></i></button>
            </form>
          </td>
        </tr>
<?php endif; ?>
      <?php endforeach; ?>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>






              <?php else: ?>  
              <h5>Please select customer</h5>
              <?php endif; ?>
            </div>

            <div class="modal-footer">
            </div><!-- end modal footer -->

          </form>
        </div>
      </div>
    </div><!-- end modal -->

<?php include 'includes/return.php'; ?>
              <?php if (isset($_GET["c_name"]) AND isset($_GET["c_address"])): ?>
                <h6>Customer Name: <?=$_GET['c_name']?></h6>
                <h6>Address: <?=$_GET['c_address']?></h6>
              <?php else: ?>
                <h6>Customer Name: </h6>
                <h6>Address: </h6>
              <?php endif; ?>
              <div class="table-responsive">
                <table class="table table-bordered" id="pos" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Bottle Name</th>
                      <th>Price</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php $total = 0; $no=1; ?>

                    <?php if (isset($_GET["c_name"]) AND isset($_GET["c_address"])): ?>
                      <?php foreach ($cart_bottles as $c): ?>
                      <?php
                        $subTotal = $c['price'] * $c['qty'];   
                        $total += $subTotal;
                      ?>    
                      <tr>
                        <td><?=$no++;?></td>
                        <?php if ($c['b_name'] == "Water Jag"): ?>
                        <td><?=$c['b_name'];?> <?=$c['stock_id'];?></td>
                        <?php else: ?>
                        <td><?=$c['b_name'];?></td>
                        <?php endif; ?>
                        <td><?=$c['price'];?></td>
                        <td>
                          <form method="POST" action="process/delete.php">
                            <input type="hidden" name="cid" value="<?=$c['c_id'];?>">
                            <input type="hidden" name="qty" value="<?=$c['qty'];?>">
                            <input type="hidden" name="sid" value="<?=$c['stock_id'];?>">
                            <?php if (isset($_GET["c_id"]) AND isset($_GET["c_name"])): ?>
                              <input type="hidden" name="c_id" value="<?=$_GET['c_id'];?>">
                              <input type="hidden" name="c_name" value="<?=$_GET['c_name'];?>">
                              <input type="hidden" name="c_address" value="<?=$_GET['c_address'];?>">
                            <?php else: ?>
                              <input type="hidden" name="c_id" value="">
                              <input type="hidden" name="c_name" value="">
                              <input type="hidden" name="c_address" value="">
                            <?php endif; ?>
                            <button type="submit" class="btn btn-danger btn-xs" name="cb_del_btn" style="padding:3px;">
                              <i class="fa fa-trash"></i>
                            </button>
                          </form>
                        </td>
                      </tr>

                      <?php endforeach; ?>
                    <?php endif; ?>
                  </tbody>
                    <tr>
                      <form method="POST" action="process/add.php">
                        <input type="hidden" name="c_id" value="<?php if($_GET['c_id'] == "") { echo "-1"; } else { echo $_GET['c_id']; };?>">
                        <td colspan="3"><button type="submit" name="bottle_btn_confirm" class="btn btn-success btn-xs btn-block">Confirm <i class="fa fa-cart-plus"></i></button></td>
                      </form>
                      <td>Total: <?=$total;?></td>
                    </tr>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted hide">Updated yesterday at 11:59 PM</div>
          </div>

        </div>
      </div><!--<div class="row">-->
<?php require 'includes/footer.php'; ?>