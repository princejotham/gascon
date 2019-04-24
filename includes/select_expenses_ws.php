<?php
  // database connection
  require_once '../database/connection.php';
  if(isset($_POST['ed'])) {
    $ed = $_POST['ed'];

    try {
      $stmt = $PDO->prepare("SELECT * FROM expenses WHERE e_date LIKE ?;");
      $stmt->bindValue(1, $ed . "%", PDO::PARAM_STR);
      $stmt->execute();
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
      echo $e->getMessage();
    }
  } elseif(isset($_POST['month'])) {
    $sd = $_POST['sd'];

    try {
      $stmt = $PDO->prepare("SELECT * FROM expenses WHERE e_date LIKE ?;");
      $stmt->bindValue(1, $sd . "%", PDO::PARAM_STR);
      $stmt->execute();
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
      echo $e->getMessage();
    }
  } else {
    $sd = $_POST['sd'];

    try {
      $stmt = $PDO->prepare("SELECT * FROM expenses WHERE e_date LIKE ?;");
      $stmt->bindValue(1, $sd . "%", PDO::PARAM_STR);
      $stmt->execute();
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
      echo $e->getMessage();
    }
  }
?>
          <div class="card mb-3">
            <div class="card-header" style="background-color: #78ffae;">
              <i class="fa fa-table"></i> All Expenses <strong style="float: right;"><?=date("F d, Y");?></strong></div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="expenses" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="width: 30px;">#</th>
                      <th>Expenses Description.</th>
                      <th>Amount</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $total = 0; $no=1; ?>
                    <?php foreach ($results as $result): ?>
                    <?php $total += $result['price']; ?>

                    <tr>
                      <td><?=$no++;?></td>
                      <td><?=$result['expense'];?></td>
                      <td><?=number_format($result['price'], 2);?></td>
                      <td><?=date("F d, Y", strtotime($result['e_date']));?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                  <tr>
                    <td colspan="9" style="text-align: right;"><strong style="font-size: 16pt">Total Expenses: PHP <?=$total;?></strong></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted hide">Updated yesterday at 11:59 PM</div>
          </div>

<script type="text/javascript">
  $(document).ready(function() {
    $('#expenses').DataTable();
  });
</script>