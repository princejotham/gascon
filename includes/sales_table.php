<?php
require_once 'database/connection.php';
/*
$date=date_create("2018-06-22");
date_sub($date, date_interval_create_from_date_string("3 days"));
echo date_format($date, "Y-m-d");
*/

try {
	$date_now = date("Y-m-d");
	$date_now_month = date("Y-m");

	// date now
  $stmt = $PDO->prepare("SELECT SUM(sub_total) AS ST FROM item_sales WHERE sales_date LIKE ?");
  $stmt->bindValue(1, $date_now . "%", PDO::PARAM_STR);
  $stmt->execute();
  $item_sales_today = $stmt->fetch(PDO::FETCH_ASSOC);

  $stmt = $PDO->prepare("SELECT SUM(sub_total) AS ST FROM bottle_sales WHERE sales_date LIKE ?");
  $stmt->bindValue(1, $date_now . "%", PDO::PARAM_STR);
  $stmt->execute();
  $bottle_sales_today = $stmt->fetch(PDO::FETCH_ASSOC);

  // -1 day
	$date_create=date_create($date_now);
	date_sub($date_create, date_interval_create_from_date_string("1 day"));
	$date_subd1 = date_format($date_create, "Y-m-d");

  $stmt = $PDO->prepare("SELECT SUM(sub_total) AS ST FROM item_sales WHERE sales_date LIKE ?");
  $stmt->bindValue(1, $date_subd1 . "%", PDO::PARAM_STR);
  $stmt->execute();
  $item_sales_today1 = $stmt->fetch(PDO::FETCH_ASSOC);

  $stmt = $PDO->prepare("SELECT SUM(sub_total) AS ST FROM bottle_sales WHERE sales_date LIKE ?");
  $stmt->bindValue(1, $date_subd1 . "%", PDO::PARAM_STR);
  $stmt->execute();
  $bottle_sales_today1 = $stmt->fetch(PDO::FETCH_ASSOC);

  // -2 day
	$date_create=date_create($date_now);
	date_sub($date_create, date_interval_create_from_date_string("2 days"));
	$date_subd2 = date_format($date_create, "Y-m-d");

  $stmt = $PDO->prepare("SELECT SUM(sub_total) AS ST FROM item_sales WHERE sales_date LIKE ?");
  $stmt->bindValue(1, $date_subd2 . "%", PDO::PARAM_STR);
  $stmt->execute();
  $item_sales_today2 = $stmt->fetch(PDO::FETCH_ASSOC);

  $stmt = $PDO->prepare("SELECT SUM(sub_total) AS ST FROM bottle_sales WHERE sales_date LIKE ?");
  $stmt->bindValue(1, $date_subd2 . "%", PDO::PARAM_STR);
  $stmt->execute();
  $bottle_sales_today2 = $stmt->fetch(PDO::FETCH_ASSOC);

  // -3 day
	$date_create=date_create($date_now);
	date_sub($date_create, date_interval_create_from_date_string("3 days"));
	$date_subd3 = date_format($date_create, "Y-m-d");

  $stmt = $PDO->prepare("SELECT SUM(sub_total) AS ST FROM item_sales WHERE sales_date LIKE ?");
  $stmt->bindValue(1, $date_subd3 . "%", PDO::PARAM_STR);
  $stmt->execute();
  $item_sales_today3 = $stmt->fetch(PDO::FETCH_ASSOC);

  $stmt = $PDO->prepare("SELECT SUM(sub_total) AS ST FROM bottle_sales WHERE sales_date LIKE ?");
  $stmt->bindValue(1, $date_subd3 . "%", PDO::PARAM_STR);
  $stmt->execute();
  $bottle_sales_today3 = $stmt->fetch(PDO::FETCH_ASSOC);

  // -4 day
	$date_create=date_create($date_now);
	date_sub($date_create, date_interval_create_from_date_string("4 days"));
	$date_subd4 = date_format($date_create, "Y-m-d");

  $stmt = $PDO->prepare("SELECT SUM(sub_total) AS ST FROM item_sales WHERE sales_date LIKE ?");
  $stmt->bindValue(1, $date_subd4 . "%", PDO::PARAM_STR);
  $stmt->execute();
  $item_sales_today4 = $stmt->fetch(PDO::FETCH_ASSOC);

  $stmt = $PDO->prepare("SELECT SUM(sub_total) AS ST FROM bottle_sales WHERE sales_date LIKE ?");
  $stmt->bindValue(1, $date_subd4 . "%", PDO::PARAM_STR);
  $stmt->execute();
  $bottle_sales_today4 = $stmt->fetch(PDO::FETCH_ASSOC);

  // -5 day
	$date_create=date_create($date_now);
	date_sub($date_create, date_interval_create_from_date_string("5 days"));
	$date_subd5 = date_format($date_create, "Y-m-d");

  $stmt = $PDO->prepare("SELECT SUM(sub_total) AS ST FROM item_sales WHERE sales_date LIKE ?");
  $stmt->bindValue(1, $date_subd5 . "%", PDO::PARAM_STR);
  $stmt->execute();
  $item_sales_today5 = $stmt->fetch(PDO::FETCH_ASSOC);

  $stmt = $PDO->prepare("SELECT SUM(sub_total) AS ST FROM bottle_sales WHERE sales_date LIKE ?");
  $stmt->bindValue(1, $date_subd5 . "%", PDO::PARAM_STR);
  $stmt->execute();
  $bottle_sales_today5 = $stmt->fetch(PDO::FETCH_ASSOC);

  // -6 day
	$date_create=date_create($date_now);
	date_sub($date_create, date_interval_create_from_date_string("6 days"));
	$date_subd6 = date_format($date_create, "Y-m-d");

  $stmt = $PDO->prepare("SELECT SUM(sub_total) AS ST FROM item_sales WHERE sales_date LIKE ?");
  $stmt->bindValue(1, $date_subd6 . "%", PDO::PARAM_STR);
  $stmt->execute();
  $item_sales_today6 = $stmt->fetch(PDO::FETCH_ASSOC);

  $stmt = $PDO->prepare("SELECT SUM(sub_total) AS ST FROM bottle_sales WHERE sales_date LIKE ?");
  $stmt->bindValue(1, $date_subd6 . "%", PDO::PARAM_STR);
  $stmt->execute();
  $bottle_sales_today6 = $stmt->fetch(PDO::FETCH_ASSOC);

  // MONTH
  // Today Month
  $stmt = $PDO->prepare("SELECT SUM(sub_total) AS ST FROM item_sales WHERE sales_date LIKE ?");
  $stmt->bindValue(1, $date_now_month . "%", PDO::PARAM_STR);
  $stmt->execute();
  $iMonth = $stmt->fetch(PDO::FETCH_ASSOC);

  $stmt = $PDO->prepare("SELECT SUM(sub_total) AS ST FROM bottle_sales WHERE sales_date LIKE ?");
  $stmt->bindValue(1, $date_now_month . "%", PDO::PARAM_STR);
  $stmt->execute();
  $bMonth = $stmt->fetch(PDO::FETCH_ASSOC);

  // -1 Month
	$date_create=date_create($date_now_month);
	date_sub($date_create, date_interval_create_from_date_string("1 month"));
	$date_subM1 = date_format($date_create, "Y-m");

  $stmt = $PDO->prepare("SELECT SUM(sub_total) AS ST FROM item_sales WHERE sales_date LIKE ?");
  $stmt->bindValue(1, $date_subM1 . "%", PDO::PARAM_STR);
  $stmt->execute();
  $iMonth1 = $stmt->fetch(PDO::FETCH_ASSOC);

  $stmt = $PDO->prepare("SELECT SUM(sub_total) AS ST FROM bottle_sales WHERE sales_date LIKE ?");
  $stmt->bindValue(1, $date_subM1 . "%", PDO::PARAM_STR);
  $stmt->execute();
  $bMonth1 = $stmt->fetch(PDO::FETCH_ASSOC);

  // -2 Month
	$date_create=date_create($date_now_month);
	date_sub($date_create, date_interval_create_from_date_string("2 months"));
	$date_subM2 = date_format($date_create, "Y-m");

  $stmt = $PDO->prepare("SELECT SUM(sub_total) AS ST FROM item_sales WHERE sales_date LIKE ?");
  $stmt->bindValue(1, $date_subM2 . "%", PDO::PARAM_STR);
  $stmt->execute();
  $iMonth2 = $stmt->fetch(PDO::FETCH_ASSOC);

  $stmt = $PDO->prepare("SELECT SUM(sub_total) AS ST FROM bottle_sales WHERE sales_date LIKE ?");
  $stmt->bindValue(1, $date_subM2 . "%", PDO::PARAM_STR);
  $stmt->execute();
  $bMonth2 = $stmt->fetch(PDO::FETCH_ASSOC);

  // -3 Month
	$date_create=date_create($date_now_month);
	date_sub($date_create, date_interval_create_from_date_string("3 months"));
	$date_subM3 = date_format($date_create, "Y-m");

  $stmt = $PDO->prepare("SELECT SUM(sub_total) AS ST FROM item_sales WHERE sales_date LIKE ?");
  $stmt->bindValue(1, $date_subM3 . "%", PDO::PARAM_STR);
  $stmt->execute();
  $iMonth3 = $stmt->fetch(PDO::FETCH_ASSOC);

  $stmt = $PDO->prepare("SELECT SUM(sub_total) AS ST FROM bottle_sales WHERE sales_date LIKE ?");
  $stmt->bindValue(1, $date_subM3 . "%", PDO::PARAM_STR);
  $stmt->execute();
  $bMonth3 = $stmt->fetch(PDO::FETCH_ASSOC);

  // -4 Month
	$date_create=date_create($date_now_month);
	date_sub($date_create, date_interval_create_from_date_string("4 months"));
	$date_subM4 = date_format($date_create, "Y-m");

  $stmt = $PDO->prepare("SELECT SUM(sub_total) AS ST FROM item_sales WHERE sales_date LIKE ?");
  $stmt->bindValue(1, $date_subM4 . "%", PDO::PARAM_STR);
  $stmt->execute();
  $iMonth4 = $stmt->fetch(PDO::FETCH_ASSOC);

  $stmt = $PDO->prepare("SELECT SUM(sub_total) AS ST FROM bottle_sales WHERE sales_date LIKE ?");
  $stmt->bindValue(1, $date_subM4 . "%", PDO::PARAM_STR);
  $stmt->execute();
  $bMonth4 = $stmt->fetch(PDO::FETCH_ASSOC);

  // -5 Month
	$date_create=date_create($date_now_month);
	date_sub($date_create, date_interval_create_from_date_string("5 months"));
	$date_subM5 = date_format($date_create, "Y-m");

  $stmt = $PDO->prepare("SELECT SUM(sub_total) AS ST FROM item_sales WHERE sales_date LIKE ?");
  $stmt->bindValue(1, $date_subM5 . "%", PDO::PARAM_STR);
  $stmt->execute();
  $iMonth5 = $stmt->fetch(PDO::FETCH_ASSOC);

  $stmt = $PDO->prepare("SELECT SUM(sub_total) AS ST FROM bottle_sales WHERE sales_date LIKE ?");
  $stmt->bindValue(1, $date_subM5 . "%", PDO::PARAM_STR);
  $stmt->execute();
  $bMonth5 = $stmt->fetch(PDO::FETCH_ASSOC);

} catch(PDOException $e) {
  echo $e->getMessage();
}
?>

<input type="hidden" id="date_today_price" value="<?=$bottle_sales_today['ST']+$item_sales_today['ST'];?>">
<input type="hidden" id="date_today" value="<?=date("M d");?>">

<input type="hidden" id="date_today_p1" value="<?=$bottle_sales_today1['ST']+$item_sales_today1['ST'];?>">
<input type="hidden" id="date_subd1" value="<?=date("M d", strtotime($date_subd1));?>">

<input type="hidden" id="date_today_p2" value="<?=$bottle_sales_today2['ST']+$item_sales_today2['ST'];?>">
<input type="hidden" id="date_subd2" value="<?=date("M d", strtotime($date_subd2));?>">

<input type="hidden" id="date_today_p3" value="<?=$bottle_sales_today3['ST']+$item_sales_today3['ST'];?>">
<input type="hidden" id="date_subd3" value="<?=date("M d", strtotime($date_subd3));?>">

<input type="hidden" id="date_today_p4" value="<?=$bottle_sales_today4['ST']+$item_sales_today4['ST'];?>">
<input type="hidden" id="date_subd4" value="<?=date("M d", strtotime($date_subd4));?>">

<input type="hidden" id="date_today_p5" value="<?=$bottle_sales_today5['ST']+$item_sales_today5['ST'];?>">
<input type="hidden" id="date_subd5" value="<?=date("M d", strtotime($date_subd5));?>">

<input type="hidden" id="date_today_p6" value="<?=$bottle_sales_today6['ST']+$item_sales_today6['ST'];?>">
<input type="hidden" id="date_subd6" value="<?=date("M d", strtotime($date_subd6));?>">






<input type="hidden" id="Month" value="<?=$bMonth['ST']+$iMonth['ST'];?>">
<input type="hidden" id="Monthd" value="<?=date("F");?>">

<input type="hidden" id="Month1" value="<?=$bMonth1['ST']+$iMonth1['ST'];?>">
<input type="hidden" id="Monthd1" value="<?=date("F", strtotime($date_subM1));?>">

<input type="hidden" id="Month2" value="<?=$bMonth2['ST']+$iMonth2['ST'];?>">
<input type="hidden" id="Monthd2" value="<?=date("F", strtotime($date_subM2));?>">

<input type="hidden" id="Month3" value="<?=$bMonth3['ST']+$iMonth3['ST'];?>">
<input type="hidden" id="Monthd3" value="<?=date("F", strtotime($date_subM3));?>">

<input type="hidden" id="Month4" value="<?=$bMonth4['ST']+$iMonth4['ST'];?>">
<input type="hidden" id="Monthd4" value="<?=date("F", strtotime($date_subM4));?>">

<input type="hidden" id="Month5" value="<?=$bMonth5['ST']+$iMonth5['ST'];?>">
<input type="hidden" id="Monthd5" value="<?=date("F", strtotime($date_subM5));?>">

      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-area-chart"></i> Daily Sales <small class="pull-right">Year <?=date("Y")?></small></div>
        <div class="card-body">
          <canvas id="myAreaChart" width="100%" height="30"></canvas>
        </div>
      </div>
<?php
try {
  $grand_total_sell = 0;
  $grand_total_buy = 0;
  $grand_total_b_stock = 0;

  $stmt = $PDO->prepare("SELECT SUM(price) AS e_price FROM expenses");
  $stmt->execute();
  $expenses = $stmt->fetch(PDO::FETCH_ASSOC);

  $stmt = $PDO->prepare("SELECT SUM(sub_total) AS ST FROM item_sales");
  $stmt->execute();
  $total_item_sales = $stmt->fetch(PDO::FETCH_ASSOC);

  $stmt = $PDO->prepare("SELECT SUM(sub_total) AS ST FROM bottle_sales");
  $stmt->execute();
  $total_bottle_sales = $stmt->fetch(PDO::FETCH_ASSOC);

  $stmt = $PDO->prepare("SELECT * FROM stock_bottle WHERE bottle_qty = ?");
  $stmt->bindValue(1, 1, PDO::PARAM_STR);
  $stmt->execute();
  $stock_bottle = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach ($stock_bottle as $key) {
    $stmt = $PDO->prepare("SELECT SUM(price) AS ST FROM bottle WHERE id = ?");
    $stmt->bindValue(1, $key['bottle_id'], PDO::PARAM_STR);
    $stmt->execute();
    $total_bottle_stock = $stmt->fetch(PDO::FETCH_ASSOC);    
    $grand_total_b_stock += $total_bottle_stock['ST'];
  }

  $stmt = $PDO->prepare("SELECT * FROM stock_item");
  $stmt->execute();
  $stock_item = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach ($stock_item as $key) {
    $stmt = $PDO->prepare("SELECT * FROM item WHERE id=?");
    $stmt->bindValue(1, $key['item_id'], PDO::PARAM_STR);
    $stmt->execute();
    $item = $stmt->fetch(PDO::FETCH_ASSOC);
    $sub_total_buy = $item['buy_price'] * $key['item_qty'];
    $sub_total_sell = $item['sell_price'] * $key['item_qty'];
    $grand_total_buy += $sub_total_buy;
    $grand_total_sell += $sub_total_sell;
  }

  $st0 = $total_item_sales['ST']+$total_bottle_sales['ST']+$grand_total_b_stock;
  $grand_total_sell += $st0;

  $st1 = $total_item_sales['ST']+$total_bottle_sales['ST']+$grand_total_b_stock;
  $grand_total_buy += $st1;
} catch(PDOException $e) {
  echo $e->getMessage();
}
?>
      <div class="row">
        <div class="col-lg-12">
          <!-- Monthly Sales-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-bar-chart"></i> Monthly Sales <small class="pull-right">Year <?=date("Y")?></small></div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-8 my-auto">
                  <canvas id="myBarChart" width="100" height="50"></canvas>
                </div>
                <div class="col-sm-4 text-center my-auto">
                  <div class="h4 mb-0 text-primary">PHP <?=number_format($grand_total_buy, 2)?></div>
                  <div class="small text-muted">Revenue</div>
                  <hr>
                  <?php
                    $pro = 0;
                    $profit = 0;
                    $pro = $total_item_sales['ST']+$total_bottle_sales['ST'];
                    $pro = 9900-$grand_total_sell;
                    if($pro<=0) {
                      $profit = 0;
                    } else {
                      $profit = $pro;
                    }
                  ?>
                  <div class="h4 mb-0 text-success">PHP <?=number_format($profit, 2)?></div>
                  <div class="small text-muted">Profit</div>
                  <hr>
                  <div class="h4 mb-0 text-warning">PHP <?=number_format($expenses["e_price"], 2)?></div>
                  <div class="small text-muted">Expenses</div>
                </div>
              </div>
            </div>
          </div>