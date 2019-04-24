<?php require_once 'includes/sessionsp.php'; ?>
<?php require 'includes/header_pharmacy.php'; ?>



  <!-- Navigation-->  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html">AJ JR Pharmacy</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item " title="Daily Sales">
          <a class="nav-link" href="sales_pharmacy.php">
            <span class="nav-link-text">Daily Sales</span>
          </a>
        </li>
        <li class="nav-item active" title="Monthly Sales">
          <a class="nav-link" href="sales_pharmacy_monthly.php">
            <span class="nav-link-text">Monthly Sales</span>
          </a>
        </li>
        <li class="nav-item" title="Yearly Sales">
          <a class="nav-link" href="sales_pharmacy_yearly.php">
            <span class="nav-link-text">Yearly Sales</span>
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
        <li class="breadcrumb-item active">Sales</li>
        </li>
      </ol>

      <div class="row">
        <div class="col-sm-12">
              <div class="row" style="padding-top: 1em;padding-bottom: 1em;">
              <div class="col-sm-8">
                <a class="btn btn-primary" href="#" id="sale-report_pharmacy">
                  <span class="nav-link-text">Print Sales</span>
                </a>
                <a class="btn btn-danger" href="sales_pharmacy_monthly.php">
                  <span class="nav-link-text">Back</span>
                </a>
              </div>
            </div>

          <!-- All Items -->
<?php
  // database connection
  require_once 'database/connection.php';
  $date_now = $_GET['ymd'];
  try {
      $stmt = $PDO->prepare("SELECT * FROM sales_trans WHERE date_tran LIKE ? AND cus_id = ?;");
      $stmt->bindValue(1, $date_now . "%", PDO::PARAM_STR);
      $stmt->bindValue(2, 0, PDO::PARAM_STR);
      $stmt->execute();
      $sales_trans = $stmt->fetchAll(PDO::FETCH_ASSOC); 
  } catch(PDOException $e) {
    echo $e->getMessage();
  }
?>
          <div class="card mb-3">
            <div class="card-header" style="background-color: #78ffae;">
              <i class="fa fa-table"></i> All Sales <strong style="float: right;"><?=date("F d, Y", strtotime($date_now));?></strong></div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="items" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="width: 30px;">#</th>
                      <th>Transaction No.</th>
                      <th>Total Price</th>
                      <th>Date</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $total = 0; $no=1; ?>
                    
                    <?php foreach ($sales_trans as $t): ?>
                    <?php $subTotal=0; ?>
                    <?php
                      try {
                        $stmt = $PDO->prepare("SELECT * FROM item_sales WHERE tran_id = ?");
                        $stmt->bindValue(1, $t["trans_no"], PDO::PARAM_STR);
                        $stmt->execute();
                        $stock_i = $stmt->fetchAll(PDO::FETCH_ASSOC);
                      } catch(PDOException $e) {
                        echo $e->getMessage();
                      }

                      foreach ($stock_i as $k) {
                        $subTotal += $k['sub_total'];
                      }
                      $total += $subTotal;
                    ?>
                    
                    <tr>
                      <td><?=$no++;?></td>
                      <td><?=sprintf("%09d", $t["trans_no"]);?></td>
                      <td><?=number_format($subTotal, 2);?></td>
                      <td><?=date("F d, Y - H:i a", strtotime($t['date_tran']));?></td>
                      <td>


                          <button type="button" class="btn btn-danger btn-xs" style="padding:3px;" data-toggle="modal" data-target="#TransactionDetails<?=$t['trans_no'];?>">Details</button>


    <!-- Detail Transaction Modal-->
    <div class="modal fade" id="TransactionDetails<?=$t['trans_no'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Transaction Details</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>

<?php
  $row_no = 1;
  $grandTotal = 0;
?>
<?php foreach ($stock_i as $bstotal):
  $grandTotal += $bstotal['sub_total'];
endforeach; ?>

          <div class="modal-body">
            <h6>Grand Total: PHP <?=number_format($grandTotal, 2);?></h6>
            <h6>Amount Tendered: PHP <?=$t['tendered'];?></h6>
            <h6>Amount Change: PHP <?=$t['amountchange'];?></h6>
            <h6>Date: <?=date("F d, Y - h:i a", strtotime($t['date_tran']));?></h6>
            <br>

<div class="">
  <table class="table table-bordered" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>#</th>
        <th>Item Name</th>
        <th>Price</th>
        <th>Qty</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($stock_i as $bs): ?>
        <tr>
          <td><?=$row_no++;?></td>
          <td><?=$bs['item_name'];?></td>
          <td><?=number_format($bs['sub_total'], 2);?></td>
          <td><?=$bs['qty'];?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
          </div>

          <div class="modal-footer">
          <input type="hidden" id="tran_id<?=$t['trans_no'];?>" value="<?=$t['trans_no'];?>">
            <a href="#" class="btn btn-primary" id="print_details_d<?=$t['trans_no'];?>">Print</a>
            <script>
        //sale-report_pharmacy print (details - daily)
        $('#print_details_d<?=$t['trans_no'];?>').click(function(event) {
          var tn = $('#tran_id<?=$t['trans_no'];?>').val();
          window.open('sales_pharmacy_print_details.php?tn='+tn+'&tendered='+<?=$t['tendered'];?>+'&change='+<?=$t['amountchange'];?>,'name','width=auto,height=auto');
        });
            </script>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>

                      </td>
                    </tr>

                    <?php endforeach; ?>
                  </tbody>
                  <tr>
                    <td colspan="7" style="text-align: right;"><strong style="font-size: 16pt">Total: PHP <?=number_format($total, 2);?></strong></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted hide">Updated yesterday at 11:59 PM</div>
          </div>
        </div>
      </div><!--<div class="row">-->
<?php require 'includes/footer.php'; ?>