<?php
	date_default_timezone_set('Asia/Manila');
	// Database Connection
	$DB_host = "localhost";
	$DB_user = "root";
	$DB_pass = "";
	$DB_name = "prijo_gascon";

	try
	{
		$PDO = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
		$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$PDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$PDO->setAttribute(PDO::ATTR_PERSISTENT, true);
	}
	catch(PDOException $ex)
	{
		echo $ex->getMessage();
	}

	function num_format($num) {
		$number = number_format($num, 2);
		return $number;
	}

	$stmt = $PDO->prepare("SELECT * FROM cart");
	$stmt->execute();
	$global_purchase_set = $stmt->fetchAll(PDO::FETCH_ASSOC);


	$stmt = $PDO->prepare("SELECT * FROM sales_trans");
	$stmt->execute();
	$global_transaction_count = $stmt->rowCount();

	function getBottleByID($id) {
		global $PDO;
		$stmt = $PDO->prepare("SELECT * FROM bottle WHERE id = ?");
		$stmt->bindValue(1, $id, PDO::PARAM_STR);
		$stmt->execute();
		$bottle = $stmt->fetch(PDO::FETCH_ASSOC);
		return $bottle;
	}

	function allBottles() {
		global $PDO;
		$stmt = $PDO->prepare("SELECT * FROM bottle");
		$stmt->execute();
		$allBottles = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $allBottles;
	}

	function getAllStocksByBottleID($id) {
		global $PDO;
		$stmt = $PDO->prepare("SELECT * FROM stock_bottle sb INNER JOIN bottle b ON sb.bottle_id = b.id WHERE `bottle_qty`=1 AND sb.bottle_id = ?;");
		$stmt->bindValue(1, $id, PDO::PARAM_STR);
		$stmt->execute();
		$allStocks = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $allStocks;
	}

	function countStocksByBottleID($id) {
		global $PDO;
		$stmt = $PDO->prepare("SELECT SUM(bottle_qty) as qty FROM stock_bottle WHERE bottle_id = ?;");
		$stmt->bindValue(1, $id, PDO::PARAM_STR);
		$stmt->execute();
		$allStocksCount = $stmt->fetch(PDO::FETCH_ASSOC);
		return $allStocksCount;
	}
?>