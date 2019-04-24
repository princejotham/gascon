<?php
  // database connection
  require_once '../database/connection.php';
  $date_now = date("Y-m-d");
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
