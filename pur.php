<?php
require_once 'database/connection.php';
$date=date_create("2018-06");
date_sub($date, date_interval_create_from_date_string("1 month"));
echo date_format($date, "M");

  try {
    $stmt = $PDO->prepare("SELECT SUM(sub_total) AS ST FROM item_sales WHERE sales_date LIKE ?");
    $stmt->bindValue(1, date("Y-m-d") . "%", PDO::PARAM_STR);
    $stmt->execute();
    $item_sales = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $PDO->prepare("SELECT SUM(sub_total) AS ST FROM bottle_sales WHERE sales_date LIKE ?");
    $stmt->bindValue(1, date("Y-m-d") . "%", PDO::PARAM_STR);
    $stmt->execute();
    $bottle_sales = $stmt->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $e) {
    echo $e->getMessage();
  }

  $date_now = date("Y-m-d");
  $date_create=date_create($date_now);
  date_sub($date_create, date_interval_create_from_date_string("1 day"));
  echo date_format($date_create, "Y-m-d");
?>
<h1><?=$item_sales['ST']+$bottle_sales['ST'];?></h1>