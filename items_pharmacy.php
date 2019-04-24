<?php require_once 'includes/sessionsp.php'; ?>
<?php
  // database connection
  require_once 'database/connection.php';
  try {
    $stmt = $PDO->prepare("SELECT * FROM item");
    $stmt->execute();
    $all_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $row_num = $stmt->rowCount();

    $stmt = $PDO->prepare("SELECT * FROM category");
    $stmt->execute();
    $all_category = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        <li class="nav-item active" title="Items">
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
        <li class="nav-item active">
          <a class="nav-link" href="stocks_pharmacy.php">Inventory</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="sales_pharmacy.php">Reports</a>
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
        <li class="breadcrumb-item active">Items</li>
        </li>
      </ol>

      <div class="row">
        <div class="col-sm-12">
          <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#NewItem">New Item</a>
          <br></br>
          <!-- All Items -->
          <div class="card mb-3">
            <div class="card-header" style="background-color: #78ffae;">
              <i class="fa fa-table"></i> Item List</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="items" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Item Code</th>
                      <th>Item Name</th>
                      <th>Type</th>
                      <th>Sale Price</th>
                      <th>Retailer Price</th>
                      <th>Category</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($all_items as $i): ?>
                    <?php
                      $stmt = $PDO->prepare("SELECT * FROM category WHERE id='{$i['category_id']}'");
                      $stmt->execute();
                      $category = $stmt->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <tr>
                      <td><?=sprintf("%09d", $i['id']);?></td>
                      <td><?=$i['item_name'];?></td>
                      <td><?=$i['type'];?></td>
                      <td><?=num_format($i['sell_price']);?></td>
                      <td><?=num_format($i['buy_price']);?></td>
                      <td><?=$category['name'];?></td>
                      <td><a href="#" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#UpdateItem<?=$i['id'];?>">Update</a></td>
                    </tr>

    <!-- Update Item Modal-->
    <div class="modal fade" id="UpdateItem<?=$i['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Updating item</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          
          <form method="POST" action="process/update.php">

            <div class="modal-body">
                <div class="form-group">
                  <label>Item Code:</label>
                  <input type="text" class="form-control" disabled value="<?=sprintf("%09d", $i['id']);?>">
                  <input type="hidden" value="<?=$i['id'];?>" name="ic">
                </div>

                <div class="form-group">
                  <label>Item Name:</label>
                  <input type="text" name="in" class="form-control" value="<?=$i['item_name'];?>">
                </div>

                <div class="form-group">
                  <label>Type:</label>
                  <select class="form-control" name="it">
                    <option value="Tablet" <?php if ($i['type'] == "Tablet") { echo 'selected'; } ?>>Tablet</option>
                    <option value="Syrup" <?php if ($i['type'] == "Syrup") { echo 'selected'; } ?>>Syrup</option>
                    <option value="Cream" <?php if ($i['type'] == "Cream") { echo 'selected'; } ?>>Cream</option>
                    <option value="Capsule" <?php if ($i['type'] == "Capsule") { echo 'selected'; } ?>>Capsule</option>
                    <option value="Foods" <?php if ($i['type'] == "Foods") { echo 'selected'; } ?>>Foods</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>Category:</label>
                  <select class="form-control" name="icat">
                    <?php foreach ($all_category as $key) : ?>
                    <option value="<?=$key['id'];?>" <?php if ($i['category_id'] == $key['id']) { echo 'selected'; } ?>><?=$key['name'];?></option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="form-group">
                  <label>Sale Price:</label>
                  <input type="number" name="sp" class="form-control" value="<?=$i['sell_price'];?>">
                </div>

                <div class="form-group">
                  <label>Retailer Price:</label>
                  <input type="number" name="bp" class="form-control" value="<?=$i['buy_price'];?>">
                </div>
            </div>

            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <input type="submit" name="biu" class="btn btn-success" value="Save">
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

    <!-- Add Item Modal-->
    <div class="modal fade" id="NewItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Adding new item</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          
          <form method="POST" action="process/add.php">

            <div class="modal-body">
                <div class="form-group">
                  <label>Item Code:</label>
                  <input type="text" class="form-control" disabled value="<?=sprintf("%09d", $row_num+1);?>">
                </div>

                <div class="form-group">
                  <label>Item Name:</label>
                  <input type="text" name="in" class="form-control">
                </div>

                <div class="form-group">
                  <label>Type:</label>
                  <select class="form-control" name="it">
                    <option value="Tablet">Tablet</option>
                    <option value="Syrup">Syrup</option>
                    <option value="Cream">Cream</option>
                    <option value="Capsule">Capsule</option>
                    <option value="Foods">Foods</option>
                    <option value="Tablet">Services</option>
                    <option value="Tablet">Sales</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>Category:</label>
                  <select class="form-control" name="icat">
                    <?php foreach ($all_category as $key) : ?>
                    <option value="<?=$key['id'];?>"><?=$key['name'];?></option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="form-group">
                  <label>Sale Price:</label>
                  <input type="number" name="sp" class="form-control">
                </div>

                <div class="form-group">
                  <label>Retailer Price:</label>
                  <input type="number" name="bp" class="form-control">
                </div>
            </div>

            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <input type="submit" name="bi" class="btn btn-success" value="Save">
            </div>

          </form>
        </div>
      </div>
    </div>
<?php require 'includes/footer.php'; ?>